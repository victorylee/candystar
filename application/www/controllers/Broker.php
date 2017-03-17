<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Broker extends CI_Controller {

    public function index()
    {
        // test 的萨达
        $this->smarty->view('broker/list.tpl');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */