<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->model('vtp_model');
        $this->load->model('question_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $arr['page'] ='home';
        if ($this->session->userdata('is_client_login')) {
            $arr['list'] = $this->question_model->get_vtp();
        $this->load->view('vwHome',$arr);
        } else {
        redirect('home/do_login');
        }
    }

     public function do_login() {

        if ($this->session->userdata('is_client_login')) {
            redirect('home/loggedin');
        } else {

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
            $this->load->view('vwLogin');
            } else {
                $user = $_POST['username'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM users WHERE user_name = '" . $user . "' AND password = '" . md5($password) . "'";
                $val = $this->db->query($sql);


                if ($val->num_rows()) {
                    foreach ($val->result_array() as $recs => $res) {

                        $this->session->set_userdata(array(
                            'id' => $res['id'],
                            'username' => $res['user_name'],
                            'email' => $res['email'], 
                            'ag_country' => $res['address_country'],  
                            'is_client_login' => true
                                )
                        );
                    }
                    redirect('home/loggedin');
                } else {
                    $err['error'] = 'Username or Password incorrect';
                    $this->load->view('vwLogin', $err);
                }
            }
        }
           }

        
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
         $this->session->unset_userdata('ag_country');
        
        $this->session->unset_userdata('is_client_login');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }

    public function loggedin(){
       $arr['list'] = $this->question_model->get_vtp();
        $this->load->view('vwHome',$arr);
    }
    public function center($aid){
       $arr['list'] = $this->vtp_model->get_cents($aid);
        $this->load->view('vwCenter',$arr);
    }
     public function inspection($cid){
       $arr['list'] = $this->question_model->get_insp($cid);
        $this->load->view('vwInspection',$arr);
    }
    
    public function start_quiz($id){
        $arr['page'] ='home';
        $arr['quiz'] = $this->question_model->get_ques($id);
        $this->form_validation->set_rules('noq', 'noq', 'required');
          if ($this->form_validation->run() == FALSE) {
                    } else {
              $laon = 'no data';
              $arr['succ']=$this->question_model->upload_result($id,$laon); 
              redirect('home/success_quiz', 'refresh');
        }
        $this->load->view('vwQuiz',$arr);
    }
    public function success_quiz(){
        $arr['succ']= "Thank you. Result saved.";
        $arr['list'] = $this->vtp_model->get_vtp();
        $this->load->view('vwHome',$arr);
    }
    
     public function savevid($id){
         $arr['list'] = $this->vtp_model->save_vid($id);
     }

    public function api(){
//http://stackoverflow.com/questions/18382740/cors-not-working-php
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
    }
    //http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined
    $postdata = file_get_contents("php://input");
	if (isset($postdata)) {
		$request = json_decode($postdata);
		$username = $request->username;
		if ($username != "") {
            $this->long = $username;
		}
		else {
			$this->long = 'no';
		}
	}
	else {
		$this->long = 'no';
	}
    }

}