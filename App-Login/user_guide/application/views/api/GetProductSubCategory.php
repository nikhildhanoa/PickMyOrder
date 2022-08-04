<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
		 $get_cat_id = $_REQUEST['catid'];
		$Next_Status=2;
		$All_sub_cat_data=array();
		 $selected_data = $this->db->query('select * from dev_product_sub_cat where cat_id="'.$get_cat_id .'"');
		$select_data = $selected_data->result_array();
		foreach($select_data as $select)
		{
			$check_sub_sub=$select['id'];
			$check_sub_sub_data = $this->db->query('select * from super_sub_cat
             where sub_cat="'.$check_sub_sub .'"');
		
			if($check_sub_sub_data->num_rows())
			{
				$Next_Status=1;
			}
			else
			{
				$Next_Status=2;
				$check_product=$select['id'];
			    $check_product = $this->db->query('select * from dev_products
                where sub_categories="'.$check_product.'"');
			   
				if($check_product->num_rows())
				{
				$Next_Status=0; //zero means have product on this cat 
				}
				else
				{
					$Next_Status=2;
				}
				
					
				
				
			}
			$All_cat_data[]=array('sub_cat-id'=>$select['id'],'sub_cat-name'=>$select['sub_cat_name'],'cat-image'=>$select['image'],'status'=>$Next_Status);
			
			
		}
		
		if($selected_data->num_rows())
		{ 
			
			echo json_encode(array("statusCode"=>200,'Sub_Category'=>$All_cat_data));
		 }
		else
		{
			echo json_encode(array("statusCode"=>401,'Message'=>'Sub Category Not Found',"valid"=>false));
		}  
?>

