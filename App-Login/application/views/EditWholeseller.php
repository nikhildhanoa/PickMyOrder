<?php error_reporting(0);
if($_SESSION['status']['iswholseller'] )
{
	$type="Users";
	$ishidden='none';
}
else
{
	$type="Engineers";
	$ishidden='block';
	if($this->DataModel->CheckBussinessStatus()==1)
	{
		$type="Users"; 
		$ishidden='none';
			if(isset($_SESSION['Current_Business']))
		{
        	$cbid=$_SESSION['Current_Business'];
        	$data=$this->db->query("select business_name from dev_business where id='$cbid'");
            $dataarray=$data->result_array();
        	   if($dataarray[0]['business_name']=='Atradeya Electrical')
        	   {
        	       $trade="trade";
        	       $guest="guest";
        	   }
        	   else
        	   {
        	       $trade="Bussiness";
        	       $guest="Oprative";
        	   }
		}
	}
}
$editid=$_GET['id'];
	   
	      $select_single_engineer_query="select * from dev_engineer where id='$editid'";
		$select_single_engineer=$this->db->query($select_single_engineer_query);
	   $select_single_engineer=$select_single_engineer->result_array();
	  $select_single= $select_single_engineer[0];
	 
	  $select_single_engineer_permi_query="select * from dev_engineer_permissions where engineer_id='$editid'";
		$select_single_engineer_permi=$this->db->query($select_single_engineer_permi_query);
	   $select_single_engineer_permi=$select_single_engineer_permi->result_array();
	  
	  $select_single_permi= $select_single_engineer_permi[0];
	
	  
	   ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
.select-opt select {
    width: 100%;
    padding: 4px;
    border-radius: 4px;
}
.new_card{
	padding-bottom:283px !important;
}
</style>	
<div class="container">
  

 

  <div class="tab-content">
   
    <div id="menu1" class="tab-pane active">
   <div id="form">
<div class="container">
	 
	    <div class="row">
		  
	    <div class="col-md-6 col-xs-12">
      
	  <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">General Details</h3>
	
		 </div>
		 <div class="card-body new_card">
	<div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg">

  <div class="form-horizontal">
    <div class="form-group">
	  
	  
  <form method="post" action="<?php echo site_url('editengineer');?>">
   <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label>First Name</label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="First Name" name="name" value="<?php echo $select_single['name'];?>">
    
	</div>
   <!----------------address------------------------->   
   <!----------------last-name------------------------->   
   <div class="form-group">
      <label>Last Name</label>
	  
	 
      <input required type="text" class=" form-control form-control-solid" id="email" placeholder="Last Name" name="lastName" value="<?php echo $select_single['newlastname'];?>">
    
	</div>
   <!----------------address------------------------->   
   <div class="form-group">
 <label>User Name</label>

	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Enter Your User Name" name="uname" value="<?php echo $select_single['user_name'];?>">
    
	</div>
   <!----------------post code-------------------------> 
   <div class="form-group">
     <label>Email Address</label>

	  
      <input required type="email" class="form-control form-control-solid" id="user_email" placeholder="Email Address" name="email" value="<?php echo $select_single['email'];?>"><span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>
    
		  </div>
		  
		  <div class="form-group">
      <label>Account Number</label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Account Number" name="accnumber" value="<?php echo $select_single['newaccnumber'];?>">
   
	</div>
	
	<div class="form-group">
      <label>Business  Name</label>
	  
	  
      <input required type="text" class="form-control form-control-solid"  placeholder="Business Name" name="businessName" value="<?php echo $select_single['newbussiname'];?>">
   
	</div>
   <!----------------Email------------------------->
   <div class="form-group">
    <label>Password</label>
	
	  <div>
      <input required type="Password" class="form-control form-control-solid" id="email" placeholder="Password" name="Password" value="<?php echo $select_single['password'];?>">
    </div> 
	</div>
	<!--------------------------------HiddenWholeSeller_Value------------------------------>
	 
	<input type="hidden" name='hid' value="<?php echo $select_single['id'];?>">
	 <input type="hidden" name='hiduserid' value="<?php echo $select_single['user_id'];?>">


	</div>
  
