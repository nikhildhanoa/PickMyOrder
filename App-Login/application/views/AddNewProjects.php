<?php  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
 $blank_sup='';
 foreach($supervisor_key as $supervisor)
 {
   $blank_sup.='<option value='.$supervisor["id"].'>'.$supervisor["name"].'</option>';
 }
 
 $blank_ope='';
 foreach($Operative_key as $Operative)
 {
   $blank_ope.='<option value='.$Operative["id"].'>'.$Operative["name"].'</option>';
 }
?>
     <form action="<?php echo site_url('projects'); ?>" method="post">
	 <div class="container">
	  <div class="main_sec">
	  
	  
	  <div class="marg product-form">
 
 	
	  <div class="row">

<div class="col-md-12 bord">

    <div class="row">

	 <div class="col-md-12 col-xs-12 border">
		<div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
         <h3 class="card-title">General Details</h3>
	 <h3 class="card-title" style="color:#d02324;"> <?php echo $this->session->flashdata('err'); ?></h3>
		 </div>
		 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
<div class="col-md-6">
   <div class="form-group col-md-12">
      <label>Project Name</label>
	 
	 
      <input required type="text" class="form-control form-control-solid"  placeholder="Enter Project Name" name="Project_Name">
   
 </div>
   <!----------------address------------------------->

   <div class="form-group col-md-12">
       <label>Customer Name</label>
	

      <input required type="text" class="form-control form-control-solid"  placeholder="Enter Customer Name" name="Customer_Name">
    
  </div>
  <div class="form-group col-md-12">
   <label>Address</label>

	
      <input required type="text" class="form-control form-control-solid" id="email" placeholder=" Address" name="permanent_Address">

	  </div>
	   <div class="form-group col-md-12">
        <label>City</label>
	 
	 
      <input required type="text" class="form-control form-control-solid"  placeholder="city" name="City_permanent">
  
 </div>
	   <div class="form-group col-md-12">
  <label>Post Code</label>
	 
	 
      <input required type="text" class="form-control form-control-solid"  placeholder=" Post Code" name="Post_Code_permanent">
 
 </div>
   <!----------------Contact Name------------------------->

   

  

   
	  <div class="form-group col-md-12">
   <label>Delivery Address</label>

	
      <input required type="text" class="form-control form-control-solid" id="email" placeholder=" Delivery  Address" name="Delivery_Address">
    
	  </div>
	
      <div class="form-group col-md-12">
        <label>City</label>
	 
	 
      <input required type="text" class="form-control form-control-solid"  placeholder="city" name="Delevery_City">
   
 </div>

   

 
 
 
  </div>

<div class="col-md-6">



 <!----------------Email------------------------->
 
   <div class="form-group col-md-12">
  <label>Post Code</label>
	 
	
      <input required type="text" class="form-control form-control-solid"  placeholder=" Post Code" name="Post_Code_delevery">
    
 </div>



	
	<!----------------Contact Name------------------------->

 <div class="form-group col-md-12">
        <label>Contact Number</label>
	 
	 
      <input required type="text" class="form-control form-control-solid"  placeholder="Enter Contact Number" name="Contact_Number">
    
 </div>
 <div class="form-group col-md-12">
        <label>Email Address</label>
      <input required type="email" class="form-control form-control-solid"  placeholder="Enter Email Address" name="Email_Address">
    
 </div>
 
 <div class="form-group col-md-12">
        <label>Order Number</label>
      <input required type="text" class="form-control form-control-solid"  placeholder="Enter Order Number" name="invioce_Order_Number">
 </div>
 
    <!----------------hiden i value for engineer------------------------->
 <input type="hidden" name="enghid" id="enghid2" >
  <!----------------hiden i value for engineer------------------------->
  
  <!----------------Operative code------------------------->
   <div class="form-group col-md-12" id="add_new_box">
   <div class="Adddiv">
       <label> supervisor Name</label>
      <select  class="form-control form-control-solid"   name="supervisorarray[]">
	  <option selected disabled>----select-----</option>
	  
	 <?php echo $blank_sup; ?>
     
	 </select>
	
    
	    <div class="col-md-2">
	
		</div>
	</div>
  </div>
	
	   
