
<?php 
$cat_id=$_GET['id'];

$cat_list_name=$this->db->query("select * from dev_categorylist where id='$cat_id'");
$cat_list_name=$cat_list_name->result_array();

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
						  
								 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('EditCategoryList');?>">
								   <label>Category List Name</label>
								   <input type="hidden"  name="catid" value="<?php echo $cat_id ?>" >
									<input type="text" name="catlist" value="<?php echo $cat_list_name[0]['catalog_list_name']; ?>" class="form-control form-control-solid">
									<input style="margin-top: 10px;" type="submit" value="Edit" name="categorylistbutton" class="btn btn-info listbtn">
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
	
<