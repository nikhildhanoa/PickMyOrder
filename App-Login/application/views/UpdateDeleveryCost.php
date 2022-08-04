<?php error_reporting(0);
$id=$_REQUEST['id'];
$dataobject=$this->db->query("select * from dev_delevery where id='$id'");
$data_array=$dataobject->result_array();
$title=$data_array[0]['title'];
$cost=$data_array[0]['cost'];
$id=$data_array[0]['id'];
?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">


  <div class="tab-content">
    
	 
	 
    
    <div id="menu1" class="tab-pane active background"> 
      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
		<div id="form">
		<div class="container">
			 
				<div class="row">
			
				<div class="col-md-6 col-xs-12 ">
				 <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Add Shiping</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
				<form  method="post" enctype="multipart/form-data" action="<?php echo site_url('UpdateDeleveryCost'); ?>">
		  
						  <div class="jumbotron-sec marg ">
							 <div class="form-horizontal">
							 <!----------------Shipping Title------------------------->   
							 <div class="form-group ">
								  <label>Shipping Title</label>
								
										<input type="name" class="form-control form-control-solid" value="<?php echo $title; ?>" placeholder name="title">
								
							 </div>
							   <!----------------Cost------------------------->   
							  <div class="form-group  ">
								  <label>Shipping Cost</label>
								
								  <input type="text" class="form-control form-control-solid" required  name="cost" value="<?php echo $cost; ?>">
								  <input type="hidden" class="form-control form-control-solid" value="<?php echo $id;?>"; name="id">
								
							 </div>
								<!-------------------------------city------------------------------->
                               <button  name="updatecost" class="btn btn-info">Update Shipping</button> 
							</div>
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
	</div>
</div></div>