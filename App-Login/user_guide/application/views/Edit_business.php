       <?php 
	   error_reporting(0); 
	   $editid=$_GET['id'];    
	   
	    $select_single_business_query="select * from dev_business where id='$editid'";
		$select_single_business=$this->db->query($select_single_business_query);
		$select_single=$select_single_business->result_array();
		$select_single= $select_single[0];
	 
	    $select_single_businessacc_query="select * from dev_account where business_id='$editid'";
		
		$select_single_businessaccc=$this->db->query($select_single_businessacc_query);
		
		$select_singleacc=$select_single_businessaccc->result_array();
		$select_singleacc= $select_singleacc[0];
	
	   ?>		
		<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  

  <div class="tab-content">

    <div id="menu1" class="tab-pane active background">
      
      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
<div id="form">
	<div class="container">
		<div class="row">
		
	    <div class="col-md-6 col-xs-12 placholder_class">
		<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
         <h3 class="card-title">General Details</h3>
	
		 </div>
	<div class="card-body">
		<div class="form-group">
  <form  method="post" action="<?php echo site_url('editbusiness'); ?>" enctype="multipart/form-data" <?php if($select_single['bussiness_logo']==''){ ?> class="dropzone" id="dropzoneFrom" style="border: none;" <?php } ?>>
 
  	 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
      <label>Business Name</label>
	
	
      <input type="name" class="form-control form-control-solid" style="background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAOFJREFUOBHFUjsSgjAQJYkFNJ5AzmJt64weQe/kEXQs5SI01sINLKAh8T3IjsCIoo5jZja7eXn7dvMJgr8PY8xCKZXB3JuW+Vx1wSniD0+SBa2qSRRFMxqwRPAhYdmHV46kMAzjoihyxhCJy7JkZyxwoO8P59yK2KS/4de1KGMhDvDuAqi4Q+UNiYwlQWu9lrjtrbV7rrWAaDWFWW+p4C89Evh8xz6RmN97+rz1HaDNU1VVHQ1iaHMJkVGXeO1kN4sag8jDO2B3pMF/95HwG80ZTzWH2LQpPHrOccztaPbPiDcgS12+ITUDKQAAAABJRU5ErkJggg==data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAOFJREFUOBHFUjsSgjAQJYkFNJ5AzmJt64weQe/kEXQs5SI01sINLKAh8T3IjsCIoo5jZja7eXn7dvMJgr8PY8xCKZXB3JuW+Vx1wSniD0+SBa2qSRRFMxqwRPAhYdmHV46kMAzjoihyxhCJy7JkZyxwoO8P59yK2KS/4de1KGMhDvDuAqi4Q+UNiYwlQWu9lrjtrbV7rrWAaDWFWW+p4C89Evh8xz6RmN97+rz1HaDNU1VVHQ1iaHMJkVGXeO1kN4sag8jDO2B3pMF/95HwG80ZTzWH2LQpPHrOccztaPbPiDcgS12+ITUDKQAAAABJRU5ErkJggg=="); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" required placeholder="Enter Business Name" name="Business_Name" value="<?php echo  $select_single['business_name']; ?>">
   <input name="hid" type="hidden" value="<?php echo  $select_single['id']; ?>">
	  </div>
  
	<!----------------adress------------------------->   
   <div class="form-group  ">
      <label <label>Address</label>

      <input type="text" class="form-control form-control-solid" required placeholder="Enter Your Complete Address" name="address" value="<?php echo  $select_single['address']; ?>">
