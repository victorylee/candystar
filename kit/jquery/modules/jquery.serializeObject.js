/*jquery form to json*/
(function($){
    $.serializeObject=function(){
        var obj={};
        var array=this.serializeArray();
        $(array).each(function(){
            if(obj[this.name]){
                if($.isArray(obj[this.name])){
                    obj[this.name].push(this.value);
                }else{
                    obj[this.name]=[obj[this.name],this.value];
                }
            }else{
                obj[this.name]=this.value;
            }
        });
        return obj;
    };
})(jQuery);
