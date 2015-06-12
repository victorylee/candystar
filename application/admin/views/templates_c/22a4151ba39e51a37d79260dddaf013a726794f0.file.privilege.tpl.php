<?php /* Smarty version Smarty-3.1.20, created on 2015-04-22 17:57:15
         compiled from "/mnt/hgfs/website/candystar/application/admin/views/templates/admin/privilege.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7629523475537707b022936-58252731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22a4151ba39e51a37d79260dddaf013a726794f0' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/admin/views/templates/admin/privilege.tpl',
      1 => 1406115628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7629523475537707b022936-58252731',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5537707b0d51f9_82613993',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5537707b0d51f9_82613993')) {function content_5537707b0d51f9_82613993($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/grid/default/default.css" />
    <link rel="stylesheet" type="text/css" href="/kit/dialog/green/green.css" />
    <script type="text/javascript" src="/kit/dialog/jquery.artDialog.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/kit/tree/default/default.css" />
    <script type="text/javascript" src="/kit/tree/jquery.ztree.all.min.js"></script>

    <title>权限</title>

    <style type="text/less">
        .row_title {
            border-bottom: 2px solid #CCCCCC;
            font-family: '微软雅黑';
            font-size: 20px;
            height: 60px;
            line-height: 60px;
            margin-bottom: 20px;
            padding-left: 10px;
        }
    </style>

    <script type="text/javascript">
        var IDMark_Switch = "_switch";
        var IDMark_Icon = "_ico";
        var IDMark_Span = "_span";
        var IDMark_Input = "_input";
        var IDMark_Check = "_check";
        var IDMark_Edit = "_edit";
        var IDMark_Remove = "_remove";
        var IDMark_Ul = "_ul";
        var IDMark_A = "_a";
        var g_mainFormSubmited=false;
        var pNode = null;
        function mainFormSubmit(){
            if(g_mainFormSubmited==true){
                $.alert("请不要重复提交！");
                return false;
            }
            if(!$.validator($("#mainForm input[name='id']").val(),'required','ID不能为空'))
                return false;
            if(!$.validator($("#mainForm input[name='name']").val(),'required','名称不能为空'))
                return false;
            if(!$.validator($("#mainForm input[name='url']").val(),'required','URL不能为空'))
                return false;
            var parentid = $("#mainForm").find("input[name='pid']").val();
            g_mainFormSubmited=true;
            $.post("/admin/privilege/saveOrUpdate",$("#mainForm").serializeObject(),function(jd){
                g_mainFormSubmited=false;
                if(jd.success){ //成功
                    $.dialog.list['mainFormDialog'].close();
                    var treeObj = $.fn.zTree.getZTreeObj("tree");
                    treeObj.reAsyncChildNodes(pNode, "refresh", false);
                }else{  //失败
                    $.alert(jd.msg);
                }
            },"json");
            return false;
        }

        function addDiyDom(treeId, node) {
            var aObj = $("#" + node.tId + IDMark_A);
            var editStr = "&nbsp;&nbsp<a href='javascript:void(0);' iconClass='add' nodeid='"+node.id+"' pid='"+node.pid+"'>添加子项</a>";
            editStr = editStr+"&nbsp;&nbsp<a href='javascript:void(0);' iconClass='edit' nodeid='"+node.id+"' pid='"+node.pid+"'>修改</a>";
            if(node.isleaf==1)
                editStr = editStr+"&nbsp;&nbsp<a href='javascript:void(0);' iconClass='remove' nodeid='"+node.id+"' pid='"+node.pid+"'>删除</a>";
            aObj.append(editStr);
            //添加
            $("a[iconClass='add']").live('click',function(){
                var pid = $(this).attr("nodeid");
                $.dialog({
                    id:'mainFormDialog',
                    content:$("#mainFormDialogTrolelate").html(),
                    fixed:true,
                    ok:mainFormSubmit,
                    cancel:function(){},
                    initialize:function(){
                        $.post("/admin/privilege/findOne",{ id:pid},function(jsonData){
                            if(jsonData.data==null){
                                $.alert("此权限已存在！");
                            }else{
                                $("#mainForm").find("input[name='newflag']").val(1);
                                $("#mainForm").find("input[name='id']").val("");
                                $("#mainForm").find("input[name='pid']").val(jsonData.data.id);
                                $("#mainForm").find("input[name='ancestornames']").val(jsonData.data.name);
                                $("#mainForm").find("input[name='level']").val(parseInt(jsonData.data.level)+1);
                                $("#mainForm").find("input[name='isleaf']").val(1);
                            }
                        },"json");
                    }
                });
            });
            //修改
            $("a[iconClass='edit']").live("click",function(){
                var id = $(this).attr("nodeid");
                $.dialog({
                    id:'mainFormDialog',
                    content:$("#mainFormDialogTrolelate").html(),
                    fixed:true,
                    ok:mainFormSubmit,
                    cancel:function(){},
                    initialize:function(){
                        $.post("/admin/privilege/findOne",{ id:id},function(jsonData){
                            if(jsonData.data==null){
                                $.alert("此权限已存在！");
                            }else{
                                $("#mainForm").find("input[name='newflag']").val(0);
                                $("#mainForm").find("input[name='id']").val(jsonData.data.id);
                                $("#mainForm").find("input[name='pid']").val(jsonData.data.pid);
                                $("#mainForm").find("input[name='ancestornames']").val(jsonData.data.ancestornames);
                                $("#mainForm").find("input[name='name']").val(jsonData.data.name);
                                $("#mainForm").find("input[name='level']").val(jsonData.data.level);
                                $("#mainForm").find("input[name='isleaf']").val(jsonData.data.isleaf);
                                $("#mainForm").find("input[name='url']").val(jsonData.data.url);
                            }
                        },"json");
                    }
                });
            });
            //删除
            $("a[iconClass='remove']").live("click",function(){
                var id = $(this).attr("nodeid");
                var pid = $(this).attr("pid");
                $.confirm('您要删除当前所选权限吗？',
                        function () {
                            $.post("/admin/privilege/delete",{ id:id,pid:pid},function(jd){
                                if (jd.success) {
                                    $.dialog.list['Confirm'].close();
                                    var treeObj = $.fn.zTree.getZTreeObj("tree");
                                    treeObj.reAsyncChildNodes( pNode, "refresh",false);
                                } else {
                                    $.alert(jd.msg);
                                }
                            },"json");
                            return false;
                        },function(){}
                );
            });
        }
        function beforeClick(treeId, treeNode) {
            pNode = treeNode.getParentNode();
            if(pNode == null)
                pNode = treeNode;
        }
        //设置选项
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
                addDiyDom: addDiyDom,
                expandSpeed: "fast",
                selectedMulti:false,
                showIcon:true,
                showLine:true,
                showTitle:true
            },
            async: {
                enable: true,
                url:"/admin/privilege/getSubNodes",
                autoParam:["id=pid", "name=n", "level=lv"],
                dataFilter: function(treeId, parentNode, childNodes){
                    if (!childNodes) return null;
                    for (var i=0, l=childNodes.length; i<l; i++) {
                        if(childNodes[i].isleaf!=1){
                            childNodes[i].open=true;
                            childNodes[i].isParent = true;
                        }
                    }
                    return childNodes;
                }
            },
            callback: {
                beforeClick: beforeClick
            }
        };

        $(document).ready(function(){
            $.fn.zTree.init($("#tree"), setting);
        });
    </script>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="row">
    <div class="row_title">权限管理</div>
</div>
<div class="row clearfix" style="width: 950px;height: 600px;overflow-y: auto;">
    <ul id="tree" class="ztree"></ul>
</div>

</body>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</html>
<script type="text/trolelate" id="mainFormDialogTrolelate">
    <form id="mainForm">
        <input type="hidden" name="newflag" id="newflag"/>
        <input type="hidden" name="pid"/>
        <input type="hidden" name="ancestornames"/>
        <input type="hidden" name="level"/>
        <input type="hidden" name="isleaf"/>
        <table>
            <tr><td width="50">ID</td><td><input id="id" name="id" type="text"/></td></tr>
            <tr><td>名称：</td><td><input id="name" name="name" type="text"/></td></tr>
            <tr><td>URL</td><td><input type="text" id="url" name="url" /></td></tr>
        </table>
    </form>
</script><?php }} ?>
