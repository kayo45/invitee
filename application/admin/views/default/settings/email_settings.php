<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>


<?php 
	
	$email_setting = array();
	if(isset($options_list) && $options_list->num_rows()>0)
	{
		foreach($options_list->result() as $row)
		{
			$email_setting = json_decode($row->option_value, true);
		}
	}
	
		
?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1  class="page-title"><i class="fa fa-cog"></i> <?php echo mlx_get_lang('Email Settings'); ?> </h1>
		  <?php echo validation_errors(); 
			if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
			{
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			?>
        </section>

        <section class="content">
		     <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('settings/email_setting',$attributes); 
			
			?>
			<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">	
			<div class="row">
			<div class="col-md-8">   
			   
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo mlx_get_lang('Email Settings'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				
                  <div class="box-body">
					<?php 
						foreach($email_setting as $key=>$value){
							if($key == 'smtp_pass'){?>
						<div class="form-group">
						<label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
						  <input type="password" class="form-control" 
						  name="options[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php if(isset($protocol)) { echo $protocol; }else{ echo $value;} ?>">
					  
						</div>
					<?php }else{?>
						<div class="form-group">
						<label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
						  <input type="text" class="form-control" 
						  name="options[<?php echo $key; ?>]" id="<?php echo $key; ?>" value="<?php if(isset($protocol)) { echo $protocol; }else{ echo $value;} ?>">
					  
						</div>
					<?php } 
					}?>
										
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
					<button name="submit" type="submit" class="btn btn-primary pull-right" id="save_publish"><?php echo mlx_get_lang('Save Changes'); ?></button>
                  </div>
			  </div>
		  </div>
		  
		  
		  </div>
		  
			</form>
        </section>
      </div>
      