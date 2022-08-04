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
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Send Notification</a></li> 		
  </ul>
 <div class="tab-content">
    <div id="home" class="tab-pane  active background">
   <h2><?php echo $this->session->flashdata('send'); ?></h2> 
  <div class="row">
    	<div class="col-md-6">
         <span style="color:red">This Notification Will Be Recived By All User's Of <?php echo $bussiness_name;?></span>
          <form class="form-signin" id="login" method="post" action="Notifications">
             <input type="hidden" name="bidinhid" value="<?php echo $business_id;?>">
            <textarea class="form-control" name="msg" placeholder="Enter Your Message Here" rows="4" cols="50" ></textarea>
           
            <button class="btn" name="send">SEND</button>
          </form>
    
          

        </div> <!-- /container -->
	</div>
    </div>

  </div>
  
</div>

