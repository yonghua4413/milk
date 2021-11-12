<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk\Session;

abstract class Drive
{

    protected static $config;

    protected static $dns;

    /**
     * Database drive bind
     */
    public static function bind(...$args)
    {
        // $dbClass = __NAMESPACE__ . '\\' . ucwords($type);
        // $method = $args[0];
        // // halt($args[1][0]);
        // $args = isset($args[1][0]) ? $args[1][0] : '';
        // return $dbClass::$method($args);
    }
}