</div>
	 <!----------------city------------------------->   
   <div class="form-group  ">
      <label>City</label>
	 

      <input type="text" class="form-control form-control-solid" required placeholder="Enter Your Complete Address" name="city" value="<?php echo  $select_single['city']; ?>">
    </div>
   <!----------------post code------------------------->
   <div class="form-group   ">
      <label>Post Code</label>

      <input type="text" class="form-control form-control-solid" required placeholder="Enter Post Code" name="Post_Code" value="<?php echo  $select_single['post_code']; ?>">

	  </div>
	
   <!----------------Email------------------------->
   <div class="form-group ">
      <label>Email</label>
	 

      <input type="email" class="form-control form-control-solid" required placeholder="Enter Email" name="Email" value="<?php echo  $select_single['email']; ?>" >
 </div>
   <!----------------Contact Name------------------------->
   <div class="form-group  ">
      <label>Contact Name</label>
	  

      <input type="text" class="form-control form-control-solid" required placeholder="Enter Contact Name" name="Contact_Name" value="<?php echo  $select_single['contact_name']; ?>">
</div>
   <!----------------Contact Number------------------------->
	<div class="form-group">
		<label>Contact Number</label>
	
			<input type="number" class="form-control form-control-solid" required placeholder="Enter Contact Number" name="Contact_Number" value="<?php echo  $select_single['contact_number']; ?>">
		</div> 

	
	<!----------------------------------Business Logo-------------------------------->
	<div class="form-group">
		<label class="col-sm-4" for="logo" style="padding: 0px;">Business Logo</label>
		
		<div class="col-md-8">
		<input type="hidden" name="logoimage" value="" id="forimage">
		<?php if($select_single['bussiness_logo']!=''){ ?>
			
		<input type="hidden" value="<?php echo $select_single['bussiness_logo'];?>" name="business_url">
        <span id="cutlogo" class="<?php echo $select_single['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></span>
			<img src="<?php echo $select_single['bussiness_logo']; ?>" height="100px" width="100px">		
		<?php } ?>
		    
	</div>
	</div>
  
</div>
 </div>
		
	 </div> 		</div>
</div>
 </div>

<!------------------------second------section--------------------------->
	    <div class="col-md-6 col-xs-12 placholder_class">
		<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
         <h3 class="card-title">Account Details</h3>
	
		 </div>
		 <div class="card-body">
		<div class="form-group">
		 <div class="jumbotron-sec marg ">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
     <label>Contact Name</label>
	 
      <input type="text" class="form-control form-control-solid" required placeholder="Contact Name" name="Acc_Contact_Name" value="<?php echo  $select_singleacc['contact_name']; ?>">

	 </div>
   <!----------------address------------------------->
   <div class="form-group">
<label>Address</label>
	

      <input type="text" class="form-control form-control-solid" required placeholder="Enter Your Complete Address" name="acc_address" value="<?php echo  $select_singleacc['address']; ?>">
    </div> 
	<!----------------city------------------------->
   <div class="form-group">
