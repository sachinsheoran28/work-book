<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('question_model');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $arr['page']='dash';
		$arr['title'] = 'Dashboard';
        $arr['ques']= $this->question_model->get_ques_num();
        $arr['vtp']= $this->question_model->get_vtp_num();
        $arr['users']= $this->question_model->get_users_num();
        $arr['center']= $this->question_model->get_center_num();
        $this->load->view('admin/vwDashboard',$arr);
    }
    public function error()
    {
     $this->load->view('admin/404');        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */