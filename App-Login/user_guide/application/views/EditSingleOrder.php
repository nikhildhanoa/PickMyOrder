<?php error_reporting(0); 
     
$editid=$_GET['EditStatus'];
       
	      $select_single_order_query="select * from dev_single_order where id='$editid'";
		$select_single_order_query=$this->db->query($select_single_order_query);
	   $select_single_order_query=$select_single_order_query->result_array();
	  $select_single= $select_single_order_query[0];
	 
	   ?>	

<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<div class="container">


  <ul class="nav nav-tabs">
    
    <li class="active"><a data-toggle="tab" href="#menu1">Manage Order</a></li>
    
  </ul>

  <div class="tab-content">
    
    <div id="menu1" class="tab-pane active">
	<h3>Orders</h3>
          <div class="container">
  
  <table class="table">
    <thead>
      <tr>
        <th>Line Number</th>
        <th>Image</th>
		<th>Qty</th>
		<th>Price EX VAT</th>
		<th>Total EX VAT</th>
		
      </tr>
    </thead>
    <tbody>
	
      <tr>	
		<td><?php echo $select_single['id']; ?></td>
		<td><img style="width:30px;height:30px" src="<?php echo $select_single['image']; ?>" ></td>
		 <td><input id="qty" class="form-control" type="number" value="<?php echo $select_single['qty']; ?>" name="editsingle"></td>
		 	
		<td id="ex_vat">£<?php echo $select_single['ex_vat']; ?></td>
		<td id="total_ex">£<?php echo $select_single['total_ex_vat']; ?></td>
		
		
      </tr>      
	
    </tbody>
  </table>
</div>

<hr>

<div class="save_btn btn_sec2" id="updateqty"><button type="button" class="btn btn-default">UPDATE</button></div>

</div>
 
</div>
</div>
<script>
jQuery('#updateqty').click(function(){
	var Qty=jQuery('#qty').val();
	var ex_vat=<?php echo $select_single['ex_vat']; ?>;
	var total=Qty*ex_vat;

	var id=<?php echo $editid; ?>;
	var Reffrence_id=<?php echo $select_single['Reffrence_id'];?>;
       
	jQuery.ajax({
		
		url:<?php echo base_url();?>"/updateqty",
		method:"POST",
		data:{'id':id,'value':Qty,'total_ex':total},
		success:function(d){
		
			if(d==1){
	window.location.replace(<?php echo base_url(); ?>"/manageOrder?id="+Reffrence_id);
			}
		}
		
	});
	
});



</script>