<label>City</label>
	
	
      <input type="text" class="form-control form-control-solid" required placeholder="Enter Your Complete Address" name="acc_city" value="<?php echo  $select_singleacc['acc_city']; ?>">
    </div> 
   <!----------------post code------------------------->
   <div class="form-group">
  <label>Post Code</label>
	  
	
      <input type="text" class="form-control form-control-solid" required placeholder="Enter Post Code" name="PostCode" value="<?php echo  $select_singleacc['post_code']; ?>">

	</div>
   <!----------------Email------------------------->
   <div class="form-group">
    <label>Email</label>
	  

      <input type="email" class="form-control form-control-solid" required placeholder="Enter Email" name="acc_email" value="<?php echo  $select_singleacc['email']; ?>">
    </div>
   <!----------------Contact Number------------------------->
   <div class="form-group">
     <label>Contact Number</label>
	
	
      <input type=" Number" class="form-control form-control-solid" required placeholder="Enter Contact Number" name=" acc_Number" value="<?php echo  $select_singleacc['contact_number']; ?>">
  
	  </div>
   <!----------------VAT Number------------------------->
   <div class="form-group">
   <label>VAT Number</label>
	

      <input type=" Number" class="form-control form-control-solid" required placeholder="Enter VAT Number" name="VAT_Number" value="<?php echo  $select_singleacc['vat_number']; ?>">

	  </div>
	   <div class="form-group">

      <h3 class="font-size-lg text-dark font-weight-bold mb-6">Wholesaler App</h3><hr>
  <div style="align-items: center;display: flex;">
    
	<label style="margin-bottom: 0px;">Wholesaler Page</label>
	 
      <input style="width: 15%;height: 18px;" id="wholesaleryes" type="checkbox" class="form-control form-control-solid"   name="iswholeapp" <?php if($select_single['iswholpageview']=='1'){  ?> checked <?php } ?>>
    </div>
	  </div>
	  	  <!-----------------------------field for delevery cost------------------------------->
	
	  <!---------------------------------------------------------------------------------->
	  	  <div class="form-group" id="paymentoptions" style="display:none">
   <label class="control-label col-sm-4" for=" Number">Dedicate Account</label>
	
	 
     
	  <div class="col-sm-8"><input <?php if($select_single['isdedicate']=='1'){ ?> checked <?php } ?>type="checkbox" id="DedicateAccount" class="method"  name="DedicateAccount" ></div>
   
	  </div>
	  <!---------------payment method------------------>
	  <div id="DedicateAccountdiv" style="display:none">
		  <div class="form-group">
			 <label class="control-label col-sm-4" for=" Number">Secret Key</label>
			
			  <div class="col-md-8  ">
			  <input type="text" class="form-control dedicatevalue"  name="Secretkey" value="<?php echo $select_single['stripe_secretkey']; ?>">
			</div>
			  </div>
			  <div class="form-group">
			 <label class="control-label col-sm-4" for=" Number">Publish Key</label>
			
			  <div class="col-md-8  ">
			  <input type="text" class="form-control dedicatevalue"   name="Publishkey" value="<?php echo $select_single['stripe_publishkey']; ?>">
			</div>
			
			  </div>
	  </div>
 
</div>
</div>
</div>
</div>
</div>
<hr>
</div>

<!-------email-section--->
<div class="col-md-6 col-xs-12 placholder_class">
<div class="card card-custom gutter-b example example-compact">
   <!-- <div class="col-md-12">
      <h2>Email Address</h2>
</div>-->
<div class="card-body">
  <div class="form-group ">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 
 
        <!------------<label class="control-label col-md-4" for=" Number">Order To Supplier</label>
	
	  <div class="col-md-8">
      <input type="email" class="form-control email" required  placeholder="" name="Supplier_email" value="<?php echo  $select_single['supplier_email']; ?>">
	 
    </div>
	  </div>

   
   <div class="form-group  ">
 
	  
	 
	  <label class="control-label col-md-12 address_cont_email" for=" Number">This email address will be the address used to send order to supplier</label>

  </div>
-->
   <div class="form-group">
<!--<label>App Status</label>
	
    <select name="app_active_status" class="form-control">
			<?php   if($select_single['app_status']=='1'){ $val='YES';}else{$val='NO';} ?>
			   <option value="<?php echo  $select_single['app_status']; ?>"><?php echo  $val; ?></option>
			   <option value="1">Active</option>
			   <option value="0">DeActive</option>
			</select>
  <br>-->
  <div class="form-group">

      <h3 class="font-size-lg text-dark font-weight-bold mb-6" style="padding: 16px;">App Setting</h3><hr>
    </div>
  <div style="align-items: center;display: flex;">
	<label class="col-md-6" style="margin-bottom: 0px;">Contractors app</label>
	 
       <div class="col-md-6">
<input style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="contractorApp" <?php if( $select_single['iswholeapp']=='0' ){ ?> checked <?php } ?>></div>
    </div>
   
	<div style="align-items: center;display: flex;">
	<label class="col-md-6" style="margin-bottom: 0px;">Invoice Management</label>
	 
       <div class="col-md-6"><input <?php if( $select_single['iswholeapp']=='2' ){ ?> checked <?php } ?> style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="InvoiceManagement"></div>
    </div>
	<div style="align-items: center;display: flex;">
	<label class="col-md-6" style="margin-bottom: 0px;">Wholesalers app</label>
	 
       <div class="col-md-6">
