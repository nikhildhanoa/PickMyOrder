<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$valid = 'invalid';
$this->load->helper('string');
$allid=array();
$j=0;
if(isset($_POST['user_id']) && isset($_POST['card']) && isset($_POST['exp_month']) && isset($_POST['exp_year']) && isset($_POST['brand']))
{
	        $cardnumber=$_POST['card'];
			$CardObjects=$this->db->query("select user_id from dev_PaymentMethod where cardnumber='$cardnumber'");
		    $CardArray=$CardObjects->result_array();
			foreach($CardArray as $Card)
			{
			$allid[$j]=$Card['user_id'];
			$j++;
			}			
			if(!in_array($_POST['user_id'],$allid))         
			{   
			//Save user Card
		
				$PaymentData=array('user_id'=>$_POST['user_id'],'cardnumber'=>$_POST['card'],'exp_date'=>$_POST['exp_month'],'exp_year'=>$_POST['exp_year'],'card_type'=>$_POST['brand']);
				$InsertStatus=$this->DataModel->insert('dev_PaymentMethod',$PaymentData);
			echo json_encode(array("statusCode"=>200,"valid"=>true,'Message'=>'Card Add Successfully','CardId'=>$InsertStatus),JSON_FORCE_OBJECT);				
			} 
			else
			{
				echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>"Card Already Saved"),JSON_FORCE_OBJECT);	
			}
}
else
{
	echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>"All Field iS Required"),JSON_FORCE_OBJECT);
}
?>