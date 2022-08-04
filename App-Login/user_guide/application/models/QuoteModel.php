<?php 
class QuoteModel extends CI_Model
{
	public function SelectQuoteById($id){
		$query = $this->db->query("select *from dev_quotes  where id='$id'");
		$quote = $query->result_array();
		return ($quote);
		
	}
	
	
}



?>