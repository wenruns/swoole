<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:58
 */
//namespace Main;
use Main\controllers\Container;

class Swoole
{
    protected static $_container = null;

    function __construct()
    {
        require_once __DIR__.DIRECTORY_SEPARATOR.'autoload'.DIRECTORY_SEPARATOR.'Autoload.php';
        self::$_container = new Container();
    }


    public function start()
    {

    }
}