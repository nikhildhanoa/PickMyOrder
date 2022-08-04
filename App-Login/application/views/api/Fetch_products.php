<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
		$userid = $_REQUEST['userid'];
		$selected_cat = $this->db->query('select * from `dev_product_cat` where `userid`="'.$userid.'"  ');
		$total_user_cat=array();
		$arr=array();
		$i=0;
		$category_data = $selected_cat->result_array();
		foreach($category_data as $sdata)
		{
			$total_user_cat[$i]=array($sdata);
			
			 $cat_id=$sdata['id'];
			$selected_sub_cat = $this->db->query('select * from `dev_product_sub_cat` where `id`="'.$cat_id.'"  ');
			$arr[$i]= $selected_sub_cat->result_array();
			$i++;
		
			
			
		
			
			/* $Alldata=array($sdata); */
			
		}
		
		$arrpro=array();
		$j=0; 
	foreach($arr as $pro)
			{
				foreach($pro as $p)
			{
				
				 $pro_id=$p['id'];
				$selected_product = $this->db->query('select * from `super_sub_cat` where `sub_cat`="'.$pro_id.'"  ');
				$arrpro[$j]= $selected_product->result_array(); 
				$j++; 
			}
			}  
			$k=array();
			foreach($total_user_cat as $tuc)
			{
				foreach($tuc as $tucfinal)
			{
				$k[0]=$tucfinal;
				$cat_id=$tucfinal['id'];
				$selected_sub_cat = $this->db->query('select * from `dev_product_sub_cat` where `id`="'.$cat_id.'"  ');
				$selected_sub_cat2=$selected_sub_cat->result_array();
				
				
				
				
                 $k[1]=$selected_sub_cat2[0];
				 $rr=$k[1]['id'];
			     
				 $selected_sub_cat3 = $this->db->query('select * from `super_sub_cat` where `sub_cat`="'.$rr.'"  ');
				
				 $selected_sub_cat4=$selected_sub_cat3->result_array();
				 
				
				$k[2]=$selected_sub_cat4[0];
				$rp='3';
				
				 $selected_sub_cat5 = $this->db->query('select * from `dev_products` where `super_sub_cat_id`="'.$rp.'"  ');
				 
				
				 $selected_sub_cat6=$selected_sub_cat5->result_array();
				$k[3]=$selected_sub_cat6[0];
				
			}
				
			}
			
			
			/* print_r($total_user_cat);
			print_r($arr);
			print_r(print_r($arr)); */
			
			
			
			//$Alldata=array($total_user_cat,$arr,print_r($arr););
	
		 if($selected_cat)
		{
			echo json_encode(array("statusCode"=>200,"data"=>$k),JSON_FORCE_OBJECT);
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>