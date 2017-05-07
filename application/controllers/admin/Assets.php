<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assets extends CI_Controller {
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('question_model');
        $this->load->model('vtp_model');
        $this->load->model('user_model');
        $this->load->helper('xlsimport/php-excel-reader/excel_reader2');
        $this->load->helper('xlsimport/spreadsheetreader.php');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($data="",$limit="") {
        $arr['page'] = 'Assets';
		$arr['title'] = 'Manage Assets';
        $arr['succ'] = urldecode($data);
        $this->load->library('pagination');
        $arr['limit'] = $limit;
        $arr['link'] = 'assets/index';
        $arr['count'] = $this->question_model->get_assets_count(0);
        $arr['list'] = $this->question_model->get_assets(0,$limit);
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
        $this->load->view('admin/vwManageAssets',$arr);
    }
    public function get_ques($id,$data="",$limit="") {
        $arr['page'] = 'Assets';
        $arr['title'] = 'Manage Assets Questions';
        $arr['succ'] = str_replace('%20',' ',$data);
        $arr['subid'] = $id;  
        $arr['limit'] = $limit;
        $arr['link'] = 'assets/get_ques/'.$id;
        $arr['list'] = $this->question_model->get_assets_ques($id,$limit);
        $arr['count'] = $this->question_model->get_assets_ques_count($id);
        $this->load->view('admin/vwManageAssetsQuestion',$arr);
    }
    public function add_assets(){
        $arr['page'] = 'Assets';
		$arr['title'] = 'Add Assets';
        $arr['result'] = 'Add Assets Inspection';
        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['users'] = $this->question_model->get_users();
        $arr['center'] = $this->vtp_model->list_center(0);
        // $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('insname', 'Assets Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
               $arr['succ'] = $this->question_model->add_new_assets_inspection();
                redirect('admin/Assets/index/'.$arr['succ']);
            }
        $this->load->view('admin/vwAddAssets',$arr);
    }
    public function edit_ins($id){
        $arr['page'] = 'Inspection';
        $arr['result'] = 'Add Inspection';
		$arr['title'] = 'Edit Inspection';
        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['users'] = $this->question_model->get_users();
        $arr['center'] = $this->vtp_model->list_center(0);
        //$arr['final_centers'] = $this->vtp_model->dropdown_cents($id);
        $arr['data'] = $this->question_model->get_inspection($id);
        $this->form_validation->set_rules('insname', 'Inspection Name', 'required');
        $this->form_validation->set_rules('insaid', 'Client Name', 'required');
        $this->form_validation->set_rules('parentid', 'Client Office', 'required');
        $this->form_validation->set_rules('insuid', 'Auditor', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
               $arr['succ'] = $this->question_model->edit_inspection($id);
                redirect('admin/Assets/index/'.$arr['succ']);
            }
        $this->load->view('admin/vwEditInspection',$arr);
    }
    public function delete_ins($id){
        $this->db->where('insid', $id);
         $this->db->update('inspection', array('ins_delete' => 'Y'));
         $data = "Inspection Deleted Successfully";
         redirect('admin/Assets/index/'.$data, 'refresh');
    }

    public function add_user() {
        $arr['page'] = 'Assets';
        $this->load->view('admin/vwAddUser',$arr);
    }
    
	public function add_question($id){
        $arr['page'] = 'Question';
        $arr['result'] = 'Add Question';
		$arr['title'] = 'Add Question';
		$arr['parent'] = $id;
      //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('question', 'Question', 'required');
        

            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
				$arr['succ'] = $this->question_model->add_new_assets_ques($id);
                redirect('admin/Assets/get_ques/'.$id.'/'.$arr['succ']);
            }
        $this->load->view('admin/vwAddAssetsQuestion',$arr);
    }
    
    public function edit_ques($id) {
        $arr['page'] = 'Question';
        $arr['result'] = 'Edit Question';
		$arr['title'] = 'Edit Question';
        $arr['list'] = $this->question_model->get_assets_que($id);
		$iid = $arr['list']->insid;
		$arr['parent'] = $iid;
      //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('question', 'Question', 'required');
        

            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
				$arr['succ'] = $this->question_model->update_assets_question($id);
                redirect('admin/Assets/get_ques/'.$iid.'/'.$arr['succ']);
            }
		$this->load->view('admin/vwEditAssets',$arr);     
    }
    
    public function block_user() {
        // Code goes here
    }
    
    public function delete_ques($id) {
        $arr['list'] = $this->question_model->get_assets_que($id);
		$iid = $arr['list']->insid;
		
        $this->db->where('qid', $id);
        $this->db->update('Assets', array('deleted' => 'Y'));
        $data = "Question Deleted Successfully";
        redirect('admin/Assets/get_ques/'.$iid.'/'.$data);
    }
    
    public function import($iid){	
          if(isset($_FILES['xlsfile'])){
			$targets = 'xls/';
              $temp = explode(".", $_FILES['xlsfile']["name"]);
              $newfilename = round(microtime(true)) . '.' . end($temp);
 
			$targets = $targets . basename($newfilename);
			$docadd=($newfilename);
			if(move_uploaded_file($_FILES['xlsfile']['tmp_name'], $targets)){
				$Filepath = $targets;
       $allxlsdata = array();
	date_default_timezone_set('UTC');

	$StartMem = memory_get_usage();

	try
	{
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$BaseMem = memory_get_usage();

		$Sheets = $Spreadsheet -> Sheets();

		foreach ($Sheets as $Index => $Name)
		{
			$Time = microtime(true);

			$Spreadsheet -> ChangeSheet($Index);

			foreach ($Spreadsheet as $Key => $Row)
			{
				//echo $Key.': ';
				if ($Row)
				{
					//print_r($Row);
					$allxlsdata[] = $Row;
				}
				else
				{
					var_dump($Row);
				}
				$CurrentMem = memory_get_usage();
		
				if ($Key && ($Key % 500 == 0))
				{
					
				}
			}
		}
		
	}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}
//print_r($allxlsdata);

$arr['succ']=$this->question_model->import_assets_question($allxlsdata,$iid);   
		
				}
			
				}
				
			else{
			echo "Error: " . $_FILES["file"]["error"];
			}	
         redirect('admin/Assets/get_ques/'.$iid.'/'.$arr['succ']);
	}

}
