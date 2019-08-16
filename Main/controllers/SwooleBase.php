<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 15:55
 */

namespace Main\controllers;


class SwooleBase
{
    protected static $_container = null;

    protected static $_events = [];

    function __construct()
    {
        self::$_container = new Container();
        $configs = config('config');

        switch (strtolower($configs['server_type'])) {
            case 'websocket':
                self::$_container->bind('websocket', new WebSocket());
                self::$_container->bindAilas('server', 'websocket');
                break;
            case 'http_server':
                self::$_container->bind('http_server', new HttpServer());
                self::$_container->bindAilas('server', 'http_server');
                break;
            case 'redis_server':
                self::$_container->bind('redis_server', new RedisServer());
                self::$_container->bindAilas('server', 'redis_server');
                break;
            default:
                self::$_container->bind('server', new Server());
                self::$_container->bindAilas('server', 'server');
        }
        $this->registerEvents();
    }

    public function registerEvents()
    {
        $server = self::$_container->getInstanceByAlias('server');
        self::$_events = config('events');
        foreach (self::$_events as $event => $func) {
            if(method_exists($this, $func)){
                $server->registerEvent($event, array($this, $func));
            }
        }
        $this->run();
    }

    public function run()
    {
        self::$_container->getInstanceByAlias('server')->run();
    }

    public function getServer()
    {
        return self::$_container->getInstanceByAlias('server')->getServer();
    }
}
