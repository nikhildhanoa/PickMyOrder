<?php  error_reporting(0); 
   if(isset($_GET['id']))
   {
   	    if(isset($_SESSION['tab']))
   		{
   			$open_tab=$_SESSION['tab'];
   		
   			
   		}
   		else
   		{
   			$open_tab='';
   			
   			
   		}
   	    $Product_Edit_Id=$_GET['id']; 
   		$Single_Product=$this->db->query("select * from dev_products where id=' $Product_Edit_Id'");
   		if($Single_Product)
   		{
   			$Single_Product=$Single_Product->result_array();
   			if(isset($Single_Product[0])){
   			$Single_Product=$Single_Product[0];
   			}
   		}
   		else
   		{
   			redirect('products');
   		}
   }
   else
   {
   	redirect('products');
   }
   ?>
<div class="container">
<ul class="nav nav-tabs">
   <!-- <li class="active"><a data-toggle="tab" href="#home">Manage Products</a></li>-->
   <li ><a data-toggle="tab" href="#menu1">Edit Products</a></li>
</ul>
<div class="tab-content">
<div id="menu1" class="tab-pane active">
   <div class="container">
      <ul class="nav nav-tabs">
         <li class="<?php if($open_tab==''){ ?>active<?php } ?>"><a data-toggle="tab" href="#pd">Product Details</a></li>
         <li class="<?php if($open_tab=='image'){ ?>active<?php } ?>"><a data-toggle="tab" href="#ai">Add Images</a></li>
         <li class="<?php if($open_tab=='supplier'){ ?>active<?php } ?>"><a data-toggle="tab" href="#sc">Suppliers Cost</a></li>
         <li class="<?php if($open_tab=='spc'){ ?>active<?php } ?>"><a data-toggle="tab" href="#sp">Specification</a></li>
         <li class="<?php if($open_tab=='optiontab'){ ?>active<?php } ?>"><a data-toggle="tab" href="#ao">Add Option</a></li>
         <li class="<?php if($open_tab=='pdf'){ ?>active<?php } ?>"><a data-toggle="tab" href="#pm">PDF Manual</a></li>
         <li ><a class="btn btn-info" href="<?php echo site_url('products');?>">Go To Manage Product</a></li>
      </ul>
      <div class="tab-content">
         <div id="pd" class="tab-pane <?php if($open_tab==''){ ?>active<?php } ?>">
            <div id="form">
               <div class="container">
                  <?php 
                     if($this->session->flashdata('succpd')){
                     ?>
                  <div class="alert alert-success"> 
                     <?php  echo $this->session->flashdata('succpd'); ?>
                  </div>
                  <?php  
                     }  
                     if($this->session->flashdata('failpd')){
                     ?>
                  <div class = "alert alert-success">
                     <?php echo $this->session->flashdata('failpd'); ?>
                  </div>
                  <?php } ?>
                  <div class="row"> <form id="product_form">
                     <div class="col-md-6 col-xs-12 back ">
                        <h2>Product  Details</h2>   
                           <div class="marg product-form">
                              <div class="form-horizontal">
                                 <div class="form-group ">
                                    <label class="control-label col-sm-4" for="name">Manufactured By</label>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control"  value="<?php echo $Single_Product['Manufacture']; ?>" name="Manufacture">
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="control-label col-sm-4" for="name">Product Code</label>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control"  value="<?php echo $Single_Product['product_name']; ?>" name="name">
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="control-label col-sm-4" for="name">Title</label>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" value="<?php echo $Single_Product['title']; ?>" placeholder="" name="title">
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="control-label col-sm-4" for="name">SKU</label>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control"  value="<?php echo $Single_Product['SKU']; ?>" placeholder="" name="SKU">
                                    </div>
                                 </div>
                                 <!----------------SKU------------------------->   
                                 <div class="form-group ">
                                    <label class="control-label col-sm-4" for="name">Description</label>
                                    <div class="col-md-8">
                                       <textarea type="text" class="form-control"  value="<?php echo $Single_Product['description']; ?>" name="Description"><?php echo $Single_Product['description']; ?></textarea>
                                    </div>
                                 </div>
                                 <!--<div class="form-group ">
                                    <label class="control-label col-sm-4" for="name">Price</label>
                                    
                                    <div class="col-md-8">
                                     <input type="text" class="form-control"  value="<?php echo $Single_Product['price']; ?>" name="price">
                                    </div>
                                    </div>  -->
                                 <!----------------Price INC VAT------------------------->   
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="name">Price Ex VAT</label>
                                    <div class="col-md-8">
                                       <input id="pexvat" type="text" class="form-control" value="<?php echo $Single_Product['ex_vat']; ?>" name="Price_ex_VAT">
                                    </div>
                                 </div>
                                 <div class="form-group ">
                                    <label class="control-label col-sm-4" for="name">Price INC VAT</label>
                                    <div class="col-md-8">
                                       <input readonly id="pincvat" type="text" class="form-control" value="<?php echo $Single_Product['inc_vat']; ?>" name="Price_INC_VAT">
                                    </div>
                                 </div>
                                 <!----------------Price ------------------------->   
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="name">VAT Deductable</label>
                                    <div class="col-md-8">
                                       Yes<input type="radio" value="1" <?php if($Single_Product['vat_deductable']=='1'){?>checked <?php } ?> name="deduct" class="tax_class"> 
                                       No<input type="radio"  value="0" <?php if($Single_Product['vat_deductable']=='0'){?>checked <?php } ?> checked name="deduct" class="tax_class">
                                    </div>
                                 </div>
                                 <!----------------radio------------------------->   
                                 <div class="form-group">
                                    <label class="control-label col-sm-4 " for="name">Tax Class</label>
                                    <div class="col-md-8" id="tax_class">
                                       <select name="tax" id="taxrate">
                                          <option value='' selected disabled>--Selected--</option>
                                          <option value='5' <?php if($Single_Product['tax_class']=='5'){ ?> selected <?php } ?>>5%</option>
                                          <option value='10' <?php if($Single_Product['tax_class']=='10'){ ?> selected <?php } ?> >10%</option>
                                          <option  <?php if($Single_Product['tax_class']=='20'){ ?> selected <?php } ?> value='20' >20%</option>
                                       </select>
                                    </div>
                                 </div>
                                 <!----------------Tax ------------------------->   
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="name">Publish Status</label>
                                    <div class="col-md-8">
                                       Yes<input type="radio" <?php  if($Single_Product['publish_status']=='1'){ ?> checked <?php } ?> value="1" name="pub" >
                                       No<input type="radio"  <?php  if($Single_Product['publish_status']=='0'){ ?> checked <?php } ?> value="0" name="pub" >
                                    </div>
                                 </div>
                              </div>
                           </div>
                     </div>
                     <div class="col-md-6 col-xs-12 " id="form">
                     <h2>Catagory</h2>
                     <div class="marg product-form">
                     <div class="form-horizontal">
                     <!------------Get All  category------------->
                     <?php 
                        $find_sub_cat1=$Single_Product['super_sub_cat_id'];
                         $find_sub_cat=$this->db->query("select sub_cat from super_sub_cat where id='$find_sub_cat1'");
                        $find_sub_cat=$find_sub_cat->result_array();
                        
                        if($find_sub_cat){
                        $find_sub_cat=$find_sub_cat[0]['sub_cat']; //sub cat id
                        }else
                        {
                        $find_sub_cat=0;
                        }
                         $find_cat=$this->db->query("select cat_id from dev_product_sub_cat where id='$find_sub_cat'");
                        $find_cat=$find_cat->result_array();
                        $selectedsubcat='';
                        $selectedid='';
                        if($find_cat){
                        $find_cat=$find_cat[0]['cat_id']; }
                        if(isset($_SESSION['Current_Business'])){ 
                        $bu_id=$_SESSION['Current_Business'];
                        }
                        else
                        {
                        $bu_id=$_SESSION['status']['business_id'];;
                        }
                        $AllCat=$this->ProductCategoryModal->GetAllCat($bu_id);
                        
                        
                        
                        ?>
                     <div class="form-group">
                     <label class="control-label col-sm-4" for="name">Mian Category</label>
                     <div class="col-md-8">
                     <select class="form-control"  name="Category" id="maincat">
                     <option value='0'>-------------Select-----------------</option>
                     <?php foreach($AllCat as $All){ ?>
                     <option <?php if($All['id']==$Single_Product['categories']){ $selectedsubcat=$All['id']; ?> selected <?php } ?> value=<?php echo $All['id'];?>><?php echo $All['cat_name']; ?></option>
                     <?php } ?>
                     </select>
                     </div>
                     </div>
                     <!-------->
                     <?php $AllSubCat=$this->db->query("select * from  dev_product_sub_cat where cat_id='$selectedsubcat'");
                        $AllSubCat=$AllSubCat->result_array();
                        ?>
                     <div class="form-group">
                     <label class="control-label col-sm-4" for="name">Sub Category</label>
                     <div class="col-md-8">
                     <select class="form-control"  name="Sub_Category" id="subcat">
                     <option value='0'>-------------Select-----------------</option>
                     <?php foreach($AllSubCat as $all){
                        ?>
                     <option <?php if( $all['id']==$Single_Product['sub_categories']){ $selectedid=$all['id'];?> selected <?php } ?> value="<?php echo $all['id'];?>"><?php echo $all['sub_cat_name'];?></option>
                     <?php  }?> 
                     </select>
                     </div>
                     </div>
                     <?php $AllSuperSubCat=$this->db->query("select * from  super_sub_cat where sub_cat='$selectedid'");
                        $AllSuperSubCat=$AllSuperSubCat->result_array();
                        ?>
                     <div class="form-group">
                     <label class="control-label col-sm-4" for="name" id="supersubcat">Sub_Sub_Category</label>
                     <div class="col-md-8">
                     <select class="form-control"  name="Sub_Sub_Category" id="subsubcat">
                     <option value='0'>-------------Select-----------------</option>
                     <?php foreach($AllSuperSubCat as $Allsub){ ?>
                     <option <?php if( $Allsub['id']==$Single_Product['super_sub_cat_id']){ $selectedid=$all['id'];?> selected <?php } ?> value="<?php echo $Allsub['id']; ?>"> <?php echo $Allsub['name'];?></option>
                     <?php } ?>
                     </select>
                     </div>
                     </div>
                     <input type="hidden" value="<?php echo $Single_Product['id'];?>" name="product_id_in_details"> <!------hidden pid----->
                     <div class=" PriviousFilltersDiv">
                     <h2>Added Fillters</h2>
                     <?php
                        if($Single_Product['AddedFilters']!='')
                        {
                        $UnserilizeArray=unserialize($Single_Product['AddedFilters']);
                        if(count($UnserilizeArray))
                        {
                        foreach($UnserilizeArray as $key=>$values)
                        {
                        foreach($values as $mainkey=>$mainvalue)
                        { ?>
                     <div class="row"><div class="col-sm-4"> <label class=""><?php echo $mainkey; ?><label></div><div class="col-sm-8"> <label><?php echo $mainvalue;?></label></div></div><br>
                     <?php }
                        }
                        }
                        }
                        
                        ?>
                     </div>
                     <div class="FilltersDiv">
                     </div>
                     <div class="form-group">
