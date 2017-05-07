<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventoryresults extends CI_Controller {
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('result_model');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($succ='',$limit='') {
        $arr['page'] = 'inventoryresults';
        $arr['limit'] = $limit;
        $arr['count'] = $this->result_model->get_inventory_result_count();
        $arr['link'] ='inventoryresults/index';
		$arr['list'] = $this->result_model->get_inventory_results($limit);
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
        $this->load->view('admin/vwManageInventoryResults',$arr);
    }

    public function view_result($id) {
        $arr['page'] = 'inventoryresults';
        $arr['list'] = $this->result_model->get_inventory_result($id);
        //echo '<pre/>';print_r($arr['list']);
		$qids=$arr['list']->qids;
        $query = $this -> db -> query("SELECT * FROM `inventory` WHERE inventory.qid IN ( $qids ) ORDER BY FIELD(inventory.qid, $qids ) ");
        $arr['ques'] = $query->result_array();
		//echo '<pre/>';print_r($arr['ques']);exit;
        $this->load->view('admin/vwViewInventoryResult',$arr);
    }
	
    public function report_result($id){
        if($this->result_model->report_inventory_result($id) == TRUE){
           redirect('admin/inventoryresults'); 
        } else{
        }
        
    }

     public function edit_ques($id) {
        $arr['page'] = 'Inventory';
       // $this->load->view('admin/vwEditUser',$arr);
         redirect('admin/inventory');
    }
    
     public function block_user() {
        // Code goes here
    }
    
     public function delete_result($id) {
         $this->db->where('id', $id);
         $this->db->update('inventory', array('deleted' => 'Y'));
         $data = "Inventory Deleted Successfully";
         redirect('admin/inventory/index/'.$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */