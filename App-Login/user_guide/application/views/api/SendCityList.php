<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");\
		if(isset($_REQUEST['userid']))
		{
			 $PostCode = $_REQUEST['userid'];
			
				$BusidData=$this->db->query("SELECT town from dev_towns");
			
			$SingleBusidData=$BusidData->result_array();
			
			
			if($SingleBusidData)
			{  
				
				echo json_encode(array("statusCode"=>200,'CityList'=>$SingleBusidData));
		    }
			else
			{
				echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>'No city Found'));
			}  
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,"Message"=>"Plese Provide a valid PostCode"),JSON_FORCE_OBJECT);
		}
?>

