<?php error_reporting(0); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style>
<?php
$id=$_GET['id'];
$what=$_GET['what'];
$alldata=$this->db->query("select * from $what where id='$id'");
$data=$alldata->result_array();
$AllTableData=$data[0]['FileName'];  
$Folder=array("quotesInvoice"=>"quotes","invoices"=>"invoices","credits"=>"credits");
  
?>

<div class="container">  
  

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Invoices Product</a></li>
  
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active">
   
	 
	 <div>
		<iframe style="height:500px;width:100%" src="https://stagingapp.pickmyorder.co.uk/<?php echo $Folder[$what]."/". $AllTableData;?>"></iframe> 
	 </div>
    </div>


</div>
</div>

