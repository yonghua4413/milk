<?php

/**
 * This file is part of Milk framework
 *
 * Author: ttitt <378797263@qq.com>
 * 
 * © Milk framework
 */

namespace Milk;

class Build extends Ram
{
    public function start()
    {
        $controller = $this->getController();
        $url = $this->cancelArgs($controller);
        $this->setUrl($url);

        // get action
        $action = explode('/', $url)[2];

        $className = $this->handleClassFile($url);
        Ram::includeFile($this->handleUserClass($className));
        $classNameFile = $this->handleClass($className);
        $obj = new $classNameFile;
        $this->funcExist($obj, $action);

        // start
        $res = call_user_func([$obj, $action]);
        if (is_string($res)) {
            echo $res;
        } elseif (is_array($res)) {
            halt($res);
        }
    }
    private function funcExist($obj, $action)
    {
        if (!method_exists($obj, $action)) {
            echo "class " . get_class($obj) . " has not " . $action . " method.\r\n";
        }
    }

    private function handleClass($classNameFile)
    {
        return 'app\\' . str_replace(array(PHP_EXT, '/'), array('', '\\'), $classNameFile);
    }

    private function handleUserClass($classNameFile)
    {
        return APP_PATH . $classNameFile . PHP_EXT;
    }

    private function handleClassFile($className)
    {
        // handle url index/index/index => index/controller/Test
        $str = substr($className, 0, strrpos($className, '/'));
        $arr = explode('/', $str);
        array_splice($arr, -1, 1, ['controller', ucfirst($arr[1])]);
        $className = join('/', $arr);
        return $className;
    }

    private function cancelArgs($controller)
    {
        $position = strpos($controller, '&');
        if ($position !== false)
            $controller = substr($controller, 0, $position);
        return $controller;
    }

    private function getController()
    {
        extract($_SERVER);
        $classNameFile = '';
        if (empty($QUERY_STRING)) {
            self::$module = Config::get('app.default_module') ?: 'index';
            self::$controller = Config::get('app.default_controller') ?: 'index';
            self::$action = Config::get('app.default_action') ?: 'index';
            $classNameFile = self::$module . '/' . self::$controller . '/' . self::$action;
        } else {
            $classNameFile = $QUERY_STRING;
            $classNameFile = str_replace(['s=//', HTML_EXT], ['', ''], $classNameFile);
        }
        return $classNameFile;
    }

    private function setUrl($url)
    {
        $arr = explode('/', $url);
        self::$module = self::$module ?: $arr[0];
        self::$controller = self::$controller ?: $arr[1];
        self::$action = self::$action ?: $arr[2];
    }
}
