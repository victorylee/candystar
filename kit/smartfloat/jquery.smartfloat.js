/**
 * Created by hope on 14-9-18.
 */
$.fn.smartFloat = function() {
    var position = function(element) {
        var top = element.position().top, //获取匹配元素相对父元素的顶部的偏移。 到距离
            pos = element.css("position");
        $(window).scroll(function() {  //当页面滚动时
            var scrolls = $(this).scrollTop(); //滚动条相对于其顶部的偏移
            if (scrolls > top) { //
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        top: 0
                    });
                    $("html,body").css({ 'background-image':'url(about:blank)','background-attachment':'fixed'});
                } else {
                    element.css({
                        top: scrolls
                    });
                    $("html,body").css({ 'background-image':'url(about:blank)','background-attachment':'fixed'});
                }
            }else {
                element.css({
                    position: "static",
                    top: top
                });
            }
        });
    };
    return $(this).each(function() {
        position($(this));
    });
};