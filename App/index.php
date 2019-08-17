<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 17:54
 */

$app = require_once '..' . DIRECTORY_SEPARATOR . 'Vender' . DIRECTORY_SEPARATOR . 'App.php';

$socket_type = config('config.server_type');
switch ($socket_type){
    case 'server':
        $app->setServer('\Vender\Server');
        break;
    default:
        $app->setServer('\Vender\Websocket');
}
$app->run();
