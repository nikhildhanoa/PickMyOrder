<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class ElectricalCatalogueController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
	$this->load->Model('VpsModel');
    $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	$this->load->Model('CommonModel');
	$this->load->Model('ProductCategoryModal');
	$this->load->library('upload');
    $this->load->library('image_lib');
	$this->load->library('session');
	$this->load->library('pagination');
	}
	
	public function BusinessIdFunction()
	{
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
			  }
			  return $bid;
	}
	
	
	public function GetLukinsManufactureInProductList()
	{
		$Value= $this->input->post('Value');
		$idName= $this->input->post('idName');
		
		if($idName=='Categoryexample')
		{
			  $Value= substr($Value, 0, 3 );
			
		}elseif($idName=='subcate')
		{
			$Value= substr($Value, 0, 6 );
		}
		else
		{
			$Value;
		}
		
		
		$query = $this->db->query("select MAN_Code,`MAN_SupplierName` from dev_sql_Manufacturer where MAN_Code in (select distinct MAN_Code from dev_sql_ItemDetails where COM_Code like '".$Value."%')");
		$All_manufacture=$query->result_array();
		 echo  json_encode($All_manufacture);
		
	}
	
	 public function CountFunction($sub_sub_category,$sub_category,$category,$Manufacturercod)
	{
		
	    $this->db->select('id');
       $this->db->from('dev_sql_ItemDetails');
       if($sub_sub_category!='0')
		    {
				$this->db->where("COM_Code Like '".$sub_sub_category."%' "); 
			}	
			elseif($sub_category!='0')
			{
				$sub_category= substr($sub_category, 0, 6 ); 
				$this->db->where("COM_Code Like '".$sub_category."%' ");
			}
			elseif($category!='0')
		    {
				$category= substr($category, 0, 3 ); 
				$this->db->where("COM_Code Like '".$category."%' ");
			}
			
			if($Manufacturercod!='0')
			{
				$this->db->where("MAN_Code='".$Manufacturercod."'");
				
				
			}
           $num_results = $this->db->count_all_results();
		
		   return $num_results;
	}
	 
	
	
	
	
	
	
	 public function FetchAllLukinsdata()
	 {
		
        if(isset($_GET['pageno']))
		{
		    $category=$_GET['cat'];
			$sub_category=$_GET['Subcat'];
			$sub_sub_category=$_GET['subsubcat'];
			$Manufacturercod=$_GET['man'];
			$category_code = $category;
            $sub_category_code = $sub_category;
			$page_number=$_GET['pageno'];
			 
			
		}	
		else
        {
		
		$category = $this->input->post('Categoryexample');
		$sub_category = $this->input->post('subcate');
		$sub_sub_category  = $this->input->post('subsubcate');
		$Manufacturercod = $this->input->post('Manufacturercod');
		$category_code = $category;
        $sub_category_code = $sub_category;
		$page_number=1;
        }

		
		if($category=='0')
		{
			$this->session->set_flashdata('error','Select category'); 
			redirect(base_url('GetLukinsproductsInproductList'));
		} 
         elseif($category!='0' && $sub_category=='0' && $sub_sub_category=='0' && $Manufacturercod=='0')
		 {
			 $this->session->set_flashdata('error','Select Two Options '); 
			 redirect(base_url('GetLukinsproductsInproductList'));
		 }
         else
         { 
			 $as='1';
			
			
		    $Total_Num = $this->CountFunction($sub_sub_category,$sub_category,$category,$Manufacturercod);
			
			    //paginaation start
			   $limti_per_page=100;
			  $total_pages = ceil($Total_Num/$limti_per_page);
			  
			   $offset = ($page_number-1)*$limti_per_page; 
			        $page_no='';
				   for($i=1; $i<= $total_pages;$i++ ) {
					   
					 $Active = ($i==$page_number) ? 'active' : '';  
  
$page_no .= '<li class="'.$Active.'" ><a href='.base_url().'/FetchAllLukinsdata?pageno='.$i.'&&cat='.$category.'&&Subcat='.$sub_category.'&&subsubcat='.$sub_sub_category.'&&man='.$Manufacturercod.'>'.$i.'</a></li>'; 
  
                    }

			  // paginaation end
			 
			$this->db->select('dev_sql_ItemDetails.ITM_Status,dev_sql_ItemDetails.ITM_ShortDesc,dev_sql_ItemDetails.ITM_ItemCode,dev_sql_ItemPrice.ITP_T1_Price');
             $this->db->from('dev_sql_ItemDetails');
             $this->db->join('dev_sql_ItemPrice','dev_sql_ItemDetails.ITM_ItemCode = dev_sql_ItemPrice.ITM_ItemCode');  
			 
			 
			if($sub_sub_category!='0')
		    {
				$this->db->where("COM_Code Like '".$sub_sub_category."%' "); 
			}	
			elseif($sub_category!='0')
			{
				$sub_category= substr($sub_category, 0, 6 ); 
				$this->db->where("COM_Code Like '".$sub_category."%' ");
			}
			elseif($category!='0')
		    {
				$category= substr($category, 0, 3 ); 
				$this->db->where("COM_Code Like '".$category."%' ");
			}
			
			if($Manufacturercod!='0')
			{
				$this->db->where("MAN_Code='".$Manufacturercod."'");
				
				
			}
             $this->db->order_by("ITM_ItemCode", "asc");			
			 $this->db->limit($limti_per_page, $offset);
			
			
			   $Data = $this->db->get()->result_array();
			
		      $business_id=$this->BusinessIdFunction();
			  $response = $this->DataModel->fetchLukinscategory($businees_id); 
			  
			  
			  // sub  cat start 
			  if($category_code!='0')
			  {
				  $category_code2= substr($category_code, 0, 3 ); 
				  $Sub_catagory_Response = $this->DataModel->fetchLukinssubcategory($category_code2);
				  $option_data='';
				  $option_data='<option value="0" >Sub Category</option>'; 
				  foreach($Sub_catagory_Response as $Sub_catagory_single_Response)
				  {
					  
					 $selected="";
					
					if($Sub_catagory_single_Response['COM_Code']==$sub_category_code){$selected="selected";}
                    $option_data.="<option value='".$Sub_catagory_single_Response['COM_Code']."'".$selected." >".$Sub_catagory_single_Response['COM_Description'].'</option>';  
				  }
				  
			  }
			  else
			  {
				  $option_data='<option value="0" >Sub Category</option>'; 
			  }	  
			  // sub cat end 
			  
			  // sub sub cat start
			  
			  if($sub_sub_category!='0')
			  {
				  $Getcode2=$sub_category_code;
				  $Getcode= substr($sub_category_code, 0, 6 );
				  
		          $Sub_Sub_catagory_Response = $this->DataModel->FetchLukinsSubSubCategory($Getcode,$Getcode2);
				  $option_data2='';
				  $option_data2='<option value="0" >Sub Sub Category</option>';
				  foreach($Sub_Sub_catagory_Response as $Sub_Sub_catagory_single_Response)
				  {
					  
					 $selected="";
					
					if($Sub_Sub_catagory_single_Response['COM_Code']==$sub_sub_category){$selected="selected";}
					
                    $option_data2.="<option value='".$Sub_Sub_catagory_single_Response['COM_Code']."'".$selected." >".$Sub_Sub_catagory_single_Response['COM_Description'].'</option>';  
				  }
				  
			  } 
			  else
			  {
				  $option_data2='<option value="0" >Sub Sub Category</option>'; 
			  }	  
			  // sub sub cat end 
			  
			  // Manufacturer start 
			  
			  if($Manufacturercod!='0')
			  {
				  
				   if($category_code!='0')
					{
						  $Value= substr($category_code, 0, 3 );
						
					}elseif($sub_category_code!='0')
					{
						$Value= substr($sub_category_code, 0, 6 );
					}
					else
					{
						$Value= $sub_sub_category;
					}
						
				  
				  $query = $this->db->query("select MAN_Code,`MAN_SupplierName` from dev_sql_Manufacturer where MAN_Code in (select distinct MAN_Code from dev_sql_ItemDetails where COM_Code like '".$Value."%')");
		          $All_manufacture=$query->result_array();
				  $option_data3='';
				  $option_data3='<option value="0" >Manufacturer</option>'; 
				   foreach($All_manufacture as $Single_manufacture)
				   {
					   $selected="";
					if($Single_manufacture['MAN_Code']==$Manufacturercod){$selected="selected";}
					
                    $option_data3.="<option value='".$Single_manufacture['MAN_Code']."'".$selected." >".$Single_manufacture['MAN_SupplierName'].'</option>';   
				   }
				   
				  
			  }
			  else
			  {
				    $option_data3='<option value="0" >Manufacturer</option>'; 
			  }	   
			  
			  // manufacturer end 
		   $bid=$this->BusinessIdFunction();
			  $cat_all_details=array('key'=>$response,'lukinskey'=>$Data,'category_code'=>$category_code,'Sub_category_code'=>$option_data,'Sub_Sub_category_code'=>$option_data2,'Manufacturer_code'=>$option_data3,'bid'=>$bid,'as'=>$as,'total_pages'=>$page_no,'total_pages_count'=>$total_pages,'Total_Num'=>$Total_Num);
			  
			  $this->load->view('lukins_header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('GetLukinsproductsInproductList.php',$cat_all_details);
			  $this->load->view('Lukins_footer.php');
			 
		 }			 
	
	
	   
	
	}
	
	
		
		
		
		 public function ExportProductInPMOList()
		{
			
			
			
			$flag=0;
			
			$val=$_POST['val'];
			
		   $categoryHtml = $this->input->post('categoryHtml');
		   $SubcategoryHtml = $this->input->post('SubcategoryHtml');
		   $SubSubcategoryHtml = $this->input->post('SubSubcategoryHtml');
		   $Manufacturercod = $this->input->post('Manufacturercod');
		   
		   $productList = $this->input->post('productList');
		   
		   $categoryval = $this->input->post('categoryval');
		   $Subcategoryval = $this->input->post('Subcategoryval');
		   $SubSubcategoryval = $this->input->post('SubSubcategoryval');
		   
		   $Manufacturerval = $this->input->post('Manufacturerval');
		 
			if($Manufacturerval == "0")
			  {
				  $Manufacturercod ='';
			  }	else
			  {
				  $Manufacturercod= $Manufacturercod;
			  }
			  
			$cattable='dev_product_cat';
			$subcattable='dev_product_sub_cat';
			$supercattable='super_sub_cat';
			  
			$path = '/images/applogo/productcomingsoon.png';
			$path2 = base_url();
			$image_url= $path2.$path;
			 
			$businees_id=$this->BusinessIdFunction();
			
			$status2 = $this->session->userdata('status');
		    $user_id = $status2['user_id'];
			
				
				
				
				
				   
				
				// insert product
								   
								                   													   
													$selectproductsdata =  $this->DataModel->selectsqlproducts($val,$businees_id);
													
												 
													if($selectproductsdata=="noproducts")
													{
														echo "1";
													}else
													{
														
														$productList=json_encode(array($productList));
														
														
														$emptyarrayone=array();
			                                            $emptyarraytwo=array();
														foreach($selectproductsdata as $selectproducts)
														{
								
		      $sub_sub_cat=$this->db->query("SELECT COM_Description FROM `dev_sql_CommodityCode` WHERE `COM_Code`=".$selectproducts['COM_Code']); 
		      $SubSubcategoryHtml=$sub_sub_cat->result_array();	
		      $SubSubcategoryHtml=$SubSubcategoryHtml[0]['COM_Description'];
				 
				 
				$sub_slice=$Value= substr($selectproducts['COM_Code'], 0, 6 ); 
                 $aa='00';	
                 $sub_slice=$sub_slice.$aa;				 
		      $sub_cat=$this->db->query("SELECT COM_Description FROM `dev_sql_CommodityCode` WHERE `COM_Code`=".$sub_slice); 
		      $SubcategoryHtml=$sub_cat->result_array();	
		      $SubcategoryHtml=$SubcategoryHtml[0]['COM_Description'];
				 
					
															
															
															$this->db->select('id');
															$this->db->from('dev_product_cat');
															$this->db->where('business_id',$businees_id );
															$this->db->like('cat_name',$categoryHtml);
															$NewBussinessCatData = $this->db->get();
															$Cat_id = $NewBussinessCatData->result();
															$check = $NewBussinessCatData->num_rows();
															 $cat_id = $Cat_id[0]->id;
															  if($check!=0) // check category 
															   {
																   
																 $cat_id = $Cat_id[0]->id;
																 $this->db->select('id');
																	  $this->db->from('dev_product_sub_cat`');
																	  $this->db->where('cat_id',$cat_id );
																	  $this->db->like('sub_cat_name',$SubcategoryHtml);
																	  $NewsubCatData = $this->db->get();
																	  $Sub_cat_id = $NewsubCatData->result();
																	  $check_sub_cat = $NewsubCatData->num_rows(); 
																	 
																	 if($check_sub_cat!=0) // check sub category
																		{
																			
																		
																			 
																					 $sub_cat_id =  $Sub_cat_id[0]->id;
																					  $this->db->select('id');
																					  $this->db->from('super_sub_cat`');
																					  $this->db->where('sub_cat',$sub_cat_id );
																					  $this->db->like('name',$SubSubcategoryHtml);
																					  $NewsubsubCatData = $this->db->get();
																					  $sub_Sub_cat_id = $NewsubsubCatData->result();
																					  $check_sub_sub_cat = $NewsubsubCatData->num_rows();
																					  
																					  if($check_sub_sub_cat!=0) // check subsubcategory
																						{   
																							 $flag=1; 
																							  $sub_sub_cat_id = $sub_Sub_cat_id[0]->id;
																							
																							  
																								 
																						}
																					  else
																							{
																								 $flag=1; 
																								 // insert subsubcategory or products
																								  $superCatArr=array('sub_cat'=>$sub_cat_id,'name'=>$SubSubcategoryHtml);
																								  $Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);			
																								  $sub_sub_cat_id=$this->db->insert_id(); 
													
																							}
																			 
																			 
																			 
																			 
																									 
																			
																			
																			
																			
																			
																			
																			
																		}
																		else
																			
																			{	 // insert  subcategory,subsubcategory or products
																			   $flag=1;
																			   
																					  $subcatarr=array('cat_id'=>$cat_id,'sub_cat_name'=>$SubcategoryHtml,'image'=>$image_url);
																					  $Insert=$this->ProductCategoryModal->insert($subcattable,$subcatarr); 
																					  $sub_cat_id=$this->db->insert_id();
																						
																					  $superCatArr=array('sub_cat'=>$sub_cat_id,'name'=>$SubSubcategoryHtml,'image'=>$image_url);
																					  $Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);			
																					  $sub_sub_cat_id=$this->db->insert_id(); 
																					  
																					  
																													   
																				
																			}
																	  
																 					 
																
															   }
															   else
																{
																	  $flag=1;
																	  // insert category, subcategory,subsubcategory or products
																	  $CatArr=array('userid'=>$user_id,'business_id'=>$businees_id,'cat_name'=>$categoryHtml,'image'=>$image_url);
																	  $Insert=$this->ProductCategoryModal->insert($cattable,$CatArr);  
																	  $cat_id=$this->db->insert_id();
																  
																		$subcatarr=array('cat_id'=>$cat_id,'sub_cat_name'=>$SubcategoryHtml,'image'=>$image_url);
																		$Insert=$this->ProductCategoryModal->insert($subcattable,$subcatarr); 
																		$sub_cat_id=$this->db->insert_id();
																		 
																			$superCatArr=array('sub_cat'=>$sub_cat_id,'name'=>$SubSubcategoryHtml,'image'=>$image_url);
																			$Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);			
																			$sub_sub_cat_id=$this->db->insert_id(); 			
																		
																}
			
															
														   $description='<div>
																<ul class="des-details" >
																	<li><b>Product code :</b>'.$selectproducts['ITM_Sortkey'].'</li>
																	<li><b>Brand :</b>'.$selectproducts['BNI_BrandName'].'</li>
																	<li><b>Range :</b>'.$categoryHtml.'</li>	
																</ul>
															</div>';
															
															
		 $product_insert_array =array('list_id'=>$productList,'categories'=>$cat_id,'sub_categories'=>$sub_cat_id,'super_sub_cat_id'=>$sub_sub_cat_id,'Manufacture'=>$Manufacturercod,'title'=>$selectproducts['ITM_ShortDesc'],'business_id'=>$businees_id,'publish_status'=>0,'SKU'=>$selectproducts['ITM_EAN1_Code'],'product_name'=>$selectproducts['ITM_Sortkey'],'description'=>$description,'vat_deductable'=>1,'tax_class'=>0,'inc_vat'=>$selectproducts['ITP_T1_Price'],'ex_vat'=>$selectproducts['ITP_T1_Price'],'Tsicode'=>$selectproducts['ITM_ItemCode'],'searchcat'=>$categoryHtml,'searchsubcat'=>$SubcategoryHtml,'searchsupercat'=>$SubSubcategoryHtml);
														   
														  $ids_array = array('COM_Code'=>$selectproducts['ITM_ItemCode']);
														  
														  array_push($emptyarrayone, $product_insert_array);
														  array_push($emptyarraytwo, $ids_array);  
														  
														}
													
													
															 $this->db->insert_batch('dev_products',$emptyarrayone);
															$this->db->insert_batch('dev_temp_ITEMCODE',$emptyarraytwo); 
														   echo "1";   
														
													}
		   
		}
		
	 public function FilterProductListProduct()
	 {
		   $catid = $this->input->post('catid');
		   $url = $this->input->post('url'); 
		  $business_id  =$this->BusinessIdFunction();
		 /* $catid ='796'; 
		   $url ='https://app.pickmyorder.co.uk/ManageListProducts/0-0-0/49'; */
		    $List_id = explode("/",$url);
			$List_id =$List_id[5];
			
			$query = $this->db->query("select dev_product_sub_cat.id,dev_product_sub_cat.sub_cat_name, dev_product_sub_cat.id,dev_product_sub_cat.sub_cat_name from dev_product_sub_cat,dev_products where dev_products.business_id=".$business_id." and dev_product_sub_cat.id=sub_categories and dev_products.list_id like '%".$List_id."%' and categories=".$catid." group by sub_categories");
			 $data = $query->result_array();
	         print_r(json_encode($data));		
	 }
	

       public function FilterProductListProduct2()
	 {
		   $subcatid = $this->input->post('subcatid');
		   $url = $this->input->post('url'); 
		  $business_id  =$this->BusinessIdFunction();
		
		    $List_id = explode("/",$url);
			$List_id =$List_id[5];
			
			$query = $this->db->query("select super_sub_cat.id,super_sub_cat.name from super_sub_cat,dev_products where dev_products.business_id='$business_id' and super_sub_cat.id=super_sub_cat_id and dev_products.list_id like '%".$List_id."%' and sub_categories=".$subcatid."  group by super_sub_cat_id");
			
			 $data = $query->result_array();
	         print_r(json_encode($data));		
	 }	
		
		
	  public function FilterProductListProduct3()
	 {
		    $Value = $this->input->post('Value');
		    $idName = $this->input->post('idName');
            $listno = $this->input->post('listno');		   
		  $business_id  =$this->BusinessIdFunction();
		  
		    if($idName=='kt_datatable_search_type')
			{
				$And = "and categories=".$Value; 
			}
			elseif($idName=='kt_datatable_search_type_Sub_Category')
			{
				$And = "and sub_categories=".$Value; 
			}
			else
			{
				$And = "and super_sub_cat_id=".$Value; 
			}	
			
			
			if($Value=='0' && $idName=='kt_datatable_search_type_Sub_Category' || $Value=='0' && $idName=='kt_datatable_search_type_Sub_Sub_Category' )
			{
				 $query = $this->db->query("SELECT Manufacture FROM dev_products  where business_id='$business_id' and dev_products.list_id like '%".$listno."%' GROUP BY Manufacture");
			}
			else
			{
			
          $query = $this->db->query("SELECT Manufacture FROM dev_products  where business_id='$business_id' and dev_products.list_id like '%".$listno."%'  ".$And." GROUP BY Manufacture");
			}
			 $data = $query->result_array();
	         print_r(json_encode($data));		
	 }		
		
}