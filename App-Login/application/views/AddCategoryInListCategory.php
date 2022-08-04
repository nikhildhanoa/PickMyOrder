<?php $cat_list_id=$_GET['listid'];
      


	$buss_CategoryList_id= $this->db->query("select id from dev_business where CategoryList=10");
	$buss_CategoryList_id= $buss_CategoryList_id->result_array();
    

 ?>
<div class="container">
								<!--end::Notice-->
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0" style="justify-content: flex-start;">
										<div class="card-title">
																					
										<div class="card-toolbar">
											<!--begin::Dropdown-->
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
												</span>Choose Category</button>
			          									<input type="hidden" value="<?php echo $cat_list_id ?>" id="cat_is_list">
												<span class="btn btn-light-primary font-weight-bolder" id="add_cat_in_list" style="margin-left:15px;">Add</span>
											
												<!--begin::Dropdown Menu-->
												<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="width: 228px!important;">
													<!--begin::Navigation-->
													<ul class="navi flex-column navi-hover py-2">
													<li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
													<?php
													     
														 $cat_id=$this->db->query("select Category_ids from  dev_categorylist where id='$cat_list_id' ");
														$cat_id=$cat_id->result_array();
														$Category_ids=$cat_id[0]['Category_ids'];
														
														 
															if($Category_ids!='')
															{
																$pmo_cat=$this->db->query("select id,cat_name from dev_product_cat where business_id='15' and id not in($Category_ids)");
															}
															else 
															$pmo_cat=$this->db->query("select id,cat_name from dev_product_cat where business_id='15'");
														
															$pmo_cat=$pmo_cat->result_array();
															 
															 
                                                                foreach($pmo_cat as $pmo_cat_data)
																{    
																	
                                                                    
                                                                 ?>
														
														<li class="navi-item" style="margin: 0 20px;display:flex;justify-content:spacebetween"> 
															
																<span class="navi-text" style="margin-right:23px;flex:6"><?php echo $pmo_cat_data['cat_name'];  ?></span>
																<span class="navi-icon" style="flex:1">
																	  <input   type="checkbox" id="exampleCheck1" value="<?php echo $pmo_cat_data['id'];?>" aria-label="Checkbox for following text input">
																</span>
															
														</li>
															<?php } ?>											
													</ul>
													<!--end::Navigation-->
												</div>
												<!--end::Dropdown Menu-->
											</div>
										</div>	
											<!-- second button-->
									    <?php 
                            $cat_list=$this->db->query("select id,catalog_list_name from dev_categorylist where id!=$cat_list_id");
														$cat_list=$cat_list->result_array();
														

										?>		
									    <div class="card_toolbarr2" style="position: relative;left: 306px;">
											<div class="dropdown_buttons_and_choose_category" style="display: flex;">
												<select class="form-control" id="cat_list_id_choose" style="width: 120px;background-color: #e1f0ff;">
												  <option value="0">---Select---</option>
												  <?php foreach($cat_list as $cat_list_data) { ?>
												  <option value="<?php echo $cat_list_data['id'];?>"><?php echo $cat_list_data['catalog_list_name'];   ?></option>
												  <?php  } ?>
												</select>
												<span class="btn btn-light-primary font-weight-bolder" id="copy_cat" style="margin-left:15px;">Copy</span>

											<?php if( $cat_list_id=="13") {?><span class="btn btn-light-primary font-weight-bolder" id="Apply_business" style="margin-left:15px;">Apply business</span> <?php }	?>
											
											<div id="loading" style="display:none;margin-left:4em;
											margin-top:0.2em" class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                             </div>
												<!--begin::Dropdown Menu-->
										
												<!--end::Dropdown Menu-->
											</div>
											</div>
											
											</div>
											
											
											<!--end::Dropdown-->
											
										</div>
									</div>
									
									
									
									
									
											<div class="card-body" style="background: white;margin-top: 30px;">
										<!--begin: Search Form-->
										<!--begin::Search Form-->
										
										
										
										
										
										
										
										
										<div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable" style=""><table class="datatable-table" style="display: block;">
										<thead class="datatable-head"><tr class="datatable-row" style="left: 0px;">										   
											
											<th class="datatable-cell datatable-cell-sort" style="width:16%;"><span >Image</span></th>
											
											<th class="datatable-cell datatable-cell-sort datatable-cell-sorted" data-sort="desc" style="width:16%;"><span >category</span></th>
											
											<th class="datatable-cell datatable-cell-sort" style="width:16%;text-align:center"><span>Actions</span></th>

											<?php if($cat_list_id==13){?>   <th class="datatable-cell datatable-cell-sort" style="width:16%;text-align:center"><span>View</span></th>
												

												<th class="datatable-cell datatable-cell-sort" style="width:16%;"><span>
											          Status
											</span></th>
                                             
											<?php }?>

											<th class="datatable-cell datatable-cell-sort" style="width:16%;text-align:center"><span>
											          Checkbox
											</span></th>
											
											</tr>
									</thead>
											
											<tbody class="datatable-body">
										
											
											<?php  foreach($key as $key_data)  {  
												
												$pmo_cat_status=$this->db->query("select status from dev_categorylist_status where cat_ids=".$key_data['id']);
																	
																	$pmo_cat_status=$pmo_cat_status->result_array();
																	$status=$pmo_cat_status[0]['status'];
																
												?>
											<tr class="datatable-row">
											
											
											<td style="width:16%">
					                            <span><img src="<?php echo $key_data['image'];  ?>"width="50px" height="50px;"></span>
											</td>
											<td style="width:16%;padding: 0.75rem 0;">
											<span ><?php echo $key_data['cat_name'];  ?></span>
											 
											</td>
											<td style="width:16%;padding: 0.75rem 0;text-align:center">
											   
											 <span class="svg-icon svg-icon-md"><a href="<?php echo base_url('DeleteCategoryForCategorylist?id=').$key_data['id'].'&listid='.$cat_list_id  ?>">  
														   																											 
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">                                        <rect x="0" y="0" width="24" height="24"></rect>                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>                                    </g>                                </svg></a>                            </span>

														
											</td>
										  
											<?php if($cat_list_id==13){?>  <td style="width:16%;padding: 0.75rem 0rem; text-align:center">
											   <a href="<?php  echo site_url("CatDetails?id=").$key_data['id'].'&cat_name='.$key_data['cat_name'] ?>"  class="btn btn-sm btn-clean btn-icon" title="view">                            <span class="svg-icon svg-icon-md">                                <i class="fa fa-eye" aria-hidden="true"></i>                            </span>                        </a> 								
     										</td>
											 

                                             <td class="publishtd" id="<?php echo $key_data['id'] ?>" style="width:16%;padding: 0.75rem 0rem;">
											
											<span style="cursor: context-menu;" id="<?php echo "myid".$key_data['id'] ?>"  <?php if($status==1) {?> class="publish"
												<?php } else { ?> class="unpublish"  <?php }  ?>  >
												
												<?php if($status==1) {?>Publish<?php } else { ?>UnPublish<?php }  ?>
												
												
												</span></label>
											</td>
											<?php } ?>	

											<td style="width:16%;padding: 0.75rem 0rem;text-align:center">
											<input type="checkbox" id="cat_checkbox" value="<?php echo $key_data['id'];  ?>">&nbsp;<span></span></label>
											</td>
											 
											  
												   </tr>										
											<?php } ?>
										</table>
										
										
										<!--end::Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
										<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
										<!--end: Datatable-->
									</div>
								</div>
									
									
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					</div>
					
					 
<script>  

