<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:28
 */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

defined('VENDER_ROOT') || define('VENDER_ROOT', substr(__DIR__, 0, strrpos(substr(__DIR__, 0, strrpos(__DIR__, DS)), DS)));

defined('CONFIG_PATH') || define('CONFIG_PATH', VENDER_ROOT.DS.'Main'.DS.'configs');

