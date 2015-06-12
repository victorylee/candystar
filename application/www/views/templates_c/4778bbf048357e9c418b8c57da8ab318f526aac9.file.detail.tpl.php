<?php /* Smarty version Smarty-3.1.20, created on 2015-05-12 17:26:02
         compiled from "/mnt/hgfs/website/candystar/application/www/views/templates/worker/detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17701233035551c72a49f388-84162179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4778bbf048357e9c418b8c57da8ab318f526aac9' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/www/views/templates/worker/detail.tpl',
      1 => 1431413463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17701233035551c72a49f388-84162179',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'worker' => 0,
    'dcd' => 0,
    'item' => 0,
    'provinceList' => 0,
    'cityList' => 0,
    'hairList' => 0,
    'constellationList' => 0,
    'degreeList' => 0,
    'professionList' => 0,
    'skillList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5551c72a82fb84_86025501',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5551c72a82fb84_86025501')) {function content_5551c72a82fb84_86025501($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/hgfs/website/candystar/system/libraries/smarty/libs/plugins/modifier.date_format.php';
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
    <title>超级星探 | 个人详情页 </title>
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <link rel="stylesheet" type="text/css" href="/kit/dialog/cakes/cakes.css" />
	<link rel="stylesheet" type="text/css" href="/kit/upload/default/default.css" />
    <link rel="stylesheet" type="text/css" href="/kit/date/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/kit/awshowcase/v.1.1.3/css/style.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>
    <script type="text/javascript" src="/kit/date/datepicker.js"></script>
    <script type="text/javascript" src="/kit/upload/jquery.uploadify.min.js" ></script>
    <script type="text/javascript" src="/kit/imgareaselect/scripts/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="/kit/awshowcase/v.1.1.3/jquery.aw-showcase.min.js"></script>
    <style type="text/less">
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
            }
        }
        .exps{
            ul{
                display:block;
                width:1000px;
                li{
                    float: left;
                    text-align: center;
                    line-height: 30px;
                    &.date{
                        width: 240px;
                     }
                    &.result{
                        width: 140px;
                     }
                    &.skill{
                        width: 100px;
                     }
                    &.description{
                        width: 380px;
                     }
                    &.operation{
                        width: 100px;
                     }
                }
            }
        }
        .businessBox,.workcityBox{
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
        .businessDemo,.workcityDemo{
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
        .imglist img{ width:115px;height:64px;margin-right:11px;margin-bottom: 11px;}
        .imgareaselect-border1 { background: url(/images/www/border-v.gif) repeat-y left top;}
        .imgareaselect-border2 { background: url(/images/www/border-h.gif) repeat-x left top;}
        .imgareaselect-border3 { background: url(/images/www/border-v.gif) repeat-y right top;}
        .imgareaselect-border4 { background: url(/images/www/border-h.gif) repeat-x left bottom;}
        .imgareaselect-border1, .imgareaselect-border2,
        .imgareaselect-border3, .imgareaselect-border4 { filter: alpha(opacity=50);opacity: 0.5;}
        .imgareaselect-handle { background-color: #fff;border: solid 1px #000;filter: alpha(opacity=50);opacity: 0.5;}
        .imgareaselect-outer { background-color: #000;filter: alpha(opacity=50);opacity: 0.5;}
        .item_avatar{ float:left;margin-right:15px;overflow:hidden;}
        .avatars .big{ width:120px;height:120px;border:1px solid #ddd;}
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
        /*产品截图*/
        #picList li {
            width: 118px;
            height: 70px;
            float: left;
            font-size: 20px;
            margin: 10px 10px 3px 0px;
            position: relative;
            overflow: hidden;
        }

        #picList img{
            width: 112px;
            height: 64px;
            border:3px solid #fff;
        }
        #picList img:hover{
            border:3px solid #db4f33;
        }
        #picList li .close {
            position: absolute;
            top: -5px;
            right: 6px;
            color: #db4f33;
            cursor: pointer;
            font-size: 25px;
            display: none;
        }
        #showcase .showcase-content{
            /*非IE的主流浏览器识别的垂直居中的方法*/
            display: table-cell;
            vertical-align:middle;
            /*设置水平居中*/
            text-align:center;
            /*针对IE的Hack */
            *display: block;
            *font-size: 175px; /*约为高度的0.873，200*0.873 约为175*/
            *font-family:Arial; /*防止非utf-8引起的hack失效问题，如gbk编码*/
            width:635px;
            height:450px;
        }
        #showcase .showcase-content img{
            width:auto;
            height:auto;
            vertical-align: middle;
        }
        #showcase .showcase-thumbnail img{
            /*width:auto;*/
            height:auto;
            vertical-align: middle;
        }
    </style>
