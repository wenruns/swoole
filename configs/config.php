<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:30
 */

return [
    'env' => 'local', // 环境
    'host' => '0.0.0.0', // 服务器主机
    'port' => 9502,  // 服务器端口
    'swoole_type' => 'SWOOLE_BASE', // 服务器类型 SWOOLE_BASE | SWOOLE_PROCESS
    'protocol' => 'SWOOLE_SOCK_TCP', // 服务器协议 SWOOLE_SOCK_TCP | SWOOLE_SOCK_UDP | SWOOLE_SOCK_TCP6 | SWOOLE_SOCK_UDP6| UnixSocket Stream | Dgram
    'server_type' => 'websocket', // 服务器类型  websocket | http_server | redis_server | default
    'server_controller' => \Vender\Websocket::class, // 服务器控制器
    'only_reload_taskworkrer' => false,  //
    'options' => [
        'backlog' => 128,   //listen backlog
        'worker_num' => 4, //指定启动的worker进程数。
        'max_request' => 10000, // 每个worker进程允许处理的最大任务数。
//        'max_conn' => 10000, //服务器允许维持的最大TCP连接数
//        'dispatch_mode' => 2, // 设置进程间的通信方式。(1:使用unix socket通信;2: 使用消息队列通信;3:使用消息队列通信，并设置为争抢模式)
//        'debug_mode'=> 3, // 指定数据包分发策略。(1:轮循模式，收到会轮循分配给每一个worker进程;2:固定模式，根据连接的文件描述符分配worker。这样可以保证同一个连接发来的数据只会被同一个worker处理;3: 抢占模式，主进程会根据Worker的忙闲状态选择投递，只会投递给处于闲置状态的Worker)
//        'daemonize' => false, // 设置程序进入后台作为守护进程运行。
//        'log_file' => __DIR__.'/swoole_log.log', //指定日志文件路径
//        'heartbeat_check_interval' => 60, //设置心跳检测间隔
//        'heartbeat_idle_time' => 1200, //设置某个连接允许的最大闲置时间。
    ]
];

