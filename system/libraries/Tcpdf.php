<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * --轻量级对象容器封装类
 * @author		于景晨
 */

require_once( BASEPATH.'libraries/tcpdf/tcpdf.php' );

class CI_Tcpdf extends Tcpdf {
    public function __construct(){
        parent::__construct();
    }
}