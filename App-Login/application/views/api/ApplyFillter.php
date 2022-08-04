<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
  if(!empty($_REQUEST['CatId']) && !empty($_REQUEST['FilterItem']))
  {
		$CatId=$_REQUEST['CatId'];
		$FilterItem=$_REQUEST['FilterItem'];
		$sended= json_decode($FilterItem,true);
		$productid=array();
		$filterObject=$this->db->query("select * from dev_products where categories='$CatId'");
		$fillterArray=$filterObject->result_array();
		
		foreach($fillterArray as $singleFillter)
		{
		if($singleFillter['AddedFilters']!='')
		{
		  $ArrayFormData=unserialize($singleFillter['AddedFilters']);
		  foreach($ArrayFormData as $key=>$value)
		  {

			// $value= array_change_key_case(array_map('strtoupper',$value),CASE_UPPER);
			  foreach($value as $innerkey=>$innervalue)
			  {
				 
				  if (array_key_exists($innerkey,$sended))
				  {    
					  $want_to_see = explode(",", $sended[$innerkey]);
						$current_user_can_see = explode(",",$innervalue );
						// Array of common elements:
						$show = array_intersect($want_to_see, $current_user_can_see);
						// If you want it as a string:
						$show_str = implode(",",$show);
						if(!empty($show_str))
						{ 
					         array_push($productid,$singleFillter['id']);
							break 2;
						} 
				  }
			  }
		  }
		}
	}
	if(count($productid))
	{
		$Ids=implode(',',$productid);
		$dataobj=$this->db->query("Select * from dev_products where id in($Ids)");
		$Dataarray=$dataobj->result_array();
		echo json_encode(array("statusCode"=>200,"valid"=>false,'Message'=>"Products found",'products'=>$Dataarray));
	}
	else
	{
		 echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>"No Product Found"),JSON_FORCE_OBJECT);
	}
  }
  else
  {
	  echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>"All Field Require"),JSON_FORCE_OBJECT);
  }
		
		

		  
?>

