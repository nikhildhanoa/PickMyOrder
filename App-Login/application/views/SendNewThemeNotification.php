<?php error_reporting(0); 
if(isset($_SESSION['Current_Business']))
	{
		$business_id=$_SESSION['Current_Business'];
	}
	else
	{
		 $business_id=$_SESSION['status']['business_id'];
	}
$get_bussiness_details=$this->db->query("select * from dev_business where id='$business_id'");
$get_bussiness_details1=$get_bussiness_details->result_array();
$bussiness_name=$get_bussiness_details1[0]['business_name'];
if($business_id=='0')
{
	$bussiness_name='All Business';
}

?>
<div class="container">
 
   <h2><?php echo $this->session->flashdata('send'); ?></h2> 
  <div class="row">
    	<div class="col-md-6">
		
		<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Send Notification</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
		
         <span style="color:red">This Notification Will Be Recived By All User's Of <?php echo $bussiness_name;?></span>
          <form class="form-signin" id="login" method="post" action="Notifications">
             <input type="hidden" name="bidinhid" value="<?php echo $business_id;?>">
            <textarea class="form-control form-control-solid mt-5" name="msg" placeholder="Enter Your Message Here" rows="4" cols="50" ></textarea>
           
            <button class="btn btn-info mt-5" name="send">SEND</button>
          </form>
    
          

        </div> <!-- /container -->
	</div>
   

  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
</div>

