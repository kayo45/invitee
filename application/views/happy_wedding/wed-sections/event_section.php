<?php 
global $settings;

if(!isset($wedding_id)) return false;

$event_result = $this->Common_model->commonQuery("select * from wedding_event
									where wedding_id = $wedding_id
									ORDER BY event_id ASC");
if($event_result->num_rows() > 0)
{
	
?>

<section class="event-section section-padding p-t-0" id="events">
	<div class="top-area">
		<?php 
		if(isset($settings['heading']) && $settings['heading'] != ''){?>
		<h2 > <?php echo mlx_get_lang($settings['heading']); ?></h2>
		<?php } ?>
		<div class="section-title1 section-title-new pos-rel">
			<?php if(isset($settings['sub_heading']) && $settings['sub_heading'] != ''){ ?>
			<p class="rob_fam"><?php echo mlx_get_lang($settings['sub_heading']); ?></p>
			<?php } ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col col-xs-12">
				<div class="event-grids event-container" 
				<?php 
				if($this->site_direction == 'rtl')
				{	echo ' dir="rtl" '; }
				?>
				<?php 
				if(isset($settings['auto_start']) && $settings['auto_start'] == 'yes') 
				{ 
					echo ' data-autoplay="Yes" ';
					if(isset($settings['carousel_interval']) && $settings['carousel_interval'] != '') {
						echo ' data-interval="'.$settings['carousel_interval'].'" ';
					}
				} 
				
				if(isset($settings['no_of_event_in_carousel']) && $settings['no_of_event_in_carousel'] != '') {
					echo ' data-no_of_event="'.$settings['no_of_event_in_carousel'].'" ';
				}
				 ?>
				>
				<?php if($event_result->num_rows()>= 4 ){ ?>
					<div class="swiper-wrapper">
						<?php  foreach($event_result->result() as $row){?>
							<div class="swiper-slide ">
								<div class="swiper-inner ">
									<div class="no-margin">
										<h3><?php echo $row->event_title; ?></h3>
										<h4 class="event_date"><?php echo date('l, F Y',$row->event_date); ?></h4>
										<h4 class="event_time"><?php echo $row->event_time; ?></h4>
										<p><?php echo $row->event_venue; ?></p>
										<?php if(!empty($row->contact_number)) { ?>
											<p class="phone">Ph: <?php echo $row->contact_number; ?></p>
										<?php } ?>
										<?php if(!empty($row->openstreetmap_embed_code)){ ?>
										<a href="<?php echo $row->openstreetmap_embed_code; ?>" class="location popup-gmaps">Venue</a>
										<?php } ?>
									</div>
								</div>
							</div> 
						<?php } ?>
					</div>
							<?php if(isset($settings['show_nav']) && $settings['show_nav'] == 'yes') { ?>
								<div class="event-button-next"></div>
								<div class="event-button-prev"></div>
							<?php } ?>
						<div class="slide_bg">
							
							<?php if(isset($settings['show_nav_dots']) && $settings['show_nav_dots'] == 'yes') { ?>
								<div class="event-pagination"></div>
							<?php } ?>
						</div>
					<?php }else{
						$n=0;
						foreach($event_result->result() as $row){
							$n++;
						$offset_class = '';
						$offset_class2 = '';
						if($event_result->num_rows() == 1){
							$offset_class = 'col-md-offset-4';
						}elseif($event_result->num_rows() == 2){
							$offset_class = 'col-md-offset-1';
							$offset_class2 = 'col-md-offset-2';
						}
					?>
					<div class=" col-md-4 <?php if($n>1) echo $offset_class2 ;else echo $offset_class; ?>  ">
						<div class="no-margin">
						<h3><?php echo $row->event_title; ?></h3>
						<h4 class="event_date"><?php echo date('l, F Y',$row->event_date); ?></h4>
						<h4 class="event_time"><?php echo $row->event_time; ?></h4>
						<p><?php echo $row->event_venue; ?></p>
						<?php if(!empty($row->contact_number)) { ?>
							<p class="phone">Ph: <?php echo $row->contact_number; ?></p>
						<?php } ?>
						<a href="<?php echo $row->openstreetmap_embed_code; ?>" class="location popup-gmaps">Venue</a>
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