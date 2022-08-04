<?php error_reporting(0); 


?>
<div class="container">




    <form class="form-signin" id="login" method="post" action="Notifications">
        <div class="row">
            <table>
                <tr id="noticetable"></tr>
            </table>
        </div>
        <div class="row">
		<!--    <div class="col-md-4 col-xs-12">
			          <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Shelves</h3>

                    </div>
                    <div class="card-body" style="padding: 2rem 1rem;">
                        <div class="form-group dropzone" style="border: none;">
                            <div class="jumbotron-sec marg ">

                                <div class="form-horizontal">
                                    <div class="form-group">
                                     
									   <?php  foreach ($cat as $cat_data){ ?>
									     <div class="mb-3 form-check">
									    <label class="form-check-label" for="exampleCheck1" ><?php echo $cat_data['shelves_name']; ?></label>
                                        <input type="checkbox" class="form-check-input" value="<?php echo $cat_data['id']; ?>"  id="exampleCheck1" style="margin:3px 10px;    
    position: absolute;top: -9px;left: 66%;height: 20px;width: 20px;background-color: #ecedf3;border-radius: 4px;">
	 </div>
									   <?php } ?>
                                       


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>-->
			
             <!-- Form 		-->	
			  
            <div class="col-md-6 col-xs-12">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">General Details</h3>

                    </div>
                    <div class="card-body">
                        <div class="form-group dropzone" style="border: none;">
                            <div class="jumbotron-sec marg ">

                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <span>Source Bussiness</span>
                                     
                                        <select class="form-control form-control-solid mt-2" id="source">
										 
                                            <option  disabled selected>Select Bussiness</option>
                                           <?php  foreach ($key as $GetSection) {  ?>
                                            <option value="<?php echo  $GetSection['id'];?>"><?php echo  $GetSection['business_name'];?></option>
                                             
                                            <?php  }?>

                                          
                                        </select>


                                    </div>
									<!-- Catalogue -->
									   <div class="form-horizontal">
                                    <div class="form-group">
                                   <h3 class="card-title" style="margin-bottom:16px">Shelves <span style="color:red;font-size:14px;">(** After select Source Bussiness Shelves Appears)</span></h3>
								   <div id='append_shelve'>
									     
										 
								
                                       
                                     </div>

                                    </div>

                                </div>
									
									
									<!-- Catalogue div end -->



                                    <div class="form-group">


                                        <span>Destination Bussiness</span>


                                        <select class="form-control form-control-solid mt-2" id="desti">
                                            <option  value="0"  selected>Select Bussiness</option>
                                            
                                            <?php  foreach ($key as $GetSection) {  ?>
                                            <option value="<?php echo  $GetSection['id'];?>"><?php echo  $GetSection['business_name'];?></option>
                                             
                                            <?php  }?>

                                            
                                        </select>


                                    </div>

                                    <div class="form-group">
                                        <span class="form-control btn btn-info" id="cpy_shelve">Copy All Shelves</span>
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
<script>
$('#source').change(function(){
 var SourceBusinessid= $('#source').val();
 
 if(SourceBusinessid!= "")
 {
	 $.ajax({
		  
		   url:'<?= base_url('')?>GetShelveByBusiness',
           method:'post',
		  
           data:{'SourceBusinessid':SourceBusinessid},
		   success:function(data)
		   {  
		     
		        var content = "";
		        var jsondata = JSON.parse(data);
		         for (var x = 0; x < jsondata.length; x++) {
					 
					  content += '<div class="mb-3 form-check" style="padding-left:0px;"><label class="form-check-label" id="Shelve_id" for="exampleCheck1">'+jsondata[x].shelves_name+'</label> <input type="checkbox" class="form-check-input" value="'+jsondata[x].id+'" id="exampleCheck1" style="margin:3px 10px; position: absolute;top: -7px;left: 58%;height: 20px;width: 20px;background-color: #ecedf3;border-radius: 4px;"></div>';
					 
				 }

			 $('#append_shelve').html(content);
		 
		   }
	      });
 }
	
    });	

/**********hh*******/
 $(document).ready(function(){
  $("#cpy_shelve").click(function(){
	 
	 var val = [];
	  $('#exampleCheck1:checked').each(function(i){
          val[i] = $(this).val();
        });

	   var sourceBusinees =$("#source").val();
	   var DestinationBusiness =$("#desti").val();
	     
	   if(DestinationBusiness == 0)
	   {
		   alert("Please Select Destination Bussiness");
	   }
	   else
	   {
	   if(val.length === 0)
	   {
		   alert("Select Atleast one Shelve");
	   }
	   else
	   {
		   if(sourceBusinees == DestinationBusiness)
		   {
			   alert("Source Bussiness And Destination Bussiness Does Note Same ");
		   }
		   else
		   {
			   $.ajax({
					  url:'<?= base_url('')?>CopyAllShelve',
					  method:'post',
					  data:{'sourceBusinees':sourceBusinees,'DestinationBusiness':DestinationBusiness,'shelveids':val},
					  success:function(data)
					  {
						 if(data==1) 
						 
						  alert('All Shelves copy');
						 // location.reload();
					  }
					 }); 
		   }
        }
	   }
  });
});


</script>