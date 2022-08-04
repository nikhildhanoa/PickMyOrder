<?php  error_reporting(0);
     
       $editid=$_GET['id'];
	   
	      $select_single_user_query="select * from dev_users where id='$editid'";
		$select_single_user=$this->db->query($select_single_user_query);
	   $select_single=$select_single_user->result_array();
	  $select_single= $select_single[0];
	  
	      
	  
	   ?>	
<div class="container">
  

  <ul class="nav nav-tabs">
    
    <!--<li><a data-toggle="tab" href="#menu1">Edit Users</a></li>-->
		
  </ul>

  <div class="tab-content">
 
    <div id="menu1" class="tab-pane  active">
      <h3>Edit User</h3>
      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
<body>
<div id="form">
<div class="container">
	 
	    <div class="row">
	    <div class="col-md-6 col-xs-12">

  <!--<form class="form-inline" action="/action_page.php">-->
 <!----------------busniss-name------------------------->   
 <form method="post" action="<?php echo site_url('editusers'); ?>">
  <div class="form-horizontal">
   <div class="form-group ">
      <label class="control-label col-md-4" for="email">Name</label>

	  <div class="col-md-8">
      <input type="text" required class="form-control" id="email" placeholder="Enter Name" name="Name" value="<?php echo $select_single['person_name']; ?>">
    </div>	
	</div>

<input type="hidden" name="hiduser" value="<?php echo $select_single['id']; ?>">
	
   <!----------------address-------------------------> 
   <div class="form-group">
 <label class="control-label col-md-4" for="email">User Name</label>
	 
	  <div class="col-md-8">
      <input type="text" class="form-control" id="email" placeholder="Enter Your User Name" name="uname" required value="<?php echo $select_single['user_name']; ?>">
    </div>
 </div>
   <!----------------post code------------------------->
  
   <div class="form-group ">
 <label class="control-label col-md-4" for="email">Email Address</label>
	 
	  <div class="col-md-8">
      <input type="email" class="form-control" id="user_email" placeholder="Email Address" name="email" required value="<?php echo $select_single['email']; ?>"><span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>
    </div>
	</div>
	
	
   <!----------------Email------------------------->

   <div class="form-group ">
 <label class="control-label col-md-4" for="email">Password</label>
	
	  <div class="col-md-8">
      <input type="Password" class="form-control" id="email" placeholder="Password" name="Password" required value="<?php echo $select_single['password']; ?>">
    </div>
  </div>
 
	 
  
	
  
  </div>
</div>


 <!-- </form>-->
<hr>
</div>
<!-------email-section--->
 <div id="email_sec">
 <div class="">
   <div class="row">
     <div class="col-md-12">
      <h2>Permissions</h2>
</div>
<div class="col-md-6 border">
    <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Full</label>
  <input  class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Full" name="Full" <?php if($select_single['permission_full']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Products</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Products" name="Products" <?php if($select_single['permission_full']=='1' || $select_single['permission_products']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Orders</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Orders" name="Orders" <?php if($select_single['permission_full']=='1' || $select_single['permission_orders']=='1'){?>checked <?php } ?>>
</div>

<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Suppliers</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Suppliers" name="Suppliers" <?php if($select_single['permission_full']=='1' || $select_single['permission_suppliers']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Engineers</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Engineers" name="Engineers" <?php if($select_single['permission_full']=='1' || $select_single['permission_engineers']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Projects</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Projects" name="Projects" <?php if($select_single['permission_full']=='1' || $select_single['permission_projects']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Catologes</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Catologes" name="Catologes"  <?php if($select_single['permission_full']=='1' || $select_single['permission_catologes']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Categories</label> 
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Categories" name="Categories"  <?php if($select_single['permission_full']=='1' || $select_single['permission_categories']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Notifications</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Notifications" name="Notifications" <?php if($select_single['permission_full']=='1' || $select_single['permission_notifications']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Stores</label> 
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Stores" name="Stores"  <?php if($select_single['permission_full']=='1' || $select_single['permission_store']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">delevery cost</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="deleverycost" name="deleverycost" <?php if($select_single['permission_full']=='1' || $select_single['permission_deleverycost']=='1'){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox2">Quotes</label>
    <input  class="form-check-input" type="checkbox" id="inlineCheckbox2" value="quotes" name="quotes" <?php if($select_single['permission_full']=='1' || $select_single['permission_quotes']=='1'){?>checked <?php } ?>>
</div>
</div>
<div class="col-md-6">
   <div class="col-md-4">
	     <p>Buisness</p>
		 </div>
	    <div class="col-md-8">
        <select  name="Buisness">
		<?php $Get_Data = $this->db->query('select *from dev_business');
          $All_business=$Get_Data->result_array();
		?>	
		<option value="<?= $select_single['business']; ?>"><?= $select_single['business']; ?></option>
		<?php foreach($All_business as $Data) { ?>
		<option value="<?php echo $Data['business_name']; ?>"><?php echo $Data['business_name']; ?></option>
		<?php } ?>
		</select>
		  </div>
		  <div class="col-md-12">
  <!-- <div class="super_cont">
  <label class=" ck col-md-4" for="inlineCheckbox2">Super Admin</label>
     <div class="col-md-8"> <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Super_Admin" name="Super Admin" <?php if( $select_single['permission_super_Admin']=='1'){?>checked <?php } ?>></div>
</div>-->  

<div class="super_cont">
  <label class=" ck col-md-4" for="inlineCheckbox2">Wholesaler App</label>
     <div class="col-md-8"> <input class="form-check-input" type="checkbox" id="p11" value="Wholesaler_App" name="Wholesaler_App" <?php if( $select_single['permission_wholeseller']=='1'){?>checked <?php } ?>></div>
</div>
		  </div>
  <div class="offset-md-4 col-md-8"> <input type="submit" name="update_user" value="Update"></div>
     </div>
</div>
</form>
   </div>
  
 </div>
</div>


	  
    </div>
    
  </div>
</div>
<script>
$('#user_email').blur(function(){
		var user_email=$(this).val();
		if(user_email!='')
		{
			$.ajax({
				url:'<?= base_url('')?>checkuserexsist',
				method:'post',
				data:{'useremail':user_email},
				success:function(data)
				{
					
					if(data=='1')
					{
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
