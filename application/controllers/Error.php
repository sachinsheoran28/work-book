<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Error extends CI_Controller {

    
    public function index() {
       $this->load->view('admin/404'); 
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */