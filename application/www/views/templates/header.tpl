
<div class="headline yahei">
    <div style="width: 100%;border-bottom: #e5e6e5 solid 1px;">
        <div class="row clearfix" style="width: 1000px;height: 90px;position: relative;">
            <div class="col" style="width:120px">
                <a href="/"><img src="/images/www/logo.png" class="logo" style="width: 100px"/></a>&nbsp;
                {*<span class="yahei" style="font-size: 22px;color:#ec6f16;position: absolute;left:180px;top:52px;">理科教学贴心服务专家</span>*}
            </div>
            <div class="col" style="width:680px">
                <div class="menu_bar yahei" style="position: relative;">
                    <a class="{if $module eq 'index'}selected{/if}" href="/">首页</a>
                    {*{if isset($user)&&($user->tp eq '004002')}*}
                        <a class="{if $module eq 'worker'}selected{/if}" href="/worker">星秀场</a>
                    {*{elseif isset($user)&&($user->tp eq '004001')}*}
                        <a class="{if $module eq 'job'}selected{/if}" href="/job">星机会</a>
                    {*{/if}*}
                    {*<a class="{if $module eq 'news'}selected{/if}" href="javascript:void(0);">星闻</a>*}
                    <a class="{if $module eq 'company'}selected{/if}" href="/home/company">星机构</a>
                    <a class="{if $module eq 'join'}selected{/if}" href="/home/join">加入我们</a>
                </div>
            </div>
            <div class="col" style="width:200px">
                {if isset($user)&&$user != ''}
                    <a class="fs14 fr mr10 rc5 signinbtn" href="/home/logout" style="color: #FFF;display: inline-block;padding: 10px;margin-top: 28px;">
                        退出
                    </a>
                    <a class="fs14 fr mr10" href="/profile" style="color: #666;display: inline-block;padding: 10px;margin-top: 28px;">
                        {if isset($user)}{$user->name}{/if}
                    </a>
                {else}
                    <a href="/home/signup"  class="fr rc5 signupbtn">注册</a>
                    <a href="/home/signin" class="fr rc5 signinbtn">登录</a>
                {/if}
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
</style>