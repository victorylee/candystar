<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privilege extends CI_Controller {
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
        $this->smarty->view('admin/privilege.tpl');
    }

    //插入或修改记录
    public function saveOrUpdate(){
        $newflag =intval($this->input->post('newflag'));
        $id = $this->input->post('id');
        $pid = $this->input->post('pid');
        $ancestornames =  $this->input->post('ancestornames');
        $name =  $this->input->post('name');
        $level = intval($this->input->post('level'));
        $isleaf = intval($this->input->post('isleaf'));
        $url =  $this->input->post('url');
        $this->db->trans_start();
        if($newflag == 1){//新增
            $this->db->query('INSERT INTO tb_privilege(id,pid,ancestornames,name,level,isleaf,url) VALUES(?,?,?,?,?,?,?)',array($pid.$id,$pid,$ancestornames,$name,$level,$isleaf,$url));
            $this->db->query('UPDATE tb_privilege SET isleaf=0 WHERE id=?',array($pid));
        }else{//修改
            $this->db->query('UPDATE tb_privilege SET pid=?,ancestornames=?,name=?,level=?,isleaf=?,url=? WHERE id=? ',array($pid,$ancestornames,$name,$level,$isleaf,$url,$id));
        }
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    //删除选中记录
    public function delete(){
        $id = $this->input->post('id');
        $pid = $this->input->post('pid');
        if($id!=''){
            $this->db->trans_start();
            $query = $this->db->query('SELECT COUNT(id) AS totalchildren FROM tb_privilege WHERE pid=?',array($pid));
            $totalchildren = $query->row()->totalchildren;
            $this->db->query('DELETE FROM tb_privilege WHERE id =?',array($id));
            $this->db->query('DELETE FROM tb_role_privilege WHERE privilegeid =?',array($id));
            if($totalchildren==1){
                $this->db->query('UPDATE tb_privilege SET isleaf=1 WHERE id =?',array($pid));
            }
            $this->db->trans_complete();
            echo json_encode(array('success'=>$this->db->trans_status()));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

    //获取一个权限的信息
    public function findOne(){
        $id = $this->input->post('id');
        if($id!=''){
            $query = $this->db->query('SELECT id,pid,ancestornames,name,level,isleaf,url FROM tb_privilege WHERE id=? LIMIT 1',array($id));
            if($query->num_rows()>0)
                echo json_encode(array('success'=>TRUE,'data'=>$query->row()));
            else
                echo json_encode(array('success'=>FALSE,'msg'=>'无符合条件的数据'));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

    public function getSubNodes(){
        $pid = $this->input->post("pid");
        $query = $this->db->query("SELECT id,pid,name,level,isleaf FROM tb_privilege WHERE pid=? ORDER BY id ASC",array($pid));
        echo json_encode($query->result());
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */