<?php 
global $settings;

if(!isset($wedding_id)) return false;

$groomsmen_relatives = $this->Common_model->commonQuery("select r.*,re.title as relation_title from `wedding_relatives` as r 
												left join wedding_relations as re on re.rel_id = r.relation
												where r.type = 'Groomsmen' and r.status = 'Y'
												and r.wedding_id = $wedding_id
												 order by r.r_id DESC ");

$bridesmaid_relatives = $this->Common_model->commonQuery("select r.*,re.title as relation_title from `wedding_relatives` as r 
												left join wedding_relations as re on re.rel_id = r.relation
												where r.type = 'Bridesmaid' and r.status = 'Y'
												and r.wedding_id = $wedding_id
												 order by r.r_id DESC ");
if($groomsmen_relatives->num_rows() > 0 || $bridesmaid_relatives->num_rows() > 0)
{
	$gb_grid_col = 'col-md-4';
	if(isset($settings['no_of_item_in_grid']) && !empty($settings['no_of_item_in_grid']))
	{
		if($settings['no_of_item_in_grid'] == 3)
			$gb_grid_col = 'col-md-4';
		else if($settings['no_of_item_in_grid'] == 4)	
			$gb_grid_col = 'col-md-3';
	}
?>
<section class="relative-section section-padding" id="people">
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
				<div class="section-title1 section-title-new pos-rels">
					<?php 
					if(isset($settings['heading']) && $settings['heading'] != ''){?>
					<h2 class="bs_fam"> <?php echo mlx_get_lang($settings['heading']); ?></h2>
					<?php } ?>
					<?php if(isset($settings['sub_heading']) && $settings['sub_heading'] != ''){?>
					<p class="rob_fam"><?php echo mlx_get_lang($settings['sub_heading']); ?></p>
					<?php } ?>
					
				</div>
			</div>
		</div>
		
		<div class="row" style="position:relative;">
			
			<div class="col col-lg-12">
				<div class="tablist">
					<ul class="nav">
						<?php if($groomsmen_relatives->num_rows() > 0 ){ ?>
							<li class="active">
								<a href="#groomsmen" data-toggle="tab">Groomsmen</a>
							</li>
						<?php } ?>
						<?php if($bridesmaid_relatives->num_rows() > 0 ){ ?>
							<li class="<?php if($groomsmen_relatives->num_rows() == 0 ){ echo 'active'; } ?>">
								<a href="#bridesmaid" data-toggle="tab">Bridesmaid</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			
			<div class="col col-lg-12">
				<div class="tab-content">
					<?php if($groomsmen_relatives->num_rows() > 0 ){ ?>
						<div class="tab-pane fade in active grid-wrapper" id="groomsmen">
							<div class="outer-grid">
								<div class="row">
								<?php 
									foreach($groomsmen_relatives->result() as $grow){
										$thumb_img_name = $myHelpers->global_lib->get_image_type('uploads/relatives/', $grow->image);
										if($thumb_img_name == '')
											$thumb_img_name = 'uploads/relatives/no_image_mans.jpg';
										else
											$thumb_img_name = 'uploads/relatives/'.$thumb_img_name;
										
									
								?>
								<div class="grid <?php echo $gb_grid_col; ?>">	
									<div class="inner-grid">
										<div class="img-holder">
												<img src="<?php echo base_url().$thumb_img_name; ?>" class="img img-responsive"/>
										</div>
										<div class="details">
											<h3><?php echo  ucwords($grow->name);?></h3>
											<span><?php echo  ucwords($grow->relation_title);?></span>
											<?php if(isset($grow->social_meta) && !empty($grow->social_meta)) { 
												$social_links = json_decode($grow->social_meta,true);
												if(!empty($social_links))
												{
											?>
											<ul class="social-links">
												<?php 
												foreach($social_links as $k=>$v)
												{
													if(!empty($v))
													{
														echo '<li><a href="'.$v.'" target="_blank"><i class="fa fa-'.$k.'"></i></a></li>';
													}
												}
												?>
											</ul>
											<?php }} ?>
										</div>
									</div>
								</div>
								<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<?php if($bridesmaid_relatives->num_rows() > 0 ){ ?>
						<div class="tab-pane fade grid-wrapper <?php if($groomsmen_relatives->num_rows() == 0 ){ echo 'active'; } ?>" id="bridesmaid">
							<div class="row">
							<?php 
							
								foreach($bridesmaid_relatives->result() as $brow){
									$thumb_img_name = $myHelpers->global_lib->get_image_type('uploads/relatives/', $brow->image);
									if($thumb_img_name == '')
										$thumb_img_name = 'uploads/relatives/no_image_mans.jpg';
									else
										$thumb_img_name = 'uploads/relatives/'.$thumb_img_name;
							?>
							
								<div class="grid <?php echo $gb_grid_col; ?>">
									<div class="inner-grid">
										<div class="img-holder">
											<img src="<?php echo base_url().$thumb_img_name; ?>" class="img img-responsive"/>
											
										</div>
										<div class="details">
											<h3><?php echo  ucwords($brow->name);?></h3>
											
												<span><?php echo  ucwords($brow->relation_title);?></span>
											
											<?php if(isset($brow->social_meta) && !empty($brow->social_meta)) { 
												$social_links = json_decode($brow->social_meta,true);
												if(!empty($social_links))
												{
												
											?>
											<ul class="social-links">
												<?php 
												foreach($social_links as $k=>$v)
												{
													if(!empty($v))
													{
														echo '<li><a href="'.$v.'" target="_blank"><i class="fa fa-'.$k.'"></i></a></li>';
													}
												}
												?>
											</ul>
												<?php }} ?>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>