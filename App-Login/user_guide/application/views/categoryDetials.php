<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
     $cat_id= $_GET['id'];
     $cat_name= $_GET['cat_name'];
?>

<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Category List</a></li>
   
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
      <h3>Manage Sub Category</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
   
<?php 
     if(isset($_SESSION['Current_Business'])){
		$bid=$_SESSION['Current_Business'];
	
 }else
 {
	 $bid=0;
	 
 }
$AllCatList= $this->ProductCategoryModal->GetAllCat($bid);
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">UniqueID</th>
      <th scope="col">Category Name</th>
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
	  <?php if($AllSubCat){ ?>
      <td><?php $i=1; foreach( $AllSubCat as  $SubCatList){ 
	  $id=$SubCatList['id'];
	  $name=$SubCatList['sub_cat_name'];
	  
	  ?><span id="<?php echo $i.'basic';?>"><a href="<?php echo site_url("deletesub?id=$id&name=$cat_name&catid=$cat_id");?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a> | <i  id="<?php echo $i;?>" class="change fa fa-pencil" aria-hidden="true"></i><a href="<?php  echo site_url("subCatDetails?id=$id & cat_name=$name"); ?>"> <?php echo $SubCatList['sub_cat_name'].'<br>'; ?></a></span>
	  <span style="display:none" id="<?php echo $i.'new';?>">
	  <i id="<?php echo  $id;?>" class="savename fa fa-check" aria-hidden="true"></i>
	  <input  type="text" value="<?php echo $SubCatList['sub_cat_name'];?>" class="<?php echo $id.'input';?>">
	  </span>
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
	
	 $.ajax({
		url:"<?= base_url('')?>UpdateSubCatName",
		method:"POST",
		data:{'catid':catid,'catname':cat_name},
		success:function(data)
		{
		        alert(data);
				location.reload();
			
		}
	}); 
});





</script>

