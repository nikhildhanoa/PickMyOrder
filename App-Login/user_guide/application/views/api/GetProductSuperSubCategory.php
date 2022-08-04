<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
		 $get_sub_cat_id = $_REQUEST['subcat'];
		$Next_Status=2;
		$All_super_sub_cat_data=array();
		 $selected_data = $this->db->query('select * from super_sub_cat where sub_cat="'.$get_sub_cat_id .'"');
		$select_data = $selected_data->result_array();
		foreach($select_data as $select)
		{
			
				$check_product=$select['id'];
			    $check_product = $this->db->query('select * from dev_products
                where super_sub_cat_id="'.$check_product.'"');
			    
				if($check_product->num_rows())
				{
				$Next_Status=0; //zero means have product on this cat 
				}
				else
				{
					$Next_Status=2;
				}
			
			$All_super_sub_cat_data[]=array('super_sub_cat-id'=>$select['id'],'super_sub_cat-name'=>$select['name'],'image'=>$select['image'],'status'=>$Next_Status);
			
			
		}
		//print_r($All_cat_data);
		if($select_data)
		{ 
			
			echo json_encode(array("statusCode"=>200,'Super_Sub_Category'=>$All_super_sub_cat_data));
		 }
		else
		{
			echo json_encode(array("statusCode"=>401,'Message'=>'No Super Sub Category Found',"valid"=>false),JSON_FORCE_OBJECT);
		}  
?>

