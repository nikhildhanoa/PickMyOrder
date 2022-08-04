<?php header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$valid = 'invalid';
$this->load->helper('string');

		$brands = $this->db->query("select id,business_name,bussiness_logo from `dev_business` where iswholeapp='3'");
		$brands=$brands->result_array();
		
		 if(!empty($brands))
		{
        echo json_encode(array("statusCode"=>200,"brands"=>$brands));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"message"=>"brands not exist"),JSON_FORCE_OBJECT);
		}   
?>