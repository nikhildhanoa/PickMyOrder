<?php error_reporting(0); ?>
<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>

<script type="application/x-javascript">

tinymce.init({selector:'#spc0'});

</script>
 
<div class="container">


  <ul class="nav nav-tabs productnav">
    <li id="man" class="<?php echo (isset($tab)) ? '': 'active'; ?>"><a data-toggle="tab" href="#home">Manage Products</a></li>
    
    <li  class="<?php echo (isset($tab)) ? 'active': ''; ?>"><a data-toggle="tab" href="#menu1">Add Products</a></li>
    <li  class="menu2 <?php //echo (isset($tab)) ? 'active': ''; ?>"><a data-toggle="tab" href="#menu2">Add List Product</a></li>
	
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane <?php echo (isset($tab)) ? 'fade': 'active'; ?>">
	   <!--------------------------------------------Fillers section----------------------------------->
 
	<div class="row">
		<div class="col-lg-6 cat">
			<div class="input-group md-form form-sm form-2 pl-0">
				<input id="searchinput" class="my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
					  <div class="input-group-append">
						<span class="presssearch input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey "
		  		aria-hidden="true"></i></span>
					  </div>
			</div>
		</div>
					<?php 
  
					  if(isset($_SESSION['Current_Business'])){ 
					  $bu_id=$_SESSION['Current_Business'];
					  }
					  else
					  {
						  $bu_id=$_SESSION['status']['business_id'];
					  }
					  $AllCat=$this->ProductCategoryModal->GetAllCat($bu_id);
					  $manufatureobj=$this->db->query("select Manufacture from dev_products where business_id='$bu_id'");
					  $manufaturearray=$manufatureobj->result_array();
					?>
		<div class="col-lg-6 manu">
			<select class="fillterselect" id="categoryfillter">
				<option>Category</option>
				<?php foreach( $AllCat as $singe){?>
					<option value="<?php echo $singe['id'];?>"><?php echo $singe['cat_name'];?></option>
				<?php } ?>
			</select>
			<select class="fillterselect" id="manufacturefillter">
				<option>Manufacture</option>
				<?php foreach( $manufaturearray as $singellist){ if($singellist['Manufacture']!=''){ ?>
					<option value="<?php echo $singellist['Manufacture'];?>"><?php echo $singellist['Manufacture'];?></option>
				<?php } } ?>
			</select>
		</div>
	</div>
<hr>
  <!---------------------------------------------------------------------------------------------->
       <h3>Manage Products</h3>
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  
  <table class="table background table-striped" id="all_list">
    <thead>
      <tr>
        <th>Image</th>
        <th>Product Title</th>
        <th>SKU</th>
		<th>Publish Status</th>
		<th>Edit</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody id="listproducttbody">
	<?php
	if(isset($_SESSION['Current_Business'])){ 
	$bid=$_SESSION['Current_Business'];
     $All_Product= $this->ProductModel->GetAllProduct($_SESSION['Current_Business']);
	}else
	{
		$bid=$_SESSION['status']['business_id'];
		$All_Product= $this->ProductModel->GetAllProduct($_SESSION['status']['business_id']);
	}
	if($All_Product){
	 $All_Product=$All_Product->result_array();
	
	 foreach($All_Product as $single_Product){
	?>
      <tr>
        <td><img width="50px" height="50px" src="<?php echo $single_Product['products_images'];?>"></img></td>
        <td> <?php echo $single_Product['title'];?></td>
        <td><?php echo $single_Product['SKU'];?></td>
		  
		<!-- <td>€<?php echo $single_Product['price'];?></td>-->
		 
		 <td><?php $publish_status=$single_Product['publish_status']; if($publish_status=='1'){echo "yes";}else{ echo "No";}?></td>
		 
		<td><a href="<?php echo site_url('Edit_single_product?id='.$single_Product['id']);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td> 
		
		<td><a href="#" class="newanchor " id="<?php echo site_url('delete_single_product?id='.$single_Product['id']);?>" data-toggle="modal" data-target="#myConModal"><i class="fa fa-times-circle getid" aria-hidden="true"></i></a></td>
      </tr>      
	<?php } }?>
    </tbody>
  </table>
    </div></div>
	
    <div id="menu1" class="tab-pane <?php echo (isset($tab)) ? 'active show in': 'fade'; ?>">
     <div class="container">

