<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * --Redis封装类
 * @author		于景晨
 */

class CI_Redis extends Redis {

    protected  $_CI;

    public function __construct(){

        $this->_CI = &get_instance();
        $this->_CI->config->load('redis');
        $config=$this->_CI->config->item('redis');

        parent::__construct();

        //$this->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_NONE);   // don't serialize data
        //$this->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);    // use built-in serialize/unserialize
        //$this->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);   // use igBinary serialize/unserialize

        try
        {
            $this->connect($config['host'], $config['port'], $config['timeout']);
        }
        catch (RedisException $e)
        {
            show_error('Redis connection refused. ' . $e->getMessage());
        }

        if (isset($config['password']))
        {
            $this->auth($config['password']);
        }

        if(isset($config['dbindex'])){
            $this->select($config['dbindex']);
        }
    }

    public function __destruct() {
        $this->close();
    }

}

// END Redis Class

/* End of file Redis.php */
/* Location: ./application/libraries/Redis.php */