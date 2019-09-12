<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/31
 * Time: 14:17
 */

namespace Vender\Exceptions;


use Vender\Kernel\SwooleBase;

class MakeException
{
    public function __construct($message)
    {
        if(config('config.env', 'local') == 'local'){
            SwooleBase::stop();
        }
        throw new \Exception($message);
    }
}