<?php $checkcat=$this->ProductCategoryModal->GetAllCat($bid); if($checkcat){ ?>
  <ul class="nav nav-tabs">
    <li class="<?php echo (isset($tab)) ? ($tab['sub']=="pd")? 'active' : '' : 'active'; ?>"><a data-toggle="tab" href="#pd">Product Details</a></li>
    <li class="disablealert disabled<?php //echo (isset($tab)) ? ($tab['sub']=="add_img")? 'active' : '' : ''; ?>"><a data-toggle="tab" href="#ai">Add Images</a></li>
    <li class="disablealert disabled<?php //echo (isset($tab)) ? ($tab['sub']=="sc")? 'active' : '' : ''; ?>"><a data-toggle="tab" href="#sc">Suppliers Cost</a></li>
	 <li class="disablealert disabled<?php //echo (isset($tab)) ? ($tab['sub']=="sp")? 'active' : '' : ''; ?>"><a data-toggle="tab" href="#sp">Specification</a></li>
	  <li class="disablealert disabled<?php //echo (isset($tab)) ? ($tab['sub']=="ao")? 'active' : '' : ''; ?>"><a data-toggle="tab" href="#ao">Add Option</a></li>
	   <li class="disablealert disabled<?php //echo (isset($tab)) ? ($tab['sub']=="pm")? 'active' : '' : ''; ?>"><a data-toggle="tab" href="#pm">PDF Manual</a></li>
	   <li class="li-file"><form id="sendcsvtoanotherfile" enctype="multipart/form-data" method="post" action="uploadcsvfilebyajax"><label>Import<input type="file" accept=".csv" id="importcsv" size="60" name="thisiscsv"></label></form><li>
	   <li class="li-file firstli" style="margin-left:10px"><span class="luckinimport btn btn-info">Lukins</span><li>
	   <li class="li-file secli" style="margin-left:10px;display:none"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i><li>
  </ul>
 <!-----------------------------------------------Modal popup----------------------------------------->
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 <!-----------------------------------------------close----------------------------------------------->
  <div class="tab-content">
    <div id="pd" class=" tab-pane <?php echo (isset($tab)) ? ($tab['sub']=="pd")? 'active' : '' : 'active'; ?>">
     
<div id="form">
<div class="container">

	 <?php 
   if($this->session->flashdata('successdetails')){
 ?>
   <div class="alert alert-success"> 
     <?php  echo $this->session->flashdata('successdetails'); ?>
	 </div>
<?php  
   }  
if($this->session->flashdata('failed')){
?>
 <div class = "alert alert-success">
   <?php echo $this->session->flashdata('faileddetails'); ?>
 </div>
<?php } ?>
	    <div class="row">
		  <form  id="product_form" enctype="multipart/form-data" method="post" action="<?php echo site_url('products');?>">
	    <div class="col-md-6 col-xs-12 back">
	 <h2>Product  Details</h2>
	

	 <div class="marg product-form">

  <div class="form-horizontal">
  
   <div class="form-group ">
      <label required class="control-label col-sm-4" for="name">Manufactured By</label>
	
	  <div class="col-md-8">
       <input  type="text" class="form-control"  placeholder="" value="<?= isset($_POST['Manufacture'])? $_POST['Manufacture']: '';?>" name="Manufacture">
    </div>
	  </div>
  
    <div class="form-group ">
      <label required class="control-label col-sm-4" for="name">Product Code</label>
	
	  <div class="col-md-8">
       <input required type="text" class="form-control"  placeholder="" value="<?= isset($_POST['name'])? $_POST['name']: '';?>" name="name">
    </div>
	  </div>
	   <div class="form-group ">
      <label class="control-label col-sm-4" for="name">Title</label>
	
	  <div class="col-md-8">
       <input required type="text" class="form-control"  placeholder="" value="<?= isset($_POST['title'])? $_POST['title']: '';?>" name="title">
    </div>
	  </div>
  
 
 <div class="form-group ">
      <label class="control-label col-sm-4" for="name">SKU</label>
	
	  <div class="col-md-8">
       <input required type="text" class="form-control"  placeholder="" value="<?= isset($_POST['SKU'])? $_POST['SKU']: '';?>" name="SKU">
    </div>
	  </div>
	  
	 
	  
   <!----------------SKU------------------------->   
 
 <div class="form-group ">
      <label class="control-label col-sm-4" for="name">Description</label>
	
	  <div class="col-md-8">
      <textarea required type="text" class="form-control"  name="Description"><?= isset($_POST['Description'])? $_POST['Description']: '';?></textarea>
    </div>
	  </div>
    <!-- <div class="form-group ">
      <label class="control-label col-sm-4" for="name">Price</label>
	
	  <div class="col-md-8">
       <input type="text" class="form-control"  placeholder="" name="price">
    </div>
	  </div>  -->
	   <div class="form-group">
      <label class="control-label col-sm-4" for="name">VAT Deductable</label>
	
	  <div class="col-md-8">
	  
      Yes<input <?php if(isset($_POST['deduct'])){ if($_POST['deduct']=='1'){?> checked <?php }  } ?> type="radio" class="tax_class" value="1" name="deduct">
      No<input checked <?php if(isset($_POST['deduct'])){ if($_POST['deduct']=='0'){?>checked <?php }  } ?>  type="radio"  class="tax_class" value="0"  name="deduct">
    </div>
	  </div>
<div class="form-group">
      <label class="control-label col-sm-4" for="name">Price Ex VAT</label>
	
	  <div class="col-md-8">
  <input required type="text" class="form-control"  placeholder="" value="<?= isset($_POST['Description'])? $_POST['Price_ex_VAT']: '';?>" name="Price_ex_VAT" id="pexvat" >
    </div>
	  </div>

 <div class="form-group ">
      <label class="control-label col-sm-4" for="name">Price INC VAT</label>
	
	  <div class="col-md-8">
    <input readonly type="text" class="form-control" placeholder="" value="<?= isset($_POST['Description'])? $_POST['Price_INC_VAT']: '';?>" name="Price_INC_VAT" id="pincvat">
    </div>
	  </div>
     

 
 <div class="form-group" id="tax_class">
      <label class="control-label col-sm-4" for="name">Tax Class</label>
	
	  <div class="col-md-8" >
    <select name="tax" id="taxrate">
	<option value='' selected disabled>--Selected--</option>
	<option value='5'  <?php if(isset($_POST['tax'])){ if($_POST['tax']=='5'){?> selected <?php }  } ?>>5%</option>
	<option <?php if(isset($_POST['tax'])){ if($_POST['tax']=='10'){?> selected <?php }  } ?> value='10' >10%</option>
	<option <?php if(isset($_POST['tax'])){ if($_POST['tax']=='20'){?> selected <?php }  } ?>selected value='20' >20%</option>
	</select>
    </div>
	  </div>
	
	 <!----------------Tax ------------------------->   

 <div class="form-group">
      <label class="control-label col-sm-4" for="name">Publish</label>
	
	  <div class="col-md-8">
          Yes<input <?php if(isset($_POST['pub'])){ if($_POST['pub']=='1'){?> checked <?php }  } ?> selected  type="radio" value="1" name="pub">
      No<input checked <?php if(isset($_POST['pub'])){ if($_POST['pub']=='0'){?> checked <?php }  } ?> type="radio"  value="0" name="pub">
    </div>
	  </div>
  
      </div>
	  </div>
 </div>
	<div class="col-md-6 col-xs-12">
	 <h2>Category</h2>

   <div class="marg product-form">

  <div class="form-horizontal">
  
  
  <!------------Get All  category------------->
  <?php 
  
  if(isset($_SESSION['Current_Business'])){ 
  $bu_id=$_SESSION['Current_Business'];
  }
  else
  {
	  $bu_id=$_SESSION['status']['business_id'];
  }
  $AllCat=$this->ProductCategoryModal->GetAllCat($bu_id);
  ?>
   <div class="form-group">
      <label class="control-label col-sm-4" for="name">Main Category</label>
	  <div class="col-md-8">
 <select class="form-control"  name="Category" id="maincat" >
  <option value="" selected disabled>--Select--</option>
 <?php foreach($AllCat as $All){?>
 <option  <?php if(isset($_POST['Category'])){ if($_POST['Category']==$All['id']){?> selected <?php }  } ?> value=<?php echo $All['id']; ?>><?php echo $All['cat_name']; ?></option>
 <?php } ?>
 </select>
    </div>
	  </div>
   <!-------->
  
  
   
   <div class="form-group">
      <label class="control-label col-sm-4" for="name">Sub Category</label>
	
	  <div class="col-md-8">
      <select class="form-control"  name="Sub_Category" id="subcat">
	  <option  value="" selected disabled>--Select--</option>
 
 </select>
    </div>
	  </div>
	
   <div class="form-group">
      <label class="control-label col-sm-4" for="name" id="supersubcat">Sub_Sub_Category</label>
	
	  <div class="col-md-8">
	  <?php $AllSuperSubCat=$this->ProductCategoryModal->GetAllSuperSubCat(0);?>
  <select class="form-control"  name="Sub_Sub_Category" id="subsubcat">
   <option value="" selected disabled>--Select--</option>
 </select>
    </div>
	  </div>
	  <div >
     <h2 class="filltergeading" style="display:none">Add Filter</h2>
	 <div class="form-group FilltersDiv">
	 
	 </div>
	  
	  </div>
 
</div>

<button class="btn btn-info" <?PHP if(isset($_POST['AddGernelDetails'])){ if($_POST['deduct']=='0'){ ?>style="display:none"<?PHP  } } ?> name="AddGernelDetails" >ADD PRODUCT</button>
</div>
</div>

   
	
</div>

</div>

</form>
   </div>
    

   </div> </div><?php }else{?><span style="color:red";>Please Add A Category First.</span><?php } ?>
   
  
