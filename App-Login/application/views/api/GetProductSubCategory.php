<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
  $arr=array();
		//$data = file_get_contents("php://input");
		 $get_cat_id = $_REQUEST['catid'];
		  $isVan = $_REQUEST['isVan'];
		   $userid = $_REQUEST['userid'];
		if($isVan)
		{
			   $Next_Status=2;
				$All_sub_cat_data=array();
				
				 $van_engineer = $this->db->query('select * from dev_van_engineer where engineer_id="'.$userid.'"');
				 $van_engineer = $van_engineer->result_array();
				 $eng_van=$van_engineer[0]['van_id'];
				 
				
				 $selected_data = $this->db->query("select distinct sub_categories from dev_products,products_van where dev_products.id= product_id  && publish_status='1' && categories='$get_cat_id' and van_id='$eng_van'");
			
				 $select_data = $selected_data->result_array();
				
				 foreach($select_data as $split=>$val)
				 {
					 $arr[]=$val['sub_categories'];
				 } 
				 if(count($arr))
				 {
					$ids=implode(',',$arr);
					
				 }
				
				$selected_data = $this->db->query("select * from dev_product_sub_cat where id in($ids)");
				$select_data = $selected_data->result_array();
				foreach($select_data as $select)
				{
					$super_sub_cat=array();
					$flag=0;
					$check_sub_sub=$select['id'];
					
					$check_sub_sub_data = $this->db->query('select * from super_sub_cat
					 where sub_cat="'.$check_sub_sub .'"');
					 
					
					
					
					if($check_sub_sub_data->num_rows())
					{
						$check_sub_sub_data = $check_sub_sub_data->result_array();
						foreach($check_sub_sub_data as $select_sub_sub_data)
						{
							if($select_sub_sub_data['id']!='')
							$super_sub_cat[]=$select_sub_sub_data['id'];	
						}
						if(!empty($super_sub_cat))
						{	
							$allsuper_sub_cat=implode(',',$super_sub_cat);
						}
						$check_product = $this->db->query("select * from dev_products,products_van where dev_products.id= product_id  && publish_status='1' and super_sub_cat_id in($allsuper_sub_cat) and van_id='$eng_van'");
						if($check_product->num_rows())
						{
							$flag=1;
						}	
						
					}
				
					if($flag)
					{
						$Next_Status=1;
						
					}
					else
					{
						$Next_Status=2;
						$check_product=$select['id'];
						$check_product = $this->db->query("select * from dev_products,products_van where dev_products.id= product_id  && publish_status='1' and sub_categories='".$check_product."'");
					   
						if($check_product->num_rows())
						{
						$Next_Status=0; //zero means have product on this cat 
						}
						else
						{
							$Next_Status=2;
						}
						
							
						
						
					}
					  
					   $sub_cat_name=$select['sub_cat_name'];
					   $sub_cat_cut_name=$select['sub_cat_cut_name'];
					   $name = (empty($Cat_Cute_Name)) ? $sub_cat_name : $sub_cat_cut_name;
					
					
					$All_cat_data[]=array('sub_cat-id'=>$select['id'],'sub_cat-name'=>$name,'cat-image'=>$select['image'],'status'=>$Next_Status);
					
					
				}
				
				if($selected_data->num_rows())
				{ 
					
					echo json_encode(array("statusCode"=>200,'Sub_Category'=>$All_cat_data));
				 }
				else
				{
					echo json_encode(array("statusCode"=>401,'Message'=>'Sub Category Not Found',"valid"=>false));
				}  
		}
		else
		{
			   $Next_Status=2;
				$All_sub_cat_data=array();
				 $selected_data = $this->db->query("select sub_categories from dev_products where van_stock='0' && publish_status='1' && categories=$get_cat_id");
				 $select_data = $selected_data->result_array();
				
				 foreach($select_data as $split=>$val)
				 {
					 $arr[]=$val['sub_categories'];
				 } 
				 if(count($arr))
				 {
					$ids=implode(',',$arr);
					
				 }
				
				 $selected_data = $this->db->query("select * from dev_product_sub_cat where id in($ids)");
				$select_data = $selected_data->result_array();
				foreach($select_data as $select)
				{
					$check_sub_sub=$select['id'];
					$check_sub_sub_data = $this->db->query('select * from super_sub_cat
					 where sub_cat="'.$check_sub_sub .'"');
				
					if($check_sub_sub_data->num_rows())
					{
						$Next_Status=1;
					}
					else
					{
						$Next_Status=2;
						$check_product=$select['id'];
						$check_product = $this->db->query('select * from dev_products
						where sub_categories="'.$check_product.'"');
					   
						if($check_product->num_rows())
						{
						$Next_Status=0; //zero means have product on this cat 
						}
						else
						{
							$Next_Status=2;
						}
						
							
						
						
					}
					
					   $sub_cat_name=$select['sub_cat_name'];
					   $sub_cat_cut_name=$select['sub_cat_cut_name'];
					   $name = (empty($Cat_Cute_Name)) ? $sub_cat_name : $sub_cat_cut_name;
					
					$All_cat_data[]=array('sub_cat-id'=>$select['id'],'sub_cat-name'=>$name,'cat-image'=>$select['image'],'status'=>$Next_Status);
					
					
				}
				
				if($selected_data->num_rows())
				{ 
					
					echo json_encode(array("statusCode"=>200,'Sub_Category'=>$All_cat_data));
				 }
				else
				{
					echo json_encode(array("statusCode"=>401,'Message'=>'Sub Category Not Found',"valid"=>false));
				}  
		}
		
?>