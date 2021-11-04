<?php

namespace app\index\controller;

use Milk\Controller;
use Milk\Request;
use Milk\Db;

class Index extends Controller
{

    public function index()
    {
        echo 'hello world';
        echo '<br>';
        // Db::name('table')->where('id', 3)->select();
        // halt($_GET);
        // halt(Request::param());

    }

    public function test()
    {
        echo '123';
    }
}
