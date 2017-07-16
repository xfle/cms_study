<?php
/*
	作者：lee
	时间：
	描述：
	
*/
class LevelAction extends Action{

    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl,new LevelModel());
        $this->_action();
        $this->_tpl->display('level.tpl');
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
            if(Validate::checkNull($_POST['level_name'])) TOOL::alertBack('等级名称不能为空');
            if(Validate::checkLength($_POST['level_name'],2,'min')) TOOL::alertBack('等级名称不得小于2位');
            if(Validate::checkLength($_POST['level_name'],12,'max')) TOOL::alertBack('等级名称不得大于12位');
            if(Validate::checkLength($_POST['level_info'],5,'min')) TOOL::alertBack('备注不得小于5位');
            if(Validate::checkLength($_POST['level_info'],200,'max')) TOOL::alertBack('备注不得大于200位');
            $this->_model->_level_name=$_POST['level_name'];
            if($this->_model->getoneLevel()) TOOL::alertBack('等级名称重复');
            $this->_model->_level_info=$_POST['level_info'];
            $this->_model->addLevel()?TOOL::alertLocation('增加成功','level.php?action=show'):TOOL::alertBack('增加失败');
        }
        $this->_tpl->assign('add',true);
        $this->_tpl->assign('title','新增等级');
    }

    private function show(){
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','等级列表');
        $this->_tpl->assign('AllLevel',$this->_model->getAllLevel());
    }

    private function update(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['level_name'])) TOOL::alertBack('等级名称不能为空');
            if(Validate::checkLength($_POST['level_name'],2,'min')) TOOL::alertBack('等级名称不得小于2位');
            if(Validate::checkLength($_POST['level_name'],12,'max')) TOOL::alertBack('等级名称不得大于12位');
            if(Validate::checkLength($_POST['level_info'],5,'min')) TOOL::alertBack('备注不得小于5位');
            if(Validate::checkLength($_POST['level_info'],200,'max')) TOOL::alertBack('备注不得大于200位');
            $this->_model->id = $_POST['id'];
            $this->_model->_level_name=$_POST['level_name'];
            $this->_model->_level_info=$_POST['level_info'];
            $this->_model->updateLevel()?TOOL::alertLocation('编辑成功','level.php?action=show'):TOOL::alertBack('修改失败');
        }
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            is_object($this->_model->getoneLevel())?true:TOOL::alertBack('等级ID传值有误');
            $this->_tpl->assign('level_name',$this->_model->getoneLevel()->level_name);
            $this->_tpl->assign('level_info',$this->_model->getoneLevel()->level_info);
            $this->_tpl->assign('id',$this->_model->getoneLevel()->id);
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','编辑等级');
        }else{
            TOOL::alertBack('非法操作');
        }
    }

    private function delete(){
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $_manage=new ManageModel();
            $_manage->_admin_level=$this->_model->id;
            if($_manage->getoneManage()) TOOL::alertBack('此等级内有管理员，无法删除。请先删除该等级的管理员');
            $this->_model->deleteLevel()?TOOL::alertLocation('删除成功','level.php?action=show'):TOOL::alertBack('删除失败');
        }else{
            TOOL::alertBack("非法操作！");
        }
    }

}

?>