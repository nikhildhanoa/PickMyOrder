<?php header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
      header("Access-Control-Allow-Methods: POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $valid = 'invalid';
     $this->load->helper(array('form','string'));
   
            	$id = $_REQUEST['Enginnerid'];       //Get Email
				$company_name=$_REQUEST['company_name'];
				$fname=$_REQUEST['First_name'];
				$lname=$_REQUEST['Last_name'];
				$address1=$_REQUEST['Address_line_1'];
				$address2=$_REQUEST['Address_line_2'];
				$city=$_REQUEST['City'];
				$postcode=$_REQUEST['Post_code'];
				$fulladdress=$_REQUEST['company_name'].','.$_REQUEST['First_name'].','.$_REQUEST['Last_name'].','.$_REQUEST['Address_line_1'].','.$_REQUEST['Address_line_2'].','.$_REQUEST['City'].','.$_REQUEST['Post_code'];
				$correctaddress="$fulladdress";
				if($address2=='0')
				{
				    $address2='';
				}
	           
			$this->form_validation->set_rules('company_name', 'company_name', 'required');
			$this->form_validation->set_rules('First_name', 'First_name', 'required');
			$this->form_validation->set_rules('Last_name', 'Last_name', 'required');
			$this->form_validation->set_rules('Address_line_1', 'Address_line_1', 'required');
		
			$this->form_validation->set_rules('City', 'City', 'required');
			$this->form_validation->set_rules('Post_code', 'Post_code', 'required');
		//	$this->form_validation->set_rules('fulladdress', 'Address', 'required|is_unique[dev_Engineer_address_list.full_address]');
			  if ($this->form_validation->run() == FALSE) 
			  {
			     	echo json_encode(array("statusCode"=>401,"Message"=>  strip_tags(validation_errors()),"valid"=>false));
			  }
			  else
			  {
			
			   $dataobj=$this->db->query("select * from dev_engineer_address_list where full_address like '%$correctaddress%' ");
			   
			 //  print_r("select * from dev_Engineer_address_list where full_address like '%$correctaddress%' ");die;
				if(!$dataobj->num_rows())
				{
				
    				$data=array('enginnerid'=>$id,'company_name'=>$company_name,'first_name'=>$fname,'last_name'=>$lname,'address_one'=>$address1,'address_two'=>$address2,'city'=>$city,'postcode'=>$postcode,'full_address'=>$fulladdress);
    				$status=$this->db->insert('dev_engineer_address_list',$data);
    				if($status)
    				{
    				    	echo json_encode(array("statusCode"=>200,"Message"=>"Address Store Successfully","valid"=>true));
    				}
    				else
    				{
    				    	echo json_encode(array("statusCode"=>401,"Message"=>"Opration Failed","valid"=>false));
    				}
				}
				else
				{
				    echo json_encode(array("statusCode"=>401,"Message"=>"Address Already exsist","valid"=>false));
				}
			  }
		
			
?>