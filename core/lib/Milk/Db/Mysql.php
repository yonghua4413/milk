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

class Mysql
{
    private static $instance;
    private static $tableName;
    private static $prefix;
    private static $where;

    public static function __callStatic($name, $arguments)
    {
        // halt($name);
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
    }
}
