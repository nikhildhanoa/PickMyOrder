<?php error_reporting(0); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style>
<?php
$alldata=$this->db->query("select * from invoices where 1");
$data=$alldata->result_array();

$CreditDataObj=$this->db->query("select * from  credits where 1");
$CreditData=$CreditDataObj->result_array();

$QuotesDataObj=$this->db->query("select * from quotesInvoice where 1");
$QuotesData=$QuotesDataObj->result_array();
?>

<div class="container">
  

  <ul class="nav nav-tabs">
   <li class="active"><a data-toggle="tab" href="#home">Invoices</a></li>
    <li class=""><a data-toggle="tab" href="#credit">Credit</a></li>
	  <li class=""><a data-toggle="tab" href="#Quotes">Quotes</a></li>
    <li class=""><a data-toggle="tab" href="#invoiceEmail">Setup</a></li>
  
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane active">
    <select class="form-control">
	 <option selected>---------Select Supplier-----------</option>
	 <option value="YESSS ELECTRICAL">YESSS ELECTRICAL</option>
	 <option></option>
	</select>
	 <span class="btn btn-info" id="refresh" >Refresh</span>
	 <div>
		 <table class="table">
		 <tr>
		   <th>invoice_number</th>
		   <th>net</th>
		    <th>tax</th>
		   <th>total</th>
		   <th>confidence</th>
		   <th>products</th>
		<tr>
		
		<?php foreach($data as $da){?>  
		<tr>
		<td><?php echo $da['invoice_number'];?></td>
		<td><?php echo $da['net'];?></td>
		<td><?php echo $da['tax'];?></td>
		<td><?php echo $da['total'];?></td>
		<td><?php echo $da['confidence'];?></td>
		<td><a href="<?php echo "invoiceProduct?id=".$da['id']."&what=invoices" ?>">view</a></td>
		</tr>
		<?php } ?>
		
		 </table>
	 </div>
    </div>
<!-------------------------------------------------------------Credit------------------------------------------------------------------------->
  
    <div id="credit" class="tab-pane fade ">
    <select class="form-control">
	 <option selected>---------Select Supplier-----------</option>
	 <option value="YESSS ELECTRICAL">YESSS ELECTRICAL</option>
	 <option></option>
	</select>
	 <span class="btn btn-info" id="refresh" >Refresh</span>
	 <div>
		 <table class="table">
		 <tr>
		   <th>invoice_number</th>
		   <th>net</th>
		    <th>tax</th>
		   <th>total</th>
		   <th>confidence</th>
		   <th>products</th>
		<tr>
		
		<?php foreach($CreditData as $da){?>  
		<tr>
		<td><?php echo $da['invoice_number'];?></td>
		<td><?php echo $da['net'];?></td>
		<td><?php echo $da['tax'];?></td>
		<td><?php echo $da['total'];?></td>
		<td><?php echo $da['confidence'];?></td>
		<td><a href="<?php echo "invoiceProduct?id=".$da['id']."&what=credits" ?>">view</a></td>
		</tr>
		<?php } ?>
		
		 </table>
	 </div>
    </div>
<!--------------------------------------------------------------Close-------------------------------------------------------------------------->
<!-------------------------------------------------------------Quotes------------------------------------------------------------------------->
  
    <div id="Quotes" class="tab-pane fade ">
    <select class="form-control">
	 <option selected>---------Select Supplier-----------</option>
	 <option value="YESSS ELECTRICAL">YESSS ELECTRICAL</option>
	 <option></option>
	</select>
	 <span class="btn btn-info" id="refresh" >Refresh</span>
	 <div>
		 <table class="table">
		 <tr>
		   <th>invoice_number</th>
		   <th>net</th>
		    <th>tax</th>
		   <th>total</th>
		   <th>confidence</th>
		   <th>products</th>
		<tr>
		
		<?php foreach($QuotesData as $da){?>  
		<tr>
		<td><?php echo $da['invoice_number'];?></td>
		<td><?php echo $da['net'];?></td>
		<td><?php echo $da['tax'];?></td>
		<td><?php echo $da['total'];?></td>
		<td><?php echo $da['confidence'];?></td>
		<td><a href="<?php echo "invoiceProduct?id=".$da['id']."&what=quotesInvoice" ?>">view</a></td>
		</tr>
		<?php } ?>
		
		 </table>
	 </div>
    </div>
<!--------------------------------------------------------------Close-------------------------------------------------------------------------->
<!-------------------------------------------------------Setting invoice email---------------------------------------------------------------->

  <div id="invoiceEmail" class="tab-pane fade " >
  	<h3 id="message" <?php if($status){ if($res){ ?> style="display:none" <?php } else{ ?>style="display:block;color:red"<?php } }else{ ?>style="display:none"<?php } ?>>Unable to connect</h3>
	<h3 id="message" <?php if($res){ ?> style="display:block" <?php } else{ ?>style="display:none;color:green"<?php } ?>>Connect Successfully</h3>
    <div class="row">

    	<div class="col-md-6">   
        
          <form class="form-signin"  method="post" action="AddInvoiceSetting" id="settingsform">
		  <label>Email setting</label>
		  <input type="text" name="setting" class="form-control" required>
		   <label>Email</label>
            <input type="Email" name="emailaddress" class="form-control" required>
			 <label>Password</label>
			<input type="password" name="password" class="form-control" required>
			
            <input type="submit" class="btn btn-info testcon" name="send" value="TEST CONECTION">
          </form>
    
          

        </div> <!-- /container -->
	</div>
	
  </div
    
<!--------------------------------------------------------close------------------------------------------------------------------------------>
</div></div>

<script>
$('#refresh').click(function(){
	location.reload();
})


</script>
