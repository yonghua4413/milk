<?php

namespace app\index\middleware;


class Test2
{

    public $a;
    private $b;
    protected $c;

    public function beforeHandle($request)
    {
        echo '我是路由前置中间件';
        return $request;
    }

    public function afterHandle($request)
    {
        echo '我是路由后置中间件';
        return $request;
    }
}
