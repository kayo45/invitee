<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-home"></i> <?php echo mlx_get_lang('Homepage Sections'); ?></h1>
	  <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
			{
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
	?> 
	</section>

	<section class="content">
		<?php 
		$attributes = array('name' => 'add_form_post','class' => 'homepage_section_form form');		 			
		echo form_open_multipart('main/home_page',$attributes); ?>
		<div class="row">
			<div class="col-md-12">
			
				<div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?> homepage_section_container" >
					<div class="box-body">
					  <?php 
					  
					  if(isset($content_sections) && !empty($content_sections)) { 
					  if(isset($meta_content_lists) && !empty($meta_content_lists))
					  {
							$old_content_sections = $content_sections;  
							$content_sections = array();
							foreach($meta_content_lists as $k=>$v)
							{
								if(isset($old_content_sections[$k]))
								{
									$content_sections[$k] = $old_content_sections[$k];
									unset($old_content_sections[$k]);
								}
								
							}
							if(!empty($old_content_sections))
							{
								foreach($old_content_sections as $k=>$v)
								{
									$content_sections[$k] = $old_content_sections[$k];
									unset($old_content_sections[$k]);
								}
							}
					  }
					  
					  $new_content_section = array();
					  if(array_key_exists('slider_section',$content_sections))
					  {
						  $new_content_section['slider_section'] = $content_sections['slider_section'];
						  unset($content_sections['slider_section']);
					  }
					  if(array_key_exists('search_section',$content_sections))
					  {
						  $new_content_section['search_section'] = $content_sections['search_section'];
						  unset($content_sections['search_section']);
					  }
					  
					  if(array_key_exists('recent_blog_section',$content_sections))
					  {
						  $site_plugins_json = $myHelpers->global_lib->get_option('site_plugins');  
				  
						  if(!empty($site_plugins_json))
						  {
								$site_plugins = json_decode($site_plugins_json,true);
								if(!in_array('blog', $site_plugins)) {
									unset($content_sections['recent_blog_section']);
								}
						  }
						  else
						  {
							  unset($content_sections['recent_blog_section']);
						  }
					  }
					  
					  $content_sections = array_merge($new_content_section,$content_sections);
					  
					  ?>
					  <ul class="todo-list ui-sortable">
							<?php 
							
								$manage_contents = array();
							
							foreach($content_sections as $content_section_key=>$content_section_value){ 
								$section_fields = $myHelpers->config->item($content_section_key."_fields") ;
								
								$sec_key = str_replace('_section','',$content_section_key);
								
								$has_val_saved = false;
								if(isset($meta_content_lists) && isset($meta_content_lists[$content_section_key]))
								{
									$has_val_saved = true;
									foreach($meta_content_lists[$content_section_key] as $csk=>$csv)
									{
										${$csk} = $csv;
									}
								}	
								$section_cls = '';
								if($content_section_key == 'slider_section' || $content_section_key == 'search_section')
									$section_cls = 'fixed-section';
							?>
							<li class="<?php echo $section_cls; ?>">
								<div class="header-block">
								  <span class="handle ui-sortable-handle">
									<i class="fa fa-ellipsis-v"></i>
									<i class="fa fa-ellipsis-v"></i>
								  </span>
								  <span class="text"><?php echo mlx_get_lang(ucfirst($content_section_value['title'])); ?></span>
								  
								   <div class="radio_toggle_wrapper pull-right">
									<input type="radio" 
									<?php if((isset($is_enable) && $is_enable == 'Y') || !isset($is_enable)) { ?>
									checked="checked" 
									<?php } ?>
									id="<?php echo $content_section_key; ?>_enable" value="Y" 
									name="<?php echo $content_section_key; ?>[is_enable]" class="toggle-radio-button">
									<label for="<?php echo $content_section_key; ?>_enable"><?php echo mlx_get_lang('Enable'); ?></label>
									
									<input type="radio" id="<?php echo $content_section_key; ?>_disable" value="N" 
									<?php if(isset($is_enable) && $is_enable == 'N') { ?>
									checked="checked" 
									<?php } ?>
									name="<?php echo $content_section_key; ?>[is_enable]" class="toggle-radio-button">
									<label for="<?php echo $content_section_key; ?>_disable"><?php echo mlx_get_lang('Disable'); ?></label>
								  </div>
							  
								  <?php if(!empty($section_fields)) { ?>
								  <div class="tools">
									<button class="btn btn-box-tool collapsed" ><i class="fa fa-chevron-down"></i></button>
								  </div>
								  <?php } ?>
								</div>
							  <?php if(!empty($section_fields)) { ?>
							  <div class="section_fields hide">
								  <?php 
								   global $single_field,$content_type;
									$content_type = $content_section_key;
									
									foreach($section_fields as $k => $single_field){
										
										if(isset($single_field['name']) && isset(${$single_field['name']}) && $has_val_saved)
										{
											global $meta_content;
											$meta_content[$single_field['name']] = ${$single_field['name']};
										}
										else
										{
											global $meta_content;
											$meta_content = array();
										}
										$this->load->view("$theme/templates/templ-".$single_field['type'] ); 
									}
								  ?>
							  </div>
							  <?php } ?>
							</li>
						<?php } ?>
					  </ul>
					  <?php } ?>
					</div>
					<div class="box-footer">
						 <button type="submit" name="submit" class="btn btn-<?php echo $myHelpers->global_lib->get_skin_class(); ?> pull-right submit-section-btn"><?php echo mlx_get_lang('Save'); ?></button>
					  </div>
				  </div>
			</div>
		
		</div>
		</form>
	</section>
</div>