<?php /* Smarty version Smarty-3.1.20, created on 2015-04-26 17:21:08
         compiled from "/mnt/hgfs/website/candystar/application/admin/views/templates/users/broker.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1595375365553ba2b6897b35-28075323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2345463d14cc44492df59c96570742796f0fc37b' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/admin/views/templates/users/broker.tpl',
      1 => 1430040067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1595375365553ba2b6897b35-28075323',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_553ba2b6c6c137_98903459',
  'variables' => 
  array (
    'statusList' => 0,
    'levelList' => 0,
    'sexList' => 0,
    'skillList' => 0,
    'businessList' => 0,
    'provinceList' => 0,
    'cityList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553ba2b6c6c137_98903459')) {function content_553ba2b6c6c137_98903459($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>管理后台--经纪人</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <link rel="stylesheet" type="text/css" href="/kit/dialog/green/green.css" />
    <link rel="stylesheet" type="text/css" href="/kit/grid/default/default.css" />
    <link rel="stylesheet" type="text/css" href="/kit/datepicker/1.3.2/jquery.calendar.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <script type="text/javascript" src="/kit/grid/jquery.grid.min.js"></script>
    <script type="text/javascript" src="/kit/tabify/1.5/jquery.tabify.js"></script>
    <script type="text/javascript" src="/kit/dialog/jquery.artDialog.min.js"></script>
    <script type="text/javascript" src="/kit/datepicker/1.3.2/jquery.calendar.js"></script>
    <style type="text/less">
        #menu {
            padding: 0;
            li {
                display: inline;
                a {
                    background: #333;
                    padding: 10px;
                    float:left;
                    border-bottom: none;
                    text-decoration: none;
                    color: #FFF;
                }
                &.active{
                    a{
                        color: #333;
                        background: #FFF;
                    }
                 }
            }
        }
        .content {
            clear: both;
            border: 1px solid #FFF;
            border-top: none;
            border-left: none;
            background: #FFF;
            padding: 10px 20px 20px;
            width: 660px;
        }

        .info,#contentBasic,#contentExp,#contentJob{
            table{
                border-bottom: 2px solid #000;
                tr{
                    td{
                        height: 40px;
                        line-height: 40px;
                        border-bottom:1px solid #CCC;
                    }
                }
            }
        }
        form{
            label{
                display: inline-block;
                width: 100px;
                text-align: right;
            }
            input{
                width:300px;
            }
        }
    </style>
    <script type="text/javascript">
        var statusList = <?php echo $_smarty_tpl->tpl_vars['statusList']->value;?>
;
        var levelList = <?php echo $_smarty_tpl->tpl_vars['levelList']->value;?>
;
        var sexList = <?php echo $_smarty_tpl->tpl_vars['sexList']->value;?>
;
        var skillList = <?php echo $_smarty_tpl->tpl_vars['skillList']->value;?>
;
        var businessList = <?php echo $_smarty_tpl->tpl_vars['businessList']->value;?>
;
        var provinceList = <?php echo $_smarty_tpl->tpl_vars['provinceList']->value;?>
;
        var cityList = <?php echo $_smarty_tpl->tpl_vars['cityList']->value;?>
;
        var g_mainFormSubmited=false;
        var g_mainGrid;

        function mainFormSubmit() {
            if(g_mainFormSubmited==true){
                $.alert("请不要重复提交！");
                return false;
            }

            if(!$.validator($("#basicForm input[name='account']").val(),'required','账号不能为空'))
                return false;
            if(!$.validator($("#basicForm input[name='name']").val(),'required','姓名不能为空'))
                return false;
            if(!$.validator($("#basicForm input[name='email']").val(),'required','邮箱不能为空'))
                return false;
            if(!$.validator($("#basicForm input[name='email']").val(),'email','邮箱格式不正确'))
                return false;
            if(!$.validator($("#basicForm input[name='mobile']").val(),'required','手机号不正确'))
                return false;
            if(!$.validator($("#basicForm input[name='mobile']").val(),'phone','手机号格式错误'))
                return false;

            g_mainFormSubmited=true;
            $.post("/users/broker/saveOrUpdate",$("#basicForm").serializeObject(),function(jd){
                g_mainFormSubmited=false;
                if(jd.success){ //成功
                    g_mainGrid.load();
                    $.dialog.list['mainFormDialog'].close();
                }else{  //失败
                    $.alert(jd.msg);
                }
            },"json");
            return false;
        }

        function getValue(arr,index){
            var result = '';
            arr.forEach(function(e){
                if(e["id"] == index){
                    result = e["name"]
                }
            });
            return result;
        }

        $(document).ready(function(){

            g_mainGrid=$("#mainGrid").grid({
                key: 'id',
                pagerLength:5,
                loader: {
                    url: '/users/broker/findSome',
                    params: { pageNo: 1, pageSize: 15 },
                    autoLoad: true
                },
                afterLoad:function(dd){
                    //修改
                    $("a.edit").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.post("/users/broker/findOne",{ id:id},function(jd){
                            $.dialog({
                                id:'mainFormDialog',
                                content:$("#mainFormDialogTemplate").html(),
                                fixed:true,
                                ok:mainFormSubmit,
                                cancel:function(){},
                                initialize:function(){
                                    for(var i=0;i<provinceList.length;i=i+1){
                                        $("select[name='provinceid']").append("<option value='"+provinceList[i].id+"'>"+provinceList[i].name+"</option>");
                                    }
                                    for(var i=0;i<cityList.length;i=i+1){
                                        $("select[name='cityid']").append("<option value='"+cityList[i].id+"'>"+cityList[i].name+"</option>");
                                    }
                                    for(var i=0;i<statusList.length;i=i+1){
                                        $("select[name='status']").append("<option value='"+statusList[i].id+"'>"+statusList[i].name+"</option>");
                                    }
                                    for(var i=0;i<levelList.length;i=i+1){
                                        $("select[name='level']").append("<option value='"+levelList[i].id+"'>"+levelList[i].name+"</option>");
                                    }

                                    $("select[name='cityid']").empty().append("<option value=''>全部</option>");
                                    $.post("/admin/common/findSubRegion",{ pid:jd.data.provinceid},function(jsonData){
                                        for(var i=0;i<jsonData.length;i=i+1){
                                            if(jd.data.cityid == jsonData[i].id)
                                                $("select[name='cityid']").append("<option value='"+jsonData[i].id+"' selected>"+jsonData[i].name+"</option>");
                                            else
                                                $("select[name='cityid']").append("<option value='"+jsonData[i].id+"'>"+jsonData[i].name+"</option>");
                                        }
                                    },"json");


                                    $("#basicForm").find("input[name='id']").val(jd.data.id);
                                    $("#basicForm").find("input[name='account']").val(jd.data.account);
                                    $("#basicForm").find("input[name='name']").val(jd.data.name);
                                    $("#basicForm").find("input[name='email']").val(jd.data.email);
                                    $("#basicForm").find("input[name='mobile']").val(jd.data.mobile);
                                    $("#basicForm").find("select[name='provinceid']").val(jd.data.provinceid);
                                    $("#basicForm").find("input[name='point']").val(jd.data.point);
                                    $("#basicForm").find("select[name='status']").val(jd.data.status);
                                    $("#basicForm").find("select[name='level']").val(jd.data.brokerlevel);

                                }
                            });
                        },"json");
                    });

                    //删除
                    $("a.remove").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.confirm('您确定要删除选中的记录吗?',
                                function () {
                                    $.post("/users/broker/delete",{ id:id},function(jd){
                                        if (jd.success) {
                                            g_mainGrid.load();
                                            $.dialog.list['Confirm'].close();
                                        } else {
                                            $.alert(jd.msg);
                                        }
                                    },"json")
                                    return false;
                                },function(){}
                        );
                    });
                },
                cols : [
                    { title : '操作', width: 50,
                        render:function(r){
                            return "<a href='javascript:;' class='edit' title='修改' rowid='"+ r.id+"'></a>"+"<a href='javascript:;' class='remove' title='删除' rowid='"+ r.id+"'></a>";
                        }
                    },
                    { field: 'id', title : 'ID', width: 60,sort : true},
                    { field: 'account', title : '用户名', width: 130},
                    { field: 'name', title : '姓名', width: 100},
                    { field: 'email', title : '邮箱', width: 180},
                    { field: 'mobile', title : '手机', width: 120},
                    { field: 'status', title : '状态', width: 60,
                        render:function(r,td){
                            var result = '';
                            statusList.forEach(function(e){
                                if(e["id"] == r.status){
                                    result = e["name"]
                                }
                            });
                            return result;
                        }
                    },
                    { title : '操作', width: 220,
                        render:function(r){
                            var result = "<a href='javascript:;' class='pwdhash' rowid='"+ r.id+"'>重置密码</a>";
                            result += "<a href='javascript:;' class='status ml5' rowid='"+ r.id+"' status='003002'>禁用</a>";
                            result += "<a href='javascript:;' class='status ml5' rowid='"+ r.id+"' status='003003'>开通</a>";
                            result += "<a href='javascript:;' class='detail ml5' rowid='"+ r.id+"'>查看详情</a>";
                            return result;
                        }
                    },
                    { field: 'cts', title : '加入时间', width: 180}
                ]
            });

            //重置密码
            $(".pwdhash").live("click",function(){
                var id=$(this).attr('rowid');console.log(id)
                $.confirm('您确定要重置该用户密码吗?',
                        function () {
                            $.post("/users/broker/resetPassword",{ id:id},function(data){
                                if (data ==1) {
                                    $.dialog.list['Confirm'].close();
                                } else {
                                    $.alert("重置失败");
                                }
                            },"text")
                            return false;
                        },function(){}
                );
            });
            //状态修改
            $(".status").live("click",function(){
                var id=$(this).attr('rowid');
                var status=$(this).attr('status');
                $.confirm('您确定要修改该用户的状态吗?',
                        function () {
                            $.post("/users/broker/changeStatus",{ id:id,status:status},function(data){
                                if (data == 1) {
                                    $.dialog.list['Confirm'].close();
                                } else {
                                    $.alert("修改失败");
                                }
                            },"text")
                            return false;
                        },function(){}
                );
            });
            //详情
            $(".detail").live('click',function(){
                var id=$(this).attr('rowid');
                $.post("/users/broker/detail",{ id:id},function(jd){
                    $.dialog({
                        id:'mainFormDialog',
                        content:$("#detailDialogTemplate").html(),
                        fixed:true,
                        ok:mainFormSubmit,
                        cancel:function(){},
                        initialize:function(){
                            $('#menu').tabify();
                            $(".account").html(jd.account);
                            $(".name").html(jd.name);
                            $(".email").html(jd.email);
                            $(".region").html(jd.ancestornames+jd.regionname);
                            $(".mobile").html(jd.mobile);
                            $(".status").html(getValue(statusList,jd.status));
                            $(".level").html(getValue(levelList,jd.level));
                            $(".cts").html(jd.cts);

                            //工作城市
                            var business = jd.business;
                            for(var i=0;i<business.length;i++){
                                $("#contentBusiness").append("<span style='margin-right:10px;'>"+getValue(businessList,business[i].business)+"</span>");
                            }
                            //工作经历
                            var cases = jd.cases;
                            for(var i=0;i<cases.length;i++){
                                var html='';
                                html+='<table>';
                                html+='<tr><td style="width: 100px;">开始日期</td><td style="width:300px;">'+(cases[i].startmonth).substr(0,7)+'</td><td style="width: 80px;">结束日期</td><td style="width: 300px;">'+(cases[i].endmonth).substr(0,7)+'</td></tr>';
                                var data = eval("("+cases[i].dcd+")");
                                html+='<tr><td>作品</td><td colspan="3">'+data.result+'</td></tr>';
                                html+='<tr><td>工作描述</td><td colspan="3">'+data.description+'</td></tr>';
                                html+='</table>';
                                $("#contentExp").append(html);
                            }
                            //工作招聘
                            var jobs = jd.jobs;
                            for(var i=0;i<jobs.length;i++){
                                var html='';
                                html+='<table>';
                                html+='<tr><td style="width: 100px;">开始日期</td><td style="width:300px;">'+(jobs[i].startdate).substr(0,7)+'</td><td style="width: 80px;">结束日期</td><td style="width: 300px;">'+(jobs[i].enddate).substr(0,7)+'</td></tr>';
                                html+='<tr><td style="width: 100px;">角色</td><td style="width:300px;">'+getValue(skillList,jobs[i].skill)+'</td><td style="width: 80px;">性别</td><td style="width: 300px;">'+getValue(sexList,jobs[i].sex)+'</td></tr>';
                                html+='<tr><td style="width: 100px;">招聘人数</td><td style="width:300px;">'+jobs[i].quantity+'</td><td style="width: 80px;">薪水</td><td style="width: 300px;">'+jobs[i].salary+'元/天</td></tr>';
                                html+='<tr><td style="width: 100px;">作品</td><td style="width:300px;">'+jobs[i].name+'</td></tr>';
                                html+='<tr><td>工作描述</td><td colspan="3">'+jobs[i].description+'</td></tr>';
                                html+='</table>';
                                $("#contentJob").append(html);
                            }
                            //照片
                            var images = eval("("+jd.dcd+")");
                            if(images.img)
                                $("#contentImg").append("<img src='"+images.img+"' style='margin-right: 15px;margin-bottom:10px;' title='头像'/>");
                        }
                    });
                },"json");
            });
            $("select[name='provinceid']").live("change",function(){
                var pid = $(this).val();
                $("select[name='cityid']").empty().append("<option value=''>全部</option>");
                $.post("/admin/common/findSubRegion",{ pid:pid},function(jd){
                    for(var i=0;i<jd.length;i=i+1){
                        $("select[name='cityid']").append("<option value='"+jd[i].id+"'>"+jd[i].name+"</option>");
                    }
                },"json");
            });
        });
    </script>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="row clearfix" style="width:1100px;overflow: hidden;">
    <div style="height: 460px;" class="mt50">
        <div id="mainGrid" class="grid"></div>
    </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
</html>
<script type="text/template" id="detailDialogTemplate">
    <div>
        <ul id="menu">
            <li class="active"><a href="#contentBasic">基本资料</a></li>
            <li><a href="#contentBusiness">经纪类型</a></li>
            <li><a href="#contentExp">工作经历</a></li>
            <li><a href="#contentJob">招聘职位</a></li>
            <li><a href="#contentImg">照片</a></li>
        </ul>
        <div class="content" id="contentBasic">
            <table class="info" style="width: 100%;">
                <tr><td style="width: 60px;">用户名:</td><td class="account" style="width: 150px;"></td><td style="width: 60px;">姓名:</td><td class="name" style="width:150px;"></td></tr>
                <tr><td>邮箱:</td><td class="email"></td><td>手机:</td><td class="mobile"></td></tr>
                <tr><td>地区:</td><td class="region"></td><td>状态:</td><td class="status"></td></tr>
                <tr><td>级别:</td><td class="level"></td><td>加入时间:</td><td class="cts"></td></tr>
            </table>
        </div>
        <div class="content" id="contentBusiness" style="display: none;min-height: 100px;">

        </div>
        <div class="content" id="contentExp" style="display: none;min-height: 100px;">

        </div>
        <div class="content" id="contentJob" style="display: none;min-height: 100px;">

        </div>
        <div class="content" id="contentImg" style="display: none;min-height: 100px;">

        </div>
    </div>

</script>
<script type="text/template" id="mainFormDialogTemplate">
    <form id="basicForm" class="mega">
        <input type="hidden" name="id"/>
        <label>账号：</label><input name="account" type="text"/><br/>
        <label>密码：</label><input name="pwdhash" type="password"/><br/>
        <label>姓名：</label><input name="name" type="text"/><br/>
        <label>邮箱：</label><input name="email" type="text"/><br/>
        <label>手机：</label><input name="mobile" type="text"/><br/>
        <label>地区：</label><select name="provinceid"></select><select name="cityid"></select><br/>
        <label>点数：</label><input name="point" type="text"/><br/>
        <label>级别：</label><select name="level"></select><br/>
        <label>状态：</label><select name="status"></select><br/>
    </form>
</script>

<?php }} ?>
