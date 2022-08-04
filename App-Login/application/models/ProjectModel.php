<?php 
class ProjectModel extends CI_Model
{
	
	   public function insert($table,$insert){
		$results = $this->db->insert($table, $insert);
		
	    $insertId = $this->db->insert_id();
		if($results){
		return $insertId;}
		else{
		return false;}
}
public function update($table,$data,$where){
			$this->db->where($where);
			$update=$this->db->update($table, $data);
			if($update)
			{
			return $update;
			}
			else
			{
			return false;
			}
}
public function delete($table,$id){
	   $this->db->where('id', $id);
	   $deleted = $this->db->delete($table); 
	   if($deleted){
		   return true;
	   }
		else{
			return false;
		}
}
function Select_All_Project($business_id){
		if($business_id!=0)
		{
		$Select_All_Project=$this->db->query("select *from dev_projects where business_id='$business_id' ORDER BY ID ASC");	
		}
		else
		{
		$Select_All_Project=$this->db->query('select *from dev_projects ');
		}
		$Select_All_Project=$Select_All_Project->result_array();
		return($Select_All_Project);
	}
	
	
}



?>