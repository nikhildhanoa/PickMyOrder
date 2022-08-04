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
		
		//print_r($key);die;
		$name=$this->db->query("select plans_name from dev_Business_Plans where business_id='$editid'");
	    $name=$name->result_array();
		$name=$name[0]['plans_name'];
		
		if(!empty($name))
		{
			$name=$name;
		}
		else{
			
			$name="You haven't take any subscription";
		}
		
		
	   ?>		
		<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.else-cond {
    min-height: auto;
	    background: white;
    padding: 20px 20px;
	box-sizing: border-box;
	border: none;
}
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
  

  <div class="tab-content">

    <div id="menu1" class="tab-pane active background">
      
      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
<div id="form">
	<div class="container">
		<div class="row">
		
	    <div class="col-md-6 col-xs-12 placholder_class">
		<div class="card card-custom gutter-b example example-compact extenddynamic">
											<div class="card-header">
         <h3 class="card-title">General Details</h3>
	
		 </div>
	<div class="card-body">
		<div class="form-group">
  <form  method="post" action="<?php echo site_url('editbusiness'); ?>" enctype="multipart/form-data" <?php if($select_single['bussiness_logo']==''){ ?> class="dropzone" id="dropzoneFrom" style="border: none;" <?php } ?>>
 
  	 <div class="jumbotron-sec marg else-cond" style="border: none;">

  <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
      <label>Business Name</label>
	
	
      <input type="name" class="form-control form-control-solid" style="background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAOFJREFUOBHFUjsSgjAQJYkFNJ5AzmJt64weQe/kEXQs5SI01sINLKAh8T3IjsCIoo5jZja7eXn7dvMJgr8PY8xCKZXB3JuW+Vx1wSniD0+SBa2qSRRFMxqwRPAhYdmHV46kMAzjoihyxhCJy7JkZyxwoO8P59yK2KS/4de1KGMhDvDuAqi4Q+UNiYwlQWu9lrjtrbV7rrWAaDWFWW+p4C89Evh8xz6RmN97+rz1HaDNU1VVHQ1iaHMJkVGXeO1kN4sag8jDO2B3pMF/95HwG80ZTzWH2LQpPHrOccztaPbPiDcgS12+ITUDKQAAAABJRU5ErkJggg==data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAOFJREFUOBHFUjsSgjAQJYkFNJ5AzmJt64weQe/kEXQs5SI01sINLKAh8T3IjsCIoo5jZja7eXn7dvMJgr8PY8xCKZXB3JuW+Vx1wSniD0+SBa2qSRRFMxqwRPAhYdmHV46kMAzjoihyxhCJy7JkZyxwoO8P59yK2KS/4de1KGMhDvDuAqi4Q+UNiYwlQWu9lrjtrbV7rrWAaDWFWW+p4C89Evh8xz6RmN97+rz1HaDNU1VVHQ1iaHMJkVGXeO1kN4sag8jDO2B3pMF/95HwG80ZTzWH2LQpPHrOccztaPbPiDcgS12+ITUDKQAAAABJRU5ErkJggg=="); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" required placeholder="Enter Business Name" name="Business_Name" value="<?php echo  $select_single['business_name']; ?>">
   <input name="hid" type="hidden" value="<?php echo  $select_single['id']; ?>">
	  </div>
  
	<!----------------adress------------------------->   
   <div class="form-group  ">
      <label >Address</label>

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

		 <!----------------Van limit------------------------->
		 
	
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
		<div class="card card-custom gutter-b example example-compact  extenddynamic">
											<div class="card-header">
         <h3 class="card-title">Account Details</h3>
	
		 </div>
		 <div class="card-body">
		<div class="form-group">
		 <div class="jumbotron-sec marg dropzone" style="border: none;">
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
<div class="card-header">
         <h3 class="card-title">App Setting</h3>
	
		 </div>
<div class="card-body">
  <div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 
 
   <div class="form-group">
   <span class="titles pl-0">Platform Type</span>

  <div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Contractors app
	 
      
<input style="width: 15%;height: 18px;" type="checkbox" class="col-md-6 form-control" name="contractorApp" <?php if( $select_single['iswholeapp']=='0' ){ ?> checked <?php } ?>>
<span class="checkmark"></span>
</label>
    </div>
   
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Invoice Management
	 
      <input <?php if( $select_single['invoice_management_premission']=='1' ){ ?> checked <?php } ?> style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="InvoiceManagement">
	  <span class="checkmark"></span>
	  </label>
    </div>
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Wholesalers Page
	 
<input style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="wholesalerpage" <?php if( $select_single['iswholpageview']=='1' ){ ?> checked <?php } ?>>
<span class="checkmark"></span>
</label>
    </div>
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Brand business
	 
<input style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="Brandbusiness" <?php if( $select_single['iswholeapp']=='3' ){ ?> checked <?php } ?>>
<span class="checkmark"></span>
</label>
    </div>
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Brand page
	 
