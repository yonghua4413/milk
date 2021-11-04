<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class App
{
    /**
     * autoload
     */
    public function autoload($class)
    {
        $path = __DIR__;
        // Framework class or User class
        if (strpos($class, __NAMESPACE__) === false) {
            $path = ROOT_PATH;
        }
        // Splicing path
        $className = $path . DIRECTORY_SEPARATOR . $class . PHP_EXT;
        // Handle path
        $className = str_replace(['\\', 'app', '//'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR . 'app', ''], $className);
        if (!file_exists($className)) {
            echo "\"{$className}\" class not found. \r\n";
        }

        include $className;
    }

    /**
     * framework start
     */
    public function start()
    {
        spl_autoload_register([$this, 'autoload']);
        $build = new Build();
        $build->start();
        spl_autoload_unregister([$this, 'autoload']);
    }
}
