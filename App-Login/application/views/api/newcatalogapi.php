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
	 
	  if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
		 $Business_id=$this->db->query("select business_id from dev_engineer where user_id='$GETUSER'");
		 $Business_id=$Business_id->result_array();
		 $fetchpdfs=$Business_id[0]['business_id'];
		 }
	  $pdfdata=$this->db->query("SELECT DISTINCT dev_cetalog_section.id,dev_cetalog_section.section_name,dev_cetalog_section.cover_image,cetalouges.url,cetalouges.type from dev_cetalog_section INNER JOIN cetalouges on cetalouges.sectionid=dev_cetalog_section.id where dev_cetalog_section.business_id='$fetchpdfs'");
	 $pdfdata= $pdfdata->result_array();
    
	 $emptyarray=array();
	 foreach($pdfdata as $pdf)
	 { 
	   if($pdf['type']=="pdf")
	   {
		   $type="pdf";
	   }
	   else
	   {
		    $type="image";
	   }
	    if(array_search($pdf['id'], array_column($emptyarray, 'id')) !== false)
	    {
                $index=array_search($pdf['id'], array_column($emptyarray, 'id'));
                $pre=$emptyarray[$index]['catalog'];
	            $emptyarray[$index]['catalog']=$pre.",".$pdf['url'].'['.$type;        
        }
        else 
		{
			//explode('.',>$pdf['url']);
           array_push($emptyarray,array('id'=>$pdf['id'],'section_name'=>$pdf['section_name'],'cover_image'=>$pdf['cover_image'],'catalog'=>$pdf['url'].'['.$type));
        }
	
	 }
	
	
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'catalogdata'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>