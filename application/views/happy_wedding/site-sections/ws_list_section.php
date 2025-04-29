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
$ws_list = $this->Common_model->commonQuery("select wd.* from wedding_details as wd
where wd.payment_status = 'complete' and site_status = 'all-set-go'
order by wd.id DESC limit $blog_limit");
if($ws_list->num_rows() > 0)
{
?>
<section class="ws_list-section blog-section section-padding" id="wedding_site_list">
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
				 
				 if(isset($ws_list) && !empty($ws_list)) {
					foreach($ws_list->result() as $row){
						
						if(empty($row->wedding_title))
							continue;
					 ?>
					<div class="grid <?php echo $blog_col_class; ?>">
						<div class="entry-media sc_fam">
							<a href="<?php echo base_url().$row->site_name;?>" target="_blank" 
							title="<?php echo $row->site_name; ?>">
							<?php 
							$exp_by_end = explode('-weds-',$row->site_name); 
							if(count($exp_by_end) > 1)
							{
								echo ucwords($exp_by_end[0]).'<br>&<br>'.ucwords($exp_by_end[1]);
							}
							else
							{
								echo $row->site_name;
							}
							?>
							</a>
						</div>
						<div class="details">
							<h3 class="text-center "><a href="<?php echo base_url().$row->site_name;?>" target="_blank" 
							title="<?php echo $row->wedding_title; ?>"><?php echo $row->wedding_title; ?></a></h3>
							
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