<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checklist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('vtp_model');
        $this->load->model('result_model');
        $this->load->model('question_model');
        $this->load->library('form_validation');
    }

    public function index($succ = '', $limit = '') {
        if ($this->session->userdata('type') != 'C' && ($this->session->userdata('type') == 'Industry Expert' || $this->session->userdata('type') == 'Chartered Accountant')) {
            //echo '<pre/>';print_r($this->session->userdata);//exit;
            $uid = $this->session->userdata('id');
            $arr['page'] = 'Checklist';
            //$arr['succ'] = urldecode($data);
            $this->load->library('pagination');
            $arr['title'] = 'Manage Checklist';
            //$this->pagination->initialize(20);
            //  echo $this->pagination->create_links();
            $arr['limit'] = $limit;
            $arr['link'] = 'checklist/index';
            $arr['count'] = $this->question_model->get_checklist_count_auditor();
            $arr['list'] = $this->question_model->get_checklist_auditor($uid, $limit);
            //echo '<pre/>';print_r($arr['list']);exit;
            $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
            $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
            $this->load->view('vwManageChecklist', $arr);
        }

        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0') {
                $arr['page'] = 'checklist';
                $arr['limit'] = $limit;

                //$arr['list'] = $this->vtp_model->get_resultsc($limit,$this->session->userdata('status'));
                //$arr['count'] = $this->vtp_model->get_resultc_count($this->session->userdata('status'));
                //echo $this->session->userdata('status');
                $arr['list'] = $this->result_model->get_checklist_results2($limit, $this->session->userdata('status'));
                //echo '<pre/>';print_r($arr['list']);exit;
                $arr['count'] = $this->result_model->get_checklist_result_count1($this->session->userdata('status'));

                $arr['link'] = 'checklist/index';

                $this->load->view('vwManageResultsChecklist', $arr);
            }
        } else {
            redirect('home/do_login');
        }
    }

    public function get_ques($id, $data = "") {
        $arr['page'] = 'Checklist';
        $arr['succ'] = str_replace('%20', ' ', $data);
        $arr['subid'] = $id;
        $arr['title'] = 'Manage Checklist Questions';
        $arr['list'] = $this->question_model->get_checklist_ques_auditor($id);
        //echo '<pre/>';print_r($arr['list']);exit;
        $this->load->view('vwManageChecklistQuestion', $arr);
    }

    public function view_result($id) {
        $arr['page'] = 'checklist';

        $arr['list'] = $this->result_model->get_checklist_result($id);
        $qids = $arr['list']->qids;
        $query = $this->db->query("SELECT * FROM  `checklist` WHERE checklist.qid IN ( $qids ) ORDER BY FIELD(checklist.qid, $qids ) ");
        $arr['ques'] = $query->result_array();
        $this->load->view('vwViewResultChecklist', $arr);
    }

    function get_report($id) {

        if ($this->input->post('generate')) {
            //$data['report']=$this->result_model->get_result($id);
            $data['list'] = $this->result_model->get_checklist_result($id);
            //echo '<pre/>';print_r($data['list']);exit;

            $qids = $data['list']->qids;
            $query = $this->db->query("SELECT * FROM  `checklist` WHERE questions.qid IN ( $qids ) ORDER BY FIELD(questions.qid, $qids ) ");
            $data['ques'] = $query->result_array();

            $this->load->library('pdf');
            $this->pdf->load_view('get_report', $data);
            $this->pdf->render();
            $filename = date('Y-M-d_H:i:s', time()) . "-report.pdf";
            $this->pdf->stream($filename);
        } else {
            redirect('reports/view_result' . $id);
        }
    }

    function pdfreport($id) {
        if ($this->input->post('generate')) {
            //$data['list']=$this->result_model->get_result($id);
            $data['list'] = $this->result_model->get_checklist_result($id);
            //echo '<pre/>';print_r($data['list']);
            $qids = $data['list']->qids;
            //echo '<pre/>';print_r($qids);exit;
            $query = $this->db->query("SELECT * FROM  `checklist` WHERE checklist.qid IN ( $qids ) ORDER BY FIELD(checklist.qid, $qids ) ");
            $data['ques'] = $query->result_array();

            $this->load->library('pdf');
            $this->pdf->load_view('get_report', $data);
            $this->pdf->render();
            $filename = date('Y-M-d_H:i:s', time()) . "-report.pdf";
            $this->pdf->stream($filename);
        } else {
            redirect('reports/view_result' . $id);
        }
    }

}
