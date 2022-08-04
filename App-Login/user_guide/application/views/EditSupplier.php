<?php 
     error_reporting(0);
$editid=$_GET['id'];
	   
	      $select_single_supplier_query="select * from dev_supplier where id='$editid'";
		$select_single_supplier=$this->db->query($select_single_supplier_query);
	   $select_single_supplier=$select_single_supplier->result_array();
	  $select_single= $select_single_supplier[0];
	
	  $select_single_supplier_permi_query="select * from dev_supplier_account where supplier_id='$editid'";
		$select_single_supplier_permi=$this->db->query($select_single_supplier_permi_query);
	   $select_single_supplier_permi=$select_single_supplier_permi->result_array();
	  
	  $select_single_permi= $select_single_supplier_permi[0];
	      
	  
	   ?>	


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style><div class="container">
  

  <ul class="nav nav-tabs">
    
    <li><a data-toggle="tab" href="#menu1">Edit Supplier</a></li>
		
  </ul>

  <div class="tab-content">
    
    <div id="menu1" class="tab-pane active">
   <div id="form">
   <form method="post" action="<?php echo site_url('editsuppliers');?>"
<div class="container">
	 
	    <div class="row">
<div class="col-md-12">
	 <h2>Edit Suppliers</h2>
</div>
<div class="col-md-12 bord">
  
<div class="row">
	    <div class="col-md-6 col-xs-12">
         <h3>General Details</h3>
		  <div class="marg product-form">
 <input type="hidden" value="<?php echo $select_single['id']; ?>" name="hid">
    <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
      <label class="control-label col-md-4" for="name">Suppliers Name</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single['suppliers_name'];?>" type="text" class="form-control"  placeholder="Enter Suppliers Name" name="Suppliers_Name">
    </div>
	  </div>
  
	
   <!----------------Address------------------------->
   <div class="form-group ">
     <label class="control-label col-md-4" for="code">Address</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single['address'];?>" type="text" class="form-control"  placeholder="Enter Address" name="Address">
    </div>
	  </div>
	<!----------------City------------------------->
   <div class="form-group ">
     <label class="control-label col-md-4" for="code">City</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single['suppliers_city'];?>" type="text" class="form-control"  placeholder="Enter City" name="City">
    </div>
	  </div>
	  <!------------------POSTCODE-------------------------->
	     <div class="form-group">
<label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo $select_single['post_code'];?>" type="text" class="form-control"  placeholder="Enter Post Code" name="Post_Code">
    </div> </div>
	   <!----------------Postcode------------------------->  
   <div class="form-group ">
     <label class="control-label col-md-4" for="address">Contact Name</label>

	  <div class="col-md-8">
      <input required value="<?php echo $select_single['contact_name'];?>" type="text" class="form-control"  placeholder="Enter Contact Name" name="Contact_Name">
    </div></div>
   

   <!----------------Contact Name------------------------->  
   <div class="form-group ">
 <label class="control-label col-md-4" for="name">Contact Number</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single['contact_number'];?>" type="text" class="form-control" id="email" placeholder="Enter Contact Number" name="Contact_Number">
    </div>  </div>
	
   <!----------------Contact Number------------------------->  
   <div class="form-group">
 <label class="col-md-4" for="email">Email</label>

	  <div class="col-md-8">
      <input required value="<?php echo $select_single['email'];?>" type="email" class="form-control"  placeholder="Enter Email" name="Email">
    </div>	  
	</div>
   <div class="form-group">
    <label class="control-label col-md-4" for="email">Website</label>
	
	  <div class="col-md-8">
      <input  value="<?php echo $select_single['website'];?>" type="text" class="form-control"  placeholder="Enter Website" name="Website">
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
      <input required value="<?php echo $select_single_permi['ac_contact_name']; ?>" type="text" class="form-control" id="email" placeholder="Contact Name" name="Ac_Contact_Name">
    </div>
		  </div>
		   <!----------------address-------------------------> 
   <div class="form-group ">
     <label class="col-md-4" for="address">Address</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single_permi['ac_address']; ?>" type="address" class="form-control"  placeholder="Enter Your  Address" name="Ac_Address">
    </div> 
	</div>
		     <!----------------City-------------------------> 
   <div class="form-group ">
     <label class="col-md-4" for="address">City</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single_permi['ac_city']; ?>" type="address" class="form-control"  placeholder="Enter City" name="Ac_City">
    </div> 
	</div>
  
   <!----------------post code------------------------->   
   <div class="form-group">
      <label class="control-label col-md-4" for="code">Post Code</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single_permi['ac_post_code']; ?>" type="text" class="form-control"  placeholder="Enter Post Code" name="Ac_Post_Code">
    </div>
	  </div>
   <!----------------Email-------------------------> 
   <div class="form-group">
     <label class="control-label col-md-4" for="email">Contact Number</label>
	  
	  <div class="col-md-8">
      <input required value="<?php echo $select_single_permi['ac_contact_number']; ?>" type="text" class="form-control" id="email" placeholder="Enter Contact Number" name="Ac_Contact_Number">
    </div>
	</div>
   <!----------------Contact Number------------------------->
   <div class="form-group">
<label class="control-label col-md-4" for=" Number">Email</label>
	
	  <div class="col-md-8">
      <input required value="<?php echo $select_single_permi['ac_email']; ?>" type=" Number" class="form-control" id="email" placeholder="Enter Email" name="Ac_Email">
    </div>
	  </div>
   <!----------------VAT Number------------------------->
   <div class="form-group">
    <label class="control-label col-md-4" for=" Number">Account Limit</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo $select_single_permi['account_limit']; ?>" type=" Number" class="form-control" id="email" placeholder="Enter Account Limit" name="Account_Limit">
    </div>
	</div>
	<div class="form-group">
    <label class="control-label col-md-4" for=" Number">Account Number</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo  $select_single['AccountNumber']; ?>" type=" Number" class="form-control" id="email" placeholder="Enter Account Limit" name="AccountNumber">
    </div>
	</div>
	
   <div class="form-group ">
    <label class="control-label col-md-4" for=" Number">Terms</label>
	
	  <div class="col-md-8">
      <select value="<?php echo $select_single_permi['terms']; ?>" class="form-control" name="Terms">
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
       <input required value="<?php echo $select_single['order_email_address'];?>" type="email" class="form-control email"  placeholder="Order To Email" name="Order_Email_Address">
    </div>
	  </div>

 
   <!----------------Contact Number------------------------->
   <div class="form-group">
<label class="control-label col-md-4" for="Project_Tech">Account Status</label>
	  <div class="col-md-8">
	<select value="<?php echo $select_single_permi['account_status']; ?>" class="form-control" id="slct" name="Account_Status">
  <option value="Open" >Open</option>
  <option value="close" >closer</option>
</select>
    </div>
	</div>
	
    <div class="submit-btn-sec offset-md-4 col-md-8">
<input required type="submit" class="btn btn-info  marg_1 " value="UPDATE" name="Edit_Supplier">

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
</div>

