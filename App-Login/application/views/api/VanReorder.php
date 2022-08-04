<?php 
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$data = json_decode(file_get_contents('php://input'));



$data=$_REQUEST['ReorderData'];
 
  $data1=json_decode($data); 
  $data_array=$data1->ReorderData;
  $num=count($data_array); 
  

  for($i=0;$i<=$num-1;$i++)
{
	  
	 $product_id=$data_array[$i]->product_Id;
	
	 $order_id=$data_array[$i]->Order_Id;
     $qty=$data_array[$i]->product_Qnty;
	    
	 
	 $reorder=array('product_id'=> $product_id,'order_id'=>$order_id,'qty'=>$qty,);
	 
	 $insetdata=$this->db->insert('dev_product_restock',$reorder);
	 
	 $order_van_id=$this->db->query("select * from dev_orders where id='$order_id'");
	 $van_id_array=$order_van_id->result_array();
	 $van_id=$van_id_array[0]['van_id'];
	 
	 
	 
	 
	 $select_instock="select in_stock,toback_instock,recordlevel from products_van where product_id='$product_id' and van_id=$van_id";
	 $select_instock=$this->db->query($select_instock);
	 $select_instock=$select_instock->result_array();
	 $totalinstock=$select_instock[0]['in_stock']+$qty;
	 $toback_instock=$select_instock[0]['toback_instock'];
	 
	 
	 
	 
	 $toback_instock=$toback_instock-$qty;
	 $com_order=$this->db->query("update products_van set in_stock ='$totalinstock' where product_id='$product_id' and van_id=$van_id");
	 if($com_order && $totalinstock>$select_instock[0]['recordlevel'] ){
		  $updatetoback_instock_product=$this->db->query("update products_van set toback_instock ='$toback_instock' where product_id='$product_id' and van_id=$van_id");
		 
	 }
	 
	 
	 
						 
						
	 
	 
	 
	 
	

}

$order_id=$data_array[0]->Order_Id;
  $order_complete=1;
 

$select_single_order_query="select * from dev_single_order where Reffrence_id='$order_id'";
			$select_single_order_query=$this->db->query($select_single_order_query);
			$select_single_order_query=$select_single_order_query->result_array();
			foreach($select_single_order_query as $select_single){
				 $product_id=$select_single['product_id'];
				 $order_qty=$select_single['qty'];
				
				$get_added_qty=$this->db->query("select sum(qty) qty from dev_product_restock where product_id='$product_id' and order_id='$order_id'");
				$get_added_qty=$get_added_qty->result_array();
				 $added_in_stock=$get_added_qty[0]['qty'];
				
				if($added_in_stock>=$order_qty){
					$order_complete=1;
					
				}
				else{
					$order_complete=0;
					break;
					
				}
				
			}
		
			if($order_complete==1){
				
				$com_order=$this->db->query("update dev_orders set reorder_complete='1' where id ='$order_id'");
				if($com_order)
				{
					$order_complete=1;
				}
				else $order_complete=0;
				
				
			}






if($insetdata)
	{
		echo json_encode(array("statusCode"=>200,"VanStockReorder" => $insetdata,"order_complete"=>$order_complete));
	}
	else
	{
		echo json_encode(array("statusCode"=>400,"message" => 'data not exists'));
	}

?>
