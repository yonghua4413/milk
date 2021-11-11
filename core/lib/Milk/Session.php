<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Session
{
    public static $session;

    public function __construct()
    {
        if (empty(self::$session)) {
            session_start();
        }
    }

    public static function get($key)
    {
        return self::$session[$key];
    }

    public static function set($key, $val)
    {
        return self::$session[$key][$val];
    }

    public static function del($key)
    {
        unset(self::$session[$key]);
    }
}
