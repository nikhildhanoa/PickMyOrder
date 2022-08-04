<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Manage Projects</a></li>
    <li><a data-toggle="tab" href="#menu1">Add Projects</a></li>
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
      <h3>Manage Project</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  
  <table class="table table-striped">
    <thead>
      <tr>
	    <th>Project Number</th>
        <th>Project Name</th>
        <th>Customer</th>
		<th>Email</th>
		<th>View Orders</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
	<?php $number=1;if(isset($_SESSION['Current_Business'])){ $All_Pojects=$this->ProjectModel->Select_All_Project($_SESSION['Current_Business']);}
	else{
		if($_SESSION['status']['role']=='1')
		{
			$All_Pojects=$this->ProjectModel->Select_All_Project(0);
		}else{
		 $business_id=$_SESSION['status']['business_id'];
		$All_Pojects=$this->ProjectModel->Select_All_Project($business_id);
		}
		
	}
	foreach($All_Pojects as $Single){
		
	?>
      <tr>
	    <td><?php echo $number;?></td>
        <td><?php echo $Single['project_name'];?></td>
        <td><?php echo $Single['customer_name'];?></td>
		<td><?php echo $Single['email_address'];?></td>
		<td><a class="btn btn-info" href="<?php echo site_url('OrderUnderProject?id='.$Single['id']);?>">View Order</a></td> 
		<td><a href="<?php echo site_url('editprojects?id='.$Single['id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td> 
		<td><a href="<?php echo site_url('deleteproject?id='.$Single['id']); ?>"><i class="fa fa-times-circle" aria-hidden="true"></a></i></td>
	</tr>   <?php $number=$number+1; } ?>   
     
    </tbody>
  </table>
</div>
	 
	 
    </div>
    <div id="menu1" class="tab-pane fade background">
      
     <form action="<?php echo site_url('projects'); ?>" method="post">
	  <div class="main_sec">
	  
	  <div id="home"><h3>Project Details</h3></div>
	  <div class="marg product-form">
 
 	
	 

    <div class="row">

	<div class="col-sm-6">
    <div class="form-horizontal">
 <!----------------busniss-name------------------------->   

   <div class="form-group">
      <label class="control-label col-md-4" for="email">Project Name</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Project Name" name="Project_Name">
    </div>
 </div>
   <!----------------address------------------------->

   <div class="form-group">
       <label class="control-label col-md-4" for="email">Customer Name</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Customer Name" name="Customer_Name">
    </div>
  </div>
  <div class="form-group">
   <label class="control-label col-md-4" for="email">Address</label>

	  <div class="col-md-8">
      <input required type="text" class="form-control" id="email" placeholder=" Address" name="permanent_Address">
    </div>
	  </div>
	   <div class="form-group">
        <label class="control-label col-md-4" for="email">City</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="city" name="City_permanent">
    </div>
 </div>
	   <div class="form-group">
  <label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder=" Post Code" name="Post_Code_permanent">
    </div>
 </div>
   <!----------------Contact Name------------------------->

   

  

   
	  <div class="form-group">
   <label class="control-label col-md-4" for="email">Delivery Address</label>

	  <div class="col-md-8">
      <input required type="text" class="form-control" id="email" placeholder=" Delivery  Address" name="Delivery_Address">
    </div>
	  </div>
	
   <!----------------Email------------------------->
     <div class="form-group">
        <label class="control-label col-md-4" for="email">City</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="city" name="Delevery_City">
    </div>
 </div>

   <div class="form-group">
  <label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder=" Post Code" name="Post_Code_delevery">
    </div>
 </div>
   <!----------------Contact Name------------------------->

   

 

 <div class="form-group">
        <label class="control-label col-md-4" for="email">Contact Number</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Contact Number" name="Contact_Number">
    </div>
 </div>
 <div class="form-group">
        <label class="control-label col-md-4" for="email">Email Address</label>
	 
	  <div class="col-md-8">
      <input required type="email" class="form-control"  placeholder="Enter Email Address" name="Email_Address">
    </div>
 </div>
  




</div>
</div>
</div>
</div>
</div>



  <div class="main_sec">
	  
	  <div id="home"><h3>Engineer</h3></div>
	  <div class="marg product-form">
 
 	
	 

    <div class="row">

	<div class="col-sm-6">
    <div class="form-horizontal">
 <!----------------busniss-name------------------------->   

   
   <!----------------hiden i value for engineer------------------------->
 <input type="hidden" name="enghid" id="enghid" >
  <!----------------hiden i value for engineer------------------------->
   <div class="form-group" id="add_new_box">
   <div class="Adddiv">
       <label class="control-label col-md-4" for="email">Engineer Name</label>
	  <div class="col-md-6">
	  
	  <?php 
	  if(isset($_SESSION['Current_Business'])){
	  $All_engineer= $this->EngineerModel->Select_All_engineers($_SESSION['Current_Business']);
	  }else{
		$All_engineer= $this->EngineerModel->Select_All_engineers(0);  
	  }
	?>
	 
      <select  class="form-control"   name="engineer0">
	  <option selected disabled>----select-----</option>
	  <?php  foreach( $All_engineer as $Engineer){
	  ?>
	  <option value="<?php echo $Engineer['id']; ?>"><?php echo $Engineer['name']; ?></option>
       <? } ?>	 
	 </select>
	
       </div>
	    <div class="col-md-2">
	
		</div>
	</div>
  </div>
   <!----------------post code------------------------->
<div class="form-group">
<div class="submit-btn-sec submit-btn-sec2 offset-md-4 col-md-8">
<span  id="add_engineer" class="btn btn-info  marg_1 " > ADD ENGINEER</span>

</div>
</div>

<div class="form-group">
<div class="submit-btn-sec submit-btn-sec2  offset-md-4 col-md-8">
<input type="submit" style="width:124px" class="btn btn-info  marg_1 " value="SUBMIT" name="Insert_Project">

</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<hr>
</div>
</div>

    </div>
  </div>
</div>
<script>
jQuery(document).ready(function(){
	i=1;
	jQuery('#add_engineer').click(function(){
	jQuery('#add_new_box').append('<div class="engineer'+i+'" style="margin-top:10px;"><label class=" col-md-4" for="email">Engineer Name</label><div class="col-md-6"><select  class="form-control" name="engineer'+i+'"><option disabled selected>---Select---</option><?php  foreach( $All_engineer as $Engineer){ ?><option value="<?= $Engineer['id']; ?>"><?= $Engineer['name']; ?></option><? } ?></select></div><div class="col-md-2"><input type="submit" value="DELETE" class="btn btn-outline-primary remove" style=" padding:5px 2px;" id="engineer'+i+'"></div></div>');
	jQuery('#enghid').val(i);
	i++;
	jQuery('.remove').click(function(){
	var id = jQuery(this).attr('id');
	jQuery('div.'+id).remove();
	
	});
	
	});
});
	
</script>

