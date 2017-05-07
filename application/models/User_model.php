<?php

class User_model extends CI_Model {

    function add_new_user() {
        $insert_data = array(
            'user_name' => $_POST['user_name'],
            'password' => md5($_POST['password']),
            'pass' => $_POST['password'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'signup_date' => $_POST['signup_date'],
            'phone_mobile' => $_POST['phone_mobile'],
            'status' => $_POST['status'],
            'address_street' => $_POST['address_street'],
            'address_city' => $_POST['address_city'],
            'address_state' => $_POST['address_state'],
            'address_country' => $_POST['address_country'],
            'address_postalcode' => $_POST['address_postalcode'],
            'qualification' => $_POST['qualification'],
            'type' => $_POST['type'],
            'industry' => $_POST['industry'],
            'deleted' => 'N',
            'user_status' => 'A',
        );
        if ($this->db->insert('users', $insert_data)) {
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

            $message .= '<h3>Hello ' . $_POST['first_name'] . ',</h3>';
            $message .= '<h4>Your new account is created on our online audit software. As you are added as a auditor of our team.</h4>';
            $message .= '<p><strong>Mobile App: <a href="https://play.google.com/store/apps/details?id=com.yudi.glocalaudit" target="_blank">Glocal thinkers Audits Application</a></strong> Download this app for video streaming.</p>';
            $message .= '<p>you can login to our online portal by using these details.</p>';
            $message .= '<p><strong>Login URL: <a href="https://www.glocalthinkers.in" target="_blank">Glocal thinkers Audit portal</a></strong></p>';

            $message .= '<p><strong>Login ID: ' . $_POST['user_name'] . '</strong></p>';
            $message .= '<p><strong>Password: ' . $_POST['password'] . '</strong></p>';
            $message .= '<p></p>';
            $message .= '<p>Thank you,<br/>Glocal thinkers team';
            $message .= '</body></html>';
            $this->email->message($message);
            $this->email->send();
            return "Auditor Successfully added";
        } else {
            return "Auditor couldn't be added";
        }
    }
    function get_users($limit) {
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            if($search_type=="users.first_name") { 
            $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%".$search."%'", NULL, FALSE);
            } else {
            $this->db->like($search_type, "$search"); }
        }
        $this->db->where('users.deleted', 'N');
        $this->db->where('users.status', '0');
        $this->db->order_by("signup_date", "DESC");
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $query = $this->db->get('users');
        //echo $this->db->last_query();exit();
        if ($query->num_rows()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function get_users_count() {
        $this->db->where('users.deleted', 'N');
        $this->db->where('users.status', '0');
        if ($this->input->post('search_type')) {
            $search_type = $this->input->post('search_type');
            $search = $this->input->post('search');
            $this->db->like($search_type, $search);
        }
        $query = $this->db->get('users');
        $result = $query->num_rows();
        return $result;
    }

    function edit_user($id) {
        $sql = "SELECT * FROM users where id = '" . $id . "'";
        $val = $this->db->query($sql);
        if ($val->num_rows() == 1) {
            return $val->row();
        } else {
            return "no auditor found";
        }
    }

    function update_user($id) {
        if ($this->input->post('password') != '') {
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'password' => md5($this->input->post('password')),
                'pass' => $this->input->post('password'),
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'phone_mobile' => $_POST['phone_mobile'],
                'status' => $_POST['status'],
                'address_street' => $_POST['address_street'],
                'address_city' => $_POST['address_city'],
                'address_state' => $_POST['address_state'],
                'address_postalcode' => $_POST['address_postalcode'],
                'qualification' => $_POST['qualification'],
                'type' => $_POST['type'],
                'industry' => $_POST['industry'],
            );
        } else {
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'phone_mobile' => $_POST['phone_mobile'],
                'status' => $_POST['status'],
                'address_street' => $_POST['address_street'],
                'address_city' => $_POST['address_city'],
                'address_state' => $_POST['address_state'],
                'address_postalcode' => $_POST['address_postalcode'],
                'qualification' => $_POST['qualification'],
                'type' => $_POST['type'],
                'industry' => $_POST['industry'],
            );
        }

        $this->db->where('id', $id);
        if ($this->db->update('users', $data)) {
            return "Auditor Updated successfully";
        } else {
            return "Auditor couldn't update";
        }
    }

}
