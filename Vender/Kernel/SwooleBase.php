<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 15:55
 */

namespace Vender\Kernel;


use Vender\Exceptions\Exception;
use Vender\Exceptions\MakeException;

class SwooleBase
{
    protected static $_container = null; // 容器

    protected static $_events = []; // 事件

    protected static $_configs = [];

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

    /**
     * 时间注册
     * @throws \Exception
     */
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

    /**
     * 获取服务实例对象
     * @return mixed
     */
    public static function getServer()
    {
        return self::$_container->getInstanceByAlias('server')->getServer();
    }

    /**
     * 启动服务器
     */
    public function run()
    {
        self::getServer()->start();
    }

    /**
     * 重启服务器
     * @throws \Exception
     */
    public static function reload()
    {
        $only_reload_taskworkrer = config('app.only_reload_taskworkrer');
        if(!$only_reload_taskworkrer){
            $only_reload_taskworkrer = config('config.only_reload_taskworkrer');
        }
        self::getServer()->reload($only_reload_taskworkrer);
    }

    /**
     * 关闭worker进程
     * 此方法在1.8.2 版本以上可用， 参数$waitEvent在版本 1.9.19 以上可用
     */
    public static function stop($worker_id = -1, $waitEvent = false)
    {
        self::getServer()->stop($worker_id, $waitEvent);
    }


    /**
     * 关闭服务器
     */
    public static function shutdown()
    {
        self::getServer()->shutdown();
    }


//    /**
//     * 新增监听端口,
//     * @param string $host
//     * @param int $port
//     * @param $type
//     * @return mixed
//     */
//    public function addListener(string $host, int $port, $type = SWOOLE_SOCK_TCP)
//    {
//        return self::getServer()->addListener($host, $port, $type);
//    }
//
//    /**
//     * 添加一个用户自定义的工作进程， 1.7.9 版本以上可用
//     * @param \Swoole\Process $process
//     */
//    public function addProcess(\Swoole\Process $process)
//    {
//        return self::getServer()->addProcess($process);
//    }
//
//    /**
//     * addListener的别名
//     * @param string $host
//     * @param int $port
//     * @param $type
//     * @return mixed
//     */
//    public function listen(string $host, int $port, $type)
//    {
//        return self::getServer()->listen($host, $port, $type);
//    }
//
//


    /**
     * 通过容器获取实例对象
     * @param $alias_name
     * @param array $options
     * @return bool|mixed
     * @throws \Exception
     */
    public static function make($alias_name, $options = [])
    {
        self::checkAlias();

        $instance = self::$_container->getInstanceByAlias($alias_name, $options);
        if($instance){
            return $instance;
        }

        $instance = self::$_container->getInstance($alias_name, $options);
        if($instance){
            return $instance;
        }

        new MakeException('Can`t found the controller: '.$alias_name);
    }

    /**
     * 检测别名
     * @throws \Exception
     */
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
