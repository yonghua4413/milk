<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class File
{
    public static function createdir($dir)
    {
        return is_dir($dir) or self::createdir(dirname($dir)) and mkdir($dir, 0777);
    }
}
