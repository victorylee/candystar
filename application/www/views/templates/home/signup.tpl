<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="超级星探">
    <meta name="description" content=""/>
    <meta name="renderer" content="webkit">
    <link href="/images/favicon.ico" rel="icon">
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <title>超级星探 - 注册</title>
    <style type="text/less">
        #signupForm{
            margin-left: 130px;
            .item{
                height:54px;
                .label{
                    display: inline-block;
                    width: 67px;
                    color: #333;
                    font-size: 12px;
                    line-height: 40px;
                    text-align: right;
                    padding-right: 10px;
                }
                input[type="text"],input[type="password"]{
                    display: inline-block;
                    width: 330px;
                    height: 28px;
                    padding: 5px;
                    line-height: 18px;
                    color: #333;
                    vertical-align: middle;
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    border-radius: 0;
                    outline: none;
                    background-color: #ffffff;
                    border: 1px solid #cccccc;
                    .transform(border linear .2s);
                    .transform(box-shadow linear .2s);
                    .border-radius(0);
                    .inner-shadow(0 1px 1px rgba(0,0,0,0.075));
                    &:focus{
                         border-color: rgba( 82,168,236,0.8);
                         border-color: #0866c6\9;
                         outline: 0;
                     .inner-shadow(0 1 px 1 px rgba(0, 0, 0, 0.075));
                     .inner-shadow(0 0 8 px rgba( 82, 168, 236, 0.6));
                     }
                }
                .error{
                    padding-left: 10px;
                    line-height: 41px;
                    display: inline-block;
                    top: 7px;
                    text-align: left;
                    width: 190px;
                    color: #db4f33;
                    font-size: 12px;
                }
                .tp{
                    display: inline-block;
                    width: 100px;
                    height: 36px;
                    line-height: 36px;
                    text-align: center;
                    border: 1px solid #CCC;
                    cursor: pointer;
                    &.selected{
                        background-color: #2b65e2;
                        color: #FFF;
                     }
                }
            }
        }
    </style>
    <script type="text/javascript">
        var g_signupFormSubmited=false;
        $(document).ready(function(){
            $(".tp").live("click",function(){
                $(".tp").each(function(){
                    $(this).removeClass("selected");
                    $(this).children("input").attr("checked",false);
                });
                $(this).addClass("selected");
                $(this).children("input").attr("checked",true);
            });

            $("#register").live('click',function(){
                if(g_signupFormSubmited==true){
                    alert("请不要重复提交！");
                    return false;
                }
                $('.error').empty();
                var tp = $("#signupForm input[name='tp']:checked").val();
                var account = $.trim($("#signupForm input[name='account']").val());
                if(!$.validator(account,'req')){
                    $("#signupForm input[name='account']").next(".error").html("请输入您的用户名");
                    return false;
                }
                var regex=/^[A-Za-z0-9_]+$/ig;
                if(!account.match(regex)){
                    $("#signupForm input[name='account']").next('.error').html('用户名只能由数字、字母或下划线');
                    return false;
                }
                if(account.length <4 || account.length >16){
                    $("#signupForm input[name='raccount']").next('.error').html('用户名只能输入4-16个字符');
                    return false;
                }

                var name = $.trim($("#signupForm input[name='name']").val());
                if(!$.validator(name,'req')){
                    $("#signupForm input[name='name']").next('.error').html('请输入您的姓名');
                    return false;
                }

                var pwdhash = $.trim($("#signupForm input[name='pwdhash']").val());
                if(!$.validator(pwdhash,'req')){
                    $("#signupForm input[name='pwdhash']").next('.error').html('请输入密码');
                    return false;
                }else if(pwdhash.length<6||pwdhash.length>16){
                    $("#signupForm input[name='pwdhash']").next('.error').html('请输入6-16位的字符');
                    return false;
                }
                var rpwdhash = $.trim($("#signupForm input[name='rpwdhash']").val());
                if(!$.validator(rpwdhash,'req')){
                    $("#signupForm input[name='rpwdhash']").next('.error').html('请输入确认密码');
                    return false;
                }
                if(pwdhash != rpwdhash){
                    $("#signupForm input[name='rpwdhash']").next('.error').html('两次密码不一致');
                    return false;
                }

                var mobile = $.trim($("#signupForm input[name='mobile']").val());
                if((!$.validator(mobile,'req')) || (!$.validator(mobile,'phone')) ){
                    $("#signupForm input[name='mobile']").next('.error').html('请输入正确的手机号码');
                    return false;
                }

                if($.trim($("#signupForm input[name='agree']").attr("checked")) == ''){
                    $('.agree_error').html('请仔细阅读并同意条款');
                    return false;
                }

                g_signupFormSubmited=true;
                $.post("/home/register",$("#signupForm").serializeObject(),function(data){
                    g_signupFormSubmited=false;
                    if(data.success){ //成功
                        if(tp == '004001'){ //艺人
                            location.href = '/job';
                        }else{
                            location.href = '/worker';
                        }
                    }else{  //失败
                        $("#signupForm input[name='account']").next('.error').html(data.msg);
                    }
                },"json");
            });
        });
    </script>

