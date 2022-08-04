<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
     $cat_id= $_GET['id'];
     $cat_name= $_GET['cat_name'];
	 
	 $image_data=$this->db->query("select image from dev_product_cat where id= $cat_id ");
	 $iamge_data =  $image_data->result_array(); 
	 $cat_image =  $iamge_data[0]['image'];
	 
?>

<style>
	.tab-content {
    background: #fff !important;
    padding: 20px;
    margin-bottom: 30px;
	    margin-top: 20px;
}
</style>
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Category List</a></li>
   
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
 
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
   
<?php 
     if(isset($_SESSION['Current_Business'])){
		$bid=$_SESSION['Current_Business'];
	
 }else
 {
	
	$status=$this->session->userdata('status'); 
	$bid = $status['business_id']; 
	 
 }

 $data=$this->db->query("select CategoryList from dev_business where id= $bid ");
 $data =  $data->result_array();
 $CategoryList=$data[0]['CategoryList'];

$AllCatList= $this->ProductCategoryModal->GetAllCat($bid);
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">UniqueID</th>
      <th scope="col">Category Name</th>
	  <th scope="col">Category image</th>
      <th scope="col">Sub Category</th>
	  <th scope="col">Edit</th>
</tr>
  </thead>
  <tbody>
 
    <tr>
      
	  <?php 
   
	  $AllSubCat=$this->db->query("select * from dev_product_sub_cat where cat_id=$cat_id");
	  $AllSubCat=$AllSubCat->result_array();  
	  ?>
	  <td><?php echo $cat_id; ?></td>
	  <td><?php echo  $cat_name; ?></td>

     <?php  if($CategoryList==10) { ?>

		<td >
		<img  src="<?php echo  $cat_image ?>" style="width:50px;height:50px"> 
		</td>


      <?php  } else {  ?>

      <td <?php if( $cat_image!='') {  ?> style="display:block" <?php } else { ?> style="display:none" <?php }
	      ?> id="hideimage"> 

		<img  src="<?php echo  $cat_image ?>" style="width:50px;height:50px">
		<i id="<?php echo $cat_id; ?>" class="fa fa-times-circle changecatimages" aria-hidden="true"></i> 
		</td>
		
			
          <td <?php if( $cat_image=='') {  ?> style="display:block" <?php } else { ?> style="display:none" <?php }  ?> id="catimagecontainer" >

		     <form class="d-flex" enctype="multipart/form-data"   method="post" action="<?php echo site_url("UpdateCatImage");?>">
			 <input type="file" name="catimg" class="imageinput">
			 <input class="" type="hidden" name="cat_name" value="<?php echo $cat_name;?>">
			 <input class="" type="hidden" name="catid" value="<?php echo $cat_id;?>">
			 <input type="submit" class="btn btn-info" value="ADD" >
		      </form>
		
	        </td>
          <?php  }  ?>










	  <?php if($AllSubCat){ ?>
      <td><?php $i=1; foreach( $AllSubCat as  $SubCatList){ 
	  $id=$SubCatList['id'];
	  $name=$SubCatList['sub_cat_name'];
	  
	  ?>
	  
	  <?php if($CategoryList==10)  { ?>
	 
		 <a href="<?php  echo site_url("subCatDetails?id=$id & cat_name=$name"); ?>"> <?php echo $SubCatList['sub_cat_name'].'<br>'; ?></a></span>
	  <span style="display:none" id="<?php echo $i.'new';?>">
	  <i id="<?php echo  $id;?>" class="savename fa fa-check" aria-hidden="true"></i>
	  <input  type="text" value="<?php echo $SubCatList['sub_cat_name'];?>" class="<?php echo $id.'input';?>">
	  </span>
	  


	   <?php  } else {?>

	  <span id="<?php echo $i.'basic';?>"><a href="<?php echo site_url("deletesub?id=$id&name=$cat_name&catid=$cat_id");?>"><?php if ($bid=='15') {?><i class="fa fa-times-circle" aria-hidden="true"></i></a> | <i  id="<?php echo $i;?>" class="change fa fa-pencil" aria-hidden="true"></i> <?php } ?><a href="<?php  echo site_url("subCatDetails?id=$id & cat_name=$name"); ?>"> <?php

        $sub_cat_name=$SubCatList['sub_cat_name'];
	    $sub_cat_cut_name=$SubCatList['sub_cat_cut_name'];
	    $names = (empty($sub_cat_cut_name)) ? $sub_cat_name : $sub_cat_cut_name;







	  echo $names.'<br>'; ?></a></span>
	  <span style="display:none" id="<?php echo $i.'new';?>">
	  <i id="<?php echo  $id;?>" class="savename fa fa-check" aria-hidden="true"></i>
	  <input  type="text" value="<?php echo $SubCatList['sub_cat_name'];?>" class="<?php echo $id.'input';?>">
	   <input  type="text" value="<?php echo $SubCatList['sub_cat_cut_name'];?>" class="<?php echo $id.'cuteinput';?>">
	  </span>

	  <?php }  ?>
	  <?php $i++;} ?></td>
	 <td><a href="<?php  echo site_url("subCatDetails?id=$id & cat_name=$name"); ?>">View</a></td>
	
	  <?php }else{?>
		    <td>No Sub Categories Found </td>
	 <td><span><i class="fa fa-pencil" aria-hidden="true"></i><span></td>
		  
	<?php  } ?>





 </tr>
  
  </tbody>
</table>
</div>
	 
	 
    </div>
    
  </div>
</div>
<script>
$('.change').click(function(){
id=$(this).attr('id');
$('#'+id+'basic').css('display','none');
$('#'+id+'new').css('display','block');
});
$('.savename').click(function(){
	catid=$(this).attr('id');
	cat_name=$('.'+catid+'input').val();
	sub_cat_cut_name=$('.'+catid+'cuteinput').val();
	
	 $.ajax({
		url:"<?= base_url('')?>UpdateSubCatName",
		method:"POST",
		data:{'catid':catid,'catname':cat_name,'sub_cat_cut_name':sub_cat_cut_name},
		success:function(data)
		{
		        alert(data);
				location.reload();
			
		}
	}); 
});

//////// changecatimages

$('.changecatimages').click(function(){

  var id = $(this).attr('id');

  $.ajax({

	url:"<?= base_url('')?>ChangeCatimages",
		method:"POST",
		data:{'catid':id},
		success:function(data)
		{
		if(data==1)
			 {
             
			  $('#catimagecontainer').css('display','block');
			  $('#hideimage').css('display','none');


			 }
				
		}



        });


});



</script>

