<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>管理后台--员工</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/grid/default/default.css" />
    <script type="text/javascript" src="/kit/grid/jquery.grid.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/dialog/green/green.css" />
    <script type="text/javascript" src="/kit/dialog/jquery.artDialog.min.js"></script>
    <style type="text/less">

    </style>
    <script type="text/javascript">
        var statusList = {$statusList};
        var roleList = {$roleList};
        var g_mainFormSubmited=false;
        var g_mainGrid;

        function mainFormSubmit() {
            if(g_mainFormSubmited==true){
                $.alert("请不要重复提交！");
                return false;
            }

            if(!$.validator($("#mainForm input[name='email']").val(),'required','账号不能为空'))
                return false;
//            if(!$.validator($("#mainForm input[name='email']").val(),'email','账号格式错误'))
//                return false;
            if(!$.validator($("#mainForm input[name='name']").val(),'required','名称不能为空'))
                return false;

            g_mainFormSubmited=true;
            $.post("/admin/emp/saveOrUpdate",$("#mainForm").serializeObject(),function(jd){
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

        $(document).ready(function(){
            g_mainGrid=$("#mainGrid").grid({
                key: 'id',
                pagerLength:5,
                loader: {
                    url: '/admin/emp/findSome',
                    params: { pageNo: 1, pageSize: 15 },
                    autoLoad: true
                },
                afterLoad:function(dd){
                    //修改
                    $("a.edit").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.post("/admin/emp/findOne",{ id:id},function(jd){
                            $.dialog({
                                id:'mainFormDialog',
                                content:$("#mainFormDialogTemplate").html(),
                                fixed:true,
                                ok:mainFormSubmit,
                                cancel:function(){},
                                initialize:function(){
                                    for(var i=0;i<statusList.length;i=i+1){
                                        $("select[name='status']").append("<option value='"+statusList[i].id+"'>"+statusList[i].name+"</option>");
                                    }
                                    for(var i=0;i<roleList.length;i=i+1){
                                        $("select[name='roleid']").append("<option value='"+roleList[i].id+"'>"+roleList[i].name+"</option>");
                                    }
                                    $("#mainForm").find("input[name='id']").val(jd.data.id);
                                    $("#mainForm").find("input[name='email']").val(jd.data.email);
                                    $("#mainForm").find("input[name='name']").val(jd.data.name);
                                    $("#mainForm").find("select[name='roleid']").val(jd.data.roleid);
                                    $("#mainForm").find("select[name='status']").val(jd.data.status);
                                    $("#mainForm").find("input[name='remark']").val(jd.data.remark);
                                }
                            });
                        },"json");
                    });

                    //删除
                    $("a.remove").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.confirm('您确定要删除选中的记录吗?',
                                function () {
                                    $.post("/admin/emp/delete",{ id:id},function(jd){
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
                    { field: 'email', title : '账号', width: 200},
                    { field: 'name', title : '姓名', width: 100},
                    { field: 'roleid', title : '角色', width: 100,
                        render:function(r,td){
                            var result = '未分配';
                            roleList.forEach(function(e){
                                if(e["id"] == r.roleid){
                                    result = e["name"]
                                }
                            });
                            return result;
                        }
                    },
                    { field: 'status', title : '状态', width: 100,
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
                    { field: 'cts', title : '加入时间', width: 300}
                ]
            });

            //新增
            $("#add").click(function(){
                $.dialog({
                    id:'mainFormDialog',
                    content:$("#mainFormDialogTemplate").html(),
                    fixed:true,
                    ok:mainFormSubmit,
                    cancel:function(){},
                    initialize:function(){
                        for(var i=0;i<statusList.length;i=i+1){
                            $("select[name='status']").append("<option value='"+statusList[i].id+"'>"+statusList[i].name+"</option>");
                        }
                        for(var i=0;i<roleList.length;i=i+1){
                            $("select[name='roleid']").append("<option value='"+roleList[i].id+"'>"+roleList[i].name+"</option>");
                        }
                    }
                });
            });

        });
    </script>
</head>

<body>
{include file="header.tpl"}
<div class="row clearfix" style="overflow: hidden;">
    <div id="toolbar" class="tal mt5 mb5">
        <a href="javascript:;" id="add" class="button">新增</a>
    </div>
    <div style="height: 460px;" class="mt5">
        <div id="mainGrid" class="grid" style="width: 980px;"></div>
    </div>
</div>
{include file="footer.tpl"}
</body>
</html>

<script type="text/template" id="mainFormDialogTemplate">
    <form id="mainForm" class="mega">
        <input type="hidden" name="id" />
        <label>账号：</label><input name="email" type="text"/><br/>
        <label>密码：</label><input name="pwdhash" type="password"/><br/>
        <label>名称：</label><input name="name" type="text"/><br/>
        <label>角色：</label><select name="roleid"></select><br/>
        <label>备注：</label><input name="remark" type="text"/><br/>
        <label>状态：</label><select name="status"></select>
    </form>
</script>

