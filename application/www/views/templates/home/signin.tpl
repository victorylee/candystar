<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="课糖,超级星探,数学,理科">
    <meta name="description" content="超级星探是中国目前唯一专注于中学理科在线教育的服务系统，拥有正确且海量的题库，高效且有趣的习题模式、人性化的家长督学报告，智能化的学校评估体系、特级名师教学微视频，全方位满足教师、学生、家长、学校需求。"/>
    <meta name="renderer" content="webkit">
    <link href="/images/favicon.ico" rel="icon">
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <title>超级星探 - 登录</title>
    <style type="text/less">
        #loginForm{
            margin-left: 130px;
            .item{
                height: 54px;
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
                    line-height: 28px;
                    color: #333;
                    vertical-align: middle;
                .border-radius(0);
                    outline: none;
                    background-color: #ffffff;
                    border: 1px solid #cccccc;
                .box-shadow(0 1px 1px rgba(0,0,0,0.075) inset);
                .transition(border linear .2s);
                .transition(box-shadow linear .2s);
                &:focus{
                     border-color: rgba( 82,168,236,0.8);
                     border-color: #0866c6\9;
                     outline: 0;
                 .box-shadow(0 0 8px rgba(82,168,236,.6));
                 }
                }
                .error{
                    padding-left: 10px;
                    line-height: 41px;
                    display: inline-block;
                    top: 7px;
                    text-align: left;
                    width: 160px;
                    color: #db4f33;
                    font-size: 12px;
                }
            }
        }
    </style>
</head>

<body>
{$module='signin'}
{include file="header.tpl"}
<h1 class="tac normal lh40 yahei" style="width:1000px;margin:0px auto;color: #666;font-size: 40px;padding-top:50px;padding-bottom:40px;border-bottom: 1px solid #ddd;">用户登录</h1>
<div class="row clearfix mb30" style="width: 800px;padding:40px 0;">
    <form id="loginForm" method="post">
        <div class="item">
            <label class="label">注册账号</label><input type="text" name="account" placeholder="用户名/手机号"/><span class="error"></span>
        </div>
        <div class="item">
            <label class="label">登录密码</label><input type="password" name="pwdhash" placeholder="您的登录密码"/><span class="error"></span>
        </div>
        <div class="fs12 mb10">
            <input type="checkbox" checked style="vertical-align: -2px;margin-left: 76px;"/>记住我的登录状态
        </div>
        <button type="submit" class="bitbtn fs18 lh30 normal tac" style="width: 342px;border: none;margin-left: 78px;">现在登录</button>
    </form>
</div>
{include file="footer.tpl"}
</body>
<script type="text/javascript">
    $(document).ready(function(){
        var g_loginFormSubmited=false;
        $("#loginForm").submit(function(){
            if(g_loginFormSubmited==true){
                alert("请不要重复提交！");
                return false;
            }
            if(!$.validator($("#loginForm input[name='account']").val(),'required')){
                $("#loginForm input[name='account']").next(".error").text("请输入用户名/手机号");
                return false;
            }else{
                $("#loginForm input[name='account']").next(".error").text("");
            }
            if(!$.validator($("#loginForm input[name='pwdhash']").val(),'required')){
                $("#loginForm input[name='pwdhash']").next(".error").text("请输入密码");
                return false;
            }else{
                $("#loginForm input[name='pwdhash']").next(".error").text("");
            }
            g_loginFormSubmited=true;
            $.post("/home/login",$("#loginForm").serializeObject(),function(jd){
                g_loginFormSubmited=false;
                var url = {if isset($http_referer)}'{$http_referer}'{else}""{/if};
                if(jd.success == 1){ //成功
                    if(url!='')
                        location.href=url;
                    else{
                        if(jd.tp == '004001')
                            location.href = '/job';
                        else
                            location.href = '/worker';
                    }
                }else if(jd.success == -1){  //失败
                    $("#loginForm input[name='account']").next(".error").text("用户名不存在");
                }else if(jd.success == -2){  //失败
                    $("#loginForm input[name='pwdhash']").next(".error").text("密码错误");
                }
            },"json");
            return false;
        });
    });
</script>
</html>

