<?php


const EPOCH = 1418801787000;

function generateParticle($machine_id)
{
    /*
    * Time - 41 bits
    */
    $time = floor(microtime(true) * 1000);

    /*
    * Substract custom epoch from current time
    */
    $time -= EPOCH;

    /*
    * Create a base and add time to it
    */
    $base = decbin(pow(2,40) - 1 + $time);
    /*
    * Configured machine id - 10 bits - up to 512 machines
    */
    $machineid = decbin(pow(2,9) - 1 + $machine_id);
    /*
    * sequence number - 12 bits - up to 2048 random numbers per machine
    */
    $random = mt_rand(1, pow(2,11)-1);
    $random = decbin(pow(2,11)-1 + $random);
    /*
    * Pack
    */
    $base = $base.$machineid.$random;

    /*
    * Return unique time id no
    */
    return bindec($base);
}

function timeFromParticle($particle)
{
    /*
    * Return time
    */
    return bindec(substr(decbin($particle),0,41)) - pow(2,40) + 1 + EPOCH;
}

//$snowflakeid=generateParticle(1);
//var_dump( $snowflakeid);
//echo '<br/>';
////echo  date("Y-m-d H:i:s", timeFromParticle($snowflakeid));
//var_dump(timeFromParticle($snowflakeid));
//echo '<br/>';
//echo  date("Y-m-d H:i:s", time());

$workerid=1;
for($i=0;$i<5;$i++){
    $mtime=microtime();
    $mtimes=explode(' ',$mtime);
    $sec=$mtimes[1];
    $msec=$mtimes[0];
    echo $sec.' '.substr($msec,2,6);
    echo '<br/>';
    $strid=sprintf('%036b %08b %020b',$sec,$workerid,intval(substr($msec,2,6)));
    echo $strid;
    echo '<br/>';
    echo bindec(trim($strid));
    echo '<br/>';
}

echo $sec;
//echo '<br/>';
//echo date("Y-m-d H:i:s", $sec);
//
//$datacenterid=001;
//$machineid=00001;
//echo 'datacenter:'.$datacenterid;
//echo '<br/>';
//echo 'machine:'.$datacenterid;


//$a1=array('heeroyu82@gmail.com');
//echo join(';',$a1);

//echo $_SERVER['HTTP_USER_AGENT'];
//echo phpinfo();
//



//$code = rand(100000,999999);
//$data ='尊敬的用户您好！验证码是：' . $code ;
//
//
//$post_data = array();
//$post_data['account'] = 'vip_tchy';
//$post_data['pswd'] = 'Tch123456';
//$post_data['mobile'] ='13911123641';
//$post_data['msg']=mb_convert_encoding($data,'UTF-8', 'auto');
//$url='http://222.73.117.158/msg/HttpBatchSendSM?';
//$o="";
//foreach ($post_data as $k=>$v)
//{
//    $o.= "$k=".urlencode($v)."&";
//}
//$post_data=substr($o,0,-1);
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//$result = curl_exec($ch);


//
//function send_mail() {
//    $ch = curl_init();
//
//    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//    curl_setopt($ch, CURLOPT_URL, 'https://sendcloud.sohu.com/webapi/mail.send.json');
//    //不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
//    curl_setopt($ch, CURLOPT_POSTFIELDS,
//        array('api_user' => 'postmaster@nboerp.sendcloud.org',
//            'api_key' => '8NXZxDVv',
//            'from' => 'heeroyu82@gmail.com',
//            'fromname' => '于景晨',
//            'to' => 'yujingchen@pe.vc',
//            'subject' => 'curl调用WebAPI测试主题',
//            'html' => '欢迎使用<a href="https://sendcloud.sohu.com">SendCloud</a>'
////            'file1' => '@/path/to/附件.png;filename=附件.png',
////            'file2' => '@/path/to/附件2.txt;filename=附件2.txt'));
//        ));
//
//    $result = curl_exec($ch);
//
//    if($result === false) //请求失败
//    {
//        echo 'last error : ' . curl_error($ch);
//    }
//
//    curl_close($ch);
//
//    return $result;
//}
//
//echo send_mail();

//echo date('Y-m-d H:i:s', 1385455687);
//echo strtotime(date('Y-m-d H:i:s'));
//echo strtotime('2050-11-26 16:33:06');

//echo strtotime('9999-12-31 23:59:59');

//$data=array(
//    array('summary'=>'11','money'=>'100.00'),
//    array('summary'=>'22','money'=>'200.00')
//);
//
//$tmp=json_encode($data);
//
//$out=json_decode($tmp);
//echo count($out);
//var_dump($data);

//$arr = [];
//array_push($arr,'mail.163.com');
//array_push($arr,'mail.qq.com');
//array_push($arr,'mail.sina.com.cn');
//array_push($arr,'mail.sohu.com');
//array_push($arr,'126.com');
//array_push($arr,'263.com');
//array_push($arr,'yeah.net');
//array_push($arr,'mail.tom.com');
//array_push($arr,'gmail.com');
//array_push($arr,'hotmail.com');
//array_push($arr,'mail.139.com');
//
//$email = '139.com';
//$site = '';
//foreach($arr AS $item){
//    if(stristr($item,$email)){
//        var_dump($item);
//        exit(0);
//    }
//}


//$arr=array('testtitle','testname');
//echo $arr[0];

//$ids =  explode(',','AAAA');
//var_dump($ids);

//phpinfo();



//$cb = new Couchbase("127.0.0.1:8091", "", "", "angelcrunch");
//$cb->set("default_jimmy_a", 101);

//$cb->delete('default_jimmy_a');
//var_dump($cb->get("default_jimmy_a"));

//for($i=0;$i<20;$i++)
//    echo 'TN'.date('YmdHis').substr(microtime(),2,6).sprintf('%02d',rand(0,99)).'<br/>';

//list($usec, $sec) = explode(" ", microtime());
//$msec=round($usec*1000);
//echo sprintf('%03d',$msec);
//echo gettimeofday();

//编码自动补位
//$x=7;
//for($i=0;$i<10;$i++)
//    echo sprintf('A%0'.$x.'d',rand(0,99999)).'<br/>';

//
//$cb = new Couchbase("127.0.0.1:8091", "", "", "angelcrunch");
////$cb->set("pagerjson", $pager);
//$cb->set("users", $users);
//
////$cb->delete('default_jimmy_a');
//var_dump($cb->get("users"));
//
//$file = array(
//    'title'=>'测试标题',
//    'desc'=>'测试描述',
//    'keyword'=>'测试',
//    'userId'=>'45455930_1420441364',
//    'pcatid'=>5,
//    'catid'=>6,
//    'Filedata'=>new CurlFile('/home/docintest.doc', 'application/doc', '')
//);
//$curl = curl_init('http://upload.docin.com/uploaddoc');
//curl_setopt($curl,CURLOPT_POST,TRUE);
//curl_setopt($curl,CURLOPT_POSTFIELDS,$file);
//$result=curl_exec($curl);
////var_dump($result);
//echo $result;