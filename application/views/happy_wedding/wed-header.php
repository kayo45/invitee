<!DOCTYPE html>
<html lang="en">
<head>
<?php 

$social_media = $myHelpers->global_lib->get_option('social_media');
$company_tel = $myHelpers->global_lib->get_option('company_tel');
$company_email = $myHelpers->global_lib->get_option('company_email');
$site_language = $myHelpers->global_lib->get_option('site_language');
$default_language = $myHelpers->global_lib->get_option('default_language');
$website_title = $myHelpers->global_lib->get_option('website_title');
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if(isset($page_title) && !empty($page_title)) { echo stripslashes($page_title).' | '; }?><?php echo $website_title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
	<?php echo link_tag("application/views/$theme/theme/css/themify-icons.css"); ?>
    <?php echo link_tag("application/views/$theme/theme/css/flaticon.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/bootstrap.min.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/animate.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/owl.carousel.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/owl.theme.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/slick.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/slick-theme.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/swiper.min.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/owl.transitions.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/jquery.fancybox.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/magnific-popup.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/style.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/plugins/bootstrap_switch_button/switch.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/font-awesome.min.css"); ?>
	<?php if($this->site_direction == 'rtl') { ?>
	
		<?php echo link_tag("application/views/$theme/theme/css/bootstrap-rtl.min.css"); ?>
		<?php echo link_tag("application/views/$theme/theme/css/style_rtl2.css"); ?>
	<?php } ?>
	
	
	<?php $custom_fonts_arr = array("Dosis:400,600","Great+Vibes","Sacramento","Niconne","Italianno","Berkshire+Swash","Orbitron","Seaweed+Script",);
	
			$custom_fonts = implode("|",$custom_fonts_arr);
	?>
	
	<link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=<?php echo $custom_fonts;?>"> 
		  
		  
	<script>
		var base_url = '<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>';
		var is_rtl = false;
		<?php if($this->site_direction == 'rtl') { ?>
		is_rtl = true;
	<?php } ?>
	</script>
	<?php echo script_tag("application/views/$theme/theme/js/jquery.min.js"); ?>
	
	<?php
		$style_theme = $myHelpers->global_lib->get_option('front_theme');
		$user_front_theme = $myHelpers->global_lib->get_user_meta($wedding_user_id,'front_theme');
		if(empty($user_front_theme)){
			$style_theme = $style_theme;
		}
		else
		{
			$style_theme = $user_front_theme;
		}
	?>
	<?php echo link_tag("application/views/$theme/theme/css/$style_theme.css"); ?>
	<?php echo link_tag("application/views/$theme/theme/css/responsive.css"); ?>
	
</head>




<body class="<?php echo $style_theme; ?>" <?php if(isset($cur_page) && $cur_page == 'home') { ?>id="home" <?php } ?>>
	
	<?php $this->load->view("$theme/wed-top-header"); ?>
	<?php $this->load->view($content); ?>
	<?php $this->load->view("$theme/wed-bottom-footer"); ?>

</html>