<?php /* Smarty version Smarty-3.1.20, created on 2015-04-22 17:56:58
         compiled from "/mnt/hgfs/website/candystar/application/admin/views/templates/admin/dict.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11296996035537706a3b9c16-00305466%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6c44afd9b9f7beeb8d5f4b74174d71ec8a8b6b7' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/admin/views/templates/admin/dict.tpl',
      1 => 1405752963,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11296996035537706a3b9c16-00305466',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5537706a530632_06057010',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5537706a530632_06057010')) {function content_5537706a530632_06057010($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理后台--字典</title>
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
        var g_mainFormSubmited=false;
        var g_mainGrid;

        function mainFormSubmit() {
            if(g_mainFormSubmited==true){
                $.alert("请不要重复提交！");
                return false;
            }

            if(!$.validator($("#mainForm input[name='id']").val(),'required','编码不能为空'))
                return false;
            if(!$.validator($("#mainForm input[name='name']").val(),'required','描述不能为空'))
                return false;

            g_mainFormSubmited=true;
            $.post("/admin/dict/saveOrUpdate",$("#mainForm").serializeObject(),function(jd){
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
                    url: '/admin/dict/findSome',
                    params: { pageNo: 1, pageSize: 15 },
                    autoLoad: true
                },
                afterLoad:function(dd){
                    //修改
                    $("a.edit").bind('click',function(){
                        var id=$(this).attr('rowid');
                        $.post("/admin/dict/findOne",{ id:id},function(jd){
                            $.dialog({
                                id:'mainFormDialog',
                                content:$("#mainFormDialogTemplate").html(),
                                fixed:true,
                                ok:mainFormSubmit,
                                cancel:function(){},
                                initialize:function(){
                                    $("#mainForm").find("input[name='newflag']").val(0);
                                    $("#mainForm").find("input[name='id']").val(jd.data.id);
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
                                $.post("/admin/dict/delete",{ id:id},function(jd){
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
                    { field: 'id', title : '编码', width: 70,sort : true},
                    { field: 'name', title : '描述', width: 300},
                    { field: 'remark', title : '备注', width: 530}
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
        <label>编码：</label><input name="id" type="text"/><br/>
        <label>描述：</label><input name="name" type="text"/><br/>
        <label>备注：</label><input name="remark" type="text"/><br/>
    </form>
</script>
<?php }} ?>
