<?php
//开启缓冲区
ob_start();
//输入一段内容，该内容会被记录在缓冲区
echo '缓冲区测试';
//ob_get_contents()获取缓冲区的内容并赋给$_a;
$_a=ob_get_contents();
//ob_end_clean()清除缓冲区，清除所有输出的缓冲。如果移动到echo $_a下面，则啥都不会输出。
ob_end_clean();
echo $_a;

/*$_xml=simplexml_load_file('./config/config.xml');

$_tagLib=$_xml->xpath('/root/taglib');
print_r($_tagLib);
exit();
$_config=array();
foreach($_tagLib as $_tag){
    $_config["$_tag->name"]=$_tag->value;
}
echo $_config['webname'];*/

?>