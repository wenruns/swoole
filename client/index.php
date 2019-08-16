<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 17:54
 */

require_once '..'.DIRECTORY_SEPARATOR.'Main'.DIRECTORY_SEPARATOR.'App.php';
$app = new \Main\App();

$swoole = $app->run();
