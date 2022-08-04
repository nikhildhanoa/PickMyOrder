<?php  error_reporting(0);
if($_SESSION['status']['iswholseller'])
{
	$type="Users";
	$ishidden='none';
}
else
{
	$type="Engineers";
	$ishidden='block';
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
.form-group{
	margin-bottom:10px;
}
</style>	 

<div class="container">
  

  <div class="tab-content">
    
    <div id="menu1" class="tab-pane  active">
		<?php 
   if($this->session->flashdata('successdetails')){
 ?>
   <div class="alert alert-success"> 
     <?php  echo $this->session->flashdata('successdetails'); ?>
	 </div>
<?php  
   }  
if($this->session->flashdata('faileddetails')){
?>
 <div class = "alert alert-success">
   <?php echo $this->session->flashdata('faileddetails'); ?>
 </div>
<?php } ?>
   <div id="form">
<div class="container">
	 
	    <div class="row">
	
		  <!--   <div class="col-md-12 col-xs-12">  <h3>Edit <?php // echo $type;?> </h3></div> -->
	      <div class="col-md-6 col-xs-12">
<div class="card card-custom gutter-b example example-compact" style="min-height: 627px;">
<div class="card-header">
         <h3 class="card-title">General Details</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
      
  <form method="post" action="<?php echo site_url('editengineer');?>">
   <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label>Name</label>
	 
	 
	  
     <input required value="<?php echo $select_single['name']; ?>" type="text" class="form-control form-control-solid"  placeholder="Enter Name" name="name">
   
	</div>
	 <input type="hidden" name='hid' value="<?php echo $select_single['id'];?>">
	 <input type="hidden" name='hiduserid' value="<?php echo $select_single['user_id'];?>">
   <!----------------address------------------------->   
   <div class="form-group">
 <label>User Name</label>

	
      <input required value="<?php echo $select_single['user_name']; ?>" type="text" class="form-control form-control-solid" id="email" placeholder="Enter Your User Name" name="uname">
   
	</div>
   <!----------------post code-------------------------> 
   <div class="form-group">
     <label>Email Address</label>

	 
      <input required value="<?php echo $select_single['email']; ?>" type="email" class="form-control form-control-solid" id="user_email" placeholder="Email Address" name="email">
	  <span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>
   
		  </div>
	
   <!----------------Email------------------------->
   <div class="form-group">
    <label>Password</label>
	
	
      <input required value="<?php echo $select_single['password']; ?>" type="Password" class="form-control form-control-solid" id="email" placeholder="Password" name="Password">
   
	</div>
   <!----------------Contact Name------------------------->
   
	</div>
  
</div>
</div>
</div>
</div>
</div>
 

</div>

<div class="col-md-6 border" style="display:<?php echo $ishidden;?>">
  <div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
         <h3 class="card-title">Permissions</h3>
	
		 </div>
  
 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 
  <div class="form-group">

	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Supervisor
  <input style="width: 15%;height: 18px;" id="p1" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
  
  <span class="checkmark"></span>
  </label>

</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Operative
  <input style="width: 15%;height: 18px;" id="p2" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="Operative" name="Operative" <?php if($select_single_permi['Operative']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>
</div>
</div>

<div class="form-group" style="display:<?php if($select_single_permi['Operative']=='1'){?>block <?Php }else { ?>none <?php }?> ;" id="cardid">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">card
  <input style="width: 15%;height: 18px;" id="p2" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="card" name="card" <?php if($select_single_permi['card']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>
</div>
</div>






  <div class="form-group">
	<div style="align-items: center;display: flex;">
  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Categories
  <input style="width: 15%;height: 18px;" id="p3" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="Categories" name="Categories" <?php if($select_single_permi['Categories']=='1'  ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>
</div>
</div>
  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Orders
  <input style="width: 15%;height: 18px;" id="p4" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="Orders" name="Orders" <?php if($select_single_permi['Orders']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Project details
  <input style="width: 15%;height: 18px;" id="p5" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="Project details" name="Project_details" <?php if($select_single_permi['Project_details']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Catalogues
  <input style="width: 15%;height: 18px;" id="p7" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="Catalogues" name="Catalogues" <?php if($select_single_permi['Catalogues']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">All_orders
  <input style="width: 15%;height: 18px;" id="p8" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="All_orders" name="All_orders" <?php if($select_single_permi['All_orders']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Orders_to_Approve
  <input style="width: 15%;height: 18px;" id="p9" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="Orders_to_Approve" name="Orders_to_Approve" <?php if($select_single_permi['Orders_to_Approve']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>
</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">See_costs
  <input style="width: 15%;height: 18px;" id="p10" class="form-check-input checkbox form-control form-control-solid checks col-md-6 " type="checkbox"  value="See_costs" name="See_costs" <?php if($select_single_permi['See_costs']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">AddProduct
  <input style="width: 15%;height: 18px;" id="p11" class="form-check-input checkbox form-control form-control-solid checks col-md-6 " type="checkbox"  value="addproduct" name="addproduct" <?php if($select_single_permi['AddProduct']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>

  <div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">Quotes
  <input style="width: 15%;height: 18px;" id="p12" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  value="quotes" name="quotes" <?php if($select_single_permi['Quotes']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>
<!--<div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">VAN Stock
  <input style="width: 15%;height: 18px;" id="p13" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"   name="vanstock" <?php if($select_single_permi['van_stock']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>-->

<div class="form-group">
	<div style="align-items: center;display: flex;">

  <label  class="form-check-label ck col-md-6 pl-0 checkbox_container">basic user 
  <input style="width: 15%;height: 18px;" id="p13" class="form-check-input checkbox form-control form-control-solid checks col-md-6" type="checkbox"  name="basic_user" <?php if($select_single_permi['is_basic_user']=='1' ){?>checked <?php } ?>>
  <span class="checkmark"></span>
  </label>

</div>
</div>

 <div style="display:<?php echo $ishidden;?>">
 <!----------------busniss-name------------------------->   
 <div class="form-group singleorderlimit" style="display:<?php if($select_single_permi['Operative']=='1'){ ?>block;<?php }else{  ?>none;<?php } ?>">

	     <label>Limit of Single Order</label>
		
	  
        <input id="singleorderlimitperday" class="form-control form-control-solid mb-5" type="number" name="single_order_per_day" placeholder="0.00" min="1" max="100000" value="<?php echo $select_single_permi['single_order_limit'];?>"><span style="color:red">This is required if oprative</span>
		  
		 
		   </div>
   <div class="form-group orderlimit" style="display:<?php if($select_single_permi['Operative']=='1'){ ?>block;<?php }else{  ?>none;<?php } ?>">

	     <label>Limit of order per day</label>
		
	   
        <input id="orderlimitperday" class="form-control form-control-solid mb-5" type="number" name="order_per_day" placeholder="0.00" min="1" max="100000" value="<?php echo $select_single_permi['limit_order_per_day'];?>"><span style="color:red">This is required if oprative</span>
		 
		 
		   </div>
</div>

 <div class="form-group ">

				<input type="submit" name="Edit_Enginner" class="btn btn-info " value="Update">
</div>

</div>
</div>
</div>
</div>
</div>
</div>


</div>



   

</form>
		   

 


  


<script>
jQuery('#p1').change(function(){
	if(jQuery('#p2').prop('checked', true)){
		
		jQuery('#p2').prop('checked', false)
	}
	
	if(jQuery('#p1').prop('checked')==false)
		{
	jQuery('#p3').prop('checked', false);
	jQuery('#p4').prop('checked', false);
	jQuery('#p5').prop('checked', false);
	jQuery('#p7').prop('checked', false);
	jQuery('#p8').prop('checked', false);
	jQuery('#p9').prop('checked', false);
	jQuery('#p10').prop('checked', false);
	jQuery('#p12').prop('checked', false);
		}
		else
		{
	jQuery('#p3').prop('checked', true);
	jQuery('#p4').prop('checked', true);
	jQuery('#p5').prop('checked', true);
	jQuery('#p7').prop('checked', true);
	jQuery('#p8').prop('checked', true);
	jQuery('#p9').prop('checked', true);
	jQuery('#p10').prop('checked', true);
	jQuery('#p12').prop('checked', true);
$('.orderlimit').css('display','none');
	jQuery('#orderlimitperday').prop('required',false);
	$('.singleorderlimit').css('display','none');
	jQuery('#singleorderlimitperday').prop('required',false);
		}
	
	
});


jQuery('#p2').change(function(){
	if(jQuery('#p1').prop('checked', true)){
		
		jQuery('#p1').prop('checked', false)
		jQuery('#p3').prop('checked', false);
		jQuery('#p4').prop('checked', false);
		jQuery('#p5').prop('checked', false);
		jQuery('#p7').prop('checked', false);
		jQuery('#p8').prop('checked', false);
		jQuery('#p9').prop('checked', false);
		jQuery('#p10').prop('checked', false);
		jQuery('#p12').prop('checked', false);
		if(jQuery('#p2').prop('checked')==false)
		{
	jQuery('#p3').prop('checked', false);
	jQuery('#p4').prop('checked', false);
	jQuery('#p7').prop('checked', false);
	jQuery('#p5').prop('checked', false);
	jQuery('#p8').prop('checked', false);
	$('.orderlimit').css('display','none');
	jQuery('#orderlimitperday').prop('required',false);
	$('.singleorderlimit').css('display','none');
	jQuery('#singleorderlimitperday').prop('required',false);
		}
		else
		{
	jQuery('#p3').prop('checked', true);
	jQuery('#p4').prop('checked', true);
	jQuery('#p7').prop('checked', true);
	jQuery('#p5').prop('checked', true);
	jQuery('#p8').prop('checked', true);
$('.orderlimit').css('display','block');
jQuery('#orderlimitperday').prop('required',true);
$('.singleorderlimit').css('display','block');
jQuery('#singleorderlimitperday').prop('required',true);
		}
	}
	
	
});
$('#user_email').blur(function(){
		var user_email=$(this).val();
		var eng="eng";
		if(user_email!='')
		{
			$.ajax({
				url:'<?= base_url('')?>checkuserexsist',
				method:'post',
				data:{'useremail':user_email,'check':eng,'editid':<?php echo $editid ?>},
				success:function(data)
				{
					
					if(data==1)
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
