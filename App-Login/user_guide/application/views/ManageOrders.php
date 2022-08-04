<?php
error_reporting(0); 
 $editid=$_GET['id'];
       $orderno=$_GET['orderno'];
	   $select_order_query="select * from dev_orders where po_reffrence	='$editid'";
		$select_order_query=$this->db->query($select_order_query);
	   $select_order_query1=$select_order_query->result_array();
	   if($select_order_query1){
	    $total_ex=$select_order_query1[0]['total_ex_vat'];
	    $total_in=$select_order_query1[0]['total_inc_vat'];
		 $supplier_id=$select_order_query1[0]['supplier_id'];
		 	 $business_id=$select_order_query1[0]['business_id'];
			 $instruction=$select_order_query1[0]['instruction'];
			 $engid=$select_order_query1[0]['engineer_id'];
			 $givenprojectname=$select_order_query1[0]['givenprojectname'];
	   }else{
		   $total_ex=0; 
		     $total_in=0;
			 $supplier_id=0;
			  $business_id=0;
			  $instruction='No Instruction';   
			$engid=0;
			$givenprojectname=0;
			 
	   }
	  $newvat=$total_in-$total_ex;
	      $select_single_order_query="select * from dev_single_order where Reffrence_id	='$editid'";
		$select_single_order_query=$this->db->query($select_single_order_query);
	   $select_single_order_query=$select_single_order_query->result_array();
	   if($select_single_order_query)
	   {
	 $project_id=$select_single_order_query[0]['project_id'];
	 $product_id=$select_single_order_query[0]['product_id'];
	 
	 $delivery_Date=$select_single_order_query[0]['delivery_Date'];
	 $delivery_time=$select_single_order_query[0]['delivery_time'];
	 $collection_date=$select_single_order_query[0]['collection_date'];
	 $collection_time=$select_single_order_query[0]['collection_time'];
	   }
	   else{
		   $project_id=0;
		   $product_id=0;
	   }
	   /*****************product details************************/
	  
	   
	   
	   
	   
	   
	   /*****************product details************************/
	 /***************select bussiness details*********************/
	 
		$select_bussiness_details=$this->db->query("select * from dev_business where id	='$business_id'");
	   $select_bussiness_details1=$select_bussiness_details->result_array();
	   if($select_bussiness_details1)
	   {
		   $business_name=$select_bussiness_details1[0]['business_name'];
		   $b_address=$select_bussiness_details1[0]['address'];
		   $b_post_code=$select_bussiness_details1[0]['post_code'];
		   $b_email=$select_bussiness_details1[0]['email'];
		   $b_city=$select_bussiness_details1[0]['city'];
	   }
	   else
	   {
		   $business_name='';
		   $b_address='';
		   $b_post_code='';
		   $b_email='';
		   $b_city='';
	   }
	   /*****************supplier******************************/
	   if($supplier_id=='0')
	   {
		  $engidata=$this->db->query("select * from dev_engineer where user_id='$engid'");
		  $Get_Data=$engidata->result_array();
		    $text1="FROM";
			$text2="Business";
			$display='none';
			$select_supplier[0]['suppliers_name']=$business_name;
			$select_supplier[0]['address']=$b_address;
			$select_supplier[0]['suppliers_city']=$b_city;
			$select_supplier[0]['post_code']=$b_post_code;
			$select_supplier[0]['AccountNumber']=$Get_Data[0]['newaccnumber'];
	   }
	   else
	   {
		   $display='block';
		   $text1="To";
			$text2="Suppliers";
		   
		 $select_supplier=$this->db->query("select * from dev_supplier where id='$supplier_id'");
		  $select_supplier=$select_supplier->result_array();  
	   }
	   if($project_id=='0')
	   {
	      
		   $engidata=$this->db->query("select * from dev_engineer where user_id='$engid'");
		   $Get_Data=$engidata->result_array();
		   
			$Project_data[0]['customer_name']=$Get_Data[0]['name'];
			$Project_data[0]['Delivery_Address']=$Get_Data[0]['newDaddress'];
			$Project_data[0]['delivery_city']=$Get_Data[0]['newDCcity'];  
			$Project_data[0]['delivery_postcode']=$Get_Data[0]['newDCpostcode'];
		   
		    if($givenprojectname=='Delivery Address')
	       {
	        $Project_data[0]['Delivery_Address']=$select_order_query1[0]['tempaddress'];
			$Project_data[0]['delivery_city']=$select_order_query1[0]['tempcity'];  
			$Project_data[0]['delivery_postcode']=$select_order_query1[0]['tempostcode'];
	       }
	   } 
	   else
	   {
		   $Project_data=$this->db->query("select * from dev_projects where id='$project_id'");
		  $Project_data=$Project_data->result_array();
		
	   }
	    
		
	  
	   ?>	

<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>@media print{a[href]:after{content:none;}
}
@media print {
    /* Hide everything in the body when printing... */
    .mainpage{ display: none; }
	 #kt_subheader{ display: none !important;}
   #kt_header{ display: none !important;}
   #kt_aside{ display: none !important;}
    /* ...except our special div. */
    body.printing #DivIdToPrint { display: block; }
}

@media screen {
    /* Hide the special layer from the screen. */
    #DivIdToPrint { display: none; }
	/*  #kt_subheader{ display: none !important;}
   #kt_header{ display: none !important;}
   #kt_aside{ display: none !important;} */
}</style>
<div class="container mainpage">

  <ul class="nav nav-tabs">
    
    <li class="active"><a data-toggle="tab" href="#menu1">Manage Order</a></li>
    
  </ul>

  <div class="tab-content" id="outprint">
    
    <div id="menu1" class="tab-pane active">
	<div class="row">
	 <div class="col-sm-1">
	<span style="color:#5867dd;font-size: 18px !important;
    font-family: Arial !important;">Orders</span>
	
		</div>
		<div class="col-sm-4 order-dec-sec">
		<span style="width:200px;color:#5867dd;font-size: 18px !important;font-family: Arial !important;margin-left:60px;"><span class="">Order Description</span> :<?php echo $select_single_order_query[0]['order_desc'];?></span>
		</div>
		<div class="col-sm-4">
	
	<span style="color:#5867dd;font-size: 18px !important;
    font-family: Arial !important;margin-left:60px;">Order Date : <?php echo $select_single_order_query[0]['date'];?></span>
	</div>
	<div class="col-sm-3">
	<button style="margin-left: 19%;" id='btn' value='Print' class="btn btn-info printMe" >PRINT THIS ORDER</button>
	</div>
	</div>
	<hr>
          <div class="container">
  
  <table class="table table-striped">
    <thead>
      <tr>
       <th>Description </th>
        <th>Image</th>
		<th>Qty</th>
		<th>Unit Price</th>
		<th>Vat</th>
		<th>Total EX VAT</th>
		<!--<th>Edit</th>
		<th>Delete</th>-->
      </tr>
    </thead>
    <tbody>
	<?php $staus=0; $total=0;foreach($select_single_order_query as $select_single){?>
      <tr>
       <?php $rowid=$select_single['id'];
	   $product_id=$select_single['product_id'];
	    $select_product_query=$this->db->query("select * from dev_products where id='$product_id'");
	   $select_product_query=$select_product_query->result_array();
	  $pdescription=$select_product_query[0]['title'];
       $staus=$select_single['status'];
	   if( $product_id=='')
	   {
		   $pdescription=$select_single['ProductTitle'];
	   }
	   
	   ?>
		<td ><?php echo $pdescription; ?></td>
		
		<td><img style="width:30px;height:30px" src="<?php echo $select_single['image']; ?>" ></td>
		
		 <td><?php echo $select_single['qty']; ?></td>
		 	
		<td>£<?php echo $select_single['ex_vat']; ?></td>
		<td><?php $tovat=$select_single['vat_class'];echo $select_single['vat_class']; ?>%</td>
		<td>£<?php $total=$total+ $select_single['total_ex_vat']; echo $select_single['total_ex_vat']; $total?></td>
		
		<!--<td><a href="<?php echo site_url('manageOrderEdit?EditStatus='.$select_single['id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td> 
		<td><a href="<?php echo site_url("DeleteSingleOrder?refferid=$editid && id=$rowid");?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td> -->
      </tr>      
	<?php } ?>
	
    </tbody>
  </table>
 
