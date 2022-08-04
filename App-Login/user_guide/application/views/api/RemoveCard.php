<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
		
		if(isset($_REQUEST['id']))
		{
			$CardId=$_REQUEST['id'];
			$data= $this->db->query("select *from dev_PaymentMethod where id='$CardId'");
			if($data->result_array())
			{
				$CardsObj=$this->db->query("delete from dev_PaymentMethod where id='$CardId'");
			  
				if($CardsObj)
				{
					echo json_encode(array("statusCode"=>200,"valid"=>true,'message'=>'Remove Card Successfully '));
				}
				else
				{
					echo json_encode(array("statusCode"=>401,"valid"=>false,'message'=>"No Cards Found"),JSON_FORCE_OBJECT);
				} 
			}
			else
			{
				echo json_encode(array("statusCode"=>401,"valid"=>false,'message'=>"Card Not exsist"),JSON_FORCE_OBJECT);
			}
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,'message'=>"Id Is Required"),JSON_FORCE_OBJECT);
		}
?>