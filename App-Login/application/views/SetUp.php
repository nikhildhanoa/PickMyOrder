<!-- new tabs -->
<div>
<div><div class="container">
						
								<div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
									
	

 
									
										<div class="card-title">
										<div class="container">
											<h4 style="font-size: 32px;text-transform: uppercase;color: #124798;">SET up wizard</h4>
											</div>
										</div>
										<div class="card-toolbar">
										
										</div>
									</div>
									<div class="card-body">
										
								<!-- card content -->
								 
							<div class="container">
  
<?php  

     if($viewTab=='home'){
       $status =(empty($listdata[0]['email'])) ? ('active') : ('disabled');
	   $status3 =(!empty($listdata[0]['email'])) ? ('active') : ('disabled');
       $status2 =(!empty($listdata[0]['email'])) ? ('credit') : ('home');
	   $show = (empty($listdata[0]['email'])) ? ('show') : ('hide');
	 }else
	 {
		 $status='';
		$status2='credit'; 
	 }


?>
  <ul class="nav nav-tabs">
 
    <li id="delactive" class="<?php /* echo $status; */ ?>"><a data-toggle="tab" href="#home" class="<?php /* echo $status; */ ?>">Email</a></li>

   <li id="addactive" class="<?php if($status2!='credit') {?>  disabled <?php }else { echo $status3;}?> " ><a data-toggle="tab" href="#credit" class="<?php if($status2!='credit') {?>  disabled <?php } ?>"  >configured Suppliers</a></li>
   
	<li id="addactive" class="<?php if($status2!='credit') {?>  disabled <?php } ?>"><a data-toggle="tab" href="#Quotes" id="adddactive" class="<?php if($status2!='credit') {?>  disabled <?php } ?>">Added Suppliers</a></li>   
	
	<li id="addactive" class=""><a data-toggle="tab" href="#account" id="" class="">Accounting integration</a></li> 	
  </ul>



  <div class="tab-content">
  
  <?php if($viewTab=='home' && $show=='show' ) {    ?>
  
    <div id="home" class="tab-pane <?php echo $status;  ?>">
    <!-- Email -->
	<div class="row">

<form class="form-signin my-5" method="post" action="AddInvoiceSetting" id="settingsform">
<!-------------->
<div class="col-md-12">
	
	
	 <div style="padding:30px 25px;box-shadow:rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;border-radius:8px;">
		 <h3 style="font-size:19px;text-transform:uppercase;margin-bottom:1rem;">Email account configuration.</h3>
		 <h4 style="font-size:14px;color: #A6A5AA;">Optional Email Account Configuration.</h4>
		 <div class="row mt-10">
		<div class=" col-md-6">
			<h4 style="font-size:14px;color: #A6A5AA;">Process Emails</h4>
	<div>
				      
				      <select class="form-control" name="Process_Emails">
					  <option value="0">Disabled</option>
					<option value="1">Enabled</option>
					      
					  </select>
		
			 </div>
	</div>
		
		<div class=" col-md-6">
			<h4 style="font-size:14px;color: #A6A5AA;">Store Emails</h4>
	<div>   
				      <select class="form-control" name="Store_Emails" id="Store_Emails">
					  <option  value="1"> Yes</option>
					  <option  value="0">No</option>		  
					  </select>
			 </div>
	</div>
	
	<div class=" col-md-6">	
	</div>
	
	<div class=" col-md-6 mt-10" Style="display:none;" id="Number_of_Day_hide_show"  >  
			<h4 style="font-size:14px;color: #A6A5AA;">Number of Day</h4>
	<div>   
				      <select class="form-control" name="Number_of_Day">
					  <option  value="90">90</option>
					  <option  value="120">120</option>
					  <option  value="150">150</option>
					  <option  value="180">180</option>
					  </select>
			 </div>
	</div>
	
	
	
</div>
	</div>
	</div>

<!-------------start-------------->




    	<div class="col-md-12">   
        
          
	<div style="border-radius: 8px;padding:30px 25px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;margin-top:1rem;">

     <div class="Email_integration">
	      <h3 style="text-transform:uppercase;font-size:20px;margin-bottom:1rem">Email Integration<h3>
	      <p style="color:#abaaaf;font-size:15px;margin-bottom:25px;">
		   Select your Email and Enter the Email address where you currently receive Supplier invoices (eg. invoices@yourcompany.com). This will connect your Email Account up to TradesM8 and process invoices, creditnotes, Quotations you have received.
		  </p>
	 </div>
	 
	
	
	 
    <div class="row mt-5">
	     <div class="col-md-3" style="display: flex;align-items: center;"> <label style="color:#000;font-size:15px;font-weight:normal">Email</label></div>
	     <div class="col-md-4">
		     <div>
					 
				     <?php if($viewTab=='home') { ?>
				      <input type="Email" name="emailaddress" class="form-control" required="">
					 <?php }else { 
                          $data  =$this->session->userdata('nylasUser');
						 $mail= $data['emailaddress'];
						 $insert_id= $data['insert_id'];
						
						
					 ?>
					  <input type="Email" name="emailaddress" class="form-control" value="<?php echo $mail;  ?>" readonly>
					 
					 <?php } ?>
			 </div>
		 </div>
	</div>
	
	   <div class="row mt-5">
	   <div class="col-md-3"  style="display: flex;align-items: center;" ><label style="color:#000;font-size:15px;font-weight:normal">Previous Months</label></div>
	     <div class="col-md-4">
		     <div>
					
				      
				      <select class="form-control">
					      <option>1 months</option>
					      <option>6 months</option>
					      <option>12 months</option>
					  <select>
					
			 </div>
		 </div>
	</div>
	
	<div class="row mt-5">
	    <div class="col-md-6" style="display:flex;align-items:center">
		   <label style="color:#000; font-size:15px;font-weight:normal;">Email Providers Supported</label>
		</div>
	    <div class="col-md-6" style="display:flex;align-items:center">
				
         <?php if($viewTab=='home') {?> <input type="submit" class="btn btn-info testcon" name="send" value="CONNECT EMAIL"> <?php }  ?>
		</div>
	</div>
	   <div class="row mt-5">
	     <div class="col-md-12">
		     <div>
					 
				   
					  <div class="providers_supported" style="display:flex;justify-content:space-around;padding: 25px 0;
                       border: 1px solid aliceblue;" >
					       <div class="">
						   <img src="https://app.pickmyorder.co.uk//images/applogo/google.png" style="width:40px;margin-right:10px">
						   Gmail</div>
					       <div class=""> <img src="https://app.pickmyorder.co.uk//images/applogo/outlook.png" style="width:40px;margin-right:10px">Outlook</div>
					       <div class=""> <img src="https://app.pickmyorder.co.uk//images/applogo/office.png" style="width:40px;margin-right:10px">Offer</div>
					       <div class=""><img src="https://app.pickmyorder.co.uk//images/applogo/yahoo.png" style="width:40px;margin-right:10px">Yahoo</div>
					       <div class=""><img src="https://app.pickmyorder.co.uk//images/applogo/mail.png" style="width:40px;margin-right:10px">Smip</div>
					  </div>
				    
					
			 </div>
		 </div>
	</div>
	
        </div> <!-- /container -->
		</form>
	</div>

	</div>
	
	<!-- content -->
	<!--end of Email tab -->
	
    </div>
  <?php } else {   ?>
  
   <div id="home" class="tab-pane">
    <!-- Email -->
	<div class="row">


<!-------------->
<div class="col-md-12">
	
	
	 <div style="padding:30px 25px;box-shadow:rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;border-radius:8px;">
		 <h3 style="font-size:19px;text-transform:uppercase;margin-bottom:1rem;">Email account configuration.</h3>
		 <h4 style="font-size:14px;color: #A6A5AA;">Optional Email Account Configuration.</h4>
		 <div class="row mt-10">
		<div class=" col-md-6">
			<h4 style="font-size:14px;color: #A6A5AA;">Process Emails</h4>
	<div>
				     
				      <select class="form-control" name="Process_Emails" id="Process_Emails">
					  <option value="0"  <?php if($listdata[0]['Process_Emails']=='0') { ?> selected  <?php } ?>>Disabled</option>
						<option value="1"  <?php if($listdata[0]['Process_Emails']=='1') { ?> selected  <?php } ?>>Enabled</option>
					      
					  </select>
		
			 </div>
	</div>
		
		<div class=" col-md-6">
			<h4 style="font-size:14px;color: #A6A5AA;">Store Emails</h4>
	<div>   
				      <select class="form-control" name="Store_Emails" id="Store_Emails">
					  <option  value="1" <?php if($listdata[0]['Store_Emails']=='1') { ?> selected  <?php } ?>> Yes</option>
					  <option  value="0" <?php if($listdata[0]['Store_Emails']=='0') { ?> selected  <?php } ?>>No</option>		  
					  </select>
			 </div>
	</div>
	
	<div class=" col-md-6">	
	</div>
	
	<div class=" col-md-6 mt-10" Style="display:<?php if($listdata[0]['Store_Emails']=='0') { ?> block  <?php } else { ?> none <?php }?>" id="Number_of_Day_hide_show"  >  
			<h4 style="font-size:14px;color: #A6A5AA;">Number of Day</h4>
	<div>   
				      <select class="form-control" name="Number_of_Day" id="Number_of_Day">
					  <option  value="90" <?php if($listdata[0]['Number_of_Day']=='90') { ?> selected  <?php } ?>>90</option>
					  <option  value="120" <?php if($listdata[0]['Number_of_Day']=='120') { ?> selected  <?php } ?>>120</option>
					  <option  value="150"<?php if($listdata[0]['Number_of_Day']=='150') { ?> selected  <?php } ?>>150</option>
					  <option  value="180"<?php if($listdata[0]['Number_of_Day']=='180') { ?> selected  <?php } ?>>180</option>
					  </select>
			 </div>
	</div>
	
	 <div class="col-md-12 mt-8" style="display:flex;align-items:center;justify-content:flex-end;">
				
         <input type="submit" class="btn btn-info testcon" name="send" value="SAVE CHANGES" id="SAVE_CHANGES">
		</div>

</div>
	</div>
	</div>

    	

	</div>
	
    </div>
  
  <?php  }   ?>
