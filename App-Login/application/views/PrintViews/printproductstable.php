
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">PRODUCT TITLE </th>
      <th scope="col">SKU</th>
	  <th scope="col">STATUS</th>

     
    </tr>
  </thead>
  <tbody>
  <?php foreach($values as $value ) { ?>
    <tr>
	 <?php if($value['publish_status']=='1'){ $status="public";}else{$status="Unpublic";}  ?>
      <td scope="row"><?php echo $value['title']; ?></th>
      <td><?php echo $value['SKU']; ?></td>
	  <td><?php echo $status ?></td>
    
     
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
			 location.href ="products";
		 }
   	 });
	 
   });
</script>