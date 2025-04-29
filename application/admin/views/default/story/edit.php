<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();
?>	  
	  
      <div class="content-wrapper">
        <section class="content-header">
          <h1 class="page-title"><i class="fa fa-edit"></i> <?php echo mlx_get_lang('Edit Story'); ?> </h1>
          
        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('story/edit',$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
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
					<?php if( form_error('content')) 	  { 	echo form_error('content'); 	  } ?>
					
					<div class="row">
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Title'); ?> <span class="required">*</span></label>
							  <input type="text" class="form-control"  name="title" id="docTitle" required
							  value="<?php if(isset($_POST['test_title'])) 
												echo $_POST['test_title'];
											else{
												echo $row->title;
											}
									 ?>">
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Date'); ?> <span class="required">*</span></label>
							  <input type="text" class="form-control datepicker_elem"  name="date" id="docTitle" required
							  value="<?php if(isset($_POST['date'])) 
												echo $_POST['date'];
											else{
												echo date('m/d/Y',$row->date);
											}
									 ?>" autocomplete="off">
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Short Description'); ?> <span class="required">*</span></label>
							  <textarea class="form-control ckeditor-element"  name="content" id="ShortDescription" ><?php if(isset($_POST['content'])) echo $_POST['content'];else echo $row->content; ?></textarea>
							  
							</div>
						</div>
						<div class="col-md-12">
							<label for="FirstName"><?php echo mlx_get_lang('Image'); ?></label>
							<?php $thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/story/',$row->image,'thumb'); ?>
							<div class="form-group pl_image_container">
								<label class="custom-file-upload" data-element_id="<?php if(isset($id) && !empty($id)) echo $id; ?>" data-type="story" id="pl_file_uploader_1" 
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo 'style="display:none;"';}?>>
									<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
								</label>
								<progress class="pl_file_progress" value="0" max="100" style="display:none;"></progress>
								<?php if(isset($thumb_photo) && !empty($thumb_photo)) { ?>
									<a class="pl_file_link" href="<?php echo base_url().'../uploads/story/'.$row->image; ?>" 
									download="<?php echo $row->image; ?>" style="">
										<img src="<?php echo base_url().'../uploads/story/'.$thumb_photo; ?>" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
								<?php }else{ ?>
									<a class="pl_file_link" href="" download="" style="display:none;">
										<img src="" >
									</a>
									<a class="pl_file_remove_img" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
								<?php } ?>
								<input type="hidden" name="story_image" 
								value="<?php if(isset($thumb_photo) && !empty($thumb_photo)) { echo $row->image;}?>" 
								class="pl_file_hidden">
							</div>
						</div>
						<div class="col-md-12">
						<div class="form-group">
						  <label for="FirstName"><?php echo mlx_get_lang('Story Order'); ?> <span class="required">*</span></label>
						  <input type="number" class="form-control"  name="order" id="story_order" required
						  value="<?php if(isset($_POST['order'])){ echo $_POST['order']; }else {echo $row->story_order;}?>" >
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
      