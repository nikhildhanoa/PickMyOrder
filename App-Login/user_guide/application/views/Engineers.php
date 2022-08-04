<?php error_reporting(0);
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


 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        
</style><div class="container">
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Manage <?php echo $type ;?></a></li>
    <li><a data-toggle="tab" href="#menu1">Add <?php echo $type ;?></a></li>
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active">
      <h3>Manage <?php echo $type ;?></h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  
  <table class="table background table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Username</th>
		<th style="display:<?php echo $ishidden ?>">Type</th>
        <th>Email address</th>
		<th>Edit </th>
		<th>Delete</th>
      </tr>
	  
	 
	  
	  <?php 
	  if(isset($_SESSION['Current_Business'])){
	  $Get_Data = $this->EngineerModel->Select_All_engineers($_SESSION['Current_Business']);
	  }
	  else
	  {
		   $Get_Data = $this->EngineerModel->Select_All_engineers($_SESSION['status']['business_id']);
	  }
	 $usercheck=$_SESSION['status']['user_id'];
	 $iswholeseller=$this->db->query("select permission_wholeseller from dev_users where id=$usercheck");
	 $iswhoResult=$iswholeseller->result();
	 
	   ?> 
	 
	 
    </thead>
    <tbody>
	<?php foreach($Get_Data as $data){?>
      <tr>
	  <?php $engineer_id=$data['id']; 
	 $Check_permision= $this->db->query('Select Supervisor from dev_engineer_permissions where engineer_id="'.$engineer_id.'"');
	   $Check_permision=$Check_permision->result_array();
	  $Check_permision=$Check_permision[0]['Supervisor'];
	  ?>
	  
        <td><?php echo $data['name'] ?></td>
        <td><?php echo $data['user_name'] ?></td>
		<td style="display:<?php echo $ishidden ?>"><?php if($Check_permision=='0'){echo "Operative";}else{ echo "Supervisor";} ?></td>
        <td><?php echo $data['email'] ?></td>
		  
		<td><a href="<?php echo site_url('editengineer?id='.$data['id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td> 
		 <?php $eid=$data['id'];
               $uid=$data['user_id'];
		 ?>
		<td><a href="<?php echo site_url("deleteengineer?id=$eid&uid=$uid");?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
      </tr>      
	<?php } ?>
    </tbody>
  </table>
</div>
	 
	 
    </div>
    <div id="menu1" class="tab-pane fade">
   <div id="form">
<div class="container">
	 
	    <div class="row">
		     <div class="col-md-12 col-xs-12">  <h3>Add <?php echo $type ;?></h3></div>
	    <div class="col-md-6 col-xs-12">
      
  <form method="post" action="<?php echo site_url('engineer');?>">
   <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label class="col-md-3" for="email">Name</label>
	  
	  <div class="col-md-9">
      <input required type="text" class="form-control" id="email" placeholder="Enter Name" name="Name">
    </div>
	</div>
   <!----------------address------------------------->   
   <div class="form-group">
 <label class="col-md-3" for="email">User Name</label>

	  <div class="col-md-9 ">
      <input required type="text" class="form-control" id="email" placeholder="Enter Your User Name" name="uname">
    </div>	
	</div>
   <!----------------post code-------------------------> 
   <div class="form-group">
     <label class="col-md-3" for="email">Email Address</label>

	  <div class="col-md-9">
      <input required type="email" class="form-control" id="user_email" placeholder="Email Address" name="email"><span id="user_exsist_error" style="color:red;display:none">Email Already in use</span>
    </div>
		  </div>
	
   <!----------------Email------------------------->
   <div class="form-group">
    <label class="col-md-3" for="email">Password</label>
	
	  <div class="col-md-9 ">
      <input required type="Password" class="form-control" id="email" placeholder="Password" name="Password">
    </div> 
	</div>
	<!--------------------------------HiddenWholeSeller_Value------------------------------>
	 
	
	
	<input  type="hidden" class="form-control"  name="HiddenWholeSeller_Value" value="<?php echo $iswhoResult[0]->permission_wholeseller;?>">

	</div>
  
</div>
</div>

 

</div>
</div>

<!-------email-section--->
 <div id="email_sec">
 <div class="container">
   <div class="row">
     <div style="display:<?php echo $ishidden;?>" class="col-md-12 per">
      <h2>Permissions</h2>
	  <hr>
</div>






<div style="display:<?php echo $ishidden;?>" class="col-md-6 border">
    
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Supervisor</label>
  <input  class="form-check-input" type="checkbox"  id="p1" value="Supervisor" name="Supervisor">
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Operative</label>
  <input  class="form-check-input" type="checkbox" id="p2"  value="Operative" name="Operative">
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Categories</label>
  <input  class="form-check-input" type="checkbox"  id="p3" value="Categories" name="Categories">
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Orders</label>
  <input  class="form-check-input" type="checkbox"  id="p4" value="Orders" name="Orders">
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Project Details</label>
  <input  class="form-check-input" type="checkbox"  id="p5" value="Project details" name="Project_details">
</div>
<!--<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Quotes</label>
  <input  class="form-check-input" type="checkbox"  id="p6" value="Quotes" name="Quotes">
</div>-->
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Catalogues</label>
  <input  class="form-check-input" type="checkbox" id="p7"  value="Catalogues" name="Catalogues">
</div>

<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">All Orders</label>
  <input  class="form-check-input" type="checkbox"  id="p8" value="All_orders" name="All_orders">
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Orders To Approve</label>
  <input  class="form-check-input" type="checkbox"  id="p9" value="Orders_to_Approve" name="Orders_to_Approve">
</div>
 <div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">See Costs</label>
  <input  class="form-check-input" type="checkbox" id="p10" value="See_costs" name="See_costs">
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Add Products</label>
  <input  class="form-check-input" type="checkbox" id="p11" value="addproduct" name="addproduct">
</div>
<div class="form-check form-check-inline dis">
  <label class="form-check-label ck" for="inlineCheckbox1">Quotes</label>
  <input  class="form-check-input" type="checkbox" id="p12" value="quotes" name="quotes">
</div>


</div>









<div class="col-md-6">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
 <div class="form-group singleorderlimit" style="display:none">

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
<input type="submit" name="add_enginner" class="btn btn-info " value="SUBMIT">

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
	jQuery('#p11').prop('checked', false);
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
	jQuery('#p11').prop('checked', true);
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
		jQuery('#p11').prop('checked', false);
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