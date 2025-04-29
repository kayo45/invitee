<?php 

if(!isset($wedding_id)) return false;


$sliders = $this->Common_model->commonQuery("select * from wedding_slider Where wedding_id = $wedding_id ORDER BY img_order");
if($sliders->num_rows() > 0)
{
	global $settings;
	
	$wedding_date = $slider->wedding_date;
	$next_month = Date('m',strtotime('+1 month',time()));
	$next_year = Date('Y',strtotime('+1 month',time()));
	
	$wedding_date = strtotime($next_year."-".$next_month."-15");
?>
<span id="myDate"><?php echo date('Y/m/d',$wedding_date); ?></span>
<span id="curDate" style="display:none;"><?php echo date('Y/m/d',time()); ?></span>

<section class="hero-slider hero-style-1" id="slider">
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
		<div class="slide-main-text">
			<div class="container">
				
				<?php if(isset($wedding->row()->wedding_status) && ($wedding->row()->wedding_status != 'Got-Married')){?>
				<div class="slide-title">
					<h2 class="itl_fam"><?php echo $slider->wedding_title; ?></h2>
				</div>
				<div class="wedding-date">
					<span><?php echo date('M-d-Y',$wedding_date); ?></span>
				</div>
				<div class="clearfix"></div>
				
				<div class="count-down-clock">
					<div id="clock"></div>
				</div>
				<?php } ?>
			</div>
		</div>
		
		<div class="swiper-wrapper">
		<?php foreach($sliders->result() as $row){?>
			<div class="swiper-slide">
				<div class="slide-inner slide-bg-image" data-background="<?php echo base_url().'/uploads/slider/'.$row->slide_img; ?>"></div> 
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