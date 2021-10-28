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
        extract($_SERVER);
        $classNameFile = '';
        if (empty($QUERY_STRING)) {
            $classNameFile = 'index/index/index';
        } else {
            $classNameFile = $QUERY_STRING;
        }

        echo $classNameFile;
        $arr = explode('/', $classNameFile);
        array_pop($arr);
        echo '<pre>';
        var_dump($arr);


        // $s = self::getUrl();
        // $uArr = explode('/', $s);
        // array_pop($uArr);
        // array_push($uArr, ucfirst(array_pop($uArr)));
        // return implode('/', $uArr);
    }
}
