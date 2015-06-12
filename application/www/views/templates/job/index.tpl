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
    <title>超级星探 | 星机会 </title>
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
            &.selected{
                     background: #ec6f16;
                     height: 28px;
                     color: #fff;
                 }
        }
        }

        a.search_advance{
            color: #999999;
            font-size: 12px;
            margin-left:10px;
            margin-top:10px;
        &:hover{
             color: #3b70e1;
             text-decoration: underline;
         }
        }

        .searchForm{
           padding:20px 30px;
            input[type="text"]{
                display: inline-block;
                width: 330px;
                height: 25px;
                padding: 5px;
                line-height: 15px;
                color: #333;
                vertical-align: middle;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 0;
                outline: none;
                background-color: #ffffff;
                border: 1px solid #cccccc;
            .transform(border linear .2s);
            .transform(box-shadow linear .2s);
            .border-radius(0);
            .inner-shadow(0 1px 1px rgba(0,0,0,0.075));
            &:focus{
                 border-color: rgba( 82,168,236,0.8);
                 border-color: #0866c6\9;
                 outline: 0;
             .inner-shadow(0 1 px 1 px rgba(0, 0, 0, 0.075));
             .inner-shadow(0 0 8 px rgba( 82, 168, 236, 0.6));
             }
            }
        }

        .job{
            background-color: #FFF;
            border-bottom: 1px dotted #e6e6e6;
            height: 245px;
            display:block;
            &:hover{
                background-color: #fbfbfb;
             }

             .sendjl{
                 position: relative;
                 .tip{
                     color: #93d553;display: inline-block;position: absolute;left: 230px;top:10px;width: 120px;
                 }
                 .send{
                     background: url(/images/www/job_sendjl.png) no-repeat;display: inline-block;width: 205px;height: 42px;border: #CCC solid 1px;position: absolute;left: 360px;top:0;
                 }
             }
        }




    </style>

</head>

<body style="background: url(/images/www/bg.png) repeat;">
{$module='job'}
{include file="header.tpl"}
<div  class="row clearfix mt20 mb20 yahei fs12" style="background-color: #FFF;">
        <div class="row searchForm">
            <div class="col" style="width: 80px;"><label class="black9 lh40">关键字：</label></div>
            <div class="col" style="width:850px;">
                <input name="keyword" type="text" style="width: 500px;" placeholder="请输入工作关键词，如群众演员"/>
                <a id="search" href="javascript:void(0);" class="bitbtn fs16 lh26 normal tac rc5" style="width: 100px;border: none;margin-left: 30px;" onclick="findpage(1);">搜索</a>

                {*<a class="search_advance" style="text-decoration: underline;" href="javascript:void(0);">高级搜索</a>*}
            </div>
        </div>
        <div id="search_skill" class="row" style="margin-left: 20px;">
            <div class="col" style="width: 80px;"><label class="black9 lh30">职业类型：</label></div>
            <div class="col" style="width:900px;">
                <div class="tag"><a href="javascript:void(0);" rel="" class="selected">全部</a></div>
                {foreach from = $skillList item="item"}
                    <div class="tag"><a href="javascript:void(0);" rel="{$item->id}">{$item->name}</a></div>
                {/foreach}
            </div>
        </div>
        <div id="search_region" class="row" style="margin-top:10px;margin-left: 20px; margin-bottom: 20px;">
            <div class="col" style="width: 80px;"><label class="black9 lh30">工作地点：</label></div>
            <div class="col" style="width:830px;">
                <div>
                    <div class="tag" rel="1"><a href="javascript:void(0);" rel="" class="selected">全国</a></div>
                    {foreach from = $regionList item="item"}
                        <div class="tag"><a href="javascript:void(0);" rel="{$item->id}">{$item->name}</a></div>
                    {/foreach}
                </div>
            </div>
        </div>
        {*<a id="search" href="javascript:void(0);" class="bitbtn fs16 lh30 normal tac rc5" style="width: 100px;border: none;margin-left: 50px;" onclick="findpage(1);">搜索</a>*}

</div>

<div class="row clearfix" style="width: 1000px;margin-bottom: 30px;">
    <div class="col" style="width: 780px;min-height: 300px;background-color: #FFF;">
        <div class="fs12 lh50 pl30" style="background-color: #FFF;border-bottom: 1px dotted #e6e6e6;">
            <span>共为您找到  <label id="jobnum" style="color:#ff7f4b;" class="fs18 fwb"></label>  个职位</span>
        </div>

        <div id="jobs">
            <div class="job yahei">
                <div class="col" style=" padding: 30px;">
                    <a href="/job/384246791073301655"><img src="/images/www/job_left.png" alt=""/></a>
                </div>
                <div class="col pt30 pb30">
                    <a class="fs20 lh26 black3" href="/job/384246791073301655">我是男神2</a>
                    <div class="fs16 lh26 black6">张洪涛：傲月、小军、王晨、李春、傲月、小军、王晨、李春……</div>
                    <div class="fs16 lh26 black9">面试时间：2015-07-01</div>
                    <div class="fs16 lh26 black9">面试地点：北京市北三环 运城宾馆901</div>
                    <div class="fs24 lh40 fw500" style="color: #eb6b79;">名额：不限/已报名12人</div>
                    <div class="sendjl">
                        <span class="fs18 lh40 tip">火热进行中……</span>
                        <a href="javascript:void(0);" class="send rc5 mt10"></a>
                    </div>
                </div>
            </div>
        </div>

        <div id="pageData" class="mt20"></div>
    </div>
    <div class="col ml20" style="width: 200px;">
        <img src="http://image0.lietou-static.com/img/550a4241430ab1cff2f572d902c.png" width="200" height="80">
        <div class="clear" style="height: 10px;"></div>
        <img src="http://image0.lietou-static.com/img/550a4241430ab1cff2f572d902c.png" width="200" height="80">
        <div class="clear" style="height: 10px;"></div>
        <img src="http://image0.lietou-static.com/img/550a4241430ab1cff2f572d902c.png" width="200" height="80">
        <div class="clear" style="height: 10px;"></div>
    </div>

