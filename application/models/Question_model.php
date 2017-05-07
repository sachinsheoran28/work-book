<?php

class Question_model extends CI_Model {

    function add_new_ques($id) {
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
            'insid' => $id,
            'deleted' => 'N'
        );
        if ($this->db->insert('questions', $insert_data)) {
            return "Question Successfully added";
        } else {
            return "Question couldn't be added";
        }
    }

    function add_new_inspection() {
        $insert_data = array(
            'insname' => $_POST['insname'],
            'date' => strtotime($_POST['date']),
            'enddate' => strtotime($_POST['enddate']),
            'insaid' => $_POST['insaid'],
            'inscid' => $_POST['parentid'],
            'insuid' => $_POST['insuid'],
            'ins_delete' => 'N'
        );
        //echo '<pre/>';print_r($insert_data);exit;
        if ($this->db->insert('inspection', $insert_data)) {
            return "Inspection Successfully added";
        } else {
            return "Inspection couldn't be added";
        }
    }

    function add_new_assets_ques() {
        $insert_data = array(
            'insid' => $_POST['parent_id'],
            'question' => $_POST['question'],
            'deleted' => 'N'
        );
        if ($this->db->insert('assets', $insert_data)) {
            return "Assets question Successfully added";
        } else {
            return "Assets question couldn't be added";
        }
    }

    function edit_inspection($id) {

        $insert_data = array(
            'insname' => $_POST['insname'],
            'date' => strtotime($_POST['date']),
            'enddate' => strtotime($_POST['enddate']),
            'insaid' => $_POST['insaid'],
            'inscid' => $_POST['parentid'],
            'insuid' => $_POST['insuid'],
            'ins_delete' => 'N'
        );
        //echo '<pre/>';print_r($insert_data);exit;
        $this->db->where('insid', $id);
        if ($this->db->update('inspection', $insert_data)) {
            return "Assets Successfully updated";
        } else {
            return "Assets couldn't be updated";
        }
    }

    function get_inspection($id) {
        $this->db->where('insid', $id);
        $val = $this->db->get('inspection');
        $result = $val->row();
        return $result;
    }

    function get_vtp() {
        $sql = "SELECT * FROM assessors WHERE assessors.deleted = 'N'";

        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->result_array();
        } else {
            return "no client found";
        }
    }

    function get_users() {
        $sql = "SELECT * FROM users WHERE users.deleted = 'N' AND users.status ='0'";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->result_array();
        } else {
            return "no assessor found";
        }
    }

    function get_varencetable() {

        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        // $this->db->join('variance','variance.ins_id = inspection.insid');
        $this->db->where('inspection.insuid', $this->session->userdata['id']);
        $this->db->where('inspection.type', 'Inventory');
        //$this->db->where('inspection.ins_delete', 'N'); // earlier code
        $this->db->where('inspection.ins_delete', 'Y');
        $val = $this->db->get('inspection');
        $result = $val->result_array();
        //echo $this->db->last_query();exit;
        return $result;
    }

    function get_varence($insid) {
        $this->db->where('inspection.insid', $insid);
        $this->db->where('inspection.ins_delete', 'Y'); // earlier code
        //$this->db->where('inspection.ins_delete', 'N');
        $val = $this->db->get('inspection');
        $result = $val->row();
        return $result;
    }

    function get_varencedropdown($insid) {
        $this->db->select('question');
        $this->db->select('qid');
        $this->db->where('insid', $insid);
        $val = $this->db->get('inventory');
        $result = $val->result();
        return $result;
    }

    function get_insp($cid) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        if ($cid != 0) {
            $this->db->where('inspection.inscid', $cid);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $val = $this->db->get('inspection');
        $result = $val->result_array();

        return $result;
    }

    function get_insps($cid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, "$search"); }
        }
        if ($cid != 0) {
            $this->db->where('inspection.inscid', $cid);
        }
        $this->db->order_by('insid', 'DESC');
        $this->db->where('inspection.ins_delete', 'N');
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
        return $result;
    }

    function get_insps_count() {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $query = $this->db->get('inspection');
        $result = $query->num_rows();
        return $result;
    }

    function get_ques($id) {
        $sql = "SELECT * FROM questions WHERE insid = $id";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->result_array();
        } else {
            return "no question found";
        }
    }

    function get_que($id) {
        //$sql = "SELECT * FROM questions WHERE qid = $id";
        //$val = $this->db->query($sql);
        $this->db->where('qid', $id);
        $val = $this->db->get('questions');
        if ($val->num_rows()) {
            return $val->row();
        } else {
            return "no question found";
        }
    }

    function get_ques_num() {
        $sql = "SELECT * FROM questions";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->num_rows();
        } else {
            return "0";
        }
    }

    function get_users_num() {
        $sql = "SELECT * FROM users";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->num_rows();
        } else {
            return "0";
        }
    }

    function get_vtp_num() {
        $sql = "SELECT * FROM assessors";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->num_rows();
        } else {
            return "0";
        }
    }

    function get_center_num() {
        $sql = "SELECT * FROM center";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->num_rows();
        } else {
            return "0";
        }
    }

    function edit_ques($id) {
        $sql = "SELECT * FROM users where aid = '" . $id . "'";
        $val = $this->db->query($sql);
        if ($val->num_rows() == 1) {
            return $val->row();
        } else {
            return "no assessor found";
        }
    }

    function update_ques($id) {

        $data = array(
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

        $this->db->where('qid', $id);
        if ($this->db->update('questions', $data)) {
            return "Question Updated successfully";
        } else {
            return "Question couldn't update";
        }
    }

    ///////////////// Results //////////////////
    function upload_result($aid) {

        $sql = "SELECT inspection.inscid FROM inspection where inspection.insid =  $aid ";

        $subQuery = $this->db->query($sql);
        foreach ($subQuery->result() as $v) {
            $dat = $v->inscid;
        }

        $noq = $_POST['noq'];
        $oids = array();
        $videos = array();
        $images = array();
        $qids = array();
        $remarks = array();
        $sugessions = array();
        $sum = 0;
        for ($x = 1; $x <= $noq; $x++) {
            $oids[$x] = $_POST['option_' . $x];
            $sum += $_POST['option_' . $x];
            $qids[$x] = $_POST['question_' . $x];
            $sugessions[$x] = $_POST['suggesstion_' . $x];
            $remarks[$x] = $_POST['remark_' . $x];
        }
        $scores = implode(",", $oids);
        $qid = implode(",", $qids);
        $sugession = implode("~", $sugessions);
        $remark = implode("~", $remarks);

        ///images 


        $images = array();

        for ($x = 1; $x <= $noq; $x++) {
            $files = $_FILES;
            if (empty($_FILES["image_" . $x]['name'])) {
                $images[] = '';
            } else {
                $config = array();
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'mpeg|mpg|mp4|qt|mpe|avi|mov|gif|jpg|png';
                $config['max_size'] = '0'; // Unlimited
                $config['max_width'] = '0'; // Unlimited
                $config['max_height'] = '0'; // Unlimited
                $config['encrypt_name'] = TRUE;
                $_FILES['image']['name'] = $files["image_" . $x]['name'];
                $_FILES['image']['type'] = $files["image_" . $x]['type'];
                $_FILES['image']['tmp_name'] = $files["image_" . $x]['tmp_name'];
                $_FILES['image']['error'] = $files["image_" . $x]['error'];
                $_FILES['image']['size'] = $files["image_" . $x]['size'];
                $this->load->library('upload', $config);
                $this->upload->do_upload("image_" . $x);

                $data = $this->upload->data();
                $fileName = $data['file_name'];
                $images[] = $fileName;
                $data = '';
                $fileName = '';
            }
        }
        $image = implode("~", $images);

        for ($x = 1; $x <= $noq; $x++) {
            $files = $_FILES;
            if (empty($_FILES["video_" . $x]['name'])) {
                $videos[] = '';
            } else {
                $config2 = array();
                $config2['upload_path'] = './uploads/';
                $config2['allowed_types'] = 'mpeg|mpg|mp4|qt|mpe|avi|mov|gif|jpg|png';
                $config2['max_size'] = '0'; // Unlimited
                $config2['max_width'] = '0'; // Unlimited
                $config2['max_height'] = '0'; // Unlimited
                $config2['encrypt_name'] = TRUE;

                $_FILES['video_']['name'] = $files["video_" . $x]['name'];
                $_FILES['video_']['type'] = $files["video_" . $x]['type'];
                $_FILES['video_']['tmp_name'] = $files["video_" . $x]['tmp_name'];
                $_FILES['video_']['error'] = $files["video_" . $x]['error'];
                $_FILES['video_']['size'] = $files["video_" . $x]['size'];
                $this->load->library('upload', $config);
                $this->upload->do_upload("video_" . $x);
                $data1 = $this->upload->data();
                $fileName1 = $data1['file_name'];
                $videos[] = $fileName1;
                $data1 = '';
                $fileName1 = '';
            }
        }

        $video = implode("~", $videos);

        $uid = $this->session->userdata('id');
        $ip = $this->input->ip_address();
        $final_score = $sum;
        $insert_data = array(
            'uid' => $uid,
            'aid' => $aid,
            'cenid' => $dat,
            'qids' => $qid,
            'scores' => $scores,
            'ip_address' => $ip,
            'final_score' => $sum,
            'suggestion' => $sugession,
            'remark' => $remark,
            'date' => date("Y-m-d g:i a"),
            'videos' => $video,
            'images' => $image,
            'final_comment' => $_POST['finam_comment'],
            'lati_longi' => $_POST['latilong'],
        );
        if ($this->db->insert('results', $insert_data)) {
            $sqls = "UPDATE inspection SET ins_delete ='Y'";
            $this->db->query($sqls);

            return "Successfully submited";
        } else {
            return "Could't submit";
        }
    }

    ////////////////// Import Quiz /////////////

    function import_question($question, $iid) {

        foreach ($question as $key => $singlequestion) {
            //$ques_type= 
//echo $ques_type; 

            if ($key != 0) {
//echo "<pre>";print_r($singlequestion);exit;
                // echo $questiondid; 
                if ($singlequestion['0'] != '') {
                    $question = str_replace('"', '&#34;', $singlequestion['0']);
                    $question = str_replace("`", '&#39;', $question);
                    $question = str_replace("‘", '&#39;', $question);
                    $question = str_replace("’", '&#39;', $question);
                    $question = str_replace("â€œ", '&#34;', $question);
                    $question = str_replace("â€˜", '&#39;', $question);
                    $question = str_replace("â€™", '&#39;', $question);
                    $question = str_replace("â€", '&#34;', $question);
                    $question = str_replace("'", "&#39;", $question);
                    $question = str_replace("\n", "<br>", $question);
                    $group = str_replace('"', '&#34;', $singlequestion['1']);
                    $group = str_replace("'", "&#39;", $group);
                    $group = str_replace("\n", "<br>", $group);
                    $Aspects = $singlequestion['2'];

                    $option_A = $singlequestion['3'];

                    $option_A_Score = $singlequestion['4'];

                    $option_B = $singlequestion['5'];

                    $option_B_Score = $singlequestion['6'];

                    $option_C = $singlequestion['7'];

                    $option_C_Score = $singlequestion['8'];

                    $option_D = $singlequestion['9'];

                    $option_D_Score = $singlequestion['10'];

                    $max_score = $singlequestion['11'];

                    $query_data = array();
                    $query_data[] = "question ='$question'";
                    $query_data[] = "insid =$iid";
                    $query_data[] = "deleted ='N'";

                    if (!empty($group)) {
                        $query_data[] = "question_group='$group'";
                    }
                    if (!empty($Aspects)) {
                        $query_data[] = "aspects='$Aspects'";
                    }
                    if (!empty($option_A)) {
                        $query_data[] = "option_A='$option_A'";
                    }
                    if (!empty($option_A_Score)) {
                        $query_data[] = "option_A_score='$option_A_Score'";
                    }
                    if (!empty($option_B)) {
                        $query_data[] = "option_B='$option_B'";
                    }
                    if (!empty($option_B_Score)) {
                        $query_data[] = "option_B_score='$option_B_Score'";
                    }
                    if (!empty($option_C)) {
                        $query_data[] = "option_C='$option_C'";
                    }
                    if (!empty($option_C_Score)) {
                        $query_data[] = "option_C_score='$option_C_Score'";
                    }
                    if (!empty($option_D)) {
                        $query_data[] = "option_D='$option_D'";
                    }
                    if (!empty($option_D_Score)) {
                        $query_data[] = "option_D_score='$option_D_Score'";
                    }
                    if (!empty($max_score)) {
                        $query_data[] = "max_score ='$max_score'";
                    }
                    //  $insert_data = array(implode(",", $query_data));

                    $query = "INSERT INTO questions SET " . implode(",", $query_data);
                    // $this->db->query($query);
                    $this->db->query($query);
                    /* $insert_data = array(
                      'question' => $question,
                      'question_group' => $group,
                      'aspects' => $Aspects,
                      'option_A' => $option_A,
                      'option_A_score' => $option_A_Score,
                      'option_B' => $option_B,
                      'option_B_score' => $option_B_Score,
                      'option_C' => $option_C,
                      'option_C_score' => $option_C_Score,
                      'option_D' => $option_D,
                      'option_D_score' => $option_D_Score,
                      'max_score' => $max_score,
                      'insid' => $iid,
                      'deleted' => 'N'
                      );

                      if($query){
                      return "Questions Successfully uploaded";
                      } else {
                      return "Questions couldn't be uploaded";
                      }
                     */
                }
            }
        }

        if ($query) {
            return "Questions Successfully uploaded";
        } else {
            return "Questions couldn't be uploaded";
        }
    }

    //////////////// Import Quiz /////////////////////
    ///////////////// Checklist Questions ///////////////////
    function add_new_checklist_inspection() {
        $insert_data = array(
            'insname' => $_POST['insname'],
            'date' => strtotime($_POST['date']),
            'enddate' => strtotime($_POST['enddate']),
            'insaid' => $_POST['insaid'],
            'inscid' => $_POST['parentid'],
            'insuid' => $_POST['insuid'],
            'ins_delete' => 'N',
            'type' => 'Checklist'
        );
        if ($this->db->insert('inspection', $insert_data)) {
            return "Checklist Successfully added";
        } else {
            return "Checklist couldn't be added";
        }
    }

    function add_new_inventory_ques($id) {
        $insert_data = array(
            'code' => $_POST['code'],
            'question' => $_POST['question'],
            'insid' => $id,
            'deleted' => 'N'
        );
        if ($this->db->insert('inventory', $insert_data)) {
            return "Question Successfully added";
        } else {
            return "Question couldn't be added";
        }
    }

    function get_checklist($cid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->order_by('insid', 'DESC');
        $this->db->where('inspection.type', 'Checklist');

        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
            
        }
        if ($cid != 0) {
            $this->db->where('inspection.inscid', $cid);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
		//echo $this->db->last_query();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_checklist_auditor($uid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->order_by('insid', 'DESC');
        $this->db->where('inspection.type', 'Checklist');

        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }

        $this->db->where('inspection.insuid', $uid);
        $this->db->where('inspection.ins_delete', 'Y'); 
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_checklist_count_auditor() {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->where('inspection.ins_delete', 'Y');
        $query = $this->db->get('inspection');
        $result = $query->num_rows();
        return $result;
    }

    function get_checklist_count() {
//       old code
//         $this->db->join('users', 'users.id = inspection.insuid');
//        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
//        $this->db->join('center', 'center.centid = inspection.inscid');
//        if ($this->input->post('search_type')) {
//            $search_type = $this->input->post('search_type');
//            $search = $this->input->post('search');
//
//            $this->db->like($search_type, $search);
//        }
//        $this->db->where('inspection.ins_delete', 'N');
//        $query = $this->db->get('inspection');
// New Code gk
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->order_by('insid', 'DESC');
        $this->db->where('inspection.type', 'Checklist');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $query = $this->db->get('inspection');
        $result = $query->num_rows();
        return $result;
    }

    function add_new_checklist_ques($id) {
        /* $insert_data = array(
          'question' => $_POST['question'],
          'insid' => $id,
          'deleted' => 'N'
          );
          if($this->db->insert('assets',$insert_data)){
          return "Question Successfully added";
          } else {
          return "Question couldn't be added";
          } */
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
            'insid' => $id,
            'weight' => $_POST['weight'],
            'deleted' => 'N'
        );
        //echo '<pre/>';print_r($insert_data);exit;
        if ($this->db->insert('checklist', $insert_data)) {
            return "Checklist Question Successfully added";
        } else {
            return "Checklist Question couldn't be added";
        }
    }

    function get_checklist_ques($id,$limit) {
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->where('checklist.insid', $id);
        $this->db->where('checklist.deleted', 'N');
        $query = $this->db->get('checklist');
        $result = $query->result_array();
        return $result;
    }
    function get_checklist_ques_count($id) {
        $sql = "SELECT * FROM checklist WHERE insid = $id and deleted!='Y'";
        $val = $this->db->query($sql);
        $result = $val->num_rows();
        return $result;
    }
    

    function get_checklist_ques_auditor($id) {
        $this->db->join('results_checklist', 'results_checklist.aid = checklist.insid');
        $this->db->where('checklist.insid', $id);
        $query = $this->db->get('checklist');
        $result = $query->result_array();
        return $result;
    }

    function get_checklist_que($id) {
        $sql = "SELECT * FROM checklist WHERE qid = $id";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->row();
        } else {
            return "no question found";
        }
    }

    function update_checklist_ques($id) {

        $data = array(
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
            'weight' => $_POST['weight'],
            'max_score' => $_POST['max_score'],
            'deleted' => 'N'
        );

        $this->db->where('qid', $id);
        if ($this->db->update('checklist', $data)) {
            return "Checklist Question Updated successfully";
        } else {
            return "Checklist Question couldn't update";
        }
    }

    function import_checklist_question($question, $iid) {
        foreach ($question as $key => $singlequestion) {
            //$ques_type= 
//echo $ques_type; 

            if ($key != 0) {
//echo "<pre>";//print_r($singlequestion,$iid);
                // echo $questiondid; 
                if ($singlequestion['0'] != '') {
                    $question = str_replace('"', '&#34;', $singlequestion['0']);
                    $question = str_replace("`", '&#39;', $question);
                    $question = str_replace("‘", '&#39;', $question);
                    $question = str_replace("’", '&#39;', $question);
                    $question = str_replace("â€œ", '&#34;', $question);
                    $question = str_replace("â€˜", '&#39;', $question);
                    $question = str_replace("â€™", '&#39;', $question);
                    $question = str_replace("â€", '&#34;', $question);
                    $question = str_replace("'", "&#39;", $question);
                    $question = str_replace("\n", "<br>", $question);
                    $group = str_replace('"', '&#34;', $singlequestion['1']);
                    $group = str_replace("'", "&#39;", $group);
                    $group = str_replace("\n", "<br>", $group);
                    $Aspects = $singlequestion['2'];

                    $option_A = $singlequestion['3'];

                    $option_A_Score = $singlequestion['4'];

                    $option_B = $singlequestion['5'];

                    $option_B_Score = $singlequestion['6'];

                    $option_C = $singlequestion['7'];

                    $option_C_Score = $singlequestion['8'];

                    $option_D = $singlequestion['9'];

                    $option_D_Score = $singlequestion['10'];

                    $max_score = $singlequestion['11'];

                    $weight = $singlequestion['12'];

                    $query_data = array();
                    $query_data[] = "question ='$question'";
                    $query_data[] = "insid =$iid";
                    $query_data[] = "deleted ='N'";

                    if (!empty($group)) {
                        $query_data[] = "question_group='$group'";
                    }
                    if (!empty($Aspects)) {
                        $query_data[] = "aspects='$Aspects'";
                    }
                    if (!empty($option_A)) {
                        $query_data[] = "option_A='$option_A'";
                    }
                    if (!empty($option_A_Score)) {
                        $query_data[] = "option_A_score='$option_A_Score'";
                    }
                    if (!empty($option_B)) {
                        $query_data[] = "option_B='$option_B'";
                    }
                    if (!empty($option_B_Score)) {
                        $query_data[] = "option_B_score='$option_B_Score'";
                    }
                    if (!empty($option_C)) {
                        $query_data[] = "option_C='$option_C'";
                    }
                    if (!empty($option_C_Score)) {
                        $query_data[] = "option_C_score='$option_C_Score'";
                    }
                    if (!empty($option_D)) {
                        $query_data[] = "option_D='$option_D'";
                    }
                    if (!empty($option_D_Score)) {
                        $query_data[] = "option_D_score='$option_D_Score'";
                    }
                    if (!empty($max_score)) {
                        $query_data[] = "max_score ='$max_score'";
                    }
                    if (!empty($weight)) {
                        $query_data[] = "weight ='$max_score'";
                    }
                    //  $insert_data = array(implode(",", $query_data));


                    $query = "INSERT INTO checklist SET " . implode(",", $query_data);
                    // $this->db->query($query);
                    $this->db->query($query);
                    /* $insert_data = array(
                      'question' => $question,
                      'question_group' => $group,
                      'aspects' => $Aspects,
                      'option_A' => $option_A,
                      'option_A_score' => $option_A_Score,
                      'option_B' => $option_B,
                      'option_B_score' => $option_B_Score,
                      'option_C' => $option_C,
                      'option_C_score' => $option_C_Score,
                      'option_D' => $option_D,
                      'option_D_score' => $option_D_Score,
                      'max_score' => $max_score,
                      'insid' => $iid,
                      'deleted' => 'N'
                      );

                      if($query){
                      return "Questions Successfully uploaded";
                      } else {
                      return "Questions couldn't be uploaded";
                      }
                     */
                }
            }
        }

        if ($query) {
            return "Questions Successfully uploaded";
        } else {
            return "Questions couldn't be uploaded";
        }
    }

