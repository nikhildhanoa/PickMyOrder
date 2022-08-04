<?php  
$id=$this->uri->segment(3);
$null=$this->uri->segment(2);
if($null!='null')
{
	  $null = explode("-",$null);
	  $cat_id=$null[0];
	  $subcat_id=$null[1];
	  $subsubcat_id=$null[2];
	  $man=$null[3];
	
	$man = urldecode($man); 
}	
?>
<div><div><div class="container">
						
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">
										List Products</h3> 
										</div>
										<div class="card-toolbar">
										
											<button class="btn btn-sm btn-light-dark mr-2" type="button" id="Import_To_List" style="font-weight: 600 !important;padding: 0.65rem 1rem;font-size: 1rem;line-height: 1.5;">Import To List</button>
											

											
											
											
											<div class="dropdown dropdown-inline mr-2">
												<button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="svg-icon svg-icon-md">
													
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
															<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
														</g>
													</svg>
												
												</span>Export</button>
											
												<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
													
													<ul class="navi flex-column navi-hover py-2">
														<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
														<li class="navi-item" >
															<a href="<?php echo base_url('Printproductstable'); ?>" class="navi-link printthis">    
																<span class="navi-icon">
																	<i class="la la-print"></i>
																</span>
																<span class="navi-text ">Print</span>
															</a>
														</li>
														<li class="navi-item csvprint">
															<a href="<?php echo base_url('MakeCsvFileForProducts');?>" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-text-o"></i>
																</span>
																<span class="navi-text">CSV</span>
															</a>
														</li>
														<li class="navi-item csvprint">
															<a href="<?php echo base_url('MakeCsvFileForShopify');?>" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-text-o"></i>
																</span>
																<span class="navi-text">shopify CSV</span>
															</a>
														</li>
														<li class="navi-item">
															<a href="<?php echo base_url('PrintPdfTableForProducts');?>" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-pdf-o"></i>
																</span>
																<span class="navi-text">PDF</span>
															</a>
														</li>
													</ul>
												
												</div>
											
											</div>
										
											<a href="<?php echo site_url('AddProductsInList?id='.$id); ?>" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
											
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
											
											</span>New Product</a>
									
										</div>
									</div>
									<div class="card-body">
										
										<div class="mb-7">
											<div class="row align-items-center">
												<div class="col-lg-12 col-xl-12">
													<div class="row align-items-center" style="gap:20px;">
														<div class="col-md-2 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>
														<?php 
  
																	  if(isset($_SESSION['Current_Business']))
																	  { 
																	  $bu_id=$_SESSION['Current_Business'];
																	  }
																	  else
																	  {
																		  $bu_id=$_SESSION['status']['business_id'];
																	  }
																	 
																	  
																	 ?>
														
														
														
														
														<div class="col-md-3 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Category</label>
																<select class="form-control common-class" id="kt_datatable_search_type">
																	<option value="0">All</option>
																	<?php

$AllCat=$this->db->query("select dev_product_cat.id,dev_product_cat.cat_name from dev_product_cat,dev_products where dev_products.business_id='$bu_id' and dev_product_cat.id=categories and dev_products.list_id like '%".'"'.$id.'"'."%' group by categories");
		                                                               $AllCat=$AllCat->result_array();


																	foreach( $AllCat as $singe)
																	
																	       $selected='';  
																		 if($singe['id']==$cat_id){$selected="selected";}
																	
																	{
																	?>
									<option value="<?php echo $singe['id'];?>" <?php echo $selected; ?> ><?php echo $singe['cat_name']; ?></option>
																	<?php } ?>
																	
																</select>
															</div>
														</div>
														
														<!--------Sub cat start----------->
													<?php  
                                                    if($null!='null') { $SUB =" and categories=".$cat_id." "; } else {$SUB='';}


													$AllsubCat=$this->db->query("select dev_product_sub_cat.id,dev_product_sub_cat.sub_cat_name from dev_product_sub_cat,dev_products where dev_products.business_id='$bu_id' and dev_product_sub_cat.id=sub_categories and dev_products.list_id like '%".'"'.$id.'"'."%'".$SUB."group by sub_categories ");
		                                                         $AllsubCat=$AllsubCat->result_array();
															 /* print_r($this->db->last_query());die; */
																 
																	   ?>
														
														<div class="col-md-3 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Sub Category</label>
																<select class="form-control common-class" id="kt_datatable_search_type_Sub_Category" <?php if($null=='null') { ?> disabled="true"  <?php } ?>>
																	<option value="0">All</option>
																	<?php foreach( $AllsubCat as $singes)
																	{
																	
																	
																	?>
									<option value="<?php echo $singes['id'];?>"<?php if($singes['id']==$subcat_id)echo "selected";?>
																		 
													 	  ><?php echo $singes['sub_cat_name']; ?></option>
																	<?php } ?>
																		
																	
																	
																</select>
															</div>
														</div>
														<!--------sub cat end ----------->
														
														<!-------- sub Sub cat start----------->
														<?php  

                                                      if($null!='null') { $subSUB ="and sub_categories=".$subcat_id.""; } else {$subSUB='';}

