<?php 
	$enbale_reg_img_upload = $myHelpers->global_lib->get_option('enbale_reg_img_upload'); 
?>

<div class="faq-pg-section section-padding">
      <div class="container">
		
		<div class="row">
			<div class="col col-lg-10 col-lg-offset-1">
				<div class="section-title" style="padding-top:0px;">
					<h2><?php echo mlx_get_lang('Register'); ?></h2>
				</div>
			</div>
		</div>
		
        <div class="row">
		
		<div class="col-md-6 col-lg-6 mb-5 col-lg-offset-3 col-md-offset-3">
          <?php 
			$args = array('class' => 'register_form  text-left', 'id' => 'register_form', 'autocomplete'=>"off",
			'enctype' => 'application/x-www-form-urlencoded');
			echo form_open('',$args);?> 
			
			  <?php if(isset($_SESSION['register_msg']) && !empty($_SESSION['register_msg'])) {
					echo $_SESSION['register_msg'];
					unset($_SESSION['register_msg']);
			   } ?>
			   
			   <h4 class="text-center mb-4"><?php echo mlx_get_lang('Create an Account'); ?></h4>
			   
				<div class="row form-group">
					<div class="col-md-6 mb-3 mb-md-0">
					  <label class="font-weight-bold" for="first_name"><?php echo mlx_get_lang('First Name'); ?> <span class="required text-danger">*</span></label>
					  <input type="text" id="first_name" name="first_name"  required class="form-control" >
					</div>
			   
					<div class="col-md-6 mb-3 mb-md-0">
					  <label class="font-weight-bold" for="last_name"><?php echo mlx_get_lang('Last Name'); ?> <span class="required text-danger">*</span></label>
					  <input type="text" id="last_name" name="last_name"  required class="form-control" >
					</div>
			    </div>
				  
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0 validation-field">
                  <label class="font-weight-bold" for="username"><?php echo mlx_get_lang('Username'); ?> <span class="required text-danger">*</span></label>
                  <input type="text" id="username" name="username" autocomplete="off" required class="form-control " >
				  <i class="fa fa-spinner fa-spin"></i>
				  <p class="help-block">Use lower case without space and special characters are allowed.</p>
                </div>
              </div>
				
				<div class="row form-group">
					<div class="col-md-12 mb-3 mb-md-0 validation-field">
					  <label class="font-weight-bold" for="email"><?php echo mlx_get_lang('Email'); ?> <span class="required text-danger">*</span></label>
					  <input type="email" id="email" name="email" autocomplete="off"  required class="form-control " >
					  <i class="fa fa-spinner fa-spin"></i>
					</div>
				  </div>
			  
              <div class="row form-group">
                <div class="col-md-6">
                  <label class="font-weight-bold" for="password"><?php echo mlx_get_lang('Password'); ?> <span class="required text-danger">*</span></label>
                  <input type="password" id="password"  name="password" required class="form-control" autocomplete="new-password">
                </div>
              
                <div class="col-md-6">
                  <label class="font-weight-bold" for="repeat_password"><?php echo mlx_get_lang('Repeat Password'); ?> <span class="required text-danger">*</span></label>
                  <input type="password" id="repeat_password"  name="repeat_password" required class="form-control" >
                </div>
              </div>
			  <?php if($enbale_reg_img_upload == 'Y'){ ?>
			  <div class="form-group row">
				<div class="col-md-12">
					<label class="font-weight-bold" for="exampleInputFile" style="display: block;"><?php echo mlx_get_lang('Profile Image'); ?> <span class="required text-danger">*</span></label>
					<label class="custom-file-upload rounded-2">
						<input type="file" accept="image/*" id="att_photo" name="attachments" data-type="photo" data-user-type="user"/>
						<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
					</label>
					<progress id="att_photo_progress" value="0" max="100" style="display:none;"></progress>
					<a id="att_photo_link" href="" download="" style="display:none;">
						<img src="">
					</a>
					<a class="remove_img" id="att_photo_remove_img" data-name="att_photo" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
					<input type="text" name="att_photo_hidden" class="photo_url_field" id="att_photo_hidden" style="visibility:hidden">
				</div>
			  </div>
			  <?php } ?>
			  
              <div class="row form-group mt-4">
                <div class="col-md-12">
                  <button type="submit" name="submit" class="theme-btn btn submit-contact-form-btn py-2 px-4 rounded-2 text-white btn-block"><?php echo mlx_get_lang('Register'); ?></button>
                </div>
              </div>
			</form>
				
				
            
          </div>
		  
        </div>
      </div>
    </div>