<!-------------------------------------------------------------Credit------------------------------------------------------------------------->
 
    <div id="credit" class="tab-pane <?php if($status2=='credit') {?>  active <?php }  ?> ">
    
		<div class="row">

    	<div class="col-md-12 col-sm-12">   
          <form class="form-signin my-5 p-5" method="post" action="AddInvoiceSetting" id="settingsform" style="border-radius: 8px;">
		 
		  <div>
		  <h3 style="text-transform:uppercase;font-size:16px">Add suppliers from Email Account<h3>
		       <p style="color: #abaaaf;font-size: 15px;margin-bottom:25px;">
			      If you have chosen to process Suppliers not already added to the TradesM8 platform, please use forms to below to config the suppliers settings for your account.
			   </p>
		  </div>
		  <div>
		       <table  id="MyTableId" style="width:100%;margin-bottom:25px">
			   <thead>
			          <tr style="background: #e8e8e8;color: #000;">
							  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;font-size: 15px;font-weight: 500;">Email Domains</th>
							  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;font-size: 15px;font-weight: 500;">Number of Emails</th>
							  <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;font-size: 15px;font-weight: 500;">Actions</th>
					  </tr>
			  </thead>
				
	          <tbody>			  
					  
					  
							 <?php   if(!$key==""){
							    $idx=1;
							   foreach($key as $data=>$val)
							   { 
								 ?>  
							  
					   <tr style="border: 1px solid #DADADB;"> 
					           <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf"><?php echo $data;  ?></td>
					           <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf"><?php echo $val;  ?></td>
					           <td class="tdid"  id="<?Php echo $idx;  ?>" style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#7E8299;width:21%;"><span  id="<?Php echo 'ID'.$idx;  ?>" class="del_span" data-id="<?php echo  $data ?>"><i class="fa fa-plus" style="padding-right:5px"></i>Add  Suplier</span> 
							  
							   </td>
							   </tr>
					  <?php $idx++; }   } else { ?>
                     
					          <tr style="border: 1px solid #DADADB;"> 
					           <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf"></td>
					           <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf">No Record Found</td>
					           <td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf"></td>
							  
							   </td>
							   </tr>

					  <?php  }  ?>					  
					  </tbody>
			   </table>
			   <div class="mt-5">
			        <h2 style="font-size:16px">ADD SUPLIERS MANUALLY</h2>
					<div class="row">
					 
		            <div class="col-md-6">
								   <label style="color:#abaaaf;font-weight:normal">Supplier Email Domain</label>
								   <input id="MANUALLYDomain" type="text" name="emailaddress" class="form-control" >
					</div>
					</div>
			      
			   </div>
			   
		  </div>
		 
			 <!-- <label>Password</label>-->
			 
			<?php   if(!empty($listdata[0]['id'])){  ?>
			<input type="hidden" name="password" class="form-control" id="userid" value="<?php echo $listdata[0]['id']; ?>">	
						<?php } else  {  ?>
		<input type="hidden" name="password" class="form-control" id="userid" value="<?php echo $insert_id; ?>">
			<?php  } ?>

			
            <Span  id="ADDMANUALLY" class="btn btn-info testcon mt-3" name="send" >ADD</span>
			 <Span  id="CONNECTDomains" style="float:right;background-color:#7bae37" type="submit" class="btn btn-info testcon mt-3" name="send" >Next </span>
          </form>
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
		  
		  
		  
		  
    </div>
