<style type="text/less">
*{
    font-size: 14px;
    font-family:"Microsoft Yahei","微软雅黑",sans-serif;
}

.row{
    margin-left: auto;
    margin-right: auto;
    width: 980px;
}

.mega{
label{
    vertical-align: 2px;
    line-height: 40px;
    min-width: 50px;
    display: inline-block;
}
textarea,input[type='text'],input[type='password']{
    display:inline-block;
    height:18px;
    padding:5px;
    line-height:18px;
    /*line-height: 150%;*/
    color:#333;
    vertical-align:2px;
    background-color:#fff;
    border:1px solid #ccc;
.box-shadow(0 1px 1px rgba(0,0,0,0.075) inset);
.transition(border linear .2s);
.transition(box-shadow linear .2s);
&:hover{
     border-color: rgba(82,168,236,0.8);
 .box-shadow(0 0 8px rgba(82,168,236,.6));
 }
}
}

#header{
    background:#FFF;
.user{
    float: right;
    text-align: right;
    padding-right:10px;
    color:#f23;
    line-height:100px;
a{
    margin: 0 5px;
    color: #666;
}
.spliter{
    border-left: 1px dotted #7B7C7D;
    margin: 0 5px;
}
}
}
#navbar{
    width:100%;
    background-color: #303a40;
.nav{
    font-size:16px;
a{
    padding: 0 20px;;
    border-style:none;
    border-width:0;
    color:#FFF;
    cursor:pointer;
    display:inline-block;
    line-height: 40px;
    height: 40px;
    text-align:center;
    text-decoration:none;
&.selected{
     background-color:#E70;
 }
&:hover{
     background-color:#E70;
 }
i.new{
    position: absolute;
    background: url(/images/new_orange.png) no-repeat;
    margin-top:0;
    margin-right: 0;
    display: inline-block;
    width: 20px;
    height: 20px;
    line-height: 20px;
}
}
}
.phone{
    line-height: 40px;
    color: #FFF;
    font-size: 18px;
    text-align: center;
    transition: all .2s ease-in-out;
    font-style: italic;
&:hover{
 .transform(scale(1.2, 1.2));
 }
}
}

ul.mainmenu {
    font-size:16px;
    list-style:none;
ul{
    list-style:none;
    margin:0;
    padding:0px;
li{
    float:none;
    margin:0;
    background-color:transparent;
}
li:hover > a{
    background-color: #327ea8;
    border-style:none;
    color:#FFF;
    text-decoration:none;
}
a{
    background:#303a40;
    color:#FFF;
    font-size:12px;
    padding:10px 10px 10px 20px;
    text-align:left;
    text-decoration:none;
}
span{
    /*background-image:url("../images/arrow.png");
    padding-right:10px;*/
    float:right;
}
.subs{
    left:110px;
    position:absolute;
    top:0;
}
}
li{
    display:block;
    float:left;
    font-size:0;
    white-space:nowrap;
    margin:0 3px 0 0;
    background-color:transparent;
}
li:hover{
    position:relative;
}
li:hover > .subs{
    display: block;
}
li:hover > a{
    background-color: #327ea8;
    border-style:none;
    color:#FFF;
    text-decoration:none;
}
a{
    width:80px;
    line-height: 20px;
    border-style:none;
    border-width:0;
    color:#FFF;
    cursor:pointer;
    display:block;
    font-size:16px;
    text-align: center;
    padding:10px 10px;
    text-decoration:none;
    vertical-align:middle;
&.selected{
     background-color:#327ea8;
 }
}
a:active,a:focus{
    outline-style:none;
}
img{
    border:none;
    margin-right:8px;
    vertical-align:middle;
}
.subs{
    background-color: #303a40;
    display:none;
    left:0;
    position:absolute;
    top:100%;
    z-index: 100;
a {
    border-top: solid 1px #f90;
&:hover{
     border-top: solid 1px #f90;
 }
}
}
}

#toolbar{
a.button{
    margin-top:5px;
    color:#FFF;
    display: inline-block;
    width: 80px;
    text-align: center;
    font-size: 16px;
    border-radius: 3px;
    background: #3879D9;
    height: 30px;
    line-height: 30px;
    font-weight: 400;
}
}

a.edit{
    width: 18px;
    height: 18px;
    margin-top: 5px;
    margin-right: 5px;
    display: inline-block;
    background: url(/images/edit.png) no-repeat;
}
a.remove{
    width: 18px;
    height: 18px;
    margin-top: 5px;
    margin-right: 5px;
    display: inline-block;
    background: url(/images/remove.png) no-repeat;
}

