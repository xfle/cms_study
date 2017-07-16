<?php
/*
	作者：lee
	时间：
	描述：
	
*/
class Page{
    private $_total;     //总页数
    private $_pagesize; //每页显示多少条
    private $_limit;
    private $_page;      //获取当前页码
    private $_pageNum;  //获取总页码
    private $_url;       //当前页面url
    private $_bothNum; //两边显示几条数据
    public function __construct($_total,$_pagesize)
    {
        $this->_total=$_total;
        $this->_pagesize=$_pagesize;
        $this->_pageNum=ceil($this->_total/$this->_pagesize);
        $this->_page=$this->setPage();
        $this->_limit='LIMIT '.($this->_page-1)*$this->_pagesize.','.$this->_pagesize;
        $this->_url=$this->setUrl();
        $this->_bothNum=3;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }

    public function __get($value){
        return $this->$value;
    }

    private function first(){
        return '<a href="'.$this->_url.'">1</a>...';
    }

    private function prv(){
        if($this->_page==1){
            return '<span class="disabled">上一页</span>';
        }
        return '<a href="'.$this->_url.'&page='.($this->_page-1).'">上一页</a>';
    }

    private function next(){
        if($this->_page==$this->_pageNum){
            return '<span class="disabled">下一页</span>';
        }
        return '<a href="'.$this->_url.'&page='.($this->_page+1).'">下一页</a>';
    }

    private function last(){
        return '...<a href="'.$this->_url.'&page='.$this->_pageNum.'">'.$this->_pageNum.'</a>';
    }
    public function setUrl(){
        //获取页面的地址（除域名以外的地址）
        $url=$_SERVER["REQUEST_URI"];
        //解析页面地址，会将地址分成文件部分如manage.php和参数部分acton=show？page=2，并且存储为数组,数组键为：path,query
        //$_par['path']="manage.php"   $_par['query']="action=show?page=2"
        $_par=parse_url($url);
        if(isset($_par['query'])){
            //parse_str()函数将$_par['query']继续拆分为action=show和page=2 的$_query数组,且键为$_query['action']="show"
            //$_query['page']=2;
            parse_str($_par['query'],$_query);
            //删除$_query['page'],则数组只剩下$_query['action']
            unset($_query['page']);
            $url=$_par['path'].'?'.http_build_query($_query);
        }
        //用http_build_query($_query)将数组的值变为字符串 即action=page,最后拼装地址返回
        return $url;
    }

    public function setPage(){
        if(!isset($_GET['page'])){
            return 1;
        }
        if(!empty($_GET['page'])){
            if($_GET['page']>0){
                if($_GET['page']>$this->_pageNum){
                    return $this->_pageNum;
                }else{
                    return $_GET['page'];
                }
            }else{
                return 1;
            }
        }else{
            return 1;
        }
    }

    private function pageList(){
            $_pagelist='';
             for($i=$this->_bothNum;$i>=1;$i--) {
                 $_page=$this->_page-$i;
                 $_pagelist.='<a href="'.$this->_url.'&page='.$_page.'">'.$_page.'</a>';
             }
            $_pagelist.='<span class="me">'.$this->_page.'</span>';
            for($i=1;$i<=$this->_bothNum;$i++){
                $_page=$this->_page+$i;
                if($_page>$this->_pageNum) break;
                $_pagelist.='<a href="'.$this->_url.'&page='.$_page.'">'.$_page.'</a>';

            }
                return $_pagelist;
    }

    public function showpage(){
        $_page=$this->prv();
        $_page.=$this->first();
        $_page.=$this->pageList();
        $_page.=$this->last();
        $_page.=$this->next();
        return $_page;
    }



}

?>