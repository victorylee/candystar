<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Smarty Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Smarty
 * @author		Kepler Gelotte
 * @link		http://www.coolphptools.com/codeigniter-smarty
 */
require_once( BASEPATH.'libraries/smarty/libs/Smarty.class.php' );
require_once( BASEPATH.'libraries/less/Less.php' );

class CI_Smarty extends Smarty {

//    function CI_Smarty()
//    {
//        parent::Smarty();
//
//        $this->addPluginsDir(BASEPATH.'libraries/smarty/plugins');
//        $this->compile_dir = APPPATH . "views/templates_c";
//        $this->template_dir = APPPATH . "views/templates";
//        $this->assign( 'APPPATH', APPPATH );
//        $this->assign( 'BASEPATH', BASEPATH );
//
//        log_message('debug', "Smarty Class Initialized");
//    }

    function __construct()
    {
        parent::__construct();

        $this->addPluginsDir(BASEPATH.'libraries/smarty/plugins');
        $this->compile_dir = APPPATH . "views/templates_c";
        $this->template_dir = APPPATH . "views/templates";
        $this->assign( 'APPPATH', APPPATH );
        $this->assign( 'BASEPATH', BASEPATH );

        // Assign CodeIgniter object by reference to CI
        if ( method_exists( $this, 'assignByRef') )
        {
            $ci =& get_instance();
            $this->assignByRef("ci", $ci);
        }

        log_message('debug', "Smarty Class Initialized");
    }


