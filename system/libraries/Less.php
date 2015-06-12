<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * --Less编译类
 * @author		于景晨
 */

require_once( BASEPATH.'libraries/less/Less.php' );

class CI_Less {

    protected $_less;
    protected  $_CI;

    public function __construct(){
        $this->_CI = &get_instance();
        $this->_less = new Less_Parser();
        //$this->_less->parse( '@color: #4D926F; #header { color: @color; } h2 { color: @color; }' );
        //$css = $parser->getCss();
    }

    public function parse($str){
        $this->_less->parse( '@color: #4D926F; #header { color: @color; } h2 { color: @color; }' );
    }

}
