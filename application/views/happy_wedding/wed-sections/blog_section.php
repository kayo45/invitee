<?php 
global $settings;
$blog_limit = 6;
$blog_col_class = 'col-md-4';
if(isset($settings['no_of_items']) && $settings['no_of_items'] != '') 
{
	$blog_limit = $settings['no_of_items'];
}
if(isset($settings['no_of_item_in_grid']) && $settings['no_of_item_in_grid'] != '') 
{
	if($settings['no_of_item_in_grid'] == 3)
		$blog_col_class = 'col-md-4';
	else if($settings['no_of_item_in_grid'] == 4)
		$blog_col_class = 'col-md-3';
}
$today_timestamp = mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
$blogs = $this->Common_model->commonQuery("select b.* from blogs as b
left join blog_categories as bc on bc.c_id = b.cat_id
where b.status = 'publish' and b.publish_on <= $today_timestamp order by b.b_id DESC limit $blog_limit");
if($blogs->num_rows() > 0)
{
?>
<section class="blog-section section-padding" id="blogs">
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
			
				<div class="blog-grids clearfix">
				 <?php 
				 
				 if(isset($blogs) && !empty($blogs)) {
					foreach($blogs->result() as $row){
						
						$thumb_img_name = $myHelpers->global_lib->get_image_type('uploads/blogs/', $row->image,'medium');
							if($thumb_img_name == '')
								$img_path = 'uploads/no-image-big.jpg';
							else
								$img_path = 'uploads/blogs/'.$thumb_img_name;
						
					 ?>
					<div class="grid <?php echo $blog_col_class; ?>">
						<div class="entry-media">
							<img src="<?php echo base_url().$img_path; ?>"   alt="<?php echo $row->title; ?>" />
						</div>
						<div class="details">
							<h3><a href="<?php echo base_url().'blogs/'.$row->slug;?>" title="<?php echo $row->title; ?>"><?php echo $row->title; ?></a></h3>
							
						</div>
					</div>
						<?php }
						} ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>