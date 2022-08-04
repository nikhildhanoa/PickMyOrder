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
</style><div class="container">
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu1">Edit <?php echo $type;?></a></li>
    
		
  </ul>

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
	
		     <div class="col-md-12 col-xs-12">  <h3>Edit <?php echo $type;?></h3></div>
	    <div class="col-md-6 col-xs-12">
      
  <form method="post" action="<?php echo site_url('editengineer');?>">
   <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label class="col-md-3" for="email">Name</label>
	 
	  <div class="col-md-9">
	  
     <input required value="<?php echo $select_single['name']; ?>" type="text" class="form-control"  placeholder="Enter Name" name="name">
    </div>
	</div>
	 <input type="hidden" name='hid' value="<?php echo $select_single['id'];?>">
	 <input type="hidden" name='hiduserid' value="<?php echo $select_single['user_id'];?>">
   <!----------------address------------------------->   
   <div class="form-group">
 <label class="col-md-3" for="email">User Name</label>

	  <div class="col-md-9 ">
      <input required value="<?php echo $select_single['user_name']; ?>" type="text" class="form-control" id="email" placeholder="Enter Your User Name" name="uname">
    </div>	
	</div>
   <!----------------post code-------------------------> 
   <div class="form-group">
     <label class="col-md-3" for="email">Email Address</label>

	  <div class="col-md-9">
      <input required value="<?php echo $select_single['email']; ?>" type="email" class="form-control" id="user_email" placeholder="Email Address" name="email">
	  <span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>
    </div>
		  </div>
	
   <!----------------Email------------------------->
   <div class="form-group">
    <label class="col-md-3" for="email">Password</label>
	
	  <div class="col-md-9 ">
      <input required value="<?php echo $select_single['password']; ?>" type="Password" class="form-control" id="email" placeholder="Password" name="Password">
    </div> 
	</div>
   <!----------------Contact Name------------------------->
   
	</div>
  
</div>
</div>

 

</div>
</div>

<!-------email-section--->
 <div id="email_sec">
 <div class="container">
   <div class="row">
     <div  class="col-md-12 per" style="display:<?php echo $ishidden;?>">
      <h2>Permissions</h2>
	  <hr>
</div>






<div class="col-md-6 border" style="display:<?php echo $ishidden;?>">
  
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Supervisor</label>
  <input  id="p1" class="form-check-input" type="checkbox"  value="Supervisor" name="Supervisor" <?php if($select_single_permi['Supervisor']=='1' ){?>checked <?php } ?>>
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Operative</label>
  <input id="p2" class="form-check-input" type="checkbox"  value="Operative" name="Operative" <?php if($select_single_permi['Operative']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Categories</label>
  <input id="p3" class="form-check-input" type="checkbox"  value="Categories" name="Categories" <?php if($select_single_permi['Categories']=='1'  ){?>checked <?php } ?>>
</div>
<div  class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Orders</label>
  <input id="p4" class="form-check-input" type="checkbox"  value="Orders" name="Orders" <?php if($select_single_permi['Orders']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Project details</label>
  <input id="p5" class="form-check-input" type="checkbox"  value="Project details" name="Project_details" <?php if($select_single_permi['Project_details']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Catalogues</label>
  <input id="p7" class="form-check-input" type="checkbox"  value="Catalogues" name="Catalogues" <?php if($select_single_permi['Catalogues']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">All_orders</label>
  <input id="p8" class="form-check-input" type="checkbox"  value="All_orders" name="All_orders" <?php if($select_single_permi['All_orders']=='1' ){?>checked <?php } ?>>
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Orders_to_Approve</label>
  <input id="p9" class="form-check-input" type="checkbox"  value="Orders_to_Approve" name="Orders_to_Approve" <?php if($select_single_permi['Orders_to_Approve']=='1' ){?>checked <?php } ?>>
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">See_costs</label>
  <input id="p10" class="form-check-input" type="checkbox"  value="See_costs" name="See_costs" <?php if($select_single_permi['See_costs']=='1' ){?>checked <?php } ?>>
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">AddProduct</label>
  <input id="p11" class="form-check-input" type="checkbox"  value="addproduct" name="addproduct" <?php if($select_single_permi['AddProduct']=='1' ){?>checked <?php } ?>>
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Quotes</label>
  <input id="p12" class="form-check-input" type="checkbox"  value="quotes" name="quotes" <?php if($select_single_permi['Quotes']=='1' ){?>checked <?php } ?>>
</div>

</div>


<div class="col-md-6">
 <div class="form-horizontal">
 <div style="display:<?php echo $ishidden;?>">
 <!----------------busniss-name------------------------->   
 <div class="form-group singleorderlimit" style="display:<?php if($select_single_permi['Operative']=='1'){ ?>block;<?php }else{  ?>none;<?php } ?>">

	     <label class="control-label col-md-6" for="Project_Amount">Limit of Single Order</label>
		
	    <div class="col-md-6">
        <input id="singleorderlimitperday" class="form-control" type="number" name="single_order_per_day" placeholder="0.00" min="1" max="100000" value="<?php echo $select_single_permi['single_order_limit'];?>"><span style="color:red">This is required if oprative</span>
		  </div>
		 
		   </div>
   <div class="form-group orderlimit" style="display:<?php if($select_single_permi['Operative']=='1'){ ?>block;<?php }else{  ?>none;<?php } ?>">

	     <label class="control-label col-md-6" for="Project_Amount">Limit of order per day</label>
		
	    <div class="col-md-6">
        <input id="orderlimitperday" class="form-control" type="number" name="order_per_day" placeholder="0.00" min="1" max="100000" value="<?php echo $select_single_permi['limit_order_per_day'];?>"><span style="color:red">This is required if oprative</span>
		  </div>
		 
		   </div>
</div>
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
