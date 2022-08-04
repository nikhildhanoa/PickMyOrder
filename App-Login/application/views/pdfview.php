<script>
function createDiv()
    {
	$(".showfun").css('display','block');
    }	
 </script>
 <section class="pdf_view_project_allocations">

    <div class="pdf_view_project_allocations_div1">
          <div class="container">
		  
		  <div class="pdf_project_content_padding">
	         <div class="row">
		            <div class="col-md-5 ml-auto col-sm-12">
					      <div class="pdf_view_project_allocations_div1_content">
						  
						  <form>
						  
					 <?php if($key[0]['pdftype']!='3') { ?>	  <div class="pdf_view_forms">
						  
						        <div class="pdf_view_project_allocations_div1_content_title">
								    <p>Project <br>Allocations</p>
                                </div>	
								
								<div class="pdf_view_project_select">
								
								<div class="form-group">
									<select class="form-control" id="exampleFormControlSelect1" >
									 <?php echo $option_data;   ?>
									</select>
								</div>
								</div>
								
								<div>
								
								<button id="Update_project" class="btn btn-primary">Update</button>
						   </div>
								
								</div> <?php }?>
								
								
                          </form>								
						  
						  </div>
		            </div>
	         </div>
			 </div>
	      </div>
	</div>
	


</section>


<section class="Edit_delete_pdf_view_project_allocations" style="margin-bottom:20px">

    <div class="pdf_view_project_allocations_div1">
          <div class="container">
		  <div class="pdf_project_content_padding">
	         <div class="row">
		            <div class="col-md-12 ml-auto col-sm-12">
					<div class="edit_delete_pdf_view_flex">
					     <div class="pdf_view_flex1">
							<div class="pdf_veiw_edit_invoice"> 
							
	       <?php if($key[0]['pdftype']=='1'){$type='Credit'; } elseif($key[0]['pdftype']=='2') {$type='Invoice'; }  else {$type='Quote';}  ?>
							
							   <span class="btn btn-primary mx-2" id="edit_invoice" >Edit <?php echo$type ; ?></span><span class="btn btn-primary mx-2" id="Delete_invoice">Delete <?php echo$type ; ?> </span>
							   <?php if($key[0]['pdftype']!='3') { ?><span id="Report_Data_Issue" class="btn btn-primary mx-2">Report Data Issue</span><?php }?>
							</div>
						 </div>
					     <div class="pdf_view_flex2"></div>
                       
					     <div class="pdf_view_flex1">
							<div class="pdf_veiw_edit_invoice"> 					
                              <input type="hidden" value="<?php echo $key[0]['flag_invoice'];  ?>" id="flag_input" > 
				 <?php $flag= ($key[0]['flag_invoice']=='0') ? 'Flag Invoice' : 'Flaged'; 
$flag_color= ($key[0]['flag_invoice']!='0') ? 'style="background-color: rgb(204, 0, 0) !important;border:0px;width: 140px"; ' : 'style="width: 140px;"';
									
 if($key[0]['pdftype']=='3'){$type2='Order Quote'; }elseif($key[0]['pdftype']=='1'){$type2='Approve Credit';} else{$type2='Approve Invoice'; }			
 
 
      if($key[0]['pdftype']=='2')
	  { 
		// this id for invoice case    
		  $button_id='Main_Invoice'; 
	  }
	  elseif($key[0]['pdftype']=='1')
	  {
		 // this id for Credit case   
		  
		  $button_id='Main_Credit';  
	  }
     elseif($key[0]['flag_invoice']=='1' && $key[0]['project_id']=='0' && $key[0]['engineer_id']=='0'  && $key[0]['pdftype']=='3' )
	 {
		  // this id for Qoute case  
         // in a case when qoute not allcate project engineer_id		  
		 
		 $button_id='Approve_Invoice';
	 }else
	 {
		 
		 // this id for Qoute case  
         // in a case when qoute  allcate project engineer_id	
		 
		 $button_id='Qoute_to_order'; 
	 } 
	
 
							  ?>
							  
         <?php if($key[0]['pdftype']!='3') { ?><button id="Flag_Invoice" class="btn  btn-primary" <?Php echo $flag_color; ?>> <?Php echo $flag ; ?></button> <?php }?>
                    <button id="<?php echo $button_id;  ?>" class="btn btn-primary"><?Php echo $type2 ; ?></button>

							</div>
						 </div>
                       
					</div>
	</div>
	</div>
	</div>
	</div>
	</div>
