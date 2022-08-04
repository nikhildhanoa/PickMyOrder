<?php 
class CommonModel extends CI_Model
{
	
 //*************************Function for Fetch data From dataBase****************************///
 
    function Fetchdata($select,$TableName,$multiClause,$result_as_array){
  
		$this->db->select($select);
		$this->db->from($TableName);  
	    $this->db->where($multiClause);
		$query=$this->db->get();
		
		if($query->num_rows())
		{
			   if($result_as_array==true)
			   {
				$result = $query->result_array();	
			   }
			   else
			   {
				 $result = $query->result();  
			   }
			   return $result;
			
		}
		else
		{
		  return false;	
		}	
		
    }	 
	 
    /*******************Function for Insert data From dataBase**********************/
	
	public function InsertRecord($Table_name,$Insert_array,$Last_insert_id,$Insert_Batch)
	{
		if($Insert_Batch==false)
		{
		    $Data_Insert = $this->db->insert($Table_name,$Insert_array);
		    $insert_id=$this->db->insert_id();
			
				if($Data_Insert==true && $Last_insert_id==true )
				 {
					return $insert_id; 
				 }
				 else
				 {
					return true;	 
				 }				 
		}
		else
		{
			 $Data_Insert=$this->db->insert_batch($Table_name,$Insert_array);
			 $insert_id=$this->db->insert_id();
			 
				 if($Data_Insert==true && $Last_insert_id==true )
				 {
					return $insert_id; 
				 }
				 else
				 {
					return true;	 
				 }	
		}		
	}
	 
	 /*******************Function for Delete data From dataBase**********************/   
	 
	 	// array('id' => $id)  id pass in array with database parameter
		
	 public function DeleteRecord($TableName,$id_array)
	 {
		
		 $this->db-> where($id_array);
        $Delete = $this->db->delete($TableName);
		if($Delete)
		{
			return true;
		}
        else
        {
			return false;
		}			
		
	 }
	  
	  //*************************Function forjion Fetch data From dataBase****************************///

	  function Fetchjoindata($select,$TableName,$multiClause,$result_as_array,$join_table,$join_relation){
		  
		$this->db->select($select);
		$this->db->from($TableName);
		$this->db->join($join_table,$join_relation);
		$this->db->where($multiClause);
		$query = $this->db->get();
		
		if($query->num_rows())
		{
			   if($result_as_array==true)
			   {
				$result = $query->result_array();	
			   }
			   else
			   {
				 $result = $query->result();  
			   }
			   return $result;
		}
		else
		{
		  return false;	
		}
		
		    
	  }
	 

      /****************Function for Update data From dataBase****************/
	   
      public function UpdateRecord($TableName,$multiclause,$WhereClause)
      {

        $this->db->where($WhereClause);
        $update=$this->db->update($TableName,$multiclause);
        if($update==true)
          {  
             return true;	 
          }
          else
          {
             return false;	
           }


      }
	  
	  
	   //*************************Function for Fetch like data From dataBase****************************///
 
    function LikeFetchdata($select,$TableName,$multiClause,$Like,$by1,$Or_like,$by2,$Order_BY,$Limit,$result_as_array){
  
		$this->db->select($select);
		$this->db->from($TableName);
		$this->db->where($multiClause);
		if($Or_like!=false)
		{
			$this->db->where("(".$Like." LIKE '%".$by1."%' OR ".$Or_like." LIKE '%".$by2."%')", NULL, FALSE);
		}else
		{
			$this->db->like($Like, $by1);
		}	
    	if($Order_BY!=false)
		{
			$this->db->order_by($Order_BY); 
		}			
		if($Limit!=false)
		{
			$this->db->limit($Limit); 
		}
		$query=$this->db->get();
		
		if($query->num_rows())
		{
			   if($result_as_array==true)
			   {
				$result = $query->result_array();	
			   }
			   else
			   {
				 $result = $query->result();  
			   }
			   return $result;
			
		}
		else
		{
		  return false;	
		}	
		
    }
	 
}

?>


		