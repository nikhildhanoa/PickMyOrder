<?php header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$valid = 'invalid';
$this->load->helper('string');
$user_id = $_REQUEST['user_id'];
		$selected_users = $this->db->query("select id from `dev_users` where `id`='$user_id'");
		//$selected_users=$selected_users->result_array();
		 if($selected_users->num_rows())
		{
        echo json_encode(array("statusCode"=>200,"message"=>"user exist"));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"message"=>"user not exist"),JSON_FORCE_OBJECT);
		}   
?>