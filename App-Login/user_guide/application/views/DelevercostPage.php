<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Manage Shipping</a></li>
    <li><a data-toggle="tab" href="#menu1">Add Shiping</a></li>
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
      <h3>Manage Shipping</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  <?php 
  
  if(isset($_SESSION['Current_Business'])){
	  $Get_Data = $this->DataModel->Select_All_dlcost($_SESSION['Current_Business']);
      $bid = $_SESSION['Current_Business'];
      
      
  }
   else{
	   $Get_Data = $this->DataModel->Select_All_dlcost(0);
	   $bid=0;
   }
   
   
   
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
	    <th>ID</th>
        <th>Title</th>
        <th>Cost</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($Get_Data as $Data) { ?>
      <tr>
	    <td><?= $Data['id']; ?></td>
       <td><?= $Data['title']; ?></td>
        <td><?= $Data['cost']; ?></td>
		<td><a href="<?php echo site_url('UpdateDeleveryCost?id='.$Data["id"]); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td> 
		<td><a href="#" class="newanchor" id="<?php echo site_url('deleteshipping?id='.$Data["id"]); ?>" data-toggle="modal" data-target="#myConModal"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
      </tr>      
    <?php  }?>
    </tbody>
  </table>
</div>
	 
	 
    </div>
    <div id="menu1" class="tab-pane fade background"> 
      <!--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
		<div id="form">
		<div class="container">
			 
				<div class="row">
				<div class="col-md-12">
					 <h2>Add Shipping</h2>
				</div>
				<div class="col-md-6 col-xs-12 ">
				 
				<form  method="post" enctype="multipart/form-data" action="<?php echo site_url('Delevercost'); ?>">
		  
						  <div class="jumbotron-sec marg ">
							 <div class="form-horizontal">
							 <!----------------Shipping Title------------------------->   
							 <div class="form-group ">
								  <label class="control-label col-sm-4" for="name">Shipping Title</label>
									<div class="col-md-8">
										<input type="name" class="form-control" required placeholder name="title">
									</div>
							 </div>
							   <!----------------Cost------------------------->   
							  <div class="form-group  ">
								  <label <label class="control-label col-sm-4" for="address">Shipping Cost</label>
								  <div class="col-md-8  ">
								  <input type="text" class="form-control" required  name="cost">
								  <input type="hidden" class="form-control" value="<?php echo $bid;?>"; name="bid">
								</div> 
							 </div>
								<!-------------------------------city------------------------------->
                               <button  name="addcost" class="btn btn-info">Add Shipping</button> 
							</div>
						</div>
				</form>
			</div>
		  </div>
		</div>
		</div>
	</div>
</div></div>
<script>
				
////confirmatiom-Of-Delete
			
	$('.newanchor').click(function(){
		var myId = $(this).attr('id');
		$("#deca").attr("href", myId);
	});
</script>