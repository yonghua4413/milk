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
        echo $classNameFile;
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
            echo '我是存在的';
            include $file;
        }

        // 获取控制器类
        $classNameFile = 'app\\' . str_replace(array(PHP_EXT, '/'), array('', '\\'), $classNameFile);
        echo $classNameFile;
    }
}
