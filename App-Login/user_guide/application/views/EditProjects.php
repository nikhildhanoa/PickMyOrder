<?php error_reporting(0); 
$editid=$_GET['id'];
	   
	      $select_single_Project_query="select * from dev_projects where id='$editid'";
		$select_single_Project=$this->db->query($select_single_Project_query);
	   $select_single_Project=$select_single_Project->result_array();
	  $select_single= $select_single_Project[0];
	  $Number_of_engineer=$select_single['id_array'];
	 $Engineer_name=explode(',',$Number_of_engineer);
	
	  $num=count($Engineer_name);
	 	   
?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Edit Projects</a></li>	
  </ul>


  <div class="tab-content">
    
    <div id="home" class="tab-pane active">
      
     <form action="<?php echo site_url('editprojects'); ?>" method="post">
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
      <input required value="<?php echo  $select_single['project_name'];?>" type="text" class="form-control"  placeholder="Enter Project Name" name="Project_Name">
    </div>
 </div>
   <!----------------address------------------------->

   <div class="form-group">
       <label class="control-label col-md-4" for="email">Customer Name</label>
	
	  <div class="col-md-8">
      <input required type="text" value="<?php echo  $select_single['customer_name'];?>" class="form-control"  placeholder="Enter Customer Name" name="Customer_Name">
    </div>
  </div>
   <!----------------post code------------------------->

   <div class="form-group">
   <label class="control-label col-md-4" for="email">Address</label>

	  <div class="col-md-8">
      <input required value="<?php echo  $select_single['address'];?>" type="text" class="form-control" id="email" placeholder="Enter Address" name="Address">
    </div>
	  </div>
	    <div class="form-group">
        <label class="control-label col-md-4" for="email">City</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo  $select_single['city'];?>" type="text" class="form-control"  placeholder="city" name="City">
    </div>
 </div>
   <div class="form-group">
  <label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo  $select_single['post_code'];?>" type="text" class="form-control"  placeholder="Enter Post Code" name="Post_Code">
    </div>
 </div>
 

   <!----------------Email------------------------->
   
 <!-------------------------end----------------------------------->
 <div class="form-group">
  <label class="control-label col-md-4" for="email">Delivery Address</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo  $select_single['Delivery_Address'];?>" type="text" class="form-control"  placeholder="Enter Post Code" name="Delivery_Address">
    </div>
 </div>
 <div class="form-group">
        <label class="control-label col-md-4" for="email">City</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control" value="<?php echo  $select_single['delivery_city'];?>" placeholder="city" name="Delevery_City">
    </div>
 </div>
  <div class="form-group">
  <label class="control-label col-md-4" for="email">Post Code</label>
	 
	  <div class="col-md-8">
      <input required type="text" class="form-control" value="<?php echo  $select_single['delivery_postcode'];?>" placeholder=" Post Code" name="Post_Code_delevery">
    </div>
 </div>
 
   <!----------------Contact Name------------------------->

   

 
 <div class="form-group">
        <label class="control-label col-md-4" for="email">Contact Number</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo  $select_single['contact_number'];?>" type="text" class="form-control"  placeholder="Enter Contact Number" name="Contact_Number">
    </div>
 </div>
 <div class="form-group">
        <label class="control-label col-md-4" for="email">Email Address</label>
	 
	  <div class="col-md-8">
      <input required value="<?php echo  $select_single['email_address'];?>" type="email" class="form-control"  placeholder="Enter Email Address" name="Email_Address">
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

     <!----------------hiden id value for engineer------------------------->
 <input type="hidden" name="hid" value=<?php echo $select_single['id']; ?> >
  <!----------------hiden id value for engineer------------------------->
  
   <div class="form-group" id="add_new_box">
   <?php for($i=0;$i<=$num-1;$i++){?>
   <div class="Adddiv">
   <div class="mb-3 col-sm-12 engineer<?php echo $i;?>" style="margin-top:10px;">
    <?php $All_engineer= $this->EngineerModel->Select_All_engineers(0);
	
	?>
       <label class="control-label col-md-4" for="email">Engineer Name</label>
	   
	 <select class="col-md-6 form-control" value="<?php echo $Engineer_name[$i]; ?>" name="engineer<?php echo $i;?>"><option selected disabled>--Select--</option>
	 <?php  foreach( $All_engineer as $Engineer){
    
	 ?>
	  
      <option <?php if($Engineer['id']==$Engineer_name[$i]){?> selected <?php } ?> class="slectEng" value="<?php echo $Engineer['id']; ?>" ><?php  echo $Engineer['name']; ?></option>
	 <?php }	 ?>
	 <select>
	  <span  class="col-md-2 btn btn-outline-primary remove" style=" padding:5px 2px;" id="engineer<?php echo $i; ?>">DELETE</span>
	 
       
   </div></div><?php } ?>
  </div>
   <!----------------hiden i value for engineer------------------------->
 <input type="hidden" value="<?php echo $i;?>" name="enghid" id="enghid" >
  <!----------------hiden i value for engineer------------------------->
   <!----------------post code------------------------->
<div class="form-group">
<div class="submit-btn-sec submit-btn-sec2 offset-md-4 col-md-8">
<span  id="add_engineer" class="btn btn-info  marg_1 " > ADD ENGINEER</span>

</div>
</div>

<div class="form-group">
<div class="submit-btn-sec submit-btn-sec2  offset-md-4 col-md-8">
<input type="submit" style="width:124px" class="btn btn-info  marg_1 " value="UPDATE" name="Edit_Project">

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
<script>
jQuery(document).ready(function(){
	i=<?php echo $num;?>;
	flag=0;
	jQuery('#add_engineer').click(function(){
		flag="1";
	jQuery('#add_new_box').append('<div class="Adddiv "> <div class="col-sm-12 mb-3 engineer'+i+'" style="margin-top:10px;"> <label class=" col-md-4" for="email">Engineer Name</label><div class="col-md-6"><select  class="form-control" name="engineer'+i+'"><option disabled selected>--Select--</option><?php  foreach( $All_engineer as $Engineer){ ?><option value="<?= $Engineer['id']; ?>"><?= $Engineer['name']; ?></option><? } ?></select></div><div class="col-md-2"><span   class="btn btn-outline-primary remove" style=" padding:5px 2px;" id="engineer'+i+'">DELETE</span></div></div></div>');
	jQuery('#enghid').val(i);
	i++;
	jQuery('.remove').click(function(){
	var id = jQuery(this).attr('id');
	jQuery('div.'+id).remove();
	
	});
	
	});
	if(flag!='1'){
	jQuery('.remove').click(function(){
	var id = jQuery(this).attr('id');
	jQuery('div.'+id).remove();
	
	});}
	
	
	
	
	
});
	
</script>

