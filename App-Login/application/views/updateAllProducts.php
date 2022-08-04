<?php   
		$Product_Edit_Id=$_GET['id'];
             		
		 /* $vanlist=$this->db->query("select * from  dev_vans ");
                        $vanlist=$vanlist->result_array(); */
		
		 $products_van=$this->db->query("select * from products_van where id='$Product_Edit_Id'");
		 $products_van=$products_van->result_array();
		$stocklevel= $products_van[0]['stocklevel'];
		$recordlevel= $products_van[0]['recordlevel'];
		$in_stock= $products_van[0]['in_stock'];
		$van_id= $products_van[0]['van_id'];  
		$product_id= $products_van[0]['product_id'];   
		$toback_instock= $products_van[0]['toback_instock'];  
		
		
		$van_deatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
		 $van_deatils=$van_deatils->result_array();
		 $driver_name=$van_deatils[0]['driver_name'];
		  $vehicle_registration=$van_deatils[0]['vehicle_registration'];
		  
		  $product_deatils=$this->db->query("select title,products_images from dev_products where id='$product_id'");
		 $product_deatils=$product_deatils->result_array();
		 $products_name=$product_deatils[0]['title'];
		  $products_image=$product_deatils[0]['products_images'];
		  
		   $product_data=$this->db->query("select * from dev_vanproduct_history,dev_users where dev_users.id =user_id and product_van_id='$Product_Edit_Id'");
		    $product_data=$product_data->result_array();
			
		
		 ?>
		  <!-- Driver's Name  and Vehicle Registration -->
	  <div style="margin:20px 30px;width:50%;font-family:inherit">

	<table style="
    width: 85%;
