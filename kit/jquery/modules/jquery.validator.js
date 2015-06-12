jQuery.validator = function(objValue, rule,message) {

    function sfm_str_trim(strIn) {
        return strIn.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
    }

    function VWZ_IsEmpty(value) {
        value = sfm_str_trim(value);
        return (value.length) == 0 ? true : false;
    }

    function TestRequiredInput(objValue){
        var ret = true;
        if (VWZ_IsEmpty(objValue)) {
            ret = false;
        }else if (objValue.getcal && !objValue.getcal()) {
            ret = false;
        }
        return ret;
    }

    function TestMaxLen(objValue, strMaxLen) {
        var ret = true;
        if (eval(objValue.length) > eval(strMaxLen)) {
            ret = false;
        } //if
        return ret;
    }

    function TestMinLen(objValue, strMinLen) {
        var ret = true;
        if (eval(objValue.length) < eval(strMinLen)) {
            ret = false;
        } //if
        return ret;
    }

    function TestInputType(objValue, strRegExp) {
        var ret = true;
        var charpos = objValue.search(strRegExp);
        if (objValue.length > 0 && charpos >= 0){
            ret = false;
        } //if
        return ret;
    }

    function TestEmail(email) {
        var splitted = email.match("^(.+)@(.+)$");
        if (splitted == null) return false;
        if (splitted[1] != null) {
            var regexp_user = /^\"?[\w-_\.]*\"?$/;
            if (splitted[1].match(regexp_user) == null) return false;
        }
        if (splitted[2] != null) {
            var regexp_domain = /^[\w-\.]*\.[A-Za-z]{2,4}$/;
            if (splitted[2].match(regexp_domain) == null) {
                var regexp_ip = /^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
                if (splitted[2].match(regexp_ip) == null) return false;
            } // if
            return true;
        }
        return false;
    }

    function TestRegExp(objValue, strRegExp) {
        var ret = true;
        if (objValue.length > 0 && !objValue.match(strRegExp)) {
            ret = false;
        } //if
        return ret;
    }

    function TestFileExtension(objValue, cmdvalue) {
        var ret = false;
        var found = false;

        if (objValue.length <= 0)
        { //The 'required' validation is not done here
            return true;
        }

        var extns = cmdvalue.split(";");
        for (var i = 0; i < extns.length; i++)
        {
            ext = objValue.substr(objValue.length - extns[i].length, extns[i].length);
            ext = ext.toLowerCase();
            if (ext == extns[i])
            {
                found = true;
                break;
            }
        }
        if (!found)
            ret = false;
        else
            ret = true;
        return ret;
    }

    if (typeof objValue != 'undefined' && typeof rule != 'undefined' ) { // name and value given, set cookie
        var ret=true;
        var strValidateStr=rule;
        var epos = strValidateStr.search("=");
        var command = "";
        var cmdvalue = "";
        if (epos >= 0)
        {
            command = strValidateStr.substring(0, epos);
            cmdvalue = strValidateStr.substr(epos + 1);
        }
        else
        {
            command = strValidateStr;
        }
        switch (command)
        {
            case "req":
            case "required":
            {
                ret = TestRequiredInput(objValue);
                break;
            }
            case "maxlength":
            case "maxlen":
            {
                ret = TestMaxLen(objValue, cmdvalue)
                break;
            }
            case "minlength":
            case "minlen":
            {
                ret = TestMinLen(objValue, cmdvalue)
                break;
            }
            case "alnum":
            case "alphanumeric":
            {
                ret = TestInputType(objValue, "[^A-Za-z0-9]");
                break;
            }
            case "alnum_s":
            case "alphanumeric_space":
            {
                ret = TestInputType(objValue, "[^A-Za-z0-9\\s]");
                break;
            }
            case "num":
            case "numeric":
            case "dec":
            case "decimal":
            {
                if (objValue.length > 0 && !objValue.match(/^[\-\+]?[\d\,]*\.?[\d]*$/)) {
                    ret = false;
                } //if
                break;
            }
            case "money":
            {
                if (objValue.length > 0 && !objValue.match(/^\+?[1-9]\d{1,9}\.\d{0,2}$|^\+?\d\.\d{0,2}$|^\+?[1-9]\d{1,9}$|^\d?$/)) {
                    ret = false;
                } //if
                break;
            }
            case "alphabetic":
            case "alpha":
            {
                ret = TestInputType(objValue, "[^A-Za-z]");
                break;
            }
            case "alphabetic_space":
            case "alpha_s":
            {
                ret = TestInputType(objValue, "[^A-Za-z\\s]");
                break;
            }
            case "email":
            {
                ret = TestEmail(objValue);
                break;
            }
            case "lt":
            case "lessthan":
            {
                ret = TestLessThan(objValue, cmdvalue);
                break;
            }
            case "gt":
            case "greaterthan":
            {
                ret = TestGreaterThan(objValue, cmdvalue);
                break;
            }
            case "regexp":
            {
                ret = TestRegExp(objValue, cmdvalue);
                break;
            }
            case "file_extn":
            {
                ret = TestFileExtension(objValue, cmdvalue);
                break;
            }

        } //switch

        if(typeof message != 'undefined'){
            if(!ret){//不匹配则弹出提示
                if(typeof $.alert !='undefined')
                    $.alert(message);
                else
                    alert(message);
            }
        }
        return ret;
    }
};