</div>
</div>
</div>
</div>
</div>
</div>
</div>







    <div class="col-md-6 col-xs-12">
       <div class="card card-custom gutter-b example example-compact">

		 <div class="card-body">
	<div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
   <div class="form-horizontal">
    <div class="form-group">
      <label style="margin-top: 69px;">Company Name</label>
	  
	  <div>
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Company Name" name="billingcompany" value="<?php echo $select_single['newCname'];?>">
    </div>
	</div>
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label>Billing address</label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Billing address" name="billingaddress" value="<?php echo $select_single['newBaddress'];?>">
    
	</div>
   <!----------------address------------------------->   
   <!----------------last-name------------------------->   
  
   <!----------------address------------------------->   
   <div class="form-group">
 <label>Address</label>

	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Company Address" name="billingcompanyaddress" value="<?php echo $select_single['newCaddress'];?>">
    
	</div>
   <!----------------post code-------------------------> 
   <div class="form-group">
     <label>City</label>

	  
      <input required type="text" class="form-control form-control-solid"  placeholder="City" name="billingcity" value="<?php echo $select_single['newCcity'];?>">
   
		  </div>
		  
		  <div class="form-group">
      <label>Postcode</label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Postcode" name="billingpostcode" value="<?php echo $select_single['newCpostcode'];?>">
    
	</div>
	<div class="form-group">
      <label>Company Name </label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Company Name" name="delivercompanyname" value="<?php echo $select_single['newDCname'];?>">
    
	</div>
	<div class="form-group">
      <label>Delivery address </label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Delivery address" name="deliveryaddress" value="<?php echo $select_single['newDaddress'];?>">
  
	</div>
	
	<div class="form-group">
      <label>Address </label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="address" Name="diliverycompanyaddress" value="<?php echo $select_single['newDCaddress'];?>">
   
	</div>
	<div class="form-group">
      <label>City</label>
	  
	   
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="City" name="diliverycompnycity" value="<?php echo $select_single['newDCcity'];?>">
    
	</div>
<div class="form-group">
      <label>Postcode</label>
	  
	  
      <input required type="text" class="form-control form-control-solid" id="email" placeholder="Postcode" name="diliverycompanypostcode" value="<?php echo $select_single['newDCpostcode'];?>">
   
	</div>
	 
	
	
	<input  type="hidden" class="form-control form-control-solid"  name="HiddenWholeSeller_Value" value="<?php echo $select_single['wholeseller_status'];?>">

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

<!-------email-section--->
 <div id="email_sec">
 <div class="container">
   <div class="row">
     <div  class="col-md-12 per">
      <h2>Permissions</h2>
	  <hr>
</div>






<div class="col-md-6 border">
    <div class="card card-custom gutter-b example example-compact">
 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 
 <div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Supervisor
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


 <div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Operative
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Guest
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Categories
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Orders
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Project Details
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>

<!--<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Quotes</label>
  <input  class="form-check-input" type="checkbox"  id="p6" value="Quotes" name="Quotes">
</div>-->
<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Catalogues
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">All Orders
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>



 <div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Orders To Approve
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


 <div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">See Costs
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>

<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Add Products
  <input  style="width: 15%;height: 18px;" class="form-check-input checkbox form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
	</label>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>








<div class="col-md-6">
<div class="card card-custom gutter-b example example-compact">
  <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0 pb-0" style="border: none;">


 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
 <div class="form-group singleorderlimit" style="display:none" >

	     <label>Limit of Single order </label>
		
	
        <input class="form-control form-control-solid" id="singleorderlimitperday" type="number" name="single_order_per_day" placeholder="0.00" min="1" max="100000" >
		 
		  
		   </div>
   <div class="form-group orderlimit" style="display:none">

	     <label>Limit of order per day</label>
		
	 
        <input class="form-control form-control-solid" id="orderlimitperday" type="number" name="order_per_day" placeholder="0.00" min="1" max="100000" >
		
		  
		   </div>
		   
 <!------------------ 
		      <div class="form-group orderlimit " style="display:none">

	     <label class="control-label col-md-6" for="Project_Amount">Limit of simple order</label>
		
	    <div class="col-md-6 ">
       	 <input class="form-control" type="number" name="simple_order" placeholder="0.00" min="1" max="100000">
		  </div>
		  
		   </div>-->
 
  <div class="form-group ">

		
	    <div class="col-md-6">
<input type="submit" name="Edit_Enginner" class="btn btn-info " value="Update">

		  </div>
		  
		   </div>


