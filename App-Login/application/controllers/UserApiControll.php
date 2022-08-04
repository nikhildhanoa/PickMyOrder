<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class UserApiControll extends CI_Controller {

	
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
     $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	}
  public function UserAccount(){
	 
	 $this->load->view('api/AccountDetails.php');
  }
   public function UserBillingDetails(){
	 
	 $this->load->view('api/EngineerBillingDetails.php');
  }
  
    public function EngineerDeleveryDetails()
	{
		$this->load->view('api/EngineerDeleveryDetails.php');
	}
   public function ChangePassword(){
	   
	    $this->load->view('api/ChangePassword.php');
   }
    public function AppLogout(){
	   
	    $this->load->view('api/UserAppLogout.php');
   }
   public function SendSellersToApp()
   {
	    $this->load->view('api/SendSellersToApp.php');
   }
   public function SendCityList()
   {
	    $this->load->view('api/SendCityList.php');
   }
    public function MakeAPayment() 
   {
	    $this->load->view('api/PaymentApi.php');
   }
    public function UserCards() 
   {
	    $this->load->view('api/GetCard.php');
   }
     public function RemoveCard() 
   {
	    $this->load->view('api/RemoveCard.php');
   }
    public function AddCard() 
   {
	    $this->load->view('api/AddCard.php');
   }
   /*send user to atrdeya*/
      public function SendUser() 
   {
	   $this->load->view('AtradeyaApi/GetUserDetails');
   }
   
   
   
   /************edit from app*************/
  public function EditBillingAndShipping()
  {
      $this->load->view('api/EditBillingAndShipping.php');
  }
  public function NewGetVanOrder()
  {
      $this->load->view('api/NewGetVanOrder.php');
  }
  
  public function orderone()
  {
	  $this->load->view('api/orderone.php');
  }
  
   public function AddToStock()
  {
	  $this->load->view('api/AddToStock.php');
  }
  
  public function VanStockReorder()
  {
	  $this->load->view('api/VanReorder.php');
  }
  
  public function AddVanReorder()
  {
	  $this->load->view('api/AddVanReorder.php');
  }
   
  public function ListM8ServiceStaff()
  {
	  $this->load->view('api/ListM8ServiceStaff.php');
  }
  
  public function CheckUserExist()
  {
	  $this->load->view('api/CheckUserExist.php');
  }
  
  public function GetBrands()
  {
	  $this->load->view('api/GetBrands.php');     
  }
  
   public function GetBrandCategory()
  {
	  $this->load->view('api/GetBrandCategory.php');     
  }
  
  public function GetAllAdvertisment()
  {
	  $this->load->view('api/GetAllAdvertisment.php');     
  }
  
  public function GetWholesalercategory()
  {
	  $this->load->view('api/GetWholesalercategory.php');     
  }
  
}