<!--------------------------------------------------------------Close-------------------------------------------------------------------------->
<!-------------------------------------------------------------Quotes------------------------------------------------------------------------->
 <?php   
if(!empty($listdata[0]['id']))
{
	 $this->db->select('domains');
	 $this->db->from('dev_PmoNylas_users_domains');
	 $this->db->where(' Nylas_users_id ',$listdata[0]['id']);
	 $Domiandata=$this->db->get()->result_array();

}      
  ?>
 
    <div id="Quotes" class="tab-pane">
 
 <!-- content -->
 
 <div class="mb-7">
											<div class="datatable datatable-bordered datatable-head-custom printable datatable-default datatable-primary datatable-loaded p-5 mt-5" id="kt_datatable" style="margin-top: 1.5em;border-radius: 8px;">
											
											<!-- headings -->
											  <h3 style="text-transform:uppercase;font-size:22px">CONFIGURED SUPPLIERS<h3>
	                                           <p style="color:#abaaaf;font-size:15px;margin-bottom:25px;">
												If you have chosed a supplier not already added to the Procure HQ system, please use the form below to configure the supplier settings for your account.
											  </p>
		                                    <!-- headings end -->
											
											<table style="width:100%;margin-bottom:25px"  id="append_result">
			          <tbody>
					                  
									<tr  style="background: #e8e8e8;color: #000;"> <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;font-size: 15px;font-weight: 500;text-transform:uppercase,text-transform:uppercase">Email Domain</th> </tr>  
									  
					  	   <?php  foreach($Domiandata as $Domiandata2) {  ?>
						   
						   
						   
						   <tr class="trdata" style="border: 1px solid #DADADB;"> <td class="insetdata" style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf;font-size: 13px !important;font-weight: 400;"><?php echo $Domiandata2['domains'];  ?></td> </td> </tr>
						   
						   
						   
						   <?php }?>
					  
							 					  
			   </tbody></table>
			   <Span  id="Connect"  class="btn btn-info testcon mt-3" name="send" >Connect</span>
			   
			   <!-- table end -->
											
											</div>
											
										</div>
 
 <!-- content -->
 
 
    </div>
<!--------------------------------------------------------------Close-------------------------------------------------------------------------->
<!----------------------------------------------Setting invoice email------------------------------------------------------>
<div id="account" class="tab-pane">
 
 <!-- content -->
 
 <div class="mb-7">
											<div class="datatable datatable-bordered datatable-head-custom printable datatable-default datatable-primary datatable-loaded p-5 mt-5" id="kt_datatable" style="margin-top: 1.5em;border-radius: 8px;">
											
											<!-- headings -->
										
											  
											  
											  <div class="container">
											  
											    <div class="row">
											   <div class="col-md-12">
											  <h4 style="text-transform:uppercase;font-size:22px">Select Account Integration<h4>
											  <p style="margin-bottom:2em;font-size:15px;color: #aaa9a9">Choose your accounting system you wish to integrate with</p>
											  </div>
											  </div>
											  
											      <div class="row" style="gap:20px 0;">
												  
												      <div class="col-md-6 col-sm-12">
													  
													  <div class="account_integration_div_system" style="  border: 2px solid #cccc;">
													       <div class="accounting_integration_header" style="border-bottom:2px solid #cccc;background:#f7f7f7">
														       
															   <figure>
															   <img src="https://app.pickmyorder.co.uk//images/applogo/logo_xero-svg.svg" style="display: block;
															   margin:auto;width: 150px;padding:20px 0">
															   
															   <figcaption>
															   <p style="text-align: center;color: #aaa9a9;font-size: 15px;">Put time-consuming tasks on autopilot and advanced integration options, including invoice automation, purchase order matching and credit limit management. </p>
														   
															   </figcaption>
															   </figure>
															    
														   </div>
														   <div class="accounting_integration_footer" style="padding:1em 0">
														   <?php 
														   
														   	
																	if(isset($_SESSION['Current_Business']))
																		   {
																			   $bid=$_SESSION['Current_Business'];
																		   }
																		  else
																		  { 
																			   $bid=$_SESSION['status']['business_id'];
																		  }
																		  

														   
														   
														   
														      $this->db->select('*');
															   $this->db->from('dev_Xero_Users');
															   $this->db->where('bussines_id',$bid);
															   $query = $this->db->get();
																$query_data = $query->result_array();
																
																if($query->num_rows()==1)
		                                                         {
																	 $url='ReconnectwithXero'; 
																 }else{
																	 $url='callXero';
																 } 
																
														   
														   ?>
														   <a  href="<?php base_url()?>/<?php echo $url; ?>" style="background-color:transparent;padding:0px;border:0px;display: block;margin: auto;"><p style="margin:0px;text-align:center"><img src="https://developer.xero.com/static/images/documentation/ConnectToXero2019/connect-blue.svg"></p>
														   
														 
														  
														  </a>
														  
														   </div>
														   </div>
													       
												      </div>
													  
													  <!-- card 2 -->
													        <div class="col-md-6 col-sm-12">
													  
													  <div class="account_integration_div_system" style="  border: 2px solid #cccc;">
													       <div class="accounting_integration_header" style="border-bottom:2px solid #cccc;background:#f7f7f7">
														       
															   <figure>
															   
															   <!-- svg used -->
															      <img src="https://app.pickmyorder.co.uk//images/applogo/svg_quick_books-svg_new.svg" style="display: block;
															   margin:auto;width: 144px;padding:20px 0">
														
															   <!-- svg used -->
															   
															
															
															   
															   <figcaption>
															   <p style="text-align: center;color: #aaa9a9;font-size: 15px;">Automate supplier bill entry into QuickBooks <br> with full line item breakdown. Simply set <br> the default accounting options and <br>start approving invoices </p>
														   
															   </figcaption>
															   </figure>
															    
														   </div>
														   <div class="accounting_integration_footer" style="padding:1em 0">
														   
														   <button style="background-color: transparent;padding: 5px 10px;border: 1px solid #ccc;display: block;margin: auto;border-radius: 3px;;">
														  <p style="margin: 0px;text-align: center;color: #2ca01c;font-size: 16px;"><img src="https://app.pickmyorder.co.uk//images/applogo/svg_quick_books-svg_new.svg" style="height:33px;margin-right:10px;">Connect to QuickBooks</p>
														  </button>
														  
														   </div>
														   </div>
													       
												      </div>
													  
													  <!-- card 2-->
													  
													  
													  <!-- second row -->
													  
													  		  
												      <div class="col-md-6 col-sm-12">
													  
													  <div class="account_integration_div_system" style="  border: 2px solid #cccc;">
													       <div class="accounting_integration_header" style="border-bottom:2px solid #cccc;background:#f7f7f7">
														       
															   <figure>
															   <img src="https://app.pickmyorder.co.uk//images/applogo/sage_50.svg" style="display: block;
															   margin:auto;width: 150px;padding:20px 0">
															   
															   <figcaption>
															   <p style="text-align: center;color: #aaa9a9;font-size: 15px;">Put time-consuming tasks on autopilot and advanced integration options, including invoice automation, purchase order matching and credit limit management. </p>
														   
															   </figcaption>
															   </figure>
															    
														   </div>
														   <div class="accounting_integration_footer" style="padding:1em 0">
														   
														     <button style="background-color: transparent;padding: 5px 10px;border: 1px solid #ccc;display: block;margin: auto;border-radius: 3px;;">
														  <p style="margin: 0px;text-align: center;color: #2ca01c;font-size: 16px;"><img src="https://app.pickmyorder.co.uk//images/applogo/sage_50.svg" style="height:40px;margin-right:10px;">Connect to Sage 50</p>
														  </button>
														   
														  
														   </div>
														   </div>
													       
												      </div>
													  
													  <!-- card 2 -->
													        <div class="col-md-6 col-sm-12">
													  
													  <div class="account_integration_div_system" style="  border: 2px solid #cccc;">
													       <div class="accounting_integration_header" style="border-bottom:2px solid #cccc;background:#f7f7f7">
														       
															   <figure>
															   
															   <!-- svg used -->
															      <img src="https://app.pickmyorder.co.uk//images/applogo/simPRO_Logo_Blue.svg" style="display: block;
															   margin:auto;width: 150px;padding:28px 0;">
														
															   <!-- svg used -->
															   
															
															
															   
															   <figcaption>
															   <p style="text-align: center;color: #aaa9a9;font-size: 15px;">Automate supplier bill entry into QuickBooks <br> with full line item breakdown. Simply set <br> the default accounting options and <br>start approving invoices </p>
														   </p>
														   
															   </figcaption>
															   </figure>
															    
														   </div>
														   <div class="accounting_integration_footer" style="padding:1em 0">
														   
														  <button style="  background-color: #fff;padding: 5px 10px;border: 1px solid #055398;display: block;margin: auto;border-radius: 3px;">
														  <p style="margin: 0px;text-align: center;color: #055398;font-size: 16px;"><img src="https://app.pickmyorder.co.uk//images/applogo/simPRO_Logo_Blue.svg" style="height:40px;margin-right:10px;">Connect to SimPro</p>
														  </button>
														   
														  
														   </div>
														   </div>
													       
												      </div>
													  
													  <!-- second row -->
													  
													  
													  
												  </div>
												  
											  </div>
	                                          
		                                    <!-- headings end -->
											
										
			
			   
			   <!-- table end -->
											
											</div>
											
										</div>
 
 <!-- content -->
 
 
    </div>
