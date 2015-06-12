<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dict extends CI_Controller {

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
        $this->smarty->view('admin/dict.tpl');
    }

    public function saveOrUpdate(){
        $newflag = intval($this->input->post('newflag'));
        $id =  $this->input->post('id');
        $name =  $this->input->post('name');
        $remark =  $this->input->post('remark');
        $this->db->trans_start();
        if($newflag==1){//新增
            $this->db->query('INSERT INTO tb_dict(id,name,remark) VALUES (?,?,?)',array($id,$name,$remark));
        }else{
            $this->db->query('UPDATE tb_dict SET name =?,remark=? WHERE id =?',array($name,$remark,$id));
        }
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    public function delete(){
        $id=$this->input->post('id');
        $this->db->trans_start();
        $this->db->query('DELETE FROM tb_dict WHERE id = ?',$id);
        $this->db->trans_complete();
        echo json_encode(array('success'=>$this->db->trans_status()));
    }

    public function deleteSome(){
        $ids =  explode(',',$this->input->post('ids'));
        if(count($ids)>0){
            $this->db->trans_start();
            foreach($ids as $id)
                $this->db->query('DELETE FROM tb_dict WHERE id = ?',$id);
            $this->db->trans_complete();
            echo json_encode(array('success'=>$this->db->trans_status()));
        }else
            echo json_encode(array('success'=>FALSE,'msg'=>'无效的id'));
    }

    public function findSome(){
        $query = $this->db->query('SELECT COUNT(id) AS total FROM tb_dict');
        $total=$query->row()->total;
        $query->free_result();
        $pager=pager(intval($this->input->post('pageSize')),$total,intval($this->input->post('pageNo')));
        $query = $this->db->query('SELECT id,name,remark FROM tb_dict ORDER BY id DESC LIMIT ? OFFSET ?',array($pager->pageSize,($pager->pageNo-1)*$pager->pageSize));
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
        $id =  $this->input->post('id');
        if($id!=''){
            $query = $this->db->query('SELECT id,name,remark FROM tb_dict WHERE id=? LIMIT 1',array($id));
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