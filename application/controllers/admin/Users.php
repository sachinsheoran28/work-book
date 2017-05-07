<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('email');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($data = "", $limit = "0") {
        $arr['page'] = 'user';
        $arr['succ'] = urldecode($data);
        $arr['list'] = $this->user_model->get_users($limit);
        $arr['link'] = 'users/index';
        $arr['count'] = $this->user_model->get_users_count();
        $arr['limit'] = $limit;
        $arr['title'] = "Manage Auditor";
        $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
        $this->load->view('admin/vwManageUser', $arr);
    }

    public function add_user() {
        $arr['page'] = 'user';
        $arr['result'] = 'Add User';
        $this->form_validation->set_rules('user_name', 'Username', 'required|trim|is_unique[users.user_name]');
        $this->form_validation->set_message('is_unique', 'The username is already registered in ' . SITE_TITLE);
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique_again[users.email.0]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        //$this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in ' . SITE_TITLE);
        $this->form_validation->set_rules('industry', 'Industry', 'trim|required');
        $this->form_validation->set_rules('phone_mobile', 'Mobile Number', 'trim|required|numeric|max_length[16]');
        $this->form_validation->set_rules('address_street', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->user_model->add_new_user();
            redirect('admin/users/index/' . $arr['succ']);
        }
        $arr['title'] = "Add Auditor";
        $this->load->view('admin/vwAddUser', $arr);
    }

    public function edit_user($id) {
        $arr['page'] = 'user';

        $arr['data'] = $this->user_model->edit_user($id);
        $user = $this->user_model->edit_user($id);
        $arr['result'] = 'Edit detail for ' . $user->first_name . ' ' . $user->last_name;
        if ($this->input->post('user_name') != $user->user_name) {
            $is_unique = '|is_unique[users.user_name]';
        } else {
            $is_unique = '';
        }
        $this->form_validation->set_rules('user_name', 'Username', 'required|trim' . $is_unique);
        if ($this->input->post('password') != '') {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[password]');
        }
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        //$this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        //$this->form_validation->set_rules('email', 'Email', "trim|valid_email|required|is_unique_again[users.email.$id]");
        //$this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in ' . SITE_TITLE);	
        $this->form_validation->set_rules('industry', 'Industry', 'trim|required');
        $this->form_validation->set_rules('phone_mobile', 'Mobile Number', 'trim|required|numeric|max_length[16]');
        $this->form_validation->set_rules('address_street', 'Address', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $arr['error'] = validation_errors();
        } else {
            $arr['succ'] = $this->user_model->update_user($id);
            redirect('admin/users/index/' . $arr['succ']);
        }
        $arr['title'] = "Update Auditor";
        $this->load->view('admin/vwEditUser', $arr);
    }

    public function block_user() {
        // Code goes here
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->update('users', array('deleted' => 'Y'));
        $data = "Auditor Deleted Successfully";
        redirect('admin/users/index/' . $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */