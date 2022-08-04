<?php header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$valid = 'invalid';
$this->load->helper('string');
$bussiness_id = $_REQUEST['bussiness_id'];
		$selected_store = $this->db->query("select * from `dev_stores` where `bussiness`='$bussiness_id'");
		$selectedarray=$selected_store->result_array();
		 if($selected_store->num_rows())
		{
        echo json_encode(array("statusCode"=>200,"Store_data"=>$selectedarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,"message"=>"No Any Store"),JSON_FORCE_OBJECT);
		}   
?>