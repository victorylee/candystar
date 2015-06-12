<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsFunction
 */
function smarty_function_redirecturl($params)
{
	static $ci, $baseurl;
	if (!$ci) {
		$ci =& get_instance();
		$baseurl = $ci->config->base_url();
	}
	if(!isset($params['url']) || empty($params['url'])){
		$params['url'] = 'home';
	}
    $url = $baseurl.$params['url'];
    return 'if(data["redirect"]){location.href ="'.$url.'";return;}';
}
