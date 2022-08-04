			<?php error_reporting(0); ?>
		
</div>

<div class="container">
	 
	    <div class="row">

	    <div class="col-md-6 col-xs-12 ">
			<div class="card card-custom gutter-b example example-compact">
         <div class="card-header">
         <h3 class="card-title">General Details</h3>
	
		 </div>
		 
	<div class="card-body">
		<div class="form-group">
  <form  method="post" enctype="multipart/form-data" action="<?php echo site_url('AddNewBusiness'); ?>" class="dropzone" id="dropzoneFrom" style="border: none;">
  
  	 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
  
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
      <label>Business Name</label>
	
	
      <input type="name" class="form-control form-control-solid" required placeholder="Enter Business Name" name="Business_Name">
  
	  </div>
   <!----------------address------------------------->   
   <div class="form-group  ">
      <label>Address</label>
	 
	 
      <input type="text" class="form-control form-control-solid" required placeholder="Enter Your Complete Address" name="address">
   </div>
	<!-------------------------------city------------------------------->
	
   <div class="form-group  ">
      <label>City</label>
	 

      <input type="text" class="form-control form-control-solid" required placeholder="Enter Your Complete Address" name="city">
   </div>
   <!----------------post code------------------------->
   <div class="form-group   ">
      <label>Post Code</label>
	
	 
      <input type="text" class="form-control form-control-solid" required placeholder="Enter Post Code" name="Post_Code">
  
	  </div>
	
   <!----------------Email------------------------->
   <div class="form-group ">
      <label>Email</label>
	 
	
      <input type="email" class="form-control form-control-solid" required placeholder="Enter Email" name="Email">
   </div>
   <!----------------Contact Name------------------------->
   <div class="form-group  ">
      <label>Contact Name</label>
	  

      <input type="text" class="form-control form-control-solid" required placeholder="Enter Contact Name" name="Contact_Name">
   </div>
   <!----------------Contact Number------------------------->
   <div class="form-group">
      <label>Contact Number</label>
	 
	
      <input type="number" class="form-control form-control-solid" required placeholder="Enter Contact Number" name="Contact_Number">
   </div>
	
	<div class="form-group">
		<label>Business Logo</label>
		
	
	       <input type="hidden" name="logoimage" value="" id="forimage">
	
	</div>
	
	
  
</div>
</div>
</div>
</div>
</div>
</div>
<!------------------------second------section--------------------------->
	    <div class="col-md-6 col-xs-12 border">
			<div class="card card-custom gutter-b example example-compact">
				<div class="card-header">
         <h3 class="card-title">Account Details</h3>
	
		 </div>
		  <div class="card-body">
		 <div class="jumbotron-sec marg ">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
     <label>Contact Name</label>
	 
	 
      <input type="text" class="form-control form-control-solid" required placeholder="Contact Name" name="Acc_Contact_Name">
   
	 </div>
   <!----------------address------------------------->
   <div class="form-group">
<label>Address</label>
	
	
      <input type="text" class="form-control form-control-solid" required placeholder="Enter Your Complete Address" name="acc_address">
   </div>
	 <!----------------City------------------------->
   <div class="form-group">
  <label>City</label>
	  
	
      <input type="text" class="form-control form-control-solid" required placeholder="Enter Post Code" name="acc_city">
 
	</div>
   <!----------------post code------------------------->
   <div class="form-group">
  <label>Post Code</label>
	  
	
      <input type="text" class="form-control form-control-solid" required placeholder="Enter Post Code" name="PostCode">
    
	</div>
   <!----------------Email------------------------->
   <div class="form-group">
    <label>Email</label>
	  
	 
      <input type="email" class="form-control form-control-solid" required placeholder="Enter Email" name="acc_email">
   </div>
   <!----------------Contact Number------------------------->
   <div class="form-group">
     <label>Contact Number</label>
	
	 
      <input type=" Number" class="form-control form-control-solid" required placeholder="Enter Contact Number" name=" acc_Number">
    
	  </div>
   <!----------------VAT Number------------------------->
   <div class="form-group">
   <label>VAT Number</label>
	
	
      <input type=" Number" class="form-control form-control-solid" required placeholder="Enter VAT Number" name="VAT_Number">
   
	  </div> 
	  <div class="form-group">
	   <div style="align-items: center;display: flex;">
   <label style="margin-bottom: 0px;">Wholesaler App</label>
	
	
      <input style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid"   name="iswholeapp" id="wholesaleryes">
   </div>
	  </div>
	 
	  
	  
	  
	  <!---------------payment method------------------>
	  <div class="form-group" id="paymentoptions" style="display:none">
	  <div style="align-items: center;display: flex;">
   <label style="margin-bottom: 0px;">Dedicate Account</label>
	
	 
     
	  <input style="width: 15%;height: 18px;" type="checkbox" id="DedicateAccount" class="method"  name="DedicateAccount" ></div>
   
	  </div>
	   </div>
	  <!---------------payment method------------------>
	  <div id="DedicateAccountdiv" style="display:none">
		  <div class="form-group">
			 <label>Secret Key</label>
			
			
			  <input type="text" class="form-control dedicatevalue form-control-solid"  name="Secretkey">
		
			  </div>
			  <div class="form-group">
			 <label>Publish Key</label>

			  <input type="text" class="form-control dedicatevalue form-control-solid"   name="Publishkey">
		
			  </div>
	  </div>
 
