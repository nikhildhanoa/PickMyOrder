<?php header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$valid = 'invalid';
$this->load->helper('string');
$userid = $_REQUEST['userid'];
		$selected_user = $this->db->query('select * from `dev_users` where `id`="'.$userid.'"  ');
		$selected_user=$selected_user->result_array();
		 if($selected_user)
		{
	$selected_user=$selected_user[0];
		}
		  if($selected_user)
		{
			echo json_encode(array("statusCode"=>200,"data"=>$selected_user),JSON_FORCE_OBJECT);
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		}   
?>