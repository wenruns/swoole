<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 16:51
 */

namespace Vender;

class App
{
    protected $_swoole_class = null;
    // 用户自定义配置
    protected $_options = [];
    public function __construct()
    {
        require_once __DIR__ .DIRECTORY_SEPARATOR.'Autoload.php';

        $this->_swoole_class = '\Vender\Websocket';
    }

    public function setServer($server_class)
    {
        $this->_swoole_class = $server_class;
    }

    public function setConfigs($options)
    {
        $this->_options = $options;
    }

    public function run()
    {
        return new $this->_swoole_class($this->_options);
    }
}

return new App();