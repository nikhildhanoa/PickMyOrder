<?php 
if(isset($_GET['id']))
{
	$Projectid=$_GET['id'];
}
		$engdata = $this->db->query("select engineer_array from dev_projects where id='$Projectid'");
		$Get_engi =$engdata->result_array();
		$engi = $Get_engi[0]['engineer_array'];
		
		$engineer_name = explode(",",$engi);
		
		
	
		
		
	
?>
<div class="container mainpage">
  <ul class="nav nav-tabs">
    
    <!--<li class="active"><a data-toggle="tab" href="#menu1">Manage Order</a></li>-->
     <li class="active"><a data-toggle="tab" href="#menu2">All Order</a></li>
	
	 
  </ul>

  <div class="tab-content">

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
				  <label class="control-label col-sm-4" for="name">Engineer</label>
					<div class="col-md-8">
						<div class="col-md-8">
					
							<Select id="SelectByProEngineer" class="form-control" >
							<option >Engineer</option>
								<?php
								for($i=0;$i<count($engineer_name );$i++)
								{
									$nameWithId = explode("[",$engineer_name[$i]);
								?>
								<option value="<?php print_r($nameWithId[1]); ?>"><?php print_r($nameWithId[0]); ?></option>
								<?php } ?>
							</select>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
 
  
    <div class="row">
    <div class="col-md-6">
  
  
  <div class="form-horizontal">
 <!----------------busniss-name------------------------->   
 

  
</div>
  
  </div>
  
    <div class="col-md-6"></div>
  
  
</div><hr>
  <table class="table table-striped" id="all_order">
    <thead>
      <tr>
	    <th>Print</th>
        <th>PO No</th>
        <th>Date</th>
		<th>Engineer Name</th>
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
} $orders=$this->db->query("select *from dev_orders where status=0 && givenprojectid='$Projectid' ORDER BY id ASC ");
	   $orders=$orders->result_array();
	   
	    $onumber=1;
	  foreach($orders as $single_order){
		
		$engineer_id = $single_order['engineer_id'];
		$engineer = $this->db->query("select name from dev_engineer  where id='$engineer_id '");
		$engineer_name = $engineer->result_array();
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
		<td><?php echo $engineer_name[0]['name'];?></td>
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
  <script>
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
$('.check_list').change(function(){
	if(this.checked) {
           $chekedid=$(this).attr('id');
		   $.ajax({
			   url:"<?= base_url('')?>insertidintableforprint",
			   type:"post",
			   data:{'pid':$chekedid},
			  
		   });
        }
});
$('.check_list').change(function(){
	if(!this.checked) {
         $chekedid=$(this).attr('id');
		   $.ajax({
			   url:"<?= base_url('')?>uncheckedaorderprint",
			   type:"post",
			   data:{'unchked_id':$chekedid},
			  
		   });
        }
});
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


/***********************************/

 jQuery('#SelectByProEngineer').change(function(){
	 
	var engineerName = $(this).children("option:selected").text();

	var id = $(this).val(); 
	  
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
		
	var $row = $('<tr>'+
	  '<td><input type="checkbox" class="check_list" id='+obj[i].id+ '>'+
      '<td>'+obj[i].po_number+'</td>'+
      '<td>'+obj[i].date+'</td>'+
	  '<td>'+engineerName+'</td>'+
      '<td>'+obj[i].odrdescrp+'</td>'+
	   '<td>'+obj[i].total_ex_vat+'</td>'+
	    '<td>'+obj[i].total_inc_vat+'</td>'+	
		 '<td>'+status+'</td>'+
		  '<td><a href="<?= base_url('')?>/manageOrder?id='+obj[i].po_reffrence+'&orderno='+obj[i].po_number+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'+
		   
      '</tr>');    


	$('#all_order tbody').append($row);
			}
			
			}
				 
			 
 }); 
 });


</script>