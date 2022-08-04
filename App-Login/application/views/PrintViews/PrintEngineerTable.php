
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"> NAME</th>
      <th scope="col">USERNAME</th>
      <th scope="col">EMAIL ADDRESS</th>
     
    </tr>
  </thead>
  <tbody>
  <?php foreach($values as $value ) { ?>
    <tr>
      <th scope="row"><?php echo $value['name']; ?></th>
      <td><?php echo $value['user_name']; ?></td>
      <td><?php echo $value['email']; ?></td>
     
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
			 location.href ="engineer";
		 }
   	 });
   });
</script>