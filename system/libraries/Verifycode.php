<?php

class CI_Verifycode {
    //初始验证码数组
    private $VerifyStr = array(
        'Q','8','W','E','2','R','T','Y','U','3','O','5','P','A','S','D','F',
        'G','H','J','6','L','K','7','4','Z','X','C','V','B','N','9','M');
    private $ArrayId;                //初始验证码数组下标
    private $VerifyStrLen;            //初始验证码长度
    private $R_VerifyStr = '';        //返回验证码
    private $R_VerifyStrLen;        //返回验证码的长度

    private $Im;                    //图像操作标识
    private $BgColor;                //图像背景颜色
    private $ImWidth;                //图像宽度
    private $ImHeight;                //图像高度

    private $FontSize;                //验证码大小
    private $FontX;                    //验证码显示起始X位置
    private $FontY;                    //验证码显示起始Y位置
    private $FontColor;                //验证码颜色

    private $PixColor;                //干扰符颜色
    private $PixX;                    //干扰符位置
    private $PixY;                    //干扰符位置
    private $PixX2;                    //干扰符位置
    private $PixY2;                    //干扰符位置
    private $PixAmount;                //干扰度
    protected static $_default_config = array(
        'w'=>80,'h'=>30,'p'=>90,'r'=>130,'g'=>160,'b'=>180
    );

    public function __construct()
    {

    }

    public function __destruct()
    {
        //imagedestroy($this->Im);
        //$this->Im->destroy();
    }

//    public function Show_Verify1($pImSet=array(),$pFont)
//    {
//        $pImSet = array_merge(self::$_default_config, $pImSet);
//        $this->ImWidth   = $pImSet['w'];    //宽
//        $this->ImHeight  = $pImSet['h'];    //高
//        $this->PixAmount = $pImSet['p'];     //干扰度
//        $this->Im = imagecreate($this->ImWidth,$this->ImHeight);    //建立画布
//        //设置背景色
//        $this->BgColor = imagecolorallocate($this->Im,$pImSet['r'],$pImSet['g'],$pImSet['b']);
//
//        //header("Content-type:image/png");
//        $this->FontSize  = $pFont['s'];        //验证码文字大小
//
//        //设置验证码显示颜色
//        $this->FontColor = imagecolorallocate($this->Im,rand(5,225),rand(15,225),rand(25,215));
//        //imagecolorallocate($this->Im,$pFont['r'],$pFont['g'],$pFont['b']);
//
//        //验证码输入位置
//        $this->FontX    = round($this->ImWidth/6);
//        $this->FontY    = round($this->ImHeight/9*7);
//        //在图片显示验证码
//        imagettftext($this->Im,$this->FontSize,rand(0,10),$this->FontX,$this->FontY,$this->FontColor,'/system/fonts/verdanab.ttf',$pFont['code']);
//        $this->PixX     = round($this->ImWidth/3*2);
//        $this->PixY     = -10;
//        $this->PixColor = imagecolorallocate($this->Im,rand(5,225),rand(15,225),rand(25,215));
//        imagearc($this->Im,$this->PixX,$this->PixY,70,70,30,120,$this->PixColor);
//        $this->PixX     = round($this->ImWidth/3);
//        $this->PixY     = round($this->ImHeight+12);
//        $this->PixColor = imagecolorallocate($this->Im,rand(5,225),rand(15,225),rand(25,215));
//        imagearc($this->Im,$this->PixX,$this->PixY,70,70,210,300,$this->PixColor);
//        //生成干扰点
//        for($j=0;$j<$this->PixAmount;$j++)
//        {
//            $this->PixX     = rand(0,$this->ImWidth);
//            $this->PixY     = rand(-10,$this->ImHeight);
//            $this->PixX2   = rand(40,60);
//            $this->PixY2   = rand(40,60);
//            $this->PixColor = imagecolorallocate($this->Im,rand(5,225),rand(15,225),rand(25,215));
//            if($j%2==0){
//                imagearc($this->Im,$this->PixX,$this->PixY,$this->PixX2,$this->PixY2,110,150,$this->PixColor);
//            }else{
//                imagearc($this->Im,$this->PixX,$this->PixY,$this->PixX2,$this->PixY2,280,320,$this->PixColor);
//            }
//        }
//        imagepng($this->Im);        //输入验证码图片
//    }

