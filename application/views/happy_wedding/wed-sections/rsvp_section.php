<?php 

global $settings;

if(!isset($wedding_id)) return false;

$event_result = $this->Common_model->commonQuery("select * from wedding_event  Where wedding_id=$wedding_id ORDER BY event_id ASC");
?>
<section class="contact-section section-padding" id="rsvp">
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
			<div class="col col-lg-10 col-lg-offset-1">
				<div class="contact-form">
					<form id="rsvp-form" class="form validate-rsvp-form row" method="post" >
						<div class="col col-sm-6">
							<input type="text" name="name" class="form-control" placeholder="Your Name*" 
							value="<?php if(isset($_GET['name']) && !empty($_GET['name'])) echo $_GET['name']; ?>">
						</div>
						<div class="col col-sm-6">
							<input type="email" name="email" class="form-control" placeholder="Your Email*" 
							value="<?php if(isset($_GET['email']) && !empty($_GET['email'])) echo $_GET['email']; ?>">
						</div>
						<div class="col col-sm-12">
							<select class="form-control" name="guest" >
								<option disabled selected>Number Of Guest*</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div>
						 <div class="col col-sm-12">
							<label for="toggle-one">Are You ?</label>
							<input id="toggle-one" checked type="checkbox" data-width="190" data-onstyle="switcher" name="are_you" value="yes">
						  
						</div>
						<div class="col col-sm-12" id="functions">
						  <div class="checkbox">
						  <?php foreach( $event_result->result() as $row){?>
							<label>
							<input type="checkbox" id="#" name="events[]" value="<?php echo $row->event_id; ?>" 
							class="checkboxs">
							<?php echo $row->event_title; ?>
							</label>
						  <?php } ?>
							 
						  </div>
						</div>
						<div class="col col-sm-12">
							<textarea class="form-control" name="notes" placeholder="Your Message*"></textarea>
						</div>
						<div class="col col-sm-12 submit-btn">
							<button type="submit" class="theme-btn">Send RSVP &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
							<div id="loader">
								<i class="ti-reload"></i>
							</div>
						</div>
						<div class="col col-md-12 success-error-message">
							<div id="success"></div>
							
							<div id="error">Some Went Wrong</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
		