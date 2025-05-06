
<head>
	<?php
    $website_title 		= $myHelpers->global_lib->get_option('website_title'); 
	?>

	<meta charset="UTF-8">
    <title><?php if(isset($page_title) && !empty($page_title)) { echo stripslashes($page_title).' | '; }?><?php echo $website_title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<meta name="keywords" content="Digital marketing agency, Digital marketing company, Digital marketing services">
	<meta name="description" content="Babun is a beautiful website template designed for Business & Consulting websites.">
    <meta property="og:site_name" content="Babun">
    <meta property="og:url" content="https://solusiitkreasi.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Babun - Business & Consulting HTML5 Template">
	<meta name='og:image' content='template/babun/images/assets/ogg.png'>
	<!-- For IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- For Resposive Device -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- For Window Tab Color -->
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#1A4137">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#1A4137">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#1A4137">

	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="56x56" href="template/babun/images/fav-icon/icon.png">
	<!-- Bootstrap CSS -->
	<?php echo link_tag("template/babun/css/bootstrap.min.css"); ?>
	<!-- Main style sheet -->
	<?php echo link_tag("template/babun/css/style.min.css"); ?>
	<!-- responsive style sheet -->
	<?php echo link_tag("template/babun/css/responsive.css"); ?>

	<!-- Fix Internet Explorer ______________________________________-->
	<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->
</head>
