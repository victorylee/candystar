<?php /* Smarty version Smarty-3.1.20, created on 2015-04-22 17:37:17
         compiled from "/mnt/hgfs/website/candystar/application/admin/views/templates/admin/role.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188370571555376bcde47cb2-31710353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1471d5303d20b82684be21ac71f8abbe1a7495fc' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/admin/views/templates/admin/role.tpl',
      1 => 1405752963,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188370571555376bcde47cb2-31710353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'subdomainList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_55376bce083ad1_64040563',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55376bce083ad1_64040563')) {function content_55376bce083ad1_64040563($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理后台--角色</title>
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/grid/default/default.css" />
    <script type="text/javascript" src="/kit/grid/jquery.grid.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/dialog/green/green.css" />
    <script type="text/javascript" src="/kit/dialog/jquery.artDialog.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/tree/default/default.css" />
    <script type="text/javascript" src="/kit/tree/jquery.ztree.all.min.js"></script>
    <style type="text/less">
        a.setup{
            width: 18px;
            height: 18px;
            margin-top: 8px;
            margin-right: 5px;
            display: inline-block;
            background: url(/images/setup.png);
        }
    </style>
    <script type="text/javascript">
        var subdomainList = <?php echo $_smarty_tpl->tpl_vars['subdomainList']->value;?>
;

        var g_mainFormSubmited=false;
        var g_privilegeFormSubmited=false;
        var g_mainGrid;
        function mainFormSubmit() {
            if(g_mainFormSubmited==true){
                $.alert("请不要重复提交！");
                return false;
            }

            if(!$.validator($("#mainForm input[name='name']").val(),'required','名称不能为空'))
                return false;
            g_mainFormSubmited=true;
            $.post("/admin/role/saveOrUpdate",$("#mainForm").serializeObject(),function(jd){
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

        function privilegeFormSubmit() {
            if(g_privilegeFormSubmited==true){
                $.alert("请不要重复提交！");
                return false;
            }

            var treeObj = $.fn.zTree.getZTreeObj("privilegeTree");
            var nodes = treeObj.getCheckedNodes(true);
            if(nodes.length>0){
                var ids = [];
                for ( var i = 0; i < nodes.length; i++) {
                    ids.push(nodes[i].id);
                }
                $("#privilegeForm").find("input[name='privilegeIds']").val(ids.join(','));
                g_privilegeFormSubmited=true;
                $.post("/admin/role/addPrivilege",$("#privilegeForm").serializeObject(),function(jd){
                    g_privilegeFormSubmited=false;
                    if (jd.success) {
                        $.dialog.list['privilegeFormDialog'].close();
                        $.alert("操作成功");
                    } else {
                        $.alert(jd.msg);
                    }
                },"json");
            }else
                $.alert("请选择权限!");
            return false;
        }

        $(document).ready(function(){
            g_mainGrid=$("#mainGrid").grid({
                key: 'id',
                pagerLength:5,
                loader: {
                    url: '/admin/role/findSome',
                    params: { pageNo: 1, pageSize: 15 },
                    autoLoad: true
                },
                afterLoad:function(dd){
                    //修改
                    $("a.edit").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.post("/admin/role/findOne",{ id:id},function(jd){
                            $.dialog({
                                id:'mainFormDialog',
                                content:$("#mainFormDialogTemplate").html(),
                                fixed:true,
                                ok:mainFormSubmit,
                                cancel:function(){},
                                initialize:function(){
                                    for(var i in subdomainList){
                                        $("#mainForm").find("select[name='subdomain']").append("<option value='"+subdomainList[i].id+"'>"+subdomainList[i].name+"</option>");
                                    }

                                    $("#mainForm").find("input[name='newflag']").val(0);
                                    $("#mainForm").find("input[name='id']").val(jd.data.id);
                                    $("#mainForm").find("select[name='subdomain']").val(jd.data.subdomain);
                                    $("#mainForm").find("input[name='name']").val(jd.data.name);
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
                                    $.post("/admin/role/delete",{ id:id},function(jd){
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

                    //编辑权限
                    $("a.setup").bind('click',function(){
                        var roleid=$(this).attr("rowid");
                        var setting = {
                            data:{
                                key:{
                                    name:"name"
                                },
                                simpleData :{
                                    enable:true,
                                    idKey:"id",
                                    pIdKey:"pid"
                                }
                            },
                            view: {
                                expandSpeed: "fast",
                                selectedMulti:false,
                                showIcon:true,
                                showLine:true,
                                showTitle:true
                            },
                            check:{
                                enable: true
                            }
                        };
                        $.post("/admin/role/findPrivilege",{ roleid:roleid},function(jd){
                            $.dialog({
                                id:'privilegeFormDialog',
                                content:$("#privilegeFormDialogTemplate").html(),
                                fixed:true,
                                ok:privilegeFormSubmit,
                                cancel:function(){},
                                initialize:function(){
                                    for(var i in jd.data){
                                        if(jd.data[i].isleaf==1)
                                            jd.data[i].open=false;
                                        else
                                            jd.data[i].open=true;
                                        if(jd.data[i].granted==1)
                                            jd.data[i].checked=true;
                                        else
                                            jd.data[i].checked=false;
                                    }
                                    $.fn.zTree.init($("#privilegeTree"),setting,jd.data);
                                    $("#privilegeForm").find("input[name='roleid']").val(roleid);
                                }
                            });
                        },"json");
                    });
                },
                cols : [
                    { title : '操作', width: 80,
                        render:function(r){
                            return "<a href='javascript:;' class='edit' title='修改' rowid='"+ r.id+"'></a>"+"<a href='javascript:;' class='remove' title='删除' rowid='"+ r.id+"'></a>"+"<a href='javascript:;' class='setup' title='权限设置' rowid='"+ r.id+"'></a>";
                        }
                    },
                    { field: 'id', title : 'ID', width: 50,sort : true},
                    { field: 'subdomain', title : '子域', width: 200,
                        render: function(r, tr){
                            var result = '';
                            subdomainList.forEach(function(e){
                                if(e['id']== r.subdomain)
                                    result = e['name'];
                            });
                            return result;
                        }
                    },
                    { field: 'name', title : '名称', width: 300},
                    { field: 'remark', title : '备注', width: 320},
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
                        for(var i in subdomainList){
                            $("#mainForm").find("select[name='subdomain']").append("<option value='"+subdomainList[i].id+"'>"+subdomainList[i].name+"</option>");
                        }
                        $("#mainForm").find("input[name='newflag']").val(1);
                    }
                });
            });

        });
    </script>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="row clearfix" style="overflow: hidden;">
    <div id="toolbar" class="tal mt5 mb5">
        <a href="javascript:;" id="add" class="button">新增</a>
    </div>
    <div style="height: 460px;" class="mt5">
        <div id="mainGrid" class="grid" style="width: 980px;"></div>
    </div>
</div>



<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
</html>

<script type="text/template" id="mainFormDialogTemplate">
    <form id="mainForm" class="mega">
        <input type="hidden" name="newflag" />
        <input type="hidden" name="id" />
        <label>子域：</label><select name="subdomain"></select><br/>
        <label>名称：</label><input name="name" type="text"/><br/>
        <label>备注：</label><input name="remark" type="text"/><br/>
    </form>
</script>

<script type="text/template" id="privilegeFormDialogTemplate">
    <form id="privilegeForm" class="mega" style="height: auto; width: 300px;">
        <input type="hidden" name="roleid">
        <input type="hidden" name="privilegeIds">
        <ul id="privilegeTree" class="ztree"></ul>
    </form>

</script><?php }} ?>
