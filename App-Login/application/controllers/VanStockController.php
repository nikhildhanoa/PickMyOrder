<?php 
require_once FCPATH. '/vendor/autoload.php';
use Aws\S3\S3Client;
class VanStockController extends CI_Controller
{
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
	}
	
	public function vanAllProducts()
	{
	  $van_id=$_GET['id'];
		
		 if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				 
				 
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
				 
			  }
			
			 
		 if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
		} 
         else{
		
		if(isset($_POST['products']))
			{			
			$user_id=$_SESSION['status']['user_id']; 
			$products=$_POST['products'];
			$stocklevels=$_POST['Van_Stocks'];
			$reorderlevels=$_POST['Reorder_Level'];
			$InStocks=$_POST['in_stock'];
			    
			  $insertdata=array('van_id'=>$van_id,'in_stock'=>$InStocks,'recordlevel'=>$reorderlevels,'stocklevel'=>$stocklevels,'product_id'=>$products);
			  
			  $Tableinsert=$this->db->insert('products_van',$insertdata);
			  $last_id=$this->db->insert_id();
			 
			 if($last_id)
			 {
				 $insertdata_two=array('in_stock'=>$InStocks,'recordlevel'=>$reorderlevels,'stocklevel'=>$stocklevels,'product_van_id'=> $last_id,'user_id'=>$user_id);
			  
			  $Tableinsert=$this->db->insert('dev_vanproduct_history',$insertdata_two);
				 
			 }
			
			  
			  
			}
	
		 $driverdeatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
		$driverdeatils=$driverdeatils->result_array();
		
		
		$send_driver_deatials=array('key'=>$driverdeatils,'van'=>$van_id);
		
		
			  
		
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('VanAllProducts.php',$send_driver_deatials);
		$this->load->view('footer.php');
	}
	}
	/************************************************************/
	public function FetchvanAllProducts()
	{
		    
			 $van_id=$_GET['id'];
			
			  
			 
		
			 if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				  $llistreorder=$this->db->query("select products_van.recordlevel,products_van.toback_instock,products_van.in_stock,products_van.stocklevel,title,SKU,products_images,products_van.id, format((products_van.in_stock+products_van.toback_instock)*dev_products.ex_vat,2) AS onorder FROM products_van, dev_products where dev_products.id=product_id  && products_van.van_id='$van_id'");
				 
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
				   $llistreorder=$this->db->query("select products_van.recordlevel,products_van.toback_instock,products_van.in_stock,products_van.stocklevel,title,SKU,products_images,products_van.id,format((products_van.in_stock+products_van.toback_instock)*dev_products.ex_vat,2) AS onorder FROM products_van, dev_products where dev_products.id=product_id  && products_van.van_id='$van_id'");
				   
			  }   
			 
			   $llistreorder=$llistreorder->result_array();
			  
				 echo json_encode($llistreorder);
	}
	/***************************deletevanallproduct***************************/
	
	public function DeleteVanAllProducts()
	{
		
		$product_id=$_GET['id'];
		$vanid=$_GET['vanid'];
		
		$delete=$this->db->query("delete from  products_van where id='$product_id'");
				if($delete)
				{	
					redirect('vanAllProducts?id='.$vanid);
				}
				else
				{
				 echo "<script>alert('van Can Not  Delete')</script>";	
				}
		
		
	}
	
	/***************************UpdateAllProduct***************************/
	public function UpdateAllProduct()
	{
		
		
		
		
		
			  if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
			 }
			else
			{		
					
		
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('updateAllProducts.php');
		$this->load->view('footer.php');
			} 
	}
/**************************UpdateAllProducts*************************/	
	public function UpdateAllProducts()
	{
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				 
				 
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
				 
			  }
		 $user_id=$_SESSION['status']['user_id'];
	$vans=$this->input->post('vanid');
	$notes=$this->input->post('w3reviews');	
	$stocklevel=$this->input->post('stocklevels');
	$reorderlevels=$this->input->post('reorderlevels');
	$InStocks=$this->input->post('InStocks');
	$prdid=$this->input->post('prdid');
	
	
	   $data = array(
        //'van_id' => $vans,
        'stocklevel' => $stocklevel,
        'recordlevel' => $reorderlevels,
		'in_stock' => $InStocks,);
		
		
   $this->db->where('id', $prdid);
   $vanupdate=$this->db->update('products_van', $data);
	if($vanupdate)
	{	$data_two = array( 'stocklevel' => $stocklevel, 'recordlevel' => $reorderlevels,'in_stock' => $InStocks,'user_id'=>$user_id,'notes'=>$notes,'product_van_id'=>$prdid);
	 
	 $this->db->insert('dev_vanproduct_history',$data_two);
	 
		echo $vans;
		
	}
	else
	{
		echo "0";
	}
	
	}
	 
/**************************Fetchproductcode***********************/	
	 
	 public function Fetchproductcode()
	 {
		 
		  if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
	 }
	 else{
		
 
				   $bid=$_SESSION['status']['business_id'];
	 }
				   
			if(isset($_POST['search'])){
			$van_id=$_POST['vanid'];
             		
           $search =$_POST['search'];
            $response = array();
            $Get_Data= $this->db->query("SELECT product_name,SKU,id FROM dev_products WHERE (product_name like'%".$search."%' or SKU like'%".$search."%' )&& business_id='$bid' and id not in (select product_id from products_van where van_id=$van_id) and supplier_with_cost!='' and
			publish_status=1");	
		    //print_r($this->db->last_query());die;
         $Get_Data=$Get_Data->result_array();
		 foreach( $Get_Data as $Get_Dataa) {
 $response[] = array("value"=>$Get_Dataa['id'],"label"=>$Get_Dataa['product_name'].' ('.$Get_Dataa['SKU'].')');	
		 } 
		}
				   
			   
		 echo json_encode($response);
		
        
	 }
	 
