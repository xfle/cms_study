<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/20
 * Time: 10:00
 */
class Parser
{
    private $_tpl;
    //构造方法将模板文件的路径传给了字段tpl。
    public function __construct($_tplFile)
    {
        //读取路径的文件里的字符串并存给tpl
    if(!$this->_tpl=file_get_contents($_tplFile)){
        exit('读完模板文件错误');
    }
    }
    //使用compile方法生成编译文件。
    private function parConfig(){
        $_patten='/\<!--([\w]+)--\>/';
        if(preg_match($_patten,$this->_tpl)){
            $this->_tpl=preg_replace($_patten,"<?php echo  \$this->_config['$1'] ?>",$this->_tpl);
        }
    }
    private function parVar(){
        $_patten='/\{\$([\w]+)\}/';
        if(preg_match($_patten,$this->_tpl)){
            $this->_tpl=preg_replace($_patten,"<?php echo \$this->_vars['$1'] ?>",$this->_tpl);
        }
    }
    private function parForeach(){
        $_pattenForeach='/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
        $_pattenEndForeach='/\{\/foreach\}/';
        $_pattenEcho='/\{@([\w]+)([\w\-\>]*)\}/';
        if(preg_match($_pattenForeach,$this->_tpl)){
            $this->_tpl=preg_replace($_pattenForeach,"<?php foreach(\$this->_vars['$1'] as \$$2=>\$$3){ ?>",$this->_tpl);
            if(preg_match($_pattenEndForeach,$this->_tpl)){
                $this->_tpl=preg_replace($_pattenEndForeach,'<?php } ?>',$this->_tpl);
                if(preg_match($_pattenEcho,$this->_tpl)){
                    $this->_tpl=preg_replace($_pattenEcho,'<?php echo \$$1$2 ?> ',$this->_tpl);
                }
            }else{
                exit('ERROE:foreach没有闭合');
            }
        }
    }
    private function parif(){
        $_pattenif='/\{if\s+\$([\w]+)()\}/';
        $_pattenendif='/\{\/if\}/';
        $_pattenelse='/\{else\}/';
        if(preg_match($_pattenif,$this->_tpl)){
            $this->_tpl=preg_replace($_pattenif,'<?php if(@$this->_vars[\'$1\']){?>',$this->_tpl);
            //找到了if语句的开头的基础上，再查找if语句的结束部分
            if(preg_match($_pattenendif,$this->_tpl)){
                $this->_tpl=preg_replace($_pattenendif,'<?php } ?>',$this->_tpl);
                if(preg_match($_pattenelse,$this->_tpl)){
                    $this->_tpl=preg_replace($_pattenelse,'<?php }else{ ?>',$this->_tpl);
                }
            }else{
                exit('if语句没有关闭');
            }
        }
    }

    private function parInclude(){
        $_pattenInclude='/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';
        if(preg_match_all($_pattenInclude,$this->_tpl,$_file)){
            /*            if(!file_exists($_file[2])||empty($_file)){
                exit('ERROR：载入的文件出错了');
            }*/
            $this->_tpl=preg_replace($_pattenInclude,"<?php \$_tpl->create('$2'); ?>",$this->_tpl);
        }
    }
    public function parcommon(){
        $_patten='/\{#\}(.*)\{#\}/';
        if(preg_match($_patten,$this->_tpl)){
            $this->_tpl=preg_replace($_patten,'<?php /* $1 */?>',$this->_tpl);
        }
    }
    public function compile($_parFile){
        $this->parConfig();
        $this->parVar();
        $this->parif();
        $this->parcommon();
        $this->parInclude();
        $this->parForeach();
        if(!file_put_contents($_parFile,$this->_tpl)){
            exit('文件编译错误');
        }
    }

}