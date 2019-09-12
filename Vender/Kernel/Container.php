<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 17:06
 */

namespace Vender\Kernel;


class Container
{
    protected static $_instances = [];

    protected static $_aliases = [];


    /**
     * 绑定实例
     * @param $class_name
     * @param $instance
     */
    public function bind($class_name, $instance)
    {
        self::$_instances[$class_name] = $instance;
    }

    /**
     * 获取实例
     * @param $class_name
     * @param array $params
     * @return mixed
     */
    public function getInstance($class_name, $params = [])
    {
        if (!isset(self::$_instances[$class_name]) || gettype(self::$_instances[$class_name]) != 'object') {
            self::$_instances[$class_name] = new $class_name(...$params);
        }
        return self::$_instances[$class_name];
    }

    /**
     * 绑定别名
     * @param $alias_name
     * @param $class_name
     */
    public function bindAilas($alias_name, $class_name)
    {
        self::$_aliases[$alias_name] = $class_name;
    }

    /**
     * 通过别名获取实例
     * @param $alias_name
     * @param array $params
     * @return bool|mixed
     */
    public function getInstanceByAlias($alias_name, $params = [])
    {
        if (!isset(self::$_aliases[$alias_name])) {
            return false;
        }
        $class_name = self::$_aliases[$alias_name];
        return self::getInstance($class_name, $params);
    }

}