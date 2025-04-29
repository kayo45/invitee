
<?php 
$short_desc_limit = 150;
$this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-calendar"></i> <?php echo mlx_get_lang('Add New Friend'); ?></h1>
  
</section>

<section class="content">
	 <?php 
	
	$attributes = array('name' => 'add_form_post','class' => 'form');		 			
	echo form_open_multipart('friendslist/add_new',$attributes); ?>
	
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	
	<div class="row">
	<div class="col-md-8">   
		
	  <div class="box box-primary">
		
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo mlx_get_lang('Friend Details'); ?></h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		  <div class="box-body">
			
			
			<?php if( form_error('FirstName')) 	  { 	echo form_error('FirstName'); 	  } ?>
			<?php if( form_error('LastName')) 	  { 	echo form_error('LastName'); 	  } ?>
			<?php if( form_error('Email'))  { 	echo form_error('Email'); 	  } ?>
			<?php if( form_error('City'))  { 	echo form_error('City'); 	  } ?>
			<?php if( form_error('State'))  { 	echo form_error('State'); 	  } ?>
			<?php if( form_error('Country'))  { 	echo form_error('Country'); 	  } ?>
			
			<div class="row">
				
				
				
				
				<div class="col-md-12">
					<div class="form-group">
					  <label for="FirstName"><?php echo mlx_get_lang('Frist Name'); ?> <span class="required">*</span></label>
					  <input type="text" class="form-control"  name="FirstName" id="FirstName" required
					  value="<?php if(isset($_POST['event_title'])) echo $_POST['event_title'];?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="LastName"><?php echo mlx_get_lang('Last Name'); ?> <span class="required">*</span></label>
					  <input type="text" class="form-control"  name="LastName" id="LastName" required
						value="">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="Email"><?php echo mlx_get_lang('Email Address'); ?> <span class="required">*</span></label>
					  <input type="eamil" class="form-control" name="email" id="Email" >
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="City"><?php echo mlx_get_lang('City'); ?> </label>
					  <input type="text" class="form-control"  name="city" id="City" required />
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="State"><?php echo mlx_get_lang('State'); ?> </label>
					  <input type="text" class="form-control"  name="state" id="State" required
					  value="<?php if(isset($_POST['State'])) echo $_POST['State'];?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label for="Country"><?php echo mlx_get_lang('Country'); ?> </label>
					  <input type="text" class="form-control"  name="country" id="Country" required
					  value="<?php if(isset($_POST['Country'])) echo $_POST['Country'];?>">
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