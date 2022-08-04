<?php error_reporting(0);
if(isset($_GET['listid']))
{
	$listid=$_GET['listid'];
}
else
{
	redirect('categorylist');
}
 ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Categories List</a></li>
   
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane  active background">
      <h3>Manage Category</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
	 
   <?php 
     if(isset($_SESSION['Current_Business'])){
		$bid=$_SESSION['Current_Business'];
	
 }else
 {
	 $bid=$_SESSION['status']['business_id'];
	 
 }
   
   $AllCatListdata= $this->db->query("select *from dev_product_cat where listid=$listid");
   $AllCatList=  $AllCatListdata->result_array();
   $cat_id_array=array();
   $sucat_id_array=array();
   $storecat=array();
   ?>
  <table class="table table-striped">
    <thead>
      <tr>
	    <th>Sr</th>
        <th>Unique ID</th>
        <th>Category</th>
		<th>Edit</th>
		<th>View</th>
		<th>Delete</th> 
      </tr>
    </thead>
    <tbody>
	<?php $i=1;foreach($AllCatList as $SingleList ) { 
    if(!in_array($SingleList['cat_name'], $storecat)){
	?>
      <tr>
	  <?php
	 $id= $SingleList['id'];
	  $name=$SingleList['cat_name'];
	  array_push($storecat,$SingleList['cat_name']);
	  ?>
        <td><?php echo $i;?></td>
		 <td><?php echo $id;?></td>
        <td id="<?php echo $i.'basic';?>"><a href="<?php echo site_url("CatDetails?id=$id&cat_name=$name");?>"><?php echo $SingleList['cat_name'];?></a></td>
		<td id="<?php echo $i.'new';?>" style="display:none"><input required type="text" value="<?php echo $SingleList['cat_name'];?>" class="<?php echo $id.'input';?>"><button class="savename btn btn-default" value="<?php echo $id; ?>">Save</button></td>
		<td><span class="change" id="<?php echo $i;?>"><i style="color:#5867dd" class="fa fa-pencil" aria-hidden="true"></i></span></td>
		<td><a href="<?php echo site_url("CatDetails?id=$id&cat_name=$name");?>">View</a></i></td> 
		<td><a href="#"><a href="<?php echo site_url("DeleteCat?cat_id=".$id);?>"><i class="fa fa-times-circle" aria-hidden="true"></a></i></td>
      </tr>      
	<?php  $i++;}}?>
    </tbody>
  </table>
</div>
	 
	 
    </div>
	
	<script>
$('.savename').click(function(){
	catid=$(this).val();
	cat_name=$('.'+catid+'input').val();
	
	$.ajax({
		url:"<?= base_url('')?>UpdateCatName",
		method:"POST",
		data:{'catid':catid,'catname':cat_name},
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

</script>