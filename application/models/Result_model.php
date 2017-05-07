<?php

class Result_model extends CI_Model {

    function add_new_ques() {
        $insert_data = array(
            'question' => $_POST['question'],
            'question_group' => $_POST['question_group'],
            'aspects' => $_POST['aspects'],
            'option_A' => $_POST['option_A'],
            'option_A_score' => $_POST['option_A_score'],
            'option_B' => $_POST['option_B'],
            'option_B_score' => $_POST['option_B_score'],
            'option_C' => $_POST['option_C'],
            'option_C_score' => $_POST['option_C_score'],
            'option_D' => $_POST['option_D'],
            'option_D_score' => $_POST['option_D_score'],
            'max_score' => $_POST['max_score'],
            'deleted' => 'N'
        );
        if ($this->db->insert('questions', $insert_data)) {
            return "Question Successfully added";
        } else {
            return "Question couldn't be added";
        }
    }

    /*
      function get_results(){

      $this->db->join('users','users.id = results.uid');
      $this->db->join('center','center.centid = results.cenid');

      $this->db->order_by("rid", "desc");
      $query = $this->db->get('results');
      $result = $query->result_array();
      return $result;

      }
     */

    function get_results($limit) {

        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        $this->db->join('users', 'users.id = results.uid');
        $this->db->join('center', 'center.centid = results.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        $this->db->order_by('results.rid', "desc");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('results');
        $result = $query->result_array();
        return $result;
    }

    function get_result_count() {
        $this->db->join('users', 'users.id = results.uid');
        $this->db->join('center', 'center.centid = results.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        $query = $this->db->get('results');
        $result = $query->num_rows();
        return $result;
    }

    function get_result($id) {
        $this->db->join('users', 'users.id = results.uid');
        $this->db->join('center', 'center.centid = results.cenid');

        $this->db->join('assessors', 'assessors.aid = center.aid');

        $this->db->where('rid', $id);
        //$this->db->order_by("rid", "desc"); 
        $query = $this->db->get('results');
        $result = $query->row();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function report_result($rid) {
        $data = array(
            'pending' => '1'
        );

        $this->db->where('rid', $rid);
        if ($this->db->update('results', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    ///////////////////////////// CheckList///////////////////////////////
    function get_checklist_results($limit) {
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        $this->db->join('users', 'users.id = results_checklist.uid');
        $this->db->join('center', 'center.centid = results_checklist.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        $this->db->order_by('results_checklist.rid', "desc");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('results_checklist');
        $result = $query->result_array();
        return $result;
    }

	function get_checklist_results2($limit,$uid) {
		
		$this->db->join('results_checklist', 'results_checklist.aid = inspection.insid');
		$this->db->join('center', 'center.centid = inspection.inscid');
		$this->db->join('users', 'users.id = inspection.insuid');
		$this->db->where('inspection.insaid',$uid);
		$this->db->where('inspection.type',"Checklist");
		$this->db->where('results_checklist.pending', '1');
        $query = $this->db->get('inspection');
        $result = $query->result_array();
		//echo '<pre/>';print_r($result);exit;
        return $result;
    }
	
	function get_inventory_results2($limit,$uid) {
		
		$this->db->join('results_inventory', 'results_inventory.aid = inspection.insid');
		$this->db->join('center', 'center.centid = inspection.inscid');
		$this->db->join('users', 'users.id = inspection.insuid');
		$this->db->where('inspection.insaid',$uid);
		$this->db->where('inspection.type',"Inventory");
		$this->db->where('results_inventory.pending', '1');
        $query = $this->db->get('inspection');
        $result = $query->result_array();
		//echo '<pre/>';print_r($result);exit;
        return $result;
    }
	
	function get_assets_results2($limit,$uid) {
		
		$this->db->join('results_assets', 'results_assets.aid = inspection.insid');
		$this->db->join('center', 'center.centid = inspection.inscid');
		$this->db->join('users', 'users.id = inspection.insuid');
		$this->db->where('inspection.insaid',$uid);
		$this->db->where('inspection.type',"Assets");
		$this->db->where('results_assets.pending', '1');
        $query = $this->db->get('inspection');
        $result = $query->result_array();
		//echo '<pre/>';print_r($result);exit;
        return $result;
    }
	
    function get_checklist_results1($limit, $id) {
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        $this->db->join('users', 'users.id = results_checklist.uid');
        $this->db->join('center', 'center.centid = results_checklist.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        $this->db->where('rid', $id);
        $this->db->order_by('results_checklist.rid', "desc");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('results_checklist');
        $result = $query->result_array();
        //echo $this->db->last_query();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_checklist_result_count() {
        $this->db->join('users', 'users.id = results_checklist.uid');
        $this->db->join('center', 'center.centid = results_checklist.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');

        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $query = $this->db->get('results_checklist');
        $result = $query->num_rows();
        return $result;
    }

    function get_checklist_result_count1($id) {
        $this->db->join('users', 'users.id = results_checklist.uid');
        $this->db->join('center', 'center.centid = results_checklist.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');

        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->where('rid', $id);
        $query = $this->db->get('results_checklist');
        $result = $query->num_rows();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_checklist_result($id) {
        $this->db->join('users', 'users.id = results_checklist.uid');
        $this->db->join('center', 'center.centid = results_checklist.cenid');

        $this->db->join('assessors', 'assessors.aid = center.aid');

        $this->db->where('rid', $id);
        // $this->db->order_by("rid", "desc"); 
        $query = $this->db->get('results_checklist');
        $result = $query->row();
        return $result;
    }

    function report_checklist_result($rid) {
        $data = array(
            'pending' => '1'
        );

        $this->db->where('rid', $rid);
        if ($this->db->update('results_checklist', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //////////////////////// Fixed Assts ///////////////////////
    function get_assets_results($limit) {


        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        $this->db->join('users', 'users.id = results_assets.uid');
        $this->db->join('center', 'center.centid = results_assets.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        $this->db->order_by('results_assets.rid', "desc");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('results_assets');
        $result = $query->result_array();
        return $result;
    }

    function get_assets_result_count() {
        $this->db->join('users', 'users.id = results_assets.uid');
        $this->db->join('center', 'center.centid = results_assets.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');

        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
        }
        $query = $this->db->get('results_assets');
        $result = $query->num_rows();
        return $result;
    }

    function get_assets_result($id) {
        $this->db->join('users', 'users.id = results_assets.uid');
        $this->db->join('center', 'center.centid = results_assets.cenid');

        $this->db->join('assessors', 'assessors.aid = center.aid');

        $this->db->where('rid', $id);
        // $this->db->order_by("rid", "desc"); 
        $query = $this->db->get('results_assets');
        $result = $query->row();
        return $result;
    }

    function report_assets_result($rid) {
        $data = array(
            'pending' => '1'
        );

        $this->db->where('rid', $rid);
        if ($this->db->update('results_assets', $data)) {
            //echo $this->db->last_query();exit;
			return TRUE;
        } else {
            return FALSE;
        }
    }

    //////////////////////// Inventory ///////////////////////
    function get_inventory_results($limit) {


        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        $this->db->join('users', 'users.id = results_inventory.uid');
        $this->db->join('center', 'center.centid = results_inventory.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        $this->db->order_by('results_inventory.rid', "desc");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('results_inventory');
        $result = $query->result_array();
        return $result;
    }

    function get_inventory_result_count() {
        $this->db->join('users', 'users.id = results_inventory.uid');
        $this->db->join('center', 'center.centid = results_inventory.cenid');
        $this->db->join('assessors', 'assessors.aid = center.aid');

        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $query = $this->db->get('results_inventory');
        $result = $query->num_rows();
        return $result;
    }

    function get_inventory_result($id) {
        $this->db->join('users', 'users.id = results_inventory.uid');
        $this->db->join('center', 'center.centid = results_inventory.cenid');

        $this->db->join('assessors', 'assessors.aid = center.aid');

        $this->db->where('rid', $id);
        // $this->db->order_by("rid", "desc"); 
        $query = $this->db->get('results_inventory');
        $result = $query->row();
        return $result;
    }

    function report_inventory_result($rid) {
        $data = array(
            'pending' => '1'
        );

        $this->db->where('rid', $rid);
        if ($this->db->update('results_inventory', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
