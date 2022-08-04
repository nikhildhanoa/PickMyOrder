<?php 
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$data = json_decode(file_get_contents('php://input'));


$order_id=$_REQUEST['order_id'];
 $emptyarray=array();

  $FetchOrder=$this->db->query("select product_id,qty,date_time from dev_product_restock where order_id='$order_id'" );
 $FetchOrder=$FetchOrder->result_array();
 
 foreach($FetchOrder as $key) 
 {  
	 $product_id=$key['product_id'];
	 
     $FetchOrdername=$this->db->query("select title from  dev_products where id='$product_id'" );
       $FetchOrdername=$FetchOrdername->result_array();
	  $productname=$FetchOrdername[0]['title'];
	
     array_push($emptyarray,array('productname'=>$productname,'qty'=>$key['qty'],'date_time'=>$key['date_time']));
	
 }
 
if($emptyarray)
	{
		echo json_encode(array("statusCode"=>200,"VanReorder" => $emptyarray));
	}
	else
	{
		echo json_encode(array("statusCode"=>400,"message" => 'data not exists'));
	}
 
 
 
 

 


?>