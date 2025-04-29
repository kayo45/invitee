<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>
<div class="content-wrapper">

	<section class="content">
		<input type="hidden" name="user_id" class="user_id" value="<?php echo html_escape($this->session->userdata('user_id')); ?>">
		
		<div class="row">
		<div class="col-md-12">   
		   
		   <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
				{
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
				
			?> 
		   
		  <div class="box box-primary gallery-section">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php echo mlx_get_lang('Photo Gallery'); ?> </h3>
			  
				<div class="btn-group pull-right" style="margin-left:5px;">
					<button class="btn btn-default btn-xs select-all-album-btn" data-container="body" data-toggle="tooltip" title="<?php echo mlx_get_lang('Select All'); ?>"><i class="fa fa-check"></i></button>
					<button class="btn btn-default btn-xs unselect-all-album-btn" data-container="body" data-toggle="tooltip" title="<?php echo mlx_get_lang('Select None'); ?>"><i class="fa fa-square-o"></i></button>
				</div>
				<button class=" pull-right btn btn-danger btn-xs remove-album-images disabled" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
				
				<span class="select-msg-text-block pull-right" style="margin-right:10px; margin-top:1px;">
					(<?php echo mlx_get_lang('Click on image to select multiple'); ?>)
				</span>
			</div>
			
			  <div class="box-body">
							
				<div id="gallery_plupload_container" class="gallery_plupload_container">
					<div id ="gallery-drop-target" class="gallery-drop-target">
						<span class="gallery-drop-target-inner">
							Drop images or folders here
							<br>
							<strong>OR</strong>
							<br>
							Click here to select multiple images
							<br><br>
							<small>(Allowed file size upto 40MB and 6000x6000 in dimention.)</small>
						</span>
						
					</div>
					
					
					
				</div>
				
				
				<div class="media_container media-upload-container row" id="gallery-upload-container">
					
					<?php if(isset($album_list) && $album_list->num_rows() > 0)
					{
						foreach($album_list->result() as $row)
						{
							$enc_img_id = $myHelpers->global_lib->EncryptClientID(html_escape($row->image_id));
							?>
							<div class="col-md-2 album_images"> 
								<div class="media_images_inner"  data-container="body" data-toggle="tooltip" title="" data-original-title="<?php echo html_escape($row->image_alt); ?>">
									<img src="<?php echo base_url().'../'.html_escape($row->image_path).html_escape($row->image_name); ?>" width="100%">
									<a href="#" class=" remove_album_image hide" id="<?php echo 'image_'.$enc_img_id;?>" data-type="photo_gallery" data-name="<?php echo 'image_'.$enc_img_id;?>"><i class="fa fa-remove"></i></a>
									<span class="select-check hide"><i class="fa fa-check"></i></span>
									<input type="hidden" name="" id="<?php echo 'image_'.$enc_img_id.'_hidden';?>" value="<?php echo html_escape($row->image_alt);?>">
								</div>
							</div>
							<?php 

						}
					}
					?>
				</div>
				
				
			 </div>
			
		  </div>
		  
		  
	</div>
	  
	  </div>
	  
	  
	</section>
</div>