<?php
	$id = $_REQUEST['id']; 
	$sectionobj= $this->db->query("select * from dev_cetalog_section where id='$id'");
	$row = $sectionobj->result_array();
	$section_name = $row[0]['section_name'];  
	$cover_image = $row[0]['cover_image'];
	$Shelves_id = $row[0]['Shelves_id'];
	
	
	$shelves_name=$this->db->query("select id,shelves_name from dev_Shelves");
   $shelves_name=$shelves_name->result_array();
?>

<div class="container">
<div id="Editsection" class="tab-pane active background">
       <h3>Edit Section</h3> 
  
	    <div>
           
              <form id="Editsectionfom" enctype="Multipart/form-data" method="post" style="margin: 15px 0;" action="<?php echo base_url('EditNewCatalogSection'); ?>" >
			  
	
			   <div class="form-group ">
					  <div>
							Select Section
					  </div>
					  <div>
					  

					  
							<select name="Shelve_id" class="col-md-6 form-control form-control-solid mt-5" id="Shelves_id" required="required">
							<option value="">-----Select------</option>
							<?php foreach($shelves_name as $sec)
							{ ?>
							<option   <?php if($row[0]['Shelves_id'] == $sec['id']) { ?> selected="<?php echo $sec['id']; ?>" <?php } ?> value="<?php echo $sec['id'];?>"><?php echo $sec['shelves_name'];?></option>
							<?php  } ?>
							</select>
					  </div>
					  
				 </div>
		
			 <br>
				   <div class="row" style="margin-top:35px">
							<div class="col-sm-8">
								  <div class="col-sm-3">Section Name</div>
								 <div class="col-sm-5">
									<input type="text" id="section" name="section" placeholder="Section Name" class="form-control" value="<?php echo $section_name?>" required>
									<input type="hidden" name="id" id="cid" value="<?php echo $id;?>">

									
								 </div>
							</div> 
				   </div>
				    <div class="row" style="margin-top:30px">
							<div class="col-sm-8">
								  <div class="col-sm-3">Cover Image</div>
								 <div class="col-sm-5">
									<input type="file" name="cover" id="file" >
								 </div>
							</div> 
				   </div>
				   <div class="row" style="margin-top:30px">
					   <div class="col-sm-6">
								<input type="submit" id="update" name="editsec" Value="UPDATE" class="btn btn-info">
						</div>
					</div>
					 
               </form>
       
   </div>
 </div>
 

   	