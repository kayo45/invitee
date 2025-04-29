<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>

<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-themeisle"></i> <?php echo mlx_get_lang('Themes'); ?></h1>
	  <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
			{
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
	?> 
	</section>

	<section class="content"> 
		<?php 
		$attributes = array('name' => 'front_themes','class' => 'form');		 			
		echo form_open_multipart('appearance/themes',$attributes); ?>
		<div class="row">
			<div class="col-md-12">
			
				<div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?> homepage_section_container theme-image" >
					<div class="box-body">
						<div class="row">
						  <?php 
						  
						  
						  $front_url = site_url();
						  $front_url = str_replace("/admin","",$front_url);
						  ?>
					  
					 
							<?php 
							foreach($front_end_themes as $key=>$value){
								
							?>
						<div class="col-md-3">
						 <div class="form-group <?php echo $key; ?> <?php if($front_themes == $value['name']) { echo 'active'; } ?>">
							 <input type="radio" name="front_theme" id="<?php echo $value['title']; ?>" class="" value="<?php echo $value['name']; ?>"/>
								
								<label for="<?php echo $value['title']; ?>">
									<img src="<?php echo base_url().'../uploads/themes_shots/'.$value['name'].'.png';?>" class="img-responsive "/>
								</label>
								
							  </div>
							<br/>
						</div>	
							<?php 
							} ?>
							
						<!-- Template Loop-->
						<?php  foreach($front_end_themeplate as $key=>$value){ ?>
						<div class="col-md-3 text-center">
						 <div class="form-group <?php echo $key; ?> <?php if($front_themes == $value['name']) { echo 'active'; } ?>">
							 <input type="radio" name="front_theme" id="<?php echo $value['title']; ?>" class="" value="<?php echo $value['name']; ?>"/>
								
								<label for="<?php echo $value['title']; ?>">
									<img src="<?php echo base_url().'../uploads/themes_shots/'.$value['name'].'.png';?>" class="img-responsive "/>
								</label>
								
							  </div>
							<br/>
							<p class="text-center"><?php echo $key; ?></p>
						</div>	
						<?php } ?>
						
						</div>
						<div class="box-footer">
							<button name="submit" type="submit" class="btn btn-primary pull-right">Save Theme</button>
						</div>
					</div>
					
			</div>
		</div>
		</form>
	</section>
</div>
