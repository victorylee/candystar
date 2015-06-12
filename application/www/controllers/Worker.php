<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Worker extends CI_Controller {

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

        //行业明星
        $query = $this->db->query('SELECT a.id,b.name,COLUMN_GET(a.dcd,"avatar" AS char) AS avatar  FROM tb_worker AS a  LEFT JOIN tb_user AS b ON a.id=b.id LEFT JOIN  tb_dict AS c ON a.constellation = c.id WHERE  a.isstar = 1  LIMIT 10');
        foreach($query->result() as $row){
            $q = $this->db->query('SELECT b.id,b.name FROM tb_worker_skill AS a LEFT JOIN tb_dict AS b ON a.skill = b.id WHERE userid=?',array($row->id));
            $skill = '';
            foreach($q->result() as $r){
                $skill .= $r->name.' ';
            }
            $row->skill = $skill;
            $q->free_result();
        }
        $this->smarty->assign('starList',$query->result());
        $query->free_result();

        $this->smarty->view('worker/index.tpl');
    }

    public function detail($id=0){
        $user = $this->bag->get('user');
        if(empty($user))
            redirect($this->config->base_url());

        $query = $this->db->query("SELECT a.id,a.account,a.name,a.email,a.mobile,a.regionid,b.tall,b.weight,b.bust,b.waist,b.hip,b.cup,b.hair,d.name AS hairname,b.shoe,b.birthday,b.sex,b.constellation,e.name AS constellationname,b.hobby,b.degree,f.name AS degreename,b.profession,g.name AS professionname,COLUMN_JSON(b.dcd) AS dcd,c.pid,c.name AS regionname,c.ancestornames FROM tb_user AS a LEFT JOIN tb_worker AS b ON a.id=b.id LEFT JOIN tb_region AS c ON a.regionid=c.id LEFT JOIN tb_dict AS d ON b.hair=d.id LEFT JOIN tb_dict AS e ON b.constellation=e.id LEFT JOIN tb_dict AS f ON b.degree=f.id LEFT JOIN tb_dict AS g ON b.profession=g.id WHERE a.id=? LIMIT 1",array($id));
        $row = $query->row();
        $query = $this->db->query("SELECT a.id,a.startmonth,a.endmonth,a.skill,b.name AS skillname,COLUMN_JSON(a.dcd) AS dcd FROM tb_worker_exp AS a LEFT JOIN tb_dict AS b ON a.skill=b.id WHERE a.userid=?",array($id));
        $row->exps = $query->result();
        $query = $this->db->query("SELECT a.id,a.skill,b.name FROM tb_worker_skill AS a LEFT JOIN tb_dict AS b ON a.skill=b.id WHERE a.userid=?",array($id));
        $row->skills = $query->result();
        $query = $this->db->query("SELECT a.id,a.regionid,b.name AS regionname FROM tb_worker_region AS a LEFT JOIN tb_region AS b ON a.regionid=b.id WHERE a.userid=?",array($id));
        $row->regions = $query->result();
        $this->smarty->assign("worker",$row);
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'005%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('skillList',$query->result());
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'006%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('hairList',$query->result());
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'007%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('constellationList',$query->result());
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'009%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('degreeList',$query->result());
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'010%\' LIMIT 625 OFFSET 1');
        $this->smarty->assign('professionList',$query->result());
        $query->free_result();
        //地区
        $query = $this->db->query('SELECT id,name FROM tb_region WHERE level=2');
        $this->smarty->assign('provinceList',$query->result());
        $query->free_result();
        $query = $this->db->query('SELECT id,name FROM tb_region WHERE pid=\'001001\'');
        $this->smarty->assign('cityList',$query->result());
        $query->free_result();
        $this->smarty->view('worker/detail.tpl');
    }

    public function findSome(){
        $user = $this->bag->get('user');
        if(empty($user))
            redirect($this->config->base_url());

        $pageSize = intval($this->input->post('pageSize'));
        $pageSize = $pageSize == 0 ? 20 : $pageSize;
        $pageIndex = intval($this->input->post('pageIndex'));
        $pageIndex = $pageIndex == 0 ? 1 : $pageIndex;

        $tmp = '';
        $skill = $this->input->post('skill');
        if(!empty($skill))
            $tmp .= ' AND a.id in ( SELECT userid FROM tb_worker_skill WHERE skill=\''.$skill.'\') ';

        $region = $this->input->post('region');
        if(!empty($region))
            $tmp .= ' AND a.id in ( SELECT userid FROM tb_worker_region WHERE regionid  LIKE \''.$region.'%\') ';

        $query = $this->db->query('SELECT a.id,b.name,a.tall,a.weight,a.bust,a.waist,a.hip,a.birthday,a.shoe,c.name AS constellation,COLUMN_GET(a.dcd,"avatar" AS char) AS avatar  FROM tb_worker AS a  LEFT JOIN tb_user AS b ON a.id=b.id LEFT JOIN  tb_dict AS c ON a.constellation = c.id WHERE  1=1 '.$tmp.' ORDER BY a.id DESC LIMIT ? OFFSET ?',array($pageSize,($pageIndex-1)*$pageSize));

        foreach($query->result() as $row){
            $q = $this->db->query('SELECT b.id,b.name FROM tb_worker_skill AS a LEFT JOIN tb_dict AS b ON a.skill = b.id WHERE userid=?',array($row->id));
            $row->skill = $q->result();
            $q->free_result();

            $q = $this->db->query('SELECT b.id,b.name FROM tb_worker_region AS a LEFT JOIN tb_region AS b ON a.regionid = b.id WHERE userid=?',array($row->id));
            $row->region = $q->result();
            $q->free_result();
        }
        $workers = $query->result();
        $query->free_result();


        $query = $this->db->query('SELECT COUNT(a.id) AS total FROM tb_worker AS a WHERE 1=1 '.$tmp);
        $total = $query->row()->total;
        $totalPages = ceil($total/$pageSize);
        $pageStr = pageString($pageSize,$pageIndex,$total);

        $data['workers'] = $workers;
        $data['pageStr'] = $pageStr;
        $data['pageIndex'] = $pageIndex;
        $data['total'] = $total;
        $data['totalPages'] = $totalPages;

        $this->renderJsonData($data);
    }

}
