<?php 
class EngineerModel extends CI_Model
{
	
	function Select_All_engineers($Business_id)
	{
		
		
		if($Business_id!='0')
		{
		$Select_All_engineers=$this->db->query("select *from dev_engineer where business_id='$Business_id'");
		}
		else{
			$Select_All_engineers=$this->db->query('select *from dev_engineer');
		}
		$All_engineers=$Select_All_engineers->result_array();
		return($All_engineers);
	}
	function Get_Business_id($Business_name){
		$Select_Business_id=$this->db->query("select id from dev_business where business_name='$Business_name'");
		$Select_Business_id=$Select_Business_id->result_array();
		return($Select_Business_id[0]['id']);
	}
	function delete_engineers($get_id)
	{
		$isEngineers=$this->db->query("select * FROM dev_engineer WHERE id='$get_id'");
		$data=$isEngineers->result_array(); 
		
		$user_id=$data[0]['user_id'];
		
		$this->db->query("delete from dev_users where id='$user_id'");
		$Delete_Engineers=$this->db->query("DELETE FROM dev_engineer WHERE id='$get_id'");
		
		if($Delete_Engineers)
		{
		$Delete_permission=$this->db->query("DELETE FROM dev_engineer_permissions WHERE engineer_id='$get_id'");	
		if($Delete_permission)
		 {
			
			 if($data[0]['wholeseller_status'])
			 {
				redirect('wholesaler');
			 }
             else
             {
				 redirect('engineer');
			 }				 
		 }
		}
	}
	function CheckEngineerPermission($Engineer_id){
		 $getuserid=$this->db->query("select * from dev_engineer_permissions where engineer_id=$Engineer_id ");
		  $result = $getuserid->result_array();
		  return($result[0]);
		
	}
	
	

}



?>