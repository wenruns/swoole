<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/17
 * Time: 16:10
 */

namespace Vender;


use Vender\Kernel\SwooleBase;
use \Swoole\Http\Server;

class HttpServer extends SwooleBase
{
    public function onWorkerStart(Server $server, $worker_id)
    {
        echo "workerStart...[$worker_id]\r\n";
    }

    /**
     * @param $request
     * @param $response
     * 接收http请求
     */
    public function onRequest($request, $response)
    {
        echo "request...\r\n";
        $client = new \Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
        $client->connect("127.0.0.1", 9502, 0.5);
        //调用connect将触发协程切换
        $client->send("hello world from swoole");
        //调用recv将触发协程切换
        $ret = $client->recv();
        $response->header("Content-Type", "text/plain");
        $response->end($ret);
        $client->close();
    }

    /**
     * @param Server $server
     * @param int $fd
     * @param int $reactorId
     * 关闭连接
     */
    public function onClose(Server $server, int $fd, int $reactorId)
    {
        echo "close...\r\n";
    }
}