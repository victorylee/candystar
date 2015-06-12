<?php
/**
 *
 * 拦截器类
 * @author		于景晨
 *
 */
class Interceptor {

    private $_CI;

    public function __construct() {
        $this->_CI = &get_instance();
    }

    /*
    //系统执行的早期调用.仅仅在benchmark 和 hooks 类 加载完毕的时候. 没有执行路由或者其它的过程.
    //此函数对应hook.php中的$hook['pre_system']，使用时请反注释相关代码
    public function pre_system(){

    }
    */

    /*
    //在调用你的任何控制器之前调用.此时所用的基础类,路由选择和安全性检查都已完成.
    //此函数对应hook.php中的$hook['pre_controller']，使用时请反注释相关代码
    public function pre_controller(){

    }
    */

    /**
     * 在你的控制器实例化之后,任何方法调用之前调用,即执行完控制器构造函数后调用此方法
     */
    public function post_controller_constructor(){
        $uri=uri_string();

        if ($uri != '' && !preg_match("/home.*/i", $uri) ) {    // 需要进行权限检查的URL
            $wtk_userhash=$this->_CI ->input->cookie('wtk_userhash');
            $userid=$this->_CI ->input->cookie('userid');

            $bOk=FALSE;
            if($userid!==FALSE){
                $wtk=$this->_CI->redis->get('wtk_user:'.$userid);
                if($wtk){
                    $temphash=md5($userid.$wtk);     //用相关值计算hash和cookie中的比较
                    if(strcmp($wtk_userhash,$temphash)==0){//如果相等则延长缓存和cookie的失效时间
                        $ttl=$this->_CI->redis->ttl('wtk_user:'.$userid);
                        if($ttl<1800)
                            $this->_CI->redis->expire('wtk_user:'.$userid,60*60*24*30);
                        $this->_CI->input->set_cookie('wtk_userhash',$wtk_userhash,60*60*24*30);
                        $this->_CI->input->set_cookie('userid',$userid,60*60*24*30);
                        $query = $this->_CI->db->query('SELECT * FROM tb_user WHERE id=?',array($userid));
                        if($query->num_rows()>0){
                            $user=$query->row();
                            $this->_CI->smarty->assign('user',$user);
                            $this->_CI->bag->put('user',$user);
//                            if(date("Y-m-d", strtotime($user->ats)) != date("Y-m-d", time())){
//                                $this->_CI->db->query('UPDATE tb_user SET ats=NOW() WHERE id=?',$userid);
//                            }
                            $query->free_result();
                        }
                        $bOk=TRUE;
                    }
                }
            }

            if(!$bOk){//如果不通过则拒绝登录
                delete_cookie('wtk_userhash');
                delete_cookie('userid');
                $accept = $this->_CI->input->server('HTTP_ACCEPT');
                if(strpos($accept,'text/javascript')>0){
                    $data = new stdClass();
                    $data->redirect = true;
                    echo json_encode($data);
                    exit(0);
                }else{
                    redirect($this->_CI->config->base_url().'home/signin?jumpurl='.$this->_CI->config->base_url().$uri);
                }
            }
        }
    }

    /*
   //在你的控制器完全运行之后调用.
   //此函数对应hook.php中的$hook['post_controller']，使用时请反注释相关代码
   public function post_controller(){

   }
   */

    /*
  //覆盖_display()函数, 用来在系统执行末尾向web浏览器发送最终页面.这允许你用自己的方法来显示.注意，
  //你需要通过 $this->_CI =& get_instance() 引用 _CI 超级对象，
  //然后这样的最终数据可以通过调用 $this->_CI->output->get_output() 来获得。
  //此函数对应hook.php中的$hook['display_override']，使用时请反注释相关代码
  public function display_override(){

  }
  */

    /*
   //可以让你调用自己的函数来取代output类中的_display_cache() 函数.这可以让你使用自己的缓存显示方法
   //此函数对应hook.php中的$hook['cache_override']，使用时请反注释相关代码
   public function cache_override(){

   }
   */

    /*
    //在最终着色页面发送到浏览器之后,浏览器接收完最终数据的系统执行末尾调用
    //此函数对应hook.php中的$hook['post_system']，使用时请反注释相关代码
    public function post_system(){

    }
    */
}  