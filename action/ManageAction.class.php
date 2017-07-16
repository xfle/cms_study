<?php
/*
	作者：lee
	时间：
	描述：
	
*/
class ManageAction extends Action{

    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl,new ManageModel());
        $this->_action();
        $this->_tpl->display('manage.tpl');
    }

    private function _action(){
        switch($_GET['action']){
            case 'show';
                $this->show();
                break;
            case 'add';
                $this->add();
                break;
            case 'update';
                $this->update();
                break;

            case 'delete';
                $this->delete();
                /*                $this->_tpl->assign('delete',true);
                                $this->_tpl->assign('title','删除管理员');*/
                break;
            default;
                TOOL::alertBack('非法操作');
                break;
        }
}

    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['admin_user'])) TOOL::alertBack('用户名不得为空');
            if(Validate::checkLength($_POST['admin_user'],2,'min')) TOOL::alertBack('用户名不得小于2位');
            if(Validate::checkLength($_POST['admin_user'],2,'min')) TOOL::alertBack('用户名不得小于2位');
            if(Validate::checkLength($_POST['admin_user'],12,'max')) TOOL::alertBack('用户名不得大于12位');
            if(Validate::checkLength($_POST['admin_pass'],6,'min')) TOOL::alertBack('密码不得小于6位');
            if(Validate::checkLength($_POST['admin_pass'],20,'max')) TOOL::alertBack('密码不得大于20位');
            if(Validate::checkNull($_POST['admin_pass'])) TOOL::alertBack('密码不得为空');
            if(Validate::checksame($_POST['admin_pass'],$_POST['admin_repass'])) TOOL::alertBack('两次输入的密码不相同');
            $this->_model->_admin_user=$_POST['admin_user'];
            if($this->_model->getoneManage()) TOOL::alertBack('用户名已被占用');
            $this->_model->_admin_pass=sha1($_POST['admin_pass']);
            $this->_model->_admin_level=$_POST['level'];
            $this->_model->addManage()?TOOL::alertLocation('增加成功','manage.php?action=show'):TOOL::alertBack('增加失败');
        }
        $this->_tpl->assign('add',true);
        $_level=new LevelModel();
        $this->_tpl->assign('Alllevel',$_level->getAlllevel());
        $this->_tpl->assign('title','新增管理员');
    }

    private function show(){
        $_page=new Page($this->_model->getManageTotal(),PAGE_SIZE);
        $this->_model->limit=$_page->_limit;
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','管理员列表');
        $this->_tpl->assign('AllManage',$this->_model->getAllManage());
        $this->_tpl->assign('page',$_page->showpage());
    }

    private function update(){
        if(isset($_POST['send'])){
            $this->_model->id=$_POST['id'];
            if(trim($_POST['admin_pass'])==''){
                $this->_model->_admin_pass=$_POST['pass'];
            }else{
                if(Validate::checkLength($_POST['admin_pass'],6,'min')) return TOOL::alertBack('密码最小不得小于6位');
                $this->_model->_admin_pass=sha1($_POST['admin_pass']);
            }
            $this->_model->_admin_level=$_POST['level'];
            $this->_model->updateManage()?TOOL::alertLocation('编辑成功','manage.php?action=show'):TOOL::alertBack('修改失败');
        }
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            is_object($this->_model->getoneManage())?true:TOOL::alertBack('管理员ID传值有误');
            $this->_tpl->assign('admin_user',$this->_model->getoneManage()->admin_user);
            $this->_tpl->assign('level',$this->_model->getoneManage()->level);
            $this->_tpl->assign('id',$this->_model->getoneManage()->id);
            $this->_tpl->assign('pass',$this->_model->getoneManage()->admin_pass);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','编辑管理员');
            $_level=new LevelModel();
            $this->_tpl->assign('Alllevel',$_level->getAlllevel());
        }else{
            TOOL::alertBack('非法操作');
        }
    }

    private function delete(){
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $this->_model->deleteManage()?TOOL::alertLocation('删除成功','manage.php?action=show'):TOOL::alertBack('删除失败');
        }else{
            TOOL::alertBack("非法操作！");
        }
    }

}

?>