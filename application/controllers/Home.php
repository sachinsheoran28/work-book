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
		$this->load->library('email');
		$this->load->helper('xlsimport/php-excel-reader/excel_reader2');
        $this->load->helper('xlsimport/spreadsheetreader.php');
    }
    
    public function index() {
        $arr['page'] ='home';
        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0'){
            redirect('home/loggedin');
        }
        
        $arr['list'] = $this->question_model->get_insp(0);
        $this->load->view('vwInspection',$arr);
		redirect('home/inspection_res');
        } else {
        redirect('home/do_login');
        }
    }

	public function variance() {
        $arr['page'] ='variance';
        
        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0'){
				redirect('home/loggedin');
			}
        
        $arr['list'] = $this->question_model->get_varencetable();
		//echo '<pre/>';print_r($arr['list']);exit;
        $this->load->view('vwVariance',$arr);
        } else {
            if ($this->session->userdata('is_admin_login')) {
              $this->session->unset_userdata('is_admin_login'); 
            }
        redirect('home/do_login');
        }
    }
    
	public function start_variance($insid) {
        $arr['page'] ='variance';
        
        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0'){
				redirect('home/loggedin');
			}        
			$arr['list'] = $this->question_model->get_varence($insid);
			//echo '<pre/>';print_r($arr['list']);exit;  
			$arr['insid'] = $insid;
			$arr['dropdown'] = $this->question_model->get_varencedropdown($insid);
			
			$this->load->view('vwVariancePut',$arr);
        } else {
            if ($this->session->userdata('is_admin_login')) {
              $this->session->unset_userdata('is_admin_login'); 
            }
			redirect('home/do_login');
        }
    }
    
	public function submit_var($insid,$cenid,$uid,$type){
		$table = '<table style="border-collapse: collapse;width: 100%;"><tr><th style="text-align: left;padding: 8px;background-color: #2a6496;color: white;">Raw Matl</th><th style="text-align: left;padding: 8px;background-color: #2a6496;color: white;">QTY</th><th style="text-align: left;padding: 8px;background-color: #2a6496;color: white;">Value</th><th style="text-align: left;padding: 8px;background-color: #2a6496;color: white;">% Usg Val</th></tr>';
        foreach($_POST['variants'] as $user)
        {
            if($user["raw_malt"] != '')
			{
				$this->db->select('question');
				$this->db->where('qid', $user["raw_malt"]);
				$val = $this->db->get('inventory');
				$result = $val->row();
				
				$data = array(
					'raw_malt' => $user["raw_malt"],
					'raw_name' => $result->question,
					'quantity' => $user["quantity"] !='' ? $user["quantity"] : '0.00',
					'value' => $user["value"] !='' ? $user["value"] : '0',
					'per_usg_val' => $user["per_usg_val"] !='' ? $user["per_usg_val"] : '0.00',
					'type' => $type,
					'ins_id' => $insid,
					'cen_id' => $cenid,
					'u_id' => $uid,
				);
				//echo '<pre/>';print_r($data);
				$this->db->insert('variance',$data);	
				
				$qtyy = $user["quantity"] !='' ? $user["quantity"] : '0.00';
				$vall = $user["value"] !='' ? $user["value"] : '0';
				$peruv = $user["per_usg_val"] !='' ? $user["per_usg_val"] : '0.00';
				$table .= '<tr><td style="text-align: left;padding: 8px;">'.$result->question.'</td><td style="text-align: left;padding: 8px;">'.$qtyy.'</td><td style="text-align: left;padding: 8px;">'.$vall.'</td><td style="text-align: left;padding: 8px;">'.$peruv.'</td></tr>';
            }             
        }//exit;
		$table .='</table>';
		
		$this->email->from('info@glocalthinkers.com', 'Glocal Thinkers');
		$this->email->to('admin@glocalthinkers.com');
		$this->email->bcc('sachinsheoran28@gmail.com,sachin.kumar@glocalthinkers.com,pankaj.rana@glocalthinkers.com'); 
		$sub = 'Variance Update';
		if($type == 'FVL')
		{
			$sub = 'Top 10 Food Variance Loss.';
		}
		if($type == 'FVC')
		{
			$sub = 'Top 5 Food Variance Gain';
		}				
		if($type == 'FYL')
		{
			$sub = 'Top 5 Food Yield Loss';
		}
		if($type == 'FYG')
		{
			$sub = 'Top 5 Food Yield Gain';
		}
		if($type == 'PVL')
		{
			$sub = 'Top 5 Paper Variance Loss';
		}
		if($type == 'PVG')
		{
			$sub = 'Top 5 Paper Variance Gain';
		}
		if($type == 'FC')
		{
			$sub = 'Food Condiments';
		}
		if($type == 'PC')
		{
			$sub = 'Paper Condiments';
		}
		$this->email->subject($sub);
		$this->email->message($table);  
		$this->email->set_mailtype("html");

		if($this->email->send()){
			echo 'success';exit;
		}
		else{
			echo 'mail not send';exit;
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
                            'status' => $res['status'],  
                            'type' => $res['type'],  
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
        $this->session->unset_userdata('type');
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('is_client_login');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }

    public function loggedin(){
       // redirect('home');
        $arr['page'] = 'loggedin';
        if ($this->session->userdata('is_client_login')) {
        if ($this->session->userdata('status') == '0'){
            redirect('home');
        } else {
            if ($this->session->userdata('type') == 'C'){
				$arr['list'] = $this-> vtp_model->get_vtps($this->session->userdata('status'));
				$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
				$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
                $this->load->view('vwHome',$arr);
            } else if ($this->session->userdata('type') == 'O'){
                $arr['list'] = $this->vtp_model->get_cent($this->session->userdata('status'));
				$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
				$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
                $this->load->view('vwCenter',$arr);
            } else {
                redirect('home');
            }
        }
        }
    }
    
	public function saved_videos($succ='',$limit=''){
        $arr['page'] = 'saved videos';
        $arr['limit'] = $limit;
        $arr['coinspection_resunt'] = $this->vtp_model->get_svids_count($this->session->userdata('status'));
        $arr['link'] ='home/saved_videos';
        $arr['list'] = $this->vtp_model->get_svids($limit,$this->session->userdata('status'));
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
        $this->load->view('vwVideo',$arr);
    }
    
	public function view_address($cid, $id=''){
            
        if (!$this->session->userdata('is_client_login')){
            redirect('home/do_login');
        }
        $arr['page'] = 'loggedin';
        $arr['insid'] =$id;
        $arr['center'] = $this->vtp_model->get_cent($cid);
        $this->load->view('vwCenterAddress',$arr);
    }
    
    public function center($aid){
        $arr['page'] = 'loggedin';
        if (!$this->session->userdata('is_client_login')){
            redirect('home/do_login');
        }
       $arr['aid'] = $aid;
       $arr['list'] = $this->vtp_model->get_cents($aid);
       $this->load->view('vwCenter',$arr);
    }
	
	public function subcenter($aid){
            $arr['page'] = 'loggedin';
        if (!$this->session->userdata('is_client_login')){
            redirect('home/do_login');
        }
       $arr['aid'] = $aid;
       $arr['list'] = $this->vtp_model->get_subcents($aid);
       $this->load->view('vwSubCenter',$arr);
    }
	
    public function inspection($cid){
         if (!$this->session->userdata('is_client_login')){
            redirect('home/do_login');
        }
       $arr['list'] = $this->question_model->get_insp($cid);
        $this->load->view('vwInspection',$arr);
    }
    
    public function start_quiz($id){
        if (!$this->session->userdata('is_client_login')){
            redirect('home/do_login');
        }
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
        if (!$this->session->userdata('is_client_login')){
            redirect('home/do_login');
        }
        $arr['succ']= "Thank you. Result saved.";
        $arr['list'] = $this->question_model->get_insp(0);
        $this->load->view('vwInspection',$arr);
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
    
    public function findme($lat, $long){
        
        $arr['page'] ='Find Me';
        $arr['lat'] =$lat;
        $arr['long'] = $long;
        $this->load->view('vwFound',$arr);
    }

	public function import($insid,$inscid,$insuid,$type){	
		
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
								$count = count($Row);
								//echo '<pre/>';print_r($Row);exit;
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
				
				$arr['succ']=$this->question_model->import_flv_variance($allxlsdata,$insid,$inscid,$insuid,$count,$type,$newfilename);
				
			}	
		}		
		else{
			echo "Error: " . $_FILES["file"]["error"];exit;
		}	
        redirect('admin/Checklist/get_ques/'.$iid.'/'.$arr['succ']);
	}
	
	public function inventory($data="",$limit="") {
		$uid = $this->session->userdata('id');
        $arr['page'] = 'inventory';
        $arr['succ'] = urldecode($data);
		$arr['title'] = 'Manage Inventory';
        $this->load->library('pagination');
        //$this->pagination->initialize(20);
        
       //  echo $this->pagination->create_links();
        $arr['limit'] = $limit;
        $arr['link'] = 'inventory/index';
        //$arr['count'] = $this->question_model->get_inventory_count_audit();
        $arr['list'] = $this->question_model->get_inventory_audit($uid,$limit);
		//echo '<pre/>';print_r($arr['list']);exit;
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
        $this->load->view('vwManageInventory',$arr);
    }

	public function get_ques($id,$data="") {
        $arr['page'] = 'inventory';
		$arr['title'] = 'Manage Inventory Questions';
        $arr['succ'] = str_replace('%20',' ',$data);
        $arr['subid'] = $id;  
        $arr['list'] = $this->question_model->get_inventory_ques_audit($id);
        $this->load->view('vwManageInventoryQuestion',$arr);
    }
	
	public function assets($data="",$limit="") {
        $uid = $this->session->userdata('id');
		$arr['page'] = 'assets';
		$arr['title'] = 'Manage Assets';
        $arr['succ'] = urldecode($data);
        $this->load->library('pagination');
        //$this->pagination->initialize(20);
        
       //  echo $this->pagination->create_links();
        $arr['limit'] = $limit;
        $arr['link'] = 'assets/index';
        //$arr['count'] = $this->question_model->get_assets_count();
        $arr['list'] = $this->question_model->get_assets_audit($uid,$limit);
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
        $this->load->view('vwManageAssets',$arr);
    }
	
	public function get_assets_ques($id,$data="") {
        $arr['page'] = 'assets';
		$arr['title'] = 'Manage Assets Questions';
        $arr['succ'] = str_replace('%20',' ',$data);
        $arr['subid'] = $id;  
        $arr['list'] = $this->question_model->get_assets_ques_audit($id);
        $this->load->view('vwManageAssetsQuestion',$arr);
    }
	
	public function inspection_res($data="",$limit="") {
        $uid = $this->session->userdata('id');
		$arr['page'] = 'inspection_res';
		$arr['title'] = 'Manage Inspection';
        $arr['succ'] = urldecode($data);
        $this->load->library('pagination');
        //$this->pagination->initialize(20);
        
       //  echo $this->pagination->create_links();
        $arr['limit'] = $limit;
        $arr['link'] = 'assets/index';
        //$arr['count'] = $this->question_model->get_assets_count();
        $arr['list'] = $this->question_model->get_inspection_audit($uid,$limit);
		$arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type']:'';
		$arr['search'] = isset($_POST['search']) ? $_POST['search']:'';
        $this->load->view('vwManageInspection',$arr);
    }

	public function get_inspection_ques($id,$data="") {
        $arr['page'] = 'inspection_res';
       
		$arr['title'] = 'Manage Inspection Questions';
        $arr['succ'] = str_replace('%20',' ',$data);
        $arr['subid'] = $id;  
        $arr['list'] = $this->question_model->get_inspection_ques_audit($id);
		//echo '<pre/>';print_r($arr['list']);exit;
        $this->load->view('vwManageInspectionQuestion',$arr);
    }

}