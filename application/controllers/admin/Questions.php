<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Questions extends CI_Controller {
	
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
        $arr['page'] = 'Inspection';
        $arr['succ'] = urldecode($data);
        $this->load->library('pagination');
        //$this->pagination->initialize(20);
        
       //  echo $this->pagination->create_links();
        $arr['limit'] = $limit;
        $arr['link'] = 'questions/index';
        $arr['count'] = $this->question_model->get_insps_count();
        $arr['list'] = $this->question_model->get_insps(0,$limit);
		$arr['title'] = 'Manage Inspection & Audits';
		
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
		
        $this->load->view('admin/vwManageInspection',$arr);
    }
    
	public function get_ques($id,$data="") {
        $arr['page'] = 'Questions';
        $arr['succ'] = str_replace('%20',' ',$data);
        $arr['subid'] = $id;
        $arr['title'] = 'Manage Questions'; 
        $arr['list'] = $this->question_model->get_ques($id);
        $this->load->view('admin/vwManageQuestion',$arr);
    }
	
    public function add_ins(){
        $arr['page'] = 'Inspection';
        $arr['result'] = 'Add Inspection';
        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['users'] = $this->question_model->get_users();
        $arr['center'] = $this->vtp_model->list_center(0);
      //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('insname', 'Inspection Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $arr['title'] = 'Add Inspection';

            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
				//echo '<pre/>';print_r($_POST);exit;
                $arr['succ'] = $this->question_model->add_new_inspection();
                redirect('admin/questions/index/'.$arr['succ']);
            }
        $this->load->view('admin/vwAddInspection',$arr);
    }
   
    public function get_hierarchy(){
		$c_id = $_POST['client_id'];
		$this->db->select('centid,aid,center_name');
		$this->db->where('aid',$c_id);		
		$query = $this->db->get('center');
        $users = $query->result_array();
		
		$opt = "<option value=''>TOP LEVEL</option>";
        if (!empty($users)) {
            foreach ($users as $subcategory) {
                $selected = "";
                $opt.= '<option ' . $selected . ' value="' . $subcategory['centid'] . '" >' . $subcategory['center_name'] . '</option>';
            }
        }
        echo $opt;
		
	}
   
    public function edit_ins($id){
        $arr['page'] = 'Inspection';
        $arr['result'] = 'Add Inspection';
        
        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['users'] = $this->question_model->get_users();
        $arr['center'] = $this->vtp_model->list_center(0);
		$arr['title'] = 'Edit Inspection & Audit';
        //$arr['final_centers'] = $this->vtp_model->dropdown_cents($id);
        $arr['data'] = $this->question_model->get_inspection($id);
		//echo '<pre/>';print_r($_POST);exit;
        
        $this->form_validation->set_rules('insaid', 'Client Name', 'required');
        $this->form_validation->set_rules('parentid', 'Client Office', 'required');
        $this->form_validation->set_rules('insuid', 'Auditor', 'required');
		$this->form_validation->set_rules('insname', 'Inspection Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        
            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
				$arr['succ'] = $this->question_model->edit_inspection($id);
                redirect('admin/questions/index/'.$arr['succ']);
            }
        $this->load->view('admin/vwEditInspection',$arr);
    }
    
	public function delete_ins($id){
        $this->db->where('insid', $id);
         $this->db->update('inspection', array('ins_delete' => 'Y'));
         $data = "Inspection Deleted Successfully";
         redirect('admin/questions/index/'.$data, 'refresh');
    }

    public function add_user() {
        $arr['page'] = 'Questions';
        $this->load->view('admin/vwAddUser',$arr);
    }
    
    public function add_question($id){
        $arr['page'] = 'Question';
        $arr['result'] = 'Add Question';
		$arr['parent'] = $id;
		$arr['title'] = 'Add Questions';
		//$this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('question', 'Question', 'required');
        

            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
               $arr['succ'] = $this->question_model->add_new_ques($id);
                redirect('admin/questions/get_ques/'.$id.'/'.$arr['succ']);
            }
        $this->load->view('admin/vwAddQuestion',$arr);
    }
    
    public function edit_ques($id) {
        $arr['page'] = 'Question';
        $arr['result'] = 'Edit Question';
        
        $arr['list'] = $this->question_model->get_que($id);
		$iid = $arr['list']->insid;
		$arr['parent'] = $iid;
		$arr['title'] = 'Edit Question';
      //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('question', 'Question', 'required');
        

            if ($this->form_validation->run() == FALSE) {
                $arr['error']= validation_errors();
            } else {
               $arr['succ'] = $this->question_model->update_ques($id);
               redirect('admin/questions/get_ques/'.$iid.'/'.$arr['succ']);
            }
         
       $this->load->view('admin/vwEditQuestion',$arr);
         // redirect('admin/questions');
    }
    
    public function block_user() {
        // Code goes here
    }
    
    public function delete_ques($id) {
        
         $this->db->where('qid', $id);
         $this->db->update('questions', array('deleted' => 'Y'));
         $data = "Question Deleted Successfully";
         redirect('admin/questions/index/'.$data);
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
				//echo '<pre/>';print_r($allxlsdata);exit;

				$arr['succ']=$this->question_model->import_question($allxlsdata,$iid);   
		
				}
			
			}	
			else{
				echo "Error: " . $_FILES["file"]["error"];
			}	
		redirect('admin/questions/get_ques/'.$iid.'/'.$arr['succ']);
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */