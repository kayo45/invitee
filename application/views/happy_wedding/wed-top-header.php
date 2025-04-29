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
							<a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'#home';?>">
								<h1 class="itl_fam"><?php echo $wedding->row()->wedding_title; ?></h1>
								<span><?php echo strtoupper($wedding->row()->wedding_status); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div> 
		
		<nav class="navigation navbar navbar-default">
			<div class="container">
				<h1 class="pull-left itl_fam mobile-sticky-logo"><?php echo $wedding->row()->wedding_title; ?></h1>
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
						<li class="">
							<a href="#home"><?php echo mlx_get_lang('Home'); ?></a>
						</li>
					<?php
						$user_id = $wedding_user_id;
						$primary_menu = $myHelpers->global_lib->get_user_meta($user_id,'homepage_section'); 
						
						if(isset($primary_menu) && !empty($primary_menu)) 
						{
							$menu_meta = json_decode($primary_menu,true);
						foreach($menu_meta as $hmk=>$hmv)
						{
							if($hmv['is_enable'] != 'Y')
								continue;
							
						    if($hmk == 'slider_section')
							  continue;
						    else if($hmk == 'couple_section')
							{
								
							}
						    else if($hmk == 'invitation_section')
							{
								if(!isset($wedding_id)) continue;
								$wd_result = $this->Common_model->commonQuery("select * from wedding_details 
								where id = $wedding_id ");
								if($wd_result->num_rows() == 0)
								{
									continue;
								}
							}
							else if($hmk == 'story_section')
							{
								if(!isset($wedding_id)) continue;
								$story_result = $this->Common_model->commonQuery("select * from wedding_story
									where wedding_id = $wedding_id	
									ORDER BY story_order ASC");
								if($story_result->num_rows() == 0)
								{
									continue;
								}
							}
							else if($hmk == 'event_section')
							{
								if(!isset($wedding_id)) continue;

								$event_result = $this->Common_model->commonQuery("select * from wedding_event
																	where wedding_id = $wedding_id
																	ORDER BY event_id ASC");
								if($event_result->num_rows() == 0)
								{
									continue;
								}
							}
							else if($hmk == 'people_section')
							{
								if(!isset($wedding_id)) continue;

								$groomsmen_relatives = $this->Common_model->commonQuery("select r.*,re.title as relation_title from `wedding_relatives` as r 
																				left join wedding_relations as re on re.rel_id = r.relation
																				where r.type = 'Groomsmen' and r.status = 'Y'
																				and r.wedding_id = $wedding_id
																				 order by r.r_id DESC ");

								$bridesmaid_relatives = $this->Common_model->commonQuery("select r.*,re.title as relation_title from `wedding_relatives` as r 
																				left join wedding_relations as re on re.rel_id = r.relation
																				where r.type = 'Bridesmaid' and r.status = 'Y'
																				and r.wedding_id = $wedding_id
																				 order by r.r_id DESC ");
								if($groomsmen_relatives->num_rows() == 0 && $bridesmaid_relatives->num_rows() == 0)
								{
									continue;
								}
							}
							else if($hmk == 'gallery_section')
							{
								if(!isset($wedding_id)) continue;
								$gallery = $this->Common_model->commonQuery("select wg1.image_name as org,wg2.image_name as med,wg1.image_path from wedding_gallery wg1 INNER JOIN wedding_gallery wg2 on wg2.parent_image_id = wg1.image_id and wg2.image_type = 'medium' WHERE wg1.image_type='original'
								and wg2.wedding_id=$wedding_id
								");
								if($gallery->num_rows() == 0)
								{
									continue;
								}
							}
							else if($hmk == 'rsvp_section')
							{
								
							}
							else if($hmk == 'gift_section')
							{
								if(!isset($wedding_id) || !isset($wedding_user_id)) continue;
								$user_gifts = $this->global_lib->get_user_meta($wedding_user_id,'my_gifts');
								if($user_gifts){
									$user_gifts = json_decode($user_gifts,true);
									
								}else $user_gifts = array();

								$gift_lists = array();
								foreach($user_gifts as $k => $gift){
									$gift_lists [] = $k;	
									
								}
								if(empty($gift_lists))
									continue;
								$gifts = $this->Common_model->commonQuery("select * from wedding_gifts where gift_id in (".implode(",",$gift_lists).")");
								if($gifts->num_rows() == 0)
								{
									continue;
								}
							}
							else if($hmk == 'blog_section')
							{
								$today_timestamp = mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
								$blogs = $this->Common_model->commonQuery("select b.* from blogs as b
								left join blog_categories as bc on bc.c_id = b.cat_id
								where b.status = 'publish' and b.publish_on <= $today_timestamp");
								if($blogs->num_rows() == 0)
								{
									continue;
								}
							}
							
						    $sec_short_name = ucwords(str_replace('_section','',$hmk));
							$sec_tag_name = ucwords(str_replace('_',' ',$sec_short_name));
						    
						    $active_class = '';
						    if($class == 'home' && $func == 'home')
						    {
								$active_class = 'active'; 
						    }
							
						  
					  ?>
						<li class="<?php echo $active_class; ?>">
							<a href="<?php echo $hmv['section_link']; ?>"><?php echo mlx_get_lang($sec_tag_name); ?></a>
						</li>
						<?php  }} ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>
