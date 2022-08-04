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
	   
	   //$product_id=$_REQUEST['product_id'];
	   $vatcaldata=$this->db->query("select * from dev_orders where po_reffrence='$ref_id'"); 
	   $vatcal=$vatcaldata->result_array();
	   $total_ex_vat=$vatcal[0]['total_ex_vat'];
	   $total_inc_vat=$vatcal[0]['total_inc_vat'];
	   $emptyarray=array();
	   
	  $FetchOrder=$this->db->query("select ProductTitle,variation_option_name,image, ex_vat,date,id,qty from  dev_single_order where Reffrence_id=$ref_id");
	  $FetchOrder=$FetchOrder->result_array();
	
	  
	
	 foreach($FetchOrder as $Single)
	 {
		
		 array_push($emptyarray,array('product_name'=>$Single['ProductTitle'],'variation_option_name'=>$Single['variation_option_name'],'price'=>$Single['ex_vat'],'image'=>$Single['image'],'date'=>$Single['date'],'linenumber'=>$Single['id'],'qty'=>$Single['qty']));
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