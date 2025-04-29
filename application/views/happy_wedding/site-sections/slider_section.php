<?php 

$sliders = $this->Common_model->commonQuery("select * from site_slider ORDER BY img_order");
if($sliders->num_rows() > 0)
{
	global $settings;
?>
<section id="slider" class="hero-slider hero-style-1">
	<div class="swiper-container" 
		<?php 
		if($this->site_direction == 'rtl')
		{	echo ' dir="rtl" '; }
		?>
		
		<?php 
		if(isset($settings['auto_start_slider']) && $settings['auto_start_slider'] == 'yes') 
		{ 
			echo ' data-autoplay="Yes" ';
			if(isset($settings['slider_interval']) && $settings['slider_interval'] != '') {
				echo ' data-interval="'.$settings['slider_interval'].'" ';
			}
		} 
		?> >
		
		
		<div class="swiper-wrapper">
		<?php foreach($sliders->result() as $row){?>
			<div class="swiper-slide">
				<div class="slide-inner slide-bg-image" data-background="<?php echo base_url().'/uploads/site_slider/'.$row->slide_img; ?>"></div> 
			</div> 
		<?php } ?>
		   
		</div>
		
		<?php if(isset($settings['show_nav']) && $settings['show_nav'] == 'yes') { 
			echo '<div class="swiper-button-next"></div>
				  <div class="swiper-button-prev"></div>';
		} ?>
		<?php if(isset($settings['show_nav_dots']) && $settings['show_nav_dots'] == 'yes') { 
			echo '<div class="swiper-pagination"></div>';
		} ?>
		
		
	</div>
</section>
<?php } ?>