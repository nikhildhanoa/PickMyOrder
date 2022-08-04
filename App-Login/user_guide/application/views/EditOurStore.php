<?php error_reporting(0);?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style><div class="container">
  

  <ul class="nav nav-tabs">
    
    <li class="active"><a data-toggle="tab" href="#menu1">Edit Stores</a></li>
		
  </ul>

  <div class="tab-content">
    
	 
	 
    
    <div id="menu1" class="tab-pane active">
   <div id="form">
   <form method="post" action="<?php echo site_url('EditStore/'.$EditArray[0]['id']);?>">
<div class="container">
	 
	    <div class="row">
<div class="col-md-12">
	 <h2>Edit Stores</h2>
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
      <input required type="text" class="form-control"  placeholder="Store Name" name="Store_Name" value="<?php echo $EditArray[0]['Store_Name'];?>">
    </div>
	  </div>
   <!----------------address------------------------->  
   <div class="form-group ">
     <label class="control-label col-md-4" for="address">Store Address 1</label>

	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Store Address 1" name="Store_Address_one" value="<?php echo $EditArray[0]['Store_Address_one'];?>">
    </div>	  </div>
	
   <!----------------post code------------------------->
   <div class="form-group ">
     <label class="control-label col-md-4" for="code">Store Address 2</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Store Address 2" name="Store_Address_two" value="<?php echo $EditArray[0]['Store_Address_two'];?>">
    </div>
	  </div>
	   <!----------------City------------------------->
	<div class="form-group ">
     <label class="control-label col-md-4" for="code">City</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="City" name="City" value="<?php echo $EditArray[0]['City'];?>">
    </div>
	  </div>
	
   <!----------------Post Code-------------------------> 
   <div class="form-group">
<label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control"  placeholder="Post Code" name="Post_Code" value="<?php echo $EditArray[0]['Post_Code'];?>">
    </div> </div>
   <!----------------Contact Name------------------------->  
   <div class="form-group ">
 <label class="control-label col-md-4" for="name">Tel Number</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control" id="email" placeholder="phone" name="Contact_Number" value="<?php echo $EditArray[0]['Contact_Number'];?>">
    </div>  </div>
	
   <!----------------Contact Number------------------------->  
   <div class="form-group">
 <label class="col-md-4" for="email">Store Email</label>

	  <div class="col-md-8">
      <input required type="email" class="form-control"  placeholder="Store Email" name="Email" value="<?php echo $EditArray[0]['Email'];?>">
    </div>	  
	</div>

	<div class="form-group">
    <label class="control-label col-md-4" for="email">Make Default Store</label>
	
	  <div class="col-md-8">
      <input  type="checkbox" class="form-control"  name="defaultcheck" <?php if($EditArray[0]['defaultcheck']){ ?> Checked <?php } ?>>
    </div>  
	</div>
	   </div>
 <div class="form-group">
    <div class="col-md-8">
        <input type="hidden" name="bid" value="<?php echo $bid ;?>">
      <input type="submit" class="btn btn-info" name="edit_store" value="update">
    </div>  
	</div>
	    </div>  
</div>

  </form>
</div></div>
</div>

</div>
</div>

