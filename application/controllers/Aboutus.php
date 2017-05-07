<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aboutus extends CI_Controller {

    /**
     
     */
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('is_client_login') == '') {
        redirect('home/do_login');
        }
    }

    public function index() {
           $arr['page'] ='about';
        $this->load->view('vwAboutus',$arr);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */