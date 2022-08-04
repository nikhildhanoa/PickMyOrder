<?php error_reporting(0); 
if($_SESSION['status']['iswholseller'])
{
	$type="Users";
	$ishidden='none';
}
else
{
	$type="Engineers"; 
	$ishidden='block';
	if($this->DataModel->CheckBussinessStatus()==1)
	{
		$type="Users"; 
		$ishidden='none';
	}
}



?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<div class="container mainpage">


  <ul class="nav nav-tabs">
    
    <!--<li class="active"><a data-toggle="tab" href="#menu1">Manage Order</a></li>-->
     <li class="active"><a data-toggle="tab" href="#menu2">All Order</a></li>
	 
	  <li style="display:<?php echo $ishidden;?>" class="active"><a data-toggle="tab" href="#menu3">Awaiting Approval</a></li>
	
  </ul>

  <div class="tab-content">
    
   
  <div id="menu3" class="tab-pane background ">

          
		<div id="home"><h3 style="display: inline-block;">Awaiting Approval</h3>
		<form method="post"  style="display: inline-block; float: right; text-transform: uppercase;">
		<input type="hidden" name="orderchecked">
		<span>Select All</span> <input type="checkbox" class="allawait">
		 <li class="btn btn-info print_multiple">Print</li>
		 <li class="btn btn-info exportorder">Export CSV</li>
		 </form></div>
		<div class="container">
  <hr>
  
    <div class="row">
    <div class="col-md-6">
  <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
   <div class="form-group ">
      <label class="control-label col-sm-4" for="name"><?php echo $type;?> Name</label>
	
<div class="col-md-8">
      
	 <?php 
	 if(isset($_SESSION['Current_Business'])){
	 $Get_Data = $this->EngineerModel->Select_All_engineers($_SESSION['Current_Business']);
	 }
	 else
	 {
		 if(isset($_SESSION['status']))
		 {
			 
			 $Get_Data = $this->EngineerModel->Select_All_engineers($_SESSION['status']['business_id']);
			 if($_SESSION['status']['iswholseller'])
			 {
				$fromBusiness=$_SESSION['status']['business_id'];
				$engidata=$this->db->query("select * from dev_engineer where business_id='$fromBusiness' && wholeseller_status='1'");
				$Get_Data=$engidata->result_array();
			 }
		 }
		 else
		 {
			$Get_Data = $this->EngineerModel->Select_All_engineers(0);
		 }
	 }
	
	 ?>
		<div class="col-md-8">
		  <Select id="SelectByEngineer2" class="form-control">
		  <option value='0'>All <?php echo $type;?></option>
		  <?php foreach($Get_Data as $single){?>
		  <option value="<?php echo $single['user_id'];?>"><?php echo $single['name'];?></option>
		  <?php }?>
		 </select>
		</div>
		</div> 
	  </div>
	</div>
	</div>
	
<div class="col-md-6">
  <div class="form-horizontal">
 <!----------------Project-name------------------------->   
   <div class="form-group ">
      <label class="control-label col-sm-4" for="name">Project Name</label>
	
<div class="col-md-8">
      <?php 
	 if(isset($_SESSION['Current_Business'])){
	 $Get_Project_Data = $this->ProjectModel->Select_All_Project($_SESSION['Current_Business']);
	 }
	 else
	 {
		 if(isset($_SESSION['status']))
		 {
			 
			 $Get_Project_Data = $this->ProjectModel->Select_All_Project($_SESSION['status']['business_id']);
			 if($_SESSION['status']['iswholseller'])
			 {
				$fromBusiness=$_SESSION['status']['business_id'];
				$project =$this->db->query("select * from dev_projects where business_id='$fromBusiness' && wholeseller_status='1'");
				$Get_Project_Data=$project->result_array();
			 }
		 }
		 else
		 {
			$Get_Project_Data = $this->ProjectModel->Select_All_Project(0);
		 }
	 }
	
	 ?>
		<div class="col-md-8">
		  <Select id="SelectByProject1" class="form-control">
		  <option value='0'>All Project</option>
		  <?php foreach($Get_Project_Data as $single_project){ ?>
		 
		  <option value="<?php echo $single_project['id'];?>"><?php echo $single_project['project_name'];?></option>
		  <?php }?>
		 </select>
		</div>
		</div> 
	  </div>
	</div>
	</div>
 </div>
  
