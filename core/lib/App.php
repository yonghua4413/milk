<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace milk;

class App extends Ram
{

    public function autoload($className)
    {
        echo $className;
    }

    public function start()
    {
        spl_autoload_register([$this, 'autoload']);
        echo 'app in come';
        // self::getUrl();
        spl_autoload_unregister([$this, 'autoload']);
    }
}
