
   <div id="form">
   <form method="post" enctype="multipart/form-data">
<div class="container">
	 
	  







<!-------email-section--->

  <div class="row">

<div class="col-md-6 col-xs-12 ">
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Add  Advertisment</h3>
	
		 </div>
  <div class="card-body">
	<div class="form-group dropzone pt-0" style="border: none;">
 <div class="jumbotron-sec marg">

  <div class="">


 <!----------------busniss-name------------------------->   
   <div class="form-group ">
        <label style="font-weight:600">Advertisment source</label>
	
	 <input  type="file" class="form-control email form-control-solid mb-5"   name="filetoupload" >
	 
	 
       
	  </div>

 
   <!----------------Contact Number------------------------->
   <div class="form-group">
<label style="font-weight:600"> url</label>
	
<input  type="text" class="form-control email form-control-solid mb-5"  placeholder="Enter Url" name="URLfileto">


	</div>
	
	<div class="form-group">
<label style="font-weight:600"> Select Tab</label>
<br>
<input type="radio"  name="fav_tab" value="0" required id="hide_brand_id">
  <label for="css">Category</label><br>
  <input type="radio"  name="fav_tab" value="1" id="hide_brand_id2">
  <label for="javascript">wholesaler</label><br>
  <input type="radio"  name="fav_tab" value="2" id="brand_id">
  <label for="javascript">Brand</label>

</div>
	
	
<div class="brandsname" id="kt_header_menu2" style="margin-bottom: 1.75rem; display:none;">
    
  <label for="javascript" style="font-weight:600;color:rgb(172, 5, 1);;">If you select a Brand, Advertisment goes to that brand else it will shows on all Brand Tab</label>                        							
							
<select class=" repeatselect form-control form-control-solid" name="selectbrand"><option value="SelectBrand,0">Select Brand</option> 							

<?php  foreach($key as $keydata)  { ?>

<option value="<?php echo $keydata['business_name'].','.$keydata['id'] ;  ?>"><?php echo $keydata['business_name'];  ?></option>
<?php  } ?>													
</select>
</div>	
	
	
	
	
<div class="form-group">
<label style="font-weight:600"> Publish Status</label>
	<br>
<input type="radio"  name="Publish_tab" value="1" required>
  <label for="css">yes</label>
  <input type="radio"  name="Publish_tab" value="0" style="margin-left:10px">
<label for="javascript">No</label><br>

	</div>	
	
 <div class="submit-btn-sec my-5">
<input type="submit" class="btn btn-info  marg_1 " value="SUBMIT" name="Insert_adv">

    </div>
</div>
</div>
</div>
<div class="col-md-6 col-xs-12 ">
</div>
</div>

</div>
</div>
</div>
</div>
  </form>
</div>
 
<script>
$('#brand_id').click(function(){
	$('.brandsname').css("display", "block");
});

$('#hide_brand_id').click(function(){
	$('.brandsname').css("display", "none");
});


$('#hide_brand_id2').click(function(){
	$('.brandsname').css("display", "none");
});

</script>