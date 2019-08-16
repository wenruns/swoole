<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 16:51
 */

namespace Main;

class App
{
    public function __construct()
    {
        require_once __DIR__.DIRECTORY_SEPARATOR.'autoload'.DIRECTORY_SEPARATOR.'Autoload.php';
    }

    public function setSwoole()
    {

    }

    public function run()
    {
        return new Swoole();
    }
}