<?php 
class ProductModel extends CI_Model
{
	    public function GetAllProduct($busi_id)
		{
		
			if($busi_id!=0)
			{
            // $products=$this->db->query("select * from dev_products where business_id='$busi_id' ORDER BY id ASC");
			 
			 $products=$this->db->query("select dev_products.id,dev_products.Manufacture,dev_products.title,dev_products.SKU,dev_products.products_images, dev_products.publish_status,dev_product_cat.cat_name Category from  dev_products,dev_product_cat where dev_products.business_id='$busi_id' and dev_product_cat.id=dev_products.categories  ORDER BY dev_products.id ASC");
			
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