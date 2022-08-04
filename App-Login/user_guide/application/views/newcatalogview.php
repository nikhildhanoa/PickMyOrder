<?php error_reporting(0);
   
    if(isset($_SESSION['Current_Business'])){
		$bid=$_SESSION['Current_Business'];
	//$All_Cetalogues=$this->CetaloguesModels->ViewCatelog($bid);
	$sectionobj=$this->db->query("select * from dev_cetalog_section where business_id='$bid'");
//	$catobj=$this->db->query("select * from dev_cetalog_cat where business_id='$bid'");
	
 }else
 {
	 $bid=$_SESSION['status']['business_id'];
	//$All_Cetalogues=$this->CetaloguesModels->ViewCatelog($bid); 
	$sectionobj=$this->db->query("select * from dev_cetalog_section where business_id='$bid'");
//$catobj=$this->db->query("select * from dev_cetalog_cat where business_id='$bid'");
	
 }
  $scearray= $sectionobj->result_array();
//  $catarray=$catobj->result_array();
?>
<div class="container">
  <ul class="nav nav-tabs">
  
    <li class="active" ><a data-toggle="tab" href="#Addsection">Add Sections</a></li>
	 <li><a data-toggle="tab" href="#Managesection">Manage Sections</a></li> 
    <li><a data-toggle="tab" href="#addcatalog">Add Catalogues</a></li> 
	<li><a data-toggle="tab" href="#managecatalog">Manage Catalogues</a></li> 	
  </ul>
 <div class="tab-content">
 
 <div id="Addsection" class="tab-pane active background">
       <h3>Add Section</h3> 
  
	    <div>
           
              <form  enctype="Multipart/form-data" method="post" action="<?php echo site_url('Newcatalogcontroller/add_section');?>">
			 
				   <div class="row" style="margin-top:30px">
							<div class="col-sm-8">
								  <div class="col-sm-3">Section Name</div>
								 <div class="col-sm-5">
									<input type="text" name="section" placeholder="Section Name" class="form-control">
									<input type="hidden" name="bid" value="<?php echo $bid;?>">
								 </div>
							</div> 
				   </div>
				    <div class="row" style="margin-top:30px">
							<div class="col-sm-8">
								  <div class="col-sm-3">Cover Image</div>
								 <div class="col-sm-5">
									<input type="file" name="cover"  >
								 </div>
							</div> 
				   </div>
				   <div class="row" style="margin-top:30px">
					   <div class="col-sm-6">
								<input type="submit" name="addsec" Value="Add Section" class="btn btn-info">
						</div>
					</div>
					 
               </form>
       
   </div>
 
 </div>
 <!----------------------------------manage section------------------------------------->
 <div id="Managesection" class="tab-pane   background">
       <h3>Manage Section</h3> 
	 <table class="table table-striped">
    <thead>
      <tr>
	    <th>ID</th>
        <th>Section</th>
       
		<th>Cover</th>
		<th>Edit</th>
		<th>Delete</th> 
      </tr>
    </thead>
    <tbody>
  <?php foreach( $scearray as $sec){ 
	  ?>
	    <tr>
		<td><?php $id = $sec['id']; echo $sec['id'];?></td>
		<td><?php echo $sec['section_name'];?></td>
		<td><img src="<?php echo $sec['cover_image'];?>" style="width:100px;height:100px;"></td>
		<td><a href="<?php echo site_url('EditNewCatalogSection?id='.$id); ?>"><i style="color:#5867dd" class="fa fa-pencil" aria-hidden="true"></i></a></td>
		<td><a href="#" class="newanchor " id="<?php echo site_url('DeleteNewCatalogSection?id='.$id); ?>" data-toggle="modal" data-target="#myConModal" ><i class="fa fa-times-circle" aria-hidden="true"></a></i></td>		
		</tr>
	  <?php
  }?>
	    </tbody>
  </table>
 </div>
 <!-----------------------------add catalog and view------------------------------------>
    <div id="addcatalog" class="tab-pane   background">
      <h3>Add Catalogues</h3> 
              <form enctype="multipart/form-data" method="post" action="<?php echo site_url('Newcatalogcontroller/newCetalogues');?>">
			  <div class="row" style="margin-top:10px;margin-bottom:10px">
				  <div class="col-sm-8">
					  <div class="col-sm-3">
							Select Section
					  </div>
					  <div class="col-sm-5">
							<select name="sectionid" class="form-control">
							<option value="0">-----Select------</option>
							<?php foreach($scearray as $sec)
							{ ?>
							<option value="<?php echo $sec['id'];?>"><?php echo $sec['section_name'];?></option>
							<?php  } ?>
							</select>
					  </div>
				  </div>
			  </div>
			  <div class="row" style="margin-top:10px;margin-bottom:10px">
				  <div class="col-sm-8">
					  <div class="col-sm-3">
							Description
					  </div>
					  <div class="col-sm-5">
							<textarea name="description" class="form-control"></textarea>
					  </div>
				  </div>
			  </div>
			  
			     <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <div class="col-sm-8">
						<div class="col-sm-3">
								Upload Catalogue
						</div>
						<div class="col-sm-3">
								<input type="file" name="pdffile" required>
						</div>
                    </div>
			    </div>
				<div class="row" style="margin-top:10px;margin-bottom:10px">
                    <div class="col-sm-8">
	     				<input class="btn btn-info" type="submit" value="Upload Catalogue" name="uploadpdf">
					</div>
				</div>
              </form>
    </div>
	<!----------------------------------manage catalog------------------------------------->
 <div id="managecatalog" class="tab-pane  background">
				<h3>Manage Catalogues</h3> 
				<div class="row" style="margin-top:10px;margin-bottom:10px">
                    <div class="col-sm-8">
						<div class="col-sm-3">
								Select Section
						</div>
						<div class="col-sm-5">
							<select name="catalogsectionid" class="form-control" id="SelectSectionForCatalog">
								<option value="0">-----Select------</option>
								<?php foreach($scearray as $sec)
								{ ?>
								<option value="<?php echo $sec['id'];?>"><?php echo $sec['section_name'];?></option>
								<?php  } ?>
							</select>	
						</div>
                    </div>
			    </div>
				  
		<!----------------------------- showing catalog section------------------------------------>
	  <div class="row addepter">
	  
	  </div>
   
 
 </div>

  </div>
  
