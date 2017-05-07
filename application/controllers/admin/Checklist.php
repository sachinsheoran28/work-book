<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checklist extends CI_Controller {

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

    public function index($data = "", $limit = "") {
        $arr['page'] = 'Checklist';
        $arr['succ'] = urldecode($data);
        $arr['title'] = 'Manage Checklist';
        $arr['limit'] = $limit;
        $arr['link'] = 'checklist/index';
        $arr['count'] = $this->question_model->get_checklist_count();
        $arr['list']= $this->question_model->get_checklist(0, $limit);
		//echo '<pre/>';print_r($arr['list']);exit;
        $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
        $this->load->view('admin/vwManageChecklist', $arr);
    }
    public function index1($data = "", $limit = "") {
        $arr['page'] = 'Checklist';
        $arr['succ'] = urldecode($data);
        $arr['title'] = 'Manage Checklist';
        $arr['limit'] = $limit;
        $arr['count'] = $this->question_model->get_checklist_count();
        $list = $this->question_model->get_checklist(0, $limit);
        $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
        
                      foreach($list as $ass) {
                      if($ass["ins_delete"] == 'N'){
                        echo '<tr>';
                         echo '<td>'.$limit++.'</td>';
                        echo '<td>'.$ass["insname"].'</td>';
                       
                        echo '<td>'.date('m/d/Y h:i A', $ass["date"]).'</td>';
                        echo '<td>'.date('m/d/Y h:i A', $ass["enddate"]).'</td>';
                        echo '<td>'.$ass["firstname"].'</td>';
                        echo '<td>'.$ass["center_name"].'</td>';
                        echo '<td>'.$ass["first_name"].' '.$ass["last_name"].'</td>';
                        echo '<td><a href="'. base_url().'admin/checklist/edit_ins/'.$ass["insid"].'" class="btn btn-xs btn-success">edit</a>   <a href="'. base_url().'admin/checklist/get_ques/'.$ass["insid"].'" class="btn btn-xs btn-warning">add Checklist Question</a>  <a href="'. base_url().'admin/checklist/delete_ins/'.$ass["insid"].'" class="btn btn-xs btn-danger">delete</a></td>';
                        echo '</tr>';
                      }
                      }
    }

    public function get_ques($id, $data = "",$limit="") {
        $arr['page'] = 'Checklist';
        $arr['succ'] = str_replace('%20', ' ', $data);
        $arr['subid'] = $id;
        $arr['limit'] = $limit;
        $arr['link'] = 'checklist/get_ques/'.$id;
        $arr['title'] = 'Manage Checklist Questions';
        $arr['list'] = $this->question_model->get_checklist_ques($id,$limit);
        $arr['count'] = $this->question_model->get_checklist_ques_count($id);
        $this->load->view('admin/vwManageChecklistQuestion', $arr);
    }

    public function add_checklist() {
        $arr['page'] = 'Checklist';
        $arr['result'] = 'Add Checklist';

        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['users'] = $this->question_model->get_users();
        $arr['center'] = $this->vtp_model->list_center(0);
        //  $this->load->view('admin/vwAddUser',$arr);
        $arr['title'] = 'Add Checklist';
        $this->form_validation->set_rules('insname', 'Checklist Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');


        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->question_model->add_new_checklist_inspection();
            redirect('admin/Checklist/index/' . $arr['succ']);
        }
        $this->load->view('admin/vwAddChecklist', $arr);
    }

    public function edit_ins($id) {
        $arr['page'] = 'Inspection';
        $arr['result'] = 'Add Inspection';
        $arr['title'] = 'Edit Checklist';
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
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->question_model->edit_inspection($id);
            redirect('admin/Checklist/index/' . $arr['succ']);
        }
        $this->load->view('admin/vwEditInspection', $arr);
    }

    public function delete_ins($id) {
        $this->db->where('insid', $id);
        $this->db->update('inspection', array('ins_delete' => 'Y'));
        $data = "Inspection Deleted Successfully";
        redirect('admin/Checklist/index/' . $data, 'refresh');
    }

    public function add_user() {
        $arr['page'] = 'Checklist';
        $this->load->view('admin/vwAddUser', $arr);
    }

    public function add_question($id) {
        $arr['page'] = 'Question';
        $arr['result'] = 'Add Question';
        $arr['parent'] = $id;
        //  $this->load->view('admin/vwAddUser',$arr);
        $arr['title'] = 'Add Checklist Question';
        $this->form_validation->set_rules('question', 'Question', 'required');


        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->question_model->add_new_checklist_ques($id);
            redirect('admin/Checklist/get_ques/' . $id . '/' . $arr['succ']);
        }
        $this->load->view('admin/vwAddChecklistQuestion', $arr);
    }

    public function edit_ques($id) {
        $arr['page'] = 'Question';
        $arr['result'] = 'Edit Question';
        $arr['list'] = $this->question_model->get_checklist_que($id);
        $iid = $arr['list']->insid;
        $arr['parent'] = $iid;
        $arr['title'] = 'Edit Checklist Question';
        //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('question', 'Question', 'required');


        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->question_model->update_checklist_ques($id);
            redirect('admin/Checklist/get_ques/' . $iid . '/' . $arr['succ']);
        }

        $this->load->view('admin/vwEditChecklist', $arr);
        // redirect('admin/Checklist');
    }

    public function block_user() {
        // Code goes here
    }

    public function delete_ques($id) {
        $arr['list'] = $this->question_model->get_checklist_que($id);
        $iid = $arr['list']->insid;

        $this->db->where('qid', $id);
        $this->db->update('Checklist', array('deleted' => 'Y'));
        $data = "Checklist Question Deleted Successfully";
        redirect('admin/Checklist/get_ques/' . $iid . '/' . $data);
    }

    public function import($iid) {
        if (isset($_FILES['xlsfile'])) {
            $targets = 'xls/';
            $temp = explode(".", $_FILES['xlsfile']["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);

            $targets = $targets . basename($newfilename);
            $docadd = ($newfilename);
            if (move_uploaded_file($_FILES['xlsfile']['tmp_name'], $targets)) {
                $Filepath = $targets;
                $allxlsdata = array();
                date_default_timezone_set('UTC');
                $StartMem = memory_get_usage();
                try {
                    $Spreadsheet = new SpreadsheetReader($Filepath);
                    $BaseMem = memory_get_usage();

                    $Sheets = $Spreadsheet->Sheets();

                    foreach ($Sheets as $Index => $Name) {
                        $Time = microtime(true);

                        $Spreadsheet->ChangeSheet($Index);

                        foreach ($Spreadsheet as $Key => $Row) {
                            //echo $Key.': ';
                            if ($Row) {
                                //print_r($Row);
                                $allxlsdata[] = $Row;
                            } else {
                                var_dump($Row);
                            }
                            $CurrentMem = memory_get_usage();

                            if ($Key && ($Key % 500 == 0)) {
                                
                            }
                        }
                    }
                } catch (Exception $E) {
                    echo $E->getMessage();
                }
//print_r($allxlsdata);

                $arr['succ'] = $this->question_model->import_checklist_question($allxlsdata, $iid);
            }
        } else {
            echo "Error: " . $_FILES["file"]["error"];
        }
        redirect('admin/Checklist/get_ques/' . $iid . '/' . $arr['succ']);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */