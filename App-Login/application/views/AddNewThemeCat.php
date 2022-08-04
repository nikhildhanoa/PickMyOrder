<?php 
if(isset($_SESSION['Current_Business']))
			{
				$bid=$_SESSION['Current_Business'];
			}
			else
			{   
				$bid=$_SESSION['status']['business_id'];
			}



?>

<link href="<?php base_url()?>//assets/css/demo1/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.forms_another_file
{
	display: flex;
    align-items: center;
}

.li-file label {
    padding: 7px 20px;
    background: #5578eb;
    color: #fff;
    border-radius: 3px;
	cursor: pointer;
}
.li-file input[type="file"] {
    display: none;
}

</style>

<div class="container">  
	 
	    <div class="row">
		<div class="col-md-12">
			<div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
	 
		<div class="details" style="display: flex;">
         <h3 class="card-title"> Details</h3>
		 </div>
		 <div class="forms_another_file">
		 <ul class="nav nav-tabs">
        <li class="li-file"><form id="sendcsvtoanotherfile" enctype="multipart/form-data" method="post" action="ImpotCatWithCsvFile"><label  style="padding: 10px 13px;">Import<input type="file" accept=".csv" id="importcsv" size="60" name="thisiscsv"></label></form></li>
        </ul>
		 </div>
		 
	
		 </div>
		 <div class="card-body">
		  <div class="form-group">
		
		 <div class="jumbotron-sec marg dropzone pt-0" style="border: none;">
 <div class="form-horizontal">
 
	    <div class="col-md-6 col-xs-12">
		<div class="row">
			
  
    <form method="post" enctype="multipart/form-data" action="<?php echo site_url('category');?>">
     <div class="form-group pl-0">
      <label for="email">Parent Category</label>
	  </div>
	  <?php
	    

		  $AllCat= $this->ProductCategoryModal->GetAllCat($bid);
		 // print_r($AllCat);die;
		  
		  ?>
	  
	  <!----category----->
	 <div class="form-group pl-0">
    <select  class="form-control form-control-solid" id="catselect" name="Parent_cat" style="margin-top:0px;">
	         <option value="0" selected >--Root--</option>
            
			 <?php foreach($AllCat as $catdata)  {  ?>

				<option value="<?php  echo  $catdata['id'] ?>"  ><?php echo $catdata['cat_name']  ?></option>

			<?php  } ?>	
            
	</select>
	  <label class="mt-3" style="color:red">Please Select Root If You Want To Add A New Product Category.</label>
    </div>

	<!---- sub category----->
	<div class="form-group pl-0 subcathtml" style="display:none;">
    <select  class="form-control form-control-solid" id="subcatselect" name="subcat" style="margin-top:0px;">
	         <option value="0" selected >--Root--</option>

	</select>
	  <label class="mt-3" style="color:red">Please Select Root If You Want To Add A New Product Sub Category.</label>
    </div>

	<!-- sub sub category -->
	<div class="form-group pl-0 subsubcathtml" style="display:none;">
    <select  class="form-control form-control-solid" id="subsubcatselect" name="subsubcat" style="margin-top:0px;">
	         <option value="0" selected >--Root--</option>

	</select>
	  <label class="mt-3" style="color:red">Please Select Root If You Want To Add A New Product sub Sub Category.</label>
    </div>


   <div class="form-group pl-0">
      <label for="email">Name</label>
	    <input required type="Text" class="form-control form-control-solid"   name="name" style="margin-top:0px !important;">
	  </div>
	  
    
 
  
   

	 <div class="form-group">
	 <h4 style="border-bottom:1px solid #f4f4f4; padding-bottom:10px;">Add Image</h4>
	 </div>
   <div class="form-group">
      <label for="email">Upload</label>
	   <input required type="file" class="form-control form-control-solid"  placeholder="image" name="image" style="margin-top:0px !important;">
	   <input type="hidden" name="redirect" value="category" >
	  </div>
	 
     
   
	

	
			<div class="form-group">
					<input type="submit" name="nsert_cat" value="SAVE" class="btn btn-info">
			</div>
	
		</div>

   </div>
</div>
</div>
 </div>
</div>
  
  </div>
</div>
  </form>
</div>
</div>
 
<script> 
 
$("#catselect").change(function(){

 $('.subcathtml').css('display','block');
 $('.subsubcathtml').css('display','none');

  var catid= $('#catselect').val();
      
  $.ajax({
				  url:'<?= base_url('')?>Getsubcategorycat',
				  method:'post',
				  data:{'catid':catid},
				  success:function(data)
				   {   
				     
					   var content = "";
					   content += '<option value="0">--Root--</option>';
					  var jsondata = JSON.parse(data);
					      
					  for (var x = 0; x < jsondata.length; x++) {
						
           content += '<option value="'+jsondata[x].id+'">'+jsondata[x].sub_cat_name+'</option>';				  
					  }
					  $('#subcatselect').html(content); 
				   }  
		          }); 


				   

});


////
$("#subcatselect").change(function(){

$('.subsubcathtml').css('display','block');

var subcatid= $('#subcatselect').val();


$.ajax({
				  url:'<?= base_url('')?>Getsubsubcategorycat',
				  method:'post',
				  data:{'subcatid':subcatid},
				  success:function(data)
				   {   
				     
					   var content = "";
					   content += '<option value="0">--Root--</option>';
					  var jsondata = JSON.parse(data);
					      
					  for (var x = 0; x < jsondata.length; x++) {
						
           content += '<option value="'+jsondata[x].id+'">'+jsondata[x].name+'</option>';				  
					  }
					  $('#subsubcatselect').html(content); 
				   }  
		          }); 

           
});
</script>
