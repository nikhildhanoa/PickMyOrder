<?php if(isset($driverdata) && isset($vanid)) 
{
	$driver_name=$driverdata[0]['driver_name'];
		$vehicle_registration=$driverdata[0]['vehicle_registration'];
}

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<div class="margin_left_table container">

<div>
     <h5 style="font-weight: 700;">DRIVER NAME : <span style="font-weight:100"><?php echo $driver_name ?></span></h5>
     <h5 style="font-weight: 700;">VEHICLE REGISTRATION :<span style="font-weight:100"><?php echo $vehicle_registration ?></span> </h5>
	 
</div>

<table class="table">

  <thead class="thead-dark">
  
    <tr>
  
      <th scope="col">PRODUCT TITLE</th>
      <th scope="col">SKU</th>
      <th scope="col">REORDERLEVEL</th>
	  <th scope="col">IN STOCK</th>
	  <th scope="col">ON ORDER</th>
	 
	  
     
    </tr>
  </thead>
  <tbody>
  <?php foreach($values as $value ) { ?>
    <tr>
      <td scope="row"><?php echo $value['title']; ?></th>
      <td><?php echo $value['SKU']; ?></td>
      <td><?php echo $value['recordlevel']; ?></td>
	  <td><?php echo $value['in_stock']; ?></td>
	  <td><?php echo $value['toback_instock']; ?></td>
     </tr>
  <?php } ?>
        
       

  	
  </tbody>
</table>
</table>


<script>
var vanid= <?php echo $vanid ?>

   $(document).ready(function(){
   	 window.print();
   	 $.ajax({
   		 url:"<?= base_url('')?>UpdateIdinTableForPrint",
		 success:function(data){
			 location.href ="vanAllProducts?id="+vanid+""
		 }
   	 });
   });
</script>