</div>
{include file="footer.tpl"}
</body>
<script type="text/javascript">

    /*查找工作*/
    function findpage(pageIndex){
        //关键字
        var keyword = $("input[name='keyword']").val();
        // 职位类型
        var skill = '';
        $('#search_skill a.selected').each(function(){
            if($(this).attr('rel') != ''){
                if(skill == ''){
                    skill += "'"+$(this).attr('rel')+"'";
                }else{
                    skill += ",'"+$(this).attr('rel')+"'";
                }
            }
        });
        // 工作地点
        var region = '';
        $('#search_region a.selected').each(function(){
            if($(this).attr('rel') != ''){
                if(region == ''){
                    region += $(this).attr('rel');
                }else{
                    region += ","+$(this).attr('rel');
                }
            }
        });

        $.post('/job/findSome',{ "keyword":keyword,"skill":skill,"region":region,"pageIndex":pageIndex},function(jd){
            var jobs = jd.jobs,strHTML='';
            if(jobs.length>0){
                for(var i=0;i<jobs.length;i=i+1){
                    strHTML += '<div class="job yahei"><div class="col" style=" padding: 30px;">';
                    strHTML += '<a href="/job/'+jobs[i].id+'" target="_blank"><img src="/images/www/job_left.png" alt=""/></a></div>';
                    strHTML += '<div class="col pt30 pb30">';
                    strHTML += '<a class="fs20 lh26 black3" href="/job/'+jobs[i].id+'">'+jobs[i].name+'</a>';
                    strHTML += '<div class="fs16 lh26 black6">张洪涛：傲月、小军、王晨、李春、傲月、小军、王晨、李春……</div>';
                    strHTML += '<div class="fs16 lh26 black9">面试时间：2015-07-01</div>';
                    strHTML += '<div class="fs16 lh26 black9">面试地点：北京市北三环 运城宾馆901</div>';
                    strHTML += '<div class="fs24 lh40 fw500" style="color: #eb6b79;">名额：不限/已报名12人</div>';
                    strHTML += '<div class="sendjl">';
                    strHTML += '<span class="fs18 lh40 tip">火热进行中……</span>';
                    strHTML += '<a href="javascript:void(0);" class="send rc5 mt10"></a>';
                    strHTML += '</div></div></div>';
                }
                $('#jobs').html(strHTML);
                $('#pageData').html(jd.pageStr);
            }else{
                $('#jobs').html('<p class="fs18 black3 tac" style="height:300px;line-height: 300px;">对不起，还没有符合您搜索条件的工作，敬请期待。</p>');
                $('#pageData').empty();
            }

            $('#jobnum').html(jd.total);
            if(pageIndex>1)
                $('body,html').animate({ scrollTop:130},1000);
        },'json');
    }

    $(document).ready(function(){
        findpage(1);

        $('.search_advance').live('click',function(){
            var name = $(this).html();
            if(name == '高级搜索'){
                $('#search_skill').show();
                $('#search_region').show();
                $(this).html('收起');
            }else if(name == '收起'){
                $('#search_skill').hide();
                $('#search_region').hide();
                $(this).html('高级搜索');
            }
        });

        $('#search_skill a').live('click',function(){
            var rel = $(this).attr('rel');
            if($('#search_skill a.selected').length >=3 && !$(this).hasClass('selected') && rel != '' ){
                alert('最多选择三个职业类型！');
                return;
            }

            if(rel == ''){
                $('#search_skill a').removeClass('selected');
                $(this).addClass('selected');
            }else{
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected');
                    if($('#search_skill a.selected').length == 0){
                        $('#search_skill a[rel=""]').addClass('selected');
                    }
                }else{
                    $('#search_skill a[rel=""]').removeClass('selected');
                    $(this).addClass('selected');
                }
            }
            findpage(1);
        });

        $('#search_region a').live('click',function(){
            var rel = $(this).attr('rel');
            if($('#search_region a.selected').length >=3 && !$(this).hasClass('selected') && rel != ''){
                alert('最多选择三个工作地点！');
                return;
            }

            var rel = $(this).attr('rel');
            if(rel == ''){
                $('#search_region a').removeClass('selected');
                $(this).addClass('selected');
            }else{
                if($(this).hasClass('selected')){
                    $(this).removeClass('selected');
                    if($('#search_region a.selected').length == 0){
                        $('#search_region a[rel=""]').addClass('selected');
                    }
                }else{
                    $('#search_region a[rel=""]').removeClass('selected');
                    $(this).addClass('selected');
                }
            }

            findpage(1);
        });
    });
</script>
</html>

