<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/css/admin.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.e9580.com/css/grid.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.e9580.com/css/reset.css" />
<script type="text/javascript" src="http://cdn.e9580.com/js/jquery/core/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.e9580.com/js/magic/css/default.css" />
<script type="text/javascript" src="http://cdn.e9580.com/js/magic/js/mousewheel.js"></script>
<script type="text/javascript" src="http://cdn.e9580.com/js/magic/js/core.js"></script>
<script type="text/javascript" src="http://cdn.e9580.com/js/magic/js/pager.js"></script>
<script type="text/javascript" src="http://cdn.e9580.com/js/magic/js/grid.js"></script>
<script type="text/javascript" src="http://cdn.e9580.com/js/jquery/cookie/jquery.cookie.js"></script>
<style type="text/css">
    #search{
        color: #555;
    }
</style>
<script type="text/javascript">
    var g_mainGrid;

    function parentChangeTitle(id,name){
        $.cookie('curfirmid',id,{ domain:'nboerp.com',path: '/' });
        window.parent.changeTabTitle("welcome",name);
    }
    function search(){
        var value = $("#search").val();
        if(value!=''){
            g_mainGrid.load({ name: "name", value:value })
        }else{
            g_mainGrid.load({ name: "name", value:"" })
        }
    }
    $(document).ready(function(){
        g_mainGrid=$("#mainGrid").mac('grid',{
            key: 'id',
            pagerLength:5,
            sortLocally: true,
            loader: {
                url: '/workspace/findSomeFirm',
                params: { pageNo: 1, pageSize: 15 },
                autoLoad: true
            },
            cols : [
                { field: 'id', title : 'ID', width: 50,sort : true},
                { field: 'name', title : '名称', width: 150,
                    render: function(r, tr){
                        return "<a href='javascript:void(0);' onclick='parentChangeTitle("+ r.id+",\""+ r.name+"\");'>"+ r.name+"</a>";
                    }
                },
                { field : 'bookkeeperjob', title: '待制证', width : 50},
                { field : 'checkerjob', title: '待审核', width : 50},
                { field : 'accountantjob',title: '待入帐',  width : 50},
                { field : 'contactperson',title: '联系人',  width : 130},
                { field : 'contactaddress',title: '联系地址',  width : 160}
            ]
        });
        //搜索框刷新事件
        $('#refresh').click(function(){
            g_mainGrid.load();
        });
        //搜索框回车事件
        $("#search").bind('keydown',function(event) {
            if(event.keyCode==13){
                search();
            }
        });
    });
</script>
</head>

<body>
测试
<div id="toolbar">
    <input type="text" size="20" id="search" value="机构名称" onfocus="if(value=='机构名称')value=''" onblur="if(value=='')value='机构名称'" />
    <button id="search_btn" type="button" onclick="javascript:search();">搜索</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="refresh">刷新</button>
</div>
{*<table id="mainGrid"></table>*}
<div style="height: 420px;width: 960px;">
    <div id="mainGrid" class="grid"></div>
</div>
</body>
</html>

