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
        echo '<br>';
        echo '123';
        echo '<br>';
        // halt(Request::param());
        // self::arr();
    }
    public function index2()
    {
        echo '<br>';
        echo '2';
        echo '<br>';
        // halt(Request::param());
        // self::arr();
    }
}
