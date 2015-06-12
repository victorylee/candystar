<?php /* Smarty version Smarty-3.1.20, created on 2015-05-12 17:23:45
         compiled from "/mnt/hgfs/website/candystar/application/www/views/templates/profile/broker.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2835256165551c6a1e40914-86105883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3034251cffb3b27a369bfee1a362d26767180884' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/www/views/templates/profile/broker.tpl',
      1 => 1431413463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2835256165551c6a1e40914-86105883',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'broker' => 0,
    'dcd' => 0,
    'item' => 0,
    'provinceList' => 0,
    'cityList' => 0,
    'businessList' => 0,
    'skillList' => 0,
    'sexList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5551c6a24eb7d3_05051334',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5551c6a24eb7d3_05051334')) {function content_5551c6a24eb7d3_05051334($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/hgfs/website/candystar/system/libraries/smarty/libs/plugins/modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="/images/favicon.ico" rel="icon">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="超级星探">
    <meta name="description" content=""/>
    <meta name="renderer" content="webkit">
    <title>超级星探 | 个人主页 </title>
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <link rel="stylesheet" type="text/css" href="/kit/dialog/cakes/cakes.css" />
	<link rel="stylesheet" type="text/css" href="/kit/upload/default/default.css" />
    <link rel="stylesheet" type="text/css" href="/kit/date/datepicker.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <script type="text/javascript" src="/kit/date/datepicker.js"></script>
    <script type="text/javascript" src="/kit/upload/jquery.uploadify.min.js" ></script>
    <script type="text/javascript" src="/kit/imgareaselect/scripts/jquery.imgareaselect.min.js"></script>
    <style type="text/less">
        .businessDemo{
            padding:10px;
            a{
                display: inline-block;
                padding: 5px 10px;
                border:1px solid #CCC;
                font-size: 12px;
                text-align: center;
                margin: 5px;
            }
        }
        .businessBox{
            padding:10px;
            a{
                display: inline-block;
                padding: 5px 10px;
                border:1px solid #CCC;
                font-size: 12px;
                text-align: center;
                margin: 5px;
                color:#333;
                span{
                    display: inline-block;
                    width: 12px;
                    height: 12px;
                    background: url(/images/www/delete.png) no-repeat 0px 0px;
                    margin-left: 5px;
                    font-size: 10px;
                }
            }
        }
        form{
            height: auto;
            padding: 20px;
            .item{
                width: 700px;
                position:relative;
                min-height: 50px;
                label{
                    display: inline-block;
                    width: 100px;
                    height: 50px;
                    line-height: 50px;
                    text-align: right;
                    margin-right: 15px;
                }
                input[type="text"]{
                    display: inline-block;
                    width: 300px;
                    height: 28px;
                    padding: 5px;
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
                select{
                    min-width: 50px;
                    height: 30px;
                }
                .error{
                    padding-left: 10px;
                    line-height: 41px;
                    display: inline-block;
                    top: 7px;
                    text-align: left;
                    width: 190px;
                    color: #db4f33;
                    font-size: 12px;
                }
            }
        }
        #topForm{
            position:relative;
            .error{
                padding-left: 10px;
                line-height: 20px;
                display: inline-block;
                top: 7px;
                text-align: left;
                width: 290px;
                color: #db4f33;
                font-size: 12px;
                background: #FFEBEB;
                /*border: 1px solid #ffbdbe;*/
                position:absolute;
                top:45px;
                left: 90px;
                z-index: 999;
            }
        }
        .box{
            .item{
                display:inline-block;
                width:430px;
                min-height:30px;
                font-size:14px;
                label{
                    display: inline-block;
                    width: 80px;
                    text-align: right;
                    margin-right: 10px;
                }
                span{

                }
            }
        }
        .exps{
            ul{
                display:block;
                width:1000px;
                li{
                    float: left;
                    line-height: 30px;
                    &.date{
                        width: 260px;
                     }
                    &.result{
                        width: 140px;
                     }
                    &.description{
                        width: 450px;
                     }
                    &.operation{
                        width: 100px;
                     }
                }
            }
        }
        .jobs{
            ul{
                display:block;
                width:960px;
                li{
                    float: left;
                    text-align: center;
                    line-height: 30px;
                    &.date{
                        width: 220px;
                     }
                     &.skill{
                          width: 60px;
                      }
                     &.sex{
                          width: 40px;
                      }
                     &.quantity{
                          width: 80px;
                      }
                     &.salary{
                          width: 130px;
                      }
                    &.name{
                        width: 120px;
                     }
                    &.description{
                        width: 210px;
                     }
                    &.operation{
                        width: 100px;
                     }
                }
            }
        }
        .imgareaselect-border1 { background: url(/images/www/border-v.gif) repeat-y left top;}
        .imgareaselect-border2 { background: url(/images/www/border-h.gif) repeat-x left top;}
        .imgareaselect-border3 { background: url(/images/www/border-v.gif) repeat-y right top;}
        .imgareaselect-border4 { background: url(/images/www/border-h.gif) repeat-x left bottom;}
        .imgareaselect-border1, .imgareaselect-border2,
        .imgareaselect-border3, .imgareaselect-border4 { filter: alpha(opacity=50);opacity: 0.5;}
        .imgareaselect-handle { background-color: #fff;border: solid 1px #000;filter: alpha(opacity=50);opacity: 0.5;}
        .imgareaselect-outer { background-color: #000;filter: alpha(opacity=50);opacity: 0.5;}
        .item_avatar{ float:left;margin-right:15px;overflow:hidden;}
        .avatars .big{ width:256px;height:256px;border:1px solid #ddd;}
        .button{
            display:inline-block;
            width: 80px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            font-size: 12px;
            color: #FFF;
            background-color: #3b70e1;
        }
    </style>
</head>

<body class="yahei" style="background: url(/images/www/bg.png) repeat;">
<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="row clearfix mt20 yahei black6 topBox" style="width: 1000px;background-color: #FFF;">
    <div class="boxShow" style="width: 1000px;height: 125px;">
        <div class="col" style="width: 150px;padding: 10px;position: relative;">
            <?php $_smarty_tpl->tpl_vars['dcd'] = new Smarty_variable(json_decode($_smarty_tpl->tpl_vars['broker']->value->dcd,true), null, 0);?>
            <img src="<?php if (isset($_smarty_tpl->tpl_vars['dcd']->value['avatar'])&&$_smarty_tpl->tpl_vars['dcd']->value['avatar']) {?><?php echo $_smarty_tpl->tpl_vars['dcd']->value['avatar'];?>
<?php } else { ?>/images/avatarBig.png<?php }?>" class="userAvatar" style="width: 120px;"/>
            <a href="javascript:void(0);" class="uploadImg" style="display:inline-block;width: 120px;height: 20px;line-height: 20px;color: #FFF;text-align: center;background-color: rgba(0,0,0,0.4);position: absolute;top:110px;left: 11px;">修改头像</a>
        </div>
        <div class="col" style="width: 530px;">
            <p class="fs20 mt30" style="color: #3879D9;"><?php echo $_smarty_tpl->tpl_vars['broker']->value->name;?>
</p>
            <p class="mt10 region">
                <span provinceid="<?php echo $_smarty_tpl->tpl_vars['broker']->value->pid;?>
" cityid="<?php echo $_smarty_tpl->tpl_vars['broker']->value->regionid;?>
">
                <?php if ($_smarty_tpl->tpl_vars['broker']->value->regionid) {?><?php echo $_smarty_tpl->tpl_vars['broker']->value->ancestornames;?>
<?php echo $_smarty_tpl->tpl_vars['broker']->value->regionname;?>
<?php }?>
                </span>
            </p>
            <p class="mt10 business">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['broker']->value->business; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                    <span rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->business;?>
" class="mr10"><?php echo $_smarty_tpl->tpl_vars['item']->value->businessname;?>
</span>
                <?php } ?>
            </p>
        </div>
    </div>
    <div class="boxHidden" style="width: 1000px;display: none;">
        <div style="position: relative;">
            <div style="height:48px;position: relative;margin-left: 20px;margin-top: 20px;">
                <input type="file" id="user_image_upload" name="avatar" />
            </div>
            <div class="clearfix" style="padding-bottom:15px;">
                <div class="avatarBg clearfix fl" style="display:inline-block;width:450px;">
                    <img id="userPhoto" src="/images/www/avatarBg.png" style="margin-left:20px;"/>
                </div>
                <div class="avatars clearfix fl" style="display:inline-block;width:450px;height: 300px;">
                    <div class="info">请注意头像是否清晰(上传的图片尺寸不得小于256x256像素)</div>
                    <?php $_smarty_tpl->tpl_vars['dcd'] = new Smarty_variable(json_decode($_smarty_tpl->tpl_vars['broker']->value->dcd,true), null, 0);?>
                    <div class="big item_avatar" style="margin-top: 20px;"><img src="<?php if (isset($_smarty_tpl->tpl_vars['dcd']->value['avatar'])&&$_smarty_tpl->tpl_vars['dcd']->value['avatar']) {?><?php echo $_smarty_tpl->tpl_vars['dcd']->value['avatar'];?>
<?php } else { ?>/images/avatarBig.png<?php }?>" width="256" height="256"></div>
                </div>
            </div>
            <input name="width" type="hidden"  />
            <input name="height" type="hidden"  />
            <input name="marginleft" type="hidden"  />
            <input name="margintop" type="hidden"  />
            <input name="avatar" type="hidden"  id="userImagePath" value=""/>
            <div class="popList" style="text-align:center;padding-top:10px;padding-bottom:10px;border-top:1px solid #eee;">
                <a href="javascript:void(0);" class="button save">确定</a>
                <a href="javascript:void(0);" class="button cancel">取消</a>
            </div>

        </div>
    </div>
