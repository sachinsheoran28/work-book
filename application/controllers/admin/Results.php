<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Results extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('result_model');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index($succ = '', $limit = '') {
        $arr['page'] = 'results';
        $arr['limit'] = $limit;
        $arr['count'] = $this->result_model->get_result_count();
        $arr['link'] = 'results/index';
        $arr['list'] = $this->result_model->get_results($limit);
        $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
        $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
        $this->load->view('admin/vwManageResults', $arr);
    }

    public function view_result($id) {
        $arr['page'] = 'results';
        $arr['list'] = $this->result_model->get_result($id);
        $qids = $arr['list']->qids;
        $query = $this->db->query("SELECT * FROM  `questions` WHERE questions.qid IN ( $qids ) ORDER BY FIELD(questions.qid, $qids ) ");
        $arr['ques'] = $query->result_array();
        $this->load->view('admin/vwViewResult', $arr);
    }

    public function report_result($id) {
        if ($this->result_model->report_result($id) == TRUE) {
            redirect('admin/results');
        } else {
            
        }
    }

    public function edit_ques($id) {
        $arr['page'] = 'Questions';
        // $this->load->view('admin/vwEditUser',$arr);
        redirect('admin/questions');
    }

    public function block_user() {
        // Code goes here
    }

    public function delete_result($id) {

        $this->db->where('id', $id);
        $this->db->update('questions', array('deleted' => 'Y'));
        $data = "Question Deleted Successfully";
        redirect('admin/question/index/' . $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */