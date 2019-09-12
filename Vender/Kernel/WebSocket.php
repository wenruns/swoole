<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 14:49
 */

namespace Vender\Kernel;


class WebSocket extends BaseServer
{
    public function init($configs)
    {
        if(empty($configs)){
            $configs = config('config', [
                'host' => '0.0.0.0',
                'port' => 9502,
                'swoole_type' => 'SWOOLE_PROCESS',
                'protocol' => 'SWOOLE_SOCK_TCP'
            ]);
        }
        $host = $configs['host'];
        $port = $configs['port'];
        $swoole_type = $configs['swoole_type'];
        $protocol = $configs['protocol'];
        self::$_server = new \Swoole\WebSocket\Server($host, $port, $swoole_type, $protocol);
        if(isset($configs['options'])){
            self::$_server->set($configs['options']);
        }
    }
}