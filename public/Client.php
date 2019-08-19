<?php

$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1))
{
    exit("connect failed. Error: {$client->errCode}\n");
}else{
    echo "connecting success!\r\nsending message to server!\r\n";
}
$client->send("hello world\n");
echo $client->recv();
$client->close();

//function