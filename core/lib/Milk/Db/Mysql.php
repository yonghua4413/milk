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

    public static function __callStatic($name, $arguments)
    {
        // halt($name);
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
            dir('Connection failed: ' . $e->getMessage());
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

    public function select()
    {
        return self::getData(true);
    }

    public function find()
    {
        return self::getData();
    }

    private static function getData($batch = false)
    {
        $sql = self::getSelectSql();
        self::connection();
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
        self::$sql .= ' ' . self::$where;

        return self::$sql;
    }
}
