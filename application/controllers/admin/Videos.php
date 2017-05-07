<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Videos extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('vtp_model');
        $this->load->model('question_model');
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($data='',$limit='') {
        $arr['page'] ='Video List';
        $arr['limit'] = $limit;
        $arr['link'] ='admin/videos/index';
        $arr['list'] =$this->vtp_model->list_videos($limit);
        $arr['count'] = $this->vtp_model->get_videos_count();
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
        $this->load->view('admin/vwVideo',$arr);      
    }
    
	public function view($cid='') {  
		$arr['page'] ='Stream Video';
		$arr['cid']= $cid;
        $this->load->view('admin/vwVideosView',$arr);
    }
    
	public function view_video($id){
        $arr['list'] =$this->vtp_model->view_video($id);
        $this->load->view('admin/vwViewVideo',$arr);
    }
    
	public function do_save($loc) {
         
         foreach(array('video', 'audio') as $type) {
      if (isset($_FILES["${type}-blob"])) {
    
        echo base_url('uploads/video/');
        
		$fileName = $_POST["${type}-filename"];
        $uploadDirectory = 'uploads/video/'.$fileName;
        
        if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
            echo(" problem moving uploaded file");
        }
		
		echo($fileName);
        $arr['date'] = $this->vtp_model->upload_video($fileName,$loc);
       }
     }

       
 }

}