<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

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
        $file_forder =$_SERVER['DOCUMENT_ROOT'].'/temp/';
        $file_name  = trxid();  //新文件名
        $config['upload_path'] = $file_forder;           //文件保存路径  这儿我用的是实际路径
        $config['allowed_types'] = 'jpg|jpeg|gif|png|jpe';  //允许上传格式
        $config['max_size'] = '2048';                           //允许上传大小
        $config['file_name']     = $file_name;                  //存放的文件名
        $this->load->library('upload', $config);
        $field_name = 'Filedata';   //上传表单字段名
        if ($this->upload->do_upload($field_name))
        {
            $data   = $this->upload->data();
            //取回图片尺寸
            $file_path = $file_forder.$data['file_name'];
            $gmagick = new Gmagick($file_path);
            $rso['success']=TRUE;
            $rso['msg']='上传成功';
            $rso['data']=array(
                'url'=>$data['file_name'],
                'width'=> $gmagick->getimagewidth(),
                'height'=> $gmagick->getimageheight()
            );
        }else{
            $data   = $this->upload->data();
            $rso['success']=FALSE;
            $rso['msg']=$data['file_type'];
        }
        echo json_encode($rso);
    }

    public function snapshot(){
        $rso=array();
        $file_forder = $_SERVER['DOCUMENT_ROOT'].'/temp/';
        $file_name  =trxid();  //新文件名
        $config['upload_path'] = $file_forder;           //文件保存路径  这儿我用的是实际路径
        $config['allowed_types'] = 'jpg|jpeg|gif|png|jpe';  //允许上传格式
        $config['max_size'] = '20480';                           //允许上传大小
        $config['file_name']     = $file_name;                  //存放的文件名
        $this->load->library('upload', $config);
        $field_name = 'snapshot';   //上传表单字段名
        if ($this->upload->do_upload($field_name))
        {
            $data   = $this->upload->data();
            $this->load->model('image');
            $this->image->compression($data['full_path']);
            $rso['success']=TRUE;
            $rso['msg']='上传成功';
            $rso['data']=array(
                'id'=>$file_name,
                'url'=> '/temp/'.$data['file_name']
            );
        }else{
            $rso['success']=FALSE;
            $rso['msg']=$this->upload->display_errors();
        }
        echo json_encode($rso);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */