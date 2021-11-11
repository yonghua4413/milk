<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Ram
{
    protected static $module = '';

    protected static $controller = '';

    protected static $action = '';

    protected static function includeFile($file)
    {
        if (!file_exists($file)) {
            throw new Exception("【{$file}】 file not find.\r\n");
        } else {
            return include $file;
        }
    }
}
