<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

use Milk\Db\Drive;

class Db
{
    private static $config = [];

    public static function __callStatic($name, $arguments)
    {
        return self::register($name, $arguments);
    }

    private static function register(...$args)
    {
        return Drive::bind($args);
    }
}