/****************************Fetchproductcode*******************/	 
	 public function InsertVanEngineer()
	 {
		 
		 $engid=$_POST['engid'];
		 $vanid=$_POST['vanid'];
		 
		 $insertvaneng=array('engineer_id'=>$engid,'van_id'=>$vanid);
		  $insert=$this->db->insert('dev_van_engineer', $insertvaneng);
		  if($insert)
		  {
			  echo "1";
		  }
		  else
		  {
			  echo "0";
		  }
		 
	 }
	
	public function VanEngineers()
	{
		
		   
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
	 }
	 else{
		
 
				   $bid=$_SESSION['status']['business_id'];
	 }
		$van_id=$_GET['id'];
		
		 $vandriverdeatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
		
		$vandriverdeatils=$vandriverdeatils->result_array();
		
		 $engineers_deatils=$this->db->query("select user_id,user_name from dev_engineer where business_id='$bid' ");
		 
		 $engineers_deatils=$engineers_deatils->result_array();
		
		$send_vandriver_deatials=array('key'=>$vandriverdeatils,'engineers_deatils'=>$engineers_deatils,'van'=>$van_id);
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('VanEngineer.php',$send_vandriver_deatials);
		$this->load->view('footer.php');
	}
	/*************************FetchVanEngineers***************************/
	public function FetchVanEngineers()
	{
		    
			 $van_id=$_GET['id'];
		
			 if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				  $listvanengineer=$this->db->query("select name,user_name,email,dev_van_engineer.id FROM dev_van_engineer, dev_engineer where dev_engineer.user_id=engineer_id && dev_van_engineer.van_id='$van_id'");
				 
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
				   $listvanengineer=$this->db->query("select name,user_name,email,dev_van_engineer.id FROM dev_van_engineer, dev_engineer where dev_engineer.user_id=engineer_id && dev_van_engineer.van_id='$van_id'");
				   
			  }   
			 
			   $listvanengineer=$listvanengineer->result_array();
			  
				 echo json_encode($listvanengineer); 
	}
	/**************************DeleteVanEngineers*********************/
	public function  DeleteVanEngineers()
	{
		$van_eng=$_GET['id'];   
		$van_id=$_GET['vanid'];
		
		
		$delete=$this->db->query("delete from  dev_van_engineer where id='$van_eng'");
		if($delete)
		{
			echo '<script>alert("Delete Van Engineer")</script>';
			redirect('VanEngineers?id='.$van_id);
			
		}
	}
	/*******************InsertVanProducts*******************/
	public function InsertVanProducts()
	{   
		  $products=$_POST['products'];
		  $stocklevels=$_POST['stocklevels'];
		  $reorderlevels=$_POST['reorderlevels'];
		  $InStocks=$_POST['InStocks'];
		  $vanid=$_POST['vanid'];
		  
		  $insertdata=array('van_id'=>$vanid,'in_stock'=>$InStocks,'recordlevel'=>$reorderlevels,'stocklevel'=>$stocklevels,'product_id'=>$products);
		  
		  $Tableinsert=$this->db->insert('products_van',$insertdata);
		  if( $Tableinsert)
		  {
			 echo "1";  
		  }else
		  {
			  echo "0";
		  }
	}
	/*********************VanAllOrder********************/
	public function VanAllOrder()
	{
		
		$van_id=$_GET['id'];
		
		 $vandriverdeatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
		
		$vandriverdeatils=$vandriverdeatils->result_array();
		
		 
		
		$send_vandriver_deatials=array('key'=>$vandriverdeatils,'van'=>$van_id);
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('VanAllorder.php',$send_vandriver_deatials);
		$this->load->view('footer.php');
	}
	
