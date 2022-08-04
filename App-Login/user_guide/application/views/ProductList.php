<?php error_reporting(0);
if(isset($tab))
{
	
	$active=$tab;
}
else{ $active='home';  }
 ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  <ul class="nav nav-tabs">
    <li <?php if($active=='home'){?> class="active" <?php } ?>><a data-toggle="tab" href="#home">Product List</a></li>
	<li <?php if($active=='menu3'){?> class="active" <?php } ?>><a data-toggle="tab" href="#menu3">Add Product List</a></li>
    
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane <?php if($active=='home'){ echo "active";}else{ echo "fade";} ?> background">
      <h3>Manage Product List</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
	 
   <?php 
		 if(isset($_SESSION['Current_Business']))
		 {
				$bid=$_SESSION['Current_Business'];
			
		 }else
		 {
			 $bid=$_SESSION['status']['business_id'];
			 
		 }
   
   $AllCatListData= $this->db->query("select * from dev_productlist");
   $AllCatList=$AllCatListData->result_array();

   ?>
  <table class="table table-striped">
    <thead>
      <tr>
	    <th>List Id</th>
        <th>List</th>
		<th>View</th>
		<th>Edit</th>
		<th>Delete</th> 
		<th>Master List</th> 
      </tr>
    </thead>
    <tbody>
	<?php $i=1; foreach($AllCatList as $SingleList ) { ?>
      <tr>
	  <td><?php echo $SingleList['id'];?></td>
	  <td id="<?php echo $i.'basic';?>"><?php echo $SingleList['productlistname']; $vid=$SingleList['id'];?></td>
	  <td id="<?php echo $i.'new';?>" style="display:none"><input required type="text" value="<?php echo $SingleList['productlistname'];?>" class="<?php echo $vid.'input';?>"><button class="savename btn btn-default" value="<?php echo $vid; ?>">Save</button></td>
	  <td><a style="color:#5867dd" href="<?php echo site_url('ManageList?listid='.$vid);?>" >View</a></td>
	  		<td><span class="change" id="<?php echo $i;?>"><i style="color:#5867dd" class="fa fa-pencil" aria-hidden="true"></i></span></td>
	  <td ><i  id="<?php echo $SingleList['id'];?>" style="color:#5867dd" class="fa fa-times-circle list" aria-hidden="true"></i></td>
        <td><input type="checkbox" value="<?php echo $SingleList['id']; ?>" <?php if($SingleList['masterlist']){echo "checked";} ?> class="singlechecklist"></td>
      </tr>      
	<?php $i++; } ?>
    </tbody>
  </table>
</div>
	 
	 
    </div>
	<!-------------------------- add list------------------------------->
		<div id="menu3" class="tab-pane <?php if($active=='menu3'){ echo "active";}else{ echo "fade";} ?> background" >
				  
			<div id="form">
				<div class="container">
					 
						<div class="row">
							<div class="col-md-6 col-xs-12">
							<div class="row">
						  
								 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('ProductList');?>">
								   <label>Product List Name</label>
									<input type="text" name="addlist" class="form-control">
									<input style="margin-top: 10px;" type="submit" value="Add" name="productlistbutton" class="btn btn-info listbtn">
								  </form>
							</div>
							</div>
						</div>

				 <!-- </form>-->
				<hr>
				</div>
			</div>
		</div>
		<!------------------------------------------------------------------>
  </div>
</div>
<script>
$('.savename').click(function(){
	plistid=$(this).val();
	prolistname_name=$('.'+plistid+'input').val();

	$.ajax({
		url:"<?= base_url('')?>UpdateProductListName",
		method:"POST",
		data:{'listid':plistid,'listname':prolistname_name},
		success:function(data)
		{
		        alert(data);
				location.reload();
			
		}
	});
});

$('.change').click(function(){
id=$(this).attr('id');
$('#'+id+'basic').css('display','none');
$('#'+id+'new').css('display','block');
});
/*********************************8make master list by ajax***********************/
$('.singlechecklist').change(function(){
	if(this.checked) 
		{
			action=1;
			
		}
		else
		{
			action=0; 
		}
	id=$(this).val();
 
	 $.ajax({
		url:"<?= base_url('')?>assignmasterlist",
		method:"POST",
		data:{'listid':id,'action':action},
		success:function(data)
		{
		        alert(data);
		}
	}); 
});
</script>
