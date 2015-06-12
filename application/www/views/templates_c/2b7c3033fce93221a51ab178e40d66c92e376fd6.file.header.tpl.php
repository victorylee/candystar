<?php /* Smarty version Smarty-3.1.20, created on 2015-05-29 15:58:04
         compiled from "/mnt/hgfs/website/candystar/application/www/views/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6559027345551a3ca04cf75-19476611%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b7c3033fce93221a51ab178e40d66c92e376fd6' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/www/views/templates/header.tpl',
      1 => 1432871143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6559027345551a3ca04cf75-19476611',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5551a3ca0ce050_44142820',
  'variables' => 
  array (
    'module' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5551a3ca0ce050_44142820')) {function content_5551a3ca0ce050_44142820($_smarty_tpl) {?>
<div class="headline yahei">
    <div style="width: 100%;border-bottom: #e5e6e5 solid 1px;">
        <div class="row clearfix" style="width: 1000px;height: 90px;position: relative;">
            <div class="col" style="width:120px">
                <a href="/"><img src="/images/www/logo.png" class="logo" style="width: 100px"/></a>&nbsp;
                
            </div>
            <div class="col" style="width:680px">
                <div class="menu_bar yahei" style="position: relative;">
                    <a class="<?php if ($_smarty_tpl->tpl_vars['module']->value=='index') {?>selected<?php }?>" href="/">首页</a>
                    <?php if (isset($_smarty_tpl->tpl_vars['user']->value)&&($_smarty_tpl->tpl_vars['user']->value->tp=='004002')) {?>
                        <a class="<?php if ($_smarty_tpl->tpl_vars['module']->value=='worker') {?>selected<?php }?>" href="/worker">星秀场</a>
                    <?php } elseif (isset($_smarty_tpl->tpl_vars['user']->value)&&($_smarty_tpl->tpl_vars['user']->value->tp=='004001')) {?>
                        <a class="<?php if ($_smarty_tpl->tpl_vars['module']->value=='job') {?>selected<?php }?>" href="/job">星机会</a>
                    <?php }?>
                    <a class="<?php if ($_smarty_tpl->tpl_vars['module']->value=='news') {?>selected<?php }?>" href="javascript:void(0);">星闻</a>
                    <a class="<?php if ($_smarty_tpl->tpl_vars['module']->value=='institutions') {?>selected<?php }?>" href="javascript:void(0);">星机构</a>
                    <a class="<?php if ($_smarty_tpl->tpl_vars['module']->value=='join') {?>selected<?php }?>" href="javascript:void(0);">加入我们</a>
                </div>
            </div>
            <div class="col" style="width:200px">
                <?php if (isset($_smarty_tpl->tpl_vars['user']->value)&&$_smarty_tpl->tpl_vars['user']->value!='') {?>
                    <a class="fs14 fr mr10 rc5 signinbtn" href="/home/logout" style="color: #FFF;display: inline-block;padding: 10px;margin-top: 28px;">
                        退出
                    </a>
                    <a class="fs14 fr mr10" href="/profile" style="color: #666;display: inline-block;padding: 10px;margin-top: 28px;">
                        <?php if (isset($_smarty_tpl->tpl_vars['user']->value)) {?><?php echo $_smarty_tpl->tpl_vars['user']->value->name;?>
<?php }?>
                    </a>
                <?php } else { ?>
                    <a href="/home/signup"  class="fr rc5 signupbtn">注册</a>
                    <a href="/home/signin" class="fr rc5 signinbtn">登录</a>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<style type="text/less">
    .headline{
        width: auto;
        background-color: #fff;
        .logo{
            position: absolute;
            top:11px;
            z-index: 88888;
        }
        .signinbtn{
            display: inline-block;padding: 10px 25px;font-size:12px;color: #FFF;border: #ec7013 solid 1px;margin-right: 10px;margin-top: 28px;background-color: #ec7013;
        }
        .signupbtn{
            display: inline-block;padding: 10px 25px;font-size:12px;color: #ec7013;border: #ec7013 solid 1px;margin-top: 28px;
        }
        .menu_bar{
            margin-top:30px;
            a{
                display: inline-block;
                font-size: 18px;
                padding: 10px 0;
                margin: 0 24px;
                color: #333;
                cursor:pointer;
                border-bottom: #FFF solid 2px;
                &:hover{
                    color:#ed8028;
                     border-bottom: #ed8028 solid 2px;
                }
                &.selected{
                    color:#ed8028;
                     border-bottom: #ed8028 solid 2px;
                }
            }
        }
}
</style><?php }} ?>