</div>
<div class="row clearfix mt20 yahei black6 box basicInfo" style="width: 960px;padding:20px;background-color: #FFF;">
    <h3 class="mb20">基本信息<a href="javascript:void(0);" class="fr fs14 fwn mr10 edit">编辑</a></h3>
    <div class="boxShow">
        <div class="item name">
            <label>姓名</label><span rel="<?php echo $_smarty_tpl->tpl_vars['broker']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['broker']->value->name;?>
</span>
        </div>
        <div class="item email">
            <label>邮箱</label><span rel="<?php echo $_smarty_tpl->tpl_vars['broker']->value->email;?>
"><?php if ($_smarty_tpl->tpl_vars['broker']->value->email) {?><?php echo $_smarty_tpl->tpl_vars['broker']->value->email;?>
<?php } else { ?>未填写<?php }?></span>
        </div>
        <div class="item region">
            <label>地区</label>
            <span provinceid="<?php echo $_smarty_tpl->tpl_vars['broker']->value->pid;?>
" cityid="<?php echo $_smarty_tpl->tpl_vars['broker']->value->regionid;?>
">
                <?php if ($_smarty_tpl->tpl_vars['broker']->value->regionid) {?><?php echo $_smarty_tpl->tpl_vars['broker']->value->ancestornames;?>
<?php echo $_smarty_tpl->tpl_vars['broker']->value->regionname;?>
<?php } else { ?>未填写<?php }?>
            </span>
        </div>
    </div>
    <div class="boxHidden" style="display: none;">
        <form id="topForm" method="post">
            <div class="item">
                <label>姓名</label><input type="text" name="name"/><span class="error"></span>
            </div>
            <div class="item">
                <label>邮箱</label><input type="text" name="email"/><span class="error"></span>
            </div>
            <div class="item">
                <label>地区</label>
                <select name="provinceid" class="mr10">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['provinceList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</option>
                    <?php } ?>
                </select>
                <select name="cityid">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cityList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</option>
                    <?php } ?>
                </select>
                <span class="error"></span>
            </div>
            <div class="item" style="width:1000px;">
                <label style="vertical-align: top;float: left;">经济类型</label>
                <div class="businessBox fl" style="display:inline-block;width:300px;height: 100px;border: 1px solid #CCC;"></div>
                <span class="error"></span>
                <div class="businessDemo" style="display:inline-block;width:300px;height: 80px;border: 1px solid #CCC;margin-left: 135px;">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['businessList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <a rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</a>
                    <?php } ?>
                </div>
            </div>
            <div class="item" style="width: 900px;">
                <a href="javascript:void(0);" class="button save mt20 ml200">确定</a>
                <a href="javascript:void(0);" class="button cancel">取消</a>
            </div>

        </form>
    </div>
