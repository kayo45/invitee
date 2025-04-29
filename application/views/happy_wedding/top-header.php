<?php 
$website_title = $myHelpers->global_lib->get_option('website_title');
$social_media = $myHelpers->global_lib->get_option('social_media');
$company_tel = $myHelpers->global_lib->get_option('company_tel');
$company_email = $myHelpers->global_lib->get_option('company_email');
$site_language = $myHelpers->global_lib->get_option('site_language');
$default_language = $myHelpers->global_lib->get_option('default_language');
$website_logo = $myHelpers->global_lib->get_option('website_logo');
$website_logo_text = $myHelpers->global_lib->get_option('website_logo_text');
?>
<div class="page-wrapper flower-fixed-body1 rose_vine-fixed-body1 golden-bar-fixed-body1 design-1-fixed-body1 pink-rose-fixed-body1">
	<div class="preloader">
		<div class="middle">
			<i class="fi flaticon-bride"></i>
			<i class="fi flaticon-bride"></i>
			<i class="fi flaticon-bride"></i>
			<i class="fi flaticon-bride"></i>
		</div>
	</div>

 	<header id="header" class="site-header header-style-1">
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col col-xs-12">
						<div class="site-logo">
							<a href="<?php echo base_url().'#home';?>">
								<?php if(isset($website_logo) && !empty($website_logo) && file_exists('uploads/logo/'.$website_logo) )
								{
									echo '<img src="'.base_url().'uploads/logo/'.$website_logo.'">';
								}
								else{ 
								?>
								<h1 class="itl_fam"><?php echo $website_logo_text; ?></h1>
								<?php } ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div> 
		
		
		<nav class="navigation navbar navbar-default">
			<div class="container">
				<h1 class="pull-left itl_fam mobile-sticky-logo">
				<?php if(isset($website_logo) && !empty($website_logo) && file_exists('uploads/logo/'.$website_logo) )
				{
					echo '<img src="'.base_url().'uploads/logo/'.$website_logo.'">';
				}
				else{ 
					echo $website_title; 
				} ?>
				</h1>
				<div class="navbar-header">
					<button type="button" class="open-btn">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="navbar-collapse collapse navigation-holder">
					
					<button class="close-navbar"><i class="ti-close"></i></button>
					<ul class="nav navbar-nav">
					<?php 
					
						
					
					$primary_menu = $myHelpers->global_lib->get_option('primary_menu'); 
					if(isset($primary_menu) && !empty($primary_menu)) 
					{
						$menu_meta = json_decode($primary_menu,true);
						
						foreach($menu_meta as $hmk=>$hmv)
						{
						  $p_url = '#';
						  $menu_id_exp = explode('~',$hmv['id']);
						  $menu_type = $menu_id_exp[0];
						  $menu_slug = $menu_id_exp[1];
						  
						  $active_class = '';
						 
							if($menu_type == 'static')
							{
							  if($menu_slug == 'homepage')
							  {
								  $menu_slug = 'home';
								  if($class == 'home' && $func == 'home')
								  {
									 $active_class = 'active'; 
								  }
							  }
							   else if($menu_slug == 'blogs')
							  {
								
								if($class == 'blogs' && $func == $menu_slug)
								{
									$active_class = 'active'; 
								}
								  $menu_slug = 'blogs';
							  }
							  
							  
							  $p_url = $myHelpers->menu_lib->get_url($menu_slug);
							  
						
							}
							else if($menu_type == 'homepage')
						    {
							  
							  $p_url = $menu_slug;
						
							}
						  else if($menu_type == 'page')
						  {
							  
							  $page_slug = $myHelpers->global_lib->get_page_slug_by_id($menu_slug);
							  $p_url = $myHelpers->menu_lib->get_url('page='.$page_slug); 
						  }
						  else if($menu_type == 'custom_link')
						  {
							    if(isset($cur_page) && $cur_page == 'home')
								{
									$p_url = $menu_slug; 
								}
								else if (strpos($menu_slug, '#') !== false) {
									$p_url = base_url(array($menu_slug));
								}	
								else
								{
									$p_url = $menu_slug; 
								}
						  }
						  
					  ?>
							<li class="
							<?php 
							if(isset($hmv['children']) && !empty($hmv['children']))
							{
								echo 'menu-item-has-children';
							}
							?> <?php echo $active_class; ?>"
							><a href="<?php echo $p_url  ; ?>"><?php echo mlx_get_lang($hmv['name']); ?></a>
								<?php 
								if(isset($hmv['children']) && !empty($hmv['children']))
								{
									echo '<ul class="sub-menu">';
									
									foreach($hmv['children'] as $hmvck=>$hmvcv)
									{
										$sub_menu_id_exp = explode('~',$hmvcv['id']);
									    $sub_menu_type = $sub_menu_id_exp[0];
									    $sub_menu_slug = $sub_menu_id_exp[1];
										if($sub_menu_type == 'page')
										{
											$page_slug = $myHelpers->global_lib->get_page_slug_by_id($sub_menu_slug);
											$type_url = $myHelpers->menu_lib->get_url('page='.$page_slug); 
										}
										else
										{
											$type_url = $myHelpers->menu_lib->get_url('type='.strtolower($hmvcv['name']));
										}
										?>
											<li ><a href="<?php echo $type_url; ?>"><?php echo mlx_get_lang($hmvcv['name']); ?></a></li>
										<?php
									}
									echo '</ul>';
								}
								?>
							</li>
					<?php  
						}
					
					?>
					</ul>
				</div>
			</div>
		</nav>
		<?php } ?>
	</header>
