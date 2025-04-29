
<?php 
$short_desc_limit = 150;
$this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>

<?php 
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
  <h1  class="page-title"><i class="fa fa-plus"></i> <?php echo mlx_get_lang('Add New Relative'); ?></h1>
  
</section>

<section class="content">
	 <?php 
	
	$attributes = array('name' => 'add_form_post','class' => 'form');		 			
	echo form_open_multipart('relatives/add_new',$attributes); ?>
	
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	
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
					  value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
					  <label for="sub_title"><?php echo mlx_get_lang('Sub Title'); ?> </label>
					  <input type="text" class="form-control"  name="sub_title" id="sub_title"
					  value="<?php if(isset($_POST['sub_title'])) echo $_POST['sub_title'];?>">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label for="exampleInputFile" style="display: block;">Photo</label>
											
						<div class="form-group pl_image_container">
						<label class="custom-file-upload" data-element_id="" data-type="relatives" id="pl_file_uploader_1">
							<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
						</label>
						<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
						<a class="pl_file_link" href="" download="" style="display:none;">
							<img src="">
						</a>
						<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
						<input type="hidden" name="photo" value="" class="pl_file_hidden">
					</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
					  <label for="type"><?php echo mlx_get_lang('Type'); ?> <span class="required">*</span></label>
					  
					  <div class="radio">
                        <label style="padding-left:0px;">
                          <input type="radio" name="type" id="type_gm" value="Groomsmen" class="minimal" checked required>
                          &nbsp;Groomsmen
                        </label>
                      </div>
					  
					  <div class="radio">
                        <label style="padding-left:0px;">
                          <input type="radio" name="type" id="type_bm" value="Bridesmaid" class="minimal" required>
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
                          <input type="radio" name="relation" id="relation_<?php echo strtolower($rrow->title); ?>" value="<?php echo $rrow->rel_id; ?>" class="minimal">
                          &nbsp;<?php echo ucfirst($rrow->title); ?>
                        </label>
                      </div>
					  <?php } ?>
					</div>
				</div>
				<?php } ?>
				
			</div>
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
					
					foreach($social_medias as $key => $details){
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
					  <input type="url" class="form-control "
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
		  <h3 class="box-title"><?php echo mlx_get_lang('Status'); ?></h3>
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