</div>
<div class="row clearfix mt20 yahei black6 expBox" style="width: 960px;padding:20px;background-color: #FFF;">
    <h3 class="mb20">工作经历<a href="javascript:void(0);" class="add fs14 fwn fr">+</a> </h3>
    <div class="exps">
        <?php if ($_smarty_tpl->tpl_vars['broker']->value->cases) {?>
            <ul><li class="date fs16">时间</li><li class="result fs16">作品</li><li class="description fs16">描述</li><li class="operation fs16">操作</li></ul>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['broker']->value->cases; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <ul class="exp<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
                    <li class="date">从<span class="start"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->startmonth,"Y-m");?>
</span>到<span class="end"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->endmonth,"Y-m");?>
</span></li>
                    <?php $_smarty_tpl->tpl_vars['dcd'] = new Smarty_variable(json_decode($_smarty_tpl->tpl_vars['item']->value->dcd,true), null, 0);?>
                    <li class="result"><?php echo $_smarty_tpl->tpl_vars['dcd']->value['result'];?>
</li>
                    <li class="description"><?php echo $_smarty_tpl->tpl_vars['dcd']->value['description'];?>
</li>
                    <li class="operation"><a href="javascript:void(0);" class="edit fs12" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">修改</a><a href="javascript:void(0);" class="delete fs12 ml10" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">删除</a> </li>
                </ul>
            <?php } ?>
        <?php } else { ?>

        <?php }?>

    </div>
    <div class="boxHidden" style="width: 600px;margin-left: 100px;display: none;">
        <form>
            <input type="hidden" name="id"/>
            <div class="item">
                <label>开始日期：</label><input type="text" name="startmonth" data-date-format="yyyy-mm" readonly="readonly"/><span class="error"></span>
            </div>
            <div class="item">
                <label>结束日期：</label><input type="text" name="endmonth" data-date-format="yyyy-mm" readonly="readonly" /><span class="error"></span>
            </div>
            <div class="item">
                <label>作品：</label><input type="text" name="result"/><span class="error"></span>
            </div>
            <div class="item">
                <label style="vertical-align: top;">描述：</label><textarea name="description" style="width:305px;height:100px;resize: none;"></textarea><span class="error"></span>
            </div>
            <div class="item">
                <a href="javascript:void(0);" class="button save mt20 ml200">确定</a>
                <a href="javascript:void(0);" class="button cancel">取消</a>
            </div>
        </form>
    </div>
