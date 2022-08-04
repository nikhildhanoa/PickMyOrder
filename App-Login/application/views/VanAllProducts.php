<?php 

if(isset ($van) && isset($key))
{

 $driverdeatils=$this->db->query("select driver_name,vehicle_registration from dev_vans where id='$van_id'");
		$driverdeatils=$driverdeatils->result_array();
		
	$totalorder=$this->db->query("select sum((products_van.in_stock+products_van.toback_instock)*dev_products.ex_vat) AS onorder FROM products_van, dev_products where dev_products.id=product_id  && products_van.van_id='$van'");	
	
				$data=$totalorder->result_array();
				$totalorder=$data[0]['onorder'];
				
		
?> 
<div><div><div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
										
										
										<!--	<h3 class="card-label">
											All Products</h3> -->
											<div class="row">
											<table class="table">

  <tbody>
 
    <tr style="color:#bbbbbb;font-size:13px;text-transform:uppercase">
      <td>Driver's Name</td>
      <td>Vehicle Registration</td> 
       <td>Total  Stock</td> 	  
    </tr>
    <tr style="font-size:">
  
      <td><?php echo $key[0]['driver_name'];?></td>
      <td><?php echo $key[0]['vehicle_registration'];?></td>
	  <td>£<?php echo number_format($totalorder,2); ?></td></td>
    </tr>
  </tbody>
</table>
<div class="All_products_aign" style="display:flex;justify-content:flex-start;align-items:flex-end;height:50px;width:100%">
<h3 style="
    font-family: inherit">All Products</h3></div>
</div>



<!-- Next  -->



										</div>
										<div class="card-toolbar" style="align-items:flex-start;">
											<!--begin::Dropdown-->
											
											<!---------------------------------------------->
                                                <div class="dropdown dropdown-inline mr-2">
												<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="svg-icon svg-icon-md">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
															<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>Export</button>
												<!--begin::Dropdown Menu-->
												<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
													<!--begin::Navigation-->
													<ul class="navi flex-column navi-hover py-2">
														<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
														<li class="navi-item" >
															<a href="<?php echo base_url('PrintVanProductsTable?id='.$van); ?>" class="navi-link printthis">    
																<span class="navi-icon">
																	<i class="la la-print"></i>
																</span>
																<span class="navi-text ">Print</span>
															</a>
														</li>
														<li class="navi-item csvprint">
															<a href="<?php echo base_url('MakeCsvFileForvanProducts?id='.$van);?>" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-text-o"></i>
																</span>
																<span class="navi-text">CSV</span>
															</a>
														</li>
														<li class="navi-item">
															<a href="<?php echo base_url('PrintPdfTablevanproducts?id='.$van);?>" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-pdf-o"></i>
																</span>
																<span class="navi-text">PDF</span>
															</a>
														</li>
													</ul>
												<!--end::Navigation-->
												</div>
											<!--end::Dropdown Menu-->
											</div>

                                         <!-------------------------------------------------->

											<a class="btn btn-primary" href="<?php echo site_url('VanAllOrder?id='.$van);?>" role="button" style=" margin: 0 10px; display: inline-block;">All Orders</a>
											
											<a class="btn btn-primary" href="<?php echo base_url('VanEngineers?id='.$van); ?>" role="button">All Users</a>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body" style="padding: 14px;">
										
										
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					
					<!-- Latest_table -->
					
					
					<div class="new_table" style="margin:20px 0"><div><div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
										
										
										<!--	<h3 class="card-label">
											All Products</h3> -->
											<div class="row">
											<form method='post' action=''>
											<table>

  <tbody>
 
    <tr style="color:#bbbbbb;font-size:13px;text-transform:uppercase;height:30px">
      <td>Products code</td>
      <td>  Stock level</td>      
      <td>Reorder Level</td>      
      <td> In Stock</td>      
    </tr>
    <tr style="font-size:">
     
      <td><input type="text" style="width:80%;border: none!important; border-bottom: 2px solid #c1c1c1!important;" placeholder="Enter SKU" id="autocomplete" required></td>
   
	<input type="hidden" id="selectuser_id" name="products" required>
      <td><input type="number" style="width:80%;border: none;border-bottom: 2px solid #c1c1c1;" min="0" id="Van_Stocks" name="Van_Stocks"required></td>

	<td><input type="number" style="width:80%;border: none;border-bottom: 2px solid #c1c1c1;"  min="0" id="Reorder_Level" name="Reorder_Level" required></td>
    
	<td><input type="number" style="width:80%;border: none;border-bottom: 2px solid #c1c1c1;" min="0"  id="in_stock" name="in_stock" required></td>
	<td style="width: 90px;"></td>
	<td><input type='submit' class="btn btn-primary"  role="button" style=" margin: 0 10px; " value="Add Products" id="add_user"></button></td>
    </tr>
  </tbody>
</table></form>

</div>





<!-- Next  -->



										</div>
									
									</div>
									<div class="card-body" style=" padding: 14px;">
										
										
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
				
			<!--Latest_table-->
					
					
					
					
					
					<!--end::Content-->
				<div class="form_part" style="margin-top: 24px;">
<div class="container">
								<div class="card card-custom">
									
									<div class="card-body">
										
										<div class="mb-7">
											<div class="datatable datatable-bordered datatable-head-custom printable" id="kt_datatable"></div>
										</div>
									
									</div>
								</div>
				</div>
							</div>

		<?php
        }
       ?>		
<script>


 $(document).ready(function(){
  $("form").submit(function(){
	  
	  
  var stocklevel=$('#Van_Stocks').val();
	var reorderlevel=$('#Reorder_Level').val();
	var InStock=$('#in_stock').val();
	var  Total_InStock=Number(InStock);
	 
	 if(Number(reorderlevel)>Number(stocklevel))
		{
			alert(" Stock Level be Greater than Reorder Level  ");
			return false;
		}
	 
	 if(Total_InStock>Number(stocklevel))
		{
			alert(" Stock Level Should be Greater than the InStock");
			return false;
		}
	
	 
  });
});

 

/*
$("#add_user").click(function(){
	var product=$('#selectuser_id').val();
		var stocklevel=$('#Van_Stocks').val();
	var reorderlevel=$('#Reorder_Level').val();
	var InStock=$('#in_stock').val();
	
	$.ajax({
		
		url:"InsertVanProducts",
		type:"post",
		data:{'products':product,'stocklevels':stocklevel,'reorderlevels':reorderlevel,'InStocks':InStock,'vanid':<?php echo $van ?>},
		success: function(data){
			if(data == 1)
			{
				alert("Van Product Add successfully");
				location.reload();

			}
			
		}
	});
	      
});
*/
/****************************************/
$( "#autocomplete" ).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "Fetchproductcode",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,'vanid':<?php echo $van ?>},
    success: function( data ) {
     response( data );
    }
   });
  },
  select: function (event, ui) {
     // Set selection
     $('#autocomplete').val(ui.item.label); 
     $('#selectuser_id').val(ui.item.value); 
     return false;
  },
  focus: function(event, ui){
     $( "#autocomplete" ).val( ui.item.label );
     $( "#selectuser_id" ).val( ui.item.value );
     return false;
   },
 });
 
</script>