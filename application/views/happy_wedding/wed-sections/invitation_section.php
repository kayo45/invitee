<?php 

if(!isset($wedding_id)) return false;

$wd_result = $this->Common_model->commonQuery("select * from wedding_details 
where id = $wedding_id ");
if($wd_result->num_rows() > 0)
{
?>
<section class="invitation-section section-padding" id="invitation">
	<?php 
	$wedding_details = $wd_result->row();
	 ?>
	<div class="container">
		<div class="row">
			<div class="col col-xs-12">
				<div class="invitation-box">
					<div class="left-vec1 left-golden-rose"></div>
					<div class="right-vec"></div>
					<div class="inner">
						<h2><?php echo $wedding_details->wedding_title; ?></h2>
						<span>Inviting for the wedding</span>
						<p><?php echo date('M-D-Y',$wedding_details->wedding_date); ?> At <?php echo $wedding_details->wedding_time; ?> , <?php echo $wedding_details->wedding_venue; ?> </p>
						<h3>Save the Date</h3>
						<p class="date"><?php echo date('M-d-Y',$wedding_details->wedding_date); ?></p>
						<a href="#rsvp" class="theme-btn" id="scroll">RSVP now &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></a>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>