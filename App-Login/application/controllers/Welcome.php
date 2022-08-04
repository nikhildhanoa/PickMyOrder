<?php error_reporting(1);
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
	$this->load->Model('VpsModel');
    $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	$this->load->Model('CommonModel');
	$this->load->Model('ProductCategoryModal');
	$this->load->library('upload');
    $this->load->library('image_lib');
	$this->load->library('session');
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
	public function GetAllBusiness()
	{
		  if(isset($_SESSION['Current_Business']))
		   {
			   $bid=$_SESSION['Current_Business'];
		   }
		  else
		  {
			  // $bid=$_SESSION['status']['business_id'];
			  $bid=0;
		  }
		$AllData=$this->DataModel->Select_All_business($bid);
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
		
		
	public function SendDataToDashboard()
    {
		
		//********** LAST ISSUED INVOICES start ***********///
		
		$this->db->select('vendor_name,total,order_number,Import_date,Attachment');
		$this->db->from('dev_NylasUsersAttachments ');
		$this->db->where('pdftype',2);
		$this->db->where('business_id ',$this->BusinessIdFunction());
		$this->db->order_by("id", "DESC");
		$this->db->limit(10);
		$result = $this->db->get()->result_array();
		
		  if(!empty($result))
		  { 
		    $blank_html='';
		    foreach($result as $single_result)
			{
				$date = $single_result['Import_date'];
				$date=str_replace('/','-',$date);
				 
				$date= strtotime($date);
				$currnet_date = strtotime(date('Y-m-d'));
                $datediff = $currnet_date - $date;
				$count_days = floor($datediff / (60 * 60 * 24)); 
				 
				$blank_html.= '<div class="timeline-item align-items-start">
														
					<div class="timeline-badge">
						<i class="fa fa-genderless text-primary icon-xl"></i>
					</div>
					<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
						<div class="dim pb-2">'.$count_days.' Days ago</div>
						<div class="dark"> <span class="font-weight-bolder text-dark-75 font-size-lg">'.$single_result['vendor_name'].'</span></div>
						
						
						<div class="dim"><span>Order No.: <a href="'.$single_result['Attachment'].'" target="_blank">'.$single_result['order_number'].'</a>   </span> <span> Value: £'.$single_result['total'].'</span></div>
					</div>								
					</div>';
				
			}
		       
		  }
		  else
		  {
			  $blank_html='NO Record Found';
		  }
          
		  //********** LAST ISSUED INVOICES end ***********///
		  
		   //********** top product start ***********///
		   
		 if(!isset($_SESSION['Current_Business']))
			   {
				   $bid=0;
			   }
			  else
			  { 
				    $bid=$_SESSION['Current_Business'];
			  }
			  
		 
		 if($bid=='0')
		   {
			    $que=$this->db->query("SELECT product_id, count(*) count1, dev_products.title,dev_products.products_images FROM `dev_single_order`,dev_products where dev_products.id=product_id group by product_id order by count1 desc limit 12");
		   }else
		   {
			     $que=$this->db->query("SELECT product_id, count(*) count1, dev_products.title,dev_products.products_images FROM `dev_single_order`,dev_products where  business_id=".$bid." and dev_products.id=product_id group by product_id order by count1 desc limit 12");
		   }
		   
			      $result = $que->result_array();
				 
				  if(!empty($result))
				  { 
		            $top_order_html='';
		            foreach($result as $single_result)
					{
		
		             $top_order_html.='<div class="timeline-item align-items-start">
														
						<div class="timeline-badge">
							<i class="fa fa-genderless text-primary icon-xl"></i>
						</div>
						
					    <img src="'.$single_result['products_images'].'" alt="image" style="width:35px;margin-left:20px">
							<div class="dark">
						<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3" style="margin-top:7px">
							 <span class="font-weight-bolder text-dark-75 font-size-lg" >'.$single_result['title'].'</span></div>
							
						
						</div>
						
					</div>';
					}
				  }
				  else
				  {
					 $top_order_html='NO Record Found'; 
				  }
		            
		   //********** top product end ***********///
		   
		   
		   // ************approve invoice start**************************///
		   
		  $this->db->select('vendor_name,total,order_number,Invoice_approve_time,Attachment');
		$this->db->from('dev_NylasUsersAttachments ');
		$this->db->where('pdftype',2);
		$this->db->where('Invoice_approve !=', '  0');
		$this->db->where('business_id ',$this->BusinessIdFunction());
		$this->db->order_by("Invoice_approve", "DESC");
		$this->db->limit(10);
		$result = $this->db->get()->result_array();
		
		  if(!empty($result))
		  { 
		    $approve_imvoice='';
		    foreach($result as $single_result)
			{
				$date = $single_result['Invoice_approve_time'];
				$date=str_replace('/','-',$date);
				 
				$date= strtotime($date);
				$currnet_date = strtotime(date('Y-m-d'));
				
                $datediff = $currnet_date-$date;
				$count_days = floor($datediff / (60 * 60 * 24)); 
				 
				$approve_imvoice.= '<div class="timeline-item align-items-start">
														
					<div class="timeline-badge">
						<i class="fa fa-genderless text-primary icon-xl"></i>
					</div>
					<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
						<div class="dim pb-2">'.$count_days.' Days ago</div>
						<div class="dark"> <span class="font-weight-bolder text-dark-75 font-size-lg">'.$single_result['vendor_name'].'</span></div>
						
						
						<div class="dim"><span>Order No.: <a href="'.$single_result['Attachment'].'" target="_blank">'.$single_result['order_number'].'</a>   </span> <span> Value: £'.$single_result['total'].'</span></div>
					</div>								
					</div>';
				
			}
		       
		  }
		  else
		  {
			  $approve_imvoice='NO Record Found';
		  }
		  
		   
		   //***************approve invoice end***********************//
		   
		   $pass_array=array('blank_html'=>$blank_html,'top_order_html'=>$top_order_html,'approve_imvoice'=>$approve_imvoice);
		  return $pass_array;
	}	
		
		
		
		
	public function login()
	{   
           //$log_button=$this->input->post('login');
		  
		if($this->input->post('login'))
		{
			  $Table='dev_business';
			 $email=$this->input->post('email');
			 $passw = $this->input->post('password');
			 $pass = $passw;
	         $que=$this->db->query("select * from dev_users where email='".$email."' and password='".$pass."' ");
			 $result = $que->result_array();
			//print_r( $result);die;
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
					//print_r($role);die;
					$iswholseller=$userdata['permission_wholeseller'];
				 }		
				    if($role == '3' || $role == '4')
					{
						 $this->session->set_flashdata('Invalid',' Invalid user'); 
                         redirect(base_url('index'));
					}
                     else
                     {						 
				   if($business_id =='')
					{
					   $trial_user_array=array('user_id'=>$user_id,'business_id'=>$business_id,'name'=>$user_name,'email'=>$email);
				       $_SESSION['Trial']=$trial_user_array;
				       redirect(base_url('busineesCreateForTrial'));
					}
				else
					{						
				     // check Trial user session time expire or not
					 $expire_date=$this->DataModel->CheckTrileBusiness($Table,$business_id);
					 $Date=date("Y/m/d");
					 $date1 = strtotime($Date); 
                     $date2 = strtotime($expire_date); 
                     $diff = ($date2 - $date1)/60/60/24;
					 
				    if($expire_date!='')
				     {  
				    if($diff <= 0 )
                     {
						
						redirect(base_url('paymentPackages'));
					 }
					 else	
					   {
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
				} 
				else
				    {					  
				 
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
			    }
			    }				
			}
			else
			{
				redirect('index');
			}	
		}
		else
		{ 
			
			if(isset($_SESSION['status']))
			{
				
				if(isset($_SESSION['Current_Business']))
				{
					$bid=$_SESSION['Current_Business'];
				}
				else
				{   
					$bid =  $_SESSION['status']['business_id'];
				}
				
				$query=$this->db->query("select * from dev_engineer where business_id=$bid");
				$NOI=$query->num_rows();
				
				
				$querySupp=$this->db->query("select * from dev_supplier where  business_id=$bid");
				$NOs=$querySupp->num_rows();
               
				$All_orders= $this->db->Query("select *from dev_orders where status='0'");
	            $orderbymonths= $this->db->Query("SELECT MONTH(`date`) as mon,count(*) as o FROM `dev_orders` where YEAR(`date`)='$current_year'  group by MONTH(`date`)");
				
				$current_month = date("m");
				$Current_year=  date('F Y');
				
				 $business_id=$this->BusinessIdFunction();
				     $select='COUNT(Attachment)  AS  Attachment_count';  
					 $select2='COUNT(Attachment)  AS  flag_count';
					 $select3='SUM(total)  AS  total_sum';
					 $TableName='dev_NylasUsersAttachments';
					 $multiClause=array('dev_PmoUserConnectNylas.business_id'=>$business_id,'dev_NylasUsersAttachments.pdftype'=>2,'current_month'=>$current_month);
					 $multiClause2=array('dev_PmoUserConnectNylas.business_id'=>$business_id,'dev_NylasUsersAttachments.pdftype'=>2,'flag_invoice'=>1,'current_month'=>$current_month);
					 $join_table=' dev_PmoUserConnectNylas ';
					 $join_relation='dev_PmoUserConnectNylas.id=dev_NylasUsersAttachments.NylasUserId';
					 $result_as_array=true;
				
				$Attachment_match = $this->CommonModel->Fetchjoindata($select,$TableName,$multiClause,$result_as_array,$join_table,$join_relation);
			 	$count_attachment=$Attachment_match[0]['Attachment_count']; 
				
				$flag_attachment= $this->CommonModel->Fetchjoindata($select2,$TableName,$multiClause2,$result_as_array,$join_table,$join_relation);
				$flag_count=$flag_attachment[0]['flag_count'];
				
				$Attachment_sum = $this->CommonModel->Fetchjoindata($select3,$TableName,$multiClause,$result_as_array,$join_table,$join_relation);
			    $total_sum = $Attachment_sum[0]['total_sum'];
			
			   if(!empty($total_sum)){$total_sum;}else{$total_sum='0.00';}
			   
			    $pass_array=$this->SendDataToDashboard();
	            $blank_html=$pass_array['blank_html'];
	            $top_order_html=$pass_array['top_order_html'];
				$approve_imvoice=$pass_array['approve_imvoice']; 
			   
			   
				$data=array('numberOfEngineer'=>$NOI,'numberOfSupplier'=>$NOs,'numberOfOrder'=>$All_orders->num_rows(),'count_attachment'=>$count_attachment,'pdftype'=>'Invoice','flag_count'=>$flag_count,'Current_year'=>$Current_year,'total_sum'=>$total_sum,'LAST_ISSUED_INVOICES'=>$blank_html,'top_order_html'=>$top_order_html,'approve_imvoice'=>$approve_imvoice);
				
				
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('dashboard.php',$data);
				$this->load->view('footer.php');
			
			}else
			{
				redirect('index');
			}	
		} 
	}
	
	public function GetAllAttchmentSearchCountData($Search_html,$Attachmentvalue1,$monthvalue1) 
	{
		
		 $select='COUNT(Attachment)  AS  Attachment_count';  
		 $select2='COUNT(Attachment)  AS  flag_count';
		 $select3='SUM(total)  AS  total_sum';
		 
		 $business_id=$this->BusinessIdFunction();
		$TableName='dev_NylasUsersAttachments ';
		
		$Like='order_number';
		$Or_like='document_number';
		$Order_BY=false;
		$Limit=false;
		$result_as_array=true;
		$by1=$Search_html;
		$by2=$Search_html;
		
		
		if($monthvalue1=='0')
		{
			$multiClause=array('pdftype'=>$Attachmentvalue1,'business_id'=>$business_id);
		    $multiClause2=array('pdftype'=>$Attachmentvalue1,'flag_invoice'=>1,'business_id'=>$business_id);
			$multiClause3=array('pdftype'=>$Attachmentvalue1,'flag_invoice'=>1,'business_id'=>$business_id);
		}else
        {
			$multiClause=array('pdftype'=>$Attachmentvalue1,'business_id'=>$business_id,'current_month'=>$monthvalue1);
		    $multiClause2=array('pdftype'=>$Attachmentvalue1,'flag_invoice'=>1,'business_id'=>$business_id,'current_month'=>$monthvalue1);
			 $multiClause3=array('pdftype'=>$Attachmentvalue1,'flag_invoice'=>1,'business_id'=>$business_id,'current_month'=>$monthvalue1);
		}			
		
		
			$Attachment_count = $this->CommonModel->LikeFetchdata($select,$TableName,$multiClause,$Like,$by1,$Or_like,$by2,$Order_BY,$Limit,$result_as_array);
			$count_attachment = $Attachment_count[0]['Attachment_count'];
			
			$flag_count = $this->CommonModel->LikeFetchdata($select2,$TableName,$multiClause2,$Like,$by1,$Or_like,$by2,$Order_BY,$Limit,$result_as_array);
			$flag_count = $flag_count[0]['flag_count'];
			
			$total = $this->CommonModel->LikeFetchdata($select3,$TableName,$multiClause,$Like,$by1,$Or_like,$by2,$Order_BY,$Limit,$result_as_array);
			$total_sum = $total[0]['total_sum'];
	
	              if($monthvalue!='0')
					{
					  $monthName = date('M', mktime(0, 0, 0, $monthvalue, 10)); 
                      $Current_year=  date('Y');
		              $combo=$monthName.' '.$Current_year;
					}
                    else
					{
						$combo = $Current_year=  date('F Y');
					}
					
					if($Attachmentvalue1 =='2'){$pdftype="Invoice";}elseif($Attachmentvalue1 =='1'){$pdftype="Credit";}else{$pdftype="Quote";}	
				 if(!empty($total_sum)){$total_sum;}else{$total_sum='0.00';}
					$return_array = array('count_attachment'=>$count_attachment,'flag_count'=>$flag_count,'total_sum'=>$total_sum,'pdftype'=>$pdftype,'combo'=>$combo);	
					
	                return json_encode(array($return_array));; 
	}
	
	
	
	
	public function GetAllAttchmentCountData()
	{
		
		
		
					$Attachmentvalue = $this->input->post('Attachmentvalue'); 
					$monthvalue = $this->input->post('monthvalue');   
		            $state = $this->input->post('state'); 
					
					
					
					if($state=='search')
					{
						 $Search_html='LONGHAUGH';
						$Attachmentvalue1='2';
						$monthvalue1='05';
						
						 $Search_html = $this->input->post('Search_html');
						 $Attachmentvalue1 = $this->input->post('Attachmentvalue1'); 
						 $Get_data = $this->GetAllAttchmentSearchCountData($Search_html,$Attachmentvalue1,$monthvalue1);
						 print_r($Get_data);
					}	
					else
					{	
		             $business_id=$this->BusinessIdFunction();
					 
					 if($business_id=='0')
					 {
						 $business_id=$_SESSION['status']['business_id'];
					 }
                     else
					 {
						 $business_id=$business_id;
					 }					 
		             
		             $select='COUNT(Attachment)  AS  Attachment_count';  
					 $select2='COUNT(Attachment)  AS  flag_count';
					 $select3='SUM(total)  AS  total_sum';
					 
					 $TableName='dev_NylasUsersAttachments';
					 
					 if($monthvalue=='0')
					 {
					 $multiClause=array('dev_PmoUserConnectNylas.business_id'=>$business_id,'dev_NylasUsersAttachments.pdftype'=>$Attachmentvalue);
					 
					 $multiClause2=array('dev_PmoUserConnectNylas.business_id'=>$business_id,'dev_NylasUsersAttachments.pdftype'=>$Attachmentvalue,'flag_invoice'=>1);
					 
					 }
					 else
					 {
						$multiClause=array('dev_PmoUserConnectNylas.business_id'=>$business_id,'dev_NylasUsersAttachments.pdftype'=>$Attachmentvalue,'current_month'=>$monthvalue);

						$multiClause2=array('dev_PmoUserConnectNylas.business_id'=>$business_id,'dev_NylasUsersAttachments.pdftype'=>$Attachmentvalue,'flag_invoice'=>1,'current_month'=>$monthvalue);
					 }	 
					 
					
					 $join_table=' dev_PmoUserConnectNylas ';
					 $join_relation='dev_PmoUserConnectNylas.id=dev_NylasUsersAttachments.NylasUserId';
					 $result_as_array=true;
					 
					 $Attachment_match = $this->CommonModel->Fetchjoindata($select,$TableName,$multiClause,$result_as_array,$join_table,$join_relation);
					
			 	     $count_attachment=$Attachment_match[0]['Attachment_count']; 
					 
					 $flag_attachment= $this->CommonModel->Fetchjoindata($select2,$TableName,$multiClause2,$result_as_array,$join_table,$join_relation); 
				     $flag_count=$flag_attachment[0]['flag_count'];
					
					$Attachment_sum = $this->CommonModel->Fetchjoindata($select3,$TableName,$multiClause,$result_as_array,$join_table,$join_relation);
			        $total_sum = $Attachment_sum[0]['total_sum']; 
					
					if($monthvalue!='0')
					{
					  $monthName = date('M', mktime(0, 0, 0, $monthvalue, 10)); 
                      $Current_year=  date('Y');
		              $combo=$monthName.' '.$Current_year;
					}
                    else
					{
						$combo = $Current_year=  date('F Y');
					}					
					
				if($Attachmentvalue =='2'){$pdftype="Invoice";}elseif($Attachmentvalue =='1'){$pdftype="Credit";}else{$pdftype="Quote";}	
				 if(!empty($total_sum)){$total_sum;}else{$total_sum='0.00';}
					$return_array = array('count_attachment'=>$count_attachment,'flag_count'=>$flag_count,'total_sum'=>$total_sum,'pdftype'=>$pdftype,'combo'=>$combo);
					
					print_r(json_encode(array($return_array)));
		
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
	   if(empty($_SESSION['status']))
	   {
		$this->load->view('login-v1.php');
	   }else
	   {
		redirect('dashboard');
	
	   }
	}
	
	     public function TrialIndex()
	 {
		  $this->load->view('login-v2.php');
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
	
    public function TrialBusiness()
	{
		
			
		             $this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('TrialBusiness.php');
					$this->load->view('footer.php');
			
	}	
	 
	public function GetTrialBusiness()
	{
		$Get_All_Trial_business=$this->db->query("select * from dev_business where Trial_business=1");
		$Get_All_Trial_business=$Get_All_Trial_business->result_array();
		echo json_encode($Get_All_Trial_business);
		
	}
	
	
	
	
	
	
	
	public function users(){
		/* echo "<pre>";
		print_r($_POST);
		die; */  
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
				// print_r($role);die;
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
				 if($this->input->post('vanstock'))
				 {
					 $p16=1;
					 
				 }
				 else
				 {
					$p16=0; 
					 
				 }
				  if($this->input->post('Electrical_Catalogue'))
				 {
					 $p17=1;
					 
				 }
				 else
				 {
					$p17=0; 
					 
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
				
                $arr=array('person_name'=>$user_name,'user_name'=>$nick_name,'business_id'=>$bid,'email'=>$email,'password'=>$password,'business'=>$assign_buss,'role'=>$role,'permission_full'=>$p1,'permission_products'=>$p2,'permission_orders'=>$p3, 'permission_suppliers'=>$p5, 'permission_engineers'=>$p6,'permission_projects'=>$p7,'permission_categories'=>$p9,'permission_notifications'=>$p10,'permission_super_Admin'=>$p11,'permission_wholeseller'=>$p12,'permission_store'=>$p13,'permission_deleverycost'=>$p14,'permission_quotes'=>$p15,'	permission_vanstock'=>$p16,'permission_ElectricalCatalogue'=>$p17);
              
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
	
	public function checkBusinesspremissions()
	{
		 if(!empty( $this->session->userdata('Current_Business')))
		 {
			 $business_id = $this->session->userdata('Current_Business');
		 }
	     else
		 {
		     $status = $this->session->userdata('status');
		     $business_id=$status['business_id'];
		 }
		 
		 $check_business='2';
         $permissions=$this->DataModel->permissionsForBusiness($business_id);
		 
		return $permissions;
	}
	
	
	public function checkAppPermissions()
	{
		if(!empty( $this->session->userdata('Current_Business')))
		 {
			 $business_id = $this->session->userdata('Current_Business');
		 }
	     else
		 {
		     $status = $this->session->userdata('status');
		     $business_id=$status['business_id'];
		 }
		
		 $que=$this->db->query("select * from dev_Business_Plans where business_id=$business_id ");
		 $result = $que->result_array();
		 
		  foreach($result as $userdata)
		  {
			  $sup_app_Categories=$userdata['sup_app_Categories'];  
			  $sup_app_Orders=$userdata['sup_app_Orders'];
			  $sup_app_All_orders=$userdata['sup_app_All_orders'];
			  $sup_app_Quotes=$userdata['sup_app_Quotes'];  
			  $sup_app_Project_details=$userdata['sup_app_Project_details'];
			  $sup_app_Account_Details=$userdata['sup_app_Account_Details'];    
			  $Staff_limit=$userdata['Staff_limit'];
			  $vans_limit=$userdata['vans_limit'];
			  
			  
			  $ope_app_Categories=$userdata['ope_app_Categories'];  
			  $ope_app_Orders=$userdata['ope_app_Orders'];
			  $ope_app_All_orders=$userdata['ope_app_All_orders'];
			  $ope_app_Quotes=$userdata['ope_app_Quotes'];  
			  $ope_app_Project_details=$userdata['ope_app_Project_details'];
			  $ope_app_Account_Details=$userdata['ope_app_Account_Details'];
			  
			  $sup_array=array('sup_app_Categories'=>$sup_app_Categories,'sup_app_Orders'=>$sup_app_Orders,'sup_app_All_orders'=>$sup_app_All_orders,'sup_app_Quotes'=>$sup_app_Quotes,'sup_app_Project_details'=>$sup_app_Project_details,'sup_app_Account_Details'=>$sup_app_Account_Details,'Staff_limit'=>$Staff_limit,'vans_limit'=>$vans_limit);
			  
			  $ope_array=array('ope_app_Categories'=>$ope_app_Categories,'ope_app_Orders'=>$ope_app_Orders,'ope_app_All_orders'=>$ope_app_All_orders,'ope_app_Quotes'=>$ope_app_Quotes,'ope_app_Project_details'=>$ope_app_Project_details,'ope_app_Account_Details'=>$ope_app_Account_Details);
		  
		      $common_array=array('sup_array'=>$sup_array,'ope_array'=>$ope_array);
		  return $common_array;
		  }
		 
		 
	}
	
	public function Editbusiness()
	{
		
		$checkAppPermissions = $this->checkAppPermissions(); 
		$sup_array=$checkAppPermissions['sup_array'];
		$ope_array=$checkAppPermissions['ope_array']; 
		$businees_permissions = $this->checkBusinesspremissions();  
	    $key=array('key'=>$businees_permissions,'sup_array'=>$sup_array,'ope_array'=>$ope_array);
		
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('Edit_business.php',$key);
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
					$image_url="https://app.pickmyorder.co.uk/images/applogo/$dynamicname";
					
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
			$Trial_expire_date= $this->input->post('birthday');
            		
			
			 if($this->input->post('Brandpage'))
			{
				$Brandpage=1;
			}
			else
			{
				$Brandpage=0;
			}
			
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
			/* else if($this->input->post('InvoiceManagement'))
			{
				$wholesalerApp=2;
			} */
			else if($this->input->post('Brandbusiness'))
			{
				$wholesalerApp=3;
			}
			else
			{
				$wholesalerApp=0;
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
			
			
			if($this->input->post('vanstock'))
			{
			$vanstock=1;
			}
			else
			{
				$vanstock=0;
			}
			
			if($this->input->post('Luckins'))
			{
			$Luckins=1;
			}
			else
			{
				$Luckins=0;
			}	
			if($this->input->post('InvoiceManagement'))
			{
			$InvoiceManagement=1;
			}
			else
			{
				$InvoiceManagement=0;
			}	
			 //// business premissions
			if($this->input->post('backproduct')){$bp1=1;}else{$bp1=0;}
			if($this->input->post('backOrders')){$bp2=1;}else{$bp2=0;}
			if($this->input->post('backSuppliers')){$bp3=1;}else{$bp3=0;}
			if($this->input->post('backEngineers')){$bp4=1;}else{$bp4=0;}
			if($this->input->post('backProjects')){$bp5=1;}else{$bp5=0;}
			if($this->input->post('backCatologes')){$bp6=1;}else{$bp6=0;}
			if($this->input->post('backCategories')){$bp7=1;}else{$bp7=0;}
			if($this->input->post('backVAN_Stock')){$bp8=1;}else{$bp8=0;}
			if($this->input->post('backElectrical_Catalogue')){$bp9=1;}else{$bp9=0;}
			$Vans_Limit= $this->input->post('Vans_Limit');
			$User_Limit= $this->input->post('User_Limit');
			
			 //// business supervisor premissions
			if($this->input->post('sup_app_Categories')){$sp1=1;}else{$sp1=0;}
			if($this->input->post('sup_app_Orders')){$sp2=1;}else{$sp2=0;}
			if($this->input->post('sup_app_All_orders')){$sp3=1;}else{$sp3=0;}
			if($this->input->post('sup_app_Quotes')){$sp4=1;}else{$sp4=0;}
			if($this->input->post('sup_app_Project_details')){$sp5=1;}else{$sp5=0;}
			if($this->input->post('sup_app_Account_Details')){$sp6=1;}else{$sp6=0;}
			
			//// business operative premissions
			if($this->input->post('ope_app_Categories')){$op1=1;}else{$op1=0;}
			if($this->input->post('ope_app_Orders')){$op2=1;}else{$op2=0;}
			if($this->input->post('ope_app_All_orders')){$op3=1;}else{$op3=0;}
			if($this->input->post('ope_app_Quotes')){$op4=1;}else{$op4=0;}
			if($this->input->post('ope_app_Project_details')){$op5=1;}else{$op5=0;}
			if($this->input->post('ope_app_Account_Details')){$op6=1;}else{$op6=0;}
			
			/////// handel wholesaler tab //////
			
			 $this->db->select('id');            
             $query = $this->db->get_where('dev_engineer', array('business_id' =>$business_id));
             $result = $query->result_array();
			 
			 if(!empty($result))
			 {
			 $total_ids=array();
			 foreach($result as $resultdata)
			 { 
			      $key=$resultdata['id'];
				 $ids_array=array('engineer_id'=>$key,'Wholeseller'=>$wholesalerpage);
				 array_push($total_ids,$ids_array);
			 }
			
			$update=$this->db->update_batch('dev_engineer_permissions ', $total_ids, 'engineer_id');
		     }
			/////////
			
			
		    $business_permissions=array('permission_products'=>$bp1,'permission_orders'=>$bp2,'permission_suppliers'=>$bp3,'permission_engineers'=>$bp4,'permission_projects'=>$bp5,'permission_catologes'=>$bp6,'permission_categories'=>$bp7,'permission_vanstock'=>$bp8,'permission_ElectricalCatalogue'=>$bp9);

            $business_supervisor_permissions=array('sup_app_Categories'=>$sp1,'sup_app_Orders'=>$sp2,'sup_app_All_orders'=>$sp3,'sup_app_Quotes'=>$sp4,'sup_app_Project_details'=>$sp5,'sup_app_Account_Details'=>$sp6,'vans_limit'=>$Vans_Limit,'Staff_limit'=>$User_Limit,'ope_app_Categories'=>$op1,'ope_app_Orders'=>$op2,'ope_app_All_orders'=>$op3,'ope_app_Quotes'=>$op4,'ope_app_Project_details'=>$op5,'ope_app_Account_Details'=>$op6);

			   $this->db->where('business_id',$business_id);
               $this->db->update('dev_Business_Plans',$business_permissions);
			   $this->db->update('dev_Business_Plans',$business_supervisor_permissions);
			  
			   
			$supervisor_array=array('Categories'=>$sp1,'Orders'=>$sp2,'All_orders'=>$sp3,'Quotes'=>$sp4,'Project_details'=>$sp5);
			$operative_array=array('Categories'=>$op1,'Orders'=>$op2,'All_orders'=>$op3,'Quotes'=>$op4,'Project_details'=>$op5);
			
			
			
				 $supervisor_query="";
			   foreach($supervisor_array as $kkey=>$vval)
			   {
				   if($vval==0)
				   {
					   $supervisor_query .= $kkey.'='.'"'.$vval.'"'.',';
				   }
			   }
			   $supervisor_query=rtrim($supervisor_query, ",");
			   
			   if(!empty($supervisor_query))
			   { 
			$supervisor_update = $this->db->query("update dev_engineer,`dev_engineer_permissions` set ".$supervisor_query." where dev_engineer.id=engineer_id and business_id='$business_id'");
			   }
			 ////////////////////////////////////
			 
			  $operative_query="";
			   foreach($operative_array as $kkkey=>$vvval)
			   {
				   if($vvval==0)
				   {
					   $operative_query .= $kkkey.'='.'"'.$vvval.'"'.',';
				   }
			   }
			   $operative_query=rtrim($operative_query, ",");
			   
			   if(!empty($operative_query))
			   { 
			$operative_update = $this->db->query("update dev_engineer,`dev_engineer_permissions` set ".$operative_query." where dev_engineer.id=engineer_id and dev_engineer.business_id='$business_id' and dev_engineer_permissions.Operative='1'");
			   }
			 ////////////////////////////
			  
			   $datauser="";
			   foreach($business_permissions as $key=>$val)
			   {
				   if($val==0)
				   {
					   $datauser .= $key.'='.'"'.$val.'"'.',';
				   }
			   }
			   $datauser=rtrim($datauser, ",");
			   
			      if(!empty($datauser))
			       { 
			   $resu = $this->db->query("update dev_users set ".$datauser." where business_id='$business_id'");
				   }
				   
				   
		$query1="UPDATE `dev_business` SET `expire_trial_time`='$Trial_expire_date',`business_name`='$business_name',`address`='$business_address',`city`='$business_city',`post_code`='$business_postcode',`email`='$business_Email',`contact_name`= '$business_contact_name',`contact_number`='$business_contact_number',`supplier_email`='$Supplier_email',`app_status`='$App_status', `bussiness_logo`='$image_url',`iswholeapp`='$wholesalerApp',`iswholpageview`='$wholesalerpage',`isdedicate`='$dedicate',`stripe_secretkey`='$Secretkey',`stripe_publishkey`='$Publishkey',`stripe_user_id`='$stripe_user_id',`isconnected`='$isconnected',`van_stock`='$vanstock',`Luckins`='$Luckins',`brandpage`='$Brandpage',`invoice_management_premission`='$InvoiceManagement' WHERE id='$business_id'";
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
			// print_r($udi);die;
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
					 $p11=1;$role='1';
					 
				 }else{$p11=0;  $role='2';}
				 
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
				if($this->input->post('vanstock'))
				{
					$p16=1;
				}
				else
				{
					$p16=0;
				}
				
				if($this->input->post('Electrical_Catalogue'))
				{
					$p17=1;
				}
				else
				{
					$p17=0;
				}
				
				//print_r($p16);die;
                $arr=array('business_id'=>$Bussiness_id,'person_name'=>$nick_name,'user_name'=>$user_name,'email'=>$email,'password'=>$password,'business'=>$assign_buss,'permission_full'=>$p1,'role'=>$role,'permission_products'=>$p2,'permission_orders'=>$p3, 'permission_suppliers'=>$p5, 'permission_engineers'=>$p6,'permission_projects'=>$p7,'permission_catologes'=>$p8,'permission_categories'=>$p9,'permission_notifications'=>$p10,'permission_super_Admin'=>$p11,'permission_wholeseller'=>$p12,'permission_store'=>$p13,'permission_deleverycost'=>$p14,'permission_quotes'=>$p15,'permission_vanstock'=>$p16,'permission_ElectricalCatalogue'=>$p17);
				  // print_r($arr);die;  
				$table='dev_users'; 
			    $where=array('id'=>$udi);
				
					$update_user=$this->DataModel->update($table,$arr,$where);
					// print_r($update_user);die;      
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
			$dev_users=$this->db->query("delete from dev_users where business_id=$Row_id");
			$dev_engineer=$this->db->query("delete from dev_engineer where business_id=$Row_id");
			
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
	   $editid=$_REQUEST['editid'];
	   $check=$_REQUEST['check'];
		
		   if($check=="eng")
		   {
			  $user_query=$this->db->query("select user_id from  dev_engineer where id='$editid'");
			  $user_array= $user_query->result_array();	   
			  $user_id=$user_array[0]['user_id'];

	         $check_user_exsist=$this->db->query("select *from dev_users where email='$email' and id!='$user_id'");
		   }
		   else
		   {
		     $check_user_exsist=$this->db->query("select *from dev_users where email='$email' and id!='$editid'");
		   } 
		   
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
   
   public function CheckNewUserExsist()
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
				$bname='AllBusiness';
			}
			else
			{
			$BusinessObj=$this->db->get_where('dev_business',array('id'=>$Busines_id));
			$BusinessData=$BusinessObj->result_array();
			
		
			$bname=$BusinessData[0]['business_name'];
		    
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
			
			//$resultios = $this->DataModel->send_ios_notification($iosdeviceid,$body);
			
			$data=array('businees_id'=>$Busines_id,'message'=>$body,'business_name'=>$bname);
			$this->db->insert('dev_Notifications',$data);
			
			$this->session->set_flashdata('send','Notification send successfully'); 
			redirect('Notifictions');
			
	  }
	  else
	  { 
		if(isset($_SESSION['status']['user_id']))
			{
			   redirect('Notifictions');
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
   
    public function RenameLukinsCategory()
   {
	   if(isset($_SESSION['status']['user_id']))
			{
				$businees_id = $this->session->userdata('status');
				$businees_id= $businees_id['business_id'];
	
				$response = $this->DataModel->fetchLukinscategory($businees_id); 
		
			    $cat_all_details=array('key'=>$response);
				
				$this->load->view('header.php');
			   $this->load->view('sidebar.php');
			   $this->load->view('RenameLukinsCategory.php',$cat_all_details);
				$this->load->view('footer.php'); 
			}else{
				
				$this->load->view('login-v1.php');
					
			}
   }
   
   public function changecatname()
   {
	   $categoryHtml= $this->input->post('categoryHtml');
	   $newcatname= $this->input->post('newcatname');
	   
	   $categoryHtml=preg_replace("/\s\s+/",'',$categoryHtml);
	   
	   $this->db->select('Pmo_category');
	   $this->db->from('dev_Category_Rename_Status ');
	   $this->db->like('Lukins_category',$categoryHtml);   
	   $Category_Rename_Status = $this->db->get();
	   $Rename_cat = $Category_Rename_Status->result();
	   $Pmo_category=$Rename_cat[0]->Pmo_category;
	   
	   if(empty($Pmo_category))
	   {
		   $inser_cat=array('Pmo_category'=>$newcatname,'Lukins_category'=>$categoryHtml);
		   $renamecat=$this->db->insert('dev_Category_Rename_Status',$inser_cat);
		   if($renamecat)
		   {
			   echo "2";
		   }
	   } 
	   else
	   {
		  echo "1"; 
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
					$image_url="https://app.pickmyorder.co.uk/images/applogo/$dynamicname";
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
			
			if($this->input->post('InvoiceManagement'))
			{
				$InvoiceManagement="1";
			}
			else
			{
				$InvoiceManagement="0";
			}
			
			
			if($this->input->post('iswholeapp'))
			{
			$wholesalerApp=1;
			}
			/* else if($this->input->post('InvoiceManagement'))
			{
				$wholesalerApp=2;
			} */
			else if($this->input->post('brandBusiness'))
			{
				$wholesalerApp=3;
			}
			else
			{
				$wholesalerApp=0;
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
			
			if($this->input->post('brandpage'))
			{
			$brandpage=1;
			}
			else
			{
				$brandpage=0;
			}
			
			
			if($this->input->post('vanstock'))
			{
				$vanstock=1;
			}
			else
			{
				$vanstock=0;
			}
			
			if($this->input->post('Luckins'))
		    {
				$Luckins=1;
			}
             else
			 {
				 $Luckins=0;
			 }				 
			
			
			            $this->db->select('*');
						$this->db->from('dev_business');
						$this->db->like('business_name',$business_name,'none');
						$Check_business_name=$this->db->get();
						
						
		         if($Check_business_name->num_rows())
				 {
					 $this->session->set_flashdata('error', '**This Business is already exists.');
					 redirect(base_url('AddNewBusiness')); 
				 }
			     else{
				$data=array($business_name,$business_address,$business_postcode,$business_Email,$business_contact_name,$business_contact_number,$business_acc_name,$business_acc_address,$business_acc_PostCode,$business_acc_email,$business_acc_number,$business_acc_vatnumber,$Supplier_email,$App_status,$business_city,$business_acc_city,$image_url,$wholesalerApp,$wholesalerpage,$dedicate,$Secretkey,$Publishkey,$vanstock,$Luckins,$brandpage,$InvoiceManagement); 
				 /* echo "</pre>";
				print_r($data);
				die; */ 
				
				$insert_buisness = $this->DataModel->Add_business($data);
				if($insert_buisness)
				{
					redirect('business');
				}
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
	   if(isset($_SESSION['Current_Business']))
		   {
			   $bid=$_SESSION['Current_Business'];
			   $dataObj=$this->db->query("select * from  dev_business where id='$bid'");
				$data=$dataObj->result_array();
		   }
		  else
		  {
			   $bid=$_SESSION['status']['business_id'];
			   $dataObj=$this->db->query("select * from  dev_business");
				$data=$dataObj->result_array();
		  }
		 
	 
	  $viewSend=array('values'=>$data);
	  $this->load->view('PrintableTable.php',$viewSend);
  }
  
  /********************************************************/
  public function Printproductstable()
  {
	   if(isset($_SESSION['Current_Business']))
		   {
			   $bid=$_SESSION['Current_Business'];
			   $dataObj=$this->db->query("select title,SKU,publish_status from  dev_products where business_id='$bid'");
				
		   }
		  else
		  {
			   $bid=$_SESSION['status']['business_id'];
			   $dataObj=$this->db->query("select title,SKU,publish_status from  dev_products");
				
		  }
		 
	 $data=$dataObj->result_array();
	  $viewSend=array('values'=>$data);
	 
	  $this->load->view('PrintViews/printproductstable.php',$viewSend);
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
		if(isset($_SESSION['Current_Business']))
		   {
			   $bid=$_SESSION['Current_Business'];
			   $dataObj=$this->db->query("select * from  dev_business where id='$bid'");
				$data=$dataObj->result_array();
		   }
		  else
		  {
			   $bid=$_SESSION['status']['business_id'];
			   $dataObj=$this->db->query("select * from  dev_business");
				$data=$dataObj->result_array();
		  }
		
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
  
  /*****************************Trial Section start***************************/
 
	public function AccountCreateForTrial()
	{    
			$this->load->view('Account_create_for_14day_trail.php');		 
	}
  
   
   public function CreateUserForTrial()
	{
		if(isset($_POST['AddGernelDetails'])) 
		{
			$fname=$this->input->post('fname');
			$lname=$this->input->post('lname');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			
			$person_name=$fname.' '.$lname;
			
        $chekEmail=$this->db->query("select email from  dev_users where email='$email'");
		$chekEmail=$chekEmail->result_array();
		$count_mail=count($chekEmail);
		 if($count_mail==1)
		 {
			 $this->session->set_flashdata('error', 'This Mail Already Use');
			 redirect(base_url('AccountCreateForTrial'));
		 }
	  else
		 {
		
		      $user_array=array('user_name'=>$person_name,'person_name'=>$person_name,'email'=>$email,'password'=>$password,'Trial'=>1,'permission_super_Admin'=>0,'permission_wholeseller'=>0,'permission_full'=>1,'permission_products'=>1,'permission_orders'=>1,'permission_quotes'=>1,'permission_suppliers'=>1,'permission_engineers'=>1,'permission_projects'=>1,'permission_catologes'=>1,'permission_categories'=>1,'permission_notifications'=>1,'permission_store'=>0,'permission_deleverycost'=>1,'permission_vanstock'=>1);
			  
               $this->db->insert('dev_users',$user_array);
			   $user_id=$this->db->insert_id();
			   if($user_id==true)
			   {				   
			    $trial_user_array=array('user_id'=>$user_id,'business_id'=>$business_id,'name'=>$person_name,'email'=>$email);
				 $_SESSION['Trial']=$trial_user_array;
				 //print_r($_SESSION['Trial']);die;
				 redirect(base_url('busineesCreateForTrial'));
			   }
				 
			   
			   
		 }
			
		}	 
	} 
    
   public function loginTrialBase()
    {
		
		if($this->input->post('login'))
		{
			
			 $email=$this->input->post('email');
			 $passw = $this->input->post('password');
			 $pass = $passw;
	         $que=$this->db->query("select * from dev_users where email='".$email."' and password='".$pass."' and Trial=1 ");
			// print_r($this->db->last_query());die;
			 $result = $que->result_array();
			 
			 $result_count=count($result);
			
		if($result_count==1)                
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
				if($business_id!='')
				{
				
                    $expire_date=$this->DataModel->CheckTrileBusiness($Table,$business_id);
					 $Date=date("Y/m/d");
					 $date1 = strtotime($Date); 
                     $date2 = strtotime($expire_date); 
                     $diff = ($date2 - $date1)/60/60/24;
					 
				  if($diff <= 0 )
                    {
						redirect(base_url('paymentPackages'));
					}
				   else
                    {					
				
				$session_array=array('user_id'=>$user_id,'business_id'=>$business_id,'name'=>$user_name,'email'=>$email,'role'=>$role,'superadmin_status'=>$superadmin_status,'iswholseller'=>$iswholseller);
				 $_SESSION['status']= $session_array;
				 redirect(base_url('dashboard'));
					}
				}	 
            	else
				{						
				 $trial_user_array=array('user_id'=>$user_id,'business_id'=>$business_id,'name'=>$user_name,'email'=>$email);
				 $_SESSION['Trial']=$trial_user_array;
				 redirect(base_url('busineesCreateForTrial'));
				}
			}
			else
			{
				$this->session->set_flashdata('message', 'Invalid Email or Password?');
				redirect(base_url('Trial/Index'));
				
			}	 
	    }	 
  
    }
	
	 public function busineesCreateForTrial()
	{    
	     if(empty($this->session->userdata('Trial'))){
            redirect(base_url('Trial/Index'));
			 }
			 else
			 { 
			$this->load->view('businees_create_for_14day_trail.php');	
			 } 			
	}  
  

      public function AddBusinessForTrial()
     {   
	 
	 
         if(isset($_SESSION['Trial']))
		   {
			  
			  $trial_user_id=$_SESSION['Trial']['user_id'];
			  $trial_name=$_SESSION['Trial']['name'];
              $trial_email=$_SESSION['Trial']['email'];		
			  
		   }	
		   
	   if($this->input->post('Insert_Busi'))
		{
			
			
		    $cattable='dev_product_cat';
	        $subcattable='dev_product_sub_cat';
	           $supercattable='super_sub_cat';

			$imgdata= $_FILES['image'];   
			$imgdata_name=$imgdata['name'];
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
			$category_list = $this->input->post('category_list');
			
			
			
			
			  $Time=date("h:i:sa");
			
			$Date=date("Y-m-d");
		    //$Today_date=$Date.' '.$Time;
			
			$expire_date= date('Y-m-d', strtotime($Today_date. ' + 14 days'));
			//$expire_time= date('h:i:sa', strtotime($Time. ' + 14 days'));
            //$expire=$expire_date.' '.$expire_time;
			$imgdata_name_EXTENSION = pathinfo($imgdata_name, PATHINFO_EXTENSION);
			$imagedata_renameimage=rand().time().'.'.$imgdata_name_EXTENSION;
			
			if(move_uploaded_file($imgdata['tmp_name'],"images/applogo/".$imagedata_renameimage))
			{
				$image_url=base_url()."images/applogo/".$imagedata_renameimage;
			}
			else
			{
			$image_url='';	
			}				
			
			
				$data_business=array('business_name'=>$business_name,'address'=>$business_address,'address'=>$business_postcode,'email'=>$business_Email,'contact_name'=>$business_contact_name,'contact_number'=>$business_contact_number,'bussiness_logo'=>$image_url,'Trial_business'=>1,'create_Trial_time'=>$Date,'city'=>$business_city,'app_status'=>1,'expire_trial_time'=>$expire_date,'CategoryList'=>$category_list);

				$insert_buisness = $this->db->insert('dev_business',$data_business);
				$businees_id= $this->db->insert_id();
				
				$account_array=array('business_id'=>$businees_id,'contact_name'=>$business_acc_name,'address'=>$business_acc_address,'post_code'=>$business_acc_PostCode,'email'=>$business_acc_email,'contact_number'=>$business_acc_number,'vat_number'=>$business_acc_vatnumber,'acc_city'=>$business_acc_city);	
				$insert_acc_deatils = $this->db->insert('dev_account',$account_array);
				
				
				$data = array('business_id'=>$businees_id,'from_bussi'=> $businees_id,'business'=>$business_name,'role'=>2,'permission_super_Admin'=>0,'permission_full'=>0,'permission_products'=>1,'permission_orders'=>1,'permission_suppliers'=>1,'permission_engineers'=>1,'permission_projects'=>1,'permission_catologes'=>1,'permission_categories'=>1,'permission_vanstock'=>1,'permission_ElectricalCatalogue'=>1);
                $this->db->where('id',$trial_user_id);
                $updatebusiness=$this->db->update('dev_users',$data);
				
				$data2 = array('business_id'=> $businees_id);
				$this->db->where('user_id',$trial_user_id);
                $updatebusiness=$this->db->update('dev_engineer',$data2); 
                $this->db->insert('dev_Business_Plans',$data2);
                if($updatebusiness)
				{
					
					
					$session_array=array('user_id'=>$trial_user_id,'business_id'=>$businees_id,'name'=>$trial_name,'email'=>$trial_email,'role'=>2,'superadmin_status'=>0,'iswholseller'=>0);
					$_SESSION['status']= $session_array;   
					
                    $check_CategoryList=$this->db->query("select CategoryList from  dev_business where id=$businees_id ");
					$check_CategoryList=$check_CategoryList->result_array();
                    $check_CategoryList=$check_CategoryList[0]['CategoryList']; 
                   
                if($check_CategoryList==10)
                {
					$cat_ids=$this->db->query("select Category_ids from  dev_categorylist where id='13'");
			        $cat_ids=$cat_ids->result_array();
			        $Category_ids=$cat_ids[0]['Category_ids'];
                    					
					 
			  $cat_staus_data=$this->db->query("SELECT cat_ids FROM `dev_categorylist_status` where status=1 and  cat_ids in($Category_ids)");
			  $cat_staus_data=$cat_staus_data->result_array();
               
				  foreach($cat_staus_data as $cat_status)
				  {
					 $cat_status_ids .= $cat_status['cat_ids']. ',';
				  }
				 
				  $cat_status_ids =  rtrim($cat_status_ids,',');

			   if(!empty($cat_status_ids))
				{
			      $cat_data=$this->db->query("SELECT * FROM `dev_product_cat` where id in($cat_status_ids)");
			      $Cat=$cat_data->result_array();
		

                    for($i=0;$i<count($Cat);$i++)
			        {

						$CatArr=array('userid'=>$trial_user_id,'business_id'=>$businees_id,'cat_name'=>$Cat[$i]['cat_name'],'image'=>$Cat[$i]['image']);
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
					unset($_SESSION['Trial']);
					redirect(base_url('dashboard'));
				}
				else
				{
					unset($_SESSION['Trial']);
					redirect(base_url('dashboard'));
				}
					
					
				}
                 		
			
				
		}
		
   }
    //////////////////////////
	
	public function paymentPackages()
	{
     
	 if(empty($this->session->userdata('status'))){
                    redirect(base_url('index'));
			 }
			 else
			   {   
                 if(!empty( $this->session->userdata('Current_Business')))
				 {
					$business_id = $this->session->userdata('Current_Business');
 
					  $queee=$this->db->query("SELECT id FROM dev_users WHERE business_id=$business_id and role=2");
			          $result = $queee->result_array();  
			          $user_id = $result[0]['id'];
                      
					 
				 }
				 else
				 {
					$status = $this->session->userdata('status');
					  $business_id=$status['business_id'];
                      $user_id=$status['user_id']; 
				 }
				 $data=array('key'=>$business_id,'keydata'=>$user_id);
			
				 $this->load->view('payment.php',$data);
			 }
	}
	
	public function ForgetPassword()
	{
     
     $this->load->view('forget_password.php');		 
	}
	
	public function UpdatePassword()
	 {
		 
		$this->load->view('update_passwoed.php');		  
	
	 }
	  public function UserForgetPassword()
	 {
		 
		 
	    $forgetpass = $this->input->post('email');
		
	     if($forgetpass)
		{
			$queee=$this->db->query("SELECT id,email FROM dev_users WHERE email LIKE '%$forgetpass'");
			$result = $queee->result_array();  
			
			$user_id = $result[0]['id'];
            $user_mail = $result[0]['email'];
           	$user_name = $result[0]['user_name'];		
			$result_count=count($result);
			
		    if($result_count==1)                
		    {
				$headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				$txt='<!DOCTYPE html>
<!--

<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Pick my order</title>
		<meta name="description" content="Login page " />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->

		
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/style.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/bundle.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/prism.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/style_bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/base_light.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/menu_light.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/brand_dark.css" rel="stylesheet" type="text/css" />
		
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/images/newlogoleatest_2.png"/>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-2 login-signin-on d-flex flex-column flex-column-fluid bg-white position-relative overflow-hidden" id="kt_login">
				<!--begin::Header-->
				<div class="login-header py-10 flex-column-auto">
					<div class="container d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between">
						<!--begin::Logo-->
						<a href="#" class="flex-column-auto py-5 py-md-0">
						
						<img src="https://app.pickmyorder.co.uk/assets/css/demo1/log_page_css/images/Pmo_logo_2.png" alt="logo"  width="170px"/>
							
						</a>
						<!--end::Logo-->
						
						
				
						
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="login-body d-flex flex-column-fluid align-items-stretch justify-content-center">
					<div class="container row">
						<div class="col-lg-6  col-sm-12 d-flex align-items-center mx-auto">
							<!--begin::Signin-->
							<div class="login-form login-signin">
								<!--begin::Form-->
								<form method="post" action="" class="form w-xxl-550px rounded-lg p-20" novalidate="novalidate" id="kt_login_signin_form"  >
									<!--begin::Title-->
									<div class="pb-5 pt-lg-0 pt-5">
										<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg mb-4">Reset Your<span style="color: #21519e;font-weight:800"> Password </span></h3>
										<h3 class="text-center mb-5" style="font-weight:700">'.$user_name.'</h3>
										<p class="mb-3">
										We are Sending you this Email because you requested a password reset. Click on this link to create a new password.
										</p>
									</div>
									
									<div class="pb-lg-0 pb-5">
									<a href="https://app.pickmyorder.co.uk/UpdatePassword?id='.$user_id.'"> <span style="display:block;width: 30%;  background-color: #187DE4;
                                         color: white;  padding: 15px 0;  font-size: 20px;">Set a new Password</span></a>
  
  
									
									</div>
									<!--end::Action-->
								</form>
								<!--end::Form-->
							</div>
							
						
						
						</div>
					
					</div>
				</div>
				<!--end::Body-->
				<!--begin::Footer-->
				<div class="login-footer py-10 flex-column-auto">
					<div class="container d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between">
						<div class="font-size-h6 font-weight-bolder order-2 order-md-1 py-2 py-md-0">
							<span class="text-muted font-weight-bold mr-2">©</span>
							<a href="https://app.pickmyorder.co.uk/UpdatePassword?id='.$user_id.'" target="_blank" class="text-dark-50 text-hover-primary" style="    color: #FFFFFF;background-color: #187DE4;width:30%">Pick my order</a>
						</div>
						
					</div>
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Login-->
		</div>
		
	</body>
	
</html>';
				
				
		      $mail = mail($user_mail,'Forget Your Password',$txt,$headers);  
			  if($mail)
			    {
					 $this->session->set_flashdata('message','you Received a Mail '); 
					 redirect(base_url('ForgetPassword'));
				}
				
			}
            else
            {
			     $this->session->set_flashdata('error',' Invalid Email'); 
                 redirect(base_url('ForgetPassword'));				 
			}				
		}   
		 
		 
	 }
	 
	 public function SetPassword()
	 {
		 
		  $password_one = $this->input->post('password_one');
		  $password_two = $this->input->post('password_two');
		  $userid = $this->input->post('userid');
		  if($password_one == $password_two)
		  { 
		  $update_array=array('password'=>$password_two);
		  $this->db->where('id', $userid);
         $update= $this->db->update('dev_users', $update_array);
		 if($update)
		 {
			 redirect(base_url('index')); 
		 } 
		  }
		  else
		  {
			  $this->session->set_flashdata('errorpass',' Both password not same'); 
                 redirect(base_url('UpdatePassword?id='.$userid )); 
		  }  
		  
		  
	 }
	 
	 public function GetLukinsProducts()
	 {
		 if(empty($this->session->userdata('status'))){
                    redirect(base_url('index'));
			 }
			 else
			 {
				$businees_id = $this->session->userdata('status');
				$businees_id= $businees_id['business_id'];
	
				$response = $this->DataModel->fetchLukinscategory($businees_id); 
		
				 if(!empty($response))
		       {
				if(isset($_SESSION['Current_Business']))
				{
					$bid=$_SESSION['Current_Business'];
				}
				else
				{   
					$bid=$_SESSION['status']['business_id'];
				}
				 
			  $cat_all_details=array('key'=>$response,'bid'=>$bid);
			  $this->load->view('lukins_header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('GetLukinsProducts.php',$cat_all_details);
			  $this->load->view('Lukins_footer.php'); 
			  		    } 
			 } 
	 }
	 
	 
	  public function GetLukinsproductsInproductList()
	 {
		 if(empty($this->session->userdata('status'))){
                    redirect(base_url('index'));
			 }
			 else
			 {
				$businees_id = $this->session->userdata('status');
				$businees_id= $businees_id['business_id'];
	
				$response = $this->DataModel->fetchLukinscategory($businees_id); 
		
				 if(!empty($response))
		       {
				if(isset($_SESSION['Current_Business']))
				{
					$bid=$_SESSION['Current_Business'];
				}
				else
				{   
					$bid=$_SESSION['status']['business_id'];
				}
				 $as=0;
			  $cat_all_details=array('key'=>$response,'bid'=>$bid,'as'=>$as);
			  $this->load->view('lukins_header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('GetLukinsproductsInproductList.php',$cat_all_details);
			  $this->load->view('Lukins_footer.php'); 
			  		    } 
			 } 
	 }
	 
	  
	 /// Get Data From SQL server Functions
        public function GetLukinsSubCategory()
	   {
		 $Getcode = $this->input->post('Getcode');
		 $Sub_catagory_Response = $this->DataModel->fetchLukinssubcategory($Getcode);
		 echo json_encode($Sub_catagory_Response);  
	   }
	   
	    public function GetLukinsSubSubCategory() 
	   {
		   
		 $Getcode = $this->input->post('Getcode');
		 $Getcode2 = $this->input->post('Getcode2');
		 $Sub_Sub_catagory_Response = $this->DataModel->FetchLukinsSubSubCategory($Getcode,$Getcode2);
		
		 echo  json_encode($Sub_Sub_catagory_Response);
	   }
       
        public function GetLukinsManufacture()
	   {
		 $Getcode = $this->input->post('Getcode');
		  $queee = $this->db->query("select dev_sql_Manufacturer.MAN_Code, MAN_SupplierName  from dev_sql_ItemDetails, dev_sql_Manufacturer where  COM_Code=$Getcode and dev_sql_Manufacturer.MAN_Code=dev_sql_ItemDetails.MAN_Code group by dev_sql_Manufacturer.MAN_Code");
		  
	       $result = $queee->result_array(); 
		 //$Manufacture = $this->DataModel->FetchLukinsManufacture($Getcode);
		 echo json_encode($result);
	   }
        
          
		
      public function SqlLukinsProducts()
	   {
		 $SubSubcategory_Com_code = $this->input->post('SubSubcategory');
		 $Manufacture_Man_Code = $this->input->post('Manufacture');
		 $Lukins_Products = $this->DataModel->FetchLukinsProducts($SubSubcategory_Com_code,$Manufacture_Man_Code);
		 echo json_encode($Lukins_Products);
		
		  
	   }   
	
	   public function GetProductInfo()
       {
		 $ID = $this->input->post('ID');
		 $GetProductInfo = $this->DataModel->GetProductInfo($ID);
		   echo json_encode($GetProductInfo);
		   
	   }	   
	 
	 
	
	   public function ExportProductInPMO()      
	    {    
	     
	        $flag=0;
			$emptyarrayone=array();
			$emptyarraytwo=array();
		   $categoryHtml = $this->input->post('categoryHtml');
		   $SubcategoryHtml = $this->input->post('SubcategoryHtml');
		   $SubSubcategoryHtml = $this->input->post('SubSubcategoryHtml');
		   $productList = $this->input->post('productList');
		   $Manufacturercod = $this->input->post('Manufacturercod');
		   
			
			if($Manufacturercod == "select Manufacture")
			  {
				  $Manufacturercod ='';
			  }	else
			  {
				  $Manufacturercod= $Manufacturercod;
			  }
			
			
		    $val=$_POST['val'];
			
			$path = '/images/applogo/productcomingsoon.png';
			$path2 = base_url();
			$image_url= $path2.$path;
			//print_r($image_url);die;
			$cattable='dev_product_cat';
	        $subcattable='dev_product_sub_cat';
	        $supercattable='super_sub_cat';
			
		    if(!empty($this->session->userdata('Current_Business')))
			{  
		          $Current_Business = $this->session->userdata('Current_Business');
				  $businees_id = $Current_Business;
		       				  
			}
			else
			{
				$status = $this->session->userdata('status');
				$businees_id = $status['business_id'];
				 
			}
			
			$businees_id =($productList=='0') ? ($businees_id) : ('15');
			
			   $status2 = $this->session->userdata('status');
		       $user_id = $status2['user_id'];
			   
			      
			 
			 		  $this->db->select('id');
					  $this->db->from('dev_product_cat');
					  $this->db->where('business_id',$businees_id );
					  $this->db->like('cat_name',$categoryHtml);
					  $NewBussinessCatData = $this->db->get();
					  $Cat_id = $NewBussinessCatData->result();
					  $check = $NewBussinessCatData->num_rows();
			 
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
					
					                   // insert product
								   
								                   													   
													$selectproductsdata =  $this->DataModel->selectsqlproducts($val,$businees_id);
												   
													if($selectproductsdata=="noproducts")
													{
														echo "1";
													}else
													{
														foreach($selectproductsdata as $selectproducts)
														{
															
															
															$list_id =($productList=='0') ? ('') : ($productList);
															if(!empty($list_id)){$list_id=json_encode(array($list_id));}
															
															 $ITM_ItemCode = $selectproducts['ITM_ItemCode'];
															$title = $selectproducts['ITM_ShortDesc'];
															$sku = $selectproducts['ITM_EAN1_Code'];
															$Shortkey = $selectproducts['ITM_Sortkey'];
															$Brand = $selectproducts['BNI_BrandName'];
															$INCVAT = $selectproducts['ITP_T1_Price'];
											   
														   $description='<div>
																<ul class="des-details" >
																	<li><b>Product code :</b>'.$Shortkey.'</li>
																	<li><b>Brand :</b>'.$Brand.'</li>
																	<li><b>Range :</b>'.$categoryHtml.'</li>	
																</ul>
															</div>';
											   
												 
											   
														  $product_insert_array =array('list_id'=>$list_id,'categories'=>$cat_id,'sub_categories'=>$sub_cat_id,'super_sub_cat_id'=>$sub_sub_cat_id,'Manufacture'=>$Manufacturercod,'title'=>$title,'business_id'=>$businees_id,'publish_status'=>0,'SKU'=>$sku,'product_name'=>$Shortkey,'description'=>$description,'vat_deductable'=>1,'tax_class'=>0,'inc_vat'=>$INCVAT,'ex_vat'=>$INCVAT,'Tsicode'=>$ITM_ItemCode);
														  
														  $ids_array = array('COM_Code'=>$ITM_ItemCode);
														  
														  array_push($emptyarrayone, $product_insert_array);
														  array_push($emptyarraytwo, $ids_array);
														 
														}
														
															$this->db->insert_batch('dev_products',$emptyarrayone);
															$this->db->insert_batch('dev_temp_ITEMCODE',$emptyarraytwo);
														   
														   
													
													echo "1";   
													}
													
												
								
				   

        }
		
		public function ManufacturerFetchfromvps()
		{
			$key_array=array();
			$Table = "dev_sql_ItemDetails";


			$ItemDetails =  $this->VpsModel->FetchSqlTableData($Table);
			
			foreach($ItemDetails as $ItemDetailsData)
			       {
					
					   $item_insert_array=array('ITM_TransCode'=>$ItemDetailsData[ITM_TransCode],'ITM_ItemCode'=>$ItemDetailsData[ITM_ItemCode],'COM_Code'=>$ItemDetailsData[COM_Code],'MAN_Code'=>$ItemDetailsData[MAN_Code],'BNI_Code'=>$ItemDetailsData[BNI_Code],'ITM_MergeCode'=>$ItemDetailsData[ITM_MergeCode],'PRC_CodeMaj'=>$ItemDetailsData[PRC_CodeMaj],'ITM_CatNo1'=>$ItemDetailsData[ITM_CatNo1],'PRC_CodeMin'=>$ItemDetailsData[PRC_CodeMin],'ITM_CatNo2'=>$ItemDetailsData[ITM_CatNo2],'BNI_BrandName'=>$ItemDetailsData[BNI_BrandName],'ITM_Sortkey'=>$ItemDetailsData[ITM_Sortkey],'ITM_Product'=>$ItemDetailsData[ITM_Product],'ITM_ShortDesc'=>$ItemDetailsData[ITM_ShortDesc],'ITM_ProductType'=>$ItemDetailsData[ITM_ProductType],'ITM_OtherDesc'=>$ItemDetailsData[ITM_OtherDesc],'ITM_Dimensions'=>$ItemDetailsData[ITM_Dimensions],'ITM_MatColFin'=>$ItemDetailsData[ITM_MatColFin],'ITM_SuppCatCode'=>$ItemDetailsData[ITM_SuppCatCode],'ITM_Status'=>$ItemDetailsData[ITM_Status],'ITM_InstTime'=>$ItemDetailsData[ITM_InstTime],'ITM_LastModified'=>$ItemDetailsData[ITM_LastModified],'ITM_EDPNumber'=>$ItemDetailsData[ITM_EDPNumber],'TSI_InstallTime'=>$ItemDetailsData[TSI_InstallTime],'ITM_EAN1_Code'=>$ItemDetailsData[ITM_EAN1_Code],'ITM_EAN2_Code'=>$ItemDetailsData[ITM_EAN2_Code],'ITM_EAN3_Code'=>$ItemDetailsData[ITM_EAN3_Code],'ITM_EAN4_Code'=>$ItemDetailsData[ITM_EAN4_Code],'ITM_EAN5_Code'=>$ItemDetailsData[ITM_EAN5_Code],'ITM_EAN6_Code'=>$ItemDetailsData[ITM_EAN6_Code],'ITM_EAN1_PackQty'=>$ItemDetailsData[ITM_EAN1_PackQty],'ITM_EAN2_PackQty'=>$ItemDetailsData[ITM_EAN2_PackQty],'ITM_EAN3_PackQty'=>$ItemDetailsData[ITM_EAN3_PackQty],'ITM_EAN4_PackQty'=>$ItemDetailsData[ITM_EAN4_PackQty],'ITM_EAN5_PackQty'=>$ItemDetailsData[ITM_EAN5_PackQty],'ITM_EAN6_PackQty'=>$ItemDetailsData[ITM_EAN6_PackQty],'ITM_EAN1_PackDesc'=>$ItemDetailsData[ITM_EAN1_PackDesc],'ITM_EAN2_PackDesc'=>$ItemDetailsData[ITM_EAN2_PackDesc],'ITM_EAN3_PackDesc'=>$ItemDetailsData[ITM_EAN3_PackDesc],'ITM_EAN4_PackDesc'=>$ItemDetailsData[ITM_EAN4_PackDesc],'ITM_EAN5_PackDesc'=>$ItemDetailsData[ITM_EAN5_PackDesc],'ITM_EAN6_PackDesc'=>$ItemDetailsData[ITM_EAN6_PackDesc],'ITM_PartShortDesc'=>$ItemDetailsData[ITM_PartShortDesc],'ITM_PartShortDesc_Name'=>$ItemDetailsData[ITM_PartShortDesc_Name],'ITM_PartShortDesc_CatNo'=>$ItemDetailsData[ITM_PartShortDesc_CatNo],'WEEE_Status'=>$ItemDetailsData[WEEE_Status],'ITM_MatCostHead'=>$ItemDetailsData[ITM_MatCostHead],'ITM_LabCostHead'=>$ItemDetailsData[ITM_LabCostHead],'ITM_SubConCostHead'=>$ItemDetailsData[ITM_SubConCostHead],'ITM_Discontinued'=>$ItemDetailsData[ITM_Discontinued],'ITM_M3Desc'=>$ItemDetailsData[ITM_M3Desc],'ITM_M3CatNo1'=>$ItemDetailsData[ITM_M3CatNo1],'ITM_M3CatNo2'=>$ItemDetailsData[ITM_M3CatNo2],'ITM_M3Name'=>$ItemDetailsData[ITM_M3Name],'ITM_M3WebDesc'=>$ItemDetailsData[ITM_M3WebDesc],'ITM_M3SalePkQty'=>$ItemDetailsData[ITM_M3SalePkQty],'pdf_name'=>$ItemDetailsData[pdf_name],'pdf2_name'=>$ItemDetailsData[pdf2_name],'products_images'=>$ItemDetailsData[products_images],'product_image_two'=>$ItemDetailsData[product_image_two],'product_image_three'=>$ItemDetailsData[product_image_three],'pdf_manual'=>$ItemDetailsData[pdf_manual],'pdf_manual2'=>$ItemDetailsData[pdf_manual2],'lukin_update'=>$ItemDetailsData[lukin_update]);
                         
					   array_push($key_array, $item_insert_array);
					}

				     	$this->db->insert_batch('dev_sql_ItemDetails',$key_array);

		}


}	


		