</div><hr>
  <table class="table table-striped" id="table2"> 
    <thead>
      <tr>
	  <th>Print</th>
        <th>PO No</th>
        <th>Date</th>
		<th>Project</th>
		<th>Order Description</th>
		<th>Total EX VAT</th>
		<th>Total INC VAT</th>
		<th>Status</th>
		<th>Edit</th>
		<!--<th>Delete</th>-->
      </tr>
    </thead>
    <tbody id="tbody2">	
	<?php if(isset($_SESSION['Current_Business'])){$business=$_SESSION['Current_Business']; 
	$orders=$this->db->query("select *from dev_orders  where status=1 && business_id='$business' ORDER BY id ASC");}
	else{
		$business=$_SESSION['status']['business_id'];
		$orders=$this->db->query("select *from dev_orders  where status=1 && business_id='$business' ORDER BY id ASC");
	}
	   $orders=$orders->result_array();
	
	  foreach($orders as $single_order){
		  
		 $po=$single_order['po_reffrence'];
		 $orders_des=$this->db->query("select order_desc from dev_single_order  where Reffrence_id='$po'");
		 $orders_des=$orders_des->result_array();
	?> 
      <tr>
	  <?php $aworderid=$single_order['po_number'];
	  $orderno=$single_order['po_reffrence'];
	  ?>
	  <td><input type="checkbox" class="check_list_await" id=<?php echo $single_order['po_reffrence'];?>></td>
       <td><a href="<?php echo site_url("manageOrder?id=$orderno&orderno=$aworderid");?>"><?php echo $aworderid;?></a></td>
		<td><?php echo $single_order['date'];?></td>
		<td><?php echo $single_order['givenprojectname'];?></td>
		<td style="width:300px"><?php echo $orders_des[0]['order_desc']; ?></td>
		<td>£<?php echo $single_order['total_ex_vat'];?></td>
		<td>£<?php echo $single_order['total_inc_vat'];?></td>
		<td><?php if($single_order['status']=='1'){ echo "Awating Approval";}else{echo "ordered";}?></td>
	
	 <td><a href="<?php echo site_url("manageOrder?id=$orderno&orderno=$aworderid");?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
		
		<!--<td><a href=<?php echo site_url("DeleteOrder?id=".$aworderid);?>><i class="fa fa-times-circle" aria-hidden="true"></i></a></td> -->
      </tr>      
	<?php  } ?>
	
    </tbody>
  </table>
  
</div>



<div id="menu2" class="tab-pane active background">

   
		<div id="home"><h3 style="display: inline-block;">All Orders</h3>
		<form method="post"  style="display: inline-block; float: right; text-transform: uppercase;">
		<input type="hidden" name="orderchecked">
		<span>Select All</span> <input type="checkbox" class="all">
		 <li class="btn btn-info print_multiple">Print</li>
		  <li class="btn btn-info exportorder">Export CSV</li>
		 </form>
		</div>
		 <div class="container">
  <hr>
  
 <div class="row">
    <div class="col-md-6">
		<div class="form-horizontal">
	 <!----------------busniss-name------------------------->   
	   <div class="form-group ">
		  <label class="control-label col-sm-4" for="name"><?php echo $type;?> Name</label>
			<div class="col-md-8">
				<div class="col-md-8">
					<Select id="SelectByEngineer" class="form-control" >
						<option value='0'>All <?php echo $type;?></option>
							<?php foreach($Get_Data as $single){?>
						<option value="<?php echo $single['user_id'];?>"><?php echo $single['name'];?></option>
						<?php }?>
				  </select>
				</div>
			</div>
		</div>
		</div>
	</div>
  
    <div class="col-md-6">
		<div class="form-horizontal">
		 <!----------------Project-name------------------------->   
		<div class="form-group ">
			<label class="control-label col-sm-4" for="name">Project Name</label>
			<div class="col-md-8">
				<div class="col-md-8">
				  <Select id="SelectByProject2" class="form-control">
					<option value='0'>All Project</option>
					  <?php foreach($Get_Project_Data as $single_project){ ?>
					<option value="<?php echo $single_project['id'];?>"><?php echo $single_project['project_name'];?></option>
					  <?php }?>
				 </select>
				</div>
			</div> 
		</div>
		</div>
	</div>
 
</div><hr>
  <table class="table table-striped" id="all_order">
    <thead>
      <tr>
	    <th>Print</th>
        <th>PO No</th>
        <th>Date</th>
		<th>Project</th>
		<th>Order Description</th>
		<th>Total EX VAT</th>
		<th>Total INC VAT</th>
		<th>Status</th>
		<!--<th>Export</th>-->
		<th>Edit</th>
		<!--<th>Delete</th>-->
      </tr>
    </thead>
    <tbody id="tbody">
<?php  if(isset($_SESSION['Current_Business'])){$business=$_SESSION['Current_Business'];}else{
	$business=$_SESSION['status']['business_id'];;
} $orders=$this->db->query("select *from dev_orders where status=0 && business_id='$business' ORDER BY id ASC ");
	   $orders=$orders->result_array();
	  
	    $onumber=1;
	  foreach($orders as $single_order){
		   $po=$single_order['po_reffrence'];
		 $orders_des=$this->db->query("select order_desc from dev_single_order  where Reffrence_id='$po'");
		 $orders_des=$orders_des->result_array();
	?>
      <tr >
	  <?php $orderid=$single_order['po_number']; 
	  $po_reffrence=$single_order['po_reffrence'];
	  ?>
       <td><input type="checkbox" class="check_list" id=<?php echo $single_order['po_reffrence'];?>></td>
      <td><a href="<?php echo site_url("manageOrder?id=$po_reffrence&orderno=$orderid");?>"><?php echo $orderid;?></a></td>
		<td><?php echo $single_order['date'];?></td>
		<td><?php echo $single_order['givenprojectname'];?></td>
		<td style="width:100px"><?php echo $orders_des[0]['order_desc'];?></td>
		<td>£<?php echo $single_order['total_ex_vat'];?></td>
		<td>£<?php echo $single_order['total_inc_vat'];?></td>
		<td><?php if($single_order['status']=='1'){ echo "Awating Approval";}else{echo "ordered";}?></td>
		<!--<td><a href="<?php echo site_url('exportcsv?refid='.$single_order['po_reffrence']);?>">CSV</a></td>-->
		<td><a href="<?php echo site_url("manageOrder?id=$po_reffrence&orderno=$orderid");?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
		
		<!--<td><a href=<?php echo site_url("DeleteOrder?id=".$orderid);?>><i class="fa fa-times-circle" aria-hidden="true"></i></a></td> 
		<td><i data-toggle="modal" data-target="#myModal" id="<?php echo $single_order['id'];?>" class="fa fa-times-circle delewithboot" aria-hidden="true" style="color:#5867dd"></i></td>-->
      </tr>      
	  <?php   } ?>
    </tbody>
  </table>
</div>
</div>
</div>

</div>
<!----Boot model --->
<div class="container mainpage">
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Alert !</h4>
		  <button type="button" class="close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
      
		   <div class="save_btn btn_sec2"> 
		   <a id="delhref" href="#" class="btn btn-info">DELETE</a>
		    <a  data-dismiss="modal" class="btn btn-info">Cancle</a>
		   </div>
		  
        </div>
      
      </div>
      
    </div>
  </div>
  </div>
<!----bott model----->
<!---------------------------------------multiple print------------------------------>
<?php 
$get_printable_value=$this->db->query("select array_of_ids from checked_id where id='1'");
$getvalue=$get_printable_value->result_array();
$allvalues=$getvalue[0]['array_of_ids'];
$arrayfordata=explode(',',$allvalues);
$numberofid=count($arrayfordata);
for($i=1;$i<=$numberofid-1;$i++)
{
$select_order_query="select * from dev_orders where po_reffrence='$arrayfordata[$i]'";

		$select_order_query=$this->db->query($select_order_query);
	   $select_order_query1=$select_order_query->result_array();
	   if($select_order_query1){
	    $total_ex=$select_order_query1[0]['total_ex_vat'];
	    $total_in=$select_order_query1[0]['total_inc_vat'];
		 $supplier_id=$select_order_query1[0]['supplier_id'];
		 	 $business_id=$select_order_query1[0]['business_id'];
			 $instruction=$select_order_query1[0]['instruction'];
	   }else{
		   $total_ex=0; 
		     $total_in=0;
			 $supplier_id=0;
			  $business_id=0;
			  $instruction='No Instruction';        
			 
	   }
	  
	  $newvat=$total_in-$total_ex;
	      $select_single_order_query="select * from dev_single_order where Reffrence_id	='$arrayfordata[$i]'";
		$select_single_order_query=$this->db->query($select_single_order_query);
	   $select_single_order_query=$select_single_order_query->result_array();
	   if($select_single_order_query)
	   {
	 $project_id=$select_single_order_query[0]['project_id'];
	 $product_id=$select_single_order_query[0]['product_id'];
	 
	 $delivery_Date=$select_single_order_query[0]['delivery_Date'];
	 $delivery_time=$select_single_order_query[0]['delivery_time'];
	 $collection_date=$select_single_order_query[0]['collection_date'];
	 $collection_time=$select_single_order_query[0]['collection_time'];
	   }
	   else{
		   $project_id=0;
		   $product_id=0;
	   }

	 
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
	    if($business_id=='3')
	   {
		 $logo= "base_url();/images/applogo/ccf29092014_00000.jpg";
	   }
	    if($business_id=='2')
	   {
		   $logo= "base_url();/images/applogo/newlogoleatest.png";
	   }
	    if($business_id=='1')
	   {
		   $logo= "base_url();/images/applogo/logo_led.png";
	   }
	    if($business_id=='0')
	   {
		    $logo= "base_url();/images/applogo/newlogoleatest.png";
	   }
	   ?>	
	   <style>
		   @media print{a[href]:after{content:none;}
			}
			@media print {
				/* Hide everything in the body when printing... */
				.mainpage{ display: none; }
				 #kt_subheader{ display: none !important;}
			   #kt_header{ display: none !important;}
			   #kt_aside{ display: none !important;}
				/* ...except our special div. */
				body.printing #DivIdToPrint { display: block; }
			}

			@media screen {
				/* Hide the special layer from the screen. */
				#DivIdToPrint { display: none; }
			}
		</style>
<div id='DivIdToPrint'  style="text-align:center;margin:0 auto">

    <style>
  td {
    
    vertical-align: -webkit-baseline-middle;
}
</style>
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background:#f4f4f4; padding:20px 10px;">
  <tr>
  <td align="center">
      <table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	     <tr> 
		 <td style="width:200px;"><img style="width: 200px;" src="<?php echo $logo; ?>"/></td> 
			<td style="width:200px;">
			    <ul style="
    width: 179px;list-style: none;margin-left: 150px;padding: 12px 12px;">
				  <li><?php echo $business_name ?></li>
				  <li><?php echo $b_address ?></li>
				  <li><?php echo $b_post_code ?></li>
				  <li><?php echo $b_email ?></li>
				  
			    </ul>
			 </td>
			 </tr>
	</table>
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
					<td width="400px;"><h3 style="font-weight: bold;">PURCHASE ORDER</h3>
						<ul style="list-style:none; padding-left:0px;">
					<li><?php  echo $select_supplier[0]['suppliers_name'];?></li>
		      <li><?php   echo $select_supplier[0]['address'];	?></li>
		      <li><?php   echo $select_supplier[0]['suppliers_city'];	?></li>
		      <li><?php     echo $select_supplier[0]['post_code'];	?></li>
		    
					</ul>
					
					</td>
					<td width="200px;">
					<ul style="list-style:none; padding-left:0px;">
					  <li><b>Purchase Order Date</b></li>
					   <li><?php  echo  $select_single_order_query[0]['date'];	?></li><br/>
					   <li><b><?php if($delivery_Date=='0' && $delivery_time=='0'){ echo "Collection";}else{ echo "Delivery";} ?> Date</b></li>
					   <li><?php if($delivery_Date=='0' && $delivery_time=='0'){ echo  $select_single_order_query[0]['collection_date']; }else { echo $select_single_order_query[0]['delivery_Date']; }	?></li><br/>
					   <li><b>Account Number</b></li>
					   <li><?php echo $select_supplier[0]['AccountNumber'] ;?></li><br/>
					   <li><b>Purchase Order Number</b></li>
					   <li><?php echo 'PO-'.$orderno;?></li><br/>
					   <br/>
					  <!-- <li><b>VAT Number</b></li>
					   <li>316383114</li><br/>-->
					</ul>
				</td>
			</tr>
	</table>
	
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center">
	   <tr>  
	   <th style="border-bottom: 2px solid #000;padding-bottom: 19px;width: 200px;text-align: left;
    padding-top: 33px;"> Product Code</th>
	<th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">Description</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">Quantity</th>
		      <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;"> Unit Price</th>
			  <th style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">VAT</th>
			  <th  style="border-bottom: 2px solid #000;padding-bottom: 19px;
    padding-top: 33px;">Total EX VAT</th>
	   </tr>
	   <?php foreach($select_single_order_query as $select_single){
		   $product_id=$select_single['product_id'];
		   $have_product_or_not=$select_single['variation_id'];
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
		   ?>
	   <tr>  
	          <td style="text-align: left;padding-top: 10px;"><?php echo $procode ; ?></td>
			  <td style="text-align: left;padding-top: 10px;"><?php echo $pdescription; ?></td>
			  <td style="text-align:center;padding-top: 10px;"><?php echo $select_single['qty']; ?></td>
		      <td style="text-align:center; padding-top: 10px;"><?php echo $select_single['ex_vat']; ?></td>
			  <td style="text-align:center;padding-top: 10px;"><?php echo $select_single['vat_class']; ?>%</td>
			  <td  style="text-align:center; padding-top: 10px;"><?php echo $select_single['total_ex_vat']; ?></td>
	   </tr>
	   <?php } ?>
	  
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="padding-bottom: 10px;text-align:center; padding-top: 10px;"></td>
			  <td style="padding-bottom: 10px;text-align:center;padding-top: 10px;">Subtotal</td>
			  <td  style="padding-bottom: 10px;text-align:center; padding-top: 10px;">£<?php echo number_format((float)$total_ex, 2, '.', ''); ?></td>
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-left:10px; padding-top: 10px;">TOTAL VAT</td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;">£<?php echo number_format((float)$newvat, 2, '.', '');?></td>
			
	   </tr>
	   <tr>  
	   <td style="padding-bottom: 10px;text-align: left; padding-top: 10px;border-bottom: 1px solid #000;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"></td>
		      <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:right; padding-top: 10px;"></td>
			  <td style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center;padding-top: 10px;"><b>TOTAL</b></td>
			  <td  style="border-bottom: 1px solid #000;padding-bottom: 10px;text-align:center; padding-top: 10px;">£<?php echo number_format((float)$total_in, 2, '.', '');?></td>
	   </tr>
	   
	</table>
	
	<table width="600px"  border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display: <?php if($delivery_Date=='0' && $delivery_time=='0'){?> none;<?php } ?>">
	
	<tr> <td style="width: 600;"><h2>DELIVERY DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Address</b></li>
					   <li><?php echo $Project_data[0]['Delivery_Address']; ?></li>
					   <li><?php echo $Project_data[0]['delivery_city']; ?></li>
					   <li><?php echo $Project_data[0]['delivery_postcode']; ?></li>
					   
		            </ul>
	   </td>
	  
	   <td width="150px" style="padding-left: 50px;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Instructions</b></li>
					   <li><?php echo $instruction;?></li>
					 
		            </ul>
	   </td>
	</tr>
	</table>
	<table width="600px"  border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:140px;display: <?php if($delivery_Date=='0' && $delivery_time=='0'){ ?> block;<?php }else{ ?>none<?php } ?>">
	
	<tr> <td style="width: 600;"><h2>COLLECTION DETAILS</h2></td></tr>
	<tr> 
	   <td width="200px"  style="border-right: 1px solid #d8d4d4;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Collection Address</b></li>
					   <li><?php  echo $select_supplier[0]['suppliers_name'];?></li>
					   <li><?php   echo $select_supplier[0]['address'];	?></li>
					   <li><?php   echo $select_supplier[0]['suppliers_city'];	?></li>
					   <li><?php     echo $select_supplier[0]['post_code'];	?></li>
		            </ul>
	   </td>
	  
	 <!--  <td width="150px" style="padding-left: 50px;" >
					<ul style="list-style:none; padding-left:0px;">
		               <li><b>Delivery Instructions</b></li>
					   <li><?php //echo $instruction;?></li>
					 
		            </ul>
	   </td>-->
	</tr>
	</table>
		 </td>
	  </tr>
	  </table>
</div><?php } ?>
<!-----------------------------------------close-------------------------------------->
<script>

 jQuery('#SelectByEngineer').change(function(){
	
	  id = $(this).val(); 
	 $("#tbody").empty();
	 jQuery.ajax({
		
		url:"<?= base_url('')?>OrdersByEngineer",
		method:"POST",
		data:{'id': id},
		success:function(d){
			
			var status;
			 obj = jQuery.parseJSON(d);
			 
			 length=obj.length;
			
		for(i=0;i<=length-1;i++){
			console.log(obj[i]);
			if(obj[i].status=='1')
			{
				status='Awating Approval';
			}
			else
			{
				status='Ordered';
			}
			
			  var $row = $('<tr>'+
	  '<td><input type="checkbox" class="check_list" id='+obj[i].id+ '>'+
      '<td>'+obj[i].po_number+'</td>'+
      '<td>'+obj[i].date+'</td>'+
	  '<td>'+obj[i].projectname+'</td>'+
      '<td>'+obj[i].odrdescrp+'</td>'+
	   '<td>'+obj[i].total_ex_vat+'</td>'+
	    '<td>'+obj[i].total_inc_vat+'</td>'+	
		 '<td>'+status+'</td>'+
		  '<td><a href="<?= base_url('')?>/manageOrder?id='+obj[i].po_reffrence+'&orderno='+obj[i].po_number+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'+
		   
      '</tr>');    
if(obj.Type=='Error') {
    $row.append('<td>'+ obj.ErrorCode+'</td>');
}

$('#all_order tbody').append($row);
		}
		
		}
			 
			 
 }); 
 });
 
 /***************************Awating approvel***********************/
 jQuery('#SelectByEngineer2').change(function(){
	
	 id=$(this).val(); 
	 $("#tbody2").empty();
	 jQuery.ajax({
		
		url:"<?= base_url('')?>AwatingOrdersByEngineer",
		method:"POST",
		
		data:{'id': id},
		success:function(d){
			
			 obj=jQuery.parseJSON(d);
			
			 length=obj.length;
			
		for(i=0;i<=length-1;i++){
			 var $row = $('<tr>'+
	  '<td>'+ ''+
      '<td>'+obj[i].po_number+'</td>'+
      '<td>'+obj[i].date+'</td>'+
	  '<td>'+obj[i].projectname+'</td>'+
      '<td>'+obj[i].odrdescrp+'</td>'+
	   '<td>'+obj[i].total_ex_vat+'</td>'+
	    '<td>'+obj[i].total_inc_vat+'</td>'+	
		 '<td>'+"Awating Approval"+'</td>'+
		  '<td><a href="<?= base_url('')?>/manageOrder?id='+obj[i].po_reffrence+'&orderno='+obj[i].po_number+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'+
		   
      '</tr>');    
	  
if(obj.Type=='Error') {
    $row.append('<td>'+ obj.ErrorCode+'</td>');
}

$('#table2> tbody').append($row);


		}
		}
			 
 }); 
 
 });
$('.delewithboot').click(function(){
	thisorderid=$(this).attr('id');
	$('#delhref').attr("href", "<?= base_url('')?>DeleteOrder?id="+thisorderid);
});

/****************************export order in csv***************/
$('.exportorder').click(function(){

      location.href = "<?= base_url('')?>ExportOrder";
	    $('.check_list').prop('checked',false); 
		 $('.check_list_await').prop('checked',false); 
		 $('.all').prop('checked',false); 
		 $('.allawait').prop('checked',false); 
   	 			 
});
/*****************************close***************************/
/*********************************click print button******************************/
$('.print_multiple').click(function(){
      location.href = "<?= base_url('')?>gotoprinter";
			 
});
$('.check_list ,.check_list_await').change(function(){
	if(this.checked) {
           $chekedid=$(this).attr('id');
		   $.ajax({
			   url:"<?= base_url('')?>insertidintableforprint",
			   type:"post",
			   data:{'pid':$chekedid},
			  
		   });
        }
});
$('.check_list ,.check_list_await').change(function(){
	if(!this.checked) {
         $chekedid=$(this).attr('id');
		   $.ajax({
			   url:"<?= base_url('')?>uncheckedaorderprint",
			   type:"post",
			   data:{'unchked_id':$chekedid},
			  
		   });
        }
});
$('.all').change(function(){
	if(this.checked) 
	{
		  $('.check_list').prop('checked',true);
           AllOrdersid=document.getElementsByClassName('check_list');
		    $lenth= AllOrdersid.length;
				
			for($i=0;$i<$lenth;$i++)
			{
				$chekedid=AllOrdersid[$i].id;
				 $.ajax({
			   url:"<?= base_url('')?>insertidintableforprint",
			   type:"post",
			   data:{'pid':$chekedid}, 
		            });
		
			}			
    }
	if(!this.checked) 
	{
		  $('.check_list').prop('checked',false); 
		  $.ajax({
   		 url:"<?= base_url('')?>UpdateIdinTableForPrint",	
   	      });
    }
});
$('.allawait').change(function(){
	if(this.checked) 
	{
		  
		  //$('.check_list_await').prop('checked',true);
           AllOrdersidaw=document.getElementsByClassName('check_list_await');
		    $lenth= AllOrdersidaw.length;
				
			for($i=0;$i<$lenth;$i++)
			{
				$chekedid=AllOrdersidaw[$i].id;
				 $.ajax({
						url:"<?= base_url('')?>insertidintableforprint",
						type:"post",
						data:{'pid':$chekedid}, 
		            });
		
			}	
    }
	if(!this.checked) 
	{
		  
		   $('.check_list_await').prop('checked',false); 
		  $.ajax({
   		 url:"<?= base_url('')?>UpdateIdinTableForPrint",	
   	      });
    }
});
/****************************************close Multiple Print**********************************/



