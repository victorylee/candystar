<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hope
 * Date: 13-9-17
 * Time: 下午12:43
 * To change this template use File | Settings | File Templates.
 */

class Image extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    //缩略图
    public function gmagick_crop($path,$width = 0,$height = 0,$x = 0,$y = 0,$quality = 100){
        $gmagick = new Gmagick($path);
        $arr = explode('.',$path);
        $dis_src = $arr[0].'_src.'.$arr[1];
        $dis_big = $arr[0].'_big.'.$arr[1];

        $gmagick->thumbnailImage($width,$height,TRUE);
        $gmagick->writeImage($dis_src);
        $gmagick->destroy();

        $src = new Gmagick($dis_src);
        $src->cropimage(256,256,$x,$y);
        $src->setCompressionQuality($quality);
        $src->writeImage($dis_big);
        $src->destroy();
    }

      public function gmagick_resize($path = 0,$width = 0,$height = 0,$quality = 75){
          $gmagick = new Gmagick($path);
          $gmagick->cropthumbnailimage($width, $height); //按指定大小缩放
          $gmagick->setCompressionQuality($quality);
          $gmagick->write($path);
          $gmagick->destroy();
      }

      public function gmagick_cropandresize($path = '',$width = 0,$height = 0,$quality = 75){
          $gmagick = new Gmagick($path);
          $srcW = $gmagick->getimagewidth();//获得图片宽
          $srcH = $gmagick->getimageheight();//获得图片高
          $srcW = $srcW > $srcH ? $srcH :$srcW;
          $gmagick->cropimage($srcW,$srcW,0,0);
          $gmagick->thumbnailImage($width,$height,TRUE);
          $gmagick->setCompressionQuality($quality);
          $gmagick->write($path);
          $gmagick->destroy();
      }
      public function compression($path = ''){
          $gmagick = new Gmagick($path);
          $arr = explode('.',$path);
          $format = $gmagick->getimageformat();
          $width  =  $gmagick->getimagewidth();
          $height = $gmagick->getimageheight();
          $r_width = 0;
          $r_height = 0;
          if($width>=$height){
              if($width>800){
                  $per = 800/$width;
                  $r_width = 800;
                  $r_height = $height*$per;
                  $gmagick->thumbnailImage($r_width,$r_height,TRUE);
              }else{
                  $r_width = $width;
                  $r_height = $height;
              }
          }else{
              if($height>800){
                  $per = 800/$height;
                  $r_height = 800;
                  $r_width = $width*$per;
                  $gmagick->thumbnailImage($width,$r_height,TRUE);
              }else{
                  $r_width = $width;
                  $r_height = $height;
              }
          }
          if(strtolower($format) == 'png'){
              $quality =100;
              $white=new Gmagick();
              $white->newImage($r_width, $r_height, "white");
              $white->compositeimage($gmagick, Gmagick::FILTER_CATROM, 0, 0);
              $white->setImageFormat('jpg');
              $cs = $white->getimagecolorspace();  // 判断图片的颜色空间
              if ($cs == Gmagick::COLORSPACE_CMYK)
              {
                  $white->setImageColorspace(Gmagick::COLORSPACE_SRGB);
              }
              $white->stripimage(); // 去除图片内的杂乱格式
              $gmagick->setCompressionQuality($quality);
              $com_800 = $arr[0].'_800.jpg';
              $white->writeImage($com_800);

              $com_120 = $arr[0].'_120.jpg';
              $thumb=new Gmagick($com_800);
              $thumb->thumbnailImage(120,120,TRUE);
              $thumb->setCompressionQuality($quality);
              $thumb->writeImage($com_120);
              $white->destroy();
              $thumb->destroy();
          }else if(strtolower($format) == 'jpeg'||strtolower($format) == 'jpg'){
              $com_800 = $arr[0].'_800.'.strtolower($arr[1]);
              $quality =75;
              $white=new Gmagick();
              $white->newImage($r_width, $r_height, "white");
              $white->compositeimage($gmagick, Gmagick::FILTER_CATROM, 0, 0);
              $cs = $white->getimagecolorspace();  // 判断图片的颜色空间
              if ($cs == Gmagick::COLORSPACE_CMYK)
              {
                  $white->setImageColorspace(Gmagick::COLORSPACE_SRGB);
              }
              $white->stripimage(); // 去除图片内的杂乱格式
              $white->setCompressionQuality($quality);
              $white->writeImage($com_800);

              $com_120 = $arr[0].'_120.'.strtolower($arr[1]);
              $thumb=new Gmagick($com_800);
              $thumb->thumbnailImage(120,120,TRUE);
              $thumb->setCompressionQuality($quality);
              $thumb->writeImage($com_120);
              $white->destroy();
              $thumb->destroy();
          }
          $gmagick->destroy();
      }
}