<input style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="wholesalerpage" <?php if( $select_single['iswholeapp']=='1' ){ ?> checked <?php } ?>></div>
    </div>
	<h3 class="font-size-lg text-dark font-weight-bold mb-6" style="padding: 16px 0 16px 5px;">Please select what products to add to account</h3>
		<div class="form-group row">
														<label class="col-3 col-form-label" style=" padding-right: 0px; margin-left: 15px">App active</label>
														<div class="col-3">
															<span class="switch switch-lg">
																<label>
																	<input type="checkbox" <?php if( $select_single['app_status'] ){ ?> checked <?php } ?> name="app_active_status">
																	<span></span>
																</label>
															</span>
														</div>
	</div>
	
    <div class="submit-btn-sec">
<input style="margin-left: 0px;" type="submit" class="btn btn-info  marg_1 " value="Update" name="update_Busi" id="submit-all">



    </div>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
 </form>
    </div>
  </div>
</div>
<script>
jQuery(document).ready(function()
{
	if(jQuery('#wholesaleryes').prop('checked') == true)
	{
			jQuery('#paymentoptions').css('display','block');
			
	  
			if(jQuery('#DedicateAccount').prop('checked') == true)
			{
				jQuery('#DedicateAccountdiv').css('display','block');
				$(".dedicatevalue").prop('required',true);
				$(".dedicatevalue").prop('required',true);
			}
			
			if(jQuery('#DedicateAccount').prop('checked') == false)
			{
				jQuery('#DedicateAccountdiv').css('display','none');
				$(".dedicatevalue").prop('required',false);
				$(".dedicatevalue").prop('required',false);
			}
	}
	if(jQuery('#wholesaleryes').prop('checked') == false)
	{
		jQuery('#paymentoptions').css('display','none');
		jQuery('#DedicateAccountdiv').css('display','none');
		$(".dedicatevalue").prop('required',false);
		$(".dedicatevalue").prop('required',false);
		$(".dedicatevalue").prop('required',false);

	}
	// if click
	
	

});

jQuery('#wholesaleryes').change(function()
{
	if(jQuery('#wholesaleryes').prop('checked') == true)
	{
    jQuery('#paymentoptions').css('display','block');
	}
	if(jQuery('#wholesaleryes').prop('checked') == false)
	{
		jQuery('#paymentoptions').css('display','none');
		jQuery('#DedicateAccountdiv').css('display','none');
		$(".dedicatevalue").prop('required',false);
		$(".dedicatevalue").prop('required',false);
	}

});
jQuery('.method').change(function()                           // change on dedicate 
{
	if(jQuery('#DedicateAccount').prop('checked') == true)
	{
		jQuery('#DedicateAccountdiv').css('display','block');
		$(".dedicatevalue").prop('required',true);
		$(".dedicatevalue").prop('required',true);
	}
	
	if(jQuery('#DedicateAccount').prop('checked') == false)
	{
		jQuery('#DedicateAccountdiv').css('display','none');
		$(".dedicatevalue").prop('required',false);
		$(".dedicatevalue").prop('required',false);
	}
});

//delete logo

$('#cutlogo').click(function(){
	id=$(this).attr('class');
	$.ajax({
		url : "<?php echo site_url('deletelogo'); ?>" ,
		data: {'id': id} ,
		method: "post",
		success: function(data){
			if(data)
			{
				location.reload();
				
			}
		}
	});
});  
$('#submit-all').click(function(e){
	
	if ( $(".dz-image")[0] ) 
	{   
		$('#forimage').val($('.dz-image > img ').attr('src'));
	}
	
	});
</script>


