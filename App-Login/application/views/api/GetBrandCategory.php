<?php header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$valid = 'invalid';
$this->load->helper('string');

		$business_id = $_REQUEST['business_id'];
		
		$selected_data = $this->db->query("select distinct categories from dev_products where van_stock='0' && publish_status='1' && business_id='$business_id'");
				 $select_data = $selected_data->result_array();
				 foreach($select_data as $split=>$val)
				 {
					 $arr[]=$val['categories'];
				 } 
				 if(count($arr))
				 {
					$ids=implode(',',$arr);
					
				 
				$selected_data = $this->db->query("select * from dev_product_cat where id in($ids)");
				$select_data = $selected_data->result_array();
				$i=0;
				foreach($select_data as $select)
				{
					$check_sub=$select['id'];					
					$check_sub_data = $this->db->query('select * from dev_product_sub_cat
					 where cat_id="'.$check_sub.'"');
					
					if($check_sub_data->num_rows())
						{
						$Next_Status=1;
						}
					else{
								$Next_Status=2;
								$check_product=$select['id'];
								$check_product = $this->db->query('select * from dev_products
								where categories="'.$check_product.'"'.' && van_stock=0 && publish_status=1');
								
								
									if($check_product->num_rows())
									{
										$Next_Status=0; //zero means have product on this cat 
									}
									else
									{
										$Next_Status=2;
									}
								
					   }
					
					$SerializeData=$select['filter'];
					if(!empty($SerializeData))
					{
						$fulldata=unserialize($SerializeData);
						if(!count($fulldata))
						{
							$fulldata=[];
						}
					}
					else
					{
						$fulldata=[];
					}
					$All_cat_data[]=array('cat-id'=>$select['id'],'cat-name'=>$select['cat_name'],'cat-image'=>$select['image'],'status'=>$Next_Status,'fillter'=>$fulldata);
				
				}
				}
				
				//print_r($All_cat_data);
				if($select_data)
				{ 
					
					echo json_encode(array("statusCode"=>200,'numberofawating'=>$numberofawating,'Category'=>$All_cat_data));
				 }
				else
				{
					echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
				}
				 
				
?>