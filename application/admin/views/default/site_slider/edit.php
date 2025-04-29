<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();
?>	  
	  
      <div class="content-wrapper">
        <section class="content-header">
          <h1  class="page-title"><i class="fa fa-edit"></i> <?php echo mlx_get_lang('Edit Site Slider'); ?> </h1>
          	<?php if( form_error('photo')) 	  { 	echo form_error('photo'); 	  } ?>
			<?php  if( form_error('img_order')){ 	echo form_error('img_order'); 	  } ?>

        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('site_slider/edit/'.$id,$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
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
											<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/site_slider/',$row->slide_img); ?>
											<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $myHelpers->EncryptClientId($id); ?>" data-type="site_slider" id="pl_file_uploader_1" 
												<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
												<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
											</label>
											<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
											<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
											
												<a class="pl_file_link" href="<?php echo base_url().'../uploads/site_slider/'.$thumb_photo; ?>" 
												download="<?php echo $thumb_photo; ?>" style="">
													<img src="<?php echo base_url().'../uploads/site_slider/'.$thumb_photo; ?>" >
												</a>
											
												<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
											<?php }else{ ?>
												<a class="pl_file_link" href="" download="" style="display:none;">
													<img src="" >
												</a>
												<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
											<?php } ?>
											<input type="hidden" name="photo" value="<?php echo $thumb_photo ;?>" 
											class="pl_file_hidden">
										</div>
							</div>
					</div>
				
					<div class="col-md-12">
						<div class="form-group">
						  <label for="order"><?php echo mlx_get_lang('Order'); ?> <span class="required">*</span></label>
						  <input type="number" class="form-control"  name="img_order" id="img_order"  required
						  value="<?php if(isset($_POST['img_order'])) echo $_POST['img_order']; else echo $row->img_order; ?>">
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
				 <div class="box-footer">
					<button name="submit" type="submit" class="btn btn-primary pull-right" id="save_publish"><?php echo mlx_get_lang('Save Publish'); ?></button>
                  </div>
			  </div>  
		  </div>

		  </div>  
			  
			  
			  
			  
			  </form>
        </section>
      </div>
     