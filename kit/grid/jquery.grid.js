/**
 * version: 3.0b4
 * author: Mac_J
 * need: core.js, mousewheel.js
 */
(function($){
    function getMousePos(e){
        var e = e || window.event, d = document
            , de = d.documentElement, db = d.body;
        return {
            x: e.pageX || (e.clientX + (de.scrollLeft || db.scrollLeft)),
            y: e.pageY || (e.clientY + (de.scrollTop || db.scrollTop))
        }
    }

    $.fn.grid = function(options) {
        var self=this;
        self.config={
            rowHeight: 32,
            sortLocally:true,
            params:{},
            pager:{
                pageNo:0,
                pageSize:0,
                pagerLength:0,
                pageCount:0,
                total:0
            }
        }
        $.extend(true,self.config, options);
        self.data = {};
        self.selected=false;
        var yb = $('<div class="ybar"></div>').appendTo(self);
        var yy = $('<div></div>').appendTo(yb);
        var mm = $('<div class="main"></div>').appendTo(self);

        var hd = $('<div class="head"></div>').appendTo(mm);
        mm.append('<div class="clear"></div>');
        if(self.config.customRow) //如果自定义列的话则隐藏表头，只显示表头的下边框线
            hd.height(1);
        var bd = $('<div class="body"></div>').appendTo(mm);
        var tt = $('<div class="tt"></div>').appendTo(bd);
        var pgr = $('<div class="pager"></div>').appendTo(self);
        var _h, _s;
        $('body').mousemove(function(e) {
            if (_s) {
                var dx = e.clientX - _s.mouseX;
                var cd = _s.th;
                var nw = cd.width() + dx;
                if (nw > 0) {
                    bd.width(bd.width() + dx);
                    tt.width(bd.width());
                    hd.width(hd.width() + dx);
                    _s.mouseX = e.clientX;
                    mm.find('[name="' + _s.name + '"][class="th"]').width(nw);
                    mm.find('[name="' + _s.name + '"][class="td"]').width(nw-5);
                }
            }
            if (_h) {
                var p = getMousePos(e);
                _h.css({
                    left : p.x + 5,
                    top : p.y + 12
                });
            }
        }).mouseup(function(e) {
            if (_s){
                $.each(self.config.cols, function(n, c){
                    if(c.name == _s.name)
                        c.width = hd.find('[name=' + c.name + ']').width();
                    if(_s.group && c.name == _s.group)
                        c.width = hd.find('[name=' + _s.group + ']').width();
                });
                _s = 0;
            }
            if (_h) {
                _h.remove();
                _h = 0;
            }
        });
        self.sortBy = [];
        var tw = 0;
        $.each(self.config.cols, function(n, c) {
            var f = c.name = c.name || c.field;
            var o = $('<div></div>').attr('name', f);
            var p = c.parent || hd;
            o.appendTo(p);
            if(c.parent){
                o.attr('group', c.group);
                o.parents('.th').css('border-right', 'none');
            }
            if (c.hidden) {
                o.hide();
                return;
            }
            if(!c.isGroup)
                tw += c.width + (c.parent?1:2);
            o.attr('unselectable', 'on');
            if (c.sizeable != false && !c.isGroup) {
                var rh = $('<div class="sizer" unselectable="on"></div>');
                rh.mousedown(function(e) {
                    var fcs = self.config.fixedCols || [];
                    if ($.inArray(c.field, fcs) < 0
                        && $.inArray(c.group, fcs) < 0) {
                        var th = hd.find('[group=' + f + ']').last();
                        if(th.length==0)
                            th = hd.find('[name=' + f + ']');
                        _s = {
                            th: th,
                            name: th.attr('name'),
                            group: th.attr('group'),
                            mouseX : e.clientX
                        }
                    }
                    return false;
                }).appendTo(o);
            }
            o.width(c.width-5);//th只需要加5像素左边距，所以只需要减5像素

            if (c.sort) {
                var u = $('<span class="icon icon-triangle-1-s"></span>');
                $('<div class="sort"></div>').append(u).appendTo(o);
                self.sortBy.push({
                    field : f,
                    sort : "asc"
                });
            }
            var a = c.header;
            if (!a) {
                a = $('<div class="title" unselectable="on"></div>').css('text-align', c.halign||'left').append(c.title);
                var x = (c.parent) ? (c.height || self.config.rowHeight) : (self.config.headerHeight || self.config.rowHeight);
                a.height(x).css('line-height', x + 'px');
            }
            if (c.moveable != false) {
                a.mousedown(function(e) {
                    if (_s)
                        return;
                    var fcs = self.config.fixedCols || [];
                    if ($.inArray(c.field, fcs) < 0
                        && $.inArray(c.group, fcs) < 0) {
                        _h = $('<div class="dragHelper"><div>');
                        _h.html('&nbsp;' + c.title + '&nbsp;');
                        _h.col = $.inArray(f, $.map(self.config.cols, function(c) {
                            return c.name || c.field
                        }));
                        _h.name = f;
                        $('body').append(_h);
                        var p = getMousePos(e);
                        _h.css({
                            left : p.x + 5,
                            top : p.y + 12
                        });
                    }
                    return false;
                }).mousemove(function(e) {
                    if (_h && f != _h.name) {
                        var td = bd.find('.td[name=' + f + ']');
                        td.addClass("dropable")
                    }
                }).mouseout(function(e) {
                    var td = bd.find('.td[name=' + f + ']');
                    td.removeClass("dropable");
                }).mouseup(function() {
                    var fcs = self.config.fixedCols || [];
                    if ($.inArray(f, fcs) >= 0)
                        return true;
                    if (_h && f != _h.name) {
                        if (hd.find('[name=' + _h.name + ']').attr('group') != o
                            .attr('group')) {
                            _h.remove();
                            return;
                        }
                        var td = mm.find('.td[name=' + f + '],.th[name=' + f + ']');
                        td.removeClass("dropable");
                        $.each(td, function(n, c) {
                            var s = $(c);
                            var t = s.parent().find('.td[name=' + _h.name
                                + '],.th[name=' + _h.name + ']');
                            s.before(t);
                        });
                        var k = $.inArray(f, $.map(self.config.cols, function(c) {
                            return c.name || c.field;
                        }));
                        self.config.cols.splice(k, 0, self.config.cols[_h.col]);
                        self.config.cols.splice(_h.col + 1, 1);
                        _h.remove();
                    }
                });
            }
            o.addClass('th').append(a);
        });
        hd.width(tw-2);
        bd.width(tw-1);
        tt.width(tw-2);
        (bd.width()+60)>=500?  $(bd).parent().parent().parent().width(bd.width()+60):  $(bd).parent().parent().parent().width(500);
        self.sort = function() {
            var sb = self.sortBy;
            if (self.config.sortLocally) {
                var dd = [];
                $.each(self.data.list, function(n, c) {
                    dd.push(c);
                });
                dd.sort(function(a, b) {
                    for ( var i = 0; i < sb.length; i++) {
                        var k = sb[i].field;
                        var x = a[k];
                        var y = b[k];
                        var cp = null;
                        for ( var j = 0; j < self.config.cols.length; j++) {
                            var cc = self.config.cols[j];
                            if (cc.field == k) {
                                cp = cc.comparator;
                                break;
                            }
                        }
                        if (cp)
                            return cp(x, y, sb[i].sort, a, b);
                        if (x == y) {
                            continue
                        } else {
                            if (sb[i].sort == 'desc') {
                                return x > y ? 1 : -1
                            } else {
                                return x < y ? 1 : -1
                            }
                        }
                    }
                    return 0
                });
                self.update();
            } else {
                var ob = $.map(sb, function(c) {
                    return c.field + ' ' + c.sort
                }).join(',');
                self.load({
                    orderBy : ob
                });
            }
        }
        hd.find('.sort').click(function() {
            var el = $(this).hide();
            var tu = 'icon-triangle-1-n';
            var td = 'icon-triangle-1-s';
            var fd = el.parent().attr('name');
            var sp = el.children();
            var sb = self.sortBy;
            for ( var i = 0; i < sb.length; i++) {
                if (sb[i].field == fd)
                    break;
            }
            sb.splice(i, 1);
            if (sp.hasClass(tu)) {
                sb = sb.unshift({
                    field : fd,
                    sort : 'asc'
                });
                sp.removeClass(tu).addClass(td)
            } else {
                sb = sb.unshift({
                    field : fd,
                    sort : 'desc'
                });
                sp.removeClass(td).addClass(tu)
            }
            self.sort();
            return false;
        });
        self.adjustYBar = function() {
            yb.height(bd.height());
            if(self.config.customRow)
                yb.css('margin-top','0px');
            yy.height(tt.height() + self.config.rowHeight);
            yb.css('overflow-y', (yy.height() > yb.height()) ? 'scroll' : 'auto');
        }
        //self.afterAdjust
        self.adjust = function(vp) {
            if (vp)
                self.height(vp.height());
            var h = self.height();
            var g = pgr ? 32 : 0;
            h = h - hd.height();
            if(self.config.pager.pagerLength>0){
                bd.height(h - g - self.config.rowHeight - (self.config.footerHeight || 0));
            }else{
                bd.height(h - g - self.config.rowHeight - (self.config.footerHeight || 0)+22);
                self.height(h-8);
            }
            self.adjustYBar();
            if(self.afterAdjust)
                self.afterAdjust();
        };
        self.newRow = function(r, ridx) {
            var rkey = self.config.key ? r[self.config.key] : 'r' + ridx;
            //self.data[k] = r;
            var tr = $('<div name="' + rkey + '" class="tr" ridx="'+ridx+'"></div>');
            if(self.config.customRow){

            }else{
                tr.height(self.config.rowHeight);
                $.each(self.config.cols, function(n, c) {
                    var b = $('<div class="td" ridx="'+ridx+'"></div>');
                    b.height(self.config.rowHeight).css('line-height', self.config.rowHeight + 'px');
                    b.attr('name', c.name || c.field);
                    b.css('text-align',c.align || 'left');
                    if (c.group) {
                        var p = a.find('.td[name=' + c.group + ']');
                        p.css('border-right', 'none');
                        p.append(b);
                        b.attr('group', c.group);
                    } else {
                        b.appendTo(tr);
                    }
                    if (!c.isGroup) {
                        b.append((c.render) ? c.render(r, tr, self) : r[c.field]);
//				b.append('&nbsp;').css('text-align', c.align || 'left');
                        b.width(c.width-10);//加了5像素内边距，所以额外减10像素
                    }
                    if (c.hidden)
                        b.hide();
                });
                tr.click(self.config.onRowClick || function() {
                    self.find('.tr').removeClass('selected');
                    self.selected = $(this).addClass('selected');
                })
            }
            tr.append('<div class="clear"></div>');
            tt.append('<div class="clear"></div>');
            return tr;
        }

        //插入一行，如果未指定行数则插在尾部，在顶部插入时ridx=0
        self.insertRow = function(r, ridx) {
            self.adjustYBar();
            if(ridx){
                self.data.splice(ridx,0,r);
                return self.newRow(r, ridx).appendTo(tt);
            }
            self.data.push(r);
            return self.newRow(r, self.data.length-1).appendTo(tt);
        }

        //删除一行
        self.deleteRow = function(ridx) {
            if(ridx<0)
                return false;
            if(self.data.length-1<ridx)
                return false;
            if(self.selected){
                if(parseInt(self.selected.attr('ridx'))==ridx)
                    self.selected=false;
            }
            var len = self.data.length-1;
            self.data.splice(ridx,1);
            var tr = tt.find('div[ridx=' + ridx + ']');
            tr.remove();
            //删除时ridx值与data中的key不一致
            for(var i=parseInt(ridx)+1;i<=len;i++)
            {
                var tem = tt.find('div[ridx=' + i + ']');
                tem.attr('ridx',i-1);
            }
            self.adjustYBar();
            return true;
        }

        //删除一行
        self.deleteRowByRid = function(key) {
            if (key.length == 0) {
                var s = self.selected;
                if (s)
                    key.push(s.attr('ridx'));
                self.selected = false;
            }
            var len = self.data.length-1;
            if (self.data[key]){
                self.data.splice(key,1);
            }
            var tr = tt.find('div[ridx=' + key + ']');
            tr.remove();
            for(var i=parseInt(key)+1;i<=len;i++)
            {
                var tem = tt.find('div[ridx=' + i + ']');
                tem.attr('ridx',i-1);
            }
            self.adjustYBar();
            return key;
        }

        //删除多行 未写完
        self.deleteRowByMultiRid = function(keys) {
            keys = keys || [];
            if (keys.length == 0) {
                var s = self.selected;
                if (s)
                    keys.push(s.attr('name'));
                self.selected = false;
            }
            $.each(keys, function(n, k) {
                if (self.data[k])
                    delete self.data[k];
                var tr = tt.children('.tr[name=' + k + ']');
                tr.next().remove();
                tr.remove();
            });
            self.adjustYBar();
            return keys;
        }

        //获取主键列
        self.getKey=function(){
            return self.config.key;
        }

        self.update = function() {
            tt.empty();
            yy.height(2);
            $.each(self.data, function(ridx, r) {
                self.adjustYBar();
                self.newRow(r, ridx).appendTo(tt);
            });
            tt.find('.tr:odd').addClass('h2o');
            tt.find('.tr:even').addClass('h2e');
            hd.find('.sort').show();
            if (!self.config.autoHeight)
                self.adjust(self.parent());
            if (self.config.afterLoad)
                self.config.afterLoad(self.data, self);

            pgr.empty();
            if($.trim(self.config.loader.url).length>0 && self.config.pager.pageSize > 0){
                //First
                pgr.append('<span action="1" class="pageNo">首页</span>');

                if(self.config.pager.pagerLength>0){
                    //Prev Skip
                    var prevskip=self.config.pager.pageNo - self.config.pager.pagerLength;
                    if(prevskip>0)
                        pgr.append('<span action="'+prevskip+'" class="pageNo">前'+self.config.pager.pagerLength+'页</span>');
                    else
                        pgr.append('<span action="1" class="pageNo">前'+self.config.pager.pagerLength+'页</span>');
                }

                //Prev
                var prev=self.config.pager.pageNo - 1;
                if(prev>0)
                    pgr.append('<span action="'+prev+'" class="pageNo">上一页</span>');
                else
                    pgr.append('<span action="1" class="pageNo">上一页</span>');

                if(self.config.pager.pagerLength>0){
                    //Next Skip
                    var nextskip=self.config.pager.pageNo + self.config.pager.pagerLength;
                    if(nextskip<self.config.pager.pageCount)
                        pgr.append('<span action="'+nextskip+'" class="pageNo">后'+self.config.pager.pagerLength+'页</span>');
                    else
                        pgr.append('<span action="'+self.config.pager.pageCount+'" class="pageNo">后'+self.config.pager.pagerLength+'页</span>');
                }
                //Next
                var next=self.config.pager.pageNo + 1;
                if(next<self.config.pager.pageCount)
                    pgr.append('<span action="'+next+'" class="pageNo">下一页</span>');
                else
                    pgr.append('<span action="'+self.config.pager.pageCount+'" class="pageNo">下一页</span>');
                //Last
                pgr.append('<span action="'+self.config.pager.pageCount+'" class="pageNo">尾页</span>');

                pgr.children('span[action]').click(function() {
                    self.load({pageNo:$(this).attr('action')});
                });

                pgr.append('&nbsp;&nbsp;第');
                var pnTf = $('<input type="text" name="pageNo"/>');
                pnTf.attr('maxlength', (''+self.config.pager.pageCount).length);
                pnTf.val(self.config.pager.pageNo);
                pnTf.change(function() {
                    this.value = Math.max(1, Math.min(this.value, self.config.pager.pageCount));
                });
                pnTf.keydown(function(e) {
                    var key = e.which;
                    if (key == 13) {
                        e.preventDefault();
                        var n = pnTf.val() || 1;
                        if (isNaN(n) || n < 0){
                            n = 1;
                        }
                        if(n > self.config.pager.pageCount){
                            n = self.config.pager.pageCount;
                        }
                        self.load({pageNo:n});
                    }
                });

                pgr.append(pnTf);
                pgr.append('页，共&nbsp;<b style="font-size: 14px;">'+self.config.pager.pageCount+'</b>&nbsp;页');
            }

            return self;
        }

        //直接加载数据
        self.loadData = function(dd) {
            self.data=dd;
            self.config.loader.url='';
            self.config.pager.pageNo=0;
            self.config.pager.pageSize=0;
            self.config.pager.pagerLength=0;
            self.config.pager.pageCount=0;
            self.config.pager.total=0;
            self.update();
//            hd.find('.sort').show();
        };

        //从URL加载数据
        self.load = function(pms) {
            pms = pms || {};
            $.extend(true,self.config.loader.params, pms);
            var pno = self.config.loader.params.pageNo;
            var pct = self.config.loader.params.pageCount;
            if(pno > pct){
                self.config.loader.params.pageNo = pct;
            }
            $.post(self.config.loader.url, self.config.loader.params, function(jd) {
                if (jd.success) {
                    self.data=jd.data.list;
                    self.formdata=jd.data.formlist;
                    self.config.pager.pageNo=jd.data.pageNo;
                    self.config.pager.pageSize=jd.data.pageSize;
                    self.config.pager.pagerLength=jd.data.pagerLength;
                    self.config.pager.pageCount=jd.data.pageCount;
                    self.config.pager.total=jd.data.total;
                    self.update();
//                    hd.find('.sort').show();
                }
            },"json");
        };

        //直接获取JSON数据
        self.getData=function(){
            return self.data;
        }

        //直接获取JSON数据
        self.getFormData=function(){
            return self.formdata;
        }

        //根据行号获取一行
        self.getRow=function(ridx){
            return self.data[ridx];
        }

        self.getPageNo = function(){
            return parseInt(self.config.pager.pageNo);
        }

        //根据Key获取一行
        self.getRowByKey=function(key){
            for (var x in self.data) {
                var r=self.data[x];
                if(r[self.getKey()]==key){
                    return r;
                }
            }
            return false;
        }

        //根据Key和列名获取单元格数据
        self.getRowItemByKey=function(key,col){
            for (var x in self.data) {
                var r=self.data[x];
                if(r[self.getKey()]==key){
                    return r[col];
                }
            }
            return false;
        }

        //根据行号获取一行
        self.setRow=function(ridx,r){
            self.data.splice(ridx,1,r);
        }

        //根据Key获取一行
        self.setRowByKey=function(key,r){
            for (var x in self.data) {
                var oldr=self.data[x];
                if(oldr[self.getKey()]==key){
                    self.data.splice(x,1,r);
                    break;
                }
            }
        }

        //根据行号设置行元素值
        self.setRowItem=function(ridx,col,value){
            var r=self.data[ridx];
            r[col]=value;
            self.data.splice(ridx,1,r);
        }

        //根据Key获取一行
        self.setRowItemByKey=function(key,col,value){
            for (var x in self.data) {
                var oldr=self.data[x];
                if(oldr[self.getKey()]==key){
                    var r=self.data[x];
                    r[col]=value;
                    self.data.splice(x,1,r);
                    break;
                }
            }
        }

        //扩展获取选中行的主键集合，必须制定key选项
        self.selectedKey = function(){
            if(self.selected)
                return bd.find('.selected').attr("name");
            return false;
        };

        yb.scroll(function() {
            bd.scrollTop(this.scrollTop+1)
        });
       /* bd.mousewheel(function(e, delta, deltaX, deltaY) {
            yb.scrollTop(yb.scrollTop() - deltaY * self.config.rowHeight);
            return false;
        });*/
        if (self.config.loader.autoLoad){
            if($.trim(self.config.loader.url).length>0){
                self.load();
            }else{
                self.loadData(self.config.data);
            }
        }else if (!self.config.autoHeight)
            self.adjust(self.parent());
        return self;
    }
})(jQuery);