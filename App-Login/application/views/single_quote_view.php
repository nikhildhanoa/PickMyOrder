<?php
 
 $quote_id = $_GET['id'];
 echo $quote_id;
 $quote = $this->QuoteModel->SelectQuoteById($quote_id);
 
?>


<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  

  <div class="tab-content" >
   
    <div id="menu1" >
  <h3>Quotes Numbar :<?php echo $id= $_GET['id'];?></h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  
  <table class="table">
    <thead>
      <tr>
        <th>Quotes No.</th>
        <th>Date</th>
		<th>Refrence No.</th>
		<th>Total EX.VAT </th>
		<th>Total INC.VAT </th>
		
      </tr>
    </thead>
    <tbody>
	<?php for($i=1;$i<=1;$i++){ ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $quote[0]['date'];?></td>
		<td><?php echo $quote[0]['po_reffrence'];?></td>
		<td>£<?php echo $quote[0]['total_ex_vat'];?></td>
		<td>£<?php echo $quote[0]['total_inc_vat'];?></td>
      </tr>      
	<?php } ?>
    </tbody>
  </table>
</div><hr>
 <div class="row">
	<div class="col-sm-9">
      <div class="col-sm-6">
      <h3>Supplier Quotes</h3>
	 
	  
	  <input type="text" value="Supplier Name">
	  
	  </div>
	  <div class="col-sm-3">
	  <input type="submit" value="Re-Order">
	  </div>
    </div>
   <div class="col-sm-3">
      <h4>SUB TOTAL :£<?php echo $quote[0]['total_ex_vat'];?> </h4>
	  <h4>VAT : £<?php echo $quote[0]['total_inc_vat'];?></h4>
	  <?php $total=$quote[0]['total_ex_vat']+ $quote[0]['total_inc_vat']?>
	  <h4>Total : £<?php echo  $total;?></h4>
    </div>
  </div>
	
	 
	 </div>
  </div>
  
