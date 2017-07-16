<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="../style/admin.css">
<script type="text/javascript" src="../js/admin_level.js"></script>
<head>
    <title>main</title>
</head>
<body id="main">
<div class="map">
    管理首页&gt;&gt;等级管理&gt;&gt;<?php echo $this->_vars['title'] ?>
</div>
<ol>
    <li><a href="level.php?action=show" class="selected">等级列表</a></li>
    <li><a href="level.php?action=add">新增等级</a></li>
    <?php if(@$this->_vars['update']){?>
        <li><a href="level.php?action=update">修改等级</a></li>
    <?php } ?>
</ol>
<?php if(@$this->_vars['show']){?>
<table cellspacing="0">
    <tr><th>编号</th><th>等级名称</th><th>备注</th><th>操作</th></tr>
    <?php foreach($this->_vars['AllLevel'] as $key=>$value){ ?>
        <tr>
            <td><?php echo $value->id ?> </td>
            <td><?php echo $value->level_name ?> </td>
            <td><?php echo $value->level_info ?> </td>
            <td><a href="?action=update&id=<?php echo $value->id ?> ">编辑</a> | <a href="?action=delete&id=<?php echo $value->id ?> " onclick="return confirm('你真的要删除吗')?true:false">删除</a></td>
        </tr>
    <?php } ?>
</table>
<p>[<a href="?action=add">新增等级</a>]</p>
<?php } ?>

<?php if(@$this->_vars['add']){?>
    <form method="post">
        <table cellspacing="0" class="left">
            <tr><td>等级名称：<input type="text" name="level_name" class="text" /></td></tr>
            <tr><td>等级备注：<textarea name="level_info" class="text" /></textarea></td></tr>
            <tr><td><input type="submit" name="send" value="新增等级" class="submit" /> [ <a href="level.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
<?php } ?>

<?php if(@$this->_vars['update']){?>
    <form method="post">
        <table cellspacing="0" class="left">
            <input type="hidden" value="<?php echo $this->_vars['id'] ?>" name="id">
            <tr><td>等级名称<input type="text"  name="level_name" value="<?php echo $this->_vars['level_name'] ?>" class="text" /></td></tr>
            <tr><td>等级备注：<textarea name="level_info" class="text" /><?php echo $this->_vars['level_info'] ?></textarea></td></tr>
            <tr><td><input type="submit" name="send" value="修改等级" class="submit" /> [ <a href="level.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
<?php } ?>

<?php if(@$this->_vars['delete']){?>
    删除页面
<?php } ?>
</body>
</html>