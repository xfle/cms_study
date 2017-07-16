<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="../style/admin.css">
<script type="text/javascript" src="../js/admin_manage.js"></script>
<head>
    <title>main</title>
</head>
<body id="main">
<div class="map">
    管理首页&gt;&gt;管理员管理&gt;&gt;<?php echo $this->_vars['title'] ?>
</div>
<ol>
    <li><a href="manage.php?action=show&page=1" class="selected">管理员列表</a></li>
    <li><a href="manage.php?action=add">新增管理员</a></li>
    <?php if(@$this->_vars['update']){?>
        <li><a href="manage.php?action=update">修改管理员</a></li>
    <?php } ?>
</ol>
<?php if(@$this->_vars['show']){?>
<table cellspacing="0">
    <tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最近登录时间</th><th>操作</th></tr>
    <?php foreach($this->_vars['AllManage'] as $key=>$value){ ?>
        <tr>
            <td><?php echo $value->id ?> </td>
            <td><?php echo $value->admin_user ?> </td>
            <td><?php echo $value->level_name ?> </td>
            <td><?php echo $value->login_count ?> </td>
            <td><?php echo $value->last_ip ?> </td>
            <td><?php echo $value->last_time ?> </td>
            <td><a href="?action=update&id=<?php echo $value->id ?> ">编辑</a> | <a href="?action=delete&id=<?php echo $value->id ?> " onclick="return confirm('你真的要删除吗')?true:false">删除</a></td>
        </tr>
    <?php } ?>
</table>
   <div id="page"><?php echo $this->_vars['page'] ?></div>;
<?php } ?>

<?php if(@$this->_vars['add']){?>
    <form method="post">
        <table cellspacing="0" class="left">
            <tr><td>用 户 名：<input type="text" name="admin_user" class="text" /></td></tr>
            <tr><td>密　  码：<input type="password" name="admin_pass" class="text" /></td></tr>
            <tr><td>密码确认：<input type="password" name="admin_repass" class="text" /></td></tr>
            <tr><td>等　  级：<select name="level">
                        <?php foreach($this->_vars['Alllevel'] as $key=>$value){ ?>
                        <option value="<?php echo $value->id ?> "><?php echo $value->level_name ?> </option>
                        <?php } ?>
                    </select>
                </td></tr>
            <tr><td><input type="submit" name="send" value="新增管理员" class="submit" /> [ <a href="manage.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
<?php } ?>

<?php if(@$this->_vars['update']){?>
    <form method="post">
        <table cellspacing="0" class="left">
            <input type="hidden" value="<?php echo $this->_vars['id'] ?>" name="id">
            <input type="hidden" value="<?php echo $this->_vars['level'] ?>" id="level">
            <input type="hidden" value="<?php echo $this->_vars['pass'] ?>" name="pass">
            <tr><td>用户名：<input type="text" name="admin_user" value="<?php echo $this->_vars['admin_user'] ?>" class="text" readonly="readonly" /></td></tr>
            <tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
            <tr><td>等　级：<select name="level">
                        <?php foreach($this->_vars['Alllevel'] as $key=>$value){ ?>
                            <option value="<?php echo $value->id ?> "><?php echo $value->level_name ?> </option>
                        <?php } ?>
                    </select>
                </td></tr>
            <tr><td><input type="submit" name="send" value="修改管理员" class="submit" /> [ <a href="manage.php?action=show">返回列表</a> ]</td></tr>
        </table>
    </form>
<?php } ?>

<?php if(@$this->_vars['delete']){?>
    删除页面
<?php } ?>
</body>
</html>