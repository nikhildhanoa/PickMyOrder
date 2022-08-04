
   <div id="form">
   <form method="post" enctype="multipart/form-data" action="<?php echo site_url('ReEnterAdvertisment');  ?>">
<div class="container">

<!-------email-section--->

  <div class="row">

<div class="col-md-6 col-xs-12 ">
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Edit  Advertisment</h3>
	
		 </div>
  <div class="card-body">
	<div class="form-group dropzone pt-0" style="border: none;">
 <div class="jumbotron-sec marg">

  <div class="">


 <!----------------busniss-name------------------------->   
   <div class="form-group ">
        <label style="font-weight:600">Advertisment source</label>
		
	
	
	
	<?php
    
	if($key[0]['Type']=='image') { ?>
	<div style="display:flex;align-items:flex-end;gap:5px" id="">
	
	  <span id="imagediv"  style="display: block;" >
	<img src="<?php echo $key[0]['source']; ?>"  style=" width: 150px;margin-bottom: 2em;" >
	<span><i class="fas fa-trash-alt deletes" style="color:red;"    ></i></span>
	</span>
	
	<span id="filediv" style="display: none;">
	<input  type="file" class="form-control email form-control-solid mb-5"   name="filetoupload"  >
	</span>
	
	<?php   }else if($key[0]['Type']=='video') { ?>
	
	 <span id="videodiv" style="display: block;">
	 <video  controls style=" width: 150px;" >
     <source src="<?php echo $key[0]['source']; ?>"></video> 
     <span><i class="fas fa-trash-alt deletes" style="color:red;"    ></i></span>
      </span>
	  
	  
	  
	 <span id="filediv" style="display: none;">
	<input  type="file" class="form-control email form-control-solid mb-5"   name="filetoupload"  >
	</span>
	 
	 
	<?php } else {  ?>
	 
	 
       
	   
	   <input  type="file" class="form-control email form-control-solid mb-5"   name="filetoupload"   >
	    </div>
	   <?php }  ?>
	  </div>
	  
 
 
   <!----------------Contact Number------------------------->
   <div class="form-group">
<label style="font-weight:600"> url</label>
	
<input  type="text" class="form-control email form-control-solid mb-5"  placeholder="Enter Url" name="URLfileto" value="<?php echo $key[0]['url'];  ?>">


	</div>

	<div class="form-group">
<label style="font-weight:600"> Select Tab</label>
<br>
<input type="radio"  name="fav_tab" value="0"  id="hide_brand_id" <?php if($key[0]['status']=='0'){?> checked <?php  } ?>>
  <label for="css">Category</label><br>
  <input type="radio"  name="fav_tab" value="1" id="hide_brand_id2"   <?php if($key[0]['status']=='1'){?> checked <?php  } ?> >
  <label for="javascript">wholesaler</label><br>
  <input type="radio"  name="fav_tab" value="2" id="brand_id"  <?php if($key[0]['status']=='2' || $key[0]['status']=='3' ){?> checked <?php  } ?>>
  <label for="javascript">Brand</label>
</div>
	
	<div class="brandsname" id="kt_header_menu2" style="margin-bottom: 1.75rem; display:<?php if($key[0]['status']=='3'|| $key[0]['status']=='2' ) {?>block <?php } else {   ?>none <?php }?>; ">
    
  <label for="javascript" style="font-weight:600;color:rgb(172, 5, 1);;">If you select a Brand, Advertisment goes to that brand else it will shows on all Brand Tab</label>                        							
							
<select class=" repeatselect form-control form-control-solid" name="selectbrand" id="selectbrandid">
<?php $brandws_id=$key[0]['brands_id'];   if($brandws_id=='0') {   ?>
<option value="SelectBrand,0" selected>Select Brand</option>
<?php } else {  ?>
<option value="SelectBrand,0" >Select Brand</option>
<?php } ?> 							
<?php  foreach($keytwo as $keydata)  { ?>

<option  <?php if($keydata['id'] == $key[0]['brands_id']) { ?> selected <?php echo $key[0]['brands_id']; ?> <?php } ?>    value="<?php echo $keydata['business_name'].','.$keydata['id'];?>"> <?php echo $keydata['business_name'];?> </option>
<?Php } ?>
											
</select>
</div>
	<div class="form-group">
<label style="font-weight:600"> Publish Status</label>
	<br>
<input type="radio"  name="Publish_tab" value="1" <?php if($key[0]['publish_status']=='1'){?> checked <?php  } ?>>
  <label for="css">yes</label>
  <input type="radio"  name="Publish_tab" value="0" style="margin-left:10px" <?php if($key[0]['publish_status']=='0'){?> checked <?php  } ?>>
<label for="javascript">No</label><br>

	</div>
	
	
	
	<input type="hidden" id="inputid" value="<?php echo $key[0]['id']  ?>"  name="getid" >
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
	$('#selectbrandid').val(0);
});


$('#hide_brand_id2').click(function(){
	$('.brandsname').css("display", "none");
	$('#selectbrandid').val(0);
});




$('.deletes').click(function(){
	
	
	id = $('#inputid').val();
	
	$.ajax({
   		type:"POST",
   		url:"<?= base_url('')?>DeleteAdsSource",
   		data:{'id':id},
   		success:function(data)
   		{
   			if(data==1)
			{
				$("#imagediv").css("display", "none");
				$("#videodiv").css("display", "none");
				$("#filediv").css("display", "block");
			}	
   			
   		}
   			
   	 });
	
	
	
});


</script>


