<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<?php 
	if(isset($options_list) && $options_list->num_rows()>0)
	{
		
		foreach($options_list->result() as $row)
		{
			${$row->option_key} = $row->option_value;
		}
	}
?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1 class="page-title"><i class="fa fa-cog"></i> <?php echo mlx_get_lang('Manage Front Keywords'); ?></h1>
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
			echo form_open_multipart('settings/manage_front_keywords',$attributes); 
			
			?>
			<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">	
			<div class="row">
			<div class="col-md-12">   
			   
			<div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?>">
                
                  <div class="box-body">
                    
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label for="keyword"><?php echo mlx_get_lang('Keyword'); ?> <span class="required">*</span></label>
							  <input type="text" class="form-control" 
							  name="keyword" id="keyword" required value="">
							</div>
						</div>
					</div>
					
					</div>
				    <div class="box-footer">
						<button name="submit" type="submit" class="btn btn-<?php echo $myHelpers->global_lib->get_skin_class(); ?>" id="save_publish"><?php echo mlx_get_lang('Save Changes'); ?></button>
					</div>
              </div>
			  
			  <div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?>">
				  <div class="box-body">
						<table id="example2" class="table table-bordered table-hover datatable-element-scrollx">
							<thead>
							  <tr>
								<th width="40px"><?php echo mlx_get_lang('S.No.'); ?></th>
								<th><?php echo mlx_get_lang('Keyword'); ?></th>
								<th width="100px"><?php echo mlx_get_lang('Actions'); ?></th>
							  </tr>
							</thead>
							<tbody>
								<?php 
								if(isset($website_keywords) && $website_keywords->num_rows() > 0)
								{
									$n=0;
									foreach($website_keywords->result() as $row)
									{
										$n++;
								?>
									<tr>
										<td >
											<?php echo $n; ?>
										</td>
										<td>
											<?php echo $row->keyword; ?>
										</td>
										<td class="action_block">
											
											<a href="<?php $segments = array('settings','delete_keyword','front',$myHelpers->EncryptClientId($row->lang_id)); 
											 echo site_url($segments);?>" 
											onClick="return confirm('Do you really want to delete this keyword?');"
											title="<?php echo mlx_get_lang('Delete'); ?>" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
											
										</td>
										
									</tr>
								<?php } } ?>
							</tbody>
						</table>
                  </div>
			  </div>
			  
		  </div>
		  
		  </div>
		  
			</form>
        </section>
      </div>
      