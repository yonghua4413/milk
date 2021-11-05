<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class View extends Ram
{
    private static $arrayConfig = array(
        'suffix'        => HTML_EXT,                 // 模板的后缀
        'templateDir'   => '',                          // 模板所在的文件夹
        'compileDir'    => RUNTIME_PATH,                   // 编译后存放的目录
        'cache_html'    => false,                       // 是否需要编译成静态的html文件
        'cache_time'    => 0,                           // 设置多长时间自动更新
        'php_turn'      => true,                        // 设置是否支持php原生代码
        'debug'         => false,
    );

    public static $fileHtml = '';

    public static function fetch($filehtml = '')
    {
        static::$fileHtml = empty($filehtml) ? self::$action : $filehtml;

        if (!is_dir(RUNTIME_PATH)) {
            File::createdir(RUNTIME_PATH);
        }

        if (!is_writable(RUNTIME_PATH)) {
            echo RUNTIME_PATH . 'is not permession \r\n';
        }
    }
}
