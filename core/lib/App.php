<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

use InflateContext;

class App
{
    /**
     * @desc 自动加载
     */
    public function autoload($className)
    {
        $path = __DIR__;
        // 判断是框架类还是用户类
        if (strpos($className, __NAMESPACE__) === false) {
            $path = APP_PATH;
        }
        // 拼接路径
        $className = $path . DIRECTORY_SEPARATOR . $className . PHP_EXT;
        // 处理路径
        $className = str_replace(['\\', 'app' . DIRECTORY_SEPARATOR, '//'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, ''], $className);
        if (!file_exists($className)) {
            echo "\"{$className}\" class not found. \r\n";
        }
        echo $className . '<br>';
        include $className;
    }

    /**
     * @desc 框架启动
     */
    public function start()
    {
        spl_autoload_register([$this, 'autoload']);
        $build = new Build();
        $build->start();
        spl_autoload_unregister([$this, 'autoload']);
    }
}