////////////// Fixed Assets Question ////////////////////

    function add_new_assets_inspection() {
        $insert_data = array(
            'insname' => $_POST['insname'],
            'date' => strtotime($_POST['date']),
            'enddate' => strtotime($_POST['enddate']),
            'insaid' => $_POST['insaid'],
            'inscid' => $_POST['parentid'],
            'insuid' => $_POST['insuid'],
            'ins_delete' => 'N',
            'type' => 'Assets'
        );
        if ($this->db->insert('inspection', $insert_data)) {
            return "Assets Successfully added";
        } else {
            return "Assets couldn't be added";
        }
    }

    function get_assets($cid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->where('inspection.type', 'Assets');
        $this->db->order_by('insid', 'DESC');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        if ($cid != 0) {
            $this->db->where('inspection.inscid', $cid);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_assets_audit($uid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->where('inspection.type', 'Assets');
        $this->db->order_by('insid', 'DESC');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }

        $this->db->where('inspection.insuid', $uid);
        $this->db->where('inspection.ins_delete', 'Y');
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_assets_count($cid) {
       $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->where('inspection.type', 'Assets');
        $this->db->order_by('insid', 'DESC');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        if ($cid != 0) {
            $this->db->where('inspection.inscid', $cid);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $query = $this->db->get('inspection');
        $result = $query->num_rows();
        return $result;
    }

    function get_assets_ques($id,$limit) {
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->where('assets.insid', $id);
         $this->db->where('assets.deleted', 'N');
        $query = $this->db->get('assets');
        $result = $query->result_array();
        return $result;
    }
    function get_assets_ques_count($id) {
        $sql = "SELECT * FROM assets WHERE insid = $id and deleted!='Y'";
        $val = $this->db->query($sql);
        $result = $val->num_rows();
        return $result;
    }

    function get_assets_ques_audit($id) {
        $this->db->join('results_assets', 'results_assets.aid = assets.insid');
        $this->db->where('assets.insid', $id);
        $query = $this->db->get('assets');
        $result = $query->result_array();
        return $result;
    }

    function get_assets_que($id) {
        $sql = "SELECT * FROM assets WHERE qid = $id";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->row();
        } else {
            return "no question found";
        }
    }

    function update_assets_question($id) {
        $data = array(
            'question' => $_POST['question']
        );
        $this->db->where('qid', $id);
        if ($this->db->update('assets', $data)) {
            return "Assets Question Updated successfully";
        } else {
            return "Assets Question couldn't update";
        }
    }

    function update_assets_ques($id) {

        $data = array(
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
            'weight' => $_POST['weight'],
            'max_score' => $_POST['max_score'],
            'deleted' => 'N'
        );

        $this->db->where('qid', $id);
        if ($this->db->update('checklist', $data)) {
            return "Question Updated successfully " . $id;
        } else {
            return "Question couldn't update";
        }
    }

    function import_assets_question($question, $iid) {
        //echo "<pre>";print_r($question);
        foreach ($question as $key => $singlequestion) {
            //$ques_type= 
//echo $ques_type; 

            if ($key != 0) {
//echo "<pre>";print_r($singlequestion);//exit;
                // echo $questiondid; 
                if ($singlequestion['0'] != '') {
                    $question = str_replace('"', '&#34;', $singlequestion['0']);
                    $question = str_replace("`", '&#39;', $question);
                    $question = str_replace("‘", '&#39;', $question);
                    $question = str_replace("’", '&#39;', $question);
                    $question = str_replace("â€œ", '&#34;', $question);
                    $question = str_replace("â€˜", '&#39;', $question);
                    $question = str_replace("â€™", '&#39;', $question);
                    $question = str_replace("â€", '&#34;', $question);
                    $question = str_replace("'", "&#39;", $question);
                    $question = str_replace("\n", "<br>", $question);
//$group= str_replace('"','&#34;',$singlequestion['1']);
//$group= str_replace("'","&#39;",$group);
//$group= str_replace("\n","<br>",$group);
                    $query_data = array();
                    $query_data[] = "question ='$question'";
                    $query_data[] = "insid =$iid";
                    $query_data[] = "deleted ='N'";
                    //echo '<pre/>';print_r($query_data);
                    $query = "INSERT INTO assets SET " . implode(",", $query_data);
                    // $this->db->query($query);
                    $this->db->query($query);
                    /* $insert_data = array(
                      'question' => $question,
                      'question_group' => $group,
                      'aspects' => $Aspects,
                      'option_A' => $option_A,
                      'option_A_score' => $option_A_Score,
                      'option_B' => $option_B,
                      'option_B_score' => $option_B_Score,
                      'option_C' => $option_C,
                      'option_C_score' => $option_C_Score,
                      'option_D' => $option_D,
                      'option_D_score' => $option_D_Score,
                      'max_score' => $max_score,
                      'insid' => $iid,
                      'deleted' => 'N'
                      );

                      if($query){
                      return "Questions Successfully uploaded";
                      } else {
                      return "Questions couldn't be uploaded";
                      }
                     */
                }
            }
        }

        if ($query) {
            return "Questions Successfully uploaded";
        } else {
            return "Questions couldn't be uploaded";
        }
    }

////////////// Inventry Question ////////////////////

    function add_new_inventory_inspection() {
        $insert_data = array(
            'insname' => $_POST['insname'],
            'date' => strtotime($_POST['date']),
            'enddate' => strtotime($_POST['enddate']),
            'insaid' => $_POST['insaid'],
            'inscid' => $_POST['parentid'],
            'insuid' => $_POST['insuid'],
            'ins_delete' => 'N',
            'type' => 'Inventory'
        );
        if ($this->db->insert('inspection', $insert_data)) {
            return "Inventory Successfully added";
        } else {
            return "Inventory couldn't be added";
        }
    }

    function get_inventory($cid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->order_by('insid', 'DESC');
        $this->db->where('inspection.type', 'Inventory');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        if ($cid != 0) {
            $this->db->where('inspection.inscid', $cid);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_inventory_audit($uid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->order_by('insid', 'DESC');
        $this->db->where('inspection.type', 'Inventory');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }

        $this->db->where('inspection.insuid', $uid);
        $this->db->where('inspection.ins_delete', 'Y');
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_inventory_count($cid) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->order_by('insid', 'DESC');
        $this->db->where('inspection.type', 'Inventory');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, $search); }
        }
        if ($cid != 0) {
            $this->db->where('inspection.inscid', $cid);
        }
        $this->db->where('inspection.ins_delete', 'N');
        $query = $this->db->get('inspection');
        $result = $query->num_rows();
        return $result;
    }

    function get_inventory_ques($id,$limit) {
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->where('inventory.insid', $id);
         $this->db->where('inventory.deleted', 'N');
        $query = $this->db->get('inventory');
        $result = $query->result_array();
        return $result;
    }
    function get_inventory_ques_count($id) {
        $sql = "SELECT * FROM inventory WHERE insid = $id and deleted!='Y'";
        $val = $this->db->query($sql);
        $result = $val->num_rows();
        return $result;
    }

    function get_inventory_ques_audit($id) {
        $this->db->join('results_inventory', 'results_inventory.aid = inventory.insid');
        $this->db->where('inventory.insid', $id);
        $query = $this->db->get('inventory');
        $result = $query->result_array();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }

    function get_inventory_que($id) {
        $sql = "SELECT * FROM inventory WHERE qid = $id";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->row();
        } else {
            return "no question found";
        }
    }

    function update_inventory_ques($id) {

        $data = array(
            'question' => $_POST['question'],
            'code' => $_POST['code'],
            'deleted' => 'N'
        );

        $this->db->where('qid', $id);
        if ($this->db->update('inventory', $data)) {
            return "Question Updated successfully";
        } else {
            return "Question couldn't update";
        }
    }

    function import_inventory_question($question, $iid) {
        foreach ($question as $key => $singlequestion) {
            //$ques_type= 
//echo $ques_type; 

            if ($key != 0) {
//echo "<pre>";//print_r($singlequestion,$iid);
                // echo $questiondid; 
                if ($singlequestion['0'] != '') {
                    $question = str_replace('"', '&#34;', $singlequestion['0']);
                    $question = str_replace("`", '&#39;', $question);
                    $question = str_replace("‘", '&#39;', $question);
                    $question = str_replace("’", '&#39;', $question);
                    $question = str_replace("â€œ", '&#34;', $question);
                    $question = str_replace("â€˜", '&#39;', $question);
                    $question = str_replace("â€™", '&#39;', $question);
                    $question = str_replace("â€", '&#34;', $question);
                    $question = str_replace("'", "&#39;", $question);
                    $question = str_replace("\n", "<br>", $question);
                    $code = str_replace('"', '&#34;', $singlequestion['1']);
                    $code = str_replace("'", "&#39;", $code);
                    $code = str_replace("\n", "<br>", $code);
					$r_quantity = $singlequestion['2'];
                    $query_data = array();
                    $query_data[] = "question ='$question'";
					$query_data[] = "r_quantity ='$r_quantity'";
                    $query_data[] = "insid =$iid";
                    $query_data[] = "deleted ='N'";

                    if (!empty($code)) {
                        $query_data[] = "code='$code'";
                    }

                    //  $insert_data = array(implode(",", $query_data));


                    $query = "INSERT INTO inventory SET " . implode(",", $query_data);
                    // $this->db->query($query);
                    $this->db->query($query);
                    /* $insert_data = array(
                      'question' => $question,
                      'question_group' => $group,
                      'aspects' => $Aspects,
                      'option_A' => $option_A,
                      'option_A_score' => $option_A_Score,
                      'option_B' => $option_B,
                      'option_B_score' => $option_B_Score,
                      'option_C' => $option_C,
                      'option_C_score' => $option_C_Score,
                      'option_D' => $option_D,
                      'option_D_score' => $option_D_Score,
                      'max_score' => $max_score,
                      'insid' => $iid,
                      'deleted' => 'N'
                      );

                      if($query){
                      return "Questions Successfully uploaded";
                      } else {
                      return "Questions couldn't be uploaded";
                      }
                     */
                }
            }
        }

        if ($query) {
            return "Questions Successfully uploaded";
        } else {
            return "Questions couldn't be uploaded";
        }
    }

