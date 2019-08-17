<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/15
 * Time: 17:39
 * 异常处理
 */
namespace Vender\Exceptions;


use Vender\Kernel\SwooleBase;

class Exception
{
    public function __construct($message)
    {
        if(config('config.env', 'local') == 'local'){
            SwooleBase::stop();
        }
        throw new \Exception($message);
    }
}