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
						  
						  <div class="pdf_view_forms">
						  
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
								
								<button class="btn btn-primary">Update</button>
						   </div>
								
								</div>
								
								
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
							   <span>Edit Invoice</span><span>Delete Invoice </span><span>Report Data Issue</span>
							</div>
						 </div>
					     <div class="pdf_view_flex2"></div>
					     <div class="pdf_view_flex1">
							<div class="pdf_veiw_edit_invoice"> 
							   <span>Flag Invoice</span><span>Approve Invoice</span>
							</div>
						 </div>
					</div>
	</div>
	</div>
	</div>
	</div>
	</div>
</section>


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
		  /*  ,DATEDIFF(30/04/2022,".$key[0]['invoice_date'].") as gapdate */
		    $Get_Data_W=$this->db->query("SELECT *,(nylas_invoice_attachement_detail.total/nylas_invoice_attachement_detail.qty) as incprice FROM `dev_NylasUsersAttachments`,nylas_invoice_attachement_detail where `dev_NylasUsersAttachments`.id=nylas_invoice_attachement_detail.nylas_id and invoice_date < '".$key[0]['invoice_date']."'  and '".$final_effective_unit_price."' > (nylas_invoice_attachement_detail.total/nylas_invoice_attachement_detail.qty ) and vendor_name='".$key[0]["vendor_name"]."' and ".$querParameter."  ORDER BY invoice_date DESC LIMIT 1 "  );
			$num = $Get_Data_W->num_rows();
		 /* print_r($this->db->last_query());die;   */
			if($num == 1)
			{  
		     $Get_Data=$Get_Data_W->result_array();
			 $gap_invoice_date=$Get_Data[0]['invoice_date'];
              $invoicedate=$key[0]['invoice_date'];
			$gap_invoice_date=str_replace('/','-',$gap_invoice_date);
			$invoicedate=str_replace('/','-',$invoicedate);
			/* print_r($gap_invoice_date);die; */
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
<input type="hidden" id="invoice_id" value="<?php echo $this->uri->segment(2);?>">
  <button id="Addcomment" style="border:none;color:#fff;background-color:#13499b;padding:15px;margin:20px 0;">Add Comment</button>
</div>
</div>
	 </div>
	 </div>
	 </div>
	 </div>
</section>
<script>
$(document).ready(function(){
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
});
</script>