
<section class="blog-list-section blog-main section-padding">
	<div class="container">
		<div class="row">
			<div class="blog-content ">
			
			<?php foreach($blogs->result() as $row){ 
							
					$thumb_img_name = $myHelpers->global_lib->get_image_type('uploads/blogs/', $row->image);
							if($thumb_img_name == '')
								$img_path = 'uploads/no-image-big.jpg';
							else
								$img_path = 'uploads/blogs/'.$thumb_img_name;
			?>
				<div class="post col col-md-4">
					<div class="entry-header">
						<div class="entry-date-media">
							<div class="entry-date"><?php echo date('d',$row->created_on); ?><span><?php echo date('M',$row->created_on); ?></span></div>
							<div class="entry-media">
								<img src="<?php echo base_url().$img_path; ?>" class="img img-responsive">
							</div>
						</div>

						<div class="entry-formet">
							<div class="entry-meta">
								<div class="cat">
									<?php if(isset($row->cat_title) && !empty($row->cat_title)){ ?>
										<i class="fa fa-tags"></i> <a href="<?php echo base_url().'blogs/category/'.$row->cat_slug;?>"><?php echo $row->cat_title;?></a>
									<?php }else{ echo '&nbsp;'; } ?>
								</div>
								
							</div>
						</div>

						<div class="entry-title">
							<h3><a href="<?php echo base_url().'blogs/'.$row->slug;?>"><?php echo $row->title;?></a></h3>
						</div>
					</div> 

					<div class="entry-content">
						<p><?php echo $row->short_description; ?></p>
						<a href="<?php echo base_url().'blogs/'.$row->slug;?>" class="read-more">Read More</a>
					</div> 
				</div> 

			<?php } ?>
				
			</div> 

			
		</div> 
	</div> 
</section>
