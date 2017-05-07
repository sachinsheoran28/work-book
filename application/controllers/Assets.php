<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('vtp_model');
        $this->load->model('result_model');
        $this->load->library('form_validation');
    }

    public function index($succ = '', $limit = '') {
        if ($this->session->userdata('is_client_login')) {
            if ($this->session->userdata('status') != '0') {
                $arr['page'] = 'Reports';
                $arr['limit'] = $limit;
                $arr['list'] = $this->vtp_model->get_resultscAssets($limit, $this->session->userdata('status'));
                $arr['count'] = $this->vtp_model->get_resultscAssets_count($this->session->userdata('status'));
                $arr['link'] = 'stock/index';

                $this->load->view('vwManageResultsAssets', $arr);
            }
        } else {
            redirect('home/do_login');
        }
    }

    public function view_result($id) {
        $arr['page'] = 'assets';

        $arr['list'] = $this->result_model->get_assets_result($id);
        $qids = $arr['list']->qids;
        $query = $this->db->query("SELECT * FROM  `assets` WHERE assets.qid IN ( $qids ) ORDER BY FIELD(assets.qid, $qids ) ");
        $arr['ques'] = $query->result_array();
        $this->load->view('vwViewResultAsset', $arr);
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
            $data['list'] = $this->result_model->get_assets_result($id);
            $qids = $data['list']->qids;
            $query = $this->db->query("SELECT * FROM  `assets` WHERE assets.qid IN ( $qids ) ORDER BY FIELD(assets.qid, $qids ) ");
            $data['ques'] = $query->result_array();

            $this->load->library('pdf');
            //$this->pdf->load_view('get_report',$data);
            $this->pdf->load_view('get_report1', $data);
            $this->pdf->render();
            $filename = date('Y-M-d_H:i:s', time()) . "-report.pdf";
            $this->pdf->stream($filename);
        } else {
            redirect('reports/view_result' . $id);
        }
    }

}
