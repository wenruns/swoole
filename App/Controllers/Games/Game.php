<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/6
 * Time: 10:28
 */

namespace App\Controllers\Games;

abstract class Game
{
    // 下注
    abstract public static function bets($data);

    // 开奖
    abstract public static function lottery($award_code);

    // 设置（赔率|开奖码）
    abstract public static function setting($data);

    // 启动入口
    abstract public static function run();

    // 关闭
    abstract public static function stop();
}