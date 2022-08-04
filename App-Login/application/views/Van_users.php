<?php   
	if(isset($key) && isset($van) && isset($engineers_deatils) ) 
	{  
	
	
		 ?>
		  <!-- Driver's Name  and Vehicle Registration -->
	  <div style="margin: 20px 30px 40px 20px;width:50%;font-family:inherit;">

	<table style="
    width: 85%;
">
		

		<tbody>
			<tr style="font-size:13px;text-transform:uppercase">
				<th scope="row" style="
    vertical-align: middle;width:27%">DRIVER'S NAME:</th>
				<td style="
    vertical-align: middle;"><?php echo $key[0]['driver_name']; ?></td>
				<th scope="row" style="
    vertical-align: middle;width:27%"> VEHICLE REGISTRATION:</th>
				<td style="
    vertical-align: middle;"><?php  echo $key[0]['vehicle_registration']; ?></td>
			</tr>
			
		
		</tbody>
	</table>


	  </div>
		 
		 <!-- Image and product -->
		
	  
	  
	  
	  
		 <div id="vs"  style=" margin-left:30px" class="tab-pane ">
		 <div id="van_idapp">
		 <div class="form-group">
		 
		 
                     
                     
                      <label>Engineers </label><select class="form-control form-control-solid"  name="" id="van" style="width: 50%;">
                     <option value='0'>-------------Select-----------------</option>
                    <?php foreach($engineers_deatils as $engineers_deatilss) { ?>
                     <option value="<?php echo   $engineers_deatilss['id']; ?> " ><?php echo   $engineers_deatilss['user_name']; ?>  </option>
                    <?php } ?>
                     </select>
					    

					 
					 </div>
					  </div>
		                <div class="col-md-12 marg_1">
                          <!-- <span class="btn btn-info" id="add_van1" >ADD </span>-->
                           <label>
                           <span  id="end_id" class="btn btn-info" >ADD</span>
                           </label> 
                        </div>
		 
		
		
		 <!------------------------------------------------>
		 
      </div>
	  
	<?php } ?>
	  
	  
	
<script>
 
$('#end_id').click(function(){
	
    var eng=$('#van').val();
   
        $.ajax({
	   
				url:"<?= base_url('')?>InsertVanEngineer",
				method:"post",
				data:{'engid':eng,'vanid':<?php echo $van ?>},
				success:function(data){
					
					if(data == 1)
					{
						alert("successful");
					}
				    }
                          
          });
          });
</script>