<div class="form-group col-md-12">
<div class="submit-btn-sec submit-btn-sec2">
<span  id="add_engineer" class="btn btn-info  marg_1 " > ADD supervisor</span>

</div>
</div>
 <!----------------end Operative code------------------------->
  <!----------------Operative code------------------------->
   <div class="form-group col-md-12" id="add_new_box2">
   <div class="Adddiv">
       <label>Operative Name</label>
      <select  class="form-control form-control-solid"   name="Operativearray[]">
	  <option selected disabled>----select-----</option>
	  
	 <?php echo $blank_ope; ?>
     
	 </select>
	
    
	    <div class="col-md-2">
	
		</div>
	</div>
  </div>
	
	   
<div class="form-group col-md-12">
<div class="submit-btn-sec submit-btn-sec2">
<span  id="add_engineer2" class="btn btn-info  marg_1 " > ADD Operative </span>

</div>
</div>
 
 
 
 
<div class="form-group col-md-12">
<div class="submit-btn-sec submit-btn-sec2">
<input type="submit" style="width:124px" class="btn btn-info  marg_1 " value="SUBMIT" name="Insert_Project">

</div>
</div>
</div>




</div>
</div>
</div>
</div></div>

</div>
</div>
</div>
</div>
</div>



  
  </div>
</div>

<script>
i=1;
$('#add_engineer').click(function(){
	
 $('#add_new_box').append('<div id="div'+i+'" ><div  style="position: relative;"> <label style="position: absolute;left: 6px;top: -27px;">supervisor Name</label> <select style="margin-top: 35px;" class="form-control form-control-solid" name="supervisorarray[]"> <option selected disabled>----select supervisor-----</option> <?php echo $blank_sup; ?> </select> <div class="col-md-2"></div><i id="'+i+'" style="position:absolute;top: 15px;right: -27px;" class="remove fa fa-times-circle" aria-hidden="true"></i></div></div>');
	i++;
$('.remove').click(function(){
	var id = $(this).attr('id');
	$('#div'+id).remove();
	
	});
});


j=1;
$('#add_engineer2').click(function(){
	
 $('#add_new_box2').append('<div id="div'+j+'" ><div  style="position: relative;"> <label style="position: absolute;left: 6px;top: -27px;">opprative  Name</label> <select style="margin-top: 35px;" class="form-control form-control-solid" name="Operativearray[]"> <option selected disabled>----select opprative -----</option> <?php echo $blank_ope; ?> </select> <div class="col-md-2"></div><i id="'+j+'" style="position:absolute;top: 15px;right: -27px;" class="removetwo fa fa-times-circle" aria-hidden="true"></i></div></div>');
	j++;
	
	$('.removetwo').click(function(){
	var id = $(this).attr('id');
	$('#div'+id).remove();
	
	});
	
	
});


/* jQuery(document).ready(function(){
	i=1;
	jQuery('#add_engineer').click(function(){
	jQuery('#add_new_box').append('<div class="engineer'+i+'" style="margin-top:10px;"><label>Engineer Name</label><select  class="form-control form-control-solid" name="engineer'+i+'"><option disabled selected>---Select---</option><?php  foreach( $All_engineer as $Engineer){ ?><option value="<?php $Engineer['id']; ?>"><?php $Engineer['name']; ?></option><?php } ?></select><input type="submit" value="DELETE" class="btn btn-outline-primary remove mt-5" style=" padding:5px 2px;" id="engineer'+i+'"></div>');
	jQuery('#enghid').val(i);
	i++;
	jQuery('.remove').click(function(){
	var id = jQuery(this).attr('id');
	jQuery('div.'+id).remove();
	
	});
	
	});
});
	 */
</script>

