<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Videos extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('vtp_model');
        $this->load->model('question_model');
        $this->load->library('form_validation');
    }

    public function index($cid='') {
        if ($this->session->userdata('status') != '0'){
            redirect('videos/view');
        }
        
        if ($this->session->userdata('is_client_login')) {
            $arr['page'] ='videos';
            $arr['cid']= $cid;
         $this->load->view('vwVideos',$arr);
        } else {
            redirect('home/do_login');
        }
    }
    
	public function view($cid='') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        if ($this->session->userdata('status') == '0'){
            redirect('videos');
        }
        
        if ($this->session->userdata('is_client_login')) {
            $arr['page'] ='videos';
            $arr['cid']= $cid;
         $this->load->view('vwVideosView',$arr);
        } else {
            redirect('home/do_login');
        }
    }
    
	public function view_video($id){
		$arr['page'] ='videos';
        if ($this->session->userdata('is_client_login')) {
        $arr['list'] =$this->vtp_model->view_video($id); 
         $this->load->view('vwViewVideo',$arr);
        } else {
            redirect('home/do_login');
        }
    }
    
    public function do_save($loc,$cid) {
       
      header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Credentials: true');
      header('Access-Control-Max-Age: 864000');
         
         foreach(array('video', 'audio') as $type) {
      if (isset($_FILES["${type}-blob"])) {
    
        echo base_url('uploads/video/');
        
		$fileName = $_POST["${type}-filename"];
        $uploadDirectory = 'uploads/video/'.$fileName;
        
        if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
            echo(" problem moving uploaded file");
        }
          $data['message'] = $this->vtp_model->upload_video($fileName,$loc,$cid);
        $this->load->view('json', $data);
       }
     }

       
     }

}