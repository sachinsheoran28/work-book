<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class RestApi_model extends CI_Model
{
    public function setNotificationToken($os, $token){
        if ($os == '' || $os == 'undefined' || $token == '' || $token == 'undefined') {
            return false;
        } else {
            $query4 = $this->db->query('SELECT * FROM `notificationtoken` WHERE `os`=('.$this->db->escape($os).') AND `token`=('.$this->db->escape($token).')');
            if ($query4->num_rows == 0) {
                $query = $this->db->query('INSERT INTO `notificationtoken`( `os`, `token`) VALUES ('.$this->db->escape($os).','.$this->db->escape($token).')');
                $id = $this->db->insert_id();
            } else {
            }
            if (!$query) {
                return  false;
            } else {
                return  $id;
            }
        }
    }
    
	public function createEnquiry($name, $email, $user, $content, $title){
        $query = $this->db->query('INSERT INTO `webapp_enquiry`( `name`, `email`, `user`,`content`, `title`) VALUES ('.$this->db->escape($name).','.$this->db->escape($email).','.$this->db->escape($user).','.$this->db->escape($content).','.$this->db->escape($title).')');
        $id = $this->db->insert_id();
        if (!$query) {
            return  0;
        } else {
            return  1;
        }
    }
    public function blogIds()
    {
        $query = $this->db->query('SELECT `id` FROM `webapp_blog`')->result();

        return $query;
    }
    public function signUp($username, $email, $password, $dob, $os, $token)
    {
        $password = md5($password);
         $query1=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
				$num=$query1->num_rows();
        if($num == 0)
        {
            $query = $this->db->query('INSERT INTO `user`( `name`, `email`, `password`,`eventnotification`,`photonotification`,`videonotification`,`blognotification`,`dob`,`logintype`,`accesslevel`) VALUES ('.$this->db->escape($username).','.$this->db->escape($email).','.$this->db->escape($password).",'false','false','false','false',".$this->db->escape($dob).",'Email','3')");
            $id = $this->db->insert_id();

            $query4 = $this->db->query('SELECT * FROM `notificationtoken` WHERE `os`=('.$this->db->escape($os).') AND `token`=('.$this->db->escape($token).')');
            if ($query4->num_rows == 0) {
                $query3 = $this->db->query('INSERT INTO `notificationtoken`(`os`,`token`,`user`) VALUES ('.$this->db->escape($os).','.$this->db->escape($token).','.$this->db->escape($id).')');
                $tokenid = $this->db->insert_id();
            } else {
            }

            $newdata = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();
            if (!$query) {
                return false;
            } else {
                return $newdata;
            }
        }
          else
        {
              $newdata=false;
              return $newdata;

        }
    }
    
    public function users(){
        $sql = "SELECT * FROM users WHERE users.deleted = 'N' AND users.status ='0'";
        $val = $this->db->query($sql);
        if ($val->num_rows()) {
            return $val->result();
        } else {
            return false;
        }
    }
    public function signIn($username, $password)
        {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE users.user_name = '" . $username . "' AND users.password = '" . $password . "'";
        $val = $this->db->query($sql);
        if ($val->num_rows() >0 ) {
            return $val->row();
        } else {
            return false;
        }  
        
    }

    function get_checklist($cid,$iid){
        $this->db->join('users','users.id = inspection.insuid');
        $this->db->join('assessors','assessors.aid = inspection.insaid');
        $this->db->join('center','center.centid = inspection.inscid');
       
       $this->db->where('inspection.type','Checklist');
        if($cid != 0){
            $this->db->where('inspection.inscid', $cid);
        }
       $this->db->where('inspection.insuid', $iid);
       $this->db->where('inspection.date <', strtotime(date("m/d/Y h:i A")));
       $this->db->where('inspection.enddate >', strtotime(date("m/d/Y h:i A")));
        $this->db->where('inspection.ins_delete', 'N');
        $val = $this->db->get('inspection');
        $result = $val->result_array();
        
            return $result;       
    }
	
	function get_checklist1($cid,$iid){
		/* $iid = 879;
        $this->db->join('users','users.id = inspection.insuid');
        $this->db->join('assessors','assessors.aid = inspection.insaid');
        $this->db->join('center','center.centid = inspection.inscid');
		$this->db->join('checklist','checklist.insid = inspection.insid');
       
		$this->db->where('inspection.type','Checklist');
        if($cid != 0){
            $this->db->where('inspection.inscid', $cid);
        }
		$this->db->where('inspection.insuid', $iid);
		$this->db->where('inspection.date <', strtotime(date("m/d/Y h:i A")));
		$this->db->where('inspection.enddate >', strtotime(date("m/d/Y h:i A")));
        $this->db->where('inspection.ins_delete', 'N');
        $val = $this->db->get('inspection');
        $result = $val->result_array();  */
		
		$cid = '86'; 
		$iid = '887';
		
		$this->db->join('users','users.id = inspection.insuid');
        $this->db->join('assessors','assessors.aid = inspection.insaid');
        $this->db->join('center','center.centid = inspection.inscid');
		$this->db->join('checklist','checklist.insid = inspection.insid');
       
		$this->db->where('inspection.type','Checklist');
        if($cid != 0){
            $this->db->where('inspection.inscid', $cid);
        }
		$this->db->where('inspection.insuid', $iid);
		$this->db->where('inspection.date <', strtotime(date("m/d/Y h:i A")));
		$this->db->where('inspection.enddate >', strtotime(date("m/d/Y h:i A")));
        $this->db->where('inspection.ins_delete', 'N');
        $val = $this->db->get('inspection');
		//echo $this->db->last_query();
        $result = $val->result_array(); 
		
            return $result;       
    }

    function get_insp($cid,$iid){
       // $this->db->join('users','users.id = inspection.insuid');
        $this->db->join('assessors','assessors.aid = inspection.insaid');
        $this->db->join('center','center.centid = inspection.inscid');
       // $this->db->where('inspection.type !=','Checklist');
        if($cid != 0){
            $this->db->where('inspection.inscid', $cid);
        }
       $this->db->where('inspection.insuid', $iid);
       $this->db->where('inspection.date <', strtotime(date("m/d/Y h:i A")));
       $this->db->where('inspection.enddate >', strtotime(date("m/d/Y h:i A")));
        $this->db->where('inspection.ins_delete', 'N');
        $val = $this->db->get('inspection');
        $result = $val->result_array();
        
            return $result;
			
    }
    function get_addr($cid){
        $this->db->where('center.centid', $cid);
        $val = $this->db->get('center');
         if ($val->num_rows() >0 ) {
            return $val->row();
        } else {
            return false;
        }
    }
    function get_questions($insid){
        $this->db->where('questions.insid', $insid);
        $val = $this->db->get('questions');
         if ($val->num_rows() >0 ) {
            return $val->result_array();
        } else {
            return false;
        }
    }
    
    function get_checklistQes($insid){
        $this->db->where('checklist.insid', $insid);
        $val = $this->db->get('checklist');
         if ($val->num_rows() >0 ) {
			 $result = $val->result_array();
            return $val->result_array();
        } else {
            return false;
        }
    }
    function get_inventryQes($insid){
        $this->db->where('inventory.insid', $insid);
        $val = $this->db->get('inventory');
         if ($val->num_rows() >0 ) {
            return $val->result_array();
        } else {
            return false;
        }
    }
    function get_AssetsQes($insid){
        $this->db->where('assets.insid', $insid);
        $val = $this->db->get('assets');
         if ($val->num_rows() >0 ) {
            return $val->result_array();
        } else {
            return false;
        }
    }
    function upload_result($uid, $aid,$cenid, $qids, $scores, $ip_address, $final_score,$suggestion,$remark, $date, $videos, $images, $final_comment, $lati_longi){
       
                     
        $insert_data = array(
            'uid' => $uid,
            'aid' => $aid,
            'cenid' => $cenid,
            'qids' => $qids,
            'date' => $date,
            'scores' => $scores,
            'ip_address' => $ip_address,
            'final_score' => $final_score,
            'suggestion' => $suggestion,
            'remark' => $remark,
            'videos' => $videos,
            'images' => $images,
            'final_comment' => $final_comment,
            'lati_longi' => $lati_longi,
            'pass'=> '0.00',
            'pending'=> 0
            );
        
       // $this->db->insert('results',$insert_data);
       // return $insert_data;
        
        if($this->db->insert('results',$insert_data)){
            $sqls = "UPDATE inspection SET ins_delete ='Y' WHERE inspection.insid = '".$aid."'";
            $this->db->query($sqls);
 
                return true;
            } else {
                return false;
            }
            
    }
    function upload_checkresult($uid, $aid,$cenid, $qids, $scores, $ip_address, $final_score,$suggestion,$remark, $date, $videos, $images, $final_comment, $lati_longi){
       
                     
        $insert_data = array(
            'uid' => $uid,
            'aid' => $aid,
            'cenid' => $cenid,
            'qids' => $qids,
            'date' => $date,
            'scores' => $scores,
            'ip_address' => $ip_address,
            'final_score' => $final_score,
            'suggestion' => $suggestion,
            'remark' => $remark,
            'videos' => $videos,
            'images' => $images,
            'final_comment' => $final_comment,
            'lati_longi' => $lati_longi,
            'pass'=> '0.00',
            'pending'=> 0
            );
        
       // $this->db->insert('results',$insert_data);
       // return $insert_data;
        
        if($this->db->insert('results_checklist',$insert_data)){
            $sqls = "UPDATE inspection SET ins_delete ='Y' WHERE inspection.insid = '".$aid."'";
            $this->db->query($sqls);
 
                return true;
            } else {
                return false;
            }
            
    }
    
    function upload_Assresult($uid, $aid,$cenid, $qids, $model, $tag, $ip_address, $suggestion,$remark, $date, $images, $final_comment, $lati_longi){
       
                     
        $insert_data = array(
            'uid' => $uid,
            'aid' => $aid,
            'cenid' => $cenid,
            'qids' => $qids,
            'tag' => $tag,
            'model' => $model,
            'date' => $date,
            'ip_address' => $ip_address,
            'suggestion' => $suggestion,
            'remark' => $remark,
            'images' => $images,
            'final_comment' => $final_comment,
            'lati_longi' => $lati_longi,
            'pending'=> 0
            );
        
       // $this->db->insert('results',$insert_data);
       // return $insert_data;
        
        if($this->db->insert('results_assets',$insert_data)){
            $sqls = "UPDATE inspection SET ins_delete ='Y' WHERE inspection.insid = '".$aid."'";
            $this->db->query($sqls);
 
                return true;
            } else {
                return false;
            }
            
    }
    
    function upload_Invresult($uid, $aid,$cenid, $qids, $score, $score2, $ip_address, $suggestion,$remark, $date, $images, $final_comment, $lati_longi){
       
                     
        $insert_data = array(
            'uid' => $uid,
            'aid' => $aid,
            'cenid' => $cenid,
            'qids' => $qids,
            'scores' => $score,
            'scores2' => $score2,
            'date' => $date,
            'ip_address' => $ip_address,
            'suggestion' => $suggestion,
            'remark' => $remark,
            'images' => $images,
            'final_comment' => $final_comment,
            'lati_longi' => $lati_longi,
            'pending'=> 0
            );
        
       // $this->db->insert('results',$insert_data);
       // return $insert_data;
        
        if($this->db->insert('results_inventory',$insert_data)){
            $sqls = "UPDATE inspection SET ins_delete ='Y' WHERE inspection.insid = '".$aid."'";
            $this->db->query($sqls);
 
                return true;
            } else {
                return false;
            }
            
    }
    
    function upload_video($fileName, $loc, $cid,$aid){
        $d = array();
        $list = explode("-",$loc);
        foreach($list as $k => $l){
            $d[$k] = $l;
        }
            
        $insert_data = array(
			'aid' => $aid,
			'cid' => $cid,
            'vid_date' => time(), 
             'vid_url' => $fileName,
            'vid_longitude' => $d[1],
           // 'vid_date' => strtotime($list[0]),
            'vid_latitude' => $d[0],
			'deleted_cn' => 'N'
			);
			if($this->db->insert('videos',$insert_data)){
                return "Video Successfully added";
            } else {
                return "Video couldn't be saved";
            }
        
    }
    
    function get_resultsc($id, $type){
         $this->db->join('users','users.id = results.uid');
        if($type == 'O'){
            $this->db->where('results.cenid', $id);
        }
        if($type == 'C'){
            $sql = "SELECT center.centid FROM center where center.aid =  $id ";
            
            $subQuery = $this->db->query($sql);
            $dat= array();
            foreach($subQuery->result() as $v){
                $dat[]= $v->centid;
            }
            
            $this->db->where_in('results.cenid',implode(',',$dat));
            
           //$this->db->where('videos.cid', $id);
        }
        
        $this->db->join('center','center.centid = results.cenid');
        $this->db->where('results.pending','1');
	     $query = $this->db->get('results');
 	    $result = $query->result_array();
        return $result;
    }

    public function profileSubmit($id, $name, $email, $password, $dob, $contact)
    {
        $password = md5($password);
        $query = $this->db->query('UPDATE `user`
 SET `name` = '.$this->db->escape($name).', `email` = '.$this->db->escape($email).',`password` = '.$this->db->escape($password).',`dob` = '.$this->db->escape($dob).',`contact` = '.$this->db->escape($contact).'
 WHERE id = ('.$this->db->escape($id).')');
        if (!$query) {
            return  0;
        } else {
            return  1;
        }
    }
    public function changePassword($id, $oldpassword, $newpassword, $confirmpassword)
    {
        $oldpassword = md5($oldpassword);
        $newpassword = md5($newpassword);
        $confirmpassword = md5($confirmpassword);
        if ($newpassword === $confirmpassword) {
            $useridquery = $this->db->query('SELECT `id` FROM `user` WHERE `password`=('.$this->db->escape($oldpassword).')');
            if ($useridquery->num_rows() == 0) {
                return 0;
            } else {
                $query = $useridquery->row();
                $userid = $query->id;
                $updatequery = $this->db->query('UPDATE `user` SET `password`=('.$this->db->escape($newpassword).') WHERE `id`=('.$this->db->escape($userid).')');

                return 1;
            }
        } else {
            //            echo "New password and confirm password do not match!!!";
            return -1;
        }
    }
    public function sendNotificationAndroid($title, $message, $image, $icon)
    {
        $query = $this->db->query('SELECT * FROM `config` WHERE `id`=13')->row();
        $gcm = $query->content;
        $query1 = $this->db->query("SELECT * FROM `notificationtoken` WHERE `os`='Android'")->result();
        foreach ($query1 as $row) {
            $token = $row->token;
            $this->chintantable->sendGcm($gcm, $token, $title, $message, $image, $icon);
        }
    }
    public function sendNotificationIos($title)
    {
        $query = $this->db->query('SELECT * FROM `config` WHERE `id`=13')->row();
        $passphase = $query->description;
        $pem = $query->image;
        $query1 = $this->db->query("SELECT * FROM `notificationtoken` WHERE `os`='iOS'")->result();
        foreach ($query1 as $row) {
            $token = $row->token;
            $this->chintantable->sendApns($pem, $passphase, $token, $title);
        }
    }
}
