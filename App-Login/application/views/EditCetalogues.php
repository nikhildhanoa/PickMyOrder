 <?php
 $shelvid =$_GET['shelvid'];
	 $sectionid =$_GET['sectionid'];
	 
	 
 if(isset($key) &&($secname) &&($cat_id) )
  
 
 {  	 
//print_r($key);die; 
 ?>
 <div id="addcatalog" class="tab-pane   background">
	  <div class="row">
       <div class="col-md-12">
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Edit Catalogue</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
              <form enctype="multipart/form-data" method="post" action="<?php echo base_url('UploadCatalogs') ?>">
			
					 <div class="form-group ">
					  <div>
							Select Section
					  </div>
					  <div>
					  
					  
					     
					  
					  
							<select id="section" name="sectionid" class="col-md-6 form-control form-control-solid mt-5" required="required">
							<option value="">-----Select------</option>
							<?php foreach($secname as $fulname)
							{  ?>
							<option <?php if($key[0]['sectionid'] == $fulname['id']) { ?> selected="<?php echo $fulname['id']; ?>" <?php } ?> value="<?php echo $fulname['id']?>"><?php echo $fulname['section_name']?></option>
							<?php } ?>
							</select>
					  </div>
				 </div>
			 
			  <div class="form-group ">
				 
					  <div>
							Description
					  </div>
					  <div>
							<textarea  name="description" id="description"  class="col-md-6 form-control form-control-solid mt-5" required><?php echo $key[0]['description']  ?></textarea>
					  </div>
				 
			  </div>
			  
			  <?php if($key[0]['type'] == "pdf" || $key[0]['type'] == "docx" || $key[0]['type'] == "xlsx" || $key[0]['type'] == "xls" || $key[0]['type'] == "doc" || $key[0]['type'] == "csv")  {?>
		   <div class="form-group"><a href="<?php echo $key[0]['url'];  ?>" style="font-weight: 500;font-size: 15px;">click Here to download <span></span></a></div>
		   
		   <?php } else { ?>
	            <img src="<?php  echo $key[0]['url'] ?>" style="width:100px;height:100px;">
		   <?php }?>
		  
			  
			  
			    <div class="form-group">
						<div style="margin: 10px 0;">
								Upload Image To Display
						</div>
						<div>
								<input type="file" name="Image_To_Display"  class="mt-5" id="fileName" onchange="validateFileType()"/>
						</div>
                    </div>
                    <div class="form-group">
						<div style="margin: 10px 0;">
								Upload Catalogue
						</div>
						<div>
								<input type="file" name="pdffile"  class="mt-5" id="fileName" onchange="validateFileType()"/>
						</div>
                    </div>
			   
				<div class="form-group">
                          <input type="hidden" name="catalog_id" value="<?php echo $cat_id ?>">
						   <input type="hidden" name="url_shelvid" value="<?php echo $shelvid  ?>">
						    <input type="hidden" name="url_sectionid" value="<?php echo $sectionid ?>">
						  
	     				<input class="btn btn-info" type="submit" id="upload_cat" value="Upload Catalogue" name="uploadpdf">
					
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
 <?php } ?>
 <script>

</script>