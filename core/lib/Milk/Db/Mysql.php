<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk\Db;

class Mysql
{
    public static function __callStatic($name, $arguments)
    {
        halt($name);
    }
}
