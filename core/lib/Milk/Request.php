<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Request
{

    public static function param()
    {
        echo $_SERVER['REQUEST_URI'];
    }

    /**
     * 判断是否是GET请求
     * @return bool
     */
    public static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    /**
     * 判断是否是POST请求
     * @return bool
     */
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * 过滤请求参数
     * @param $data
     * @return mixed|string
     */
    public static function filter($data)
    {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$k] = htmlspecialchars(str_replace('//', '', trim($v)));
            }
        } else {
            $data = htmlspecialchars(str_replace('//', '', trim($data)));
        }
        return $data;
    }

    // public static function get($key = '')
    // {
    //     if (strpos(basename($_SERVER['REQUEST_URI']), '?s=') === false) {
    //         if (isset($_GET['s'])) {
    //             unset($_GET['s']);
    //         }
    //     }
    //     if (isset($_SERVER['SCRIPT_URL'])) {
    //         $url = str_replace('.', '_', $_SERVER['SCRIPT_URL']);
    //         if (isset($_GET[$url])) {
    //             unset($_GET[$url]);
    //         }
    //     }
    //     return $key == '' ? self::filter($_GET) : self::filter($_GET[$key]);
    // }

    // /**
    //  * 获取post请求参数
    //  * @param string $key
    //  * @return mixed|string
    //  */
    // public static function post($key = '')
    // {
    //     return $key == '' ? self::filter($_POST) : self::filter($_POST[$key]);
    // }

    /**
     * 获取get请求参数
     * @param string $key
     * @return mixed|string
     */
    // public static function get($key = '')
    // {
    //     if (strpos(basename($_SERVER['REQUEST_URI']), '?s=') === false) {
    //         if (isset($_GET['s'])) {
    //             unset($_GET['s']);
    //         }
    //     }
    //     if (isset($_SERVER['SCRIPT_URL'])) {
    //         $url = str_replace('.', '_', $_SERVER['SCRIPT_URL']);
    //         if (isset($_GET[$url])) {
    //             unset($_GET[$url]);
    //         }
    //     }
    //     return $key == '' ? self::filter($_GET) : self::filter($_GET[$key]);
    // }
}
