
<?php 
$short_desc_limit = 150;
$this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-plus"></i> <?php echo mlx_get_lang('Add New Story'); ?></h1>
  
</section>

<section class="content">
	 <?php 
	
	$attributes = array('name' => 'add_form_post','class' => 'form');		 			
	echo form_open_multipart('story/add_new',$attributes); ?>
	
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	
	<div class="row">
	<div class="col-md-8">   
		
	  <div class="box box-primary">
		
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo mlx_get_lang('Story Details'); ?></h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		  <div class="box-body">
			
			
			<?php if( form_error('title')) 	  { 	echo form_error('title'); 	  } ?>
			<?php if( form_error('date')) 	  { 	echo form_error('date'); 	  } ?>
			<?php if( form_error('content'))  { 	echo form_error('content'); 	  } ?>
			
			<div class="row">
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
					  <label for="FirstName"><?php echo mlx_get_lang('Title'); ?> <span class="required">*</span></label>
					  <input type="text" class="form-control"  name="title" id="sotry_title" required
					  value="<?php if(isset($_POST['title'])) echo $_POST['title'];?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="FirstName"><?php echo mlx_get_lang('Date'); ?> <span class="required">*</span></label>
					  <input type="text" class="form-control datepicker_elem"  name="date" id="sotry_date" required
					  value="<?php if(isset($_POST['date'])) echo $_POST['date']; else echo date('m/d/Y',time());?>" autocomplete="off">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
				
					  <label for="FirstName"><?php echo mlx_get_lang('Short Description'); ?> <span class="required">*</span></label>
					  <textarea class="form-control  ckeditor-element"  name="content" id="ShortDescription" ><?php if(isset($_POST['content'])) echo $_POST['content'];else ?></textarea>
					  
					</div>
				</div>
				<div class="col-md-12">
					<label for="FirstName"><?php echo mlx_get_lang('Image'); ?></label>
					<div class="form-group pl_image_container">
						<label class="custom-file-upload" data-element_id="" data-type="story" id="pl_file_uploader_1">
							<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
						</label>
						<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
						<a class="pl_file_link" href="" download="" style="display:none;">
							<img src="">
						</a>
						<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
						<input type="hidden" name="story_image" value="" class="pl_file_hidden">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="FirstName"><?php echo mlx_get_lang('Story Order'); ?> <span class="required">*</span></label>
					  <input type="number" class="form-control"  name="order" id="story_order" required min="0" step="1"
					  value="<?php if(isset($_POST['order'])) echo $_POST['order']; else echo '0'; ?>" >
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