<!------------------------------------------------close------------------------------------------------------------------------------>

    </div>
<!--------------------------------------------------------close------------------------------------------------------------------------------>
</div>
</ul>
								<!-- card content -->
										
									</div>
									
								</div>
							
							</div>
							
						</div>
					
					</div>
					
					
					
<script> 
$("#SAVE_CHANGES").click(function(){
	  
	var Process_Emails= $('#Process_Emails').val();
	var Number_of_Day= $('#Number_of_Day').val();
	var Store_Emails= $('#Store_Emails').val();
	
	
	
	 $.ajax({
		   url:'<?= base_url('')?>SaveSetupChange',
           method:'post',
           data:{'Process_Emails':Process_Emails,'Number_of_Day':Number_of_Day,'Store_Emails':Store_Emails},
		   success:function(data)
		   {
			  if(data==1)
			  {
				 alert('Changes Save');
				
				 
			  }				  
			   
		   }
	      }); 
	
});



$("#Store_Emails").change(function(){
	var val = $(this).val();
	
	if(val==0)
	{
		$('#Number_of_Day_hide_show').css('display','block');   
	}
	else
	{
		$('#Number_of_Day_hide_show').css('display','none'); 
	}	
	
});


$("#Connect").click(function(){
	
	var userid= $('#userid').val();
	var val = [];
	 $('#append_result').find("td.insetdata").each(function(i){
		val[i] = $(this).html();
           });
	
	 if(val.length === 0)
	 {
		 alert("Add  Supliers  ");
	 }else
	 {
	
	
	$.ajax({
		   url:'<?= base_url('')?>SetupUserDomain',
           method:'post',
           data:{'val':val,'userid':userid},
		   success:function(data)
		   {
			  if(data==1)
			  {
				 alert('setup Complete');
				 window.location.replace("https://app.pickmyorder.co.uk/SetUp");
				 
			  }				  
			   
		   }
	      });
	
	
	 }
	
});
$("#CONNECTDomains").click(function(){  
	
	
	  var val = [];
	 $('#MyTableId').find("td.tdid").each(function(i){
		var checkclass = $(this).find('span').attr('class');
		 if(checkclass=="add_span")
		  {
	      val[i] = $(this).find('span').attr('data-id'); 
		   }
           }); 
	
	 if(val.length === 0)
	 {
		 alert("Select Domains ");
	 }else
	 {
		  
		 
		$.ajax({
		   url:'<?= base_url('')?>InsertUsersDomians',
           method:'post',
           data:{'val':val},
		   success:function(data)
		   {  
		  
			 var header='<tr  style="background: #e8e8e8;color: #000;"> <th style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;font-size: 15px;font-weight: 500;text-transform:uppercase,text-transform:uppercase">Email Domain</th> </tr>';
			
			 var jsondata = JSON.parse(data);
			 var content = "";
		        for (var x = 0; x < jsondata.length; x++) {
					 
					  content += '<tr class="trdata" style="border: 1px solid #DADADB;"> <td class="insetdata" style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf;font-size: 13px !important;font-weight: 400;">'+jsondata[x]+'</td> </td> </tr>';
					 
				 }
            
			  $('#delactive').removeClass('active');
			  $('#dellactive').removeClass('active');
			  $('#addactive').removeClass('disabled');
			  $('#adddactive').removeClass('disabled');
              $('#addactive').addClass('active');
			  $('#credit').removeClass('active'); 
              $('#Quotes').addClass('active');
			  $('#append_result').html(''); 
			  $('#append_result').append(header).append(content);
			
	     
		   }
	      });
	 }
});




