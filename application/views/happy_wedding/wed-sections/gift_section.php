<?php 
global $settings;

if(!isset($wedding_id) || !isset($wedding_user_id)) return false;


$user_gifts = $this->global_lib->get_user_meta($wedding_user_id,'my_gifts');
if($user_gifts){
	$user_gifts = json_decode($user_gifts,true);
	
}else $user_gifts = array();

$gift_lists = array();
foreach($user_gifts as $k => $gift){
	$gift_lists [] = $k;	
	
}
if(empty($gift_lists))
	return false;
$gifts = $this->Common_model->commonQuery("select * from wedding_gifts where gift_id in (".implode(",",$gift_lists).") ORDER BY  gift_id");
if($gifts->num_rows() > 0)
{
?>
<section class="partners-section section-padding" id="gift">
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
				<div class="partner-grids clearfix" id="registry">
					<?php 
					foreach($gifts->result() as $row){
					?>
					<div class="grid gift-block">
						<div class="gift_area">
						<a href="#" id="product_image">
						
						<img src="<?php 
						$thumb_img_name = $myHelpers->global_lib->get_image_type('uploads/gifts/', $row->image);
						if($thumb_img_name == '')
							$thumb_img_name = 'uploads/no-image.jpg';
						else
							$thumb_img_name = 'uploads/gifts/'.$thumb_img_name;
						echo base_url().$thumb_img_name; 
						?>" alt="<?php echo $row->title; ?>">
						
						</a>
						
						<div class="product_details">
							<div class="alignment">
								<div class="v-align center-middle">
									<h3 class="main-heading"><?php echo $row->title; ?></h3>
									<div class="sub-heading"><?php echo $row->description; ?></div>
									<?php 
									if(isset($_COOKIE['sender'])) {
										$cookie = json_decode($_COOKIE['sender']);
										$post = json_decode($_COOKIE['sender'],true);
									if($cookie->gift_id == $row->gift_id){?>
										
										<a class="de-button"  href="<?php echo base_url().'gifts/purchase/'.$row->slug; ?>"><?php echo 'Continue'; ?></a>
									
									<?php }else{?>
										<a class="de-button" href="<?php echo base_url().'gifts/purchase/'.$row->slug; ?>">Buy Now</a>
									<?php }?>
								<?php 
							}else{ ?>
								<a class="de-button" href="<?php echo base_url().'gifts/purchase/'.$row->slug; ?>">Buy Now</a>
							<?php } ?>
									
								</div>
							</div>
							
						</div>
						
						</div>
					</div>
					<?php }  ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>
