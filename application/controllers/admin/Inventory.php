<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventory extends CI_Controller {

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

    public function index($data = "", $limit = "") {
        $arr['page'] = 'Inventory';
        $arr['succ'] = urldecode($data);
        $arr['title'] = 'Manage Inventory';
        $this->load->library('pagination');
        $arr['limit'] = $limit;
        $arr['link'] = 'inventory/index';
        $arr['list'] = $this->question_model->get_inventory(0, $limit);
        $arr['count'] = $this->question_model->get_inventory_count(0);
        $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
        $this->load->view('admin/vwManageInventory', $arr);
    }

    public function get_ques($id, $data = "", $limit = "") {
        $arr['page'] = 'Inventory';
        $arr['title'] = 'Manage Inventory Questions';
        $arr['succ'] = str_replace('%20', ' ', $data);
        $arr['subid'] = $id;
        $arr['limit'] = $limit;
        $arr['link'] = 'inventory/get_ques/' . $id;
        $arr['list'] = $this->question_model->get_inventory_ques($id, $limit);
        $arr['count'] = $this->question_model->get_inventory_ques_count($id);
        $this->load->view('admin/vwManageInventoryQuestion', $arr);
    }

    public function add_inventory() {
        $arr['page'] = 'Inventory';
        $arr['title'] = 'Add Inventory';
        $arr['result'] = 'Add Inventory Inspection';
        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['users'] = $this->question_model->get_users();
        $arr['center'] = $this->vtp_model->list_center(0);
        // $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('insname', 'Inventory Name', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->question_model->add_new_inventory_inspection();
            redirect('admin/Inventory/index/' . $arr['succ']);
        }
        $this->load->view('admin/vwAddInventory', $arr);
    }

    public function edit_ins($id) {
        $arr['page'] = 'Inspection';
        $arr['result'] = 'Add Inspection';
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
            redirect('admin/Inventory/index/' . $arr['succ']);
        }
        $this->load->view('admin/vwEditInspection', $arr);
    }

    public function delete_ins($id) {
        $this->db->where('insid', $id);
        $this->db->update('inspection', array('ins_delete' => 'Y'));
        $data = "Inspection Deleted Successfully";
        redirect('admin/Inventory/index/' . $data, 'refresh');
    }

    public function add_user() {
        $arr['page'] = 'Inventory';
        $this->load->view('admin/vwAddUser', $arr);
    }

    public function add_question($id) {
        $arr['page'] = 'Question';
        $arr['result'] = 'Add Question';
        $arr['parent'] = $id;
        $arr['title'] = 'Add Question';
        //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('question', 'Question', 'required');


        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->question_model->add_new_inventory_ques($id);
            redirect('admin/Inventory/get_ques/' . $id . '/' . $arr['succ']);
        }
        $this->load->view('admin/vwAddInventoryQuestion', $arr);
    }

    public function edit_ques($id) {
        $arr['page'] = 'Question';
        $arr['result'] = 'Edit Question';
        $arr['title'] = 'Edit Question';
        $arr['list'] = $this->question_model->get_inventory_que($id);
        $iid = $arr['list']->insid;
        $arr['parent'] = $iid;
        //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('question', 'Question', 'required');


        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->question_model->update_inventory_ques($id);

            redirect('admin/Inventory/get_ques/' . $iid . '/' . $arr['succ']);
        }

        $this->load->view('admin/vwEditInventory', $arr);
        // redirect('admin/Assets');
    }

    public function block_user() {
        // Code goes here
    }

    public function delete_ques($id) {

        $arr['list'] = $this->question_model->get_inventory_que($id);
        $iid = $arr['list']->insid;

        $this->db->where('qid', $id);
        $this->db->update('inventory', array('deleted' => 'Y'));
        $data = "Question Deleted Successfully";
        redirect('admin/Inventory/get_ques/' . $iid . '/' . $data);
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

                $arr['succ'] = $this->question_model->import_inventory_question($allxlsdata, $iid);
                redirect('admin/Inventory/get_ques/' . $iid . '/' . $arr['succ']);
            }
        } else {
            echo "Error: " . $_FILES["file"]["error"];
        }
        redirect('admin/Inventory/get_ques/' . $iid . '/' . $arr['succ']);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */