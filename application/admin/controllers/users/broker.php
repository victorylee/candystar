<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Broker extends CI_Controller {

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
    public function index(){
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'003%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('statusList',json_encode($query->result()));
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'011%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('levelList',json_encode($query->result()));
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'008%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('sexList',json_encode($query->result()));
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'012%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('businessList',json_encode($query->result()));
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'005%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('skillList',json_encode($query->result()));
        $query->free_result();
        //地区
        $query = $this->db->query('SELECT id,name FROM tb_region WHERE level=2');
        $this->smarty->assign('provinceList',json_encode($query->result()));
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_region WHERE pid=\'001001\'');
        $this->smarty->assign('cityList',json_encode($query->result()));
        $query->free_result();
        $this->smarty->view('users/broker.tpl');
    }

    //插入或修改记录
    public function saveOrUpdate(){
        $id = intval($this->input->post('id'));
        $account =  trim($this->input->post('account'));
        $pwdhash =  $this->input->post('pwdhash');
        $name =  trim($this->input->post('name'));
        $email =  trim($this->input->post('email'));
        $mobile =  trim($this->input->post('mobile'));
        $provinceid = trim($this->input->post("provinceid"));
        $cityid = trim($this->input->post("cityid"));
        if(!empty($cityid))
            $provinceid = $cityid;
        $point =  intval($this->input->post('point'));
        $status =  trim($this->input->post('status'));

        $level =  trim($this->input->post('level'));

        $this->db->trans_start();
        if($pwdhash=='')
            $this->db->query('UPDATE tb_user SET account=?,name=?,email=?,mobile=?,regionid=?,point=?,status=? WHERE id =?',array($account,$name,$email,$mobile,$provinceid,$point,$status,$id));
        else
            $this->db->query('UPDATE tb_user SET account =?,pwdhash=?,name=?,email=?,mobile=?,regionid=?,$point=?,status=? WHERE id =?',array($account,password_hash($pwdhash, PASSWORD_BCRYPT),$name,$email,$mobile,$provinceid,$point,$status,$id));

        $this->db->query("UPDATE tb_broker SET level=? WHERE id=?",array($level,$id));
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    //删除选中记录
    public function delete(){
        $id=$this->input->post('id');
        $this->db->trans_start();
        $this->db->query('DELETE FROM tb_user WHERE id = ?',$id);
        $this->db->query('DELETE FROM tb_broker WHERE id = ?',$id);
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    public function findSome(){
        $query = $this->db->query('SELECT COUNT(id) AS total FROM tb_emp');
        $total=$query->row()->total;
        $query->free_result();
        $pager=pager(intval($this->input->post('pageSize')),$total,intval($this->input->post('pageNo')));
        $query = $this->db->query('SELECT a.id,a.account,a.name,a.email,a.mobile,a.status,a.cts FROM tb_user AS a WHERE tp="004002"  ORDER BY a.id DESC LIMIT ? OFFSET ?',array($pager->pageSize,($pager->pageNo-1)*$pager->pageSize));
        $data=array(
            'list'=>$query->result(),
            'pageNo'=>$pager->pageNo,
            'pageSize'=>$pager->pageSize,
            'pageCount'=>$pager->pageCount,
            'total'=>$pager->total
        );
        echo json_encode(array('success'=>TRUE,'data'=>$data));
    }

    //获取一个用户的信息
    public function findOne(){
        $id =  intval($this->input->post('id'));
        if($id!=0){
            $query = $this->db->query('SELECT a.id,a.level AS brokerlevel,COLUMN_JSON(a.dcd) AS dcd,b.account,b.email,b.name,b.mobile,b.regionid,b.point,b.status,c.level,c.pid FROM tb_broker AS a LEFT JOIN tb_user AS b ON a.id=b.id LEFT JOIN tb_region AS c ON b.regionid=c.id WHERE a.id=? LIMIT 1',array($id));
            if($query->num_rows()>0){
                $row = $query->row();
                if(intval($row->level) == 2){
                    $row->provinceid = $row->regionid;
                    $row->cityid = '';
                }else if(intval($row->level) == 3){
                    $row->provinceid = $row->pid;
                    $row->cityid = $row->regionid;
                }
                echo json_encode(array('success'=>TRUE,'data'=>$row));
            }
            else
                echo json_encode(array('success'=>FALSE,'msg'=>'无符合条件的数据'));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

    //重置密码
    public function resetPassword(){
        $id = intval($this->input->post("id"));
        $this->db->trans_start();
        $this->db->query("UPDATE tb_user SET pwdhash=? WHERE id=?",array(password_hash('123456', PASSWORD_BCRYPT),$id));
        $this->db->trans_complete();
        echo $this->db->trans_status();
    }

    //禁用   启用
    public function changeStatus(){
        $id = intval($this->input->post("id"));
        $status = trim($this->input->post("status"));
        $this->db->trans_start();
        $this->db->query("UPDATE tb_user SET status=? WHERE id=?",array($status,$id));
        $this->db->trans_complete();
        echo $this->db->trans_status();
    }

    //详情
    public function detail(){
        $id = intval($this->input->post("id"));
        $query = $this->db->query("SELECT a.id,a.level,COLUMN_JSON(a.dcd) AS dcd,b.account,b.email,b.name,b.mobile,b.status,b.cts,c.name AS regionname,c.ancestornames FROM tb_broker AS a LEFT JOIN tb_user AS b ON a.id=b.id LEFT JOIN tb_region AS c ON b.regionid=c.id WHERE a.id=? LIMIT 1",array($id));
        if($query->num_rows()>0){
            $row = $query->row();
            //经纪类型
            $query = $this->db->query("SELECT business FROM tb_broker_business WHERE userid=?",array($id));
            $row->business = $query->result();
            $query->free_result();
            //工作经历
            $query = $this->db->query("SELECT startmonth,endmonth,COLUMN_JSON(dcd) AS dcd FROM tb_broker_case WHERE userid=?",array($id));
            $row->cases = $query->result();
            $query->free_result();
            //工作招聘
            $query = $this->db->query("SELECT a.startdate,a.enddate,a.skill,a.sex,a.quantity,a.salary,a.name,a.description,GROUP_CONCAT(c.ancestornames,c.name SEPARATOR ',') AS regionname FROM tb_job AS a LEFT JOIN tb_job_region AS b ON a.id=b.jobid LEFT JOIN tb_region AS c ON b.regionid=c.id WHERE a.userid=? GROUP BY a.id",array($id));
            $row->jobs = $query->result();
            $query->free_result();
            echo json_encode($row);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */