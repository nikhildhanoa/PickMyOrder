<button class="btn btn-info"><i class="fa fa-arrow-left" aria-hidden="true"></i>GO BACK</button>
<?php
if(isset($_POST['allid']))
{ //echo $_POST['allid'];
$select_order_query="select * from dev_orders where po_reffrence='1'";
		$select_order_query=$this->db->query($select_order_query);
	   $select_order_query1=$select_order_query->result_array();
	   if($select_order_query1){
	    $total_ex=$select_order_query1[0]['total_ex_vat'];
	    $total_in=$select_order_query1[0]['total_inc_vat'];
		 $supplier_id=$select_order_query1[0]['supplier_id'];
		 	 $business_id=$select_order_query1[0]['business_id'];
			 $instruction=$select_order_query1[0]['instruction'];
	   }else{
		   $total_ex=0; 
		     $total_in=0;
			 $supplier_id=0;
			  $business_id=0;
			  $instruction='No Instruction';        
			 
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
	 
	   ?>	
	   <style>@media print{a[href]:after{content:none;}
}
@media print {
    /* Hide everything in the body when printing... */
    .mainpage{ display: none; }
    /* ...except our special div. */
    body.printing #DivIdToPrint { display: block; }
}

@media screen {
    /* Hide the special layer from the screen. */
    #DivIdToPrint { display: none; }
}</style>

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
		 <td style="width:200px;"><img style="width: 200px;" src="<?php echo base_url(); ?>/images/applogo/newlogo.png"/></td>
			<td style="width:200px;">
			    <ul style="
    width: 179px;list-style: none;margin-left: 150px;padding: 12px 12px;">
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
		      <td style="padding-bottom: 10px;text-align:center; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;">Subtotal</td>
			  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£<?php echo number_format((float)$total_ex, 2, '.', ''); ?></td>
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-left:10px; padding-top: 10px;">TOTAL VAT</td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;">£<?php echo number_format((float)$newvat, 2, '.', '');?></td>
			
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
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
<script>
$(document).ready(function(){
alert('hsjhdsjk');
});

</script>


<?php }else{ echo "Please Select Orders";} ?>