<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
  $arr=array();
  $ids=0;
		//$data = file_get_contents("php://input");
		 $get_super_sub_cat_id = $_REQUEST['super_sub_catid'];
		 $isVan=$_REQUEST['isVan'];
		  $userid = $_REQUEST['userid'];
		 if($isVan)
		 {
			 $Next_Status=2;
					$All_super_sub_sub_cat_data=array();
					
				 $van_engineer = $this->db->query('select * from dev_van_engineer where engineer_id="'.$userid.'"');
				 $van_engineer = $van_engineer->result_array();
				 $eng_van=$van_engineer[0]['van_id'];
				 
					$selected_data = $this->db->query("select distinct super_sub_sub_cat_id from dev_products,products_van where dev_products.id= product_id && publish_status='1' && super_sub_cat_id= $get_super_sub_cat_id and van_id=$eng_van");
					
					
					
					$select_data = $selected_data->result_array();
					
					 foreach($select_data as $split=>$val)
					 {
						 $arr[]=$val['super_sub_sub_cat_id'];
					 } 
					 if(count($arr[0]))
					 {
						$ids=implode(',',$arr);
						
					 }
					 
					
					 $selected_data = $this->db->query("select * from dev_super_sub_sub_cat where id in($ids)");
					$select_data = $selected_data->result_array();
					foreach($select_data as $select)
					{
						
							$check_product=$select['id'];
							$check_product = $this->db->query("select * from dev_products,products_van where dev_products.id= product_id && publish_status='1' and super_sub_sub_cat_id=$check_product and van_id=$eng_van");
							
							if($check_product->num_rows())
							{
							$Next_Status=0; //zero means have product on this cat 
							}
							else
							{
								$Next_Status=2;
							}
						
						$All_super_sub_sub_cat_data[]=array('super_sub_sub_cat-id'=>$select['id'],'super_sub_sub_cat-name'=>$select['name'],'image'=>$select['image'],'status'=>$Next_Status);
						
						
					}
					//print_r($All_cat_data);
					if($select_data)
					{ 
						
						echo json_encode(array("statusCode"=>200,'Super_Sub_sub_Category'=>$All_super_sub_sub_cat_data));
					 }
					else
					{
						echo json_encode(array("statusCode"=>401,'Message'=>'No Super Sub Sub Category Found',"valid"=>false),JSON_FORCE_OBJECT);
					}  
		 }
		 else
		 {
			    $Next_Status=2;
					$All_super_sub_sub_cat_data=array();
					$selected_data = $this->db->query("select super_sub_sub_cat_id from dev_products where van_stock='0' && publish_status='1' && super_sub_cat_id=$get_super_sub_cat_id");
					///
					 $select_data = $selected_data->result_array();
					/* print_r($select_data);die; */
					 foreach($select_data as $split=>$val)
					 {
						 $data=$val['super_sub_sub_cat_id'];
						 if(!empty($data))
						 {
						 $arr[]=$data;
						 }
					 } 
					 if(!empty($arr))
					 {
						$ids=implode(',',$arr);
						
					
					 
					
					
					 $selected_data = $this->db->query("select * from  dev_super_sub_sub_cat where id in ($ids) ");
					$select_data = $selected_data->result_array();
				foreach($select_data as $select)
				{
					
						$check_product=$select['id'];
						$check_product = $this->db->query('select * from dev_products
						where super_sub_sub_cat_id="'.$check_product.'"');
						
						if($check_product->num_rows())
						{
						$Next_Status=0; //zero means have product on this cat 
						}
						else
						{
							$Next_Status=2;
						}
					
					$All_super_sub_sub_cat_data[]=array('super_sub_sub_cat-id'=>$select['id'],'super_sub_sub_cat-name'=>$select['name'],'image'=>$select['image'],'status'=>$Next_Status);
					
					
				}
				//print_r($All_cat_data);
				if($select_data)
				{ 
					
					echo json_encode(array("statusCode"=>200,'Super_Sub_sub_Category'=>$All_super_sub_sub_cat_data));
				 }
				else
				{
					echo json_encode(array("statusCode"=>401,'Message'=>'No Super Sub Category Found',"valid"=>false),JSON_FORCE_OBJECT);
				}  
		        
				}
				else
				{
					echo json_encode(array("statusCode"=>401,'Message'=>'No Super Sub Category Found',"valid"=>false),JSON_FORCE_OBJECT);
				} 
		 }
		
?>

