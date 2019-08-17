<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:58
 */
namespace Vender;

use \Vender\Kernel\SwooleBase;
use \Swoole\Websocket\Server;
use \Swoole\Websocket\Frame;
use \Swoole\Http\Request;

class Websocket extends SwooleBase
{

    public function onWorkerStart()
    {
        echo "workerStart...\r\n";
    }

    /**
     * @param Server $server
     * @param Request $request
     * 连接成功
     */
    public function onOpen(Server $server, Request $request)
    {
        echo "open...\r\n";
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
     * @param Frame $frame
     * 接收消息
     */
    public function onMessage(Server $server, Frame $frame)
    {
        echo "message...[".$frame->data."]\r\n";
        if($server->isEstablished($frame->fd)){
            $server->push($frame->fd, $frame->data);
        }
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

    /**
     * 自定义握手操作
     */
//    public function onHandshake(\swoole_http_request $request, \swoole_http_response $response)
//    {
//        echo "handshake...\r\n";
//        // print_r( $request->header );
//        // if (如果不满足我某些自定义的需求条件，那么返回end输出，返回false，握手失败) {
//        //    $response->end();
//        //     return false;
//        // }
//
//        // websocket握手连接算法验证
//        $secWebSocketKey = $request->header['sec-websocket-key'];
//        $patten = '#^[+/0-9A-Za-z]{21}[AQgw]==$#';
//        if (0 === preg_match($patten, $secWebSocketKey) || 16 !== strlen(base64_decode($secWebSocketKey))) {
//            $response->end();
//            return false;
//        }
////        echo $request->header['sec-websocket-key'];
//        $key = base64_encode(sha1(
//            $request->header['sec-websocket-key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11',
//            true
//        ));
//
//        $headers = [
//            'Upgrade' => 'websocket',
//            'Connection' => 'Upgrade',
//            'Sec-WebSocket-Accept' => $key,
//            'Sec-WebSocket-Version' => '13',
//        ];
//
//        // WebSocket connection to 'ws://127.0.0.1:9502/'
//        // failed: Error during WebSocket handshake:
//        // Response must not include 'Sec-WebSocket-Protocol' header if not present in request: websocket
//        if (isset($request->header['sec-websocket-protocol'])) {
//            $headers['Sec-WebSocket-Protocol'] = $request->header['sec-websocket-protocol'];
//        }
//
//        foreach ($headers as $key => $val) {
//            $response->header($key, $val);
//        }
//
//        $response->status(101);
//        $response->end();
//    }


}