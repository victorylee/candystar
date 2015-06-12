<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    /**
     * 新版网站主页跳转方法
     */
    public function index()
    {
        $this->initUser();
        $verifycode = $this->getVerifycode();
        $this->smarty->assign('verifycode',$verifycode);
        $this->smarty->view('home/index.tpl');
    }
    private function initUser(){
        $userid=$this->input->cookie('userid');
        if($userid){
            $query = $this->db->query('SELECT * FROM tb_user WHERE id=?',$userid);
            if($query->num_rows()>0){
                $user=$query->row();
                $this->smarty->assign('user',$user);
                $query->free_result();
            }
        }
    }
    //登录
    public function signin(){
        $jumpurl = $this->input->get('jumpurl',false);
        //跳转地址
        if(!empty($jumpurl))
            $this->smarty->assign('http_referer',$jumpurl);
        $this->smarty->view('home/signin.tpl');
    }
    //注册
    public function signup(){
        $this->smarty->view('home/signup.tpl');
    }

    /**
     * 注册
     */
    public function register(){
        $account = strtolower(trim($this->input->post('account')));
        if(empty($account)){
            $this->renderFail('用户名不能为空','01');
            return;
        }
        $query = $this->db->query('SELECT id FROM tb_user WHERE account = ?',$account);
        if($query->num_rows()>0){
            echo json_encode(array("success"=>false,"msg"=>'用户名'.$account.'已存在'));
            return;
        }
        $tp = trim($this->input->post('tp'));
        $name = trim($this->input->post('name'));
        $pwdhash = trim($this->input->post('pwdhash'));
        $mobile = trim($this->input->post('mobile'));
        $agree = $this->input->post("agree");
        if($agree != 'on')
            return;
        $userid = trxid();
        $this->db->trans_start();
        $this->db->query('INSERT INTO tb_user(id,account,name,pwdhash,mobile,tp,status,uts,cts) VALUES (?,?,?,?,?,?,"003003",NOW(),NOW())',array($userid,$account,$name,password_hash($pwdhash, PASSWORD_BCRYPT),$mobile,$tp));
        if($tp == '004001'){
            $this->db->query("INSERT INTO tb_worker(id,dcd) VALUES(?,COLUMN_CREATE('avatar','' AS char))",array($userid));
        }else{
            $this->db->query("INSERT INTO tb_broker(id,dcd) VALUES(?,COLUMN_CREATE('avatar','' AS char))",array($userid));
        }
        $this->db->trans_complete();
        if($this->db->trans_status()){
            $wtk_user=trxid();     //取24位流水号作为不重复的salt
            $wtk_userhash=md5($userid.$wtk_user);   //计算wtkhash
            //将访问令牌同步写入cache
            $this->redis->setex('wtk_user:'.$userid,60*60*24*30,$wtk_user);
            //写入cookie数据
            $this->input->set_cookie('userid',$userid,60*60*24*30);
            $this->input->set_cookie('wtk_userhash',$wtk_userhash,60*60*24*30);
            echo json_encode(array("success"=>$this->db->trans_status(),"msg"=>''));
        }else{
            echo json_encode(array("success"=>$this->db->trans_status(),"msg"=>'注册失败'));
        }
    }

    public function login()
    {
        $account=strtolower(trim($this->input->post('account')));
        $pwd=trim($this->input->post('pwdhash'));
        $query=$this->db->query('SELECT id,pwdhash,tp FROM tb_user WHERE (account=? OR mobile=?) AND status=\'003003\' LIMIT 1',array($account,$account));
        if($query->num_rows()>0) {
            $row = $query->row();
            if(password_verify($pwd, $row->pwdhash)) {
                $userid=$row->id;
                $wtk_user=trxid();     //取24位流水号作为不重复的salt
                $wtk_userhash=md5($userid.$wtk_user);   //计算wtkhash
                //将访问令牌同步写入cache
                $this->redis->setex('wtk_user:'.$userid,60*60*24*30,$wtk_user);
                //写入cookie数据
                $this->input->set_cookie('userid',$userid,60*60*24*30);
                $this->input->set_cookie('wtk_userhash',$wtk_userhash,60*60*24*30);
                //登陆成功
                echo json_encode(array('success'=>1,'msg'=>'','tp'=>$row->tp));
            }else//密码错误
                echo json_encode(array('success'=>-2,'msg'=>'密码错误'));
        }else//用户名错误
            echo json_encode(array('success'=>-1,'msg'=>'用户名错误'));
    }


    //星机构
    public function company(){
        $this->initUser();
        $this->smarty->view('home/company.tpl');
    }
    //关于我们
    public function about(){
        $this->initUser();
        $this->smarty->view('home/about.tpl');
    }
    //联系我们
    public function contact(){
        $this->initUser();
        $this->smarty->view('home/contact.tpl');
    }
    //加入我们
    public function join(){
        $this->initUser();
        $this->smarty->view('home/join.tpl');
    }
    //服务条款
    public function service(){
        $this->initUser();
        $this->smarty->view('home/service.tpl');
    }
    //退出
    public function logout() {
        delete_cookie('wtk_userhash');
        delete_cookie('userid');
        redirect($this->config->base_url().'home/signin');
    }

    private function getVerifycode(){
        $ip = $this->input->user_agent();
        $code = mt_rand(10000000,99999999);
        $hash=md5($ip.$code);
        $this->load->library('verifycode');
        $code = $this->verifycode->Get_Verify(4);
        $this->redis->setex('verify:'.$hash.'code',60*10,$code);
        return $hash;
    }

    public function getNewVerifycode(){
        $ip = $this->input->user_agent();
        $code = mt_rand(10000000,99999999);
        $hash=md5($ip.$code);
        $this->load->library('verifycode');
        $code = $this->verifycode->Get_Verify(4);
        $this->redis->setex('verify:'.$hash.'code',60*10,$code);
        echo $hash;
    }

    public function generate($hash){
        $code = $this->redis->get('verify:'.$hash.'code');
        $pImset = array('w'=>90,'h'=>40,'p'=>40,'r'=>250,'g'=>250,'b'=>250);
        $this->load->library('verifycode');
        $pFont = array('s'=>20,'r'=>43,'g'=>101,'b'=>226,'code'=>$code);
        echo $this->verifycode->Show_Verify($pImset,$pFont);
    }

    private function checkVerifyCode($hash,$code){
        $val = $this->redis->get('verify:'.$hash.'code');
        if(!$val){
            return 0;
        }elseif(strcmp(strtolower($val),strtolower($code))==0){
            return 1;
        }else{
            return 0;
        }
    }

    public function checkvc(){
        $hash = $this->input->post('hash');
        $code = $this->input->post('code');
        $val = $this->redis->get('verify:'.$hash.'code');
        if(!$val){
            echo false;
        }else{
            if(strcmp(strtolower($val),strtolower($code))==0){
                echo true;
            }else{
                echo false;
            }
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */