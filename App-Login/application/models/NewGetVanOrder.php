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
 // print_r($data_array);die;
  $iswholeseller='block';
  $num=count($data_array);  

  $Product_table="dev_products";
  $order_table="dev_orders";
  $Single_order_table="dev_single_order";
  $order=array();
  $supplier_array=array(); // This will contain all supplier ids to reorder
  $atradeyaarray=array();
  $total_inc=0;
  $total_ex=0;
  $table_data='';
  $checkPriviousammount=0;
  $wholesellerview='none';
  $refrence_id=uniqid(); // we are using for order as welll as for reorder
  $opr="";
  
 
	for($i=0;$i<=$num-1;$i++)
	{
		$user_id=$data_array[$i]->user_id;
		$engineer_id=$user_id;
		$today_date=date('d-m-y');
		$logo_busnes_id=$data_array[$i]->businessidlogo;
				 //Business id of engineer_id
			 
		$Business_id=$this->db->query("select * from dev_users where id='$engineer_id'");
		 $Business_id=$Business_id->result_array();
		$user_role=$Business_id[0]['role'];
		 	
			// Van id for this user
		
			
			$eng_van_id	=$this->db->query("select * from dev_van_engineer,dev_vans where dev_vans.id=van_id and engineer_id='$user_id'");
		 $eng_van_id=$eng_van_id->result_array();
		
			$van_id=$eng_van_id[0]['van_id'];
			$vehicle_registration=$eng_van_id[0]['vehicle_registration'];
			
			 
		
		
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
		   
		
		break;
	}
  
		for($i=0;$i<=$num-1;$i++)
		{
			$product_id=$data_array[$i]->product_id;
			
			$user_id=$data_array[$i]->user_id;
			$quantity=$data_array[$i]->quantity;
			$supplier_id= $data_array[$i]->supplier_id;
			$project_id= $data_array[$i]->project_id;
			//$delivery_time= $data_array[$i]->delivery_time ;
			//$delivery_Date= $data_array[$i]->delivery_Date ;
			//$collection_date= $data_array[$i]->collection_date;
			//$collection_time= $data_array[$i]->collection_time;
			$order_desc= $data_array[$i]->order_desc;
			$delivery_instruction= $data_array[$i]->delivery_instruction;
			$variation_id= $data_array[$i]->variation_id;  //get varition option id
			$single_ex_vat=$data_array[$i]->price;
			$logo_busnes_id=$data_array[$i]->businessidlogo;
			$procode_new=$data_array[$i]->procode;
			$procode_title_new=$data_array[$i]->procode_title_new; 
			$vanstock=$data_array[$i]->vanstock;
			$delcol_query=$this->db->query("select * from  globalsettings where key_name='delivery_collection' ");
			$delcol_res=$delcol_query->result_array();
			$del_col=$delcol_res[0]['key_value'];
			array_push($atradeyaarray,array('productid'=>$product_id,'quy'=>$quantity));
              
             if($del_col == '1') // set to delivery
			 {
				 $datetime = new DateTime('tomorrow');
									$DelorColReal= $datetime->format('d-m-Y');
									
				$what1='block';
				$what2='none';
				
				
			 }
			 else
			 {
				$what1='none';
				$what2='block';	 
			 }
			 
			 
/**************************************set collection and delivery****************************************/

				
				$DelorCol='Delivery';
				/*$DelorColReal=$delivery_Date;  
				$DelorColtime=$delivery_time;*/
				$collect=0;				
			
		              /**************close*****************/
				$single_ex_vat=number_format((float)$single_ex_vat, 2, '.', '');		 
				$total_ex_price=$single_ex_vat*$quantity;
				$total_ex_price=number_format((float)$total_ex_price, 2, '.', '');
				$total_ex=$total_ex+$total_ex_price; //find total price 
				$total_ex=number_format((float)$total_ex, 2, '.', '');
	if($product_id!=0)
	{	
		
		$get_product= $this->db->query("select *,products_van.in_stock van_in_stock,products_van.stocklevel van_stocklevel, products_van.toback_instock van_toback_instock, products_van.recordlevel van_recordlevel from dev_products, products_van where dev_products.id=product_id and dev_products.id=$product_id and van_id=$van_id");
		$get_product=$get_product->result_array();
		
		

		foreach($get_product as $single)
		{    
           /*************supplier id from dev_products*********/		
		    
			/**********************/
		    $procode_new=$single['product_name'];
		    $procode_title_new=$single['title'];
			$taxclass=$single['tax_class'];
/***********************************************************/
         $in_stock=$single['van_in_stock'];
         $in_stock=$in_stock-$quantity;
		 
		 $procode_stocklevel=$single['van_stocklevel'];
		 
		$toback_instock=$single['van_toback_instock'];
				

		$willbe_instock=$in_stock+$toback_instock;
		 
		 $procode_reorder_value=$procode_stocklevel-$willbe_instock;
		 
		 $reorder_level=$single['van_recordlevel'];
		 
		 
		 
		 $this->db->query("UPDATE products_van SET in_stock='$in_stock' WHERE product_id='$product_id' and van_id=$van_id");
		
		 if($reorder_level >=$willbe_instock ){
			
         	
				$main_supplier_id=$single['main_supplier_id'];
				
				$supplier_with_cost=$single['supplier_with_cost'];
				$supplier_with_cost_array=explode(',',$supplier_with_cost);
				$number_of_keys=count($supplier_with_cost_array);
				for($j=0;$j<$number_of_keys;$j++)
				{	$SupplierCostArray=explode('=>',$supplier_with_cost_array[$j]);
					if(count($SupplierCostArray)>1)
					{
						if($SupplierCostArray[0]==$main_supplier_id){
						 
							$supplier_Cost=$SupplierCostArray[1];
							break;
						}
					}
				}
				
				
				if(!in_array($main_supplier_id,$supplier_array)){
					$supplier_array[]=$main_supplier_id;
				
					
				}
				
				
				$mail=$this->db->query("select * from dev_supplier where id='$main_supplier_id'");
				$mail=$mail->result_array();
				
		
				
                $status_sup=0;				
                $supplier_email=$mail[0]['email'];
				$supplier_accno=$mail[0]['AccountNumber'];
					     
		        
				
				
               $total_supplier_Cost=$procode_reorder_value*$supplier_Cost;				
				
		 $temp_order_details=array('product_id'=>$product_id,'supplier_id'=>$main_supplier_id,'qty'=>$procode_reorder_value,'ProductTitle'=>$procode_title_new,'ProductCode'=>$procode_new,'ex_vat'=>$supplier_Cost,'date'=>$today_date,'reffrence_id'=>$refrence_id,'order_desc'=>$order_desc,'variation_option_name'=>$variation_option_name,'total_ex_vat'=>$total_supplier_Cost,'vat_class'=>$taxclass,'image'=>$single['products_images'],'status'=>$status_sup,'supplier_email'=>$supplier_email,'supplier_acc'=>$supplier_accno);
		
			$this->db->insert('temp_reorder_details',$temp_order_details); 
					
		// this has to be sent in email
		
			$this->db->query("update products_van set toback_instock= '$procode_reorder_value' WHERE product_id='$product_id' and van_id=$van_id");
			
			
		       
		 
            
		 }
		
/*********************************************************/
			
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
				
				$insert=array('project_id'=>$project_id,'total_ex_vat'=>$total_ex_price,'order_desc'=>$order_desc,'product_id'=>$single['id'],'qty'=>$Qty,'Reffrence_id'=>$po_reffrence,'status'=>'44','ex_vat'=>$single_ex_vat,'	vat_class'=>$taxclass,'variation_option_name'=>$variation_option_name,'variation_id'=>$variation_id ,'date'=>$date,'image'=>$single['products_images'],'ProductTitle'=>$procode_title_new,'ProductCode'=>$procode_new,'van_stock'=>$vanstock);
				if(isset($DelorColReal))
				{
					$insert['delivery_Date']=$DelorColReal;
					
				}
				$in=$this->DataModel->insert($Single_order_table,$insert);
		    			
		}
		}else
		{
					
					$variation_option_name=0;
					$taxclass=20;
					$appproductvat=$single_ex_vat*20;
					$newprice=$appproductvat/100;
					$appproductINCvat=$single_ex_vat+$newprice;
					
					$total_inc=$total_inc+$appproductINCvat*$quantity;
					$total_inc=number_format((float)$total_inc, 2, '.', '');
					$total_incFor_current=$appproductINCvat*$quantity;
					$Qty= $quantity;
					$date=date('d-m-y h:i:s');
					// $time=date("h:i:s");
					$po_reffrence=$refrence_id;
					$status='1';
					$engineer_id= $user_id;
					$insert=array('project_id'=>$project_id,'total_ex_vat'=>$total_ex_price,'order_desc'=>$order_desc,'qty'=>$Qty,'Reffrence_id'=>$po_reffrence,'status'=>'44','ex_vat'=>$single_ex_vat,'vat_class'=>$taxclass,'variation_option_name'=>$variation_option_name,'variation_id'=>$variation_id ,'date'=>$date,'van_stock'=>$vanstock,'image'=>'http://app.pickmyorder.co.uk/images/applogo/pickapp.png','ProductTitle'=>$procode_title_new,'ProductCode'=>$procode_new,'delivery_Date'=>$DelorColReal);
					$in=$this->DataModel->insert($Single_order_table,$insert);
		}


				$table_data .='<tr>  
		   <td style="text-align: left;
		padding-top: 10px;">'.$procode_new.'</td>
			   <td style="text-align:center;padding-top: 10px;">'.$procode_title_new.'</td>
				  <td style="text-align:center;padding-top: 10px;">'.$Qty.'</td>
				  <td style="text-align:center; padding-top: 10px;">£'.$single_ex_vat.'</td>
				  <td style="text-align:center;padding-top: 10px;">'.$taxclass.'%</td>
				  <td  style="text-align:center; padding-top: 10px;">£'.$total_ex_price.'</td>
		   </tr>';
			 }
			 $calemailvat=$total_inc-$total_ex;
			
	
		   //Get Supplier Details
		   $get_Supplier_details=$this->db->query("select * from dev_supplier where id='$supplier_id'");
		   $get_Supplier_details1=$get_Supplier_details->result_array();
		   
		   //Make Product list to send ina enail
		   
		  
			 if($user_role=='3') // find limit per day
			 {
				$rngid=$this->db->query("select * from dev_engineer where user_id='$engineer_id'");
				$engdata=$rngid->result_array();
				
				$engid=$engdata[0]['id'];
				$customer_name=$engdata[0]['name'];
				$Engineer_email=$engdata[0]['email'];
				
				$limit=$this->db->query("select * from dev_engineer_permissions where engineer_id='$engid'");
				$limit=$limit->result_array();
				if($limit[0]['Operative']=='1')
				{
					$opr='Operative'; //set oprative 
				}	
                else
                {
					$opr=''; //set oprative
				}
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
			
			//Project Details
		   if($project_id!='0' && $supplier_id!='0')  //if whoseller user then no need of project
		   {
		   $get_Project_details=$this->db->query("select * from dev_projects where id='$project_id'");
		   $get_Project_details1=$get_Project_details->result_array();
			$given_project_name=$get_Project_details1[0]['project_name'];
		   }
		   else if($project_id!='0' && $supplier_id=='0')
		   {
			    $get_Project_details=$this->db->query("select * from dev_projects where id='$project_id'");
				$get_Project_details1=$get_Project_details->result_array();
				$given_project_name=$get_Project_details1[0]['project_name'];
				
				 
		   }
		   else
		   {
			   $given_project_name='Default Delivery';
			   $get_Project_details1[0]['Delivery_Address']= $engdata[0]['newDaddress'];
				 $get_Project_details1[0]['delivery_city']= $engdata[0]['newDCcity'];
				 $get_Project_details1[0]['post_code']= $engdata[0]['newDCpostcode'];
		   }
			                        /*********make order purchase number***********/
			$startorder=1;          //comment till monday
			
			$numrows=$this->db->query("SELECT MAX( po_number ) AS max FROM `dev_orders` where business_id='$Busines_id'");
			$numrows=$numrows->result_array();
			 $startorder=$numrows[0]['max'];
			

			$startorder=$startorder+1;     
			/*******************make order purchase number*****************/
			$numrows=$this->db->query("select * from dev_orders where business_id='$Busines_id'");
			$startorder=$numrows->num_rows();
			$startorder=$startorder+1;
			 $date=date('d-m-y h:i:s');
			
		   $insert=array('business_id'=>$Busines_id,'total_ex_vat'=>$total_ex,'date'=>$date,'po_reffrence'=>$po_reffrence,'total_inc_vat'=>$total_inc,'status'=>0,'engineer_id'=>$engineer_id,'instruction'=>$delivery_instruction,'odrdescrp'=>$order_desc,'givenprojectid'=>$project_id,'givenprojectname'=>$given_project_name,'po_number'=>$startorder,'van_stock'=>$vanstock,'Transaction_id'=>'none','payment_status'=>'none','van_id'=>$van_id);
					$in=$this->DataModel->insert($order_table,$insert);  
					$insert_id_order = $this->db->insert_id();
					$uniqid=$insert_id_order; //change reff id
					$this->DataModel->update($order_table,array('po_reffrence'=>$uniqid),array('po_reffrence'=>$po_reffrence));
					$atrdata=json_encode(array("details"=>$atradeyaarray));
					
					   //send order to atradeya
					  $curl = curl_init();
					  curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://atradeya.co.uk/ordertest.php",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => "sender=$engineer_id&order=$atrdata&paymentstaus=2&projectid=$project_id&collection=$collect&orderdes=$order_desc&instruction=$delivery_instruction&payment_id=$charge_id",
					  CURLOPT_HTTPHEADER => array(
						"cache-control: no-cache",
						"content-type: application/x-www-form-urlencoded",
						"postman-token: 2c70ac29-9dd9-4f02-08af-c0f0f3da3a1b"
					  ),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);
				
					
			if($this->db->affected_rows())
			{
		$this->DataModel->update($Single_order_table,array('Reffrence_id'=>$uniqid,'status'=>$status),array('Reffrence_id'=>$po_reffrence));
		if($this->db->affected_rows())
		{
		   if($status==0)
		   {
			   //echo "hello";die;
			  $to = $get_Supplier_details1[0]['email'];
		 if($supplier_id=='0') //if this order placed by a wholesaller engineer then hide supplier ans send mail to wholslr
		  {
				 $iswholeseller='none';
				 $wholesellerview='block';
				 $wholeaddress=$this->db->query("select email from dev_users where business_id='$Busines_id' AND permission_wholeseller='1'");
				 $wholeaddressData=$wholeaddress->result_array();
				 if($wholeaddressData)
				 {
				 $to=$wholeaddressData[0]['email'];
				 }
		  }     
			$subject = 'VAN STOCK PURCHASE ORDER'; 
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
					<ul style="width:179px;list-style:none;margin-left:187px;padding:12px 12px;display:'.$iswholeseller.'">
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
						<td  width="400px;"><h3 style="font-weight: bold;"> VAN STOCK PURCHASE ORDER</h3>
							<ul style="list-style:none; padding-left:0px;display:'.$iswholeseller.'">
						
				  <li>'.$get_Supplier_details1[0]['suppliers_name'].'</li>
				  <li>'.$get_Supplier_details1[0]['address'].'</li>
				  <li>'.$get_Supplier_details1[0]['suppliers_city'].'</li>
				  <li>'.$get_Supplier_details1[0]['post_code'].'</li>
				  <li>'.$get_Supplier_details1[0]['email'].'</li>
				 
						</ul>
						<ul style="list-style:none; padding-left:0px;display:'.$wholesellerview.'">
				 <li><b>From</b></li>	
				  <li>'.$get_bussiness_details1[0]['business_name'].'</li>
				  <li>'.$get_bussiness_details1[0]['address'].'</li>
				  <li>'.$get_bussiness_details1[0]['post_code'].'</li>
				  <li>'.$get_bussiness_details1[0]['city'].'</li>
				 
				 
						</ul>
						
						</td>
						<td width="200px;">
						<ul style="list-style:none; padding-left:0px;">
						  <li style="padding-bottom: 5px;"><b>Purchase Order Date</b></li>
						   <li style="padding-bottom: 5px;">'.$today_date.'</li>';
						   if($what1=='block'){
							   

								$message=$message.'<li style="padding-bottom: 5px;"><b>'.$DelorCol.' Date</b></li><li style="padding-bottom: 5px;">'.$DelorColReal.'</li>';	
						   }
						   
						   
						   $message=$message.'
						   
						   <li style="padding-bottom: 5px;"><b>Account Number</b></li>
						   <li style="padding-bottom: 5px;">'.$supplier_acc.'</li>
						   <li style="padding-bottom: 5px; display:'.$wholesellerview.'";>'.$engdata[0]['newaccnumber'].'</li>
						   <li style="padding-bottom: 5px;"><b>Purchase Order Number</b></li>
						   <li style="padding-bottom: 5px;">PO-'.$startorder.'</li>
						    <li style="padding-bottom: 5px; display:'.$wholesellerview.'"><b>Oprative Name</b></li>
						   <li style="padding-bottom: 5px; display:'.$wholesellerview.'">'.$engdata[0]['user_name'].'</li>
						   <li style="padding-bottom: 5px;"><b>Order Description</b>
						   <li style="padding-bottom: 5px;">'.$order_desc.'</li>
					
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
						  <li>'.$get_bussiness_details1[0]['business_name'].'</li>
					  <li>'.$get_bussiness_details1[0]['address'].'</li>
					  <li>'.$get_bussiness_details1[0]['post_code'].'</li>
					  <li>'.$get_bussiness_details1[0]['email'].'</li>
						  
						</ul>
		   </td>
		   
		   <td width="150px" style="padding-left: 50px;" >
						<ul style="list-style:none; padding-left:0px;">
						   <li><b>Delivery Instructions</b></li>
						   <li>Please deliver items</li>
						  
						</ul>
		   </td>
		</tr>
		
		</table>
		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display:'.$what2.';">
		
		<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
		<tr> 
		   <td style="display:'.$iswholeseller.'" width="200px"  style="border-right: 1px solid #d8d4d4;" >
						<ul style="list-style:none; padding-left:0px;">
						   <li><b>Collection Instructions</b></li>
						   <li>Our engineer will pick these up </li>
						  
						  
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

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers  = 'Content-type: text/html; charset=UTF-8' . "\r\n";
			 // mail($to,'You Have An Order',$message,$headers);
			 //  mail("nikhil.scorpsoft@gmail.com",'You Have An Order',$message,$headers);
		   }
		    
			
			if($insert_id_order)
			{
				
				
				/* Insert reorder in order table -------------------------------------------------------------- */
					if(!empty($supplier_array)){
						
					foreach($supplier_array as $key=>$value)
					{
						
						$results=$this->db->query("select * from `temp_reorder_details` where supplier_id=$value and reffrence_id='$refrence_id'");
						$results=$results->result_array();
						$inclusive_vat=0;
						$total_price_ex_vat=0;
						$table_data='';
						
						
						foreach($results as $results_data) 
						{   
							
							
							$vat_class=$results_data['vat_class'];
							$single_vat=$results_data['total_ex_vat'];
							$ex_vat=$results_data['ex_vat'];
							$qty=$results_data['qty'];
							$image=$results_data['image'];
							$date=$results_data['date'];
							$ProductCode=$results_data['ProductCode'];	
							$product_id=$results_data['product_id'];
							$supplier_email=$results_data['supplier_email'];
						    $supplier_id=$results_data['supplier_id'];
							$ProductTitle=$results_data['ProductTitle'];
							$ProductCode=$results_data['ProductCode'];
							$supplier_acc=$results_data['supplier_acc'];
							$reorder_supplier_id=$results_data['reorder_supplier_id	'];
							
							$table_data .='<tr>  
							   <td style="text-align: left;
							padding-top: 10px;">'.$procode_new.'</td>
								   <td style="text-align:center;padding-top: 10px;">'.$ProductTitle.'</td>
									  <td style="text-align:center;padding-top: 10px;">'.$qty.'</td>
									  <td style="text-align:center; padding-top: 10px;">£'.$ex_vat.'</td>
									  <td style="text-align:center;padding-top: 10px;">'.$vat_class.'%</td>
									  <td  style="text-align:center; padding-top: 10px;">£'.$single_vat.'</td>
								</tr>';
							
							
							$total_price_ex_vat=$total_price_ex_vat+$single_vat;
							
							$inclusive_vat=$inclusive_vat+$single_vat+$single_vat*($vat_class/100);	
						
							$inclusive_vat=number_format((float)$inclusive_vat, 2, '.', '');
							
							$single_order=array('vat_class'=>$vat_class,'total_ex_vat'=>$single_vat,'ex_vat'=>$ex_vat,'qty'=>$qty,'date'=>$date,'ProductCode'=>$ProductCode,'reffrence_id'=>$refrence_id,'product_id'=>$product_id,'image'=>$image,'ProductTitle'=>$ProductTitle);
							   if($what1=='block'){
											   $datetime = new DateTime('tomorrow');
							   $DelorColReal= $datetime->format('d-m-Y');
							   $single_order['delivery_Date']=$DelorColReal;
							   
							   }
							
							
							$this->db->insert('dev_single_order',$single_order);
							
							
						}
				
						 
						
						$calemailvat=$inclusive_vat-$total_price_ex_vat;
						
						$numrows=$this->db->query("SELECT MAX( po_number ) AS max FROM `dev_orders` where business_id='$Busines_id'");
						$numrows=$numrows->result_array();
						$startreorder=$numrows[0]['max'];

						$startreorder=$startreorder+1; 
						
					
						
											
						$order=array('business_id'=>$Busines_id,'total_ex_vat'=>$total_price_ex_vat,'date'=>$date,'po_reffrence'=>$po_reffrence,'total_inc_vat'=>$inclusive_vat,'status'=>0,'odrdescrp'=>"Van Stock Re order",'givenprojectid'=>$project_id,'givenprojectname'=>$given_project_name,'po_number'=>$startreorder,'van_stock'=>0,'Transaction_id'=>'none','payment_status'=>'none','reorder'=>1,'supplier_id'=>$supplier_id,'reorder_supplier_id'=>$supplier_id,'van_id'=>$van_id,'engineer_id'=>$engineer_id);
										
						$in=$this->DataModel->insert($order_table,$order);  
						$insert_id_reorder = $this->db->insert_id();
						$uniqid=$insert_id_reorder; //change reff id
						$this->DataModel->update($order_table,array('po_reffrence'=>$uniqid),array('po_reffrence'=>$po_reffrence));
						
						$this->db->query("update dev_single_order set Reffrence_id = '$uniqid' WHERE Reffrence_id='$refrence_id'");
						
						$message='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style>td {vertical-align: -webkit-baseline-middle;}</style></head>

								  <body style="font-family:lato;font-size:14px; padding:0px;margin:0px;"  >
								  <table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f4f4f4; padding:20px 10px;">
								  <tr>
								  <td align="center">
									  <table style="border-bottom: 1px dotted #bfbebe;"width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
										 <tr> 
											  <td style="width:200px;"><img style="width: 170px;" src="'.trim($get_bussiness_details1[0]['bussiness_logo']).'"/></td>
											 <td style="width:300px;">
												<ul style="width:179px;list-style:none;margin-left:187px;padding:12px 12px;">
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
													<td  width="400px;"><h3 style="font-weight: bold;">VAN STOCK PURCHASE REORDER</h3>
														
													
													
							
							<ul style="list-style:none; padding-left:0px;display:'.$iswholeseller.'">
						
				  <li>'.$get_Supplier_details1[0]['suppliers_name'].'</li>
				  <li>'.$get_Supplier_details1[0]['address'].'</li>
				  <li>'.$get_Supplier_details1[0]['suppliers_city'].'</li>
				  <li>'.$get_Supplier_details1[0]['post_code'].'</li>
				  <li>'.$get_Supplier_details1[0]['email'].'</li>
				 
						</ul>
						<ul style="list-style:none; padding-left:0px;display:'.$wholesellerview.'">
				 <li><b>From</b></li>	
				  <li>'.$get_bussiness_details1[0]['business_name'].'</li>
				  <li>'.$get_bussiness_details1[0]['address'].'</li>
				  <li>'.$get_bussiness_details1[0]['post_code'].'</li>
				  <li>'.$get_bussiness_details1[0]['city'].'</li>
				 
				 
						</ul>
						
						</td>
						
						
						
													<td width="200px;">
													<ul style="list-style:none; padding-left:0px;">
													  <li style="padding-bottom: 5px;"><b>Purchase Reorder Date</b></li>
													   <li style="padding-bottom: 5px;">'.$today_date.'</li>';
													  // <!---------------------------------------------->
																	   if($what1=='block'){
											   $datetime = new DateTime('tomorrow');
													$DelorColReal= $datetime->format('d-m-Y');

												$message=$message.'<li style="padding-bottom: 5px;"><b>'.$DelorCol.' Date</b></li><li style="padding-bottom: 5px;">'.$DelorColReal.'</li>';	
										   }
										   
										   $message=$message.'
													   <!----------------------------------------------->
													   
													 
													   <li style="padding-bottom: 5px;"><b></b></li>
													   <li style="padding-bottom: 5px;">'.$DelorColtime.'</li>
										    <li style="padding-bottom: 5px;"><b>Account Number</b></li>
											   <li style="padding-bottom: 5px;">'.$supplier_acc.'</li>
											
											   <li style="padding-bottom: 5px;"><b>Reorder Number</b></li>
											   <li style="padding-bottom: 5px;">PO-'.$insert_id_reorder.'</li>
												
											 
											   <li style="padding-bottom: 5px;"><b>Order Description</b>
											   <li style="padding-bottom: 5px;">Van Stock Re order</li>   
											   
											   <li style="padding-bottom: 5px;"><b>vehicle Registration</b>
											   <li style="padding-bottom: 5px;">No-'.$vehicle_registration.'</li> 
											   
											    <li style="padding-bottom: 5px;"><b>Engineer Name</b>
											   <li style="padding-bottom: 5px;">'.$customer_name.'</li>
											   
											   <li style="padding-bottom: 5px;"><b>Engineer Mail</b>
											   <li style="padding-bottom: 5px;">'.$Engineer_email.'</li>
																	
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
											  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.$total_price_ex_vat.'</td>
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
											  <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.$inclusive_vat.'</td>
									   </tr>
									   
									</table>
								<!------------------------------------------------------------------>
								<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:50px;display:'.$what1.';">
		
		<tr> <td style="width: 600;"><h2>DELIVERY DETAILS</h2></td></tr>
		<tr> 
		   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
						<ul style="list-style:none; padding-left:0px;">
						   <li><b>Delivery Address</b></li>
						  <li>'.$get_bussiness_details1[0]['business_name'].'</li>
					  <li>'.$get_bussiness_details1[0]['address'].'</li>
					  <li>'.$get_bussiness_details1[0]['post_code'].'</li>
					  <li>'.$get_bussiness_details1[0]['email'].'</li>
						  
						</ul>
		   </td>
		   
		   <td width="150px" style="padding-left: 50px;" >
						<ul style="list-style:none; padding-left:0px;">
						   <li><b>Delivery Instructions</b></li>
						   <li>Please deliver items</li>
						  
						</ul>
		   </td>
		</tr>
		
		</table>
		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display:'.$what2.';">
		
		<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
		<tr> 
		   <td style="display:'.$iswholeseller.'" width="200px"  style="border-right: 1px solid #d8d4d4;" >
						<ul style="list-style:none; padding-left:0px;">
						   <li><b>Collection Instructions</b></li>
						   <li>Our engineer will pick these up </li>
						  
						  
						</ul>
		   </td>
		   
		  
		</tr>
		
		</table>
								<!------------------------------------------------------------------>
									
									<p style="text-align: left;font-size: 12px; padding-top: 27px;">Company Registration No:SC622115. Registered Office:14 Ballumbie Derive,Dundee,Angus,DD4 0NP   </p>
										 </td>
									  </tr>
									  </table>
								  </body>
							</html>';
							//$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers  = "From: noreply@pickmyorder.co.uk\r\n"; 
                             $headers .= "Content-type: text/html\r\n";
							mail($supplier_email,"REORDER Number $insert_id_reorder",$message,$headers);
							mail("nikhil.scorpsoft@gmail.com","REORDER Number $insert_id_reorder",$message,$headers);
							
						
					}
						
					   }
				
						if($status=='1')   //send notification to all supervisor of this businees
						{
							/* $mydevices=$this->db->query("select deviceid from dev_users where is_supervisor='1' && from_bussi='$Busines_id'");	
							$devices=$mydevices->result_array();
							 $body='You have an order to approve';			
							$result = $this->DataModel->send_notification($devices,$body,$logo_busnes_id);
							// send Notifictaion to ios devices if order by ios 
							 $myiosdevices=$this->db->query("select iosdeviceid from dev_users where is_supervisor='1' && from_bussi='$Busines_id'");	
							$iosdevices=$myiosdevices->result_array();
							 $body='You have an order to approve';			
							$result2 = $this->DataModel->send_ios_notification($iosdevices,$body); */
							
					}
								
					echo json_encode(array("statusCode"=>200,"valid"=>true,"orderid"=>$startorder,"Limitstatus"=>$status,'result'=>"$response"));
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