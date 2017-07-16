<?php
/*
	作者：lee
	时间：
	描述：
	
*/
header('Content-Type:text/html;charset:utf8');
/*error_reporting(0);*/
define('ROOT_PATH',dirname(__FILE__));
require ROOT_PATH.'/config/profile.inc.php';
require 'cache.inc.php';

function __autoload($classname){
    if(substr($classname,-6)=='Action'){
        require ROOT_PATH.'/action/'.$classname.'.class.php';
    }elseif(substr($classname,-5)=='Model'){
        require ROOT_PATH.'/model/'.$classname.'.class.php';
    }else{
        require ROOT_PATH.'/include/'.$classname.'.class.php';
    }
}
$_tpl=new Templates();

?>