<?php 
global $settings;

if(!isset($wedding_id)) return false;

$story_result = $this->Common_model->commonQuery("select * from wedding_story
									where wedding_id = $wedding_id	
									ORDER BY story_order ASC");
if($story_result->num_rows() > 0)
{
?>
<section class="story-section section-padding" id="story">
	<div class="container">
		<div class="row ">
			<div class="col col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 ">
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
			<div class="col col-lg-10 col-lg-offset-1">
				<div class="story-block">
					<ul>
						<?php 
							$i=0;
							
						foreach($story_result->result() as $row){
							
							$thumb_img_name = $myHelpers->global_lib->get_image_type('uploads/story/', $row->image);
							if($thumb_img_name == '')
								$thumb_img_name = 'uploads/no-image.jpg';
							else
								$thumb_img_name = 'uploads/story/'.$thumb_img_name;
							
							if($i%2 == 0){
							
						?>
						<li>
						
							<div class="details">
								<h3 class="itl_fam"><?php echo $row->title; ?></h3>
								<span class="date"><?php echo date('d-M-Y',$row->date); ?></span>
								<p>
								<?php echo $row->content; ?>
								</p>
							</div>
							<div class="img-holder">
								<img src="<?php echo base_url().$thumb_img_name; ?>" alt >
							</div>
						</li>
					<?php 
							}else{
					?>
					<li>
					<div class="img-holder">
								<img src="<?php echo base_url().$thumb_img_name; ?>" alt >
							</div>
							<div class="details">
								<h3 class="itl_fam"><?php echo $row->title; ?></h3>
								<span class="date"><?php echo date('d-M-Y',$row->date); ?></span>
								<p>
								<?php echo $row->content; ?>
								</p>
							</div>
							
						</li>
					<?php	
								
							}
						$i++;
					
					}?>                         
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>