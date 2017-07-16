<?php
/*
	作者：lee
	时间：
	描述：
	
*/
require substr(dirname(__FILE__),0,-5).'init.inc.php';
global $_tpl;
$_tpl->assign('good','王小二');
$_tpl->display('top.tpl');
?>