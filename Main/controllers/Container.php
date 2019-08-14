<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 17:06
 */

namespace Main\controllers;


class Container
{
    protected static $_instances = [];

    protected static $_aliases = [];


    static public function bind($class_name, $instance)
    {
        self::$_instances[$class_name] = $instance;
    }


    static public function getInstance($class_name, $params = [])
    {
        if (isset(self::$_instances[$class_name]) && gettype(self::$_instances[$class_name]) == 'object') {
            return self::$_instances[$class_name];
        }
        return new $class_name(...$params);
    }

    static public function bindAilas($alias_name, $class_name)
    {
        self::$_aliases[$alias_name] = $class_name;
    }

    static public function getInstanceByAlias($alias_name, $params = [])
    {
        if (!isset(self::$_aliases[$alias_name])) {
            throw new \Exception('别名“'.$alias_name.'”没有绑定类名！');
        }
        $class_name = self::$_aliases[$alias_name];
        return self::getInstance($class_name, $params);
    }
}