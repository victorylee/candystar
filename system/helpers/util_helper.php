<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Generate TransactionId
 *
 * This function is identical to PHPs date() function,
 * except that it allows date codes to be formatted using
 * the MySQL style, where each code letter is preceded
 * with a percent sign:  %Y %m %d etc...
 *
 * The benefit of doing dates this way is that you don't
 * have to worry about escaping your text letters that
 * match the date codes.
 *
 * @access	public
 * @param	string
 */

// (当前秒数二进制--服务器编号二进制--毫秒数前6位二进制）转十进制   最大支持255台服务器并行编码
if ( ! function_exists('trxid'))
{
    function trxid()
    {
        $workerid=ini_get('workerid');
        if($workerid==FALSE||$workerid=='')
            $workerid=0;
        else
            $workerid=intval($workerid);
        $mtime=microtime();
        $mtimes=explode(' ',$mtime);
        return bindec(sprintf('%036b%08b%020b',$mtimes[1],$workerid,intval(substr($mtimes[0],2,6))));
    }
}

// ------------------------------------------------------------------------
/**
 * Generate TransactionId
 *
 * This function is identical to PHPs date() function,
 * except that it allows date codes to be formatted using
 * the MySQL style, where each code letter is preceded
 * with a percent sign:  %Y %m %d etc...
 *
 * The benefit of doing dates this way is that you don't
 * have to worry about escaping your text letters that
 * match the date codes.
 *
 * @access	public
 * @param	integer
 * @param	integer
 * @param	integer
 */
if ( ! function_exists('pageString')){
    function pageString($pageSize, $pageIndex, $total)
    {
        $totalPages = ceil($total/$pageSize);
        $prefivepage = 1;
        $nextfivepage = $totalPages;
        $prepage = 1;
        $nextpage = $totalPages;
        if($pageIndex>5){
            $prefivepage = $pageIndex-5;//前5页
        }
        if($pageIndex < $totalPages -5 ){
            $nextfivepage = $pageIndex+5;
        }
        if($pageIndex>1){
            $prepage = $pageIndex-1;//前5页
        }
        if($pageIndex < $totalPages ){
            $nextpage = $pageIndex+1;
        }
        $pageStr = '<div class="col pager" style="width: 790px;height: 36px;text-align: center;"><a class="pageNo" onclick="findpage(1)">首页</a><a class="pageNo" onclick="findpage('.$prefivepage.')">前5页</a><a class="pageNo" onclick="findpage('.$prepage.')" >上一页</a><a class="pageNo" onclick="findpage('.$nextpage.')">下一页</a><a class="pageNo" onclick="findpage('.$nextfivepage.')">后5页</a><a class="pageNo" onclick="findpage('.$totalPages.')">尾页</a>&nbsp;&nbsp;第<input id="pageindex" type="text" name="pageNo" maxlength="4" value="'.$pageIndex.'"/>页，共<span style="font-size: 15px;font-weight: bold;margin: 0 6px 0 5px;">'.$totalPages.'</span>页</div>';
        return $pageStr;
    }
}

