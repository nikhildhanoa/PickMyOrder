<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
     $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	$this->load->Model('ProductCategoryModal');
	$this->load->library('upload');
    $this->load->library('image_lib');
	}
	public function GetAllBusiness()
	{
		$AllData=$this->DataModel->Select_All_business(0);
		echo json_encode($AllData);
		
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
	public function login()
	{
		if($this->input->post('login'))
		{
			
			 $email=$this->input->post('email');
			 $passw = $this->input->post('password');
			 $pass = $passw;
	         $que=$this->db->query("select * from dev_users where email='".$email."' and password='".$pass."' ");
			 $result = $que->result_array();
			 if($result)                 //enter in if email and password exsist
			 {
			 foreach($result as $userdata)
			 {
				$user_id= $userdata['id'];
				$user_name= $userdata['user_name'];
				$email=$userdata['email'];
				$business_id=$userdata['business_id'];
				$superadmin_status=$userdata['permission_super_Admin'];
				$role=$userdata['role'];
				$iswholseller=$userdata['permission_wholeseller'];
			 }
			 
			$session_array=array('user_id'=>$user_id,'business_id'=>$business_id,'name'=>$user_name,'email'=>$email,'superadmin_status'=>$superadmin_status,'role'=>$role,'iswholseller'=>$iswholseller);
			
			
				$_SESSION['status']= $session_array;
			
				
					$table='dev_users';
					$time=date("h:i:sa");
					$date=date("Y/m/d");
					$upd=$date.' '.$time;
					$where=array('email'=>$email,'password'=>$pass);
					$data=array('last_login'=>$upd);
					$this->DataModel->update($table,$data,$where);
					redirect('dashboard');
			}
			else
			{
				redirect('index');
			}	
		}
		else
		{
			if(isset($_SESSION['status'])){
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('dashboard.php');
			$this->load->view('footer.php');
			
			}else
			{
				redirect('index');
			}	
		}
	}
	
  public function Adminloginbysuperadmin()
  {
	  $Adminuserz_id=$_GET['id'];
	  $queadmin=$this->db->query("select * from dev_users where id= $Adminuserz_id ");
		$result = $queadmin->result_array();
			foreach($result as $admindetails)
			{
				$useradmin_id=$admindetails['id'];
				$useradmin_name=$admindetails['user_name'];
				$useradmin_email=$admindetails['email'];
				$business_id=$admindetails['business_id'];
				$useradmin_pass=$admindetails['password'];
				$superadmin_status=$admindetails['permission_super_Admin'];
				$role=$admindetails['role'];
				$iswholseller=$admindetails['permission_wholeseller'];
			}
			
			if($result)
			{ 
				unset($_SESSION['status']);
				$admin_sesion_again=array('user_id'=>$useradmin_id,'business_id'=>$business_id,'name'=>$useradmin_name,'email'=>$useradmin_email,'superadmin_status'=>$superadmin_status,'role'=>$role,'iswholseller'=>$iswholseller);
				
				$_SESSION['status']=$admin_sesion_again;
				
					$table='dev_users';
					$time=date("h:i:sa");
					$date=date("Y/m/d");
					$upd=$date.' '.$time;
					$where=array('password'=>$useradmin_pass,'email'=>$useradmin_email);
					$data=array('last_login'=>$upd);
					$this->DataModel->update($table,$data,$where);
					
					redirect('dashboard');
			}
			else
			{
				redirect('index');
			}	
	  
	}
	 
	public function index()
	{
	   
$this->load->view('login-v1.php');
	/* $this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('dashboard.php');
		$this->load->view('footer.php'); */
	}
	public function business()
	{
		
		
			if(isset($_SESSION['status']))
			{
				if($_SESSION['status']['superadmin_status']=='1')
				{
					$this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('business.php');
					$this->load->view('footer.php');
				} 
				else
				{
					redirect('dashboard');
					 
				}
			}
			else
			{
				redirect('dashboard');
			}
		
		
	
	}
	public function users(){
		if($this->input->post('submit'))
		{
			$this->load->view('login-v1.php');
		}
		else
		{
			 if($this->input->post('Insert_user'))
			 {
				 
				 $nick_name= $this->input->post('Name');
				 $user_name= $this->input->post('uname');
				 $email= $this->input->post('email');
				 $pass = $this->input->post('Password');
				 $password = $pass;
				 $confirmpass= $this->input->post('Conpass');
				 $assign_buss=$this->input->post('Buisness');
			
				
				  if($this->input->post('Full'))
				 {
					 $p1=1;
				 }else{$p1=0;}
				  if($this->input->post('Products')){
					 $p2=1;
				 }else{$p2=0;}
				 if($this->input->post('Orders')){
					 $p3=1; 
				 }else{$p3=0;}
				 if($this->input->post('Suppliers')){
					 $p5= 1;
				 }else{$p5=0;}
				  if($this->input->post('Engineers')){
					$p6= 1;
				 }else{$p6=0;}
				  if($this->input->post('Projects')){
					 $p7=1;
				 }else{$p7=0;}
				  if($this->input->post('Catologes')){
					$p8= 1;
				 }else{$p8=0;}
				if($this->input->post('Categories')){
					  $p9= 1;
				 }else{$p9=0;}
				 if( $this->input->post('Notifications')){
					$p10= 1;
				 }else{$p10=0;}
				  if($this->input->post('Super_Admin')){
					 $p11=1;
					 $role='1';
				 }else{$p11=0; $role='2';}
				 if($this->input->post('Wholesaler_App'))
				 {
					 $p12=1;
					 
				 }
				 else
				 {
					$p12=0; 
					 
				 }
				  if($this->input->post('Stores'))
				 {
					 $p13=1;
					 
				 }
				 else
				 {
					$p13=0; 
					 
				 }
				  if($this->input->post('deleverycost'))
				 {
					 $p14=1;
					 
				 }
				 else
				 {
					$p14=0; 
					 
				 } 
				 if($this->input->post('quotes'))
				 {
					 $p15=1;
					 
				 }
				 else
				 {
					$p15=0; 
					 
				 }
				 
				 $result_bussiness=$this->db->Query('select id from dev_business where business_name="'.$assign_buss.'"');
				 $result_bussiness=$result_bussiness->result_array();
				 $bid=0;
				 if( $result_bussiness)
				 {
				 $bid=$result_bussiness[0]['id'];
				 }
				 else
				 {
					 $assign_buss='0';
				 }
				
                $arr=array('person_name'=>$user_name,'user_name'=>$nick_name,'business_id'=>$bid,'email'=>$email,'password'=>$password,'business'=>$assign_buss,'role'=>$role,'permission_full'=>$p1,'permission_products'=>$p2,'permission_orders'=>$p3, 'permission_suppliers'=>$p5, 'permission_engineers'=>$p6,'permission_projects'=>$p7,'permission_categories'=>$p9,'permission_notifications'=>$p10,'permission_super_Admin'=>$p11,'permission_wholeseller'=>$p12,'permission_store'=>$p13,'permission_deleverycost'=>$p14,'permission_quotes'=>$p15);
    
				$table='dev_users';
	
					 $insert_user = $this->DataModel->insert($table,$arr);
					 if($insert_user)
			            {
				          redirect('users');
			            }
					  else
					    {
					      redirect('users');
                        }
				
			 }
			 else
			 {
				 if(isset($_SESSION['status'])){
				
					  if($_SESSION['status']['superadmin_status']=='1'){
			
				$this->load->view('header.php');
				
			$this->load->view('sidebar.php');
		
			$this->load->view('users.php');
			 $this->load->view('footer.php');
					  } else{
					 redirect('dashboard');
					 
				 }
				 }
				 else{
					 redirect('dashboard');
					 
				 }
			 }
		}
	}
	public function Suppliers(){
		 if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		
		$this->load->view('Suppliers.php');
		$this->load->view('footer.php');
		 }else{
			 redirect('dashboard');
		 }
	}

	public function Projects(){
		 if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		
		$this->load->view('Projects.php');
		$this->load->view('footer.php');
		 }else{
			 redirect(dashboard);
		 }
	}
	public function Cetalogues(){
		if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		
		$this->load->view('cetalogues.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
	}
	
	
	public function Category(){
		if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		
		$this->load->view('category.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
	}
	
	public function Editbusiness()
	{
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('Edit_business.php');
		$this->load->view('footer.php');
		
		if($this->input->post('update_Busi'))
		{
			  $imgdata=$_POST['logoimage'];
			if(!empty($_POST['logoimage']))
			{
		       
			   $dataencod= explode(',', $imgdata);
			   $datadecode = base64_decode($dataencod[1]);
			   $dynamicname=time()+rand().'.png';
			  
				if(file_put_contents("./images/applogo/$dynamicname",$datadecode))
				{
					$image_url="https://stagingapp.pickmyorder.co.uk/themeCustomization/images/applogo/$dynamicname";
					
				}
				else
				{
					$image_url="";
				}
			}
			$business_id= $this->input->post('hid');
			$business_name= $this->input->post('Business_Name');
			$business_address= str_replace(",","-",$this->input->post('address'));
			$business_city= $this->input->post('city');
			$business_postcode= $this->input->post('PostCode');
			$business_Email= $this->input->post('Email');
			$business_contact_name= $this->input->post('Contact_Name');
			$business_contact_number= $this->input->post('Contact_Number');
			$business_acc_name= $this->input->post('Acc_Contact_Name');
			$business_acc_address= str_replace(",","-",$this->input->post('acc_address'));
			$business_acc_city= $this->input->post('acc_city');
			$business_acc_PostCode= $this->input->post('PostCode');
			$business_acc_email= $this->input->post('acc_email');
			$business_acc_number= $this->input->post('acc_Number');
			$business_acc_vatnumber= $this->input->post('VAT_Number');
			$Supplier_email= $this->input->post('Supplier_email');
			
		   if($this->input->post('app_active_status'))
			{
				$App_status=1;
			}
			else
			{
				$App_status=0;
			}
		
				if($this->input->post('iswholeapp'))
			{
			$wholesalerApp=1;
			}
			else if($this->input->post('contractorApp'))
			{
				$wholesalerApp=0;
			}
			else
			{
				$wholesalerApp=2;
			}
			if($this->input->post('DedicateAccount'))
			{
				$dedicate=1;
				$Secretkey=$this->input->post('Secretkey');
				$Publishkey=$this->input->post('Publishkey');
				$stripe_user_id=0; 
				$isconnected=0;

			}
			else
			{
				$dedicate=0;
				$Secretkey=0;
				$Publishkey=0;
				$stripe_user_id=0; 
				$isconnected=0;
			}
			if($this->input->post('wholesalerpage'))
			{
			$wholesalerpage=1;
			}
			else
			{
				$wholesalerpage=0;
			}
			
			
				
				
				$query1="UPDATE `dev_business` SET `business_name`='$business_name',`address`='$business_address',`city`='$business_city',`post_code`='$business_postcode',`email`='$business_Email',`contact_name`= '$business_contact_name',`contact_number`='$business_contact_number',`supplier_email`='$Supplier_email',`app_status`='$App_status', `bussiness_logo`='$image_url',`iswholeapp`='$wholesalerApp',`iswholpageview`='$wholesalerpage',`isdedicate`='$dedicate',`stripe_secretkey`='$Secretkey',`stripe_publishkey`='$Publishkey',`stripe_user_id`='$stripe_user_id',`isconnected`='$isconnected' WHERE id='$business_id'";
				$resu = $this->db->query($query1);
			
				$query2="UPDATE `dev_account` SET `business_id`='$business_id',`contact_name`='$business_acc_name',`address`='$business_acc_address',`acc_city`='$business_acc_city',`post_code`='$business_acc_PostCode',`email`='$business_acc_email',`contact_number`='$business_acc_number',`vat_number`='$business_acc_vatnumber' WHERE business_id='$business_id'";
			 
				if($resu)
				{
					$resu2 = $this->db->query($query2);
				}
				if( $resu2)
				{
					redirect('business');
				} 
			
			
		} 
		
		
	}
	public function Editusers(){
			
			if($this->input->post('update_user'))
			 {
			  
				 $nick_name= $this->input->post('Name');
				 $user_name= $this->input->post('uname');
				 $email= $this->input->post('email');
				 $password= $this->input->post('Password');
				 $confirmpass= $this->input->post('Conpass');
				 $assign_buss=$this->input->post('Buisness');
				 $udi=$this->input->post('hiduser');
				$Bussiness_id= $this->DataModel->Get_Business_id($assign_buss);
				  if($this->input->post('Full'))
				 {
					 $p1=1;
				 }else{$p1=0;}
				  if($this->input->post('Products')){
					 $p2=1;
				 }else{$p2=0;}
				 if($this->input->post('Orders')){
					 $p3=1; 
				 }else{$p3=0;}
				 if($this->input->post('Suppliers')){
					 $p5= 1;
				 }else{$p5=0;}
				  if($this->input->post('Engineers')){
					$p6= 1;
				 }else{$p6=0;}
				  if($this->input->post('Projects')){
					 $p7=1;
				 }else{$p7=0;}
				  if($this->input->post('Catologes')){
					$p8= 1;
				 }else{$p8=0;}
				if($this->input->post('Categories')){
					  $p9= 1;
				 }else{$p9=0;}
				 if( $this->input->post('Notifications')){
					$p10= 1;
				 }else{$p10=0;}
				  if($this->input->post('Super_Admin')){
					 $p11=1;
				 }else{$p11=0;}
				 if($this->input->post('Wholesaler_App')){
					 $p12=1;
				 }else{$p12=0;}
				 	  if($this->input->post('Stores'))
				 {
					 $p13=1;
					 
				 }
				 else
				 {
					$p13=0; 
					 
				 }
				  if($this->input->post('deleverycost'))
				 {
					 $p14=1;
					 
				 }
				 else
				 {
					$p14=0; 
					 
				 }
				  if($this->input->post('quotes'))
				 {
					 $p15=1;
					 
				 }
				 else
				 {
					$p15=0; 
					 
				 }
				
                $arr=array('business_id'=>$Bussiness_id,'person_name'=>$nick_name,'user_name'=>$user_name,'email'=>$email,'password'=>$password,'business'=>$assign_buss,'permission_full'=>$p1,'permission_products'=>$p2,'permission_orders'=>$p3, 'permission_suppliers'=>$p5, 'permission_engineers'=>$p6,'permission_projects'=>$p7,'permission_catologes'=>$p8,'permission_categories'=>$p9,'permission_notifications'=>$p10,'permission_super_Admin'=>$p11,'permission_wholeseller'=>$p12,'permission_store'=>$p13,'permission_deleverycost'=>$p14,'permission_quotes'=>$p15);
				            
				$table='dev_users'; 
			    $where=array('id'=>$udi);

				//	print_r($where);die;
					$update_user=$this->DataModel->update($table,$arr,$where);
					
				 if($this->db->affected_rows() > 0)
				 {
					 redirect('users');
				 }
				 else
				 {
					 echo "<script>alert('Not Update');window.location.replace('users');
</script>"; 
				 }
	
				
			
			}
			else{
			
		   $this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('Edit_users.php');
			$this->load->view('footer.php'); 
			}
				
			 
		
	}
	public function User_verification(){
	$this->load->view('api/login.php');
		
		
	}
   public function ForgotPassword(){
	   
	   	$this->load->view('api/forgotpassword.php');
	   
   }
   
   public function Fetch_products(){
	   
	   	$this->load->view('api/Fetch_products.php');
	   
   }
  
   public function Remove(){             //delete business and user 
	   $Row_id=$_GET['id'];
	   $type=$_GET['type'];
	   if($type=='users')
	   {
		   $table='dev_users';
		   $url = 'users';
		}
	   if($type=='business')
	   {
	    $table='dev_business';
		   $url = 'business';
	   }
	   $del=$this->DataModel->delete($table,$Row_id);
	   if($del)
		{
			$table="dev_account";
			$Row_id=$Row_id;
			 $delaccount=$this->db->query("delete from dev_account where business_id=$Row_id");
			 if($delaccount){
			 redirect($url);}
		}
	   
   }
   /**********************Functions for Set current bussiness Session************/ 
   public function Set_Business_Session()
   {
		$CB=$_REQUEST['CB'];
		if($CB!=0){
		$_SESSION['Current_Business']=$CB;
		if(isset($_SESSION['Current_Business']))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
		}else{
			unset($_SESSION["Current_Business"]);
			echo '1';
		}
   }
   /********************************check user exsist or not******************************/
   public function CheckUserExsist()
   {
	   $email=$_REQUEST['useremail'];
	   $check_user_exsist=$this->db->query("select *from dev_users where email='$email'");
	   $check_user_exsist=$check_user_exsist->result_array();
	   if($check_user_exsist)
	   {
		   echo "1";
       }
	   else
	   {
		   echo "0";
	   }
   }
   public function SendNotification()
   {
	   
	  if(isset($_POST['send']))
	  { 
		   //send notification to all users of this businees
			$Busines_id=$this->input->post('bidinhid');
			
			$body=$this->input->post('msg');	
			
		    $mydevices=$this->db->query("select deviceid from dev_users where role='3' && from_bussi='$Busines_id'");
		
    $myiosdevices=$this->db->query("select iosdeviceid from dev_users where role='3' && from_bussi='$Busines_id'");
		
			if($Busines_id=='0')
			{
			    $mydevices=$this->db->query("select deviceid from dev_users where role='3'");
				$myiosdevices=$this->db->query("select iosdeviceid from dev_users where role='3'");
				
			}
			$devices=$mydevices->result_array();
			
			$iosdeviceid=$myiosdevices->result_array();
			
			if($Busines_id=='1')
			{
				$company='led';
			}
			if($Busines_id=='2')
			{
				$company='pick';
			}
			if($Busines_id=='3') 
			{
				$company='spark';
			}
			if($Busines_id=='0') 
			{
				$company='pick';
			}
			$result = $this->DataModel->send_notification($devices,$body,$company); 
			
			 $resultios = $this->DataModel->send_ios_notification($iosdeviceid,$body);
			
			$this->session->set_flashdata('send','Notification send successfully'); 
			$this->load->view('header.php');
	        $this->load->view('sidebar.php');
	        $this->load->view('Notifictions.php');
	        $this->load->view('footer.php');
			
	  }
	  else
	  { 
		if(isset($_SESSION['status']['user_id']))
			{
			   $this->load->view('header.php'); 
			   $this->load->view('sidebar.php');
			   $this->load->view('Notifictions.php');
				$this->load->view('footer.php'); 
			}else{
				$this->load->view('login-v1.php');
			}
	  }
   }
   public function CategoryTransfer()
   {
	   if(isset($_SESSION['status']['user_id']))
			{
				$this->load->view('header.php');
			   $this->load->view('sidebar.php');
			   $this->load->view('BussinessCategoryCopy.php');
				$this->load->view('footer.php'); 
			}else{
				
				$this->load->view('login-v1.php');
					
			}
   }
    public function CategoriesListTransfer()   // transfer with list view 
   {
	    $this->load->view('header.php');
	   $this->load->view('sidebar.php');
	   $this->load->view('CategoriesListTransfer.php');
	    $this->load->view('footer.php'); 
   }
  public function wholesaler()
   {
	   if(isset($_SESSION['status']['user_id']))
		{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('WholeSellerEnginer.php');
			$this->load->view('footer.php');
		} else{
			$this->load->view('login-v1.php');
		}
   }
   public function StripeConnect()
   {
	   $bussinessid=$_SESSION['status']['business_id'];
		$select_single_business_query="select * from dev_business where id='$bussinessid'";
		$select_single_business1=$this->db->query($select_single_business_query);
		$select_singleres=$select_single_business1->result_array();
		$select_single= $select_singleres[0]['isdedicate'];
		$pre_connected= $select_singleres[0]['stripe_user_id'];
		 
		  if(isset($_GET['code']))
		  {
			  $code=$_GET['code'];
			  $curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://connect.stripe.com/oauth/token",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "grant_type=authorization_code&code=$code",
				  CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer sk_test_aE1Lwti0twn6RyEpNH9cXDi9",
					"Content-Type: application/x-www-form-urlencoded",
					"Cookie: machine_identifier=dkPp9dXX06PAiT9LkDP7j1CgP8oH%2BuFeC0irGqLYv1UXjB6GWVJxLhKhfUYfeJ6%2FNw8%3D; private_machine_identifier=VdCwjh8gBIXpeBQ%2BC2a17khnMXaElAFY7PAk2yPnXX5LtJUX7B9zZNcLj43jtsVESPg%3D; __stripe_orig_props=%7B%22referrer%22%3A%22%22%2C%22landing%22%3A%22https%3A%2F%2Fconnect.stripe.com%2Foauth%2Ftoken%22%7D"
				  ),
				));

				$response = curl_exec($curl);
                curl_close($curl);
				$result=json_decode($response);
				 if($result->error)
				{
					
					$data=array('error'=> $result->error_description,'button'=>$select_single);
					$this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('StripeConnect.php',$data);
					$this->load->view('footer.php');  
				} 
				else
				{
					$stripe_user_id=$result->stripe_user_id;
					$bussinessid=$_SESSION['status']['business_id'];
					$this->db->query("update dev_business set stripe_user_id='$stripe_user_id' , isconnected='1' where id=$bussinessid");
					if($this->db->affected_rows())
					{
					$data=array('error'=>'Connected Successfully','button'=>$select_single,'preconnect'=>1);
					$this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('StripeConnect.php',$data);
					$this->load->view('footer.php');  
					}
					else
					{
					$data=array('error'=>'Updated ','button'=>$select_single);
					$this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('StripeConnect.php',$data);
					$this->load->view('footer.php');  
					}
				}
				
				 
				
		  }
		  else if(isset($_GET['error']))
		  {
			  $data=array('error'=>$_GET['error'],'button'=>$select_single);
			  $this->load->view('header.php');  
			  $this->load->view('sidebar.php');
			  $this->load->view('StripeConnect.php',$data);
			  $this->load->view('footer.php');
		  }    
		  else if(isset($_POST['Disconnect']))
		  {
			  $this->db->query("update dev_business set stripe_user_id='0' , isconnected='0' where id=$bussinessid");
			  $data=array('button'=>$select_single,'preconnect'=>0);
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('StripeConnect.php',$data);
			  $this->load->view('footer.php');  
		  } 
          else
		  {
			  if(isset($_SESSION['status']['user_id']))
			{
			  $data=array('button'=>$select_single,'preconnect'=>$pre_connected);
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('StripeConnect.php',$data);
				$this->load->view('footer.php'); 
			}else{
				$this->load->view('login-v1.php');
			} 
		  }			  
		  
   }
   //Add New Bussiness in new Theme 
   public function AddNewBusiness()
   {
	   if($this->input->post('Insert_Busi'))
		{
			$imgdata=$_POST['logoimage'];
			if(!empty($_POST['logoimage']))
			{
		       
			   $dataencod= explode(',', $imgdata);
			   $datadecode = base64_decode($dataencod[1]);
			   $dynamicname=time()+rand().'.png';
			  
				if(file_put_contents("./images/applogo/$dynamicname",$datadecode))
				{
					$image_url="https://stagingapp.pickmyorder.co.uk/themeCustomization/images/applogo/$dynamicname";
					
				}
				else
				{
					$image_url="";
				}
			}
			$business_name= $this->input->post('Business_Name');
			$business_address= str_replace(",","-",$this->input->post('address'));
			$business_city= $this->input->post('city');
			$business_postcode= $this->input->post('PostCode');
			$business_Email= $this->input->post('Email');
			$business_contact_name= $this->input->post('Contact_Name');
			$business_contact_number= $this->input->post('Contact_Number');
			$business_acc_name= $this->input->post('Acc_Contact_Name');
			$business_acc_address= str_replace(",","-",$this->input->post('acc_address'));
			$business_acc_city= $this->input->post('acc_city');
			$business_acc_PostCode= $this->input->post('PostCode');
			$business_acc_email= $this->input->post('acc_email');
			$business_acc_number= $this->input->post('acc_Number');
			$business_acc_vatnumber= $this->input->post('VAT_Number');
			$Supplier_email= $this->input->post('Supplier_email');
			if($this->input->post('app_active_status'))
			{
				$App_status="1";
			}
			else
			{
				$App_status="0";
			}
			
			
			
			if($this->input->post('iswholeapp'))
			{
			$wholesalerApp=1;
			}
			else if($this->input->post('contractorApp'))
			{
				$wholesalerApp=0;
			}
			else
			{
				$wholesalerApp=2;
			}
			
			if($this->input->post('DedicateAccount'))
			{
				$dedicate=1;
				$Secretkey=$this->input->post('Secretkey');
				$Publishkey=$this->input->post('Publishkey');

			}
			else
			{
				$dedicate=0;
				$Secretkey=0;
				$Publishkey=0;
			}
			if($this->input->post('wholesalerpage'))
			{
			$wholesalerpage=1;
			}
			else
			{
				$wholesalerpage=0;
			}
			//$image=$_FILES['business_logo'];
			//$image_name_1=$_FILES['business_logo']['name'];
		   // $image_url=$this->UpdateUrlMethod().'/images/applogo/'.$image_name_1;
			// $image_url=str_replace(' ', '',$image_url);
			//if(move_uploaded_file($image["tmp_name"],"images/applogo/".$image_name_1))	
			//{	
		    
		         
				$data=array($business_name,$business_address,$business_postcode,$business_Email,$business_contact_name,$business_contact_number,$business_acc_name,$business_acc_address,$business_acc_PostCode,$business_acc_email,$business_acc_number,$business_acc_vatnumber,$Supplier_email,$App_status,$business_city,$business_acc_city,$image_url,$wholesalerApp,$wholesalerpage,$dedicate,$Secretkey,$Publishkey);
				
				$insert_buisness = $this->DataModel->Add_business($data);
				if($insert_buisness)
				{
					redirect('business');
				}
		
			//}
				
		}
		else
		{
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('AddBusiness.php');
			  $this->load->view('footer.php'); 
		}
   }
  public function deletelogo(){   
	  $id=$_POST['id'];
	  $this->db->query("update dev_business  set bussiness_logo='' where id='$id'");
	  if($this->db->affected_rows())
	  {
		  echo 1;
	  }
	  else
	  {
		  echo 0;
	  }
  }
  /******************Print User Table ***************************/
  public function PrintHtmlTable()
  {
	  $dataObj=$this->db->query("select * from  dev_business");
	  $data=$dataObj->result_array();
	  $viewSend=array('values'=>$data);
	  $this->load->view('PrintableTable.php',$viewSend);
  }
  /******************Print pdf Table ***************************/
  public function PrintPdfTable()
  {
	  $dataObj=$this->db->query("select * from  dev_business");
	  $data=$dataObj->result_array();
	  $viewSend=array('values'=>$data);
	  $this->load->view('GenratePdf.php',$viewSend);
  }
  // make csv file 
  public function makeCsvFile()
  {
		$dataObj=$this->db->query("select * from  dev_business");
		$data=$dataObj->result_array();
		
		 	  // Create an array of elements 
		$list = array(array('Business ID','Business Name','Email','Type','Status')); 
		foreach($data as $d)
		{
			if($d['iswholeapp']=='0')
			{
				$type='Contractor App';
			}
			if($d['iswholeapp']=='1')
			{
				$type='Wholesaler App';
			}
			if($d['iswholeapp']=='2')
			{
				$type='Invoice Management';
			}
			if($d['app_status']=='1')
			{
				$active="Active";
			}
			else
			{
				$active="De-Active";
			}
			array_push($list,array($d['id'],$d['business_name'],$d['email'],$type,$active));
		}
		
		 // Open a file in write mode ('w') 
		$fp = fopen('./images/csv/users.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/users.csv"; 	
        $file_name = basename($url);  
		$info = pathinfo($file_name); 
        if ($info["extension"] == "csv") 
		{ 
			/* Informing the browser that 
			the file type of the concerned 
			file is a MIME type (Multipurpose 
			Internet Mail Extension type). 
			Hence, no need to play the file 
			but to directly download it on 
			the client's machine. */
			header("Content-Description: File Transfer");  
			header("Content-Type: application/octet-stream");  
			header( 
			"Content-Disposition: attachment; filename=\""
			. $file_name . "\"");   
			readfile ($url); 
		}  		
  }
}
