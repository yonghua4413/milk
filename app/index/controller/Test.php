<?php

namespace app\index\controller;

use Milk\Controller;
use Milk\Request;
use Milk\Session;

class Test extends Base
{

    public function index()
    {
        $res = Session::get('name');
        halt($res);
        // halt(Request::param());
        // self::arr();
    }
}
