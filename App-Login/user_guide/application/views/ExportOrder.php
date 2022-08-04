<?php
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=Users.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('PO NUMBER','Product Code','Description','Quantity','Unit Price','VAT','Total EX VAT')); 
   $get_printable_value=$this->db->query("select array_of_ids from checked_id where id='1'");
   $getvalue=$get_printable_value->result_array();
   $allvalues=$getvalue[0]['array_of_ids'];
   $arrayfordata=explode(',',$allvalues);
   $numberofid=count($arrayfordata);
   for($i=1;$i<=$numberofid-1;$i++)
   {
       $select_order_query="select * from dev_orders where po_reffrence='$arrayfordata[$i]'";
   	   $select_order_query=$this->db->query($select_order_query);
   	   $select_order_query1=$select_order_query->result_array();	
       if($select_order_query1)
	   {
   	    $total_ex=$select_order_query1[0]['total_ex_vat'];
   	    $total_in=$select_order_query1[0]['total_inc_vat'];
   		$supplier_id=$select_order_query1[0]['supplier_id'];
   		$business_id=$select_order_query1[0]['business_id'];
   	    $instruction=$select_order_query1[0]['instruction'];
   		$ponumber=$select_order_query1[0]['po_number'];
   	   }
	   else
	   {
   		   $total_ex=0; 
   		   $total_in=0;
   		   $supplier_id=0;
   		   $business_id=0;
   		   $instruction='No Instruction';        
   		   $ponumber=0;
   	   }	   
	$select_single_order_query="select * from dev_single_order where Reffrence_id	='$arrayfordata[$i]'";
    $select_single_order_query=$this->db->query($select_single_order_query);
   	$select_single_order_query=$select_single_order_query->result_array();
   	foreach($select_single_order_query as $select_single)
	{
                 $product_id=$select_single['product_id'];
                  $have_product_or_not=$select_single['variation_id'];
                  $select_product_query=$this->db->query("select * from dev_products where id='$product_id'");
                  $select_product_query=$select_product_query->result_array();
                  $pdescription=$select_product_query[0]['title'];
                  $procode=$select_product_query[0]['product_name'];
                  if($have_product_or_not!='0')      //get varition item if have variation
                  {
                  $variation_option_name=$this->db->query("select * from dev_product_variation where id=$have_product_or_not ");
                  $variation_option_name=$variation_option_name->result_array();
                  $procode=$variation_option_name[0]['pcode'];
                  $pdescription=$variation_option_name[0]['description'];
                  }
				  $procode ; 
                  $pdescription; 
                  $qty=$select_single['qty'];
                  $ex_vat=$select_single['ex_vat']; 
                  $vat_class=$select_single['vat_class'];
                  $total_ex_vat=$select_single['total_ex_vat'];
				  $arr=array($ponumber,$procode,$pdescription,$qty,'£'.$ex_vat.'00',$vat_class.'%','£'.$total_ex_vat.'00');
				  $this->db->query("update checked_id set array_of_ids='' where id='1'");
				  fputcsv($output,$arr);
				  
   }
  }

   ?>
