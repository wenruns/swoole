<?php
namespace Vender;

use \Vender\Kernel\SwooleBase;
use \Swoole\Server as SwooleServer;

class Server extends SwooleBase
{
//    public function onStart(SwooleServer $server)
//    {
//        echo "start...\r\n";
//    }

    public function onShutdown(SwooleServer $server)
    {
        echo "shutdown...\r\n";
    }

    public function onWorkerStart(SwooleServer $server, $worker_id)
    {
        echo "workerStart...\r\n";
    }

    public function onWorkerStop(SwooleServer $server, $worker_id)
    {
        echo "workerStop...\r\n";
    }

    public function onConnect(SwooleServer $server, $fd, $reactor_id)
    {
        echo "connect...\r\n";
    }

    public function onReceive(SwooleServer $server, $fd, $reactor_id, $data)
    {
        echo "receive...\r\n";
    }

    public function onClose(SwooleServer $server, $fd, $reactor_id)
    {
        echo "close...\r\n";
    }
}