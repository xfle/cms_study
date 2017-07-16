<?php
/*
	作者：lee
	时间：
	描述：
	
*/
class TOOL{
   static public function alertLocation($_info,$_url){
       echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>'";
       exit();
   }
    static public function alertBack($_info){
        echo "<script type='text/javascript'>alert('$_info');history.back();</script>'";
        exit();
    }

}

?>