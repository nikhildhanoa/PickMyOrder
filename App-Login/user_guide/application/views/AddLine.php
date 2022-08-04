<?php 
$refnumber=$_GET['refnumber'];
?>
<body>
<div id="form">
<div class="container">
<div class="add-line_sec ">
<div id="home" class="addline_cont">
	  <h3>Add Line</h3>
	  </div>
	  
	    <div class="row">
	    <div class="col-md-6 col-xs-12">

  <!--<form class="form-inline" action="/action_page.php">-->
 <!----------------busniss-name------------------------->   
 <form method="post" action="<?php echo site_url('addline'); ?>">
  <div class="form-horizontal">
   <div class="form-group ">
   <!--hidden---->
   <input type="hidden" name='refnumber' value="<?php echo $refnumber;?>">
   <!--hidden---->
      <label class="control-label col-md-4" for="email">Product Id/SKU </label>

	  <div class="col-md-8">
      <input type="text" required class="form-control" id="Product_num_sku" placeholder="Product Id/SKU " name="Code">
    </div>	
	</div>


	
   <!----------------address-------------------------> 
   <div class="form-group">
 <label class="control-label col-md-4" for="email">Product Description</label>
	 
	  <div class="col-md-8">
      <textarea required class="form-control" id="product_description" placeholder="Product Description" name="description"></textarea>
    </div>
 </div>
   <!----------------post code------------------------->
  
   <div class="form-group ">
 <label class="control-label col-md-4" for="email">Qty</label>
	 
	  <div class="col-md-8">
      <input required type="number" class="form-control" id="Qty" placeholder="Qty" name="qty">
    </div>
	</div>
	
	
   <!----------------Email------------------------->

   <div class="form-group ">
 <label class="control-label col-md-4" for="email">Cost</label>
	
	  <div class="col-md-8">
      <input required type="text" class="form-control" id="Cost" placeholder="Supplier Cost" name="Cost">
    </div>
  </div>
   <!----------------Contact Name------------------------->  

   <div class="form-group">
 <label class="control-label col-md-4" for="email">Supplier</label>
<?php 

 if(isset($_SESSION['Current_Business'])){
	$All_Supplier=$this->SupplierModel->Select_All_Supplier($_SESSION['Current_Business']);
 }else
 {
	$All_Supplier=$this->SupplierModel->Select_All_Supplier($_SESSION['status']['business_id']); 
 }
	
	?>
	  <div class="col-md-8">
      <select required class="form-control" id="supplier"  name="supplier">
	  <option selected disabled>----Select----</option>
	  <?php foreach($All_Supplier as $supp){ ?>
	  <option value="<?php echo $supp['id']; ?>"><?php echo $supp['suppliers_name'];?></option>
	  <?php } ?>
	 
	  
	  </select>
	 <div class="save_btn btn_sec2"> <input style="margin-top:20px" class="btn btn-info" type="submit" name="Add_product" value="ADD PRODUCT"></div>
	 
    </div>

		  </div>
 
  </div>
</div>
</form>
<hr>
</div>

</div>	  
 <script>

 jQuery('#Product_num_sku').blur(function(){
	 var cost = new Array();
	   ProCode=$(this).val(); 
	   optionValue='4';
	 jQuery.ajax({
		
		url:"<?= base_url('')?>GetBySky",
		method:"POST",
		
		data:{'SKU_ID':ProCode},
		success:function(d){
			
			 if(d!=0){
				 obj=jQuery.parseJSON(d);
	jQuery('#product_description').val(obj['des']);
		length=obj.arr.length;
		for(i=0;i<=length-1;i++){
		 
		 cost[i]=obj.arr[i].supplier_cost;
		 $('<option>').val(obj.arr[i].supplier_cost).text(obj.arr[i].supplier_name).appendTo('#supplier');
		}
			 }else{
				optionValue='0';
				alert('No Product Found');
		jQuery('#product_description').val('');
			jQuery('#Qty').val('');
			jQuery('#Cost').val('');
			$("#supplier").val(optionValue)
.find("option[value=" + optionValue +"]").attr('selected', true);
			} 
		}
		
	});
	
 });
 jQuery('#supplier').change(function(){
	scost=jQuery("#supplier option:selected").val();
	jQuery("#Cost").val(scost);
 });
 
 
   	
 </script>
