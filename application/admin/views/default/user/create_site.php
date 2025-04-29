
<?php $this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
	<h1 class="page-title"><i class="fa fa-plus"></i> <?php echo mlx_get_lang('Create New Site'); ?></h1>
	
	<?php if( form_error('payment_title')) 	  { 	echo form_error('payment_title'); 	  } ?>
	<?php if( form_error('payment_status')) 	  { 	echo form_error('payment_status'); 	  } ?>
	<?php if( form_error('payment_amount')) 	  { 	echo form_error('payment_amount'); 	  } ?>
	<?php if( form_error('payment_mode')) 	  { 	echo form_error('payment_mode'); 	  } ?>
</section>

<section class="content">
	 <?php 
	
	$attributes = array('name' => 'add_form_post','class' => 'form');		 			
	echo form_open_multipart('user/create_site/'.$wedding_user_id,$attributes); ?>
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	
	<div class="row">
	<div class="col-md-8">   
		
	  <div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?>">
		
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo mlx_get_lang('Site Details'); ?></h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		  <div class="box-body">
			
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label for="payment_title"><?php echo mlx_get_lang('Payment Title'); ?> <span class="required">*</span></label>
					  <input type="text" class="form-control" name="payment_title" id="payment_title" required
					  value="<?php if(isset($_POST['payment_title'])) echo $_POST['payment_title']; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="payment_status"><?php echo mlx_get_lang('Payment Status'); ?>  <span class="required">*</span></label>
						<select class="form-control"  name="payment_status" required id="payment_status">
							<option value=""><?php echo mlx_get_lang('Select Payment Status'); ?></option>
							<option value="complete"><?php echo mlx_get_lang('Complete'); ?></option>
							<option value="free"><?php echo mlx_get_lang('Free'); ?></option>
						</select>
					</div>
				</div>
				
				
				<div class="col-md-6">
					<div class="form-group">
					  <label for="payment_mode_cod"><?php echo mlx_get_lang('Payment Mode'); ?> <span class="required">*</span></label>
					  <div class="radio">
						<label>
							<input type="radio" name="payment_mode" id="payment_mode_cod" checked value="cod">
							COD
						</label>
					  </div>
					  <div class="radio">
						<label>
							<input type="radio" name="payment_mode" id="payment_mode_bank" value="bank">
							Bank Transfer
						</label>
					  </div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
					  <label for="payment_amount"><?php echo mlx_get_lang('Payment Amount'); ?> <span class="required">*</span></label>
					  <input type="number" class="form-control" name="payment_amount" id="payment_amount" required step=".01" min="0"
					  value="<?php if(isset($_POST['payment_amount'])) echo $_POST['payment_amount']; else echo '0'; ?>">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<label for="payment_remark"><?php echo mlx_get_lang('Payment Remark'); ?> </label>
						<textarea class="form-control" name="payment_remark" id="payment_remark"><?php if(isset($_POST['payment_remark'])) echo $_POST['payment_remark']; ?></textarea>
					</div>
				</div>
				
			</div>	
			
		  </div>
		
	  </div>
</div>
  
  <div class="col-md-4">
  <div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?>">
	  <div class="box-header with-border">
		  <h3 class="box-title"><?php echo mlx_get_lang('Status'); ?></h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		
		 <div class="box-footer">
			<button name="submit" type="submit" class="btn btn-<?php echo $myHelpers->global_lib->get_skin_class(); ?> pull-right" id="save_publish"><?php echo mlx_get_lang('Submit'); ?></button>
		  </div>
	  </div>
  </div>
  </div>
	  </form>
</section>
</div>