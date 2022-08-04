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
    <li <?php if($active=='home'){?> class="active" <?php } ?>><a data-toggle="tab" href="#home">Categories List</a></li>
	<li <?php if($active=='menu3'){?> class="active" <?php } ?>><a data-toggle="tab" href="#menu3">Add List</a></li>
    <li <?php if($active=='menu1'){?> class="active" <?php } ?>><a data-toggle="tab" href="#menu1">Add Category</a></li>
		
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane <?php if($active=='home'){ echo "active";}else{ echo "fade";} ?> background">
      <h3>Manage List</h3>
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
   
   $AllCatList= $this->ProductCategoryModal->GetAllList();

   ?>
  <table class="table table-striped">
    <thead>
      <tr>
	   
        <th>List</th>
		<th>View</th>
		<th>Edit</th>
		<th>Delete</th> 
      </tr>
    </thead>
    <tbody>
	<?php $i=1; foreach($AllCatList as $SingleList ) { ?>
      <tr>
	  <td id="<?php echo $i.'basic';?>"><?php echo $SingleList['listname']; $vid=$SingleList['id'];?></td>
	  <td id="<?php echo $i.'new';?>" style="display:none"><input required type="text" value="<?php echo $SingleList['listname'];?>" class="<?php echo $vid.'input';?>"><button class="savename btn btn-default" value="<?php echo $vid; ?>">Save</button></td>
	  <td><a style="color:#5867dd" href="<?php echo site_url('catinsidelist?listid='.$vid); ?> " >View</a></td>
	  		<td><span class="change" id="<?php echo $i;?>"><i style="color:#5867dd" class="fa fa-pencil" aria-hidden="true"></i></span></td>
	  <td ><i  id="<?php echo $SingleList['id'];?>" style="color:#5867dd" class="fa fa-times-circle list" aria-hidden="true"></i></td>
        
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
						  
								 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('categorylist');?>">
								   <label>List Name</label>
									<input type="text" name="addlist" class="form-control">
									<input style="margin-top: 10px;" type="submit" value="Add" name="addlistbutton" class="btn btn-info listbtn">
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
    <div id="menu1" class="tab-pane <?php if($active=='menu1'){ echo "active";}else{ echo "fade";} ?> background">
            
<div id="form">
<div class="container">
	 
	    <div class="row">
	    <div class="col-md-6 col-xs-12">
		<div class="row"> 
  
 <form method="post" enctype="multipart/form-data" action="<?php echo site_url('category');?>">
       <div class="row">
			<div class="form-group col-md-4">
				<label for="list">List</label>
			</div>
			<div class="col-md-8">
				<select name="listid" class="form-control" >
				<option>----select----</option>
				<?php foreach($AllCatList as $SingleList ) { ?>
					<option value="<?php echo $SingleList['id'];?>" ><?php echo $SingleList['listname'];?></option>
				<?php } ?>
				</select>
			</div>
		</div>
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
	  <input type="hidden" name="redirect" value="categorylist?tab=1">
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
	listid=$(this).val();
	list_name=$('.'+listid+'input').val();
	
	$.ajax({
		url:"<?= base_url('')?>UpdateListName",
		method:"POST",
		data:{'listid':listid,'listname':list_name},
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

/******************delete lists*****************/
 $('.list').click(function(){
	listid=$(this).attr('id');
   $.ajax({
		url:"<?= base_url('')?>DeleteList",
		method:"POST",
		data:{'Listid':listid},
		success:function(data)
		{
		        alert(data);
				location.reload();
			
		}
	});
});
/**********************************************/


</script>
