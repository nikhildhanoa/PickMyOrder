
<div class="container">
								<!--end::Notice-->
								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pb-0" style="justify-content: flex-start;align-items:center">
										<div class="row" style="width:100%">
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				         <div class="input_div_category ">
			                 <select class="form-control" id="Categoryexample">
							 <option value="0">Category</option>
							 <?php  if(isset($key))  { 
									foreach ($key as $data)
									{  
									  $cat_name= $data['COM_Description'];
									  $COM_Code= $data['COM_Code'];
									 ?>
										
						<option value="<?php echo $COM_Code ?>"><?php echo $cat_name ?></option>
                             <?php  }  }?>
									 
							 </select>
							<input type="hidden" value="cat1" id="cat_hidden" >
			           </div>
				   </div>
				   
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				          <div class="input_div_sub_category"> 
						  
        				<select class="form-control " id="subcate">
                        <option value="0">Sub Category</option>
							  
					    </select>
						  </div>
				   </div>
				   
				   
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				           <div class="input_div_sub_sub_category">
        						  <div class="input_div_sub_sub_category"> 
						  
        				     <select class="form-control " id="subsubcate">
                              <option value="0">Sub Sub Category </option>
							  
					         </select>
						  </div>
						   </div>
				   </div>
				  
				   
				   
				   
			       <div class="col-md-3 col-lg-3 col-sm-12 p-3">
				           <div class="manufacture" value="Manufacture">
						          <select class="form-control" id="Manufacturercod">
                              <option value="0">Manufacturer</option>
                                                            
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
	    <input type="button" class="primary" value="Search" id="Search_products" style="width: 80%;
         padding: 0.5em 0.5em;border: none;color: white;background: blue;border-radius: 5px;font-size: 15px;background:#3699FF;">
																
															</div> 
															
															
													<!-------- Import button   --->		
															<div class="mt-5">
															 <input type="button" class="primary"  value="import" id="import_products" style="display:none; width: 80%;
         padding: 0.5em 0.5em;border: none;color: white;background: blue;border-radius: 5px;font-size: 15px;background:#3699FF;">
															</div>
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
						   <span style="width: 20px;"><label class="checkbox checkbox-single checkbox-all kt_datatable_checkbox_value">  <input type="checkbox" id="checkall">&nbsp;<span></span></label></span>
						   
						 </th>
					       <th scope="col" class="header_spl_table">
						   Product Name
						   </th>
					       <th scope="col" class="header_spl_table">Trade Cost</th>	
                           <th scope="col" class="header_spl_table">Product info.</th>						   
				        
					</tr>
					</thead>
					<tbody id='content' >
						

                    <tr>
					<td colspan="4" style="border-bottom:none;text-align:center;padding-top:30px"> No records found </td>
					</tr>
						
					</tbody>
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

            
	$(document).ready(function() {		
	// This is for sub category	
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

      ///////// this for sub sub category /////////////////////// 
	  
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
        
  		//// this is for manufacture ////

        $("#subsubcate").change(function(){ 
	        
	      var  subsubcatCode  = $(this).val();
		  
		    $('#Manufacturercod').html('');
		   $("#Manufacturercod").append('<option   value="0">Loading...</option>');
		   $("#Manufacturercod").addClass("loading");
           $('#Manufacturercod').val(0);
		    $("#import_products").hide(); 	
		   $('#content').html('');
		   $('#checkall').prop('checked',false); 
		   
		   $.ajax({
				  url:'<?= base_url('')?>GetLukinsManufacture',
				  method:'post',
				  data:{'Getcode':subsubcatCode},
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
		
		///// products search from lukins
		
		    $("#Search_products").click(function(){ 
		    $('#pro_id').html('');
			
		    var  category  = $("#Categoryexample").val();
			var  Subcategory  = $("#subcate").val();
			var  SubSubcategory  = $("#subsubcate").val();
			var  Manufacture  = $("#Manufacturercod").val();

			if(category==0)
			{    
		         
				$("#error").html("** select category");
				$("#error").css('color', '#cc0000');	
			}
			 else if(Subcategory==0)
			{
				$("#error").html("** select Sub category");
				$("#error").css('color', '#cc0000');
			}
			 else if(SubSubcategory==0)
			 {
				 $("#error").html("** select Sub Sub category");
				 $("#error").css('color', '#cc0000');
			 }
             else
			 { 
				  $("#error").empty(); 
				   
				     $("#loaderImg").hide();
					   	
				$.ajax({
				  url:'<?= base_url('')?>SqlLukinsProducts',
				  method:'post',
				  data:{'SubSubcategory':SubSubcategory,'Manufacture':Manufacture},
				  beforeSend: function() {
                   $("#loaderImg").show();
                           },
						   
				  success:function(data)
				   {    
				       
                     $("#loaderImg").hide();
                     var records = JSON.parse(data);
					 
					 if(records.length === 0)
					 {
						$("#error").html("No Product Found ");
				        $("#error").css('color', '#cc0000');
                          
					 }
					 else
					{
						$("#import_products").show(); 				 
                        var productsdata="";
					  
					   for (var z = 0; z < records.length; z++)
					   { 
		                         
							beverage = (records[z].ITM_Status=='D') ? "style='color:red'" : "style='color:black'";
							prostatus = (records[z].ITM_Status=='D') ? "DISC" : records[z].ITP_T1_Price;
							chekbox = (records[z].ITM_Status=='D') ? '<input type="checkbox" id="exampleCheck1"  value='+records[z].ITM_ItemCode+' disabled>' : '<input type="checkbox" id="exampleCheck1" class="singlecheck" value='+records[z].ITM_ItemCode+'>';
							
							
							
								 
						   productsdata +='<tr> <td> <span style="width: 20px;"><label class="checkbox ">'+chekbox+' &nbsp;<span></span></label></span></td> <td '+beverage+'>'+records[z].ITM_ShortDesc+'</td> <td '+beverage+'>'+prostatus+'</td> <td><span id='+records[z].ITM_ItemCode+' class="btn btn-warning proinfo">info </span></td></tr>';
					   }
					       $('#content').html(productsdata);
				   }
				
				
				             $('.proinfo').click(function() {
		                
						        var ID = $(this).attr('id');
                                  
                                     $.ajax({
										  url:"<?= base_url('')?>GetProductInfo",
										  method:'post',
										  data:{'ID':ID},
										  success:function(data)
			                               {
											   var productdat='';
											 var productsinfo = JSON.parse(data);  
										
											   for(var n=0; n < productsinfo.length; n++)
											   {
												 
												 productdat +='<div class="text-bold">Description:</div> <div style=" grid-column: 2 / -1;">'+productsinfo[n].ITM_ShortDesc+'</div> <div class="text-bold">Manufacturer:</div> <div>'+productsinfo[n].MAN_NameKey+'</div> <div class="text-bold">Cut Number:</div> <div>Null</div> <div class="text-bold">Brand Name:</div> <div>'+productsinfo[n].BNI_BrandName+'</div> <div class="text-bold">Finish:</div> <div>Null</div> <div class="text-bold">Dimentions:</div> <div>'+productsinfo[n].ITM_Dimensions+'</div> <div class="text-bold">Install time:</div> <div>'+productsinfo[n].TSI_InstallTime+'</div>'; 
											   }
											      
											     
                                                  $("#getCode").html(productdat);
															   
										   },
										 
									       });
	                         });

				          						 
				    }
				        });			
				 	 
							
				  
				  				   
			 }				 
			
		 
		    }); 
			

			
       ////   sql products copy in pmo
	   
	   
	   $('#import_products').click(function() {
		   
		  var val = [];
	  $('#exampleCheck1:checked').each(function(i){ 
          val[i] = $(this).val();
        });
		 
		 var  categoryHtml  = $("#Categoryexample option:selected").html();
	     var  SubcategoryHtml  = $("#subcate option:selected").html();
		 var  SubSubcategoryHtml  = $("#subsubcate option:selected").html();
		 var  Manufacturercod  = $("#Manufacturercod option:selected").html();
		 var  productList  = $("#product_List").val();
			
	
	   if(val.length===0)
	   {
		   
		   // $("#error").show();
		   $('#error').html('** Select Products');
		  $("#error").css('color', '#cc0000');
	   } 
	   else
	   {
		  $('#error').empty(); 
		   
		 $.ajax({
		    url:'<?= base_url('')?>ExportProductInPMO',
			method:'post',
			data:{'val':val,'categoryHtml':categoryHtml,'SubcategoryHtml':SubcategoryHtml,'SubSubcategoryHtml':SubSubcategoryHtml,'Manufacturercod':Manufacturercod,'productList':productList},
			dataType: "json",
			 beforeSend: function() {
                   $("#loaderImg").show();
                           },
			success:function(data)
			{
				
				$("#loaderImg").hide();
				if(data == 1)
				{
					
			    $('.singlecheck').prop('checked',false);
				$('#checkall').prop('checked',false);	
				$('#content').html('');
				$('#product_List').val(0);
				 $("#error").html("** products copy");
			     $("#error").css('color', '#cc0000');	
					 
					 
				}
				
				
				
				
				
			},
		
		
		      }); 
			
	   }	
	   });
	   });
       /// infoget
	   
	   
	   
	















	 
</script>					