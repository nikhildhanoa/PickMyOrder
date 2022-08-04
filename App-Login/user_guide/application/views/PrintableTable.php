<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">BUSINESS NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">TYPE</th>
	  <th scope="col">STATUS</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($values as $value ) { ?>
    <tr>
      <th scope="row"><?php echo $value['id']; ?></th>
      <td><?php echo $value['business_name']; ?></td>
      <td><?php echo $value['email']; ?></td>
      <td><?php  if($value['iswholeapp']=='1'){echo "Wholesaler App ";} if($value['iswholeapp']=='2'){ echo "Invoice Management ";} if($value['iswholeapp']=='0'){ echo "Contractor App";}?></td>
	   <td><?php if($value['app_status']){ echo "Active";}else{ echo "De-Activate";} ?></td>
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
			 location.href ="business";
		 }
   	 });
   });
</script>