<?php 
class CetaloguesModels extends CI_Model
{
	    public function insert($table,$insert,$shelve_id){
		$results = $this->db->insert($table, $insert);
		
	    $insertId = $this->db->insert_id();
		 $insertId = $this->db->insert_id();
		$update_sort = $this->db->query("update cetalouges set sort_order='$insertId' where id='$insertId' ");
			if($update_sort)
			{
				redirect('ManageCatalogSection?id='.$shelve_id);
			}
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
			$delcetalougessec = $this->db->query("delete  from cetalouges where sectionid='$id'");
			if($delcetalougessec)
				{
			redirect('newCetalogues');
				}
		}
		//Add shelves
		
		public function AddShelves($Table,$data)
		{
			$insert = $this->db->insert($Table,$data);
			 $insertId = $this->db->insert_id();
		$update_sort = $this->db->query("update dev_Shelves set sort_order='$insertId' where id='$insertId' ");
			if($update_sort)
			{
				redirect('newCetalogues');
			}
		}
	
		
		public function DeleteShelves($shelves_id)
		{
			$DeleteShelves = $this->db->query("delete  from dev_Shelves where id='$shelves_id'");
			//$DeleteShelves = $this->db->query("delete  from cetalouges where sectionid='$shelves_id'");
			if($DeleteShelves)
				{
			redirect('newCetalogues');
				}
		}
		/*****************************/
		
}



?>