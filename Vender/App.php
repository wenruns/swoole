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
    // 用户自定义配置
    protected $_options = [];
    public function __construct()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Autoload.php';
        $this->_options = array_merge(config('config'), empty(config('app')) ? [] : config('app'));
    }

    public function run()
    {
        $server_controller = config('app.server_controller');
        if(!$server_controller){
            $server_controller = config('config.server_controller');
        }
        return new $server_controller($this->_options);
    }
}

return new App();