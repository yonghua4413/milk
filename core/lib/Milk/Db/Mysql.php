<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk\Db;

use Milk\Config;
use PDO;

class Mysql extends Drive
{
    private static $instance;
    private static $tableName;
    private static $prefix;
    private static $where;
    private static $sql;
    private static $field;
    private static $db;
    private static $alias;
    private static $join = [];

    public function __call($name, $arguments)
    {
        if (is_null(self::$db)) {
            self::connection();
        }
        return $this->$name($arguments);
    }

    private static function connection()
    {
        class_exists('PDO') or die("PDO: class not exists.");
        self::setConfig();
        try {
            if (is_null(self::$db)) {
                self::$db = new PDO(self::$dns, self::$config['username'], self::$config['password'], []);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$db->exec('SET NAMES ' . self::$config['charset']);
            }
        } catch (\PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function name($name)
    {
        return static::register($name, Config::get('database.prefix'));
    }

    private static function register($name, $prefix = null)
    {
        if (!static::$instance instanceof self) {
            static::$instance = new self();
        }

        static::$tableName = is_null($prefix) ? $name : $prefix . $name;
        return static::$instance;
    }

    public function where()
    {
        $num = func_num_args();
        $args = func_get_args();

        static::$where = 'where ';
        if ($num == 0) {
            die('function where at least one parameter.');
        }
        if ($num == 1) {
            foreach ($args[0] as $key => $value) {
                if (static::$where == 'where ') {
                    static::$where .= "{$key} = '{$value}' ";
                } else {
                    static::$where .= "AND {$key} = '{$value}' ";
                }
            }
        } else {
            $num != 2 ?: array_splice($args, 1, 0, '=');
            static::$where .= "{$args['0']} {$args[1]} '{$args[2]}' ";
        }
        return static::$instance;
    }

    public function alias($var)
    {
        self::$alias = $var;
        return static::$instance;
    }

    public function join($option, $where, $model = 'left')
    {
        $arr = [];
        $arr['option'] = $option;
        $arr['where'] = $where;
        $arr['model'] = $model;
        array_push(self::$join, $arr);
        return static::$instance;
    }

    private function insert($data)
    {
        $data = $this->dataFormat(self::$tableName, $data[0]);
        if (!$data) return 0;
        $table = self::$tableName;
        $field = implode(',', array_keys($data));
        $value = implode(',', array_values($data));
        // $sql = "insert into {$table} ({$field}) value({$value})";
        $sql = htmlentities("INSERT INTO {$table} ({$field}) VALUES ($value)");
        // halt($sql);
        return self::$db->exec($sql);
    }

    private function dataFormat($tableName, $data)
    {
        if (!is_array($data)) return [];
        $tableColumn = $this->tablefield($tableName);
        $res = [];
        foreach ($data as $key => $value) {
            if (!is_scalar($value)) continue;
            if (array_key_exists($key, $tableColumn)) {
                $key = $this->addChar($key);
                if (is_int($value)) $value = intval($value);
                if (is_float($value)) $value = floatval($value);
                if (is_string($value)) $value = "'" .  addslashes($value) . "'";
                $res[$key] = $value;
            }
        }
        return $res;
    }

    private function addChar(string $value)
    {
        if ('*' == $value || false !== strpos($value, '(') || false !== strpos($value, '.') || false !== strpos($value, '`')) {
        } elseif (false === strpos($value, '`')) {
            $value = '`' . trim($value) . '`';
        }
        return $value;
    }

    private function tablefield($tableName)
    {
        $sql = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME="' . $tableName . '"AND TABLE_SCHEMA="' . self::$config['database'] . '"';
        $sth = self::$db->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($result as $key => $value) {
            $res[$value['COLUMN_NAME']] = 1;
        }
        return $res;
    }

    private function update($data)
    {
        // No condition stop update (Security considerations)
        if (!trim(self::$where)) return 0;
        $data = $this->dataFormat(self::$tableName, $data[0]);
        if (!$data) return 0;
        $arr = [];
        foreach ($data as $key => $value) {
            $arr[] = $key . '=' . $value;
        }
        $table = self::$tableName;
        $where = self::$where;
        $value = implode(',', $arr);
        $sql = htmlentities("UPDATE {$table} SET {$value} {$where}");
        return self::$db->exec($sql);
    }

    private function delete()
    {
        // No condition stop update (Security considerations)
        if (!trim(self::$where)) return 0;
        $table = self::$tableName;
        $where = self::$where;
        $sql = htmlentities("DELETE FROM {$table} {$where}");
        return self::$db->exec($sql);
    }

    private function select()
    {
        return self::getData(true);
    }

    private function find()
    {
        return self::getData();
    }

    private function value($field)
    {
        $res = $this->find();
        if (!empty($res)) {
            if (array_key_exists($field[0], $res)) {
                return $res[$field[0]];
            } else {
                halt("Undefined index: {$field[0]}");
            }
        }
        return false;
    }

    private static function getData($batch = false)
    {
        $sql = self::getSelectSql();
        $sql = htmlspecialchars($sql);
        $sth = self::$db->prepare($sql);
        $sth->execute();
        if ($batch) {
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $res = $sth->fetch(PDO::FETCH_ASSOC);
        }
        return $res;
    }

    private static function getSelectSql()
    {
        self::$field = empty(self::$field) ? "*" : self::$field;

        self::$sql = 'select ' . self::$field;
        self::$sql .= ' from ' . self::$tableName;
        self::$sql .= ' ' . self::$alias;

        foreach (self::$join as $key => $value) {
            self::$sql .= " {$value['model']} join {$value['option']} on {$value['where']}";
        }

        self::$sql .= ' ' . self::$where;

        halt(self::$sql);

        return self::$sql;
    }

    public function __destruct()
    {
        self::$db = null;
    }
}
