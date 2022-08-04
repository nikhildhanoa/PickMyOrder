<?php header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
      header("Access-Control-Allow-Methods: POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $valid = 'invalid';
    $this->load->helper('string');
	
		if(isset($_REQUEST['id']) && isset($_REQUEST['Company_name']) && isset($_REQUEST['First_name']) && isset($_REQUEST['Last_name'])&& isset($_REQUEST['Address_line_1'])&& isset($_REQUEST['Address_line_2'])&& isset($_REQUEST['City']) && isset($_REQUEST['Post_code']))
		{
		
			
				$id = $_REQUEST['id'];       //Get Email
				$data=$this->db->query("select * from dev_engineer_address_list where id='$id'");
            	$isexsist=$data->result_array();
            	if($isexsist)
            	{
				$company_name=$_REQUEST['Company_name'];
				$fname=$_REQUEST['First_name'];
				$lname=$_REQUEST['Last_name'];
				$address1=$_REQUEST['Address_line_1'];
				$address2=$_REQUEST['Address_line_2'];
				$city=$_REQUEST['City'];
				$postcode=$_REQUEST['Post_code'];
			//	$fulladdress=$_REQUEST['fulladdress'];
					$fulladdress=$_REQUEST['Company_name'].','.$_REQUEST['First_name'].','.$_REQUEST['Last_name'].','.$_REQUEST['Address_line_1'].','.$_REQUEST['Address_line_2'].','.$_REQUEST['City'].','.$_REQUEST['Post_code'];
			
				$this->db->where('id', $id); 
				if($address2=='0')
				{
				    $address2='';
				}
				$data=array('first_name'=>$fname,'company_name'=>$company_name,'last_name'=>$lname,'address_one'=>$address1,'address_two'=>$address2,'city'=>$city,'postcode'=>$postcode,'full_address
'=>	$fulladdress);
				
				$status=$this->db->update('dev_engineer_address_list',$data);
				if($this->db->affected_rows())
				{
				    	echo json_encode(array("statusCode"=>200,"Message"=>"Update Successfully","valid"=>true));
				}
				else
				{
				    	echo json_encode(array("statusCode"=>401,"Message"=>"Not Updated","valid"=>false));
				}
    		}
    		else
    		{
    		    	echo json_encode(array("statusCode"=>401,"Message"=>"Id Not Exsist","valid"=>false));
    		    
    		}
	}
	
			
?>