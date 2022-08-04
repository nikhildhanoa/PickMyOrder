<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
  $valid = 'invalid';
  $this->load->helper('string');
//$this->load->library('Email_folder');
  $data=$_REQUEST['cart'];
  
  $data=json_decode($data);
  $data_array=$data->Orderdetails;
  
  $num=count($data_array);  
  $Product_table="dev_products";
  $order_table="dev_orders";
  $Single_order_table="dev_single_order";
  $order=array();
  $total_inc=0;
  $total_ex=0;
  $table_data='';
  $checkPriviousammount=0;
  $refrence_id=rand();
		for($i=0;$i<=$num-1;$i++)
		{
			$product_id=$data_array[$i]->product_id;
			$user_id=$data_array[$i]->user_id;
			$quantity=$data_array[$i]->quantity;
			$supplier_id= $data_array[$i]->supplier_id;
			$project_id= $data_array[$i]->project_id;
			$delivery_time= $data_array[$i]->delivery_time ;
			$delivery_Date= $data_array[$i]->delivery_Date ;
			$collection_date= $data_array[$i]->collection_date;
			$collection_time= $data_array[$i]->collection_time;
			$order_desc= $data_array[$i]->order_desc;
			$delivery_instruction= $data_array[$i]->delivery_instruction;
			$variation_id= $data_array[$i]->variation_id;  //get varition option id
			$single_ex_vat=$data_array[$i]->price;
			$logo_busnes_id=$data_array[$i]->businessidlogo;
			
			
/************************************************set collection and delivery*************************************************/
			if($delivery_Date=='0' && $delivery_time=='0' )
			{
				$what1='none';
				$what2='block';
				$DelorCol='Collection';
				$DelorColReal= $collection_date;
				$DelorColtime=$collection_time;
			}
			else
			{
				$what1='block';
				$what2='none';
				$DelorCol='Delivery';
				$DelorColReal=$delivery_Date;  
				$DelorColtime=$delivery_time;		   
			} 
		              /**************close*****************/
				$single_ex_vat=number_format((float)$single_ex_vat, 2, '.', '');		 
				$total_ex_price=$single_ex_vat*$quantity;
				$total_ex_price=number_format((float)$total_ex_price, 2, '.', '');
				$total_ex=$total_ex+$total_ex_price; //find total price 
				$total_ex=number_format((float)$total_ex, 2, '.', '');
		
		$get_product= $this->db->query("select *from dev_products where id=$product_id");
		$get_product=$get_product->result_array();
		
		foreach($get_product as $single)
		{
		    $procode_new=$single['product_name'];
		    $procode_title_new=$single['title'];
			if($variation_id!='0') // If its variation Pick Inclusive price 
			{
				$variation_option_name=$this->db->query("select * from dev_product_variation where 	id=$variation_id ");
						
				$variation_option_name=$variation_option_name->result_array();
					  
				$total_inc=$total_inc+$variation_option_name[0]['inc_price']*$quantity;
				$procode_new=$variation_option_name[0]['pcode'];
				$procode_title_new=$variation_option_name[0]['description'];
				$total_inc=number_format((float)$total_inc, 2, '.', '');
						
				if($variation_option_name)
				{
					$variation_option_name=$variation_option_name[0]['name'];
				}
				else
				{
					$variation_option_name=0;
				}
			 
			}
			else  // Pick inclusive price from product table
			{
				$variation_option_name=0;
				$total_inc=$total_inc+$single['inc_vat']*$quantity;
				$total_inc=number_format((float)$total_inc, 2, '.', '');
				
			}
			    $total_incFor_current=$single['inc_vat']*$quantity;
				$Qty= $quantity;
				$date=date('d-m-y h:i:s');
				// $time=date("h:i:s");
				$po_reffrence=$refrence_id;
				$status='1';
				$engineer_id= $user_id;
				$insert=array('project_id'=>$project_id,'delivery_time'=>$delivery_time,'delivery_Date'=>$delivery_Date,'collection_date'=>$collection_date,'collection_time'=>$collection_time,'total_ex_vat'=>$total_ex_price,'order_desc'=>$order_desc,'product_id'=>$single['id'],'qty'=>$Qty,'Reffrence_id'=>$po_reffrence,'status'=>'44','ex_vat'=>$single_ex_vat,'	vat_class'=>$single['tax_class'],'variation_option_name'=>$variation_option_name,'variation_id'=>$variation_id ,'date'=>$date,'image'=>$single['products_images']);
				$in=$this->DataModel->insert($Single_order_table,$insert);
		    			
		}
			$table_data .='<tr>  
	   <td style="text-align: left;
    padding-top: 10px;">'.$procode_new.'</td>
	       <td style="text-align:center;padding-top: 10px;">'.$procode_title_new.'</td>
			  <td style="text-align:center;padding-top: 10px;">'.$Qty.'</td>
		      <td style="text-align:center; padding-top: 10px;">£'.$single_ex_vat.'</td>
			  <td style="text-align:center;padding-top: 10px;">'.$single['tax_class'].'%</td>
			  <td  style="text-align:center; padding-top: 10px;">£'.$total_ex_price.'</td>
	   </tr>';
		 }
		 $calemailvat=$total_inc-$total_ex;
		 //Business id of engineer_id
		 
		 $Business_id=$this->db->query("select * from dev_users where id='$engineer_id'");
		 $Business_id=$Business_id->result_array();
		 $user_role=$Business_id[0]['role'];
		 $Busines_id=$Business_id[0]['business_id'];
		
		 if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
		 $Business_id=$this->db->query("select business_id from dev_engineer where user_id='$engineer_id'");
		 $Business_id=$Business_id->result_array();
		 $Busines_id=$Business_id[0]['business_id'];
		 }
		 //Get bussiness details
	  $get_bussiness_details=$this->db->query("select * from dev_business where id='$Busines_id'");
	   $get_bussiness_details1=$get_bussiness_details->result_array();
	   //print_r($get_bussiness_details1);die;
	   //Get Supplier Details
	   $get_Supplier_details=$this->db->query("select * from dev_supplier where id='$supplier_id'");
	   $get_Supplier_details1=$get_Supplier_details->result_array();
	   //Project Details
	   $get_Project_details=$this->db->query("select * from dev_projects where id='$project_id'");
	   $get_Project_details1=$get_Project_details->result_array();
	    $given_project_name=$get_Project_details1[0]['project_name'];
	   //Make Product list to send ina enail
	   
	   
		 if($user_role=='3') // find limit per day
		 {
			$rngid=$this->db->query("select id from dev_engineer where user_id='$engineer_id'");
			$engid=$rngid->result_array();
			$engid=$engid[0]['id'];
			$limit=$this->db->query("select * from dev_engineer_permissions where engineer_id='$engid'");
			$limit=$limit->result_array();
			$SingleOrderlimit=$limit[0]['single_order_limit'];  //single_order_limit 
			$limit=$limit[0]['limit_order_per_day'];  //perday get limit
				
		$today_date=date('d-m-y');
		
		$check_over_Pre_limit=$this->db->query("select total_inc_vat from dev_orders where date LIKE '%$today_date%' && engineer_id='$user_id'");
		$today_number_of_order_inc=$check_over_Pre_limit->result_array();
         foreach($today_number_of_order_inc as $current_number)	
		 {		 
		  $Priviousammount=$current_number['total_inc_vat'];
		  $checkPriviousammount=$checkPriviousammount+$Priviousammount;
		 }
		 $checkPriviousammount=$checkPriviousammount+$total_incFor_current;
		 if($checkPriviousammount<$limit)
		 {
			
			 		
		if($total_inc>$SingleOrderlimit || $total_inc>$limit )  //compair limit 
		{
			$status=1; 
		}
		else
		{
			$status=0; 
		}
		 }
		 else
			{
			 $status=1; 
			
			}
		}
		/*******************make order purchase number*******************/
		$startorder=1;          //comment till monday
		
		$numrows=$this->db->query("SELECT MAX( po_number ) AS max FROM `dev_orders` where business_id='$Busines_id'");
		$numrows=$numrows->result_array();
		$startorder=$numrows[0]['max'];

		$startorder=$startorder+1;
		/*******************make order purchase number*****************
		$numrows=$this->db->query("select * from dev_orders where business_id='$Busines_id'");
		$startorder=$numrows->num_rows();
		$startorder=$startorder+1;
		/*******************close************************************/
		
		/*******************close************************************/
		
		
	   $insert=array('business_id'=>$Busines_id,'total_ex_vat'=>$total_ex,'date'=>$date,'po_reffrence'=>$po_reffrence,'total_inc_vat'=>$total_inc,'status'=>$status,'engineer_id'=>$engineer_id,'supplier_id'=>$supplier_id,'instruction'=>$delivery_instruction,'odrdescrp'=>$order_desc,'givenprojectid'=>$project_id,'givenprojectname'=>$given_project_name,'po_number'=>$startorder);
				$in=$this->DataModel->insert($order_table,$insert);
		        $insert_id_order = $this->db->insert_id();
				$uniqid=$insert_id_order; //change reff id
				$this->DataModel->update($order_table,array('po_reffrence'=>$uniqid),array('po_reffrence'=>$po_reffrence));
				
				
		/*********fetch bussiness logo*******************/
		
		if($logo_busnes_id=='led'){
	$get_logo=$this->db->query("select bussiness_logo from dev_business where id=1");
	
		}
		if($logo_busnes_id=='pick'){
	$get_logo=$this->db->query("select bussiness_logo from dev_business where id=2");
		}
		if($logo_busnes_id=='spark'){
	$get_logo=$this->db->query("select bussiness_logo from dev_business where id=3");
		} 
		$get_logo=$get_logo->result_array();
		$get_logo_=$get_logo[0]['bussiness_logo'];
		
		
		/***************close**********************/		
				
		if($this->db->affected_rows())
		{
	$this->DataModel->update($Single_order_table,array('Reffrence_id'=>$uniqid,'status'=>$status),array('Reffrence_id'=>$po_reffrence));
	if($this->db->affected_rows())
	{
       if($status==0)
	   {
		   //echo "hello";die;
		  $to = $get_Supplier_details1[0]['email'];
        $subject = 'PURCHASE ORDER';
       $from = 'Pick My Order';
		   $message='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style>td {vertical-align: -webkit-baseline-middle;}</style></head>

  <body style="font-family:lato;font-size:14px; padding:0px;margin:0px;"  >
  <table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f4f4f4; padding:20px 10px;">
  <tr>
  <td align="center">
      <table style="border-bottom: 1px dotted #bfbebe;"width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	     <tr> 
		      <td style="width:200px;"><img style="width: 170px;" src="'.trim($get_bussiness_details1[0]['bussiness_logo']).'"/></td>
			 <td style="width:300px;">
			    <ul style="width:179px;list-style:none;margin-left:187px;padding:12px 12px">
				  <li>'.$get_bussiness_details1[0]['business_name'].'</li>
				  <li>'.$get_bussiness_details1[0]['address'].'</li>
				  <li>'.$get_bussiness_details1[0]['post_code'].'</li>
				  <li>'.$get_bussiness_details1[0]['email'].'</li>
			    </ul>
			 </td>
			 </tr>
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
					<td width="400px;"><h3 style="font-weight: bold;">PURCHASE ORDER</h3>
						<ul style="list-style:none; padding-left:0px;">
					
		      <li>'.$get_Supplier_details1[0]['suppliers_name'].'</li>
		      <li>'.$get_Supplier_details1[0]['address'].'</li>
		      <li>'.$get_Supplier_details1[0]['suppliers_city'].'</li>
		      <li>'.$get_Supplier_details1[0]['post_code'].'</li>
		      <li>'.$get_Supplier_details1[0]['email'].'</li>
		     
					</ul>
					
					</td>
					<td width="200px;">
					<ul style="list-style:none; padding-left:0px;">
					  <li><b>Purchase Order Date</b></li>
					   <li>'.$today_date.'</li><br/>
					   <li><b>'.$DelorCol.' Date</b></li>
					   <li>'.$DelorColReal.'</li><br/>
					   <li><b>'.$DelorCol.' Time</b></li>
					   <li>'.$DelorColtime.'</li><br/>
					   <li><b>Account Number</b></li>
					   <li>'.$get_Supplier_details1[0]['AccountNumber'].'</li><br/>
					   <li><b>Purchase Order Number</b></li>
					   <li>PO-'.$startorder.'</li>
					   <li><b>Order Description</b>
					   <li>'.$order_desc.'</li><br/>
					   
					  

					</ul>
					
					</td>
			</tr>
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	   <tr>  
	   <th style="border-bottom: 2px solid #000;padding-bottom: 19px;width: 100px;text-align: left;
    padding-top: 33px;">Product Code</th>
	<th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px">Description</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px">Quantity</th>
		      <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px"> Unit Price</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px">VAT</th>
			  <th  style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">Total EX VAT</th>
	   </tr>
	   
	   <tr>  
	   '.$table_data.'
	   </tr>
	   <tr>  
	   
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="padding-bottom: 10px;text-align:center; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;">Subtotal</td>
			  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.$total_ex.'</td>
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;
    padding-left: 20px;">TOTAL VAT</td>
			 <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.number_format((float)$calemailvat, 2, '.', '').'</td>
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"><b>TOTAL </b></td>
			  <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.$total_inc.'</td>
	   </tr>
	   
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:50px;display:'.$what1.';">
	
	<tr> <td style="width: 600;"><h2>DELIVERY DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Address</b></li>
					   <li>'.$get_Project_details1[0]['Delivery_Address'].'</li>
					   <li>'.$get_Project_details1[0]['delivery_city'].'</li>
					   <li>'.$get_Project_details1[0]['Delivery_Address'].'</li>
					  
		            </ul>
	   </td>
	   
	   <td width="150px" style="padding-left: 50px;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Instructions</b></li>
					   <li>'.$delivery_instruction.'</li>
					  
		            </ul>
	   </td>
	</tr>
	
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display:'.$what2.';">
	
	<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Collection Address</b></li>
					   <li>'.$get_Supplier_details1[0]['suppliers_name'].'</li>
					   <li>'.$get_Supplier_details1[0]['address'].'</li>
					   <li>'.$get_Supplier_details1[0]['suppliers_city'].'</li>
					   <li>'.$get_Supplier_details1[0]['post_code'].'</li>
					   <li>'.$get_Supplier_details1[0]['email'].'</li>
					  
		            </ul>
	   </td>
	   
	  
	</tr>
	
	</table>
	<p style="text-align: left;font-size: 12px; padding-top: 27px;">Company Registration No:SC622115. Registered Office:14 Ballumbie Derive,Dundee,Angus,DD4 0NP   </p>
		 </td>
	  </tr>
	  </table>
  </body>
</html>';

$headers  = "no reply .pickmyorder.co.uk";
//$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		   mail($to,'You Have An Order',$message,$headers);
	   }
		
		if($insert_id_order)
	    {
			if($status=='1')   //send notification to all supervisor of this businees
			{
		    $mydevices=$this->db->query("select deviceid from dev_users where is_supervisor='1' && from_bussi='$Busines_id'");	
			$devices=$mydevices->result_array();
             $body='You have an order to approve';			
			$result = $this->DataModel->send_notification($devices,$body,$logo_busnes_id);
			// send Notifictaion to ios devices if order by ios 
			 $myiosdevices=$this->db->query("select iosdeviceid from dev_users where is_supervisor='1' && from_bussi='$Busines_id'");	
			$iosdevices=$myiosdevices->result_array();
             $body='You have an order to approve';			
			$result2 = $this->DataModel->send_ios_notification($iosdevices,$body);
			
			}
		echo json_encode(array("statusCode"=>200,"valid"=>true,"orderid"=>$startorder,"Limitstatus"=>$status,'result'=>"null"));
		//'result'=>$result
		}
	else
		{
		echo json_encode(array("statusCode"=>401,"valid"=>false));
		}  
	}
}
else
{
 echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
} 


		
?>