</form>
		   
 
 
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
jQuery('#p1').change(function(){
	if(jQuery('#p2').prop('checked', true)){
		
		jQuery('#p2').prop('checked', false);
		
	}
	
	if(jQuery('#p1').prop('checked')==false)
		{
	jQuery('#p3').prop('checked', false);
	jQuery('#p4').prop('checked', false);
	jQuery('#p8').prop('checked', false);
	jQuery('#p7').prop('checked', false);
	jQuery('#p10').prop('checked', false);
	
		}
		else
		{
			jQuery('#p12').prop('checked', false);
	jQuery('#p3').prop('checked', true);
	jQuery('#p4').prop('checked', true);
	jQuery('#p8').prop('checked', true);
	jQuery('#p7').prop('checked', true);
	jQuery('#p10').prop('checked', true);
	
$('.orderlimit').css('display','none');
	jQuery('#orderlimitperday').prop('required',false);
	$('.singleorderlimit').css('display','none');
	jQuery('#singleorderlimitperday').prop('required',false);
		}
	
	
});


jQuery('#p2').change(function(){
	if(jQuery('#p1').prop('checked', true)){
		
		jQuery('#p1').prop('checked', false);
		jQuery('#p3').prop('checked', false);
		jQuery('#p4').prop('checked', false);
		jQuery('#p5').prop('checked', false);
		jQuery('#p7').prop('checked', false);
	jQuery('#p8').prop('checked', false);
	jQuery('#p10').prop('checked', false);
		if(jQuery('#p2').prop('checked')==false)
		{
	jQuery('#p3').prop('checked', false);
	jQuery('#p4').prop('checked', false);
	jQuery('#p7').prop('checked', false);
	jQuery('#p8').prop('checked', false);
	jQuery('#p10').prop('checked', false);
	$('.orderlimit').css('display','none');
	jQuery('#orderlimitperday').prop('required',false);
	$('.singleorderlimit').css('display','none');
	jQuery('#singleorderlimitperday').prop('required',false);
		}
		else
		{jQuery('#p12').prop('checked', false);
	jQuery('#p3').prop('checked', true);
	jQuery('#p4').prop('checked', true);
	jQuery('#p7').prop('checked', true);
	jQuery('#p8').prop('checked', true);
	jQuery('#p10').prop('checked', true);
$('.orderlimit').css('display','block');
jQuery('#orderlimitperday').prop('required',true);
$('.singleorderlimit').css('display','block');
	jQuery('#singleorderlimitperday').prop('required',true);
		}
	}
	
	
});
/**********guest********/
jQuery('#p12').change(function(){
	if(jQuery('#p1').prop('checked', true)){
		
		jQuery('#p1').prop('checked', false);
		
	}
	if(jQuery('#p2').prop('checked', true)){
		
		jQuery('#p2').prop('checked', false);
		
	}
if(jQuery('#p12').prop('checked')==false)
		{
	jQuery('#p3').prop('checked', false);
	jQuery('#p4').prop('checked', false);
	jQuery('#p8').prop('checked', false);
	jQuery('#p7').prop('checked', false);
	jQuery('#p10').prop('checked', false);
	jQuery('#p1').prop('checked', false);
	jQuery('#p2').prop('checked', false);
	
	jQuery('#p12').prop('checked', false);	}
		else
		{
		
	jQuery('#p4').prop('checked', true);
	jQuery('#p3').prop('checked', true);
	jQuery('#p4').prop('checked', true);
	jQuery('#p8').prop('checked', true);             
	jQuery('#p7').prop('checked', true);
	jQuery('#p10').prop('checked', true);

$('.orderlimit').css('display','none');
	jQuery('#orderlimitperday').prop('required',false);
	$('.singleorderlimit').css('display','none');
	jQuery('#singleorderlimitperday').prop('required',false);
		}
})

$('#user_email').blur(function(){
		var user_email=$(this).val();
		if(user_email!='')
		{
			$.ajax({
				url:"<?= base_url('')?>checkuserexsist",
				method:'post',
				data:{'useremail':user_email},
				success:function(data)
				{
					
					if(data=='1')
					{
						$('#user_exsist_error').css('display','block');
						$('#user_email').val('');
					}
					
			    }
			       });
			
		}
		
	});
	$('#user_email').focus(function(){
		$('#user_exsist_error').css('display','none');
	});
</script>