$('.tdid').click(function(){
	var ID = $(this).attr("id");
	 var check_class=$(this).closest('td').find('span').attr('class');
    
   if(check_class=='del_span')
   {
           $('#ID'+ID).removeClass('del_span'); 
              $('#ID'+ID).addClass('add_span');
			  $('#ID'+ID).html('Added');
			  
   }else
   {
               $('#ID'+ID).removeClass('add_span'); 
                   $('#ID'+ID).addClass('del_span'); 
				   $('#ID'+ID).html('<i class="fa fa-plus" style="padding-right:5px"></i>Add Suplier');
   }		  
	            
	
});


$('#ADDMANUALLY').click(function(){
	
	var MANUALLYDomain = $('#MANUALLYDomain').val();
	var rowCount = $('#MyTableId tr').length;
	/*  var email = new RegExp('^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$'); */
	

	 if(MANUALLYDomain!=''){
    	var Appendhtml= '<tr   style="border: 1px solid #DADADB;"><td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf">'+MANUALLYDomain+'</td><td style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#abaaaf">0</td><td class="tdid" id='+rowCount+' style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;border: 1px solid #dadadb;color:#7E8299;"><span id=ID'+rowCount+' class="add_span" data-id='+MANUALLYDomain+' style="width:85%;margin:auto">Manually Add </span> </td> </tr>';
	$('#MANUALLYDomain').val('');
	 $("#MyTableId").append(Appendhtml);
	 
	} 
	else{
		alert("Enter A Domain");
	}
	
	
	
	
});

 



</script>