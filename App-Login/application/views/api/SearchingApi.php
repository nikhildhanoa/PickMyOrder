<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');

	   $SearchKey=$_REQUEST['SearchKey'];
	   $userid=$_REQUEST['userid'];
	
		$Business_id=$this->db->query("select * from dev_users where id='$userid'");
		 $Business_id=$Business_id->result_array();
		 $user_role=$Business_id[0]['role'];
		 $Busines_id=$Business_id[0]['business_id'];
		
		  
		 if(isset($_REQUEST['isVan']) && $_REQUEST['isVan']==1)
		 {
			 $van_stock=1;  
		 }
		 else
		 {
			 $van_stock=0; 
		 }
		 
		 if(isset($_REQUEST['Wholesalerid']) )
		 {
			
			  $id=$_REQUEST['Wholesalerid'];
			 
			  $SearchKey=$this->db->query("Select * from dev_products where publish_status='1'  && business_id='$id' &&( product_name LIKE '$SearchKey%' || SKU='$SearchKey' || title LIKE '%$SearchKey%' || description LIKE '$SearchKey%' || searchcat LIKE '$SearchKey%' || searchsubcat LIKE '$SearchKey%' || searchsupercat LIKE '$SearchKey%')");
			  
			  $iswholeapp='1'; 
		 }
		  else if(isset($_REQUEST['brandid']))
		  {
			   $id=$_REQUEST['brandid'];
			   
			    $SearchKey=$this->db->query("Select * from dev_products where publish_status='1'  && business_id='$id' &&( product_name LIKE '$SearchKey%' || SKU='$SearchKey' || title LIKE '%$SearchKey%' || description LIKE '$SearchKey%' || searchcat LIKE '$SearchKey%' || searchsubcat LIKE '$SearchKey%' || searchsupercat LIKE '$SearchKey%')");
				
				$iswholeapp='2';
		  }
		 else
		 {
			
		 if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
			
			 $Business_id=$this->db->query("select business_id from dev_engineer where user_id='$userid'");
			 $Business_id=$Business_id->result_array();
			 $Busines_id=$Business_id[0]['business_id'];
		 }
		  if($userid=='0')   /*if atrdeya guest user ************/
		  { 
			  $Busines_id='16';
		  }
		    $get_bussiness_details=$this->db->query("select stripe_publishkey from dev_business where id='$Busines_id'");
			$get_bussiness_details1=$get_bussiness_details->result_array();
			$publishkey=$get_bussiness_details1[0]['stripe_publishkey'];
			 $iswholeapp='0'; 
	 if($van_stock==0)
	 {
	 
		 $SearchKey=$this->db->query("Select * from dev_products where publish_status='1' && van_stock=$van_stock && business_id='$Busines_id' &&( product_name LIKE '$SearchKey%' || SKU='$SearchKey' || title LIKE '%$SearchKey%' || description LIKE '$SearchKey%' || searchcat LIKE '$SearchKey%' || searchsubcat LIKE '$SearchKey%' || searchsupercat LIKE '$SearchKey%')");
		
	 }
	 
	 else
	{
		   $van_engineer = $this->db->query('select * from dev_van_engineer where engineer_id="'.$userid.'"');
				 $van_engineer = $van_engineer->result_array();
				 $eng_van=$van_engineer[0]['van_id'];
		
		$SearchKey=$this->db->query("Select dev_products.`id`, `list_id`, `copy_in`, `Manufacture`, `super_sub_cat_id`, `sub_categories`, `categories`, `searchcat`, `searchsubcat`, `searchsupercat`, `business_id`, `Tsicode`, `UniqueCodeForImport`, `SKU`, `product_name`, `title`, `description`, `reviews`, `specification`, `price`, `inc_vat`, `ex_vat`, `vat_deductable`, `publish_status`, `tax_class`, `products_images`, `product_image_two`, `pdf_manual`, `pdf_manual2`, `pdf_manual3`, `pdf_manual4`, `pdf_manual5`, `pdf_manual6`, `pdf_name`, `pdf2_name`, `pdf3_name`, `pdf4_name`, `pdf5_name`, `pdf6_name`, `supplier_with_cost`, `AddedFilters`, `dateandtime`, `van_stock`, products_van.`stocklevel`, products_van.`recordlevel`, products_van.`in_stock`, products_van.`toback_instock`,  `main_supplier_id` from dev_products,products_van where dev_products.id= product_id and  publish_status='1' && business_id='$Busines_id' &&( product_name LIKE '$SearchKey%' || SKU='$SearchKey' || title LIKE '%$SearchKey%' || description LIKE '$SearchKey%' || searchcat LIKE '$SearchKey%' || searchsubcat LIKE '$SearchKey%' || searchsupercat LIKE '$SearchKey%') and van_id=$eng_van");
		$iswholeapp='3';
	 }
	
     } 	
	 
	 
	 

// old query//
/* 		   $SearchKey=$this->db->query("Select * from dev_products where product_name LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1'|| SKU='$SearchKey' && business_id='$Busines_id' && publish_status='1'|| title LIKE '%$SearchKey%' && business_id='$Busines_id' && publish_status='1' || description LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1' || searchcat LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1'|| searchsubcat LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1' || searchsupercat LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1' && van_stock=$van_stock");
 */		
 
      

$arr=array('productType' => $iswholeapp);
 $SearchKeyData=$SearchKey->result_array();
  foreach($SearchKeyData as $SearchKeyDataa)
 {
	  $arr2 = $SearchKeyDataa + $arr;
	  $arr3[]=$arr2;
 }  
 
	    
	 /* if($SearchKeyData->num_rows()!=0) */
		 if($arr3)
		{
			for($i=0;$i<count($arr3); $i++)
			{
				$arr3[$i]['van_stock']="$van_stock";
			}
			echo json_encode(array("statusCode"=>200,"valid"=>true,'SearchData'=>$arr3,'publishkey'=>$publishkey)); 
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,"message"=>"no result found"),JSON_FORCE_OBJECT);
		} 
?>