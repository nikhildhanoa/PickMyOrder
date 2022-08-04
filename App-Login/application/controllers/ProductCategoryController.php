<?php  //error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCategoryController extends CI_Controller {

	
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
     $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	$this->load->Model('ProductCategoryModal');
	$this->load->library('upload');
    $this->load->library('image_lib');
	}
	public function UpdateUrlMethod()
{
$siteurl=site_url();                   
$siteur=explode('/',$siteurl);
$updateurl=explode(':',$siteur[0]);
if($updateurl[0]!='https')
  {
	$updateurl=$updateurl[0].'s://'.$siteur[2];
	return($updateurl);
  }
else
  {
	$updateurl=site_url();
	return($updateurl);
  } 
}
	public function category()
	{
		 	
			 
		    if($this->input->post('nsert_cat'))
			{




		      $Parent_cat= $this->input->post('Parent_cat');
			  $subcat= $this->input->post('subcat');
			  $subsubcat= $this->input->post('subsubcat');
			  $Orignelname=$this->input->post('name');
			  $redirect=$this->input->post('redirect');
			
			 
			$image=$_FILES['image'];
			 $image_name_1=preg_replace('/\s+/', '', $image['name']); 
			
			 $uniqueid=rand();
			 $image_name_1=$uniqueid.$image_name_1;
			
			
			/************************check type*************/
			if($Parent_cat=='0')
			{   
				 if(isset($_SESSION['Current_Business']))
				{
					 $business=$_SESSION['Current_Business'];
					
			        $userid=$_SESSION['status']['user_id'];
				}       
				else
				{
	                 $business=$_SESSION['status']['business_id'];
					 $userid=$_SESSION['status']['user_id'];
                } 
				/****check bussiness wholsaler or not ***********/
				$get_busi_status = $this->db->query('select iswholeapp from dev_business where id="'.$business.'"');
			    $business_status = $get_busi_status->result_array();
				$wholsaler_value=$business_status[0]['iswholeapp'];
				
				/************************************************/
				
				$url_image_name_1=$this->UpdateUrlMethod().'/images/category/'.$image_name_1;
				$atradeya_spacial_url="https://pickmyorder.co.uk/App-Login".'/images/category/'.$image_name_1;
			
				 if(move_uploaded_file($image["tmp_name"],"images/category/".$image_name_1)){
			     if($this->input->post('listid'))
				 {
					 $listid=$this->input->post('listid');
					 
				 }
				 else
				 {
					 $listid=0;
					 
				 }
				$table='dev_product_cat';
				$CatArr=array('	userid'=>$userid,'business_id'=>$business,'cat_name'=>$Orignelname,'image'=>$url_image_name_1,'listid'=>$listid);
				
				/************executing curl for atradeya site to insert cat in atradeya also here i nee to 
				 * add code for whlsaler only********/
				 if($wholsaler_value)
				 {
				 $curl = curl_init();

                    curl_setopt_array($curl, array(
                     CURLOPT_URL => "https://atradeya.co.uk/AddCategoryByPickmyorder.php",
                     CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_ENCODING => "",
                     CURLOPT_MAXREDIRS => 10,
                     CURLOPT_TIMEOUT => 30,
                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                     CURLOPT_CUSTOMREQUEST => "POST",
                     CURLOPT_POSTFIELDS => "thumb=$atradeya_spacial_url&name=$Orignelname&description=$Orignelname&slug=$Orignelname&parent=$Orignelname",
                     CURLOPT_HTTPHEADER => array(
                       "cache-control: no-cache",
                       "content-type: application/x-www-form-urlencoded",
                       "postman-token: c0f37c76-9968-5d82-7f89-ad072897fb6b"
                     ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
				 /************************************/
				 }
				 }
				 else
				 {
					 echo "<script>alert('Category Not Insert');
					  location.reload(true);
					 </script>";
				 }
				
			}
			else
			{
				
				if($subcat==0)
				{
					$url_image_name_1=$this->UpdateUrlMethod().'/images/sub_cat/'.$image_name_1;
				   if(move_uploaded_file($image["tmp_name"],"images/sub_cat/".$image_name_1)){
					$table='dev_product_sub_cat';
					$CatArr=array('cat_id'=>$Parent_cat,'sub_cat_name'=>$Orignelname,'image'=>$url_image_name_1);
				 }

				}

				if($subsubcat==0)
				{
						$url_image_name_1=$this->UpdateUrlMethod().'/images/super_cat/'.$image_name_1;
				 if(move_uploaded_file($image["tmp_name"],"images/super_cat/".$image_name_1)){
					$table='super_sub_cat';
					$CatArr=array('sub_cat'=>$subcat,'name'=>$Orignelname,'image'=>$url_image_name_1);
				 } 

				}
				else
				{
					$url_image_name_1=$this->UpdateUrlMethod().'/images/super_cat/'.$image_name_1;
				    if(move_uploaded_file($image["tmp_name"],"images/super_cat/".$image_name_1)){
					$table='dev_super_sub_sub_cat';
					$CatArr=array('super_sub_cat'=>$subsubcat,'name'=>$Orignelname,'image'=>$url_image_name_1);
				}

				
				
			}
			
			/************************close*************/
		}
		
		$Insert=$this->ProductCategoryModal->insert($table,$CatArr);
			
			if($Insert)
			{
				if($Parent_cat==0)  
				{
					$this->session->set_flashdata('message', 'Category Inserted');
					redirect($redirect);
				}
				elseif ($subcat==0)
				{
					$this->session->set_flashdata('message', 'Sub Category Inserted');
                    redirect($redirect);
				}
				elseif($subsubcat==0)
				{  
					 $this->session->set_flashdata('message', 'Sub Sub Category Inserted');
                    redirect($redirect);
				}
				else
				{
					$this->session->set_flashdata('message', 'Sub Sub Sub Category Inserted');
                    redirect($redirect);
				}


				
			}
		
			}
			else
			{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('category.php');
			$this->load->view('footer.php'); 
			}
	
	}
	public function CatDetails()
	{
		if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
			 }
			 else
			 {
		   $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('categoryDetials.php');
			$this->load->view('footer.php');
             }			
	}
	public function subCatDetails()
	{
        if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
			 }
			 else
			 {		
		    $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('subcatdetails.php');
			$this->load->view('footer.php'); 
			 }
	}
	public function DeleteSub()
	 {
		 if(isset($_GET['id']))
		 {
		 $removeable_subcat_id=$_GET['id'];
		 $name=$_GET['name'];
		  $catid=$_GET['catid'];
		 $this->db->query("delete from dev_product_sub_cat where id=$removeable_subcat_id");
         $this->db->query("delete from super_sub_cat where sub_cat=$removeable_subcat_id");
        $this->db->query("delete from dev_products where sub_categories=$removeable_subcat_id");
		 }
		 redirect("CatDetails?id=$catid&cat_name=$name");
	 }
   public function DeleteCat(){
	   $category_id=$_GET['cat_id'];
	  
	   $sub_cat_id=array();
	   $supersub_cat_id=array();
	   $total_product_id=array();
	   $sub_cat_id2=array();
	   $subcategory=$this->db->query("select id from dev_product_sub_cat where cat_id='$category_id'");
	   $subcatid=$subcategory->result_array();
	   $number_subcat=count($subcatid);
	
	   
	   for($i=0;$i<=$number_subcat-1;$i++)
	   {
		 
		 $sub_cat_id[]=$subcatid[$i]['id'];
		 $supersubcategory=$this->db->query("select id from super_sub_cat where sub_cat= $sub_cat_id[$i]");
		 $supersubcategory_id=$supersubcategory->result_array();
		 $number_supersubcategory=count($supersubcategory_id);
		  
		  
		
		  for($j=0;$j<=$number_supersubcategory-1;$j++)
	      {
			  
		$supersub_cat_id[]=$supersubcategory_id[$j]['id'];
		 $product=$this->db->query("select id from dev_products where super_sub_cat_id= $supersub_cat_id[$j]");
		 $product_id=$product->result_array();
		
		 $number_product_id=count($product_id);
		 
		  
			 for($k=0;$k<=$number_product_id-1;$k++)
	         {
				  $total_product_id[]=$product_id[$k]['id'];
			 }  			 
		  }
	   }

	 
	   if($number_subcat>0 && $number_supersubcategory>0 && $number_product_id>0){
		  
	    for($i=0;$i<=$number_product_id-1;$i++)
	     {
	     $product_delete=$this->db->query("delete  from dev_products where super_sub_cat_id= $supersub_cat_id[$i]");
		 if($product_delete)
		   {
			   for($j=0;$j<=$number_supersubcategory-1;$j++)
	              {
			      $super_delete=$this->db->query("delete  from super_sub_cat where sub_cat= $sub_cat_id[$j]");
				    if($super_delete)
		             {
						 
						$sub_cat_delete=$this->db->query("delete  from dev_product_sub_cat where cat_id='$category_id'");
						
						if($sub_cat_delete)
						{
						$cat_delete=$this->db->query("delete  from dev_product_cat where id='$category_id'");
						if($cat_delete)
						 {
							 redirect('category');
						 }
						}
						
						 }
					 }
				  
		          }
		   }
	   }//End of if 
	 else if(!$number_subcat>0)
	{
	 	$cat_delete=$this->db->query("delete  from dev_product_cat where id='$category_id'");
	   if($cat_delete)
		 {
			 redirect('category');
		 } 
		
	} 
	else if($number_subcat>0 && $number_supersubcategory<=0)
	{
		 $cat_delete=$this->db->query("delete  from dev_product_sub_cat where cat_id='$category_id'");
		 if($cat_delete)
		 {
  	     $cat_delete=$this->db->query("delete  from dev_product_cat where id='$category_id'");
		 if($cat_delete)
		     {
			 redirect('category');
		     }
		 } 
	}
	else if($number_subcat>0 && $number_supersubcategory>0 )
	{
		  
	   for($i=0;$i<=$number_supersubcategory-1;$i++)
	     {
		 $supersubcategory2=$this->db->query("delete from super_sub_cat where sub_cat= $sub_cat_id[$i]");
	     }
	   	if($supersubcategory2)
		 {
			$subcategory=$this->db->query("delete from dev_product_sub_cat where cat_id='$category_id'");
		 	if($subcategory)
		      {
			 $cat_delete=$this->db->query("delete  from dev_product_cat where id='$category_id'");
			  if($cat_delete)
		        {
			       redirect('category'); 
		        }
		      }
		 } 
		
		
	}
	else 
	{
		redirect('category');
	} 
 
}
/******************************Delete A List*******************/
	public function DeleteList()  //here a list will be removed and all these cat but not sub abd supersubcat
	{
		$listid=$_POST['Listid'];
		$result=$this->db->query("delete from dev_product_cat where listid='$listid'");
		if($result)
		{
			$isdelete=$this->db->query("delete from dev_CatList where id='$listid'");
			if($isdelete)
			{
				echo "list Deleted Successfully";
			}
			else
			{
				echo "Failed";
			}
		}
		else
		{
			echo "Failed";
		}
	}
/**************************************************************/
public function get_cat_by_ajax()   //use in catagory copy 
{
	   $prechech=array();
	   $flag=0;
	     
    $userid=$_SESSION['status']['user_id'];
	$cattable='dev_product_cat';
	$subcattable='dev_product_sub_cat';
	$supercattable='super_sub_cat';
	$business=$_GET['newbid'];
	// $listid=$_GET['CategoryList'];
	$Category_List_id=$_GET['CategoryList'];
	//print_r($CategoryList);die;
	$NewBussinessCat=$this->ProductCategoryModal->GetAllCat($business);
	
	
	if($Category_List_id!='0')
	{
		   $cat_ids=$this->db->query("select Category_ids from  dev_categorylist where id='$Category_List_id' ");
			$cat_ids=$cat_ids->result_array();
			$Category_ids=$cat_ids[0]['Category_ids']; 
			$cat_data=$this->db->query("SELECT * FROM `dev_product_cat` where id in($Category_ids)");
			$Cat=$cat_data->result_array();
			
	}
	else
	{
		$bid=$_GET['bid'];
		$Cat=$this->ProductCategoryModal->GetAllCat($bid);
	
	}		
	
	
	 for($i=0;$i<count($Cat);$i++)
	{ 
	 
	 $cat_name=$Cat[$i]['cat_name'];
	 
	 
	//
	 
	 $NewBussinessCatData=$this->db->query("select * from dev_product_cat where business_id=$business && cat_name like '$cat_name'");
	 
	 if($NewBussinessCatData->num_rows())
	 {
			$NewBussinessCatData=$NewBussinessCatData->result_array();
			$get_new_business_cat_id=$NewBussinessCatData[0]['id'];
			
			
			
			
			$subdata=$this->ProductCategoryModal->GetAllSubCat($Cat[$i]['id']);
			
			for($j=0;$j<count($subdata);$j++)
			{
			 
			
				$sub_cat_name=$subdata[$j]['sub_cat_name'];
				
				$check_sub_cat_exsist=$this->db->query("SELECT * FROM `dev_product_sub_cat` where sub_cat_name like '$sub_cat_name' and cat_id=$get_new_business_cat_id");
				 
				if($check_sub_cat_exsist->num_rows())
				{
				   $check_sub_cat_exsist=$check_sub_cat_exsist->result_array();
				   $get_new_business_sub_cat_id=$check_sub_cat_exsist[0]['id'];
				   
				   $Supersubdata=$this->ProductCategoryModal->GetAllSuperSubCat($subdata[$j]['id']);
					
					for($k=0;$k<count($Supersubdata);$k++)
					{
					
					
						$sub_sub_cat_name=$Supersubdata[$k]['name'];
					
						$this->db->select('*');
						$this->db->from('super_sub_cat');
						$this->db->where('sub_cat',$get_new_business_sub_cat_id);
						$this->db->like('name', $sub_sub_cat_name,'none');
						$check_sub_sub_cat_exsist=$this->db->get();
						// $check_sub_sub_cat_exsist=$this->db->query("SELECT * FROM `super_sub_cat`  where name like '$sub_sub_cat_name' and sub_cat=$get_new_business_sub_cat_id");
						if($check_sub_sub_cat_exsist->num_rows())
						{
						
						
							
							$check_sub_sub_cat_exsist=$check_sub_sub_cat_exsist->result_array();
							$get_new_business_super_sub_cat_id=$check_sub_sub_cat_exsist[0]['id'];
							//$Supersubsubdata=$this->ProductCategoryModal->GetAllSuperSubCat($Supersubdata[$k]['id']);
							$GetAllSuperSubSub_id=$Supersubdata[$k]['id'];
							$Supersubsubdata=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$GetAllSuperSubSub_id'");
							$Supersubsubdata=$Supersubsubdata->result_array();
							
							for($m=0;$m<count($Supersubsubdata);$m++)
							{	 
								$SupersubSubCategoryName=$Supersubsubdata[$m]['name'];
							  	$this->db->select('*');
								$this->db->from('dev_super_sub_sub_cat');
								$this->db->where('super_sub_cat',$get_new_business_super_sub_cat_id);
								$this->db->like('name', $SupersubSubCategoryName,'none');
								$check_Super_sub_sub_cat_exsist=$this->db->get();  
							  
							   if(!$check_Super_sub_sub_cat_exsist->num_rows())
							  {
								  if($SupersubSubCategoryName!='') 
								  {
												$SupersubSubCategory_image_url=$Supersubsubdata[$m]['image'];
												$super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$get_new_business_super_sub_cat_id);
												$Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
												
												
								    }	
							   }	 
							  
							  
							} 
							  
						}
						else
						{
						
						$cute_super_cat=$Supersubdata[$k]['cute_super_cat'];
						if(empty($cute_super_cat))
						{
							$cute_super_cat='';
						}
						
						
						$superCatArr=array('sub_cat'=>$get_new_business_sub_cat_id,'name'=>$Supersubdata[$k]['name'],'image'=>$Supersubdata[$k]['image'],'cute_super_cat'=>$cute_super_cat);
						$Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);
						
						$flag=1;
						
						 $GetAllSuperSubSub_id=$Supersubdata[$k]['id'];
						$Supersubsubdata=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$GetAllSuperSubSub_id'");
						$Supersubsubdata = $Supersubsubdata->result_array();
						for($m=0;$m<count($Supersubsubdata);$m++)
						{

							$SupersubSubCategoryName=$Supersubsubdata[$m]['name'];
							
							if($SupersubSubCategoryName!='') 
											{
												$SupersubSubCategory_image_url=$Supersubsubdata[$m]['image'];
												$super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$Insert);
												$Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
												
												
											}	
								
						}
						
						
						
						
						
					}	
						  
						  
						  
						
						
						
						
					}
			 }
			 
			 
			 
			 
			  else
			 {
			  
				$flag=1;
				
				$sub_cat_cut_name=$subdata[$j]['sub_cat_cut_name'];
				
				if(empty($sub_cat_cut_name))
				{
					$sub_cat_cut_name='';
				}	
				
				$subcatarr=array('cat_id'=>$get_new_business_cat_id,'sub_cat_name'=>$subdata[$j]['sub_cat_name'],'image'=>$subdata[$j]['image'],'sub_cat_cut_name'=>$sub_cat_cut_name);
				$Insert=$this->ProductCategoryModal->insert($subcattable,$subcatarr); 
				$lastinsertsubcatid=$this->db->insert_id();
			   $Supersubdata=$this->ProductCategoryModal->GetAllSuperSubCat($subdata[$j]['id']);
			   for($k=0;$k<count($Supersubdata);$k++)
				{
					
					$cute_super_cat=$Supersubdata[$k]['cute_super_cat'];
					
					if(empty($cute_super_cat))
				    {
				 	 $cute_super_cat='';
				    }
					
					$superCatArr=array('sub_cat'=>$lastinsertsubcatid,'name'=>$Supersubdata[$k]['name'],'image'=>$Supersubdata[$k]['image'],'cute_super_cat'=>$cute_super_cat);
					$Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);
					
					
					$GetAllSuperSubSub_id=$Supersubdata[$k]['id'];
					//$Supersubsubdata=$this->ProductCategoryModal->GetAllSuperSubCat($Supersubdata[$k]['id']);
					$Supersubsubdata=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$GetAllSuperSubSub_id'");
					$Supersubsubdata = $Supersubsubdata->result_array();
					for($m=0;$m<count($Supersubsubdata);$m++)
						{

							$SupersubSubCategoryName=$Supersubsubdata[$m]['name'];;
							
							if($SupersubSubCategoryName!='') 
											{
												$SupersubSubCategory_image_url=$Supersubsubdata[$m]['image'];
												$super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$Insert);
												$Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
												
												
											}	
								
						}
					
					
				}
			 }
					
					
					
					
				}
			
			 }
			
	 else{ 
	 
		$flag=1;
		
		$Cat_Cute_Name=$Cat[$i]['Cat_Cute_Name'];
		if(empty($Cat_Cute_Name)){$Cat_Cute_Name='';}
				
					
			
		
		$CatArr=array('userid'=>$userid,'business_id'=>$business,'cat_name'=>$Cat[$i]['cat_name'],'image'=>$Cat[$i]['image'],'Cat_Cute_Name'=>$Cat_Cute_Name);
	   $Insert=$this->ProductCategoryModal->insert($cattable,$CatArr);  
	     $lastinsertcatid=$this->db->insert_id();
	  
	 
	 
	   $subdata=$this->ProductCategoryModal->GetAllSubCat($Cat[$i]['id']);
	  for($j=0;$j<count($subdata);$j++)
		{
			$sub_cat_cut_name=$subdata[$j]['sub_cat_cut_name'];
		if(empty($sub_cat_cut_name)){$sub_cat_cut_name='';}
			
		$subcatarr=array('cat_id'=>$lastinsertcatid,'sub_cat_name'=>$subdata[$j]['sub_cat_name'],'image'=>$subdata[$j]['image'],'sub_cat_cut_name'=>$sub_cat_cut_name);
		$Insert=$this->ProductCategoryModal->insert($subcattable,$subcatarr); 
		$lastinsertsubcatid=$this->db->insert_id();
		$Supersubdata=$this->ProductCategoryModal->GetAllSuperSubCat($subdata[$j]['id']);
		   for($k=0;$k<count($Supersubdata);$k++)
			{
				$cute_super_cat=$Supersubdata[$k]['cute_super_cat'];
		      if(empty($cute_super_cat)){$cute_super_cat='';}
				
				
				$superCatArr=array('sub_cat'=>$lastinsertsubcatid,'name'=>$Supersubdata[$k]['name'],'image'=>$Supersubdata[$k]['image'],'cute_super_cat'=>$cute_super_cat);
				
				
			    $Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);
				$lastinsertsubsubcatid=$this->db->insert_id();
				
				$getallsupersub_id=$Supersubdata[$k]['id'];
				$GetAllSuperSubSub_Data=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$getallsupersub_id'");
				$GetAllSuperSubSub_Data=$GetAllSuperSubSub_Data->result_array();
				
				
				for($M=0;$M<count($GetAllSuperSubSub_Data);$M++)
				    {
						$supersubsubarray=array('super_sub_cat'=>$lastinsertsubsubcatid,'name'=>$GetAllSuperSubSub_Data[$M]['name'],'image'=>$GetAllSuperSubSub_Data[$M]['image'],'description'=>$GetAllSuperSubSub_Data[$M]['description']);
						
						$this->db->insert('dev_super_sub_sub_cat',$supersubsubarray);
					}
				
			}
		}  
		 
	 
	 
	 }
	 
	 
	 
	}
	echo $flag;
	
	
    }  //close
	
	/**********************************************Get fillter of a cat 9/09/2020**********************/
	  public function get_cat_fillter()
	   { 
		$catid=$_GET['catid'];
		$Fillterobj=$this->db->query("select filter from dev_product_cat where id='$catid'");
		
		
			$Fillterarray=$Fillterobj->result_array();
			if($Fillterarray[0]['filter'])
			{
				echo json_encode(unserialize($Fillterarray[0]['filter']));
			}
			else
			{
			  echo 0;	
			}
		
	
		
	   }
	/****************************************************************************************************/
  public function get_subcat_by_ajax()
   {
	$catid=$_GET['catid'];
	$subCat=$this->ProductCategoryModal->GetAllSubCat($catid);
	
	print_r(json_encode($subCat));
   }
    public function get_supersubcat_by_ajax()
   {
	$subcatid=$_GET['supercat'];
	
	 $supersubCat=$this->ProductCategoryModal->GetAllSuperSubCat($subcatid);
	
	print_r(json_encode($supersubCat)); 
   }
   
    public function get_super_sub_sub_subcat_by_ajax()
   {
	$supercat=$_GET['sub_sub_cat_id'];
	
	 $AllCat=$this->db->query("select * from  dev_super_sub_sub_cat where super_sub_cat=$supercat");
	 $AllCat=$AllCat->result_array();
	
	print_r(json_encode($AllCat)); 
   }
   
   
   
   
   
   
     /*******************************cange listname by ajax****************************/
   public function UpdateListName()
   {
	   if(isset($_POST['listid'])&& isset($_POST['listname']))
	   {
	   $listid=$_POST['listid'];
	   $listname=$_POST['listname'];
	 
	   $this->db->query("update dev_CatList set listname='$listname' where id='$listid'");
	   if($this->db->affected_rows())
	   {
		   echo "Update Successfully";
	   }
	   else
	   {
		   echo "Update Failed";
	   }
	   }
	   else
	   {
		   echo "Opration Failed";
	   }
   }
   /*******************************cange categoryname by ajax****************************/
   public function UpdateCatName()
   {
	   if(isset($_POST['catid'])&& isset($_POST['catname']))
	   {
	   $cat_id=$_POST['catid'];
	   $cat_name=$_POST['catname'];
	 
	   $this->db->query("update dev_product_cat set cat_name='$cat_name' where id='$cat_id'");
	   if($this->db->affected_rows())
	   {
		   echo "Update Successfully";
	   }
	   else
	   {
		   echo "Update Failed";
	   }
	   }
	   else
	   {
		   echo "Opration Failed";
	   }
   }
    public function UpdateSubCatName()
   {
	    if(isset($_POST['sub_cat_cut_name']))
	   {
		   $sub_cat_cut_name=$_POST['sub_cat_cut_name'];
	   }
	   else
	   {
		   $sub_cat_cut_name='';
	   }
	   
	  
	   $cat_id=$_POST['catid'];
	   $cat_name=$_POST['catname'];
	   
	
	   $this->db->query("update dev_product_sub_cat set sub_cat_name='$cat_name',sub_cat_cut_name='$sub_cat_cut_name' where id='$cat_id'");
	   if($this->db->affected_rows())
	   {
		   echo "Update Successfully";
	   }
	   else
	   {
		   echo "Update Failed";
	   }
	   
   }
   
   public function updatesupersubcat()
   {
	   
	   if(isset($_POST['cutedata']))
	   {
		   $cutedata=$_POST['cutedata'];
	   }
	   else
	   {
		   $cutedata='';
	   }
	   
	   $cat_id=$_POST['id'];
	   $supercat_name=$_POST['valdata'];
	   
	
	   $this->db->query("update  super_sub_cat  set name='$supercat_name',cute_super_cat='$cutedata' where id='$cat_id'");
	   if($this->db->affected_rows())
	   {
		   echo "Update Successfully";
	   }
	   else
	   {
		   echo "Update Failed";
	   }
	   
   }
   
   /*******************05/09/2020 function for spacial bussiness add by scott************************************/
   public function categorylist()
   {
	          
			 
			if($this->input->post('addlistbutton'))
			{
				$listname=$this->input->post('addlist');
				$ListArray=array('listname'=>$listname);
				$Insert=$this->ProductCategoryModal->insert('dev_CatList',$ListArray);
				
				if($Insert)
				{
						$message=array('success'=>'Add List Successfully','tab'=>'menu3');
						$this->load->view('header.php');
						$this->load->view('sidebar.php');
						$this->load->view('categorylistview.php',$message);
						$this->load->view('footer.php');
				}
			}
			else
			{
				if(isset($_GET['tab']))
				{
					$message=array('success'=>'Add List Successfully','tab'=>'menu1');
				}
				else
				{
					$message=array('success'=>'Add List Successfully','tab'=>'home');
				}
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('categorylistview.php',$message);
		   	$this->load->view('footer.php');
			}
   }
   public function catinsidelist()
   {
	    if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
			 }
			 else
			 {
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('CategoryInsideList.php');
			$this->load->view('footer.php'); 
			 }
   }
   
   
    public function GrandSubCat()
   {
	    if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
			 }
			 else
			 {
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('GrandSubCat.php');
				$this->load->view('footer.php'); 
			 }
   }
   
   
   /******************************Delete cat image by click cross*******************************************/
 public function DeleteCatImage()
	{
		if(isset($_POST['subcatid']))
		{
			$subcatid=$_POST['subcatid'];
			$this->db->query("update dev_product_sub_cat SET image='' where id=$subcatid ");
		}
		else
		{
			$catid=$_POST['catid'];
			$this->db->query("update dev_product_cat SET image='' where id=$catid ");
		
		}
		
		if($this->db->affected_rows())
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
	
	/**************************************************/
	
	public function DeletesubsubCatImage()
	{
		
			$subcatid=$_POST['supcatid'];
			$this->db->query("update dev_super_sub_sub_cat SET image='' where id=$subcatid ");
				if($this->db->affected_rows())
				{
					echo "1";
				}
				else
				{
					echo "0";
				}
	}
	
	
	
	public function DeletesubCatImagewithajax()
	{
		
			$subcatid=$_POST['subcatid'];
			
			$this->db->query("update super_sub_cat SET image='' where id=$subcatid ");
				if($this->db->affected_rows())
				{
					echo "1";
				}
				else
				{
					echo "0";
				}
	}
	/*************************************/
		public function ChangesubsubCatImage()
	{
		
		 $subcat = $_POST['changedsupcatid'];
		  $supcatname = $_POST['supcatname'];
		
		  $changedsupcatid = $_POST['mainsupcatid'];
		$supcatimg = $_FILES['supcatimg'];
		  $image_name = $supcatimg['name'];
		 
		$url_image_name =$this->UpdateUrlMethod().'/images/super_cat/'.$image_name;
		 if(move_uploaded_file($supcatimg["tmp_name"],"images/super_cat/".$image_name))
		 {
				$this->db->query("update dev_super_sub_sub_cat SET image='$url_image_name' where id=$changedsupcatid ");
				if($this->db->affected_rows())
				{
					redirect("GrandSubCat?id=$subcat&&sub_cat_name=$supcatname");
				}
				
		 }

	}
	
	/*******************************/
	
	
	 
	
	
	
	/******************************Delete cat image by click cross*******************************************/
 public function changeCatImage()
	{
		$changedcatid=$_POST['changedcatid'];
		$catimg=$_FILES['catimg'];
		$image_name_1=$catimg['name'];
		$url_image_name_1=$this->UpdateUrlMethod().'/images/category/'.$image_name_1;
		 if(move_uploaded_file($catimg["tmp_name"],"images/category/".$image_name_1))
		 {
				$this->db->query("update dev_product_cat SET image='$url_image_name_1' where id=$changedcatid ");
				if($this->db->affected_rows())
				{
					redirect('category');
				}
				
		 }

	}
	/******************************Delete cat image by click cross*******************************************/
 public function changeSubCatImage()
	{
		$changedsubcatid=$_POST['changedsubcatid'];
		$subcatname=$_POST['subcatname'];
		$subcatimg=$_FILES['subcatimg'];
		$image_name_1=$subcatimg['name'];
		
		$url_image_name_1=$this->UpdateUrlMethod().'/images/sub_cat/'.$image_name_1;
		 if(move_uploaded_file($subcatimg["tmp_name"],"images/sub_cat/".$image_name_1))
		 {
				$this->db->query("update dev_product_sub_cat SET image='$url_image_name_1' where id=$changedsubcatid ");
				if($this->db->affected_rows())
				{
					redirect("subCatDetails?id=$changedsubcatid&&cat_name=$subcatname");
				}
				
		 }

	}
	
	/******************************Delete cat image by click cross*******************************************/
	public function DeleteSupCatImages()
	{
		if(isset($_POST['supcatid']))
		{
			$supcatid =$_POST['supcatid'];
			$this->db->query("update super_sub_cat SET image='' where id=$supcatid ");
		}
		
		if($this->db->affected_rows())
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
	public function ChangeSupCatImage()
	{
		
		$subcat = $_POST['changedsupcatid'];
		$changedsupcatid = $_POST['mainsupcatid'];
		$supcatname = $_POST['supcatname'];
		$supcatimg = $_FILES['supcatimg'];
		$image_name = $supcatimg['name'];
		
		$url_image_name =$this->UpdateUrlMethod().'/images/super_cat/'.$image_name;
		 if(move_uploaded_file($supcatimg["tmp_name"],"images/super_cat/".$image_name))
		 {
				$this->db->query("update super_sub_cat SET image='$url_image_name' where id=$changedsupcatid ");
				if($this->db->affected_rows())
				{
					redirect("subCatDetails?id=$subcat&&cat_name=$supcatname");
				}
				
		 }

	}
	
  /**********catagory import with csv*****************/
     
	 public function ImpotCatWithCsvFile()
	 {
		 if(isset($_FILES['thisiscsv']))
	     {
		  	 
		  $cat_info =   $this->csvreader->parse_file($_FILES['thisiscsv']['tmp_name']);
		
		$i=1;
		$flag=1;
		 $userid=$_SESSION['status']['user_id'];
		$dataarray=array();
		 foreach($cat_info as $cat_data)
		 {
			 if($cat_data['categoryName']!='' && $cat_data['business-id']!='')
			 {
				 
				  //$cat_data['SupersubSubCategoryName']!='' && 
				 if(  $cat_data['SuperSubCategoryName']!='' && $cat_data['SubCategoryName']=='')
				 {
					$flag=0; 
					break;
				 }
				 elseif($cat_data['SupersubSubCategoryName']!='' && $cat_data['SuperSubCategoryName']=='' )
				 {
					 $flag=0; 
					break;
					 
				 }
					 
                 else
				 {
					 
					
					
					$dataarray[]=array('categoryName'=>$cat_data['categoryName'],'cat_image'=>$cat_data['cat-image'],'SubCategoryName'=>$cat_data['SubCategoryName'],'subcat_image'=>$cat_data['subcat-image'],'SuperSubCategoryName'=>$cat_data['SuperSubCategoryName'],'supersucat_image'=>$cat_data['supersucat-image'],'business_id'=>$cat_data['business-id'],'SupersubSubCategoryName'=>$cat_data['SupersubSubCategoryName'],'SupersubSubCategory_image'=>$cat_data['SupersubSubCategoryimage']);
					
					
				 }	
			 }
			 else
			 {	 $flag=0;
				 break;
				 
			 }	 
			 $i++;
			
		 }

		 if($flag==1)
     		 {
				 
				 
				 
			 for($i=0;$i<count($dataarray);$i++)
			 {
				  /***************  Category data****************/
				
				 
				  $cat_name=$dataarray[$i]['categoryName'];
				  $business=$dataarray[$i]['business_id'];
				  
				  
			if($dataarray[$i]['cat_image'])
			    {
					  $cat_image=$dataarray[$i]['cat_image'];
					  
					  $path = FCPATH . 'images/ImageAddbycsv/';
					  $filepath=$path.$cat_image;
	                        
                  if(is_file($filepath)) 
					{
						$destinationFilePath = FCPATH . 'images/category/';
						$EXTENSION = pathinfo($cat_image, PATHINFO_EXTENSION);
						$renameimage=rand().time().'.'.$EXTENSION;
						$MoveFile=$destinationFilePath.$renameimage;
						//$test=base_url();
						//$test2="$test/images/category/$cat_image";
						//print_r($test2);die;
						$cat_image_url="http://app.pickmyorder.co.uk/images/category/$renameimage";
						copy($filepath,$MoveFile);
								
					}
					else
				   {
					  $cat_image_url=''; 
				   }
                    						 
				}
				 else
				   {
					  $cat_image_url=''; 
				   }
				   /*************** closed****************/
				  
				   /*************** Sub Category data****************/
				  
			if($dataarray[$i]['SubCategoryName'])
				{
					 $SubCategoryName= $dataarray[$i]['SubCategoryName'];
			    }
				else
				 
                 {
					 $SubCategoryName='';
				 }			 
				
				  
				 if($dataarray[$i]['subcat_image'])
				    {  
						  $SubCategoryimage= $dataarray[$i]['subcat_image'];
						  $SubCategory_image_path = FCPATH . 'images/ImageAddbycsv/';
						  $SubCategory_filepath=$SubCategory_image_path.$SubCategoryimage;
	                     
							
                     if(is_file($SubCategory_filepath)) 
						{
							$SubCategory_destinationFilePath = FCPATH . 'images/sub_cat/';
							$SubCategory_EXTENSION = pathinfo($SubCategoryimage, PATHINFO_EXTENSION);
							$SubCategory_renameimage=rand().time().'.'.$SubCategory_EXTENSION;
							$SubCategory_MoveFile=$SubCategory_destinationFilePath.$SubCategory_renameimage;
							$SubCategory_image_url="http://app.pickmyorder.co.uk/images/sub_cat/$SubCategory_renameimage";
							copy($SubCategory_filepath,$SubCategory_MoveFile);
							
							
						}
						else
				    {
					   $SubCategory_image_url=''; 
				    }
					 
					 
					 
				    }
				     else
				    {
						 
					   $SubCategory_image_url=''; 
				    }
				    /*************** closed****************/
				  
				  /***************Super Sub Category data****************/
				 if($dataarray[$i]['SuperSubCategoryName'])
				    {	  
					  $sub_sub_cat_name=$dataarray[$i]['SuperSubCategoryName'];
				    }
					else
					{
						$sub_sub_cat_name='';
					}	
				  
                     if($dataarray[$i]['supersucat_image'])
				       {					  
							 $supersucat_image=$dataarray[$i]['supersucat_image'];
							 $supersucat_image_path = FCPATH . 'images/ImageAddbycsv/';
							 $supersucat_filepath=$supersucat_image_path.$supersucat_image;
							
                          if(is_file($supersucat_filepath)) 
						      {
								$supersucat_destinationFilePath = FCPATH . 'images/super_cat/';
								$supersucat_EXTENSION = pathinfo($supersucat_image, PATHINFO_EXTENSION);
								$supersucat_renameimage=rand().time().'.'.$supersucat_EXTENSION;
								$supersucat_MoveFile=$supersucat_destinationFilePath.$supersucat_renameimage;
                                $supersucat_image_url="http://app.pickmyorder.co.uk/images/super_cat/$supersucat_renameimage";
								copy($supersucat_filepath,$supersucat_MoveFile);
							
							
						    }
							 else
				        {
					       $supersucat_image_url='';  
				        } 
						  
				        }
				     else
				        {
							
					       $supersucat_image_url='';  
				        } 
				  /***************close****************/
				  
				 /******************super sub sub category data*********************/
			    if($dataarray[$i]['SupersubSubCategoryName'])
				{
					 $SupersubSubCategoryName= $dataarray[$i]['SupersubSubCategoryName'];
			    }
				else
				{
					 $SupersubSubCategoryName='';
				 }			 
				
				  
				 if($dataarray[$i]['SupersubSubCategory_image'])
				    {  
						  $SupersubSubCategory_image= $dataarray[$i]['SupersubSubCategory_image'];
						  $SupersubSubCategory_image_path = FCPATH . 'images/ImageAddbycsv/';
						  $SupersubSubCategory_filepath=$SupersubSubCategory_image_path.$SupersubSubCategory_image;
	                     
							
                     if(is_file($SupersubSubCategory_filepath)) 
						{
				$SupersubSubCategory_destinationFilePath = FCPATH . 'images/sub_cat/';
				$SupersubSubCategory_EXTENSION = pathinfo($SupersubSubCategory_image, PATHINFO_EXTENSION);
				$SupersubSubCategory_renameimage=rand().time().'.'.$SupersubSubCategory_EXTENSION;
				$SupersubSubCategory_MoveFile=$SupersubSubCategory_destinationFilePath.$SupersubSubCategory_renameimage;
				$SupersubSubCategory_image_url="http://app.pickmyorder.co.uk/images/sub_cat/$SupersubSubCategory_renameimage";
				copy($SupersubSubCategory_filepath,$SupersubSubCategory_MoveFile);
							
							
						}
						else
				    {
					   $SupersubSubCategory_image_url=''; 
				    }
					 
					 
					 
				    }
				     else
				    {
						 
					   $SupersubSubCategory_image_url=''; 
				    }
				 
				  
				 
				 /*************closed***************/
				  
				  
				  
				  $NewBussinessCatData=$this->db->query("select * from dev_product_cat where business_id=$business && trim(cat_name) like trim('$cat_name')");
				  if($NewBussinessCatData->num_rows())
				  {
					  if($dataarray[$i]['SubCategoryName']!='')
					  {	  
						  $sub_cat_name=$dataarray[$i]['SubCategoryName'];	
						  $NewBussinessCatData=$NewBussinessCatData->result_array();
						  $get_new_business_cat_id=$NewBussinessCatData[0]['id'];
						  $NewBussinesssubCatData=$this->db->query("SELECT * FROM `dev_product_sub_cat` where cat_id=$get_new_business_cat_id and trim(sub_cat_name) like trim('$sub_cat_name')");
						  if($NewBussinesssubCatData->num_rows())
						  {
							  if($dataarray[$i]['SubCategoryName']!='')
							  {   
								  $NewBussinesssubCatData=$NewBussinesssubCatData->result_array();
								  $get_new_business_sub_cat_id=$NewBussinesssubCatData[0]['id'];
								   $sub_sub_cat_name=$dataarray[$i]['SuperSubCategoryName'];
								  $this->db->select('*');
								  $this->db->from('super_sub_cat');
								  $this->db->where('sub_cat',$get_new_business_sub_cat_id);
								  $this->db->like('name', $sub_sub_cat_name,'none');
								  $check_sub_sub_cat_exsist=$this->db->get();
								  if($check_sub_sub_cat_exsist->num_rows())
								  {
									 if($sub_sub_cat_name!='')
									 {		
										  /*********************************/
										 $check_sub_sub_cat_exsist=$check_sub_sub_cat_exsist->result_array();
										 $get_new_business_super_sub_cat_id=$check_sub_sub_cat_exsist[0]['id'];
											
										  $this->db->select('*');
										  $this->db->from('dev_super_sub_sub_cat');
										  $this->db->where('super_sub_cat',$get_new_business_super_sub_cat_id);
										  $this->db->like('name', $SupersubSubCategoryName,'none');
										  $check_Super_sub_sub_cat_exsist=$this->db->get();
										  
										  if(!$check_Super_sub_sub_cat_exsist->num_rows())
										  { 
											if($SupersubSubCategoryName!='') 
											{
												$super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$get_new_business_super_sub_cat_id);
												$Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
												
												
											}	
											  
										  }	 
									 }			

									
									  
									  
									  
									  
									  
								  }
								  else
								  {
									 

									if( $sub_sub_cat_name!='')
									{			
									 $superCatArr=array('sub_cat'=> $get_new_business_sub_cat_id,'name'=> $sub_sub_cat_name,'image'=>$supersucat_image_url);
									  $Insert=$this->db->insert('super_sub_cat',$superCatArr);
									  $lastinsertsubsubcatid=$this->db->insert_id();
									
									if($lastinsertsubsubcatid)
									{
										$super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$lastinsertsubsubcatid);
												$Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
										
									}		
									}  
									  
								  }		
								  
								  
												  
							  }	  
							  
						  }
						  else
						  {
							  
							if($dataarray[$i]['SubCategoryName']!='')
							{
								$subcatarr=array('cat_id'=> $get_new_business_cat_id,'sub_cat_name'=> $SubCategoryName,'image'=> $SubCategory_image_url);
							$Insert=$this->db->insert('dev_product_sub_cat',$subcatarr); 
							$lastinsertsubcatid=$this->db->insert_id();
							}
							
							if($sub_sub_cat_name!='')
							{	
								$superCatArr=array('sub_cat'=>$lastinsertsubcatid,'name'=>$sub_sub_cat_name,'image'=>$supersucat_image_url);
								$Insert=$this->db->insert('super_sub_cat',$superCatArr); 
							}
							
						  }			
					  
					  }
					  
					  
				  }
				  else
				  {
					  $CatArr=array('userid'=>$userid,'business_id'=>$business,'cat_name'=>$cat_name,'image'=> $cat_image_url);
					  
					  
				   $Insert=$this->db->insert('dev_product_cat',$CatArr);  
					$lastinsertcatid=$this->db->insert_id();
					 
					 if( $SubCategoryName!='')
					 {	 
					 $subcatarr=array('cat_id'=> $lastinsertcatid,'sub_cat_name'=> $SubCategoryName,'image'=> $SubCategory_image_url);
							$Insert=$this->db->insert('dev_product_sub_cat',$subcatarr); 
							$lastinsertsubcatid=$this->db->insert_id();
							
					 }
					 if($sub_sub_cat_name!='')
					 {	 
						
						$superCatArr=array('sub_cat'=>$lastinsertsubcatid,'name'=>$sub_sub_cat_name,'image'=>$supersucat_image_url);
						$Insert=$this->db->insert('super_sub_cat',$superCatArr);
						
						$lastinsertsubsubcatid=$this->db->insert_id();						
					}	
					 if($SupersubSubCategoryName!='')
					 {
						$super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$lastinsertsubsubcatid);
												$Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array); 
												$this->db->insert_id();
												
					 }
					 
					  
				  }	
				 
				 
			 }		
				 
			 
		 }
		 else{
			 
			 $this->session->set_flashdata('error', 'Invalid Csv File');
		          redirect(base_url('category'));
			
			exit;
			 
		 } 	
		 $this->session->set_flashdata('message', 'Csv Import Successfully');
		 redirect(base_url('category'));
		 
			 
		 
		
		 }
		 
	 }
	 /**************************/
	 
	 
	 
	  public function UpdateProductsWithCsvFile()
	 {
		 
		 
		 $emptyarray=array();
		 if(isset($_FILES['thisiscsv']))
	     {
			/* $data="";
			$handle=fopen($_FILES['thisiscsv']['tmp_name'],"r");
			while(!feof($handle))
			{
				$data.=fgets($handle,5000);
				
			}	
			$data=mb_convert_encoding($data,"UTF-8",'auto');
			$array=str_getcsv($data);
			
			print_r($array);
			die; */
		   $pro_info =$this->csvreader->parse_file($_FILES['thisiscsv']['tmp_name']);
		  
		    
         foreach($pro_info as $pro_data)
		 {
			  $id=$pro_data['id'];
			 
			  $Tsicode=$pro_data['Tsicode'];
			  $VatDeductable=$pro_data['Vat Deductable'];
			  $ProductName=$pro_data['Product Name'];
			  $Title=$pro_data['Title'];
			  $Publish_Status=$pro_data['Publish_Status'];
			  $Products_image_one=$pro_data['Products_image_one'];
			  $PDF1=$pro_data['PDF1'];
			  $taxclass=$pro_data['tax class'];
			  $Manufacture=$pro_data['Manufacture'];
			  $Sku=$pro_data['Sku'];
			  $Products_image_two=$pro_data['Products_image_two'];
			  $PDF2=$pro_data['PDF2'];
			  $PDF3=$pro_data['PDF3'];
			  $PDF4=$pro_data['PDF4'];
			  $PDF5=$pro_data['PDF5'];
			  $PDF6=$pro_data['PDF6']; 
			  $supplierwithCost=$pro_data['supplierwithCost'];
			  
			  
			  $supplierCostdata=str_replace(';',',',$supplierwithCost);
			
			$update_array=array('Tsicode'=>$Tsicode,'vat_deductable'=>$VatDeductable,'product_name'=>$ProductName,'title'=>$Title,'publish_status'=>$Publish_Status,'products_images'=>$Products_image_one,'pdf_name'=>$PDF1,'tax_class'=>$taxclass,'Manufacture'=>$Manufacture,'SKU'=>$Sku,'product_image_two'=>$Products_image_two,'pdf2_name'=>$PDF2,'pdf3_name'=>$PDF3,'pdf4_name'=>$PDF4,'pdf5_name'=>$PDF5,'pdf6_name'=>$PDF6,'supplier_with_cost'=>$supplierCostdata);
			
		
            if($id!='')
			{				
          $this->db->where('id', $id);
          $this->db->update('dev_products', $update_array);
			}
			
		 } 
		   print_r('update Successfully');
		   echo "<a href='products'>BACK</a>";
          
		 
		  
		 }	  
	 }
  /******************************/
  
   public function DeleteMultipleProducts()
   {
	   
	   $selected=$_POST['selected'];
	  
	  $get=$selected[0];
	  
	  if($get=='on')
	  {
			unset($selected[0]);
	  }	  
          
			
		    $id = implode(',',$selected); 
		
			$delete=$this->db->query("delete from dev_products where id in ($id)");
			if($delete)
			{
				echo "1";
			}
	     
	
	   
	 
		
		
   }
    /*******************************/
	
	
   public function publishedMultipleProducts()
   {
	   
	   $selected=$_POST['selected'];
	  
	  $get=$selected[0];
	  
	  if($get=='on')
	  {
			unset($selected[0]);
	  }	  
          
			
		    $id = implode(',',$selected); 
		
			$delete=$this->db->query("update dev_products  set publish_status = 1 where id in ($id)");
			if($delete)
			{
				echo "1";
			}
	     
		
   }
	
 /*************************/

        
   public function unpublishedMultipleProducts()
   {
	   
	   $selected=$_POST['selected'];
	  
	  $get=$selected[0];
	  
	  if($get=='on')
	  {
			unset($selected[0]);
	  }	  
          
			
		    $id = implode(',',$selected); 
		
			$delete=$this->db->query("update dev_products  set publish_status = 0 where id in ($id)");
			if($delete)
			{
				echo "1";
			}
	     
		
   } 
	
	
   public function CatCopyfromList()    
   {
		  $prechech=array();
		  $flag=0;
			$cat_status_ids='';
	   $userid=$_SESSION['status']['user_id'];
	   $cattable='dev_product_cat';
	   $subcattable='dev_product_sub_cat';
	   $supercattable='super_sub_cat';
	   $business_arrays = $_POST['newbid'];

	   $Category_List_id=$_POST['CategoryList'];
	 //  $NewBussinessCat=$this->ProductCategoryModal->GetAllCat($business);
	   
	
	   foreach( $business_arrays as  $business_array)
	   {
		   foreach ( $business_array as $business)   
		   {
			  
			  $cat_ids=$this->db->query("select Category_ids from  dev_categorylist where id='$Category_List_id'");
			   $cat_ids=$cat_ids->result_array();
			  $Category_ids=$cat_ids[0]['Category_ids']; 
			
			  $cat_staus_data=$this->db->query("SELECT cat_ids FROM `dev_categorylist_status` where status=1 and  cat_ids in($Category_ids)");
			  $cat_staus_data=$cat_staus_data->result_array();
               
			  foreach($cat_staus_data as $cat_status)
			  {
				 $cat_status_ids .= $cat_status['cat_ids']. ',';
			  }
			 
			  $cat_status_ids =  rtrim($cat_status_ids,',');

			 
			   $cat_data=$this->db->query("SELECT * FROM `dev_product_cat` where id in($cat_status_ids)");
			   $Cat=$cat_data->result_array();
			
	   		
	
	   
		for($i=0;$i<count($Cat);$i++)
	   { 
		
		$cat_name=$Cat[$i]['cat_name'];
		$NewBussinessCatData=$this->db->query("select * from dev_product_cat where business_id=$business && cat_name like '$cat_name'");
		
		if($NewBussinessCatData->num_rows())
		{
			   $NewBussinessCatData=$NewBussinessCatData->result_array();
			   $get_new_business_cat_id=$NewBussinessCatData[0]['id'];
			   
			   
			   
			   
			   $subdata=$this->ProductCategoryModal->GetAllSubCat($Cat[$i]['id']);
			   
			   for($j=0;$j<count($subdata);$j++)
			   {
				
			   
				   $sub_cat_name=$subdata[$j]['sub_cat_name'];
				   
				   $check_sub_cat_exsist=$this->db->query("SELECT * FROM `dev_product_sub_cat` where sub_cat_name like '$sub_cat_name' and cat_id=$get_new_business_cat_id");
					
				   if($check_sub_cat_exsist->num_rows())
				   {
					  $check_sub_cat_exsist=$check_sub_cat_exsist->result_array();
					  $get_new_business_sub_cat_id=$check_sub_cat_exsist[0]['id'];
					  
					  $Supersubdata=$this->ProductCategoryModal->GetAllSuperSubCat($subdata[$j]['id']);
					   
					   for($k=0;$k<count($Supersubdata);$k++)
					   {
					   
					   
						   $sub_sub_cat_name=$Supersubdata[$k]['name'];
					   
						   $this->db->select('*');
						   $this->db->from('super_sub_cat');
						   $this->db->where('sub_cat',$get_new_business_sub_cat_id);
						   $this->db->like('name', $sub_sub_cat_name,'none');
						   $check_sub_sub_cat_exsist=$this->db->get();
						   // $check_sub_sub_cat_exsist=$this->db->query("SELECT * FROM `super_sub_cat`  where name like '$sub_sub_cat_name' and sub_cat=$get_new_business_sub_cat_id");
						   if($check_sub_sub_cat_exsist->num_rows())
						   {
						   
						   
							   
							   $check_sub_sub_cat_exsist=$check_sub_sub_cat_exsist->result_array();
							   $get_new_business_super_sub_cat_id=$check_sub_sub_cat_exsist[0]['id'];
							   //$Supersubsubdata=$this->ProductCategoryModal->GetAllSuperSubCat($Supersubdata[$k]['id']);
							   $GetAllSuperSubSub_id=$Supersubdata[$k]['id'];
							   $Supersubsubdata=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$GetAllSuperSubSub_id'");
							   $Supersubsubdata=$Supersubsubdata->result_array();
							   
							   for($m=0;$m<count($Supersubsubdata);$m++)
							   {	 
								   $SupersubSubCategoryName=$Supersubsubdata[$m]['name'];
									 $this->db->select('*');
								   $this->db->from('dev_super_sub_sub_cat');
								   $this->db->where('super_sub_cat',$get_new_business_super_sub_cat_id);
								   $this->db->like('name', $SupersubSubCategoryName,'none');
								   $check_Super_sub_sub_cat_exsist=$this->db->get();  
								 
								  if(!$check_Super_sub_sub_cat_exsist->num_rows())
								 {
									 if($SupersubSubCategoryName!='') 
									 {
												   $SupersubSubCategory_image_url=$Supersubsubdata[$m]['image'];
												   $super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$get_new_business_super_sub_cat_id);
												   $Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
												   
												   
									   }	
								  }	 
								 
								 
							   } 
								 
						   }
						   else
						   {
						   
						   $superCatArr=array('sub_cat'=>$get_new_business_sub_cat_id,'name'=>$Supersubdata[$k]['name'],'image'=>$Supersubdata[$k]['image']);
						   $Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);
						   
						   $flag=1;
						   
							$GetAllSuperSubSub_id=$Supersubdata[$k]['id'];
						   $Supersubsubdata=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$GetAllSuperSubSub_id'");
						   $Supersubsubdata = $Supersubsubdata->result_array();
						   
						   for($m=0;$m<count($Supersubsubdata);$m++)
						   {
   
							   $SupersubSubCategoryName=$Supersubsubdata[$m]['name'];
							   
							   if($SupersubSubCategoryName!='') 
											   {
												   $SupersubSubCategory_image_url=$Supersubsubdata[$m]['image'];
												   $super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$Insert);
												   $Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
												   
												   
											   }	
								   
						   }
						   
						   
						   
						   
						   
					   }	
							 
							 
							 
						   
						   
						   
						   
					   }
				}
				
				
				
				
				 else
				{
			   
				   $flag=1;
				   $subcatarr=array('cat_id'=>$get_new_business_cat_id,'sub_cat_name'=>$subdata[$j]['sub_cat_name'],'image'=>$subdata[$j]['image']);;
				   $Insert=$this->ProductCategoryModal->insert($subcattable,$subcatarr); 
				   $lastinsertsubcatid=$this->db->insert_id();
				  $Supersubdata=$this->ProductCategoryModal->GetAllSuperSubCat($subdata[$j]['id']);
				  for($k=0;$k<count($Supersubdata);$k++)
				   {
					   $superCatArr=array('sub_cat'=>$lastinsertsubcatid,'name'=>$Supersubdata[$k]['name'],'image'=>$Supersubdata[$k]['image']);
					   $Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);
					   
					   
					   $GetAllSuperSubSub_id=$Supersubdata[$k]['id'];
					   //$Supersubsubdata=$this->ProductCategoryModal->GetAllSuperSubCat($Supersubdata[$k]['id']);
					   $Supersubsubdata=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$GetAllSuperSubSub_id'");
					   $Supersubsubdata = $Supersubsubdata->result_array();
					   for($m=0;$m<count($Supersubsubdata);$m++)
						   {
   
							   $SupersubSubCategoryName=$Supersubsubdata[$m]['name'];;
							   
							   if($SupersubSubCategoryName!='') 
											   {
												   $SupersubSubCategory_image_url=$Supersubsubdata[$m]['image'];
												   $super_sub_sub_category_array=array('name'=>$SupersubSubCategoryName,'image'=>$SupersubSubCategory_image_url,'super_sub_cat'=>$Insert);
												   $Insert=$this->db->insert('dev_super_sub_sub_cat',$super_sub_sub_category_array);
												   
												   
											   }	
								   
						   }
					   
					   
				   }
				}
					   
					   
					   
					   
				   }
				   
					
				   
				   
				   
				
				}
			   
		else{ 
		
		   $flag=1;
		   $CatArr=array('userid'=>$userid,'business_id'=>$business,'cat_name'=>$Cat[$i]['cat_name'],'image'=>$Cat[$i]['image']);
		  $Insert=$this->ProductCategoryModal->insert($cattable,$CatArr);  
			$lastinsertcatid=$this->db->insert_id();
		 
		
		
		  $subdata=$this->ProductCategoryModal->GetAllSubCat($Cat[$i]['id']);
		 for($j=0;$j<count($subdata);$j++)
		   {
		   $subcatarr=array('cat_id'=>$lastinsertcatid,'sub_cat_name'=>$subdata[$j]['sub_cat_name'],'image'=>$subdata[$j]['image']);
		   $Insert=$this->ProductCategoryModal->insert($subcattable,$subcatarr); 
		   $lastinsertsubcatid=$this->db->insert_id();
		   $Supersubdata=$this->ProductCategoryModal->GetAllSuperSubCat($subdata[$j]['id']);
			  for($k=0;$k<count($Supersubdata);$k++)
			   {
				   $superCatArr=array('sub_cat'=>$lastinsertsubcatid,'name'=>$Supersubdata[$k]['name'],'image'=>$Supersubdata[$k]['image']);
				   
				   
				   $Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);
				   $lastinsertsubsubcatid=$this->db->insert_id();
				   
				   $getallsupersub_id=$Supersubdata[$k]['id'];
				   $GetAllSuperSubSub_Data=$this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$getallsupersub_id'");
				   $GetAllSuperSubSub_Data=$GetAllSuperSubSub_Data->result_array();
				   
				   
				   for($M=0;$M<count($GetAllSuperSubSub_Data);$M++)
					   {
						   $supersubsubarray=array('super_sub_cat'=>$lastinsertsubsubcatid,'name'=>$GetAllSuperSubSub_Data[$M]['name'],'image'=>$GetAllSuperSubSub_Data[$M]['image'],'description'=>$GetAllSuperSubSub_Data[$M]['description']);
						   
						   $this->db->insert('dev_super_sub_sub_cat',$supersubsubarray);
					   }
				   
			   }
		   }  
			
		
		
		}
		
		
	}
	   }
	}
	   echo $flag;
  
   



}

		public function ChangeCatimages()
		{
			if(isset($_POST['catid']))
			{
				$catid=$_POST['catid'];
				
				$update=$this->db->query("update dev_product_cat SET image='' where id=$catid ");
				if($update)
				{
					echo "1";
				}
				else
				{
					echo "0";
				}
			}
		}

		public function UpdateCatImage()
		{

		
			$changedsubcatid=$_POST['catid'];
			$subcatname=$_POST['cat_name'];
			$subcatimg=$_FILES['catimg'];
			$image_name_1=$subcatimg['name'];
			
			$url_image_name_1=$this->UpdateUrlMethod().'/images/sub_cat/'.$image_name_1;
			 if(move_uploaded_file($subcatimg["tmp_name"],"images/sub_cat/".$image_name_1))
			 {
					$this->db->query("update dev_product_cat SET image='$url_image_name_1' where id=$changedsubcatid ");
					if($this->db->affected_rows())
					{
						redirect("CatDetails?id=$changedsubcatid&&cat_name=$subcatname");
					}
					
			 }
	
		}


       public function SubCategory()
	   {
			if(empty($this->session->userdata('status'))){
				redirect(base_url('index'));
				 }
				 else
				 {
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('SubCategory.php');
				$this->load->view('footer.php'); 
				 }
	   }
	   
       public function GetAllSubCategory()
		{
		$catid=$_GET['id'];
		
		$subCat=$this->ProductCategoryModal->GetAllSubCat($catid);
		print_r(json_encode($subCat));
		}
		
		public function DeleteSubCategory() 
		{
		$table='dev_product_sub_cat';	
		$id=$_GET['id'];
		$catid=$_GET['catid'];
		
		$subCat=$this->ProductCategoryModal->delete($table,$id);
		if($subCat)
		{
			redirect(base_url("SubCategory?id=".$catid));
		}	
		
		}
         
		 public function EditSubCategory()
	   {
			if(empty($this->session->userdata('status'))){
				redirect(base_url('index'));
				 }
				 else
				 {
					
					if(isset($_SESSION['Current_Business'])){
		             $bid=$_SESSION['Current_Business'];
					}else
					{
					$status=$this->session->userdata('status'); 
					$bid = $status['business_id']; 
					}
					$id=$_GET['id'];
                    $dataobject=$this->db->query("select * from  dev_product_sub_cat  where id='$id'"); 
                    $data_array=$dataobject->result_array();
					$data=array('key'=>$data_array,'bid'=>$bid);
					$this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('EditSubCategory.php',$data);
					$this->load->view('footer.php'); 
				 }
	   }
		 
	public function superSubCategory()
	   {
			if(empty($this->session->userdata('status'))){
				redirect(base_url('index'));
				 }
				 else
				 {
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('superSubCategory.php');
				$this->load->view('footer.php'); 
				 }
	   }
		
        public function GetAllSuperSubCategory()
		{
		$subcatid=$_GET['id'];
		
		$supersubCat=$this->ProductCategoryModal->GetAllSuperSubCat($subcatid);
		print_r(json_encode($supersubCat));
		}
		
		public function DeleteSuperSubCategory() 
		{
		$table='super_sub_cat ';	
		$id=$_GET['id'];
		$catid=$_GET['catid'];
		
		$subCat=$this->ProductCategoryModal->delete($table,$id);
		if($subCat)
		{
			redirect(base_url("superSubCategory/".$catid));
		}	
		
		}
		
		 public function EditSuperSubCategory()
	   {
			if(empty($this->session->userdata('status'))){
				redirect(base_url('index'));
				 }
				 else
				 {
					
					if(isset($_SESSION['Current_Business'])){
		             $bid=$_SESSION['Current_Business'];
					}else
					{
					$status=$this->session->userdata('status'); 
					$bid = $status['business_id']; 
					}
					$id=$this->uri->segment(2);
                    $dataobject=$this->db->query("select * from  super_sub_cat   where id='$id'"); 
                    $data_array=$dataobject->result_array();
					$data=array('key'=>$data_array,'bid'=>$bid);
					$this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('EditSuperSubCategory.php',$data);
					$this->load->view('footer.php'); 
				 }
	   }
		
        		
    public function updateSubData()
	{
         
		$changedcatid=$_POST['id'];
		$cat_name=$_POST['cat_name'];
		$Cat_Cute_Name=$_POST['Cat_Cute_Name'];  
		$checkpage=$_POST['checkpage'];
		$redirectid=$_POST['redirectid'];
		$Cat_Cute_Name=(empty($Cat_Cute_Name)) ? '' : $Cat_Cute_Name ;
		  
		$catimg=$_FILES['cat_img'];
		$image_name_1=$catimg['name'];
		if(!empty($image_name_1))
		{
			$url_image_name_1=site_url().'/images/category/'.$image_name_1;
		 if(move_uploaded_file($catimg["tmp_name"],"images/category/".$image_name_1))
		 {
			 if($checkpage=='subcategory')
			 {
				$update=$this->db->query("update  dev_product_sub_cat SET sub_cat_cut_name='$Cat_Cute_Name',image='$url_image_name_1',sub_cat_name='$cat_name' where id=$changedcatid ");
				if($update){redirect(base_url('SubCategory?id='.$redirectid));}
			 }else
			 {
				 $update=$this->db->query("update   super_sub_cat  SET cute_super_cat='$Cat_Cute_Name',image='$url_image_name_1',name='$cat_name' where id=$changedcatid ");
				if($update){redirect(base_url('superSubCategory/'.$redirectid));}
			 }	 
             			 
		 }
		}else{
			
			if($checkpage=='subcategory')
			 { 
			$update=$this->db->query("update dev_product_sub_cat SET sub_cat_cut_name='$Cat_Cute_Name',sub_cat_name='$cat_name' where id=$changedcatid ");
			if($update){redirect(base_url('SubCategory?id='.$redirectid));}
			 }else
             {
			 $update=$this->db->query("update super_sub_cat SET cute_super_cat='$Cat_Cute_Name',name='$cat_name' where id=$changedcatid ");
			 if($update){redirect(base_url('superSubCategory/'.$redirectid));}
			 }				 
			
		}
		
	 

	}

}
