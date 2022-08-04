<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
     $sub_sub_cat_id= $_GET['id'];
	
	
	
     $sub_cat_name= $_GET['sub_cat_name'];
	/* echo $cat_id;
	echo $cat_name;
	exit; */
?>
<style>
 .nav-pills, .nav-tabs {
    margin: 0 0 25px 0;
}
.tab-content {
    background: #fff !important;
	padding: 20px;
    margin-bottom: 30px;
}
</style>
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Category List</a></li>
   
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
    
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->

   
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
      <th scope="col">Sub sub Category Name</th>
	   <!--<th scope="col">Image</th>-->
      <th scope="col">Sub  sub Sub Category</th>
	  <!--<th scope="col">Edit</th>-->
     
      
    </tr>
  </thead>
  <tbody>
 
    <tr>
      
	  <?php  
     $AllSubCatimage=$this->db->query("select  image  from super_sub_cat where id='$sub_sub_cat_id'");
	  $SingleSubCatImage=$AllSubCatimage->result_array();
	
	  $AllSubCat = $this->db->query("select * from dev_super_sub_sub_cat where super_sub_cat='$sub_sub_cat_id'");
	  $AllSubCat = $AllSubCat->result_array();

		
	 if($AllSubCat){ 
	  ?>
	  <td><?php  echo $sub_sub_cat_id; ?></td>
	  <td><?php echo  $sub_cat_name; ?></td> 

	 <!-- <td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $sub_sub_cat_id;?>">
		<img  src="<?php echo $SingleSubCatImage[0]['image'];?>" style="width:50px;height:50px">
		<i id="<?php echo $sub_sub_cat_id; ?>" class="fa fa-times-circle changecatimage" aria-hidden="true"></i>
	  </td>-->
	  
	  
	 <td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $sub_sub_cat_id;?>">
		 <form class="d-flex" enctype="multipart/form-data" id="imagecontainer<?php echo $sub_sub_cat_id; ?>"  method="post" action="<?php echo site_url("changesuperSubCatImage");?>">
			 <input type="file" name="subcatimg" class="imageinput">
			 <input class="helpincat" type="hidden" name="changedsubcatid" value="<?php echo $sub_sub_cat_id;?>">
			 <input  type="hidden" name="subcatname" value="<?php echo $sub_cat_name;?>">
			 <input type="submit" class="btn btn-info" value="ADD" >
		 </form>
	 </td>                                         
           <!--  <a href="<?php echo site_url();?>"></a>
                                            echo $SubCatList['name']."  (UniqueId=".$SubCatList['id'].'<br>';
											.' '.$SubCatList['name'].'<br>'; 
											-->	 
      <td >
	  
			<?php   foreach( $AllSubCat as  $SubCatList){  echo  "(UniqueId=".$SubCatList['id'].")"?><?php echo " ".$SubCatList['name'] ?>  
			<div <?php if($SubCatList['image']==''){ ?> style="display:none" <?php } ?> id="remove" class=" img<?php echo $SubCatList['id']; ?>"><img  src="<?php echo $SubCatList['image'];?>" style="width:50px;height:50px">
			<i id="<?php echo $SubCatList['id']; ?>" class="fa fa-times-circle changesupercatimg" aria-hidden="true"></i></div>
			<div <?php if($SubCatList['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?> class="supcatimguploadsec<?php echo $SubCatList['id'];?>">
				<form  class="d-flex" enctype="multipart/form-data" id="imgcontainer" action="<?php echo site_url("ChangesubsubCatImage");?>" method="post">
					<input type="file" name="supcatimg" class="imginput">
					<input class="helpincat" type="hidden" name="changedsupcatid" value="<?php echo  $sub_sub_cat_id; ?>">
					<input  type="hidden" name="mainsupcatid" value="<?php echo  $SubCatList['id']; ?>">
					<input  type="hidden" name="supcatname" value="<?php echo $sub_cat_name;?>">
					<input type="submit" class="btn btn-info" value="ADD" >
				</form>
			</div>
			<?php }?>
	  </td>       
	 
	  <?php }else{?>
		<td><?php echo $sub_sub_cat_id; ?></td>
		<td><?php echo $sub_cat_name; ?></td>
		<td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $sub_sub_cat_id;?>"><img  src="<?php echo $SingleSubCatImage[0]['image'];?>" style="width:50px;height:50px"><i id="<?php echo $sub_sub_cat_id; ?>" class="fa fa-times-circle changecatimage" aria-hidden="true"></i></td>
		<td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $sub_sub_cat_id;?>">
		 <form class="d-flex" enctype="multipart/form-data" id="imagecontainer<?php echo $sub_sub_cat_id; ?>" action="<?php echo site_url("changesuperSubCatImage");?>" method="post">
		 <input type="file" name="subcatimg" class="imageinput">
		 <input class="helpincat" type="hidden" name="changedsubcatid" value="<?php echo $sub_sub_cat_id;?>">         
		 <input  type="hidden" name="subcatname" value="<?php echo $sub_cat_name;?>">
		 <input type="submit" class="btn btn-info" value="ADD" >
		 </form>
	 </td>
		   <td>No Sub sub Sub category found</td>
	 <?php } ?>
	  
 </tr>
  
  </tbody>
</table>

	 
	 
    </div>
    
  </div>
</div>
<script>
// change or delete cat image	
$('.changecatimage').click(function(){
		var mmyId = $(this).attr('id');
	 alert(mmyId);
		$.ajax({
		url:"<?= base_url('')?>DeletesubCatImagewithajax",
		method:"POST",
		data:{'subcatid':mmyId},
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
		 alert(myId);
		
		$.ajax({
		url:"<?= base_url('')?>DeletesubsubCatImage",
			
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

