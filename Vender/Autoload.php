<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:39
 */
class Autoload
{

    public function __construct()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'func.php';
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoLoad'));
    }

    private function autoLoad($class_name)
    {
        require_once ROOT_PATH.DS.$class_name.'.php';
    }

}

$autoload = new Autoload();
$autoload->register();
return $autoload;
