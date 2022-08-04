<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Newcatalogcontroller extends CI_Controller {

	
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
    $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	$this->load->Model('ProductCategoryModal');
	$this->load->Model('ProductModel');
	$this->load->library('upload');
    $this->load->library('image_lib');
	$this->load->Model('CetaloguesModels');
	
	}//$route['newCetalogues'] = 'newcatalogcontroller/newCetalogues';

	public function newCetalogues(){ 
		if(isset($_SESSION['status'])){
		if(isset($_POST['uploadpdf']))
		{ 
			if(isset($_SESSION['Current_Business'])){
					 $bid=$_SESSION['Current_Business'];
				 }
				 else
				 {
					 $bid=$_SESSION['status']['business_id'];
				 }
				 $sectionid=$_REQUEST['sectionid']; 
				 
			$Edit_catalog_sectionid =$_POST['Edit_catalog_sectionid'];	
			
			 
			$shelve_id =$_POST['shelve_id'];
			$desc =$_POST['description'];	 
			$table="cetalouges";
			$pdffile=$_FILES['pdffile'];
			$pdfname=$pdffile['name'];
			$ext = pathinfo($pdfname, PATHINFO_EXTENSION);
			$storepdf=rand().time().'.'.$ext;
			$url=site_url().'images/cetalogues/'.$storepdf;
			$pdfdate=date("d/m/Y");
			$size=$_FILES['pdffile']['size'].'bytes';
			
			$Image_To_Display=$_FILES['Image_To_Display'];
			$Image_To_Display_tempname=$_FILES['Image_To_Display']['tmp_name'];
		    $Image_To_Display_imagename=$_FILES['Image_To_Display']['name'];
			
			$IMAGE_PATH=$_SERVER['DOCUMENT_ROOT'] ."/images/cetalogues/$Image_To_Display_imagename";
		     $Image_To_Display_url="https://app.pickmyorder.co.uk/images/cetalogues/$Image_To_Display_imagename";
			
			$productcetalog=array('name'=>$storepdf,'bussinessid'=>$bid,'url'=>$url,'image_to_display'=>$Image_To_Display_url,'size'=>$size,'description'=>$desc,'date'=>$pdfdate,'sectionid'=>$sectionid,'type'=>$ext);
			if(move_uploaded_file($pdffile["tmp_name"],"images/cetalogues/".$storepdf) && move_uploaded_file($Image_To_Display_tempname,$IMAGE_PATH))
			{
				$insert=$this->CetaloguesModels->insert($table,$productcetalog,$shelve_id);
				/* if($insert)
				{
				   redirect('ManageCatalogSection?id='.$shelve_id);
					
				} */
			}
		}else{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('newcatalogview.php');
			$this->load->view('footer.php');
		     }
		}
		//SESSION CHECK
			  else{ 
		redirect('dashboard');
	    }	
	}
	public function DeleteCateLouges()
	{
		$id=$_GET['id'];
		$this->CetaloguesModels->DeleteCateLouges($id);
	}
	public function newGetCateLouges(){   //api
		$this->load->view('api/newcatalogapi.php');
	}
	public function Shelves(){   //api
		$this->load->view('api/Shelves.php');
	}
	public function GetSectionByShelve(){   //api
		$this->load->view('api/GetSectionByShelve.php');
	}
	
	
    /**********************add section **************/
	public function add_section()
	{
		if(!empty($this->session->userdata('Current_Business')))
		{
			$business_id = $this->session->userdata('Current_Business');
		}else
		{
			$business_id=$_SESSION['status']['business_id'];
		}

	
		if($this->input->post('addsec'))
		{
			$bid = $this->input->post('bid');
			$section = $this->input->post('section');
			$shelvesid = $this->input->post('Shelve_id');
			
			if(!empty($_FILES['cover']['name']))
			{
				$file = $_FILES['cover'];
				$filenam = $file['name'];
				$tmpname = $file['tmp_name'];
				$ext = pathinfo($filenam, PATHINFO_EXTENSION);
				
				$storecover = rand().time().'.'.$ext;
				$url = site_url().'images/CetalogSectionCover/'.$storecover;
				if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif' )
				{
				if(move_uploaded_file($tmpname,"images/CetalogSectionCover/".$storecover))
				{
					 $data = array('business_id'=>$business_id,'section_name'=>$section,'cover_image'=>$url,'Shelves_id'=>$shelvesid);
					 $this->db->insert('dev_cetalog_section',$data);
					  $insertId = $this->db->insert_id();
		            $update_sort = $this->db->query("update dev_cetalog_section set sort_order='$insertId' where id='$insertId' ");
					 if($update_sort)
					 {
							redirect('ManageCatalogSection?id='.$shelvesid);
					 }
					 else
					 {
							redirect('ManageCatalogSection?id='.$shelvesid);
					 }
				}
				else
				{
					   redirect('ManageCatalogSection?id='.$shelvesid);
						
				}
				
				}
				else
				{
					redirect('ManageCatalogSection?id='.$shelvesid);
					
				  
				  }
			}
			else
			{
				
					
				$buisness = $this->DataModel->Select_All_business($bid);
				$business_logo = $buisness[0][bussiness_logo];
				$section = $this->input->post('section');
				$data = array('business_id'=>$bid,'section_name'=>$section,'cover_image'=>$business_logo);
				$this->db->insert('dev_cetalog_section',$data);
				redirect('ManageCatalogSection?id='.$shelvesid);
				
				
			
			}		
			
		}
	}

	//update
	public function DeleteNewCatalogSection()
	{
		$id=$_GET['id'];
		$this->CetaloguesModels->DeleteCatalogSection($id);
	}
	//show 
      public function ShowCatalogBySection()
	  {
		  if($_REQUEST['selectedid']!=0)
		  {
			  $sectionid=$_REQUEST['selectedid'];
			  $dataobj=$this->db->query("select * from cetalouges where sectionid='$sectionid'");
			  $dataarray=$dataobj->result_array();
			  echo json_encode($dataarray);
		  }
		  else
		  {
			  echo "0";
		  }
	  }
	  
	  
	  //DeleteCateLougesImg
	public function DeleteCateLougesImg (){
		$id = $_POST['id'];
		$cetalougesimg=$this->db->query("delete  from cetalouges where id='$id'");
			
	}
	
	//Edit Catalog section
	public function EditNewCatalogSection() 
	
	{
		if(isset($_POST['editsec']))
		{
	$id = $_POST['id'];
	$section = $_POST['section'];
	$Shelves_id = $_POST['Shelve_id'];

	$update=$this->db->query("update dev_cetalog_section set section_name='$section',Shelves_id='$Shelves_id' where id='$id'");
	if($update)
	{
		redirect('newCetalogues');
	}
	}else
	{
		
	        $this->load->view('header.php');
			$this->load->view('sidebar.php');
		    $this->load->view('EditCatalog.php');
		    $this->load->view('footer.php');
	}	
	
	}
	
	//Updatecatalog
	public function Updatecatalog()
	{
		
	}
	/**************************************/
	public function EditCatalogs()
	{
		 $catalog_id = $this->input->get('id');
	  
	    $cetalougesobj=$this->db->query("select * from cetalouges where id='$catalog_id'");
        $cetalougesobj= $cetalougesobj->result_array();
	   
	    $section_id=$cetalougesobj[0]['sectionid']; 
		
	    //$section_name=$this->db->query("select section_name from dev_cetalog_section where id='$section_id'");
	   // $section_name=$section_name->result_array();
		
		$section_name=$this->db->query("select id,section_name from dev_cetalog_section");
	    $section_name=$section_name->result_array();
	
	  
 
	    $data=array('key'=>$cetalougesobj,'secname'=>$section_name,'cat_id'=>$catalog_id);
		    $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('EditCetalogues.php',$data);
			$this->load->view('footer.php');
			
   }
   
   /**************************************/
     public function UploadCatalogs()
	 {  
	 
	 if(isset($_POST['uploadpdf']))
	 {
		$catalog_id = $_POST['catalog_id'];
		$url_shelvid = $_POST['url_shelvid'];
		$url_sectionid = $_POST['url_sectionid'];
		
		 $sectionid = $_POST['sectionid'];
		  $description = $_POST['description'];
		   $pdf = $_FILES['pdffile'];
		   
		  $pdf_tempname=$_FILES['pdffile']['tmp_name'];
		  $pdf_imagename=$_FILES['pdffile']['name'];
		  
		  $Image_To_Display=$_FILES['Image_To_Display'];
		  $Image_To_Display_tempname=$_FILES['Image_To_Display']['tmp_name'];
		  $Image_To_Display_imagename=$_FILES['Image_To_Display']['name'];
		  
		   $Image_To_Display_destination =$_SERVER['DOCUMENT_ROOT'] ."/images/cetalogues/$Image_To_Display_imagename";
			$Image_To_Display_url="https://app.pickmyorder.co.uk/images/cetalogues/$Image_To_Display_imagename";
			
			if($pdf_imagename == "")
		  {
			 $data = array('description'=>$description,'sectionid'=>$sectionid);
		 
			     $this->db->where('id', $catalog_id);
                $catalog_data=$this->db->update('cetalouges', $data);
				if($catalog_data)
				{
					redirect('ManageCatalogSection?id='.$url_shelvid.'&Sectionid='.$url_sectionid);
				}
		  }else
		  {
			 
			$ext = pathinfo($pdf_imagename, PATHINFO_EXTENSION);
			$storepdf=rand().time().'.'.$ext;
		
		   $pdf_destination =$_SERVER['DOCUMENT_ROOT'] ."/images/cetalogues/$storepdf";
			$pdf_url="https://app.pickmyorder.co.uk/images/cetalogues/$storepdf";
			

			 $data = array('description'=>$description,'sectionid'=>$sectionid,'url'=>$pdf_url,'type'=>$ext,'image_to_display'=>$Image_To_Display_url);
		// print_r($data);die;
		  move_uploaded_file($pdf_tempname,$pdf_destination) && move_uploaded_file($Image_To_Display_tempname,$Image_To_Display_destination);
		  
			     $this->db->where('id', $catalog_id);
                $catalog_data=$this->db->update('cetalouges', $data);
				if($catalog_data)
				{
					redirect('ManageCatalogSection?id='.$url_shelvid.'&Sectionid='.$url_sectionid);
				}
		  
           	   
		  }
		  
			
		
	  }
	  }
	  
	  /********************************/
	  public function DeleteCatalogs()
	  {
		  
		   $catalog_id = $this->input->get('id');
		   $url_shelvid = $this->input->get('shelvid');
		   $url_sectionid = $this->input->get('sectionid');
		   
		   $cetalougesimg=$this->db->query("delete  from cetalouges where id='$catalog_id'");
		   if($cetalougesimg)
		   {
			   redirect('ManageCatalogSection?id='.$url_shelvid.'&Sectionid='.$url_sectionid);
		   }
		  
	  }
	  /**************************************/
	  public function AddShelves()
	  {
		 
		  if(isset($_SESSION['Current_Business'])){
					 $bid=$_SESSION['Current_Business'];
				 }
				 else
				 {
					 $bid=$_SESSION['status']['business_id'];
				 }
		  
		 if(isset($_POST['addShelves'])) 
		 {  
		 
     		 $Table="dev_Shelves";
			 $shelves = $this->input->post('Shelves');
			 
			 $data=array('shelves_name'=>$shelves,'business_id'=>$bid);
			$insert=$this->CetaloguesModels->AddShelves($Table,$data);
		 }
		  
		  
	  }
	  
	  /***************************************/
	/*  public function FetchShelves()
	  {
		    if(isset($_SESSION['Current_Business'])){
					 $bid=$_SESSION['Current_Business'];
				 }
				 else
				 {
					 $bid=$_SESSION['status']['business_id'];
				 }
			$data	=$this->CetaloguesModels->FetchShelves($bid); 
			$senddata=array('key'=>$data);
			
			$this->load->view('newcatalogview.php',$senddata);	
				
				
				 
	  }  */
	  /*****************************/
	  public function DeleteShelves()
	  {
		  $shelves_id= $this->input->get('id');
		  
		 $this->CetaloguesModels->DeleteShelves($shelves_id);
	  
	  }
	  
	 /**************************/
      public function EditShelves()
	  {
		  $shelves_id= $this->input->get('id');
		  
		  $shelves=$this->db->query("select * from dev_Shelves where id='$shelves_id'");
        $shelves= $shelves->result_array();
		  $datasend=array('key'=>$shelves,'id'=>$shelves_id);
		  
		   $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('EditShelve.php',$datasend);
			$this->load->view('footer.php');
	  }
   /***************************/
     public function InsertEditShelve()
	 {
		 if(isset($_POST['editShelves']))
		 {
			 
			 $shelve_id = $this->input->post('shelve_id');
			 $shelves = $this->input->post('Shelves');
			 
			  $data=array('shelves_name'=>$shelves);
			 
			     $this->db->where('id', $shelve_id);
                $shelves_data=$this->db->update('dev_Shelves', $data);
				if($shelves_data)
				{
					redirect('newCetalogues');
				} 
			 
			
		 }
	 }
   /***************************/
   public function ManageCatalogSection()
   {
	    $shelve_id=$this->input->get('id');
		$Sectionid=$this->input->get('Sectionid');
		
		if($Sectionid)
		{
			
			
		$section_data=$this->db->query("select * from  dev_cetalog_section  where Shelves_id='$shelve_id' ORDER BY sort_order ");
			$section_data=$section_data->result_array();
		
		 $cat_data=$this->db->query("select * from cetalouges where sectionid='$Sectionid' ORDER BY sort_order");
         $cat_data= $cat_data->result_array();
		
		$data=array('key'=>$shelve_id,'Sectionkey'=>$section_data,'sectiondata'=>$cat_data,'selectsectionid'=>$Sectionid);
	   
		   $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ManageCatalogSection.php',$data);
			$this->load->view('footer.php');
		}
		else
		{
		$section_data=$this->db->query("select * from  dev_cetalog_section  where Shelves_id='$shelve_id' ORDER BY sort_order ");
			$section_data=$section_data->result_array();
		
		$data=array('key'=>$shelve_id,'Sectionkey'=>$section_data);
	   
		   $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('ManageCatalogSection.php',$data);
			$this->load->view('footer.php');
		}	
			
   }
   
   /**************************/
     
   /*****************************/
    public function GetSetOrderIds()
	{
		$setorderid=$_POST['setorderid'];
		$item_order=explode(',',$setorderid);
		for($i=0;$i<count($item_order);$i++)
		{
			$sortorder=$i+1;
			$id=$item_order[$i];
			$Setorder=$this->db->query("update dev_cetalog_section set sort_order='$sortorder' where id='$id'");
			
			
		}	
		if($Setorder)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
			
			
		
}
/***************************************/
public function GetSetOrderIdsCatalog()
	{
		$setorderid=$_POST['setorderid'];
		$item_order=explode(',',$setorderid);
		for($i=0;$i<count($item_order);$i++)
		{
			$sortorder=$i+1;
			$id=$item_order[$i];
			$Setorder=$this->db->query("update cetalouges set sort_order='$sortorder' where id='$id'");
			
			
		}	
		if($Setorder)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
			
			
		
}
    /***********************/
     public function GetSetOrderIdsShelve()
	{
		$setorderid=$_POST['setorderid'];
		$item_order=explode(',',$setorderid);
		for($i=0;$i<count($item_order);$i++)
		{
			$sortorder=$i+1;
			$id=$item_order[$i];
			$Setorder=$this->db->query("update dev_Shelves set sort_order='$sortorder' where id='$id'");
			
			
		}	
		if($Setorder)
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
			
			
		
}


  /*******************************/
  
  public function LockShelve()
  {
	  $checkids=$_POST['checkids'];
	  $ids_data= implode(",",$checkids);
	  
	  $uncheckids=$_POST['uncheckids'];
	  $uncheck_ids= implode(",",$uncheckids);
	  
	  
    if($ids_data!='')
	{
		$update_data=$this->db->query("update dev_Shelves set lock_shelves=1 where id in ($ids_data) ");
			  
	}
	if($uncheck_ids!='')
	{
		$update_data=$this->db->query("update dev_Shelves set lock_shelves=0 where id in ($uncheck_ids) ");
	}
        if($update_data)
			 {
				 echo "1";
			 }
			else
				 {
					 echo "0";
				 }		 
	  
  }
  
  
}