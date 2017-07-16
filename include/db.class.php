<?php
/*
	作者：lee
	时间：
	描述：
	
*/
class DB{
     static public function getDB(){
         $_mysqli=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
         if($_mysqli->errno){
             exit('数据库连接失败，错误代码为'.$_mysqli->errno);
         }
         $_mysqli->set_charset('utf8');
        return $_mysqli;
     }

    static public function unDB(&$_result,&$_db){
        if(is_object($_result)){
            //清理结果集
            $_result->free();
            //销毁结果对象
            $_result=null;
        }
        if(is_object($_db)){
            //关闭数据库
                $_db->close();
        //清理资源句柄
                $_db=null;}
    }

}

    ?>