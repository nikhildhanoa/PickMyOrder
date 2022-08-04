
<div class="container">
<div style="text-align: right;padding: 0px 25px;margin-bottom: 20px;colr: re;color: #cf1b1c;font-size: 18px;">
<?php if($as!='0'){  ?>	<span id="spid"><?php echo $this->session->flashdata('error');  ?></span> <?php } ?>
</div>
								<!--end::Notice-->
								<!--begin::Card-->
<?php if($as=='1'){  ?>

<script> 

$('#spid').html('');


</script>


<?php } ?>								
								
								
								
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pb-0" style="justify-content: flex-start;align-items:center">
										<div class="row" style="width:100%">
										
					<form action="FetchAllLukinsdata" method="post" >					
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				         <div class="input_div_category ">
			                 <select class="form-control common-class" name="Categoryexample" id="Categoryexample">
							 <option value="0">Category</option>
							 <?php  if(isset($key))  { 
									foreach ($key as $data)
									{  
									  $cat_name= $data['COM_Description'];
									  $COM_Code= $data['COM_Code'];
									  
									   $selected="";
									 if(isset($category_code)) 
										{
											 
										if($COM_Code==$category_code){$selected="selected";}	
											
										}	
									  
									 ?>
										
						<option value="<?php echo $COM_Code ?>"  <?php echo $selected; ?>      ><?php echo $cat_name ?></option>
                             <?php  }  }?>
									 
							 </select>
							<input type="hidden" value="cat1" id="cat_hidden" >
			           </div>
				   </div>
				   
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				          <div class="input_div_sub_category"> 
						  
        				<select class="form-control common-class " id="subcate" name="subcate">
						<?php if(isset($Sub_category_code)) {
							?>
						   <?php echo $Sub_category_code;  ?>
						<?php } else {  ?>
                        <option value="0">Sub Category</option>
						<?php } ?> 
					    </select>
						  </div>
				   </div>
				   
				   
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				           <div class="input_div_sub_sub_category">
        						  <div class="input_div_sub_sub_category"> 
						  
        				     <select class="form-control common-class" id="subsubcate" name="subsubcate">
							 
							 <?php if(isset($Sub_Sub_category_code)) {
							?>
						   <?php echo $Sub_Sub_category_code;  ?>
						<?php } else {  ?>
                        <option value="0"> Sub Sub Category</option>
						<?php } ?> 
							 
                            
							  
					         </select>
						  </div>
						   </div>
				   </div>
				  
				   
				   
				   
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				           <div class="manufacture " value="Manufacture">
						          <select class="form-control" id="Manufacturercod" name="Manufacturercod">
								  
								  <?php if(isset($Manufacturer_code)) {
									?>
							   <?php echo $Manufacturer_code;  ?>
							<?php } else {  ?>
							<option value="0">Manufacturer</option>
							<?php } ?> 
								  
                              
                                                            
                               </select>
                              
                             
                                                           
						   </div>
				   </div>	
                </div>
											
											</div>
											
											
											<!--end::Dropdown-->
											
										</div>
									</div>
									
									<div class="container">
									    <div class="row  mt-5">
										    <div class="col-md-3">
											<div class="input-icon">
	    <input type="submit" class="primary" value="Search" name="Search_products" style="width: 80%;
         padding: 0.5em 0.5em;border: none;color: white;background: blue;border-radius: 5px;font-size: 15px;background:#3699FF;">
																
															</div> 
				</form>		
<?php if($as=='1') { ?>			 
				<div class="input-icon mt-5" style="display:block" id="import_button"  >
	    <input type="button" class="primary" value="Import" id="import_products" style="width: 80%;
         padding: 0.5em 0.5em;border: none;color: white;background: blue;border-radius: 5px;font-size: 15px;background:#3699FF;">
																
															</div> 	
	<?php  } ?>														
					<button id="loading_button" class="btn btn-primary mt-5" style="width: 80%; display:none;">
  <span class="spinner-grow spinner-grow-sm"></span>
  Loading..
