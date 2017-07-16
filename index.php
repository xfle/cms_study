<?php
/*
	作者：lee
	时间：
	描述：
	
*/
require dirname(__FILE__).'/init.inc.php';
global $_tpl;
//访问编译display方法
$_tpl->assign('title',"标头");
$_tpl->display('index.tpl');
?>