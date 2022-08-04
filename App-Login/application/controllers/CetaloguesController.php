<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class CetaloguesController extends CI_Controller {

	
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
	
	}
	public function Cetalogues(){
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
			$table="cetalouges";
			$pdffile=$_FILES['pdffile'];
			$pdfname=$pdffile['name'];
			$ext = pathinfo($pdfname, PATHINFO_EXTENSION);
			$storepdf=rand().time();
			$url=site_url().'images/cetalogues/'.$storepdf;
			$pdfdate=date("d/m/Y");
			$size=$_FILES['pdffile']['size'].'bytes';
			$productcetalog=array('name'=>$storepdf,'bussinessid'=>$bid,'url'=>$url,'size'=>$size,'date'=>$pdfdate,'sectionid'=>$sectionid,"type"=>$ext);  
			if(move_uploaded_file($pdffile["tmp_name"],"images/cetalogues/".$storepdf))
			{
				$insert=$this->CetaloguesModels->insert($table,$productcetalog);
				if($insert)
				{
					redirect('cetalogues');
				}
			}
		}else{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('cetalogues.php');
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
	public function GetCateLouges(){   //api
		$this->load->view('api/cetalougesapi.php');
	}
	
    public function categoryLists()
	{
		      $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('categoryLists.php');
			$this->load->view('footer.php');
	}

	

}
