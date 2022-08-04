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
		 $userid = $_REQUEST['userid'];
		 $isVan = $_REQUEST['isVan'];
		 
		 if(isset($_REQUEST['Wholesalerid']))
		 {
			 $business_id = $_REQUEST['Wholesalerid'];
			 $numberofawating=0;
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
			 
		       }	 
		     else if($isVan)
		     {
			$numberofawating=0;
			if($userid!='0')
			{
				 $selected_role = $this->db->query('select * from dev_users where id="'.$userid.'"');
				 $selected_role = $selected_role->result_array();
				 $user_role=$selected_role[0]['role'];
				 $business_id=$selected_role[0]['from_bussi'];
				 
				 $van_engineer = $this->db->query('select * from dev_van_engineer where engineer_id="'.$userid.'"');
				 $van_engineer = $van_engineer->result_array();
				 $eng_van=$van_engineer[0]['van_id'];
				 
				
				                //get product which have van stock 1
				 if($business_id!='')
				 {
				 $Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$business_id");
					$numberofawating=$Get_awating_orders->num_rows();
				 }
				          /*************************close***************************/
				 if($user_role=='3')  //check if user engineer 
				 {
					  $selected_engineer = $this->db->query('select * from dev_engineer where user_id="'.$userid.'"');
					  $selected_engineer = $selected_engineer->result_array();
					   $business_id=$selected_engineer[0]['business_id'];
					   $engineer_id=$selected_engineer[0]['id'];
					   /****************NUMBER OF AWATING IF ENGINEER*******************/
					$Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id= $business_id");
					$numberofawating=$Get_awating_orders->num_rows();
					/*************************close**********************/
					   $check_oprative=$this->db->query("select * from dev_engineer_permissions where engineer_id='$engineer_id'");
					  $check_oprative=$check_oprative->result_array();
				  if($check_oprative[0]['Operative']=='1')
					 {
						
						  /****************NUMBER OF AWATING IF ENGINEER*******************/
						$Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$business_id&&engineer_id=$userid");
						$numberofawating=$Get_awating_orders->num_rows();
						/*************************close**********************/
					 }
				 }
				  if($user_role=='1' ||$user_role=='2')  //check if user admin or superadmin 
				 {
				  
				   $selected_admin = $this->db->query('select business_id	from dev_users where id="'.$userid.'"');
					  $selected_admin = $selected_admin->result_array();
					   $business_id=$selected_admin[0]['business_id'];
				  }
			}else
			{
				$business_id=16; // set a static bussiness id for atradeya 
			}
				
				 $selected_data = $this->db->query("select distinct categories from dev_products, products_van where dev_products.id= product_id and publish_status='1' && business_id='$business_id' and van_id=$eng_van");
				 
				 
				 $select_data = $selected_data->result_array();
				 foreach($select_data as $split=>$val)
				 {
					 $arr[]=$val['categories'];
				 } 
				 if(count($arr))
				 {
					$ids=implode(',',$arr);
					
				 }
				 
				 if(!empty($ids))
				 {
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
								$check_product = $this->db->query("select * from dev_products, products_van where dev_products.id= product_id and publish_status='1' && business_id='$business_id' and van_id=$eng_van and categories=$check_product");
								
								
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
					
					   $cat_name=$select['cat_name'];
					   $Cat_Cute_Name=$select['Cat_Cute_Name'];
					   $name = (empty($Cat_Cute_Name)) ? $cat_name : $Cat_Cute_Name;
					   
					$All_cat_data[]=array('cat-id'=>$select['id'],'cat-name'=>$name,'cat-image'=>$select['image'],'status'=>$Next_Status,'fillter'=>$fulldata);
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
		}
		else
		{		
				$All_cat_data=array();
				$Next_Status=2;
				$numberofawating=0;
			if($userid!='0')
			{ // if user id 0 it mean this is atradeya app guest and send all data  it 

				//get role of user
				 $selected_role = $this->db->query('select * from dev_users where id="'.$userid.'"');
				 $selected_role = $selected_role->result_array();
				 $user_role=$selected_role[0]['role'];
				$business_id=$selected_role[0]['business_id'];
				 
				 /*************************number of awatin******************/
				 if($business_id!='')
				 {
				 $Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$business_id");
					$numberofawating=$Get_awating_orders->num_rows();
				 }
				 /*************************close***************************/
				 if($user_role=='3')  //check if user engineer 
				 {
					  $selected_engineer = $this->db->query('select * from dev_engineer where user_id="'.$userid.'"');
					  $selected_engineer = $selected_engineer->result_array();
					   $business_id=$selected_engineer[0]['business_id'];
					   $engineer_id=$selected_engineer[0]['id'];
					   /****************NUMBER OF AWATING IF ENGINEER*******************/
					$Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id= $business_id");
					$numberofawating=$Get_awating_orders->num_rows();
					/*************************close**********************/
					   $check_oprative=$this->db->query("select * from dev_engineer_permissions where engineer_id='$engineer_id'");
					  $check_oprative=$check_oprative->result_array();
			  if($check_oprative[0]['Operative']=='1')
				 {
					
					  /****************NUMBER OF AWATING IF ENGINEER*******************/
					$Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$business_id&&engineer_id=$userid");
					$numberofawating=$Get_awating_orders->num_rows();
					/*************************close**********************/
				 }
				 }
				  if($user_role=='1' ||$user_role=='2')  //check if user admin or superadmin 
				 {
				  
				   $selected_admin = $this->db->query('select business_id	from dev_users where id="'.$userid.'"');
					  $selected_admin = $selected_admin->result_array();
					   $business_id=$selected_admin[0]['business_id'];
				  }
			} // close atradeya app condition 
			else
			{
				$business_id=16; // set a static bussiness id for atradeya 
			}

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
					
					   $cat_name=$select['cat_name'];
					   $Cat_Cute_Name=$select['Cat_Cute_Name'];
					   $name = (empty($Cat_Cute_Name)) ? $cat_name : $Cat_Cute_Name;
					
					$All_cat_data[]=array('cat-id'=>$select['id'],'cat-name'=>$name,'cat-image'=>$select['image'],'status'=>$Next_Status,'fillter'=>$fulldata);
				
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
		}
?>