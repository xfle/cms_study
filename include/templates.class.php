<?php
/*
	作者：lee
	时间：
	描述：
	
*/
class Templates{
    private $_vars=array();
    private $_config=array();
    //构造方法
    function __construct(){
        if(!is_dir(TPL_DIR)||!is_dir(TPL_C_DIR)||!is_dir(CACHE_DIR)){
            exit('error!模板目录或编译目连或缓存目录不存在，请手工设置');
        }
        $_xml=simplexml_load_file(ROOT_PATH.'/config/config.xml');
        $_tagLib=$_xml->xpath('/root/taglib');
        foreach($_tagLib as $_tag){
            $this->_config["$_tag->name"]=$_tag->value;
        }
    }

    function assign($_var,$_value){
        if(!isset($_var)||!empty($_var)){
            $this->_vars[$_var]=$_value;
        }else{
            exit('请设置模板变量');
        }
    }

    function display($_file){
        $_tpl=$this;
        //模板文件的路径
        $_tplFile=TPL_DIR.$_file;
        if(!is_file($_tplFile)){
            exit('模板文件不存在');
        }
        //编译文件的路径
        $_parFile=TPL_C_DIR.md5($_file).$_file.'.php';
        //缓存文件路径
        $_cacheFile=CACHE_DIR.md5($_file).$_file.'.html';
        if(IS_CACHE){
            if(file_exists($_cacheFile)&&file_exists($_parFile)&&filemtime($_parFile)>=filemtime($_tplFile)&&filemtime($_cacheFile)>=filemtime($_parFile)){
                include $_cacheFile;
                return;
            }
        }
        //将模板文件读取，然后存成编译文件 file_put_contents(文件名，字符串)将字符串生成文件。
        //file_get_contents(文件)，读取文件内容
        //如果文件不存在，就生成编译文件，如果存在则不要生成，防止重复生成浪费时间与资源。
        //如果模板文件发生了更改，则编译文件也需要重新生成。判断模板文件的时间与编译文件的时间，如果模板文件的时间大于编译文件，则重新生产编译文件。
        if(!is_file($_parFile)||filemtime($_tplFile)>filemtime($_parFile)){
            //文件读取生成编译文件的代码转义到Parser.class类里面了。
            require_once ROOT_PATH.'/include/Parser.class.php';
            $parser=new Parser($_tplFile);
            $parser->compile($_parFile);
        }
        //三元运算 如果IS_CACHE为真，则开启缓冲区，否则什么都不执行
        include $_parFile;
        if(IS_CACHE){
            file_put_contents($_cacheFile,ob_get_contents());
            ob_end_clean();
            if(file_exists($_cacheFile)){
                include $_cacheFile;
            }
        }
    }

    function create($_file){
        //模板文件的路径
        $_tplFile=TPL_DIR.$_file;
        if(!is_file($_tplFile)){
            exit('模板文件不存在');
        }
        //编译文件的路径
        $_parFile=TPL_C_DIR.md5($_file).$_file.'.php';
        //缓存文件路径

        //将模板文件读取，然后存成编译文件 file_put_contents(文件名，字符串)将字符串生成文件。
        //file_get_contents(文件)，读取文件内容
        //如果文件不存在，就生成编译文件，如果存在则不要生成，防止重复生成浪费时间与资源。
        //如果模板文件发生了更改，则编译文件也需要重新生成。判断模板文件的时间与编译文件的时间，如果模板文件的时间大于编译文件，则重新生产编译文件。
        if(!is_file($_parFile)||filemtime($_tplFile)>filemtime($_parFile)){
            //文件读取生成编译文件的代码转义到Parser.class类里面了。
            require_once ROOT_PATH.'/include/Parser.class.php';
            $parser=new Parser($_tplFile);
            $parser->compile($_parFile);
        }
        include $_parFile;
    }


}
?>