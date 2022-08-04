<?php
 header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input"); */
		$userid = $_REQUEST['userid'];
		$newpass = $_REQUEST['newpass'];
		 print_r($_POST); die;
		$selected_data = $this->db->query('select * from dev_users where id="'.$userid.'"');
		$select_data = $selected_data->result_array();
		
		if($select_data)
		{
		$update_pass = $this->db->query("update dev_users set password='$newpass' where id='$userid'  ");
		$role=$select_data[0]['role'];
		  if($role=='3')
		  {
		   $Insert_pass_in_enginner = $this->db->query('update dev_engineer SET password="'.$newpass.'" where user_id="'.$userid.'" ');
		  }
		}
		
		
		
		 if($this->db->affected_rows()>0)
		  {
	
			echo json_encode(array("statusCode"=>200,'Message'=>'Password Change Successfull'));
		  }
		else
		   {
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		   }   
?>