
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<table class="table">
  <thead class="thead-dark">
    <tr>
	






      <th scope="col">PO NUMBER</th>
      <th scope="col">DATE</th>
      <th scope="col">PROJECT</th>
	  <th scope="col">ORDER DESCRIPTION</th>
	  <th scope="col">TOTAL EX VAT</th>
	  <th scope="col">TOTAL INC VAT</th>
	  <th scope="col">ORDER TYPE</th>
     
    </tr>
  </thead>
  <tbody>
  <?php foreach($values as $value ) { ?>
    <tr>
	           <?php  $order="Reorder";  ?>
      <td scope="row"><?php echo $value['po_number']; ?></th>
      <td><?php echo $value['date']; ?></td>
      <td><?php echo $value['givenprojectname']; ?></td>
	  <td><?php echo $value['odrdescrp']; ?></td>
	  <td><?php echo $value['total_ex_vat']; ?></td>
	  <td><?php echo $value['total_inc_vat']; ?></td>
	  <td><?php echo $order ?></td>
     
    </tr>
  <?php } ?> 
  
  </tbody>
</table>

<script>
   $(document).ready(function(){
   	 window.print();
   	 $.ajax({
   		 url:"<?= base_url('')?>UpdateIdinTableForPrint",
		 success:function(data){
			 location.href ="ReorderProducts";
		 }
   	 });
   });
</script>