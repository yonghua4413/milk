<?php

namespace app\index\middleware;


class Test
{

    public $a;
    private $b;
    protected $c;

    public function beforeHandle($request)
    {
        echo '我是前置中间件';
        return $request;
    }

    public function afterHandle($request)
    {
        echo '我是后置中间件';
        return $request;
    }
}