</section>
<!-------------------------------------------->


<!------------------------------------------>
<section class="Edit_delete_pdf_view_image_and_data">

         <div class="container">
		 
		 <div class="Edit_delete_pdf_view_image_and_data_padding">
		 
		     <div class="row">
			 
			       <div class="col-md-6">
				   
				      <img src="<?php echo $GlobalSupliers_logo[0]['Supliers_logo']  ?>"   alt="supplier logo">
				   
				   </div>
				   
				   
			       <div class="col-md-6">
				   
				      <div class="Edit_delete_pdf_view_image_and_data_content">
					  
					      <h2><?php if($key[0]['pdftype']=='1'){?> Credit <?php } elseif($key[0]['pdftype']=='2') { ?>Invoice <?php }  else { ?> Quote <?php }  ?> </h2>
						  
						  <div class="Edit_delete_pdf_view_image_and_data_content_flex_div">
						  
						  <!--first_ line -->
						  
						        <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_header bd_border">
								 <span>Import Date<span>
								</div>
								<div class="Edit_delete_pdf_view_image_and_data_content_flex_div_title bd_border tr_right">
								<span><?php echo $key[0]['invoice_date'];  ?></span>
								</div>
						
                          <!--first_ line -->

                         <!--second_ line -->						  
						 
						   <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_header bd_border">
						    <span>Order no.<span>
						   </div>
								<div class="Edit_delete_pdf_view_image_and_data_content_flex_div_title bd_border tr_right">
								<span><?php
								 $check_order=$key[0]['order_number'];
								
								if($check_order!='DAMMY'){ echo $check_order; } ?></span>
								</div>
                         <!--second_ line -->						  
								
								
								  <!--third line -->						  
						 
						   <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_header bd_border">
						   <span>Invoice no.<span>
						   </div>
						   <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_title bd_border tr_right">
						   <span><?php echo $key[0]['document_number'];  ?></span>
						   </div>
						   
                         <!--third line -->	
						 
						 
						 <!-- forth line -->
						 
						    <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_header bd_border">
							  <span>Issue Date</span>
							</div>
						   <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_title bd_border tr_right">
						    <span><?php echo     $key[0]['Import_date'];  ?></span>
						   </div>
						   
						   <!-- End of forth line-->	


							
                       
                           <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_header ">
							  <span>PDF Document</span>
							</div>
						   <div class="Edit_delete_pdf_view_image_and_data_content_flex_div_title tr_right">
						    <span><a href="<?php echo $key[0]['Attachment'];  ?>" target="_blank" ><?php $attachmentname=explode('/',$key[0]['Attachment']); echo $attachmentname[5]; ?></a></span>
						   </div>
							<!-- End of Fifth line -->						   
						  </div>
					  
					  </div>
				   
				   </div>
				   
			 </div>

			 <div id="cross_div" class="showfun alert alert-warning alert-dismissible mt-5" role="alert" style="color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;padding: 12px;margin-bottom: 20px;border-radius: 4px;border:1px solid #937d58;display:none">
			  <strong>Price increased Alert!</strong> Items purchased on this invoice have price increases.
			  <button  id="cross_button" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background-color:transparent;float:right;border:none;">X</button>
              </div>
			  
			  <?php 
			  if(($tolerancePrice[0]['Price_Increase_Monitoring']=='1') && (empty($tolerancePrice[0]['Price_Increase_Tolerance'])) ) {  ?>
			   <div id="cross_div2" class="showfun alert alert-warning alert-dismissible mt-5" role="alert" style="color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;padding: 12px;margin-bottom: 20px;border-radius: 4px;border:1px solid #937d58;">
			  <strong>Tolerance Price Alert!</strong> The supplier has not set a price.
			  <button  id="cross_button2" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="background-color:transparent;float:right;border:none;">X</button>
              </div><?php } ?>
			 </div>
		 </div>
            
