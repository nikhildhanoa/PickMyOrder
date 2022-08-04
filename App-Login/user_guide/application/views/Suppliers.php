<?php error_reporting(0); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style><div class="container">
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Manage Suppliers</a></li>
    <li><a data-toggle="tab" href="#menu1">Add Suppliers</a></li>
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active">
      <h3>Manage Suppliers</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  
  <table class="table background table-striped">
    <thead>
      <tr>
	    <th>ID</th>
        <th>Supplier Name</th>
        <th>Contact Name</th>
        <th>Email</th>
		<th>Edit </th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
	<?php
 if(isset($_SESSION['Current_Business'])){
	$All_Supplier=$this->SupplierModel->Select_All_Supplier($_SESSION['Current_Business']);
 }else
 {
	$All_Supplier=$this->SupplierModel->Select_All_Supplier($_SESSION['status']['business_id']); 
 }
	foreach($All_Supplier as $Single){
	?>
      <tr>
	    <td><?php echo $Single['id'];?> </td>
        <td><?php echo $Single['suppliers_name'];?> </td>
        <td><?php echo $Single['contact_name'];?></td>
        <td><?php echo $Single['email'];?></td>
		  
		<td><a href="<?php echo site_url('editsuppliers?id='.$Single['id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td> 
		<td><a href="<?php echo site_url('deletesuppliers?id='.$Single['id']);?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
	</tr>    <?php } ?>  
     
    </tbody>
  </table>
</div>
	 
	 
    </div>
    <div id="menu1" class="tab-pane fade">
   <div id="form">
   <form method="post" action="<?php echo site_url('suppliers');?>"
<div class="container">
	 
	    <div class="row">
<div class="col-md-12">
	 <h2>Add Suppliers</h2>
</div>
<div class="col-md-12 bord">
  
<div class="row">
	    <div class="col-md-6 col-xs-12">
         <h3>General Details</h3>
		  <div class="marg product-form">
 
    <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
      <label class="control-label col-md-4" for="name">Suppliers Name</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Suppliers Name" name="Suppliers_Name">
    </div>
	  </div>
   <!----------------address------------------------->  
   <div class="form-group ">
     <label class="control-label col-md-4" for="address">Contact Name</label>

	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Contact Name" name="Contact_Name">
    </div>	  </div>
	
   <!----------------post code------------------------->
   <div class="form-group ">
     <label class="control-label col-md-4" for="code">Address</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Address" name="Address">
    </div>
	  </div>
	   <!----------------City------------------------->
	<div class="form-group ">
     <label class="control-label col-md-4" for="code">City</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Address" name="City">
    </div>
	  </div>
	
   <!----------------Post Code-------------------------> 
   <div class="form-group">
<label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Post Code" name="Post_Code">
    </div> </div>
   <!----------------Contact Name------------------------->  
   <div class="form-group ">
 <label class="control-label col-md-4" for="name">Contact Number</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control" id="email" placeholder="Enter Contact Number" name="Contact_Number">
    </div>  </div>
	
   <!----------------Contact Number------------------------->  
   <div class="form-group">
 <label class="col-md-4" for="email">Email</label>

	  <div class="col-md-8">
      <input required type="email" class="form-control"  placeholder="Enter Email" name="Email">
    </div>	  
	</div>
   <div class="form-group">
    <label class="control-label col-md-4" for="email">Website</label>
	
	  <div class="col-md-8">
      <input  type="text" class="form-control"  placeholder="Enter Website" name="Website">
    </div>  
	</div>
	   </div>

	    </div>  
</div>
<!------------------------second------section--------------------------->
	    <div class="col-md-6 col-xs-12">
         <h3>Account Details</h3>
		    <div class="marg product-form">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group">
   <label class="control-label col-md-4" for="name">Contact Name</label>

	  <div class="col-md-8">
      <input required type="text" class="form-control" id="email" placeholder="Contact Name" name="Ac_Contact_Name">
    </div>
		  </div>
		  <!----------------address-------------------------> 
   <div class="form-group ">
     <label class="col-md-4" for="address">Address</label>
	
	  <div class="col-md-8">
      <input required type="address" class="form-control"  placeholder="Enter Your Address" name="Ac_Address">
    </div> 
	</div>
		    <!----------------City-------------------------> 
   <div class="form-group ">
     <label class="col-md-4" for="address">City</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Your Address" name="Ac_City">
    </div> 
	</div>
   
   <!----------------post code------------------------->   
   <div class="form-group">
      <label class="control-label col-md-4" for="code">Post Code</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Enter Post Code" name="Ac_Post_Code">
    </div>
	  </div>
   <!----------------Email-------------------------> 
   <div class="form-group">
     <label class="control-label col-md-4" for="email">Contact Number</label>
	  
	  <div class="col-md-8">
      <input required type="text" class="form-control" id="email" placeholder="Enter Contact Number" name="Ac_Contact_Number">
    </div>
	</div>
   <!----------------Contact Number------------------------->
   <div class="form-group">
<label class="control-label col-md-4" for=" Number">Email</label>
	
	  <div class="col-md-8">
      <input required type=" Number" class="form-control" id="email" placeholder="Enter Email" name="Ac_Email">
    </div>
	  </div>
   <!----------------VAT Number------------------------->
   <div class="form-group">
    <label class="control-label col-md-4" for=" Number">Account Limit</label>
	 
	  <div class="col-md-8">
      <input required type=" Number" class="form-control" id="email" placeholder="Enter Account Limit" name="Account_Limit">
    </div>
	</div>
	<div class="form-group">
    <label class="control-label col-md-4" for=" Number">Account Number</label>
	 
	  <div class="col-md-8">
      <input required type=" Number" class="form-control" id="email" placeholder="Enter Account Limit" name="AccountNumber">
    </div>
	</div>
	
   <div class="form-group ">
    <label class="control-label col-md-4" for=" Number">Terms</label>
	
	  <div class="col-md-8">
      <select class="form-control" name="Terms" >
  <option value="30days">30days</option>
  <option value="60days">60days</option>
  <option value="90days">90days</option>
  <option value="Cash">Cash</option>
</select>
    </div>
	  </div>
	  
	  </div>
		  </div>  

</div>
</div>

</div>
</div>






<!-------email-section--->

  <div class="row">

    <div class="col-md-12">
      <h2>Email Address</h2>
</div>
<div class="col-md-6 col-xs-12 ">

 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
        <label class="control-label col-md-4" for=" Number">Email address To send orders to</label>
	
	  <div class="col-md-8">
       <input required type="email" class="form-control email"  placeholder="Order Email Address" name="Order_Email_Address"><span style="color:red">This Email Address Should Be Same As Above Email Address.</span>
    </div>
	  </div>

 
   <!----------------Contact Number------------------------->
   <div class="form-group">
<label class="control-label col-md-4" for="Project_Tech">Account Status</label>
	  <div class="col-md-8">
	<select class="form-control" id="slct" name="Account_Status">
  <option value="Open" >Open</option>
  <option value="close" >closer</option>
</select>
    </div>
	</div>
	
    <div class="submit-btn-sec offset-md-4 col-md-8">
<input type="submit" class="btn btn-info  marg_1 " value="SUBMIT" name="Insert_suppliers">

    </div>
</div>
</div>
</div>
<div class="col-md-6 col-xs-12 ">
</div>
</div>

  </div>
  </form>
</div>
</div>

</div>
</div></div>
