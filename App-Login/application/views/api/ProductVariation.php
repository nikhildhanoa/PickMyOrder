<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		
		 $productsku = $_REQUEST['productid'];
		$products_variation=array(array('option_name'=>'Select','variation_id'=>'0','prise'=>'0'));
		 $selected_data = $this->db->query("select dev_product_variation.id,dev_product_variation.name,dev_product_variation.description,dev_product_variation.price,dev_product_variation.inc_price,option_id,option_name, plaseholder from dev_variation_option inner join dev_product_variation on dev_variation_option.id=dev_product_variation.option_id  where product_id='$productsku'");
		$select_data = $selected_data->result_array();
		
		foreach($select_data as $select)
		{
			$price=number_format((float)$select['price'], 2, '.', '');
			$inc_price=number_format((float)$select['inc_price'], 2, '.', '');
			$products_variation[]=array('variation_id'=>$select['id'],'option_id'=>$select['option_id'],'option_name'=>$select['option_name'],'plaseholder'=>$select['plaseholder'],'name'=>$select['name'],'description'=>$select['description'],'price'=>$price,'inc_price'=>$inc_price);
			
		}
		if($select_data)
		{
			$hasornot=1;
		}
		else
		{
			$hasornot=0;
		}
			
			echo json_encode(array("statusCode"=>200,'Message'=>'Success','hasornot'=>$hasornot,'variation'=>$products_variation ));
		   
?>