<input style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="Brandpage" <?php if( $select_single['brandpage']=='1' ){ ?> checked <?php } ?>>
<span class="checkmark"></span>
</label>
    </div>
	
	
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Luckins
	 
<input style="width: 15%;height: 18px;" type="checkbox" class="form-control form-control-solid" name="Luckins" <?php if( $select_single['Luckins']=='1' ){ ?> checked <?php } ?>>
<span class="checkmark"></span>
</label>  
    </div>
   <?php if($select_single['Trial_business']=='1') {  ?>
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Expiry Date
	 </label> 
	 <input type="date" id="birthday" name="birthday" style="border: 1px solid #ecedf3;
    padding: 5px;margin-left: 16px;margin-top: 11px;width: 33%;}" value="<?php echo date('Y-m-d', strtotime($select_single['expire_trial_time'])) ?>">  
 
    </div>      
	
	<?php }?>
	
	<!-- dedicated account-->
	   <div class="form-group">

      <h3 class="font-size-lg text-dark font-weight-bold mb-6" style="font-size:1.275rem;">Wholesaler App</h3><hr>
  <div style="align-items: center;display: flex;">
    
	<label class="checkbox_container pl-0" style="margin-bottom: 0px;">Wholesaler App
	 
      <input style="width: 15%;height: 18px;" id="wholesaleryes" type="checkbox" class="form-control form-control-solid"   name="iswholeapp" <?php if($select_single['iswholeapp']=='1'){  ?> checked <?php } ?>>
	  <span class="checkmark"></span>
	  </label>
    </div>
	  </div>
	  	  <!-----------------------------field for delevery cost------------------------------->
	
	  <!---------------------------------------------------------------------------------->
	  	 	  	  <div class="form-group" id="paymentoptions" style="display:none">
				  <div style="align-items: center;display: flex;">
   <label class="checkbox_container" style="margin-bottom: 0px;">Dedicate Account
	
	 
     
	  <input <?php if($select_single['isdedicate']=='1'){ ?> checked <?php } ?>type="checkbox" id="DedicateAccount" class="method"  name="DedicateAccount" style="width: 15%;height: 18px;">
	  <span class="checkmark"></span>
	  </label>
    </div>
	  </div>
	  <!---------------payment method------------------>
	  <div id="DedicateAccountdiv" style="display:none">
		  <div class="form-group">
		    <span class="titles pl-0">Select to have dedicated payment account(Stripe)</span><br>
			 <label for=" Number">Secret Key</label>
			
			  
			  <input type="text" class="form-control dedicatevalue form-control-solid"  name="Secretkey" value="<?php echo $select_single['stripe_secretkey']; ?>">
	
			  </div>
			  <div class="form-group">
			   <span class="titles pl-0">You can get this from stripe account</span><br>
			 <label for=" Number">Publish Key</label>
			
			 
			  <input type="text" class="form-control dedicatevalue form-control-solid"   name="Publishkey" value="<?php echo $select_single['stripe_publishkey']; ?>">
			<span class="titles pl-0">You can get this from stripe account</span>
			  </div>
	  </div>
 
	<!-- dedicated account-->
	
	
	
	<h3 class=" font-size-lg text-dark font-weight-bold mb-6" style="padding: 16px 0 16px 0px !important;color:red !important">Please select what products to add to account</h3>
		<div class="form-group row">
														<label class="col-3 col-form-label pl-0" style=" padding-right: 0px; margin-left: 15px">App active</label>
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



<!-- New form -->
<?php  if($select_single['iswholeapp']=='0'){   ?>
<div class="col-md-6 col-xs-12 placholder_class">
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Business Settings</h3>
	<span style="font-size:10px;color:red;margin-top:20px">business setting only apply for subscription  plans</span>
		 </div>
<div class="card-body">
   <h5>Backend permissions <span style="margin-left:20px;"><strong> ( <?php echo $name;  ?> ) </strong><span></h5>
  <div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 
 
       

   <div class="form-group">

  <div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Products 
<input style="width: 15%;height: 18px;" type="checkbox"  <?php if( $key['permission_products']=='1' ){ ?> checked <?php } ?> class="col-md-6 form-control" name="backproduct">
<span class="checkmark"></span>
</label>
    </div>
   
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Orders
      <input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_orders']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="backOrders">
	  <span class="checkmark"></span>
	  </label>
    </div>
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Suppliers
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_suppliers']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="backSuppliers">
<span class="checkmark"></span>
</label>
    </div>
	
		<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Engineers
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_engineers']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="backEngineers">
<span class="checkmark"></span>
</label>  
    </div>
	
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Projects
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_projects']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="backProjects">
<span class="checkmark"></span>
</label>  
    </div>
	
<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Catologes
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_catologes']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="backCatologes">
<span class="checkmark"></span>
</label>  
    </div>
	
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Categories
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_categories']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="backCategories">
<span class="checkmark"></span>
</label>  
    </div>
	
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> VAN Stock
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_vanstock']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="backVAN_Stock">
<span class="checkmark"></span>
</label>  
    </div>
	
		1
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Electrical Catalogue
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $key['permission_ElectricalCatalogue']=='1' ){ ?> checked <?php } ?>class="form-control form-control-solid" name="backElectrical_Catalogue">
<span class="checkmark"></span>
</label>  
    </div>
	
