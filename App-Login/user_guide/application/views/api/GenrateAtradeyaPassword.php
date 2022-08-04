<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$this->load->helper('string');
if(isset($_REQUEST['Email']))
{
			$email=$_REQUEST['Email'];
			$users=$this->db->query("select id from dev_users where email='$email'");
			
		    if(!$users->num_rows())
			{
				$random=random_string('alnum',3);
				$randompassword=$random.time();
				if(mail($email,'Genrated password from atradeya',$randompassword))
				{
					echo json_encode(array("statusCode"=>200,"valid"=>true,'Message'=>"email send successfully" ,'password'=>$randompassword),JSON_FORCE_OBJECT);
				}
				else
				{
					echo json_encode(array("statusCode"=>400,"valid"=>false,'Message'=>"something going wrong we are unable to send you password please contact to us"),JSON_FORCE_OBJECT);
				}
			}
			else
			{
				echo json_encode(array("statusCode"=>409,"valid"=>false,'Message'=>"email alreday exsist"),JSON_FORCE_OBJECT);
			}
}
else
{
	echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>"All Field iS Required"),JSON_FORCE_OBJECT);
}
?>