</div>

<hr>
<div style="">
<div class="row">
<div class="col-sm-9">
<div class="save_btn btn_sec2"><button  data-toggle="modal" data-target="#ordermodal" type="button" class="btn btn-default">MORE DETAILS</button></div>
<?php 
if($staus=='1'){
?>
<div class="save_btn btn_sec2"><button  data-toggle="modal" data-target="#approvemodal" type="button" class="btn btn-default">APPROVE ORDER</button></div>
<?php } ?>

</div>
 <div class="subtot  col-sm-3" >
  <h3 style="color:black">Sub Total <span class="cost-sec">£<?php echo number_format((float)$total_ex, 2, '.', ''); ?></span></h3>
  <?php $vat=$total/5;?>
  <h3 style="color:black">Vat<span class="cost-sec2">£<?php echo number_format((float)$newvat, 2, '.', '');?></span></h3>
  <?php $Deduct=$total+$vat;?>
  <h3 style="color:black">Total <span class="cost-sec3"> £<?php echo number_format((float)$total_in, 2, '.', '');?></span></h3>
  </div>


</div>




</div>

</div>

</div>

  
</div>
<!--------------------------------Approve order popup----------------------------->
  <div class="modal fade" id="approvemodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		 <h4 class="modal-title">Alert!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
		 <div class="form-group">
 
 <label class="control-label col-md-12" for="email">DO YOU WANT APPROVE THIS ORDER</label>
	
 </div>
   
      

        </div>
        <div class="modal-footer">
		<button name="appro" type="button" id="orderapprove" class="btn btn-default" >Continue</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>
  <!---------------------------------close------------------------------------------>
  <!--------------------------------More Details popup----------------------------->
  <div class="modal fade" id="ordermodal" role="dialog">
    <div class="modal-dialog">
     
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		 <h4 class="modal-title">Order Details </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
		 <div class="form-group">
		 
		 <div class="row">
		  <div class="col-sm-12"><h4>Purchase Order Details</h4></div>
		  <div class="col-sm-6">
		 
		   <p><?php echo $text1; ?></p>
		   
		   <div class="row">
        <div class="col-sm-5"><?php echo $text2; ?>:</div>
    <div class="col-sm-7"><?php  echo $select_supplier[0]['suppliers_name'];?></div>
    
    </div>
		 <div class="row">
        <div class="col-sm-5">Address:</div>
    <div class="col-sm-7"><?php   echo $select_supplier[0]['address'];	?></div>
    
    </div>   
		   
		  	 <div class="row">
        <div class="col-sm-5">City:</div>
    <div class="col-sm-7"><?php   echo $select_supplier[0]['suppliers_city'];	?></div>
    
    </div>    
		   
	  	 <div class="row">
        <div class="col-sm-5">Postcode:</div>
    <div class="col-sm-7"><?php     echo $select_supplier[0]['post_code'];	?></div>
    
    </div>  
	
		  </div>
		 <div class="col-sm-6 mt-4">
		<p></p>
		<div class="row">
        <div class="col-sm-5">Order Date:</div>
        <div class="col-sm-7"><?php  echo  $select_single_order_query[0]['date'];	?></div>
        </div> 
<div class="row">
        <div class="col-sm-5"><?php if($delivery_Date=='0'&& $delivery_time=='0'){ echo "Collection";}else{ echo "Delivery";}?> Date:</div>
        <div class="col-sm-7"><?php if($delivery_Date=='0'&& $delivery_time=='0'){ echo  $select_single_order_query[0]['collection_date']; }else{ echo $select_single_order_query[0]['delivery_Date'] ;}	?></div>
        </div>  
		    
