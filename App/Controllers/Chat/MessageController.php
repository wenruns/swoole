<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/4
 * Time: 9:40
 */

namespace App\Controllers\Chat;

use App\Controllers\ManagerController;
use \Swoole\Websocket\Server;


class MessageController
{
    protected static $server = null;

    public static function chatRoom(Server $server, $data)
    {
        self::$server = $server;
        $chatPools = ManagerController::getChatPools();
        foreach ($chatPools as $k => $id) {
            if ($id != $data['id']) {
                self::send($id, $data['msg']);
            }
        }
    }

    public static function send($id, $msg)
    {
        $fd = ManagerController::getUserPool($id);
        if(self::$server->isEstablished($fd)){
            $data = [
                'type' => ManagerController::CHAT_TYPE_ROOM,
                'statusCode' => 200,
                'data' => $msg
            ];
            self::$server->push($fd, json_encode($data));
        }else{
            ManagerController::clear($id);
        }

    }

}