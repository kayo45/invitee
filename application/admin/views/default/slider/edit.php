<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();
?>	  
	  
      <div class="content-wrapper">
        <section class="content-header">
          <h1  class="page-title"><i class="fa fa-edit"></i> <?php echo mlx_get_lang('Edit Slider'); ?> </h1>
          <?php if( form_error('photo')) 	  { 	echo form_error('photo'); 	  } ?>
		  <?php if( form_error('date')) 	  { 	echo form_error('date'); 	  } ?>
        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('slider/edit',$attributes); ?>
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
											<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/slider/',$row->slide_img); ?>
											<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $myHelpers->EncryptClientId($id); ?>" data-type="slider" id="pl_file_uploader_1" 
												<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
												<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
											</label>
											<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
											<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
											
												<a class="pl_file_link" href="<?php echo base_url().'../uploads/slider/'.$thumb_photo; ?>" 
												download="<?php echo $thumb_photo; ?>" style="">
													<img src="<?php echo base_url().'../uploads/slider/'.$thumb_photo; ?>" >
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
							<label for="place">Placement <span class="required">*</span></label>
							<select class="form-control" id="place" name="place" style="width: 100%" required>
								<option value="<?php if(isset($_POST['place'])) echo $_POST['place']; else echo $row->place; ?>"><?php if(isset($_POST['place'])) echo $_POST['place']; else echo '-- Selected '.$row->place.' --'; ?></option>

								<option value="cover">Cover</option>
								<option value="opening">Opening</option>
								<option value="our-love">Our Love</option>
								<option value="filter-ig">Filter IG</option>
								<option value="wedding-gifts">Wedding Gifts</option>
							</select>
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
     