</div>
</div>
<!-------------------------------------------- Add Product list tab content----------------------------------------------->
 <div id="menu2" class="tab-pane ">
	  
 	<div class="row">
		<div class="col-lg-6 cat">
			<h3>List Products</h3>
		</div>
					
		<div class="col-lg-6 ">
			<!-----------------------------------------list dropdown for list------------------------------------------------------>
	   	<?php 
			   $AllProListData= $this->db->query("select * from dev_productlist where masterlist='1' order by `productlistname` ASC");
			   $AllProList=$AllProListData->result_array();
       ?>
	<div style="margin-left:208px" class="masterdrop"><select id="masterlistbox" style="height: calc(1.5em + 1.3rem + 2px);
    padding: 6px;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #e2e5ec;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;">
	<option value="0" selected>Select List To Copy</option>
	<?php 
	foreach($AllProList as $prodata)
	{ ?>
	<option value="<?php echo $prodata['id']; ?>"><?php echo $prodata['productlistname'];?></option>
	<?php
	}
	?>
	</select> <span class="btn btn-info copymasterlist ">Copy</span></div>
	<!--------------------------------------------------------------------------------------------------------------------->
			
		</div>
	</div>
	
<hr>

	
       
     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
	 <div class="container">
  
  <table class="table background table-striped" id="masterlist_item">
    <thead>
      <tr>
        <th>Image</th>
        <th>Product Title</th>
        <th>SKU</th>
		<th>Publish Status</th>
		<th>Copy All <input type="checkbox" class="allchecked"></th>     
      </tr>
    </thead>
    <tbody id="Masterlistproducttbody">
	
      <tr>
       
      </tr>      
	
    </tbody>
  </table>
    </div></div>
