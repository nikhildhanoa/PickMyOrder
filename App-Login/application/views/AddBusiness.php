<?php error_reporting(0); ?>
		

<style>
	.checkbox_container {
  display: block;
  position: relative;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}


.checkbox_container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}


.checkmark {
  position: absolute;
    top: 0;
   right: -35px;
    height: 20px;
    width: 20px;
    background-color: #ecedf3;
    border-radius: 4px;
}



.checkbox_container input:checked ~ .checkmark {
  background-color: #2196F3;
}


.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}


.checkbox_container input:checked ~ .checkmark:after {
  display: block;
}


.checkbox_container .checkmark:after {
 left: 7px;
    top: 2px;
    width: 7px;
    height: 14px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<div class="container">
    <div class="row">
	        <div class="col-md-12">
			   <h3 style="font-size: 20px;color: rgb(204, 0, 0);"><?php echo $this->session->flashdata('error');    ?></h3>
			</div>
	</div>
</div>
<div class="container">
	 
	    <div class="row">

	    <div class="col-md-6 col-xs-12 ">
			<div class="card card-custom gutter-b example example-compact extenddynamic">
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
	  

      <input type="text" class="form-control form-control-solid contact-name_1"  required placeholder="Enter Contact Name" name="Contact_Name">
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
			<div class="card card-custom gutter-b example example-compact  extenddynamic" style="height: 970px;">
				<div class="card-header">
         <h3 class="card-title">Account Details</h3>
	
		 </div>
		  <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group " style="margin-top:19px;"> 
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
	  
	  
 </div>
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
<div class="row">
<div class="col-md-6 col-xs-12 ">
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">App Setting</h3>
	
		 </div>
<div class="card-body">
	<div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">

   <div class="form-group">
 
	<span class="titles pl-0">Platform Type</span>
<!-- <select name="app_active_status" class="form-control email" required>
              <option >--Status--</option>
			   <option value="1">Active</option>
			   <option value="0">DeActive</option>
			</select><br> -->
	<span></span>
    <div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Contractors app

       <input style="width: 15%;height: 18px;" type="checkbox" class="pro col-md-6 form-control"   name="contractorApp">
	   <span class="checkmark"></span>
</label>
  
 
    </div>  
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Invoice Management
       <input style="width: 15%;height: 18px;" type="checkbox" class="  col-md-6 form-control"   name="InvoiceManagement">
	   <span class="checkmark"></span>
	   </label>

    </div> 
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Wholesalers page

       <input style="width: 15%;height: 18px;" type="checkbox" class=" col-md-6 form-control"   name="wholesalerpage">
	   <span class="checkmark"></span>
</label>
    </div>
<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Brand Business

       <input style="width: 15%;height: 18px;" type="checkbox" class="pro col-md-6 form-control"   name="brandBusiness">
	   <span class="checkmark"></span>
</label>
    </div>

<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Brand page

       <input style="width: 15%;height: 18px;" type="checkbox" class=" col-md-6 form-control"   name="brandpage">
	   <span class="checkmark"></span>
</label>
    </div>

	
	
<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Luckins

       <input style="width: 15%;height: 18px;" type="checkbox" class=" col-md-6 form-control"   name="Luckins">
	   <span class="checkmark"></span>
</label>
    </div>	
	
	
	
		  
	
	   <div style="align-items: center;display: flex;">
	  	
   <label class="checkbox_container col-md-6 pl-0" style="margin-bottom: 0px;">Wholesaler App
	
	
      <input style="width: 15%;height: 18px;" type="checkbox" class=" pro checkbox form-control form-control-solid checks"   name="iswholeapp" id="wholesaleryes">
	  <span class="checkmark"></span>
	  </label>
   </div>
	 
	 
	  
	  
	  
	  <!---------------payment method------------------>
	  <div class="" id="paymentoptions" style="display:none">
	  <div style="align-items: center;display: flex;">
   
   
   <label class="checkbox_container col-md-6 pl-0" style="margin-bottom: 0px;">Dedicate Account
	
	
      <input style="width: 15%;height: 18px;" type="checkbox"  id="DedicateAccount" class="method"  name="DedicateAccount" >
	  <span class="checkmark"></span>
	  </label>
   </div>
   
	  </div>
	
	  <!---------------payment method------------------>
	  <div id="DedicateAccountdiv" style="display:none">
		  <div class="mt-3">
		  <span class="titles pl-0">Select to have dedicated payment account(Stripe)</span><br>
			 <label class="mt-4">Secret Key</label>
			  <input type="text" class="form-control dedicatevalue form-control-solid"  name="Secretkey">
			  </div>
			  <div class="mt-3">
			  <span class="titles pl-0">You can get this from stripe account</span><br>
			 <label class="mt-4">Publish Key</label>

			  <input type="text" class="form-control dedicatevalue form-control-solid mb-4"   name="Publishkey">
		      <span class="titles pl-0">You can get this from stripe account</span>
			  </div>
	  </div>
 
	
	
	
	
	<h3 class=" font-size-lg text-dark font-weight-bold mb-6" style="padding: 16px 0 16px 0px !important;color:red !important">Please select what products to add to account</h3>
		<div class="form-group row">
														<label class="col-3 col-form-label pl-0" style=" padding-right: 0px; margin-left: 15px">App active</label>
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
</div>


<script>
 jQuery('.pro').click(function()                           
{
	$(".pro").prop("checked", false);
    $(this).prop("checked", true);
	
	jQuery('#paymentoptions').css('display','none');
	jQuery('#DedicateAccountdiv').css('display','none');
	$('#DedicateAccount').prop('checked', false);
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
		 $(".extenddynamic").css("height","1147px");
	}
	
	if(jQuery('#DedicateAccount').prop('checked') == false)
	{
		jQuery('#DedicateAccountdiv').css('display','none');
		$(".dedicatevalue").prop('required',false);
		$(".dedicatevalue").prop('required',false);
		 $(".extenddynamic").css("height","970px");
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
