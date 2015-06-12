function AddLog(sharetype, urltype, url) {
    //$.post("/Jobs/Jobs/AddWeixinShareLog", { url: url, urltype: urltype, sharetype: sharetype }, function () { });
};

var wechatShareInfo = {
    appId: "",
    MsgImg: "http://www.cakestudy.com/images/wechat/02.jpg",
    TLImg: "http://www.cakestudy.com/images/wechat/02.jpg",
    url: "",
    title: "",
    desc: "",
    weibodesc: "",
    urltype:""
};

function shareInfoInit(img, url, title, desc, weibodesc, urltype) {
    wechatShareInfo.MsgImg = img;
    wechatShareInfo.TLImg = img;
    wechatShareInfo.url = url;
    wechatShareInfo.title = title;
    wechatShareInfo.desc = desc;
    wechatShareInfo.weibodesc = weibodesc;
    wechatShareInfo.urltype = urltype;
};

(function () {
    var onBridgeReady = function () {
        //分享给好友
        WeixinJSBridge.on('menu:share:appmessage', function (e) {
            WeixinJSBridge.invoke('sendAppMessage', {
                "appid": wechatShareInfo.appId,
                "img_url": wechatShareInfo.MsgImg,
                "img_width": "80",
                "img_height": "80",
                "link": wechatShareInfo.url,
                "desc": wechatShareInfo.desc,
                "title": wechatShareInfo.title
            });
        });
        //分享给好友圈
        WeixinJSBridge.on('menu:share:timeline', function (e) {
            WeixinJSBridge.invoke('shareTimeline', {
                "img_url": wechatShareInfo.TLImg,
                "img_width": "80",
                "img_height": "80",
                "link": wechatShareInfo.url,
                "desc": wechatShareInfo.desc,
                "title": wechatShareInfo.title
            });
        });
        //分享到微博
        WeixinJSBridge.on('menu:share:weibo', function (e) {
            WeixinJSBridge.invoke('shareWeibo', {
                "content": wechatShareInfo.weibodesc + ' ' + wechatShareInfo.url,
                "url": wechatShareInfo.url
            });
        });
        //分享到非死不可
        WeixinJSBridge.on('menu:share:facebook', function (e) {
            WeixinJSBridge.invoke('shareFB', {
                "img_url": wechatShareInfo.TLImg,
                "img_width": "120",
                "img_height": "120",
                "link": wechatShareInfo.url,
                "desc": wechatShareInfo.desc,
                "title": wechatShareInfo.title
            });
        });
    };
    if (document.addEventListener) {
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    } else if (document.attachEvent) {
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    }
})();