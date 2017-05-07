<?php

class Vtp_model extends CI_Model {

    function add_new_vtp() {
        $insert_data = array(
            'vchaddress' => $_POST['vchaddress'],
            'firstname' => $_POST['firstname'],
            'city' => $_POST['city'],
            'contryid' => $_POST['contryid'],
            'state' => $_POST['state'],
            'pincode' => $_POST['pincode'],
            'vtp_rep' => $_POST['vtp_rep'],
            'designations' => $_POST['designations'],
            'vtp_rep2' => $_POST['vtp_rep2'],
            'designations2' => $_POST['designations2'],
            'link' => $_POST['link'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'pmobile' => $_POST['pmobile'],
            'pemail' => $_POST['pemail'],
            'plandline' => $_POST['plandline'],
            'body' => $_POST['body'],
            'parent' => '0',
            'admin' => '0',
        );
        //echo '<pre/>';print_r($insert_data);exit;
        if ($this->db->insert('assessors', $insert_data)) {
            $insert_id = $this->db->insert_id();
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);

            if (isset($_POST['vtp_rep'])) {
                $randomString = '';
                for ($i = 0; $i < 8; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $user_dataone = array(
                    'user_name' => $_POST['phone'],
                    'password' => md5($randomString),
                    'pass' => $randomString,
                    'first_name' => $_POST['vtp_rep'],
                    'email' => $_POST['email'],
                    'phone_mobile' => $_POST['phone'],
                    'signup_date' => date("Y-m-d H:i:s"),
                    'status' => $insert_id,
                    'address_street' => $_POST['vchaddress'],
                    'address_city' => $_POST['city'],
                    'address_state' => $_POST['state'],
                    'address_country' => $_POST['contryid'],
                    'address_postalcode' => $_POST['pincode'],
                    'qualification' => $_POST['designations'],
                    'type' => 'C',
                    'industry' => $_POST['body'],
                    'deleted' => 'N',
                    'user_status' => 'A',
                );
                if ($this->db->insert('users', $user_dataone)) {
                    $config['wordwrap'] = FALSE;
                    $config['mailtype'] = 'html';
                    $config['crlf'] = "\r\n";
                    $config['newline'] = "\r\n";
                    $this->email->initialize($config);
                    $from = 'admin@glocalthinkers.in';
                    $fromname = "Glocal thinkers Audit Software";
                    $this->email->from($from, $fromname);
                    $this->email->to($_POST['email']);
                    $this->email->bcc('admin@dealsontips.com');
                    $this->email->subject('New Account created for you');
                    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" /><meta name="apple-mobile-web-app-capable" content="yes" /></head><body style="background-color: #DDDDDD; margin: 0; padding: 10px;">';

                    $message .= '<h3>Hello ' . $_POST['vtp_rep'] . ',</h3>';
                    $message .= '<h4>Your new account is created on our online audit software. As you are a representative of our valuable client ' . $_POST['firstname'] . '</h4>';
                    $message .= '<p>you can login to our online portal by using these details.</p>';
                    $message .= '<p><strong>Mobile App: <a href="https://play.google.com/store/apps/details?id=com.yudi.glocalaudit" target="_blank">Glocal thinkers Audits Application</a></strong> Download this app for video streaming</p>';
                    $message .= '<p><strong>Login URL: <a href="https://www.glocalthinkers.in" target="_blank">Glocal thinkers Audit portal</a></strong></p>';
                    $message .= '<p><strong>Login ID: ' . $_POST['phone'] . '</strong></p>';
                    $message .= '<p><strong>Password: ' . $randomString . '</strong></p>';
                    $message .= '<p></p>';
                    $message .= '<p>Thank you,<br/>Glocal thinkers team';
                    $message .= '</body></html>';
                    $this->email->message($message);
                    $this->email->send();
                }
            }
            if (isset($_POST['vtp_rep2'])) {
                $randomString = '';
                for ($i = 0; $i < 8; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $user_datatwo = array(
                    'user_name' => $_POST['pmobile'],
                    'password' => md5($randomString),
                    'pass' => $randomString,
                    'first_name' => $_POST['vtp_rep2'],
                    'email' => $_POST['pemail'],
                    'phone_mobile' => $_POST['pmobile'],
                    'signup_date' => date("Y-m-d H:i:s"),
                    'status' => $insert_id,
                    'address_street' => $_POST['vchaddress'],
                    'address_city' => $_POST['city'],
                    'address_state' => $_POST['state'],
                    'address_country' => $_POST['contryid'],
                    'address_postalcode' => $_POST['pincode'],
                    'qualification' => $_POST['designations2'],
                    'type' => 'C',
                    'industry' => $_POST['body'],
                    'deleted' => 'N',
                    'user_status' => 'A',
                );
                if ($this->db->insert('users', $user_datatwo)) {
                    $config['wordwrap'] = FALSE;
                    $config['mailtype'] = 'html';
                    $config['crlf'] = "\r\n";
                    $config['newline'] = "\r\n";
                    $this->email->initialize($config);
                    $from = 'admin@glocalthinkers.in';
                    $fromname = "Glocal thinkers Audit Software";
                    $this->email->from($from, $fromname);
                    $this->email->to($_POST['pemail']);
                    $this->email->bcc('admin@dealsontips.com');
                    $this->email->subject('New Account created for you');
                    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" /><meta name="apple-mobile-web-app-capable" content="yes" /></head><body style="background-color: #DDDDDD; margin: 0; padding: 0;">';

                    $message .= '<h3>Hello ' . $_POST['vtp_rep2'] . ',</h3>';
                    $message .= '<h4>Your new account is created on our online audit software. As you are a representative of our valuable client ' . $_POST['firstname'] . '</h4>';
                    $message .= '<p>you can login to our online portal by using these details.</p>';
                    $message .= '<p><strong>Login URL: <a href="https://www.glocalthinkers.in" target="_blank">Glocal thinkers Audit portal</a></strong></p>';
                    $message .= '<p><strong>Login ID: ' . $_POST['pmobile'] . '</strong></p>';
                    $message .= '<p><strong>Password: ' . $randomString . '</strong></p>';
                    $message .= '<p></p>';
                    $message .= '<p>Thank you,<br/>Glocal thinkers team';
                    $message .= '</body></html>';
                    $this->email->message($message);
                    $this->email->send();
                }
            }
            return "Client Successfully added";
        } else {
            return "Client couldn't be added";
        }
    }

    function get_vtp($limit) {
        /* if($this->input->post('search')){
          $search=$this->input->post('search');
          $sql = "SELECT * FROM assessors WHERE assessors.deleted = 'N' AND firstname LIKE '%$search%' LIMIT ".$this->config->item('number_of_rows')." OFFSET $limit";

          }else{
          $sql = "SELECT * FROM assessors LIMIT ".$this->config->item('number_of_rows')." OFFSET $limit";

          }
          $val = $this->db->query($sql);
          if ($val->num_rows()) {
          return $val->result_array();
          } else {
          return "no client found";
          } */


        $this->db->where('assessors.deleted', 'N');
        $this->db->where('assessors.admin', '0');
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $like_data = array(
                'firstname' => addslashes($search)
            );
            $this->db->like($like_data);
        }
        $this->db->order_by("aid", "DESC");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('assessors');
        //echo $this->db->last_query();
        if ($query->num_rows()) {
            return $query->result_array();
        } else {
            return "no client found";
        }
    }

    function get_vtp_count() {
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $like_data = array(
                'firstname' => addslashes($search)
            );
            $this->db->like($like_data);
        }
        $this->db->order_by("aid", "DESC");
        $this->db->where('assessors.deleted', 'N');
        $query = $this->db->get('assessors');
        $result = $query->num_rows();
        return $result;
    }

