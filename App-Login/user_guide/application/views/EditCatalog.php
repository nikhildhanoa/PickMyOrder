<?php
	$id = $_REQUEST['id']; 
	$sectionobj= $this->db->query("select * from dev_cetalog_section where id='$id'");
	$row = $sectionobj->result_array();
	$section_name = $row[0]['section_name'];
	$cover_image = $row[0]['cover_image'];
?>

<div class="container">
<div id="Editsection" class="tab-pane active background">
       <h3>Edit Section</h3> 
  
	    <div>
           
              <form id="Editsectionfom" enctype="Multipart/form-data" method="post" >
			 
				   <div class="row" style="margin-top:30px">
							<div class="col-sm-8">
								  <div class="col-sm-3">Section Name</div>
								 <div class="col-sm-5">
									<input type="text" id="section" name="section" placeholder="Section Name" class="form-control" value="<?php echo $section_name?>">
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
 
<script>
   $(document).ready(function(){
	   
   	/******************Edit data by ajax******************************/

    $("#update").click(function(){
		
        //var fd = new FormData();
        //var files = $('#file')[0].files[0];
		var section = $('#section').val();
		var cid = $('#cid').val();
		
        $.ajax({
            url: "<?= base_url('')?>updatecatalog",
            type: 'post',
            data: {'section':section,'cid':cid},
            success: function(data){
                consloe.log(data);
            },
        });
    });
});

</script>	