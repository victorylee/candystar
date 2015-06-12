<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp extends CI_Controller {

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
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'002%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('statusList',json_encode($query->result()));
        $query->free_result();
        $query = $this->db->query("SELECT id,name FROM tb_role WHERE subdomain='001001'");
        $this->smarty->assign("roleList",json_encode($query->result()));
        $this->smarty->view('admin/emp.tpl');
    }

    //插入或修改记录
    public function saveOrUpdate(){
        $id = intval($this->input->post('id'));
        $email =  trim($this->input->post('email'));
        $pwdhash =  $this->input->post('pwdhash');
        $name =  trim($this->input->post('name'));
        $remark =  trim($this->input->post('remark'));
        $roleid =  $this->input->post('roleid');
        $status =  $this->input->post('status');
        $this->db->trans_start();
        if($id==0){//新增
            $this->db->query('INSERT INTO tb_emp(email,pwdhash,name,remark,roleid,status,cts) VALUES (?,?,?,?,?,?,NOW())',array($email,password_hash($pwdhash, PASSWORD_BCRYPT),$name,$remark,$roleid,$status));
        }else{//修改
            if($pwdhash=='')
                $this->db->query('UPDATE tb_emp SET email =?,name=?,remark=?,roleid=?,status=? WHERE id =?',array($email,$name,$remark,$roleid,$status,$id));
            else
                $this->db->query('UPDATE tb_emp SET email =?,pwdhash=?,name=?,remark=?,roleid=?,status=? WHERE id =?',array($email,password_hash($pwdhash, PASSWORD_BCRYPT),$name,$remark,$roleid,$status,$id));
        }
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    //删除选中记录
    public function delete(){
        $id=$this->input->post('id');
        $this->db->trans_start();
        $this->db->query('DELETE FROM tb_emp WHERE id = ?',$id);
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    public function deleteSome(){
        $ids =  explode(',',$this->input->post('ids'));
        if(count($ids)>0){
            $this->db->trans_start();
            foreach($ids as $id)
                $this->db->query('DELETE FROM tb_emp WHERE id = ?',$id);
            $this->db->trans_complete();
            echo json_encode(array('success'=>$this->db->trans_status()));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

    public function findSome(){
        $query = $this->db->query('SELECT COUNT(id) AS total FROM tb_emp');
        $total=$query->row()->total;
        $query->free_result();
        $pager=pager(intval($this->input->post('pageSize')),$total,intval($this->input->post('pageNo')));
        $query = $this->db->query('SELECT id,email,name,status,roleid,cts FROM tb_emp ORDER BY id DESC LIMIT ? OFFSET ?',array($pager->pageSize,($pager->pageNo-1)*$pager->pageSize));
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
            $query = $this->db->query('SELECT id,email,name,remark,roleid,status FROM tb_emp WHERE id=? LIMIT 1',array($id));
            if($query->num_rows()>0)
                echo json_encode(array('success'=>TRUE,'data'=>$query->row()));
            else
                echo json_encode(array('success'=>FALSE,'msg'=>'无符合条件的数据'));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */