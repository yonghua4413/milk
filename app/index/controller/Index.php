<?php

namespace app\index\controller;

use Milk\Controller;
use Milk\Request;

class Index extends Controller
{

    public function index()
    {
        echo 'hello world';
        echo '<br>';
        // halt($_GET);
        halt(Request::param());
    }

    public function test()
    {
        echo '123';
    }
}
