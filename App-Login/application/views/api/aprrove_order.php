<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
  $Reffid=$_POST['poreff'];
  $ponum=$_POST['ponum'];
  $status="";
  $rowid=$ponum;
  $company='pick';
  if(isset($_POST['poreff'])){
	$this->db->query("update dev_single_order SET status='0' where Reffrence_id='$Reffid'");
		if($this->db->affected_rows())
		{
			$this->db->query("update dev_orders SET status='0' where po_reffrence='$Reffid' ");
			if($this->db->affected_rows())
		    {
				$status='1';
 $tabledata='';
 $select_order_query="select * from dev_orders where po_reffrence='$Reffid'";
		$select_order_query=$this->db->query($select_order_query);
	   $select_order_query1=$select_order_query->result_array();
	   if($select_order_query1){
		  
	    $total_ex=$select_order_query1[0]['total_ex_vat'];
	    $total_in=$select_order_query1[0]['total_inc_vat'];
		 $supplier_id=$select_order_query1[0]['supplier_id'];
		 	 $business_id=$select_order_query1[0]['business_id'];
			 $instruction=$select_order_query1[0]['instruction'];
			 $orderdescr=$select_order_query1[0]['odrdescrp'];
			  $engineer_id=$select_order_query1[0]['engineer_id'];
	   }else{
		   $total_ex=0; 
		     $total_in=0;
			 $supplier_id=0;
			  $business_id=0;
			  $instruction='No Instruction';
			  $orderdescr='';
			 $engineer_id=0;
	   }
	   if($business_id=='1')
			{
				$company='led';
			}
			if($business_id=='2')
			{
				$company='pick';
			}
			if($business_id=='3') 
			{
				$company='spark';
			}
	  $newvat=$total_in-$total_ex;
	      $select_single_order_query="select * from dev_single_order where Reffrence_id	='$Reffid'";
		$select_single_order_query=$this->db->query($select_single_order_query);
	   $select_single_order_query=$select_single_order_query->result_array();
	   /*************Deliver Or Collection det ******************/
	   if($select_single_order_query[0]['delivery_time']=='0' && $select_single_order_query[0]['delivery_Date']=='0')
	   {
		   $what1='none';
		    $what2='block';
		   $DelorCol='Collection';
		   $DelorColReal=$select_single_order_query[0]['collection_date'];
	   }
	   else
	   {
		   $what1='block';
		   $what2='none';
		   $DelorCol='Delivery';
		   $DelorColReal=$select_single_order_query[0]['delivery_Date'];
		   
	   } 
		 
	   foreach($select_single_order_query as $select_single1)
	   {
		   $product_id=$select_single1['product_id'];
		   $have_product_or_not=$select_single1['variation_id'];
	    $select_product_query=$this->db->query("select * from dev_products where id='$product_id'");
	   $select_product_query=$select_product_query->result_array();
	   if($product_id!='')
	   {
		  $pdescription=$select_product_query[0]['title'];
		  $procode=$select_product_query[0]['product_name'];
	   }
	   else{
		   $pdescription=$select_single1['ProductTitle'];
		  $procode=$select_single1['ProductCode'];
	   }
	  
	   if($have_product_or_not!='0')      //get varition item if have variation
	  {
		 $variation_option_name=$this->db->query("select * from dev_product_variation where id=$have_product_or_not ");
		 $variation_option_name=$variation_option_name->result_array();
 		 $procode=$variation_option_name[0]['pcode'];
		$pdescription=$variation_option_name[0]['description'];
	  }
	  $tabledata .=' 
	  <tr>
	          <td style="text-align: left;padding-top: 10px;">'.$procode.'</td>
			  <td style="text-align:center;padding-top: 10px;">'.$pdescription.'</td>
			  <td style="text-align:center;padding-top: 10px;">'.$select_single1['qty'].'</td>
		      <td style="text-align:center; padding-top: 10px;">£'.$select_single1['ex_vat'].'</td>
			  <td style="text-align:center;padding-top: 10px">'.$select_single1['vat_class'].'%</td>
			  <td  style="text-align:center; padding-top: 10px;">£'.$select_single1['total_ex_vat'].'</td>
	   </tr>';
	   }
	   if($select_single_order_query)
	   {
	 $project_id=$select_single_order_query[0]['project_id'];
	   }
	   else{
		   $project_id=0;
	   }
	 /***************select bussiness details*********************/
	 
		$select_bussiness_details=$this->db->query("select * from dev_business where id	='$business_id'");
	   $select_bussiness_details1=$select_bussiness_details->result_array();
	   if($select_bussiness_details1)
	   {
		   $buisness_image = $select_bussiness_details1[0]['bussiness_logo'];
		   $business_name=$select_bussiness_details1[0]['business_name'];
		   $b_address=$select_bussiness_details1[0]['address'];
		   $b_post_code=$select_bussiness_details1[0]['post_code'];
		   $b_email=$select_bussiness_details1[0]['email'];
	   }
	   else
	   {
		   $business_name='';
		   $b_address='';
		   $b_post_code='';
		   $b_email='';
	   }
	   /*****************supplier******************************/
	    $select_supplier=$this->db->query("select * from dev_supplier where id='$supplier_id'");
		  $select_supplier=$select_supplier->result_array();
		$Project_data=$this->db->query("select * from dev_projects where id='$project_id'");
		  $Project_data=$Project_data->result_array();

$message='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style>td {vertical-align: -webkit-baseline-middle;}</style></head>

  <body style="font-family:lato;font-size:14px; padding:0px;margin:0px;"  >
 
  <table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f4f4f4; padding:20px 10px;">
  <tr>
  <td align="center">
      <table style="border-bottom: 1px dotted #bfbebe;" width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	     <tr> 
		 <td style="width:200px;"><img style="width: 170px;" src="'.trim($buisness_image).'"/></td>
		     
			 <td style="width:200px;">
			    <ul style="
    width: 179px;list-style: none;margin-left: 187px;padding: 12px 12px;">
				  <li>'.$business_name.'</li>
				  <li>'.$b_address .'</li>
				  <li>'.$b_post_code.'</li>
				  <li>'.$b_email.'</li>
				  
			    </ul>
			 </td>
			 </tr>
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
					<td width="400px;"><h3 style="margin-left:14px;font-weight: bold;">PURCHASE ORDER</h3>
						<ul style="list-style:none; padding-left:0px;">
					<li>'.$select_supplier[0]['suppliers_name'].'</li>
		      <li>'.$select_supplier[0]['address'].'</li>
		      <li>'.$select_supplier[0]['suppliers_city'].'</li>
		      <li>'.$select_supplier[0]['post_code'].'</li>
		    
					</ul>
					
					</td>
					<td width="200px;">
					<ul style="list-style:none; padding-left:0px;">
					  <li><b>Purchase Order Date</b></li>
					   <li>'.$select_single_order_query[0]['date'].'</li><br/>
					   <li><b>'.$DelorCol.' Date</b></li>
					   <li>'.$DelorColReal.'</li><br/>
					   <li><b>Account Number</b></li>
					   <li>'.$select_supplier[0]['AccountNumber'].'</li><br/>
					   <li><b>Purchase Order Number</b></li>
					   <li>PO-'.$ponum.'</li>
					   <li><b>Order Description</b></li>
					   <li>'.$orderdescr.'</li><br/>
					   
					  
					 
					</ul>
					
					</td>
			</tr>
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	   <tr>  
	   <th style="border-bottom: 2px solid #000;padding-bottom: 19px;width: 200px;text-align: left;
    padding-top: 33px;width:100px;"> Product Code</th>
	<th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">Description</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">Quantity</th>
		      <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;"> Unit Price</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">VAT</th>
			  <th  style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">Total EX VAT</th>
	   </tr>
	   
	   '.$tabledata.'
	 
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="padding-bottom: 10px;text-align:center; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;">SUBTOTAL</td>
			  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.number_format((float)$total_ex, 2, '.', '').'</td>
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-left: 4px;padding-top: 10px;">TOTAL VAT</td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;">£'. number_format((float)$newvat, 2, '.', '').'</td>
			
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"><b>TOTAL</b></td>
			  <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.number_format((float)$total_in, 2, '.', '').'</td>
	   </tr>
	   
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:100px;display:'.$what1.';">
	
	<tr> <td style="width: 600;"><h2>DELIVERY DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Address</b></li>
					   <li>'.$Project_data[0]['Delivery_Address'].'</li>
					   <li>'.$Project_data[0]['delivery_city'].'</li>
					   <li>'. $Project_data[0]['delivery_postcode'].'</li>
					   
		            </ul>
	   </td>
	  
	   <td width="150px" style="padding-left: 50px;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Instructions</b></li>
					   <li>'. $instruction.'</li>
					 
		            </ul>
	   </td>
	</tr>
	
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:50px;display:'.$what2.';">
	
	<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Collection Address</b></li>
					   <li>'.$select_supplier[0]['suppliers_name'].'</li>
					   <li>'.$select_supplier[0]['address'].'</li>
					   <li>'.$select_supplier[0]['suppliers_city'].'</li>
					    <li>'.$select_supplier[0]['post_code'].'</li>
		            </ul>
	   </td>
	  
	   
	</tr>
	
	</table>
		 </td>
	  </tr>
	  </table>
</body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$to=$select_supplier[0]['email'];
 mail($to,'Purchase Order',$message,$headers);
			}
			else
			{
				$status='0';
			}
		}
		else
		{
			$status='0';
		}
  }
  else{
	 $status='0'; 
  }
		if($status)
		{
			  $mydevices=$this->db->query("select deviceid from dev_users where id='$engineer_id'");
		      $devices=$mydevices->result_array();	
			  $body='Your Order Is Approve';
			  $result = $this->DataModel->send_notification($devices,$body,$company);
			  mail('rohitkumar.scorpsoft@gmail.com','android o approval',$result);
					  /*ios notification****/
			  $myiosdevices=$this->db->query("select iosdeviceid from dev_users where id='$engineer_id'");
		      $iosdevices=$myiosdevices->result_array();	
			  
			  $resultios = $this->DataModel->send_ios_notification($iosdevices,$body);
			   mail('rohitkumar.scorpsoft@gmail.com','android o ios', $resultios);
			echo json_encode(array("statusCode"=>200,"valid"=>true,"message"=>"Order Approve",$result),JSON_FORCE_OBJECT);
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,"message"=>"failed"));
		}    

?>