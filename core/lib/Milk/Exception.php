<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Exception extends \Exception
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return __CLASS__  . "[{$this->code}]" . ": <p style='color: #f00;font-size: 14px;font-weight: bold;'>{$this->message}</p>";
        // return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