</section>


<section class="pdf_view_project_allocations_table">
    <div class="container">
	 <div class="Edit_delete_pdf_view_image_and_data_padding">
	     <table class="table">
  <thead class="thead-light">
    <tr>
     
      <th scope="col">Qty</th>
	  <th>Part No.</th>
	  <th>Description</th>
	  <th>Price</th>
	  <th>Per UOM</th>
	  <th >Discount(%)</th>
	  <th >Total</th>
	
    </tr>
  </thead>
  <tbody>
     
      <?php 
	  $Table_in_loop='';
	       
	  foreach($data as $dataval){  
           
        if($dataval['part_number']=='')
		{
			$querParameter="description='".$dataval['description']."'";
			$dec_link='<a href=invoiceNylasAttachmentDetails/'.$dataval['id'].'/Dec>'.$dataval['description'].'</a>';
		}	
		else
		{
			$querParameter="part_number='".$dataval['part_number']."'";
			$dec_link=$dataval['description'];
		}	
		 if(preg_match("/[a-z]/i", $dataval['total'])){
              $dATA=explode("S",$dataval['total']);
			  $A=$dATA[0];
           }else{
			    $A=$dataval['total'];
		   }
		   
		   $effective_unit_price=$A/$dataval['qty'];
		   
		   if(!empty($tolerancePrice[0]['Price_Increase_Tolerance']) && $tolerancePrice[0]['Price_Increase_Monitoring']=='1' ){
		   $final_effective_unit_price=$effective_unit_price-$tolerancePrice[0]['Price_Increase_Tolerance'];
		    $Get_Data_W=$this->db->query("SELECT *,(nylas_invoice_attachement_detail.total/nylas_invoice_attachement_detail.qty) as incprice FROM `dev_NylasUsersAttachments`,nylas_invoice_attachement_detail where `dev_NylasUsersAttachments`.id=nylas_invoice_attachement_detail.nylas_id and invoice_date < '".$key[0]['invoice_date']."'  and '".$final_effective_unit_price."' > (nylas_invoice_attachement_detail.total/nylas_invoice_attachement_detail.qty ) and vendor_name='".$key[0]["vendor_name"]."' and ".$querParameter."  ORDER BY invoice_date DESC LIMIT 1 "  );
			$num = $Get_Data_W->num_rows();
		 
			if($num == 1)
			{  
		     $Get_Data=$Get_Data_W->result_array();
			 $gap_invoice_date=$Get_Data[0]['invoice_date'];
              $invoicedate=$key[0]['invoice_date'];
			$gap_invoice_date=str_replace('/','-',$gap_invoice_date);
			$invoicedate=str_replace('/','-',$invoicedate);
			 $diff = abs(strtotime($invoicedate) - strtotime($gap_invoice_date));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	
			 
		     $Get_single_Data= number_format($Get_single_Data, 2);  
               $final=$effective_unit_price-$Get_single_Data; 
			 $final= number_format($final, 2);  
		    $backGroundColor='style="background-color:#e7c7cc;"';
		    $price_inc_tag='<br><span style="font-size:15px;color:#b63c49">£'.$final.' Per Unit Price Increase</span>';   


           $increase_price=$final+$A;
             $Table_in_loop.='<tr class="border" >
							<td style="padding:10px">'.$dataval['part_number'].'</td>
							<td style="padding:10px">'.$dataval['description'].'</td>
							<td style="padding:10px">£'.$A.'</td>
							<td style="padding:10px">£'.$increase_price.'</td>
							<td style="padding:10px">£'.$final.'</td>
							<td style="padding:10px;color:#da9f41">£'.$final.'</td>
							<td style="padding:10px">'.$key[0]["vendor_name"].'</td>
							<td style="padding:10px">
							<span>Invoice</span>
							<br>'.$days.' days before</td>	
							</tr>';	
							
				?>
				 <script>    createDiv();   </script>
				<?php 
			}else
			{
				$backGroundColor='';
				$price_inc_tag='';
			}  				
		   }else{
			   
			  $backGroundColor='';
				$price_inc_tag=''; 
		   }
		   		 
	  ?>
             <tr <?php echo $backGroundColor;   ?>>
             <td style="width: 36ch;" ><?php echo $dataval['qty'];?></td>
	<td style="width: 36ch;" ><a href="<?php echo base_url().'invoiceNylasAttachmentDetails/'.$dataval['id'].'/part'?>"><?php echo $dataval['part_number'];?> </a></td>
			 <td style="width: 36ch;" ><?php echo $dec_link; ?></td>
			 <td style="width: 36ch;" ><?php echo $dataval['price'];?></td>
			 <td style="width: 36ch;" ><?php echo $dataval['per_uom'];?></td>
			 <td style="width: 36ch;" ><?php echo $dataval['discount'];?></td>
			 <td style="width: 80ch;" ><?php  echo $A.$price_inc_tag; ?></td> 
			</tr>
			<?php  }?>
  </tbody>