</div>
</div>
</div>
</div>
<hr>


<!-------email-section--->


  <!--  <div class="col-md-12">
      <h2>Email Address</h2>
</div>-->
<div class="col-md-6 col-xs-12 ">
<div class="card card-custom gutter-b example example-compact">
<div class="card-body">
 <div class="form-group ">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
  
      <!--  <label class="control-label col-md-4" for=" Number">Order To Supplier</label>
	
	  <div class="col-md-8">
       <input type="email" class="form-control email" required placeholder="" name="Supplier_email">
    </div>
	  </div>

   
   <div class="form-group  ">
 
	  
	 
	  <label class="control-label col-md-12 address_cont_email" for=" Number">This email address will be the address used to send order to supplier</label>

  </div>
   ----------------------->
   <div class="form-group">
  <div class="form-group">

      <h3 class="font-size-lg text-dark font-weight-bold mb-6" style="padding: 16px;">App Setting</h3><hr>
    </div>
<!-- <select name="app_active_status" class="form-control email" required>
              <option >--Status--</option>
			   <option value="1">Active</option>
			   <option value="0">DeActive</option>
			</select><br> -->
    <div style="align-items: center;display: flex;">
	<label class="col-md-6" style="margin-bottom: 0px;">Contractors app</label>
	 <div class="col-md-6">
       <input style="width: 15%;height: 18px;" type="checkbox" class="form-control"   name="contractorApp">
 </div>
    </div>  
	<div style="align-items: center;display: flex;">
	<label class="col-md-6" style="margin-bottom: 0px;">Invoice Management</label>
	 <div class="col-md-6">
       <input style="width: 15%;height: 18px;" type="checkbox" class="form-control"   name="InvoiceManagement">
 </div>
    </div> 
	<div style="align-items: center;display: flex;">
	<label class="col-md-6" style="margin-bottom: 0px;">Wholesalers page</label>
	 <div class="col-md-6">
       <input style="width: 15%;height: 18px;" type="checkbox" class="form-control"   name="wholesalerpage">
 </div>
    </div>  
	 
	<h3 class="font-size-lg text-dark font-weight-bold mb-6" style="padding: 16px 0 16px 5px;">Please select what products to add to account</h3>
		<div class="form-group row">
														<label class="col-3 col-form-label" style=" padding-right: 0px; margin-left: 15px">App active</label>
														<div class="col-3">
															<span class="switch switch-lg">
																<label>
																	<input  name="app_active_status" type="checkbox"  >
																	<span></span>
																</label>
															</span>
														</div>
	</div>
	<div class="submit-btn-sec">
<input type="submit" class="btn btn-info  marg_1 " value="SUBMIT" name="Insert_Busi" id="submit-all">
  </div>
	</div>  
	
    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script>
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

////confirmatiom-Of-Delete
			
	$('.newanchor').click(function(){
		var myId = $(this).attr('id');
		$("#deca").attr("href", myId);
	});
	
	$('#submit-all').click(function(e){
	
	if ( $(".dz-image")[0] ) 
	{   
		$('#forimage').val($('.dz-image > img ').attr('src'));
	}
	
	});
</script>