    public function Show_Verify($pImSet=array(),$pFont)
    {
        $pImSet = array_merge(self::$_default_config, $pImSet);
        $this->ImWidth   = $pImSet['w'];    //宽
        $this->ImHeight  = $pImSet['h'];    //高
        $this->PixAmount = $pImSet['p'];     //干扰度
        $this->Im = new Gmagick();
        $this->Im->newimage($this->ImWidth,$this->ImHeight,'#ffe2ee','png');
        header("Content-type:image/png");
        $this->FontSize  = floatval($pFont['s']);        //验证码文字大小
        //设置验证码显示颜色
        $this->FontColor = $this->getRandColor();

        //验证码输入位置
        $this->FontX    = round($this->ImWidth/6);
        $this->FontY    = round($this->ImHeight/4*3);

        //在图片显示验证码
        $this->Im = $this->setText($this->Im,$this->FontX,$this->FontY,$this->FontColor,floatval(rand(1,30)),$this->FontSize,$pFont['code']);
//        //生成干扰点
//        for($j=0;$j<1;$j++)
//        {
//            $this->PixX     = floatval(rand(0,$this->ImWidth));
//            $this->PixY     = floatval(rand(-20,$this->ImHeight+10));
//            $this->PixX2   = floatval(rand(0,$this->ImWidth));
//            $this->PixY2   = floatval(rand(-20,$this->ImHeight+10));
//            $this->PixColor = $this->getRandColor();
//            if($j%2==0){
//                $this->Im = $this->setArc($this->Im,$this->PixX,$this->PixY,$this->PixX2,$this->PixY2,110,150,$this->PixColor);
//            }else{
//                $this->Im = $this->setArc($this->Im,$this->PixX,$this->PixY,$this->PixX2,$this->PixY2,280,320,$this->PixColor);
//            }
//        }
        return $this->Im; //输入验证码图片
    }

    private function getColor($r,$g,$b){
        $color = '#'.str_pad(dechex($r),2,'0',STR_PAD_LEFT).str_pad(dechex($g),2,'0',STR_PAD_LEFT).str_pad(dechex($b),2,'0',STR_PAD_LEFT);
        return $color;
    }

    private function getRandColor(){
        $r = rand(5,225);
        $g = rand(15,225);
        $b = rand(25,215);
        $color = '#'.str_pad(dechex($r),2,'0',STR_PAD_LEFT).str_pad(dechex($g),2,'0',STR_PAD_LEFT).str_pad(dechex($b),2,'0',STR_PAD_LEFT);
        $gp = new GmagickPixel();
        $gp->setcolor($color);
        return $gp;
    }

    private function setText($gm,$x,$y,$color,$decoration,$fontsize,$text){
        $gd = new GmagickDraw();
        $gd->setfillcolor($color);
//        $gd->setfont('system/fonts/verdanab.ttf');
        $fontindex = rand(1,5);
        $fontpath = 'system/fonts/'.$fontindex.'.ttf';
        $gd->setfont($fontpath);
        $gd->settextdecoration($decoration);
        $gd->settextencoding('UTF-8');
        $gd->setfontsize($fontsize);
        $gd->annotate(floatval($x),floatval($y),strval($text));
        $gm->drawimage($gd);

        return $gm;
    }

    private function setArc($gm,$x1,$y1,$x2,$y2,$sd,$ed,$color){
        $gd = new GmagickDraw();
        $gd->setfillcolor($color);
        $gd->arc($x1,$y1,$x2,$y2,$sd,$ed);
        $gm->drawimage($gd);
        return $gm;
    }

    public function Get_Verify($num)
    {
        $this->R_VerifyStrLen = $num;//验证码显示位数
        $this->VerifyStrLen   = count($this->VerifyStr);
        //生成验证码
        for($i=0;$i<$this->R_VerifyStrLen;$i++)
        {
            $this->ArrayId = rand(0,($this->VerifyStrLen-1));
            $this->R_VerifyStr .= $this->VerifyStr[$this->ArrayId];
        }
        return $this->R_VerifyStr;    //返回验证码
    }
}

