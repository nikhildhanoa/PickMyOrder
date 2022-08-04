<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="container">
	 
	    <div class="row">
		<div class="col-md-6">
			<div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
         <h3 class="card-title">Add New Vans</h3>
	
		 </div>
		 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 
	    <div class="col-md-12 col-xs-12">
		<div class="row">
			
  
 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('insertvans');?>" style="width:100%">
   
   <!----------------address-------------------------> 
   <div class="form-group pl-0">
      <label for="email"> Driver Name </label>
	    <input required type="Text" class="form-control form-control-solid"   name="drivername" style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email"> Vehicle Registration</label>
	    <input required type="Text" class="form-control form-control-solid"   name="registration" style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email">Make</label>
	    <input required type="Text" class="form-control form-control-solid"   name="make" style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email">Model</label>
	    <input required type="Text" class="form-control form-control-solid"   name="model" style="margin-top:0px !important;">
	  </div>
	  
	  
	  <div class="form-group pl-0">
      <label for="email">Type</label>
	    <input required type="Text" class="form-control form-control-solid"   name="type" style="margin-top:0px !important;">
	  </div>
	  
	  <div class="form-group pl-0">
      <label for="email">Add Engineer</label>
	    <input required type="Text" class="form-control form-control-solid"    placeholder="Enter Engineer" id="autocomplete" style="margin-top:0px !important;">
		<input type="hidden" class="eng" id="selectuser_id" name="engineer"> <span id="show_message"> </span>
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
					<input type="submit" name="nsert_vans" value="SAVE" class="btn btn-info" id="add_van">
			</div>
	
		</div>

   </div>
</div>
</div>
 </div>
</div>
  
  </div>
</div>


<!-- Second column -->


  
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