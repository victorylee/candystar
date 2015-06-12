<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Save extends CI_Controller {

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

    public function avatar(){
        $rso=array();
        $this->load->model('image');
        $this->load->helper('util');
        $name = $this->input->post('name');
        $width = intval($this->input->post('width'));
        $height = intval($this->input->post('height'));
        $marginleft = intval($this->input->post('marginleft'));
        $margintop = intval($this->input->post('margintop'));
        $arr = explode('.',$name);
        $big = $arr[0].'_big.'.$arr[1];
        $middle = $arr[0].'_middle.'.$arr[1];
        $small = $arr[0].'_small.'.$arr[1];
        $path = $_SERVER['DOCUMENT_ROOT'].'/temp'.$name;
        $this->image->gmagick_crop($path,$width,$height,$marginleft,$margintop);
        $year = date("Y");
        $month = date("m");
        $disurl = $_SERVER['DOCUMENT_ROOT'].'/resource/avatar/'.$year.'/'.$month;
        $temppath = $_SERVER['DOCUMENT_ROOT'].'/temp';
        createFolder($disurl);
        $bigresult = FALSE;
        $middleresult = FALSE;
        $smallresult = FALSE;
        $srcresult = FALSE;
        if(file_exists($temppath.$big))
            $bigresult = copy($temppath.$big, $disurl.$big);
        if(file_exists($temppath.$middle))
            $middleresult = copy($temppath.$middle, $disurl.$middle);
        if(file_exists($temppath.$small))
            $smallresult = copy($temppath.$small, $disurl.$small);
        if(file_exists($temppath.$name))
            $srcresult = copy($temppath.$name, $disurl.$name);
        if($bigresult&&$middleresult&&$smallresult&&$srcresult){
            $rso['success'] = TRUE;
            $rso['data'] = array(
                'big'=>'/resource/avatar/'.$year.'/'.$month.$big,
                'middle'=> '/resource/avatar/'.$year.'/'.$month.$middle,
                'small'=> '/resource/avatar/'.$year.'/'.$month.$small,
                'src'=>'/resource/avatar/'.$year.'/'.$month.$name
            );
        }else{
            $rso['success'] = FALSE;
        }
        echo json_encode($rso);
    }


    public function snapshot(){
        $rso=array();
        $this->load->helper('util');
        $paths = json_decode($this->input->post('paths'));
        $year = date("Y");
        $month = date("m");
        $disurl = $_SERVER['DOCUMENT_ROOT'].'/resource/photography/'.$year.'/'.$month;
        $temppath = $_SERVER['DOCUMENT_ROOT'].'/temp';
        createFolder($disurl);
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
        if($srcresult){
            $rso['success'] = TRUE;
            $rso['paths'] = $dispaths;
        }else{
            $rso['success'] = FALSE;
        }
        echo json_encode($rso);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */