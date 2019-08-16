<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 17:03
 */

namespace Main\controllers;


use Main\controllers\others\Exception;

abstract class Common
{
    protected static $_SWOOLE_TYPE = [
        'SWOOLE_PROCESS' => SWOOLE_PROCESS,
        'SWOOLE_BASE' => SWOOLE_BASE
    ];

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

    abstract public function registerEvent($event, $func);

    abstract public function getServer();

    abstract public function run();

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