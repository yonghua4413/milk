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

abstract class Drive
{

    protected static $config;

    protected static $dns;

    /**
     * Database drive bind
     */
    public static function bind($args)
    {
        $type = Config::get('database.type') ?: 'mysql';
        $dbClass = __NAMESPACE__ . '\\' . ucwords($type);
        $method = $args[0];
        return $dbClass::$method($args[1][0]);
    }

    protected static function setConfig()
    {
        if (is_null(self::$config)) {
            self::$config = Config::get('database');
            extract(self::$config);
            self::$dns = $type . ':host=' . $hostname . ';port=' . $hostport . ';dbname=' . $database . ';charset=' . $charset;
        }
    }
}
