<?php error_reporting(0); ?>
<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Categories List</a></li>
    <li><a data-toggle="tab" href="#menu1">Add Category</a></li>
		
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
   
   $AllCatList= $this->ProductCategoryModal->GetAllCat($bid);
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
		<th>Image</th>
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
		<td <?php if($SingleList['image']==''){ ?> style="display:none" <?php } ?> class="imagesec<?php echo $id;?>"><img  src="<?php echo $SingleList['image'];?>" style="width:50px;height:50px"><i id="<?php echo $id; ?>" class="fa fa-times-circle changecatimage" aria-hidden="true"></i></td>
		<td  <?php if($SingleList['image']==''){ ?> style="display:block" <?php }else{?> style="display:none" <?php } ?>    class="imageuploadsec<?php echo $id;?>"><form  enctype="multipart/form-data" id="imagecontainer<?php echo $id; ?>" action="<?php echo site_url("changeCatImage");?>" method="post"><input type="file" name="catimg" class="imageinput"><input class="helpincat" type="hidden" name="changedcatid" value="<?php echo $id;?>"><input type="submit" class="btn btn-info" value="ADD" ></form></td>
		<td id="<?php echo $i.'new';?>" style="display:none"><input required type="text" value="<?php echo $SingleList['cat_name'];?>" class="<?php echo $id.'input';?>"><button style="margin-top:10px" class="savename btn btn-default">Save</button></td>
		<td><span class="change" id="<?php echo $i;?>"><i style="color:#5867dd" class="fa fa-pencil" aria-hidden="true"></i></span></td>
		<td><a href="<?php echo site_url("CatDetails?id=$id&cat_name=$name");?>">View</a></i></td> 
		<td><a href="" class="newanchor" id="<?php echo site_url("DeleteCat?cat_id=".$id);?>" data-toggle="modal" data-target="#myConModal"><i class="fa fa-times-circle" aria-hidden="true"></a></i></td>
      </tr>           
	<?php  $i++;}}?>
    </tbody>
  </table>  
</div>
	 
	 
    </div>
    <div id="menu1" class="tab-pane fade background">
      
<div id="form">
<div class="container">
	 
	    <div class="row">
	    <div class="col-md-6 col-xs-12">
		<div class="row">
  
 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('category');?>">
   <div class="form-group col-md-4">
      <label for="email">Parent Category</label>
	  </div>
	  <?php
	    
		  $AllCat= $this->ProductCategoryModal->GetAllCat($bid);?>
	  
	  
	  <div class="col-md-8">
      <select  class="form-control" id="catselect" name="Parent_cat" style="margin-top:0px;">
	  <option value="0" selected >--Root--</option>
	  <?php foreach($AllCat as $singlecat){
		  $cat_id_array[]=$singlecat['id'];
		 
		  ?>
	  <option value=<?php echo $singlecat['id'].',cat'; ?>><?php echo $singlecat['cat_name'];?></option>
	  <?php }?>
	    <option disabled > -----------------Sub Category-------------</option>
	   <?php  for($i=0;$i<count($cat_id_array);$i++){
              $AllSubCat= $this->ProductCategoryModal->GetAllSubCat($cat_id_array[$i]);
		  foreach($AllSubCat as $singlecat){
			    $sucat_id_array[]=$singlecat['id'];
			if(isset($singlecat['sub_cat_name'])){  ?>
	  <option value=<?php echo $singlecat['id'].',Subcat'; ?>><?php echo $singlecat['sub_cat_name'];?></option>
	   <?php } } }?>
	   <option disabled > ---------------Sub Sub Category-------------</option>
	   <?php for($i=0;$i<count($sucat_id_array);$i++){
		 $AllSuperSubCat= $this->ProductCategoryModal->GetAllSuperSubCat($sucat_id_array[$i]);
		 
		  foreach($AllSuperSubCat as $singleSupercat){

		if(isset($singleSupercat['name'])){	  ?>
	  <option disabled value=<?php echo $singleSupercat['id'].',super_sub_cat'; ?>><?php echo $singleSupercat['name'];?></option>
	   <?php }}  } ?>
	 
	  </select><label style="color:red">Please Select Root If You Want To Add A New Product Category.</label>
    </div>
	</div>
	<div class="row">
	
   <!----------------address-------------------------> 
   <div class="form-group col-md-4">
      <label for="email">Name</label>
	  </div>
	  <div class="col-md-8">
      <input required type="Text" class="form-control"   name="name" style="margin-top:0px !important;">
    </div>
	</div>
  
   
	 <div class="row">
	 <div class="col-md-12">
	 <h4 style="border-bottom:1px solid #f4f4f4; padding-bottom:10px;">Add Image</h4></div>
   <div class="form-group col-md-4">
      <label for="email">Upload</label>
	  </div>
	  <div class="col-md-8">
      <input required type="file" class="form-control"  placeholder="image" name="image" style="margin-top:0px !important;">
	   <input type="hidden" name="redirect" value="category" >
    </div>
	</div>

	<div class="row">
			<div class="col-md-12">
					<input type="submit" name="nsert_cat" value="SAVE" class="btn btn-info">
			</div>
	</div>
	
  </form>
  </div>
</div>
</div>

 <!-- </form>-->
<hr>
</div>
    </div>
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


////confirmatiom-Of-Delete
			
	$('.newanchor').click(function(){
		var myId = $(this).attr('id');
		$("#deca").attr("href", myId);
	});
// change or delete cat image	
$('.changecatimage').click(function(){
		var myId = $(this).attr('id');
		$.ajax({
		url:"DeleteCatImages",
		method:"POST",
		data:{'catid':myId},
		success:function(data)
		{
		        if(data=="1")
				{
					$('.imagesec'+myId).css('display','none');
					$('.imageuploadsec'+myId).css('display','block');
				}
				
			
		}
	});
		
	});	
/**************************************
$('.ff').click(function(){
alert($(".imageinput").val());
   	 id=$('.helpincat').val();
    var formData = new FormData($('#imagecontainer'+id)[0]);	 
for (var pair of formData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
}
	
   	 
   
        $.ajax({
               type:'POST',
               url: "changeCatImage",
               data:formData,
               cache:false,
               contentType: false,
               processData: false,
               success:function(data){  
                  alert(data);
               },
               error: function(data){
                   console.log(data);
                   alert(data);
               }
           });
      
       
      });**/
</script>