/***************************SelectByProject***********************/
jQuery('#SelectByProject2').change(function(){
	
		id = $(this).val();		
		$("#tbody").empty();
	jQuery.ajax({
		
		url:"<?= base_url('')?>OrdersByProject",
		method:"POST",
		data:{'id': id},
		success:function(d){
			
			var status;
			 obj = jQuery.parseJSON(d);
			 
			 length=obj.length;
			
			for(i=0;i<=length-1;i++){
				console.log(obj[i]);
				if(obj[i].status=='1')
				{
					status='Awating Approval';
				}
				else
				{
					status='Ordered';
				}
				
				  var $row = $('<tr>'+
						'<td><input type="checkbox" class="check_list" id='+obj[i].id+ '>'+
						'<td>'+obj[i].po_number+'</td>'+
						'<td>'+obj[i].date+'</td>'+
						'<td>'+obj[i].projectname+'</td>'+
						'<td>'+obj[i].odrdescrp+'</td>'+
						'<td>'+obj[i].total_ex_vat+'</td>'+
						'<td>'+obj[i].total_inc_vat+'</td>'+	
						'<td>'+status+'</td>'+
						'<td><a href="<?= base_url('')?>/manageOrder?id='+obj[i].po_reffrence+'&orderno='+obj[i].po_number+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'+
					'</tr>');    
				if(obj.Type=='Error') {
					$row.append('<td>'+ obj.ErrorCode+'</td>');
				}

				$('#all_order tbody').append($row);
			}
		}
	}); 
 });
 
