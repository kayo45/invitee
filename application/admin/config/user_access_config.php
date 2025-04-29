<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


$config['site_users'] = array(
						"admin" => array("title" => "Admin"),
						"wedding_user" => array("title" => "Wedding User"),
						);

$config['site_user_access'] = 
array( 
		"admin" => 
		array(	
			"menu" => array( "has_access" => "exclude",
							"menu_items" => array("story","event","slider","kutipan","utility","guestbook",
							"gifts||my_gifts","packages||my_payments",
							"relatives","received_gifts","friendslist")
							),
			"controller" => array( "has_access" => "exclude",
							"all_items" => array()),
			"view" => array( "has_access" => "exclude",
							"all_items" => array()),
			"content" => array( 
						"has_access" => "access_all",
						"default_status" => "publish_all"
						),
			"widget" => array( "has_access" => "access_all"),
			
			),	
		"wedding_user" => 
		array(	
			"menu" => array( 
				"has_access" => "limited",
				"menu_items" => array(
					"main",
					"main||dashboard",
					
					"story",
					"story||add_new",
					"story||edit",
					"story||manage",
					"story||delete",
					
					"event",
					"event||add_new",
					"event||edit",
					"event||manage",
					
					"appearance",
					"appearance||themes",
					
					"packages",
					"packages||my_payments",
					
					"slider",
					"slider||add_new",
					"slider||edit",
					"slider||manage",

					"kutipan",
					"kutipan||add_new",
					"kutipan||edit",
					"kutipan||manage",

					"utility",
					"utility||audio",
					"utility||youtube",
					"utility||filter_ig",
					"utility||maps",
					
					"guestbook",
					"guestbook||add_new",
					"guestbook||edit",
					"guestbook||manage",
					"guestbook||managelist",
					"guestbook||add_tamu",
					"guestbook||edit_tamu",
					"guestbook||delete_tamu",
					
					"relatives",
					"relatives||add_new",
					"relatives||edit",
					"relatives||manage",
					"relatives||relations",
					
					"gallery",
					
					/*"gifts",
					"gifts||my_gifts",*/
					
					"media",
					"media||manage",
					"settings","settings||change_password",
					
					)
				),
			"controller" => array( 
				"has_access" => "limited",
				"all_items"=> array("story","event","slider","kutipan","utility","guestbook","relatives",'packages',"gallery",
				/*"gifts",*/
				"settings","media")
			),
			"view" => array( 
				"has_access" => "limited",
				"all_items"=> array(
						
						"story"=>array("manage","add_new","edit","delete"),
						"event"=>array("manage","add_new","edit","delete"),
						"slider"=>array("manage","add_new","edit","delete"),
						"kutipan"=>array("manage","add_new","edit","delete"),
						"utility"=>array("manage","add_new","edit","delete"),
						"guestbook"=>array("manage","add_new","edit","delete","managelist","add_tamu","edit_tamu","delete_tamu"),
						"relatives"=>array("manage","add_new","edit","relations","delete"),
						
						"gallery"=>array("index"),
						/*"gifts"=>array("my_gifts"),*/
						"packages"=>array("my_payments"),
						"media"=>array("manage"),
						"settings"=>array("change_password")
						
					)
				),
			"content" => array( 
				"has_access" => "limited",
				"all_items"=> array(
					"client" => array( "view_all" , "view" ), 
					"loan" => array( "view_all" ),
					),
				"default_status" => "publish_all"	
				),	
			"widget" => array( "has_access" => "access_all"),	
			),
		
	);