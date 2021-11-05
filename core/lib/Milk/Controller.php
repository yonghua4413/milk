<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Controller
{

    protected $request = '';

    public function __construct()
    {
        $this->request = $this->request ?: new Request();
    }
}
