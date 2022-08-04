<?php 
if(isset($_GET['id']) && isset($_GET['name']))
{
	$id=$_GET['id'];
	$name=$_GET['name'];
?>
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
						  
								 <form method="post"  action="<?php echo site_url('EditNewProductList');?>">
								   <label>Product List Name</label>
									<input type="text" name="addlist" class="form-control form-control-solid" value="<?php echo$name; ?>">
										<input type="hidden" name="hiddenid"  value="<?php echo $id; ?>">
									<input style="margin-top: 10px;" type="submit" value="Update" name="updateListName" class="btn btn-info listbtn">
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
	
<?php } ?>