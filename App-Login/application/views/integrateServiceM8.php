<?php error_reporting(0);
if(isset($_SESSION['Current_Business']))
			{
				$bid=$_SESSION['Current_Business'];
			}
			else
			{   
				$bid=$_SESSION['status']['business_id'];
			}



?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.forms_another_file
{
	display: flex;
    align-items: center;
}

.li-file label {
    padding: 7px 20px;
    background: #5578eb;
    color: #fff;
    border-radius: 3px;
	cursor: pointer;
}
.li-file input[type="file"] {
    display: none;
}

</style>

<div class="container">
	 
	    <div class="row">
		<div class="col-md-12">
			<div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
	    <!-- comment-->
		<div class="details" style="display: flex;">
         <h3 class="card-title"> Service M8 login form</h3>
		 </div>

		 
	<!-- comment-->
		 </div>
<?php 
$query=$this->db->query("select webhook_job,username,access_token from  dev_service_m8 where business_id='$bid' ");
$reult=$query->result_array();
$webhook_job=$reult[0]['webhook_job'];
$access_token=$reult[0]['access_token'];

if( $webhook_job=='' &&  $webhook_job==0)    { ?>		 
		 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 
	    <div class="col-md-6 col-xs-12">
		<div class="row">
			
  
    <form method="post" enctype="multipart/form-data" action="<?php echo site_url('integrateServiceM8');?>">
   

   <div class="form-group pl-0">
      <label >User Name</label>
	    <input  type="Text" class="form-control form-control-solid"   name="name" style="margin-top:0px !important;width: 300px;" required>
	  </div>
	  
	     <div class="form-group pl-0">
      <label >Password</label>
	    <input  type="password" class="form-control form-control-solid"   name="Password" style="margin-top:0px !important; width: 300px;" required>
	  </div>

     
   
	

	
			<div class="form-group">
					<input type="submit" name="nsert_cat" value="SAVE" class="btn btn-info">
			</div>
	
		</div>

   </div>
</div>
</div>
 </div>
</div>
  <?php } elseif($access_token=="") { ?>
  
    <p style="color:red;padding-left: 26px;">** This business  has   not   been connected  with  M8 service</p>
   <p style="padding-left: 26px;">** complete setup  <a style="font-weight: 500;padding: 5px 15px;border: 1px solid black;
    border-radius: 5px;background: #3699ff;color: white;margin: 0 21px;border:none" href="<?php echo base_url('CreateOauthToken/'.$bid); ?>">Go</a> </p>
   <?php } else { ?>
  <p style="color:red;padding-left: 26px;">** This business  has been already  completed with  M8 Service</p>
   <p style="padding-left: 26px;">
   <span style="font-weight:bold">User Name:</span> <span><?php echo $reult[0]['username'];  ?></span>
   <a href="<?php echo base_url('ListM8ServiceStaff');  ?>" style="background: #187de4;
    color: #fff;
    padding: 5px 20px;
    border-radius: 5px;position: relative;
    left: 57%;">Import Staff</a>
   </p>
   
  <?php } ?>
  </div>
</div>
  </form>
</div>
</div>
 



