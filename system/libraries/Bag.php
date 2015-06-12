<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * --轻量级对象容器封装类
 * @author		于景晨
 */

require_once( BASEPATH.'libraries/hashmap/Hashmap.php' );

class CI_Bag extends Hashmap {
    public function __construct(){
        parent::__construct();
    }
}
