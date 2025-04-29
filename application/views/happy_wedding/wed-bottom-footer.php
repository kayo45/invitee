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
