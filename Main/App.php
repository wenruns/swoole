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
    protected $_swoole_class = null;
    public function __construct()
    {
        require_once __DIR__.DIRECTORY_SEPARATOR.'autoload'.DIRECTORY_SEPARATOR.'Autoload.php';
        $this->_swoole_class = '\Main\Websocket';
    }

    public function setSwoole($swoole_class)
    {
        $this->_swoole_class = $swoole_class;
    }

    public function run()
    {
        return new $this->_swoole_class();
    }
}

return new App();