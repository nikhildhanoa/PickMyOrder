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
		 	
			 if(isset($_SESSION['status'])){
		    if($this->input->post('nsert_cat'))
			{
		    $Parent_cat= $this->input->post('Parent_cat');
			$Orignelname=$this->input->post('name');
			  $redirect=$this->input->post('redirect');;
			$image=$_FILES['image'];
			 $image_name_1=preg_replace('/\s+/', '', $image['name']); 
			
			 $uniqueid=rand();
			 $image_name_1=$uniqueid.$image_name_1;
			
			//$Description=$this->input->post('Description');
			
			
			//$image_tmp_name=$image['tmp_name'];
			
			/************************check type*************/
			if($Parent_cat=='0')
			{
				 if(isset($_SESSION['Current_Business']))
				{
					 $business=$_SESSION['Current_Business'];
					// $selected_user = $this->db->query('select id from dev_users where business_id="'.$business.'"');
			//  $selected_admin = $selected_user->result_array();
			  // $userid=$selected_admin[0]['id'];
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
				$Checkarray=explode(',',$Parent_cat);
				$id=$Checkarray[0];
				$name=$Checkarray[1];
				if($name=='cat')
				{
					$url_image_name_1=$this->UpdateUrlMethod().'/images/sub_cat/'.$image_name_1;
				 if(move_uploaded_file($image["tmp_name"],"images/sub_cat/".$image_name_1)){
					$table='dev_product_sub_cat';
					$CatArr=array('cat_id'=>$id,'sub_cat_name'=>$Orignelname,'image'=>$url_image_name_1);
				 } else
				 {
					 echo "<script>alert('SubCategory Not Insert');
					  location.reload(true);
					 </script>";
				 }
				}
				if($name=='Subcat')
				{
						$url_image_name_1=$this->UpdateUrlMethod().'/images/super_cat/'.$image_name_1;
				 if(move_uploaded_file($image["tmp_name"],"images/super_cat/".$image_name_1)){
					$table='super_sub_cat';
					$CatArr=array('sub_cat'=>$id,'name'=>$Orignelname,'image'=>$url_image_name_1);
				 } else
				 {
					 echo "<script>alert('SubCategory Not Insert');
					  location.reload(true);
					 </script>";
				 }
				}
				
				
			}
			$Insert=$this->ProductCategoryModal->insert($table,$CatArr);
			if($Insert)
			{
				redirect($redirect);
			}
			/************************close*************/
			
			}
			else
			{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('category.php');
			$this->load->view('footer.php'); 
			}
	}
	
	else{
		redirect('dashboard');
	}
	}
	public function CatDetails()
	{
		   $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('categoryDetials.php');
			$this->load->view('footer.php'); 
	}
	public function subCatDetails(){
		
		    $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('subcatdetails.php');
			$this->load->view('footer.php'); 
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
		  for($i=0;$i<=$number_supersubcategory-1;$i++)
	      {
	    $supersub_cat_id[]=$supersubcategory_id[$i]['id'];
		 $product=$this->db->query("select id from dev_products where super_sub_cat_id= $supersub_cat_id[$i]");
		 $product_id=$product->result_array();
		
		 $number_product_id=count($product_id);
		  
			 for($i=0;$i<=$number_product_id-1;$i++)
	         {
				  $total_product_id[]=$product_id[$i]['id'];
			 }  			 
		  }
	   }
	  
	   if($number_subcat>0 && $number_supersubcategory>0 && $number_product_id>0){
	    for($i=0;$i<=$number_product_id-1;$i++)
	     {
	     $product_delete=$this->db->query("delete  from dev_products where super_sub_cat_id= $supersub_cat_id[$i]");
		 if($product_delete)
		   {
			   for($i=0;$i<=$number_supersubcategory-1;$i++)
	              {
			      $super_delete=$this->db->query("delete  from super_sub_cat where sub_cat= $sub_cat_id[$i]");
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
	     
    $userid=$_SESSION['status']['user_id'];
	$cattable='dev_product_cat';
	$subcattable='dev_product_sub_cat';
	$supercattable='super_sub_cat';
	$business=$_GET['newbid'];
	$listid=$_GET['listid'];
	$NewBussinessCat=$this->ProductCategoryModal->GetAllCat($business);
	if($listid!='0')
	{
		$NewBussinessCatData=$this->db->query("select * from dev_product_cat where business_id=$business && listid=$listid");
		$NewBussinessCat=$NewBussinessCatData->result_array();
	}
	$bid=$_GET['bid'];
	$Cat=$this->ProductCategoryModal->GetAllCat($bid);
	foreach($NewBussinessCat as $newbusi)
	{
		array_push($prechech,$newbusi['cat_name']);
	}
	
	 for($i=0;$i<count($Cat);$i++)
	{ 
      if(!in_array($Cat[$i]['cat_name'], $prechech))
	  {
		  
      $CatArr=array('userid'=>$userid,'business_id'=>$business,'cat_name'=>$Cat[$i]['cat_name'],'image'=>$Cat[$i]['image']);
	   $Insert=$this->ProductCategoryModal->insert($cattable,$CatArr);  
	     $lastinsertcatid=$this->db->insert_id();
	   $subdata=$this->ProductCategoryModal->GetAllSubCat($Cat[$i]['id']);
	  for($j=0;$j<count($subdata);$j++)
		{
		$subcatarr=array('cat_id'=>$lastinsertcatid,'sub_cat_name'=>$subdata[$j]['sub_cat_name'],'image'=>$subdata[$j]['image']);;
		$Insert=$this->ProductCategoryModal->insert($subcattable,$subcatarr); 
		$lastinsertsubcatid=$this->db->insert_id();
		$Supersubdata=$this->ProductCategoryModal->GetAllSuperSubCat($subdata[$j]['id']);
		   for($k=0;$k<count($Supersubdata);$k++)
			{
				$superCatArr=array('sub_cat'=>$lastinsertsubcatid,'name'=>$Supersubdata[$k]['name'],'image'=>$Supersubdata[$k]['image']);
			    $Insert=$this->ProductCategoryModal->insert($supercattable,$superCatArr);
				print_r('1');
			}
		}  
	 } else{ echo "0"; }
	}
	
	
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
	$subcatid=$_GET['subcat'];
	
	 $supersubCat=$this->ProductCategoryModal->GetAllSuperSubCat($subcatid);
	
	print_r(json_encode($supersubCat)); 
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
	   if(isset($_POST['catid'])&& isset($_POST['catname']))
	   {
	   $cat_id=$_POST['catid'];
	   $cat_name=$_POST['catname'];
	 
	   $this->db->query("update dev_product_sub_cat set sub_cat_name='$cat_name' where id='$cat_id'");
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
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('CategoryInsideList.php');
			$this->load->view('footer.php'); 
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
		
  
}

