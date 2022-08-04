
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">PROJECT NAME</th>
      <th scope="col">CUSTOMER</th>
      <th scope="col">EMAIL</th>
     
    </tr>
  </thead>
  <tbody>
  <?php foreach($values as $value ) { ?>
    <tr>
      <th scope="row"><?php echo $value['project_name']; ?></th>
      <td><?php echo $value['customer_name']; ?></td>
      <td><?php echo $value['email_address']; ?></td>
     
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
			 location.href ="projects";
		 }
   	 });
   });
</script>