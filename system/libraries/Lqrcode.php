<?php
require_once(BASEPATH.'libraries/qrcode/Qrcode.php');

class CI_Lqrcode {
    protected $_config;
    protected static $_default_config = array(
        'url' => 'http://www.cakestudy.com/',
        'outfile' => false,
        'level' => 'H',
        'size' => 8,
        'margin' => 4,
        'saveandprint' => false
    );

    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function png($config=array()){
        $this->_config = array_merge(self::$_default_config, $config);
        QRcode::png($this->_config['url'] , $this->_config['outfile'],$this->_config['level'] , $this->_config['size']);
    }
}

