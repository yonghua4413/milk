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

    protected function funcExist($obj, $action)
    {
        if (!method_exists($obj, $action)) {
            echo "class " . get_class($obj) . " has not " . $action . " method.\r\n";
        }
    }

    protected function handleClass($classNameFile)
    {
        // 获取控制器类
        return 'app\\' . str_replace(array(PHP_EXT, '/'), array('', '\\'), $classNameFile);
    }

    protected function handleUserClass($classNameFile)
    {
        return APP_PATH . $classNameFile . PHP_EXT;
    }

    protected function includeFile($file)
    {
        // 引用控制器文件
        if (!file_exists($file)) {
            echo "【{$file}】 file not find.\r\n";
        } else {
            include $file;
        }
    }

    protected function handleClassFile($className)
    {
        // 处理url index/index/index => index/controller/Test
        $str = substr($className, 0, strrpos($className, '/'));
        $arr = explode('/', $str);
        array_splice($arr, -1, 1, ['controller', ucfirst($arr[1])]);
        $className = join('/', $arr);
        return $className;
    }

    protected function cancelArgs($controller)
    {
        $position = strpos($controller, '&');
        if ($position !== false)
            $controller = substr($controller, 0, $position);
        return $controller;
    }

    protected function getController()
    {
        // 获得控制器文件
        extract($_SERVER);
        $classNameFile = '';
        if (empty($QUERY_STRING)) {
            $classNameFile = 'index' . DIRECTORY_SEPARATOR . 'index' . DIRECTORY_SEPARATOR . 'index';
        } else {
            $classNameFile = $QUERY_STRING;
            $classNameFile = str_replace(['s=//', HTML_EXT], ['', ''], $classNameFile);
        }
        return $classNameFile;
    }
}
