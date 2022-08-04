

			<div id="form">
				<div class="container">
					 
						<div class="row">
							<div class="col-md-6 col-xs-12">
							<div class="card card-custom gutter-b example example-compact">
							<div class="card-header">
                        <h3 class="card-title">General Details</h3>

                    </div>
					
					<div class="card-body">
                        <div class="dropzone" style="border: none;">
                            <div class="jumbotron-sec marg ">

                                <div class="form-horizontal">
                                    <div class="form-group">
						  
								 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('ProductList');?>">
								   <label>Product List Name</label>
									<input type="text" name="addlist" class="form-control form-control-solid">
									<input style="margin-top: 10px;" type="submit" value="Add" name="productlistbutton" class="btn btn-info listbtn">
								  </form>
							
							</div>
							
							
							
							
							</div>
						</div>
						</div>
						</div>
						</div>
					
							
							</div>
						</div>

				 <!-- </form>-->
				<hr>
				</div>
			</div>
	
<script>
$('.savename').click(function(){
	plistid=$(this).val();
	prolistname_name=$('.'+plistid+'input').val();

	$.ajax({
		url:"<?= base_url('')?>UpdateProductListName",
		method:"POST",
		data:{'listid':plistid,'listname':prolistname_name},
		success:function(data)
		{
		        alert(data);
				location.reload();
			
		}
	});
});

$('.change').click(function(){
id=$(this).attr('id');
$('#'+id+'basic').css('display','none');
$('#'+id+'new').css('display','block');
});
/*********************************8make master list by ajax***********************/
$('.singlechecklist').change(function(){
	if(this.checked) 
		{
			action=1;
			
		}
		else
		{
			action=0; 
		}
	id=$(this).val();
 
	 $.ajax({
		url:"<?= base_url('')?>assignmasterlist",
		method:"POST",
		data:{'listid':id,'action':action},
		success:function(data)
		{
		        alert(data);
		}
	}); 
});
</script>
