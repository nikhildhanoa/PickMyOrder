<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
  
  $Shelveid=$_REQUEST['Shelveid'];
  
  $Sectionn_data=$this->db->query("SELECT * FROM `dev_cetalog_section`where Shelves_id='$Shelveid' order by sort_order");
  $Sectionn_data= $Sectionn_data->result_array();
  $emptyarray=array();
  foreach($Sectionn_data as $data)
  {
	   
	   $Section_id=$data['id'];
	   
    $catalog_data=$this->db->query("SELECT id,url,type,image_to_display,description FROM `cetalouges` where sectionid='$Section_id' order by sort_order");
  $catalog_data= $catalog_data->result_array();
     /* $url='';
   foreach($catalog_data as $cat)
		{
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
		
		}
 */
	 
  $Section_data2=array('id'=>$data['id'],'heading'=>$data['section_name'],'SectionImage'=>$data['cover_image'],'cetalouge'=>$catalog_data);
 array_push($emptyarray,$Section_data2);   
  }
    
    
	if($emptyarray)
	{
		echo json_encode(array("statusCode"=>200,"valid"=>true,'Shelvesdata'=>$emptyarray)); 
	}
	else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		}
 ?>