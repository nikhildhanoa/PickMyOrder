<?php  error_reporting(0); 
if(isset($_GET['optionid'])){
$optionid=$_GET['optionid'];
if(isset($_GET['product']))
{
$productsid=$_GET['product'];
}
}
?>
<div class="container">
 <ul class="nav nav-tabs">

	  <li class="active"><a data-toggle="tab" href="#ao">Variations</a></li>
  </ul>

<div class="tab-content">
 <div id="ao" class="tab-pane active ">
<div class="container">
	 <form method="post" action="" >
	    <div class="row">
<div class="col-md-12">
	 <h2>Add Variations</h2>
</div>
  


  
   <div class="form-group col-md-2 marg ">
      <label for="name">Name</label>
	  </div>
	  <div class="col-md-9 marg ">
      <input required type="text" class="form-control"  id="name" name="name" >
    </div>
  
  
   <div class="form-group col-md-2 marg ">
      <label for="text">Product Description</label>
	  </div>
	  <div class="col-md-9 marg ">
      <textarea  class="form-control"  id="Description" name="Description" ></textarea>
	  <input required type="hidden" name="optionid" id="optionid" value=" <?php echo $_GET['optionid']; ?>">
    </div>
	<div class="form-group col-md-2 marg ">
      <label for="text">Product Code</label>
	  </div>
	  <div class="col-md-9  ">
	 
      <input required type="text" class="form-control"  id="SKU" name="SKU" >
	  
	   
	
	  
    </div>
	<div class="form-group col-md-2 marg ">
      <label for="text">Price</label>
	  </div>
	  
	  <div class="col-md-9">
	  <div class="row">
      <div class="col-sm-5"><input required type="text" class="form-control"  id="price"  name="price" ></div>
	    <div class="col-sm-7"><span class="btn btn-info defaultprice">USE DEFAULT PRICE AND SKU</span></div> 
	  <input required type="hidden" class="form-control"  id="inc_vat"  name="inc_vat" >
	  </div>
    </div>
	<div class="col-md-12 marg ">
	
<input  type="submit" class="btn btn-default" id="Add_Variations" name="Add_Variations" value="Add Variations">
	<div>
    </div>
</div>
  </div>
  </form>
 <?php if(isset($_GET['product']))
   {?>
  <form action="<?php echo site_url('updateproducts');?>" method="post">
  <div class="btn-new-sec">
  <div class="btn-addsec"><input type="hidden" value="<?php echo $productsid;?>" name="hididforvariation"></div>
  <div class="btn-goback"><input type="SUBMIT" name="goback" value="GO BACk"></div>
  </div>
  <form>
   <?php }else{
	   ?>
	    <form action="<?php echo site_url('products');?>" method="post">
  <input type="SUBMIT" name="gobackproduct" value="GO BACk">
  <form>
  <?php } ?>
<hr>
</div>
  
  <?php $variation=$this->ProductModel->GetVariationsById($optionid);?>
    <div class="table">
	  <div class="container">
	   <div class="row">
	    <table class="table">
		  <tr><td><strong>Order</strong></td>
                <td><strong>Name</strong></td>
		      <td><strong>Product Description</strong></td>
		      <td><strong>Product Code</strong></td>
			  <td><strong>Price</strong></td>
			  <td><strong>Edit</strong></td>
			  <td><strong>Delete</strong></td>
			  </tr>
			  <?php foreach($variation as $single){ ?>
		  <tr >
		      <td><strong>+</strong></td>
			  <td><strong><?php echo $single['name'];?></strong></td>
		      <td><strong><?php echo $single['description'];?></strong></td>
		      <td><strong><?php echo $single['pcode'];?></strong></td>
			  <td><strong><?php echo $single['price'];?></strong></td>
			  <td id="<?php echo $single['id'];?>"><span class="editsinglevariation"><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
			  <?php $id=$single['id']; ?>
			  <td><strong><a href="<?php  echo site_url("deletesinglevariation?id=$id&parent=$optionid"); ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a></strong></td>
			  </tr>
			  <?php } ?>
		</table>
	   </div>
	  </div>
	</div>
	
    </div>
	</div>
	</div>
	<script>
	$('.editsinglevariation').click(function(){
		variationid=$(this).closest('td').attr('id');
		$.ajax({
		url:"<?= base_url('')?>EditSingleVariation",
		method:"POST",
		data:{'variationid':variationid},
		success:function(data){
		 ObjArray=JSON.parse(data);
            $('#name').val(ObjArray[0].name);
			$('#Description').val(ObjArray[0].description);
			$('#SKU').val(ObjArray[0].pcode	);
			$('#price').val(ObjArray[0].price);
			$('#optionid').val(variationid);
			$('#Add_Variations').val('update');
			$('#Add_Variations').attr('update');
			$('#Add_Variations').prop('name', 'update');
		}
	})
	});
	/************************varitaion price calculate*************************/
	parsent=20;
$('#price').blur(function(){
	var val=$(this).val();
	vat=parseFloat(val)*parsent/100;
	val=parseFloat(val)+parseFloat(vat);
  $('#inc_vat').val(val.toFixed(2));

});
$('.defaultprice').click(function(){
	$.ajax({
		url:"<?= base_url('')?>fetchdefaultprice",
		method:"POST",
		data:{'optionid':<?php echo $optionid; ?>},
	success:function(data)
	    {
			data=JSON.parse(data);
		ex=data[0].ex_vat;
		inc=data[0].inc_vat;
		pcode=data[0].product_name;
		$('#price').val(ex);
		$('#inc_vat').val(inc);
		$('#SKU').val(pcode);
	    }});
	
});
/***************************variation price ************************/
	</script>