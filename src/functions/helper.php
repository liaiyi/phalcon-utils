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
use limx\phalcon\Logger;

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
     * 控制器，视图或者任何继承于 Phalcon\Di\Injectable 的组件，都可以访问session服务
     * 故可以通过以下方式调用session
     * 设置一个session变量    $this->session->set("user-name", "Michael");
     * 检查session变量是否已定义    $this->session->has("user-name")；
     * 获取session变量的值    $this->session->get("user-name");
     * 删除session变量    $this->session->remove("user-name");
     * 销毁全部session会话    $this->session->destroy();
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

if (!function_exists('url')) {
    /**
     * [url desc]
     * @desc 生成访问地址
     * @author limx
     * @param $url 地址
     * @param array $params 参数
     */
    function url($action, $params = [])
    {
        return di('url')->get($action, $params);
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

if (!function_exists('cache')) {

    /**
     * [cache desc]
     * @desc
     * @author limx
     * @param null $key 缓存KEY
     * @param null $value 缓存值 array|string
     * @return null
     */
    function cache($key = null, $value = null)
    {
        $cache = di('cache');

        if (is_null($key)) {
            return null;
        }
        if (is_null($value)) {
            return $cache->get($key);
        }
        return $cache->save($key, $value);
    }
}

if (!function_exists('logger')) {

    /**
     * [logger desc]
     * @desc 写入日志助手函数
     * @author limx
     * @param $info
     * @param string $type
     */
    function logger($info, $type = 'info', $file = 'logger.log')
    {
        $logger = Logger::getInstance('file', $file);
        $logger->$type($info);
    }
}