">
		

		<tbody>
			<tr style="font-size:13px;text-transform:uppercase">
				<th scope="row" style="
    vertical-align: middle;width:27%">DRIVER'S NAME:</th>
				<td style="
    vertical-align: middle;"><?php echo $driver_name ?></td>
				<th scope="row" style="
    vertical-align: middle;width:27%">REGISTRATION:</th>
				<td style="
    vertical-align: middle;"><?php echo $vehicle_registration ?></td>
			</tr>
			<tr style="font-size:13px;text-transform:uppercase">
				<th scope="row" style="vertical-align:middle">PRODUCT Title:</th>
				<td style="vertical-align:middle"><?php echo $products_name ?></td>
				<th scope="row" style="vertical-align:middle" >IMAGE:</th>
				<td><img src="<?php echo $products_image ?>" width="60px" height="60px" style="position: relative;top: 18px;"></td>
			</tr>
		
		</tbody>
	</table>


	  </div>
		 
		 <!-- Image and product -->
		
	  
	  
	  
	  
		 <div id="vs"  style=" margin-left:30px" class="tab-pane <?php if($open_tab=='pdf'){ ?>active<?php } ?>">
		 <div id="van_idapp">
		 <div class="form-group">
		 
		 
                     
                     
                     <!-- <label>Vans </label><select class="form-control form-control-solid"  name="" id="van" style="width: 50%;">
                     <option value='0'>-------------Select-----------------</option>
                     <?php foreach($vanlist as $Allvanlist){ ?>
                     <option  <?php if($van_id == $Allvanlist['id']) {?>  selected="<?php $Allvanlist['id']  ?>" <?php } ?> value="<?php   echo $Allvanlist['id']; ?>">  <?php   echo $Allvanlist['driver_name'];  ?> </option>
                     <?php } ?>
                     </select>-->
					    

					 <div class="form-group" style="margin-top:20px;">
								  
								  <div id="isVan" class="Isvan">
								  <label>Stock Level</label>
								  <input type="number" class="form-control vanlevel"  style=" width: 50%;" value="<?php   echo $stocklevel  ?>" name="stocklevel" id="stocklevel" required> 
								  <label>Reorder Level</label>
								  <input type="number" name="reorderlevel" id="reorderlevel" value="<?php   echo $recordlevel  ?>" class="form-control vanlevel"  style=" width: 50%;" required>
								  </div>
								  
								  
								  <div class="form-group" style="margin-top:20px" >
								   <label> In Stock </label>
								   
								   
								  <input type="number" name="InStock"  value="<?php   echo $in_stock  ?>" id="InStock" class="form-control form-control-solid"  style="width: 50%;" required>
								   </div>
								   
								    <div class="form-group" style="margin-top:20px" >
								   <label>On Order(Read only)</label>
								   
								   
								  <input type="number" name="InStock"  value="<?php   echo $toback_instock  ?>" class="form-control form-control-solid"  style="width: 50%;" readonly>
								  <input type="hidden" value="<?php   echo $toback_instock  ?>" id="toback_stock">
								   </div>
								   
								    <div class="form-group" style="margin-top:20px" >
								   <label>Notes </label>
								   <br>
								   
								  <textarea id="w3review" name="w3review" rows="4" style="width: 50%;resize:none" placeholder="Please enter reason to change.." ></textarea>
								   </div>
							
                     </div>
					 </div>
					  </div>
		                <div class="col-md-12 marg_1">
                          <!-- <span class="btn btn-info" id="add_van1" >ADD </span>-->
                           <label>
                           <span  id="add_vanvv" class="btn btn-info" >UPDATE</span>
                           </label> 
                        </div>
		 
		
		
		 <!------------------------------------------------>
		 
      </div>
	  <div class="row" id="divchange" style="margin-top:15px">
       <div class="col-md-10 mx-auto">
	   
	   <table class="table table-striped" style=" text-align: center;">
    <thead>
      <tr>
	  <th class="bg-primary">User Name</th>
       <th class="bg-primary">Stocklevel	 </th>
        <th class="bg-primary">	Recordlevel</th>
        <th class="bg-primary">	In Stock</th>
        <th class="bg-primary">Notes</th>
		<th class="bg-primary">Time</th>
		
		
      </tr>
    </thead>
	<tbody>
	<?php  foreach($product_data as $data ) { ?>
	     <tr>
		 <td><?php echo $data['person_name'];?></td>
		 <td><?php echo $data['stocklevel'];?></td>
		 <td><?php echo $data['recordlevel'];?></td>
		 <td><?php echo $data['in_stock'];?></td>
		<!-- <td><?php echo $data['notes'];?></td>-->
		<td><?php if($data['notes']==''){echo "(Notes Empty)";}else{ echo $data['notes']; }?>
		 <td><?php echo $data['edit_date'];?></td>
		 </tr>
	<?php  } ?>
	</tbody>
	 </table>	   
</div>
	  
	
	  
	   
	
<script>
/******************************/ 
 $('#add_vanvv').click(function(){

   	var stocklevel=$('#stocklevel').val();
	var reorderlevel=$('#reorderlevel').val();
	var InStock=$('#InStock').val();
	var toback_Instock=$('#toback_stock').val();
	var w3review=$('#w3review').val();
	var  Total_InStock=Number(InStock)+Number(toback_Instock);
	 
	 if(Number(reorderlevel)>Number(stocklevel))
		{
			alert("  Stock Level be Greater than Reorder Level  ");
			return false;
		}
	 
	 if(Total_InStock>Number(stocklevel))
		{
			alert(" Stock Level Should be Greater than the sum of InStock and OnOrder");
			return false;
		}
			
        $.ajax({
			
			
			
	   
				url:"<?= base_url('')?>UpdateAllProducts",
				method:"post",
				data:{'stocklevels':stocklevel,'reorderlevels':reorderlevel,'InStocks':InStock,'prdid':<?php  echo $Product_Edit_Id ?>,'vanid':<?php  echo $van_id ?>,'w3reviews':w3review},
				success:function(data){
				
				if(data!= "" )
				{
					alert("Update Successfully");
					 window.location.href="vanAllProducts?id="+data+""; 

				}
				}
                          
          });
		
          }); 
</script>