</table>
	 <!-- table last -->
	 <div class="container">
	 <div class="row">
	 <div class="col-md-4 mt-6 ml-auto">
	  	     <table class="table">
  <tbody>
  <?php if(!empty($key[0]['subtotal']))  {    ?>
    <tr>

      <td style="@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');font-family: 'Poppins', sans-serif;font-size:16px"> <b>Sub Total</b> </td>
      <td style="@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');font-family: 'Poppins', sans-serif;font-size:16px">  £ <?php echo $key[0]['subtotal']; ?> </td>
    </tr>
  <?php }   ?>
 <?php if(!empty($key[0]['tax']))  {    ?>
	    <tr>
      <td  style="@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');font-family: 'Poppins', sans-serif;font-size: 16px;"> <b>VAT </b></td>
      <td style="@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');font-family: 'Poppins', sans-serif;font-size:16px">  £ <?php  echo $key[0]['tax']; ?> </td>
    </tr>   
<?php }   ?>
	
<?php if(!empty($key[0]['total']))  {    ?>
<tr>
      <td  style="@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');font-family: 'Poppins', sans-serif;font-size: 16px;"> <b>Total</b> </td>
      <td style="@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');font-family: 'Poppins', sans-serif;font-size:16px;font-weight:bold">   <?php  echo $key[0]['total']; ?> </td>
    </tr>
<?php }   ?>
  </tbody>
</table>
	 
	 </div>
	 </div>
	 
	</div>
	</div>
</div>
</section>
<!-- Second INvoice table -->

<section class="Edit_delete_pdf_view_image_and_data" style="margin-top:20px">
	<div class="container">
	<div class="Edit_delete_pdf_view_image_and_data_padding_new" style="background-color:#fff">
<div class="row"
	 <?php if($key[0]['pdftype']=='2') {  ?>
	 <!-- Associated -- invoices -->
		<div class="card-body" style="width: 100%;padding: 0 11px;">
			<h2 class="btn_collapse_associated_voice mb-0">
  <a class="btn " data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size:clamp(12px,1vw,32px);font-weight:bold;color: #fff;display: flex;align-items: center;">
  
   <i class="fa fa-plus  mr-3"  style="font-size:clamp(12px,1vw,32px);font-weight:bold;color: #fff;" id="plus"></i>
  <i class="fa fa-minus  mr-3"  style="font-size:clamp(12px,1vw,32px);font-weight:bold;color: #fff;display:none"></i>
  Associated Invoice
  </a>
</h2>		
			<div class="collapse" id="collapseExample">
  <div class="card card-body" style="padding: 1rem 2.25rem;">
  <div class="datatable datatable-bordered datatable-head-custom printable" id="kt_datatable"></div>
  </div>
</div>		
			</div>
			
		
		
		</div>
	<?php  } ?> 
	</div>
	<!-- End of Associated invoices -->
<!-- table last --> 
	 </div>
	 </div>
            
