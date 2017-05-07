<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('vtp_model');
        $this->load->model('question_model');
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($cid = '') {
        $arr['page'] = 'Stream Video';
        $arr['cid'] = $cid;
        $this->load->view('admin/vwTestView', $arr);
    }

}
