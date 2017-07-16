<?php
/*
	作者：lee
	时间：
	描述：
	
*/
class Model{
    protected function aud($_sql){
        $_db=DB::getDB();
        $_result=$_db->query($_sql);
        $_rows=$_db->affected_rows;
        DB::unDB($_result,$_db);
        return $_rows;
    }

    protected function one($_sql){
        $_db=DB::getDB();
        $_result=$_db->query($_sql);
        $_objects=$_result->fetch_object();
        DB::unDB($_result,$_db);
        return $_objects;
    }

    protected function all($_sql){
        $_db=DB::getDB();
        $_result=$_db->query($_sql);
        $_html=array();
        while($_objects=$_result->fetch_object()){
            $_html[]=$_objects;
        }
        DB::unDB($_result,$_db);
        return $_html;
    }

    protected function total($_sql){
        $_db=DB::getDB();
        $_result=$_db->query($_sql);
        $_total=$_result->fetch_row();
        DB::unDB($_result,$_db);
        return $_total[0];
    }
}

?>