</div>



<!--::js""-->
<script>
jQuery('#SelectSectionForCatalog').change(function(){
	  jQuery(".addepter").empty();
      selctvalue = jQuery(this).val();
	  
	  
      jQuery.ajax({
          url:"<?= base_url('')?>newcatalogcontroller/ShowCatalogBySection",
          method:"post",
          data:{'selectedid':selctvalue},
          success:function(data)
          {
			  
			  if(data!='0')
			  {
				  
				  parseddata = JSON.parse(data);
				  
				   if(parseddata.length)
				  {
					  for(i=0;i<parseddata.length;i++)
					  {
						  
						  url=parseddata[i]['url'];
						  id = parseddata[i]['id'];
						  jQuery(".addepter").append("<div class='col-sm-3 imgbox'><img src='"+url+"' style='width:100px;height:100px'><i class='fa fa-times deleteicon' id='"+id+"' aria-hidden='true'></i></div>");
						  
						
					}   
						jQuery(".deleteicon").click(function(){

							id = $(this).attr('id');
							jQuery.ajax({
							  url:"<?= base_url('')?>newcatalogcontroller/DeleteCateLougesImg",
							  method:"post",
							  data:{'id':id},
							  success:function(data)
							  {
								  console.log('delete sucessfully');
							  }
							 	
							});	
							jQuery(this).parent('.imgbox').remove();  
						});			  
				}
				  
			  }
			  else
			  {
				  alert('Select a section');
			  }
          }
      })
});

//confirmatiom-Of-Delete

$('.newanchor').click(function(){
		var myIdd = $(this).attr('id');
		$("#deca").attr("href", myIdd);
	});

</script>