</head>

<body>
{$module='signup'}
{include file="header.tpl"}
<h1 class="tac normal lh40 yahei" style="width:1000px;margin:0px auto;color: #666;font-size: 40px;padding-top:50px;padding-bottom:40px;border-bottom: 1px solid #ddd;">新用户注册</h1>
<div class="row clearfix yahei" style="width: 800px;{if !isset($errMessage)}padding-top:40px;{/if}">
    <form id="signupForm" method="post">
        {if isset($errMessage)}
            <p style="color:#db4f33;display: block;margin-left: 180px;" class="mt20 mb20">{$errMessage}</p>
        {/if}
        <div class="item">
            <label class="label">身份</label>
            <label for="worker" class="tp selected"><input type="radio" name="tp" value="004001" id="worker" checked="checked" style="display: none;"/>艺人</label>
            <label for="broker" class="tp"><input type="radio" name="tp" value="004002" id="broker" style="display: none;"/>经纪人</label>
            <span class="error"></span>
        </div>
        <div class="item">
            <label class="label">用户名</label><input type="text" name="account" placeholder="请输入用户名，由字母、数字或下划线组成" maxlength="16"/><span class="error"></span>
        </div>
        <div class="item">
            <label class="label">您的姓名</label><input type="text" name="name" placeholder="请输入您的姓名" maxlength="16"/><span class="error"></span>
        </div>
        <div class="item">
            <label class="label">登录密码</label><input type="password" name="pwdhash"  placeholder="请输入您的登录密码"/><span class="error"></span>
        </div>
        <div class="item">
            <label class="label">确认密码</label><input type="password" name="rpwdhash"  placeholder="请再次确认登录密码"/><span class="error"></span>
        </div>
        <div class="item">
            <label class="label">手机号码</label><input type="text" name="mobile"  placeholder="请输入您的手机号码"/><span class="error"></span>
        </div>
        <div class="item fs12">
            <input id="agree" name="agree" type="checkbox" checked style="margin-left: 75px;">
            <div style="display: inline-block;"><label for="agree" style="width: 130px;">我已认真阅读并同意</label><a href="/home/service.html" target="_blank" style="font-size: 12px;color: #08c;">《超级星探用户服务协议》</a></div>
            <span class="error agree_error" style="padding-left: 25px;"></span>
        </div>
        <a id="register" href="javascript:void(0);" class="bitbtn fs18 lh30 normal tac" style="width: 342px;border: none;margin-left: 78px;">创建账号</a>
    </form>
</div>

<div class="row clearfix tac mt20 mb20 fs14" style="width: 330px;" >已有账号。<a href="/home/signin">直接登录</a></div>
{include file="footer.tpl"}
</body>
</html>

