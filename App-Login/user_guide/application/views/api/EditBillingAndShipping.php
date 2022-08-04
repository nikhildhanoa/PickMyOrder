<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $valid = 'invalid';
   $type= $_REQUEST['type'];  // 1 for delevery 2 for billing
    $eng_id=$_REQUEST['Enginnerid'];
    $address=$_REQUEST['address'];
    $company_name=$_REQUEST['company_name'];
    $compay_adress=$_REQUEST['company_adress'];
    $company_city=$_REQUEST['company_city'];
    $comapny_postcode=$_REQUEST['company_postcode'];
	$firstName=$_REQUEST['firstName'];
   $lastName=$_REQUEST['lastName'];
	
if(isset($_REQUEST['firstName']) &&isset($_REQUEST['lastName']) && isset($_REQUEST['type']) && isset($_REQUEST['Enginnerid']) && isset($_REQUEST['address']) && isset($_REQUEST['company_name']) && isset($_REQUEST['company_adress']) && isset($_REQUEST['company_city']) && isset($_REQUEST['company_postcode']) )
		{
			
			if($type=='1')
			{
			    	$this->db->query("update dev_engineer set name='$firstName',newlastname='$lastName',newDaddress='$address',newDCname='$company_name',newDCaddress='$compay_adress',newDCcity='$company_city',newDCpostcode='$comapny_postcode' where id=$eng_id");
			    	if($this->db->affected_rows())
			    	{
			    	    echo json_encode(array("statusCode"=>200,"Message"=>"Update success","valid"=>true));
			    	}
			    	else
			    	{
			    	    	echo json_encode(array("statusCode"=>401,"Message"=>"Update failed","valid"=>false));
			    	}
			}
			else
			{
			    	$this->db->query("update dev_engineer set name='$firstName',newlastname='$lastName',	newCaddress='$address',newCname='$company_name',newCaddress='$compay_adress',newCcity='$company_city',newCpostcode='$comapny_postcode' where id=$eng_id");
			    	if($this->db->affected_rows())
			    	{
			    	    	echo json_encode(array("statusCode"=>200,"Message"=>"Update success","valid"=>true));
			    	}
			    	else
			    	{
			    	    	echo json_encode(array("statusCode"=>401,"Message"=>"Update failed","valid"=>false));
			    	}
			}
			
				
				
	    }
		else
		{
				echo json_encode(array("statusCode"=>401,"Message"=>"All Field Is Required","valid"=>false));
		}
?>