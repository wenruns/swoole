<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:30
 */

return [
    'host' => '0.0.0.0',
    'port' => 9502,
    'swoole_type' => 'SWOOLE_BASE',
    'protocol' => 'SWOOLE_SOCK_TCP',
    'server_type' => 'websocket',
    'options' => [
        'worker_num' => 4,    //worker process num
        'backlog' => 128,   //listen backlog
        'max_request' => 50,
//        'dispatch_mode'=>1,
    ]
];