 <div class="footer">
	   <div class="full_width_centered">
       <?php 
	   
	   $social_media = $myHelpers->global_lib->get_option('social_media'); 
	   if(isset($social_media) && !empty($social_media)) { 
				$social_media_array = json_decode($social_media,true);
				
	   }
	   ?>
       <div class="footer_socials">
       <ul>
	   <?php 
					foreach($social_media_array as $k=>$v) { 
						if(!isset($v['enable']) || (isset($v['enable']) && $v['enable'] != 1 ))
							continue;
					?>
						<li><a class="" href="<?php echo $v['url']; ?>" target="_blank"><img src="<?php echo base_url().'application/views/'.$theme.'/theme/images/'.str_replace('fa-','',$v["icon"]).'.png';?>"  /></a></li>
					<?php } ?>
      
       </ul>
       </div>
       <nav class="footer_menu">
	   
       <ul>
	   <?php $footer_menu = $myHelpers->global_lib->get_option('footer_menu'); 
				  if(isset($footer_menu) && !empty($footer_menu)) {
				  $menu_meta = json_decode($footer_menu,true);
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
						  }
						  $p_url = $myHelpers->menu_lib->get_url($menu_slug);
						  
						  
					  }
					  else if($menu_type == 'page')
					  {
						  $page_slug = $myHelpers->global_lib->get_page_slug_by_id($menu_slug);
						  $p_url = $myHelpers->menu_lib->get_url('page='.$page_slug); 
					  }
					  else if($menu_type == 'custom_link')
					  {
						  $p_url = $menu_slug; 
					  }
				  ?>
						<li class="<?php echo $active_class; ?>">
							<a href="<?php echo $p_url; ?>"><?php echo mlx_get_lang($hmv['name']); ?></a>
						</li>
				  <?php
				  }}else{
				  ?>
			   <li><a href="<?php echo base_url(); ?>" >HOME</a></li>
			   <li><a href="#">THE WEDDING</a></li>
			   <li><a href="#">RSVP</a></li>
			   <li><a href="#">GET IN TOUCH</a></li>
			   <?php } ?>
       
       </ul>
       </nav>
      </div>
   </div>
			
        </footer>
        


    </div>
    
	
<?php echo script_tag("application/views/$theme/theme/js/bootstrap.min.js"); ?>
<?php echo script_tag("application/views/$theme/theme/js/jquery-plugin-collection.js"); ?>
<?php echo script_tag("application/views/$theme/theme/js/script.js"); ?>
<?php echo script_tag("application/views/$theme/theme/js/custom-scripts.js");?>
<?php echo script_tag("application/views/$theme/theme/plugins/bootstrap_switch_button/switch.js");?>

</body>
</html>
