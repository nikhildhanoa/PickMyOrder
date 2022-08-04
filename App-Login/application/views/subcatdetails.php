<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
     $cat_id= $_GET['id'];
	 $SubcatLoop= $cat_id;
	
     $cat_name= $_GET['cat_name'];
	
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


 $data=$this->db->query("select CategoryList from dev_business where id= $bid ");
 $data =  $data->result_array();
 $CategoryList=$data[0]['CategoryList'];

$AllCatList= $this->ProductCategoryModal->GetAllCat($bid);?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">UniqeID</th>
      <th scope="col">Sub Category Name</th>
	   <th scope="col"> Sub Category Image</th>
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
	  
	  <?php if($CategoryList==10)  { ?>

		<td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $cat_id;?>">
		<img  src="<?php echo $SingleSubCatImage[0]['image'];?>" style="width:50px;height:50px">
		
	  </td>
	  
	  
	 <td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $cat_id;?>">
		
	 </td>

		<?php  } else { ?>
	  <td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $cat_id;?>">
		<img  src="<?php echo $SingleSubCatImage[0]['image'];?>" style="width:50px;height:50px">
		<i id="<?php echo $cat_id; ?>" class="fa fa-times-circle changecatimage" aria-hidden="true"></i>
	  </td>
	  
	  
	 <td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $cat_id;?>">
		 <form class="d-flex" enctype="multipart/form-data" id="imagecontainer<?php echo $cat_id; ?>"  method="post" action="<?php echo site_url("changeSubCatImage");?>">
			 <input type="file" name="subcatimg" class="imageinput">
			 <input class="helpincat" type="hidden" name="changedsubcatid" value="<?php echo $cat_id;?>">
			 <input  type="hidden" name="subcatname" value="<?php echo $cat_name;?>">
			 <input type="submit" class="btn btn-info" value="ADD" >
		 </form>
	 </td>     
	 <?php } ?>                                    
           <!--  <a href="<?php echo site_url();?>"></a>
                                            echo $SubCatList['name']."  (UniqueId=".$SubCatList['id'].'<br>';
											.' '.$SubCatList['name'].'<br>'; 
											-->	 
      <td >
			<?php foreach( $AllSubCat as  $SubCatList){
				
				$data=$SubCatList['id'];
				$data2=$SubCatList['name'];
				$data3=$SubCatList['cute_super_cat'];
				
				$names = (empty($data3)) ? $data2 : $data3;
				
				
               if($CategoryList==10)
			   {

                echo  "(UniqueId=".$data.")"?><a href="<?php echo site_url("GrandSubCat?id=$data & sub_cat_name=$data2");?>"><?php echo " ".$data2 ?> </a> 
			<div <?php if($SubCatList['image']==''){ ?> style="display:none" <?php } ?> id="remove" class=" img<?php echo $SubCatList['id']; ?>"><img  src="<?php echo $SubCatList['image'];?>" style="width:50px;height:50px">
			</div>
			<div <?php if($SubCatList['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?> class="supcatimguploadsec<?php echo $SubCatList['id'];?>">
				
			</div>





			 <?php    }else{ ?>


			 <?php 	echo  "(UniqueId=".$data.")"?> <span  id="<?php echo 'subedit'.$data   ?>"   class="pencils" ><?php if ($bid=='15') {?><i data-id="<?php echo $data;  ?>" class="change fa fa-pencil" aria-hidden="true"></i><?php } ?> <a href="<?php echo site_url("GrandSubCat?id=$data & sub_cat_name=$data2");?>"><?php echo " ".$names ?> </a> </span> 
			<span class="tick" id="<?php echo 'subeditdone'.$data  ?>"  style="display:none" >
			<i class="savename fa fa-check" aria-hidden="true" data-ids="<?php echo $data;  ?>"></i> 
			 <input  type="text" value="<?php echo $data2; ?>" class="<?php echo $data.'valdata';?>">
			 <?php if($bid=="15") { ?>    <input  type="text" value="<?php echo $data3; ?>" class="<?php echo $data.'cutedata';?>"> <?php } ?>
			</span>


			
			<div <?php if($SubCatList['image']==''){ ?> style="display:none" <?php } ?> id="remove" class=" img<?php echo $SubCatList['id']; ?>"><img  src="<?php echo $SubCatList['image'];?>" style="width:50px;height:50px">
			<i id="<?php echo $SubCatList['id']; ?>" class="fa fa-times-circle changesupercatimg" aria-hidden="true"></i></div>
			
			<div <?php if($SubCatList['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?> class="supcatimguploadsec<?php echo $SubCatList['id'];?>">
				<form  class="d-flex" enctype="multipart/form-data" id="imgcontainer" action="<?php echo site_url("ChangeSupCatImage");?>" method="post">
					<input type="file" name="supcatimg" class="imginput">
					<input class="helpincat" type="hidden" name="changedsupcatid" value="<?php echo  $cat_id; ?>">
					<input  type="hidden" name="mainsupcatid" value="<?php echo  $SubCatList['id']; ?>">
					<input  type="hidden" name="supcatname" value="<?php echo $cat_name;?>">
					<input type="submit" class="btn btn-info" value="ADD" >
				</form>
			</div>
			
			<?php } }?>
	  </td>       
	 
	  <?php } else {?>
		<td><?php echo $cat_id; ?></td>
		<td><?php echo $cat_name; ?></td>
		<td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $cat_id;?>"><img  src="<?php echo $SingleSubCatImage[0]['image'];?>" style="width:50px;height:50px"><i id="<?php echo $cat_id; ?>" class="fa fa-times-circle changecatimage" aria-hidden="true"></i></td>
		<td <?php if($SingleSubCatImage[0]['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $cat_id;?>">
		 <form class="d-flex" enctype="multipart/form-data" id="imagecontainer<?php echo $cat_id; ?>" action="<?php echo site_url("changeSubCatImage");?>" method="post">
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
<script>
$(".change").click(function(){
	
id=$(this).attr('data-id');	
 $('#subedit'+id).css('display','none');
$('#subeditdone'+id).css('display','block'); 
});

$('.savename').click(function(){
	
	id=$(this).attr('data-ids');     
	valdata=$('.'+id+'valdata').val();
	cutedata=$('.'+id+'cutedata').val();
	
	
	
	
	
	$.ajax({
		url:"<?= base_url('')?>updatesupersubcat",
		method:"POST",
		data:{'id':id,'valdata':valdata,'cutedata':cutedata},
		success:function(data)
		{
		        alert(data);
				location.reload();
			
		}
	});
});

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

