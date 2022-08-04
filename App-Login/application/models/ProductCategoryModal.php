<?php 
class ProductCategoryModal extends CI_Model
{
	function GetAllList()    
	{
		$listdata=$this->db->query("select * from 	dev_catlist");
		return($listdata->result_array());
	}
	function GetAllCat($bussiness_id)
	{
		if($bussiness_id!=0)
		{
		
		/* $categories_ids=$this->db->query("select categories from dev_products where business_id='$busi_id' ");
		$categories_ids=$categories_ids->result_array();
		$ids=$categories_ids[0]['categories']; */
		
		$AllCat=$this->db->query("select * from dev_product_cat where business_id='$bussiness_id' ORDER BY cat_name ");
		
		
		$AllCat=$AllCat->result_array();
		
		return($AllCat);
		}
		else{
		$AllCat=$this->db->query('select * from dev_product_cat ');
		$AllCat=$AllCat->result_array();
		return($AllCat);
		}
	}
	
	function GetAllSubCat($catid)
	{
		if($catid==0){
		$AllCat=$this->db->query('select * from dev_product_sub_cat');
		$AllCat=$AllCat->result_array();
		return($AllCat);
		}
		else
		{
		$AllCat=$this->db->query("select * from dev_product_sub_cat where cat_id='$catid'");
		$AllCat=$AllCat->result_array();
		}
		
		$cat_array=array();
	   foreach($AllCat as $SingleList ) 
	   { 
			$cat_name=$SingleList['sub_cat_name'];
			$Cat_Cute_Name=$SingleList['sub_cat_cut_name'];
			
			 $catname = (empty($Cat_Cute_Name)) ? $cat_name : $Cat_Cute_Name; 
			
			  array_push($cat_array,array('id'=>$SingleList['id'],'sub_cat_name'=>$catname,'image'=>$SingleList['image'])); 
						
	   }return($cat_array);	
		
	}
  function GetAllSuperSubCat($subcatid)
	{
		if($subcatid==0){
		$AllCat=$this->db->query('select * from super_sub_cat');
		$AllCat=$AllCat->result_array();
		return($AllCat);
		}
		else
		{
		$AllCat=$this->db->query("select * from super_sub_cat where sub_cat=$subcatid");
		$AllCat=$AllCat->result_array();
		}
		$cat_array=array();
	   foreach($AllCat as $SingleList ) 
	   { 
			$name=$SingleList['name'];
			$cute_super_cat=$SingleList['cute_super_cat'];
			
			 $catname = (empty($cute_super_cat)) ? $name : $cute_super_cat; 
			
			  array_push($cat_array,array('id'=>$SingleList['id'],'name'=>$catname,'image'=>$SingleList['image'])); 
						
	   }return($cat_array);	
	} 
	
	function GetAllSupersubSubCat($subsubcatid)
	{
		if($subcatid==0){
		$AllCat=$this->db->query('select * from dev_super_sub_sub_cat');
		$AllCat=$AllCat->result_array();
		return($AllCat);
		}
		else
		{
		$AllCat=$this->db->query("select * from dev_super_sub_sub_cat where sub_cat=$subsubcatid");
		$AllCat=$AllCat->result_array();
		return($AllCat);
		}
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

}



?>