$(".publishtd").click(function(){

	var ID = $(this).attr("id");
	 
     
     if(ID)
	 {
		$.ajax({
			  url:'<?= base_url('')?>ChangeStatusCategory',
			  method:'post',
			  data:{'ID':ID},
			  success:function(data)
			  {   
				 if(data==1)
				 {
					
					$('#myid'+ID).removeClass('unpublish'); 
                   $('#myid'+ID).addClass('publish'); 
				   $('#myid'+ID).html('publish'); 
				 } 
				 else
				 {
					
				$('#myid'+ID).removeClass('publish'); 
                 $('#myid'+ID).addClass('unpublish');  
				$('#myid'+ID).html('UnPublish');
															
				 }
			  }
		 });
	 }

	
	 



     

 
 
});


$(document).ready(function(){
  $("#add_cat_in_list").click(function(){
   
   var catListId=$('#cat_is_list').val()
   
    var val = [];
	  $('#exampleCheck1:checked').each(function(i){
          val[i] = $(this).val();
        });
  
      if(val.length == 0)
	  {
		 alert('choose category'); 
	  }
      else
      {		  
   $.ajax({
			  url:'<?= base_url('')?>AddCategoryInCategoryList',
			  method:'post',
			  data:{'val':val,'catListId':catListId},
			  success:function(data)
			  {   
				 if(data==1)
				 {
					 alert("Category Add");
					 location.reload();
				 } 
			  }
		 });
	  }
   
  });
});    
/*******************************/
 $('#copy_cat').click(function(){
	 
var catlist=$('#cat_list_id_choose').val(); 
	
 var val = [];
	  $('#cat_checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });	
		
	
	if(catlist=="0")
	{
		alert(" select category list");
		return false;
	}

    if(val.length === 0)
    {
		alert(" select the category");
	}else
		
    {
		 $.ajax({
			  url:'<?= base_url('')?>CopyCategoryInAnotherList',
			  method:'post',
			  data:{'val':val,'catListId':catlist},
			  success:function(data)
			  {   
			      alert(data);
				  location.reload();
			  }
		 });
	}		
	
 });
////////////////////////////

$('#Apply_business').click(function(){
  
	var carlistid = 13;
    var ids_buss = <?php   echo    json_encode($buss_CategoryList_id);   ?>;
   


	 $.ajax({
			  url:'<?= base_url('')?>CatCopyfromList',
			  method:'post',
			  data:{'CategoryList':carlistid,'newbid':ids_buss},
			  beforeSend:function()
			  {
				 $("#loading").show();
				 $('#Apply_business').hide();
			  },
			  success:function(data)
			  {   
				    $("#loading").hide();
				    $('#Apply_business').show();
			        alert(data);
				   
			  },
		 });




});



</script>					