    /**
     *  Parse a template using the Smarty engine
     *
     * This is a convenience method that combines assign() and
     * display() into one step.
     *
     * Values to assign are passed in an associative array of
     * name => value pairs.
     *
     * If the output is to be returned as a string to the caller
     * instead of being output, pass true as the third parameter.
     *
     * @access	public
     * @param	string
     * @param	array
     * @param	bool
     * @return	string
     */
    function view($template, $data = array(), $return = FALSE)
    {
        foreach ($data as $key => $val)
        {
            $this->assign($key, $val);
        }

        $ret=$this->fetch($template);
        $lessString='';
        $offsetstart=0;
        $firstStart=0;
        while(TRUE){
            $pos=strpos($ret,'<style type="text/less">',$offsetstart);
            if($pos==FALSE)
                break;
            if($firstStart==0)
                $firstStart=$pos;
            $offsetstart=$pos+24;
            $pos=strpos($ret,'</style>',$offsetstart);
            if($pos==FALSE)
                break;
            $offsetend=$pos;
            $lessString=$lessString.substr($ret,$offsetstart,$offsetend-$offsetstart);
            $ret=substr($ret,0,$offsetstart-24).substr($ret,$offsetend+8);//一边查找一边删除less
        }
        $parser = new Less_Parser();
        //$parser->parse( '@color: #4D926F; #header { color: @color; } h2 { color: @color; }' );
        $animationprefix='.animation(@args) {
            -webkit-animation: @args;
            -moz-animation: @args;
            -ms-animation: @args;
            -o-animation: @args;
        }
        .animation-delay(@delay) {
            -webkit-animation-delay: @delay;
            -moz-animation-delay: @delay;
            -ms-animation-delay: @delay;
            -o-animation-delay: @delay;
        }
        .animation-direction(@direction) {
            -webkit-animation-direction: @direction;
            -moz-animation-direction: @direction;
            -ms-animation-direction: @direction;
            -o-animation-direction: @direction;
        }
        .animation-duration(@duration) {
            -webkit-animation-duration: @duration;
            -moz-animation-duration: @duration;
            -ms-animation-duration: @duration;
            -o-animation-duration: @duration;
        }
        .animation-iteration-count(@count) {
            -webkit-animation-iteration-count: @count;
            -moz-animation-iteration-count: @count;
            -ms-animation-iteration-count: @count;
            -o-animation-iteration-count: @count;
        }
        .animation-name(@name) {
            -webkit-animation-name: @name;
            -moz-animation-name: @name;
            -ms-animation-name: @name;
            -o-animation-name: @name;
        }
        .animation-play-state(@state) {
            -webkit-animation-play-state: @state;
            -moz-animation-play-state: @state;
            -ms-animation-play-state: @state;
            -o-animation-play-state: @state;
        }
        .animation-timing-function(@function) {
            -webkit-animation-timing-function: @function;
            -moz-animation-timing-function: @function;
            -ms-animation-timing-function: @function;
            -o-animation-timing-function: @function;
        }';
        $backgroundsizeprefix='.background-size(@args) {
            -webkit-background-size: @args;
            -moz-background-size: @args;
            background-size: @args;
        }';
        $borderradiusprefix='.border-radius(@args) {
            -webkit-border-radius: @args;
            -moz-border-radius: @args;
            border-radius: @args;

            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
        }';
        $boxshadowprefix='.box-shadow(@args) {
            -webkit-box-shadow: @args;
            -moz-box-shadow: @args;
            box-shadow: @args;
        }
        .inner-shadow(@args) {
            .box-shadow(inset @args);
        }';
        $boxsizingprefix='.box-sizing(@args){
            -webkit-box-sizing: @args;
            -moz-box-sizing: @args;
            box-sizing: @args;
        }
        .border-box(){
            .box-sizing(border-box);
        }
        .content-box(){
            .box-sizing(content-box);
        }';
        $columnprefix='.columns(@args){
            -webkit-columns: @args;
            -moz-columns: @args;
            columns: @args;
        }
        .column-count(@count) {
            -webkit-column-count: @count;
            -moz-column-count: @count;
            column-count: @count;
        }
        .column-gap(@gap) {
            -webkit-column-gap: @gap;
            -moz-column-gap: @gap;
            column-gap: @gap;
        }
        .column-width(@width){
            -webkit-column-width: @width;
            -moz-column-width: @width;
            column-width: @width;
        }
        .column-rule(@args){
            -webkit-column-rule: @args;
            -moz-column-rule: @args;
            column-rule: @args;
        }';
        $gradientprefix='.gradient-top(@default: #F5F5F5, @start: #EEE, @stop: #FFF) {
    .linear-gradient-top(@default,@start,0%,@stop,100%);
}
        .linear-gradient-top(@default,@color1,@stop1,@color2,@stop2) {
            background-color: @default;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(@stop1, @color1), color-stop(@stop2 @color2));
            background-image: -webkit-linear-gradient(top, @color1 @stop1, @color2 @stop2);
            background-image: -moz-linear-gradient(top, @color1 @stop1, @color2 @stop2);
            background-image: -ms-linear-gradient(top, @color1 @stop1, @color2 @stop2);
            background-image: -o-linear-gradient(top, @color1 @stop1, @color2 @stop2);
            background-image: linear-gradient(top, @color1 @stop1, @color2 @stop2);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=@color1, endColorstr=@color2);
            -ms-filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=@color1, endColorstr=@color2);
        }
        .linear-gradient-top(@default,@color1,@stop1,@color2,@stop2,@color3,@stop3) {
            background-color: @default;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(@stop1, @color1), color-stop(@stop2 @color2), color-stop(@stop3 @color3));
            background-image: -webkit-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: -moz-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: -ms-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: -o-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3);
        }
        .linear-gradient-top(@default,@color1,@stop1,@color2,@stop2,@color3,@stop3,@color4,@stop4) {
            background-color: @default;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(@stop1, @color1), color-stop(@stop2 @color2), color-stop(@stop3 @color3), color-stop(@stop4 @color4));
            background-image: -webkit-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: -moz-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: -ms-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: -o-linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: linear-gradient(top, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
        }
        .gradient-left(@default: #F5F5F5, @start: #EEE, @stop: #FFF) {
    .linear-gradient-left(@default,@start,0%,@stop,100%);
}
        .linear-gradient-left(@default,@color1,@stop1,@color2,@stop2) {
            background-color: @default;
            background-image: -webkit-gradient(linear, left top, left top, color-stop(@stop1, @color1), color-stop(@stop2 @color2));
            background-image: -webkit-linear-gradient(left, @color1 @stop1, @color2 @stop2);
            background-image: -moz-linear-gradient(left, @color1 @stop1, @color2 @stop2);
            background-image: -ms-linear-gradient(left, @color1 @stop1, @color2 @stop2);
            background-image: -o-linear-gradient(left, @color1 @stop1, @color2 @stop2);
            background-image: linear-gradient(left, @color1 @stop1, @color2 @stop2);
        }
        .linear-gradient-left(@default,@color1,@stop1,@color2,@stop2,@color3,@stop3) {
            background-color: @default;
            background-image: -webkit-gradient(linear, left top, left top, color-stop(@stop1, @color1), color-stop(@stop2 @color2), color-stop(@stop3 @color3));
            background-image: -webkit-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: -moz-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: -ms-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: -o-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3);
            background-image: linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3);
        }
        .linear-gradient-left(@default,@color1,@stop1,@color2,@stop2,@color3,@stop3,@color4,@stop4) {
            background-color: @default;
            background-image: -webkit-gradient(linear, left top, left top, color-stop(@stop1, @color1), color-stop(@stop2 @color2), color-stop(@stop3 @color3), color-stop(@stop4 @color4));
            background-image: -webkit-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: -moz-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: -ms-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: -o-linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
            background-image: linear-gradient(left, @color1 @stop1, @color2 @stop2, @color3 @stop3, @color4 @stop4);
        }';
        $opacityprefix='.opacity(@factor){
            opacity: @factor;
            @iefactor: @factor*100;
            filter: alpha(opacity=@iefactor);
        }';

        $textshadowprefix='.text-shadow(@args){
            text-shadow: @args;
        }';
        $trasformprefix='.transform(@args) {
            -webkit-transform: @args;
            -moz-transform: @args;
            -ms-transform: @args;
            -o-transform: @args;
            transform: @args;
        }
        .rotate(@deg:45deg){
            .transform(rotate(@deg));
        }
        .scale(@factor:.5){
            .transform(scale(@factor));
        }
        .translate(@x,@y){
            .transform(translate(@x,@y));
        }
        .translate3d(@x,@y,@z) {
            .transform(translate3d(@x,@y,@z));
        }
        .translateHardware(@x,@y){
            .translate(@x,@y);
            -webkit-transform: translate3d(@x,@y,0);
            -moz-transform: translate3d(@x,@y,0);
        }';

        $transitionsprefix='.transition(@args:200ms) {
            -webkit-transition: @args;
            -moz-transition: @args;
            -o-transition: @args;
            transition: @args;
        }
        .transition-delay(@delay:0) {
            -webkit-transition-delay: @delay;
            -moz-transition-delay: @delay;
            -o-transition-delay: @delay;
            transition-delay: @delay;
        }
        .transition-duration(@duration:200ms) {
            -webkit-transition-duration: @duration;
            -moz-transition-duration: @duration;
            -o-transition-duration: @duration;
            transition-duration: @duration;
        }
        .transition-property(@property:all) {
            -webkit-transition-property: @property;
            -moz-transition-property: @property;
            -o-transition-property: @property;
            transition-property: @property;
        }
        .transition-timing-function(@function:ease) {
            -webkit-transition-timing-function: @function;
            -moz-transition-timing-function: @function;
            -o-transition-timing-function: @function;
            transition-timing-function: @function;
        }';
        $parser->parse($animationprefix.$backgroundsizeprefix.$borderradiusprefix.$boxshadowprefix.$boxsizingprefix.$columnprefix.$gradientprefix.$opacityprefix.$textshadowprefix.$trasformprefix.$transitionsprefix.$lessString);
        $cssString = $parser->getCss();
        //$pos=strpos($ret,'<head>');
        //$ret=substr($ret,0,$pos+6).'<style type="text/css">'.$cssString.'</style>'.substr($ret,$pos+6);
        $ret=substr($ret,0,$firstStart).'<style type="text/css">'.$cssString.'</style>'.substr($ret,$firstStart);//在首次出现less的位置插入css
        //echo $ret;

        if ($return == FALSE)
        {
            $CI =& get_instance();
            if (method_exists( $CI->output, 'set_output' ))
            {
                $CI->output->set_output( $ret );
            }
            else
            {
                $CI->output->final_output = $ret;
            }
            return;
        }
        else
        {
            return $ret;
        }
    }
}
// END Smarty Class
