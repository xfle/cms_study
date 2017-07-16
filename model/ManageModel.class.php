<?php
/*
	作者：lee
	时间：
	描述：
	
*/
//管理员实体类
class ManageModel extends Model{
    private $_admin_user;
    private $_admin_pass;
    private $_admin_level;
    private $limit;
    private $id;

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
    public function __get($name)
    {
        return $this->$name;
    }

    //查询单个管理员
    public function getoneManage(){
        $_sql ="SELECT
										id,
										admin_user,
										admin_pass,
                                        level
								FROM
										cms_manage
								WHERE
										id='$this->id'
                                    OR
                                        admin_user='$this->_admin_user'
                                    OR
                                       level='$this->_admin_level'
								LIMIT
										1";
        return parent::one($_sql);
    }

//取得管理员的总数
    public function getManageTotal(){
        $_sql="SELECT COUNT(id) FROM cms_manage ";
        return parent::total($_sql);
    }

    // 查询所有管理员
    public function getAllManage(){
        $_sql = "SELECT
										m.id,
										m.admin_user,
										m.login_count,
										m.last_ip,
										m.last_time,
										l.level_name
								FROM
										cms_manage m,
										cms_level l
								WHERE
										l.id = m.level
							ORDER BY
										m.id ASC
                              $this->limit";
        return parent::all($_sql);
    }
 // 新增管理员
    public function addManage(){
        $_sql="INSERT INTO cms_manage (admin_user,admin_pass,level,reg_time) VALUES('$this->_admin_user','$this->_admin_pass','$this->_admin_level',NOW() )";
        return parent::aud($_sql);
    }
 // 编辑管理员
    public function updateManage(){
        $_sql="UPDATE cms_manage SET admin_pass='$this->_admin_pass',level='$this->_admin_level'WHERE id='$this->id LIMIT 1'";
        return parent::aud($_sql);
    }
 // 删除管理员
    public function deleteManage(){
        $_sql="DELETE FROM cms_manage WHERE id='$this->id' LIMIT 1";
        return parent::aud($_sql);
    }
}

?>