<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();
$short_desc_limit = 150;
?>	  
	  
      <div class="content-wrapper">
        <section class="content-header">
          <h1 class="page-title"><i class="fa fa-edit"></i> <?php echo mlx_get_lang('Edit Event'); ?> </h1>
			<?php if( form_error('gift_title')) 	  { 	echo form_error('gift_title'); 	  } ?>
			<?php if( form_error('gift_price'))  	  { 	echo form_error('gift_price'); 	  } ?>
			<?php if( form_error('gift_description')) { 	echo form_error('gift_description'); 	  } ?>
        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('gifts/edit',$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
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
							  <input type="text" class="form-control"  name="gift_title" id="gift_title" required  maxlength="50"
							  value="<?php if(isset($_POST['gift_title'])) 
												echo $_POST['gift_title'];
											else{
												echo $row->title;
											}
									 ?>">
							</div>
						</div>
						
						
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputFile" style="display: block;"><?php echo mlx_get_lang('Gift Image'); ?> <span class="required">*</span></label>
								
								<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/gifts/',$row->image,'thumb'); ?>
								<div class="form-group pl_image_container">
								<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $myHelpers->global_lib->EncryptClientId($id); ?>" data-type="gifts" id="pl_file_uploader_1" 
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
									<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
								</label>
								<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
									<a class="pl_file_link" href="<?php echo base_url().'../uploads/gifts/'.$row->image; ?>" 
									download="<?php echo $row->image; ?>" style="">
										<img src="<?php echo base_url().'../uploads/gifts/'.$thumb_photo; ?>" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
								<?php }else{ ?>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
								<?php } ?>
								<input type="hidden" name="gift_image" value="<?php if(isset($row->image) && !empty($row->image)) { echo $row->image;}?>" 
								class="pl_file_hidden">
							</div>
							 
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="gift_price"><?php echo mlx_get_lang('Price'); ?> <span class="required">*</span></label>
							  <input type="number" class="form-control"  name="gift_price" id="gift_price" required
							   value="<?php if(isset($_POST['gift_price'])){ 
												echo $_POST['gift_price'];
											}else{
												echo $row->price;
											}
									 ?>" autocomplete="off">
								 
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="gift_description"><?php echo mlx_get_lang('Description'); ?> <span class="required">*</span></label>
							 <textarea class="form-control short-description-element" maxlength="<?php echo $short_desc_limit; ?>" name="gift_description" id="gift_description" required> <?php if(isset($_POST['gift_description'])){ 
												echo $_POST['gift_description'];
											}else{
												echo $row->description;
											}?></textarea>
								<span class="rchars" id="rchars"><?php echo $short_desc_limit; ?></span> <?php echo mlx_get_lang('Character(s) Remaining'); ?>
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
					<label > <?php echo mlx_get_lang('URL Slug'); ?></label> 
								<input type="text" name="slug" value="<?php if( isset($row->slug)) echo $row->slug;?>" class="form-control" />
						
								<input type="hidden" name="old_slug" value="<?php if( isset($row->slug)) echo $row->slug;?>"  />
				</div>
				 <div class="box-footer">
					<button name="submit" type="submit" class="btn btn-primary pull-right" id="save_publish"><?php echo mlx_get_lang('Update'); ?></button>
                  </div>
			  </div>
		  </div>
		  </div>
			  </form>
        </section>
      </div>
	  
      