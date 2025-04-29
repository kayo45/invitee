<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();

?>	  
	  
      <div class="content-wrapper">
        <section class="content-header">
          <h1><?php echo mlx_get_lang('Edit Event'); ?> </h1>
          
        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('event/edit',$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
			<div class="row">
			<div class="col-md-8">   
			   
			<div class="box box-primary">
				
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo mlx_get_lang('Event Details'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				 </div>
                </div>
				
                  <div class="box-body">
                    
					
					<?php if( form_error('event_title')) 	  { 	echo form_error('event_title'); 	  } ?>
					<?php if( form_error('event_date')) 	  { 	echo form_error('event_date'); 	  } ?>
					<?php if( form_error('event_time')) 	  { 	echo form_error('event_time'); 	  } ?>
					<?php if( form_error('event_venue')) 	  { 	echo form_error('event_venue'); 	  } ?>
					<?php if( form_error('contact_number'))   { 	echo form_error('contact_number'); 	  } ?>
					
					<div class="row">
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Event Title'); ?> <span class="required">*</span></label>
							  <input type="text" class="form-control"  name="event_title" id="event_title" required
							  value="<?php if(isset($_POST['event_title'])) 
												echo $_POST['event_title'];
											else{
												echo $row->event_title;
											}
									 ?>">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="event_place">Placement <span class="required">*</span></label>
								<select class="form-control" id="event_place" name="event_place" style="width: 100%" required>
									<option value="<?php if(isset($_POST['event_place'])) echo $_POST['event_place']; else echo $row->event_place; ?>"><?php if(isset($_POST['event_place'])) echo '--'.$_POST['event_place'].'--'; else echo '-- Selected '.$row->event_place.' --'; ?></option>
									<option value="akad">Akad</option>
									<option value="resepsi">Resepsi</option>
									<option value="event">Event Lainnya</option>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Event Date'); ?> <span class="required">*</span></label>
							  <div class="input-group">
								  <input type="text" class="form-control datepicker_elem"  name="event_date" id="event_date" required
								  value="<?php if(isset($_POST['event_date'])){ 
												echo $_POST['event_date'];
											}else if($row->event_date != ''){
												echo date('m/d/Y',$row->event_date);
											}
											else 
											{
												echo date('m/d/Y',time());
											}
									 ?>" autocomplete="off">
									<div class="input-group-addon">
								  <i class="fa fa-calendar"></i>
								</div>
							  </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Event Time'); ?> <span class="required">*</span></label>
							  <div class="input-group bootstrap-timepicker timepicker">
								  <input type="text" class="form-control timepicker_elem"  name="event_time" id="event_time" required
								  value="<?php if(isset($_POST['event_time'])) 
												echo $_POST['event_time'];
											else{
												echo $row->event_time;
											}
									 ?>" >
									<div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Event Venue'); ?> <span class="required">*</span></label>
							  <textarea class="form-control"  name="event_venue" id="event_venue" ><?php if(isset($_POST['event_venue'])) echo $_POST['event_venue'];else echo $row->event_venue; ?></textarea>
							  
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Contact Number'); ?> <span class="required">*</span></label>
							  <input type="text" class="form-control"  name="contact_number" id="contact_number" required
							  value="<?php if(isset($_POST['contact_number'])) echo $_POST['contact_number']; else echo $row->contact_number; ?> " >
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="openstreetmap_embed_code"><?php echo mlx_get_lang('Open Street Map Embed Code URL'); ?></label>
							  <textarea class="form-control openstreetmap_embed_code"  name="openstreetmap_embed_code" id="openstreetmap_embed_code"><?php if(isset($_POST['openstreetmap_embed_code'])) echo $_POST['openstreetmap_embed_code']; else if(isset($row->openstreetmap_embed_code)) echo $row->openstreetmap_embed_code; ?></textarea>
							</div>
						</div>
					</div>
						
				</div>	
					
			<div>
                    
                  </div>
                
              </div>
			  
			 
		  </div>
		  
		  <div class="col-md-4">
		  <div class="box box-primary">
			  <div class="box-header with-border">
                  <h3 class="box-title"> <?php echo mlx_get_lang('Status'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					
				  </div>
                </div>
				<div class="box-body">
						<label for="FirstName"><?php echo mlx_get_lang('Image'); ?></label>
						<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/event/',$row->event_image,'thumb'); ?>
						<div class="form-group pl_image_container">
							<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $id; ?>" data-type="event" id="pl_file_uploader_1" 
							<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
								<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
							</label>
							<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
							<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
								<a class="pl_file_link" href="<?php echo base_url().'../uploads/event/'.$row->event_image; ?>" 
								download="<?php echo $row->event_image; ?>" style="">
									<img src="<?php echo base_url().'../uploads/event/'.$thumb_photo; ?>" >
								</a>
								<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
							<?php }else{ ?>
								<a class="pl_file_link" href="" download="" style="display:none;">
									<img src="" >
								</a>
								<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
							<?php } ?>
							<input type="hidden" name="event_image" 
							value="<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo $row->event_image;}?>" 
							class="pl_file_hidden">
						</div>

				</div>
				
				 <div class="box-footer">
					<button name="submit" type="submit" class="btn btn-primary pull-right" id="save_publish"><?php echo mlx_get_lang('Save Publish'); ?></button>
                  </div>
			  </div>  
		  </div>
		  </div>
		</form>
        </section>
      </div>
      