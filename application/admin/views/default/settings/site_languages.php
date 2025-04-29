<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<div class="content-wrapper">
	<?php 
		$attributes = array('name' => 'add_form_post','class' => 'form site_language_form');		 			
		echo form_open_multipart('settings/site_languages',$attributes); 
	?>
	
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-cog"></i>  <?php echo mlx_get_lang('Site Language'); ?> </h1>
	  
	  <?php echo validation_errors(); 
		if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
		{
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
	</section>
	
	<section class="content">
		<?php 
		if(isset($site_language) && !empty($site_language)){
			$site_language_array = json_decode($site_language,true);
		}
		
		
		$first_language = array(
								'language' => "English~en" ,
								'currency' => "USD" ,
								'direction' => "ltr" ,
								'timezone' => "Asia/Kolkata" ,
								'status' => "enable", 	
								'currency_pos' => 'left',
								'thousand_sep' => ',',
								'decimal_sep' => '.',
								'num_decimals' => '2',
								
								);
								
		if(isset($site_language_array[1]))
			$first_language = $site_language_array[1];
			
		if(!isset($first_language['currency_pos'])) $first_language['currency_pos'] = 'left'; 
		if(!isset($first_language['thousand_sep'])) $first_language['thousand_sep'] = ','; 
		if(!isset($first_language['decimal_sep'])) $first_language['decimal_sep'] = '.'; 
		if(!isset($first_language['num_decimals'])) $first_language['num_decimals'] = '2'; 		
		
		?>
		 
		<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">	
		<div class="row">
			<div class="col-md-12">   
			 
			<div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?>">
					
				  <div class="box-body lang-container">
					
					<div class="single-lang-block <?php if(isset($site_language_array) && count($site_language_array) > 1) echo 'hide'; ?>"> 
						<div class="row">
						<input type="hidden" class="minimal" id="default_lang_1"  name="options[default_language]" value="<?php echo $first_language['language'];?>" >
							<div class="col-md-12">
								<div class="row">
									
									<div class="col-md-4 ">
										<div class="form-group">
										  <label for="language_1"><?php echo mlx_get_lang('Language'); ?> <span class="required">*</span></label>
										  
										  <select name="options[site_language][1][language]"  id="language_1" required class=" select2_elem language_list form-control">
											<?php 
											if(isset($languages) && !empty($languages))
											{
												foreach($languages as $k=>$v)
												{
													
													echo '<option value="'.$v.'~'.$k.'"';
														if($first_language['language'] == $v.'~'.$k )
															echo ' selected="selected" ';
													echo '>'.ucfirst($v).' ('.$k.')</option>';
												}
											}
											?>
										  </select>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
										  <label for="timezone_1"><?php echo mlx_get_lang('Timezone'); ?></label>
										  <?php $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
												$timezone_offsets = array();
												foreach( $timezones as $timezone )
												{
													$tz = new DateTimeZone($timezone);
													$timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
												}

												asort($timezone_offsets);
												$timezone_list = array();
												foreach( $timezone_offsets as $timezone => $offset )
												{
													$offset_prefix = $offset < 0 ? '-' : '+';
													$offset_formatted = gmdate( 'H:i', abs($offset) );

													$pretty_offset = "UTC${offset_prefix}${offset_formatted}";

													$timezone_list[$timezone] = "(${pretty_offset}) $timezone";
												}
										  ?>
											<select class="form-control select2_elem" id="timezone_1" name="options[site_language][1][timezone]">
												  <option value="" selected="selected"><?php echo mlx_get_lang('Select Any Timezone'); ?></option>
												  <?php if($timezone_list) { 
														foreach($timezone_list as $timezonekey=>$timezonevalue) {
														 $timezone_selected = "";
														if($first_language['timezone'] == $timezonekey  )	
															 $timezone_selected = "selected=selected";
														?>
														<option value="<?php echo $timezonekey; ?>" <?php echo $timezone_selected; ?>><?php echo $timezonevalue; ?></option>
												  <?php } } ?>
											</select>
										 </div>
									</div>
									
									
									
									<div class="col-md-4">
										<div class="form-group">
											<label for="direction_1" style="width:100%;"><?php echo mlx_get_lang('Direction'); ?></label>
											 
											 <div class="radio_toggle_wrapper" style="display:inline-block; width:auto;">
												<input type="radio" id="ltr_1" value="ltr" 
												<?php 
												if($first_language['direction'] == 'ltr' )
													echo ' checked="checked" ';
												?> name="options[site_language][1][direction]" 
												class="toggle-radio-button">
												<label for="ltr_1"><?php echo mlx_get_lang('LTR'); ?></label>
												
												<input type="radio" id="rtl_1" 
												<?php 
												if($first_language['direction'] == 'rtl' )
													echo ' checked="checked" ';
												?>
												 value="rtl" name="options[site_language][1][direction]" 
												class="toggle-radio-button">
												<label for="rtl_1"><?php echo mlx_get_lang('RTL'); ?></label>
											</div>
											
											
										</div>	 
									</div>
									
									<div class="clearfix"></div>
									
									<div class="col-md-4">
										<div class="form-group">
										  <label for="currency_1"><?php echo mlx_get_lang('Currency'); ?> <span class="required">*</span></label>
										  <select class="form-control select2_elem"  name="options[site_language][1][currency]" id="currency_1" >
											<?php if(isset($currency_symbols) && !empty($currency_symbols)) {
												foreach($currency_symbols as $k=>$v)
												{
													
													echo '<option value="'.$k.'"';
													if($first_language['currency'] == $k )
														echo ' selected="selected" ';
													echo '>'.$k.' - '.$v.'</option>';
												}
											}
											?>
										  </select>
										</div>
									</div>
									
										<?php
										$currency_positions = array();
										$currency_positions ['left'] = "Left";
										$currency_positions ['left_space'] = "Left with Space";
										$currency_positions ['right'] = "Right";
										$currency_positions ['right_space'] = "Right with Space";
										
										?>

									<div class="col-md-4">
										<div class="form-group">
										  <label for="currency_pos_1"><?php echo mlx_get_lang('Currency Position'); ?></label>
										  <select class="form-control select2_elem" name="options[site_language][1][currency_pos]" 
										  id="currency_pos_1" >
											<?php if(isset($currency_positions) && !empty($currency_positions)) {
												foreach($currency_positions as $k=>$v)
												{
													echo '<option value="'.$k.'"';
													if($first_language['currency_pos'] == $k)
														echo ' selected="selected" ';
													echo '>'.mlx_get_lang($v).'</option>';
												}
											}
											?>
										  </select>
										</div> 
									</div>
									
									<input type="hidden" id="status_enable_1" value="enable" 
										name="options[site_language][1][status]" 
										class="toggle-radio-button">
									
									
									
									<div class="col-md-4">
										<div class="form-group">
										  <label for="thousand_sep_1"><?php echo mlx_get_lang('Thousand Separator for Currecny'); ?></label><br>
										  <input type="text" class="form-control thousand_sep" 
										  name="options[site_language][1][thousand_sep]" id="thousand_sep_1" placeholder="<?php echo mlx_get_lang('Enter Thousand Separator'); ?>" 
										  value="<?php 
										  if(isset($first_language['thousand_sep'])) echo $first_language['thousand_sep']; 
										  else echo ","; ?>">
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
										  <label for="decimal_sep_1"><?php echo mlx_get_lang('Decimal separator for Currecny'); ?></label><br>
										  <input type="text" class="form-control decimal_sep" 
										  name="options[site_language][1][decimal_sep]" id="decimal_sep_1" placeholder="<?php echo mlx_get_lang('Enter Decimal Separator'); ?>" 
										  value="<?php 
										  if(isset($first_language['decimal_sep'])) echo $first_language['decimal_sep']; 
										  else echo "."; ?>">
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
										  <label for="num_decimals_1"><?php echo mlx_get_lang('Number of decimals for Currecny'); ?></label><br>
										  <input type="number" class="form-control num_decimals" step="1"
										  name="options[site_language][1][num_decimals]" id="num_decimals_1" placeholder="<?php echo mlx_get_lang('Enter Number of Decimals'); ?>" 
										  value="<?php 
										  if(isset($first_language['num_decimals'])) echo $first_language['num_decimals']; 
										  else echo "2"; ?>">
										</div>
									</div>
									
									
									
								</div>
							</div>
							
						</div>
					</div>
					
					
				  </div>
				  
				  <div class="box-footer">
					  <label>
						<input type="checkbox" class="minimal" name="remove_old_lang" value="Y">&nbsp;&nbsp;Do you want to remove language file in case of language change.
					  </label>
					  <button name="submit" type="submit" class="btn btn-<?php echo $myHelpers->global_lib->get_skin_class(); ?> pull-right" id="save_publish"><?php echo mlx_get_lang('Save Changes'); ?></button>
				  </div>
				  
			</div>
		  </div>
	    </div>
	</section>
	</form>
</div>

