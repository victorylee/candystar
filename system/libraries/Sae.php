<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * --Sina Application Enviroment封装类
 * @author		于景晨
 */

//$this->load->library('sae', array(  'WB_CALLBACK_URL' => 'http://angelcrunch.com/callback.php'));
//$this->sae->getAccessToken($code);
require_once( BASEPATH.'libraries/sae/saetv2.ex.class.php' );

class CI_Sae {

    protected $_sae;
    protected $_config;
    protected static $_default_config = array(
        'WB_AKEY' => '761950726',
        'WB_SKEY' => '9c85ad25f4ff3c2501b10a940162acd0',
        'WB_CALLBACK_URL' => 'http://angelcrunch.com/callback.php'
    );

    public function __construct($config=array())
    {

        $this->_config = array_merge(self::$_default_config, $config);

        $this->_sae = new SaeTOAuthV2( $this->_config['WB_AKEY'] , $this->_config['WB_SKEY' ]);

    }

    public function __destruct()
    {

    }

    public function getAuthorizeURL()
    {
        return $this->_sae->getAuthorizeURL( $this->_config['WB_CALLBACK_URL']);
    }

    public function getAccessToken($code)
    {
        $keys = array();
        $keys['code'] = $code;
        $keys['redirect_uri'] = $this->_config['WB_CALLBACK_URL'];
        try {
            $token = $this->_sae->getAccessToken( 'code', $keys ) ;
            return $token;
        } catch (OAuthException $e) {

        }
        return FALSE;
    }

}
// END Session Class

/* End of file Session.php */
/* Location: ./application/libraries/Session.php */