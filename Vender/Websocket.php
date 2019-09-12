<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:58
 */
namespace Vender;

use App\Controllers\Chat\MessageController;
use App\Controllers\ManagerController;
use http\Message;
use \Vender\Kernel\SwooleBase;
use \Swoole\Websocket\Server;
use \Swoole\Websocket\Frame;
use \Swoole\Http\Request;

class Websocket extends SwooleBase
{
    /**
     * 启动worker子进程
     */
    public function onWorkerStart()
    {
        echo "workerStart...\r\n";
    }

    /**
     * @param $request
     * @param $response
     * 接收http请求
     */
    public function onRequest($request, $response)
    {
        $response->header('Content-Type', 'text/html;charset=utf-8');
        if(is_file(PUBLIC_PATH.DS.'index.php')){
            $res = include PUBLIC_PATH.DS.'index.php';
            $response->end($res);
        }else if(is_file(PUBLIC_PATH.DS.'index.html')){
            $response->end(file_get_contents(PUBLIC_PATH.DS.'index.html'));
        }
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
     * @param Server $server
     * @param Frame $frame
     * 接收消息
     */
    public function onMessage(Server $server, Frame $frame)
    {
        echo "message...[".$frame->data."]\r\n";
        $data = json_decode($frame->data, true);
        ManagerController::setUserPool($data['id'], $frame->fd);
        switch ($data['type']){
            case ManagerController::CHAT_TYPE_HELLO:
                ManagerController::setUserInfo($data['id'], $data);
                break;
            case ManagerController::CHAT_TYPE_ROOM:
                if(!in_array($data['id'], ManagerController::getChatPools())){
                    ManagerController::setChatPool($data['id']);
                }
                MessageController::chatRoom($server, $data);
                break;
            case ManagerController::CHAT_TYPE_FRIEND:
                break;
            case ManagerController::CHAT_TYPE_ALL:
                break;
            default:
                if($server->isEstablished($frame->fd)){
                    $server->push($frame->fd, $frame->data);
                }
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
        $user_id = array_search($fd, ManagerController::getUserPools());
        if(in_array($user_id, ManagerController::getChatPools())){
            $info = ManagerController::getUserInfo($user_id);
            MessageController::chatRoom($server, [
                'type' => ManagerController::CHAT_TYPE_ROOM,
                'id' => $user_id,
                'msg' => $info['name'].'，已离开聊天室'
            ]);
        }
        ManagerController::clear($user_id);
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