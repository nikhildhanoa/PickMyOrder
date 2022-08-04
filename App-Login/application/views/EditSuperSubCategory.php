<?php error_reporting(0);
$catid=$this->uri->segment(3);

?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">


      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
		<div id="form">

			 
				<div class="row">
				 <div class="col-md-6 col-xs-6 border">
		<div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
         <h3 class="card-title">Edit Sub Sub Category</h3>
	
		 </div>
		 <div class="card-body">
		  <div class="form-group mb-0">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
				
				<form  method="post" enctype="multipart/form-data" action="<?php echo site_url('updateSubData'); ?>">
		  
						  <div class="jumbotron-sec marg ">
							 <div class="form-horizontal">
							 <!----------------Shipping Title------------------------->   
							 <div class="form-group ">
								  <label>Name</label>
								
								<?php if($bid=='15') { ?>
								<input type="text" class="form-control form-control-solid" value="<?php echo $key[0]['name']; ?>"  name="cat_name">
								<?php   } else { ?>
                            <input type="text" class="form-control form-control-solid" value="<?php echo $key[0]['name']; ?>"  name="cat_name" readonly>
							<input type="hidden" value="<?php echo $key[0]['cute_super_cat']; ?>" name="Cat_Cute_Name" >
                                <?php } ?>								
							
									
							 </div>
							 <?php if($bid=='15') { ?>
							 <div class="form-group ">
								  <label>Name In App</label>
								
										<input type="text" class="form-control form-control-solid" value="<?php echo $key[0]['cute_super_cat']; ?>"  name="Cat_Cute_Name">
									
							 </div>
							 <?php  } ?>
							   <!----------------Cost------------------------->   
							   
							   
							  <div class="form-group a1" <?php if($key[0]['image']==''){?>style="display:block"<?php }else{?>style="display:none"<?php } ?>>
								  <label>Image</label>
								  
								  <input type="file" class="form-control form-control-solid"   name="cat_img">
								
							 </div>
							  <div class="form-group a2" <?php if($key[0]['image']==''){?>style="display:none"<?php }else{?>style="display:block"<?php } ?>>
								  <label class="mr-5">Image</label>
							
							       
								  <img class="mr-5" src="<?php echo $key[0]['image'];?>" width='50px' height='50px'><i class="fas fa-trash-alt changecatimage"></i>
								
							 </div>
							
								<!-------------------------------city------------------------------->
							<div class="form-group">
							<input type="hidden" class="form-control form-control-solid" value="<?php echo $catid;?>" name="redirectid">
							<input type="hidden" class="form-control form-control-solid" value="supersubcategory" name="checkpage">
							 <input type="hidden" class="form-control form-control-solid" value="<?php echo $key[0]['id'];?>"; id="ids" name="id">
								<button  name="updatecost" class="btn btn-info">Update</button>
							</div>							   
							</div>
						</div>
				</form>
			
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
  
  
 $('.changecatimage').click(function(){
	 var ids=$('#ids').val();	
	 
		$.ajax({
		url:"DeleteSupCatImages",
		method:"POST",
		data:{'supcatid':ids},
		success:function(data)
		{
		        if(data==1)
				{
					$('.a2').css('display','none');
					$('.a1').css('display','block');
					location.relode();
				}
				
			
		}
	});
		
	}); 


</script>