/*********************GetVanAllOrder*********************/	
	public function GetVanAllOrder()
		{ 
		    $van_id=$_GET['id'];
			if(isset($_SESSION['Current_Business']))
			{
				$business=$_SESSION['Current_Business']; 
				$orders=$this->db->query("select dev_orders.id id,po_reffrence,dev_orders.date date,givenprojectname,odrdescrp,dev_orders.total_ex_vat total_ex_vat,total_inc_vat,po_number,reorder,dev_orders.van_stock from dev_orders where dev_orders.business_id='$business' && dev_orders.status='0' && van_id='$van_id'");
				
				
			}
			else
			{
				$business=$_SESSION['status']['business_id'];
				$orders=$this->db->query("select dev_orders.id id,po_reffrence,dev_orders.date date,givenprojectname,odrdescrp,dev_orders.total_ex_vat total_ex_vat,total_inc_vat,po_number,reorder,dev_orders.van_stock from dev_orders where  dev_orders.status='0' && van_id='$van_id'");
					
			}
			$orders=$orders->result_array(); 
			$orders_array=array();
			foreach($orders as $new_array){
				if($new_array['van_stock']==1){
				$new_array['status']=1;
				}elseif($new_array['reorder']==1){
					$new_array['status']=2;
				}
				else $new_array['status']=0;
				
				$orders_array[]=$new_array;
				
			}
			
			
			echo json_encode($orders_array);
		}
		
	/****************************FetchVanEngineer*********************************/	
		 public function FetchVanEngineer()
	 {
		 
		  if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
	 }
	 else{
		
 
				   $bid=$_SESSION['status']['business_id'];
	 }
				   
			if(isset($_POST['search'])){
           $search =$_POST['search'];
            $response = array();
            $Get_Data= $this->db->query("SELECT email,user_name,user_id FROM dev_engineer WHERE (email like'%".$search."%' || user_name like '%".$search."%' )&& business_id='$bid' and user_id not in (select engineer_id from dev_van_engineer)");	
		    
         $Get_Data=$Get_Data->result_array();
		 foreach( $Get_Data as $Get_Dataa) {
 $response[] = array("value"=>$Get_Dataa['user_id'],"label"=>$Get_Dataa['email'].' ('.$Get_Dataa['user_name'].')');	
		 } 
		}
				   	
			   
		 echo json_encode($response);
		
	 }
	 
	 /******************************************/
	 
		public function PrintPdfTableForProducts()
		{
			if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				   
				    $dataobj=$this->db->query("select title,SKU,publish_status from  dev_products where business_id='$bid'");
					
				  
			   }
			  else
			  {
				  
				   $dataobj=$this->db->query("select title,SKU,publish_status from  dev_products");
				  
			  }
		 
		  $data=$dataobj->result_array();
		 $viewSend=array('values'=>$data);
		  $this->load->view('PrintViews/GenratePdfForproducts',$viewSend);  
		}	
		
		
		/**********************************/
		     public function MakeCsvFileForProducts()
        { 
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				  $dataobj=$this->db->query("select * from  dev_products where business_id='$bid'");
				  
			   }
			  else
			  {
				  
				  
				   $dataobj=$this->db->query("select * from  dev_products");
				  
			  }
	
		$data=$dataobj->result_array();


	
		 	  // Create an array of elements 

	  
		$list = array(array('id','Tsicode','Vat Deductable','Product Name','Title','Publish_Status','Products_image_one','PDF1','UniqueCode','tax class','Manufacture','Sku','Products_image_two','PDF2','PDF3','PDF4','PDF5','PDF6','supplierwithCost')); 
		foreach($data as $d)
		{
			$supplierCost=str_replace(',',';',$d['supplier_with_cost']);
			
			array_push($list,array($d['id'],$d['Tsicode'],$d['vat_deductable'],$d['product_name'],$d['title'],$d['publish_status'],$d['products_images'],$d['pdf_name'],$d['UniqueCodeForImport'],$d['tax_class'],$d['Manufacture'],$d['SKU'],$d['product_image_two'],$d['pdf2_name'],$d['pdf3_name'],$d['pdf4_name'],$d['pdf5_name'],$d['pdf6_name'],$supplierCost));
		}
		
		 // Open a file in write mode ('w') 
		 
		$fp = fopen('./images/csv/products.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/products.csv"; 	
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

/**********************************************/
  public function MakeCsvFileForvanstock()
        { 
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				  $dataobj=$this->db->query("select *,sum(products_van.in_stock) instock from dev_products,products_van where dev_products.id=product_id and business_id='$bid' group by product_id");
				
			   }
			  else
			  {
				  
				  
				   $dataobj=$this->db->query("select *,sum(products_van.in_stock) instock from dev_products,products_van where dev_products.id=product_id and  group by product_id");
				  
			  }
	
		$data=$dataobj->result_array();

		 	  // Create an array of elements 
		$list = array(array('Product Title','SKU','Stock qty','Status')); 
		foreach($data as $d)
		{
			if($d['publish_status']=='1'){$status="publish";}else{$status="Unpublish";}
			
			array_push($list,array($d['title'],$d['SKU'],$d['in_stock'],$status));
		}
		
		 // Open a file in write mode ('w') 
		 
		$fp = fopen('./images/csv/Vantock.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/Vantock.csv"; 	
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
	/*********************************************/
public function PrintPdfTableForvanstock()
		{
			if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				   
				    $dataobj=$this->db->query("select *,sum(products_van.in_stock) instock from dev_products,products_van where dev_products.id=product_id and business_id='$bid' group by product_id");
					
				  
			   }
			  else
			  {
				  
				   $dataobj=$this->db->query("select *,sum(products_van.in_stock) instock from dev_products,products_van where dev_products.id=product_id and group by product_id");
				  
			  }
		 
		  $data=$dataobj->result_array();
		 $viewSend=array('values'=>$data);
		  $this->load->view('PrintViews/GenratePdfForvanstock',$viewSend);  
		}	
	
/*************************PrintvanstockTable**************************/
public function PrintvanstockTable()
	  {
		   if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				    $dataobj=$this->db->query("select *,sum(products_van.in_stock) instock from dev_products,products_van where dev_products.id=product_id and business_id='$bid' group by product_id");
				  
			   }
			  else
			  {
				   $bid=$_SESSION['status']['business_id'];
				    $dataobj=$this->db->query("select *,sum(products_van.in_stock) instock from dev_products,products_van where dev_products.id=product_id and  group by product_id");
				  
			  }
	     
		    $data=$dataobj->result_array();
		  $viewSend=array('values'=>$data);
		  
		  $this->load->view('PrintViews/PrintvanstockTable.php',$viewSend);
		  
	  }	
	/**************************PrintvansTable*************************/
    public function PrintvansTable()
	  {
		   if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				    $dataobj=$this->db->query("select dev_vans.id, dev_vans.driver_name,dev_vans.vehicle_registration,dev_vans.make,dev_vans.model,dev_vans.type,concat(dev_engineer.email,'(',user_name,')') user_name   from dev_vans,`dev_van_engineer`,dev_engineer  where dev_vans.id=dev_van_engineer.van_id and `dev_van_engineer`.engineer_id=dev_engineer.user_id and dev_vans.business_id= '$bid'");
				  
			   }
			  else
			  {
				   $bid=$_SESSION['status']['business_id'];
				    $dataobj=$this->db->query("select dev_vans.id, dev_vans.driver_name,dev_vans.vehicle_registration,dev_vans.make,dev_vans.model,dev_vans.type,concat(dev_engineer.email,'(',user_name,')') user_name   from dev_vans,`dev_van_engineer`,dev_engineer  where dev_vans.id=dev_van_engineer.van_id and `dev_van_engineer`.engineer_id=dev_engineer.user_id");
				  
			  }
	     
		    $data=$dataobj->result_array();
		  $viewSend=array('values'=>$data);
		  
		  $this->load->view('PrintViews/PrintvansTable.php',$viewSend);
		  
	  }	
	  
	  /**********************MakeCsvFileforvans************************/
       public function MakeCsvFileForvans()
        { 
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				  $dataobj=$this->db->query("select dev_vans.id, dev_vans.driver_name,dev_vans.vehicle_registration,dev_vans.make,dev_vans.model,dev_vans.type,concat(dev_engineer.email,'(',user_name,')') user_name   from dev_vans,`dev_van_engineer`,dev_engineer  where dev_vans.id=dev_van_engineer.van_id and `dev_van_engineer`.engineer_id=dev_engineer.user_id and dev_vans.business_id= '$bid'");
				 
			   }
			  else
			  {
				  
				  
				   $dataobj=$this->db->query("select dev_vans.id, dev_vans.driver_name,dev_vans.vehicle_registration,dev_vans.make,dev_vans.model,dev_vans.type,concat(dev_engineer.email,'(',user_name,')') user_name   from dev_vans,`dev_van_engineer`,dev_engineer  where dev_vans.id=dev_van_engineer.van_id and `dev_van_engineer`.engineer_id=dev_engineer.user_id");
				  
			  }
	
		$data=$dataobj->result_array();
     
		 	  // Create an array of elements 
		$list = array(array('DRIVER NAME','VEHICLE REGISTRATION','MAKE','MODEL','TYPE','ENGINEER')); 
		foreach($data as $d)
		{
			
			
			array_push($list,array($d['driver_name'],$d['vehicle_registration'],$d['make'],$d['model'],$d['type'],$d['user_name']));
		}
		
		 // Open a file in write mode ('w') 
		 
		$fp = fopen('./images/csv/Vans.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/Vans.csv"; 	
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
        /**********************PrintPdfTableForvans*****************/
        public function PrintPdfTableForvans()
		{
			if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				   
				    $dataobj=$this->db->query("select dev_vans.id, dev_vans.driver_name,dev_vans.vehicle_registration,dev_vans.make,dev_vans.model,dev_vans.type,concat(dev_engineer.email,'(',user_name,')') user_name   from dev_vans,`dev_van_engineer`,dev_engineer  where dev_vans.id=dev_van_engineer.van_id and `dev_van_engineer`.engineer_id=dev_engineer.user_id and dev_vans.business_id= '$bid'");
					
				  
			   }
			  else
			  {
				  
				   $dataobj=$this->db->query("select dev_vans.id, dev_vans.driver_name,dev_vans.vehicle_registration,dev_vans.make,dev_vans.model,dev_vans.type,concat(dev_engineer.email,'(',user_name,')') user_name   from dev_vans,`dev_van_engineer`,dev_engineer  where dev_vans.id=dev_van_engineer.van_id and `dev_van_engineer`.engineer_id=dev_engineer.user_id");
				  
			  }
		 
		  $data=$dataobj->result_array();
		 $viewSend=array('values'=>$data);
		  $this->load->view('PrintViews/GenratePdfForVans',$viewSend);  
		}	
	
	 /**********************************************/
	 public function PrintReorderProductsTable()
	  {
		   if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				    $dataobj=$this->db->query("select * from dev_orders  where  reorder='1' && business_id= '$bid' && reorder_complete!=1");
				   
			   }
			  else
			  {
				   $bid=$_SESSION['status']['business_id'];
				    $dataobj=$this->db->query("select * from dev_orders  where  reorder='1' && reorder_complete!=1");
				  
			  }
	     
		    $data=$dataobj->result_array();
		  $viewSend=array('values'=>$data);
		  
		  $this->load->view('PrintViews/PrintReorderProductsTable.php',$viewSend);
		  
	  }	
	  /**************************************************/
	   public function MakeCsvFileForReorderproducts()
        { 
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				  $dataobj=$this->db->query("select * from dev_orders  where  reorder='1' && business_id= '$bid' && reorder_complete!=1");
				
			   }
			  else
			  {
				  
				  
				   $dataobj=$this->db->query("select * from dev_orders  where  reorder='1'  && reorder_complete!=1");
				  
			  }
	
		$data=$dataobj->result_array();
     
		 	  // Create an array of elements 
		$list = array(array('PO NUMBER','PROJECT','ORDER DESCRIPTION','TOTAL EX VAT','TOTAL INC VAT','ORDER TYPE')); 
		foreach($data as $d)
		{
			$order="Reorder"; 
			
			array_push($list,array($d['po_number'],$d['givenprojectname'],$d['odrdescrp'],$d['total_ex_vat'],$d['total_inc_vat'],$order));
		}
		
		 // Open a file in write mode ('w') 
		 
		$fp = fopen('./images/csv/Reorderproduct.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/Reorderproduct.csv"; 	
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

/****************************************************/
	 public function PrintPdfTableReorderproduct()
		{
			if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				   
				    $dataobj=$this->db->query("select * from dev_orders  where  reorder='1' && business_id= '$bid' && reorder_complete!=1");
					
				  
			   }
			  else
			  {
				  
				   $dataobj=$this->db->query("select * from dev_orders  where  reorder='1'  && reorder_complete!=1");
				  
			  }
		 
		  $data=$dataobj->result_array();
		 $viewSend=array('values'=>$data);
		  $this->load->view('PrintViews/PrintPdfTableReorderproduct',$viewSend);  
		}	  
	  
	  /*********************************************************/
	  
	  public function PrintVanProductsTable()
	  {
		  $van_id=$_GET['id'];
		  
				    $dataobj=$this->db->query("select products_van.recordlevel,products_van.toback_instock,products_van.in_stock,products_van.stocklevel,title,SKU,products_images,products_van.id FROM products_van, dev_products where dev_products.id=product_id  && products_van.van_id='$van_id'  ");
					 $data=$dataobj->result_array();
				   
				    $driverdeatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
		            $driverdeatils=$driverdeatils->result_array();
		
			
		    $data=$dataobj->result_array();
		  $viewSend=array('values'=>$data,'driverdata'=>$driverdeatils,'vanid'=>$van_id);
		  $this->load->view('PrintViews/PrintVanProductsTable.php',$viewSend);
		  
	  }	
	  /**************************PrintPdfTablevanproducts************************/
	  
	   public function PrintPdfTablevanproducts()
		{
			
			$van_id=$_GET['id'];
		  
			$dataobj=$this->db->query("select products_van.recordlevel,products_van.toback_instock,products_van.in_stock,products_van.stocklevel,title,SKU,products_images,products_van.id FROM products_van, dev_products where dev_products.id=product_id  && products_van.van_id='$van_id'");
			 $data=$dataobj->result_array();
		   
			$driverdeatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
			$driverdeatils=$driverdeatils->result_array();
		
			
		 
		  $data=$dataobj->result_array();
		 $viewSend=array('values'=>$data,'driverdata'=>$driverdeatils);
		  $this->load->view('PrintViews/PrintPdfTablevanproducts',$viewSend);  
		}	
        /**********************************************/
