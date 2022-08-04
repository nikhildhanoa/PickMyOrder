<?php header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
      header("Access-Control-Allow-Methods: POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $valid = 'invalid';
    $this->load->helper('string');
	
		if(isset($_REQUEST['Enginnerid']))
		{
			
			
				$id = $_REQUEST['Enginnerid'];       //Get Email
			
				$dataobj=$this->db->query("select * from dev_engineer_address_list where enginnerid='$id'");
				$data=$dataobj->result_array();
				if($data)
				{
				    	echo json_encode(array("statusCode"=>200,"Message"=>"Get Address Successfully","Address"=>$data,"valid"=>true));
				}
				else
				{
				    	echo json_encode(array("statusCode"=>401,"Message"=>"Nothing Found","valid"=>false));
				}
		}
			
?>