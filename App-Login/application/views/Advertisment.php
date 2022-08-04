   

<div>
	<div>
		<div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
									<h5 class="text-dark font-weight-bold my-1 mr-5">Advertisment</h5>
										<div class="card-title">
											<h3 class="card-label showerror">
                                            
											<span class="d-block text-muted pt-2 font-size-sm">
                                             </span></h3>
										</div>
										<div class="card-toolbar">
											<!--begin::Dropdown-->
											
											<!--end::Dropdown-->
											<!--begin::Button-->
											
								                
                                             
												<a href="<?php echo site_url('AddNewAdvertisment'); ?>" id="check" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md  ">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>New Advertisment</a>

												
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Search Form-->
										<!--begin::Search Form-->
										<div class="mb-7">
											<div class="row align-items-center">
												<div class="col-lg-9 col-xl-8">
													<div class="row align-items-center">
														<div class="col-md-4 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Tab Name</label>
																<select class="form-control" id="kt_datatable_search_status">
																	<option value="">All</option>
																
<?php  
                                                                
																$Manage_carouse=$this->db->query("select  tab_name from dev_Manage_carousel");
			                                                     $Manage_carouse=$Manage_carouse->result_array();

																?>	
																<?php foreach($Manage_carouse as $data2) {   ?>
																	
																	<option value="<?php echo $data2['tab_name']; ?>"><?php echo $data2['tab_name']; ?></option>
																<?php } ?>
													
																</select>
															</div>
														</div>
														
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Brand Name</label>
																
																<?php  
                                                                
																$brandbusiness=$this->db->query("select id,business_name from dev_business  where iswholeapp='3'");
			                                                     $brandbusiness=$brandbusiness->result_array();

																?>
																
																<select class="form-control" id="kt_datatable_search_type">
																<option value="">All</option>
																<?php foreach($brandbusiness as $data) {   ?>
																	
																	<option value="<?php echo $data['id']; ?>"><?php echo $data['business_name']; ?></option>
																<?php } ?>
																	
																	
																</select>
															</div>
														</div>
														
														
													</div>
												</div>
												<!--<div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
													<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
												</div>-->
											</div>
										</div>
										<!--end::Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
										
										<!--end: Datatable-->
									</div>
									
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					
					<!-- carousel  -->
					
					
					
					<div class="carousel_edit" style="margin-top:20px;">
					<div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title" style="width:100%">
										
										
										<!--	<h3 class="card-label">
											All Products</h3> -->
											<div class="row" style="width:100%">
											<form method="post" action="" style="width:100%"> 
											<table style="width:100%">

  <tbody>
 
    <tr style="color:#bbbbbb;font-size:13px;text-transform:uppercase;height:30px">
	 <?php foreach($key as $keydata)   { ?>
      <td><?php echo $keydata['tab_name'] ?></td>
     <?php  } ?>
      <td></td>	  
    </tr>
    <tr style="font-size:">
     <?php foreach($key as $keydata2)   { ?>
      <td>
	  <span class="switch switch-lg"> 
			<label>
	 <input type="checkbox"   id="<?php echo $keydata2['tab_name'].'Status' ?>"  <?php if($keydata2['carousel_status']=='1') {?> checked <?php } ?>    >
				<span></span>
			</label>
	  </span>
	  
	  <input type="number"   class="btn btn-outline-primary mt-3" id="<?php echo $keydata2['tab_name'].'Sec' ?>" style="width:75px;" min="0" value="<?php echo $keydata2['carousel_time']; ?>">
	  <span style="margin-left:10px;  position: relative;top: 12px;">Sec</span>
	  
	  </td>
	 <?php } ?>
      <!--<td>
	    <span class="switch switch-lg">
			<label>
				<input type="checkbox" id="WholesailerStatus">
				<span></span>
			</label>
	  </span>
	  <input type="number" class="btn btn-outline-primary mt-3" style="width:75px;" min="0">
	  <span style="margin-left:10px;  position: relative;top: 12px;">Sec</span>
	  </td>

	<td>
	  <span class="switch switch-lg">
			<label>
				<input type="checkbox" id="allBrandsStatus">
				<span></span>
			</label>
	  </span>
	  <input type="number" class="btn btn-outline-primary mt-3" style="width:75px;" min="0">
	  <span style="margin-left:10px;  position: relative;top: 12px;">Sec</span>
	</td>-->
	
	
	<td style="vertical-align:bottom">

	  <input type="button" class="btn btn-primary font-weight-bolder mt-3" id="updatebutton" value="Update" style="width:100%">
	  
	</td>
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
		</div>
					<!-- carousel  -->
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


 							
<script>
$('#updatebutton').click(function(){ 
	

if($('#CategoryStatus').is(':checked',true)){CategoryStatuss=1;}else{CategoryStatuss=0;}
if($('#wholesalerStatus').is(':checked',true)){WholesailerStatus=1;}else{WholesailerStatus=0;}
if($('#BrandsStatus').is(':checked',true)){allBrandsStatus=1;}else{allBrandsStatus=0;}

 var Categorysec = $('#CategorySec').val();
 var wholesalersec = $('#wholesalerSec').val();
 var Brandssec = $('#BrandsSec').val();
 
 var proceed = confirm("Are you sure you want to proceed?");
	
 if(proceed)
 {  

	    $.ajax({ 
		url:'<?= base_url('')?>updatecarousel',
		method:'POST',
		data:{'CategoryStatuss':CategoryStatuss,'WholesailerStatus':WholesailerStatus,'allBrandsStatus':allBrandsStatus,'Categorysec':Categorysec,'wholesalersec':wholesalersec,'Brandssec':Brandssec},
		success:function(data){
			
			if(data==1)
			{
				 location.reload(); 
			}
			
		}
	     });
 }
 else
 {
	alert("cancel"); 
 }	 
	
	
	
});


</script>
  