public function MakeCsvFileForvanProducts()
        { 
	
	
			$van_id=$_GET['id'];
		  
			$dataobj=$this->db->query("select products_van.recordlevel,products_van.toback_instock,products_van.in_stock,products_van.stocklevel,title,SKU,products_images,products_van.id FROM products_van, dev_products where dev_products.id=product_id  && products_van.van_id='$van_id'");
			 $data=$dataobj->result_array();
		  
			$driverdeatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
			$driverdeatils=$driverdeatils->result_array();
		
	
		$data=$dataobj->result_array();
     	

		 	  // Create an array of elements 
		$list = array(array('PRODUCT TITLE','SKU','STOCKLEVEL','REORDERLEVEL ','IN STOCK','ON ORDER','DRIVER NAME','VEHICLE REGISTRATION')); 
		foreach($data as $d)
		{
			
			
			array_push($list,array($d['title'],$d['SKU'],$d['stocklevel'],$d['recordlevel'],$d['in_stock'],$d['toback_instock'],$driverdeatils[0]['driver_name'],$driverdeatils[0]['vehicle_registration']));
		}
		
		 // Open a file in write mode ('w') 
		 
		$fp = fopen('./images/csv/vanproduct.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/vanproduct.csv"; 	
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
      /****************************************/
	    public function PrintQuotesTable()
	  {
		 
			 if(isset($_SESSION['Current_Business'])){$business=$_SESSION['Current_Business']; 
		$dataobj=$this->db->query("select *from dev_Quotes  where business_id='$business' ORDER BY id ASC");}
			
		else{
			$business=$_SESSION['status']['business_id'];
			$dataobj=$this->db->query("select *from dev_Quotes  where business_id='$business' ORDER BY id ASC");
		}
		   
		
			
		    $data=$dataobj->result_array();
			
		  $viewSend=array('values'=>$data);
		  $this->load->view('PrintViews/PrintQuotesTable.php',$viewSend);
		  
	  }	
	  
	  /**************************************************/
	   public function MakeCsvFileForQuotes()
        { 
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				   
				  $dataobj=$this->db->query("select * from dev_Quotes  where business_id='$bid' ORDER BY id ASC");
				
			   }
			  else
			  {
				  
				  
				   $dataobj=$this->db->query("select *from dev_Quotes  where ORDER BY id ASC");
				  
			  }
	
		$data=$dataobj->result_array();

		 	  // Create an array of elements 
		$list = array(array('DATE','REFRENCE NO.','TOTAL EX.VAT','TOTAL INC VAT')); 
		foreach($data as $d)
		{
			 //$newDate = date("d-m-Y", strtotime($d['date']));
			
			array_push($list,array($d['date'],$d['po_reffrence'],$d['total_ex_vat'],$d['total_inc_vat']));
		}
		
		 // Open a file in write mode ('w') 
		 
		$fp = fopen('./images/csv/Quotes.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/Quotes.csv"; 	
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
       /**************************************/
	    public function PrintPdfTableQuotes()
		{
			
			if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				   
				  $dataobj=$this->db->query("select * from dev_Quotes  where business_id='$bid' ORDER BY id ASC");
				
			   }
			  else
			  {
				  
				  
				   $dataobj=$this->db->query("select *from dev_Quotes  where ORDER BY id ASC");
				  
			  }
	
		$data=$dataobj->result_array();
		
			
		 
		  $data=$dataobj->result_array();
		 $viewSend=array('values'=>$data,'driverdata'=>$driverdeatils);
		  $this->load->view('PrintViews/PrintPdfTableQuotes.php',$viewSend);  
		}	
		
		/**************/
	
			public function TransferShelves()
			{
				$business_name=$this->db->query("select id,business_name from dev_business");
				$business_name=$business_name->result_array();
				
				$catalog_name=$this->db->query("select id,shelves_name from  dev_Shelves where business_id='15' ");
				$catalog_name=$catalog_name->result_array();
				
                $senddata=array('key'=>$business_name,'cat'=>$catalog_name);			
				
				$this->load->view('header.php');
				$this->load->view('sidebar.php');
				$this->load->view('TransferShelves.php',$senddata);
				$this->load->view('footer.php');
			}
			/****************/
			
			public function CopyAllShelve()
			{

				   if(!empty($this->session->userdata('Current_Business')))
					{
						$business_id = $this->session->userdata('Current_Business');
					}else
					{
						$business_id=$_SESSION['status']['business_id'];
					}

				$sourceBusinees=$_POST['sourceBusinees'];
				$DestinationBusiness=$_POST['DestinationBusiness'];
				$shelveids=$_POST['shelveids'];
				
				$Shelve_ids= implode(",",$shelveids);
				
				$Get_Shelve=$this->db->query("select * from dev_Shelves where id IN ($Shelve_ids)");
				$Get_Shelve=$Get_Shelve->result_array();
				
				foreach($Get_Shelve as $data ) // get all shelves data
				{
					$shelve_id=$data['id'];
					$shelve_name=$data['shelves_name'];
					$sort_order	=$data['sort_order'];

                    $this->db->select('*');
					$this->db->from('dev_Shelves');
					$this->db->where('business_id',$DestinationBusiness);
					$this->db->like('shelves_name',$shelve_name,'none');
					$shelve_data=$this->db->get();
                     
				   if($shelve_data->num_rows()) // check shelve exist or not in destination business
					{
                        
						$shelve_data=$shelve_data->result_array();
						$exist_shalve_id=$shelve_data[0]['id'];	
                        
						$Get_Section=$this->db->query("select * from dev_cetalog_section where Shelves_id=$shelve_id");
						$Get_Section=$Get_Section->result_array();
                        

						foreach($Get_Section as $Section_Data)
						{

							$section_id=$Section_Data['id'];
							$section_name=$Section_Data['section_name'];
							$cover_image=$Section_Data['cover_image'];
							$sort_order=$Section_Data['sort_order'];

							$this->db->select('*');
							$this->db->from('dev_cetalog_section');
							$this->db->where('Shelves_id',$exist_shalve_id);
							$this->db->like('section_name',$section_name,'none');
							$Section_data2=$this->db->get();
						
							if($Section_data2->num_rows()) // check cetalog_section exit or not 
							{
                                 
								$cetalog_section=$Section_data2->result_array();
								$exist_cetalog_section=$cetalog_section[0]['id'];	
		
                                $Get_Shelve=$this->db->query("select * from cetalouges where sectionid=$section_id");
								$Get_Shelve=$Get_Shelve->result_array();
                                
								foreach($Get_Shelve as $Shelve_data )
								{
                                  
									$Shelve_url=$Shelve_data['url'];
									$Shelve_image_to_display=$Shelve_data['image_to_display'];
									$Shelve_size=$Shelve_data['size'];
									$Shelve_description=$Shelve_data['description'];
									$shelve_sort_order=$Shelve_data['sort_order'];
									$Shelve_type=$Shelve_data['type'];
									 $name=$Shelve_data['name'];


									 $this->db->select('*');
									 $this->db->from('cetalouges');
									 $this->db->where('sectionid',$exist_cetalog_section);
									 $this->db->like('description',$Shelve_description,'none');
									 $Section_data3=$this->db->get();
									  $row=$Section_data3->num_rows();
									 
                                     if($row==0)
									 {
										

										$Send_New_Catalog=array('sectionid'=>$exist_cetalog_section	
										,'url'=>$Shelve_url,'image_to_display'=>$Shelve_image_to_display,'size'=>$Shelve_size,'description'=>$Shelve_description,'sort_order'=>$shelve_sort_order,'type'=>$Shelve_type,'name'=>$name);
										$done=$this->db->insert('cetalouges',$Send_New_Catalog);

									 }

								}
							
							}
							  else
							{
								
								$Send_New_Section=array('Shelves_id'=>$exist_shalve_id,'section_name'=>$section_name,'cover_image'=>$cover_image,'sort_order'=>$sort_order);
								
								$this->db->insert('dev_cetalog_section',$Send_New_Section);
								$last_Section_id=$this->db->insert_id();

								$Get_Shelve=$this->db->query("select * from cetalouges where sectionid=$section_id");
								$Get_Shelve=$Get_Shelve->result_array();
								
								foreach($Get_Shelve as $Shelve_data )
								{
									$Shelve_url=$Shelve_data['url'];
									$Shelve_image_to_display=$Shelve_data['image_to_display'];
									$Shelve_size=$Shelve_data['size'];
									$Shelve_description=$Shelve_data['description'];
									$shelve_sort_order=$Shelve_data['sort_order'];
									$Shelve_type=$Shelve_data['type'];
									 $name=$Shelve_data['name'];
									
									$Send_New_Catalog=array('sectionid'=>$last_Section_id,'url'=>$Shelve_url,'image_to_display'=>$Shelve_image_to_display,'size'=>$Shelve_size,'description'=>$Shelve_description,'sort_order'=>$shelve_sort_order,'type'=>$Shelve_type,'name'=>$name);
									$done=$this->db->insert('cetalouges',$Send_New_Catalog);
								}
								
							} 

					    }

					}
					else
					{
						// shelve not exit
						
						 $send_New_Shelve=array('shelves_name'=>$shelve_name,'business_id'=>$DestinationBusiness,'sort_order'=>$sort_order);
                          $this->db->insert('dev_Shelves',$send_New_Shelve);
                   	      $last_id=$this->db->insert_id();

							 $Get_Section=$this->db->query("select * from dev_cetalog_section where Shelves_id=$shelve_id");
							 $Get_Section=$Get_Section->result_array();
							 
							 foreach($Get_Section as $Section_Data)
							 {
								 $section_id=$Section_Data['id'];
								 $section_name=$Section_Data['section_name'];
								 $cover_image=$Section_Data['cover_image'];
								 $sort_order=$Section_Data['sort_order'];
								
								 $Send_New_Section=array('Shelves_id'=>$last_id,'section_name'=>$section_name,'cover_image'=>$cover_image,'sort_order'=>$sort_order,'business_id'=> $business_id);
								 $this->db->insert('dev_cetalog_section',$Send_New_Section);
								 $last_Section_id=$this->db->insert_id();
								 
								 $Get_Shelve=$this->db->query("select * from cetalouges where sectionid=$section_id");
								 $Get_Shelve=$Get_Shelve->result_array();
								 
								 foreach($Get_Shelve as $Shelve_data )
								 {
									 $Shelve_url=$Shelve_data['url'];
									 $Shelve_image_to_display=$Shelve_data['image_to_display'];
									 $Shelve_size=$Shelve_data['size'];
									 $Shelve_description=$Shelve_data['description'];
									 $shelve_sort_order=$Shelve_data['sort_order'];
									 $Shelve_type=$Shelve_data['type'];
									  $name=$Shelve_data['name'];
									 
									 $Send_New_Catalog=array('sectionid'=>$last_Section_id,'url'=>$Shelve_url,'image_to_display'=>$Shelve_image_to_display,'size'=>$Shelve_size,'description'=>$Shelve_description,'sort_order'=>$shelve_sort_order,'type'=>$Shelve_type,'name'=>$name,'bussinessid'=>$business_id);
									 $done=$this->db->insert('cetalouges',$Send_New_Catalog);
								 }
								 
							 }	 
					
				    }
				
								
			}
			echo "1";
		}

			
			/******************/
			public function GetShelveByBusiness()
			{
				$SourceBusinessid=$_POST['SourceBusinessid'];
				
				$Get_Shelve=$this->db->query("select id,shelves_name from  dev_Shelves where business_id=$SourceBusinessid");
				$Get_Shelve=$Get_Shelve->result_array();  
				
				echo json_encode($Get_Shelve);
			}
			
		/******************cateory list**************/	
		
		public function CategoryList()
		{   
			if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
		 } 
          else{
			  
			 
			  
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('CategoryList.php');
			  $this->load->view('footer.php');
			  
			 
		      }
		}
		
		public function AddNewCategoryList()
		{   
			if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
		 } 
          else{
			  
			  
			  
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('AddNewCategoryList.php');
			  $this->load->view('footer.php');
			  
			 
		      }
		}
        /********************/
		public function InsertCatList()
		{
			 if($this->input->post('categorylistbutton'))
			  {
				  $cat_name=$this->input->post('catlist');
				 $cat_array=array('catalog_list_name'=>$cat_name); 
				$inser_data=$this->db->insert('dev_categorylist',$cat_array);
				  if($inser_data)
				  {
					  redirect(base_url('CategoryList'));
				  }
			  }
		}
		
		/**************FetchCategoryList**************/
		public function FetchCategoryList()
		{
			$cat_data=$this->db->query("select * from dev_categorylist");
			$cat_data=$cat_data->result_array();
			
			echo json_encode($cat_data);
		}
	      /***********DeleteCategoryList***********/	
		  public function DeleteCategoryList()
		   {   
		   
              $CategoryList_id=$_GET['id'];	
			  
			  if( $CategoryList_id==13)
			  {
				$this->session->set_flashdata('message', 'can not delete  this list');
				redirect(base_url('CategoryList'));
			  }else
			  {
				$DeleteCategoryList=$this->db->query("delete from dev_categorylist where id='$CategoryList_id'");
				if($DeleteCategoryList)
				{
					redirect(base_url('CategoryList'));
				}
			  }
			 
		  }
		  /*****************************/
		   public function UpdateCategoryList()
		  {
           
            
			 if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
			 }else
			 {
			  

               $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('EditCategoryList.php');
			  $this->load->view('footer.php');
			 } 
			   
		  } 
		  
		  public function  EditCategoryList()
		  {
                 if($this->input->post('categorylistbutton'))
			  {    $catid=$this->input->post('catid');
				  $cat_name=$this->input->post('catlist');
				 $cat_array=array('catalog_list_name'=>$cat_name); 
				$this->db->where('id', $catid);
                $inser_data= $this->db->update('dev_categorylist', $cat_array);
				  if($inser_data)
				  {
					  redirect(base_url('CategoryList'));
				  }
			  } 
			  
		  }
		 /**********************/

		 public function AddCategoryInListCategory()
		{
			 if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
		 } 
          else{
			  
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('AddCategoryInListCategory.php');
			  $this->load->view('footer.php');
			  
			 
		      }
		}
		
		/*********************/
		 
		 public function integrateServiceM8()
		 {
		    
			if(isset($_POST['nsert_cat']))
			{
				/* if($webhook ==1)
				{
					
				}
				else
				{
					$message = 
				} */
			  if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
			   }
		      else
			  {
				   $bid=$_SESSION['status']['business_id'];
				   
			  }	
				
				
				$username=$this->input->post('name');
				$password=$this->input->post('Password');
				
				$tablename='dev_service_m8';
				$insert_array=array('username'=>$username,'password'=>$password,'business_id'=>$bid);
				
			
				$query=$this->db->query("select access_token,business_id,username from  dev_service_m8 where business_id='$bid' ");
				
				$num=$query->num_rows();
				
				
			
			   /* if($num >= 1)
				{
					// this business aleady integrate in ServiceM8
				$reult=$query->result_array();
				$save_username=$reult[0]['username'];
				$access_token=$reult[0]['access_token'];
				$business_id=$reult[0]['business_id'];	
					
				
					if($access_token!='')
					{
						
						
					}	
					
					
				}
				else
				{
						
				}	
				die ; */
			
				$last_id= $this->DataModel->Insertservicem8($insert_array,$tablename);
				
				if($last_id)
				{
					redirect(base_url('CreateOauthToken/'.$bid));			

					}	
			}else
			{
			 
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('integrateServiceM8.php');
			  $this->load->view('footer.php');
			}			  
		 }
		 
	/*****************************/	 
	public function GetAllCatsData()
	{
		$key = array();
		$img="https://app.pickmyorder.co.uk//images/applogo/productcomingsoon.png";
		$response = $this->DataModel->fetchLukinscategory(); 
		
		foreach($response as $cat_response)  //category
		{

			$Getcode = $cat_response['COM_Code'];
			$category_name = $cat_response['COM_Description']; 
			$Getcode  = substr($Getcode, 0, 3); 
			
			$Sub_catagory_Response = $this->DataModel->fetchLukinssubcategory($Getcode);
          
			foreach($Sub_catagory_Response as $Sub_catagory_Response1) //subcategory
			{
                $Getcode2 = $Sub_catagory_Response1['COM_Code'];
				$sub_category_name = $Sub_catagory_Response1['COM_Description'];
				$Getcode  = substr($Getcode2, 0, 6); 
				
				

				$Sub_Sub_catagory_Response = $this->DataModel->FetchLukinsSubSubCategory($Getcode,$Getcode2);
		
				foreach($Sub_Sub_catagory_Response as $Sub_Sub_catagory_Response1) //subsubcategory
				{
					
					$sub_sub_category_name = $Sub_Sub_catagory_Response1['COM_Description']; 
				    
					$total_data =array('category'=>$category_name,'subcategory'=>$sub_category_name,'subsubcategory'=>$sub_sub_category_name);
                       array_push($key,$total_data);
				}	
			}

			

		}	
                
		 

		   // Create an array of elements 
		$list = array(array('categoryName','cat-image','SubCategoryName','subcat-image','SuperSubCategoryName','supersucat-image','business-id','SupersubSubCategoryName','SupersubSubCategoryimage')); 

		//$list = array(array('categoryName','cat-image')); 
		foreach($key as $d)
		{   
			;
			 //$newDate = date("d-m-Y", strtotime($d['date']));
			
			//array_push($list,array($d['category'],$img,$d['subcategory'],$img,$d['subsubcategory'],$img));
			array_push($list,array($d['category'],$img));
		}
		
		 // Open a file in write mode ('w') 
		 
		$fp = fopen('./images/csv/catalldata.csv', 'w'); 
		  
		// Loop through file pointer and a line 
		foreach ($list as $fields) { 
			fputcsv($fp, $fields); 
		} 
		  
		fclose($fp);      
         $url = "./images/csv/catalldata.csv"; 	
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

	public function MakeCsvFileForShopify()
	{ 
		 $empty="";
	     $VariantGrams="0.00";
		 $VariantInventoryPolicy="deny";
		 $VariantFulfillmentService="manual";
		 $VariantRequiresShipping="TRUE";


		 if(!empty($this->session->userdata('Current_Business')))
			{
				$business_id = $this->session->userdata('Current_Business');
			}else
			{
				$business_id=$_SESSION['status']['business_id'];
			}

			$this->db->select('*');
			$this->db->from('dev_products');
			$this->db->where('business_id',$business_id);
			$data = $this->db->get()->result_array();


		
	$list = array(array('Handle','Title','Body (HTML)','Vendor','Tags','Published','Option1 Name','Option1 Value','Option2 Name','Option2 Value','Option3 Name','Option3 Value','Variant SKU','Variant Grams','Variant Inventory Tracker','Variant Inventory Qty','Variant Inventory','Variant Fulfillment Service','Variant Price','Variant Compare At Price','Variant Requires Shipping','Variant Taxable','Variant Barcode','Image Src','Image Position','Image Alt Text','Gift Card','SEO Title','SEO Description','Google Shopping / Google Product Category','Google Shopping / Gender','Google Shopping / Age Group','Google Shopping / MPN','Google Shopping / AdWords Grouping','Google Shopping / AdWords Labels','Google Shopping / Condition','Google Shopping / Custom Product','Google Shopping / Custom Label 0','Google Shopping / Custom Label 1','Google Shopping / Custom Label 2','Google Shopping / Custom Label 3','Google Shopping / Custom Label 4','Variant Image','Variant Weight Unit','Variant Tax Code','Cost per item','Status','Standard Product Type','Custom Product Type')); 
	foreach($data as $d)
	{
		$description=$d['description'];    
		$pdf_manual=$d['pdf_manual'];
		$pdf_manual2=$d['pdf_manual2'];
		$pdf_name=$d['pdf_name'];
		$pdf2_name=$d['pdf2_name'];
		
		$PDF1='</div>
		<div style="display: flex;">
		<div><a href="'.$pdf_manual.'" target="_blank"><img alt="pdf" src="https://app.pickmyorder.co.uk/images/applogo/1200px-PDF_file_icon.png" width="50" height="50"></a><p>'.$pdf_name.'</p>
		</div>';

		$PDF2='</div>
		<div style="display: flex;">
		<div><a href="'.$pdf_manual2.'" target="_blank"><img alt="pdf" src="https://app.pickmyorder.co.uk/images/applogo/1200px-PDF_file_icon.png" width="50" height="50"></a><p>'.$pdf2_name.'</p>
		</div>';
         
		
		



		if($pdf_manual=='' && $pdf_manual2=='')
		{
            $data=$description;
		}
		else if($pdf_manual2=='')
		{
			$data=$description.$PDF1;
		}
        else
        {
            $data=$description.$PDF1.' '.$PDF2;
        }
		
		

		array_push($list,array($d['title'],$d['title'],$data,$empty,$empty,$empty,$d['title'],$d['title'],$empty,$empty,$empty,$empty,$d['SKU'],$VariantGrams,$empty,$empty,$VariantInventoryPolicy,$VariantFulfillmentService,$d['ex_vat'],$empty,$VariantRequiresShipping,$empty,$empty,$d['products_images'],$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,$empty,"active",$empty,$empty));
	}
	
	 // Open a file in write mode ('w') 
	 
	$fp = fopen('./images/csv/shopify.csv', 'w'); 
	  
	// Loop through file pointer and a line 
	foreach ($list as $fields) { 
		fputcsv($fp, $fields); 
	} 
	  
	fclose($fp);      
	 $url = "./images/csv/shopify.csv"; 	
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

 public function Advertisment()
		{
			 if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
		 } 
          else{
			  
			  $Manage_carousel=$this->db->query("select * from dev_Manage_carousel");
			  $Manage_carousel=$Manage_carousel->result_array();
			  $data=array('key'=>$Manage_carousel);
			  
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('Advertisment.php',$data);
			  $this->load->view('footer.php');
			  
			 
		      }
		}

      public function AddNewAdvertisment()
		{
			 if(empty($this->session->userdata('status'))){
            redirect(base_url('index'));
		 } 
          else{
			 
			  if(isset($_POST['Insert_adv']))
			  {
				  
				 
				  $url=$this->input->post('URLfileto');
				  $fav_tab=$this->input->post('fav_tab');
				  $Publish_tab=$this->input->post('Publish_tab');
				  $selectbrand=$this->input->post('selectbrand');
				  $str_arr = explode (",", $selectbrand);
				  $brandname=$str_arr[0];
				  $brandname_id=$str_arr[1];
				 
				 
				  $brandname="Brand(".$brandname.")";
				  $fav_tab = ($brandname_id=='0') ? ($fav_tab) : ("3");
				  
				  if($fav_tab=='0')
				  {
					  $brandname='Category';
					 
				  }
			       else if($fav_tab=='1')
				   {
					  $brandname='wholesaler';
                       					  
				   }
			       else if($fav_tab=='2')
				   {
					   $brandname='Brands'; 
					   
				   }
				   
				   $source=$_FILES['filetoupload'];
				   $name=$_FILES['filetoupload']['name'];
				   $tmp_name=$_FILES['filetoupload']['tmp_name'];
				   $type=$_FILES['filetoupload']['type'];
				   $str_arrr = str_replace('/', ',', $type);
				   $str_arr = explode (",", $str_arrr);
				  $type=$str_arr[0];
				  $w=$str_arr[1];
				   
				  $name_EXTENSION = pathinfo($name, PATHINFO_EXTENSION);
				  $imagedata_renameimage=rand().time().'.'.$name_EXTENSION;
				  
                   if(move_uploaded_file($tmp_name,"images/applogo/".$imagedata_renameimage))
					{
						$image_url=base_url()."images/applogo/".$imagedata_renameimage;
						
			$inser_ads=array('status'=>$fav_tab,'url'=>$url,'source'=>$image_url,'Type'=>$type,'publish_status'=>$Publish_tab,'brands_id'=>$brandname_id,'status_name'=>$brandname);
						
						$insert=$this->db->insert('dev_Advertisment ',$inser_ads);
						if($insert)
						{
							redirect(base_url('Advertisment'));
						}	
						
					}
					 
			  } 
			  else
			  {
				  
			$brandbusiness=$this->db->query("select id,business_name from dev_business  where iswholeapp='3'");
			$brandbusiness=$brandbusiness->result_array();
			$data=array('key'=>$brandbusiness);  
			 
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('AddNewAdvertisment.php',$data);
			  $this->load->view('footer.php');
			  }
			 
		      }
		}

  public function Fetchads()
  {
	  $Advertisment=$this->db->query("select * from dev_Advertisment");
    $Advertisment=$Advertisment->result_array();
	
	echo json_encode($Advertisment);
  }

   public function Deleteads()
  {
	  $id=$this->input->get('id');
	  
	 $deleteadss =  $this->db->query("delete from dev_Advertisment where id='$id'");
	 if($deleteadss)
	 {
		redirect(base_url('Advertisment')); 
	 }
  }

      public function EditAdvertisment()
		{
		 if(empty($this->session->userdata('status'))){
          redirect(base_url('index'));
		    } 
			
           else
		   {
			 $id=$this->input->get('id');
			 $EditAdvertisment=$this->db->query("select * from dev_Advertisment where id='$id'");
             $EditAdvertisment=$EditAdvertisment->result_array();
			 
			$brandbusiness=$this->db->query("select id,business_name from dev_business  where iswholeapp='3'");
			$brandbusiness=$brandbusiness->result_array();
			 $data=array('key'=>$EditAdvertisment,'keytwo'=>$brandbusiness);
			  
			  $this->load->view('header.php');
			  $this->load->view('sidebar.php');
			  $this->load->view('EditAdvertisment.php',$data);
			  $this->load->view('footer.php');
		      }
		}

      public function DeleteAdsSource()
      {
		  
		$id =$this->input->post('id');  
		  
		 $updatesource=$this->db->query("update  dev_Advertisment SET source='',Type='' where id='$id'");
		 if($updatesource)
		 {
			 echo "1";
		 }  
	  }	  

      public function ReEnterAdvertisment() 
	  {
		  
		 
		 
		          $url=$this->input->post('URLfileto');
				  $fav_tab=$this->input->post('fav_tab');
				  $getid=$this->input->post('getid');
				  $Publish_tab=$this->input->post('Publish_tab');
				  $selectbrand=$this->input->post('selectbrand');
				  $str_arr = explode (",", $selectbrand);
				  $brandname=$str_arr[0];
				  $brandname_id=$str_arr[1];
				 
				 
				  $brandname="Brand(".$brandname.")";
				  $fav_tab = ($brandname_id=='0') ? ($fav_tab) : ("3");
				  
				  if($fav_tab=='0')
				  {
					  $brandname='Category';
					 
				  }
			       else if($fav_tab=='1')
				   {
					  $brandname='wholesaler';
                       					  
				   }
			       else if($fav_tab=='2')
				   {
					   $brandname='Brands'; 
					   
				   }
				  
				    $source=$_FILES['filetoupload'];
				   $name=$_FILES['filetoupload']['name'];
				   $tmp_name=$_FILES['filetoupload']['tmp_name'];
				   $type=$_FILES['filetoupload']['type'];
				   $str_arrr = str_replace('/', ',', $type);
				   $str_arr = explode (",", $str_arrr);
				  $type=$str_arr[0];
				  $w=$str_arr[1];
				   
				   
				   
				   if(!empty($name))
				   {
				  $name_EXTENSION = pathinfo($name, PATHINFO_EXTENSION);
				  $imagedata_renameimage=rand().time().'.'.$name_EXTENSION;
				  

                   if(move_uploaded_file($tmp_name,"images/applogo/".$imagedata_renameimage))
					{
						$image_url=base_url()."images/applogo/".$imagedata_renameimage;
						
						$inser_ads=array('status'=>$fav_tab,'url'=>$url,'source'=>$image_url,'Type'=>$type,'publish_status'=>$Publish_tab,'brands_id'=>$brandname_id,'status_name'=>$brandname);
						$this->db->where('id',$getid);
                        $update=$this->db->update('dev_Advertisment', $inser_ads);	
					}
				   }
				   else
				   {
					   $inser_ads=array('status'=>$fav_tab,'url'=>$url,'publish_status'=>$Publish_tab,'brands_id'=>$brandname_id,'status_name'=>$brandname);
					   $this->db->where('id',$getid);
                        $update=$this->db->update('dev_Advertisment', $inser_ads);
				   }
                    
					     if($update)
						{
							redirect(base_url('Advertisment'));
						}
				   
					  
	  }

    public function updatecarousel()
	 { 


$s3Client = new S3Client([
		'version' => 'latest',
		'region'  => 'eu-west-2',
		'credentials' => [
			'key'    => 'AKIAYBHU5TTPYJHCIU7M',
			'secret' => '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'
		]
	]);
	  
	  
	$bucket = 'pmo-s3-json-input-bucket';
	$file_Path = FCPATH.'/images/applogo/10064330831643280135.jpg';
	$key = basename($file_Path);
	  
	// Upload a publicly accessible file. The file size and type are determined by the SDK.
	try {
		$result = $s3Client->putObject([
			'Bucket' => $bucket,
			'Key'    => $key,
			'Body'   => fopen($file_Path, 'r'),
			'ACL'    => 'public-read', // make file 'public'
		]);
		echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
	} catch (Aws\S3\Exception\S3Exception $e) {
		echo "There was an error uploading the file.\n";
		echo $e->getMessage();
	}	  

		  /* $CategoryStatuss=$this->input->post('CategoryStatuss');
		  $Categorysec=$this->input->post('Categorysec');
		  
		  $WholesailerStatus=$this->input->post('WholesailerStatus');
		  $wholesalersec=$this->input->post('wholesalersec');
		  
		  $allBrandsStatus=$this->input->post('allBrandsStatus');
		  $Brandssec=$this->input->post('Brandssec');
		  
$data = array(array('id' => 1,'carousel_status' =>$CategoryStatuss,'carousel_time' =>$Categorysec),array('id' => 2,'carousel_status' =>$WholesailerStatus,'carousel_time' =>$wholesalersec),array('id' =>3,'carousel_status' =>$allBrandsStatus,'carousel_time' =>$Brandssec));
$update=$this->db->update_batch('dev_Manage_carousel ', $data, 'id');

 
	 echo "1"; */
 	 
	
	 }
	  
	 

	 
	 
	 

}  
	
	