</div>
<div class="row clearfix mt20 yahei black6 jobBox" style="width: 960px;padding:20px;background-color: #FFF;">
    <h3 class="mb20">发布工作<a href="javascript:void(0);" class="add fs14 fwn fr">+</a> </h3>
    <div class="jobs">
        <?php if ($_smarty_tpl->tpl_vars['broker']->value->jobs) {?>
            <ul><li class="date fs16">时间</li><li class="name fs16">作品</li><li class="skill fs16">角色</li><li class="sex fs16">性别</li><li class="quantity fs16">招聘数量</li><li class="salary fs16">日薪(100元/天)</li><li class="description fs16">描述</li><li class="operation fs16">操作</li></ul>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['broker']->value->jobs; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <ul class="job<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
                    <li class="date">从<span class="start"><?php echo $_smarty_tpl->tpl_vars['item']->value->startdate;?>
</span>到<span class="end"><?php echo $_smarty_tpl->tpl_vars['item']->value->enddate;?>
</span></li>
                    <li class="name"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</li>
                    <li class="skill" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->skill;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->skillname;?>
</li>
                    <li class="sex" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->sex;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->sexname;?>
</li>
                    <li class="quantity"><?php echo $_smarty_tpl->tpl_vars['item']->value->quantity;?>
</li>
                    <li class="salary"><?php echo $_smarty_tpl->tpl_vars['item']->value->salary;?>
</li>
                    <li class="description"><?php echo $_smarty_tpl->tpl_vars['item']->value->description;?>
</li>
                    <li class="operation"><a href="javascript:void(0);" class="edit fs12" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">修改</a><a href="javascript:void(0);" class="delete fs12 ml10" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">删除</a> </li>
                </ul>
            <?php } ?>
        <?php }?>

    </div>
    <div class="boxHidden" style="width: 600px;margin-left: 100px;display: none;">
        <form>
            <input type="hidden" name="id"/>
            <div class="item">
                <label>开始日期：</label><input type="text" name="startdate" data-date-format="yyyy-mm-dd" readonly="readonly"/><span class="error"></span>
            </div>
            <div class="item">
                <label>结束日期：</label><input type="text" name="enddate" data-date-format="yyyy-mm-dd" readonly="readonly" /><span class="error"></span>
            </div>
            <div class="item">
                <label>作品：</label><input type="text" name="name"/><span class="error"></span>
            </div>
            <div class="item">
                <label>招聘角色：</label>
                <select name="skill">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['skillList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</option>
                    <?php } ?>
                </select><span class="error"></span>
            </div>
            <div class="item">
                <label>性别：</label>
                <select name="sex">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sexList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</option>
                    <?php } ?>
                </select>
                <span class="error"></span>
            </div>
            <div class="item">
                <label>招聘人数：</label><input type="text" name="quantity"/><span class="error"></span>
            </div>
            <div class="item">
                <label>日薪：</label><input type="text" name="salary"/><span class="error"></span>
            </div>
            <div class="item">
                <label style="vertical-align: top;">描述：</label><textarea name="description" style="width:305px;height:100px;resize: none;"></textarea><span class="error"></span>
            </div>
            <div class="item">
                <a href="javascript:void(0);" class="button save mt20 ml200">确定</a>
                <a href="javascript:void(0);" class="button cancel">取消</a>
            </div>
        </form>
    </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
