<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-cog"></i> <?php echo mlx_get_lang('Admin Keyword Settings'); ?> 
  <a href="<?php echo base_url();?>/settings/manage_admin_keywords" class="btn btn-<?php echo $myHelpers->global_lib->get_skin_class(); ?> pull-right content-header-right-link"><?php echo mlx_get_lang('Manage Keywords'); ?></a>
  
  </h1>
  <?php echo validation_errors(); 
	if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
	{
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	?>
</section>

		
		
		
<section class="content">
	
	 
	<input type="hidden" name="user_id" class="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">	
	<div class="row">
	<div class="col-md-12">   
	 
	  <?php if(isset($site_language) && !empty($site_language)) { 
		$site_language_array = json_decode($site_language,true);
		if(!empty($site_language_array)) { 
	  ?>
	 
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs hide">
			  <?php 
				$n=0;
				foreach($site_language_array as $k=>$v) { $n++; 
				$lang_exp = explode('~',$v['language']);
				$lang_code = $lang_exp[1];
				$lang_title = $lang_exp[0];
				?>
				<li <?php if($n == 1) echo 'class="active"'; ?>>
					<a href="#<?php echo $lang_code; ?>" data-toggle="tab"><?php echo ucfirst($lang_title); ?></a>
				</li>
			  <?php } ?>
			</ul>
			<div class="tab-content">
			  <?php 
				$n=0;
				foreach($site_language_array as $k=>$v) { $n++; 
					$lang_exp = explode('~',$v['language']);
					$lang_code = $lang_exp[1];
					$lang_title = $lang_exp[0];
					
					$lang_slug = $myHelpers->global_lib->get_slug($lang_title,'_');
				?>
					  <div class="<?php if($n == 1) echo 'active'; ?> tab-pane" id="<?php echo $lang_code; ?>">
						 <?php 
							$attributes = array('name' => 'add_form_post','class' => 'form-horizontal admin_keyword_settings_form form');		 			
							echo form_open_multipart('settings/admin_keyword_settings',$attributes); 
							
							 $keyword_result = $myHelpers->Common_model->commonQuery("select keyword,lang_id,$lang_slug from languages where lang_for = 'back'
							order by lang_id DESC");
						  if($keyword_result->num_rows() > 0) {
						?>
						 <input type="hidden" name="lang_slug" value="<?php echo $lang_slug; ?>">
						 <input type="hidden" name="lang_code" class="lang_code" value="<?php echo $lang_code; ?>">
						
						
						  <?php 
						  
						  foreach($keyword_result->result() as $row){
						  ?>
							  <div class="form-group">
								<label for="<?php echo $row->keyword; ?>" class="col-sm-3 control-label"><?php echo ucfirst($row->keyword); ?></label>
								<div class="col-sm-9">
								  
									<input type="text" value="<?php if($lang_slug == 'english' && $row->$lang_slug == '') echo $row->keyword; else echo $row->$lang_slug; ?>" 
									class="form-control keywords" name="lang_ids[<?php echo $row->lang_id; ?>]" id="<?php echo $row->keyword; ?>" 
									data-lang_id="<?php echo $myHelpers->EncryptClientId($row->lang_id); ?>" data-lang_slug="<?php echo $lang_slug; ?>"
									>
									<i class="fa fa-spinner fa-spin" style="display:none;"></i>
								 
								</div>
							  </div>
						  <?php } ?>
						  <div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
							  <button type="submit" name="lang_update" class="btn btn-<?php echo $myHelpers->global_lib->get_skin_class(); ?>"><?php echo mlx_get_lang('Submit & Update Language File'); ?></button>
							</div>
						  </div>
						  <?php }else{
						  ?>
						  <h4 class="text-center"><?php echo mlx_get_lang('No Keyword Available'); ?></h4>
						  <?php } ?>
						</form>
					  </div>
				<?php } ?>
			</div>
		  </div>
		 
	  <?php }} ?>
  </div>
  
  </div>
  
	
</section>


</div>
   