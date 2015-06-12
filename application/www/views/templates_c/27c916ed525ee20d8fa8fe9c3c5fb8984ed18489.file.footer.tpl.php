<?php /* Smarty version Smarty-3.1.20, created on 2015-05-29 15:58:29
         compiled from "/mnt/hgfs/website/candystar/application/www/views/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18107957705551a3ca12cc39-73199503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27c916ed525ee20d8fa8fe9c3c5fb8984ed18489' => 
    array (
      0 => '/mnt/hgfs/website/candystar/application/www/views/templates/footer.tpl',
      1 => 1432886305,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18107957705551a3ca12cc39-73199503',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.20',
  'unifunc' => 'content_5551a3ca156955_38403245',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5551a3ca156955_38403245')) {function content_5551a3ca156955_38403245($_smarty_tpl) {?><style type="text/less">
    .row{
        margin-left: auto;
        margin-right: auto;
        width: 1000px;
    }

    .c_headline{
        /*width: auto;*/
        height: 80px;
        background-color: #43403f;
        .logo{
            position: absolute;
            top:4px;
            /*width: 150px;*/
            z-index: 80;
        }
        .dropBox{
            z-index:999;
            display: none;
            float: right;
            position:relative;
            top:67px;
            left:0;
            div.box{
                display:inline-block;
                width:150px;
                background: #fff;
                padding:5px 0 0;
                box-shadow: 0 2px 3px #ccc;
                margin-top:13px;
                color:#3c3d3c;
                .recharge{
                    display: inline-block;width: 40px;height: 20px;padding:3px;margin-left:10px;text-align:center;background-color: #e9f8fd;color:#326b9b;cursor:pointer;border:#bbbcbc solid 1px;
                    &:hover{
                         background-color: #336992;color:#FFF;border:none;
                     }
                }
                ul{
                    li{
                        display:inline-block;
                        width: 108px;
                        border-bottom: 1px solid #ddd;
                        &:hover{
                             color:#333;
                             background-color: #f6f6f6;
                         }
                        a{
                            width: 90px;
                            height:30px;
                            line-height:30px;
                            margin-top:0;
                            border-right:0;
                            color:#336b93;
                            text-align: left;
                            padding-left: 10px;
                            &:hover{
                                 color:#2088e4;
                                 text-decoration: underline;
                             }
                        }
                    }
                    li{
                        display:inline;
                    }
                }
            }

        }
        .box:hover > div > .dropBox{
            display: block;
        }
        .box:hover > .profile {
            color: #f8f1e4;
            background: #c55d00;
        }
    }

    .pager {
        margin-top: 8px;color: #333;
    .button { height: 24px; line-height: 24px; padding: 4px 8px; cursor: pointer; border: 1px solid #9aafe5; }
    .pageNo{
        font-size: 16px;margin: 2px; padding: 5px 20px;cursor: pointer;border: 1px solid #9aafe5;color: #2e6ab1;border-radius: 3px;
    &:hover {
         color: #fff;background: #9aafe5;border: 1px solid #2e6ab1;
     }
    &.selected {
         color: #fff;background: #9aafe5;border: 1px solid #2e6ab1;
     }
    }
    input { margin: 0 5px; width: 40px;text-align: center; font-weight: bold;font-size: 15px;}
    #pageindex {
        color: #333;border: 1px solid #9aafe5;
        font-size: 15px;
    .box-shadow(0px 1px 1px rgba(0,0,0,0.075));
    .transform(border linear .2s);
    .transform(box-shadow linear .2s);
    &:focus{
         border-color: rgba( 82,168,236,0.8);outline: 0;
     .box-shadow(0 1px 1px rgba(0,0,0,0.075));
     .box-shadow(0 0 8px rgba(82,168,236,.6));
     }
    }
    }

    div#footer {
        width: 100%;
        height: 260px;
        background-color: #FFF;
        border-top: 2px solid #a5a6aa;
        h1{
            font-size: 30px;
            color: #666;
            font-weight: normal;
            margin-top: 30px;
        }
        .linked{
            a{
                color: #666;
                font-size:14px;
                &:hover{
                     color: #FFF;
                     text-decoration: underline;
                 }
            }
            .spliterspan{
                color:#666;
                font-size:14px;
                padding: 0 8px;
            }
        }

        .sina{
            display: inline-block;
            width: 80px;
            height: 68px;
            background: url(/images/weibo_hover.png) no-repeat 0 0;
        &:hover{
             background: url(/images/weibo.png) no-repeat 0 0;
         }
        }
        .wechat{
            display: inline-block;
            width: 80px;
            height: 68px;
            background: url(/images/wechat_hover.png) no-repeat 0 0;
        &:hover{
             background: url(/images/wechat.png) no-repeat 0 0;
         }
        }
        .apple{
            display: inline-block;
            width: 80px;
            height: 68px;
            background: url(/images/apple_hover.png) no-repeat 0 0;
        &:hover{
             background: url(/images/apple.png) no-repeat 0 0;
         }
        }
        .android{
            display: inline-block;
            width: 80px;
            height: 68px;
            background: url(/images/android_hover.png) no-repeat 0 0;
        &:hover{
             background: url(/images/android.png) no-repeat 0 0;
         }
        }
        .wechat_img{
            width: 185px;
            height: 176px;
            position: absolute;
            top: -196px;
            left: 192px;
        }
        .wechat_img_show{
            width: 116px;
            height: 110px;
            position: absolute;
            left: 425px;
            top:0;
        }
    }