<script type="text/javascript">
    var ias='';
    function resetSize(data){
        var left = 0, top = 0 , width = 278 , height = 278;
        //根据返回的图片大小进行裁剪
        if(data.width < 278 && data.height < 278){
            left = 278-data.width;
            top = 278 -data.height;
            $('#userPhoto').css({ width:'auto', 'height': 'auto', 'margin-left' : left/2+'px', 'margin-top': top/2+'px' });
            setSelect(278,'center',data);
        }else{
            if(data.width > data.height){
                height = data.height/data.width*278;
                top = 278-height;
                $('#userPhoto').css({ width:'278px', 'height': 'auto', 'margin-left' : '0px', 'margin-top': top/2+'px' });
                setSelect(height,'top');
            }else if(data.width < data.height){
                width = data.width/data.height*278;
                left = 278 - width;
                $('#userPhoto').css({ height:'278px','width':'auto', 'margin-top' : '0px', 'margin-left' : left/2+'px' });
                setSelect(width,'left');
            }else if(data.width == data.height){
                $('#userPhoto').css({ width:'278px','height':'278px', 'margin-top' : '0px', 'margin-left' : '0px' });
                setSelect(278,null);
            };
        }
    };
    function setSelect(num,direction,data){
        var x1,x2,y1,y2,plus,view = {};
        if (direction == 'top'){
            x1 = 78;
            y1 = (num > 256) ? (num - 256)/2 : 0;
        }else if(direction == 'left'){
            x1 = (num > 256) ? (num - 256)/2 : 0;
            y1 = 78;
        }else if(direction == 'center'){
            x1 = (data.width - 256)/2;
            y1 = (data.height - 256)/2;
        }else{
            x1 = 78 ;
            y1 = 78 ;
        }
        if(num > 256){
            x2 = x1 + 256 ;
            y2 = y1 + 256 ;
            plus = 256;
        }else{
            x2 = x1 + num ;
            y2 = y1 + num ;
            plus = num;
        };
        ias.setSelection(x1, y1, x2, y2, true);
        ias.setOptions({ show: true });
        ias.update();
        view = {
            width : plus,
            height: plus,
            x1 : x1,
            y1 : y1,
            x2 : x2,
            y2 : y2
        };
        preview(null,view);
        $('input[name="width"]').val($('.big img').css("width").replace("px",""));
        $('input[name="height"]').val($('.big img').css("height").replace("px",""));
        $('input[name="marginleft"]').val($('.big img').css("margin-left").replace("px","").replace("-",""));
        $('input[name="margintop"]').val($('.big img').css("margin-top").replace("px","").replace("-",""));
    };

    function preview(img, selection) {
        var width = $('#userPhoto').width(), height = $('#userPhoto').height();
        var scaleX = 256 / (selection.width || 1);
        var scaleY = 256 / (selection.height || 1);
//        var scaleX1 = 80 / (selection.width || 1);
//        var scaleY1 = 80 / (selection.height || 1);
//        var scaleX2 = 30 / (selection.width || 1);
//        var scaleY2 = 30 / (selection.height || 1);

        $('.big img').css({
            width: Math.round(scaleX * width) + 'px',
            height: Math.round(scaleY * height) + 'px',
            marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
            marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
        });
//        $('.middle img').css({
//            width: Math.round(scaleX1 * width) + 'px',
//            height: Math.round(scaleY1 * height) + 'px',
//            marginLeft: '-' + Math.round(scaleX1 * selection.x1) + 'px',
//            marginTop: '-' + Math.round(scaleY1 * selection.y1) + 'px'
//        });
//        $('.small img').css({
//            width: Math.round(scaleX2 * width) + 'px',
//            height: Math.round(scaleY2 * height) + 'px',
//            marginLeft: '-' + Math.round(scaleX2 * selection.x1) + 'px',
//            marginTop: '-' + Math.round(scaleY2 * selection.y1) + 'px'
//        });
    };
    $(document).ready(function(){
        $("select[name='provinceid']").live("change",function(){
            var pid = $(this).val();
            $("select[name='cityid']").empty();
            $.post("/profile/findSubRegion",{ pid:pid},function(jd){
                for(var i=0;i<jd.length;i=i+1){
                    $("select[name='cityid']").append("<option value='"+jd[i].id+"'>"+jd[i].name+"</option>");
                }
            },"json");
        });
        ias = $('#userPhoto').imgAreaSelect({
            instance: true ,
            handles: true,
            aspectRatio: '1:1',
            onSelectChange: preview ,
            onSelectEnd: function (img, selection) {
                $('input[name="width"]').val($('.big img').css("width").replace("px",""));
                $('input[name="height"]').val($('.big img').css("height").replace("px",""));
                $('input[name="marginleft"]').val($('.big img').css("margin-left").replace("px","").replace("-",""));
                $('input[name="margintop"]').val($('.big img').css("margin-top").replace("px","").replace("-",""));
            }
        });
        /*
         * 需要后端返回data数据
         * data { url : '' , width : '图片宽度' , height :' 图片高度'}
         * */

        $('#user_image_upload').uploadify({
            'swf'      : '/kit/upload/uploadify.swf',
            'uploader' : '/upload/avatar',
            'width'  : 108,
            'height' : 41,
            'buttonImage' : '/images/www/upload.png',
            'fileTypeExts' : '*.jpg;*.gif;*.png;*.jpeg',
            'fileTypeDesc' : 'Image Files (.JPG, .GIF, .PNG, .JPEG)',
            'fileSizeLimit' : '2MB',
            'auto' : true,
            'multi' : false,
            'successTimeout' : 10,
            'removeTimeout' : 0,
            'onUploadSuccess' : function(file, result) {
                result = eval('('+result+')');
                if (result) {
                    var data = result.data;
                    if(result.success){
                        if(data.width < 256 || data.height < 256){
                            alert ('上传的图像尺寸太小，请重新上传');
                            return false;
                        };
                        var path = data.url;
                        $('#userPhoto').attr('src', "/temp/"+path);
                        $('#userImagePath').val(path);
                        $(".big img").attr("src","/temp/"+path).show();

                        var img = new Image();
                        img.src = "/temp/"+path ;
                        img.onload = function(){
                            resetSize(data);
                        }
                    }else{
                        alert (result.msg);
                        return false;
                    }
                } else {
                    alert("上传失败，请稍后重试.");
                }
            },
            'onSelectError':function(file,errorCode){
                switch(errorCode) {
                    case -110:
                        alert("图片 ["+file.name+"] 大小超过限制，请选择小于2M的图片！");
                        break;
                    case -120:
                        alert("图片 ["+file.name+"] 大小异常！");
                        break;
                    case -130:
                        alert("图片 ["+file.name+"] 类型不正确！");
                        break;
                }
                return false;
            }
        });

        //上传头像
        $(".uploadImg").live("click",function(){
            $(".topBox .boxShow").hide();
            $(".topBox .boxHidden").show();
        });
        $(".topBox .save").live("click",function(){
            var uploaddata = {
                width : $('input[name="width"]').val(),
                height : $('input[name="height"]').val(),
                marginleft : $('input[name="marginleft"]').val(),
                margintop : $('input[name="margintop"]').val(),
                url : $('input[name="avatar"]').val(),
                type:0
            };
            if($('input[name="avatar"]').val() == ''){
                alert ('请先上传头像');
                return false;
            };
            $.post('/profile/saveavatar',uploaddata,function(result){
                if(result.success){
                    var data = result.data;
                    $(".userAvatar").attr("src",data['big']);
                    $(".topBox .cancel").trigger("click");
                }else
                    $(".topBox .cancel").trigger("click");
            },"json");
        });
        //取消上传头像
        $(".topBox .cancel").live("click",function(){
            $(".topBox .boxShow").show();
            $(".topBox .boxHidden").hide();
            ias.cancelSelection();
            $('input[name="width"]').val("");
            $('input[name="height"]').val("");
            $('input[name="marginleft"]').val("");
            $('input[name="margintop"]').val("");
            $('#userPhoto').attr('src', '/images/www/avatarBg.png');
            $('#userImagePath').val("");
            $(".big img").attr("src","/images/www/avatarBig.png");
        });

        //经纪类型
        $(".businessDemo a").live("click",function(){
            var rel = $(this).attr("rel"),text = $(this).text();
            if($(".businessBox a[rel='"+rel+"']").length == 0){
                $(".businessBox").append("<a href='javascript:void(0);' rel='"+rel+"'>"+text+"<span></span></a>");
            }else{
                alert("该经纪类型已经存在，不能再次添加");
            }
        });

        $(".businessBox a span").live("click",function(){
            $(this).parent("a").remove();
        });

        //编辑基本信息
        $(".basicInfo .edit").live("click",function(){
            $(".basicInfo .boxShow").hide();
            $(".basicInfo .boxHidden").show();
            $(".business span").each(function(){
                $(".businessBox").append('<a href="javascript:void(0);" rel="'+$(this).attr("rel")+'">'+$(this).text()+'<span></span></a>');
            });
            $(".basicInfo input[name='name']").val($(".basicInfo .name span").attr("rel"));
            $(".basicInfo input[name='email']").val($(".basicInfo .email span").attr("rel"));
            var provinceid = $(".basicInfo .region span").attr("provinceid");
            var cityid = $(".basicInfo .region span").attr("cityid");
            $("select[name='cityid']").empty().append("<option value=''>全部</option>");
            $.post("/profile/findSubRegion",{ pid:provinceid},function(jd){
                for(var i=0;i<jd.length;i=i+1){
                    $("select[name='cityid']").append("<option value='"+jd[i].id+"'>"+jd[i].name+"</option>");
                }
                $("select[name='provinceid']").val(provinceid);
                $("select[name='cityid']").val(cityid);
            },"json");
        });

        var submited=false;
        $(".basicInfo .save").live("click",function(){
            if(submited==true){
                alert("请不要重复提交！");
                return false;
            }
            $('.error').empty();
            if(!$.validator($(".basicInfo input[name='name']").val(),'req')){
                $(".basicInfo input[name='name']").next(".error").html("请输入您的姓名");
                return false;
            }
            if(!$.validator($(".basicInfo input[name='email']").val(),'req')){
                $(".basicInfo input[name='email']").next(".error").html("请输入您的邮箱");
                return false;
            }
            if(!$.validator($(".basicInfo input[name='email']").val(),'email')){
                $(".basicInfo input[name='email']").next(".error").html("邮箱格式错误");
                return false;
            }

            var business = '';
            $(".businessBox a").each(function(){
                business += $(this).attr("rel")+',';
            });
            if(business == ''){
                $(".businessBox").next(".error").html("请选择经历类型");
            }
            submited=true;
            $.post("/profile/saveBrokerBasicInfo",$.extend(true,$(".basicInfo form").serializeObject(),{ business:business}),function(data){
                submited=false;
                if(data){ //成功
                    $(".business").empty();
                    $(".businessBox a").each(function(){
                        $(".business").append('<span rel="'+$(this).attr("rel")+'" class="mr10">'+$(this).text()+'</span>');
                    });
                    $(".businessBox").empty();
                    $(".basicInfo .name span").text($(".basicInfo input[name='name']").val());
                    $(".basicInfo .name span").attr("rel",$(".basicInfo input[name='name']").val());
                    $(".basicInfo .email span").text($(".basicInfo input[name='email']").val());
                    $(".basicInfo .email span").attr("rel",$(".basicInfo input[name='email']").val());
                    $(".region span").text($(".basicInfo select[name='provinceid'] option:selected").text()+$(".basicInfo select[name='cityid'] option:selected").text());
                    $(".region span").attr("provinceid",$(".basicInfo select[name='provinceid']").val());
                    $(".region span").attr("cityid",$(".basicInfo select[name='cityid']").val());
                    $(".basicInfo .cancel").trigger("click");
                }else{  //失败
                    alert("添加失败");
                }
            },"json");
        });
        //取消
        $(".basicInfo .cancel").live("click",function(){
            $(".basicInfo .boxShow").show();
            $(".basicInfo .boxHidden").hide();
            $(".basicInfo form")[0].reset();
            $(".businessBox").empty();
        });

        //新增工作经历
        $(".expBox .add").live("click",function(){
            $(".expBox .exps").hide();
            $(".expBox .boxHidden").show();
            $("input[name='startmonth']").datepicker();
            $("input[name='endmonth']").datepicker();
        });

        //编辑
        $(".expBox .edit").live("click",function(){
            var id = $(this).attr("rel");
            $(".expBox .boxHidden input[name='id']").val(id);
            $(".expBox .boxHidden input[name='startmonth']").val($("ul[class='exp"+id+"']").find('.start').text());
            $(".expBox .boxHidden input[name='endmonth']").val($("ul[class='exp"+id+"']").find('.end').text());
            $(".expBox .boxHidden input[name='result']").val($("ul[class='exp"+id+"']").find('.result').text());
            $(".expBox .boxHidden textarea[name='description']").val($("ul[class='exp"+id+"']").find('.description').text());
            $("input[name='startmonth']").datepicker();
            $("input[name='endmonth']").datepicker();
            $(".expBox .exps").hide();
            $(".expBox .boxHidden").show();
        });
        //删除
        $(".expBox .delete").live("click",function(){
            var id = $(this).attr("rel");
            if(confirm("您确定删除该记录吗")){
                $.post("/profile/deleteBrokerCase",{ id:id},function(data){
                    if(data)
                        $("ul[class='exp"+id+"']").remove();
                    else
                        alert("删除失败");
                },"text");
            }
        });

        //保存工作经历
        var submited=false;
        $(".expBox .save").live("click",function(){
            if(submited==true){
                alert("请不要重复提交！");
                return false;
            }
            $('.error').empty();
            var startMonth = $(".expBox input[name='startmonth']").val();
            var endMonth = $(".expBox input[name='endmonth']").val();
            var result = $(".expBox input[name='result']").val();
            var description = $(".expBox textarea[name='description']").val();

            if(!$.validator(startMonth,'req')){
                $(".expBox input[name='startmonth']").next(".error").html("请选择开始日期");
                return false;
            }
            if(!$.validator(endMonth,'req')){
                $(".expBox input[name='endmonth']").next(".error").html("请选择结束日期");
                return false;
            }
            if(!$.validator(result,'req')){
                $(".expBox input[name='result']").next(".error").html("请输入作品名称");
                return false;
            }
            if(!$.validator(description,'req')){
                $(".expBox textarea[name='description']").next(".error").html("请简单描述");
                return false;
            }
            submited=true;
            $.post("/profile/saveBrokerCase",$(".expBox form").serializeObject(),function(data){
                submited=false;
                if(data.success){ //成功
                    var id = $(".expBox input[name='id']").val();
                    if(id == ''){
                        $(".exps").append("<ul class='exp"+data.id+"'><li class='date'>从<span class='start'>"+startMonth+"</span>到<span class='end'>"+endMonth+"</span></li><li class='result'>"+result+"</li><li class='description'>"+description+"</li><li class='operation'><a href='javascript:void(0);' class='edit fs12' rel='"+data.id+"'>修改</a><a href='javascript:void(0);' class='delete fs12 ml10' rel='"+data.id+"'>删除</a></li></ul>");
                    }else{
                        $("ul.exp"+data.id).html("<li class='date'>从<span class='start'>"+startMonth+"</span>到<span class='end'>"+endMonth+"</span></li><li class='result'>"+result+"</li><li class='description'>"+description+"</li><li class='operation'><a href='javascript:void(0);' class='edit fs12' rel='"+data.id+"'>修改</a><a href='javascript:void(0);' class='delete fs12 ml10' rel='"+data.id+"'>删除</a></li>");
                    }
                    $(".expBox .cancel").trigger("click");
                }else{  //失败
                    alert("添加失败");
                }
            },"json");
        });
        //取消
        $(".expBox .cancel").live("click",function(){
            $(".expBox .exps").show();
            $(".expBox .boxHidden").hide();
            $(".expBox form")[0].reset();
        });

        //新增工作招聘
        $(".jobBox .add").live("click",function(){
            $(".jobBox .jobs").hide();
            $(".jobBox .boxHidden").show();
            $("input[name='startdate']").datepicker();
            $("input[name='enddate']").datepicker();
        });

        //编辑
        $(".jobBox .edit").live("click",function(){
            var id = $(this).attr("rel");
            $(".jobBox .boxHidden input[name='id']").val(id);
            $(".jobBox .boxHidden input[name='startdate']").val($("ul[class='job"+id+"']").find('.start').text());
            $(".jobBox .boxHidden input[name='enddate']").val($("ul[class='job"+id+"']").find('.end').text());

            $(".jobBox .boxHidden select[name='skill']").val($("ul[class='job"+id+"']").find('.skill').attr("rel"));
            $(".jobBox .boxHidden select[name='sex']").val($("ul[class='job"+id+"']").find('.sex').attr("rel"));

            $(".jobBox .boxHidden input[name='quantity']").val($("ul[class='job"+id+"']").find('.quantity').text());
            $(".jobBox .boxHidden input[name='salary']").val($("ul[class='job"+id+"']").find('.salary').text());
            $(".jobBox .boxHidden input[name='name']").val($("ul[class='job"+id+"']").find('.name').text());
            $(".jobBox .boxHidden textarea[name='description']").val($("ul[class='job"+id+"']").find('.description').text());
            $("input[name='startdate']").datepicker();
            $("input[name='enddate']").datepicker();
            $(".jobBox .jobs").hide();
            $(".jobBox .boxHidden").show();
        });
        //删除
        $(".jobBox .delete").live("click",function(){
            var id = $(this).attr("rel");
            if(confirm("您确定删除该记录吗")){
                $.post("/profile/deleteBrokerJob",{ id:id},function(data){
                    if(data)
                        $("ul[class='job"+id+"']").remove();
                    else
                        alert("删除失败");
                },"text");
            }
        });

        //保存工作经历
        var submited=false;
        $(".jobBox .save").live("click",function(){
            if(submited==true){
                alert("请不要重复提交！");
                return false;
            }
            $('.error').empty();
            var startdate = $(".jobBox input[name='startdate']").val();
            var enddate = $(".jobBox input[name='enddate']").val();
            var skill = $(".jobBox select[name='skill']").val();
            var skill_text = $(".jobBox select[name='skill'] option:selected").text();
            var sex = $(".jobBox select[name='sex']").val();
            var sex_text = $(".jobBox select[name='sex'] option:selected").text();
            var quantity = $(".jobBox input[name='quantity']").val();
            var salary = $(".jobBox input[name='salary']").val();
            var name = $(".jobBox input[name='name']").val();
            var description = $(".jobBox textarea[name='description']").val();

            if(!$.validator(startdate,'req')){
                $(".jobBox input[name='startmonth']").next(".error").html("请选择开始日期");
                return false;
            }
            if(!$.validator(enddate,'req')){
                $(".jobBox input[name='endmonth']").next(".error").html("请选择结束日期");
                return false;
            }
            if(!$.validator(quantity,'req')){
                $(".jobBox input[name='quantity']").next(".error").html("请输入招聘人数");
                return false;
            }
            if(!$.validator(quantity,'integer')){
                $(".jobBox input[name='quantity']").next(".error").html("招聘人数只能是数字");
                return false;
            }
            if(!$.validator(salary,'req')){
                $(".jobBox input[name='salary']").next(".error").html("请输入日薪");
                return false;
            }
            if(!$.validator(salary,'integer')){
                $(".jobBox input[name='salary']").next(".error").html("日薪只能是数字");
                return false;
            }
            if(!$.validator(name,'req')){
                $(".jobBox input[name='name']").next(".error").html("请输入作品名称");
                return false;
            }
            if(!$.validator(description,'req')){
                $(".jobBox textarea[name='description']").next(".error").html("请简单描述");
                return false;
            }
            submited=true;
            $.post("/profile/saveBrokerJob",$(".jobBox form").serializeObject(),function(data){
                submited=false;
                if(data.success){ //成功
                    var id = $(".jobBox input[name='id']").val();
                    if(id == ''){
                        $(".jobs").append("<ul class='job"+data.id+"'><li class='date'>从<span class='start'>"+startdate+"</span>到<span class='end'>"+enddate+"</span></li><li class='name'>"+name+"</li><li class='skill' rel='"+skill+"'>"+skill_text+"</li><li class='sex' rel='"+sex+"'>"+sex_text+"</li><li class='quantity'>"+quantity+"</li><li class='salary'>"+salary+"</li><li class='description'>"+description+"</li><li class='operation'><a href='javascript:void(0);' class='edit fs12' rel='"+data.id+"'>修改</a><a href='javascript:void(0);' class='delete fs12 ml10' rel='"+data.id+"'>删除</a></li></ul>");
                    }else{
                        $("ul.job"+data.id).html("<li class='date'>从<span class='start'>"+startdate+"</span>到<span class='end'>"+enddate+"</span></li><li class='name'>"+name+"</li><li class='skill' rel='"+skill+"'>"+skill_text+"</li><li class='sex' rel='"+sex+"'>"+sex_text+"</li><li class='quantity'>"+quantity+"</li><li class='salary'>"+salary+"</li><li class='description'>"+description+"</li><li class='operation'><a href='javascript:void(0);' class='edit fs12' rel='"+data.id+"'>修改</a><a href='javascript:void(0);' class='delete fs12 ml10' rel='"+data.id+"'>删除</a></li>");
                    }
                    $(".jobBox .cancel").trigger("click");
                }else{  //失败
                    alert("添加失败");
                }
            },"json");
        });
        //取消
        $(".jobBox .cancel").live("click",function(){
            $(".jobBox .jobs").show();
            $(".jobBox .boxHidden").hide();
            $(".jobBox form")[0].reset();
        });
    });
</script>
</html>

<?php }} ?>
