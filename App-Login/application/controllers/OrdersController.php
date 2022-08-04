<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersController extends CI_Controller {
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
     $this->load->Model('SupplierModel');
	$this->load->Model('ProjectModel');
	//$this->load->library('Email_folder');
	}
	public function Orders(){
		
		if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('orders.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
	}
	public function OrdersByEngineer(){
		$Enid=$_POST['id'];

	$emptyarray=array();
	if(!$Enid=='0'){
		$orders=$this->db->query("select *from dev_orders where engineer_id='$Enid' && status='0' ORDER BY id ASC");
		
	   $orders=$orders->result_array();
	      }else{
			 	$orders=$this->db->query("select *from dev_orders where status='0' ORDER BY id ASC");
	   $orders=$orders->result_array(); 
		  }
	   foreach($orders as $or){
		  
	   array_push($emptyarray,array('id'=>$or['id'],'total_ex_vat'=>$or['total_ex_vat'],'date'=>$or['date'],'projectname'=>$or['givenprojectname'],'po_reffrence'=>$or['po_reffrence'],'total_inc_vat'=>$or['total_inc_vat'],'status'=>$or['status'],'engineer_id'=>$or['engineer_id'],'supplier_id'=>$or['supplier_id'],'odrdescrp'=>$or['odrdescrp'],'po_number'=>$or['po_number']));
	   }
	   print_r(json_encode($emptyarray));
	}
	/****************************************Export Order******************************************/
	public function ExportOrder()
	{
		
		$this->load->view('ExportOrder.php');
	
	}
	/*****************************************close*************************************************/
	public function AwatingOrdersByEngineer(){
		$Enid=$_POST['id'];
		$emptyarray=array();
		if(!$Enid=='0'){
			$orders=$this->db->query("select *from dev_orders where engineer_id='$Enid' && status='1' ORDER BY id ASC");
		}else{
			$orders=$this->db->query("select *from dev_orders where  status='1' ORDER BY id ASC");
		}
		   $orders=$orders->result_array();
		   
		   foreach($orders as $or){
		   array_push($emptyarray,array('id'=>$or['id'],'total_ex_vat'=>$or['total_ex_vat'],'date'=>$or['date'],'projectname'=>$or['givenprojectname'],'po_reffrence'=>$or['po_reffrence'],'total_inc_vat'=>$or['total_inc_vat'],'status'=>$or['status'],'engineer_id'=>$or['engineer_id'],'supplier_id'=>$or['supplier_id'],'odrdescrp'=>$or['odrdescrp'],'po_number'=>$or['po_number']));
		   }
		   print_r(json_encode($emptyarray));
		
	}
	public function AddLine(){
		
		if(isset($_SESSION['status'])){
			
			if($this->input->post('Add_product'))
			{
				$refnumber=$this->input->post('refnumber');
				//$this->input->post('Code');
				//$description=$this->input->post('description');
				$qty=$this->input->post('qty');
				//$this->input->post('Cost');
				//$this->input->post('supplier');
				$product=array("Reffrence_id"=>$refnumber,'qty'=>$qty,'ex_vat'=>'34','total_ex_vat'=>'22','	image'=>'base_url();/images/sub_cat/led/download%20(1).jpg','date'=>date("Y-m-d"));
				
				$table="dev_single_order";
				$insert=$this->DataModel->insert($table,$product);
				if($insert)
				{
					redirect('manageOrder?id='.$refnumber);
				}
			}
		    else
		    {
				
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('AddLine.php');
			$this->load->view('footer.php');
		    }
		}
		else
		{
				
			redirect('dashboard');
		}
		
	}
	/********************MultiOrderPrint function ******************/
	public function InsertIdinTableForPrint()
	{
		 if(isset($_POST['pid']))
		{
			$addedid=$_POST['pid'];
			
		 $allselected=$this->db->query("select array_of_ids from checked_id where id='1'");
		$fetchdata=$allselected->result_array();
		$privios=$fetchdata[0]['array_of_ids'];
		$newlist=$privios.','.$addedid;
		$updated_values=$this->db->query("UPDATE `checked_id` SET `array_of_ids`='$newlist' WHERE id='1'");  
		
		
		}
		else
		{
			echo "0";
		} 
	}
	/********************remove id's from table after print********************/
	public function UpdateIdinTableForPrint()
	{
	$this->db->query("UPDATE `checked_id` SET `array_of_ids`='' WHERE id='1'");
	
	}
	/************************close**********************************************/
	
	public function Printer()
	{
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('printer.php');
		$this->load->view('footer.php');
	}
	public function uncheckedaorderprint()   //unchecked a order thene remove it's id from table 
	{
		$unchecked_id=$_POST['unchked_id'];
		
		$Allids=$this->db->query("select array_of_ids from checked_id where id='1'");
		$Allids1=$Allids->result_array();
        $idsarray=explode(',',$Allids1[0]['array_of_ids']);      
		
		 if (($key = array_search($unchecked_id,$idsarray)) !== false) 
		{ 
			unset($idsarray[$key]);
		}	
		$newarray=implode(",",$idsarray); 
		
		$this->db->query("UPDATE checked_id SET array_of_ids='$newarray' where id='1'");
		/* $this->db->query("UPDATE `checked_id` SET  `array_of_ids` = CONCAT((TRIM(BOTH ',' FROM REPLACE(CONCAT(',', `array_of_ids`), ',$unchecked_id', ''))),',') WHERE FIND_IN_SET('$unchecked_id', `array_of_ids`)"); */
	}
	/************************END**********************************/
	public function ManageOrder(){
		if(isset($_SESSION['status'])){
	$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('ManageOrders.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
		
	}
	
	public function ManageReorder(){
		
		if(isset($_POST['addstock']))
		{ 
			
			
			$orderid=$_POST['orderid'];
			$order_van_id=$this->db->query("select * from dev_orders where id='$orderid'");
					$van_id_array=$order_van_id->result_array();
					$van_id=$van_id_array[0]['van_id'];
			$order_complete=1;
			
			foreach($_POST as $key=>$value)
			{
				$keys=explode('_',$key);
				
				if($keys[0]=='productid')
				{
					$product_id=$keys[1];
					
					$qty=$value;
					if($qty!='' && $qty>=1){
						
						$data=array('order_id'=>$orderid,'product_id'=>$product_id,'qty'=>$qty);
						$insert=$this->db->insert('dev_product_restock',$data);
						
						
						$select_instock="select in_stock,toback_instock,recordlevel from products_van where product_id='$product_id' and van_id=$van_id";
						$select_instock=$this->db->query($select_instock);
						
						$select_instock=$select_instock->result_array();
						
						 $totalinstock=$select_instock[0]['in_stock']+$qty;
						 
						 $toback_instock=$select_instock[0]['toback_instock'];
	 
						$toback_instock=$toback_instock-$qty;
						 
						
						
						$com_order=$this->db->query("update products_van set in_stock ='$totalinstock' where product_id='$product_id' and van_id=$van_id");
						 if($com_order && $totalinstock>$select_instock[0]['recordlevel'] ){
							$updatetoback_instock_product=$this->db->query("update products_van set toback_instock ='$toback_instock' where product_id='$product_id' and van_id=$van_id");
		 
						}
						
						
					}
					
					
						

				}
				
						
			}
			
			$select_single_order_query="select * from dev_single_order where Reffrence_id='$orderid'";
			$select_single_order_query=$this->db->query($select_single_order_query);
			$select_single_order_query=$select_single_order_query->result_array();
			foreach($select_single_order_query as $select_single){
				$product_id=$select_single['product_id'];
				$order_qty=$select_single['qty'];
				
				$get_added_qty=$this->db->query("select sum(qty) qty from dev_product_restock where product_id='$product_id' and order_id='$orderid'");
				$get_added_qty=$get_added_qty->result_array();
				$added_in_stock=$get_added_qty[0]['qty'];
				if($added_in_stock>=$order_qty){
					$order_complete=1;
					
				}
				else{
					$order_complete=0;
					break;
					
				}
				
			}
			if($order_complete==1){
				
				$com_order=$this->db->query("update dev_orders set reorder_complete='1' where id ='$orderid'");
				if($com_order)
				{
					redirect('ReorderProducts');
				}
				
			}
						
						
					
			
			
			
			
			
			
			
			
			
			
			
			
			
		}
		
		if(isset($_SESSION['status'])){
	$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('managereorder.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
		
	}
	
	
	
	
	
	public function EditManageOrder(){
		if(isset($_SESSION['status'])){
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('EditSingleOrder.php');
		$this->load->view('footer.php');
		}else{
			redirect('dashboard');
		}
		
	}
	public function UpdateQty(){ //function for update Qty of order
		
		$id=$_POST['id'];
		$value=$_POST['value'];
		$newtotalex=$_POST['total_ex'];
		
		$update=$this->db->query("update dev_single_order set qty='$value',total_ex_vat='$newtotalex' where id='$id'");
		
		if($this->db->affected_rows())
		{
			echo "1";
		}
else
{
	echo 0;
}	
	}
	
	public function GetProductBySkuID(){ // function for get product details for add line
		$SKU_ID=$_POST['SKU_ID'];
		 $Get_product=$this->db->query("select *from dev_products where id='$SKU_ID' || SKU='$SKU_ID'");
		 $Get_product=$Get_product->result_array();
		 
		 if($Get_product){
			 $arr=array();
			$product_id= $Get_product[0]['id'];
			$get_supplier=$this->db->query("select *from supplier_cost where 	product_id='$product_id'");
			$get_supplier=$get_supplier->result_array();
			$PDescription=$Get_product[0]['description'];             //get product 
			
			foreach($get_supplier as $supplier)
			{
				array_push($arr,array('supplier_name'=>$supplier['supplier_name'],
				'supplier_cost'=>$supplier['supplier_cost']));
				
			}
			
		print_r(json_encode(array('des'=>$PDescription,'arr'=>$arr)));
		 }else{
			 echo "0"; 
		 } 
	}
	public function GetSupplierCostBySkuID(){ // function for get product details for add line
		$Supplier_ID=$_POST['Supplier_ID'];
		 $Get_product=$this->db->query("select SupplierCOST from dev_supplier where id='$Supplier_ID' ");
		 $Get_product=$Get_product->result_array();
		 
		 if($Get_product){
			 
		print_r(json_encode($Get_product[0]));
		 }else{
			 echo "0"; 
		 } 
	}
	public function DeleteOrderFull(){
		$orderid=$_GET['id'];
		$po_reffrence=$this->db->query("select po_reffrence from dev_orders where id=$orderid");
		$po_reffrence=$po_reffrence->result_array();
        $po_reffrence=$po_reffrence[0]['po_reffrence'];
		$Delete=$this->db->query("delete from dev_orders where id=$orderid");
		if($Delete)
		{
			$DeleteFromSingleOrder=$this->db->query("delete from dev_single_order where Reffrence_id=$po_reffrence");
			if($DeleteFromSingleOrder)
			{
				redirect('orders');
			}
		}
	}
	public function DeleteSingleOrder(){
		$orderid=$_GET['id'];
		$refid=$_GET['refferid'];
		$Delete=$this->db->query("delete from dev_single_order where id=$orderid");
		if($Delete)
		{
			
				redirect(site_url('manageOrder?id='.$refid));
			
		}
	}
	public function getorderfromapp()         //store order in db api
	{
		
		$this->load->view('api/GetOrder.php');
	}
	public function getorderfromiosapp()         //order from ios api
	{
		
		$this->load->view('iosapi/GetOrderInIos.php');
	}
	public function SendOrderToApp()         //send order to app from db api
	{
		$this->load->view('api/UserOrderGroupApi.php');
		
	}
	public function SendAwatingOrderToApp()         //send pennding order to app from db api
	{
		$this->load->view('api/PendingOrderApi.php');
	
	}
	public function SendSingleOrderToApp(){    //send order to app from db api
		$this->load->view('api/UsersingleOrderApi.php');
	}
	public function ApproveOrderApi()
	{
		$this->load->view('api/aprrove_order');
	}
	public function Moredetails()
	{
		$this->load->view('api/OrderMoreDetails');
	}
	/*************************new api's function 25-01-2020*************************/
	public function NewSendSingleOrderToApp()
	{
		
       $this->load->view('api/NewUserSingleOrder.php');
	}
	public function Newgetorderfromapp()
	{
		$this->load->view('api/NewGetOrder.php');
	}
	/****************************************close****************************/
		public function GetQuotes()
	{
		
       $this->load->view('api/GetQuotes.php');
	}
	public function UserQuotesGroup()
	{
		
       $this->load->view('api/UserQuotesGroup.php');
	}
	
	public function UserSingleQuotes()
	{
		
       $this->load->view('api/UserSingleQuotes.php');
	}
	public function MakeAnOrderQuotes()
	{
		
       $this->load->view('api/MakeAnOrderQuotes.php');
	}
	
	public function ApproveOrderbyAdmin()
	{
		$Reffid=$_POST['poreff'];
		$pornum=$_POST['pornum'];
		$this->db->query("update dev_single_order SET status='0' where Reffrence_id='$Reffid' ");
		if($this->db->affected_rows())
		{
			$this->db->query("update dev_orders SET status='0' where po_reffrence='$Reffid' ");
			if($this->db->affected_rows())
		    {
				$this->SendMail($Reffid,$pornum);
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "0";
		}
	}
	public function CancleOrder()
	{
		$cancleid=$_POST['id'];
	
		$this->db->query("update dev_single_order SET status='2' where Reffrence_id='$cancleid' ");
		if($this->db->affected_rows())
		{
			$this->db->query("update dev_orders SET status='2' where po_reffrence='$cancleid' ");
			if($this->db->affected_rows())
		    {
			
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			echo "0";
		}
	}
	/***********************************ORDER UNDER PROJECT***************************/
	public function OrderUnderProject()
	{
		$this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('OrderUnderProject.php');
		$this->load->view('footer.php');
	}
	/****************************************CLOSE************************************/
	/*********************function for get data by selected days in dashboard***********************/
	  public function getordersbyselecteddays()
	  {
		  if(isset($_SESSION['Current_Business']))
			{
				$business_id=$_SESSION['Current_Business'];
			}
			else 
			{   
				$business_id=$_SESSION['status']['business_id'];
			}
		 $days=$_POST['days'];
		 $bid=$business_id;
		  $datediffrence=date('Y-m-d', strtotime("-$days days"));
		  if($bid!='0')
		  {
          $diffrancedata= $this->db->Query("SELECT *FROM dev_orders WHERE date(date) > '$datediffrence' && business_id='$bid'");
		  }
		  else
		  {
			$diffrancedata= $this->db->Query("SELECT *FROM dev_orders WHERE date(date) > '$datediffrence' ");  
		  }
	      echo $diffrancedata->num_rows(); 
		  
	  }
	/*************************************close********************************************************/
	/***************************Find top ordered product for dashboard*****************************/
	public function toporderedproduct()
	{
		$days=$_POST['days'];
		$idsdata=array();
		$datediffrence=date('Y-m-d', strtotime("-$days days"));
		 $fetchidandnumber=$this->db->query("SELECT product_id, COUNT(product_id) TotalCount FROM dev_single_order where date(date) > '$datediffrence' GROUP BY product_id HAVING COUNT(product_id) > 1"); 
		
		$thisisrealdata=$fetchidandnumber->result_array(); 
		  foreach($thisisrealdata as $data)
		  {
			  if($data['TotalCount']>2)
			  {
				  array_push($idsdata,$data['product_id']);
			  }
		  }
		  $comasprateid=implode(',',$idsdata);
		  if($comasprateid!='')
		  {
			 $senddata=$this->db->query("select * from dev_products where id in ($comasprateid) ");
			 $ajaxdata=$senddata->result_array();
			
			 echo json_encode($ajaxdata);
		  } 
	}
	/****************************************close********************************************/
	/**************function for send mail when approve order****************************/
	public function SendMail($editid,$rowid){
		$tabledata='';
 $select_order_query="select * from dev_orders where po_reffrence='$editid'";
		$select_order_query=$this->db->query($select_order_query);
	   $select_order_query1=$select_order_query->result_array();
	   if($select_order_query1){
		  
	    $total_ex=$select_order_query1[0]['total_ex_vat'];
	    $total_in=$select_order_query1[0]['total_inc_vat'];
		 $supplier_id=$select_order_query1[0]['supplier_id'];
		 	 $business_id=$select_order_query1[0]['business_id'];
			 $instruction=$select_order_query1[0]['instruction'];
			 $orderdes=$select_order_query1[0]['odrdescrp'];
	   }else{
		   $total_ex=0; 
		     $total_in=0;
			 $supplier_id=0;
			  $business_id=0;
			  $instruction='No Instruction';
			 $orderdes='';
	   }
	  $newvat=$total_in-$total_ex;
	      $select_single_order_query="select * from dev_single_order where Reffrence_id	='$editid'";
		$select_single_order_query=$this->db->query($select_single_order_query);
	   $select_single_order_query=$select_single_order_query->result_array();
	   /*************Deliver Or Collection det ******************/
	   if($select_single_order_query[0]['delivery_time']=='0' && $select_single_order_query[0]['delivery_Date']=='0')
	   {
		   $what1='none';
		    $what2='block';
		   $DelorCol='Collection';
		   $DelorColReal=$select_single_order_query[0]['collection_date'];
	   }
	   else
	   {
		   $what1='block';
		   $what2='none';
		   $DelorCol='Delivery';
		   $DelorColReal=$select_single_order_query[0]['delivery_Date'];
		   
	   } 
		 
		  
	     
		
		 
		 
	   foreach($select_single_order_query as $select_single1)
	   {
		   $product_id=$select_single1['product_id'];
		   $have_product_or_not=$select_single1['variation_id'];
	    $select_product_query=$this->db->query("select * from dev_products where id='$product_id'");
	   $select_product_query=$select_product_query->result_array();
	  $pdescription=$select_product_query[0]['title'];
	  $procode=$select_product_query[0]['product_name'];
	   if($have_product_or_not!='0')      //get varition item if have variation
	  {
		 $variation_option_name=$this->db->query("select * from dev_product_variation where id=$have_product_or_not ");
		 $variation_option_name=$variation_option_name->result_array();
 		 $procode=$variation_option_name[0]['pcode'];
		$pdescription=$variation_option_name[0]['description'];
	  }
	  $tabledata .=' 
	  <tr>
	          <td style="text-align: left;padding-top: 10px;">'.$procode.'</td>
			   <td style="text-align:center;padding-top: 10px;">'.$pdescription.'</td>
			  <td style="text-align:center;padding-top: 10px;">'.$select_single1['qty'].'</td>
		      <td style="text-align:center; padding-top: 10px;">£'.$select_single1['ex_vat'].'</td>
			  <td style="text-align:center;padding-top: 10px">'.$select_single1['vat_class'].'%</td>
			  <td  style="text-align:center; padding-top: 10px;">£'.$select_single1['total_ex_vat'].'</td>
	   </tr>';
	   }
	   if($select_single_order_query)
	   {
	 $project_id=$select_single_order_query[0]['project_id'];
	   }
	   else{
		   $project_id=0;
	   }
	 /***************select bussiness details*********************/
	 
		$select_bussiness_details=$this->db->query("select * from dev_business where id	='$business_id'");
	   $select_bussiness_details1=$select_bussiness_details->result_array();
	   if($select_bussiness_details1)
	   {
		   $business_name=$select_bussiness_details1[0]['business_name'];
		   $b_address=$select_bussiness_details1[0]['address'];
		   $b_post_code=$select_bussiness_details1[0]['post_code'];
		   $b_email=$select_bussiness_details1[0]['email'];
	   }
	   else
	   {
		   $business_name='';
		   $b_address='';
		   $b_post_code='';
		   $b_email='';
	   }
	   /*****************supplier******************************/
	    $select_supplier=$this->db->query("select * from dev_supplier where id='$supplier_id'");
		  $select_supplier=$select_supplier->result_array();
		$Project_data=$this->db->query("select * from dev_projects where id='$project_id'");
		  $Project_data=$Project_data->result_array();

$message='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style>td {vertical-align: -webkit-baseline-middle;}</style></head>

  <body style="font-family:lato;font-size:14px; padding:0px;margin:0px;"  >
 
  <table  width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f4f4f4; padding:20px 10px;">
  <tr>
  <td align="center">
      <table  style="border-bottom: 1px dotted #bfbebe;" width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	     <tr> 
		 <td style="width:200px;"><img style="width: 170px;" src="base_url();/images/applogo/newlogoleatest.png"/></td>
		     
			 <td style="width:200px;">
			    <ul style="
    width: 179px;list-style: none;margin-left: 187px;padding: 12px 12px;">
				  <li>'.$business_name.'</li>
				  <li>'.$b_address .'</li>
				  <li>'.$b_post_code.'</li>
				  <li>'.$b_email.'</li>
				  
			    </ul>
			 </td>
			 </tr>
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
					<td width="400px;"><h3 style="margin-left:14px;font-weight: bold;">PURCHASE ORDER</h3>
						<ul style="list-style:none; padding-left:0px;">
					<li>'.$select_supplier[0]['suppliers_name'].'</li>
		      <li>'.$select_supplier[0]['address'].'</li>
		      <li>'.$select_supplier[0]['suppliers_city'].'</li>
		      <li>'.$select_supplier[0]['post_code'].'</li>
		    
					</ul>
					
					</td>
					<td width="200px;">
					<ul style="list-style:none; padding-left:0px;">
					  <li><b>Purchase Order Date</b></li>
					   <li>'.$select_single_order_query[0]['date'].'</li><br/>
					   <li><b>'.$DelorCol.' Date</b></li>
					   <li>'.$DelorColReal.'</li><br/>
					   <li><b>Account Number</b></li>
					   <li>'.$select_supplier[0]['AccountNumber'].'</li><br/>
					   <li><b>Purchase Order Number</b></li>
					   <li>PO-'.$rowid.'</li>
					    <li><b>Order Description</b></li><li>'.$orderdes.'</li><br/>
					   
					  
					 
					</ul>
					
					</td>
			</tr>
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	   <tr>  
	   <th style="border-bottom: 2px solid #000;padding-bottom: 19px;width: 200px;text-align: left;
    padding-top: 33px;width:100px;">Product Code </th>
	<th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">Description</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">Quantity</th>
		      <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;"> Unit Price</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">VAT</th>
			  <th  style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;width:100px;">Total EX VAT</th>
	   </tr>
	   
	   '.$tabledata.'
	 
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="padding-bottom: 10px;text-align:center; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;">SUBTOTAL</td>
			  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.number_format((float)$total_ex, 2, '.', '').'</td>
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-left: 4px;padding-top: 10px;">TOTAL VAT</td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;">£'. number_format((float)$newvat, 2, '.', '').'</td>
			
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"><b>TOTAL</b></td>
			  <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£'.number_format((float)$total_in, 2, '.', '').'</td>
	   </tr>
	   
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:100px;display:'.$what1.';">
	
	<tr> <td style="width: 600;"><h2>DELIVERY DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Address</b></li>
					   <li>'.$Project_data[0]['Delivery_Address'].'</li>
					   <li>'.$Project_data[0]['delivery_city'].'</li>
					   <li>'. $Project_data[0]['delivery_postcode'].'</li>
					   
		            </ul>
	   </td>
	  
	   <td width="150px" style="padding-left: 50px;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Instructions</b></li>
					   <li>'. $instruction.'</li>
					 
		            </ul>
	   </td>
	</tr>
	
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:50px;display:'.$what2.';">
	
	<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Collection Address</b></li>
					   <li>'.$select_supplier[0]['suppliers_name'].'</li>
					   <li>'.$select_supplier[0]['address'].'</li>
					   <li>'.$select_supplier[0]['suppliers_city'].'</li>
					    <li>'.$select_supplier[0]['post_code'].'</li>
		            </ul>
	   </td>
	  
	   
	</tr>
	
	</table>
		 </td>
	  </tr>
	  </table>
</body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$to=$select_supplier[0]['email'];
 mail($to,'Purchase Order',$message,$headers);
}


/****************************Ordered by Project*************/
public function OrdersByProject(){
	
	$project_id=$_POST['id'];
	$emptyarray=array();
	if(!$project_id=='0'){
		$orders=$this->db->query("select *from dev_orders where givenprojectid='$project_id' && status='0' ORDER BY id ASC");
		
	   $orders=$orders->result_array();
	      }else{
			 	$orders=$this->db->query("select *from dev_orders where status='0' ORDER BY id ASC");
	   $orders=$orders->result_array(); 
		  }
	   foreach($orders as $or){
		  
	   array_push($emptyarray,array('id'=>$or['id'],'total_ex_vat'=>$or['total_ex_vat'],'date'=>$or['date'],'projectname'=>$or['givenprojectname'],'po_reffrence'=>$or['po_reffrence'],'total_inc_vat'=>$or['total_inc_vat'],'status'=>$or['status'],'engineer_id'=>$or['engineer_id'],'supplier_id'=>$or['supplier_id'],'odrdescrp'=>$or['odrdescrp'],'po_number'=>$or['po_number']));
	   }
	   print_r(json_encode($emptyarray));
	
}
/****************************AwatingOrdersByProject*************/
public function AwatingOrdersByProject(){
		$project_id=$_POST['id'];
		$emptyarray=array();
		if(!$project_id=='0'){
			$orders=$this->db->query("select *from dev_orders where givenprojectid='$project_id' && status='1' ORDER BY id ASC");
		}else{
			$orders=$this->db->query("select *from dev_orders where  status='1' ORDER BY id ASC");
		}
		   $orders=$orders->result_array();
		   
		   foreach($orders as $or){
		   array_push($emptyarray,array('id'=>$or['id'],'total_ex_vat'=>$or['total_ex_vat'],'date'=>$or['date'],'projectname'=>$or['givenprojectname'],'po_reffrence'=>$or['po_reffrence'],'total_inc_vat'=>$or['total_inc_vat'],'status'=>$or['status'],'engineer_id'=>$or['engineer_id'],'supplier_id'=>$or['supplier_id'],'odrdescrp'=>$or['odrdescrp'],'po_number'=>$or['po_number']));
		   }
		   print_r(json_encode($emptyarray));
		
	}

}
