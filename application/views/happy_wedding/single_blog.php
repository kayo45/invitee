<section class="blog-main blog-details-content section-padding">
	<div class="container">
		<div class="row">
		<?php foreach($blog->result() as $row){ 
					$thumb_img_name = $myHelpers->global_lib->get_image_type('uploads/blogs/',$row->image,'origional');
					if($thumb_img_name == '')
						$img_path = 'uploads/no-image-big.jpg';
					else
						$img_path = 'uploads/blogs/'.$thumb_img_name;
			?>
			<div class="blog-content col col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="post">
					<div class="entry-header">
						<div class="entry-date-media">
							<div class="entry-date"><?php echo date('d',$row->created_on); ?><span><?php echo date('M',$row->created_on); ?></span></div>
							<div class="entry-media">
								<img src="<?php echo base_url().$img_path; ?>" class="img img-responsive" alt>
							</div>
						</div>
						
						<?php if(isset($row->cat_title) && !empty($row->cat_title)){ ?>
						<div class="entry-formet">
							<div class="entry-meta">
								<div class="cat">
									
										<i class="fa fa-tags"></i>&nbsp;<a href="<?php echo base_url().'blogs/category/'.$row->cat_slug;?>"><?php echo $row->cat_title;?></a>
									
								</div>
								
							</div>
						</div>
						<?php } else { echo '<br><br>'; } ?>	
						
						<div class="entry-title">
							<h3><?php echo $row->title;?></h3>
						</div>
					</div>

					<div class="entry-content">
													   
						 <p><?php echo $row->description; ?></p>
					   
						
					</div> 
					
					<ul class="shares">
						<li class="shareslabel"><h3>Share This Blog</h3></li>
						<li>
							<a class="w-inline-block social-share-btn share-facebook" 
								title="Share on Facebook" target="_blank" 
								onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li>
							<a class="w-inline-block social-share-btn share-twitter" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ' :%20 ' + encodeURIComponent(document.URL), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
						<li>
							<a class="w-inline-block social-share-btn share-googleplus" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-google-plus"></i>
							</a>
						</li>
						<li>
							<a class="w-inline-block social-share-btn share-pinterest" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' + encodeURIComponent(document.title), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-pinterest"></i>
							</a>
						</li>
						<li>
							<a class="w-inline-block social-share-btn share-tumblr" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.title), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-tumblr"></i>
							</a>
						</li>
						<li>
							<a class="w-inline-block social-share-btn share-email" target="_blank" title="Email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' + encodeURIComponent(document.URL), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-envelope"></i>
							</a>
						</li>
						
						<li>
							<a class="w-inline-block social-share-btn share-linkedin" target="_blank" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' + encodeURIComponent(document.title), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-linkedin"></i>
							</a>
						</li>
						<li>
							<a class="w-inline-block social-share-btn share-reddit" target="_blank" title="Submit to Reddit" onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' + encodeURIComponent(document.title), 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400,left=LEFT_POS,top=TOP_POST'); return false;">
								<i class="fa fa-reddit"></i>
							</a>
						</li>
					</ul>
					</div>                      
			</div> 
		<?php } ?>
		
			<div class="blog-sidebar col col-lg-4 col-md-4 col-sm-12 col-xs-12 sidebar">
		
				<?php if(isset($blog_categories) && $blog_categories->num_rows() > 0){ ?>
				<div class="widget widget_categories">
					<div class="widget_title">
						<h4><span><?php echo mlx_get_lang('Blog Categories'); ?></span></h4>
						</div>
					<ul class="arrows_list list_style">
						<?php foreach($blog_categories->result() as $b_row)
						{
							$cat_url = base_url(array('blogs/category',$b_row->cat_slug));	
							echo '<li><a href="'.$cat_url.'" >'.ucfirst($b_row->title);
							if($b_row->total_blog > 0)
								echo ' ('.$b_row->total_blog.')';
							echo '</a></li>';
						}?>
					</ul>
				</div>
				<?php } ?>
			
			
				<?php if(isset($recent_blogs) && $recent_blogs->num_rows() > 0){ ?>
				<div class="widget widget_categories">
					<div class="widget_title">
						<h4><span><?php echo mlx_get_lang('Recent Blog'); ?></span></h4>
						</div>
					<ul class="arrows_list list_style">
						<?php foreach($recent_blogs->result() as $b_row)
						{
							$blog_url = base_url(array('blogs',$b_row->slug));
							echo '<li><a href="'.$blog_url.'" >'.ucfirst($b_row->title);
							echo '</a></li>';
						}?>
					</ul>
				</div>
				<?php } ?>
			</div>
		</div> 
		
	</div> 
	
</section>