<?php 
class CetaloguesModels extends CI_Model
{
	    public function insert($table,$insert){
		$results = $this->db->insert($table, $insert);
		
	    $insertId = $this->db->insert_id();
		if($results){
		return $insertId;}
		else{
		return false;}
        }
		public function ViewCatelog($bid)
		{
			$cetalouges=$this->db->query("select * from cetalouges where bussinessid='$bid'");
			$cetalouges=$cetalouges->result_array();
			return($cetalouges);
		}
		public function DeleteCateLouges($id)
		{
			$cetalouges=$this->db->query("delete  from cetalouges where id='$id'");
			if($cetalouges)
			{
				redirect('cetalogues');
			}
		}
		
		//delete catalog section
		public function DeleteCatalogSection($id)
		{
			$delcetalougessec = $this->db->query("delete  from dev_cetalog_section where id='$id'");
			redirect('newCetalogues');
			
		}
		
		
		
}



?>