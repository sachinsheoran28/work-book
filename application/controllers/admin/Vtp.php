<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vtp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('vtp_model');
        $this->load->model('user_model');
        $this->load->library('email');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($data = "", $limit = "") {
        $arr['page'] = 'clients';
        $arr['limit'] = $limit;
        $arr['succ'] = urldecode($data);
        $arr['list'] = $this->vtp_model->get_vtp($limit);
        $arr['link'] = 'vtp/index';
        $arr['count'] = $this->vtp_model->get_vtp_count($limit);
        $arr['title'] = "Manage Client";
        $this->load->view('admin/vwManageVtp', $arr);
    }

    public function add_vtp() {
        $arr['page'] = 'clients';
        $arr['result'] = 'Add Client';
        //  $this->load->view('admin/vwAddUser',$arr);
        $this->form_validation->set_rules('firstname', 'Client Name', 'trim|required');
        $this->form_validation->set_rules('vchaddress', 'Address', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('contryid', 'Country', 'trim|required');
        $this->form_validation->set_rules('vtp_rep', 'Representative One', 'trim|required');
        $this->form_validation->set_rules('designations', 'Designations', 'trim|required');
        //$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique_again[assessors.email.0]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        //$this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in ' . SITE_TITLE);
        $this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric');

        if (isset($_POST['vtp_rep'])) {
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
        }

        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->vtp_model->add_new_vtp();
            redirect('admin/vtp/index/' . $arr['succ']);
        }
        $arr['title'] = "Add Client";
        $this->load->view('admin/vwAddVtp', $arr);
    }

    public function edit_vtp($id) {
        $arr['page'] = 'Client';

        $arr['data'] = $this->vtp_model->edit_vtp($id);

        $arr['title'] = "Update Client";

        $this->form_validation->set_rules('firstname', 'Client Name', 'trim|required');
        $this->form_validation->set_rules('vchaddress', 'Address', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('contryid', 'Country', 'trim|required');
        $this->form_validation->set_rules('vtp_rep', 'Representative One', 'trim|required');
        $this->form_validation->set_rules('designations', 'Designations', 'trim|required');
        //$this->form_validation->set_rules('email', 'Email', "trim|valid_email|required|is_unique_again1[assessors.email.$id]");
        $this->form_validation->set_rules('email', 'Email', "trim|valid_email|required");
        //$this->form_validation->set_message('is_unique_again1', 'The e-mail address is already registered in ' . SITE_TITLE);
        $this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric');

        if (isset($_POST['vtp_rep'])) {
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
        }

        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
            $this->load->view('admin/vwEditVtp', $arr);
        } else {
            $arr['succ'] = $this->vtp_model->update_vtp($id);
            redirect('admin/vtp/index/' . $arr['succ']);
        }
    }

    public function get_office($id, $oid) {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->vtp_model->dropdown_cents($id, $oid)));
    }

    public function block_vtp() {
        // Code goes here
    }

    public function delete_vtp($id) {
        $data = array(
            'deleted' => 'Y'
        );
        $cond = 'assessors.aid="' . addslashes($id) . '"';
        $this->db->update("assessors", $data, $cond);
        $data = "Client Deleted Successfully";
        redirect('admin/vtp/index/' . $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */