<?php error_reporting(0);
 if(isset($_GET['id']))
   {
	   
	   
	  $vans_id=$_GET['id']; 
   		 $single_van_data=$this->db->query("select * from  dev_vans where id=' $vans_id'"); 
	   
	   $single_van_data=$single_van_data->result_array();
	   
	   $van_engineer=$this->db->query("select engineer_id from   dev_van_engineer where van_id='$vans_id'"); 
	   $van_engineer=$van_engineer->result_array();
	    $engineer_id=$van_engineer[0]['engineer_id'];
		
		$van_engineer_deatils=$this->db->query("select email,user_name from   dev_engineer where user_id='$engineer_id'"); 
	   $van_engineer_deatils=$van_engineer_deatils->result_array();
	 
	    $engineer_email=$van_engineer_deatils[0]['email'];
		 $engineer_user_name=$van_engineer_deatils[0]['user_name'];
		
		
	   
   }




?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="container">
	 
	    <div class="row">
		<div class="col-md-12">
			<div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
         <h3 class="card-title">update  Vans</h3>
	
		 </div>
		 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 
	    <div class="col-md-6 col-xs-12">
		<div class="row">
			<!--Array ( [0] => Array ( [id] => 4 [driver_name] => test 25 [vehicle_registration] => 2431334 [make] => rerer [model] => 2322 [type] => 12312313 [business_id] => 3 ) )-->
  
 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('Updatevans');?>" style="width:100%">
   
   <!----------------address-------------------------> 
   <div class="form-group pl-0">
      <label for="email"> Driver Name </label>
	    <input required type="Text" class="form-control form-control-solid"   name="drivername" value="<?php echo$single_van_data[0]['driver_name']; ?>" style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email"> Vehicle Registration</label>
	    <input required type="Text" class="form-control form-control-solid"   name="registration" value="<?php echo$single_van_data[0]['vehicle_registration']; ?>" style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email">Make</label>
	    <input required type="Text" class="form-control form-control-solid"   name="make"  value="<?php echo$single_van_data[0]['make']; ?>"style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email">Model</label>
	    <input required type="Text" class="form-control form-control-solid"   name="model"   value="<?php echo$single_van_data[0]['model']; ?>"style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email">Type</label>
	    <input required type="Text" class="form-control form-control-solid"   name="type"  value="<?php echo$single_van_data[0]['type']; ?>" style="margin-top:0px !important;">
	  </div>
	  
	  <div class="form-group pl-0">
      <label for="email">Add Engineer</label>    
	    <input required type="Text" class="form-control form-control-solid"  id="autocomplete" value="<?php echo $engineer_email.' ('.$engineer_user_name.')' ?>" style="margin-top:0px !important;">
		<input type="hidden" class="eng" id="selectuser_id" name="engineer" value="<?php echo $engineer_id ?>">
	  </div>
	  
    

  
   

	 
	 
	 <!--<div class="form-group">
	 <h4 style="border-bottom:1px solid #f4f4f4; padding-bottom:10px;">Add Image</h4>
	 </div>
   <div class="form-group">
      <label for="email">Upload</label>
	   <input required type="file" class="form-control form-control-solid"  placeholder="image" name="image" style="margin-top:0px !important;">
	   <input type="hidden" name="redirect" value="category" >
	  </div>-->
	 
     
   
	

	
			<div class="form-group">
					<input type="submit" name="update_vans" value="SAVE" class="btn btn-info">
					 <input type="hidden" id="vans_id" name="id" value="<?php  echo $_GET['id']; ?>">
			</div>
	
		</div>

   </div>
</div>
</div>
 </div>
</div>
  
  </div>
</div>
  </form>
</div>
</div>
  <script>
   $(document).ready(function(){
  $("form").submit(function(){
  var userid=$('#selectuser_id').val();
	 if(isNaN(userid) || userid=='')
	 {
		$('#show_message').html("Enter valid Engineer");
		$('#show_message').css("color", "red");
		
		 return false;
		
	 }
	
	 
  });
});

 
  
 
 $( "#autocomplete" ).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "FetchVanEngineer",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term
    },
    success: function( data ) {
     response( data );
    }
   });
  },
  select: function (event, ui) {
     // Set selection
     $('#autocomplete').val(ui.item.label); 
     $('#selectuser_id').val(ui.item.value); 
     return false;
  },
  focus: function(event, ui){
     $( "#autocomplete" ).val( ui.item.label );
     $( "#selectuser_id" ).val( ui.item.value );
     return false;
   },
 });
 
 

</script>