<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Build extends Ram
{
    public function start()
    {
        $controller = self::getController();
        $url = self::cancelArgs($controller);

        // 获取要执行的方法
        $action = explode('/', $url)[2];

        $className = self::handleClassFile($url);
        self::includeFile(self::handleUserClass($className));
        $classNameFile = self::handleClass($className);
        $obj = new $classNameFile;
        self::funcExist($obj, $action);

        // 开始执行
        $res = call_user_func([$obj, $action]);
        if (is_string($res)) {
            echo $res;
        } elseif (is_array($res)) {
            halt($res);
        }
    }
}