</section>
<!-- Second INvoice table -->



<!--price monitor section -->
     <section class="Edit_delete_pdf_view_image_and_data">
	 <div class="container">
	  <div class="Edit_delete_pdf_view_image_and_data_padding_new" style="background-color:#fff">
        <div class="row" ="" associated="" --="" invoices="">
		 <div class="card-body" style="width: 100%;padding: 0 11px;">
			<h2 class="btn_collapse_associated_voice_one mb-0" style="background: #13499b;">
			
     <a class="btn collapsed" data-toggle="collapse" role="button" aria-expanded="false" style="font-size:clamp(12px,1vw,32px);font-weight:bold;color: #fff;display: flex;align-items: center;" href="#collapseExample2" aria-controls="collapseExample2">
  
   <i class="fa fa-plus plus-sign  mr-3" style="font-size: clamp(12px, 1vw, 32px); font-weight: bold; color: rgb(255, 255, 255); display: block;" id="plus"></i>
  <i class="fa fa-minus minus-sign  mr-3" style="font-size: clamp(12px, 1vw, 32px); font-weight: bold; color: rgb(255, 255, 255); display: none;"></i>
Price Monitor</a>
      </h2>		
			<div class="collapse" style="" id="collapseExample2">
            <div class="card card-body" style="padding: 0rem !important">
        <div class="invoice_table">
        <table class="table_invoice" style="width:100%">
  <tr style="background:#ebecf0;padding:10px;">
    <th style="padding:10px">Code</th>
    <th style="padding:10px">Product</th>
    <th style="padding:10px">WAS </th>
    <th style="padding:10px">NOW </th>
    <th style="padding:10px">INCREASE</th>
    <th style="padding:10px">COST</th>
    <th style="padding:10px">SUPPLIER </th>
    <th style="padding:10px">LAST ACTIVITY  </th>
  </tr>
  <!--<tr class="border" >
    <td style="padding:10px">11111</td>
    <td style="padding:10px">THIS IS THE SAMPLE TEXT</td>
    <td style="padding:10px">19.55</td>
    <td style="padding:10px">24.5</td>
    <td style="padding:10px">255</td>
    <td style="padding:10px">HHDGSDG</td>
    <td style="padding:10px">255</td>
    <td style="padding:10px">
        <span>Invoice</span>
        <br>
        509 days before
    </td>
  </tr>-->
 <?php echo $Table_in_loop;  ?>
  
</table>
        </div>
		  </div>
		   </div>		
			</div>
			
		
		
		</div>
	 
	</div>
	<!-- End of Associated invoices -->
<!-- table last --> 
	 </div>
	 </section>
	 <!--end price monitor section -->
<!-- new Associated invoice -->
<!-- new associated invoice -->
<section class="Edit_delete_pdf_view_image_and_data" style="margin-top:-22px;padding-top:30px">
<div class="container">
	<div class="Edit_delete_pdf_view_image_and_data_padding_3">
	<div class="form_part" ">
<div class="container">
<div class="col-12">
	 <h3 style="font-size: 16px;font-weight:bold;margin-bottom:20px;color: #000;">User Comments</h3>
	 
	 <div class="border_width_user ">
	 
	  <?php  foreach($Commentdata as $Commentdatasingle) { ?>
<div class="row" style="margin:0px"> 
  <div class="col-4">
   <div>
     
<h4 class="sender_name" style="padding-top:8px;font-size:13px">
  <?php echo $Commentdatasingle['UserName'];   ?>
     </h4> 
     
    </div>
  </div>
  <div class="col-8">
    <h4 style="padding-top:8px;font-size:13px"><?php echo $Commentdatasingle['Comment'];   ?></h4>
  </div>
	 </div>
<?php  } ?>

<div style="display:flex;justify-content:center;padding-top:40px" class="text_">
  <textarea id="textarea_value"  placeholder="write your comment" style="width:100%;height:120px"></textarea>