<div class="col-md-6"><span class="reset btn btn-info">Reset Filter</span></div>
                     <div class="col-md-6">
                     <span   name="updatefirstdetails" class="btn btn-info" id="Single_details" >UPDATE</span>
					 </div>
					 </div>
					   </div>
					   </div>
					   </div>
                     </form>
                   
                     
                     
                  </div>
               </div>
            </div>
         </div>
         <div id="ai" class="tab-pane <?php if($open_tab=='image'){ ?>active<?php } ?>">
            <div class="container">
               <?php 
                  if($this->session->flashdata('succimg')){
                  ?>
               <div class="alert alert-success"> 
                  <?php  echo $this->session->flashdata('succimg'); ?>
               </div>
               <?php  
                  }  
                  if($this->session->flashdata('failimg')){
                  ?>
               <div class = "alert alert-success">
                  <?php echo $this->session->flashdata('failimg'); ?>
               </div>
               <?php } ?>
               <div class="row">
                  <form id="productimageform" method="post" enctype="multipart/form-data">
                     <div class="col-md-12 marg ">
                        <div class="upload-sec">
                           <h2>Upload Images</h2>
                        </div>
                     </div>
                     <?php
                        $imagename=0;
                        $imagename2=0;
                        if($Single_Product['products_images']!='')
                        {
                        $str=$Single_Product['products_images'];
                        $str=explode("/",$str);
                        $imagename=$str[5];
                        }
                        if(isset($Single_Product['product_image_two']))
                        {
                        	if($Single_Product['product_image_two']!='')
                        {
                        $str2=$Single_Product['product_image_two'];
                        $str2=explode("/",$str2);
                        
                        $imagename2=$str2[5];
                        }
                        }
                         ?>
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="btn-new-sec" > <input  class="btn-3" id="img_1" type="file" value="<?php echo $Single_Product['products_images'] ?>" name="product_image_1">  </div>
                              <img src="<?php echo $Single_Product['products_images'] ?>" id="profile-img-tag" width="200px" /> <span id="products_images"><i <?php if($Single_Product['products_images']!=''){ ?> style="display:block" <? } else{ ?>  style="display:none" <?php } ?> id="imagenone1" class="removeimage fa fa-times-circle " aria-hidden="true"></i></span>
                           </div>
                           <div class="col-sm-6">
                              <div  class="btn-new-sec"> <input   class="btn-3" id="img_2" type="file" name="product_image_2" >
                                 <img src="<?php echo $Single_Product['product_image_two'] ?>" id="profile-img-tag2" width="200px" /> <span id="product_image_two"><i <?php if($Single_Product['product_image_two']!=''){?> style="display:block" <? } else{ ?> style="display:none" <?php } ?> id="imagenone2" class="removeimage fa fa-times-circle " aria-hidden="true"></i></span>
                                 <input type="hidden" value="<?php echo $Single_Product['id'];?>" name="product_id_in_images"> 
                              </div>
                           </div>
                           <hr>
                           <div class="col-sm-12 upload-secnew"></div>
                        </div>
                     </div>
                  </form>
               </div>
               <!--------row------>
            </div>
            <!--------container------>
         </div>
         <div id="sc" class="tab-pane <?php if($open_tab=='supplier'){ ?>active<?php } ?>">
            <div id="form">
               <form method="post" id="ajaxsuppliercos" >
                  <div class="container">
                     <?php 
                        if($this->session->flashdata('succsc')){
                        ?>
                     <div class="alert alert-success"> 
                        <?php  echo $this->session->flashdata('succsc'); ?>
                     </div>
                     <?php  
                        }  
                        if($this->session->flashdata('failsc')){
                        ?>
                     <div class = "alert alert-success">
                        <?php echo $this->session->flashdata('failsc'); ?>
                     </div>
                     <?php } ?>
                     <div class="row" >
                        <div class="col-md-12">
                           <h2>Suppliers Cost</h2>
                        </div>
                        <div id="single_row">
                           <?php 
                              if(isset($_SESSION['Current_Business'])){
                              $All_Supplier=$this->SupplierModel->Select_All_Supplier($_SESSION['Current_Business']);
                              }
                              else{
                              $All_Supplier=$this->SupplierModel->Select_All_Supplier(0);	
                              }
                              $supplier_with_cost=$Single_Product['supplier_with_cost']; //fetch supplier and cost
                              $supplier_with_cost=explode(',',$supplier_with_cost);
                              $number_of_keys=count($supplier_with_cost);
                              for($i=0;$i<$number_of_keys;$i++)
                              {
                              	$SupplierCostArray=explode('=>',$supplier_with_cost[$i]);
                              	if(count($SupplierCostArray)>1){
                              	$Suppid=$SupplierCostArray[0];
                              	$Cost=$SupplierCostArray[1];
                              	}
                              	else
                              	{
                              		$Suppid='';
                              	    $Cost='';
                              	}
                              
                              ?>
                           <div  class="form-horizontal" >
                              <div class="supcost<?php echo $i; ?>">
                                 <div class="col-md-6 col-xs-12  ">
                                    <div class="form-group ">
                                       <label class="col-md-3 control-label" for="address">Supplier</label>
                                       <div class="col-md-9   ">
                                          <select class="form-control"  name="supp<?php echo $i;?>">
                                             <option value="0">Select</option>
                                             <?php foreach($All_Supplier as $single){?>
                                             <option <?php if($single['id']==$Suppid){ ?> selected <?php } ?>value="<?php echo $single['id'];?>"><?php echo $single['suppliers_name'];?></option>
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-xs-12 " id="form">
                                    <div class="form-group">
                                       <label class="col-md-3 control-label"  for="name">Cost</label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" id="suppcost0" value="<?php echo $Cost; ?>" name="suppcost<?php echo $i;?>">
                                       </div>
                                    </div>
                                 </div>
                                 <i id="<?php echo "supcost".$i; ?>" class="fa fa-times-circle removesupcost" aria-hidden="true"></i>
                              </div>
                           </div>
                           <?php } ?>
                           <input type="hidden"  value="<?php echo $Single_Product['id']; ?>" name="hideen_pid_supplier">
                           <input type="hidden" id="hidden_supplier_value" value="<?php echo $i; ?>" name="hideen_no_supp">
                        </div>
                        <div class="col-md-12 marg_1">
                           <span class="btn btn-info" id="addmoresupplier" >ADD MORE</span>
                           <label>
                           <span  id="addsuppliyer" class="btn btn-info" >UPDATE</span>
                           </label> 
                        </div>
						  </div>
               </div>
               </form>
             
            </div>
         </div>
         <div id="sp" class="tab-pane <?php if($open_tab=='spc'){ ?> active <?php } ?>">
            <div class="container">
               <?php 
                  if($this->session->flashdata('succsp')){
                  ?>
               <div class="alert alert-success"> 
                  <?php  echo $this->session->flashdata('succsp'); ?>
               </div>
               <?php  
                  }  
                  if($this->session->flashdata('failsp')){
                  ?>
               <div class = "alert alert-success">
                  <?php echo $this->session->flashdata('failsp'); ?>
               </div>
               <?php } ?>
               <div class="row">
                  <div class="col-md-12">
                     <div class="upload-sec">
                        <h2>Specification</h2>
                     </div>
                  </div>
                  <!--<form method="post" action="<?php echo site_url('updateproducts');?>" >-->
                  <input type="hidden" value="<?php echo $Single_Product['id'];?>" id="hidspcvalue" name="hidproid_in_spc">
                  <div class="form-horizontal" id="addnewsp">
                     <?php
                        if(isset($Single_Product['specification'])) 
                        {
                         $specification=$Single_Product['specification'];
                         $specification_array=explode(',',$specification);
                           $numberOfSpeci=count($specification_array);
                        for($j=0;$j<$numberOfSpeci;$j++){
                        ?>
                     <div class="form-group spc<?php echo $j;?> " >
                        <div class="col-md-12  ">
                           <textarea id="singlespc"  rows="4"  name="spc<?php echo $j;?>"  class="form-control" placeholder="Description" ><?php echo $specification_array[$j];?></textarea>
                           <!--<i class="fa fa-times-circle removespc  " id="<?php echo "spc".$j;?>" aria-hidden="true"></i>-->
                        </div>
                     </div>
                     <?php } }?>
                     <input type="hidden"  id="jvalue" value="<?php echo $j;?>" name="numberofspc">
                     <div class="form-group">
                        <div class="col-md-9 offset-md-3">
                        </div>
                     </div>
                  </div>
                  <!----------------Supplier 3------------------------->   
               </div>
            </div>
            <hr>
            <!--<input type="submit" name="speciupdate" value="UPDATE" class="btn btn-info">
               </form>-->
            <span class="btn btn-info" id="addspcibutton">Add Specification</span>
         </div>
         <?php 
            $pdf_manual='';
            if($Single_Product['pdf_manual']!=''){
            $pdf_manual_path=$Single_Product['pdf_manual'];
            $pdf_manual=explode("/",$pdf_manual_path);
            $pdf_manual=$pdf_manual[5];
            }
            $pdf_manual2='';
            if($Single_Product['pdf_manual2']!=''){
            $pdf_manual_path2=$Single_Product['pdf_manual2'];
            $pdf_manual2=explode("/",$pdf_manual_path2);
            
            $pdf_manual2=$pdf_manual2[5];
            }
            $pdf_manual3='';
            if($Single_Product['pdf_manual3']!=''){
            $pdf_manual_path3=$Single_Product['pdf_manual3'];
            $pdf_manual3=explode("/",$pdf_manual_path3);
            $pdf_manual3=$pdf_manual3[5];
            
            }
            
            $pdf_manual4='';
            if($Single_Product['pdf_manual4']!=''){
            $pdf_manual_path4=$Single_Product['pdf_manual4'];
            $pdf_manual4=explode("/",$pdf_manual_path4);
            
            $pdf_manual4=$pdf_manual4[5];
            }
            $pdf_manual5='';
            if($Single_Product['pdf_manual5']!=''){
            $pdf_manual_path5=$Single_Product['pdf_manual5'];
            $pdf_manual5=explode("/",$pdf_manual_path5);
            
            $pdf_manual5=$pdf_manual5[5];
            }
            
            $pdf_manual6='';
            if($Single_Product['pdf_manual6']!=''){
            $pdf_manual_path6=$Single_Product['pdf_manual6'];
            $pdf_manual6=explode("/",$pdf_manual_path6);
            
            $pdf_manual6=$pdf_manual6[5];
            }
            
            ?>
         <div id="ao" class="tab-pane <?php if($open_tab=='optiontab'){ ?>active<?php } ?>">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <h2>App Options</h2>
                  </div>
                  <!----------------name------------------------->   
                  <div class="form-group col-md-2 marg ">
                     <label for="name">Name</label>
                  </div>
                  <div class="col-md-9 marg ">
                     <input type="text" class="form-control"   name="var_name" id="var_name">
                  </div>
                  <!----------------Supplier 3------------------------->   
                  <div class="form-group col-md-2 marg ">
                     <label for="text">Place holder</label>
                  </div>
                  <div class="col-md-9 marg ">
                     <input type="text" class="form-control"   name="placeholder_name" id="placeholder_name">
                  </div>
                  <div class="col-md-12 marg ">
                     <button type="button" class="btn btn-info" id="addoption">Add Options</button>
                     <div>
                     </div>
                  </div>
               </div>
               <hr>
            </div>
            <!------------------table---------------------->
            <div class="table">
               <div class="container">
                  <div class="row">
                     <table class="table" id="Variation_row">
                        <thead>
                           <tr>
                              <td><strong>Order</strong></td>
                              <td><strong>Name</strong></td>
                              <td><strong>Placeholder</strong></td>
                              <td><strong>Variation</strong></td>
                              <td><strong>Edit</strong></td>
                              <td><strong>Delete</strong></td>
                           </tr>
                        </thead>
                        <tbody></tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div id="pm" class="tab-pane <?php if($open_tab=='pdf'){ ?>active<?php } ?>">
            <div id="form">
               <div class="container">
                  <?php 
                     if($this->session->flashdata('succap')){
                     ?>
                  <div class="alert alert-success"> 
                     <?php  echo $this->session->flashdata('succap'); ?>
                  </div>
                  <?php  
                     }  
                     if($this->session->flashdata('failap')){
                     ?>
                  <div class = "alert alert-success">
                     <?php echo $this->session->flashdata('failap'); ?>
                  </div>
                  <?php } ?>
                  <div class="row">
                     <div class="col-md-12">
                        <h2>PDF Manules</h2>
                     </div>
                     <!-------------------buttons-------------------->
                     <form method="post" enctype="multipart/form-data" id="allpdfform">
                        <div class="row">
                           <div class="col-md-4 mb-4">
                              <iframe id="myiframe1" style="width:100%" src="<?php echo $pdf_manual_path;?>" frameborder="1"></iframe><span id="pdf_manual"><i <?php if($Single_Product['pdf_manual']!=''){?> style="display:block" <? } else{ ?> style="display:none" <?php } ?> id="pdfnone1" class="removepdf fa fa-times-circle " aria-hidden="true"></i></span>
                              <input id="iframeinput1" value="<?php echo $pdf_manual;?>" type="file" name="pdf_manual">
                           </div>
                           <div class="col-md-4 mb-4">
                              <iframe id="myiframe2" style="width:100%" src="<?php echo $pdf_manual_path2;?>" frameborder="1"></iframe><span id="pdf_manual2"><i <?php if($Single_Product['pdf_manual2']!=''){?> style="display:block" <? } else{ ?> style="display:none" <?php } ?> id="pdfnone2" class="removepdf fa fa-times-circle " aria-hidden="true"></i></span>
                              <input id="iframeinput2" value="<?php echo  $pdf_manual2;?>" type="file" name="pdf_manual2">
                           </div>
                           <div class="col-md-4 mb-4">
                              <iframe id="myiframe3" style="width:100%" src="<?php echo $pdf_manual_path3;;?>" frameborder="1"></iframe><span id="pdf_manual3"><i <?php if($Single_Product['pdf_manual3']!=''){?> style="display:block" <? } else{ ?> style="display:none" <?php } ?> id="pdfnone3" class="removepdf fa fa-times-circle " aria-hidden="true"></i></span>
                              <input id="iframeinput3" value="<?php echo $pdf_manual3;?>" type="file" name="pdf_manual3">
                           </div>
                           <div class="col-md-4 mb-4 mb-4">
                              <iframe id="myiframe4" style="width:100%" src="<?php echo $pdf_manual_path4;?>" frameborder="1"></iframe><span id="pdf_manual4"><i <?php if($Single_Product['pdf_manual4']!=''){?> style="display:block" <? } else{ ?> style="display:none" <?php } ?> id="pdfnone4" class="removepdf fa fa-times-circle " aria-hidden="true"></i></span>
                              <input id="iframeinput4" value="<?php echo $pdf_manual4;?>" type="file" name="pdf_manual4">
                           </div>
                           <div class="col-md-4 mb-4">
                              <iframe id="myiframe5" style="width:100%" src="<?php echo $pdf_manual_path5;?>" frameborder="1"></iframe><span id="pdf_manual5"><i <?php if($Single_Product['pdf_manual5']!=''){?> style="display:block" <? } else{ ?> style="display:none" <?php } ?> id="pdfnone5" class="removepdf fa fa-times-circle " aria-hidden="true"></i></span>
                              <input id="iframeinput5" value="<?php echo $pdf_manual5;?>" type="file" name="pdf_manual5">
                           </div>
                           <div class="col-md-4 mb-4">
                              <iframe id="myiframe6" style="width:100%" src="<?php echo $pdf_manual_path6;?>" frameborder="1"></iframe><span id="pdf_manual6"><i <?php if($Single_Product['pdf_manual6']!=''){?> style="display:block" <? } else{ ?> style="display:none" <?php } ?> id="pdfnone6" class="removepdf fa fa-times-circle " aria-hidden="true"></i></span>
                              <input id="iframeinput6" value="<?php echo $pdf_manual6;?>" type="file" name="pdf_manual6">
                           </div>
                           <div class="top-border-btn">
                              <label class=" button2" >
                              <input type="hidden" name="pdf_pid" value="<?php echo $Single_Product['id']?>">
                              </label> 
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<script>
   $(document).ready(function(){
   	
   	/******************Add data by ajax******************************/
   	
   	 $('#Single_details').click(function(){
   	 
    var form_data = new FormData($('#product_form')[0]);;	 
        $.ajax({
               type:'POST',
               url: "<?= base_url('')?>updateproducts",
               data:form_data,
               cache:false,
               contentType: false,
               processData: false,
             
               
           });
      });
      
    jQuery("#addspcibutton").click(function(){                 //Add specifications
     the_content=tinyMCE.get('singlespc').getContent();
     hidproid_in_spc=<?php echo $Single_Product['id'];?>;
     $.ajax({
   	  type:"POST",
   	  url:"<?= base_url('')?>updateproducts",
   	  data:{'contant':the_content,'hidproid_in_spc':hidproid_in_spc},
   	  success:function(data)
   	  {
   		   alert(data);
   	  }
     });
   });
   	/********************close add details************************/
   	/**********************productimageform*********************/
   	 $('#img_1,#img_2').change(function(){
   	 
    var form_data = new FormData($('#productimageform')[0]);;	 
        $.ajax({
               type:'POST',
               url: "<?= base_url('')?>updateproducts",
               data:form_data,
               cache:false,
               contentType: false,
               processData: false,
               success:function(data){
                  alert('Update Successfully');
               },
               error: function(data){
                   console.log("error");
                   alert(data);
               }
           });
      });
   	/**********************close********************************/
   	$('#Single_details').click(function(){
   	 
    var form_data = new FormData($('#product_form')[0]);;	 
    
        $.ajax({
               type:'POST',
               url: "<?= base_url('')?>updateproducts",
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
   	/*******************image show on upload******************/
   	function readURL(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#profile-img-tag').attr('src', e.target.result);
   				$('#imagenone1').css('display','block');
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
   	function readURL2(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#profile-img-tag2').attr('src', e.target.result);
   					$('#imagenone2').css('display','block');
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
   	/************************close*************************/
   	
   	/**********************Supllier with cost*******************/
   	 $('#addsuppliyer').click(function(){
   	 
    var form_data = new FormData($('#ajaxsuppliercos')[0]);	 
        $.ajax({
               type:'POST',
               url: "<?= base_url('')?>updateproducts",
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
   	/************************close******************************/
   	/**********************pdf by ajax************************************/
   	
   	function readURLpdf1(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#myiframe1').attr('src', e.target.result);
   					$('#pdfnone1').css('display','block');
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
       $("#iframeinput1").change(function(){
           readURLpdf1(this);
       });
   	//2
   	function readURLpdf2(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#myiframe2').attr('src', e.target.result);
   					$('#pdfnone2').css('display','block');
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
       $("#iframeinput2").change(function(){
           readURLpdf2(this);
       });
   	//3
   	function readURLpdf3(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#myiframe3').attr('src', e.target.result);
   					$('#pdfnone3').css('display','block');
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
       $("#iframeinput3").change(function(){
           readURLpdf3(this);
       });
   	//4
   	function readURLpdf4(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#myiframe4').attr('src', e.target.result);
   					$('#pdfnone4').css('display','block');
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
       $("#iframeinput4").change(function(){
           readURLpdf4(this);
       });
   	//5
   	function readURLpdf5(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#myiframe5').attr('src', e.target.result);
   					$('#pdfnone5').css('display','block');
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
       $("#iframeinput5").change(function(){
           readURLpdf5(this);
       });
   	//6
   	function readURLpdf6(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
               
               reader.onload = function (e) {
                   $('#myiframe6').attr('src', e.target.result);
   					$('#pdfnone6').css('display','block');
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
       $("#iframeinput6").change(function(){
           readURLpdf6(this);
       });
   	$('#iframeinput1,#iframeinput2,#iframeinput3,#iframeinput4,#iframeinput5,#iframeinput6').change(function(){
   	 
    var form_data = new FormData($('#allpdfform')[0]);;	 
        $.ajax({
               type:'POST',
               url: "<?= base_url('')?>updateproducts",
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
   	/*************************close****************************************/
   	
   	
   	$('#addoption').click(function(){
   	var placeholder=$('#placeholder_name').val();
   	var varname=$('#var_name').val();
   	var proid=<?php echo $Single_Product['id'];?>;
   	if(placeholder!=''&&varname!=''){
   	$.ajax({
   		url:"<?= base_url('')?>AddProductVariation",
   		method:"GET",
   		data:{'placeholder':placeholder,'varname':varname,'pro_id':proid},
   		success:function(data){
   		     alert("Add Successfully");
   			//$('#var_name').val('');
   			//$('#placeholder_name').val('');
   			$.ajax({
   		url:"<?= base_url('')?>ViewSingleProductVariation",
   		method:"POST",
   		data:{'editproid':data},
   		success:function(data){
   		   	decodeddata=JSON.parse(data);
   			objlen=decodeddata.length;
   			for(i=0;i<objlen;i++)
   			{
   				id=decodeddata[i].id;
   				name=decodeddata[i].option_name;
   				plaseholder=decodeddata[i].plaseholder	;
   			    product_id=decodeddata[i].product_id;
   			$('table#Variation_row tbody').after("<tr class="+id+"ro><td>+</td><td>"+name+"</td><td>"+plaseholder+"</td><td><a href=variationpage?optionid="+id+"&&product="+product_id+">view</a></td><td><a href=variationpage?optionid="+id+"&&product="+product_id+"><i class='fa fa-pencil' aria-hidden='true'></i></a></td><td><i id="+id+" class='fa fa-times-circle delvarrow1' aria-hidden='true'></i></td></tr>");
   			$('.delvarrow1').click(function(){        //delete variation option va ajax
   		optid=$(this).attr('id');
   		
   		proid=<?php echo $Single_Product['id'];?>;
   		$.ajax({
   		type:"POST",
   		url:"<?= base_url('')?>deletevariationoption",
   		data:{'optionid':optid,'product':proid},
   		success:function(data)
   		{
   			
   			$("."+optid+"ro").remove();
   		}
   		
   	});
   			
   	 });
   			} 
   			
   		
   		}
   		
   	});
   			//location.reload();
   			}
   	});
   	}
   	else
   	{
   	alert('Please Enter NAme And Placeholder');
   	}
   		
   });
   
   $('.removeimage').click(function(){
   	
   	imagenumber=$(this).parent().attr('id');
   	product_id=<?php echo $Product_Edit_Id; ?>;
   	
   	 $.ajax({
   		url:"<?= base_url('')?>deleteproductimage",
   		method:"POST",
   		data:{'imagenum':imagenumber,'product_id':product_id},
   		success:function(data){
   			
   			if(data=='products_images')
   			{
   				$('#imagenone1').css('display','none');
   				$('#profile-img-tag').attr('src',"");
   			}
   			if(data=='product_image_two')
   			{
   				$('#imagenone2').css('display','none');
   				$('#profile-img-tag2').attr('src',"");
   			}
   			alert('Are You Sure Delete Image');
   			
   		}
   		
   	}); 
   });
   jQuery('.removepdf').click(function(){
   	
   	product_id=<?php echo $Product_Edit_Id; ?>;
   	var colname=$(this).parent().attr('id');
   	
   	 $.ajax({
   		url:"<?= base_url('')?>deleteproductpdf",
   		method:"POST",
   		data:{'product_id':product_id,'colname':colname},
   		success:function(data){
   			
   			if(data=='pdf_manual')
   			{
   				$('#pdfnone1').css('display','none');
   				$('#myiframe1').attr('src',"");
   			}
   			if(data=='pdf_manual2')
   			{
   				$('#pdfnone2').css('display','none');
   				$('#myiframe2').attr('src',"");
   			}
   			if(data=='pdf_manual3')
   			{
   				$('#pdfnone3').css('display','none');
   				$('#myiframe3').attr('src',"");
   			}
   			if(data=='pdf_manual4')
   			{
   				$('#pdfnone4').css('display','none');
   				$('#myiframe4').attr('src',"");
   			}
   			if(data=='pdf_manual5')
   			{
   				$('#pdfnone5').css('display','none');
   				$('#myiframe5').attr('src',"");
   			}
   			if(data=='pdf_manual6')
   			{
   				$('#pdfnone6').css('display','none');
   				$('#myiframe6').attr('src',"");
   			}
   			
   		}
   		
   	}); 
   });
   
    
   $('#addspcibutton1').click(function(){
     current_value_j=$('#jvalue').val();
      
   	 $('#addnewsp').append( '<div class="form-group spc'+current_value_j+'"><label class="col-md-3 control-label" for="name">Description</label><div class="col-md-9"><textarea  name="spc'+current_value_j+'" class="form-control" placeholder="Description" ></textarea><span id="product_image_two"><i id="spc'+current_value_j+'" class="fa fa-times-circle removespc " aria-hidden="true"></i></span></div></div>');
   	 current_value_j= parseInt(current_value_j)+1;
   	 $('#jvalue').val(current_value_j);
   	 $('.removespc').click(function(){
   	 removediv=$(this).attr('id');
   	 $('.'+removediv).remove();
   	});
   });
    $('.removespc').click(function(){
   	 current_value_j=$('#jvalue').val();
   	 
   	 removediv=$(this).attr('id');
   	 $('.'+removediv).remove();
   	
   	 
   });
   
   	
   $('#addmoresupplier').click(function(){
   	hidden_supplier_value=$('#hidden_supplier_value').val();
   	
   	$('#single_row').append('<div  class="form-horizontal"><div class="supcost'+hidden_supplier_value+'"><div class="col-md-6 col-xs-12  "><div class="form-group "><label class="col-md-3 control-label" for="address">Supplier</label><div class="col-md-9 "><select class="form-control"  name="supp'+hidden_supplier_value+'"><option value="0">Select</option>  <?php foreach($All_Supplier as $single){?><option value="<?php echo $single['id'];?>"><?php echo $single['suppliers_name'];?></option><?php } ?></select></div></div></div><div class="col-md-6 col-xs-12 " id="form"><div class="form-group"><label class="col-md-3 control-label"  for="name">Cost</label><div class="col-md-9"><input type="text" class="form-control" name="suppcost'+hidden_supplier_value+'"></div></div></div><i id="supcost'+hidden_supplier_value+'" class="fa fa-times-circle removesupcost" aria-hidden="true"></i></div></div>');
   	hidden_supplier_value=parseInt(hidden_supplier_value)+1;
   	$('#hidden_supplier_value').val(hidden_supplier_value);
   	
   	$('.removesupcost').click(function(){
   	 removesupcost=$(this).attr('id');
   	 $('.'+removesupcost).remove();
   	});
   });
   
   	$('.removesupcost').click(function(){
   	 removesupcost=$(this).attr('id');
   	 $('.'+removesupcost).remove();
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
   	$('#maincat').change(function(){
   		
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
   		reset($cat_id);
   			  
   	}); 
   	$('.reset').click(function(){
   		cat=$('#maincat').val();
   		reset(cat);
   	})
   	function reset($cat_id)
   	{  $('.PriviousFilltersDiv').empty();
   	   $('.FilltersDiv').empty();
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
   						
   						$('.FilltersDiv').append("<div class='row' style='margin-bottom: 10px;margin-left: 0px;margin-right: 0px;'><div class='col-md-4'><span style='margin-right: 10px;'>'"+key+"'</span></div><div class='col-md-2'><input type='checkbox' class='commencheck' name='filteritem[]' id='"+id+"' value='"+key+"'></div><div class='col-md-6'><select name='filteritemvalue[]' style='display:none' class='form-control "+id+"'></select></div></div>");
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
   	}
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
   if($("input[name='deduct']:checked").val()=='0')
   	{
   		$('#tax_class').css('display','none');
   	} 
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
   	productid=<?php  echo $Single_Product['id'];?>,
   	$.ajax({
   		url:"<?= base_url('')?>Updatetaxclassvat",
   		method:"POST",
   		data:{'vatcalss':20,'proid':productid},
   		
   		
   	});
   	}
   	
   });
   var editpid=<?php echo $Single_Product['id'];?>;
   $.ajax({
   		url:"<?= base_url('')?>ViewProductVariation",
   		method:"POST",
   		data:{'editproid':editpid},
   		success:function(data){
   		   	decodeddata=JSON.parse(data);
   			objlen=decodeddata.length;
   			for(i=0;i<objlen;i++)
   			{
   				id=decodeddata[i].id;
   				name=decodeddata[i].option_name;
   				plaseholder=decodeddata[i].plaseholder	;
   			    product_id=decodeddata[i].product_id;
   			$('table#Variation_row tbody').after("<tr class="+id+"ro><td>+</td><td>"+name+"</td><td>"+plaseholder+"</td><td><a href=variationpage?optionid="+id+"&&product="+product_id+">view</a></td><td><a href=variationpage?optionid="+id+"&&product="+product_id+"><i class='fa fa-pencil' aria-hidden='true'></i></a></td><td><i id="+id+" class='delvarrow fa fa-times-circle ' aria-hidden='true'></i></td></tr>");
   		
   			} 
   				$('.delvarrow').click(function(){      //delete varition option ajax
   		optid=$(this).attr('id');
   		
   		proid=<?php echo $Single_Product['id'];?>;
   		$.ajax({
   		type:"POST",
   		url:"<?= base_url('')?>deletevariationoption",
   		data:{'optionid':optid,'product':proid},
   		success:function(data)
   		{
   			
   			$("."+optid+"ro").remove();
   		}
   			
   	 });
   		
   	});
   		}
   	});
   	
   	});
   	
</script>
<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="application/x-javascript">
   tinymce.init({selector:'#singlespc'});
   
</script>