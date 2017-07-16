<?php
/*
	作者：lee
	时间：
	描述：
	
*/
/*require 'init.inc.php';
require ROOT_PATH.'/model/manage.class.php';
$_db=DB::getDB();
$_sql="select m.test,l.test from cms_manage as m,cms_level as l limit 0,10";
$_result=$_db->query($_sql);

$_html=array();
while($_rows=$_result->fetch_object()){
    $_html[]=$_rows;
    print_r($_html);
}*/

$url= $_SERVER["REQUEST_URI"];

$_par=parse_url("photo/oop/tpl/test5.php?id=abc&go=123");

parse_str($_par['query'],$_query);
unset($_query['go']);
print_r($_query);
echo http_build_query($_query);
?>