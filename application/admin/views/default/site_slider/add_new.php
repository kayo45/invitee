
<?php 
$short_desc_limit = 150;
$this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1  class="page-title"><i class="fa fa-plus"></i> <?php echo mlx_get_lang('Add New Site Slider'); ?></h1>
	<?php if( form_error('photo')) 	  { 	echo form_error('photo'); 	  } ?>
	<?php  if( form_error('img_order')){ 	echo form_error('img_order'); 	  } ?>
</section>

<section class="content">
	 <?php 
	
	$attributes = array('name' => 'add_form_post','class' => 'form');		 			
	echo form_open_multipart('site_slider/add_new',$attributes); ?>
	
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	
	<div class="row">
	<div class="col-md-8">   
		
	  <div class="box box-primary">
		
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo mlx_get_lang('Slider Details'); ?></h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		  <div class="box-body">
			<div class="row">
				
				
				
				<div class="col-md-12">
				
						<div class="form-group">
						  <label for="exampleInputFile" style="display: block;">Photo <span class="required">*</span></label>
							<div class="pl_image_container">
								<label class="custom-file-upload" data-element_id="" data-type="site_slider" id="pl_file_uploader_1">
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
					  <label for="order"><?php echo mlx_get_lang('Order'); ?> <span class="required">*</span></label>
					  <input type="number" class="form-control"  name="img_order" id="img_order"  required
					  value="<?php if(isset($_POST['img_order'])) echo $_POST['img_order']; else echo 0; ?>">
					</div>
				</div>

			</div>
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
