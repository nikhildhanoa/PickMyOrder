<?php 

$data=$this->db->query("select * from  globalsettings where id='1'");
$data1=$data->result_array();
$key_value=$data1[0]['key_value'];

?>
<div class="container">
<div class="row">
<div class="col-md-6">
<div style="padding: 2rem 2.25rem;background: white;
    height: 350px;">		
		<h3 class=" font-size-lg text-dark font-weight-bold mb-6" style="padding: 16px 0 16px 0px !important;color:red !important">Please select what products Delivery or Collection </h3>
	<div class="form-group row">
				<label class="col-3 col-form-label pl-0" style=" padding-right: 0px; margin-left: 15px"><span id="status_word"> <?php if($key_value=='1'){ ?> Delivery <?php } else echo "Collection"; ?> </span></label>
				<div class="col-3 deli">
					<span class=" switch switch-lg">
						<label>
	<input  <?php if($key_value=='1'){ ?> checked <?php } ?>  type="checkbox" name="app_active_status" class="Delivery Collection" id="pbtn">
					
							<span></span>
						</label>
					</span>
				</div>
				
	             </div>
</div>
</div>
</div>			
 <script>
 

$(document).ready(function(){
 $("#pbtn").click(function(){
	 
   if($("#pbtn").prop('checked') == true)
   {
	  
	   state=1;
	  $("#status_word").html("Delivery");
	   /*
	 $(this).removeClass('Delivery');
	 $(this).addClass('Collection'); 
	 $('#pbtn').html('Collection');
	 $('#pbtn').removeClass('btn-success');
	 $('#pbtn').addClass('btn-danger');
	 */
	 }
   else
   { 
      state=0;
	   $("#status_word").html("Collection");
   /*
	  $(this).removeClass('UnPublish'); 
	  $(this).addClass('Collection');
	  $('#pbtn').html('Collection');
	 $('#pbtn').removeClass('btn-danger');
	 $('#pbtn').addClass('btn-success');
	  */
   
   }
    $.ajax({
	url:"CollectionDelivery",
	method:"post",
	data:{'id':1,'status':state},
	success:function(data)
     {
		 ('.deli').html();
	 }
	 });
		
  });
  }); 
</script>
			 
