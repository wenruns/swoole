<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 17:03
 */

namespace Vender\Kernel;


use Vender\Exceptions\Exception;

abstract class BaseServer
{
    // 配置信息
    protected static $configs = [];

    // 服务实例对象
    protected static $_server = null;

    // swoole类型
    protected static $_SWOOLE_TYPE = [
        'SWOOLE_PROCESS' => SWOOLE_PROCESS,
        'SWOOLE_BASE' => SWOOLE_BASE
    ];

    // 协议集合
    protected static $_PROTOCOL = [
        'SWOOLE_SOCK_TCP' => SWOOLE_SOCK_TCP,
        'SWOOLE_SOCK_TCP6' => SWOOLE_SOCK_TCP6,
        'SWOOLE_SOCK_UDP' => SWOOLE_SOCK_UDP,
        'SWOOLE_SOCK_UDP6' => SWOOLE_SOCK_UDP6,
        'SWOOLE_SOCK_UNIX_DGRAM' => SWOOLE_SOCK_UNIX_DGRAM,
        'SWOOLE_SOCK_UNIX_STREAM' => SWOOLE_SOCK_UNIX_STREAM,
        'SWOOLE_SOCK_SYNC' => SWOOLE_SOCK_SYNC,
        'SWOOLE_SOCK_ASYNC' => SWOOLE_SOCK_ASYNC,
    ];

    public function __construct($configs = [])
    {
        self::$configs = config('config', [
            'host' => '0.0.0.0',
            'port' => 9502,
            'swoole_type' => 'SWOOLE_PROCESS',
            'protocol' => 'SWOOLE_SOCK_TCP',
        ]);
        self::$configs = array_merge(self::$configs, $configs);
        self::$configs['swoole_type'] = self::getSwooleType(self::$configs['swoole_type']);
        self::$configs['protocol'] = self::getProtocol(self::$configs['protocol']);
        $this->init(self::$configs);
    }

    /**
     * 初始化服务
     * @param $configs
     * @return mixed
     */
    abstract public function init($configs);


    /**
     * 注册事件
     * @param $event
     * @param $func
     */
    public function registerEvent($event, $func)
    {
        self::$_server->on($event, $func);
    }

    /**
     * 获取服务实例
     * @return null
     */
    public function getServer()
    {
        return self::$_server;
    }


    /**
     * 获取swoole类型
     * @param string $swoole_type
     * @return array|mixed
     * @throws \Exception
     */
    static public function getSwooleType($swoole_type = '')
    {
        if($swoole_type){
            if(self::$_SWOOLE_TYPE[$swoole_type]){
                return self::$_SWOOLE_TYPE[$swoole_type];
            }else{
                new Exception('不存在的swoole_type：'.$swoole_type);
            }
        }else{
            return self::$_SWOOLE_TYPE;
        }
    }

    /**
     * 获取协议
     * @param string $protocol
     * @return array|mixed
     * @throws \Exception
     */
    static public function getProtocol($protocol = '')
    {
        if($protocol){
            if(isset(self::$_PROTOCOL[$protocol])){
                return self::$_PROTOCOL[$protocol];
            }else{
                new Exception('不存在的protocol：'.$protocol);
            }
        }else{
            return self::$_PROTOCOL;
        }
    }
}