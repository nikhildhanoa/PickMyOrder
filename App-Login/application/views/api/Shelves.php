<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
	   $GETUSER=$_REQUEST['userid'];
	  
	  $Business=$this->db->query("select * from dev_users where id='$GETUSER'");
	  $Business=$Business->result_array();
	 
	  $user_role=$Business[0]['role'];
	 $fetchpdfs=$Business[0]['business_id'];
	 $emptyarray1=array();
	 
	  if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
		 $Business_id=$this->db->query("select business_id from dev_engineer where user_id='$GETUSER'");
		 $Business_id=$Business_id->result_array();
		 $fetchpdfs=$Business_id[0]['business_id'];
		
		 }
		 //get Shelves with business id 
		 
		  $Shelves_data=$this->db->query("SELECT * FROM `dev_Shelves`where business_id='$fetchpdfs'  order by sort_order");
	      $Shelves_data= $Shelves_data->result_array();
	
		$emptyarray=array();
		
		 
	foreach($Shelves_data as $data)	
	{  
		$shalve_name=$data['shelves_name'];
		$shalve_id=$data['id'];
		
		 //get section with Shelves id 
		
	  $Section_data=$this->db->query(" SELECT * FROM `dev_cetalog_section` where Shelves_id='$shalve_id' order by sort_order");
	  $Section_data= $Section_data->result_array();
	  	  
      	$emptyarray_two=array();  
       foreach($Section_data as $data_two)
		{  
                 
			$id_section=$data_two['id'];
			$section_name=$data_two['section_name'];
			$SectionImage=$data_two['cover_image'];
			
			
			$cat_data=$this->db->query("SELECT id,sectionid,type,url,image_to_display,description FROM `cetalouges` where  sectionid='$id_section' order by sort_order");
	     $cat_data= $cat_data->result_array();
		 
		 
		 // $url='';
	/*	 foreach($cat_data as $cat)
		{    // print_r($cat_data);die;
		
		       if($cat['type'] == 'xlsx' || $cat['type'] == 'xls')
			  {
				  $type="Excel";
			  }
			  elseif($cat['type'] == 'pdf')
			  {
				  $type="pdf";
			  }
			  elseif($cat['type'] == 'doc' || $cat['type'] == 'docx')
			  {
				  $type="msword";
			  }
				elseif($cat['type'] == 'csv')
			  {
				  $type="csv";
			  }
			   else
              {
				   $type="image";
			  }	
			  
			if($url!='')
              $url=$url.','.$cat['url'].'['.$type.']'.$cat['image_to_display'];
			  else $url=$cat['url'].'['.$type.']'.$cat['image_to_display'];
			
			
		}*/
			
		    $emptyarray_two[]=array('id'=>$id_section,'heading'=>$section_name,'SectionImage'=>$SectionImage,'cetalouge'=>$cat_data);	
		}	
		  
				
		array_push($emptyarray,array('id'=>$shalve_id,'heading'=>$shalve_name,'Shelvesdata'=>$emptyarray_two));		
	}	


	if($emptyarray)
	{
		echo json_encode(array("statusCode"=>200,"valid"=>true,'Shelves'=>$emptyarray)); 
	}
	else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		}
		 
?>		 