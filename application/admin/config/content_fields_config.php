<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


	$config ['slide_fields'] = array(); 
	
											
 
	$config ['slide_fields'] []  = array( 	'id'=> 'heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['slide_fields'] []  = array( 	'id'=> 'content', 'name' => 'content', 'title' => 'Content', 
											'type' => 'textarea',	'required' => 'required', 'default' => '', );
											
											

	$config ['slide_fields'] []  = array( 	'id'=> 'button1_text', 'name' => 'button1_text', 'title' => 'Button1 Text', 
											'type' => 'text-field',	'required' => '', 'default' => 'Read More', );

	$config ['slide_fields'] []  = array( 	'id'=> 'button1_url', 'name' => 'button1_url', 'title' => 'Button1 URL', 
											'type' => 'url-field',	'required' => '', 'default' => '', );

	$config ['slide_fields'] []  = array( 	'id'=> 'button2_text', 'name' => 'button2_text', 'title' => 'Button2 Text', 
											'type' => 'text-field',	'required' => '', 'default' => 'Read More', );

	$config ['slide_fields'] []  = array( 	'id'=> 'button2_url', 'name' => 'button2_url', 'title' => 'Button2 URL', 
											'type' => 'url-field',	'required' => '', 'default' => '', );
											
	$config ['slide_fields'] []  = array( 	'id'=> 'select_slider', 'name' => 'select_slider', 'title' => 'Select Slider', 
											'type' => 'select-field',	'required' => '', 'default' => '',
											'title_field' => 'slider_title', 'content_field' => 'slider',
											 );

	$config ['slide_fields'] []  = array( 	'id'=> 'slider_image', 'name' => 'slider_image', 'title' => 'Slide Image', 
											'type' => 'file-image-ajax',	'required' => '', 'attributes' => array('accept' => 'image/*')
											 );
	
	//slider flieds title page for 
	
	$config ['slider_fields'] = array(); 
 
	$config ['slider_fields'] []  = array( 	'id'=> 'slider_title', 'name' => 'slider_title', 'title' => 'Title of The slider', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
											
	$config ['slider_fields'] []  = array( 	'id'=> 'slider_for', 'name' => 'slider_for', 'title' => 'Slider for', 
											'type' => 'select-field',	'required' => 'required', 'default' => '', 
											'options' => 'default_pages'
											);										
											
	// gallery flieds
	$config ['gallery_fields'] = array(); 
 
	$config ['gallery_fields'] []  = array( 	'id'=> 'gallery_id', 'name' => 'gallery_title', 'title' => 'Title of The gallery', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
	$config ['gallery_fields'] []  = array( 	'id'=> 'gallery_content_id', 'name' => 'gallery_content', 'title' => 'Content of The gallery', 
											'type' => 'textarea',	'required' => 'required', 'default' => '','max-width'=>'200px' );
											
	//rsvp_fields
	$config ['rsvp_fields'] = array(); 
 
	$config ['rsvp_fields'] []  = array( 	'id'=> 'rsvp_name', 'name' => 'rsvp_name', 'title' => 'rsvp Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['rsvp_fields'] []  = array( 	'id'=> 'rsvp_url', 'name' => 'rsvp_url', 'title' => 'Url Link', 
											'type' => 'url-field',	'required' => 'required', 'default' => '', );
											
	$config ['rsvp_fields'] []  = array( 	'id'=> 'photo', 'name' => 'photo', 'title' => 'Photo', 
											'type' => 'file-image-ajax',	'required' => '', 'attributes' => array('accept' => 'image/*')
											 );

	
	
	$config ['price_fields'] = array(); 
 
	$config ['price_fields'] []  = array( 	'id'=> 'icon_id', 'name' => 'icon', 'title' => 'Icon', 
											'type' => 'icon-field',	'required' => 'required', 'default' => '', );
											
	$config ['price_fields'] []  = array( 	'id'=> 'price_title', 'name' => 'price_title', 'title' => 'Title', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['price_fields'] []  = array( 	'id'=> 'price_id', 'name' => 'price', 'title' => 'Price', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
	$config ['price_fields'] []  = array( 	'id'=> 'subtitle', 'name' => 'priceSubtitle', 'title' => 'SubTitle', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['price_fields'] []  = array( 	'id'=> 'price_text', 'name' => 'price_text', 'title' => 'Text', 
											'type' => 'text-editor',	'required' => 'required', 'default' => '', );
											
	$config ['price_fields'] []  = array( 	'id'=> 'is_featured', 'name' => 'is_featured', 'title' => 'Is Featured?', 
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'options' => 'yes_no_options'
											 );
											
	$config ['price_fields'] []  = array( 	'id'=> 'button_text', 'name' => 'button_text', 'title' => 'Button Text', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['price_fields'] []  = array( 	'id'=> 'button_url', 'name' => 'button_url', 'title' => 'Button URL', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	
	
	$config ['gift_category_fields'] = array(); 
 
	$config ['gift_category_fields'] []  = array( 	'id'=> 'category_name', 'name' => 'category_name', 'title' => 'Category Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['gift_category_fields'] []  = array( 	'id'=> 'status', 'name' => 'status', 'title' => 'Status', 
											'type' => 'select-field',	'required' => 'required', 'default' => 'inactive', 'options'=>'active_inactive' );
	
	
	$config ['gift_fields'] = array(); 
 
	$config ['gift_fields'] []  = array( 	'id'=> 'gift_name', 'name' => 'gift_name', 'title' => 'Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['gift_fields'] []  = array( 	'id'=> 'Short-Content', 'name' => 'Short-Content', 'title' => 'Short Content', 
											'type' => 'textarea',	'required' => 'required', 'default' => '', );
	
	$config ['gift_fields'] []  = array( 	'id'=> 'content', 'name' => 'content', 'title' => 'Content', 
											'type' => 'textarea',	'required' => 'required', 'default' => '', );
											
	$config ['gift_fields'] []  = array( 	'id'=> 'rsvp-Name', 'name' => 'rsvp-Name', 'title' => 'rsvp Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['gift_fields'] []  = array( 	'id'=> 'rsvp-company', 'name' => 'rsvp-company', 'title' => 'rsvp Company', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
											
	$config ['gift_fields'] []  = array( 	'id'=> 'start-date', 'name' => 'start-date', 'title' => 'Start Date', 
											'type' => 'date-field',	'required' => 'required', 'default' => '', 
											'class' => 'from_date','attributes' => array('autocomplete'=>'off'),);
	
	$config ['gift_fields'] []  = array( 	'id'=> 'end-date', 'name' => 'end-date', 'title' => 'End Date', 
											'type' => 'date-field',	'required' => 'required', 'default' => '', 
											'class' => 'to_date','attributes' => array('autocomplete'=>'off'),);
											
	$config ['gift_fields'] []  = array( 	'id'=> 'website', 'name' => 'website', 'title' => 'Website', 
											'type' => 'url-field',	'required' => 'required', 'default' => '', );
											
	$config ['gift_fields'] []  = array( 	'id'=> 'cost', 'name' => 'cost', 'title' => 'Cost', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['gift_fields'] []  = array( 	'id'=> 'rsvp-comment', 'name' => 'rsvp-comment', 'title' => 'rsvp Comment', 
											'type' => 'textarea',	'required' => 'required', 'default' => '', );
	
	$config ['gift_fields'] []  = array( 	'id'=> 'photo', 'name' => 'photo', 'title' => 'Photo', 
											'type' => 'file-image-ajax',	'required' => '', 'attributes' => array('accept' => 'image/*')
											 );
											
	$config ['gift_fields'] []  = array( 'id'=> 'gift_category', 'name' => 'gift_category', 
												'title' => 'Select Category', 
											'type' => 'select-field',	'required' => 'required', 'default' => '',
											//'options' => 'gift_db_categories' , 
											'title_field' => 'category_name',
											'content_field' => 'gift_category'
											 );
											
	
	//gift  fields ends
											
	//servies fields
	
	$config ['services_fields'] = array(); 
 
	$config ['services_fields'] []  = array( 	'id'=> 'services_name', 'name' => 'service_name', 'title' => 'Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['services_fields'] []  = array( 	'id'=> 'service_short_description', 'name' => 'short_desciption', 'title' => 'Short Description', 
											'type' => 'textarea',	'required' => 'required', 'default' => '');
											
	$config ['services_fields'] []  = array( 	'id'=> 'service_description', 'name' => 'desciption', 'title' => 'Description', 
											'type' => 'text-editor',	'required' => 'required', 'default' => '');
											
	$config ['services_fields'] []  = array( 'id'=> 'photo', 'name' => 'photo', 'title' => 'Photo', 
											'type' => 'file-image-ajax',	'required' => '', 'attributes' => array('accept' => 'image/*'));
											
	//services_fields ends	
	
	
	//Our blog fields
	
	$config ['blog_fields'] = array(); 
 
	$config ['blog_fields'] []  = array( 	'id'=> 'icon_id', 'name' => 'icon', 'title' => 'Icon', 
											'type' => 'icon-field',	'required' => 'required', 'default' => '', );
											
	$config ['blog_fields'] []  = array( 	'id'=> 'title_id', 'name' => 'title', 'title' => 'Title', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['blog_fields'] []  = array( 	'id'=> 'dscription_id', 'name' => 'description', 'title' => 'Description', 
											'type' => 'text-editor',	'required' => 'required', 'default' => '');
											
											
	//Our_blog ends	
	
	//Our services fields
	
	$config ['blog_fields'] = array(); 
 
	$config ['blog_fields'] []  = array( 	'id'=> 'photo', 'name' => 'photo', 'title' => 'Photo', 
											'type' => 'icon-field',	'required' => 'required', 'default' => '', );
											
	$config ['blog_fields'] []  = array( 	'id'=> 'title_id', 'name' => 'title', 'title' => 'Title', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['blog_fields'] []  = array( 	'id'=> 'dscription_id', 'name' => 'description', 'title' => 'Description', 
											'type' => 'text-editor',	'required' => 'required', 'default' => '');
											
											
	//Our_services ends	
	
	
	//Our blog fields
	
	$config ['features_fields'] = array(); 
 
	$config ['features_fields'] []  = array( 	'id'=> 'icon_id', 'name' => 'icon', 'title' => 'Icon', 
											'type' => 'icon-field',	'required' => 'required', 'default' => '', );
											
	$config ['features_fields'] []  = array( 	'id'=> 'title_id', 'name' => 'title', 'title' => 'Title', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['features_fields'] []  = array( 	'id'=> 'dscription_id', 'name' => 'description', 'title' => 'Description', 
											'type' => 'text-editor',	'required' => 'required', 'default' => '');							
	//Our_blog ends	
	
	
											
	$config['default_pages'] =  array();
	$config['default_pages'] ["home"] = "Home";
	$config['default_pages'] ["contact"] = "Contact"; 
	
	$config['gift_db_categories'] =  array();
	
	
	$config['yes_no_options'] =  array();
	$config['yes_no_options'] ['yes'] = "Yes";  
	$config['yes_no_options'] ['no'] = "No";  		

	$config['active_inactive'] ['active'] = "Active";  
	$config['active_inactive'] ['inactive'] = "inactive";  
	//end slider
											
	$config ['people_fields'] = array(); 
 
	$config ['people_fields'] []  = array('id'=> 'rsvp_name', 'name' => 'rsvp_name', 'title' => 'rsvp Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
	$config ['people_fields'] []  = array('id'=> 'designation', 'name' => 'designation', 'title' => 'Designation', 
											'type' => 'text-field',	'required' => 'required', 'default' => '', );
											
											
	$config ['people_fields'] []  = array( 	'id'=> 'photo', 'name' => 'photo', 'title' => 'Photo', 
											'type' => 'file-image-ajax',	'required' => '', 'attributes' => array('accept' => 'image/*')
											 );
											
											
	$config ['people_fields'] []  = array('id'=> 'comment', 'name' => 'comment', 'title' => 'Comment', 
											'type' => 'textarea',	'required' => 'required', 'default' => '', );
	
	//Our event fields
	
	$config ['event_fields'] = array(); 
 
											
	$config ['event_fields'] []  = array( 	'id'=> 'photo', 'name' => 'photo', 'title' => 'Photo', 
											'type' => 'file-image-ajax',	'required' => '', 'attributes' => array('accept' => 'image/*')
											 );
											
	$config ['event_fields'] []  = array( 	'id'=> 'name_id', 'name' => 'name', 'title' => 'Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['event_fields'] []  = array( 	'id'=> 'designation_id', 'name' => 'designation', 'title' => 'Designation', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['event_fields'] []  = array( 	'id'=> 'description_id', 'name' => 'description', 'title' => 'Description', 
											'type' => 'text-editor',	'required' => 'required', 'default' => '');	

	$config ['event_fields'] []  = array( 	'id'=> 'fb_id', 'name' => 'facebook_link', 'title' => 'Faceook Link', 
											'type' => 'url-field',	'required' => 'required', 'default' => '');	
											
	$config ['event_fields'] []  = array( 	'id'=> 'tw_id', 'name' => 'twitter_link', 'title' => 'Twitter Link', 
											'type' => 'url-field',	'required' => 'required', 'default' => '');	
											
	$config ['event_fields'] []  = array( 	'id'=> 'g_id', 'name' => 'google_link', 'title' => 'Google Link', 
											'type' => 'url-field',	'required' => 'required', 'default' => '');	
	// our event ends	

    //Contact fields
	
	$config ['contact_fields'] = array(); 
 
											
	$config ['contact_fields'] []  = array( 	'id'=> 'photo', 'name' => 'photo', 'title' => 'Photo', 
											'type' => 'file-image-ajax',	'required' => '', 'attributes' => array('accept' => 'image/*')
											 );
											
	$config ['contact_fields'] []  = array( 	'id'=> 'name_id', 'name' => 'name', 'title' => 'Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['contact_fields'] []  = array( 	'id'=> 'designation_id', 'name' => 'designation', 'title' => 'Designation', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['contact_fields'] []  = array( 	'id'=> 'description_id', 'name' => 'description', 'title' => 'Description', 
											'type' => 'text-editor',	'required' => 'required', 'default' => '');	

	$config ['contact_fields'] []  = array( 	'id'=> 'fb_id', 'name' => 'facebook_link', 'title' => 'Faceook Link', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');	
											
	$config ['contact_fields'] []  = array( 	'id'=> 'tw_id', 'name' => 'twitter_link', 'title' => 'Twitter Link', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');	
											
	$config ['contact_fields'] []  = array( 	'id'=> 'g_id', 'name' => 'google_link', 'title' => 'Google Link', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');	
	// Contact ends	
	
	
	//Contact-page fields
	
	$config ['contact_page_fields'] = array(); 
 							
	$config ['contact_page_fields'] []  = array( 	'id'=> 'name_id', 'name' => 'name', 'title' => 'Name', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['contact_page_fields'] []  = array( 	'id'=> 'contact_number_id', 'name' => 'contact_number', 'title' => 'Phone Number', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['contact_page_fields'] []  = array( 	'id'=> 'contact_email_id', 'name' => 'contact_email', 'title' => 'Email Address', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['contact_page_fields'] []  = array( 	'id'=> 'contact_subject_id', 'name' => 'contact_subject', 'title' => 'Subject', 
											'type' => 'text-field',	'required' => 'required', 'default' => '');
											
	$config ['contact_page_fields'] []  = array( 	'id'=> 'contact_message_id', 'name' => 'contact_message', 'title' => 'Message', 
											'type' => 'text-area',	'required' => 'required', 'default' => '');
											
	


	$config ['wed_content_sections'] = array();  
	
	$config ['wed_content_sections'] ["slider_section"] = array('title' => 'Slider Section');  

	$config ['slider_section_fields'] = array();  
	
	$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_show_nav', 'name' => 'show_nav', 'title' => 'Show Navigation Icon?', 
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'options' => 'yes_no_options'
											 );
	
	$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_show_nav_dots', 'name' => 'show_nav_dots', 'title' => 'Show Navigation Dots?', 
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'options' => 'yes_no_options'
											 );
	
	$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_auto_start_slider', 'name' => 'auto_start_slider', 'title' => 'Auto Start', 
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'class' => 'show_hide_block_btn', 
											'attributes' => array('data-target'=>'slider_block_related'),
											'options' => 'yes_no_options'
											 );
	
	$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_interval', 'name' => 'slider_interval', 'title' => 'Interval', 
											'parent_class' => 'slider_block_related yes_block',
											'type' => 'number-field',	'required' => 'required', 'default' => '6500', 'min' => '1000', 'step' => '500');
											
	
	/* Couple Section */	
	
	$config ['wed_content_sections'] ["couple_section"] = array('title' => 'Couple Section');  
	
	$config ['couple_section_fields'] = array();  
	
	$config ['couple_section_fields'] []  = array( 	'id'=> 'couple_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Happy Couple', );
	
	$config ['couple_section_fields'] []  = array( 	'id'=> 'couple_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );
	
	$config ['couple_section_fields'] []  = array( 	'id'=> 'couple_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#couple', );
	
	$config ['couple_section_fields'] []  = array( 	'id'=> 'couple_show_social_media_icon', 'name' => 'show_social_media_icon', 'title' => 'Show Social Media Icon?', 
											'type' => 'radio-toggle', 'default' => 'yes',
											'options' => 'yes_no_options'
											 );
	
	$config ['couple_section_fields'] []  = array( 	'id'=> 'couple_show_signature', 'name' => 'show_signature', 'title' => 'Show Signature?', 
											'type' => 'radio-toggle', 'default' => 'yes',
											'options' => 'yes_no_options'
											 );
	
	$config ['wed_content_sections'] ["invitation_section"] = array('title' => 'Invitation Section');  

	$config ['invitation_section_fields'] = array();  
 
	$config ['invitation_section_fields'] []  = array( 	'id'=> 'invitation_bg_color', 'name' => 'bg_color', 'title' => 'Background Color', 
											
											'type' => 'text-field',	'default' => '#9E020C', );
	
	
	$config ['invitation_section_fields'] []  = array( 	'id'=> 'invitation_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#invitation', );
	
	$config ['wed_content_sections'] ["story_section"] = array('title' => 'Story Section');  

	$config ['story_section_fields'] = array();  
 
	$config ['story_section_fields'] []  = array( 	'id'=> 'story_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Our story', );
	
	$config ['story_section_fields'] []  = array( 	'id'=> 'story_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );	
	
	$config ['story_section_fields'] []  = array( 	'id'=> 'story_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#story', );
	
	$config ['wed_content_sections'] ["event_section"] = array('title' => 'Event Section');  

	$config ['event_section_fields'] = array();  
 	
	$config ['event_section_fields'] []  = array( 	'id'=> 'event_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Celebrate Our Love', );
	
	$config ['event_section_fields'] []  = array( 	'id'=> 'event_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );								
	
	$config ['event_section_fields'] []  = array( 	'id'=> 'event_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#events', );
	
	$config ['event_section_fields'] []  = array( 	'id'=> 'no_of_event_in_carousel', 'name' => 'no_of_event_in_carousel', 'title' => 'No. of Events', 
											'parent_class' => 'our_event_grid_block_related carousel_block',
											'type' => 'number-field',	'required' => 'required', 'default' => '3', 'min' => '0', 'step' => '1' , 'max' => 5);											
	
	$config ['event_section_fields'] []  = array( 	'id'=> 'show_nav_in_event_carousel', 'name' => 'show_nav', 'title' => 'Show Navigation Icon?', 
											'parent_class' => 'our_event_grid_block_related carousel_block',
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'options' => 'yes_no_options'
											 );
	
	$config ['event_section_fields'] []  = array( 	'id'=> 'show_nav_dots_in_event_carousel', 'name' => 'show_nav_dots', 'title' => 'Show Navigation Dots?', 
											'parent_class' => 'our_event_grid_block_related carousel_block',
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'options' => 'yes_no_options'
											 );
	
	$config ['event_section_fields'] []  = array( 	'id'=> 'auto_start_in_event_carousel', 'name' => 'auto_start', 'title' => 'Auto Start', 
											'parent_class' => 'our_event_grid_block_related carousel_block',
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'class' => 'show_hide_block_btn', 
											'attributes' => array('data-target'=>'event_slider_block_related'),
											'options' => 'yes_no_options'
											 );
	
	$config ['event_section_fields'] []  = array( 	'id'=> 'event_carousel_interval', 'name' => 'carousel_interval', 'title' => 'Interval', 
											'parent_class' => 'event_slider_block_related yes_block our_event_grid_block_related',
											'type' => 'number-field',	'required' => 'required', 'default' => '5000', 'min' => '0', 'step' => '500');
											
	
	// peoples admin side		
	$config ['wed_content_sections'] ["people_section"] = array('title' => 'People Section');  

	$config ['people_section_fields'] = array();  
 
	
	$config ['people_section_fields'] []  = array( 	'id'=> 'people_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Groomsmen & Bridesmaid', );
	
	$config ['people_section_fields'] []  = array( 	'id'=> 'people_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );								
	
	$config ['people_section_fields'] []  = array( 	'id'=> 'people_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#people', );
										
    $config ['people_section_fields'] []  = array( 	'id'=> 'no_of_people_in_grid', 'name' => 'no_of_item_in_grid', 'title' => 'No. of People in a Row', 
											'type' => 'number-field',	'required' => 'required', 'default' => '3', 'min' => '3', 'step' => '1', 'max' => '4');	
											
	
// peoples admin side end

// gallery admin side		
	$config ['wed_content_sections'] ["gallery_section"] = array('title' => 'Gallery Section');  

	$config ['gallery_section_fields'] = array();  
 
	
	$config ['gallery_section_fields'] []  = array( 	'id'=> 'gallery_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Captured Moments', );
	
	$config ['gallery_section_fields'] []  = array( 	'id'=> 'gallery_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );								
	
	$config ['gallery_section_fields'] []  = array( 	'id'=> 'gallery_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#gallery', );
											
// gallery admin side end

// rsvp admin side		
	$config ['wed_content_sections'] ["rsvp_section"] = array('title' => 'RSVP Section');  

	$config ['rsvp_section_fields'] = array();  
 
	
	
	$config ['rsvp_section_fields'] []  = array( 	'id'=> 'rsvp_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Are you attending?', );
	
	$config ['rsvp_section_fields'] []  = array( 	'id'=> 'rsvp_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );								
	
	$config ['rsvp_section_fields'] []  = array( 	'id'=> 'rsvp_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#rsvp', );
	
	// rsvp admin side end

	// gift admin side	
	
	/*
	$config ['wed_content_sections'] ["gift_section"] = array('title' => 'Gift Section');  

	$config ['gift_section_fields'] = array();  
 
	
	$config ['gift_section_fields'] []  = array( 	'id'=> 'gift_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Gifts You will love to send', );
	
	$config ['gift_section_fields'] []  = array( 	'id'=> 'gift_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );								
	
	$config ['gift_section_fields'] []  = array( 	'id'=> 'gift_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#gift', );
	*/
	
	// gift admin side end			


	// blog admin side		
	/*
	$config ['wed_content_sections'] ["blog_section"] = array('title' => 'Blog Section');  

	$config ['blog_section_fields'] = array();  
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'blog_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Latest form the blog', );
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'blog_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );								
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'blog_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#blogs', );
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'no_of_total_blogs', 'name' => 'no_of_items', 'title' => 'No. of Blogs', 
											'type' => 'number-field',	'required' => 'required', 'default' => '6', 'min' => '1', 'step' => '1',);	
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'no_of_blog_in_row', 'name' => 'no_of_item_in_grid', 'title' => 'No. of Blog in a Row', 
											'type' => 'number-field',	'required' => 'required', 'default' => '3', 'min' => '3', 'step' => '1', 'max' => '4');	
	
	*/


	
	$config ['payment_methods'] ["payment_method_stripe_section"] = array('title' => 'Stripe Payment Getway');  

	$config ['payment_method_stripe_section_fields'] = array();  
 
	
	$config ['payment_method_stripe_section_fields'] []  = array( 	'id'=> 'method_name_stripe', 'name' => 'method_stripe', 'title' => 'Method Name', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Use: Pay online via Stripe', );

	$config ['payment_method_stripe_section_fields'] []  = array( 	'id'=> 'stripe_client_id', 'name' => 'stripe_client_id', 'title' => 'Client Id', 

											'type' => 'text-field',	'required' => 'required', 'default' => 'pk_test_7XJekDehXaxssmHNfkQMG4aG', );

	$config ['payment_method_stripe_section_fields'] []  = array( 	'id'=> 'stripe_client_secret', 'name' => 'stripe_client_secret', 'title' => 'Secret', 

											'type' => 'text-field',	'required' => 'required', 'default' => 'secret', );
	
	
											  /* Paypal */ 
	
	
	$config ['payment_methods'] ["payment_method_paypal_section"] = array('title' => 'Paypal Payment Getway');  

	$config ['payment_method_paypal_section_fields'] = array();  
	
	
	$config ['payment_method_paypal_section_fields'] []  = array( 	'id'=> 'method_name_paypal', 'name' => 'method_paypal', 'title' => 'Method Name', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Use: Pay online via paypale', );

	$config ['payment_method_paypal_section_fields'] []  = array( 	'id'=> 'paypal_client_id', 'name' => 'paypal_client_id', 'title' => 'Client Id', 

											'type' => 'text-field',	'required' => 'required', 'default' => 'pk_test_7XJekDehXaxssmHNfkQMG4aG', );

	$config ['payment_method_paypal_section_fields'] []  = array( 	'id'=> 'paypal_client_secret', 'name' => 'paypal_client_secret', 'title' => 'Secret', 

											'type' => 'text-field',	'required' => 'required', 'default' => 'password', );
											
	/* bank transfer*/
	$config ['payment_methods'] ["payment_method_bank_section"] = array('title' => 'Bank Transfer');  

	$config ['payment_method_bank_section_fields'] = array();  
	
	
	$config ['payment_method_bank_section_fields'] []  = array( 	'id'=> 'method_name_bank', 'name' => 'method_bank', 'title' => 'Method Name', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Use: Pay via Bank Transfer', );

	$config ['payment_method_bank_section_fields'] []  = array( 	'id'=> 'bank_details', 'name' => 'bank_details', 'title' => 'Bank A/c Details', 

											'type' => 'textarea',	'required' => 'required', 'default' => '', );
											
	/* cod */

	$config ['payment_methods'] ["payment_method_cod_section"] = array('title' => 'Cash On delivery');  

	$config ['payment_method_cod_section_fields'] = array();  
	
	
	$config ['payment_method_cod_section_fields'] []  = array( 	'id'=> 'method_name_cod', 'name' => 'method_cod', 'title' => 'Method Name', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Pay With C.O.D', );

	$config ['payment_method_cod_section_fields'] []  = array( 	'id'=> 'cod_details', 'name' => 'bank_details', 'title' => 'C.O.D Details', 

											'type' => 'textarea',	'required' => 'required', 'default' => '', );
	
	/* Admin Content Sections */
	
	$config ['content_sections'] = array();  
	
	$config ['content_sections'] ["slider_section"] = array('title' => 'Site Slider Section');  

	$config ['slider_section_fields'] = array();  
	
		$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_show_nav', 'name' => 'show_nav', 'title' => 'Show Navigation Icon?', 
												'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
												'options' => 'yes_no_options'
												 );
		
		$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_show_nav_dots', 'name' => 'show_nav_dots', 'title' => 'Show Navigation Dots?', 
												'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
												'options' => 'yes_no_options'
												 );
		
		$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_auto_start_slider', 'name' => 'auto_start_slider', 'title' => 'Auto Start', 
												'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
												'class' => 'show_hide_block_btn', 
												'attributes' => array('data-target'=>'slider_block_related'),
												'options' => 'yes_no_options'
												 );
		
		$config ['slider_section_fields'] []  = array( 	'id'=> 'slider_interval', 'name' => 'slider_interval', 'title' => 'Interval', 
												'parent_class' => 'slider_block_related yes_block',
												'type' => 'number-field',	'required' => 'required', 'default' => '6500', 'min' => '1000', 'step' => '500');
																					

	$config ['content_sections'] ["ws_list_section"] = array('title' => 'Wedding Site Section');  

	$config ['ws_list_section_fields'] = array();  
	
		$config ['ws_list_section_fields'] []  = array( 	'id'=> 'ws_list_heading', 'name' => 'heading', 'title' => 'Heading', 
												
												'type' => 'text-field',	'required' => 'required', 'default' => 'Wedding Site Lists', );
		
		$config ['ws_list_section_fields'] []  = array( 	'id'=> 'ws_list_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
												
												'type' => 'text-field',	'required' => '', 'default' => '', );								
		
		$config ['ws_list_section_fields'] []  = array( 	'id'=> 'ws_list_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
												
												'type' => 'hidden',	'required' => '', 'default' => '#wedding_site_list', );
		
		$config ['ws_list_section_fields'] []  = array( 	'id'=> 'no_of_total_sites', 'name' => 'no_of_items', 'title' => 'No. of Sites', 
												'type' => 'number-field',	'required' => 'required', 'default' => '6', 'min' => '1', 'step' => '1',);	
		
		$config ['ws_list_section_fields'] []  = array( 	'id'=> 'no_of_site_in_row', 'name' => 'no_of_item_in_grid', 'title' => 'No. of Site in a Row', 
												'type' => 'number-field',	'required' => 'required', 'default' => '3', 'min' => '3', 'step' => '1', 'max' => '4');	
	
	
	$config ['content_sections'] ["register_section"] = array('title' => 'Register Section');  

	$config ['register_section_fields'] = array();  
	
		$config ['register_section_fields'] []  = array( 	'id'=> 'register_heading', 'name' => 'heading', 'title' => 'Heading', 
												
												'type' => 'text-field',	'required' => 'required', 'default' => 'Register For Personal Wedding', );
		
		$config ['register_section_fields'] []  = array( 	'id'=> 'register_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
												
												'type' => 'text-field',	'required' => '', 'default' => '', );								
		
		$config ['register_section_fields'] []  = array( 	'id'=> 'register_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
												
												'type' => 'hidden',	'required' => '', 'default' => '#register', );
		
		$config ['register_section_fields'] []  = array( 	'id'=> 'register_section_btn_title', 'name' => 'btn_text', 'title' => 'Button Text', 
												
												'type' => 'text-field',	'required' => '', 'default' => 'Register Now', );
												
	
$config ['content_sections'] ["blog_section"] = array('title' => 'Blog Section');  

	$config ['blog_section_fields'] = array();  
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'blog_heading', 'name' => 'heading', 'title' => 'Heading', 
											
											'type' => 'text-field',	'required' => 'required', 'default' => 'Latest Blogs', );
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'blog_sub_heading', 'name' => 'sub_heading', 'title' => 'Sub Heading', 
											
											'type' => 'text-field',	'required' => '', 'default' => '', );								
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'blog_section_link', 'name' => 'section_link', 'title' => 'Section Link', 
											
											'type' => 'hidden',	'required' => '', 'default' => '#blogs', );
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'no_of_total_blogs', 'name' => 'no_of_items', 'title' => 'No. of Blogs', 
											'type' => 'number-field',	'required' => 'required', 'default' => '6', 'min' => '1', 'step' => '1',);	
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'no_of_blog_in_row', 'name' => 'no_of_item_in_grid', 'title' => 'No. of Blog in a Row', 
											'type' => 'number-field',	'required' => 'required', 'default' => '3', 'min' => '3', 'step' => '1', 'max' => '4');	
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'enable_view_more_btn', 'name' => 'show_view_more_btn', 'title' => 'Show Load More Button', 
											'type' => 'radio-toggle',	'required' => 'required', 'default' => 'no',
											'class' => 'show_hide_block_btn', 
											'attributes' => array('data-target'=>'show_blog_load_more_block_related'),
											'options' => 'yes_no_options'
											 );
	
	$config ['blog_section_fields'] []  = array( 	'id'=> 'blog_load_more_btn_text', 'name' => 'blog_load_more_btn_text', 'title' => 'Load More Button Text', 
											'parent_class' => 'show_blog_load_more_block_related yes_block',
											'type' => 'text-field',	'required' => 'required', 'default' => 'Load More',);