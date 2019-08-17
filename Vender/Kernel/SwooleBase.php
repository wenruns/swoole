<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 15:55
 */

namespace Vender\Kernel;


use Vender\Exceptions\Exception;

class SwooleBase
{
    protected static $_container = null;

    protected static $_events = [];

    function __construct($options = [])
    {
        self::$_container = new Container();
        $server_type = isset($options['server_type']) ? $options['server_type'] : config('config.server_type');

        switch (strtolower($server_type)) {
            case 'websocket':
                self::$_container->bind('websocket', new WebSocket($options));
                self::$_container->bindAilas('server', 'websocket');
                break;
            case 'http_server':
                self::$_container->bind('http_server', new HttpServer($options));
                self::$_container->bindAilas('server', 'http_server');
                break;
            case 'redis_server':
                self::$_container->bind('redis_server', new RedisServer($options));
                self::$_container->bindAilas('server', 'redis_server');
                break;
            default:
                self::$_container->bind('server', new Server($options));
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


    public static function stop(){
        self::$_container->getInstanceByAlias('server')->stop();
    }

    public static function make($alias_name)
    {
        self::checkAlias();
        return self::$_container->getInstanceByAlias($alias_name);
    }

    public static function checkAlias()
    {
        $maps = config('interface_class_map');
        foreach ($maps as $alias_name => $class_name) {
            if ($alias_name == 'server') {
               new Exception('server作为内核别名已被注册，请不要使用！');
            }
            self::$_container->bindAilas($alias_name, $class_name);
        }
    }

}
