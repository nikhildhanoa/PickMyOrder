<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
     $cat_id= $_GET['id'];
	 $SubcatLoop= $cat_id;
	
     $cat_name= $_GET['cat_name'];
	
?>

<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Category List</a></li>
   
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
      <h3>Manage SubCategory</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
   
<?php 
   if(isset($_SESSION['Current_Business'])){
		$bid=$_SESSION['Current_Business'];
	
 }else
 {
	 $bid=$_SESSION['status']['business_id'];
	 
 }

$AllCatList= $this->ProductCategoryModal->GetAllCat($bid);?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">UniqeID</th>
      <th scope="col">Sub Category Name</th>
	   <th scope="col">Image</th>
      <th scope="col">Sub Sub Category</th>
	  <!--<th scope="col">Edit</th>-->
     
      
    </tr>
  </thead>
  <tbody>
 
    <tr>
      
	  <?php  
     $AllSubCatimage=$this->db->query("select  image  from dev_product_sub_cat where id='$cat_id'");
	  $SingleSubCatImage=$AllSubCatimage->result_array();
	  
	  $AllSubCat = $this->db->query("select * from super_sub_cat where sub_cat='$cat_id'");
	  $AllSubCat = $AllSubCat->result_array();

		
	  if($AllSubCat){
	  ?>
	  <td><?php  echo $cat_id; ?></td>
	  <td><?php echo  $cat_name; ?></td>      
	  <td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $cat_id;?>">
		<img  src="<?php echo $SingleSubCatImage[0]['image'];?>" style="width:50px;height:50px">
		<i id="<?php echo $cat_id; ?>" class="fa fa-times-circle changecatimage" aria-hidden="true"></i>
	  </td>
	  
	  
	 <td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $cat_id;?>">
		 <form  enctype="multipart/form-data" id="imagecontainer<?php echo $cat_id; ?>"  method="post" action="<?php echo site_url("changeSubCatImage");?>">
			 <input type="file" name="subcatimg" class="imageinput">
			 <input class="helpincat" type="hidden" name="changedsubcatid" value="<?php echo $cat_id;?>">
			 <input  type="hidden" name="subcatname" value="<?php echo $cat_name;?>">
			 <input type="submit" class="btn btn-info" value="ADD" >
		 </form>
	 </td>
      <td >
			<?php foreach( $AllSubCat as  $SubCatList){ echo $SubCatList['name']."  (UniqueId=".$SubCatList['id'].'<br>';?> 
			<div <?php if($SubCatList['image']==''){ ?> style="display:none" <?php } ?> id="remove" class=" img<?php echo $SubCatList['id']; ?>"><img  src="<?php echo $SubCatList['image'];?>" style="width:50px;height:50px">
			<i id="<?php echo $SubCatList['id']; ?>" class="fa fa-times-circle changesupercatimg" aria-hidden="true"></i></div>
			<div <?php if($SubCatList['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?> class="supcatimguploadsec<?php echo $SubCatList['id'];?>">
				<form  enctype="multipart/form-data" id="imgcontainer" action="<?php echo site_url("ChangeSupCatImage");?>" method="post">
					<input type="file" name="supcatimg" class="imginput">
					<input class="helpincat" type="hidden" name="changedsupcatid" value="<?php echo  $cat_id; ?>">
					<input  type="hidden" name="mainsupcatid" value="<?php echo  $SubCatList['id']; ?>">
					<input  type="hidden" name="supcatname" value="<?php echo $cat_name;?>">
					<input type="submit" class="btn btn-info" value="ADD" >
				</form>
			</div>
			<?php }?>
	  </td>       
	 
	  <?php }else{?>
		<td><?php echo $cat_id; ?></td>
		<td><?php echo $cat_name; ?></td>
		<td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $cat_id;?>"><img  src="<?php echo $SingleSubCatImage[0]['image'];?>" style="width:50px;height:50px"><i id="<?php echo $cat_id; ?>" class="fa fa-times-circle changecatimage" aria-hidden="true"></i></td>
		<td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $cat_id;?>">
		 <form  enctype="multipart/form-data" id="imagecontainer<?php echo $cat_id; ?>" action="<?php echo site_url("changeSubCatImage");?>" method="post">
		 <input type="file" name="subcatimg" class="imageinput">
		 <input class="helpincat" type="hidden" name="changedsubcatid" value="<?php echo $cat_id;?>">         
		 <input  type="hidden" name="subcatname" value="<?php echo $cat_name;?>">
		 <input type="submit" class="btn btn-info" value="ADD" >
		 </form>
	 </td>
		   <td>No Sub Sub category found</td>
	 <?php } ?>
	  
 </tr>
  
  </tbody>
</table>
</div>
	 
	 
    </div>
    
  </div>
</div>
<script>
// change or delete cat image	
$('.changecatimage').click(function(){
		var myId = $(this).attr('id');
		$.ajax({
		url:"<?= base_url('')?>DeleteCatImages",
		method:"POST",
		data:{'subcatid':myId},
		success:function(data)
		{
		        if(data=="1")
				{
					$('.imagesec'+myId).css('display','none');
					$('.imageuploadsec'+myId).css('display','block');
				}
				else
				{
					alert(data);
				}
				
			
		}
	});
		
	});

// change or delete sup cat image 
$('.changesupercatimg').click(function(){
		var myId = $(this).attr('id');
		$.ajax({
		url:"<?= base_url('')?>DeleteSupCatImages",
		method:"POST",
		data:{'supcatid':myId},
		success:function(data)
		{
		        if(data=="1")
				{
					$('.img'+myId).css('display','none');
					$('.supcatimguploadsec'+myId).css('display','block');
				}
				else
				{
					console.log(data);
				}
		}
		
	});
	});
	
	
	
	
	

</script>

