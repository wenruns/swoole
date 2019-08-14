<?php
////创建Server对象，监听 127.0.0.1:9501端口
//$serv = new swoole_server("0.0.0.0", 9501, SWOOLE_BASE, SWOOLE_SOCK_TCP);
//$serv->set(array(
//    'worker_num' => 8, //指定启动的worker进程数。
//    'max_request' => 10000, // 每个worker进程允许处理的最大任务数。
//    'max_conn' => 10000, //服务器允许维持的最大TCP连接数
//    'dispatch_mode' => 2, // 设置进程间的通信方式。(1:使用unix socket通信;2: 使用消息队列通信;3:使用消息队列通信，并设置为争抢模式)
//    'debug_mode'=> 3, // 指定数据包分发策略。(1:轮循模式，收到会轮循分配给每一个worker进程;2:固定模式，根据连接的文件描述符分配worker。这样可以保证同一个连接发来的数据只会被同一个worker处理;3: 抢占模式，主进程会根据Worker的忙闲状态选择投递，只会投递给处于闲置状态的Worker)
//    'daemonize' => false, // 设置程序进入后台作为守护进程运行。
//    'log_file' => __DIR__.'/swoole_log.log', //指定日志文件路径
//    'heartbeat_check_interval' => 60, //设置心跳检测间隔
//    'heartbeat_idle_time' => 1200, //设置某个连接允许的最大闲置时间。
//));
//
//
//$serv->on('Start', function ($serv){
////    var_dump($serv);
//    echo "start...\r\n";
//});
//
////$serv->on('WorkerStart', function ($serv){
////    echo "workstart \r\n";
//////    var_dump($serv);
////});
//
////监听连接进入事件
//$serv->on('Connect', function ($serv, $fd) {
//    echo "Client: Connect.\n";
//});
//
////监听数据接收事件
//$serv->on('Receive', function ($serv, $fd, $from_id, $data) {
//    $serv->send($fd, "Server: ".$data);
//});
//
////监听连接关闭事件
//$serv->on('Close', function ($serv, $fd) {
//    echo "Client: Close.\n";
//});
//
////启动服务器
//$serv->start();
//
$server = new Swoole\WebSocket\Server("0.0.0.0", 9502);


$server->set(array(
    'worker_num' => 4,
    'daemonize' => false,
    'backlog' => 128,
));

$server->on('Start', function ($serv){
    echo "start...\r\n";
});

$server->on('Shutdown', function ($serv){
    echo "shutdown....\r\n";
});
$server->on('WorkerStart', function ($serv){
    echo "workerstart...\r\n";
});
$server->on('WorkerStop', function ($serv){
   echo "WorkerStop...\r\n";
});
$server->on('WorkerExit', function ($serv){
    echo "WorkerExit\r\n";
});
$server->on('WorkerError', function ($serv){
    echo "WorkerError...\r\n";
});

$server->on('Task', function ($serv){
    echo "Task...\r\n";
});
$server->on('Finish', function ($serv){
    echo "Finish...\r\n";
});

$server->on('ManagerStart', function ($serv){
    echo "ManagerStart...\r\n";
});

$server->on('ManagerStop', function ($serv){
    echo "ManagerStop...\r\n";
});
$server->on('PipeMessage', function ($serv){
    echo "PipeMessage...\r\n";
});

$server->on('Connect', function ($serv){
    echo "Connect...\r\n";
});
$server->on('Receive', function ($serv, $fd, $from_id, $data){
    $serv->send('server:'.$data);
    echo "Receive...\r\n";
});
$server->on("Close", function ($serv){
    echo "Close...\r\n";
});
$server->on('Packet', function ($serv){
    echo "Packet...\r\n";
});
$server->on('BufferFull', function ($serv){
    echo "BufferFull...\r\n";
});
$server->on('BufferEmpty', function ($serv){
    echo "BufferEmpty...\r\n";
});
$server->on('Request', function ($serv){
    echo "Request...\r\n";
});

//$server->on('HandShake', function ($serv){
//    echo "HandShake...\r\n";
//});
$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
//    var_dump($server);
//    var_dump($request);
    echo "server: handshake success with fd{$request->fd}\n";
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});


$server->start();