<div class="row">
        <div class="col-sm-5">Order Description:</div>
        <div class="col-sm-7"><?php   echo $select_single_order_query[0]['order_desc'];	?></div>
        </div>  
		   		   
		   
		
		  
		  </div>
		 
		 </div>
		 
		  <div class="row" style="display:<?php if($delivery_Date=='0'&& $delivery_time=='0'){ ?> none <?php }else{ ?> block <?php } ?>;">
		
		    <div class="col-sm-12 mt-3">
			 
			<h4><?php if($delivery_Date=='0'&& $delivery_time=='0'){ echo "Collection";}else{ echo "Delivery";}?> Details</h4></div>
			
		  <div class="col-sm-6">
		  <p>To</p>
		
		 <div class="row">
        <div class="col-sm-5">Customer:</div>
        <div class="col-sm-7"><?php echo $Project_data[0]['customer_name'];?></span></p></div>
        </div>  
		<div class="row">
        <div class="col-sm-5">Delivery Address:</div>
        <div class="col-sm-7"><?php echo $Project_data[0]['Delivery_Address']; ?></div>
        </div>  
		<div class="row">
        <div class="col-sm-5">City:</div>
        <div class="col-sm-7"><?php echo $Project_data[0]['delivery_city']; ?></div>
        </div>  
		<div class="row">
        <div class="col-sm-5">Postcode:</div>
        <div class="col-sm-7"><?php echo $Project_data[0]['delivery_postcode']; ?></div>
        </div> 
      
	   
		   
		  
		
		  </div>
		
		 
		 </div>

	
		</div>
   
      

        </div>
        <div class="modal-footer">
		
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!---------------------------------close------------------------------------------>
  <!-------------------------------Print Document html -------------------------------->
