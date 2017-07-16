<?php
/*
	作者：lee
	时间：
	描述：
	
*/
    class Validate{
        //检测是否为空
        public static function checkNull($date){
            if(trim($date)=='') return true;
            return false;
    }
        //检测用户名长度
        public static function checkLength($date,$length,$flag){
            if($flag=='min'){
                if(mb_strlen(trim($date),'utf-8')<$length) return true;
                return false;
            }else if($flag=='max'){
                if(mb_strlen(trim($date),'utf-8')>$length) return true;
                return false;
            }else{
                TOOL::alertBack('参数传递错误');
            }
        }

        //检测密码
        public static function checksame($date,$date2){
            if(trim($date)!=trim($date2)) return true;
            return false;
        }

    }


?>