</div>
<div style="display:flex;">
<input type="hidden" id="invoice_id" value="<?php echo $this->uri->segment(2);?>" name="InvoiceId">
<input type="hidden" id="Document_type" value="<?php echo $key[0]['pdftype'];?>">
  <button id="Addcomment" style="border:none;color:#fff;background-color:#13499b;padding:15px;margin:20px 0;">Add Comment</button>
</div>
</div>
	 </div>
	 </div>
	 </div>
	 </div>
</section>
                      <!-----------------model one start---------------->
<div id="myModal" class="modal " role="dialog">
  <div class="modal-dialog" style="position: relative;top: 25%;left:4%;">

    
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title"> Update Invoice</h4>
      </div>
      <div class="modal-body">
	  
	  <form action="<?php base_url() ?>/UpdateINvoice" method="POST">
	  
          <div class="form-group col-md-12">
      <label style="padding-left:3px;"> Order Number</label>
      <input required type="text" class="form-control form-control-solid"  placeholder="Enter Order Number" name="Order_Number">
        </div>
  <input type="hidden"  value="<?php echo $this->uri->segment(2);?>" name="InvoiceId">
      </div>
      <div class="modal-footer">
	  <button  type="submit"  class="btn btn-default btn-primary" >Update</button>
        <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Close</button>
      </div>
	   </form>
	  
    </div>

  </div>
</div>
                              <!--------------model end----------->
							  
							   <!--------------model two start----------->
	 <div id="myModalmessage" class="modal " role="dialog">
  <div class="modal-dialog" style="position: relative;top: 25%;left:4%;">

    
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title"> Report Data Issue </h4>
      </div>
      <div class="modal-body">
	  
	
	  
          <div class="form-group col-md-12">
      <label style="padding-left:3px;"> Message</label>
       <textarea  name="small_message" rows="4" cols="35" placeholder="write message....."> </textarea>
        </div>
  
      </div>
      <div class="modal-footer">
	  <button  type="submit"  class="btn btn-default btn-primary" >Update</button>
        <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Close</button>
      </div>
	 
	  
    </div>

  </div>
  
</div>
  <!--------------model for order----------->
 <div id="myModalmessagetwo" class="modal " role="dialog">
  <div class="modal-dialog" style="position: relative;;left:4%;">

    
    <div class="modal-content" style="padding:25px;">
      <div class="modal-header">
       
        <h4 class="modal-title"> Details </h4>
      </div>
      <div class="modal-body">
	  
	
	  <div class="marg product-form">

  <div class="form-horizontal">
  
  <form  action="<?php base_url()?>/CreteOrderToqoute" method="post" id="my_order_form">
  <!------------Get All  category------------->
     <div class="form-group">
      <label>Suppliers</label>

 <select class="form-control form-control-solid" name="supplier_id"  id="supplier_id">
  <?php echo$supplier_html; ?>
  </select>
	  </div>
   
   <div class="form-group">
      <label>Engineers</label>
      <select class="form-control form-control-solid" name="engineer_id" id="engineer_id" required>
	 <?php echo$engineer_html; ?>
 </select>
	  </div>
	
   <div class="form-group">
      <label id="supersubcat">projects</label>
	    <select class="form-control form-control-solid" name="project_id" id="project_id" >
   <?php echo$option_data; ?>
 </select>
	  </div>
	  
	 <div class="form-group">
      Delivery &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="tax_class" style="padding-left:7px" value="1" name="deduct" id="p1">
	  <br>
      Collection &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="tax_class" style="padding-left:7px" value="0" name="deduct" id="p2">
	  </div>


      <div class="form-group" id="date_id" style="display:none">
      <label id="append_date">Date</label>
      &nbsp;&nbsp; <input type="date" id="birthday_date" name="birthday_date">
	  </div>
	  
	   <div class="form-group" id="time_id" style="display:none" >
      <label id="append_time"> Time</label>
      &nbsp;&nbsp; <input type="time" id="birthday_time" name="birthday_time">
	  </div>
	
 
