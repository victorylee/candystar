<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="/images/favicon.ico" rel="icon">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="超级星探">
    <meta name="description" content=""/>
    <meta name="renderer" content="webkit">
    <title>超级星探 | 工作机会 </title>
    <link rel="stylesheet" type="text/css" href="/kit/base.css" />
    <script type="text/javascript" src="/kit/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/kit/jquery/jquery.extends.min.js"></script>

    <style type="text/less">
        .title-info{
            width: 620px;
            height: 90px;
            background-color: #3d9ccc;
            position: relative;
            left: -15px;
            top: 18px;
            padding-right: 10px;
            padding-left: 40px;
            color: #FFF;

            .title-triangle {
                display: inline-block;
                width: 15px;
                position: absolute;
                left: -15px;
                bottom: -7px;
                border-bottom: 8px solid transparent;
                border-right: 15px solid #156e9b;
            }

        }

        .item{
            display: inline-block;
            width: 300px;
            height: 30px;
            font-size: 14px;
            label{
                display: inline-block;
                width: 80px;
                text-align: right;
                margin-right: 10px;
            }

        }


    </style>

</head>

<body style="background: url(/images/www/bg.png) repeat;">
{$module='job'}
{include file="header.tpl"}
<div  class="row clearfix mt30 mb30 yahei" style="min-height: 300px;" >
    <div class="col" style="width: 680px;background-color: #FFF;">
        <div class="title-info">
            <div class="lh40 fs26 pt10" title="{$job->name}">{$job->name}</div>
            <div class="fs16 lh30">{$job->company}</div>
            <span class="title-triangle"></span>
        </div>

        <div class="pt30 pl30 pb20" style="border-bottom: #CCC solid 1px;">
            <h1 class="fs20 lh40 fwb black6 mb20">基本信息：</h1>
            <div class="item"><label>招聘角色：</label><span>{$job->skillname}</span></div>
            <div class="item"><label>性别要求：</label><span>{$job->sexname}</span></div>
            <div class="item"><label>招聘人数：</label><span>{$job->quantity}人</span></div>
            <div class="item"><label>工作地点：</label><span>{$job->region}</span></div>
            <div class="item"><label>发布日期：</label><span>{$job->startdate}</span></div>
            <div class="item"><label>截止日期：</label><span>{$job->enddate}</span></div>
        </div>

        <div class="pt20 pl30 pb30 pr40" style="border-bottom: #CCC solid 1px;">
            <h1 class="fs20 lh40 fwb black6 mb20">职位描述：</h1>
            <div class="black9 fs14 lh40">
                {$job->description}
            </div>
        </div>

    </div>
    <div class="col ml20 pd20 yahei" style="width:260px;background-color: #FFF;min-height: 560px;">
        <h6 class="black6">职位发布经纪人</h6>
        <div class="mt20 mb10 tac">
            <img src="/images/www/broker_avatar.png" alt=""/>
        </div>
        <div class="fs16 lh30 black6 tac">{$job->company}</div>
        <div class="fs16 lh30 black6 tac">{$job->levelname}：{$job->broker}</div>
        {*<div class="fs16 lh30 black6 tac pb20">经纪类型：电视剧、网络剧、综艺节目，电视剧、网络剧、综艺节目</div>*}
        <div></div>
    </div>
</div>
{include file="footer.tpl"}
</body>
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
</html>