</button> 								<!-------- Import button   --->	

                                                       
															
											</div>
											<!-------- Import button   --->
											
										<!----------->	
											
											
											   <div class="col-md-6" style="display:flex;align-items:center;justify-content:center">
											    <img src="https://app.pickmyorder.co.uk/images/loder/Iphone-spinner-2%20(1).gif" alt="loader1" style="display:none; height:40px; width:40px;position: relative;top: 6px;" id="loaderImg">
											   <span id="error" style="font-size:20px;"><span>
											   <span id="msg" style="font-size:20px;"><span>
											
										
											   </div>
							
											 <div class="col-md-3 ml-auto" style="display:flex;align-items:center">
											 
											 <!-- dropdown -->
								<?php if($bid=='15')  { ?>			 
											 <div class="form-group" Style="position:relative">
                                        
                                        <?php $cat_list_name=$this->db->query("select id,productlistname from  dev_productlist");
                                              $cat_list_name=$cat_list_name->result_array();
										?>
                                        <select class="btn-success form-control  mt-2 drop_list" id="product_List" style="position:relative">
                                            <option  value="0" selected>Select  Products List</option>
                                            <?php foreach($cat_list_name as $cat_Data) { ?>
                                            <option value="<?= $cat_Data['id'];?>">
                                                <?php echo $cat_Data['productlistname']; ?>
                                            </option>

                                            <?php } ?>
											
											
                                        </select>

                                     <i class="fas fa-caret-down" style="position: absolute;top: 12px;right: 20px;font-size: 23px;color:#fff"></i>
                                    </div>
									<?php  }else { ?>
									<input type="hidden" value="0" id="product_List" >
									<?php } ?>									
									<!-- dropdown -->
											 
											 
											 
											   
											   </div>
										</div>
									</div>
									
									
								<!---------- ------->	
									
					    <div class="card-body" style="margin-top: 30px;">
										
							
										
										
										
										<div class="datatable_new_padding datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable" style="background: #fff;
    border-radius: 5px;"><section class="table_section">
	       <div class="container">
	    <div class="table-responsive table_section_div">
	         <table id="table_id" class="table">
					<thead>
					    <tr> 
					
						
					       <th scope="col" class="header_spl_table">
						   
						  <input style="margin-left:8px;height:13px;" type="checkbox" id="checkall"> 
						  
						   
						 </th>
					       <th scope="col" class="header_spl_table">
						   Product Name
						   </th>
					       <th scope="col" class="header_spl_table">Trade Cost</th>	
                          <!-- <th scope="col" class="header_spl_table">Product info.</th> -->						   
				        
					</tr> 
					</thead>
					<tbody id='content' >
					<?php  if(!empty($lukinskey)) {  foreach ($lukinskey as $key_data ) { ?>
					
					 <tr <?php if($key_data['ITM_Status']=='D') { ?>  style="background-color:#cd0b0b;"  <?php  } ?> >
						
						<?php 
						
						$chekbox = ($key_data['ITM_Status']=='D') ? '<input type="checkbox"   value='.$key_data['ITM_ItemCode'].' disabled>' : '<input type="checkbox"  class="singlecheck" value=' .$key_data['ITM_ItemCode'].'>';
						
						?>
						
						
					       <th scope="col" class="header_spl_table">
						     <!-- <input style="margin-left:8px;height:13px;" type="checkbox" class="singlecheck" value="<?php echo$key_data['ITM_ItemCode']; ; ?>">-->
							 
							 <?php echo $chekbox; ?>
						   
						 </th>
					       <th scope="col" class="header_spl_table"> <?php  echo  $key_data['ITM_ShortDesc'];  ?>  </th>
						  
						 
					       <th scope="col" class="header_spl_table"><?php  echo  $key_data['ITP_T1_Price'];  ?></th>	
                          <!-- <th scope="col" class="header_spl_table">Product info.</th>	-->					   
				        
					</tr>
					
					
					
					<?php   } }  else { ?>
					
					 </tbody>  
					
                    <!--  <tr>
					<td colspan="4" style="border-bottom:none;text-align:center;padding-top:30px"> No records found </td>
					</tr>-->
						
					<?php    } ?>
                  </table>
						
						
						
			 <div style="margin-top:60px">
            <div id="pager">
            </div>
            
        </div>		
	   </div></div></section>
	   
	 					
										
									
										<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
										
									</div>
								</div>
								
									
								</div>
								<!--end::Card-->
