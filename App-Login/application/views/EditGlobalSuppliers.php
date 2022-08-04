
 <style>
 .eng_option .form-group {
    margin-bottom: 10px;
}
	.checkbox_container {
  display: block;
  position: relative;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}


.checkbox_container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}


.checkmark {
  position: absolute;
    top: 0;
   right: -35px;
    height: 20px;
    width: 20px;
    background-color: #ecedf3;
    border-radius: 4px;
}



.checkbox_container input:checked ~ .checkmark {
  background-color: #2196F3;
}


.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}


.checkbox_container input:checked ~ .checkmark:after {
  display: block;
}


.checkbox_container .checkmark:after {
 left: 7px;
    top: 2px;
    width: 7px;
    height: 14px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.select-opt select {
    width: 100%;
    padding: 4px;
    border-radius: 4px;
}
</style>	


 
<div class="container">
	 
	    <div class="row">
		
	   <div class="col-md-6 col-xs-12">
      
	  <div class="card card-custom gutter-b example example-compact" style="min-height: 630px;">
<div class="card-header">
         <h3 class="card-title">General Details</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
      
	  
	  
  <form method="post"  enctype="multipart/form-data" action="<?php echo site_url('EditSingleGlobalSupplier');?>"  >
   <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group">
      <label >Supplier Name</label>
	  
	 
      <input required type="text" class="form-control form-control-solid" placeholder="Enter Name" name="SupplierName" value="<?php echo $key[0]['Supliers_Name'];  ?>">
    
	</div>
   <!----------------address------------------------->   
   <div class="form-group">
 <label >Supplier logo</label>

        <?php  if(!empty($key[0]['Supliers_logo'])){?>
		
		
		 <img id="a2" src="<?php echo $key[0]['Supliers_logo'];  ?>" alt="supplier logo" height="100px" width="100px"/><i class="fas fa-trash-alt changecatimage"></i>
		
		<?php } else { ?>
	 
      <input  id="a1" type="file" class="form-control form-control-solid"   name="Supplierlogo">
     <?php } ?>
	</div>
   <!----------------post code-------------------------> 

   <!----------------Email------------------------->
   
 
	<!--------------------------------HiddenWholeSeller_Value------------------------------>
	 
	<input type="hidden"  value="<?php  echo $this->uri->segment(2); ?>" name="hiddenid"  >
	
	<div class="form-group ">

		
	    <div class="col-md-6">
<input type="submit" name="add_enginner" class="btn btn-info " value="SUBMIT">

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

</form>
		   
 
 



    </div>

</div>
 <script>

// change or delete cat image	
$('.changecatimage').click(function(){
		
		$.ajax({
		url:"<?= base_url('')?>DeleteSingleSuplierLogo",
		method:"POST",
		data:{'id':<?php echo $this->uri->segment(2); ?>},
		success:function(data)
		{
		        if(data==1)
				{
					$('#a2').css('display','none');
					$('#a1').css('display','block');
					location.reload();
				}
				
			
		}
	});
		
	});

</script>