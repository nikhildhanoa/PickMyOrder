
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
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Manage Quotes</a></li>
    <!--<li><a data-toggle="tab" href="#menu1">Quotes</a></li>-->
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
		  <h3>Manage Quotes</h3>
	  <div class="container">
  
  <table class="table">
    <thead>
      <tr>
        <th>Quotes No.</th>
        <th>Date</th>
		<th>Refrence No.</th>
		<th>Total EX.VAT </th>
		<th>Total INC.VAT </th>
		<th>View Quote</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
	<?php if(isset($_SESSION['Current_Business'])){$business=$_SESSION['Current_Business']; 
	$quotes=$this->db->query("select *from dev_quotes  where business_id='$business' ORDER BY id ASC");}
	else{
		$business=$_SESSION['status']['business_id'];
		$quotes=$this->db->query("select *from dev_quotes  where business_id='$business' ORDER BY id ASC");
	}
	   $quotes=$quotes->result_array();
	
	  foreach($quotes as $single_quote){
		
	?>
	<?php for($i=1;$i<=1;$i++){ ?>
      <tr>
        <td><?php echo $i; ?></td>
		<td><?php echo $single_quote['date'];?></td>
		<td><?php echo $single_quote['po_reffrence'];?></td>
		<td>£<?php echo $single_quote['total_ex_vat'];?></td>
		<td>£<?php echo $single_quote['total_inc_vat'];?></td>
		<td><a  href="<?php echo site_url('View_Single_Quote?id='.$single_quote['id']);?>">View Quote</a></td>
		<td><a href="#" class="newanchor " id="<?php echo site_url('DeleteQuote?id='.$single_quote['id']);?>" 
		data-toggle="modal" data-target="#myConModal"><i class="fa fa-times-circle getid" aria-hidden="true"></i></a></td>
      </tr>      
	<?php } ?>
	<?php   } ?>
    </tbody>
  </table>
</div>
    <hr>
	 
    </div>
  </div>
  <script>
  $('.newanchor').click(function(){
		var myId = $(this).attr('id');
		$("#deca").attr("href", myId);
	});
  </script>
