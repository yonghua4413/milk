<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Config extends Ram
{
    private static $config = [];

    public static function get($key = '')
    {
        if (empty($key)) {
            return 'not supported all read';
        } else {
            if (strpos($key, '.') === false) {
                $name = $key;
                $configPath = CONFIG_PATH . $key . PHP_EXT;
            } else {
                $key = explode('.', $key);
                $name = $key[0];
            }
            $configPath = CONFIG_PATH . $name . PHP_EXT;
            $config = Ram::includeFile($configPath);
            return is_array($key) ? $config[$key[1]] : $config;
        }
    }
}