    function get_vtps($aid) {
        $this->db->where('assessors.deleted', 'N');
        $this->db->where('assessors.aid', $aid);
        $this->db->order_by("assessors.aid", "desc");
        $query = $this->db->get('assessors');
        $result = $query->result_array();
        return $result;
    }

    function edit_vtp($id) {
        $sql = "SELECT * FROM assessors where aid = '" . $id . "'";
        $val = $this->db->query($sql);
        if ($val->num_rows() == 1) {
            return $val->row();
        } else {
            return "no assessor found";
        }
    }

    function update_vtp($id) {
        $data = array(
            'vchaddress' => $_POST['vchaddress'],
            'firstname' => $_POST['firstname'],
            'city' => $_POST['city'],
            'contryid' => $_POST['contryid'],
            'state' => $_POST['state'],
            'pincode' => $_POST['pincode'],
            'vtp_rep' => $_POST['vtp_rep'],
            'designations' => $_POST['designations'],
            'vtp_rep2' => $_POST['vtp_rep2'],
            'designations2' => $_POST['designations2'],
            'link' => $_POST['link'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'pmobile' => $_POST['pmobile'],
            'pemail' => $_POST['pemail'],
            'plandline' => $_POST['plandline'],
            'body' => $_POST['body'],
            'parent' => '0',
            'admin' => '0',
        );

        $this->db->where('aid', $id);
        if ($this->db->update('assessors', $data, $cond)) {
            return "Client Updated successfully";
        } else {
            return "Client couldn't update";
        }
    }

    ////////////////////////////// Videos ///////////////////

    function get_svids($limit, $id) {
        $this->db->join('users', 'users.id = videos.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        if ($this->session->userdata('type') == 'O') {
            $this->db->where('videos.cid', $id);
        }
        if ($this->session->userdata('type') == 'C') {
            $sql = "SELECT center.centid FROM center where center.aid =  $id ";

            $subQuery = $this->db->query($sql);
            $dat = array();
            foreach ($subQuery->result() as $v) {
                $dat[] = $v->centid;
            }
            if (empty($dat)) {
                $this->db->where('videos.cid', -1);
            } else {
                $this->db->where_in('videos.cid', $dat);
            }


            //$this->db->where('videos.cid', $id);
        }
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('videos');
        $result = $query->result_array();
        return $result;
    }

    function get_svids_count($id) {
        $this->db->join('users', 'users.id = videos.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        if ($this->session->userdata('type') == 'O') {
            $this->db->where('videos.cid', $id);
        }
        if ($this->session->userdata('type') == 'C') {
            $sql = "SELECT center.centid FROM center where center.aid =  $id ";

            $subQuery = $this->db->query($sql);
            $dat = array();
            foreach ($subQuery->result() as $v) {
                $dat[] = $v->centid;
            }

            if (empty($dat)) {
                $this->db->where('videos.cid', -1);
            } else {
                $this->db->where_in('videos.cid', $dat);
            }

            //$this->db->where('videos.cid', $id);
        }
        $query = $this->db->get('videos');
        $result = $query->num_rows();
        return $result;
    }

    function upload_video($fileName, $loc, $cid) {
        $d = array();
        $list = explode("-", $loc);
        foreach ($list as $k => $l) {
            $d[$k] = $l;
        }

        $insert_data = array(
            'aid' => $this->session->userdata['id'],
            'cid' => $cid,
            'vid_date' => time(),
            'vid_url' => $fileName,
            'vid_longitude' => $d[1],
            // 'vid_date' => strtotime($list[0]),
            'vid_latitude' => $d[0],
            'deleted_cn' => 'N'
        );
        if ($this->db->insert('videos', $insert_data)) {
            return "Video Successfully added";
        } else {
            return "Video couldn't be saved";
        }
    }

    function list_videos($limit) {

        $this->db->join('users', 'users.id = videos.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        //$cond = 'vid_longitude !="null" AND vid_latitude !="null"';
        //$this->db->where($cond);
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('videos');
        $result = $query->result_array();
        return $result;
    }

    function get_videos_count() {
        $this->db->join('users', 'users.id = videos.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        $query = $this->db->get('videos');
        $result = $query->num_rows();
        return $result;
    }

    function view_video($id) {
        $this->db->join('users', 'users.id = videos.aid');
        $this->db->where('vid', $id);
        $query = $this->db->get('videos');
        $result = $query->row();
        return $result;
    }

    /////////////////////////////// Reports ///////////////


    function get_resultsc($limit, $id) {
        //echo 'hiii'.'<br/>'.$limit.'<br/>'.$id;exit;
        $this->db->where('results.pending', '1');

        if ($this->session->userdata('type') == 'O') {
            $this->db->where('results.cenid', $id);
        }
        if ($this->session->userdata('type') == 'C') {
            $sql = "SELECT center.centid FROM center where center.aid =  $id ";

            $subQuery = $this->db->query($sql);
            $dat = array();
            foreach ($subQuery->result() as $v) {
                $dat[] = $v->centid;
            }


            if (empty($dat)) {
                $this->db->where('results.cenid', -1);
                // $newsql = "SELECT * FROM results  WHERE results.cenid = -1 ";
            } else {
                $this->db->where_in('results.cenid', $dat);
            }

            //$this->db->where('videos.cid', $id);
        }
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }

        $this->db->join('center', 'center.centid = results.cenid');

        $this->db->join('users', 'users.id = results.uid');

        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->order_by('results.rid', "desc");
        $query = $this->db->get('results');
        $result = $query->result_array();
        return $result;
    }

    function get_resultc_count($id) {



        if ($this->session->userdata('type') == 'O') {
            $this->db->where('results.cenid', $id);
        }
        if ($this->session->userdata('type') == 'C') {
            $dat = array();
            $sql = "SELECT center.centid FROM center where center.aid =  $id ";

            $subQuery = $this->db->query($sql);

            foreach ($subQuery->result() as $v) {
                $vals = (int) $v->centid;
                $dat[] = $vals;
            }

            if (empty($dat)) {
                $this->db->where('results.cenid', -1);
            } else {
                $this->db->where_in('results.cenid', $dat);
            }

            //$this->db->where('videos.cid', $id);
        }
        $this->db->join('center', 'center.centid = results.cenid');

        $this->db->join('users', 'users.id = results.uid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->where('results.pending', '1');
        $query = $this->db->get('results');
        $result = $query->num_rows();
        return $result;
    }

    ////////////////////////////////Center //////////////////
    function get_center($limit, $id) {
       
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        
        $this->db->join('users', 'users.id = center.uid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        $this->db->where('center.deleted_cn', 'N');
        $this->db->where('center.parentid', $id);
        $this->db->order_by("center.centid", "desc");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('center');
        $result = $query->result_array();
        //echo $this->db->last_query();exit();
        return $result;
    }

    function get_aid($id) {
        $this->db->where('center.deleted_cn', 'N');
        $this->db->where('center.centid', $id);
        $query = $this->db->get('center');
        $result = $query->row();
        return $result;
    }

    function get_center_count($id) {
        $this->db->join('users', 'users.id = center.uid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->order_by("center.centid", "desc");
        $this->db->where('center.deleted_cn', 'N');
        $this->db->where('center.parentid', $id);
        $query = $this->db->get('center');
        $result = $query->num_rows();
        return $result;
    }

    function list_center($id) {

        $sql = "SELECT * FROM center WHERE centid != $id";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->result_array();
        } else {
            return "no client found";
        }
    }

    function get_cent($cid) {
        $this->db->join('users', 'users.id = center.uid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->where('center.centid', $cid);
        $query = $this->db->get('center');
        $result = $query->row();
        return $result;
    }

    function get_cents($aid) {

        $this->db->join('users', 'users.id = center.uid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->where('center.aid', $aid);
        $this->db->where('center.parentid', '0');
        $this->db->order_by('center.centid', "desc");
        $query = $this->db->get('center');
        $result = $query->result_array();
        return $result;
    }

    function get_subcents($aid) {

        $this->db->join('users', 'users.id = center.uid');
        $this->db->join('assessors', 'assessors.aid = center.aid');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');

            $this->db->like($search_type, $search);
        }
        $this->db->where('center.parentid', $aid);
        $this->db->order_by('center.centid', "desc");
        $query = $this->db->get('center');
        $result = $query->result_array();
        return $result;
    }

    function dropdown_cents($aid, $oid) {
        $this->db->select('centid, center_name, parentid');

        if ($aid != NULL) {
            $this->db->where('aid', $aid);
        }
        if ($oid != NULL) {
            $this->db->where('parentid', $oid);
        }

        $query = $this->db->get('center');

        $batchs = array();

        if ($query->result()) {
            foreach ($query->result() as $batch) {
                $batchs[$batch->centid] = $batch->center_name;
            }

            //return $batchs;
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function update_cent($id) {
        $data = array(
            'aid' => $_POST['aid'],
            'uid' => $_POST['uid'],
            'parentid' => $_POST['parentid'],
            'center_name' => $_POST['center_name'],
            'email' => $_POST['email'],
            'center_address_one' => $_POST['center_address_one'],
            'center_address_city' => $_POST['center_address_city'],
            'center_address_state' => $_POST['center_address_state'],
            'center_address_zip' => $_POST['center_address_zip'],
            'center_phone' => $_POST['center_phone'],
            'center_rep' => $_POST['center_rep'],
            'deleted_cn' => 'N'
        );

        $this->db->where('centid', $id);
        if ($this->db->update('center', $data)) {
            return "client office Updated successfully";
        } else {
            return "client office couldn't update";
        }
    }

    function add_new_center() {
        $insert_data = array(
            'aid' => $_POST['aid'],
            'uid' => $_POST['uid'],
            'parentid' => $_POST['parentid'],
            'center_name' => $_POST['center_name'],
            'email' => $_POST['email'],
            'center_address_one' => $_POST['center_address_one'],
            'center_address_city' => $_POST['center_address_city'],
            'center_address_state' => $_POST['center_address_state'],
            'center_address_zip' => $_POST['center_address_zip'],
            'center_phone' => $_POST['center_phone'],
            'center_rep' => $_POST['center_rep'],
            'deleted_cn' => 'N'
        );
        //echo '<pre/>';print_r($insert_data);exit;
        if ($this->db->insert('center', $insert_data)) {
            return "VTP Center Successfully added";
        } else {
            return "VTP Center couldn't be added";
        }
    }

    ////////////////// Import Sub-Center /////////////

    function import_subcenter($center_name, $iid, $aid) {
		
		//echo "<pre>";print_r($center_name);exit;	
        foreach ($center_name as $key => $singlequestion) {
            if ($key != 0) {

                if ($singlequestion['0'] != '') {
                    $center_name = str_replace('"', '&#34;', $singlequestion['0']);
                    $center_name = str_replace("`", '&#39;', $center_name);
                    $center_name = str_replace("‘", '&#39;', $center_name);
                    $center_name = str_replace("’", '&#39;', $center_name);
                    $center_name = str_replace("â€œ", '&#34;', $center_name);
                    $center_name = str_replace("â€˜", '&#39;', $center_name);
                    $center_name = str_replace("â€™", '&#39;', $center_name);
                    $center_name = str_replace("â€", '&#34;', $center_name);
                    $center_name = str_replace("'", "&#39;", $center_name);
                    $center_name = str_replace("\n", "<br>", $center_name);
                    $center_address_one = str_replace('"', '&#34;', $singlequestion['1']);
                    $center_address_one = str_replace("'", "&#39;", $center_address_one);
                    $center_address_one = str_replace("\n", "<br>", $center_address_one);
                    $center_address_city = $singlequestion['2'];

                    $center_address_state = $singlequestion['3'];

                    $center_address_contry = $singlequestion['4'];

                    $center_address_zip = $singlequestion['5'];

                    $center_phone = $singlequestion['6'];

                    $email = $singlequestion['7'];

                    $center_rep = $singlequestion['8'];

                    $query_data = array();
                    $query_data[] = "center_name='$center_name'";
                    $query_data[] = "parentid=$iid";
                    $query_data[] = "deleted_cn='N'";
                    $query_data[] = "uid='1'";
                    $query_data[] = "aid='$aid'";

                    if (!empty($center_address_one)) {
                        $query_data[] = "center_address_one='$center_address_one'";
                    }
                    if (!empty($center_address_city)) {
                        $query_data[] = "center_address_city='$center_address_city'";
                    }
                    if (!empty($center_address_state)) {
                        $query_data[] = "center_address_state='$center_address_state'";
                    }
                    if (!empty($center_address_contry)) {
                        $query_data[] = "center_address_contry='$center_address_contry'";
                    }
                    if (!empty($center_address_zip)) {
                        $query_data[] = "center_address_zip='$center_address_zip'";
                    }
                    if (!empty($center_phone)) {
                        $query_data[] = "center_phone='$center_phone'";
                    }
                    if (!empty($email)) {
                        $query_data[] = "email='$email'";
                    }
                    if (!empty($center_rep)) {
                        $query_data[] = "center_rep='$center_rep'";
                    }

                    //  $insert_data = array(implode(",", $query_data));


                    $query = "INSERT INTO center SET " . implode(",", $query_data);
                    $this->db->query($query);
                    /* $insert_data = array(
                      'center_name' => $center_name,
                      'center_address_one' => $center_address_one,
                      'aspects' => $Aspects,
                      'center_address_state' => $center_address_state,
                      'center_address_contry' => $center_address_contry,
                      'center_address_zip' => $center_address_zip,
                      'center_phone' => $center_phone,
                      'email' => $email,
                      'center_rep' => $center_rep,
                      'option_D' => $option_D,
                      'option_D_score' => $option_D_Score,
                      'max_score' => $max_score,
                      'insid' => $iid,
                      'deleted' => 'N'
                      );

                      if($query){
                      return "Sub-Center Successfully uploaded";
                      } else {
                      return "Sub-Center couldn't be uploaded";
                      }
                     */
                }
            }
        }//exit;

        if ($query) {
            /* $sql = "update center set further='1' where centid = '" . $iid . "'";
            $this->db->query($sql); */
            return "Sub-Center Successfully uploaded";
        } else {
            return "Sub-Center couldn't be uploaded";
        }
    }

    //////////////// Import Sub-Center /////////////////////
}
