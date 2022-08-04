<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");\
		if(isset($_REQUEST['City']))
		{
			 $PostCode = $_REQUEST['City'];
			if($PostCode=='0')
			{
			 
			$BusidData=$this->db->query("SELECT  dev_business.id, dev_business.city, dev_business.bussiness_logo, dev_business.stripe_publishkey,dev_users.id, dev_users.business ,dev_users.business_id FROM dev_users inner join dev_business on dev_users.business_id=dev_business.id where  dev_business.iswholeapp='1'");
			}
			else
			{
				$BusidData=$this->db->query("SELECT  dev_business.id, dev_business.city, dev_business.bussiness_logo, dev_business.stripe_publishkey,dev_users.id, dev_users.business, dev_users.business_id FROM dev_users inner join dev_business on dev_users.business_id=dev_business.id where dev_business.city='$PostCode' && dev_business.iswholeapp='1'");
			}
			$SingleBusidData=$BusidData->result_array();
			//print_r($SingleBusidData);die;
			
			if($SingleBusidData)  
			{  
				
				echo json_encode(array("statusCode"=>200,'wholselear'=>$SingleBusidData));
		    }
			else
			{
				echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>'No Sealer Found'));
			}  
		}
		else
		{
		echo json_encode(array("statusCode"=>401,"valid"=>false,"Message"=>"Plese Provide a valid city"),JSON_FORCE_OBJECT);
		}
?>

