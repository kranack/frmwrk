<?php

  class Query {

    protected $_db            =   null;
    protected $_sql           =   null;
    protected $_fields_args   =   null;

    protected $_action        =   '';
    protected $_select        =   '';
    protected $_values        =   '';
    protected $_fields        =   '';
    protected $_from          =   '';
    protected $_where         =   '';

    protected $_limit         =   '';
    protected $_start_limit   =   0;
    protected $_orderBy       =   '';

    const FETCH_TYPE = [
      'assoc'   => PDO::FETCH_ASSOC,
      'both'    => PDO::FETCH_BOTH,
      'bound'   => PDO::FETCH_BOUND,
      'class'   => PDO::FETCH_CLASS,
      'into'    => PDO::FETCH_INTO,
      'lazy'    => PDO::FETCH_LAZY,
      'named'   => PDO::FETCH_NAMED,
      'num'     => PDO::FETCH_NUM,
      'obj'     => PDO::FETCH_OBJ
    ];

    const FETCH_ARG = [
      'column'  => PDO::FETCH_COLUMN,
      'class'   => PDO::FETCH_CLASS,
      'func'    => PDO::FETCH_FUNC
    ];

    const ACTIONS = [
      'select'  =>  'SELECT',
      'update'  =>  'UPDATE',
      'insert'  =>  'INSERT INTO',
      'delete'  =>  'DELETE'
    ];

    const OPERATORS = [
      'AND', 'OR'
    ];

    const OPERANDS = [
      '=', '!=', 'LIKE', 'BETWEEN', 'IS NULL', 'IS NOT NULL'
    ];

    public function __construct ($connection) {
      $this->_db = $connection;
      $this->_sql = "";
    }

    /**
     *  Protected methods
     */

    protected function _select ($fields, $mode = null) {
      if ($mode !== null) {
        $this->_select = strtoupper($mode);
      }
      $this->sql('select', $fields);
    }

    protected function _insert ($table, $fields) {
      $this->_from = $table;
      if (!empty($fields)) {
        $args = array();
        foreach ($fields as $k => $v) {
          $args[':'.$k] = $v;
        }
        $f = '(' . implode(',', array_keys($fields)) . ')';
        $this->_values = '( :'.implode(', :',array_keys($fields)) .' )';
      }
      $this->_fields = $f;
      $this->sql('insert', $args);
    }

    protected function _update ($table, $fields) {
      $this->_from = $table;
      $f =  "";
      foreach ($fields as $k => $v) {
        $f .= $this->escAttr($k) . ' = \'' . $v . '\'';
      }
      $this->sql('update', $f);
    }

    protected function _delete ($table) {
      $this->_from = $table;
      $this->sql('delete');
    }

    protected function _row ($sql) {
      return $sql;
    }

    protected function _run () {
      if ($this->_sql === null) {
        $this->generate();
      }
      if ($this->_fields_args !== null
          && !empty($this->_fields_args)) {
            $result = $this->_db->execute($this->_sql, $this->_fields_args);
          }
      $result = $this->_db->execute($this->_sql);

      if ($this->_action === 'SELECT'
          && $this->_select === '') {
        return $this->_db->fetchAll($result->statement);
      } elseif ($this->_action === 'SELECT') {
        return $this->_db->fetch($result->statement);
      } else {
        return $result;
      }
    }

    protected function sql ($action, $arg = "") {
      if (array_key_exists($action, self::ACTIONS)) {
        $this->_action = self::ACTIONS[$action];
        if (!is_array($arg)) {
          $this->_fields = $arg;
        } else {
          $this->_fields_args = $arg;
        }
      }
      //call_user_func_array(array($this, '_'.$action), array());
    }

    protected function escAttr ($attr) {
      return '`' . $attr . '`';
    }

    protected function generate () {
      return $this->_sql = $this->_generator();
    }

    protected function _generator () {
      switch ($this->_action) {
        case 'SELECT':
            $sql = 'SELECT ';
            if ($this->_select !== '') {
              $sql .= $this->_select . ' ';
            }
            if ($this->_fields !== ''
                && $this->_fields !== '*') {
              $sql .= $this->escAttr($this->_fields);
            } else {
              $sql .= $this->_fields;
            }
            if ($this->_from !== '') {
              $sql .= ' FROM ' . $this->escAttr($this->_from);
            }
            if ($this->_where !== '') {
              $sql .= ' WHERE ' . $this->_where;
            }
            if ($this->_limit !== '') {
              $sql .= ' LIMIT ' . $this->_start_limit . ', ' . $this->_limit;
            }
            if ($this->_orderBy !== '') {
              $sql .= ' ORDER BY ' . $this->_orderBy;
            }
          break;
        case 'INSERT INTO':
            $sql = 'INSERT INTO ';
            if ($this->_from !== '') {
              $sql .= $this->escAttr($this->_from);
            }
            if ($this->_fields !== '') {
              $sql .= $this->_fields;
            }
            if ($this->_values !== '') {
              $sql .= ' VALUES ' . $this->_values;
            }
          break;
        case 'UPDATE':
            $sql = 'UPDATE ';
            if ($this->_from !== '') {
              $sql .= $this->escAttr($this->_from);
            }
            if ($this->_fields !== '') {
              $sql .= ' SET ' . $this->_fields;
            }
            if ($this->_where !== '') {
              $sql .= ' WHERE ' . $this->_where;
            }
          break;
        case 'DELETE':
            $sql = 'DELETE FROM ';
            if ($this->_from !== '') {
              $sql .= $this->escAttr($this->_from);
            }
            if ($this->_where !== '') {
              $sql .= ' WHERE ' . $this->_where;
            }
          break;
        default:
          break;
      }

      return $sql;
    }

    protected function _secureWhere ($cond) {
      /* Prepare operators capture string */
      $operators = '(' . implode(')|(', self::OPERATORS) . ')';

      /* Split condition string with operators */
      $conds = preg_split('/' . $operators . '/', $cond, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

      /* Split each condition with operands */
      $last = '';
      $new_cond = '';
      foreach ($conds as $c) {
        /*
          IF $c is a regular condition (not an operator)
             AND $c is not empty AND $last was not an operator
             OR is empty
          ELSE IF $c is an operator AND $last was not an operator
          */
        if (!in_array($c, self::OPERATORS)
            && trim($c) !== ''
            && (in_array($last, self::OPERATORS) || $last === '')) {
          $operands = '(' . implode(')|(', self::OPERANDS) . ')';
          $a = preg_split('/' . $operands . '/', $c, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

          if ($last !== '') {
            $new_cond .= ' ';
          }
          $new_cond .= $this->escAttr(trim($a[0])) . ' ' . trim($a[1]);
          if (count($a) === 3) {
            $new_cond .= ' ' . trim($a[2]);
          }
          $last = trim($c);
        } elseif (in_array($c, self::OPERATORS)
                  && !in_array($last, self::OPERATORS)) {
          $new_cond .= ' ' . trim($c) . ' ';
          $last = trim($c);
        }

      }
      return $new_cond;
    }

  }
