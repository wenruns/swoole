<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:39
 */
class Autoload
{
    private $root_path = '';

    protected static $container = null;

    public function __construct()
    {
        require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'func.php';
        $this->root_path = VENDER_ROOT;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoLoad'));
    }

    private function autoLoad($class_name)
    {
        require_once $this->root_path.DS.$class_name.'.php';
    }


}

$autoload = new Autoload();
$autoload->register();