</head>

<body class="yahei" style="background: url(/images/www/bg.png) repeat;">
<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('worker', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="row clearfix mt20 yahei black6 topBox" style="width: 1000px;background-color: #FFF;">
    <div class="boxShow" style="width: 1000px;height: 125px;">
        <div class="col" style="width: 150px;padding: 10px;position: relative;">
            <?php $_smarty_tpl->tpl_vars['dcd'] = new Smarty_variable(json_decode($_smarty_tpl->tpl_vars['worker']->value->dcd,true), null, 0);?>
            <img src="<?php if (isset($_smarty_tpl->tpl_vars['dcd']->value['avatar'])&&$_smarty_tpl->tpl_vars['dcd']->value['avatar']) {?><?php echo $_smarty_tpl->tpl_vars['dcd']->value['avatar'];?>
<?php } else { ?>/images/avatarBig.png<?php }?>" class="userAvatar" style="width: 120px;"/>
            
        </div>
        <div class="col" style="width: 530px;">
            <p class="fs20 mt30" style="color: #3879D9;"><?php echo $_smarty_tpl->tpl_vars['worker']->value->name;?>
<span class="ml10 fs14 sex"><?php if ($_smarty_tpl->tpl_vars['worker']->value->sex==1) {?>男<?php } elseif ($_smarty_tpl->tpl_vars['worker']->value->sex==0) {?>女<?php }?></span></p>
            <p class="mt10 region">
                <span>
                <?php if ($_smarty_tpl->tpl_vars['worker']->value->regionid) {?><?php echo $_smarty_tpl->tpl_vars['worker']->value->ancestornames;?>
<?php echo $_smarty_tpl->tpl_vars['worker']->value->regionname;?>
<?php }?>
                </span>
            </p>
            <p class="mt10">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value->skills; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                    <span rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->skill;?>
" class="mr10"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</span>
                <?php } ?>
            </p>
        </div>
    </div>
