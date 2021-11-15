<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Middleware
{
    // public static function getProperties($className)
    // {
    //     $class = new \ReflectionClass($className);
    //     $properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PRIVATE);
    //     foreach ($properties as $key => $value) {
    //         $value->setAccessible(true);
    //         halt($value->getName());
    //     }
    // }

    public static function beforeHandle()
    {
        self::register(self::getConfig(), __FUNCTION__);
    }

    public static function afterHandle()
    {
        self::register(self::getConfig(), __FUNCTION__);
    }

    private static function getConfig()
    {
        return Config::get('middleware');
    }

    /**
     * register meddleware
     */
    public static function register($config, $func)
    {
        foreach ($config as $key => $value) {
            if (!method_exists($value, $func)) {
                throw new Exception("class {$value} has not " . $func . " method \r\n");
            }
            call_user_func([new $value, $func], new Request());
        }
    }
}