if ( ! function_exists('pager'))
{
    function pager($pageSize, $total, $pageNo,$pagerLength=5)
    {
        /** 总页数 */
        $pageCount=0;
        /** 首页 */
        $firstPageIndex=0;
        /** 尾页 */
        $lastPageIndex=0;
        /** 上一页 */
        $prevPageIndex=0;
        /** 下一页 */
        $nextPageIndex=0;
        /** 开始的索引 */
        $pageRecordBeginIndex=0;
        /***/
        $optionalPageIndexList = [];

        if ($total <= $pageSize) {
            $pageRecordBeginIndex=0;
            $pageCount = 1;
            $firstPageIndex=0;
            $prevPageIndex=0;
            $nextPageIndex=0;
            $lastPageIndex=0;
            $prevskipPageIndex=0;
            $nextskipPageIndex=0;
        } else {
            if ($total % $pageSize == 0) {
                $pageCount = intval($total / $pageSize);
            } else {
                $pageCount = intval($total / $pageSize + 1);
            }
            $pageRecordBeginIndex=$pageSize * ($pageNo - 1);
            if($pageNo>1){
                $firstPageIndex=1;
                $prevPageIndex=$pageNo-1;
            }else{
                $firstPageIndex=0;
                $prevPageIndex=0;
            }
            $prevskipPageIndex=$pageNo-$pagerLength;
            if($prevskipPageIndex<0){
                $prevskipPageIndex=0;
            }
            if($pageNo<$pageCount){
                $lastPageIndex=$pageCount;
                $nextPageIndex=$pageNo+1;
            }else{
                $nextPageIndex=0;
                $lastPageIndex=0;
            }
            $nextskipPageIndex=$pageNo+$pagerLength;
            if($nextskipPageIndex>$pageCount){
                $nextskipPageIndex=$pageCount;
            }
            $needtoadd=0;
            for($i=$pageNo-2;$i<$pageNo;$i++)
                if($i>=1)
                    array_push($optionalPageIndexList,$i);
                else
                    $needtoadd++;
            for($i=$pageNo;$i<=$pageNo+2+$needtoadd;$i++)
                if($i<=$pageCount)
                    array_push($optionalPageIndexList,$i);
        }

        return  (object) array(
            'pageSize' => $pageSize,
            'total'=>$total,
            'pageNo'=>$pageNo,
            'pageCount'=>$pageCount,
            'pagerLength' => $pagerLength,
            'firstPageIndex'=>$firstPageIndex,
            'lastPageIndex'=>$lastPageIndex,
            'prevPageIndex'=>$prevPageIndex,
            'nextPageIndex'=>$nextPageIndex,
            'prevskipPageIndex'=>$prevskipPageIndex,
            'nextskipPageIndex'=>$nextskipPageIndex,
            'pageRecordBeginIndex'=>$pageRecordBeginIndex,
            'optionalPageIndexList' => $optionalPageIndexList
        );
    }
}
// ------------------------------------------------------------------------
/**
 * Generate TransactionId
 *
 * This function is identical to PHPs date() function,
 * except that it allows date codes to be formatted using
 * the MySQL style, where each code letter is preceded
 * with a percent sign:  %Y %m %d etc...
 *
 * The benefit of doing dates this way is that you don't
 * have to worry about escaping your text letters that
 * match the date codes.
 *
 * @access	public
 * @param	string
 */
if ( ! function_exists('hostsite'))
{
    function hostsite($site)
    {
        $arr = [];
        array_push($arr,'mail.163.com');
        array_push($arr,'mail.qq.com');
        array_push($arr,'mail.sina.com.cn');
        array_push($arr,'mail.sohu.com');
        array_push($arr,'126.com');
        array_push($arr,'263.com');
        array_push($arr,'yeah.net');
        array_push($arr,'mail.tom.com');
        array_push($arr,'gmail.com');
        array_push($arr,'hotmail.com');
        array_push($arr,'mail.139.com');
        foreach($arr AS $item){
            if(stristr($item,$site)){
                return $item;
            }
        }
    }
}

if ( ! function_exists('mkdirex'))
{
    function mkdirex($dir){
        if (!file_exists($dir)){
            mkdirex(dirname($dir));
            mkdir($dir, 0777,true);
        }
    }
}

if ( ! function_exists('isemail'))
{
    function isemail($email){
        return preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/',$email);
    }
}

if ( ! function_exists('runtime')){
    function runtime($mode=0) {
        static $t;
        if(! $mode) {
            $t = microtime();
            return;
        }
        $t1 = microtime();
        list($m0,$s0) = explode(" ",$t);//split(" ",$t);
        list($m1,$s1) = explode(" ",$t1);//split(" ",$t1);
        return sprintf("%.3f ms",($s1+$m1-$s0-$m0)*1000);
    }
}



/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */