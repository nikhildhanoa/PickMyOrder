<?php  error_reporting(0);
     
      if(!empty( $this->session->userdata('Current_Business')))
				 {
					$business_id = $this->session->userdata('Current_Business');
				 }
				 else
				 {
					$status = $this->session->userdata('status');
					$business_id=$status['business_id']; 
				 }
	   
	      $select_single_user_query="select * from dev_business where id='$business_id'";
		$select_single_user=$this->db->query($select_single_user_query);
	   $select_single=$select_single_user->result_array();
	  $select_single= $select_single[0];
	  
	  
	  
	  $Business_Plans_query="select * from dev_Business_Plans where business_id='$business_id'";
	  $Business_Plans=$this->db->query($Business_Plans_query);
	  $Business_Plans=$Business_Plans->result_array();
	  $Business_Plans= $Business_Plans[0];
	  
	  
	  
	   ?>	
	   

<style>
.user_option .form-group {
    margin-bottom: 10px;
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
.select-opt select {
    width: 100%;
    padding: 4px;
    border-radius: 4px;
}
</style>	   
	   
	   
	   
<div class="container">
  

  <ul class="nav nav-tabs">
    
    <!--<li><a data-toggle="tab" href="#menu1">Edit Users</a></li>-->
		
  </ul>

  <div class="tab-content">
 
    <div id="menu1" class="tab-pane  active">
     
      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
<body>
<div id="form">
<div class="container">
	 
	    <div class="row">
	    <div class="col-md-6 col-xs-12">
<div class="card card-custom gutter-b example example-compact" style="min-height: 780px;">
<div class="card-header">
         <h3 class="card-title">General Details</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
  <!--<form class="form-inline" action="/action_page.php">-->
 <!----------------busniss-name------------------------->   
 <form method="post" action="<?php echo site_url('users'); ?>">
  <div class="form-horizontal">
   <div class="form-group ">
      <label for="email">Name</label>

	  
      <input type="text" required class="form-control form-control-solid" id="email" placeholder="Enter Name" name="Name" >
   
	</div>


	
   <!----------------address-------------------------> 
   <div class="form-group">
 <label for="email">User Name</label>
	 
	
      <input type="text" class="form-control form-control-solid" id="email" placeholder="Enter Your User Name" name="uname" required >
   
 </div>
   <!----------------post code------------------------->
  
   <div class="form-group ">
 <label for="email">Email Address</label>
	 
	 
      <input type="email" class="form-control form-control-solid" id="user_email" placeholder="Email Address" name="email" required ><span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>

	</div>
	
	
   <!----------------Email------------------------->

   <div class="form-group ">
 <label for="email">Password</label>
	
	
      <input type="Password" class="form-control form-control-solid" id="email" placeholder="Password" name="Password" required >
    
  </div>
 
	 
  
	
  
  </div>
</div>
  </div>
</div>
  </div>
</div>
  </div>
</div>

<div class="col-md-6 border user_option">
	<div class="card card-custom gutter-b example example-compact">
	<div class="card-header">
         <h3 class="card-title">Premission</h3>	    
		 </div>
	
 <div class="card-body">
  <p style="color:#B80F0A;display:none" id="erropre"> This Permission is not valid for this Business</p>
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 <div class="form-group">

	<div style="align-items: center;display: flex;position:relative" >
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Full
  
  <input <?php $full=0; if($select_single['Trial_business']=='2'){ if($full=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?>    style="width: 15%;height: 18px;" class="form-check-input form-control form-control-solid checks col-md-6 form-control" type="checkbox"  id="inlineCheckbox1" value="Full" name="Full" >
 
   <span class="checkmark"  id="<?php echo  $full;  ?>"></span>
 <input type="hidden" id="hidetype"  value="<?php echo $select_single['Trial_business'];  ?>">
  </label>
  </div>
</div>

<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Products
    <input  <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_products']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Products" name="Products" >
	
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_products'];  ?>"></span>
	 </label>
</div>
</div>

<?php  $role=$_SESSION['status']['role'];  

 if($role==1){
  ?>

<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Super Admin
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Super_Admin" name="Super_Admin" >
	 <span class="checkmark" ></span>
	 </label>
</div>
</div>

 <?php  } ?>

<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Orders
    <input <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_orders']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?>  style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Orders" name="Orders" >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_orders'];  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Suppliers
    <input <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_suppliers']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Suppliers" name="Suppliers" >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_suppliers'];  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Engineers
    <input <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_engineers']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Engineers" name="Engineers" >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_engineers'];  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Projects
    <input <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_projects']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Projects" name="Projects" >
	 <span class="checkmark"id="<?php echo $Business_Plans['permission_projects'];  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Catologes
    <input  <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_catologes']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Catologes" name="Catologes" >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_catologes'];  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Categories 
    <input <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_categories']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Categories" name="Categories"  >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_categories'];  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Notifications
    <input <?php $Notifications=0;  if($select_single['Trial_business']=='2'){ if($Notifications=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Notifications" name="Notifications">
	 <span class="checkmark" id="<?php echo $Notifications;  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Stores
    <input  <?php $Stores=0;  if($select_single['Trial_business']=='2'){ if($Stores=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?>  style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Stores" name="Stores" >
	 <span class="checkmark" id="<?php echo $Stores;  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">delevery cost
    <input  <?php $delevery=0;  if($select_single['Trial_business']=='2'){ if($delevery=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="deleverycost" name="deleverycost" >
	 <span class="checkmark" id="<?php echo $delevery;  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Quotes
    <input <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_quotes']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="quotes" name="quotes" >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_quotes'];  ?>"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">VAN Stock
    <input  <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_vanstock']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="vanstock"  name="vanstock"   >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_vanstock'];  ?>"></span>
	 </label>
</div>
</div>

<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container"> Electrical Catalogue
    <input <?php  if($select_single['Trial_business']=='2'){ if($Business_Plans['permission_ElectricalCatalogue']=='0'){  ?> style="display:none" disabled <?php } else  {?>  checked  <?php } } ?> style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2"  value="Electrical_Catalogue" name="Electrical_Catalogue" >
	 <span class="checkmark" id="<?php echo $Business_Plans['permission_ElectricalCatalogue'];  ?>"></span>
	 </label>
</div>
</div>

<div class="form-group select-opt">
   <div class="">
	     <p>Buisness</p>
		 </div>
	    <div class="col-md-8 pl-0">
        <select  name="Buisness">
		<?php
         $id=$select_single['id'];

		$Get_Data = $this->db->query("select *from dev_business where id NOT IN ($id)");
          $All_business=$Get_Data->result_array();
		?>	
		<option value="<?= $select_single['business_name']; ?>"><?= $select_single['business_name']; ?></option>
		<?php foreach($All_business as $Data) { ?>
		<option value="<?php echo $Data['business_name']; ?>"><?php echo $Data['business_name']; ?></option>
		<?php } ?>
		</select>
		  </div>
		   </div>
	<div class="form-group">

	<div style="align-items: center;display: flex;">

  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Wholesaler App
     <input style="width: 15%;height: 18px;" class="form-check-input  form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="p11" value="Wholesaler_App" name="Wholesaler_App" >
	  <span class="checkmark"></span>
	 </label>

</div>
</div>

 <div class="form-group submit-btn-sec"> <input class="btn btn-info" type="submit" name="Insert_user" value="Update"></div>
		   
</div>
</div>
</div>
</div>
</div>
</div>

 <!-- </form>-->
<hr>
</div>
<!-------email-section--->


  
</form>

  

</div>


	  
    </div>
    
  </div>
</div>
<script>


$('.checkmark').click(function(){
	
	$("#erropre").css("display", "none")
	var hidetype = $('#hidetype').val();
	 var ID = $(this).attr("id");
	
	if(hidetype==2)
	{
	if(ID==0)
	{
		$("#erropre").css("display", "block")
	}		
	}	
});


$('#inlineCheckbox1').change(function(){
	
     if($("#inlineCheckbox1").prop("checked"))
	 {
		 $(".checkboxx").prop("checked",true)
	 }	
	 else 
	 {
		 $(".checkboxx").prop("checked",false)
	 } 
});

$('.checkboxx').change(function(){
	
	if($('.checkboxx:checked').length == $('.checkboxx').length)
	{
		$("#inlineCheckbox1").prop("checked",true)
	}
	else
	{
		$("#inlineCheckbox1").prop("checked",false)
	}
});



$('#user_email').blur(function(){
		var user_email=$(this).val();
		if(user_email!='')
		{
			$.ajax({
				url:'<?= base_url('')?>CheckNewUserExsist',
				method:'post',
				data:{'useremail':user_email},
				success:function(data)
				{
					
					if(data==1)
					{
						$('#user_email').val('');
						$('#user_exsist_error').css('display','block');
						
					}
					
			    }
			       });
			
		}
		
	});
	$('#user_email').focus(function(){
		$('#user_exsist_error').css('display','none');
	});

 </script>
