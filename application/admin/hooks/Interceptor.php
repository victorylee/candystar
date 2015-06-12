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
        if ( !preg_match("/home.*/i", $uri) ) {    // 需要进行权限检查的URL
            $wtk_emphash=$this->_CI ->input->cookie('wtk_emphash');
            $empid=$this->_CI ->input->cookie('empid');
            $this->_CI ->load->library('redis', $this->_CI->config->item('redis'));
            $bOk=FALSE;
            if($empid!==FALSE){
                $wtk=$this->_CI->redis->get('wtk_emp:'.$empid);
                if($wtk){
                    $temphash=md5($empid.$wtk);     //用相关值计算hash和cookie中的比较
                    if(strcmp($wtk_emphash,$temphash)==0){//如果相等则延长缓存和cookie的失效时间
                        $ttl=$this->_CI->redis->ttl('wtk_emp:'.$empid);
                        if($ttl<1800)
                            $this->_CI->redis->expire('wtk_emp:'.$empid,60*60*24*30);//默认延长3600秒
                        $this->_CI->input->set_cookie('wtk_emphash',$wtk_emphash,60*60*24*30);
                        $this->_CI->input->set_cookie('empid',$empid,60*60*24*30);
                        $query = $this->_CI->db->query('SELECT * FROM tb_emp WHERE id=?',$empid);
                        if($query->num_rows()>0){
                            $emp=$query->row();
                            $this->_CI->smarty->assign('emp',$emp);
                            $this->_CI->bag->put('emp',$emp);
                            $query->free_result();
                            $query=$this->_CI->db->query('SELECT id,value FROM tb_sysvar WHERE id=\'adminId\' LIMIT 1');
                            $row=$query->row();
                            $adminId=intval($row->value);
                            $query->free_result();
                            $privilegeList=array();
                            if($empid==$adminId){
                                array_push($privilegeList,array('id'=>'00','pid'=>'','ancestornames'=>'','level'=>1,'isleaf'=>0,'name'=>'系统管理','url'=>''));
                                array_push($privilegeList,array('id'=>'0001','pid'=>'00','ancestornames'=>'系统管理','level'=>2,'isleaf'=>1,'name'=>'系统参数','url'=>'/admin/sysvar'));
                                array_push($privilegeList,array('id'=>'0002','pid'=>'00','ancestornames'=>'系统管理','level'=>2,'isleaf'=>1,'name'=>'字典管理','url'=>'/admin/dict'));
                                array_push($privilegeList,array('id'=>'0003','pid'=>'00','ancestornames'=>'系统管理','level'=>2,'isleaf'=>1,'name'=>'权限管理','url'=>'/admin/privilege'));
                                array_push($privilegeList,array('id'=>'0004','pid'=>'00','ancestornames'=>'系统管理','level'=>2,'isleaf'=>1,'name'=>'角色管理','url'=>'/admin/role'));
                                array_push($privilegeList,array('id'=>'0005','pid'=>'00','ancestornames'=>'系统管理','level'=>2,'isleaf'=>1,'name'=>'系统初始化','url'=>'/admin/sysinit'));
                            }
                            $query = $this->_CI->db->query('SELECT b.id,b.pid,b.level,b.isleaf,b.name,b.url from tb_role_privilege AS a LEFT JOIN tb_privilege AS b ON a.privilegeid=b.id WHERE a.roleid=? AND b.subdomain=\'001001\'',$emp->roleid);
                            foreach($query->result_array() as $row)
                                array_push($privilegeList,$row);
                            $this->_CI->smarty->assign('privilegeList',json_encode($privilegeList));
                        }
                        $bOk=TRUE;
                    }
                }
            }

            if(!$bOk){//如果不通过则拒绝登陆
                delete_cookie('wtk_emphash');
                delete_cookie('empid');
                if(!empty($uri))
                    redirect($this->_CI->config->base_url());
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