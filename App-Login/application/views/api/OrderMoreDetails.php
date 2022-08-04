<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		 $editid=$_REQUEST['refid'];
       $emptyarray=array();
	   $select_order_query="select * from dev_orders where po_reffrence	='$editid'";
		$select_order_query=$this->db->query($select_order_query);
	   $select_order_query1=$select_order_query->result_array();
	  
	   if($select_order_query1){
			 $total_ex=$select_order_query1[0]['total_ex_vat'];
			 $total_in=$select_order_query1[0]['total_inc_vat'];
			 $supplier_id=$select_order_query1[0]['supplier_id'];
		 	 $business_id=$select_order_query1[0]['business_id'];
			 $instruction=$select_order_query1[0]['instruction'];
			 $EnginnerId=$select_order_query1[0]['engineer_id'];
			 $givenprojectname=$select_order_query1[0]['givenprojectname'];
			 $deleveryid=$select_order_query1[0]['deleveryid'];
			 $odrdescrp=$select_order_query1[0]['odrdescrp'];
			 $reorder=$select_order_query1[0]['reorder'];
			$van=$select_order_query1[0]['van_stock'];
	   }else{
		   $total_ex=0; 
		     $total_in=0;
			 $supplier_id=0;
			  $business_id=0;
			  $EnginnerId=0;
			  $instruction='No Instruction';
			 $givenprojectname=0;
			 $deleveryid=0;
	   }
	  $newvat=$total_in-$total_ex;
	      $select_single_order_query="select * from dev_single_order where Reffrence_id	='$editid'";
		$select_single_order_query=$this->db->query($select_single_order_query);
	   $select_single_order_query=$select_single_order_query->result_array();
	   
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
		  if($supplier_id=='0' || $supplier_id=='')
		  {
			  
			   $engidata=$this->db->query("select * from dev_engineer where user_id='$EnginnerId'");
			   $Get_Data=$engidata->result_array();
			   $text1="FROM";
				$text2="Business";
				$select_supplier[0]['suppliers_name']=$business_name;;
				$select_supplier[0]['address']=$select_bussiness_details1[0]['address'];
				$select_supplier[0]['suppliers_city']=$select_bussiness_details1[0]['city'];
				$select_supplier[0]['post_code']=$select_bussiness_details1[0]['post_code'];
		  }
		  else
		  {
			  $select_supplier=$this->db->query("select * from dev_supplier where id='$supplier_id'");
			  $select_supplier=$select_supplier->result_array(); 
			   
		  }
		  if($project_id=='0' || $project_id=='')
		  {
			  $engidata=$this->db->query("select * from dev_engineer where user_id='$EnginnerId'");
		   $Get_Data=$engidata->result_array();
		   
			$Project_data[0]['customer_name']=$Get_Data[0]['name'];
			$Project_data[0]['Delivery_Address']=$Get_Data[0]['newDaddress'];
			$Project_data[0]['delivery_city']=$Get_Data[0]['newDCcity'];  
			$Project_data[0]['delivery_postcode']=$Get_Data[0]['newDCpostcode'];
			if($givenprojectname=='Manual Delivery Address' ||$givenprojectname=='Selected Delivery' )
	       {
	           $selecteddelobj=$this->db->query("SELECT * from WHERE id='$deleveryid'");
	          if( $selecteddelobj->num_rows())
	          {
	            $delarray=$selecteddelobj->result_array();
    	        $Project_data[0]['Delivery_Address']=$delarray[0]['address_one'];
    			$Project_data[0]['delivery_city']=$delarray[0]['city'];  
    			$Project_data[0]['delivery_postcode']=$delarray[0]['postcode'];
	          }
	       }
		  }
		  else
		  {
			 $Project_data=$this->db->query("select * from dev_projects where id='$project_id'");
			 $Project_data=$Project_data->result_array(); 
		  } 
		  if($select_single_order_query[0]['delivery_Date']==0 || $select_single_order_query[0]['delivery_Date']=='')
		  {
			  $DeliveryDate=0;
			  
		  }
		  else $DeliveryDate=$select_single_order_query[0]['delivery_Date'];
		  
		  
		  $DeliveryAddress=$Project_data[0]['Delivery_Address'];
		  $delivery_city=$Project_data[0]['delivery_city'];
		  $delivery_postcode=$Project_data[0]['delivery_postcode'];
		  $Instructions='';
		  
		  
		  
		  
		  
		  
		  /************************************************/
		/*   $check_order=$this->db->query("select * from dev_orders where po_reffrence='$editid'");
			 $check_order=$check_order->result_array(); 
			$reorder_supplier_id=$check_order[0]['reorder_supplier_id']; */
			
		  /************************************************/
		  if($reorder==1)
           {
			  
			  
		  
				if($delivery_Date=='0' || $delivery_Date=='')
				{ 
					
					$DeliveryAddress=$select_supplier[0]['address'];
					$delivery_city=$select_supplier[0]['suppliers_city'];
					$delivery_postcode=$select_supplier[0]['post_code'];
					$Instructions="Our engineer will pick these up";
					
				
				
				}
				else
				{

					
					$business_name=$select_bussiness_details1[0]['business_name'];
					$DeliveryAddress=$select_bussiness_details1[0]['address'];
					$delivery_city=$select_bussiness_details1[0]['city'];
					$delivery_postcode=$select_bussiness_details1[0]['post_code'];
					$Instructions="Please deliver items";
					
					
				}
		   
		   
		   }
		 
		  /***********Make array to send*****************/
		 
			  
	  $emptyarray=array('Suppliers'=>$select_supplier[0]['suppliers_name'],'Address'=>$select_supplier[0]['address'],'City'=>$select_supplier[0]['suppliers_city'],'Postcode'=>$select_supplier[0]['post_code'],'OrderDate'=>$select_single_order_query[0]['date'],'DeliveryDate'=>$DeliveryDate,'order description'=>$odrdescrp,'collection_date'=>$select_single_order_query[0]['collection_date'],'Customer'=>$Project_data[0]['customer_name'],'DeliveryAddress'=>$DeliveryAddress,'delivery_city'=>$delivery_city,'delivery_postcode'=>$delivery_postcode,'instructions'=>$Instructions);
		  
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'ordermoredetails'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>