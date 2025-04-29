<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


	
	$CI =& get_instance();
	
	/*echo "<pre>";
	print_r($CI->config); exit;*/


	$config ['sidebar_left'] = array(); 
 
	$config ['sidebar_left'] [10]  = array( 	'class'=> 'main', 'method' => 'main', 
											'text' => 'Dashboard', 'link' => 'main',		
											'collapse_class' => '','icon_class' => 'fa fa-dashboard', 				);
	
	$config ['sidebar_left'] [11]  = array( 	'class'=> 'main', 'method' => 'home_page', 
											'text' => 'Homepage', 'link' => 'main/home_page',		
											'collapse_class' => '','icon_class' => 'fa fa-home',);

	$config ['sidebar_left'] [18]  = array('class' => 'gallery',  'method'=> '',
											'text'=> 'Gallery', 'link'=> 'gallery',		
												'collapse_class'=> '', 'icon_class'=> 'fa fa-picture-o');
											
	$config ['sidebar_left'] [12]  = array( 	'class' => 'story',  'method'=> '',
											'text'=> 'Story', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-book'	);
											
	$config ['sidebar_left'] [12] ['item']  [] = array('class' => 'story',  'method'=> 'manage',
												'text'=> 'Manage', 'link'=> 'story/manage',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
												
	$config ['sidebar_left'] [12] ['item']  [] = array( 	'class' => 'story',  'method'=> 'add_new',
												'text'=> 'Add New', 'link'=> 'story/add_new',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);


	$config ['sidebar_left'] [4545]  = array( 	'class' => 'kutipan',  'method'=> '',
	'text'=> 'Kutipan', 'link'=> '#',
	'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-commenting-o' );

	$config ['sidebar_left'] [4545] ['item']  [] = array('class' => 'kutipan',  'method'=> 'manage',
												'text'=> 'Manage', 'link'=> 'kutipan/manage',
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);

	$config ['sidebar_left'] [4545] ['item']  [] = array( 	'class' => 'kutipan',  'method'=> 'add_new',
												'text'=> 'Add New', 'link'=> 'kutipan/add_new',
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);


	$config ['sidebar_left'] [04545]  = array( 	'class' => 'utility',  'method'=> '',
												'text'=> 'Utility', 'link'=> '#',
												'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-file-movie-o' );

	$config ['sidebar_left'] [04545] ['item']  [] = array( 	'class' => 'utility',  'method'=> 'audio',
												'text'=> 'Audio Upload', 'link'=> 'utility/audio',
												'collapse_class'=> '','icon_class'=> 'fa fa-instagram-o',	);	
	$config ['sidebar_left'] [04545] ['item']  [] = array( 	'class' => 'utility',  'method'=> 'filter_ig',
												'text'=> 'Filter IG', 'link'=> 'utility/filter_ig',
												'collapse_class'=> '','icon_class'=> 'fa fa-instagram-o',	);
	$config ['sidebar_left'] [04545] ['item']  [] = array( 	'class' => 'utility',  'method'=> 'maps',
												'text'=> 'Maps Embed', 'link'=> 'utility/maps',
												'collapse_class'=> '','icon_class'=> 'fa fa-maps-o',	);
	$config ['sidebar_left'] [04545] ['item']  [] = array('class' => 'utility',  'method'=> 'youtube',
												'text'=> 'Youtube Embed', 'link'=> 'utility/youtube',
												'collapse_class'=> '','icon_class'=> 'fa fa-youtube-o',	);
												
												
	$config ['sidebar_left'] [13]  = array( 	'class' => 'event',  'method'=> '',
											'text'=> 'Event', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-calendar'	);
											
		$config ['sidebar_left'] [13] ['item']  [] = array('class' => 'event',  'method'=> 'manage',
													'text'=> 'Manage', 'link'=> 'event/manage',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
													
		$config ['sidebar_left'] [13] ['item']  [] = array( 	'class' => 'event',  'method'=> 'add_new',
													'text'=> 'Add New', 'link'=> 'event/add_new',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
												
	$config ['sidebar_left'] [14]  = array( 	'class' => 'slider',  'method'=> '',
											'text'=> 'Slider', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-sliders'	);
											
		$config ['sidebar_left'] [14] ['item']  [] = array('class' => 'slider',  'method'=> 'manage',
													'text'=> 'Manage', 'link'=> 'slider/manage',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
													
		$config ['sidebar_left'] [14] ['item']  [] = array( 	'class' => 'slider',  'method'=> 'add_new',
													'text'=> 'Add New', 'link'=> 'slider/add_new',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
												
												
	$config ['sidebar_left'] [15]  = array( 	'class' => 'site_slider',  'method'=> '',
											'text'=> 'Site Slider', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-sliders'	);
											
		$config ['sidebar_left'] [15] ['item']  [] = array('class' => 'site_slider',  'method'=> 'manage',
													'text'=> 'Manage', 'link'=> 'site_slider/manage',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
													
		$config ['sidebar_left'] [15] ['item']  [] = array( 	'class' => 'site_slider',  'method'=> 'add_new',
													'text'=> 'Add New', 'link'=> 'site_slider/add_new',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);										
												
												

												
	$config ['sidebar_left'] [16]  = array( 	'class' => 'guestbook',  'method'=> '',
	                                            'text'=> 'Tamu Undangan', 'link'=> '#',
	                                                'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-users'	);
	                                                
    $config ['sidebar_left'] [16] ['item']  [] = array('class' => 'guestbook',  'method'=> 'add_tamu',
												'text'=> 'Add New', 'link'=> 'guestbook/add_tamu',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
	                                                
	$config ['sidebar_left'] [16] ['item']  [] = array( 'class' => 'guestbook',  'method'=> 'managelist',
												'text'=> 'Manage', 'link'=> 'guestbook/managelist',
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);

	$config ['sidebar_left'] [16] ['item']  [] = array('class' => 'guestbook',  'method'=> 'manage',
												'text'=> 'Kehadiran', 'link'=> 'guestbook/manage',
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);

	
												
												
		
	
	
	$config ['sidebar_left'] [17]  = array( 	'class' => 'relatives',  'method'=> '',
											'text'=> 'Groomsmen & Bridesmaid', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-gratipay'	);
	
		$config ['sidebar_left'] [17] ['item']  [] = array('class' => 'relatives',  'method'=> 'manage',
												'text'=> 'Manage', 'link'=> 'relatives/manage',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [17] ['item']  [] = array('class' => 'relatives',  'method'=> 'add_new',
												'text'=> 'Add New', 'link'=> 'relatives/add_new',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [17] ['item']  [] = array('class' => 'relatives',  'method'=> 'relations',
												'text'=> 'Relations', 'link'=> 'relatives/relations',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
	
	
	
	$config ['sidebar_left'] [21]  = array( 	'class' => 'blog',  'method'=> '',
										'text'=> 'Blog', 'link'=> '#',		
										'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-newspaper-o'	);

		$config ['sidebar_left'] [21] ['item']  [] = array( 	'class' => 'blog',  'method'=> 'manage',
													'text'=> 'Manage', 'link'=> 'blog/manage',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
			
		$config ['sidebar_left'] [21] ['item']  [] = array( 	'class' => 'blog',  'method'=> 'add_new',
													'text'=> 'Add New', 'link'=> 'blog/add_new',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [21] ['item']  [] = array( 	'class' => 'blog',  'method'=> 'category',
													'text'=> 'Category', 'link'=> 'blog/category',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);											
	
	$config ['sidebar_left'] [50]  = array( 	'class' => 'page',  'method'=> '',
										'text'=> 'Page', 'link'=> '#',		
										'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-file'	);

		$config ['sidebar_left'] [50] ['item']  [] = array( 	'class' => 'page',  'method'=> 'manage',
												'text'=> 'Manage', 'link'=> 'page/manage',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [50] ['item']  [] = array( 	'class' => 'page',  'method'=> 'add_new',
												'text'=> 'Add New', 'link'=> 'page/add_new',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);							
		
	$config ['sidebar_left'] [84]  = array( 	'class' => 'appearance',  'method'=> '',
											'text'=> 'Appearance', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-star'	);
	
		$config ['sidebar_left'] [84] ['item']  [] = array( 	'class' => 'appearance',  'method'=> 'themes',
												'text'=> 'Themes', 'link'=> 'appearance/themes',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
	
		$config ['sidebar_left'] [84] ['item']  [] = array( 	'class' => 'appearance',  'method'=> 'menus',
												'text'=> 'Menus', 'link'=> 'appearance/menus',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);	
	
	$config ['sidebar_left'] [85]  = array( 	'class' => 'user',  'method'=> '',
											'text'=> 'User', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-users'	);
	
		$config ['sidebar_left'] [85] ['item']  [] = array( 	'class' => 'user',  'method'=> 'manage',
												'text'=> 'Manage', 'link'=> 'user/manage',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		
		$config ['sidebar_left'] [85] ['item'] [] = array( 	'class' => 'user',  'method'=> 'add_new',
												'text'=> 'Add New', 'link'=> 'user/add_new',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
	
	$config ['sidebar_left'] [120]  = array( 	'class' => 'settings',  'method'=> '',
										'text'=> 'Settings', 'link'=> '#',		
										'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-cog'	);
										
		$config ['sidebar_left'] [120] ['item']  [] = array( 	'class' => 'settings',  'method'=> 'general_settings',
												'text'=> 'General Settings', 'link'=> 'settings/general_settings',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [120] ['item']  [] = array( 	'class' => 'settings',  'method'=> 'site_languages',
											'text'=> 'Site Languages', 'link'=> 'settings/site_languages',		
											'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
											
		$config ['sidebar_left'] [120] ['item']  [] = array( 	'class' => 'settings',  'method'=> 'front_keyword_settings',
												'text'=> 'Front Keywords Settings', 'link'=> 'settings/front_keyword_settings',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [120] ['item']  [] = array( 	'class' => 'settings',  'method'=> 'admin_keyword_settings',
												'text'=> 'Admin Keywords Settings', 'link'=> 'settings/admin_keyword_settings',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);	
		$config ['sidebar_left'] [120] ['item']  [] = array( 	'class' => 'settings',  'method'=> 'social_settings',
												'text'=> 'Social Settings', 'link'=> 'settings/social_settings',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
										
		$config ['sidebar_left'] [120] ['item']  [] = array( 	'class' => 'settings',  'method'=> 'email_setting',
												'text'=> 'Email Settings', 'link'=> 'settings/email_setting',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		
		
		$config ['sidebar_left'] [120] ['item']  [] = array( 	'class' => 'settings',  'method'=> 'change_password',
												'text'=> 'Change Password', 'link'=> 'settings/change_password',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
											
		$config ['sidebar_left'] [122]  = array('class' => 'packages',  'method'=> '',
		'text'=> 'Payments', 'link'=> '#','collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-credit-card'	);
		
		$config ['sidebar_left'] [122] ['item']  [] = array( 	'class' => 'packages',  'method'=> 'manage',
				'text'=> 'Packages', 'link'=> 'packages/manage',		
				'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [122] ['item']  [] = array( 	'class' => 'packages',  'method'=> 'transaction',
		'text'=> 'Transactions', 'link'=> 'packages/transaction',		
		'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);

		$config ['sidebar_left'] [122] ['item']  [] = array( 	'class' => 'packages',  'method'=> 'payment_methods',
		'text'=> 'Payment Methods', 'link'=> 'packages/payment_methods',		
		'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	); 
		
		$config ['sidebar_left'] [122] ['item']  [] = array('class' => 'packages',  'method'=> 'my_payments',
												'text'=> 'My Payments', 'link'=> 'packages/my_payments',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);	
												
												
		$config ['sidebar_left'] [123]  = array( 	'class' => 'gifts',  'method'=> '',
											'text'=> 'Gifts', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-gift'	);
											
		$config ['sidebar_left'] [123] ['item']  [] = array('class' => 'gifts',  'method'=> 'manage',
												'text'=> 'Manage', 'link'=> 'gifts/manage',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
		
		$config ['sidebar_left'] [123] ['item']  [] = array('class' => 'gifts',  'method'=> 'my_gifts',
												'text'=> 'My Gifts', 'link'=> 'gifts/my_gifts',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
												
		
		
												
		$config ['sidebar_left'] [123] ['item']  [] = array( 	'class' => 'gifts',  'method'=> 'add_new',
												'text'=> 'Add New', 'link'=> 'gifts/add_new',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);

		$config ['sidebar_left'] [124]  = array( 	'class' => 'received_gifts',  'method'=> '',
											'text'=> 'Received Gifts', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-gift'	);
											
		$config ['sidebar_left'] [124] ['item']  [] = array('class' => 'received_gifts',  'method'=> 'manage',
												'text'=> 'Manage Gifts', 'link'=> 'received_gifts/manage',		
												'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);	
		

		
		
												
		$config ['sidebar_left'] [125]  = array( 	'class' => 'friendslist',  'method'=> '',
											'text'=> 'FriendsList', 'link'=> '#',		
											'collapse_class'=> 'fa fa-angle-left pull-right', 'icon_class'=> 'fa fa-users'	);
											
		$config ['sidebar_left'] [125] ['item']  [] = array('class' => 'friendslist',  'method'=> 'manage',
													'text'=> 'Manage', 'link'=> 'friendslist/manage',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);
													
		$config ['sidebar_left'] [125] ['item']  [] = array( 	'class' => 'friendslist',  'method'=> 'add_new',
													'text'=> 'Add New', 'link'=> 'friendslist/add_new',		
													'collapse_class'=> '','icon_class'=> 'fa fa-circle-o',	);


		