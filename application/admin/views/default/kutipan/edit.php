<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
$row = $query->row();
?>	  
	  
      <div class="content-wrapper">
        <section class="content-header">
          <h1  class="page-title"><i class="fa fa-edit"></i> <?php echo mlx_get_lang('Edit Kutipan'); ?> </h1>
			<?php if( form_error('place')) 	  { 	echo form_error('place'); 	  	} ?>
			<?php if( form_error('kutipan'))  { 	echo form_error('kutipan'); 	} ?>
        </section>

        <section class="content">
			 <?php 
			$attributes = array('name' => 'add_form_post','class' => 'form');		 			
			echo form_open_multipart('kutipan/edit',$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
			<div class="row">
			<div class="col-md-8">   
			   
			<div class="box box-primary">
				
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo mlx_get_lang('Kutipan Details'); ?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				 </div>
                </div>
				
                  <div class="box-body">
                    
					
					
				
					
				<div class="row">
							
							

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
					
							<label for="ShortDescription"><?php echo mlx_get_lang('Kutipan'); ?> <span class="required">*</span></label>
							<textarea class="form-control ckeditor-element"  name="kutipan" id="ShortDescription" ><?php if(isset($_POST['kutipan'])) echo $_POST['kutipan'];else echo $row->kutipan; ?></textarea>
						
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
     