<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 16:04
 */

namespace Vender\Kernel;


class HttpServer extends Common
{

    protected static $_server = null;

    public function init($configs)
    {
        // TODO: Implement init() method.
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
        $swoole_type = self::getSwooleType($configs['swoole_type']);
        $protocol = self::getProtocol($configs['protocol']);
        self::$_server = new \Swoole\Http\Server($host, $port, $swoole_type, $protocol);
        if(isset($configs['options'])){
            self::$_server->set($configs['options']);
        }
    }

    public function registerEvent($event, $func)
    {
        // TODO: Implement registerEvent() method.
        self::$_server->on($event, $func);
    }

    public function getServer()
    {
        // TODO: Implement send() method.
        return self::$_server;
    }

    public function run()
    {
        // TODO: Implement run() method.
        self::$_server->start();
    }

    public function stop()
    {
        // TODO: Implement stop() method.
        self::$_server->shutdown();
    }
}