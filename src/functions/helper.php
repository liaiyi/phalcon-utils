<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/11/9 Time: 14:39
// +----------------------------------------------------------------------
use Phalcon\Di\FactoryDefault as DI;

if (!function_exists('di')) {
    /**
     * [di desc]
     * @desc 获取容器对象
     * @author limx
     * @param $name 容器服务名
     * @return mixed
     */
    function di($name = null)
    {
        $di = DI::getDefault();
        if ($name == null) return $di;
        return $di[$name];
    }
}

if (!function_exists('session')) {

    /**
     * [session desc]
     * @desc 获取注册后的session服务
     * @author limx
     * @param null $key
     * @param null $value
     * @return null
     */
    function session($key = null, $value = null)
    {
        $session = di('session');

        if (is_null($key)) {
            return null;
        }
        if (is_null($value)) {
            return $session->get($key);
        }
        return $session->set($key, $value);
    }
}

if (!file_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        return $value;
    }
}