</div>
</div>
        
  
      </div>
      <div class="modal-footer">
	  <input type="hidden"  value="yourKey" name="checkMethod">
	  <input type="hidden" id="invoice_id" value="<?php echo $this->uri->segment(2);?>" name="InvoiceId">
	 <input type="hidden" id="invoice_approve" value="<?php echo $key[0]['Invoice_approve'];?>" name="InvoiceId">
 	  <button  id="submit"  class="btn btn-default btn-primary" >order</button>
        <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Close</button>
      </div>
	 </form>
	  
    </div>

  </div>
   <input  type="hidden" value="<?php echo $key[0]['vendor_name'].'/'.$key[0]['order_number'].'/'.$key[0]['total'].'/'.$key[0]['Attachment_name'].'/'.$this->uri->segment(2);?>" id="pay_bill" >
 <script> 
 $('#Main_Invoice').click(function(){
	 
	 
	let  invoice_approve =$('#invoice_approve').val();
	
	if(invoice_approve!=0)
	{
		alert('This Invoice All ready  Approved');
		
	}
	else if($('#flag_input').val()==1)
		 {
			 alert("This Invoice can't be  Approved because This is Flaged");;
		 } 
	else 
	{	
	 
	 
	$.ajax({
			    url:'<?= base_url('')?>createBill',
                  method:'POST',
                  data:{'pay_bill':$('#pay_bill').val()},				  
				  success:function(data)
					  {
						 if(data==1)
						 {
							 alert('This business Not Connect With Xero');
						 }
                         else if(data==2)
                         {
							 alert('vendor can Not Found');
						 }
						 else if(data==3)
                         {
							 alert('Conncet Xero Account With Your Business');
						 }
                         else if(data==4)
                         {
							 alert('Invoice Approved');
						 }							 
					  }
		        });
	 
	}
	 
 });
 
 
 
       $('#submit').click(function(){ 
	  var supplier_id = $('#supplier_id').val(); 
	  var engineer_id = $('#engineer_id').val(); 
	  var project_id = $('#project_id').val();
      var birthday_date = $('#birthday_date').val();
     
	  var birthday_date = $('#birthday_date').val();	  
	  var birthday_time = $('#birthday_time').val();	  
	
	
	 if(supplier_id==0)
	 {
		 alert('Select suppliers');
		 return false;
	 }else if(engineer_id==0)
	 {
		 alert('Select Engineer'); 
		 return false;
	 } 
	 else if(project_id==0)
	 {
		 alert('Select Project');
		 return false;
	 }	
     else if(birthday_date=='')
	 {
		 alert('Select date ');
		 return false;
	 }	
	   else if(birthday_time=='')
	 {
		 alert('Select Time ');
		 return false;
	 }	
	 
	 else
	 {
		$("#my_order_form").submit(function(e) {
        e.preventDefault();
        alert("order placed");
		 location.reload(); 
        }); 
		 
		
	 } 
	
	 
 });
 
 
 
 
$('#p1').click(function(){
	
	$("#date_id").css("display", "block");
	$("#time_id").css("display", "block");
	$('#append_date').html("Delivery Date");
	$('#append_time').html("Delivery time");
});

$('#p2').click(function(){
	$("#date_id").css("display", "block");
	$("#time_id").css("display", "block");
	$('#append_date').html("Collection Date");
	$('#append_time').html("Collection time");
});

 </script>
</div>
  
  
  
  
<script>
/*************************************************/

