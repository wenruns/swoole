<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:58
 */
namespace Main;

use \Main\controllers\SwooleBase;
use \Swoole\Websocket\Server;
use \Swoole\Websocket\Frame;
use \Swoole\Http\Request;

class Swoole extends SwooleBase
{
    public function onWorkerStart()
    {
        echo "workerStart...\r\n";
    }

    public function onOpen(Server $server, Request $request)
    {
    }

    public function onRequest($request, $response)
    {
    }


    public function onMessage(Server $server, Frame $frame)
    {
        if($server->isEstablished($frame->fd)){
            $server->push($frame->fd, $frame->data);
        }
    }

    public function onClose(Server $server, int $fd, int $reactorId)
    {
        echo "close...\r\n";
    }

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