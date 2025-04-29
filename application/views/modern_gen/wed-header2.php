<?php

    $social_media       = $myHelpers->global_lib->get_option('social_media');
    $company_tel        = $myHelpers->global_lib->get_option('company_tel');
    $company_email      = $myHelpers->global_lib->get_option('company_email');
    $site_language      = $myHelpers->global_lib->get_option('site_language');
    $default_language   = $myHelpers->global_lib->get_option('default_language');
    $website_title      = $myHelpers->global_lib->get_option('website_title');

	$cover = $this->Common_model->commonQuery("select * from wedding_slider where wedding_id = $wedding_id AND img_order='1' AND place='cover' ")->row_array();
?>


<!DOCTYPE html>
<html lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="UTF-8">
	<style type="text/css">
        .cui-comment-text img {
            max-width: 100% !important;
        }
    </style>


    <meta name='robots' content='noindex, follow' />
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $slider->wedding_title ?> | <?php echo $website_title; ?> </title>
	<meta name="description" content="You&#039;re Invited " />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $slider->wedding_title ?> | <?php echo $website_title; ?>" />
	<meta property="og:description" content="You&#039;re Invited" />
	<meta property="og:url" content="<?php echo  base_url($slider->site_name . '/' .$slider->id)?>" />
	<meta property="og:site_name" content="<?php echo $slider->wedding_title ?>" />
	<meta property="article:published_time" content="<?php echo date('d-m-Y H:i:s'); ?>" />
	<meta property="article:modified_time" content="<?php echo date('d-m-Y H:i:s'); ?>" />
	<meta property="og:image" content="<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$cover['slide_img']) ?>" />
	<meta property="og:image:width" content="1065" />
	<meta property="og:image:height" content="1600" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta name="author" content="<?php echo $slider->wedding_title ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:label1" content="Written by" />
	<meta name="twitter:data1" content="<?php echo $slider->wedding_title ?>" />
	<meta name="twitter:label2" content="Est. reading time" />
	<meta name="twitter:data2" content="2 minutes" />
	<meta name="google" content="notranslate"/>
    <link rel="icon" href="<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$cover['slide_img']) ?>" sizes="32x32" />
    <link rel="icon" href="<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$cover['slide_img']) ?>" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$cover['slide_img']) ?>" />
    <meta name="msapplication-TileImage" content="<?php echo str_replace('/', '\\/', base_url().'uploads/slider/'.$cover['slide_img']) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<?php $this->load->view("$theme/wed-css"); ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" />

	<link href="https://cdn.jsdelivr.net/npm/@icon/dashicons@0.9.0-alpha.4/dashicons.min.css" rel="stylesheet">

</head>




<!--<body class="<?php //echo $style_theme; ?>" <?php //if(isset($cur_page) && $cur_page == 'home') { ?>id="home" <?php //} ?>>-->


<body class="post-template post-template-elementor_canvas single single-post postid-99779 single-format-standard wp-custom-logo wp-embed-responsive ehf-template-generatepress 
ehf-stylesheet-generatepress right-sidebar nav-below-header separate-containers header-aligned-left dropdown-hover featured-image-active elementor-default elementor-template-canvas 
elementor-kit-10 elementor-page elementor-page-99779">

	<div data-elementor-type="wp-post" data-elementor-id="99779" class="elementor elementor-99779">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">

					<?php $this->load->view("$theme/wed-top-header"); ?>

					<?php $this->load->view("$theme/wed-body1"); ?>

					<?php $this->load->view("$theme/wed-body2"); ?>

                	<!-- <?php //$this->load->view($content); ?> -->

			</div>

		</div>

	</div>


	<?php $this->load->view("$theme/wed-bottom-footer"); ?>