<!------------------------------------------------------------------------------------------------------------------------>
</div>
<script>
		$(document).ready(function(){
			l=1;
			$('#add_supplier').click(function(){
		$('#single_row').append('<div class="col-md-6 col-xs-12  "><div class="form-group "><label class="col-md-3 control-label" for="address">Supplier</label><div class="col-md-9   "> <select class="form-control" id="supp'+l+'" name="supp'+l+'"><option value="0">Select</option><?php foreach($All_Supplier as $single){?><option value=<?php echo $single['id'];?>><?php echo $single['suppliers_name'];?></option><?php } ?></select></div></div></div><div class="col-md-6 col-xs-12 " id="form"><div class="form-group"><label class="col-md-3 control-label"  for="name">Cost</label><div class="col-md-9"> <input id="suppcost'+l+'" name="suppcost'+l+'" type="text" class="form-control" ></div> </div></div>');

		l++;
		});
		j=1;
		$('#Add_specifictaion').click(function(){
			$('.addnewsp').append('<div class="form-horizontal"><div class="row row3"><label class="col-md-3 control-label spc'+j+'" >Description</label><div class="col-md-5 "><textarea  class="form-control" id="spc'+j+'" name="spc'+j+'" " ></textarea></div><div class="form-group col-md-4"><div class="col-md-9 offset-md-3"><span class="btn btn-info rem" id="'+j+'">REMOVE</span></div></div></div></div>');
			
			j++;
			jQuery('.rem').click(function(){
			id=$(this).attr('id');
			$("#"+'spc'+id).remove();
			$("."+'spc'+id).remove();
			$("#"+id).remove();
			
		});
		});
		allvalue=new Array();
		allsuplierid_cost=new Array();
		$('#Addspecbyajax').click(function(){       //add spcification
			for(i=0;i<j;i++){
			allvalue[i]=$("#"+'spc'+i).val();
			}
			 $("#"+'spc0').val(allvalue);
			 $('#specification_form').submit();
		});
		$('#Addsuppliersbyajax').click(function(){        //add supplier
			 for(k=0;k<l;k++){
			allsuplierid_cost[k]=$("#"+'supp'+k).val()+'=>'+$("#"+'suppcost'+k).val();
							}
			 $("#hidsuppli").val(allsuplierid_cost);
			 $('#supplier_form').submit();
			   });

		$('#addoption').click(function(){
			var placeholder=$('#placeholder_name').val();
			var varname=$('#var_name').val();
			if(placeholder!=''&&varname!=''){
			$.ajax({
				url:"<?= base_url('')?>AddProductVariation",
				method:"GET",
				data:{'placeholder':placeholder,'varname':varname},
				success:function(data){
					 alert(data);
					$('#var_name').val('');
					$('#placeholder_name').val('');
					$.ajax({
				url:"ViewProductVariation",
				success:function(data){
					$('#vartionMessage').text('Please Go To Edit Product To Add Variation For The Options');
					$('.newrow').empty();
					decodeddata=JSON.parse(data);
					objlen=decodeddata.length;
					for(i=0;i<objlen;i++)
					{
						id=decodeddata[i].id;
						product_id=decodeddata[i].product_id;
						name=decodeddata[i].option_name;
						plaseholder=decodeddata[i].plaseholder	;
					
					$('#Variation_row').after("<tr class='newrow'><td>+</td><td>"+name+"</td><td>"+plaseholder+"</td><td><a href=deletevariationoption?optionid="+id+"&&product="+product_id+"><i class='fa fa-times-circle' aria-hidden='true'></i></a></td></tr>");
					
					} 
					
				}
			});
					
				}
			});
			}
			else
			{
			alert('Please Enter NAme And Placeholder');
			}
		});

			
			$('#subcat').change(function(){
				$sub_cat_id=$(this).val();
				$.ajax({
				url:"<?= base_url('')?>getsupersubcatbyajax",
				method:"GET",
				data:{'subcat':$sub_cat_id},
				success:function(data){
					  $('#subsubcat').empty();
					  $('#subsubcat').append('<option value="" selected >--Select--</option>'); 
					 data=JSON.parse(data);
					 
					 objlen=data.length;
					for(i=0;i<objlen;i++)
					{
					 
					$('#subsubcat').append('<option value="'+data[i].id+'" selected="selected">'+data[i].name+'</option>'); 
					}  
				  
					
				}
			});
				
			});
			$('#maincat').change(function(){ $('.filltergeading').css('display','block'); $('.FilltersDiv').empty();
				maincatinbox=$('#maincat option:selected').attr('data-label');
				
				$('#subcat').empty();
				$('#subcat').append('<option value="" selected >--Select--</option>'); 
				$cat_id=$(this).val();
				$.ajax({
				url:"<?= base_url('')?>getsubcatbyajax",
				method:"GET",
				data:{'catid':$cat_id},
				success:function(data){
					data=JSON.parse(data);
					objlen=data.length;
					for(i=0;i<objlen;i++)
					{
					  
					$('#subcat').append('<option value="'+data[i].id+'" selected="selected">'+data[i].sub_cat_name+'</option>'); 
					}
				  
					
				}
			});
			/********************************Fillter work****************************/
				$.ajax({
				url:"<?= base_url('')?>getcatfillter",
				method:"GET",
				data:{'catid':$cat_id},
				success:function(data)
				{
					obj=JSON.parse(data);
					obj.forEach(function(item) {
					  Object.keys(item).forEach(function(key) {
						id=key.replace(/\s/g, "");
						
						$('.FilltersDiv').append("<div class='row' style='margin-bottom: 10px;margin-left: 0px;margin-right: 0px;'><div class='col-md-4'><span style='color:black;margin-right: 10px;'>'"+key+"'</span></div><div class='col-md-2'><input type='checkbox' class='commencheck' name='filteritem[]' id='"+id+"' value='"+key+"'></div><div class='col-md-6'><select name='filteritemvalue[]' style='display:none' class='form-control "+id+"'></select></div></div>"); 
						item[key].split(',').forEach(function(single)
						{
							
							$('.'+id).append('<option value="'+single+'" >'+single+'</option>');
						});
					  });
					});
					 /********************************Fillter UI Work********************************/
			    $('.commencheck').change(function(){
			   id=$(this).attr('id');
						if(this.checked) 
							{
								 
								$('.'+id).css('display','block');
								
							}
							else
							{
								$('.'+id).css('display','none');
							}
		       });
			   /********************************************************************************/
				}
               });
			  
				
			});
			
         
		$('#tax_class').css('display','none');
		$('.tax_class').change(function(){
			var val=$(this).val();
			if(val=='1')
			{
				$('#tax_class').css('display','block');
				
			}
			else
			{
				$('#tax_class').css('display','none');
				var val=$('#pexvat').val();
			vat=parseFloat(val)*20/100;
			val=parseFloat(val)+parseFloat(vat);
			$('#pincvat').val(val.toFixed(2));
			}
			
			
		});
		parsent=20;
			$('#taxrate').change(function(){
			parsent=$(this).val();	
			var val=$('#pexvat').val();
			vat=parseFloat(val)*parsent/100;
			val=parseFloat(val)+parseFloat(vat);
			$('#pincvat').val(val.toFixed(2));
			});
		$('#pexvat').blur(function(){
			var val=$(this).val();
			vat=parseFloat(val)*parsent/100;
			
			val=parseFloat(val)+parseFloat(vat);
		$('#pincvat').val(val.toFixed(2));

		});

		$('#man').click(function(){
			$('#menu1').addClass('fade');
		});

		});
		  function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					
					reader.onload = function (e) {
						$('#profile-img-tag').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
			function readURL2(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					
					reader.onload = function (e) {
						$('#profile-img-tag2').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
			$("#img_1").change(function(){
				readURL(this);
			});
			 $("#img_2").change(function(){
				readURL2(this);
			});
		   $('#upimage').click(function(){
			 
		 var form_data = new FormData($('#product_form_image')[0]);
		 
			 $.ajax({
					type:'POST',
					url: "<?= base_url('')?>uploadimagebyajax",
					data:form_data,
					cache:false,
					contentType: false,
					processData: false,
					success:function(data){
					   alert(data);
					},
					error: function(data){
						console.log("error");
						alert(data);
					}
				});
		   });
		   //Disbled tabs alert
		   $('.disablealert').click(function(){
			  alert('Please Add Product Details First'); 
		   });
		   //import csv
		   $('#importcsv').change(function(){
			 $('#sendcsvtoanotherfile').submit();  
			  
		   });
		   //luckin import from curl productcontroller
		   $('.luckinimport').click(function(){
			   
				var press=confirm("This Action Import Data From Luckins For The Products Which Have A Correct Tsi Code In The Database <br> Do You Want To Perform This Action ?");
				
				if(press)
				{
					$('.firstli').css('display','none');
					$('.secli').css('display','block');
					$.ajax({
						type:"POST",
						url:"<?= base_url('')?>FetchingDataFromLuckins",
						success:function(data)
						{
							$('.secli').css('display','none');
							$('.firstli').css('display','block');
							alert(data);
						}
					}); 
				}
		   });
			/**************************fillters script on change category and manufactures****************************/
			

		 jQuery('.fillterselect').change(function(){
			  $type=$(this).attr('id');
			  if($type=='categoryfillter')
			  {
				   mode=1;
			  }
			  if($type=='manufacturefillter')
			  {
				 mode=2;  
			  }
			  catid=$(this).val(); 
			  businessid=<?php echo $bid; ?>;
			   $("#listproducttbody").empty();
			   jQuery.ajax({
				
				url:"<?= base_url('')?>ApplyFillterOnNormalProducts",
				method:"POST",
				data:{'cat_id': catid,'businessid':businessid,'type':mode},
				success:function(d){
					if(d)
					{
					var status;
					 obj=jQuery.parseJSON(d);
					
					  length=obj.length;
					  
						   
				for(i=0;i<=length-1;i++){
					
			  var $row = $('<tr>'+
			  '<td><img src='+obj[i].products_images+' style="width:50px;height50px;"></td>'+
			  '<td>'+obj[i].title+'</td>'+
			  '<td>'+obj[i].SKU+'</td>'+
			   '<td>'+obj[i].publish_status+'</td>'+
				'<td><a href="Edit_single_product?id='+obj[i].id+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'+	
				 '<td><a href="delete_single_product?id='+obj[i].id+'"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>'+
				  
				   
			  '</tr>');    
		if(obj.Type=='Error') {
			$row.append('<td>'+ obj.ErrorCode+'</td>');
		}

		$('#all_list').append($row);
				} 
				 
				}
			} //check json data is coming or not		 
					 
		 }); 
			 
		 });
				/**************************fillters script on click category and manufactures and all****************************/
			

		 jQuery('.presssearch').click(function(){
			  
			  catid=$('#searchinput').val(); 
			  businessid=<?php echo $bid; ?>;
			   $("#listproducttbody").empty();
			   jQuery.ajax({
				
				url:"<?= base_url('')?>ApplyFillterOnNormalProducts",
				method:"POST",
				data:{'cat_id': catid,'businessid':businessid,'type':'3'},
				success:function(d){
					if(d)
					{
					var status;
					 obj=jQuery.parseJSON(d);
					
					  length=obj.length;
					  
						   
				for(i=0;i<=length-1;i++){
					
			  var $row = $('<tr>'+
			  '<td><img src='+obj[i].products_images+' style="width:50px;height50px;"></td>'+
			  '<td>'+obj[i].title+'</td>'+
			  '<td>'+obj[i].SKU+'</td>'+
			   '<td>'+obj[i].publish_status+'</td>'+
				'<td><a href="Edit_single_product?id='+obj[i].id+'"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>'+	
				 '<td><a href="delete_single_product?id='+obj[i].id+'"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>'+
				  
				   
			  '</tr>');    
		if(obj.Type=='Error') {
			$row.append('<td>'+ obj.ErrorCode+'</td>');
		}

		$('#all_list').append($row);
				} 
				 
				}
			} //check json data is coming or not		 
					 
		 }); 
			 
		 });
		 
		 /****************************master list change and get all this product by ajax*********************/
		 $('#masterlistbox').change(function(){
			listid=$(this).val(); 
			$("#Masterlistproducttbody").empty();
			$.ajax({
						type:"POST",
						url:"<?= base_url('')?>CallMeForListProducts",
						data:{'listid':listid},
						success:function(data)
						{
	                       if(data)
							{
								var status;
								obj=jQuery.parseJSON(data);
								length=obj.length;
								for(i=0;i<=length-1;i++)
								{
									if(obj[i].publish_status)
									{
										ps='Yes';
									}
									else
									{
										ps='No';
									}
									var $row = $('<tr>'+
								  '<td><img src='+obj[i].products_images+' style="width:50px;height50px;"></td>'+
								  '<td>'+obj[i].title+'</td>'+
								  '<td>'+obj[i].SKU+'</td>'+
								   '<td>'+ps+'</td>'+	
									 '<td><input style="margin-left:55px;" type="checkbox" value='+obj[i].id+' class="singlecheck"></td>'+
									'</tr>');    
									if(obj.Type=='Error') 
									{
										$row.append('<td>'+ obj.ErrorCode+'</td>');
									}
									$('#masterlist_item').append($row);
								} 
							}
						} //check json data is coming or not		 
					}); 
				}); 
				/********************all checked master list products **************************************/
				$('.allchecked').change(function(){
						   if(this.checked) 
							{
								$('.singlecheck').prop('checked',true); 
								
							}
							else
							{
								$('.singlecheck').prop('checked',false); 
							}
					});
					$('.copymasterlist').click(function()   //click copy btn
						   {
							         IdArrayStore=[];
									 businessid=<?php echo $bid; ?>;
									listid=$('#alllist').val();

									if(listid!='0')
									{
										AllOrdersid=document.getElementsByClassName('singlecheck');
										$lenth= AllOrdersid.length;
										for($i=0;$i<$lenth;$i++)
										{
											if(AllOrdersid[$i].checked)
											{
												$chekedid=AllOrdersid[$i].value;
												IdArrayStore.push($chekedid);
											}
										}
									  $.ajax({
											   url:"<?= base_url('')?>Copy_List_Product",
											   type:"post",
											   data:{'newbid':businessid,'productidarray':IdArrayStore},
                                               success:function(data)
											   {
												   alert('Opration Successfully');
											   }											   
											  
												}); 
									}
						   });
			/*********************show master list dropdown if menu2 is active****************************/
			
////confirmatiom-Of-Delete
			
	$('.newanchor').click(function(){
		var myId = $(this).attr('id');
		$("#deca").attr("href", myId);
	});
		 
</script>

