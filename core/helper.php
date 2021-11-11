<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

register_shutdown_function(function () {
    if (error_get_last()['message'] == null)
        return;
    extract(error_get_last());
    $file = substr($file, strrpos($file, '/') + 1);
    $html = "[{$type}] Error in $file line {$line} <br> <h2>{$message}</h2>";
    echo $html;
    // throw new Exception($html);
    // throw new Milk\Exception($html);
});

set_error_handler(function ($severity, $message, $filename, $lineno) {
    $error = [
        'type' => $severity,
        'message' => $message,
        'file' => $filename,
        'line' => $lineno
    ];
    // $error = "[{$severity}] Error in $filename line {$lineno} <br> <h2>{$message}</h2>";
    halt($error);
    // throw new Milk\Exception($error);
});

if (!function_exists('halt')) {
    function halt($var)
    {
        echo '<pre>';
        var_dump($var);
        exit();
    }
}
