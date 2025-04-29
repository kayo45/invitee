<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_lib {

	var $menu_items = array(); 

	

	public function __construct(){
	
		$this->menu_items ['home'] =  base_url(array('home',':lang'));
		$this->menu_items ['contact'] =  site_url(array('contact',':lang'));
		$this->menu_items ['search'] =  site_url(array('search',':lang'));
	}
	
	public function get_url($menu_item = ''){
		
		$CI =& get_instance();
		if(array_key_exists($menu_item,$this->menu_items))
		{	
			
			$return_menu_item =  $this->menu_items[$menu_item];
			
			if( isset($CI->enable_multi_lang ) && $CI->enable_multi_lang  != true  && $menu_item = 'home')
			{	
				$return_menu_item = "#home";	
			}
		}
		else if(preg_match("/page=/", $menu_item))
		{
			$return_menu_item = str_replace("page=","",$menu_item);
			$return_menu_item = site_url(array(':lang',$return_menu_item));
			
		}	
		else	
			$return_menu_item  = base_url(array($menu_item));
		
		$return_menu_item  =  $this->remove_lang_from_url($return_menu_item);
		
		return $return_menu_item ;
		
	}	
	
	public function remove_lang_from_url($menu_item){
	
		$CI =& get_instance();
		$return_menu_item  =  "";
		if(isset($CI->enable_multi_lang ) && $CI->enable_multi_lang  == true )
		{	
			$lang = '';
			
			$lang = $CI->default_language;	
			$return_menu_item  =  str_replace(":lang",$lang,$menu_item  );	
		
		}else{
			$return_menu_item  =  str_replace("/:lang/","",$menu_item  );
			$return_menu_item  =  str_replace("/:lang","",$menu_item  );
		}
		
		return $return_menu_item ;
	
	}
	
	
}
