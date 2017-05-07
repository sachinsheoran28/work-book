<?php
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Center extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('vtp_model');
        $this->load->model('user_model');
        $this->load->model('question_model');
        $this->load->helper('xlsimport/php-excel-reader/excel_reader2');
        $this->load->helper('xlsimport/spreadsheetreader.php');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($data = '', $limit = '') {
        
        $arr['page'] = 'center';
        $arr['id'] = '0';
        $arr['aid'] = '0';
        $arr['limit'] = $limit;
        $arr['succ'] = str_replace('%20', ' ', $data);
        $arr['list'] = $this->vtp_model->get_center($limit, 0);
        $arr['count'] = $this->vtp_model->get_center_count(0);
        $arr['link'] = 'center/index';
        $arr['title'] = "Manage Clients Office";
        $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
        $this->load->view('admin/vwManageCenter', $arr);
    }

    public function sub_center($id, $aid, $data = '', $limit = '') {
        
        $arr['aid'] = $aid;
        $arr['page'] = 'center';
        $arr['id'] = $id;
        $arr['succ'] = str_replace('%20', ' ', $data);
        $arr['list'] = $this->vtp_model->get_center($limit, $id);
        //$arr['aid'] = $this->vtp_model->get_aid($id);
        //echo '<pre/>';print_r($arr['aid']);exit;
        $arr['count'] = $this->vtp_model->get_center_count($id);
        $arr['limit'] = $limit;
        $user = $this->vtp_model->get_cent($id);
        $arr['user'] = $user;
        $arr['link'] = 'center/sub_center/' . $id;
        $arr['title'] = "Manage Sub Offices";
        $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
        $this->load->view('admin/vwManageCenter', $arr);
    }

    public function add_center($id = '', $aid = '') {
        $arr['page'] = 'center';
        $arr['result'] = 'Add a new center';
        $arr['id'] = $id;
        $arr['aid'] = $aid;

        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['center'] = $this->vtp_model->list_center(0);
        $this->form_validation->set_rules('aid', 'Client', 'required');
        $this->form_validation->set_rules('center_name', 'Name of center', 'required');


        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            $arr['succ'] = $this->vtp_model->add_new_center();
        }
        $arr['title'] = 'Add a new center';
        $this->load->view('admin/vwAddCenter', $arr);
    }

    public function get_hierarchy() {
        $c_id = $_POST['client_id'];
        $this->db->select('centid,aid,center_name');
        $this->db->where('aid', $c_id);
        $query = $this->db->get('center');
        $users = $query->result_array();

        $opt = "<option value=''>TOP LEVEL</option>";
        if (!empty($users)) {
            foreach ($users as $subcategory) {
                $selected = "";
                $opt .= '<option ' . $selected . ' value="' . $subcategory['centid'] . '" >' . $subcategory['center_name'] . '</option>';
            }
        }
        echo $opt;
    }

    public function edit_center($id) {
        $arr['page'] = 'center';

        $arr['vtps'] = $this->question_model->get_vtp();
        $arr['center'] = $this->vtp_model->list_center($id);
        $arr['data'] = $this->vtp_model->get_cent($id);
        $user = $this->vtp_model->get_cent($id);
        $arr['user'] = $user;
        $arr['result'] = 'Edit ' . $user->center_name;
        $this->form_validation->set_rules('centid', 'Client Id', 'required');
        $this->form_validation->set_rules('center_name', 'Name of center does not match', 'required');

        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->vtp_model->update_cent($id);
            if ($user->parentid > 0) {
                redirect('admin/center/sub_center/' . $user->parentid . '/' . $user->aid . '/' . $arr['succ']);
            } else {
                redirect('admin/center/index/' . $arr['succ']);
            }
        }
        $arr['title'] = "Update Office";
        $this->load->view('admin/vwEditCenter', $arr);
    }

    public function block_center() {
        // Code goes here
    }

    public function delete_center($id) {
        $this->db->where('centid', $id);
        $this->db->update('center', array('deleted_cn' => 'Y'));
        $data = "Center Deleted Successfully";

        $user = $this->vtp_model->get_cent($id);
//		echo '<pre/>';print_r($user);exit;
        if ($user->parentid > 0) {
            redirect('admin/center/sub_center/' . $user->parentid . '/' . $user->aid . '/' . $data);
        } else {
            redirect('admin/center/index/' . $data, 'refresh');
        }
    }

    public function import($iid, $aid) {
		
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
				//echo '<pre/>';print_r($allxlsdata);exit;
                $arr['succ'] = $this->vtp_model->import_subcenter($allxlsdata, $iid, $aid);
            }
        } else {
            echo "Error: " . $_FILES["file"]["error"];
        }
		redirect('admin/center/sub_center/' . $iid . '/'. $aid.'/'. $arr['succ']);
    }

}

