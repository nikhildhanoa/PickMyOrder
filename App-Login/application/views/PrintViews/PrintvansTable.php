
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<table class="table">
  <thead class="thead-dark">
  	
    <tr>
      <th scope="col">DRIVER NAME</th>
      <th scope="col">VEHICLE REGISTRATION</th>
      <th scope="col">MAKE </th>
	   <th scope="col">MODEL</th>
	   <th scope="col">TYPE</th>
	   <th scope="col">ENGINEER</th>
     
    </tr>
  </thead>
  <tbody>
  <?php foreach($values as $value ) { ?>
    <tr>
	      
      <td scope="row"><?php echo $value['driver_name']; ?></td>
      <td><?php echo $value['vehicle_registration']; ?></td>
	   <td><?php echo $value['make']; ?></td>
	   <td><?php echo $value['model']; ?></td>
	   <td><?php echo $value['type']; ?></td>
	    <td><?php echo $value['user_name']; ?></td>
      <td><?php  ?></td>
     
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
			 location.href ="Vans";
		 }
   	 });
   });
</script>