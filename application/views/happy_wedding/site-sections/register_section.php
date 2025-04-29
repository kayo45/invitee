<?php global $settings; ?>
<section class="register-section invitation-section section-padding" id="register">
	<div class="container">
		<div class="row">
			<div class="col col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
				<div class="section-title1 section-title-new pos-rel">
					<?php 
					if(isset($settings['heading']) && $settings['heading'] != ''){?>
					<h2 class="bs_fam text-white"> <?php echo mlx_get_lang($settings['heading']); ?></h2>
					<?php } ?>
					<?php if(isset($settings['sub_heading']) && $settings['sub_heading'] != ''){?>
					<p class="rob_fam"><?php echo mlx_get_lang($settings['sub_heading']); ?></p>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-12 text-center">
				<a href="<?php echo base_url();?>register" class="theme-btn"><?php if(isset($settings['btn_text']) && $settings['btn_text'] != ''){ echo $settings['btn_text']; } else echo 'Register Now'; ?></a>
			</div>
		</div>
	</div>
</section>