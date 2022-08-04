<?php 
if(isset($key) && isset($id))
{
	
?>
 <div id="AddShelves" class="tab-pane active background">
     
  <div class="row">
	    <div class="col-md-12">
	   <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Edit Shelve</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
           
              <form  method="post" action="<?php echo site_url('InsertEditShelve'); ?>">
			 
				  
							   <div class="form-group ">
								  <div>Shelves Name</div>
								 
									<input type="text" name="Shelves" placeholder="Shelves Name" class="col-md-6 form-control form-control-solid mt-5" value="<?php  echo $key[0]['shelves_name']; ?>" required>
									<input  type="hidden" name="shelve_id" value="<?php echo $id ?>">
								 
								</div>
				  
					   <div class="form-group ">
								<input type="submit" name="editShelves" Value="Edit Shelve" class="btn btn-info">
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
<?php  }?>