<div id='DivIdToPrint'  style="text-align:center;margin:0 auto">

    <style>
  td {
    
    vertical-align: -webkit-baseline-middle;
} 
</style>
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f4f4f4; padding:20px 10px;">
  <tr>
  <td align="center">
      <table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	     <tr> 
		 <td style="width:200px;"><img style="width: 200px;" src="<?php echo  $select_bussiness_details1[0]['bussiness_logo']; ?>"/></td>
			<td style="width:200px;">
			    <ul style="
    width: 179px;list-style: none;margin-left: 150px;padding: 12px 12px;display:<?php echo $display; ?>">
				  <li><?php echo $business_name ?></li>
				  <li><?php echo $b_address ?></li>
				  <li><?php echo $b_post_code ?></li>
				  <li><?php echo $b_email ?></li>
				  
			    </ul>
			 </td>
			 </tr>
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
					<td width="400px;"><h3 style="font-weight: bold;">PURCHASE ORDER</h3>
						<ul style="list-style:none; padding-left:0px;">
					<li><?php  echo $select_supplier[0]['suppliers_name'];?></li>
		      <li><?php   echo $select_supplier[0]['address'];	?></li>
		      <li><?php   echo $select_supplier[0]['suppliers_city'];	?></li>
		      <li><?php     echo $select_supplier[0]['post_code'];	?></li>
		    
					</ul>
					
					</td>
					<td width="200px;">
					<ul style="list-style:none; padding-left:0px;">
					  <li><b>Purchase Order Date</b></li>
					   <li><?php  echo  $select_single_order_query[0]['date'];	?></li><br/>
					   <li><b><?php if($delivery_Date=='0' && $delivery_time=='0'){ echo "Collection";}else{ echo "Delivery";} ?> Date</b></li>
					   <li><?php if($delivery_Date=='0' && $delivery_time=='0'){ echo  $select_single_order_query[0]['collection_date']; }else { echo $select_single_order_query[0]['delivery_Date']; }	?></li><br/>
					   <li><b>Account Number</b></li>
					   <li><?php echo $select_supplier[0]['AccountNumber'] ;?></li><br/>
					   <li><b>Purchase Order Number</b></li>
					   <li><?php echo 'PO-'.$orderno;?></li><br/>
					   <li <?php if($display=='block'){ ?>style="display:none" <?php } ?>><b>Oprative Name</b></li>
					   <li <?php if($display=='block'){ ?>style="display:none" <?php } ?>><?php echo $Get_Data[0]['name']; ?></li>
					   <br/>
					  <!-- <li><b>VAT Number</b></li>
					   <li>316383114</li><br/>-->
					</ul>
				</td>
			</tr>
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	   <tr>  
	   <th style="border-bottom: 2px solid #000;padding-bottom: 19px;width: 200px;text-align: left;
    padding-top: 33px;"> Product Code</th>
	<th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">Description</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">Quantity</th>
		      <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;"> Unit Price</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">VAT</th>
			  <th  style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">Total EX VAT</th>
	   </tr>
	   <?php foreach($select_single_order_query as $select_single){
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
		   ?>
	   <tr>  
	          <td style="text-align: left;padding-top: 10px;"><?php echo $procode ; ?></td>
			  <td style="text-align: left;padding-top: 10px;"><?php echo $pdescription; ?></td>
			  <td style="text-align:center;padding-top: 10px;"><?php echo $select_single['qty']; ?></td>
		      <td style="text-align:center; padding-top: 10px;"><?php echo $select_single['ex_vat']; ?></td>
			  <td style="text-align:center;padding-top: 10px;"><?php echo $select_single['vat_class']; ?>%</td>
			  <td  style="text-align:center; padding-top: 10px;"><?php echo $select_single['total_ex_vat']; ?></td>
	   </tr>
	   <?php } ?>
	  
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
				<td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="padding-bottom: 10px;text-align:center; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;">Subtotal</td>
			  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£<?php echo number_format((float)$total_ex, 2, '.', ''); ?></td>
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
	   <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-left:10px; padding-top: 10px;">TOTAL VAT</td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;">£<?php echo number_format((float)$newvat, 2, '.', '');?></td>
			
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
	   <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"><b>TOTAL</b></td>
			  <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£<?php echo number_format((float)$total_in, 2, '.', '');?></td>
	   </tr>
	   
	</table>
	
	<table width="600px"  border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display: <?php if($delivery_Date=='0' && $delivery_time=='0'){?> none;<?php } ?>">
	
	<tr> <td style="width: 600;"><h2>DELIVERY DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Address</b></li>
					   <li><?php echo $Project_data[0]['Delivery_Address']; ?></li>
					   <li><?php echo $Project_data[0]['delivery_city']; ?></li>
					   <li><?php echo $Project_data[0]['delivery_postcode']; ?></li>
					   
		            </ul>
	   </td>
	  
	   <td width="150px" style="padding-left: 50px;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Instructions</b></li>
					   <li><?php echo $instruction;?></li>
					 
		            </ul>
	   </td>
	</tr>
	</table>
	<table width="600px"  border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display: <?php if($delivery_Date=='0' && $delivery_time=='0'){ ?> block;<?php }else{ ?>none<?php } ?>">
	
	<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Collection Address</b></li>
					   <li><?php  echo $select_supplier[0]['suppliers_name'];?></li>
					   <li><?php   echo $select_supplier[0]['address'];	?></li>
					   <li><?php   echo $select_supplier[0]['suppliers_city'];	?></li>
					   <li><?php     echo $select_supplier[0]['post_code'];	?></li>
		            </ul>
	   </td>
	  
	 <!--  <td width="150px" style="padding-left: 50px;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Instructions</b></li>
					   <li><?php //echo $instruction;?></li>
					 
		            </ul>
	   </td>-->
	</tr>
	</table>
		 </td>
	  </tr>
	  </table>
</div>
<!--------------------------------close -------------------------------------------->

<script>
jQuery(".printMe").click(function(){
	
	window.print();
	
});
jQuery('#orderapprove').click(function(){
	Aprove_id=<?php echo $editid;?>;
	ponum=<?php echo $orderno;?>; //purchase order number
	$.ajax({
		url:"<?= base_url('')?>approveorderbyadmin",
		method:"POST",
		data:{'poreff':Aprove_id,'pornum':ponum},
		success:function(data)
		{
			if(data=='1')
			{
			    $('#approvemodal').modal('hide');
				
				location.reload();
			}
			else
			{
				location.reload();
			}
		}
	});
});
</script>