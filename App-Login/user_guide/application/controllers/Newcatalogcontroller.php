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
			$desc =$_POST['description'];	 
			$table="cetalouges";
			$pdffile=$_FILES['pdffile'];
			$pdfname=$pdffile['name'];
			$ext = pathinfo($pdfname, PATHINFO_EXTENSION);
			$storepdf=rand().time();
			$url=site_url().'images/cetalogues/'.$storepdf;
			$pdfdate=date("d/m/Y");
			$size=$_FILES['pdffile']['size'].'bytes';
			$productcetalog=array('name'=>$storepdf,'bussinessid'=>$bid,'url'=>$url,'size'=>$size,'description'=>$desc,'date'=>$pdfdate,'sectionid'=>$sectionid,'type'=>$ext);
			if(move_uploaded_file($pdffile["tmp_name"],"images/cetalogues/".$storepdf))
			{
				$insert=$this->CetaloguesModels->insert($table,$productcetalog);
				if($insert)
				{
					redirect('newCetalogues');
				}
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
    /**********************add section **************/
	public function add_section()
	{
		if($this->input->post('addsec'))
		{
			$bid = $this->input->post('bid');
			$section = $this->input->post('section');
			if(!empty($_FILES['cover']['name']))
			{
				$file = $_FILES['cover'];
				$filenam = $file['name'];
				$tmpname = $file['tmp_name'];
				$storecover = rand().time();
				$url = site_url().'images/CetalogSectionCover/'.$storecover;
				
				if(move_uploaded_file($tmpname,"images/CetalogSectionCover/".$storecover))
				{
					 $data = array('business_id'=>$bid,'section_name'=>$section,'cover_image'=>$url);
					 $this->db->insert('dev_cetalog_section',$data);
					 if($this->db->affected_rows())
					 {
							redirect('newCetalogues');
					 }
					 else
					 {
							redirect('newCetalogues');
					 }
				}
				else
				{
						redirect('newCetalogues');
				}
			}
			else
			{
				
					
				$buisness = $this->DataModel->Select_All_business($bid);
				$business_logo = $buisness[0][bussiness_logo];
				$section = $this->input->post('section');
				$data = array('business_id'=>$bid,'section_name'=>$section,'cover_image'=>$business_logo);
				$this->db->insert('dev_cetalog_section',$data);
				redirect('newCetalogues');
				
				
			
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
	        $this->load->view('header.php');
			$this->load->view('sidebar.php');
		    $this->load->view('EditCatalog.php');
		    $this->load->view('footer.php');
			
	
	}
	
	//Updatecatalog
	public function Updatecatalog(){
	$id = $_POST['cid'];
	$section = $_POST['section'];
	//$filename = $_FILES['file']['name'];
	//echo $filename;
	$this->db->query("update dev_cetalog_section set $section='section_name' where id=$id");
	
	}
}