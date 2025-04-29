<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
if(isset($options_list) && $options_list->num_rows()>0)
{
	foreach($options_list->result() as $row)
	{
		${$row->option_key} = $row->option_value;
	}
}
?>
<script>
$(window).on('load', function () {
	var hash = window.location.hash;
	setTimeout(function(){
		if (hash) {
			hash = hash.replace('#',''); 
			$('#'+hash).find('.box-tools .btn-box-tool').trigger('click');
		}
	},100);
});
</script>
      <div class="content-wrapper">
       <section class="content-header">
          <h1 class="page-title"><i class="fa fa-cog"></i> <?php echo mlx_get_lang('General Settings'); ?> </h1>
          <?php echo validation_errors(); 
			if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
			{
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			?>
        </section>

        <section class="content setting-section">
		   <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('settings/general_settings',$attributes); 
			
			?>
			<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">	
			<div class="row">
			<div class="col-md-8">   
			   
			<div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?> collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo mlx_get_lang('General Settings'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
                </div>
				  <div class="box-body">
                	<div class="form-group">
                      <label for="website_title"><?php echo mlx_get_lang('Website Title'); ?></label>
                      <input type="text" class="form-control" 
					  name="options[website_title]" id="website_title" value="<?php if(isset($website_title)) echo $website_title; ?>">
                    </div>
					
					<div class="form-group">
                      <label for="website_logo_text"><?php echo mlx_get_lang('Website Logo Text'); ?></label>
                      <input type="text" class="form-control" 
					  name="options[website_logo_text]" id="website_logo_text" value="<?php if(isset($website_logo_text)) echo $website_logo_text; ?>">
                    </div>
					
					<div class="row">				
						<div class="col-md-6">
							<div class="form-group">					  
								<label for="exampleInputFile" style="display: block;"><?php echo mlx_get_lang('Website Logo'); ?> <small>(400x100)</small></label>						
								
								<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/logo/',$website_logo,'thumb'); ?>
								<div class="form-group pl_image_container">
								<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $myHelpers->global_lib->EncryptClientId($id); ?>" data-type="logo" id="pl_file_uploader_1" 
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
									<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
								</label>
								<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
									<a class="pl_file_link" href="<?php echo base_url().'../uploads/logo/'.$website_logo; ?>" 
									download="<?php echo $website_logo; ?>" style="">
										<img src="<?php echo base_url().'../uploads/logo/'.$thumb_photo; ?>" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
								<?php }else{ ?>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
								<?php } ?>
								<input type="hidden" name="options[website_logo]" value="<?php if(isset($website_logo) && !empty($website_logo)) { echo $website_logo;}?>" 
								class="pl_file_hidden">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">					  
								<label for="exampleInputFile" style="display: block;"><?php echo mlx_get_lang('Fevicon Icon'); ?> <small>(16x16)</small></label>						
								
								<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/fevicon/',$fevicon_icon,'thumb'); ?>
								<div class="form-group pl_image_container">
								<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $myHelpers->global_lib->EncryptClientId($id); ?>" data-type="fevicon" id="pl_file_uploader_2" 
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
									<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
								</label>
								<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
									<a class="pl_file_link" href="<?php echo base_url().'../uploads/fevicon/'.$fevicon_icon; ?>" 
									download="<?php echo $fevicon_icon; ?>" style="">
										<img src="<?php echo base_url().'../uploads/fevicon/'.$thumb_photo; ?>" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
								<?php }else{ ?>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
								<?php } ?>
								<input type="hidden" name="options[fevicon_icon]" value="<?php if(isset($fevicon_icon) && !empty($fevicon_icon)) { echo $fevicon_icon;}?>" 
								class="pl_file_hidden">
								</div>
								
								
							</div>
						</div>
					</div>
					
				</div>
					
              </div>
			
			<div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?> collapsed-box">
				  <div class="box-header with-border">
					  <h3 class="box-title"><?php echo mlx_get_lang('Visual Section Settings'); ?></h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div>
				  </div>
				  
				  <div class="box-body" >
					
					<div class="form-group" >
						<label for="enbale_front_end_registration"><?php echo mlx_get_lang('Enable Front End Registration'); ?></label>
						<br>
						 <div class="radio_toggle_wrapper ">
							<input type="radio" id="enbale_front_end_registration_yes" value="Y" 
							data-target="front_end_reg_yes" data-elem="front_end_reg_elem"
							<?php 
							if(isset($enbale_front_end_registration) && $enbale_front_end_registration == 'Y')  
							{ echo ' checked="checked" '; }
							?> name="options[enbale_front_end_registration]" 
							class="toggle-radio-button show_hide_setting_elem">
							<label for="enbale_front_end_registration_yes"><?php echo mlx_get_lang('Yes'); ?></label>
							
							<input type="radio" id="enbale_front_end_registration_no" 
							data-target="front_end_reg_no" data-elem="front_end_reg_elem"
							<?php 
							if((isset($enbale_front_end_registration) && $enbale_front_end_registration == 'N')|| 
							!isset($enbale_front_end_registration))
							{ echo ' checked="checked" '; }
							?> value="N" name="options[enbale_front_end_registration]" 
							class="toggle-radio-button show_hide_setting_elem">
							<label for="enbale_front_end_registration_no"><?php echo mlx_get_lang('No'); ?></label>
						</div>
					</div> 
					
					<div class="form-group front_end_reg_elem front_end_reg_yes child-form-group" >
						<label for="default_user_status_after_reg_yes"><?php echo mlx_get_lang('Default User Status After Register'); ?></label>
						 <div class="radio_toggle_wrapper ">
							<input type="radio" id="default_user_status_after_reg_yes" value="Y" 
							<?php 
							if(isset($default_user_status_after_reg) && $default_user_status_after_reg == 'Y')  
							{ echo ' checked="checked" '; }
							?> name="options[default_user_status_after_reg]" 
							class="toggle-radio-button">
							<label for="default_user_status_after_reg_yes"><?php echo mlx_get_lang('Active'); ?></label>
							
							<input type="radio" id="default_user_status_after_reg_no" 
							<?php 
							if((isset($default_user_status_after_reg) && $default_user_status_after_reg == 'N')|| 
							!isset($default_user_status_after_reg))
							{ echo ' checked="checked" '; }
							?> value="N" name="options[default_user_status_after_reg]" 
							class="toggle-radio-button">
							<label for="default_user_status_after_reg_no"><?php echo mlx_get_lang('InActive'); ?></label>
						</div>
					</div>
					
					<div class="form-group front_end_reg_elem front_end_reg_yes child-form-group" >
						<label for="enbale_reg_auto_login_yes"><?php echo mlx_get_lang('Enable Auto Login After Register'); ?></label>
						 <div class="radio_toggle_wrapper ">
							<input type="radio" id="enbale_reg_auto_login_yes" value="Y" 
							<?php 
							if(isset($enbale_reg_auto_login) && $enbale_reg_auto_login == 'Y')  
							{ echo ' checked="checked" '; }
							?> name="options[enbale_reg_auto_login]" 
							class="toggle-radio-button">
							<label for="enbale_reg_auto_login_yes"><?php echo mlx_get_lang('Yes'); ?></label>
							
							<input type="radio" id="enbale_reg_auto_login_no" 
							<?php 
							if((isset($enbale_reg_auto_login) && $enbale_reg_auto_login == 'N')|| 
							!isset($enbale_reg_auto_login))
							{ echo ' checked="checked" '; }
							?> value="N" name="options[enbale_reg_auto_login]" 
							class="toggle-radio-button">
							<label for="enbale_reg_auto_login_no"><?php echo mlx_get_lang('No'); ?></label>
						</div>
					</div> 
					
					
					
				</div>
			</div>
			
		  <div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?> collapsed-box">
			  <div class="box-header with-border">
				  <h3 class="box-title"><?php echo mlx_get_lang('Admin Settings'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
			  </div>
			  <div class="box-body">
				
				
				<div class="form-group">
				  <label for="skins"><?php echo mlx_get_lang('Admin Skins'); ?></label>
				  <input type="hidden" name="options[skin]" class="option_skin" value="<?php if(isset($skin)) echo $skin; ?>">
				  <div class="skin-container row">
					 <ul class="list-unstyled clearfix ">
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-blue" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" 
							class="clearfix <?php if((!isset($skin)) || (isset($skin) && $skin == 'skin-blue')) echo ''; else echo 'full-opacity-hover'; ?>">
								<div>
									<span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span>
									<span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							</a>
							<p class="text-center"><?php echo mlx_get_lang('Blue'); ?></p>
						</li>
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-black" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-black') echo ''; else echo 'full-opacity-hover'; ?>">
								<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix">
									<span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span>
									<span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #222;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							</a>
							<p class="text-center"><?php echo mlx_get_lang('Black'); ?></p>
						</li>
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-purple" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-purple') echo ''; else echo 'full-opacity-hover'; ?>">
								<div>
									<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span>
									<span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							</a>
							<p class="text-center"><?php echo mlx_get_lang('Purple'); ?></p>
						</li>
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-green" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-green') echo ''; else echo 'full-opacity-hover'; ?>">
								<div>
									<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span>
									<span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							</a>
							<p class="text-center"><?php echo mlx_get_lang('Green'); ?></p>
						</li>
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-red" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-red') echo ''; else echo 'full-opacity-hover'; ?>">
								<div>
									<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span>
									<span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							</a>
							<p class="text-center"><?php echo mlx_get_lang('Red'); ?></p>
						</li>
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-yellow" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-yellow') echo ''; else echo 'full-opacity-hover'; ?>">
								<div>
									<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span>
									<span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							</a>
							<p class="text-center"><?php echo mlx_get_lang('Yellow'); ?></p>
						</li>
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-blue-light" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-blue-light') echo ''; else echo 'full-opacity-hover'; ?>">
								<div>
									<span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span>
									<span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							</a>
							<p class="text-center no-margin" ><?php echo mlx_get_lang('Blue Light'); ?></p>
						</li>
						<li class="col-md-2">
							<a href="javascript:void(0);" data-skin="skin-black-light" 
							style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-black-light') echo ''; else echo 'full-opacity-hover'; ?>">
								<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix">
									<span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span>
									<span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span>
								</div>
								<div>
									<span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span>
									<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
								</div>
							 </a>
							 <p class="text-center no-margin" ><?php echo mlx_get_lang('Black Light'); ?></p>
							</li>
							<li class="col-md-2">
								<a href="javascript:void(0);" data-skin="skin-purple-light" 
								style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-purple-light') echo ''; else echo 'full-opacity-hover'; ?>">
									<div>
										<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span>
										<span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span>
									</div>
									<div>
										<span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span>
										<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
									</div>
								 </a>
								 <p class="text-center no-margin" ><?php echo mlx_get_lang('Purple Light'); ?></p>
							</li>
							<li class="col-md-2">
								<a href="javascript:void(0);" data-skin="skin-green-light" 
								style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-green-light') echo ''; else echo 'full-opacity-hover'; ?>">
									<div>
										<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span>
										<span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span>
									</div>
									<div>
										<span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span>
										<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
									</div>
								</a>
								<p class="text-center no-margin" ><?php echo mlx_get_lang('Green Light'); ?></p>
							</li>
							<li class="col-md-2">
								<a href="javascript:void(0);" data-skin="skin-red-light" 
								style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-red-light') echo ''; else echo 'full-opacity-hover'; ?>">
									<div>
										<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span>
										<span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span>
									</div>
									<div>
										<span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span>
										<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
									</div>
								</a>
								<p class="text-center no-margin" ><?php echo mlx_get_lang('Red Light'); ?></p>
							</li>
							<li class="col-md-2">
								<a href="javascript:void(0);" data-skin="skin-yellow-light" 
								style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix <?php if(isset($skin) && $skin == 'skin-yellow-light') echo ''; else echo 'full-opacity-hover'; ?>">
									<div>
										<span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span>
										<span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span>
									</div>
									<div>
										<span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span>
										<span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
									</div>
								</a>
								<p class="text-center no-margin" ><?php echo mlx_get_lang('Yellow Light'); ?></p>
							</li>
						</ul>
				  </div>
				</div>
			  </div>
		</div>
			
			
			
		  </div>
		  
			  <div class="col-md-4">
				<div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?> sticky_sidebar">
				  <div class="box-header with-border">
					  <h3 class="box-title"><?php echo mlx_get_lang('Status'); ?></h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					  </div>
					</div>
					 
					 <div class="box-footer">
						<button name="submit" type="submit" class="btn btn-<?php echo $myHelpers->global_lib->get_skin_class(); ?> pull-right" id="save_publish"><?php echo mlx_get_lang('Save Changes'); ?></button>
					  </div>
				  </div>
			  </div>
		  
		  
		  </div>
		  
			</form>
        </section>
      </div>
