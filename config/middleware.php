<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

return [
    // 注册全局中间件
    'all' => [
        'app\index\middleware\Test'
    ],
    // 注册路由中间件
    'route' => [
        'app\index\index\index' => 'app\index\middleware\Test2'
    ]
];
