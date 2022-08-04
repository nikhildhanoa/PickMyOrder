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
        
</style><div class="container">
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Edit <?php echo $type ;?></a></li>
    
		
  </ul>

  <div class="tab-content">
   
    <div id="menu1" class="tab-pane active">
   <div id="form">
<div class="container">
	 
	    <div class="row">
		     <div class="col-md-12 col-xs-12">  <h3>Add <?php echo $type ;?></h3></div>
	    <div class="col-md-6 col-xs-12">
      
  <form method="post" action="<?php echo site_url('editengineer');?>">
   <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label class="col-md-3" for="email">First Name</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="First Name" name="name" value="<?php echo $select_single['name'];?>">
    </div>
	</div>
   <!----------------address------------------------->   
   <!----------------last-name------------------------->   
   <div class="form-group">
      <label class="col-md-3" for="email">Last Name</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Last Name" name="lastName" value="<?php echo $select_single['newlastname'];?>">
    </div>
	</div>
   <!----------------address------------------------->   
   <div class="form-group">
 <label class="col-md-3" for="email">User Name</label>

	  <div class="col-md-9 ">
      <input required type="text" class="form-control" id="email" placeholder="Enter Your User Name" name="uname" value="<?php echo $select_single['user_name'];?>">
    </div>	
	</div>
   <!----------------post code-------------------------> 
   <div class="form-group">
     <label class="col-md-3" for="email">Email Address</label>

	  <div class="col-md-9">
      <input required type="email" class="form-control" id="user_email" placeholder="Email Address" name="email" value="<?php echo $select_single['email'];?>"><span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>
    </div>
		  </div>
		  
		  <div class="form-group">
      <label class="col-md-3" for="email">Account Number</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Account Number" name="accnumber" value="<?php echo $select_single['newaccnumber'];?>">
    </div>
	</div>
	
	<div class="form-group">
      <label class="col-md-3" for="email">Business  Name</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control"  placeholder="Business Name" name="businessName" value="<?php echo $select_single['newbussiname'];?>">
    </div>
	</div>
   <!----------------Email------------------------->
   <div class="form-group">
    <label class="col-md-3" for="email">Password</label>
	
	  <div class="col-md-9 ">
      <input required type="Password" class="form-control" id="email" placeholder="Password" name="Password" value="<?php echo $select_single['password'];?>">
    </div> 
	</div>
	<!--------------------------------HiddenWholeSeller_Value------------------------------>
	 
	<input type="hidden" name='hid' value="<?php echo $select_single['id'];?>">
	 <input type="hidden" name='hiduserid' value="<?php echo $select_single['user_id'];?>">


	</div>
  
</div>
    <div class="col-md-6 col-xs-12">
      
   <div class="form-horizontal">
    <div class="form-group">
      <label class="col-md-3" for="email">Company Name</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Company Name" name="billingcompany" value="<?php echo $select_single['newCname'];?>">
    </div>
	</div>
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label class="col-md-3" for="email">Billing address</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Billing address" name="billingaddress" value="<?php echo $select_single['newBaddress'];?>">
    </div>
	</div>
   <!----------------address------------------------->   
   <!----------------last-name------------------------->   
  
   <!----------------address------------------------->   
   <div class="form-group">
 <label class="col-md-3" for="email">Address</label>

	  <div class="col-md-9 ">
      <input required type="text" class="form-control" id="email" placeholder="Company Address" name="billingcompanyaddress" value="<?php echo $select_single['newCaddress'];?>">
    </div>	
	</div>
   <!----------------post code-------------------------> 
   <div class="form-group">
     <label class="col-md-3" for="email">City</label>

	  <div class="col-md-9">
      <input required type="text" class="form-control"  placeholder="City" name="billingcity" value="<?php echo $select_single['newCcity'];?>">
    </div>
		  </div>
		  
		  <div class="form-group">
      <label class="col-md-3" for="email">Postcode</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Postcode" name="billingpostcode" value="<?php echo $select_single['newCpostcode'];?>">
    </div>
	</div>
	<div class="form-group">
      <label class="col-md-3" for="email">Company Name </label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Company Name" name="delivercompanyname" value="<?php echo $select_single['newDCname'];?>">
    </div>
	</div>
	<div class="form-group">
      <label class="col-md-3" for="email">Delivery address </label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Delivery address" name="deliveryaddress" value="<?php echo $select_single['newDaddress'];?>">
    </div>
	</div>
	
	<div class="form-group">
      <label class="col-md-3" for="email">Address </label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="address" Name="diliverycompanyaddress" value="<?php echo $select_single['newDCaddress'];?>">
    </div>
	</div>
	<div class="form-group">
      <label class="col-md-3" for="email">City</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="City" name="diliverycompnycity" value="<?php echo $select_single['newDCcity'];?>">
    </div>
	</div>
