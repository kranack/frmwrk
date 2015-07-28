<?php
/**
 * Core Class
 * @author Damien Calesse
 * @date 18/07/2015
 * @description core class "the one"
 */
class Core {

  private static $_excpt = array('Exceptions', 'Core');
  private static $_opt = array();
  private static $_dir = __DIR__;

  private static $__loaded = array();
  private static $__priority = array();

  public static function require_all ($load_hooks = false) {
    if ($load_hooks) {
      self::load_hooks();
    }
    self::load_priority_files();
    self::_require_directory(self::$_dir);
    self::_require_optionnals();
    if ($load_hooks) {
      self::load_hooks(false);
    }
  }

  public static function require_file ($dir, $file) {
    if ($file === null) {
      return null;
    }

    if (is_dir($file)) {
      self::_require_directory($file);
    } else {
      if (!in_array($file, self::$_excpt)) {
        require_once($dir . DIRECTORY_SEPARATOR . $file);
        self::$__loaded [] = $dir . DIRECTORY_SEPARATOR . $file;
      }
    }
  }

  public static function enable ($smthg) {
    if (!in_array($smthg, self::$_opt)) {
      self::$_opt [] = strtolower($smthg);
    }
  }

  public static function disable ($smthg) {
    $k = array_search($smthg, self::$_opt);
    if ($k !== false) {
      unset(self::$_opt[$smthg]);
    }
  }

  public static function is_loaded ($classname) {
    return in_array($classname, self::$__loaded);
  }

  private static function load_hooks ($load_before_core = true) {
    $hooks = Config::get_hooks($load_before_core);
    if ($hooks === null) {
      return null;
    }
    require_once(self::$_dir . DIRECTORY_SEPARATOR . 'Hooks.php' );
    foreach ($hooks as $class => $func) {
      require_once(HOOKS_DIRECTORY . DIRECTORY_SEPARATOR . $class . '.php');
      $c = new $class();
      $c->$func();
    }
  }

  private static function load_priority_files () {
    if (empty(self::$__priority)) {
      return null;
    }
    foreach (self::$__priority as $_file) {
      if (!in_array($_file, self::$__loaded)) {
        self::_require_file($_file);
        self::$__loaded [] = $_file;
      }
    }
  }

  private static function _require_file ($dir, $filename) {
    //$_filename = self::$_dir . DIRECTORY_SEPARATOR . $filename;
    if (!in_array($filename, self::$_excpt)) {
      require_once($filename);
    }
    if ($p = get_parent_class($filename)) {
      if (!in_array($p, self::$_excpt)) {
        require_once($dir . DIRECTORY_SEPARATOR . $p . '.php');
      }
    }
    $classname = preg_replace('/\\.[^.\\s]{3,4}$/', '', strrchr($filename, "\\"));
    if ($interfaces = class_implements($classname)) {
      foreach ($interfaces as $interface) {
        require_once($dir . DIRECTORY_SEPARATOR . $interface . '.php');
      }
    }
  }

  private static function _require_directory ($dir) {
    $_files = self::_get_files_from_dir($dir);
    foreach($_files as $_file) {
      if (!in_array($_file, self::$__loaded)) {
        if (is_dir($_file)) {
          self::_require_directory($_file);
        }
        self::_require_file($dir, $_file);
        self::$__loaded [] = $_file;
      }
    }
  }

  private static function _get_files_from_dir ($dir) {
    $files = array();

    $dh  = opendir($dir);
    while (false !== ($filename = readdir($dh))) {
      if(!in_array($filename,array(".",".."))) {
        if (is_dir($dir . DIRECTORY_SEPARATOR . $filename)) {
          $files = array_merge($files, self::_get_files_from_dir($dir . DIRECTORY_SEPARATOR . $filename));
        } else {
          $files[] = $dir . DIRECTORY_SEPARATOR . $filename;
        }
      }
    }
    asort($files);
    return $files;
  }

  private static function _require_optionnals () {
    if (empty(self::$_opt)) {
      return null;
    }
    foreach (self::$_opt as $dir) {
      if ($dir === "modules") {
        self::__load_modules($dir);
      } else {
        self::_require_directory($dir);
      }
    }
  }

  private static function __get_parent_classes ($classname) {
    if ($p = get_parent_class($classname)) {
      if (!in_array($p, self::$_excpt)) {
        require_once($p . '.php');
      }
    }
  }

  private static function __load_modules ($dir) {
    $files = self::_get_files_from_dir($dir);
    if (empty($files)) {
      return null;
    }
    usort($files, function ($a, $b) {
      if (strpos(strtolower($a), "element") !== false) {
        return 0;
      } elseif (substr($a, -8) === "form.php") {
        return 1;
      } else {
        return 2;
      }
    });

    foreach ($files as $module) {
      /* Get Classname and namespace */
      $classname = ltrim(preg_replace('/\\.[^.\\s]{3,4}$/', '', strrchr($module, "\\")), '\\');
      $namespace = ucfirst(str_replace('.php', '', $module));

      /* Get parent class and require class */
      self::__get_parent_classes($classname);
      if (!(substr($module, -strlen(".tpl")) === ".tpl")) {
        require_once ($module);
      }

      /* If it's a module, launch the system_init function */
      if (strpos(strtolower($classname), "module") !== false) {
        $m = new $namespace();
        $func = "system_init";
        $m->$func();
      }
      self::$__loaded [] = $namespace;
    }
  }

  /* not used */
  public static function _load_model ($model) {
    try {
      require_once (MODELS_DIRECTORY . DIRECTORY_SEPARATOR . $model . '.php');
    } catch (Exception $e) {
      print_r($e->getMessage());
    }
  }

  private function get_all_classes_implementing_interfaces ($interface) {
    $array = array();
    $array = array_filter(
      get_declared_classes(), function($className) use ($interface) {
        return in_array($interface, class_implements($className));
      }
    );

    return $array;
  }

  private function get_all_modules($interface = "Hooks") {
    return (self::get_all_classes_implementing_interfaces($interface));
  }

  /**
  * method_invoke_all
  * @param String $method the method to invoke
  * @param mixed args...(Optionnal)
  * @return array of mixed results.
  */
  private function method_invoke_all($method, $parameters = array(),    $merge = false, $interface = "Hooks") {
    $r = array();
    $modules = self::get_all_modules($interface);
    foreach ($modules as $module) {
      $utils = array($module, $method, $parameters);
      if (method_exists($module, $method)) {
        if ($merge) {
          $r = array_merge($r, call_user_func_array("method_invoke", $utils));
        } else {
          $r[] = call_user_func_array("method_invoke", $utils);
        }
      }
    }
    return $r;
  }

  /**
  * method_invoke
  * @param string $module
  * @param string $method
  * @param mixed args...(Optionnal)
  * @return mixed results.
  */
  private function method_invoke($module, $method, $utils = array()) {
    if (method_exists($module, $method)) {
      $b = new $module();
      return call_user_func_array(array($b, $method), $utils);
    }
    return null;
  }

}
