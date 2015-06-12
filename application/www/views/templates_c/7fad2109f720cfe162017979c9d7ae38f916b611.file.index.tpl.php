<?php /* Smarty version Smarty-3.1.20, created on 2015-05-29 10:52:46
         compiled from "/mnt/hgfs/website/candystar/application/www/views/templates/worker/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14363150335551c72430ace0-87308487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fad2109f720cfe162017979c9d7ae38f916b611' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/www/views/templates/worker/index.tpl',
      1 => 1431514534,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14363150335551c72430ace0-87308487',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5551c7243c9534_34964669',
  'variables' => 
  array (
    'skillList' => 0,
    'item' => 0,
    'regionList' => 0,
    'starList' => 0,
    'star' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5551c7243c9534_34964669')) {function content_5551c7243c9534_34964669($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="/images/favicon.ico" rel="icon">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="超级星探">
    <meta name="description" content=""/>
    <meta name="renderer" content="webkit">
    <title>超级星探 | 人才中心 </title>
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>

    <style type="text/less">

        .tag{
            height: 28px;
            line-height: 28px;
            float: left;
            text-align: center;
            padding:2px 5px;
             a{
                 color: #222;
                 padding: 0 5px;
                 border-radius: 10px;
                 display: block;
                 text-align: center;
                 &:hover,&.selected{
                      background: #ec6f16;
                      height: 28px;
                      color: #fff;
                  }
             }
        }

        a.showMore{
            float: left;
            color: #999999;
            font-size: 12px;
            margin-left:10px;
            margin-top:10px;
            &:hover{
                color: #3b70e1;
                text-decoration: underline;
             }
        }

        .worker{
            display: inline-block;
            margin-right: 12px;
            margin-top: 20px;
            padding: 10px;
            width: 200px;
            border: 3px solid #FFF;
            background-color:#FFF;
            &:hover{
                 border: 3px solid #ec6f16;
            }
             .avatar{
                 display: block;
                 width: 200px;
                 height: 200px;
             }
             .name{
                 display: inline-block;
                 vertical-align: middle;
                 font-size: 14px;
                 line-height: 30px;
                 color: #0097d3;
                 &:hover{
                    text-decoration: underline;
                  }
             }
        }

        .star{
            display: block;
            padding:15px 10px;
            &:hover{
                background-color: #DDD;
                 border-radius: 5px;
             }
            .star_avatar{
                display: block;
                width: 78px;
                height: 78px;
                border:#ddd solid 1px;
            }
            .star_name{
                color:#0097d3;
                &:hover{
                    text-decoration: underline;
                 }
            }
        }

    </style>

</head>

<body style="background: url(/images/www/bg.png) repeat;">
<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('worker', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div  class="row clearfix mt30 mb30 yahei fs14" style="width:1222px;" >
    <div class="row" style="width: 1166px; background-color: #FFF;padding: 20px">

        <div id="search_skill" class="row">
            <div class="col" style="width: 80px;"><label class="black9 lh30">热门搜索：</label></div>
            <div class="col" style="width:880px;">
                <div class="tag"><a href="javascript:void(0);" rel="" class="selected">全部</a></div>
                <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['skillList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value) {
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                    <div class="tag"><a href="javascript:void(0);" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</a></div>
                <?php } ?>
            </div>
        </div>
        <div id="search_region" class="row" style="margin-top:10px;">
            <div class="col" style="width: 80px;"><label class="black9 lh30">工作地点：</label></div>
            <div class="col" style="width:880px;">
                <div>
                    <div class="tag" rel="1"><a href="javascript:void(0);" rel="" class="selected">全国</a></div>
                    <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['regionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value) {
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                        <div class="tag hidden"><a href="javascript:void(0);" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</a></div>
                    <?php } ?>
                    <div class="tag"><a href="javascript:void(0);" rel="001001">北京</a></div>
                    <div class="tag"><a href="javascript:void(0);" rel="001002">天津</a></div>
                    <div class="tag"><a href="javascript:void(0);" rel="001003">上海</a></div>
                    <div class="tag"><a href="javascript:void(0);" rel="001004">重庆</a></div>
                    <div class="tag"><a href="javascript:void(0);" rel="001013">河北</a></div>
                    <a class="showMore" style="text-decoration: underline;" href="javascript:void(0);">显示更多</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="width: 1222px; margin-top: 10px;min-height: 400px;">
        <div class="col" style="width: 965px;">

            <div id="workers">
                
                    
                    
                        
                        
                    
                
            </div>

            <div id="pageData" class="mt50" style="margin-left: 75px;"></div>
        </div>

        <div class="col mt20 ml10 pd10" style="width: 211px;min-height:300px;background-color: #FFF;">
            <div class="fs18 lh30 fwb black9 yahei mb10">行业明星</div>

            <?php  $_smarty_tpl->tpl_vars["star"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["star"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['starList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["star"]->key => $_smarty_tpl->tpl_vars["star"]->value) {
$_smarty_tpl->tpl_vars["star"]->_loop = true;
?>
                <div class="row star" style="width: 190px;">
                    <div class="col">
                        <a href="/worker/<?php echo $_smarty_tpl->tpl_vars['star']->value->id;?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['star']->value->avatar;?>
" alt="" class="star_avatar rc5"/></a>
                    </div>
                    <div class="col black9 pl10">
                        <a href="/worker/<?php echo $_smarty_tpl->tpl_vars['star']->value->id;?>
" class="fs16 lh40 star_name" target="_blank"><?php echo $_smarty_tpl->tpl_vars['star']->value->name;?>
</a><br>
                        <span class="fs14 lh40 ellipsis" style="display:block;width: 90px;" title="<?php echo $_smarty_tpl->tpl_vars['star']->value->skill;?>
"><?php echo $_smarty_tpl->tpl_vars['star']->value->skill;?>
</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
<script type="text/javascript">

    /*查找艺人*/
    function findpage(pageIndex){
        // 职位类型
        var skill = $("#search_skill a.selected").attr('rel');
        // 工作地点
        var region = $("#search_region a.selected").attr('rel');

        $.post('/worker/findSome',{ "skill":skill,"region":region,"pageIndex":pageIndex},function(jd){
            var workers = jd.workers,strHTML='';

            if(workers.length>0){
                for(var i=0;i<workers.length;i=i+1){
                   strHTML += '<div class="worker">';
                   strHTML += '<a href="/worker/'+workers[i].id+'" target="_blank"><img src="'+workers[i].avatar+'" alt="" class="avatar"/></a>';
                    strHTML += '<a class="name" target="_blank" href="/worker/'+workers[i].id+'">'+workers[i].name+'</a>';

                    strHTML += '<div class="fs14 lh24 black9 ellipsis" style="width: 180px;">职业：';
                    for(var j=0;j<workers[i].skill.length;j=j+1){
                        strHTML += workers[i].skill[j].name;
                        if(j < workers[i].skill.length-1){
                            strHTML += '<span style="vertical-align:-2px;"> · </span>';
                        }
                    }
                    strHTML += '</div></div>';
                }
				$('#workers').empty();
                $('#workers').html(strHTML);
                $('#pageData').html(jd.pageStr);
            }else{
                $('#workers').html('<p class="fs18 black3 tac" style="height: 300px;line-height: 300px;">对不起，还没有符合您搜索条件的艺人，敬请期待。</p>');
                $('#pageData').empty();
            }

            if(pageIndex>1)
                $('body,html').animate({ scrollTop:130},1000);
        },'json');
    }

    $(document).ready(function(){

        findpage(1);

        $('.showMore').live('click',function(){
            var region = $('#search_region a.selected').attr('rel');
           $('#search_region .tag[rel!="1"]').toggleClass('hidden');
            $('#search_region a[rel='+region+']').addClass('selected');
            var name = $(this).html();
            if(name == '显示更多'){
                $(this).html('收起');
            }else if(name == '收起'){
                $(this).html('显示更多');
            }
        });

        $('#search_skill a').live('click',function(){
            $('#search_skill a').removeClass('selected');
            $(this).addClass('selected');
            findpage(1);
        });

        $('#search_region a').live('click',function(){
            if($(this).hasClass('showMore')){
                return;
            }
            $('#search_region a').removeClass('selected');
            $(this).addClass('selected');
            findpage(1);
        });


    });
</script>
</html>

<?php }} ?>