/*************************** SelectByProject Awating approvel***********************/
 jQuery('#SelectByProject1').change(function(){
	
	 id=$(this).val();
	 $("#tbody2").empty();
	 jQuery.ajax({
		
		url:"<?= base_url('')?>AwatingOrdersByProject",
		method:"POST",
		data:{'id': id},
		success:function(d){
			
				 obj=jQuery.parseJSON(d);
				 length=obj.length;
				
			for(i=0;i<=length-1;i++){
				var $row = $('<tr>'+
					'<td>'+ ''+
					'<td>'+obj[i].po_number+'</td>'+
					'<td>'+obj[i].date+'</td>'+
					'<td>'+obj[i].projectname+'</td>'+
					'<td>'+obj[i].odrdescrp+'</td>'+
					'<td>'+obj[i].total_ex_vat+'</td>'+
					'<td>'+obj[i].total_inc_vat+'</td>'+	
					'<td>'+"Awating Approval"+'</td>'+
					'<td><a href="<?= base_url('')?>/manageOrder?id='+obj[i].po_reffrence+'&orderno='+obj[i].po_number+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'+
				   
				'</tr>');    
			  
				if(obj.Type=='Error') {
					$row.append('<td>'+ obj.ErrorCode+'</td>');
				}

				$('#table2> tbody').append($row);
			}
		}
			 
	}); 
 
 });
 </script>
