<div><div><div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">
											Lukins Failure Products</h3> 
										</div>
										<div class="card-toolbar">
										
											<!--begin::Dropdown-->
											
											<!--<button style="margin-right: 9px;border-radius: 0.42rem;border:none;" class="li-file btn btn-warning"><form id="sendupdatecsv" enctype="multipart/form-data" method="post" action="UpdateProductsWithCsvFile"><label style="padding: 2px; cursor: default;margin-bottom:0px;">update<input type="file" accept=".csv" id="updatecsvjax" size="60" name="thisiscsv" style="display:none"></label></form></button>-->
											
											
											
												
												<button class="btn btn-sm btn-success mr-2" type="button" id="kt_datatable_pulish_all" style="font-weight: 600 !important;padding: 0.65rem 1rem;font-size: 1rem;line-height: 1.5;">Publish All</button>
												<button class="btn btn-sm btn-primary mr-2" type="button" id="kt_datatable_UnPublish_all" style="font-weight: 600 !important;padding: 0.65rem 1rem;font-size: 1rem;line-height: 1.5;">UnPublish All</button>
												<button class="btn btn-sm btn-danger mr-2" type="button" id="kt_datatable_delete_all" style="color: #ffffff;background-color: #F64E60;border-color: #F64E60;font-weight: 600 !important;padding: 0.65rem 1rem;font-size: 1rem;line-height: 1.5;">Delete All</button>
												<button class="btn btn-sm mr-2" type="button" id="kt_datatable_delete_all" style="color: #ffffff;font-weight: 600 !important;padding: 0.50rem 2.7rem;font-size: 1rem;line-height: 1.5;display:none"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i></button>
												<li class="li-file secli" style="margin-left:10px;display:none"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i></li>
											
											<!--end::Dropdown-->
											<!--begin::Button-->
											
											
											<!------------------>
											<!--<div  class="btn btn-primary font-weight-bolder" style="margin:4px">
											<span class="svg-icon svg-icon-md">
												
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												end::Svg Icon
											</span>Uploads</div>-->
											
											<!--------------------->
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
																<label class="mr-3 mb-0 d-none d-md-block">Manufacture</label>
																<select class="form-control" id="kt_datatable_search_status">
																	<option value="">All</option>
																	<?php 
  
																	  if(isset($_SESSION['Current_Business'])){ 
																	  $bu_id=$_SESSION['Current_Business'];
																	  }
																	  else
																	  {
																		  $bu_id=$_SESSION['status']['business_id'];
																	  }
																	 
																	  
																	  
																	  
																	  $AllCat=$this->db->query("select * from dev_product_cat,dev_products where dev_products.business_id='$bu_id' and dev_product_cat.id=categories group by categories");
		                                                               $AllCat=$AllCat->result_array();
		
		
																	  
																	  
																	 // $AllCat=$this->ProductCategoryModal->GetAllCat($bu_id);
																	  //$manufatureobj=$this->db->query("select Manufacture from dev_products where business_id='$bu_id'");
																	  
																	  $manufatureobj=$this->db->query("SELECT Manufacture FROM dev_products  where business_id='$bu_id'  GROUP BY Manufacture");
																	  
																	  
																	  $manufaturearray=$manufatureobj->result_array();?>
																	
													 
																	
																	
																	
																	  <?php
																	  foreach($manufaturearray as $ma){     if($ma['Manufacture']!=''){
																	?>
																	
																		<option value="<?php echo $ma['Manufacture'];?>"><?php echo $ma['Manufacture'];?></option>
																	           
																	  <? } } ?>
																</select>
															</div>
														</div>
														<div class="col-md-4 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Category</label>
																<select class="form-control" id="kt_datatable_search_type">
																	<option value="">All</option>
																	<?php foreach( $AllCat as $singe)
																	{ ?>
																		<option value="<?php echo $singe['cat_name'];?>"><?php echo $singe['cat_name'];?></option>
																	<?php } ?>
																	
																</select>
															</div>
														</div>
													</div>
												</div>
												<!--<div class="col-lg-3" style="display: flex;justify-content: flex-end;">
												<span class="btn" id="delete_pro" style="    color: #FFFFFF;background-color: #3699FF;border-color: #3699FF;">button</span>
												</div>-->
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
  $('#updatecsvjax').change(function(){
			 $('#sendupdatecsv').submit();  
			  
		   });
</script>