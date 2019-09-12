<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/14
 * Time: 16:28
 */
require_once 'const.php';

function dump($var, $_stdout = false){
    $unique = mt_rand();
    $str = '<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            padding: 0px;
            margin: 0px;
            list-style: none;
            font-size: 18px;
        }
        ul{
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            background: lightgoldenrodyellow;
        }
        li{
            list-style: none;
            color: red;
        }
        .icon'.$unique.':before{
            content: attr(data-icon);
            display: inline-block;
            width: 10px;
            height: 10px;
            text-align: center;
            line-height: 8px;
            background: darkgray;
            color: honeydew;
            font-size: 10px;
            margin-right: 5px;
        }
        .sub-ul{
            padding-left: 30px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .is-hide{
            display: none;
        }
        .type-box{
            font-size: 14px;
            color: deepskyblue;
        }
    </style>
</head>
<body>
    <ul>';
    $str .= makeLi($var, false, $unique);
    $str .= '</ul>
    <script>
        document.querySelectorAll(\'.icon'.$unique.'\').forEach(function (item, index) {
            item.addEventListener(\'click\', function (e) {
                var sub_ul = null;
                var ellipsis = null;
                for(var i=0; i<e.target.parentElement.children.length; i++){
                    if (e.target.parentElement.children[i].classList.value.indexOf(\'sub-ul\') >= 0) {
                        sub_ul = e.target.parentElement.children[i];
                    } else if (e.target.parentElement.children[i].classList.value.indexOf(\'ellipsis\') >= 0) {
                        ellipsis = e.target.parentElement.children[i];
                    }
                }
                if(!sub_ul && !ellipsis){
                    return false;
                }
                if (e.target.dataset.icon == \'-\') {
                   e.target.dataset.icon = \'+\';
                   if(sub_ul){
                       sub_ul.classList.add(\'is-hide\');
                   }
                   if(ellipsis){
                       ellipsis.classList.remove(\'is-hide\');
                   }
                }else{
                    e.target.dataset.icon = \'-\';
                    if(sub_ul){
                        sub_ul.classList.remove(\'is-hide\');
                    }
                    if(ellipsis){
                        ellipsis.classList.add(\'is-hide\');
                    }
                }
            })
        })
    </script>
</body>
</html>';
    if(!$_stdout){
        return $str;
    }
    echo $str;
}

function makeLi($var, $key, $unique){
//    echo gettype($key).'<hr/>';
    if(is_array($var)){
        $str = '<li>
                    <span class="icon'.$unique.'" data-icon="-"></span>';
        if($key === false){
            $str .= '<span>'.gettype($var).'('.count($var).')'.'{</span>';
        }else{
            $str .= '<span>"'.$key.'" => </span>';
            $str .= '<span class="type-box">'.gettype($var).'('.count($var).')'.'</span><span> {</span>';
        }
        $str .= '<ul class="sub-ul">';
        foreach ($var as $key => $val){
            $str .= makeLi($val, $key, $unique);
        }
        $str .= '</ul>
                    <span class="ellipsis is-hide">...</span>
                    <span>}</span>
                </li>';
    }elseif(gettype($var) == 'object'){
        $methods = get_class_methods($var);
        $properties = get_class_vars(get_class($var));
        $str = '<li>
                <span class="icon'.$unique.'" data-icon="-"></span>
                <span class="type-box">[object('.count((array)$var).')]</span>
                <span>'.get_class($var).' {</span>';
        $str .= '<ul class="sub-ul">';

        if(empty($methods)){
            $str .= '<span>methods => NULL</span>';
        }else{
            $str .= '<span>methods => array('.count($methods).') {</span>
                <ul class="sub-ul">';
            foreach ($methods as $key => $vo){
                $str .= makeLi($vo, $key, $unique);
            }
            $str .= '</ul><span>}</span>';
        }
        if(empty($properties)){
            $str .= '<br/>
                <span>properties => NULL</span>';
        }else{
            $str .= '<br/>
                <span>properties => array('.count($properties).') {</span>
                <ul class="sub-ul">';
            foreach ($properties as $key => $property) {
                $str .= makeLi($property, $key, $unique);
            }
            $str .= '</ul>
                <span>}</span>';
        }

        $str .= '</ul>
                <span class="ellipsis is-hide">...</span>
                <span>}</span>
            </li>';
    }elseif (gettype($var) == 'NULL'){
//        $str = '<li>'.gettype($var).'</li>';
        $str = '';
    }else{
        $str = '<li>';
        $str .= '<span class="icon'.$unique.'" data-icon="-"></span>';
        if ($key === false) {
            $str .= '<span class="type-box">['.gettype($var).'('.strlen($var).')]</span><span> '.$var.'</span>';
        }else{
            if(gettype($key) == 'integer'){
                $str .= '<span>'.$key.'</span>';
            }else{
                $str .= '<span>"'.$key.'"</span>';
            }
            $str .= '<span> =></span>
                <span  class="type-box">['.gettype($var).'('.strlen($var).')]</span><span> '.(gettype($var) == 'string' ? '"'.$var.'"': $var).'</span>';
        }
        $str .= '</li>';
    }
    return $str;
}



function config($index = '', $default = null){
    if(is_dir(CONFIG_PATH)){
        if($index){
            $index = explode('.', $index);
            if(is_file(CONFIG_PATH.DS.$index[0].'.php')){
                $configs = require CONFIG_PATH.DS.$index[0].'.php';
                unset($index[0]);
                foreach ($index as $key){
                    if(!isset($configs[trim($key, ' ')])){
                        if($default !== null){
                            return $default;
                        }
                        throw new \Exception('undefined index: '.$key);
                    }
                    $configs = $configs[trim($key, ' ')];
                }
                return $configs;
            }else{
                if ($default !== null) {
                    return $default;
                }
                return null;
            }
        }else{
            $files = scandir(CONFIG_PATH, SCANDIR_SORT_NONE);
            $configs = [];
            foreach ($files as $key => $file) {
                if($file != '.' && $file != '..'){
                    $c = require CONFIG_PATH.DS.$file;
                    $configs = array_merge($configs, $c);
                }
            }
            if(empty($configs) && $default !== null){
                return $default;
            }
            return $configs;
        }
    }else{
        throw new \Exception('配置文件路径不存在！');
    }
}




































