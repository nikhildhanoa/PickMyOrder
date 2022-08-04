
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
				<form  method="post" enctype="multipart/form-data" action="<?php echo site_url('AddNewDeleverCost'); ?>">
		  
						  <div class="jumbotron-sec marg ">
							 <div class="form-horizontal">
							 <!----------------Shipping Title------------------------->   
							 <div class="form-group ">
								  <label>Shipping Title</label>
								
										<input type="name" class="form-control form-control-solid" placeholder name="title">
								
							 </div>
							   <!----------------Cost------------------------->   
							  <div class="form-group  ">
								  <label>Shipping Cost</label>
								
								  <input type="text" class="form-control form-control-solid" required  name="cost" value="<?php echo $cost; ?>">
								  
								
							 </div>
								<!-------------------------------city------------------------------->
                               <button  name="updatecost" class="btn btn-info">Add Shipping</button> 
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