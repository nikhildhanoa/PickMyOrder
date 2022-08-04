

<div class="container">
  <ul class="nav nav-tabs">
  
  
    <li><a data-toggle="tab" href="#Addsection" >Add Sections</a></li>
	 <li><a data-toggle="tab" href="#Managesection">Manage Sections</a></li> 
    <li><a data-toggle="tab" href="#addcatalog">Add Catalogues</a></li> 
	<li><a data-toggle="tab" href="#managecatalog">Manage Catalogues</a></li>	
  </ul>
 <div class="tab-content">
 
 <div id="Addsection" class="tab-pane  background">
     
  <div class="row">
	    <div class="col-md-12">
	   <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Add Section</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
           
              <form  enctype="Multipart/form-data" method="post" action="">
			 
			 
	
			 
				  
							   <div class="form-group ">
								  <div>Section Name</div>
								 
									<input type="text" name="section" placeholder="Section Name" class="col-md-6 form-control form-control-solid mt-5" required>
									<input type="hidden" name="bid" value="">
								 
								</div>
				
				  
							<div class="form-group ">
								  <div>Cover Image</div>
								
									<input type="file" name="cover" class="mt-5" required>
                                    <input type="hidden" name="Shelve_id" value=""> 								      
									  
							</div> 
				  
				   
					   <div class="form-group ">
								<input type="submit" name="addsec"  Value="Add Section" class="btn btn-info" >
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
 <!----------------------------------manage section------------------------------------->
 <div id="Managesection" class="tab-pane   background">
  <div class="row">
	    <div class="col-md-12">
	   <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Manage Section</h3>
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
 
     <div class="table_data" >
	     <div class="table_header" style=" display:grid;grid-template-columns: repeat(5,1fr);border-bottom: 1px solid #EBEDF3;">
	       <div> <h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">ID</h5></div>
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Section</h5></div>
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Cover Image</h5></div>
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Edit</h5></div>
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Delete</h5></div>
		  </div> 
		  <div id = "imageListId">
		 
 
		     <div  class = "listitemClass getvalue" id="" style=" display:grid;grid-template-columns:repeat(5,1fr);padding: 1rem 1rem 1rem 0; border-bottom: 1px solid #EBEDF3;">
	      <div class = "listitemClass"> <p> </p></div>
	       <div class = "listitemClass"><p></p></div>
	       <div class = "listitemClass"><p><img src="" style="width:50px;height:40px;"></p></div>
		  
	       <div class = "listitemClass"><p><a href=""><i style="color:#5867dd" class="fa fa-edit" aria-hidden="true"></i></a></p></div>
	       <div class = "listitemClass"><p><a href="" class="newanchor " ><i class="fa fa-times-circle" aria-hidden="true"></i></a></p></div>
		  </div> 
		   <?php }?>  
        </div>
        <input type="hidden"  id="outputvalues" name="outputvalues" value="">
		<div style="display:flex;justify-content:flex-end;margin-top:20px;">
		<span  type="button" class="divbutton" style="padding: 10px 20px;background-color: #3699FF;border-color: #3699FF;color: white;
            border-radius: 10px;font-size: 15px;">SET ORDER</span>
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
 <!-----------------------------add catalog and view------------------------------------>
    <div id="addcatalog" class="tab-pane   background">
	  <div class="row">
       <div class="col-md-12">
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Add Catalogues</h3>
	
		 </div>
		 <div class="card-body">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

  <div class="form-horizontal">
    <div class="form-group">
              <form enctype="multipart/form-data" method="post" action="">
			
					 <div class="form-group ">
					  <div>
							Select Section
					  </div>
					  <div>
					  

					  
							<select name="sectionid"  class="col-md-6 form-control form-control-solid mt-5" required="required">
							<option value="">-----Select------</option>
							
							<option value=""></option>
							
							</select><span id="show_cat" style="color: red;position: relative;top: 27px;left: 20px;font-size: 18px;"></span>
					  </div>
				 </div>
			 
			  <div class="form-group ">
				 
					  <div>
							Description
					  </div>
					  <div>
							<textarea name="description" class="col-md-6 form-control form-control-solid mt-5" required></textarea>
					  </div>
				 
			  </div>
			  
			     
                    <div class="form-group">
						<div>
								Upload Catalogue
						</div>
						<div>
								<input type="file" name="pdffile" required class="mt-5" required>
								<input type="hidden" id="shelve_id" name="shelve_id" value="">
								
						</div>
                    </div>
			   
				<div class="form-group">
         

	     				<input class="btn btn-info" type="submit" value="Upload Catalogue" name="uploadpdf">
					
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
	<!----------------------------------manage catalog------------------------------------->
  <div id="managecatalog" class="tab-pane  background">
  <div class="row">
	    <div class="col-md-12">
	   <div class="card card-custom gutter-b example example-compact">
<div class="card-header">
         <h3 class="card-title">Manage Catalogues</h3>
	
		 </div>
		 <div class="card-body" style="padding: 2rem 2.25rem 1rem 2.25rem;">
	<div class="form-group dropzone mb-0" style="border: none;">
 <div class="jumbotron-sec marg ">

 
 <div class="form-horizontal">
 <form  action=>
    <div class="form-group ">
					  <div>
							Select Section
					  </div>
					  <div>
					  

					  
							<select name="sectionid"  class="col-md-6 form-control form-control-solid mt-5" id="Select_Section">
							<option value="">-----Select------</option>
							
						
							
							<option   value=""></option>
						
						
							</select><span id="show_cat" style="color: red;position: relative;top: 27px;left: 20px;font-size: 18px;"></span>
							
					  </div>
				 </div>
				 <!-- print catalogue-->
	</form>
	<div class="form-group">
	<!-- Div Table -->
	 
	
	
	 <div class="table_data_ID_and_Section" >
	     <div class="table_header_new" style=" display:grid;grid-template-columns: repeat(4,1fr);padding-bottom: 10px;
               border-bottom: 1px solid #EBEDF3;">
	      
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Description</h5></div>
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Image</h5></div>
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Edit</h5></div>
	       <div><h5 style="color: #B5B5C3;font-size: 0.9rem;text-transform: uppercase;font-weight: 600;letter-spacing: 0.1rem;">Delete</h5></div>
		  </div> 
		  <div id = "imageListId2">
		
		     <div  class = "listitemClass getvalue2" id="" style=" display:grid;grid-template-columns:repeat(4,1fr);padding: 1rem 1rem 1rem 0; border-bottom: 1px solid #EBEDF3;">
	      
	       <div class = "listitemClass2"><P></P></div>
	       <div class = "listitemClass2"><img src="" style="width:50px;height:40px;"></div>
		  
	       <div class = "listitemClass2"><a href=""><i style="color:#5867dd" class="fa fa-edit" aria-hidden="true"></i></a></div>
	       <div class = "listitemClass2"><a href="" class="newanchor " ><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
		  </div> 
		   <?php }?> 
        </div>
        <input type="hidden"  id="outputvalues" name="outputvalues" value="">
		<div style="display:flex;justify-content:flex-end;margin-top:20px;">
		<span  type="button" class="divbutton2" style="padding: 10px 20px;background-color: #3699FF;border-color: #3699FF;color: white;
            border-radius: 10px;font-size: 15px;">SET ORDER</span>
		</div>
	 </div>
 
 
 </div>		
		  
 
	</div>
   
	
	<!-- End of print catalogue-->
  </div>
   </div>
    </div>
	 </div>
	  </div>
	   </div>
	    </div>
		 </div>
		 
		 
		
		 
		 <!--  End of Append div-->



