<?php
 header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
   if(isset($_REQUEST['devicestatus']))
   {
	   $DeviceStatus='Android';
   }
   else
   {
	   $DeviceStatus='ios';
   }
   $Device=$_REQUEST['deviceid'];
   $userid=$_REQUEST['userid'];
	if(isset($_REQUEST['deviceid']) && isset($_REQUEST['userid']))
	{
		if($DeviceStatus=='Android')
		{
			$This_user_devices=$this->db->query("select deviceid from dev_users where id='$userid'");
			$This_user_devices1=$This_user_devices->result_array();
			$idsarray=explode(',',$This_user_devices1[0]['deviceid']); 	
			if (($key = array_search($Device,$idsarray)) !== false) 
			{
			unset($idsarray[$key]);
			}	
			$newarray=implode(",",$idsarray);
			$this->db->query("UPDATE dev_users SET deviceid='$newarray' where id='$userid'");
		}
		if($DeviceStatus=='ios')
		{
			$This_user_devices=$this->db->query("select iosdeviceid from dev_users where id='$userid'");
			$This_user_devices1=$This_user_devices->result_array();
			$idsarray=explode(',',$This_user_devices1[0]['iosdeviceid']); 	
			if (($key = array_search($Device,$idsarray)) !== false) 
			{
			unset($idsarray[$key]);
			}	
			$newarray=implode(",",$idsarray);
			$this->db->query("UPDATE dev_users SET iosdeviceid='$newarray' where id='$userid'");
		}
		
		
		echo json_encode(array("statusCode"=>200,'Message'=>'Loguout Successfull'));
	}
	else
	{
		echo json_encode(array("statusCode"=>400,'Message'=>'invalid action'));
	}
	
		   
?>