</style>
<div id="footer">
    <div class="row clearfix yahei" >
        <div class="col mt5" style="width: 610px;height: 250px">
            <div class="linked mt40">
                <a href="/home/about.html" target="_blank">企业简介</a><span class="spliterspan">|</span>
                <a href="/home/service.html" target="_blank">服务条款</a><span class="spliterspan">|</span>
                <a href="/home/job.html"  target="_blank">人才招聘</a><span class="spliterspan">|</span>
                <a href="/home/contact.html"  target="_blank">联系我们</a><span class="spliterspan">|</span>
                
                
                
                
            </div>
            <div class="col mt40" style="width: 570px;position: relative;">
                
                
                
                
                
            </div>
            <p class="black6 fs12 lh20 mt45">2015&nbsp;©&nbsp;超级星探网站版权所有</p>
            <p class="black6 fs12 lh20">北京天创华育科技有限公司&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;京ICP备14059845号-1</p>
            <p class="black6 fs12 lh20">北京市海淀区中关村东路18号1号楼3层C-307-001号</p>
        </div>
        <div class="col pl50" style="width: 320px;height: 200px;margin-top:30px;border-left: 1px solid #666;">
            <span class="fs24 pl40 lh60" style="background: url(/images/www/footer_phone.png) no-repeat 0 4px; color: #8c8d8c;">010-64465803</span><br>
            <span class="fs12 lh24 black6">地址：北京市朝阳区西坝河南路甲1号新天第大厦A座603</span><br>
            <span class="fs12 lh24 black6">传真：010-64465803-809</span><br>
            <span class="fs12 lh24 black6">网址：www.cakestudy.com</span><br>
            <span class="fs12 lh24 black6">邮编：100028</span>
        </div>
    </div>
</div>


<script type="text/javascript">
    var pages = 1;
    $('#pageindex').live('keyup',function(){
        pages = parseInt(pages);
        if(isNaN(Math.max(1, Math.min($(this).val(), pages)))){
            $(this).val(1);
        }else{
            $(this).val(Math.max(1, Math.min($(this).val(), pages)));
        }
    });
    $('#pageindex').live('keydown',function(e) {
        var key = e.which;
        pages = parseInt(pages);
        if (key == 13) {
            e.preventDefault();
            var n = $(this).val() || 1;
            if (isNaN(n)){
                n = 1;
            }
            if(n > pages){
                n = pages;
            }
            findpage(n);
        }
    });
//    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
//    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F94c9e27c2efeee2eb60baef1b927278f' type='text/javascript'%3E%3C/script%3E"));
//    var _hmt = _hmt || [];
//    (function() {
//        var hm = document.createElement("script");
//        hm.src = "//hm.baidu.com/hm.js?94c9e27c2efeee2eb60baef1b927278f";
//        var s = document.getElementsByTagName("script")[0];
//        s.parentNode.insertBefore(hm, s);
//    })();

    $(document).ready(function(){
        $(".wechat").hover(function(){
            $(".wechat_img").show();
            $(".wechat_img_show").hide();
        },function(){
            $(".wechat_img").hide();
            $(".wechat_img_show").show();
        });
    });

</script>
<?php }} ?>
