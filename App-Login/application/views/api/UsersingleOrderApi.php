<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
	   $ref_id=$_REQUEST['ref_id'];
	   $qoutesstatus=$_REQUEST['qoutesstatus'];
	   //$product_id=$_REQUEST['product_id'];
	   $vatcaldata=$this->db->query("select * from dev_orders where po_reffrence='$ref_id'"); 
	   $vatcal=$vatcaldata->result_array();
	   $total_ex_vat=$vatcal[0]['total_ex_vat'];
	   $total_inc_vat=$vatcal[0]['total_inc_vat'];
	   $emptyarray=array();
	   
	  
	  if($qoutesstatus=='1')
	  {
	   $FetchOrder=$this->db->query("select dev_products.title,dev_single_order.variation_option_name,dev_products.products_images, dev_single_order.ex_vat,dev_single_order.date,dev_single_order.id,dev_single_order.qty from  dev_single_order inner join dev_products on dev_single_order.product_id=dev_products.id  where dev_single_order.Reffrence_id=$ref_id && quotes_status='1'");
	  $FetchOrder=$FetchOrder->result_array();
	  }
	  else
	  {
		$FetchOrder=$this->db->query("select dev_products.title,dev_single_order.variation_option_name,dev_products.products_images, dev_single_order.ex_vat,dev_single_order.date,dev_single_order.id,dev_single_order.qty from  dev_single_order inner join dev_products on dev_single_order.product_id=dev_products.id  where dev_single_order.Reffrence_id=$ref_id");  
	  }
	  
	
	 foreach($FetchOrder as $Single)
	 {
		
		 array_push($emptyarray,array('product_name'=>$Single['title'],'variation_option_name'=>$Single['variation_option_name'],'price'=>$Single['ex_vat'],'image'=>$Single['products_images'],'date'=>$Single['date'],'linenumber'=>$Single['id'],'qty'=>$Single['qty']));
	 }
	
	
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'total_ex'=>$total_ex_vat,'total_inc'=>$total_inc_vat,'SingleOrderData'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>