<?php error_reporting(0);
if($_SESSION['status']['iswholseller'])
{
	$type="Users";
}
else
{
	$type="Engineers";
	if($this->DataModel->CheckBussinessStatus())
	{
		$type='Users';
	}
}
if(isset($_SESSION['status']))
	{
		$bid=$_SESSION['status']['business_id'];
	}
	if(isset($_SESSION['Current_Business']))
	{
		$bid=$_SESSION['Current_Business'];
	}
	if($bid=='15')
	{
	$OnlyProductApp='none';
	}
	else
	{
	$OnlyProductApp='block';	
	}
$bussidata=$this->db->query("select business_name from dev_business where id='$bid'");
$namedata=$bussidata->result_array();
$bname=$namedata[0]['business_name'];
?>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin::Aside Brand -->
					<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="<?php echo site_url("dashboard");?>">
								<img alt="Logo" src="<?php echo base_url(); ?>/images/applogo/newlogoleatest.png" />
							</a>
						</div>
						<div class="kt-aside__brand-tools">
							<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
						</div>
					</div>
 
					<!-- end:: Aside Brand -->

					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
									<?php 	if(isset($_SESSION['status'])){
								$userid=$_SESSION['status']['user_id'];
								$permissions=$this->DataModel->CheckPermission($userid);
								//print_r($permissions);die;
								
					if($permissions['permission_super_Admin']=='1' ){		

							?>
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-graphic"></i><span class="kt-menu__link-text">Dashboards</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								
						     <!-----div for spacial app product menu----------------------->
							 <div style="display:<?php if($OnlyProductApp=='none'){ echo "block" ;}else{ echo "none";} ?>" class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('dashboard');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Dashboards</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											</li>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('categorylist');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Category</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											</li>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('CategoriesListTransfer'); ?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Category (Copy)</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											</li> 
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('products');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Products</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											</li> 
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('ProductListTransfer');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Products Copy</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											</li> 
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('ProductList');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Products List</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											</li> 
										</ul>
							</div>
							 <!------------------------------------------------------------>
									<div style="display:<?php echo $OnlyProductApp;?>" class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Dashboards</span></span></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo site_url("business");?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Business</span></a></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo site_url("users");?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">User (Admin)</span></a></li>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('CategoryTransfer'); ?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Category (Copy)</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											</li> 
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('Notifications'); ?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Notifications</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li> 
										</ul>
									</div><?php } }?>
								</li>
								
								<li style="display:<?php echo $OnlyProductApp; ?>"" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-drop"></i><span class="kt-menu__link-text">Apps</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Features</span></span></li>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('dashboard');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Dashboards</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li>
											<?php if($permissions['permission_super_Admin']=='1'|| $permissions['permission_products']=='1'){	?>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('products');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Products</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												
											</li> <?php } ?>
											<?php if($permissions['permission_super_Admin']=='1'|| $permissions['permission_categories']=='1'){	?>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('category');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Category</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												
											</li><?php } ?>
											<?php if($permissions['permission_super_Admin']=='1'|| $permissions['permission_orders']=='1'){	?>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('orders');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Orders</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li><?php } ?>
											<?php if($permissions['permission_super_Admin']=='1'|| $permissions['permission_quotes']=='1'){	?>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('quotes');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Quotes</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li><?php } ?>
											<?php if($permissions['permission_super_Admin']=='1' && $this->DataModel->CheckBussinessStatus()!=1|| $permissions['permission_suppliers']=='1'){	?>
											<li class="kt-menu__item   aria-haspopup="true"><a href="<?php echo site_url("suppliers");?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Suppliers</span></a></li>
											<?php } ?>
											<?php if($permissions['permission_super_Admin']=='1'|| $permissions['permission_engineers']=='1'){	?>
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php if($type=="Engineers"){echo site_url("engineer"); }else{
												echo site_url("wholesaler"); 
												
											}?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"><?php echo $type;?></span></a></li>
											<?php } ?>
											<!--------------------------------------------------Delevery cost menu showing if wholsaler--------------------------------------------->
											<?php if($permissions['permission_super_Admin']=='1' && $this->DataModel->CheckBussinessStatus()==1||$permissions['permission_deleverycost']=='1'){	?>
											<li class="kt-menu__item   aria-haspopup="true"><a href="<?php echo site_url("Delevercost");?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Delevery Cost</span></a></li>
											<?php } ?>
											<!--------------------------------------------------------------------------------------------------------------------------------------->
											<!--------------------------------------------------store menu showing if wholsaler--------------------------------------------->
											<?php if($permissions['permission_super_Admin']=='1' && $this->DataModel->CheckBussinessStatus()==1||$permissions['permission_store']=='1'){	?>
											<li class="kt-menu__item   aria-haspopup="true"><a href="<?php echo site_url("Stores");?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Stores</span></a></li>
											<?php } ?>
											
											<!--------------------------------------------------------------------------------------------------------------------------------------->
											<!--------------------------------------------------Fillter showing if wholsaler--------------------------------------------->
											<?php if($permissions['permission_super_Admin']=='1' && $this->DataModel->CheckBussinessStatus()==1||$permissions['permission_store']=='1'){	?>
											<li class="kt-menu__item   aria-haspopup="true"><a href="<?php echo site_url("fillter");?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Fillters</span></a></li>
											<?php } ?>
											<!--------------------------------------------------------------------------------------------------------------------------------------->
											
											<?php if($permissions['permission_super_Admin']=='1' && $this->DataModel->CheckBussinessStatus()!=1|| $permissions['permission_projects']=='1' ){	?>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('projects');?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Projects</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li><?php } ?>
											
											<?php if($permissions['permission_super_Admin']=='1' || $permissions['permission_catologes']=='1'){	?>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('newCetalogues') ?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Catalogues</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li> <? }
											if($_SESSION['status']['iswholseller']){ ?>
											
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="<?php echo site_url('StripeConnect'); ?>" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Stripe Connect</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li>
											
											<?php } 

											?>
											
										</ul> 
									</div>
								</li>
								<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-drop"></i><span class="kt-menu__link-text">Support</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
								<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Support</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
								</li>
											<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Submit Ticket</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
											
											</li>
								       </ul>
									</div>
								</li>
							
							</ul>
						</div>
					</div>

					<!-- end:: Aside Menu -->

					<!-- begin:: Aside Footer -->
					<div class="kt-aside__footer kt-grid__item" id="kt_aside_footer">
						<div class="kt-aside__footer-nav">
							
						</div>
						<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
					
						<div class="kt-footer__menu">
							
							<a href="www.pickmyorder.co.uk" target="_blank" class="kt-footer__menu-link kt-link">2019&nbsp;©&nbsp;Pick My Order</a>
						</div>
					</div>
					</div>

					<!-- end:: Aside Footer-->
					
					
					
					
				</div>