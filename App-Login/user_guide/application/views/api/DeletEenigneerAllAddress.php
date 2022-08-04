<?php header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
      header("Access-Control-Allow-Methods: POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $valid = 'invalid';
    $this->load->helper('string');
	
		if(isset($_REQUEST['id']))
		{
            $id = $_REQUEST['id'];       //Get Email
          $dataobj=$this->db->query("select * from dev_Engineer_address_list where id='$id'");
          $data=$dataobj->result_array();
          if($data)
          {
            $this->db->query("delete  from dev_Engineer_address_list where id='$id'");
            echo json_encode(array("statusCode"=>200,"Message"=>"Delete Address Successfully","valid"=>true));
          }
          else
          {
              	echo json_encode(array("statusCode"=>401,"Message"=>"Id not exsist","valid"=>false));
          }
		}
		else
		{
		    	echo json_encode(array("statusCode"=>401,"Message"=>"Address Id Is Required","valid"=>false));
		}
		
			
?>