//new function made by another one

    function import_flv_variance($question, $insid, $inscid, $insuid, $count, $type, $excel_name) {
        if ($count == 4) {
            foreach ($question as $key => $singlequestion) {
                if ($key != 0) {
                    if ($singlequestion['0'] != '') {
                        $question = str_replace('"', '&#34;', $singlequestion['0']);
                        $question = str_replace("`", '&#39;', $question);
                        $question = str_replace("‘", '&#39;', $question);
                        $question = str_replace("’", '&#39;', $question);
                        $question = str_replace("â€œ", '&#34;', $question);
                        $question = str_replace("â€˜", '&#39;', $question);
                        $question = str_replace("â€™", '&#39;', $question);
                        $question = str_replace("â€", '&#34;', $question);
                        $question = str_replace("'", "&#39;", $question);
                        $question = str_replace("\n", "<br>", $question);

                        if (is_numeric($singlequestion['1'])) {
                            $qty = $singlequestion['1'];
                        } else {
                            echo "Invalid Input given in excel sheet.";
                            exit;
                        }
                        if (is_numeric($singlequestion['2'])) {
                            $Val = is_numeric($singlequestion['2']);
                        } else {
                            echo "Invalid Input given in excel sheet.";
                            exit;
                        }
                        if (is_numeric($singlequestion['2'])) {
                            $Usg = is_numeric($singlequestion['3']);
                        } else {
                            echo "Invalid Input given in excel sheet.";
                            exit;
                        }

                        $query_data = array();
                        $query_data[] = "raw_malt =''";
                        $query_data[] = "raw_name ='$question'";
                        if (!empty($qty)) {
                            $query_data[] = "quantity ='$qty'";
                        }
                        if (!empty($Val)) {
                            $query_data[] = "value ='$Val'";
                        }
                        if (!empty($Usg)) {
                            $query_data[] = "per_usg_val ='$Usg'";
                        }
                        $query_data[] = "type ='$type'";
                        $query_data[] = "ins_id ='$insid'";
                        $query_data[] = "cen_id ='$inscid'";
                        $query_data[] = "u_id ='$insuid'";

                        if (!empty($qty) && !empty($Val) && !empty($Usg)) {
                            $query = "INSERT INTO variance SET " . implode(",", $query_data);
                            $this->db->query($query);
                        } else {
                            echo "excel formate not supported";
                            exit;
                        }
                    }
                }
            }
        } else {
            echo "excel formate is not valid";
            exit;
        }
        if ($query) {
            /*             * ***sending mail to the users****** */

            $this->email->from('info@glocalthinkers.com', 'Glocal Thinkers');
            $this->email->to('admin@glocalthinkers.com');
            //$this->email->cc('sachinsheoran28@gmail.com'); 
            $this->email->bcc('sachinsheoran28@gmail.com,sachin.kumar@glocalthinkers.com,pankaj.rana@glocalthinkers.com');
            $sub = 'Variance Update';
            if ($type == 'FVL') {
                $sub = 'Top 10 Food Variance Loss.';
            }
            if ($type == 'FVC') {
                $sub = 'Top 5 Food Variance Gain';
            }
            if ($type == 'FYL') {
                $sub = 'Top 5 Food Yield Loss';
            }
            if ($type == 'FYG') {
                $sub = 'Top 5 Food Yield Gain';
            }
            if ($type == 'PVL') {
                $sub = 'Top 5 Paper Variance Loss';
            }
            if ($type == 'PVG') {
                $sub = 'Top 5 Paper Variance Gain';
            }
            if ($type == 'FC') {
                $sub = 'Food Condiments';
            }
            if ($type == 'PC') {
                $sub = 'Paper Condiments';
            }
            $this->email->subject($sub);
            $this->email->message('Please See The Below Attached File.');
            $url = str_replace('index.php/', '', base_url());
            $this->email->attach($url . 'xls/' . $excel_name);

            if ($this->email->send()) {
                //echo 'mail send';exit;
            } else {
                echo 'mail not send';
                exit;
            }

            /*             * ***end of mail code***** */
            echo "variance data Successfully uploaded";
            exit;
        } else {
            echo "variance data couldn't be uploaded";
            exit;
        }
    }

	function get_inspection_audit($uid, $limit) {
        $this->db->join('users', 'users.id = inspection.insuid');
        $this->db->join('assessors', 'assessors.aid = inspection.insaid');
        $this->db->join('center', 'center.centid = inspection.inscid');
        $this->db->where('inspection.type', 'Inspection');
        $this->db->order_by('insid', 'DESC');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }

        $this->db->where('inspection.insuid', $uid);
        $this->db->where('inspection.ins_delete', 'Y');
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('inspection');
        $result = $query->result_array();
        //echo '<pre/>';print_r($result);exit;
        return $result;
    }
	
	function get_inspection_ques_audit($id) {
        $this->db->join('results', 'results.aid = questions.insid');
        $this->db->where('questions.insid', $id);
        $query = $this->db->get('questions');
        $result = $query->result_array();
		//echo '<pre/>';print_r($result);exit;
        return $result;
    }
}
