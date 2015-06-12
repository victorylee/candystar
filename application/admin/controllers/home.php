<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $wtk_emphash=$this ->input->cookie('wtk_emphash');
        $empid=$this ->input->cookie('empid');
        if(!empty($wtk_emphash)&&!empty($empid)) {
            redirect($this->config->base_url().'users/worker');
        }
        $err=intval($this->input->get('err'));
        switch($err){
            case 0:
                $this->smarty->assign('errorMessage','');
                break;
            case 1:
                $this->smarty->assign('errorMessage','账号错误');
                break;
            case 2:
                $this->smarty->assign('errorMessage','密码错误');
                break;
            default:
                $this->smarty->assign('errorMessage','未知错误');
        }
        $this->smarty->view('home/index.tpl');
    }

    public function login() {
        $email=$this->input->post('email');
        $pwd=$this->input->post('pwd');
        $query=$this->db->query('SELECT id,pwdhash FROM tb_emp WHERE email=? AND status=\'002003\' LIMIT 1',array($email));
        if($query->num_rows()>0) {
            $row = $query->row();
            if(password_verify($pwd, $row->pwdhash)) {
                $empid=$row->id;
                $wtk_emp=trxid();     //取24位流水号作为不重复的salt
                $wtk_emphash=md5($empid.$wtk_emp);   //计算wtkhash
                //将访问令牌同步写入cache
                $this->redis->setex('wtk_emp:'.$empid,60*60*24*30,$wtk_emp);
                //写入cookie数据
                $this->input->set_cookie('empid',$empid,60*60*24*30);
                $this->input->set_cookie('wtk_emphash',$wtk_emphash,60*60*24*30);
                //登陆成功
                echo json_encode(array('success'=>true,'msg'=>''));
            }else//密码错误
                echo json_encode(array('success'=>false,'msg'=>'密码错误'));
        }else//用户名错误
            echo json_encode(array('success'=>false,'msg'=>'用户名错误'));
    }
    /**
     * 修改密码
     */
    public function changePassword(){
        $s_empid=intval($this->input->cookie('empid'));
        $c_empid = intval($this->input->post('empid'));
        $oldpwdhash = $this->input->post('oldpwdhash');
        $newpwdhash = $this->input->post('newpwdhash');
        if($s_empid==$c_empid){
            $query = $this->db->query('SELECT pwdhash FROM tb_emp WHERE id=?',array($s_empid,$hash = password_hash($oldpwdhash, PASSWORD_BCRYPT)));
            if($query->num_rows()>0){
                $row = $query->row();
                if(password_verify($oldpwdhash, $row->pwdhash)){
                    $this->db->trans_start();
                    $this->db->query('UPDATE tb_emp SET pwdhash=? WHERE id=?',array($hash = password_hash($newpwdhash, PASSWORD_BCRYPT),$s_empid));
                    $this->db->trans_complete();
                    echo json_encode(array('success'=>$this->db->trans_status(),'data'=>''));
                }else{
                    echo json_encode(array('success'=>FALSE,'data'=>'旧密码错误'));
                }
            }else{
                echo json_encode(array('success'=>FALSE,'data'=>'用户不存在'));
            }
        }else{
            echo json_encode(array('success'=>FALSE,'data'=>'修改失败'));
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */