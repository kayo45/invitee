<?php 
global $settings;
if(!isset($wedding_id)) return false;
?>
<section id="couple" class="couple-section section-padding">
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
			<div class="about_topsign gv_fam">&amp;</div>
			<?php if((isset($wedding->row()->wedding_side) && $wedding->row()->wedding_side == 'groom') || !isset($wedding->row()->wedding_side)){?>
			<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="couple-area">
					<span class="names_titles">THE GROOM</span>
					<h2><?php echo $couple->row()->groom_name; ?></h2>
					<div class="about_pic_container">
						<span class="about_picframe"></span>
						<div class="about_pic">
							<img src="<?php echo  base_url().'uploads/weddings/'.$couple->row()->groom_photo; ?>" 
							alt="<?php echo $couple->row()->groom_name; ?>" >
						</div>
					</div>
					
					<div class="thumb_read_more">
						<?php if(isset($settings['show_social_media_icon']) && $settings['show_social_media_icon'] == 'yes'){ ?>
							<ul class="social-links">
							<?php 
								$data = json_decode($couple->row()->groom_social_links);
								foreach($data as $key=>$value){?>
								<li><a href="<?php echo $value; ?>"><i class="ti-<?php echo $key; ?>"></i></a></li>
							<?php }?>
							</ul>
						<?php }else echo '<br>'; ?>
					</div>
					
					<p><?php echo $couple->row()->groom_short_description; ?></p>
					
					<?php if(isset($settings['show_signature']) && $settings['show_signature'] == 'yes'){ ?>
						<?php if(isset($wedding->row()->groom_signature) && !empty($wedding->row()->groom_signature)){?>
							<div class="couple-signature sc_fam"><?php echo $wedding->row()->groom_signature; ?></div>
						<?php } ?>
					<?php } ?>
					
				</div>
			</div>
			<div class="col col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="couple-area">
					<span class="names_titles">THE BRIDE</span>
					<h2><?php echo $couple->row()->bride_name; ?></h2>
					<div class="about_pic_container">
						<span class="about_picframe"></span>
						<div class="about_pic">
							<img src="<?php echo  base_url().'uploads/weddings/'.$couple->row()->bride_photo; ?>" 
							alt="<?php echo $couple->row()->bride_name; ?>" >
						</div>
					</div>
					<div class="thumb_read_more">
						<?php if(isset($settings['show_social_media_icon']) && $settings['show_social_media_icon'] == 'yes'){ ?>
							<ul class="social-links">
								<?php 
								$data = json_decode($couple->row()->bride_social_links);
								foreach($data as $key=>$value){?>
								<li><a href="<?php echo $value; ?>"><i class="ti-<?php echo $key; ?>"></i></a></li>
								<?php } ?>  
							</ul>
						<?php }else echo '<br>'; ?>
					</div>
					
					<p><?php echo $couple->row()->bride_short_description; ?></p>
					
					<?php if(isset($settings['show_signature']) && $settings['show_signature'] == 'yes'){ ?>
						<?php if(isset($wedding->row()->bride_signature) && !empty($wedding->row()->bride_signature)){?>
							<div class="couple-signature sc_fam"><?php echo $wedding->row()->bride_signature; ?></div>
						<?php } ?>
					<?php } ?>
					
				</div>
			</div>
			<?php }else{ ?>
			<div class="col col-lg-6">
				<div class="couple-area">
					<span class="names_titles">THE BRIDE</span>
					<h2><?php echo $couple->row()->bride_name; ?></h2>
					<div class="about_pic_container">
						<span class="about_picframe"></span>
						<div class="about_pic">
							<img src="<?php echo  base_url().'uploads/weddings/'.$couple->row()->bride_photo; ?>" 
							alt="<?php echo $couple->row()->bride_name; ?>" >
						</div>
					</div>
					<div class="thumb_read_more">
						<ul class="social-links">
							<?php 
							$data = json_decode($couple->row()->bride_social_links);
							foreach($data as $key=>$value){?>
							<li><a href="<?php echo $value; ?>"><i class="ti-<?php echo $key; ?>"></i></a></li>
							<?php } ?>  
						</ul>
					</div>
					
					<p><?php echo $couple->row()->bride_short_description; ?></p>
					
					<?php if(isset($wedding->row()->bride_signature) && !empty($wedding->row()->bride_signature)){?>
						<div class="couple-signature sc_fam"><?php echo $wedding->row()->bride_signature; ?></div>
					<?php } ?>
					
				</div>
			</div>
			<div class="col col-lg-6">
				<div class="couple-area">
					<span class="names_titles">THE GROOM</span>
					<h2><?php echo $couple->row()->groom_name; ?></h2>
					<div class="about_pic_container">
						<span class="about_picframe"></span>
						<div class="about_pic">
							<img src="<?php echo  base_url().'uploads/weddings/'.$couple->row()->groom_photo; ?>" 
							alt="<?php echo $couple->row()->groom_name; ?>" >
						</div>
					</div>
					<div class="thumb_read_more">
					<ul class="social-links">
					<?php 
						$data = json_decode($couple->row()->groom_social_links);
						foreach($data as $key=>$value){?>
						<li><a href="<?php echo $value; ?>"><i class="ti-<?php echo $key; ?>"></i></a></li>
					<?php }?>
					</ul>
					</div>
					
					<p><?php echo $couple->row()->groom_short_description; ?></p>
					<?php if(isset($wedding->row()->groom_signature) && !empty($wedding->row()->groom_signature)){?>
						<div class="couple-signature sc_fam"><?php echo $wedding->row()->groom_signature; ?></div>
					<?php } ?>
					
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>