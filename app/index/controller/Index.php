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
        $data = [
            'username' => '吴凯',
            'password' => '56789'
        ];

        $res = Db::name('user')->where('id', 1)->value('username');
        // $res = Db::name('user')->where('id', 2)->delete();
        // $res = Db::name('user')->where('id', 1)->update(['username' => 'zyw', 'password' => 'fy123456']);
        // $res = Db::name('user')->where('id', 1)->select();
        halt($res);

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
