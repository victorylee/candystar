<?php /* Smarty version Smarty-3.1.20, created on 2015-04-26 14:13:19
         compiled from "/mnt/hgfs/website/candystar/application/admin/views/templates/home/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61955658955346493537169-70543205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca8a263679c35287185ba5cda260503e4b71a335' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/admin/views/templates/home/index.tpl',
      1 => 1429979470,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61955658955346493537169-70543205',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5534649366cd22_04967859',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5534649366cd22_04967859')) {function content_5534649366cd22_04967859($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/dialog/green/green.css" />
    <script type="text/javascript" src="/kit/dialog/jquery.artDialog.min.js"></script>
    <title>管理后台----用户登陆</title>
    <style type="text/less">
        .errorMsg{
            margin:10px 0px 10px 180px;
            color: #db4f33;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            var g_loginFormSubmited=false;
            $("#loginForm").submit(function(){
                if(g_loginFormSubmited==true){
                    alert("请不要重复提交！");
                    return false;
                }
                if(!$.validator($("#loginForm input[name='email']").val(),'required','邮箱不能为空'))
                    return false;
                if(!$.validator($("#loginForm input[name='pwd']").val(),'required','密码不能为空'))
                    return false;
                g_loginFormSubmited=true;
                $.post("/home/login",$("#loginForm").serializeObject(),function(jd){
                    g_loginFormSubmited=false;
                    if(jd.success){ //成功
                        location.href="/";
                    }else{  //失败
                        $('.errorMsg').text(jd.msg);
                    }
                },"json");
                return false;
            });
        });
    </script>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="row clearfix tac normal" style="width:700px;font-size: 40px;line-height: 40px;margin-top:50px;margin-bottom:40px;color: #666;">用户登陆</div>
<div class="row clearfix" style="width: 700px;padding:0px 0 30px;border-top:1px solid #ddd;border-bottom:1px solid #ddd;">
    <p class="errorMsg"></p>
    <form id="loginForm" method="post" class="mega" style="width: 330px;margin-left: 180px;">
        <label>账号：</label>
        <input type="text" name="email" style="width: 260px;" placeholder="邮箱、手机号"/><br/>
        <label>密码：</label>
        <input type="password" name="pwd" style="width: 260px;" placeholder="登陆密码"/><br/>
        <div class="clear" style="height: 10px;"></div>
        <div class="col" style="width: 150px;" ><input type="checkbox" checked/>记住我的登陆状态</div>
        <div class="col" style="width: 80px;margin-left: 100px;"><a href="javascript:void(0);">忘记密码？</a></div>
        <div class="clear" style="height: 20px;"></div>
        <button type="submit" class="bitbtn fs18 lh30 normal" style="width: 330px;">现在登陆</button>

        
            
            
            
            
        
    </form>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
</html>

<?php }} ?>
