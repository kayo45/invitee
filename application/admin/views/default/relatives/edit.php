<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();

$social_medias = array();
$social_medias ['facebook'] = array('placeholder' => 'Enter Facebook Url',
									'type' => 'text', 'title' => 'Facebook', 'fa-icon' => 'fa-facebook',	);
									
$social_medias ['twitter'] = array('placeholder' => 'Enter Twitter Url',
									'type' => 'text', 'title' => 'Twitter', 'fa-icon' => 'fa-twitter',	);

$social_medias ['pinterest'] = array('placeholder' => 'Enter Pinterest Url',
									'type' => 'text', 'title' => 'Pinterest', 'fa-icon' => 'fa-pinterest',	);
									
$social_medias ['instagram'] = array('placeholder' => 'Enter Instagram Url',
									'type' => 'text', 'title' => 'Instagram', 'fa-icon' => 'fa-instagram',	);
									
$social_medias ['youtube'] = array('placeholder' => 'Enter Youtube Url',
									'type' => 'text', 'title' => 'Youtube', 'fa-icon' => 'fa-youtube',	);
									
?>	  
      <div class="content-wrapper">
        <section class="content-header">
          <h1  class="page-title"><i class="fa fa-edit"></i> <?php echo mlx_get_lang('Edit Relative'); ?> </h1>
          
        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('relatives/edit',$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
			<div class="row">
			<div class="col-md-8">   
			   
			<div class="box box-primary">
				
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo mlx_get_lang('Relative\'s Details'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				 </div>
                </div>
				
                  <div class="box-body">
                    
					
					<?php  if( form_error('name')){ 	echo form_error('name'); 	  } ?>
					<?php  if( form_error('type')){ 	echo form_error('type'); 	  } ?>
				
					
					<div class="row">
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="name"><?php echo mlx_get_lang('Name'); ?> <span class="required">*</span></label>
							  <input type="text" class="form-control"  name="name" id="name"  required
							  value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $row->name; ?>">
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="sub_title"><?php echo mlx_get_lang('Sub Title'); ?> </label>
							  <input type="text" class="form-control"  name="sub_title" id="sub_title"
							  value="<?php if(isset($_POST['sub_title'])) echo $_POST['sub_title']; else echo $row->sub_title; ?>">
							</div>
						</div>
						
						<div class="col-md-12">
					
							<div class="form-group">
								<label for="exampleInputFile" style="display: block;">Photo</label>
									<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/relatives/',$row->image,'thumb'); ?>
								<div class="form-group pl_image_container">
								<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $id; ?>" data-type="relatives" id="pl_file_uploader_1" 
									<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
									<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
								</label>
								<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
									<a class="pl_file_link" href="<?php echo base_url().'../uploads/relatives/'.$thumb_photo; ?>" 
									download="<?php echo $row->image; ?>" style="">
										<img src="<?php echo base_url().'../uploads/relatives/'.$thumb_photo; ?>" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
								<?php }else{ ?>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
								<?php } ?>
								<input type="hidden" name="photo" value="<?php if(isset($row->image) && !empty($row->image)) { echo $row->image;}?>" 
								class="pl_file_hidden">
							</div>
							
							
							</div>
							
							
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="type"><?php echo mlx_get_lang('Type'); ?> <span class="required">*</span></label>
							  
							  <div class="radio">
								<label style="padding-left:0px;">
								  <input type="radio" name="type" id="type_gm" value="Groomsmen" class="minimal"  
								  <?php if((isset($row->type) && $row->type == 'Groomsmen') || !isset($row->type)) echo 'checked'; ?>
								  required>
								  &nbsp;Groomsmen
								</label>
							  </div>
							  
							  <div class="radio">
								<label style="padding-left:0px;">
								  <input type="radio" name="type" id="type_bm" value="Bridesmaid" class="minimal" required 
								  <?php if(isset($row->type) && $row->type == 'Bridesmaid') echo 'checked'; ?>>
								  &nbsp;Bridesmaid
								</label>
							  </div>
							  
							</div>
						</div>
						
						<?php if(isset($relation_list) && $relation_list->num_rows() > 0) { ?>
						<div class="col-md-12">
							<div class="form-group">
							  <label for="relation"><?php echo mlx_get_lang('Relation'); ?></label>
							  
							  <?php 
							  foreach($relation_list->result() as $rrow){
							  ?>
							  <div class="radio">
								<label style="padding-left:0px;">
								  <input type="radio" name="relation" 
								  <?php if(isset($row->relation) && $row->relation == $rrow->rel_id) 
									echo 'checked';  
								  ?>
								  id="relation_<?php echo strtolower($rrow->title); ?>" value="<?php echo $rrow->rel_id; ?>" class="minimal">
								  &nbsp;<?php echo ucfirst($rrow->title); ?>
								</label>
							  </div>
							  <?php } ?>
							</div>
						</div>
						<?php } ?>	
					</div>
						
				</div>	
					
			<div>
                    
                  </div>
                
              </div>
			
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo mlx_get_lang('Social Details'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				
                  <div class="box-body">
                    
					<?php 
					
					if(isset($row->social_meta) && !empty($row->social_meta))
					{
						$social_media = json_decode($row->social_meta, true);
					}
					
					foreach($social_medias as $key => $details){
						
						$url = (isset($social_media[$key]) && !empty($social_media[$key]))?$social_media[$key]:'';
						
					?>
					<div class="form-group">
                      <label for="facebook"><?php echo $details['title']; ?></label>
                      <div class="input-group">
					  <span class="input-group-addon">
					  		<input type="hidden" class="form-control "
					  name="options[<?php echo $key; ?>][icon]"  
					  value="<?php echo $details['fa-icon']; ?>">
                          <i class="fa <?php echo $details['fa-icon']; ?>"></i>
                        </span> 
					  <input type="url" class="form-control " value="<?php echo $url; ?>"
					  name="social_meta[<?php echo $key; ?>]" id="<?php echo $key; ?>" >
					  
					  
					  </div>
					  
                    </div>
					
					<?php
					
					}?>
					
					
					
					
					
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
				 <div class="box-footer">
					<button name="submit" type="submit" class="btn btn-primary pull-right" id="save_publish"><?php echo mlx_get_lang('Save Publish'); ?></button>
                  </div>
			  </div>	  
		  </div>
		  
		  </div>
			  
			  </form>
        </section>
      </div>
      