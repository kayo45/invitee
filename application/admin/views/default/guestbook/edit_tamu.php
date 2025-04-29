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
			echo form_open_multipart('guestbook/edit_tamu',$attributes); ?>
			   <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
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
                        
    				<div class="row">
    							
    					<div class="col-md-12">
        					<div class="form-group">
        					  <label for="FirstName">No Handphone (WA For Share) <span class="required">*</span></label>
        					  <input type="text" class="form-control"  name="no_hp"  required
        					  value="<?php if(isset($_POST['no_hp'])) echo $_POST['no_hp'];else echo $row->no_hp; ?>">
        					</div>
        				</div>
        				
        				<div class="col-md-12">
        					<div class="form-group">
        					  <label for="FirstName">Nama & Pasangan Tamu Undangan <span class="required">*</span></label>
        					  <input type="text" class="form-control"  name="nama_undangan"  required
        					  value="<?php if(isset($_POST['nama_undangan'])) echo $_POST['nama_undangan'];else echo $row->nama_undangan; ?>">
        					</div>
        				</div>
        				
    					
    
    					<div class="col-md-12">
    						<div class="form-group">
    							<label for="ShortDescription"><?php echo mlx_get_lang('Isi Undangan'); ?> <span class="required">*</span></label>
    							<textarea class="form-control ckeditor-element"  name="template" id="ShortDescription" >
    							    <?php if(isset($_POST['template'])) echo $_POST['template'];else echo $row->template; ?></textarea>
    						
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
     