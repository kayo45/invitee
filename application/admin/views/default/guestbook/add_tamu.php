
<?php 
$short_desc_limit = 150;
$this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-plus"></i> <?php echo mlx_get_lang('Nama Tamu Undangan'); ?></h1>
  
</section>

<section class="content">
	 <?php 
	
	$attributes = array('name' => 'add_form_post','class' => 'form');		 			
	echo form_open_multipart('guestbook/add_tamu',$attributes); ?>
	
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
	
	<div class="row">
	<div class="col-md-8">   
		
	  <div class="box box-primary">
		
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo mlx_get_lang('Nama Tamu Undangan'); ?></h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		  <div class="box-body">
			<?php if( form_error('no_hp'))  { 	echo form_error('no_hp'); 	} ?>
			<?php if( form_error('nama_undangan'))  { 	echo form_error('nama_undangan'); 	} ?>
			<?php if( form_error('template'))  { 	echo form_error('template'); 	} ?>
			
			<div class="row">
			    <div class="col-md-12">
					<div class="form-group">
					  <label for="FirstName">No Handphone (WA For Share) <span class="required">*</span></label>
					  <input type="text" class="form-control"  name="no_hp"  required
					  value="<?php if(isset($_POST['no_hp'])) echo $_POST['no_hp'];?>">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
					  <label for="FirstName">Nama & Pasangan Tamu Undangan <span class="required">*</span></label>
					  <input type="text" class="form-control"  name="nama_undangan"  required
					  value="<?php if(isset($_POST['nama_undangan'])) echo $_POST['nama_undangan'];?>">
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
				
					  <label for="template"><?php echo mlx_get_lang('Isi Undangan'); ?> <span class="required">*</span></label>
					  <textarea class="form-control  ckeditor-element"  name="template" id="Kutipan" ><?php if(isset($_POST['template'])) echo $_POST['template'];else ?></textarea>
					  
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