<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
{include file="header.tpl"}

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

        {*<table width="100%">*}
            {*<tr height="30"><td width="20%" align="right">帐号：</td><td width="80%"><input type="text" name="email" style="width: 330px;" placeholder="请输入您的登陆账号：邮箱、手机号"/></td></tr>*}
            {*<tr><td align="right">密码：</td><td></td></tr>*}
            {*<tr><td colspan="2" align="center" class="msg" style="color:red;font-weight: bold;"></td></tr>*}
            {*<tr><td colspan="2" align="center"><input type="submit" value="登&nbsp;&nbsp;&nbsp;&nbsp;录"/>&nbsp;&nbsp;&nbsp;<a href="#">忘记密码?</a></td></tr>*}
        {*</table>*}
    </form>
</div>

{include file="footer.tpl"}
</body>
</html>