<div class="form-group">
      <label class="col-md-3" for="email">Postcode</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Postcode" name="diliverycompanypostcode" value="<?php echo $select_single['newDCpostcode'];?>">
    </div>
	</div>
	 
	
	
	<input  type="hidden" class="form-control"  name="HiddenWholeSeller_Value" value="<?php echo $select_single['wholeseller_status'];?>">

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
    
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Supervisor</label>
  <input  class="form-check-input" type="checkbox"  id="p1" value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1"> Operative</label>
  <input  class="form-check-input" type="checkbox" id="p2"  value="Operative" name="Operative" <?php if($select_single_permi['Operative']=='1'&& $select_single_permi['Guest']=='0'  ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1"> Guest</label>
  <input  class="form-check-input" type="checkbox" id="p12"  value="Operative" name="guest" <?php if($select_single_permi['atradeya_retail']=='1' ){?>checked <?php } ?>>
</div>

<div class="form-check form-check-inline dis" >
  <label class="form-check-label ck" for="inlineCheckbox1">Categories</label>
  <input  class="form-check-input" type="checkbox"  id="p3" value="Categories" name="Categories" <?php if($select_single_permi['Categories']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis" >
  <label class="form-check-label ck" for="inlineCheckbox1">Orders</label>
  <input  class="form-check-input" type="checkbox"  id="p4" value="Orders" name="Orders" <?php if($select_single_permi['Orders']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis" >
  <label class="form-check-label ck" for="inlineCheckbox1" >Project Details</label>
  <input  class="form-check-input" type="checkbox"  id="p5" value="Project details" name="Project_details" <?php if($select_single_permi['Project_details']=='1' ){?>checked <?php } ?>>
</div>
<!--<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Quotes</label>
  <input  class="form-check-input" type="checkbox"  id="p6" value="Quotes" name="Quotes">
</div>-->
<div class="form-check form-check-inline dis" >
  <label class="form-check-label ck" for="inlineCheckbox1">Catalogues</label> 
  <input  class="form-check-input" type="checkbox" id="p7"  value="Catalogues" name="Catalogues" <?php if($select_single_permi['Catalogues']=='1' ){?>checked <?php } ?>>
</div>

<div class="form-check form-check-inline dis" >
  <label class="form-check-label ck" for="inlineCheckbox1">All Orders</label>
  <input  class="form-check-input" type="checkbox"  id="p8" value="All_orders" name="All_orders" <?php if($select_single_permi['All_orders']=='1' ){?>checked <?php } ?>>
</div>
 <div class="form-check form-check-inline dis" >
  <label class="form-check-label ck" for="inlineCheckbox1">Orders To Approve</label>
  <input  class="form-check-input" type="checkbox"  id="p9" value="Orders_to_Approve" name="Orders_to_Approve" <?php if($select_single_permi['Orders_to_Approve']=='1' ){?>checked <?php } ?>>
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">See Costs</label>
  <input  class="form-check-input" type="checkbox" id="p10" value="See_costs" name="See_costs" <?php if($select_single_permi['See_costs']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis" >
  <label class="form-check-label ck" for="inlineCheckbox1">Add Products</label>
  <input  class="form-check-input" type="checkbox" id="p11" value="addproduct" name="addproduct" <?php if($select_single_permi['AddProduct']=='1' ){?>checked <?php } ?>>
</div>



</div>









<div class="col-md-6">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
 <div class="form-group singleorderlimit" style="display:none" >

	     <label class="control-label col-md-6" for="Project_Amount">Limit of Single order </label>
		
	    <div class="col-md-6">
        <input class="form-control" id="singleorderlimitperday" type="number" name="single_order_per_day" placeholder="0.00" min="1" max="100000" >
		  </div>
		  
		   </div>
   <div class="form-group orderlimit" style="display:none">

	     <label class="control-label col-md-6" for="Project_Amount">Limit of order per day</label>
		
	    <div class="col-md-6">
        <input class="form-control" id="orderlimitperday" type="number" name="order_per_day" placeholder="0.00" min="1" max="100000" >
		  </div>
		  
		   </div>
		   
 <!------------------ 
		      <div class="form-group orderlimit " style="display:none">

	     <label class="control-label col-md-6" for="Project_Amount">Limit of simple order</label>
		
	    <div class="col-md-6 ">
       	 <input class="form-control" type="number" name="simple_order" placeholder="0.00" min="1" max="100000">
		  </div>
		  
		   </div>-->
 
  <div class="form-group ">

		
	    <div class="offset-md-6 col-md-6">
<input type="submit" name="Edit_Enginner" class="btn btn-info " value="Update">

		  </div>
		  
		   </div>


</form>
		   
 
 
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