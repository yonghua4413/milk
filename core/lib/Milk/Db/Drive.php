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

    public static function bind($args)
    {
        $type = Config::get('database.type') ?: 'mysql';
        $dbClass = __NAMESPACE__ . '\\' . ucwords($type);
        $method = $args[0];
        return $dbClass::$method($args[1][0]);
    }
    // /**
    //  * 数据库驱动绑定
    //  * @param $args
    //  * @return mixed
    //  * @throws \yogurt\Exception
    //  */
    // public static function bind($args)
    // {
    //     $type = empty(Config::get('database.type')) ? 'mysql' : Config::get('database.type');
    //     $className = 'yogurt\\db\\driver\\' . ucwords($type);
    //     $method = $args[0];
    //     return $className::$method($args[1][0] ?? $args[1]);
    // }
}
