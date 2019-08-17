<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 17:39
 * 异常处理
 */
namespace Vender\Exceptions;


class Exception
{
    public function __construct($message)
    {
        throw new \Exception($message);
    }
}