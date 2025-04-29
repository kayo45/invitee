<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();

?>	  
	  
      <div class="content-wrapper">

        <section class="content-header">
            <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
                {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
        ?>
        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('utility/youtube',$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
			<div class="row">
			<div class="col-md-8">   
			   
			<div class="box box-primary">
				
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo mlx_get_lang('Youtube Embed'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				 </div>
                </div>
				
                  <div class="box-body">
                    
					
					<?php if( form_error('youtube')) 	  { 	echo form_error('youtube'); 	  } ?>
					
					<div class="row">
						
						<div class="col-md-12">
							<div class="form-group">
							  <label for="FirstName"><?php echo mlx_get_lang('Youtube Embed'); ?> <span class="required">*</span></label>
							  <input type="text" class="form-control"  name="youtube" id="youtube" required
							  value="<?php if(isset($_POST['youtube'])) 
												echo $_POST['youtube'];
											else{
												echo $row->konten;
											}
									 ?>">
							</div>
						</div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <iframe width="413" height="232" src="<?php $yt = str_replace('https://youtu.be/','https://www.youtube.com/embed/',$row->konten);  echo $yt?> " title="Prewedding Hartinah &amp; Bagus" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
      