$(document).ready(function(){  

$('#Qoute_to_order').click(function(){
	
	var InvoiceId = $('#invoice_id').val(); 
	
	 $.ajax({
			      url:'<?= base_url('')?>CreteOrderToqoute',
                  method:'POST',
                  data:{'InvoiceId':InvoiceId,'checkMethod':'AutoKey'},				  
				  success:function(data)
					  {
						 if(data==1)
						 {
							 alert('order placed');
							  location.reload();
						 }else
						 {
							 alert(data);
						 }
					  }
		        }); 
});


$('#Approve_Invoice').click(function(){
	
	var pdftype =$('#Document_type').val();
	 if(pdftype==3)
	  {
		
	  $("#myModalmessagetwo").modal('show'); 
	  }
});


$('#edit_invoice').click(function(){
	  $("#myModal").modal('show'); 
});

$('#Report_Data_Issue').click(function(){
	  $("#myModalmessage").modal('toggle'); 
});	
	
	
$("#cross_button2").click(function(){
	 $("#cross_div2").remove();});
	 
$("#cross_button").click(function(){
	 $("#cross_div").remove();
});	
	
  $(".btn_collapse_associated_voice").click(function(){
    if($(".fa-minus").css('display')=='none')
	{
		$(".fa-minus").css('display','block');
		$(".fa-plus").css('display','none');
	}
	else{	
		$(".fa-minus").css('display','none');
		$(".fa-plus").css('display','block');
		} });
 
 $(".btn_collapse_associated_voice_one").click(function(){
    if($(".minus-sign").css('display')=='none')
	{
		$(".minus-sign").css('display','block');
		$(".plus-sign").css('display','none');
	}
	else{	
		$(".minus-sign").css('display','none');
		$(".plus-sign").css('display','block');
		} });			
			
 
 
$('#Addcomment').click(function(){   
	
 var url = window.location.href;	
 var TextareaValue = $('#textarea_value').val();
 var InvoiceId = $('#invoice_id').val(); 
	
	  if(TextareaValue=="")
	  {
		  alert("Write Any Comment");
	  }
      else
      {  
		  $.ajax({
			      url:'<?= base_url('')?>AddCommentToAttachment',
                  method:'POST',
                  data:{'TextareaValue':TextareaValue,'InvoiceId':InvoiceId,'url':url},				  
				  success:function(data)
					  {
						 if(data==1)
						 {
							 location.reload();
						 }
					  }
		        });  
	  }	  
});

/**************projecj allcate  to invoice******************/
$('#Update_project').click(function(event){
   event.preventDefault();
 var project_value = $('#exampleFormControlSelect1 :selected').val();
 var InvoiceId = $('#invoice_id').val(); 
 /* var invoice_flag_value =$('#flag_input').val(); */	
        if(project_value==0 )
		{
		   alert("Select a Project");
        }
        else if(project_value==00)
         {
            alert("No Record Found");
         }
		 else if($('#flag_input').val()==1)
		 {
			 alert("This Invoice can't be  Allocate  a Project because This is Flaged");;
		 } 
         else
         {
                $.ajax({
			      url:'<?= base_url('')?>AllcateProjectToInvoice',
                  method:'POST',
                  data:{'project_value':project_value,'InvoiceId':InvoiceId},				  
				  success:function(data)
					  {
						 if(data==1)
						 {
                             alert("project Allocate");
							 location.reload();
						 }
                          else(data);  
					  }
		        });
         }  
});
/************** End projecj allcate  to invoice******************/

/***********invoice flag or mot****************/
$('#Flag_Invoice').click(function(){
	
    var invoice_flag_value =$('#flag_input').val();	
	var InvoiceId = $('#invoice_id').val();
	
	$.ajax({
			      url:'<?= base_url('')?>UpdateInvoiceFlagValue',
                  method:'POST',
                  data:{'invoice_flag_value':invoice_flag_value,'InvoiceId':InvoiceId},				  
				  success:function(data)
					  {
						 if(data==1)
						 {
                             
							 location.reload();
						 }
                          else(data);  
					  }
		        });
	
	
});
/*********************************************/

/**************Delete Invoice *******************/   
$('#Delete_invoice').click(function(){
	
	if($('#Document_type').val()==1){var url='Creditnote';} else if($('#Document_type').val()==2){var url='Invoice';}else{var url='Quotation';}  

	var InvoiceId = $('#invoice_id').val();
	const text = "Are you sure you want to delete this Invoice";
	if (confirm(text) == true) {
	$.ajax({
		          url:'<?= base_url('')?>DeleteInvoice',
                  method:'POST',
                  data:{'InvoiceId':InvoiceId},				  
				  success:function(data)
					  {
						  if(data==1)
						  {
							  location.replace('<?= base_url('')?>'+url); 
						  }else{alert(data);}
                          						  
					  }
		        });
	}			
});

});
</script>


 