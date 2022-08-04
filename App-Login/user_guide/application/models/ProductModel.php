<?php 
class ProductModel extends CI_Model
{
	    public function GetAllProduct($busi_id)
		{
		
			if($busi_id!=0)
			{
             $products=$this->db->query("select * from dev_products where business_id='$busi_id' ORDER BY id ASC");
			
			  return($products);
			
			}else{
				$All_Products=$this->db->query('select *from dev_products');
				return($All_Products);
			}
			
		}
	   public function GetVariationsById($id)
		{
			
			$Variations=$this->db->query("select *from dev_product_variation where option_id=$id ORDER BY id ASC");
			$Variations=$Variations->result_array();
			
			return($Variations);
		}
	public function insert($table,$insert){
		$results = $this->db->insert($table, $insert);
		
	    $insertId = $this->db->insert_id();
		if($results){
		return $insertId;}
		else{
		return false;}
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

}



?>