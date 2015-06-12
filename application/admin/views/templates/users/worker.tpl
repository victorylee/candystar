<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>管理后台--艺人</title>
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

        .info,#contentBasic,#contentDetail,#contentExp{
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
        var statusList = {$statusList};
        var typeList = {$typeList};
        var skillList = {$skillList};
        var hairList = {$hairList};
        var constellationList = {$constellationList};
        var degreeList = {$degreeList};
        var professionList = {$professionList};
        var provinceList = {$provinceList};
        var cityList = {$cityList};
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

            if(!$.validator($("#infoForm input[name='tall']").val(),'numeric','只能是数字'))
                return false;
            if(!$.validator($("#infoForm input[name='weight']").val(),'numeric','只能是数字'))
                return false;
            if(!$.validator($("#infoForm input[name='bust']").val(),'numeric','只能是数字'))
                return false;
            if(!$.validator($("#infoForm input[name='waist']").val(),'numeric','只能是数字'))
                return false;
            if(!$.validator($("#infoForm input[name='hip']").val(),'numeric','只能是数字'))
                return false;
            var obj = $.extend({ }, $("#basicForm").serializeObject(),$("#infoForm").serializeObject());

            g_mainFormSubmited=true;
            $.post("/users/worker/saveOrUpdate",obj,function(jd){
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
                    url: '/users/worker/findSome',
                    params: { pageNo: 1, pageSize: 15 },
                    autoLoad: true
                },
                afterLoad:function(dd){
                    //修改
                    $("a.edit").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.post("/users/worker/findOne",{ id:id},function(jd){
                            $.dialog({
                                id:'mainFormDialog',
                                content:$("#mainFormDialogTemplate").html(),
                                fixed:true,
                                ok:mainFormSubmit,
                                cancel:function(){},
                                initialize:function(){
                                    $('#menu').tabify();
                                    for(var i=0;i<provinceList.length;i=i+1){
                                        $("select[name='provinceid']").append("<option value='"+provinceList[i].id+"'>"+provinceList[i].name+"</option>");
                                    }
                                    for(var i=0;i<cityList.length;i=i+1){
                                        $("select[name='cityid']").append("<option value='"+cityList[i].id+"'>"+cityList[i].name+"</option>");
                                    }
                                    for(var i=0;i<statusList.length;i=i+1){
                                        $("select[name='status']").append("<option value='"+statusList[i].id+"'>"+statusList[i].name+"</option>");
                                    }
                                    for(var i=0;i<hairList.length;i=i+1){
                                        $("select[name='hair']").append("<option value='"+hairList[i].id+"'>"+hairList[i].name+"</option>");
                                    }
                                    for(var i=0;i<constellationList.length;i=i+1){
                                        $("select[name='constellation']").append("<option value='"+constellationList[i].id+"'>"+constellationList[i].name+"</option>");
                                    }
                                    for(var i=0;i<degreeList.length;i=i+1){
                                        $("select[name='degree']").append("<option value='"+degreeList[i].id+"'>"+degreeList[i].name+"</option>");
                                    }
                                    for(var i=0;i<professionList.length;i=i+1){
                                        $("select[name='profession']").append("<option value='"+professionList[i].id+"'>"+professionList[i].name+"</option>");
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

                                    $("#infoForm").find("input[name='tall']").val(jd.data.tall);
                                    $("#infoForm").find("input[name='weight']").val(jd.data.weight);
                                    $("#infoForm").find("input[name='bust']").val(jd.data.bust);
                                    $("#infoForm").find("input[name='waist']").val(jd.data.waist);
                                    $("#infoForm").find("input[name='hip']").val(jd.data.hip);
                                    $("#infoForm").find("select[name='hair']").val(jd.data.hair);
                                    $("#infoForm").find("input[name='shoe']").val(jd.data.shoe);
                                    $("#infoForm").find("input[name='birthday']").val(jd.data.birthday);
                                    $("#infoForm").find("select[name='sex']").val(jd.data.sex);
                                    $("#infoForm").find("select[name='constellation']").val(jd.data.constellation);
                                    $("#infoForm").find("select[name='degree']").val(jd.data.degree);
                                    $("#infoForm").find("select[name='profession']").val(jd.data.profession);
                                    $("#infoForm").find("textarea[name='hobby']").val(jd.data.hobby);

                                }
                            });
                        },"json");
                    });

                    //删除
                    $("a.remove").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.confirm('您确定要删除选中的记录吗?',
                                function () {
                                    $.post("/users/worker/delete",{ id:id},function(jd){
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
                            $.post("/users/worker/resetPassword",{ id:id},function(data){
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
                            $.post("/users/worker/changeStatus",{ id:id,status:status},function(data){
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
                $.post("/users/worker/detail",{ id:id},function(jd){
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
                            $(".cts").html(jd.cts);

                            $(".tall").html(jd.tall+"cm");
                            $(".weight").html(jd.weight+"kg");
                            $(".bust").html(jd.bust+"cm");
                            $(".waist").html(jd.waist+"cm");
                            $(".hip").html(jd.hip+"cm");
                            $(".hair").html(getValue(hairList,jd.hair));
                            $(".shoe").html(jd.shoe);
                            $(".birthday").html(jd.birthday);
                            if(parseInt(jd.sex) == 1)
                                $(".sex").html("男");
                            else
                                $(".sex").html("女");
                            $(".constellation").html(getValue(constellationList,jd.constellation));
                            $(".degree").html(getValue(degreeList,jd.degree));
                            $(".profession").html(getValue(professionList,jd.profession));
                            $(".hobby").html(jd.hobby);
                            //工作经历
                            var exps = jd.exps;
                            for(var i=0;i<exps.length;i++){
                                var html='';
                                html+='<table>';
                                html+='<tr><td style="width: 100px;">开始日期</td><td style="width:300px;">'+(exps[i].startmonth).substr(0,7)+'</td><td style="width: 80px;">结束日期</td><td style="width: 300px;">'+(exps[i].endmonth).substr(0,7)+'</td></tr>';
                                html+='<tr><td>技能</td><td>'+getValue(skillList,exps[i].skill)+'</td></tr>';
                                var data = eval("("+exps[i].dcd+")");
                                html+='<tr><td>角色和职能</td><td colspan="3">'+data.result+'</td></tr>';
                                html+='<tr><td>工作描述</td><td colspan="3">'+data.description+'</td></tr>';
                                html+='</table>';
                                $("#contentExp").append(html);
                            }
                            //工作城市
                            var regions = jd.regions;
                            for(var i=0;i<regions.length;i++){
                                $("#contentRegion").append("<span style='margin-right: 10px;'>"+regions[i].ancestornames+regions[i].name+",</span>")
                            }
                            //技能城市
                            var skills = jd.skills;
                            for(var i=0;i<skills.length;i++){
                                $("#contentSkill").append("<span style='margin-right: 10px;'>"+getValue(skillList,skills[i].skill)+",</span>")
                            }
                            //照片
                            var images = eval("("+jd.dcd+")");
                            if(images.frontphoto)
                                $("#contentImg").append("<img src='"+images.frontphoto+"' style='margin-right: 15px;margin-bottom:10px;' title='正面照'/>");
                            if(images.leftphoto)
                                $("#contentImg").append("<img src='"+images.leftphoto+"' style='margin-right: 15px;margin-bottom:10px;' title='左侧面'/>");
                            if(images.rightphoto)
                                $("#contentImg").append("<img src='"+images.rightphoto+"' style='margin-right: 15px;margin-bottom:10px;' title='右侧面'/>");
                            if(images.backphoto)
                                $("#contentImg").append("<img src='"+images.backphoto+"' style='margin-right: 15px;margin-bottom:10px;' title='背面'/>");
                            if(images.nearphoto)
                                $("#contentImg").append("<img src='"+images.nearphoto+"' style='margin-right: 15px;margin-bottom:10px;' title='近身照'/>");
                            if(images.fullphoto)
                                $("#contentImg").append("<img src='"+images.fullphoto+"' style='margin-right: 15px;margin-bottom:10px;' title='全景照'/>");
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
{include file="header.tpl"}
<div class="row clearfix" style="width:1100px;overflow: hidden;">
    <div style="height: 460px;" class="mt50">
        <div id="mainGrid" class="grid"></div>
    </div>
</div>
{include file="footer.tpl"}
</body>
</html>
<script type="text/template" id="detailDialogTemplate">
    <div>
        <ul id="menu">
            <li class="active"><a href="#contentBasic">基本资料</a></li>
            <li><a href="#contentDetail">详细信息</a></li>
            <li><a href="#contentExp">工作经历</a></li>
            <li><a href="#contentRegion">工作要求城市</a></li>
            <li><a href="#contentSkill">技能</a></li>
            <li><a href="#contentImg">照片</a></li>
        </ul>
        <div class="content" id="contentBasic">
            <table class="info" style="width: 100%;">
                <tr><td style="width: 60px;">用户名:</td><td class="account" style="width: 150px;"></td><td style="width: 60px;">姓名:</td><td class="name" style="width:150px;"></td></tr>
                <tr><td>邮箱:</td><td class="email"></td><td>手机:</td><td class="mobile"></td></tr>
                <tr><td>地区:</td><td class="region"></td><td>状态:</td><td class="status"></td></tr>
                <tr><td>加入时间:</td><td class="cts"></td></tr>
            </table>
        </div>
        <div class="content" id="contentDetail" style="display: none;">
            <table class="info" style="width: 100%;">
                <tr><td style="width: 60px;">身高:</td><td class="tall" style="width: 150px;"></td><td style="width: 60px;">体重:</td><td class="weight" style="width:150px;"></td></tr>
                <tr><td>胸围:</td><td class="bust"></td><td>腰围:</td><td class="waist"></td></tr>
                <tr><td>臀围:</td><td class="hip"></td><td>头发颜色:</td><td class="hair"></td></tr>
                <tr><td>鞋码:</td><td class="shoe"></td><td>生日:</td><td class="birthday"></td></tr>
                <tr><td>性别:</td><td class="sex"></td><td>星座:</td><td class="constellation"></td></tr>
                <tr><td>学历:</td><td class="degree"></td><td>专业:</td><td class="profession"></td></tr>
                <tr><td>爱好:</td><td class="hobby"></td></tr>
            </table>
        </div>
        <div class="content" id="contentExp" style="display: none;min-height: 100px;">

        </div>
        <div class="content" id="contentRegion" style="display: none;min-height: 100px;">

        </div>
        <div class="content" id="contentSkill" style="display: none;min-height: 100px;">

        </div>
        <div class="content" id="contentImg" style="display: none;min-height: 100px;">

        </div>
    </div>

</script>
<script type="text/template" id="mainFormDialogTemplate">
    <div>
        <ul id="menu">
            <li class="active"><a href="#contentBasic">基本资料</a></li>
            <li><a href="#contentDetail">详细信息</a></li>
        </ul>
        <div class="content" id="contentBasic">
            <form id="basicForm" class="mega">
                <input type="hidden" name="id"/>
                <label>账号：</label><input name="account" type="text"/><br/>
                <label>密码：</label><input name="pwdhash" type="password"/><br/>
                <label>姓名：</label><input name="name" type="text"/><br/>
                <label>邮箱：</label><input name="email" type="text"/><br/>
                <label>手机：</label><input name="mobile" type="text"/><br/>
                <label>地区：</label><select name="provinceid"></select><select name="cityid"></select><br/>
                <label>点数：</label><input name="point" type="text"/><br/>
                <label>状态：</label><select name="status"></select><br/>
            </form>
        </div>
        <div class="content" id="contentDetail" style="display: none;">
            <form id="infoForm" class="mega" style="position: relative;">
                <label>身高：</label><input name="tall" type="text"/>cm<br/>
                <label>体重：</label><input name="weight" type="text"/>kg<br/>
                <label>胸围：</label><input name="bust" type="text"/>cm<br/>
                <label>腰围：</label><input name="waist" type="text"/>cm<br/>
                <label>臀围：</label><input name="hip" type="text"/>cm<br/>
                <label>头发颜色：</label><select name="hair"></select><br/>
                <label>鞋子尺码：</label><input name="shoe" type="text"/><br/>
                <label>生日：</label><input name="birthday" type="text" maxlength="10" onfocus="$(this).calendar()"><br/>
                <label>性别：</label><select name="sex"><option value="1">男</option><option value="0">女</option></select>
                <label class="ml20">星座：</label><select name="constellation"></select><br/>
                <label>学历：</label><select name="degree"></select>
                <label class="ml20">专业：</label><select name="profession"></select><br/>
                <label style="vertical-align: top;">爱好|特长：</label><textarea style="resize: none;width: 300px;height: 100px;" name="hobby"></textarea><br/>
            </form>
        </div>
    </div>
</script>

