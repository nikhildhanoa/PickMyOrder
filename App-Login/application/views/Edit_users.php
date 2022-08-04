<?php  error_reporting(0);
     
  $editid=$_GET['id'];
  $select_single_user_query="select * from dev_users where id='$editid'";
  $select_single_user=$this->db->query($select_single_user_query);
  $select_single=$select_single_user->result_array();
	   ?>	
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
.edit_user_premssion_icon .form-group{
	margin-bottom:10px;
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
<div class="card card-custom gutter-b example example-compact" style="height: 770px;">
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
 <form method="post" action="<?php echo site_url('editusers'); ?>">
  <div class="form-horizontal">
   <div class="form-group ">
      <label for="email">Name</label>

	  
      <input type="text" required class="form-control form-control-solid" id="email" placeholder="Enter Name" name="Name" value="<?php echo $select_single[0]['person_name']; ?>">
     <input type="hidden" id="user_id_id" value="<?php echo $editid;  ?>" >
	</div>

<input type="hidden" name="hiduser" value="<?php echo $select_single[0]['id']; ?>">
	
   <!----------------address-------------------------> 
   <div class="form-group">
 <label for="email">User Name</label>
	 
	
      <input type="text" class="form-control form-control-solid" id="email" placeholder="Enter Your User Name" name="uname" required value="<?php echo $select_single[0]['user_name']; ?>">
   
 </div>
   <!----------------post code------------------------->
  
   <div class="form-group ">
 <label for="email">Email Address</label>
	 
	 
      <input type="email" class="form-control form-control-solid" id="user_email" placeholder="Email Address" name="email" required value="<?php echo $select_single[0]['email']; ?>"><span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>

	</div>
	
	
   <!----------------Email------------------------->

   <div class="form-group ">
 <label for="email">Password</label>
	
	
      <input type="Password" class="form-control form-control-solid" id="email" placeholder="Password" name="Password" required value="<?php echo $select_single[0]['password']; ?>">
    
  </div>
 
	 
  
	
  
  </div>
</div>
  </div>
</div>
  </div>
</div>
  </div>
</div>


<div class="col-md-6 border">
	<div class="card card-custom gutter-b example example-compact edit_user_premssion_icon">
	<div class="card-header">
         <h3 class="card-title">Permissions</h3>
	
		 </div>
 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 <div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Full
  <input style="width: 15%;height: 18px;" class="form-check-input  form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox1" value="Full" name="Full" <?php if($select_single[0]['permission_full']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>
  </div>
</div>

<?php  $role=$_SESSION['status']['role'];  

 if($role==1){
  ?>

<div class="form-group">
	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Super Admin
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Super_Admin" name="Super_Admin" <?php if($select_single[0]['role']=='1' ){?>checked <?php } ?> >
	 <span class="checkmark"></span>
	 </label>
</div>
</div>

 <?php  } ?>




<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Products
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Products" name="Products" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_products']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Orders
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Orders" name="Orders" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_orders']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Suppliers
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Suppliers" name="Suppliers" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_suppliers']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Engineers
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Engineers" name="Engineers" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_engineers']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Projects
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Projects" name="Projects" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_projects']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Catologes
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Catologes" name="Catologes"  <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_catologes']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Categories 
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Categories" name="Categories"  <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_categories']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Notifications
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Notifications" name="Notifications" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_notifications']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Stores
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="Stores" name="Stores"  <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_store']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
   <div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">delevery cost
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="deleverycost" name="deleverycost" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_deleverycost']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
  </div>
   </div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Quotes
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2" value="quotes" name="quotes" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_quotes']=='1'){?>checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>
<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">VAN Stock
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2"  name="vanstock" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_vanstock']=='1'){?> checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>

<div class="form-group">

	<div style="align-items: center;display: flex;">
  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Electrical Catalogue
    <input style="width: 15%;height: 18px;" class="form-check-input checkboxx form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="inlineCheckbox2"  name="Electrical_Catalogue" <?php if($select_single[0]['permission_full']=='1' || $select_single[0]['permission_ElectricalCatalogue']=='1'){?> checked <?php } ?>>
	 <span class="checkmark"></span>
	 </label>
</div>
</div>


<div class="form-group select-opt mt-5">
   <div class="col-md-4 pl-0">
	     <p>Buisness</p>
		 </div>
	    <div class="col-md-8">
        <select  name="Buisness" class="form-control form-control-solid">
		<?php $Get_Data = $this->db->query('select *from dev_business');
          $All_business=$Get_Data->result_array();
		?>	
		<option value="<?= $select_single[0]['business']; ?>"><?= $select_single[0]['business']; ?></option>
		<?php foreach($All_business as $Data) { ?>
		<option value="<?php echo $Data['business_name']; ?>"><?php echo $Data['business_name']; ?></option>
		<?php } ?>
		</select>
		  </div>
		  </div>
<div class="form-group">

	<div style="align-items: center;display: flex;">

  <label class="form-check-label ck col-md-6 pl-0 checkbox_container">Wholesaler App
     <input style="width: 15%;height: 18px;" class="form-check-input  form-control form-control-solid checks col-md-6 form-control" type="checkbox" id="p11" value="Wholesaler_App" name="Wholesaler_App" <?php if( $select_single[0]['permission_wholeseller']=='1'){?>checked <?php } ?>>
	  <span class="checkmark"></span>
	 </label>

</div>
</div>
 <div class="form-group submit-btn-sec mt-5"> <input class="btn btn-info" type="submit" name="update_user" value="Update"></div>
 
</div>
</div>
</div>
</div>
</div>
</div>

 <!-- </form>-->
<hr>
</div>



</form>


</div>


	  
    </div>
    
  </div>
</div>
<script>

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
		var editid= $('#user_id_id').val();
	var user="user";
		if(user_email!='')
		{
			$.ajax({
				url:'<?= base_url('')?>checkuserexsist',
				method:'post',
				data:{'useremail':user_email,'check':user,'editid':editid},
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
