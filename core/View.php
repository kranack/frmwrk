<?php
/**
 * View Class
 * @file View.php
 * @author Damien Calesse
 * @date 18/07/2015
 * @description View class for templating
 *              and page caching
 **/
class View {

  private $_template = null;
  private $_body = null;
  private $_cache_file = null;

  private $__data = null;
  private $__view_content = null;
  private $__view_path = null;
  private $__view_root_path = null;
  private $__cache_root_path = null;

  private $__enable_cache = false;

  public function __construct () {
    $this->set_template("default.tpl");
    $this->__data = array(
      "charset"   =>  "utf-8",
      "css"       =>  array(),
      "title"     =>  DEFAULT_VIEW_TITLE
    );
    $this->__view_root_path = ROOT_PATH .  'views' . PATH_SEPARATORS;
    $this->__cache_root_path = 'cache' . PATH_SEPARATORS;

    $this->__enable_cache = false;
  }

  public function display () {
    $this->__data = (object) $this->__data;
    $__content = $this->render();
    if ($this->__enable_cache) {
      Cache::restore_from_db();
      $content = Cache::restore ($this->_template, $this->_body);
      if ($content === null) {
        Cache::save($this->_template, $this->_body, $__content);
        echo $__content;
      } else {
        echo $content;
      }
    } else {
      echo $__content;
    }
  }

  public function set_template ($template) {
    $this->_template = $template;

    return $this;
  }

  public function set_body ($folder, $file = 'index.tpl') {
    $this->__view_path = $this->__view_root_path . $folder . PATH_SEPARATORS;
    $this->_body = $folder . DIRECTORY_SEPARATOR . $file;

    return $this;
  }

  public function attach_data ($data) {
    /* Get filenames */
    if ($this->_template !== null) {
      $__template_filename = ROOT_DIRECTORY . 'views' . DIRECTORY_SEPARATOR . $this->_template;
    }
    if ($this->_body !== null) {
      $__body_filename = ROOT_DIRECTORY . 'views' . DIRECTORY_SEPARATOR . $this->_body;
    }

    /* Add content to data */
    $this->__data = array_merge($this->__data, $data);
    //$this->__data ['content'] = $__bdy;
    if (isset($__body_filename)) {
      ob_start();
      require_once ($__body_filename);
      $this->__data['body'] = ob_get_clean();
    }

    return $this;
  }

  public function set_css ($css) {
    foreach ($css as $c) {
      $this->__data ['css'] [] = '<link rel="stylesheet" type="text/css" href="'. $this->__view_path . $c .'">';
    }
  }

  public function set_js ($js) {
    foreach ($js as $j) {
      $this->__data ['js'] [] = '<script type="text/javascript" src="' . $j . '"></script>';
    }
  }

  public function exec() {
    $this->__view_content = preg_replace('~\{(\w+)\}~', '<?php echo \'$1\'; ?>', $this->__view_content);
  }

  public function set_content_type ($type, $charset = null) {
    try {
      if ($charset !== null) {
        $header = Headers::set_content($type) . ';' . Headers::set_charset($charset);
        Headers::save($header);
      } else {
        Headers::save(Headers::set_content($type));
      }
    } catch (HeaderTypeException $e) {
      print_r($e->getMessage());
    }

    return $this;
  }

  public function set_charset ($charset) {
    try {
      Headers::save(Headers::set_charset($charset));
    } catch (HeaderTypeException $e) {
      print_r($e->getMessage());
    }

    return $this;
  }

  private function render () {
    if ($this->_template === null) {
      throw new Exception("Cannot render View");
    } else {
      ob_start();
      //require_once ($this->__cache_root_path . $this->_cache_file);
      require_once (ROOT_DIRECTORY . 'views' . DIRECTORY_SEPARATOR . $this->_template);
      return ob_get_clean();
    }
  }

  private function substitute_match ($matches) {
    if (isset($this->__data[strtolower($matches[1])])) {
      return $this->__data[strtolower($matches[1])];
    }
    // Don't bother doing the substitution.
    return $matches[0];
  }

  private function set_cache () {
    file_put_contents ($this->__cache_root_path . $this->_cache_file, $this->__view_content);
  }
}
