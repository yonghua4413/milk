<?php

namespace app\index\controller;

use Milk\Controller;
use Milk\Db;
use Milk\View;

class Index extends Controller
{

    public function index()
    {
        echo 'hello world';
        echo '<br>';
        
        View::fetch();
        // halt($this->request->param())
        // halt($this->request->param());
        // Db::name('table')->where('id', 3)->select();
        // halt($_GET);
        // halt(Request::param());

    }

    public function test()
    {
        echo '123';
    }
}
