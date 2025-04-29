
<?php 
$short_desc_limit = 150;
$this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-plus"></i> <?php echo mlx_get_lang('Add New Gift'); ?></h1>
  <?php if( form_error('gift_title')) 	  { 	echo form_error('gift_title'); 	  } ?>
			
	<?php if( form_error('gift_price'))  	  { 	echo form_error('gift_price'); 	  } ?>
	<?php if( form_error('gift_description')) { 	echo form_error('gift_description'); 	  } ?>
</section>

<section class="content">
	 <?php 
	
	$attributes = array('name' => 'add_form_post','class' => 'form');		 			
	echo form_open_multipart('gifts/add_new',$attributes); ?>
	
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	
	<div class="row">
	<div class="col-md-8">   
		
	  <div class="box box-primary">
		
			<div class="box-header with-border">
			  <h3 class="box-title"><?php echo mlx_get_lang('Gift Details'); ?></h3>
			  <div class="box-tools pull-right">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			  </div>
			</div>
		  <div class="box-body">
			<div class="row">
				
				<div class="col-md-12">
					<div class="form-group">
					  <label for="FirstName"><?php echo mlx_get_lang('Gift Title'); ?> <span class="required">*</span></label>
					  <input type="text" class="form-control"  name="gift_title" id="gift_title" required maxlength="50"
					  value="<?php if(isset($_POST['gift_title'])) echo $_POST['gift_title'];?>">
					</div>
				</div>
					<div class="col-md-12">
									
							<div class="form-group">
							<label for="exampleInputFile" style="display: block;"><?php echo mlx_get_lang('Gift Image'); ?> <span class="required">*</span></label>
								<div class="pl_image_container">
									<label class="custom-file-upload" data-element_id="" data-type="gifts" id="pl_file_uploader_1">
										<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
									</label>
									<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="">
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
									<input type="hidden" name="gift_image" value="" class="pl_file_hidden">
								</div>
							</div>
					
						</div>
						<div class="col-md-12">
							<div class="form-group">
							  <label for="gift_price"><?php echo mlx_get_lang('Price'); ?> <span class="required">*</span></label>
							  <input type="number" class="form-control"  name="gift_price" id="gift_price" required
							  value="<?php if(isset($_POST['gift_price'])) echo $_POST['gift_price'];?>">
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="gift_description"><?php echo mlx_get_lang('Description'); ?> <span class="required">*</span></label>
							 <textarea class="form-control short-description-element" maxlength="<?php echo $short_desc_limit; ?>" name="gift_description" id="gift_description" required></textarea>
							<span class="rchars" id="rchars"><?php echo $short_desc_limit; ?></span> <?php echo mlx_get_lang('Character(s) Remaining'); ?>
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
			<button name="submit" type="submit" class="btn btn-primary pull-right" id="save_publish"><?php echo mlx_get_lang('Submit'); ?></button>
		  </div>
	  </div>
  </div>
  </div>
	  </form>
</section>
</div>
