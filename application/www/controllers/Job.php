<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

    public function index(){
        $user = $this->bag->get('user');
        if(empty($user))
            redirect($this->config->base_url());
        //职位类型
        $query=$this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'005%\' LIMIT 655 OFFSET 1');
        $this->smarty->assign('skillList',$query->result());
        $query->free_result();
        //工作地点
        $query=$this->db->query('SELECT id,name FROM tb_region WHERE level=2');
        $this->smarty->assign('regionList',$query->result());
        $query->free_result();

        $this->smarty->view('job/index.tpl');
    }

    public function detail($id=0){
        $user = $this->bag->get('user');
        if(empty($user))
            redirect($this->config->base_url());

        $query = $this->db->query('SELECT id FROM tb_job WHERE id=?',array($id));
        if($query->num_rows() == 0){
            echo '您的链接有误，此工作不存在！！！！！！';die;
        }

        $query = $this->db->query('SELECT a.id,a.userid,b.name AS broker,f.name AS levelname,e.company,a.startdate,a.enddate,a.skill,c.name AS skillname,a.sex,d.name AS sexname,a.quantity,a.salary,a.name,a.description FROM tb_job AS a  LEFT JOIN tb_user AS b ON a.userid=b.id LEFT JOIN tb_dict AS c ON a.skill=c.id  LEFT JOIN tb_dict AS d ON a.sex=d.id LEFT JOIN  tb_broker AS e ON e.id=b.id LEFT JOIN  tb_dict AS f ON f.id=e.level WHERE a.id=? ',array($id));

        foreach($query->result() as $row) {
            $q = $this->db->query('SELECT b.id,b.name FROM tb_job_region AS a LEFT JOIN tb_region AS b ON a.regionid = b.id WHERE a.jobid=?',array($id));
            $region = '';
            foreach($q->result() as $item){
                if(empty($region)){
                    $region .= $item->name;
                }else{
                    $region .= ','.$item->name;
                }
            }
            $row->region = $region;
        }
        $this->smarty->assign('job',$query->row());

        $this->smarty->view("job/detail.tpl");
    }

    public function findSome(){
        $user = $this->bag->get('user');
        if(empty($user))
            redirect($this->config->base_url());

        $pageSize = intval($this->input->post('pageSize'));
        $pageSize = $pageSize == 0 ? 10 : $pageSize;
        $pageIndex = intval($this->input->post('pageIndex'));
        $pageIndex = $pageIndex == 0 ? 1 : $pageIndex;

        $tmp = '';
        $keyword = trim($this->input->post('keyword'));
        if(!empty($keyword))
            $tmp .= ' AND (a.name like \'%'.$keyword.'%\' OR a.description like \'%'.$keyword.'%\' ) ';

        $skill = $this->input->post('skill');
        if(!empty($skill))
            $tmp .= ' AND a.skill  in ('.$skill.') ';

        $region = $this->input->post('region');

        if(!empty($region)){
            $regionlist = explode(',',$region);
            $tmp = ' AND a.id in ( SELECT jobid FROM tb_job_region WHERE ' ;
            $regionWhere = '';
            foreach($regionlist as $r){
                if($regionWhere == ''){
                    $regionWhere .= ' regionid  LIKE \''.$r.'%\'  ';
                }else{
                    $regionWhere .= ' OR regionid  LIKE \''.$r.'%\' ';
                }
            }
            $tmp .= $regionWhere.' ) ';
        }

        $query = $this->db->query('SELECT a.id,a.userid,b.name AS broker, a.startdate,a.enddate,a.skill,c.name AS skillname,a.sex,d.name AS sexname,a.quantity,a.salary,a.name,a.description FROM tb_job AS a  LEFT JOIN tb_user AS b ON a.userid=b.id LEFT JOIN tb_dict AS c ON a.skill=c.id  LEFT JOIN tb_dict AS d ON a.sex=d.id WHERE  1=1 '.$tmp.' ORDER BY a.id DESC LIMIT ? OFFSET ?',array($pageSize,($pageIndex-1)*$pageSize));
        $jobs = $query->result();
        $query->free_result();

        $query = $this->db->query('SELECT COUNT(a.id) AS total FROM tb_job AS a WHERE 1=1 '.$tmp);
        $total = $query->row()->total;
        $totalPages = ceil($total/$pageSize);
        $pageStr = pageString($pageSize,$pageIndex,$total);
        echo json_encode(array('jobs'=>$jobs,'pageStr'=>$pageStr,'pageIndex'=>$pageIndex,'total'=>$total,'totalPages'=>$totalPages));
    }



}
