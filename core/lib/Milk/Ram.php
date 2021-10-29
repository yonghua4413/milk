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
    protected function getUrl()
    {
        // 获得控制器文件
        extract($_SERVER);
        $classNameFile = '';
        if (empty($QUERY_STRING)) {
            $classNameFile = 'index' . DIRECTORY_SEPARATOR . 'index' . DIRECTORY_SEPARATOR . 'index';
        } else {
            $classNameFile = $QUERY_STRING;
        }
        echo '<pre>';
        var_dump($QUERY_STRING);
        // 获取要执行的方法
        $action = explode(DIRECTORY_SEPARATOR, $classNameFile)[2];

        // 处理url index/index/index => index/controller/Index.php
        $str = substr($classNameFile, 0, strrpos($classNameFile, DIRECTORY_SEPARATOR));
        $arr = explode(DIRECTORY_SEPARATOR, $str);
        array_splice($arr, -1, 1, ['controller', ucfirst($arr[1])]);
        $classNameFile = join(DIRECTORY_SEPARATOR, $arr);
        $file = APP_PATH . $classNameFile . PHP_EXT;

        // 引用控制器文件
        if (!file_exists($file)) {
            echo "【{$file}】 file not find.\r\n";
        } else {
            include $file;
        }

        // 获取控制器类
        $classNameFile = 'app\\' . str_replace(array(PHP_EXT, '/'), array('', '\\'), $classNameFile);
        // echo $classNameFile;

        // 判断控制器的是否存在
        $obj = new $classNameFile;
        if (!method_exists($obj, $action)) {
            echo "class " . get_class($obj) . " has not " . $action . " method.\r\n";
        }

        // 开始执行
        $res = call_user_func([$obj, $action]);

        if (is_string($res)) {
            echo $res;
        } elseif (is_array($res)) {
            echo '<pre>';
            var_dump($res);
        }

        // $rest = call_user_func([$obj, self::$action]);
        // if (is_string($rest)) {
        //     echo $rest;
        // } elseif (is_array($rest)) {
        //     print_r($rest);
        // }



    }
}
