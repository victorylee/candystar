<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index()
    {
        $user = $this->bag->get("user");
        if($user->tp == '004001'){
            $query = $this->db->query("SELECT a.id,a.account,a.name,a.email,a.mobile,a.regionid,b.tall,b.weight,b.bust,b.waist,b.hip,b.cup,b.hair,d.name AS hairname,b.shoe,b.birthday,b.sex,b.constellation,e.name AS constellationname,b.hobby,b.degree,f.name AS degreename,b.profession,g.name AS professionname,COLUMN_JSON(b.dcd) AS dcd,c.pid,c.name AS regionname,c.ancestornames FROM tb_user AS a LEFT JOIN tb_worker AS b ON a.id=b.id LEFT JOIN tb_region AS c ON a.regionid=c.id LEFT JOIN tb_dict AS d ON b.hair=d.id LEFT JOIN tb_dict AS e ON b.constellation=e.id LEFT JOIN tb_dict AS f ON b.degree=f.id LEFT JOIN tb_dict AS g ON b.profession=g.id WHERE a.id=? LIMIT 1",array($user->id));
            $row = $query->row();
            $query = $this->db->query("SELECT a.id,a.startmonth,a.endmonth,a.skill,b.name AS skillname,COLUMN_JSON(a.dcd) AS dcd FROM tb_worker_exp AS a LEFT JOIN tb_dict AS b ON a.skill=b.id WHERE a.userid=?",array($user->id));
            $row->exps = $query->result();
            $query = $this->db->query("SELECT a.id,a.skill,b.name FROM tb_worker_skill AS a LEFT JOIN tb_dict AS b ON a.skill=b.id WHERE a.userid=?",array($user->id));
            $row->skills = $query->result();
            $query = $this->db->query("SELECT a.id,a.regionid,b.name AS regionname FROM tb_worker_region AS a LEFT JOIN tb_region AS b ON a.regionid=b.id WHERE a.userid=?",array($user->id));
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
            $this->smarty->view('profile/worker.tpl');
        }else{
            $query = $this->db->query("SELECT a.id,a.account,a.name,a.email,a.mobile,a.regionid,a.point,COLUMN_JSON(b.dcd) AS dcd,c.pid,c.name AS regionname,c.ancestornames FROM tb_user AS a LEFT JOIN tb_broker AS b ON a.id=b.id LEFT JOIN tb_region AS c ON a.regionid=c.id WHERE a.id=? LIMIT 1",array($user->id));
            $row = $query->row();
            $query = $this->db->query("SELECT a.id,a.startmonth,a.endmonth,COLUMN_JSON(a.dcd) AS dcd FROM tb_broker_case AS a WHERE a.userid=?",array($user->id));
            $row->cases = $query->result();
            $query = $this->db->query("SELECT a.id,a.business,b.name AS businessname FROM tb_broker_business AS a LEFT JOIN tb_dict AS b ON a.business=b.id WHERE a.userid=?",array($user->id));
            $row->business = $query->result();
            $query = $this->db->query("SELECT a.id,a.startdate,a.enddate,a.skill,b.name AS skillname,a.sex,c.name AS sexname,a.quantity,a.salary,a.name,a.description FROM tb_job AS a LEFT JOIN tb_dict AS b ON a.skill=b.id LEFT JOIN tb_dict AS c ON a.sex=c.id WHERE a.userid=?",array($user->id));
            $row->jobs = $query->result();
            $this->smarty->assign("broker",$row);
            $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'005%\' LIMIT 625 OFFSET 1');
            $this->smarty->assign('skillList',$query->result());
            $query->free_result();
            $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'008%\' LIMIT 625 OFFSET 1');
            $this->smarty->assign('sexList',$query->result());
            $query->free_result();
            $query = $this->db->query('SELECT id,name FROM tb_dict WHERE id LIKE \'012%\' LIMIT 625 OFFSET 1');
            $this->smarty->assign('businessList',$query->result());
            $query->free_result();
            //地区
            $query = $this->db->query('SELECT id,name FROM tb_region WHERE level=2');
            $this->smarty->assign('provinceList',$query->result());
            $query->free_result();
            $query = $this->db->query('SELECT id,name FROM tb_region WHERE pid=\'001001\'');
            $this->smarty->assign('cityList',$query->result());
            $query->free_result();
            $this->smarty->view('profile/broker.tpl');
        }
    }

    //修改头像
    public function saveavatar(){
        $this->load->model('image');
        $resultdata = array();
        $user = $this->bag->get('user');
        $type = $this->input->post('type');
        $name = $this->input->post('url');
        //120*120图像全图宽度
        $width = intval($this->input->post('width'));
        //120*120图像全图高度
        $height = intval($this->input->post('height'));
        $marginleft = intval($this->input->post('marginleft'));
        $margintop = intval($this->input->post('margintop'));
        $arr = explode('.',$name);
        $big = $arr[0].'_big.'.$arr[1];
        $path = $_SERVER['DOCUMENT_ROOT'].'/temp/'.$name;
        $this->image->gmagick_crop($path,$width,$height,$marginleft,$margintop);
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $disurl = $_SERVER['DOCUMENT_ROOT'].'/resource/avatar/'.$year.'/'.$month."/".$day."/";
        $temppath = $_SERVER['DOCUMENT_ROOT'].'/temp/';
        mkdirex($disurl);
        $bigresult = FALSE;
        $srcresult = FALSE;
        if(file_exists($temppath.$big))
            $bigresult = rename($temppath.$big, $disurl.$big);
        if(file_exists($temppath.$name))
            $srcresult = rename($temppath.$name, $disurl.$name);
        if($bigresult&&$srcresult){
            $this->db->trans_start();
            if($type == 1)
                $this->db->query('UPDATE tb_worker SET dcd=COLUMN_ADD(dcd,\'avatar\',? AS CHAR) WHERE id = ?',array('/resource/avatar/'.$year.'/'.$month."/".$day."/".$big,intval($user->id)));
            else
                $this->db->query('UPDATE tb_broker SET dcd=COLUMN_ADD(dcd,\'avatar\',? AS CHAR) WHERE id = ?',array('/resource/avatar/'.$year.'/'.$month."/".$day."/".$big,intval($user->id)));
            $this->db->trans_complete();
            $resultdata['success'] = TRUE;
            $resultdata['data'] = array(
                'big'=>'http://www.candystar.cn/resource/avatar/'.$year.'/'.$month."/".$day."/".$big
            );
        }else{
            $resultdata['success'] = FALSE;
            $resultdata['msg'] = 'failed';
        }
        echo json_encode($resultdata);
    }

    //艺术照
    public function savesnapshot(){
        $user = $this->bag->get('user');
        $paths = $this->input->post('paths');
        $year = date("Y");
        $month = date("m");
        $disurl = $_SERVER['DOCUMENT_ROOT'].'/resource/photography/'.$year.'/'.$month;
        $temppath = $_SERVER['DOCUMENT_ROOT'].'/temp';
        mkdirex($disurl);
        $srcresult = TRUE;
        $dispaths = array();
        for($i=0;$i<count($paths);$i=$i+1){
            $name = strrchr($paths[$i],'/');
            $arr = explode('.',$name);
            $big = $arr[0].'_800.jpg';
            $small = $arr[0].'_120.jpg';
            if(file_exists($temppath.$name))
                $srcresult = $srcresult&&rename($temppath.$name, $disurl.$name);
            if(file_exists($temppath.$big))
                $srcresult = $srcresult&&rename($temppath.$big, $disurl.$big);
            if(file_exists($temppath.$small))
                $srcresult = $srcresult&&rename($temppath.$small, $disurl.$small);
            array_push($dispaths,'/resource/photography/'.$year.'/'.$month.$name);
        }
        $str = ' ';
        if($srcresult){//图片移动成功
            for($i=0;$i<count($dispaths);$i=$i+1){
                if($i ==0)
                    $str.=' \''.$i.'\', \''.$dispaths[$i].'\' AS CHAR';
                else
                    $str.=' , \''.$i.'\',\''.$dispaths[$i].'\' AS CHAR';
            }
            $this->db->trans_start();
            $this->db->query('UPDATE tb_worker SET dcd=COLUMN_ADD(dcd,\'num\', '.count($paths).' AS INTEGER,\'imgs\',COLUMN_CREATE( '.$str.')) WHERE id=?',array(intval($user->id)));
            $this->db->trans_complete();
            $ret = array(
                'status' => $this->db->trans_status(),
                'paths'  => json_encode($dispaths)
            );
            echo json_encode($ret);
        }else{//图片移动失败
            $ret['status'] = FALSE;
            echo json_encode($ret);
        }
    }

    public function saveWorkerBasicInfo(){
        $user = $this->bag->get("user");
        $name = trim($this->input->post("name"));
        $provinceid = trim($this->input->post("provinceid"));
        $cityid = trim($this->input->post("cityid"));
        if(!empty($cityid))
            $provinceid = $cityid;
        $email = trim($this->input->post("email"));
        $tall = intval($this->input->post("tall"));
        $weight = intval($this->input->post("weight"));
        $bust = intval($this->input->post("bust"));
        $waist = intval($this->input->post("waist"));
        $hip = intval($this->input->post("hip"));
        $hair = trim($this->input->post("hair"));
        $cup = trim($this->input->post("cup"));
        $shoe = intval($this->input->post("shoe"));
        $birthday = trim($this->input->post("birthday"));
        $sex = intval($this->input->post("sex"));
        $constellation = trim($this->input->post("constellation"));
        $degree = trim($this->input->post("degree"));
        $profession = trim($this->input->post("profession"));
        $hobby = trim($this->input->post("hobby"));
        $workcitys = trim($this->input->post("workcitys"));
        $workcitys = substr($workcitys,0,strlen($workcitys)-1);
        $workcitys = explode(",",$workcitys);
        $sql = "INSERT INTO tb_worker_region(id,userid,regionid) VALUES";
        foreach($workcitys AS $item){
            $sql.='('.trxid().','.intval($user->id).',"'.$item.'"),';
        }
        $sql_region = substr($sql,0,strlen($sql)-1);

        $business = trim($this->input->post("business"));
        $business = substr($business,0,strlen($business)-1);
        $business = explode(",",$business);
        $sql = "INSERT INTO tb_worker_skill(id,userid,skill) VALUES";
        foreach($business AS $item){
            $sql.='('.trxid().','.intval($user->id).',"'.$item.'"),';
        }
        $sql_skill = substr($sql,0,strlen($sql)-1);

        $this->db->trans_start();
        $this->db->query("UPDATE tb_user SET name=?,email=?,regionid=? WHERE id=?",array($name,$email,$provinceid,intval($user->id)));
        $this->db->query("UPDATE tb_worker SET tall=?,weight=?,bust=?,waist=?,hip=?,cup=?,hair=?,shoe=?,birthday=?,sex=?,constellation=?,degree=?,profession=?,hobby=? WHERE id=?",array($tall,$weight,$bust,$waist,$hip,$cup,$hair,$shoe,$birthday,$sex,$constellation,$degree,$profession,$hobby,intval($user->id)));
        $this->db->query("DELETE FROM tb_worker_region WHERE userid=?",array(intval($user->id)));
        $this->db->query($sql_region);
        $this->db->query("DELETE FROM tb_worker_skill WHERE userid=?",array(intval($user->id)));
        $this->db->query($sql_skill);
        $this->db->trans_complete();
        echo $this->db->trans_status();
    }

    public function saveBrokerBasicInfo(){
        $user = $this->bag->get("user");
        $name = trim($this->input->post("name"));
        $provinceid = trim($this->input->post("provinceid"));
        $cityid = trim($this->input->post("cityid"));
        $business = trim($this->input->post("business"));
        $business = substr($business,0,strlen($business)-1);
        $business = explode(",",$business);
        $sql = "INSERT INTO tb_broker_business(id,userid,business) VALUES";
        foreach($business AS $item){
            $sql.='('.trxid().','.intval($user->id).',"'.$item.'"),';
        }
        $sql = substr($sql,0,strlen($sql)-1);
        if(!empty($cityid))
            $provinceid = $cityid;
        $email = trim($this->input->post("email"));
        $this->db->trans_start();
        $this->db->query("UPDATE tb_user SET name=?,email=?,regionid=? WHERE id=?",array($name,$email,$provinceid,intval($user->id)));
        $this->db->query("DELETE FROM tb_broker_business WHERE userid=?",array(intval($user->id)));
        $this->db->query($sql);
        $this->db->trans_complete();
        echo $this->db->trans_status();
    }

    public function saveWorkerExp(){
        $user = $this->bag->get("user");
        $id = $this->input->post("id");
        $startmonth = trim($this->input->post("startmonth"));
        $endmonth = trim($this->input->post("endmonth"));
        $skill = trim($this->input->post("skill"));
        $result = trim($this->input->post("result"));
        $description = trim($this->input->post("description"));
        $this->db->trans_start();
        if($id == 0){
            $id = trxid();
            $this->db->query("INSERT INTO tb_worker_exp(id,userid,startmonth,endmonth,skill,dcd) VALUES(?,?,?,?,?,COLUMN_CREATE('result',? AS CHAR,'description',? AS CHAR))",array($id,intval($user->id),$startmonth.'-01',$endmonth.'-01',$skill,$result,$description));
        }else{
            $this->db->query("UPDATE tb_worker_exp SET startmonth=?,endmonth=?,skill=?,dcd=COLUMN_ADD(dcd,'result',? AS CHAR,'description',? AS CHAR) WHERE id=?",array($startmonth.'-01',$endmonth.'-01',$skill,$result,$description,$id ));
        }
        $this->db->trans_complete();
        echo json_encode(array("success"=>$this->db->trans_status(),"id"=>$id));
    }

    public function saveBrokerCase(){
        $user = $this->bag->get("user");
        $id = $this->input->post("id");
        $startmonth = trim($this->input->post("startmonth"));
        $endmonth = trim($this->input->post("endmonth"));
        $result = trim($this->input->post("result"));
        $description = trim($this->input->post("description"));
        $this->db->trans_start();
        if($id == 0){
            $id = trxid();
            $this->db->query("INSERT INTO tb_broker_case(id,userid,startmonth,endmonth,dcd) VALUES(?,?,?,?,COLUMN_CREATE('result',? AS CHAR,'description',? AS CHAR))",array($id,intval($user->id),$startmonth."-01",$endmonth."-01",$result,$description));
        }else{
            $this->db->query("UPDATE tb_broker_case SET startmonth=?,endmonth=?,dcd=COLUMN_ADD(dcd,'result',? AS CHAR,'description',? AS CHAR) WHERE id=?",array($startmonth."-01",$endmonth."-01",$result,$description,$id ));
        }
        $this->db->trans_complete();
        echo json_encode(array("success"=>$this->db->trans_status(),"id"=>$id));
    }

    public function saveBrokerJob(){
        $user = $this->bag->get("user");
        $id = $this->input->post("id");
        $startdate = trim($this->input->post("startdate"));
        $enddate = trim($this->input->post("enddate"));
        $skill = trim($this->input->post("skill"));
        $sex = trim($this->input->post("sex"));
        $quantity = intval($this->input->post("quantity"));
        $salary = trim($this->input->post("salary"));
        $name = trim($this->input->post("name"));
        $description = trim($this->input->post("description"));
        $this->db->trans_start();
        if($id == 0){
            $id = trxid();
            $this->db->query("INSERT INTO tb_job(id,userid,startdate,enddate,skill,sex,quantity,salary,name,description) VALUES(?,?,?,?,?,?,?,?,?,?)",array($id,intval($user->id),$startdate,$enddate,$skill,$sex,$quantity,$salary,$name,$description));
        }else{
            $this->db->query("UPDATE tb_job SET startdate=?,enddate=?,skill=?,sex=?,quantity=?,salary=?,name=?,description=? WHERE id=?",array($startdate,$enddate,$skill,$sex,$quantity,$salary,$name,$description,$id));
        }
        $this->db->trans_complete();
        echo json_encode(array("success"=>$this->db->trans_status(),"id"=>$id));
    }

    public function deleteWorkExp(){
        $id = $this->input->post("id");
        $this->db->trans_start();
        $this->db->query("DELETE FROM tb_worker_exp WHERE id=?",array($id));
        $this->db->trans_complete();
        echo $this->db->trans_status();
    }

    public function deleteBrokerCase(){
        $id = intval($this->input->post("id"));
        $this->db->trans_start();
        $this->db->query("DELETE FROM tb_broker_case WHERE id=?",array($id));
        $this->db->trans_complete();
        echo $this->db->trans_status();
    }

    public function deleteBrokerJob(){
        $id = intval($this->input->post("id"));
        $this->db->trans_start();
        $this->db->query("DELETE FROM tb_job WHERE id=?",array($id));
        $this->db->trans_complete();
        echo $this->db->trans_status();
    }

    public function findSubRegion(){
        $pid = $this->input->post("pid");
        if(!empty($pid)){
            $query = $this->db->query("SELECT id,name FROM tb_region WHERE pid = ?",array($pid));
            echo json_encode($query->result());
        }else{
            echo '';
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */