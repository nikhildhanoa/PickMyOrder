<?php error_reporting(0);?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style><div class="container">
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Manage Stores</a></li>
    <li><a data-toggle="tab" href="#menu1">Add Stores</a></li>
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active">
      <h3>Manage Stores</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  
  <table class="table background table-striped">
    <thead>
      <tr>
	    <th>ID</th>
        <th>Store Name</th>
        <th>Store Address</th>
        <th>Default</th>
		<th>Edit </th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
	<?php
 if(isset($_SESSION['Current_Business'])){
     $bid=$_SESSION['Current_Business'];
	$All_Supplier=$this->SupplierModel->Select_All_Supplier($_SESSION['Current_Business']);
 }else
 {
	$All_Supplier=$this->SupplierModel->Select_All_Supplier($_SESSION['status']['business_id']); 
	$bid=$_SESSION['status']['business_id'];
 }
	foreach($result as $Single){
	?>
      <tr>
	    <td><?php echo $Single['id'];?> </td>
        <td><?php echo $Single['Store_Name'];?> </td>
        <td><?php echo $Single['Store_Address_one'];?></td>
        <td><?php echo $Single['defaultcheck'];?></td>
		  
		<td><a href="<?php $id=$Single['id']; echo site_url("EditStore/{$id}");?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td> 
		<td><a href="#" class="newanchor" id="<?php  echo site_url("deletestore/{$id}");?>" data-toggle="modal" data-target="#myConModal"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
	</tr>    <?php } ?>  
     
    </tbody>
  </table>
</div>
	 
	 
    </div>
    <div id="menu1" class="tab-pane fade">
   <div id="form">
   <form method="post" action="<?php echo site_url('Stores');?>">
<div class="container">
	 
	    <div class="row">
<div class="col-md-12">
	 <h2>Add Stores</h2>
</div>
<div class="col-md-12 bord">
  
<div class="row">
	    <div class="col-md-6 col-xs-12">
         <h3>General Details</h3>
		  <div class="marg product-form">
 
    <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
      <label class="control-label col-md-4" for="name">Store Name</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Store Name" name="Store_Name">
    </div>
	  </div>
   <!----------------address------------------------->  
   <div class="form-group ">
     <label class="control-label col-md-4" for="address">Store Address 1</label>

	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Store Address 1" name="Store_Address_one">
    </div>	  </div>
	
   <!----------------post code------------------------->
   <div class="form-group ">
     <label class="control-label col-md-4" for="code">Store Address 2</label>
	
	  <div class="col-md-8">
      <input  type="text" class="form-control"  placeholder="Store Address 2" name="Store_Address_two">
    </div>
	  </div>
	   <!----------------City------------------------->
	<div class="form-group ">
     <label class="control-label col-md-4" for="code">City</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="City" name="City">
    </div>
	  </div>
	
   <!----------------Post Code-------------------------> 
   <div class="form-group">
<label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Post Code" name="Post_Code">
    </div> </div>
   <!----------------Contact Name------------------------->  
   <div class="form-group ">
 <label class="control-label col-md-4" for="name">Tel Number</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control" id="email" placeholder="phone" name="Contact_Number">
    </div>  </div>
	
   <!----------------Contact Number------------------------->  
   <div class="form-group">
 <label class="col-md-4" for="email">Store Email</label>

	  <div class="col-md-8">
      <input required type="email" class="form-control"  placeholder="Store Email" name="Email">
    </div>	  
	</div>

	<div class="form-group">
    <label class="control-label col-md-4" for="email">Make Default Store</label>
	
	  <div class="col-md-8">
      <input  type="checkbox" class="form-control"  name="defaultcheck">
    </div>  
	</div>
	   </div>
 <div class="form-group">
    <div class="col-md-8">
        <input type="hidden" name="bid" value="<?php echo $bid ;?>">
      <input type="submit" class="btn btn-info" name="submit_store" placeholder="Add Store">
    </div>  
	</div>
	    </div>  
</div>

  </form>
</div>
</div>

</div>
</div>

<script>
				
////confirmatiom-Of-Delete
			
	$('.newanchor').click(function(){
		var myId = $(this).attr('id');
		$("#deca").attr("href", myId);
	});
</script>