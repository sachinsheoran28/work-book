<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('vtp_model');
         $this->load->model('result_model');
        $this->load->library('form_validation');
    }

    public function index($succ='',$limit='') {
        if ($this->session->userdata('is_client_login')) {
        if ($this->session->userdata('status') != '0'){
           $arr['page'] = 'Reports';
           $arr['limit'] = $limit;
           $arr['list'] = $this->vtp_model->get_resultscInventry($limit,$this->session->userdata('status'));
           $arr['count'] = $this->vtp_model->get_resultscInventry_count($this->session->userdata('status'));
          $arr['link'] ='stock/index';
        
          $this->load->view('vwManageResultsStock',$arr);
        }
            
        } else {
            redirect('home/do_login');
        }
    }
    public function view_variance($rid){
        $arr['page'] = 'results';
        $arr['list'] = $this->vtp_model->get_variance($rid);
        $this->load->view('vwVarianceShow',$arr);
        
        
    }
     public function view_result($id) {
        $arr['page'] = 'inventory';
        
        $arr['list'] = $this->result_model->get_inventory_result($id);
        $qids=$arr['list']->qids;
        $query = $this -> db -> query("SELECT * FROM  `inventory` WHERE inventory.qid IN ( $qids ) ORDER BY FIELD(inventory.qid, $qids ) ");
        $arr['ques'] = $query->result_array();
        $this->load->view('vwViewResultStock',$arr);
    }
    
    function get_report($id){
		
	if($this->input->post('generate')){
  	$data['report']=$this->result_model->get_result($id);
   
	$this->load->library('pdf');
    $this->pdf->load_view('get_report',$data);
	$this->pdf->render();
	$filename=date('Y-M-d_H:i:s',time())."-report.pdf";
	$this->pdf->stream($filename);
	
	
  	}else{
  	redirect('reports/view_result'.$id);
  	}		

	}
    function pdfreport($id){
    if($this->input->post('generate')){
  	$data['list']=$this->result_model->get_inventory_result($id);
    $qids=$data['list']->qids;
    $query = $this -> db -> query("SELECT * FROM  `inventory` WHERE inventory.qid IN ( $qids ) ORDER BY FIELD(inventory.qid, $qids ) ");
    $data['ques'] = $query->result_array();
   
	$this->load->library('pdf');
    $this->pdf->load_view('get_report',$data);
	$this->pdf->render();
	$filename=date('Y-M-d_H:i:s',time())."-report.pdf";
	$this->pdf->stream($filename);	
        }else{
  	redirect('reports/view_result'.$id);
  	}	

	}



}