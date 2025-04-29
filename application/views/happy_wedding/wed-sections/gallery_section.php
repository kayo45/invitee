<?php 
global $settings;

if(!isset($wedding_id)) return false;

$gallery = $this->Common_model->commonQuery("select wg1.image_name as org,wg2.image_name as med,wg1.image_path
from wedding_gallery wg1 INNER JOIN wedding_gallery wg2 on wg2.parent_image_id = wg1.image_id and wg2.image_type = 'medium' WHERE wg1.image_type='original'
and wg2.wedding_id=$wedding_id ");
if(isset($gallery) && $gallery->num_rows() > 0){ ?> 
<section class="gallery-section section-padding" id="gallery">
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
				<div class="section-title1 section-title-new pos-rel">
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

		<div class="row">
			<div class="col col-xs-12">
				<div class="gallery-container gallery-fancybox masonry-gallery">
				<?php 
				foreach($gallery->result() as $rw){
					$thumb_img_name = $myHelpers->global_lib->get_image_type($rw->image_path, $rw->org);
				?>
					<div class="grid grid-item">
					
						<a href="<?php echo base_url().$rw->image_path.$rw->org; ?>" class="fancybox" data-fancybox-group="gall-1">
						<?php if(!empty($thumb_img_name)){ ?>
							<img src="<?php echo base_url().$rw->image_path.$thumb_img_name; ?>" alt class="img img-responsive">
							<?php } ?>
						</a>
					
					</div>
				<?php } ?>
				</div>
			</div>
		</div> 
	</div> 
</section>
<?php } ?>		