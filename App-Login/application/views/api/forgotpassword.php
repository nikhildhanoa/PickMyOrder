<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		$data = file_get_contents("php://input");
		$email = $_REQUEST['email'];
		
		$selected_data = $this->db->query('select * from dev_users where email="'.$email.'"');
		$select_data = $selected_data->result_array();
		
		
		if($select_data)
		{
						$role=$select_data[0]['role'];
						$number=rand();
						$newpassword=$number;
						
						if($role=='3')
						{
							$this->db->query('update dev_users SET password="'.$newpassword.'" where email="'.$email.'" ');
							if($this->db->affected_rows())
							{
								$this->db->query('update dev_engineer SET password="'.$newpassword.'" where email="'.$email.'" ');
								 if($this->db->affected_rows())
								 {
									 mail($email,'password','this is your new password '.$newpassword );
									 echo json_encode(array("statusCode"=>200,"Message"=>"Change Password Successfully"));
								 }
								 else
								 {
									 echo json_encode(array("statusCode"=>400,"Message"=>"Opration failed"));
								 }
							}
							else
								 {
									 echo json_encode(array("statusCode"=>400,"Message"=>"Opration failed"));
								 }
						}
						
			
		}
		else
		{
		
			echo json_encode(array("statusCode"=>401,"valid"=>false,"Message"=>"No User Found"));
		}
?>