</style>
<div id="header">
    <div class="row clearfix">
        <div class="col"><a href="javascript:void(0);"><img src="/images/logo_240.png" style="width: 132px;"/></a></div>
        <div class="col user">
            {if isset($emp)}
                <span id="comname" class="mr10">{$emp->name}</span>
                <span class="spliter"></span>
                <a href="javascript:void(0);" class="password">修改密码</a>
                <span class="spliter"></span>
                <a href="/workspace/logout" style="; margin-left: 10px;">注销</a>
            {/if}
        </div>
    </div>
</div>


<div id="navbar">
    <div class="row clearfix">
        {if isset($emp)}
            <ul class="mainmenu"></ul>
        {/if}
    </div>
</div>

<script type="text/javascript">
    var privilegeList={if isset($privilegeList)}{$privilegeList}{else}new Array(){/if};
    var cur={if isset($module)}'{$module}'{else}''{/if};
    var strHtml="";
    for(var i=0;i<privilegeList.length;i++){
        if(privilegeList[i].level==1){
            if(privilegeList[i].url==''){
                if(cur==privilegeList[i].id){
                    strHtml="<li><a href='javascript:;' class='selected' id='"+privilegeList[i].id+"'>"+privilegeList[i].name+"</a></li>";
                }else{
                    strHtml="<li><a href='javascript:;' id='"+privilegeList[i].id+"'>"+privilegeList[i].name+"</a></li>";
                }
            }
            else{
                if(cur==privilegeList[i].id){
                    strHtml="<li><a href='"+privilegeList[i].url+"' class='selected' id='"+privilegeList[i].id+"'>"+privilegeList[i].name+"</a></li>";
                }else{
                    strHtml="<li><a href='"+privilegeList[i].url+"' id='"+privilegeList[i].id+"'>"+privilegeList[i].name+"</a></li>";
                }
            }
            $(".mainmenu").append(strHtml);
        }
    }
    for(var i=0;i<privilegeList.length;i++){
        if(privilegeList[i].level==2){
            if($("#"+privilegeList[i].pid).parent().find("div.subs").length==0){
                strHtml="<div class='subs'><ul></ul></div>";
                $("#"+privilegeList[i].pid).parent().append(strHtml);
            }
            if(privilegeList[i].url=='')
                strHtml="<li><a href='javascript:;'  id='"+privilegeList[i].id+"'><span>&gt;</span>"+privilegeList[i].name+"</a></li>";
            else
                strHtml="<li><a href='"+privilegeList[i].url+"'  id='"+privilegeList[i].id+"'>"+privilegeList[i].name+"</a></li>";
            $("#"+privilegeList[i].pid).parent().find("div.subs ul").first().append(strHtml);
        }
    }

    $('.password').live('click',function(){
        var empid = $.cookie('empid');
        $.dialog({
            id:'passwordDialog',
            content:$("#passwordDialogTemplate").html(),
            fixed:true,
            ok:function(){
                if(!$.validator($("#pwddata input[name='oldpwdhash']").val(),'required','请输入旧密码'))
                    return false;
                if(!$.validator($("#pwddata input[name='newpwdhash']").val(),'required','请输入新密码'))
                    return false;
                if(!$.validator($("#pwddata input[name='rpwdhash']").val(),'required','请再次输入新密码'))
                    return false;
                var oldpwdhash = $.trim($('input[name="oldpwdhash"]').val());
                var newpwdhash = $.trim($('input[name="newpwdhash"]').val());
                var rpwdhash = $.trim($('input[name="rpwdhash"]').val());
                if(newpwdhash!=rpwdhash){
                    $.alert('两次输入的新密码不一致');
                    return false;
                }else{
                    $.post('/home/changePassword',{ empid:empid,oldpwdhash:oldpwdhash,newpwdhash:newpwdhash},function(jd){
                        if(jd.success){
                            $.alert('密码修改成功');
                            $.dialog.list['passwordDialog'].close();
                        }else{
                            $.alert(jd.data);
                        }
                    },'json')
                }
                return false;
            },
            cancel:function(){ },
            initialize:function(){

            }
        });
    });
    $("#pageindex").live("keyup",function(){
        if(event.keyCode == 13){
            findpage($(this).val());
        }
    });
</script>

<script type="text/template" id="passwordDialogTemplate">
    <div id="passwordDdialog" style="height: 130px;padding: 5px;">
        <form id="pwddata">
            <input type="password" name='oldpwdhash' id="oldpwdhash" style="height: 20px;width: 270px;" placeholder="请输入旧密码"/><p style="color: #c00;"></p><br/>
            <input type="password" name="newpwdhash" id="newpwdhash" style="height: 20px;width: 270px;" placeholder="请输入新密码"/><p style="color: #c00;"></p><br/>
            <input type="password" name="rpwdhash" style="height: 20px;width: 270px;" placeholder="请再次输入新密码"/><p style="color: #c00;"></p><br/>
        </form>
    </div>

</script>