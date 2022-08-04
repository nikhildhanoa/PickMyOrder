<?php 
class VpsModel extends CI_Model
{
	
     public function FetchSqlTableData($Table)
     {
        
        
        $db2 = $this->load->database('database2', TRUE);
     
           $db2->select('*');
           $db2->from($Table);
           $db2->order_by('ITM_ItemCode');
           $db2->limit(50000,850000);
         

            $result2 = $db2->get()->result_array();
            
return $result2;
     }
	
}



?>