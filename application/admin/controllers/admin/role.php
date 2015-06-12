<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

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
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'001%\' LIMIT 999 OFFSET 1');
        $this->smarty->assign('subdomainList',json_encode($query->result()));
        $this->smarty->view('admin/role.tpl');
    }

    public function saveOrUpdate(){
        $newflag = intval($this->input->post('newflag'));
        $id =  intval($this->input->post('id'));
        $subdomain =  $this->input->post('subdomain');
        $name =  $this->input->post('name');
        $remark =  $this->input->post('remark');
        $this->db->trans_start();
        if($newflag==1){//新增
            $this->db->query('INSERT INTO tb_role(subdomain,name,remark) VALUES (?,?,?)',array($subdomain,$name,$remark));
        }else{
            $this->db->query('UPDATE tb_role SET subdomain=?,name =?,remark=? WHERE id =?',array($subdomain,$name,$remark,$id));
        }
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    public function delete(){
        $id=intval($this->input->post('id'));
        $this->db->trans_start();
        $this->db->query('DELETE FROM tb_role WHERE id = ?',$id);
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    public function deleteSome(){
        $ids =  explode(',',$this->input->post('ids'));
        if(count($ids)>0){
            $this->db->trans_start();
            foreach($ids as $id)
                $this->db->query('DELETE FROM tb_role WHERE id = ?',intval($id));
            $this->db->trans_complete();
            echo json_encode(array('success'=>$this->db->trans_status()));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

    public function findSome(){
        $query = $this->db->query('SELECT COUNT(id) AS total FROM tb_role');
        $total=$query->row()->total;
        $query->free_result();
        $pager=pager(intval($this->input->post('pageSize')),$total,intval($this->input->post('pageNo')));
        $query = $this->db->query('SELECT id,subdomain,name,remark FROM tb_role ORDER BY id DESC LIMIT ? OFFSET ?',array($pager->pageSize,($pager->pageNo-1)*$pager->pageSize));
        $data=array(
            'list'=>$query->result(),
            'pageNo'=>$pager->pageNo,
            'pageSize'=>$pager->pageSize,
            'pageCount'=>$pager->pageCount,
            'total'=>$pager->total
        );
        echo json_encode(array('success'=>TRUE,'data'=>$data));
    }

    public function findOne(){
        $id =  intval($this->input->post('id'));
        if(!empty($id)){
            $query = $this->db->query('SELECT id,subdomain,name,remark FROM tb_role WHERE id=? LIMIT 1',array($id));
            if($query->num_rows()>0)
                echo json_encode(array('success'=>TRUE,'data'=>$query->row()));
            else
                echo json_encode(array('success'=>FALSE,'msg'=>'无符合条件的数据'));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

    public function findPrivilege(){
        $roleid = $this->input->post('roleid');
        $query = $this->db->query('SELECT a.id,a.pid,a.name,a.isleaf,EXISTS(SELECT * FROM tb_role_privilege AS b WHERE a.id=b.privilegeid AND b.roleid=?) AS granted FROM tb_privilege AS a WHERE a.subdomain=\'001001\' ORDER BY a.id ASC',array($roleid));
        echo json_encode(array('success'=>TRUE,'data'=>$query->result()));
    }

    public function addPrivilege(){
        $roleid = $this->input->post('roleid');
        $privilegeIds=explode(',',$this->input->post('privilegeIds'));
        if(!empty($roleid)){
            $this->db->trans_start();
            if(count($privilegeIds)>0){
                $this->db->query('DELETE FROM tb_role_privilege WHERE roleid=?',array($roleid));
                foreach($privilegeIds as $privilegeId)
                    $this->db->query('INSERT INTO tb_role_privilege(roleid,privilegeid) VALUES(?,?)',array($roleid,$privilegeId));
            }
            $this->db->trans_complete();
            echo json_encode(array('success'=>$this->db->trans_status()));
        }else{
            echo json_encode(array('success'=>FALSE));
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */