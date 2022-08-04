<?php header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		$get_super_sub_cat_id = $_REQUEST['supersubcat'];
		$keystatus = $_REQUEST['keystatus'];
	     $isVAn = $_REQUEST['isVan'];
		 $userid= $_REQUEST['userid'];
		 
	  if(isset($_REQUEST['supersubcat']) && isset($_REQUEST['keystatus']) )
	  {
		 $products=array();
	 if($isVAn)
	 {	 
	        $van_engineer = $this->db->query('select * from dev_van_engineer where engineer_id="'.$userid.'"');
				 $van_engineer = $van_engineer->result_array();
				 $eng_van=$van_engineer[0]['van_id'];
				 
		  if($keystatus=='1')
		 {
		
		 $selected_data = $this->db->query("select * ,products_van.in_stock instock from dev_products,products_van where dev_products.id= product_id and  categories='$get_super_sub_cat_id' && publish_status='1' && van_id='$eng_van'");
		 $select_data = $selected_data->result_array();
		 }
		 if($keystatus=='2')
		 {
		 $selected_data = $this->db->query("select *,products_van.in_stock instock from dev_products,products_van where dev_products.id= product_id  and  sub_categories='$get_super_sub_cat_id' && publish_status='1' && van_id='$eng_van'");
		
		 
		 $select_data = $selected_data->result_array();
		 }
		 if($keystatus=='3')
		 {
			  
		 $selected_data = $this->db->query("select *,products_van.in_stock instock from dev_products,products_van where dev_products.id= product_id and super_sub_cat_id='$get_super_sub_cat_id' && publish_status='1' && van_id='$eng_van'");
		 $select_data = $selected_data->result_array();
		 }
		  if($keystatus=='4')
		 {
			  
		 $selected_data = $this->db->query("select *,products_van.in_stock instock from dev_products,products_van where dev_products.id= product_id and super_sub_sub_cat_id='$get_super_sub_cat_id' && publish_status='1' && van_id='$eng_van'");
		 $select_data = $selected_data->result_array();
		 }
	 }
	 else{
		 if($keystatus=='1')
		 {
		
		 $selected_data = $this->db->query("select *, id product_id from dev_products where categories='$get_super_sub_cat_id' && publish_status='1' && van_stock='0'");
		 $select_data = $selected_data->result_array();
		 }
		 if($keystatus=='2')
		 {
		 $selected_data = $this->db->query("select *,id product_id from dev_products where sub_categories='$get_super_sub_cat_id' && publish_status='1' && van_stock='0'");
		
		 
		 $select_data = $selected_data->result_array();
		 }
		 if($keystatus=='3')
		 {
			  
		 $selected_data = $this->db->query("select *,id product_id from dev_products where super_sub_cat_id='$get_super_sub_cat_id' && publish_status='1' && van_stock='0'");
		 $select_data = $selected_data->result_array();
		 }
		 if($keystatus=='4')
		 {
			  
		 $selected_data = $this->db->query("select *, id product_id from dev_products where super_sub_sub_cat_id='$get_super_sub_cat_id' && publish_status='1' && van_stock='0'");
		 $select_data = $selected_data->result_array();
		 }
		 $isVAn='0';
		 
		 
		 
	 }
		foreach($select_data as $select)
		{
			 $pt1='';$pt2='';$pt3='';$pt4='';$pt5='';$pt6='';$pname2='';$pname1=''; 
			if($select['pdf_manual'])
			{
				$ptitle1=explode('/',$select['pdf_manual']);
				$pt1=$ptitle1[5];
				$pname1=$select['pdf_name'];
			}
			if($select['pdf_manual2'])
			{
				$ptitle2=explode('/',$select['pdf_manual2']);
				$pt2=$ptitle2[5];
				$pname2=$select['pdf2_name'];
			}
			if($select['pdf_manual3'])
			{
				$ptitle3=explode('/',$select['pdf_manual3']);
				$pt3=$ptitle3[5];
				$pname3=$select['pdf3_name'];
			}
			if($select['pdf_manual4'])
			{
				$ptitle4=explode('/',$select['pdf_manual4']);
				$pt4=$ptitle4[5];
				$pname4=$select['pdf4_name'];
			}
			if($select['pdf_manual5'])
			{
				$ptitle5=explode('/',$select['pdf_manual5']);
				$pt5=$ptitle5[5];
				$pname5=$select['pdf5_name'];
			}
				if($select['pdf_manual6'])
			{
				$ptitle6=explode('/',$select['pdf_manual6']);
				$pt6=$ptitle6[5];
				$pname6=$select['pdf6_name'];
			}
				if(isset($select['instock']))
			{
				
				$instock=$select['instock'];
			}
			else
			$instock=$select['in_stock'];
			
			$bussinesid=$select['business_id'];
			$get_bussiness_details=$this->db->query("select * from dev_business where id='$bussinesid'"); 
			$get_bussiness_details1=$get_bussiness_details->result_array();
			$publishkey=$get_bussiness_details1[0]['stripe_publishkey'];
			$iswholeapp=$get_bussiness_details1[0]['iswholeapp'];
			
			// 0 means contractor app product/ 1 means wholeapp product/ 2 means brands products / 3 for vanstock
			if($iswholeapp=='0'){$productType='0';}else if($iswholeapp=='1'){$productType='1';}else if($iswholeapp=='3'){$productType='2';}
			if($isVAn){$productType='3';}
		
		
					
			$products[]=array('productType'=>$productType,'WhichBusiness'=>$select['business_id'],'id'=>$select['product_id'],'product_name'=>$select['product_name'],
			'SKU'=>$select['SKU'],
			'title'=>$select['title'],
			'description'=>$select['description'],
			'reviews'=>$select['reviews'],
			'van_stock'=>$isVAn,
			'in_stock'=>$instock,
			'specification'=>$select['specification'],
			'ex_vat'=>preg_replace('/\s+/', '', $select['ex_vat']),
			'inc_vat'=>$select['inc_vat'],
			'products_images'=>$select['products_images'],
			'product_image_two'=>$select['product_image_two'],
			'pdf_manual'=>$select['pdf_manual'],
			'pdf1_title1'=>$pt1,
			'pdf_name'=>$pname1, 
			'pdf_manual2'=>$select['pdf_manual2'],
			'pdf2_title2'=>$pt2,
			'pdf2_name'=>$pname2,
			'pdf_manual3'=>$select['pdf_manual3'],
			'pdf3_title3'=>$pt3,
			'pdf3_name'=>$pt3,
			'pdf_manual4'=>$select['pdf_manual4'],
			'pdf4_title4'=>$pt4,
			'pdf4_name'=>$pt4,
			'pdf_manual5'=>$select['pdf_manual5'],
			'pdf5_title5'=>$pt5,
			'pdf5_name'=>$pt5,
			'pdf_manual6'=>$select['pdf_manual6'],
			'pdf6_title6'=>$pt6,
			'pdf6_name'=>$pt6,
			
			);
			
		}
		//print_r($All_cat_data);
		if($select_data)
		{ 
			
			echo json_encode(array("statusCode"=>200,'products'=>$products ));
		 }
		else
		{
			echo json_encode(array("statusCode"=>401,"Message"=>'No Product Found',"valid"=>false));
		}  
	  }else
	  {
		  			echo json_encode(array("statusCode"=>401,"Message"=>'inserkey',"valid"=>false));
	  }
?>
