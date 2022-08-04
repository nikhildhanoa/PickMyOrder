<?php error_reporting(0); 
$editid=$_GET['id'];
	   
	      $select_single_Project_query="select * from dev_projects where id='$editid'";
		$select_single_Project=$this->db->query($select_single_Project_query);
	   $select_single_Project=$select_single_Project->result_array();
	  $select_single= $select_single_Project[0];
	  $Number_of_engineer=$select_single['engineer_array'];
	 $Engineer_name=explode(',',$Number_of_engineer);
	//print_r($Engineer_name);die;
	 /*  $num=count($Engineer_name); */
	 	
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
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <style>
 .form-group.col-md-6 {
    margin-right: 0px;
    margin-left: 0px;
	padding-left: 0px;
}
.form-control{
	background-color: #F3F6F9;
    border-color: #F3F6F9;
    color: #3F4254;
}
 </style>

      
     <form action="<?php echo site_url('editprojects'); ?>" method="post">
	 <div class="container">
	  <div class="main_sec">
	  

	  
	  <div class="row">

<div class="col-md-12 bord">

    <div class="row">

	 <div class="col-md-12 col-xs-12 border">
		<div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
         <h3 class="card-title">Projects Details</h3>
         <h3 class="card-title" style="color:#d02324;"> <?php echo $this->session->flashdata('err'); ?></h3>
	
		 </div>
		 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
	<div class="row">
		<div class="col-md-6">
			<div class="form-group col-md-12">
      <label>Project Name</label>
	 
	 
      <input required value="<?php echo  $select_single['project_name'];?>" type="text" class="form-control"  placeholder="Enter Project Name" name="Project_Name">
   
 </div>
    <!----------------address------------------------->

   <div class="form-group col-md-12">
       <label>Customer Name</label>
	
	
      <input required type="text" value="<?php echo  $select_single['customer_name'];?>" class="form-control"  placeholder="Enter Customer Name" name="Customer_Name">
   
  </div>
  
   <!----------------post code------------------------->

   <div class="form-group col-md-12">
   <label>Address</label>


      <input required value="<?php echo  $select_single['address'];?>" type="text" class="form-control" id="email" placeholder="Enter Address" name="Address">
   
	  </div>
 
  <div class="form-group col-md-12">
        <label>City</label>
	 
	
      <input required value="<?php echo  $select_single['city'];?>" type="text" class="form-control"  placeholder="city" name="City">
    
 </div>
 
   <div class="form-group col-md-12">
  <label>Post Code</label>
	 
	 
      <input required value="<?php echo  $select_single['post_code'];?>" type="text" class="form-control"  placeholder="Enter Post Code" name="Post_Code">
   
 </div>
 <div class="form-group col-md-12">
  <label>Delivery Address</label>
	 
	 
      <input required value="<?php echo  $select_single['Delivery_Address'];?>" type="text" class="form-control"  placeholder="Enter Post Code" name="Delivery_Address">
   
 </div>
 
  <div class="form-group col-md-12">
        <label>City</label>
	 
	
      <input required type="text" class="form-control" value="<?php echo  $select_single['delivery_city'];?>" placeholder="city" name="Delevery_City">
    
 </div>
		</div>
		
		<div class="col-md-6">
			 <!-------------------------end----------------------------------->
 
 

 
 
  <div class="form-group col-md-12">
  <label>Post Code</label>
	 
	 
      <input required type="text" class="form-control" value="<?php echo  $select_single['delivery_postcode'];?>" placeholder=" Post Code" name="Post_Code_delevery">
   
 </div>
 <div class="form-group col-md-12">
        <label>Contact Number</label>
	 
	 
      <input required value="<?php echo  $select_single['contact_number'];?>" type="text" class="form-control"  placeholder="Enter Contact Number" name="Contact_Number">
  
 </div>
 
  <div class="form-group col-md-12">
        <label>Email Address</label>
      <input required value="<?php echo  $select_single['email_address'];?>" type="email" class="form-control"  placeholder="Enter Email Address" name="Email_Address">
 </div>
 
 <div class="form-group col-md-12">
        <label>Order Number</label>
      <input required  value="<?php echo  $select_single['invioce_Order_Number'];?>" type="text" class="form-control form-control-solid"  placeholder="Enter Order Number" name="invioce_Order_Number">
 </div>

   <div class="form-group col-md-12" id="add_new_box">
      <!----------------hiden id value for engineer------------------------->
 <input type="hidden" name="hid" value=<?php echo $select_single['id']; ?> >
  <!----------------hiden id value for engineer------------------------->
  
   <?php foreach ($Engineer_name as $id){ 
   
   $select='id,name';
   $TableName='dev_engineer ';
   $multiClause=array('id'=>$id);
   $result_as_array=true;
  $Add_eng= $this->CommonModel->Fetchdata($select,$TableName,$multiClause,$result_as_array); 
  
 ?>
   <div class="Adddiv" id="<?php echo 'div'.$Add_eng[0]['id'];  ?>">
   <div class="col-sm-12 mb-3 engineer<?php echo $i;?>" style="margin-top:10px;">
    
       <label>Added Engineer Name</label>
	   
	
    
	  <input readonly value="<?php echo $Add_eng[0]['name'];  ?>" type="text" class="form-control" id="email" placeholder="Enter Address" >
	  <input type="hidden" value="<?php echo $Add_eng[0]['id'];  ?>"  name="AddEngineerArray[]" > 
	  <span  class="col-md-2 btn btn-outline-primary removedel mt-5" style=" padding:5px 2px;" id="<?php echo $Add_eng[0]['id'];  ?>">DELETE</span>
	 
       
   </div><br></div><?php } ?>
  </div>
  
     <!----------------hiden i value for engineer------------------------->
 <input type="hidden" value="<?php echo $i;?>" name="enghid" id="enghid" >
  <!----------------hiden i value for engineer------------------------->
   <!----------------sup start------------------------->

<div class="form-group col-md-12" id="add_new_boxsup">
   <div class="Adddiv">
       <label> supervisor Name</label>
      <select  class="form-control form-control-solid"   name="supervisorarray[]">
	  <option selected disabled>----select-----</option>
	  
	 <?php  echo $blank_sup;  ?>
     
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


 <!------------------------------------------------------>
  <!----------------ope start------------------------->
  <div class="form-group col-md-12" id="add_new_box2">
   <div class="Adddiv">
       <label>Operative Name</label>
      <select  class="form-control form-control-solid"   name="Operativearray[]">
	  <option selected disabled>----select-----</option>
	  
	 <?php echo  $blank_ope;  ?>
     
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
 
  <!------------------------------------------------------>
 <div class="form-group col-md-12">
<div class="submit-btn-sec submit-btn-sec2 ">
<input type="submit" style="width:124px" class="btn btn-info  marg_1 " value="UPDATE" name="Edit_Project">

</div>
</div>
		</div>
		
	</div>
   

  
	   
 

   

 
   <!----------------Contact Name------------------------->

   

 
 



   




</div>
</div>
</div>
</div>
</div>



</div>
</div>
</div>
</div>
</div>



  </div>
</div>
<script>
jQuery(document).ready(function(){
	/* i=<?php echo $num;?>;
	flag=0;
	jQuery('#add_engineer').click(function(){
		flag="1";
	jQuery('#add_new_box').append('<div class="Adddiv "> <div class="col-sm-12 mb-3 engineer'+i+'" style="margin-top:10px;"> <label>Engineer Name</label><select class="form-control form-control-solid" name="engineer'+i+'"><option disabled selected>--Select--</option><?php  foreach( $All_engineer as $Engineer){ ?><option value="<?= $Engineer['id']; ?>"><?= $Engineer['name']; ?></option><?php } ?></select><span class="col-md-2 btn btn-outline-primary remove mt-5" style=" padding:5px 2px;" id="engineer'+i+'">DELETE</span></div></div>');
	jQuery('#enghid').val(i);
	i++;
	jQuery('.remove').click(function(){
	var id = jQuery(this).attr('id');
	jQuery('div.'+id).remove();
	
	});
	
	}); */
	
	i=1;
$('#add_engineer').click(function(){
	
 $('#add_new_boxsup').append('<div id="div'+i+'" ><div  style="position: relative;"> <label style="position: absolute;left: 6px;top: -27px;">supervisor Name</label> <select style="margin-top: 35px;" class="form-control form-control-solid" name="supervisorarray[]"> <option selected disabled>----select supervisor-----</option> <?php echo $blank_sup; ?> </select> <div class="col-md-2"></div><i id="'+i+'" style="position:absolute;top: 15px;right: -27px;" class="remove fa fa-times-circle" aria-hidden="true"></i></div></div>');
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
	
	
	jQuery('.removedel').click(function(){
	var id = jQuery(this).attr('id');
	jQuery('#div'+id).remove();
	
	});
	
	
	
	
	
});
	
</script>

