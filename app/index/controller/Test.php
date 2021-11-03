<?php

namespace app\index\controller;

use Milk\Controller;
use Milk\Request;

class Test extends Base
{

    public function index()
    {
        halt(Request::param());
        self::arr();
    }
}