</div>
<div class="row clearfix mt20 yahei black6 box snapshotBox" style="width: 960px;padding:20px;background-color: #FFF;">
    <h3 class="mb20">个人照片</h3>
    <div class="boxShow">
        <div id="playimages" class="play clearfix relative">
            <div style="width: 635px; margin: auto;" class="snapshots">
                <?php $_smarty_tpl->tpl_vars['dcd'] = new Smarty_variable(json_decode($_smarty_tpl->tpl_vars['worker']->value->dcd,true), null, 0);?>
                <?php if ((isset($_smarty_tpl->tpl_vars['dcd']->value['imgs'])&&$_smarty_tpl->tpl_vars['dcd']->value['imgs'])) {?>
                    <div style="width: 635px; margin: auto;">
                        <div id="showcase" class="showcase">
                            <!-- 图片 start -->
                            <?php if (isset($_smarty_tpl->tpl_vars['dcd']->value['imgs'])) {?>
                                <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dcd']->value['imgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value) {
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                                    <div class="showcase-slide">
                                        <div class="showcase-thumbnail">
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"  name='resize'/>
                                            <div class="showcase-thumbnail-caption"></div>
                                            <div class="showcase-thumbnail-cover"></div>
                                        </div>
                                        <div class="showcase-content">
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
" name='resize'/>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php }?>
                            <!-- 图片 end -->
                        </div>
                    </div>
                <?php } else { ?>
                    <img src="/images/v2/startup_v_img.png" class="snapshotEdit" style="cursor:pointer;width: 635px;" />
                <?php }?>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix mt20 yahei black6 box basicInfo" style="width: 960px;padding:20px;background-color: #FFF;">
    <h3 class="mb20">基本信息</h3>
    <div class="boxShow">
        <div class="item name">
            <label>姓名</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->name;?>
</span>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->email) {?>
            <div class="item email">
                <label>邮箱</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->email;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->regionid) {?>
            <div class="item region">
                <label>地区</label>
                <span>
                    <?php echo $_smarty_tpl->tpl_vars['worker']->value->ancestornames;?>
<?php echo $_smarty_tpl->tpl_vars['worker']->value->regionname;?>

                </span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->tall) {?>
            <div class="item tall">
                <label>身高</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->tall;?>
cm</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->weight) {?>
            <div class="item weight">
            <label>体重</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->weight;?>
kg</span>
        </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->sex) {?>
            <div class="item sex">
                <label>性别</label><span><?php if ($_smarty_tpl->tpl_vars['worker']->value->sex==1) {?>男<?php } else { ?>女<?php }?></span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->bust||$_smarty_tpl->tpl_vars['worker']->value->waist||$_smarty_tpl->tpl_vars['worker']->value->hip) {?>
            <div class="item bwh">
                <label>三围</label>
                <?php if ($_smarty_tpl->tpl_vars['worker']->value->bust) {?><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->bust;?>
cm(胸围)</span><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['worker']->value->waist) {?><span class="ml10"><?php echo $_smarty_tpl->tpl_vars['worker']->value->waist;?>
cm(腰围)</span><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['worker']->value->hip) {?><span class="hip ml10"><?php echo $_smarty_tpl->tpl_vars['worker']->value->hip;?>
cm(臀围)</span><?php }?>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->hair) {?>
            <div class="item hair">
                <label>发色</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->hairname;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->shoe) {?>
            <div class="item shoe">
                <label>鞋号</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->shoe;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->birthday&&$_smarty_tpl->tpl_vars['worker']->value->birthday!='0000-00-00') {?>
            <div class="item birthday">
                <label>生日</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->birthday;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->constellationname) {?>
            <div class="item constellation">
                <label>星座</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->constellationname;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->degree) {?>
            <div class="item degree">
                <label>学历</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->degreename;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->profession) {?>
            <div class="item profession">
                <label>专业</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->professionname;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->hobby) {?>
            <div class="item hobby">
                <label>爱好特长</label><span><?php echo $_smarty_tpl->tpl_vars['worker']->value->hobby;?>
</span>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->regions) {?>
            <div class="item">
                <label>工作地点</label>
                <div class="workcitys" style="display: inline-block;">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value->regions; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <span rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->regionid;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->regionname;?>
</span>
                    <?php } ?>
                </div>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['worker']->value->skills) {?>
            <div class="item">
                <label>技能</label>
                <div class="business" style="display: inline-block;">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value->skills; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <span rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->skill;?>
" class="mr10"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</span>
                    <?php } ?>
                </div>
            </div>
        <?php }?>
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
                    <option value="">全部</option>
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
                    <option value="">全部</option>
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
            <div class="item">
                <label>身高</label><input type="text" name="tall"/>cm<span class="error"></span>
            </div>
            <div class="item">
                <label>体重</label><input type="text" name="weight"/>kg<span class="error"></span>
            </div>
            <div class="item">
                <label>性别</label><select name="sex"><option value="1">男</option><option value="0">女</option></select><span class="error"></span>
            </div>
            <div class="item">
                <label>胸围</label><input type="text" name="bust"/>cm<span class="error"></span>
            </div>
            <div class="item">
                <label>腰围</label><input type="text" name="waist"/>cm<span class="error"></span>
            </div>
            <div class="item">
                <label>臀围</label><input type="text" name="hip"/>cm<span class="error"></span>
            </div>
            <div class="item">
                <label>发色</label>
                <select name="hair">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hairList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                <label>鞋号</label><input type="text" name="shoe"/><span class="error"></span>
            </div>
            <div class="item">
                <label>生日</label><input type="text" name="birthday" data-date-format="yyyy-mm-dd" readonly="readonly" /><span class="error"></span>
            </div>
            <div class="item">
                <label>星座</label><select name="constellation">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['constellationList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                <label>学历</label><select name="degree">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['degreeList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</option>
                    <?php } ?>
                </select>
                <label>专业</label><select name="profession">
                    <option value="">请选择</option>
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['professionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                <label style="vertical-align: top;float: left;line-height: 30px;">期望工作<br/>城市</label>
                <div class="workcityBox fl" style="display:inline-block;width:300px;height: 100px;border: 1px solid #CCC;"></div>
                <span class="error"></span>
                <div class="workcityDemo" style="display:inline-block;width:300px;height: 80px;border: 1px solid #CCC;margin-left: 135px;">
                        <a rel="001001" href="javascript:void(0);">北京</a>
                        <a rel="001002" href="javascript:void(0);">天津</a>
                        <a rel="001003" href="javascript:void(0);">上海</a>
                        <a rel="001009001" href="javascript:void(0);">广州</a>
                        <a rel="001009012" href="javascript:void(0);">深圳</a>
                        <a rel="001028001" href="javascript:void(0);">成都</a>
                        <a rel="001027001" href="javascript:void(0);">西安</a>
                        <a rel="001021010" href="javascript:void(0);">大连</a>
                        <a rel="001019001" href="javascript:void(0);">南京</a>
                        <a rel="001034001" href="javascript:void(0);">杭州</a>
                </div>
            </div>
            <div class="item" style="width:1000px;margin-top: 10px;">
                <label style="vertical-align: top;float: left;">经济类型</label>
                <div class="businessBox fl" style="display:inline-block;width:300px;height: 80px;border: 1px solid #CCC;"></div>
                <span class="error"></span>
                <div class="businessDemo" style="display:inline-block;width:300px;height: 135px;border: 1px solid #CCC;margin-left: 135px;">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['skillList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <a rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</a>
                    <?php } ?>
                </div>
            </div>
            <div class="item mt10">
                <label style="vertical-align: top;">爱好</label><textarea style="width:305px;height:70px;resize: none;" name="hobby"></textarea><span class="error"></span>
            </div>
            <div class="item" style="width: 1000px;">
                <a href="javascript:void(0);" class="button save mt20 ml200">确定</a>
                <a href="javascript:void(0);" class="button cancel">取消</a>
            </div>

        </form>
    </div>
</div>
<div class="row clearfix mt20 yahei black6 expBox" style="width: 960px;padding:20px;background-color: #FFF;">
    <h3 class="mb20">工作经历</h3>
    <div class="exps">
        <ul><li class="date fs16">时间</li><li class="result fs16">作品</li><li class="skill fs16">角色</li><li class="description fs16">描述</li></ul>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value->exps; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                <li class="skill" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value->skill;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->skillname;?>
</li>
                <li class="description"><?php echo $_smarty_tpl->tpl_vars['dcd']->value['description'];?>
</li>
            </ul>
        <?php } ?>
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
                <label>角色：</label>
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
                </select>
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
    //个人图片展示
    function aShowcase(){
        $("#showcase").awShowcase({
            content_width:			635,
            content_height:			450,
            fit_to_parent:			false,
            auto:					false,
            interval:				1000,
            continuous:				false,
            loading:				true,
            tooltip_width:			200,
            tooltip_icon_width:		32,
            tooltip_icon_height:	32,
            tooltip_offsetx:		18,
            tooltip_offsety:		0,
            arrows:					true,
            buttons:				false,
            btn_numbers:			false,
            keybord_keys:			true,
            mousetrace:				false, /* Trace x and y coordinates for the mouse */
            pauseonover:			true,
            stoponclick:			false,
            transition:				'hslide', /* hslide/vslide/fade */
            transition_delay:		0,
            transition_speed:		500,
            show_caption:			'onload', /* onload/onhover/show */
            thumbnails:				true,
            thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
            thumbnails_direction:	'horizontal', /* vertical/horizontal */
            thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
            dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
            speed_change:			false, /* Set to true to prevent users from swithing more then one slide at once. */
            viewline:				false, /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
            custom_function:		function(){
                $(".showcase-content img[name='resize']").load(function(){
                    var width =this.width;
                    var height = this.height;
                    var r_width = 0;
                    var r_height = 0;
                    if(width>=height){
                        if(width>=615){
                            var per = 615/width;
                            r_width = 615;
                            r_height = height*per;
                        }else{
                            r_width = width;
                            r_height = height;
                        }
                    }else{
                        if(height>=450){
                            var per = 450/height;
                            r_height = 450;
                            r_width = width*per;
                        }else{
                            r_width = width;
                            r_height = height;
                        }
                    }
                    if(r_width != 0 && r_height != 0){
                        $(this).css({ 'width':r_width,'height':r_height});
                        $(this).attr('name','resized');
                    }
                });
            } /* Define a custom function that runs on content change */
        });

        resizeImg();

        $('.showcase-arrow-next').hide();
        $('.showcase-arrow-previous').hide();

        $('#showcase').mouseenter(function(){
            $('.showcase-arrow-next').show();
            $('.showcase-arrow-previous').show();
        }).mouseleave(function(){
            $('.showcase-arrow-next').hide();
            $('.showcase-arrow-previous').hide();
        });

        $('.showcase-thumbnail-restriction').css('width','584px');
    }

    function resizeImg(){
        $(".showcase-content img[name='resize']").each(function(){
            var width =this.width;
            var height = this.height;
            var r_width = 0;
            var r_height = 0;
            if(width>=height){
                if(width>=615){
                    var per = 615/width;
                    r_width = 615;
                    r_height = height*per;
                }else{
                    r_width = width;
                    r_height = height;
                }
            }else{
                if(height>=450){
                    var per = 450/height;
                    r_height = 450;
                    r_width = width*per;
                }else{
                    r_width = width;
                    r_height = height;
                }
            }
            if(r_width != 0 && r_height != 0){
                $(this).css({ 'width':r_width,'height':r_height});
                $(this).attr('name','resized');
            }
        });
    }
    /*个人图片展示方法结束*/
    /*上传头像方法*/
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
            y1 = (num > 120) ? (num - 120)/2 : 0;
        }else if(direction == 'left'){
            x1 = (num > 120) ? (num - 120)/2 : 0;
            y1 = 78;
        }else if(direction == 'center'){
            x1 = (data.width - 120)/2;
            y1 = (data.height - 120)/2;
        }else{
            x1 = 78 ;
            y1 = 78 ;
        }
        if(num > 120){
            x2 = x1 + 120 ;
            y2 = y1 + 120 ;
            plus = 120;
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
        var scaleX = 120 / (selection.width || 1);
        var scaleY = 120 / (selection.height || 1);
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
    }
    /*上传头像结束*/

    $(document).ready(function(){
        aShowcase();
        $("select[name='provinceid']").live("change",function(){
            var pid = $(this).val();
            $("select[name='cityid']").empty().append("<option value=''>全部</option>");
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
                        if(data.width < 120 || data.height < 120){
                            alert ('上传的图像尺寸太小，请重新上传');
                            return false;
                        };
                        var path = data.url;
                        $('#userPhoto').attr('src', "/temp/"+path);
                        $('#userImagePath').val(path);
                        $(".big img").attr("src","/temp/"+path).show();

                        var img = new Image();
                        img.src = "/temp/"+path ; ;
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
                type:1
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

        /*----------------------个人照片-----------------------------*/
        $('.snapshotBox .edit').live('click',function(){
            $(".snapshotBox .boxHidden").show();
            $(".snapshotBox .boxShow").hide();
        });
        $(".snapshotBox .cancel").bind("click",function(){
            $(".snapshotBox .boxHidden").hide();
            $(".snapshotBox .boxShow").show();
        });
        //图片上的“X”
        $('#picList .close').live('click',function(){
            $(this).parent().remove();
        });
        //hover状态
        $('#picList li').hover(function(){
            $(this).children('.close').css("display",'block');
        },function(){
            $(this).children('.close').css("display",'none');
        });

        $('#pic_upload').uploadify({
            overrideEvents: ['onSelectError','onDialogClose'],
            'swf'      : '/kit/upload/uploadify.swf',
            'uploader' : '/upload/snapshot',
            'width'  : 198,
            'height' : 53,
            'buttonImage' : '/images/www/snapshot.png',
            'fileTypeExts' : '*.jpg;*.gif;*.png;*.jpeg',
            'fileTypeDesc' : 'Image Files (.JPG, .GIF, .PNG, .JPEG)',
            'fileSizeLimit' : '2MB',
            'auto' : true,
            'multi' : true,
            'successTimeout' : 10,
            'removeTimeout' : 0,
            'fileObjName' : 'snapshot',
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
            },
            'onUploadSuccess' : function(file, result) {
                if (result != null && result != "") {
                    var result = eval("(" + result + ")");
                    if(result.success){
                        var data = result.data;
                        $('#picList').height('auto');

                        var lastindex = data.url.lastIndexOf('.');
                        var smallPicUrl = data.url.substr(0,lastindex);
                        var suffix = data.url.substr(lastindex+1).toLowerCase();
                        if(suffix == 'png'){
                            smallPicUrl=  smallPicUrl+'_800.jpg';
                        }else  if(suffix == 'jpg' || suffix == 'jpeg'){
                            smallPicUrl =  smallPicUrl+'_800.'+suffix;
                        }else{
                            smallPicUrl =  data.url;
                        }

                        $('#picList').append('<li rel="'+data.id+'"><img src="'+smallPicUrl+'"><input type="hidden" name="pic[]" value="'+data.url+'"></input><a href="javascript:void(0);" class="close">×</a></li>');

                        $('#picList .close').bind('click',function(){
                            $(this).parent().remove();
                        });
                        //hover状态
                        $('#picList li,#piclist .close').hover(function(){
                            $(this).children('.close').css("display",'block');
                        },function(){
                            $(this).children('.close').css("display",'none');
                        });
                    }else
                        alert("上传失败，请检查您的图片格式是否正确。");
                } else {
                    alert("上传失败，请稍后重试.");
                }
            }
        });

        //保存产品截图
        $(".snapshotBox .save").live("click",function(){
            var ids = [], pic = [];
            $('#picList li').each(function(){
                ids.push($(this).attr('rel'));
                pic.push($(this).find('input').val());
            });
            if(pic.length == 0){
                alert('请添加图片');
            }else{
                if(pic.length<3){
                    alert("请至少上传3张图片");
                    return false;
                }
                $.post('/profile/savesnapshot',{ ids:ids,paths:pic},function(data){
                    var html = '';
                    if(data.status){
                        var paths = eval("("+data.paths+")");
                        if(pic.length >0){
                            html='<div style="width: 635px; margin: auto;">';
                            html+='<div id="showcase" class="showcase">';
                            for(var i=0;i<paths.length;i=i+1){
                                html+='<div class="showcase-slide">';
                                html+='<div class="showcase-thumbnail">';
                                html+='<img src="'+paths[i]+'"  name="resize" />';
                                html+='<div class="showcase-thumbnail-caption"></div>';
                                html+='<div class="showcase-thumbnail-cover"></div>';
                                html+='</div>';
                                html+='<div class="showcase-content">';
                                html+='<img src="'+paths[i]+'" name="resize"/>';
                                html+='</div>';
                                html+='</div>';
                            }
                            html+='</div>';
                            html+='</div>';
                            $('.snapshots').empty().append(html);
                            aShowcase();
                            resizeImg();
                            $('.showcase-thumbnail-restriction').css('width','584px');
                            $('.snapshot_anchor').parent('li').removeClass('false').removeClass('warn');
                            $('.snapshot_anchor').css('color','#333')
                            $(".snapshotBox .cancel").trigger("click");
                        }else{ //没有图片
                            alert('请添加图片');
                        }
                    }else{
                        alert ('添加失败');
                    }
                },'json');
            }
        });
        //修改个人图片结束

        //编辑基本信息
        $(".basicInfo .edit").live("click",function(){
            $(".basicInfo .boxShow").hide();
            $(".basicInfo .boxHidden").show();
            var provinceid = $(".basicInfo .region span").attr("provinceid");
            var cityid = $(".basicInfo .region span").attr("cityid");
            $("select[name='cityid']").empty().append("<option value=''>全部</option>");
            $.post("/profile/findSubRegion",{ pid:provinceid},function(jd){
                for(var i=0;i<jd.length;i=i+1){
                    $("select[name='cityid']").append("<option value='"+jd[i].id+"'>"+jd[i].name+"</option>");
                }
                $(".basicInfo select[name='provinceid']").val(provinceid);
                $(".basicInfo select[name='cityid']").val(cityid);
            },"json");
            $(".workcitys span").each(function(){
                $(".workcityBox").append('<a href="javascript:void(0);" rel="'+$(this).attr("rel")+'">'+$(this).text()+'<span></span></a>');
            });
            $(".business span").each(function(){
                $(".businessBox").append('<a href="javascript:void(0);" rel="'+$(this).attr("rel")+'">'+$(this).text()+'<span></span></a>');
            });
            $(".basicInfo input[name='name']").val($(".basicInfo .name span").attr("rel"));
            $(".basicInfo input[name='email']").val($(".basicInfo .email span").attr("rel"));
            $(".basicInfo input[name='tall']").val($(".basicInfo .tall span").attr("rel"));
            $(".basicInfo input[name='weight']").val($(".basicInfo .weight span").attr("rel"));
            $(".basicInfo select[name='sex']").val($(".basicInfo .sex span").attr("rel"));
            $(".basicInfo input[name='bust']").val($(".basicInfo .bust").attr("rel"));
            $(".basicInfo input[name='waist']").val($(".basicInfo .waist").attr("rel"));
            $(".basicInfo input[name='hip']").val($(".basicInfo .hip").attr("rel"));
            $(".basicInfo select[name='hair']").val($(".basicInfo .hair span").attr("rel"));
            $(".basicInfo input[name='shoe']").val($(".basicInfo .shoe span").attr("rel"));
            $(".basicInfo input[name='birthday']").val($(".basicInfo .birthday span").attr("rel"));

            $(".basicInfo select[name='constellation']").val($(".basicInfo .constellation span").attr("rel"));
            $(".basicInfo select[name='degree']").val($(".basicInfo .degree span").attr("rel"));
            $(".basicInfo select[name='profession']").val($(".basicInfo .profession span").attr("rel"));
            $(".basicInfo textarea[name='hobby']").val($(".basicInfo .hobby span").attr("rel"));
            $(".basicInfo input[name='birthday']").datepicker();
        });
        //工作城市
        $(".workcityDemo a").live("click",function(){
            var rel = $(this).attr("rel"),text = $(this).text();
            if($(".workcityBox a[rel]").length < 3){
                if($(".workcityBox a[rel='"+rel+"']").length == 0){
                    $(".workcityBox").append("<a href='javascript:void(0);' rel='"+rel+"'>"+text+"<span></span></a>");
                }else{
                    alert("该经纪类型已经存在，不能再次添加");
                }
            }else{
                alert("城市数量不能超过3个")
            }

        });

        $(".workcityBox a span").live("click",function(){
            $(this).parent("a").remove();
        });
        //经纪类型
        $(".businessDemo a").live("click",function(){
            var rel = $(this).attr("rel"),text = $(this).text();
            if($(".businessBox a[rel]").length < 3){
                if($(".businessBox a[rel='"+rel+"']").length == 0){
                    $(".businessBox").append("<a href='javascript:void(0);' rel='"+rel+"'>"+text+"<span></span></a>");
                }else{
                    alert("该经纪类型已经存在，不能再次添加");
                }
            }else{
                alert("技能不能超过3个")
            }

        });

        $(".businessBox a span").live("click",function(){
            $(this).parent("a").remove();
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
            if(!$.validator($(".basicInfo input[name='bust']").val(),'integer')){
                $(".basicInfo input[name='bust']").next(".error").html("只能是数字");
                return false;
            }
            if(!$.validator($(".basicInfo input[name='waist']").val(),'integer')){
                $(".basicInfo input[name='waist']").next(".error").html("只能是数字");
                return false;
            }
            if(!$.validator($(".basicInfo input[name='hip']").val(),'integer')){
                $(".basicInfo input[name='hip']").next(".error").html("只能是数字");
                return false;
            }
            if(!$.validator($(".basicInfo input[name='shoe']").val(),'num')){
                $(".basicInfo input[name='shoe']").next(".error").html("只能是数字");
                return false;
            }
            var workcitys = '';
            $(".workcityBox a").each(function(){
                workcitys += $(this).attr("rel")+',';
            });
            if(workcitys == ''){
                $(".workcityBox").next(".error").html("请选择期望工作城市");
            }

            var business = '';
            $(".businessBox a").each(function(){
                business += $(this).attr("rel")+',';
            });
            if(business == ''){
                $(".businessBox").next(".error").html("请选择经历类型");
            }
            submited=true;
            $.post("/profile/saveWorkerBasicInfo",$.extend(true,$(".basicInfo form").serializeObject(),{ business:business,workcitys:workcitys}),function(data){
                submited=false;
                if(parseInt(data) == 1){ //成功
                    $(".basicInfo .name span").text($(".basicInfo input[name='name']").val());
                    $(".basicInfo .email span").text($(".basicInfo input[name='email']").val());
                    $(".basicInfo .region span").text($(".basicInfo select[name='provinceid'] option:selected").text()+$(".basicInfo select[name='cityid'] option:selected").text());
                    $(".basicInfo .region span").attr("provinceid",$(".basicInfo select[name='provinceid']").val());
                    $(".basicInfo .region span").attr("cityid",$(".basicInfo select[name='cityid']").text());

                    $(".basicInfo .tall span").text($(".basicInfo input[name='tall']").val()+"cm");
                    $(".basicInfo .weight span").text($(".basicInfo input[name='weight']").val()+"kg");
                    $(".basicInfo .sex").attr("rel",$(".basicInfo select[name='sex']").val());
                    $(".basicInfo .sex span").text($(".basicInfo select[name='sex'] option:selected").text());

                    $(".basicInfo .bust").text($(".basicInfo input[name='bust']").val()+"cm");
                    $(".basicInfo .waist").text($(".basicInfo input[name='waist']").val()+"cm");
                    $(".basicInfo .hip").text($(".basicInfo input[name='hip']").val()+"cm");
                    $(".basicInfo .hair").attr("rel",$(".basicInfo select[name='hair']").val());
                    $(".basicInfo .hair span").text($(".basicInfo select[name='hair'] option:selected").text());
                    $(".basicInfo .shoe span").text($(".basicInfo input[name='shoe']").val());
                    $(".basicInfo .birthday span").text($(".basicInfo input[name='birthday']").val());

                    $(".basicInfo .constellation").attr("rel",$(".basicInfo select[name='constellation']").val());
                    $(".basicInfo .constellation span").text($(".basicInfo select[name='constellation'] option:selected").text());
                    $(".basicInfo .degree").attr("rel",$(".basicInfo select[name='degree']").val());
                    $(".basicInfo .degree span").text($(".basicInfo select[name='degree'] option:selected").text());
                    $(".basicInfo .profession").attr("rel",$(".basicInfo select[name='profession']").val());
                    $(".basicInfo .profession span").text($(".basicInfo select[name='profession'] option:selected").text());
                    $(".basicInfo .hobby span").attr("rel",$(".basicInfo textarea[name='hobby']").val());
                    $(".basicInfo .hobby span").text($(".basicInfo textarea[name='hobby']").val());

                    $(".workcitys").empty();
                    $(".workcityBox a").each(function(){
                        $(".workcitys").append('<span rel="'+$(this).attr("rel")+'" class="mr10">'+$(this).text()+'</span>');
                    });
                    $(".workcityBox").empty();

                    $(".business").empty();
                    $(".businessBox a").each(function(){
                        $(".business").append('<span rel="'+$(this).attr("rel")+'" class="mr10">'+$(this).text()+'</span>');
                    });
                    $(".businessBox").empty();

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
            $(".expBox .boxHidden select[name='skill']").val($("ul[class='exp"+id+"']").find('.skill').attr("rel"));
            $(".expBox .boxHidden textarea[name='description']").val($("ul[class='exp"+id+"']").find('.description').text());
            $(".expBox .exps").hide();
            $(".expBox .boxHidden").show();
            $("input[name='startmonth']").datepicker();
            $("input[name='endmonth']").datepicker();
        });
        //删除
        $(".expBox .delete").live("click",function(){
            var id = $(this).attr("rel");
            if(confirm("您确定删除该记录吗")){
                $.post("/profile/deleteWorkExp",{ id:id},function(data){
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
            var skill = $(".expBox select[name='skill']").val();
            var skill_text = $(".expBox select[name='skill'] option:selected").text();
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
            $.post("/profile/saveWorkerExp",$(".expBox form").serializeObject(),function(data){
                submited=false;
                if(data.success){ //成功
                    var id = $(".expBox input[name='id']").val();
                    if(id == ''){
                        $(".exps").append("<ul class='exp"+data.id+"'><li class='date'>从<span class='start'>"+startMonth+"</span>到<span class='end'>"+endMonth+"</span></li><li class='result'>"+result+"</li><li class='skill' rel='"+skill+"'>"+skill_text+"</li><li class='description'>"+description+"</li><li class='operation'><a href='javascript:void(0);' class='edit fs12' rel='"+data.id+"'>修改</a><a href='javascript:void(0);' class='delete fs12 ml10' rel='"+data.id+"'>删除</a></li></ul>");
                    }else{
                        $("ul.exp"+data.id).html("<li class='date'>从<span class='start'>"+startMonth+"</span>到<span class='end'>"+endMonth+"</span></li><li class='result'>"+result+"</li><li class='skill' rel='"+skill+"'>"+skill_text+"</li><li class='description'>"+description+"</li><li class='operation'><a href='javascript:void(0);' class='edit fs12' rel='"+data.id+"'>修改</a><a href='javascript:void(0);' class='delete fs12 ml10' rel='"+data.id+"'>删除</a></li>");
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
    });
</script>
</html>

<?php }} ?>