<?php if($as=='1'){  ?>							
		    <section class="m-5">
	        <div class="container">
			  		<!--pagination -->
					
					<div class="pagination_flex_container" style="display: flex;justify-content: space-between;align-items: center;">
							
	<div class="pagination m-0"  <?php if($total_pages_count > 7) { ?> style="width: 258px;overflow: hidden;overflow-x: hidden;overflow-x: scroll;" <?php } ?>>
  <ul class="pagination m-0" id="ul_html">

  
  <?php echo $total_pages; ?>
 
</ul>
</div>

<div  id="total_num_id"  >
<p class="mb-0">Total Number of Products is:  <b><?php echo $Total_Num; ?><span></span></b></p>
</div>
</div>
					<!--pagination -->
			  </div>
	   </section>
	<?php } ?>					
					
					
					
							</div>
							
							
						
								
							<!--end::Container-->
						</div>
						
							
							
						<!--end::Entry-->
					</div>
		
				
							
							
					<!--end::Content-->
					<!--begin::Footer-->
					</div>
					
			
					
		
		<!-- Modal 
		 <div class="modal" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel"> API CODE </h4>
       </div>
       <div class="modal-body" id="getCode" style="overflow-x: scroll;">
         
       </div>
    </div>
   </div>
 </div> -->
	
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:576px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">product info.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="content_table">
			       <div class="grid" id="getCode">
				      
                        					  
						
				   </div>
			</div>
	          	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
	 
<script> 
$("#Manufacturercod").change(function(){ 
	  $("#import_button").css("display", "none");
	   $('#content').html('');
	    $('#ul_html').html('');
		$('#total_num_id').html('');
 });

 $('#import_products').click(function() {
		   
		  var val = [];
	  $('.singlecheck:checked').each(function(i){ 
          val[i] = $(this).val();
        });
      
	  
	     var  categoryHtml  = $("#Categoryexample option:selected").html();
	     var  SubcategoryHtml  = $("#subcate option:selected").html();
		 var  SubSubcategoryHtml  = $("#subsubcate option:selected").html();
		 var  Manufacturercod  = $("#Manufacturercod option:selected").html();
		 
		 var  categoryval  = $("#Categoryexample option:selected").val();
	     var  Subcategoryval  = $("#subcate option:selected").val();
		 var  SubSubcategoryval  = $("#subsubcate option:selected").val();
		 var  Manufacturerval  = $("#Manufacturercod option:selected").val();
		 
		 var  productList  = $("#product_List").val();
		 
		 if(val.length===0)
	     {
		   alert("select products");
	     }
         else if(productList=='0')
	     {
			 alert('select product list');
			 
		 }
         else
         {
			 $.ajax({
				  url:'<?= base_url('')?>ExportProductInPMOList',  	 
				  method:'post',
				  data:{'categoryHtml':categoryHtml,'SubcategoryHtml':SubcategoryHtml,'SubSubcategoryHtml':SubSubcategoryHtml,'Manufacturercod':Manufacturercod,'categoryval':categoryval,'Subcategoryval':Subcategoryval,'SubSubcategoryval':SubSubcategoryval,'Manufacturerval':Manufacturerval,'productList':productList,'val':val},
				 beforeSend: function() {
                   $("#import_button").css("display", "none");
				   $("#loading_button").css("display", "block");
                           },
				  
				  
				  success: function(data) {
					  
					  if(data=1)
					 {
						  alert('Product Copy');
						 window.location.replace("<?php echo base_url(); ?>/GetLukinsproductsInproductList");
					 } 
        						 
					  
					  
				  }
			       });
                         
						   
				  
		 }			 
		
	  
 });

$('#checkall').change(function(){
	   if(this.checked) 
		{	     
			 $('.singlecheck').prop('checked',true); 
		}
		else
		{
			$('.singlecheck').prop('checked',false); 
		}
	  
   });

