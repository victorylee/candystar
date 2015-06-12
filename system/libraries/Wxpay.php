<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once( BASEPATH.'libraries/WxPayPubHelper/WxPayPubHelper.php' );
/*
微信支付接口
*/
class WxPay{

    /**
     * 构造函数
     *
     * @return void
     */
    public function __construct(){
        $this->_CI = &get_instance();
    }


    public function pay($order=array()){
        //使用被扫支付接口
        $unifiedOrder = new UnifiedOrder_pub();
        $unifiedOrder->setParameter("body",$order['body']);//商品描述
        //自定义订单号，此处仅作举例
        $out_trade_no = trxid();
        $unifiedOrder->setParameter("out_trade_no",$out_trade_no);//商户订单号
        $unifiedOrder->setParameter("total_fee",$order['fee']);//总金额
        $unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址
        $unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
        $unifiedOrder->setParameter("attach",$order['attach']);//交易类型
        //提交订单
        $unifiedOrderResult = $unifiedOrder->getResult();
        //商户根据实际情况设置相应的处理流程
        if ($unifiedOrderResult["return_code"] == "FAIL")
        {
            //商户自行增加处理流程
            echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
        }
        elseif($unifiedOrderResult["result_code"] == "FAIL")
        {
            //商户自行增加处理流程
            echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
            echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
        }
        elseif($unifiedOrderResult["code_url"] != NULL)
        {
            //从统一支付接口获取到code_url
            $code_url = $unifiedOrderResult["code_url"];
            return $code_url;
        }
    }



    /**
     * 析构函数
     *
     * @access public
     * @return void
     */
    public function __destruct()
    {
        if (isset($this->lib)) {
            unset($this->lib);
        }
    }
}
