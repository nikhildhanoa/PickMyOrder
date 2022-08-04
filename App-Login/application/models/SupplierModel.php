<?php 
class SupplierModel extends CI_Model
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
function Select_All_Supplier($Business_id){
		if($Business_id!='0')
		{
		$Select_All_Supplier=$this->db->query("select *from dev_supplier where business_id=$Business_id  ");
		}else
		{
			$Select_All_Supplier=$this->db->query('select *from dev_supplier ');
		}
		$All_Supplier=$Select_All_Supplier->result_array();
		return($All_Supplier);
	}
	function Select_Supplier_By_Product($product_id){
		print_r($product_id);die;
	}
	
	
}



?>