$AllsubsubCat=$this->db->query("select super_sub_cat.id,super_sub_cat.name from super_sub_cat,dev_products where dev_products.business_id='$bu_id' and super_sub_cat.id=super_sub_cat_id and dev_products.list_id like '%".'"'.$id.'"'."%' ".$subSUB." group by super_sub_cat_id; ");
		                                                         $AllsubsubCat=$AllsubsubCat->result_array();
																 
														 /* print_r($this->db->last_query());die; */		 
																	   ?>
														
														
														
														<div class="col-md-3 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Sub Sub Category</label>
																<select class="form-control common-class" id="kt_datatable_search_type_Sub_Sub_Category"
																<?php if($null=='null') { ?> disabled="true"  <?php } ?>>
																	<option value="0">All</option>
																	<?php foreach( $AllsubsubCat as $singess)
																	
																	    
																	
																	{
																	?>
									<option value="<?php echo $singess['id'];?>" <?php if($singess['id']==$subsubcat_id)echo "selected";?> ><?php echo $singess['name']; ?></option>
																	<?php } ?>
																		
																	
																	
																</select>
															</div>
														</div>
														<!-------- sub sub cat end ----------->
														<div class="col-md-3 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Manufacture</label>
																<select class="form-control" id="kt_datatable_search_status">
																	<option value="">All</option>
																	
																	
																	  <?php
																	   $manufatureobj=$this->db->query("SELECT Manufacture FROM dev_products  where business_id='$bu_id' and dev_products.list_id like '%".'"'.$id.'"'."%' GROUP BY Manufacture");
																	  $manufaturearray=$manufatureobj->result_array();
																	  
																	  foreach($manufaturearray as $ma)
								 
	  							                    {   

																	    
																		  if($ma['Manufacture']!=='')
																		  {
																			$selectedu='';  
																		 if($ma['Manufacture']==$man){$selectedu="selected";}	  
																	?>
																	
									<option value="<?php echo $ma['Manufacture']; ?>" <?php echo $selectedu; ?>><?php echo $ma['Manufacture']; ?></option>
																	           
																	  <?php } } ?>
																</select>
															</div>
														</div>
														
														
														<div class="col-md-3 my-2 my-md-0">
															<div class="d-flex align-items-center">
																<label class="mr-3 mb-0 d-none d-md-block">Product List</label>
																<select class="form-control" id="kt_datatable_Category_List">
																	<option value="0">Select Product List</option>
																	<?php

                                                                     $cat_list_name=$this->db->query("select * from dev_productlist where masterlist='0' order by `productlistname` ASC");
                                                                  $cat_list_name=$cat_list_name->result_array();

																	foreach( $cat_list_name as $singes)
																	{ 
																	?>
																		<option value="<?php echo $singes['id']; ?>"><?php echo $singes['productlistname']; ?></option>
																	<?php } ?>
																	
																</select>
															</div>
														</div>
														<div class="col-md-5" style="padding: 0;max-width: 45% !important;flex: 0 0 45% !important;">
														<div style="display:flex;justify-content:flex-end;">
															<button class="btn btn-sm btn-light-dark mr-2" type="button" id="submit" style="font-weight: 600 !important;padding: 0.75rem 2rem;font-size: 1rem;line-height: 1.5;background-color: #3699FF;color: #fff;margin-top: 3rem;">submit</button>
														</div>
														</div>
														
													</div>
												</div>
												
											</div>
										</div>
										
									</div>
									
								</div>
							
							</div>
							
						</div>
					
					</div>
					
					
				
					
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


</script>