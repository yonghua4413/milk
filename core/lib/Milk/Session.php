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

    protected static $init = null;

    public static function boot()
    {
        if (is_null(self::$init)) {
            session_start();
            self::$init = true;
        }
    }

    /**
     * set session
     * @param string $key
     * @param mixed  $val
     */
    public static function set($key, $val)
    {
        self::$init ?? self::boot();
        $_SESSION[$key] = $val;
    }

    /**
     * get session
     * @param string $key
     * @return mixed
     */
    public static function get($key = '')
    {
        self::$init ?? self::boot();
        return $key == '' ? $_SESSION : $_SESSION[$key] ?? null;
    }

    /**
     * delete session
     * @param string $key
     */
    public static function delete($key)
    {
        self::$init ?? self::boot();
        unset($_SESSION[$key]);
    }

    /**
     * clear session
     */
    public static function clear()
    {
        self::$init ?? self::boot();
        $_SESSION = [];
    }

    /**
     * destroy session
     */
    public static function destroy()
    {
        if (!empty($_SESSION)) $_SESSION = [];
        session_unset();
        session_destroy();
        self::$init = null;
    }
}