<div style="align-items: end;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Vans Limit
</label>  
<input style="width: 61px;height: 25px;padding: 0.6rem 0.3rem 0.65rem 1rem;border-radius: 5px;margin-top:10px;" type="number" class="form-control form-control-solid" name="Vans_Limit" min="0" value="<?php  echo $sup_array['vans_limit'];  ?>">
<span class="VansLimit"></span>

</div>	


<div style="align-items: end;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> User Limit
</label>  
<input style="width: 61px;height: 25px;padding: 0.6rem 0.3rem 0.65rem 1rem;border-radius: 5px;margin-top:10px;" type="number" class="form-control form-control-solid" name="User_Limit" min="0" value="<?php  echo $sup_array['Staff_limit']; ?>">
<span class="VansLimit"></span>

</div>	

</div>
</div>

<!-- second model -->

         <h5 class="card-title">App Permissions  <span style="margin-left:20px;"><strong>(Supervisor) </strong><span></h5>
  <div class="form-group" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 

   <div class="form-group">
   

  <div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Categories 
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $sup_array['sup_app_Categories']=='1' ){ ?> checked <?php } ?> class="col-md-6 form-control" name="sup_app_Categories">
<span class="checkmark"></span>
</label>
    </div>
   
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Orders
      <input style="width: 15%;height: 18px;" type="checkbox"  <?php if( $sup_array['sup_app_Orders']=='1' ){ ?> checked <?php } ?>class="form-control form-control-solid" name="sup_app_Orders">
	  <span class="checkmark"></span>
	  </label>
    </div>
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">All_orders
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $sup_array['sup_app_All_orders']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="sup_app_All_orders">
<span class="checkmark"></span>
</label>
    </div>
	
		<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Quotes
<input style="width: 15%;height: 18px;" type="checkbox"  <?php if( $sup_array['sup_app_Quotes']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="sup_app_Quotes">
<span class="checkmark"></span>
</label>  
    </div>
	
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Project Details
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $sup_array['sup_app_Project_details']=='1' ){ ?> checked <?php } ?>  class="form-control form-control-solid" name="sup_app_Project_details">
<span class="checkmark"></span>
</label>  
    </div>
	
<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Account Details
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $sup_array['sup_app_Account_Details']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="sup_app_Account_Details">
<span class="checkmark"></span>
</label>  
    </div>
			 

</div>
</div>



</div>



</div>

<!-- second model -->



<!-- Third model -->

         <h5 class="card-title">App Permissions  <span style="margin-left:20px;"><strong>(Operative) </strong><span></h5>
  <div class="form-group" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 

   <div class="form-group">
   

  <div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Categories 
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $ope_array['ope_app_Categories']=='1' ){ ?> checked <?php } ?> class="col-md-6 form-control" name="ope_app_Categories">
<span class="checkmark"></span>
</label>
    </div>
   
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">Orders
      <input style="width: 15%;height: 18px;" type="checkbox" <?php if( $ope_array['ope_app_Orders']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="ope_app_Orders">
	  <span class="checkmark"></span>
	  </label>
    </div>
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;">All orders
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $ope_array['ope_app_All_orders']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="ope_app_All_orders">
<span class="checkmark"></span>
</label>
    </div>
	
		<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Quotes
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $ope_array['ope_app_Quotes']=='1' ){ ?> checked <?php } ?>   class="form-control form-control-solid" name="ope_app_Quotes">
<span class="checkmark"></span>
</label>  
    </div>
	
	
	<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Project details
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $ope_array['ope_app_Project_details']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="ope_app_Project_details">
<span class="checkmark"></span>
</label>  
    </div>
	
<div style="align-items: center;display: flex;">
	<label class="col-md-6 pl-0 checkbox_container" style="margin-bottom: 0px;"> Account Details
<input style="width: 15%;height: 18px;" type="checkbox" <?php if( $ope_array['ope_app_Account_Details']=='1' ){ ?> checked <?php } ?> class="form-control form-control-solid" name="ope_app_Account_Details">
<span class="checkmark"></span>
</label>  
    </div>

             
			 

</div>
</div>



</div>



</div>

<!-- Third model -->

</div>

</div>
</div>

</div>
<!-- account settings -->
<div class="card card-custom gutter-b example example-compact">

</div>

<!-- account settings -->

</div>
<?php } ?>
</div>

<!-- New form -->



 </form>
    </div>
  </div>
</div>
<script>

$('#')





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
				$(".extenddynamic").css("height","1147px");
			}
			
			if(jQuery('#DedicateAccount').prop('checked') == false)
			{
				jQuery('#DedicateAccountdiv').css('display','none');
				$(".dedicatevalue").prop('required',false);
				$(".dedicatevalue").prop('required',false);
					$(".extenddynamic").css("height","970px");
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


