
<?php  $id=$key;
      $user_id=$keydata;
	  
	 $bussidata=$this->db->query("select * from dev_business where id='$id'");
     $namedata=$bussidata->result_array();

     $bname=$namedata[0]['business_name'];   
     $Trial_business_status=$namedata[0]['Trial_business']; 
     $subscription_price=$namedata[0]['subscription_price'];
     $subscription_name=$namedata[0]['subscription_name']; 	 
     $subscription_value=$namedata[0]['subscription_value'];
     $subscription_id = $namedata[0]['subscription_id'];	 
 ?> 

<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Pick my order</title>
		<meta name="description" content="Create Account " />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->

		
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/style.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/bundle.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/prism.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/style_bundle.css" rel="stylesheet" type="text/css" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
		
		
		
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/base_light.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/menu_light.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/brand_dark.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/images/newlogoleatest_2.png" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<!--begin::Body-->
	<!--begin::Body-->
	<body>
	
	<div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
								<div style="display:block;justify-content:space-between;padding:10px 20px" >
								<?php if($Trial_business_status==1) {?>
								<p style="color:red;font-size:16px">You haven't take any subscription</p>
								
							<?php } else if ($Trial_business_status==2) { ?>
								<p style="color:blue;font-size:16px">your subscription is <?php echo $subscription_price."
								/ ".$subscription_value ?> (<?php echo $subscription_name ?>) </p>
								

                                 <?php  
								 
								 if(isset($_SESSION['Current_Business']))
		                      {
			                $bid=$_SESSION['Current_Business'];
							   }
							  else
							  {
							$bid=$_SESSION['status']['business_id'];  
							  }

                            $bussindata1=$this->db->query("select * from dev_business where id=$bid");
                            $bussindata1=$bussindata1->result_array(); 
							$expire_trial_time=$bussindata1[0]['expire_trial_time'];
    
								 ?>

                                  

								<p style="color:red;" >Expiry Date:- <?php echo $expire_trial_time ;   ?>  </p>
								<!--<input type="button" value="Cancel subscription" style="background-color: red;color: white;border: none;border-radius: 5px;font-weight: 500;padding: 10px 20px;font-size: 15px;"> -->
								<?php  } ?>
								</div>
									<div class="card-body py-10">
										  <div class="d-flex justify-content-start mb-5">
				  <a href="#" class="flex-column-auto py-5 py-md-0">
						
						<img src="https://app.pickmyorder.co.uk/assets/css/demo1/log_page_css/images/newlogoleatest.png" alt="logo" width="160px">
							<!--<img src="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/images/logo-6.svg" alt="logo" class="h-50px" />-->
						</a>
				</div>
										<!-- begin: Tabs-->
										<div class="d-flex justify-content-center">
											<ul class="nav nav-pills nav-group nav-primary mb-10 mb-lg-20 font-weight-bolder" id="pills-tab" role="tablist">
												<li class="nav-item">
													<a class="nav-link px-8 py-5 active" data-toggle="pill" href="#kt_pricing_1">Annual Plans</a>
												</li>
												<li class="nav-item">
													<a class="nav-link px-8 py-5 " data-toggle="pill" href="#kt_pricing_2">Monthly Plans</a>
												</li>
											</ul>
										</div>
										<!-- end: Tabs-->
										<div class="tab-content">
											<!-- begin: Tab pane-->
											<div class="tab-pane row text-center  active" id="kt_pricing_1" role="tabpanel">
												<div class="row">
												<!---1-->
												
												<div class="col-xl-3">
														<div class="py-20 px-10 px-lg-10">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															<!--content heading  -->
                                                             <h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Apprentice</h2>

															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-5">
																<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">240</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/year</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Basic License</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Unlimited Staff</li>
																	<li>Unlimited Products</li>
																	<li>Orders</li>
																	<li>Engineers</li>
																	<li>Projects</li>
																	<br>
																	<br>
																	<br>
																	<br>
																</ul>
																<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWPjDRVVxSjrdergaugzgA"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
														</div>
													</div>	
													<!---2-->
													 <div class="col-xl-3">
														<div class="bg-white rounded shadow-sm p1-20 px-10 px-lg-10 py-lg-20">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															<!--content heading  -->
															<h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Journeyman</h2>

															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-5">
																	<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">840</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/ year</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Business License</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Unlimited Staff</li>
																	<li>Unlimited Products</li>
																	<li>Orders</li>
																	<li>Engineers</li>
																	<li>Projects</li>
																	<li>Catalogues</li>
																	<li>Van Stock*</li>
																	<li>Luckins Products </li>
																	<br>
																</ul>
																<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWQZDRVVxSjrdePEjvkwrr"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
														</div>
													</div>
                                                   <!------3------>
                                                     <div class="col-xl-3">
														<div class="py-20 px-10 px-lg-10">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															
															<!--content heading  -->
															<h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Superviser</h2>


															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-5">
																	<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">1740</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/ year</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Full License</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Unlimited Staff</li>
																	<li>Unlimited Products</li>
																	<li>Orders</li>
																	<li>Engineers</li>
																	<li>Projects</li>
																	<li>Catalogues</li>
																	<li>Van Stock***</li>
																	<li>Luckins Products </li>
																	<li>3rd Party Integrations</li>
																</ul>
																<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWRvDRVVxSjrdeSVrygvX0"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
														</div>
													</div>
													<!----------4-------->
													
													
													<div class="col-xl-3">
														<div class="py-20 px-10 px-lg-10">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															
															<!--content heading  -->
															<h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Shelve It</h2>


															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-5">
																<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">350</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/ year</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Shelve It</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Up 2 3 users </li>
																	<li>Over 500k products </li>
																	<li>Over 500k images </li>
																	<li>Pdf literature for products </li>
																	<li>Pdf drawings </li>
																	<li>Pdf instructions </li>
																	<li>Manufacturers catalogues </li>
																	<li>18<sup>th</sup> regulation book***</li>
																	<li>Electrical documents*****</li>
																</ul>
																<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWSVDRVVxSjrdedbELTKzq"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
														</div>
													</div>
													
													
													
												</div>
											</div>
											<!-- end: Tab pane-->
											<!-- begin: Tab pane-->
											<div class="tab-pane row text-center " id="kt_pricing_2" role="tabpanel">
												<div class="row">
													<!--begin: Pricing-->
													<div class="col-xl-3 border-right-0 border-right-xl border-bottom border-bottom-xl-0">
														<div class="py-20 px-10 px-lg-20">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															<h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Apprentice</h2>
															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-10">
																	<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">25</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/ month</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Basic License</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Unlimited Staff</li>
																	<li>Unlimited Products</li>
																	<li>Orders</li>
																	<li>Engineers</li>
																	<li>Projects</li>
																	<br>
																	<br>
																	<br>
																	<br>
																	<br>
																	
																</ul>
																
      <!-- Note: If using PHP set the action to /create-checkout-session.php   price_1JXJfXDRVVxSjrdeWj2zxb6m-->

															  
													
														
															<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWMuDRVVxSjrdeJdzTQvqh"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
										 				</div>
													</div>
													<!--end: Pricing-->
													<!--begin: Pricing-->
													<div class="col-xl-3 border-right-0 border-right-xl border-bottom border-bottom-xl-0">
														<div class="py-20 px-10 px-lg-20">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															<h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Journeyman</h2>
															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-10">
																	<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">75</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/ month</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Business License</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Unlimited Staff</li>
																	<li>Unlimited Products</li>
																	<li>Orders</li>
																	<li>Engineers</li>
																	<li>Projects</li>
																	<li>Catalogues</li>
																	<li>Van Stock</li>
																	<li>Luckins Products </li>
																	<br>
																	<br>
																</ul>
																<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWNoDRVVxSjrdewix5SKzU"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
														</div>
													</div>
													<!--end: Pricing-->
													<!--begin: Pricing-->
													<div class="col-xl-3">
														<div class="py-20 px-10 px-lg-20">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															<h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Supervisor</h2>
															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-10">
																	<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">150</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/month</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Full License</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Unlimited Staff</li>
																	<li>Unlimited Products</li>
																	<li>Orders</li>
																	<li>Engineers</li>
																	<li>Projects</li>
																	<li>Catalogues</li>
																	<li>Van Stock</li>
																	<li>Luckins Products </li>
																	<li>3rd Party Integrations</li>
																	
																</ul>
																<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWOXDRVVxSjrdeU0xak2iu"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
														</div>
													</div>
													<!--end: Pricing-->
		<!--begin: Pricing-->
	
		<div class="col-xl-3">
														<div class="py-20 px-10 px-lg-10">
															<!--begin::Icon-->
															<div class="d-flex flex-center position-relative py-5">
															
															<!--content heading  -->
															<h2 style="font-size: 1.75rem;color: #1c4d9b;font-weight: bold;">Shelve It</h2>


															</div>
															<!--end::Icon-->
															<!--begin::Content-->
															<div class="d-flex flex-column flex-center text-center pt-10">
																<div class="d-flex justify-content-center pb-5">
																<span class="text-muted font-size-h3 align-self-start mr-2">??</span>
																	<span class="font-weight-bolder display-4 text-dark-75 align-self-center">29</span>
																	<span class="text-muted font-size-lg align-self-end ml-2">/ month</span>
																</div>
																<h4 class="font-size-h6 d-block d-block font-weight-bold text-dark-50 pb-5">Shelve It</h4>
																<ul class="list-unstyled text-muted mb-10">
																	<li>Up 2 3 users </li>
																	<li>Over 500k products </li>
																	<li>Over 500k images </li>
																	<li>Pdf literature for products </li>
																	<li>Pdf drawings </li>
																	<li>Pdf instructions </li>
																	<li>Manufacturers catalogues </li>
																	<li>18<sup>th</sup> regulation book***</li>
																	<li>Electrical documents*****</li>
																	<br>
																	<br>
																</ul>
																<form action="https://pickmyorder.co.uk/stripe/server/php/public/create-checkout-session.php" method="POST">
											<input type="hidden" name="priceId" value="price_1JtWZxDRVVxSjrdedwo1svgp"/>
											<input type="hidden" name="business_id" value="<?php echo $id ?>"/>
											<input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
																<button type="submit" name="BasicPurchase" class="btn btn-primary text-uppercase font-weight-bolder px-16 py-4">Purchase </button>
																	</form>
															</div>
															<!--end::Content-->
														</div>
													</div>
													<!-- end: Shelve it -->


												</div>
											</div>
											<!-- end: Tab pane-->
										</div>
									</div>
									<h2 style="font-size:22px;font-weight:bold;color:B5B5C3;margin-bottom:10px;">NOTES</h2>
						<p style="font:15px;color:#B5B5C3 !important;"> (1) * van stock for 2 vans additional charge will apply for additional vans over </p>
						<p style="font:15px;color:#B5B5C3;">(2) ** van stock for 5 vans additional charge will apply for additional vans over</p>
						<p style="font:15px;color:#B5B5C3;"> (3) *** Additional charges will apply </p>
						<p style="font:15px;color:#B5B5C3;">(4) **** Additional charges will apply </p>
						<p style="font:15px;color:#B5B5C3;"> (5) Please refer to T&amp;C for more information </p>
						<p style="font:15px;color:#B5B5C3;"> (6) Prices Excluding VAT</p>
								</div>
								<!--end::Card-->
							</div>
	
	
	
		<script src="https://pickmyorder.co.uk/Test/plugins.bundle.js?v=2.1.1"></script>
		<script src="https://pickmyorder.co.uk/Test/prismjs.bundle.js?v=2.1.1"></script>
		<script src="https://pickmyorder.co.uk/Test/scripts.bundle.js?v=2.1.1"></script>
		<!--end::Global Theme Bundle-->
	</body>
</html>