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
				$Enginner_data=$this->db->query("select * from dev_engineer where id=$id");
				$data=$Enginner_data->result_array();
				if($data)
				{
					echo json_encode(array("statusCode"=>200,'firstname'=>$data[0]['name'],'lastname'=>$data[0]['newlastname'],'DeleveryAddress'=>$data[0]['newDaddress'],'DeleveryCompanyName'=>$data[0]['newDCname'],'DeleveryCompanyAddress'=>$data[0]['newDCaddress'],'DeleveryCompanyCity'=>$data[0]['newDCcity'],'DeleveryCompanyPostcode'=>$data[0]['newDCpostcode'],"valid"=>true));
				}
				else
				{
					echo json_encode(array("statusCode"=>401,"Message"=>"User Not Found","valid"=>false));
				}
	    }
		else
		{
			
				echo json_encode(array("statusCode"=>401,"Message"=>"Engineer Id Is Required","valid"=>false));
		}
?>