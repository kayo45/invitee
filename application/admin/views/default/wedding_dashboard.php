<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left"); ?>
<?php $user_type = $this->session->userdata('user_type'); ?>
<div class="content-wrapper">
	<section class="content-header">
	<h1 class="page-title"><i class="fa fa-dashboard"></i> <?php echo mlx_get_lang('Dashboard'); ?></h1>
	<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
			{
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
	?> 
	</section>
	<section class="content">
		<?php 
		if($user_type == 'admin')
		{
			
		}
		else
		{
			
		
		$attributes = array('name' => 'add_form_post','class' => 'dashboard-form form');		 			
		echo form_open_multipart('main/dashboard',$attributes); ?>
			<input type="hidden" name="cur_tab" value="<?php if(isset($step)) echo $step; ?>">
		<div class="row">
			<div class="col-md-12">
				
				<div class="box box-primary dashboard-section">
					<div class="box-header with-border">
						<div class="step-wizard" role="navigation">
							<div class="progress">
							<div class="progressbar empty"></div>
							<div id="prog" class="progressbar"></div>
							</div>
							<ul>
							<li class="active">
								<button id="step1">
								<div class="step">1</div>
								<div class="title">Informasi Pernikahan</div>
								</button>
							</li>
							<li class="">
								<button id="step2">
								<div class="step">2</div>
								<div class="title">Mempelai Pria</div>
								</button>
							</li>
							<li class="">
								<button id="step3">
								<div class="step">3</div>
								<div class="title">Mempelai Wanita</div>
								</button>
							</li>
							<li class="">
								<button id="step4">
								<div class="step">4</div>
								<div class="title">Detail Pernikahan</div>
								</button>
							</li>
							<li class="">
								<button id="step5">
								<div class="step">5</div>
								<div class="title">Complete Setup</div>
								</button>
							</li>
							</ul>
						</div>
					</div>
					<div class="box-body">
					
						<div class="step1 tab-block" style="display:none;">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php 
										$site_name_pre = $site_name_post = '';
										if(isset($row->site_name) && !empty($row->site_name)){
											$sn_exp = explode('-weds-',$row->site_name);
											$site_name_pre = $sn_exp[0];
											$site_name_post = $sn_exp[1];
										} 
										$wedding_row_set = false;
										if(isset($row))
											$wedding_row_set = true;
										?>
										<label for="site_name" >Alamat web Anda</label>
										<div class="input-group wedding_site_name_block">
											<input type="text" class="form-control site_name_pre" id="site_name" value="<?php if(isset($wedding_row_set)) echo $site_name_pre; ?>">
											<div class="input-group-addon">
												&nbsp;&nbsp;- weds -&nbsp;&nbsp;
											</div>
											<input type="text" class="form-control site_name_post" value="<?php if(isset($row)) echo $site_name_post; ?>">
										<input type="hidden"  class="form-control" name="site_name" value="<?php if(isset($row)) echo $row->site_name; ?>" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="wedding_title" >Judul Pernikahan</label>
										<input type="text"  class="form-control " id="wedding_title" name="wed_title" value="<?php if(isset($row)) echo $row->wedding_title; ?>"/>							  
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="col-md-6">
								
									<div class="form-group">
										<label for="wedding_date" >Tanggal Pernikahan</label>
										<div class="input-group bootstrap-timepicker timepicker">
											<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</div>  
										<input type="text" autocomplete="off" class="form-control datepicker_elem" id="wedding_date" name="wed_date" value="<?php if(isset($row)) echo date('m/d/Y',$row->wedding_date); else echo date('m/d/Y');  ?>" />							  
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="wedding_time" >Waktu Pernikahan</label>
										<div class="input-group bootstrap-timepicker timepicker">
											<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
											</div>
											<input type="text" class="form-control timepicker_elem" name="wedding_time" id="wedding_time" value="<?php if(isset($row)) echo $row->wedding_time; ?>">
										</div>
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="wedding_venue" >Lokasi Pernikahan</label>
										<div class="input-group bootstrap-timepicker timepicker">
											<div class="input-group-addon">
											<i class="fa fa-map-marker"></i>
											</div>
										<input type="text"  class="form-control" id="wedding_venue" name="wedding_venue" value="<?php if(isset($row)) echo $row->wedding_venue; ?>"/>							  
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="wedding_side" >Pilih tampilan awal</label>
										<select  class="form-control select2_elem" id="wedding_side" name="wedding_side"/>
											<option value="groom" <?php if(isset($row->wedding_side) && $row->wedding_side == 'groom') echo 'selected="selected"'; ?>>Mempelai Pria</option>
											<option value="bride" <?php if(isset($row->wedding_side) && $row->wedding_side == 'bride') echo 'selected="selected"'; ?>>Mempelai Wanita</option>
										</select> 
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="wedding_status">Pilih Status</label>
										<select  class="form-control select2_elem" id="wedding_status" name="wedding_status"/>
											<option value="Getting-Married" <?php if(isset($row->wedding_status) && $row->wedding_status == 'Getting-Married') echo 'selected="selected"'; ?>>Pernikahan <i>(Wedding)</i></option>
											<option value="Got-Married" <?php if(isset($row->wedding_status) && $row->wedding_status == 'Got-Married') echo 'selected="selected"'; ?>>Tunangan <i>(Engagement)</i></option>
										</select> 
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="step2 tab-block" style="display:none;">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="groom_name" style="display: block;">Nama Mempelai Pria</label>
										<input type="text" id="groom_name" class="form-control on-change-cls" 
										data-target="groom_name_container" name="groom_name" value="<?php  if(isset($row)) echo $row->groom_name; ?>"/>
									</div>
									
									<div class="form-group">
										<label for="groom_tag_line" style="display: block;">TagLine</label>
										<input type="text" id="groom_tag_line" class="form-control on-change-cls" 
										data-target="groom_tag_line_container" name="groom_tag_line" value="<?php if(isset($row)) echo $row->groom_tag_line; ?>" placeholder="contoh: #Wedding"/>
									</div>
									
									<div class="form-group">
										<label for="groom_signature" style="display: block;">Signature</label>
										<input type="text" id="groom_signature" class="form-control" name="groom_signature" value="<?php if(isset($row)) echo $row->groom_signature; ?>" placeholder="contoh: #Wedding"/>
									</div>
									
									<div class="form-group">
										<label for="groom_short_description" style="display: block;">Deskripsi Mempelai Pria</label>
										<textarea id="groom_short_description" class="form-control on-change-cls" 
										data-target="groom_short_description_container" name="groom_short_description" rows="3" col="5"><?php if(isset($row)) echo $row->groom_short_description; ?></textarea>
									</div>

									<div class="social-media-container form-group">
										<label for="exampleInputFile" style="display: block;">Sosial Media</label>
										<?php  if(isset($social_medias)){ foreach($social_medias as $k=>$v){?>
											<div class="input-group">
												<div class="input-group-addon ">
													<i class="fa fa-<?php echo $k; ?> btn-<?php echo $k; ?>"></i>
												</div>
												<input type="text" class="form-control " autocomplete="off"  
												name="groom_links[<?php echo $k; ?>]" 
												value="<?php if(isset($groom_links) && array_key_exists($k,$groom_links)) echo $groom_links[$k]; ?>"/>
											</div>
										<?php } } ?>
									</div>
									
								</div>
								
								<?php 
								if(isset($row))
									$groom_photo = $myHelpers->global_lib->get_image_type('../uploads/weddings/',$row->groom_photo,'thumb');
								?>
								
							<div class="col-md-6">
									<div class="form-group pl_image_container">
									<label for="groom_image" style="display: block;">Foto Mempelai Pria</label>
								<label class="custom-file-upload" 
								data-element_column="groom_photo" 
								data-element_id="<?php if(isset($row->id) && !empty($row->id))  echo $myHelpers->EncryptClientId($row->id);; ?>" 
								data-type="weddings" id="pl_file_uploader_1" 
								<?php if(isset($groom_photo) && !empty($groom_photo)) { echo 'style="display:none;"';}?>>
									<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
								</label>
								<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
								<?php 
									
								if(isset($groom_photo) && !empty($groom_photo)) { ?>
									<a class="pl_file_link" href="<?php echo base_url().'../uploads/weddings/'.$row->groom_photo; ?>" 
									download="<?php echo $row->groom_photo; ?>" style="">
										<img src="<?php echo base_url().'../uploads/weddings/'.$groom_photo; ?>" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
								<?php }else{ ?>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
								<?php } ?>
								<input type="hidden" name="groom_photo" value="<?php if(isset($groom_photo) && !empty($groom_photo)) { echo $row->groom_photo;}?>" 
								class="pl_file_hidden">
								</div>
								
								<?php 
								if(isset($row))
									$groom_photo_bg = $myHelpers->global_lib->get_image_type('../uploads/weddings/',$row->groom_photo_bg,'thumb');
								?>

								<hr>
									<div class="form-group pl_image_container">
											<label for="groom_photo_bg" style="display: block;">Foto Background Mempelai Pria</label>
										<label class="custom-file-upload" 
										data-element_column="groom_photo_bg" 
										data-element_id="<?php if(isset($row->id) && !empty($row->id))  echo $myHelpers->EncryptClientId($row->id);; ?>" 
										data-type="weddings" id="pl_file_uploader_12" 
										<?php if(isset($groom_photo_bg) && !empty($groom_photo_bg)) { echo 'style="display:none;"';}?>>
											<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
										</label>
										<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
										<?php 
											
										if(isset($groom_photo_bg) && !empty($groom_photo_bg)) { ?>
											<a class="pl_file_link" href="<?php echo base_url().'../uploads/weddings/'.$row->groom_photo_bg; ?>" 
											download="<?php echo $row->groom_photo_bg; ?>" style="">
												<img src="<?php echo base_url().'../uploads/weddings/'.$groom_photo_bg; ?>" >
											</a>
											<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
										<?php }else{ ?>
											<a class="pl_file_link" href="" download="" style="display:none;">
												<img src="" >
											</a>
											<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
										<?php } ?>
										<input type="hidden" name="groom_photo_bg" value="<?php if(isset($groom_photo_bg) && !empty($groom_photo_bg)) { echo $row->groom_photo_bg;}?>" 
										class="pl_file_hidden">
									</div>
									
									
								</div>
								
							</div>
						</div>
						
						<div class="step3 tab-block" style="display:none;">
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="bride_name" style="display: block;">Nama Mempelai Wanita</label>
										<input type="text" id="bride_name" class="form-control on-change-cls" 
										data-target="bride_name_container" name="bride_name" value="<?php if(isset($row)) echo $row->bride_name; ?>" placeholder="contoh: #Wedding"/>
									</div>
									
									<div class="form-group">
										<label for="bride_tag_line" style="display: block;">TagLine</label>
										<input type="text" id="bride_tag_line" class="form-control on-change-cls" 
										data-target="bride_tag_line_container" name="bride_tag_line" value="<?php if(isset($row)) echo $row->bride_tag_line; ?>" placeholder="contoh: #Wedding"/>
									</div>
									
									<div class="form-group">
										<label for="bride_signature" style="display: block;">Signature</label>
										<input type="text" id="bride_signature" class="form-control" name="bride_signature" value="<?php if(isset($row)) echo $row->bride_signature; ?>"/>
									</div>
									
									<div class="form-group">
										<label for="bride_short_description" style="display: block;">Deskripsi Mempelai Wanita</label>
										<textarea class="form-control on-change-cls" id="bride_short_description" 
										data-target="bride_short_description_container"  name="bride_short_description" rows="3" col="5"><?php  if(isset($row)) echo $row->bride_short_description; ?></textarea>
									</div>

									<?php if(isset($social_medias)){ ?>
									<div class="social-media-container form-group">
										<label for="exampleInputFile" style="display: block;">Sosial Media</label>
										<div class="social-links">
										<?php 
										
											foreach($social_medias as $k=>$v){?>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-<?php echo $k; ?> btn-<?php echo $k; ?>"></i>
										</div>
										<input type="text" class="form-control "  
										name="bride_links[<?php echo $k; ?>]" autocomplete="off"  	
										value="<?php if(isset($bride_links) && array_key_exists($k,$bride_links)) echo $bride_links[$k];  ?>"/>
										</div>
										<?php }	?>
										</div>
									</div>
									<?php }	?>
									
								</div>
								
								<?php 
								if(isset($row))
									$bride_photo = $myHelpers->global_lib->get_image_type('../uploads/weddings/',$row->bride_photo,'thumb');
								?>
								<div class="col-md-6">
									<div class="form-group pl_image_container">
										<label for="bride_image" style="display: block;">Foto Mempelai Wanita</label>
								<label class="custom-file-upload" 
								data-element_column="bride_photo" 
								data-element_id="<?php if(isset($row->id) && !empty($row->id))  echo $myHelpers->EncryptClientId($row->id);; ?>" 
								data-type="weddings" id="pl_file_uploader_2" 
								<?php if(isset($bride_photo) && !empty($bride_photo)) { echo 'style="display:none;"';}?>>
									<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
								</label>
								<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
								<?php 
									
								if(isset($bride_photo) && !empty($bride_photo)) { ?>
									<a class="pl_file_link" href="<?php echo base_url().'../uploads/weddings/'.$row->bride_photo; ?>" 
									download="<?php echo $row->bride_photo; ?>" style="">
										<img src="<?php 
										echo base_url().'../uploads/weddings/'.$bride_photo; ?>" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
								<?php }else{ ?>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
								<?php } ?>
								<input type="hidden" name="bride_photo" value="<?php if(isset($bride_photo) && !empty($bride_photo)) { echo $row->bride_photo;}?>" 
								class="pl_file_hidden">

								</div>
								
								<hr>

								<?php 
								if(isset($row))
									$bride_photo_bg = $myHelpers->global_lib->get_image_type('../uploads/weddings/',$row->bride_photo_bg,'thumb');
								?>
									<div class="form-group pl_image_container">
										<label for="bride_photo_bg" style="display: block;">Foto Background Mempelai Wanita</label>
										<label class="custom-file-upload" 
										data-element_column="bride_photo_bg" 
										data-element_id="<?php if(isset($row->id) && !empty($row->id))  echo $myHelpers->EncryptClientId($row->id);; ?>" 
										data-type="weddings" id="pl_file_uploader_22" 
										<?php if(isset($bride_photo_bg) && !empty($bride_photo_bg)) { echo 'style="display:none;"';}?>>
											<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
										</label>
										<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
										<?php 
											
										if(isset($bride_photo_bg) && !empty($bride_photo_bg)) { ?>
											<a class="pl_file_link" href="<?php echo base_url().'../uploads/weddings/'.$row->bride_photo_bg; ?>" 
											download="<?php echo $row->bride_photo_bg; ?>" style="">
												<img src="<?php 
												echo base_url().'../uploads/weddings/'.$bride_photo_bg; ?>" >
											</a>
											<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
										<?php }else{ ?>
											<a class="pl_file_link" href="" download="" style="display:none;">
												<img src="" >
											</a>
											<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
										<?php } ?>
										<input type="hidden" name="bride_photo_bg" value="<?php if(isset($bride_photo_bg) && !empty($bride_photo_bg)) { echo $row->bride_photo_bg;}?>" 
										class="pl_file_hidden">
								
								
									</div>
								
							</div>
						</div>
					</div>	

						<div class="step4 tab-block" style="display:none;">
							<div class="row">
								<?php if(isset($row) && $row->wedding_side == 'groom'){?>
								<div class="col-md-6 groom">
									<h4>Mempelai Wanita</h4>
									<label for="groom_name" style="display: block;" id="groom_name_container"><?php if(isset($row)) echo $row->groom_name; ?></label>
									<span id="groom_tag_line_container"><?php if(isset($row)) echo $row->groom_tag_line; ?></span><br/>
									<?php if(isset($groom_photo) && !empty($groom_photo) ){ ?>
									<img id="groom_image_container" src="<?php 
										echo base_url().'../uploads/weddings/'.$groom_photo;
										?>" class="groom_img">
									<?php } ?>
									<p id="groom_short_description_container" style="margin-top:10px;"><?php if(isset($row)) echo $row->groom_short_description; ?></p>
							
								</div>
								
								<div class="col-md-6 bride">
									<h4>Mempelai Pria</h4>
									<label for="bride_name" style="display: block;" id="bride_name_container"><?php if(isset($row)) echo $row->bride_name; ?></label>
									<span id="bride_tag_line_container"><?php echo $row->bride_tag_line; ?></span><br/>
									<?php if(isset($bride_photo) && !empty($bride_photo)){ ?>
									<img id="groom_image_container" src="<?php 
										echo base_url().'../uploads/weddings/'.$bride_photo;
										?>" class="bride_img">
									<?php } ?>
									
									
									<p id="bride_short_description_container" style="margin-top:10px;"><?php if(isset($row)) echo $row->bride_short_description; ?></p>
																								
								</div>
								<?php }else{?>
								<div class="col-md-6 bride">
									<h4>Mempelai Wanita</h4>
									<label for="bride_name" style="display: block;" id="bride_name_container"><?php if(isset($row)) echo $row->bride_name; ?></label>
									<span id="bride_tag_line_container"><?php if(isset($row)) echo $row->bride_tag_line; ?></span><br/>
									<?php if(isset($bride_photo) && !empty($bride_photo)){ ?>
									<img id="groom_image_container" src="<?php 
										echo base_url().'../uploads/weddings/'.$bride_photo;
										?>" class="bride_img">
									<?php } ?>
									
									<p id="bride_short_description_container" style="margin-top:10px;"><?php if(isset($row)) echo $row->bride_short_description; ?></p>
								</div>
								
								<div class="col-md-6 groom">
									<h4>Mempelai Pria</h4>
									<label for="groom_name" style="display: block;" id="groom_name_container"><?php if(isset($row)) echo $row->groom_name; ?></label>
									<span id="groom_tag_line_container"><?php if(isset($row)) echo $row->groom_tag_line; ?></span><br/>
									<?php if(isset($groom_photo) && !empty($groom_photo) ){ ?>
									<img id="groom_image_container" src="<?php 
										echo base_url().'../uploads/weddings/'.$groom_photo;
										?>" class="groom_img">
									<?php } ?>
									
									<p id="bride_short_description_container" style="margin-top:10px;"><?php if(isset($row)) echo $row->groom_short_description; ?></p>
							
								</div>
								
								<?php } ?>
							</div>
						</div>
						
						<div class="step5 tab-block" style="display:none;">
						
							<?php 
							$all_set = false;
							
							if(isset($step) && !empty($step) && $step > 3) { $all_set = true; } ?>
							
							<?php if($row->payment_status == 'pending') {?>
								<p class="text-center lead fill-form-block" <?php if(!$all_set) echo 'style="display:none;"'; ?>>Please buy any package to publish your site. <a href="<?php echo base_url(array('packages/my_payments')); ?>">Click Here</a> to select package.</p>
							<?php }else{ ?>
								<p class="text-center lead fill-form-block" <?php if(!$all_set) echo 'style="display:none;"'; ?>>All Set Go Ahead. <?php if(isset($row)) { ?> <a href="<?php echo str_replace('admin/','',base_url()).$row->site_name; ?>" target="_blank">Click here</a> <?php } ?> to View Site</p>
							<?php } ?>
							
							<p class="text-center lead unfill-form-block" <?php if($all_set) echo 'style="display:none;"'; ?>>Please Complete Wedding Details .</p>
							
						</div>
						
					</div>
					<div class="box-footer"  style="display:none;">
					
						<div class="buttons">
							<button class="btn btn-default" id="prev">Prev</button>
							<button name="submit" class="btn btn-primary" id="next">
							<?php if($step == 3){
								echo 'Done';
							}else{
								echo 'Next';
							}?>
							</button>
						</div>
					</div>
				</div>

		</div>
		</form>
	</div>
	<?php } ?>
	</section>
</div>