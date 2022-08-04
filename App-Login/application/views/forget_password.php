<!DOCTYPE html>
<!--
Template Name: Keen - The Ultimate Bootstrap 4 HTML Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/
Support: https://keenthemes.com/theme-support
License: You must have a valid license purchased only from themes.getbootstrap.com(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Trades M8</title>
		<meta name="description" content="Login page " />
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
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/base_light.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/menu_light.css" rel="stylesheet" type="text/css" />
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/brand_dark.css" rel="stylesheet" type="text/css" />
		
		<link href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/css/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/images/newlogoleatest_2.png"/>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-2 login-signin-on d-flex flex-column flex-column-fluid bg-white position-relative overflow-hidden" id="kt_login">
				<!--begin::Header-->
				<div class="login-header py-10 flex-column-auto" style="background-color: #14499a!important;">
					<div class="container d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between">
						<!--begin::Logo-->
						<a href="#" class="flex-column-auto py-5 py-md-0">
						
						<img src="https://app.pickmyorder.co.uk/images/applogo/Back_End_Logo_2.png" alt="logo" class="h-50px" width="214px"/>
							<!--<img src="https://app.pickmyorder.co.uk//assets/css/demo1/log_page_css/images/logo-6.svg" alt="logo" class="h-50px" />-->
						</a>
						<!--end::Logo-->
						
						
				
						
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="login-body d-flex flex-column-fluid align-items-stretch justify-content-center" style="background-color: #14499a!important;">
					<div class="container row">
						<div class="col-lg-6 d-flex align-items-center">
							<!--begin::Signin-->
							<div class="login-form login-signin">
								<!--begin::Form-->
								<form style="background-color:#fff!important" method="post" action="<?php echo base_url('UserForgetPassword') ?>" class="form w-xxl-550px rounded-lg p-20" novalidate="novalidate" id="kt_login_signin_form"  >
									<!--begin::Title-->
									<div class="pb-13 pt-lg-0 pt-5">
										<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forget Your <span style="color: #21519e;font-weight:800"> Password </span></h3>
									</div>
									<!--begin::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">Enter your Email</label>
										<input class="form-control form-control-solid h-auto p-6 rounded-lg" type="email" name="email" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
								
									<div style="color:red;font-weight: 600;"><?php  echo $this->session->flashdata('error');   ?></div>
									<div style="color:red;font-weight: 600;"><?php  echo $this->session->flashdata('message');   ?></div>
									<!--end::Form group-->
									<!--begin::Action-->
									<div class="pb-lg-0 pb-5">
										<input type="submit"  name="forgetpass"   id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" style="display:block;width: 100%;background-color: #14499a!important;">
									
									</div>
									<!--end::Action-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Signin-->
						
						
						</div>
						<div class="col-lg-6 bgi-size-contain bgi-no-repeat bgi-position-y-center bgi-position-x-center min-h-150px mt-10 m-md-0" style="background-image: url(https://app.pickmyorder.co.uk/images/applogo/orignalhand.png)"></div>
					</div>
				</div>
				<!--end::Body-->
				<!--begin::Footer-->
				<div class="login-footer py-10 flex-column-auto" style="background-color: #14499a!important;">
					<div class="container d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between">
						<div class="font-size-h6 font-weight-bolder order-2 order-md-1 py-2 py-md-0">
							<span class="text-muted font-weight-bold mr-2">©</span>
							<a href="https://app.pickmyorder.co.uk/index" target="_blank" class="text-dark-50 text-hover-primary" style="color:#fff!important">TradesM8</a>
						</div>
						<!--<div class="font-size-h5 font-weight-bolder order-1 order-md-2 py-2 py-md-0">
							<a href="#" class="text-primary">Terms</a>
							<a href="#" class="text-primary ml-10">Plans</a>
							<a href="#" class="text-primary ml-10">Contact Us</a>
						</div>-->
					</div>
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/keen/theme/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3E97FF", "secondary": "#E5EAEE", "success": "#08D1AD", "info": "#844AFF", "warning": "#F5CE01", "danger": "#FF3D60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#DEEDFF", "secondary": "#EBEDF3", "success": "#D6FBF4", "info": "#6125E1", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/custom/login/login.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>