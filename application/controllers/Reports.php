<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('vtp_model');
        $this->load->model('result_model');
        $this->load->library('form_validation');
    }

    public function index($succ = '', $limit = '') {
        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0') {
                $arr['page'] = 'reports';
                $arr['limit'] = $limit;
                $arr['list'] = $this->vtp_model->get_resultsc($limit, $this->session->userdata('status'));
                $arr['count'] = $this->vtp_model->get_resultc_count($this->session->userdata('status'));
                $arr['link'] = 'reports/index';
                $arr['search_type'] = isset($_POST['search_type']) ? $_POST['search_type'] : '';
                $arr['search'] = isset($_POST['search']) ? $_POST['search'] : '';
                $this->load->view('vwManageResults', $arr);
            }
        } else {
            redirect('home/do_login');
        }
    }

    public function view_result($id) {
        $arr['page'] = 'reports';

        $arr['list'] = $this->result_model->get_result($id);
        $qids = $arr['list']->qids;
        $query = $this->db->query("SELECT * FROM  `questions` WHERE questions.qid IN ( $qids ) ORDER BY FIELD(questions.qid, $qids ) ");
        $arr['ques'] = $query->result_array();
        $this->load->view('vwViewResult', $arr);
    }

    function get_report($id) {

        if ($this->input->post('generate')) {
            $data['report'] = $this->result_model->get_result($id);

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
            $data['list'] = $this->result_model->get_result($id);
            $qids = $data['list']->qids;
            $query = $this->db->query("SELECT * FROM  `questions` WHERE questions.qid IN ( $qids ) ORDER BY FIELD(questions.qid, $qids ) ");
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

    public function inventory($succ = '', $limit = '') {
        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0') {
                $arr['page'] = 'inventory';
                $arr['limit'] = $limit;

                $arr['list'] = $this->result_model->get_inventory_results2($limit, $this->session->userdata('status'));
                //echo '<pre/>';print_r($arr['list']);exit;

                $arr['link'] = 'inventory/index';

                $this->load->view('vwManageResultsStock', $arr);
            }
        } else {
            redirect('home/do_login');
        }
    }

    public function assets($succ = '', $limit = '') {
        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0') {
                $arr['page'] = 'assets';
                $arr['limit'] = $limit;

                $arr['list'] = $this->result_model->get_assets_results2($limit, $this->session->userdata('status'));
                //echo '<pre/>';print_r($arr['list']);exit;

                $arr['link'] = 'assets/index';

                $this->load->view('vwManageResultsAssets', $arr);
            }
        } else {
            redirect('home/do_login');
        }
    }

}
