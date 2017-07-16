<?php
/*
	作者：lee
	时间：
	描述：
	
*/
//等级实体类
class LevelModel extends Model{
    private $_level_name;
    private $_level_info;
    private $id;

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
    public function __get($name)
    {
        return $this->$name;
    }

    //查询单个
    public function getoneLevel(){
        $_sql ="SELECT
										id,
										level_name,
                                        level_info
								FROM
										cms_level
								WHERE
										id='$this->id'
                                    OR
                                        level_name='$this->_level_name'
								LIMIT
										1";
        return parent::one($_sql);
    }
    //查询所有
    public function getAlllevel(){
        $_sql="SELECT
                                        id,
                                        level_name,
                                        level_info
                                FROM
                                        cms_level
                                ORDER BY
                                        id ASC";
        return parent::all($_sql);
    }

 // 新增
    public function addLevel(){
        $_sql="INSERT INTO cms_level (level_name,level_info) VALUES('$this->_level_name','$this->_level_info' )";
        return parent::aud($_sql);
    }
 // 编辑
    public function updateLevel(){
        $_sql="UPDATE
                        cms_level
                SET
                        level_name='$this->_level_name',
                        level_info='$this->_level_info'
                WHERE
                        id='$this->id
              LIMIT
                      1'";
        return parent::aud($_sql);
    }
 // 删除
    public function deleteLevel(){
        $_sql="DELETE FROM cms_level WHERE id='$this->id' LIMIT 1";
        return parent::aud($_sql);
    }
}

?>