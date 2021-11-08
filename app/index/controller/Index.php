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

        Db::name('dbtest')->where('id', 3);

        // halt($this->request->param())
        // halt($this->request->param());
        // Db::name('table')->where('id', 3)->select();
        // halt($_GET);
        // halt(Request::param());

    }

    public function view()
    {
        $html = 'Milk是一个免费开源的，快速、简单的面向对象的轻量级PHP开发框架';
        $arr = [
            'id' => 1,
            'name' => '张三'
        ];
        View::assign('info', $html);
        View::assign('arr', $arr);
        View::fetch();
    }
}