$('.singlecheck').change(function(){
	
	if($('.singlecheck:checkbox').length == $('.singlecheck:checkbox:checked').length)
	{
		 $('#checkall').prop('checked',true);
	}
	else
    {
		 $('#checkall').prop('checked',false);
	}		
});




 $("#Categoryexample").change(function(){
          var  data  = $(this).val();
		  var  Getcode = data.slice(0, 3)
		  
		 
		  $('#content').html('');
		  $('#checkall').prop('checked',false); 
		  
		  $('#subsubcate').html('');
		  $("#subsubcate").append('<option value="0">Sub sub Category</option>');
		  $('#subsubcate').val(0);
		  
		  
		    $('#Manufacturercod').html('');
		   $("#Manufacturercod").append('<option value="0">Manufacturer</option>');
           $('#Manufacturercod').val(0);	 
		  
		  
         if(Getcode!=0){
			   
            $.ajax({
				  url:'<?= base_url('')?>GetLukinsSubCategory',
				  method:'post',
				  data:{'Getcode':Getcode},
				  success:function(data)
				   {   
				       var content = "";
					   content += '<option value="0">select sub category</option>';
					  var jsondata = JSON.parse(data);
					      
					  for (var x = 0; x < jsondata.length; x++) {
						
           content += '<option value="'+jsondata[x].COM_Code+'">'+jsondata[x].COM_Description+'</option>';				  
					  }
					  $('#subcate').html(content); 
				   }  
		          }); 
				  
		        }
         }); 
		 
		 
		 
		 
		 
		  $("#subcate").change(function(){     
	       
	      var  subcatCode  = $(this).val();
		  var  subcatSlice = subcatCode.slice(0, 6)
		       
		   $('#Manufacturercod').html('');
		   $("#Manufacturercod").append('<option value="0">Manufacturer</option>');
           $('#Manufacturercod').val(0);	
			 $("#import_products").hide(); 	
			$('#content').html('');
		    $('#checkall').prop('checked',false); 	
		  
		    $.ajax({
				  url:'<?= base_url('')?>GetLukinsSubSubCategory',
				  method:'post',
				  data:{'Getcode':subcatSlice,'Getcode2':subcatCode},
				  success:function(data)
				   { 
				   
				     var TotalContent="";
				     TotalContent += '<option value="0">select Sub sub category</option>';
				     var subsubcat = JSON.parse(data);
					
					 for (var i=0; i < subsubcat.length; i++)
					 {
						 
					TotalContent +='<option value="'+subsubcat[i].COM_Code+'">'+subsubcat[i].COM_Description+'</option>';	 
					 }
				          $('#subsubcate').html(TotalContent);
				   }
			});				   
	  
	  });
	  
	  
	  $(".common-class").change(function(){
		  
		  
		  let Value  = $(this).val(); 
		  var idName = $(this).attr("id");
		  
		  $("#import_button").css("display", "none");
		  $('#total_num_id').html('');
		  $('#ul_html').html('');
		  $('#content').html('');
		  $('#Manufacturercod').html('');
		  $("#Manufacturercod").append('<option   value="0">Loading...</option>');
		   $("#Manufacturercod").addClass("loading");
		   
		    $.ajax({
				  url:'<?= base_url('')?>GetLukinsManufactureInProductList',
				  method:'post',
				  data:{'Value':Value,'idName':idName},
				  success:function(data)
				   {   
				   
		               $("#Manufacturercod").removeClass("loading");		   
				       var ManufactureContent="";
					    ManufactureContent += '<option value="0">select Manufacture</option>';
					   var ManufactureData = JSON.parse(data);
					   
					   for (var z = 0; z < ManufactureData.length; z++)
					   { 
		          
						   ManufactureContent +='<option value="'+ManufactureData[z].MAN_Code+'">'+ManufactureData[z].MAN_SupplierName+'</option>';
					   }
					       $('#Manufacturercod').html(ManufactureContent);
				   }
		 	
		});
		   
		   
		   
		  
	  });
	  
 
 
</script>

