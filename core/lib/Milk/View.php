<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class View extends Compile
{
    public static $fileHtml = '';

    public static function display($filehtml = '')
    {
        static::$fileHtml = empty($filehtml) ? Request::getAction() : $filehtml;

        if (!is_dir(RUNTIME_PATH)) {
            File::createdir(RUNTIME_PATH);
        }

        if (!is_writable(RUNTIME_PATH)) {
            throw new Exception(RUNTIME_PATH . ' is not permession \r\n');
        }
        self::$template = static::getViewPath();
        if (!file_exists(self::$template)) {
            throw new Exception(self::$template . ' template file not found.\r\n');
        }

        self::$runtime = RUNTIME_PATH . md5(self::$template) . '.php';
        self::build();
        include self::$runtime;
    }

    public static function assign(...$args)
    {
        if (count($args) < 2) echo 'function assign at least two parameter';
        self::$value[$args[0]] = $args[1];
    }

    private static function getViewPath()
    {
        return APP_PATH . Request::getModule() . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . Request::getController() . DIRECTORY_SEPARATOR . Request::getAction() . '.' . Config::get('app.default_template_ext');
    }
}
