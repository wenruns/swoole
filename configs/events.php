<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 16:19
 */
return [
    'start' => 'onStart',
    'shutdown' => 'onShutdown',
    'WorkerStart' => 'onWorkerStart',
    'WorkerStop' => 'onWorkerStop',
    'WorkerExit' => 'onWorkerExit',
    'Connect' => 'onConnect',
    'Receive' => 'onReceive',
    'Packet' => 'onPacket',
    'Close' => 'onClose',
    'Task' => 'onTask',
    'Finish' => 'onFinish',
    'PipeMessage' => 'onPipeMessage',
    'WorkerError' => 'onWorkerError',
    'ManagerStart' => 'onManagerStart',
    'ManagerStop' => 'onManagerStop',
    'Request' => 'onRequest',
    'handshake' => 'onHandshake',
    'Open' => 'onOpen',
    'Message' => 'onMessage',
    'BufferFull' => 'onBufferFull',
    'BufferEmpty' => 'onBufferEmpty',
];