<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
	
	var $theme;
	var $site_users;
	var $site_user_access;
	
	var $post_id;
	var $cat_id;
	
	var $canonical_url;
	var $hreflang_url;
	var $hreflang;
		
	function __construct()
	{
		parent::__construct();
		
		$CI =& get_instance();
		$this->theme = $CI->config->item('theme') ;
		
		$this->load->model('Common_model');
		
		$this->load->library('global_lib');
		$this->load->library('menu_lib');
		
		$this->load->helper('mlxlang_helper');
		
		$default_language = $CI->global_lib->get_option('default_language');
		$this->default_language = 'en';
		$this->default_language_title = 'English';
		$this->enable_multi_lang = false;
		$this->lang->load('english', 'english');
		$this->site_direction = 'ltr';
		$this->site_currency = 'USD';
		$this->set_default_timezone();
		$enable_multi_language = $CI->global_lib->get_option('enable_multi_language');
		if(!empty($enable_multi_language) && $enable_multi_language == 'Y')
		{
			$this->enable_multi_lang = true;
		}
		
		
		$site_language = $CI->global_lib->get_option('site_language');
		
		
		
		if(isset($_SESSION['default_lang_front']) && !empty($_SESSION['default_lang_front']) && 
		   !empty($site_language) && $this->enable_multi_lang)
		{
			$lang_exp = explode('~',$_SESSION['default_lang_front']);
			$lang_code = $lang_exp[1];
			$lang_title = $lang_exp[0];
			$site_language_array = json_decode($site_language,true);
			$lang_slug = $CI->global_lib->get_slug($lang_title);
			$is_lang_exists = false;
			foreach($site_language_array as $slak=>$slav)
			{
				if($slav['language'] == $lang_title.'~'.$lang_code  && file_exists('application/language/'.$lang_slug.'/'.$lang_slug.'_lang.php'))
				{
					$is_lang_exists = true;
					$this->site_direction = $slav['direction'];
					$this->site_currency = $slav['currency'];
				}
			}
			if($is_lang_exists)
			{
				
				$this->default_language = $lang_code;
				$this->default_language_title = $lang_title;
				
				$this->lang->load($lang_slug, $lang_slug);
			}
		}
		else if(!empty($default_language) && !empty($site_language))
		{
			
			$lang_exp = explode('~',$default_language);
			$lang_code = $lang_exp[1];
			$lang_title = $lang_exp[0];
			$site_language_array = json_decode($site_language,true);
			$lang_slug = $CI->global_lib->get_slug($lang_title);
			
			$is_lang_exists = false;
			foreach($site_language_array as $slak=>$slav)
			{
				if($slav['language'] == $lang_title.'~'.$lang_code && file_exists('application/language/'.$lang_slug.'/'.$lang_slug.'_lang.php'))
				{
					$is_lang_exists = true;
					$this->site_direction = $slav['direction'];
					$this->site_currency = $slav['currency'];
				}
			}
			if($is_lang_exists)
			{
				
				$this->default_language = $lang_code;
				$this->default_language_title = $lang_title;
				$this->lang->load($lang_slug, $lang_slug);
			}
		}
	
		
		$this->site_users 		= $CI->config->item('site_users') ;
		$this->site_user_access 	= $CI->config->item('site_user_access') ;
		
		$this->post_id = 0;	
		$this->cat_id = 0;	
		
		$current_url =  current_url();
		$this->canonical_url = $current_url ;
			
			
		if($this->enable_multi_lang )
		{
			$this->hreflang_url = $current_url ;
			$this->hreflang = $this->default_language  ;
		}else{
			$this->hreflang_url = $this->hreflang = "";
		
		}
		
		
		
		
    }
		public function set_default_timezone()
		{
			
			$this->load->model('Common_model');	
			
			$options = $this->Common_model->commonQuery("select * from options where option_key  = 'default_timezone'");	
		
			if(isset($options) && $options->num_rows()>0)
			{

					foreach($options->result() as $row)
					{
						 $default_timezone = $row->option_value;
					}

				date_default_timezone_set($default_timezone);
			}
			else
			{
				 date_default_timezone_set('Asia/Kolkata');
			}
		}	
		
	public function get_the_ID(){
	
		$CI =& get_instance();
		$p = $this->get_the_page_context() ;
		$c = $this->get_the_cat_context() ;
		if("default" == $p  && "default" == $c)	
			return 0;
		else	
		{
			if("default" != $p  )	
			{
				return $this->post_id ;	
				
			}else if("default" != $c  )	{
			
				return $this->cat_id ;	
			}
				return 0;
		}	
	}
	
	public function get_the_page_context(){
		
		$CI =& get_instance();
		$page_contexts = $CI->config->item('page_contexts') ;
		$current = $this->router->fetch_class();
		$current_context = "default";
		
		if(in_array($current , $page_contexts))
			$current_context = $current;
		
		return $current_context ;
	}

	public function get_the_cat_context(){
		
		$CI =& get_instance();
		$cat_contexts = $CI->config->item('cat_contexts') ;
		$current = $this->router->fetch_class();
		$current_context = "default";
		
		if(in_array($current , $cat_contexts))
			$current_context = $current;
		
		return $current_context ;
	}

	
	public function has_menu_access($menu_item = "", $user_type )
	{
		
		if(in_array($user_type, $this->site_users ))
		{
			$menu_access = $this->site_user_access [$user_type]['menu']	 ;
			
			if($menu_access['has_access'] == 'access_all')
			{
				return true;
			}else if($menu_access['has_access'] == 'limited'){
				
				$menu_items = $menu_access['menu_items'];
				if(in_array($menu_item, $menu_items ))
					return true;
			}
			
			return false;
		}
		else return false;
		
	}
	
	public function has_class_access($class_item = "", $user_type = "" )
	{
		
		if($class_item == "")
		{
			$class_item =  $this->router->fetch_class();
		}
		
		$user_type = $this->session->userdata('user_type');
		if(in_array($user_type, $this->site_users ))
		{
			$class_access = $this->site_user_access [$user_type]['controller']	 ;
			
			if($class_access['has_access'] == 'access_all')
			{
				return true;
			}else if($class_access['has_access'] == 'limited'){
				
				$class_items = $class_access['all_items'];
				if(in_array($class_item, $class_items ))
					return true;
			}
		}
		
		return false;
		
	}
	
	public function has_method_access($method_item = "", $user_type = "" )
	{
		
		
		$class_item =  $this->router->fetch_class();
		$method_item =  $this->router->fetch_method();
			
		$user_type = $this->session->userdata('user_type');
		if(in_array($user_type, $this->site_users ))
		{
			$method_access = $this->site_user_access [$user_type]['view']	 ;
			
			if($method_access['has_access'] == 'access_all')
			{
				return true;
			}else if($method_access['has_access'] == 'limited'){
				
				if(array_key_exists($class_item, $method_access ['all_items']) )
				{
					$method_items = $method_access['all_items'][$class_item];
					if(in_array($method_item, $method_items ))
						return true;
				}		
			}
		}
		
		return false;
		
	}
	
	public function has_widget_access($widget_item = "", $user_type = "" )
	{
		
		if($widget_item == "")
		{
			return false;
		}
		
		
		$user_type = $this->session->userdata('user_type');
		if(in_array($user_type, $this->site_users ))
		{
			if(isset($this->site_user_access [$user_type]['widget']	))
				$widget_access = $this->site_user_access [$user_type]['widget']	 ;
			else
				return false;
				
				
			if($widget_access['has_access'] == 'access_all')
			{
				return true;
			}else if($widget_access['has_access'] == 'limited'){
				
				if(in_array($widget_item, $widget_access ['all_items']))
				{
						return true;
				}		
			}
		}
		
		return false;
		
	}
	
	public function has_permission($item = "", $task = "", $user_type = "" )
	{
		
		
		$user_type = $this->session->userdata('user_type');
		if(in_array($user_type, $this->site_users ))
		{
			$access = $this->site_user_access [$user_type]['content']	 ;
			
			if($access['has_access'] == 'access_all')
			{
				return true;
			}else if($access['has_access'] == 'limited'){
				
				$all_items = $access['all_items'];
				if(array_key_exists($item,$all_items))
				{
					$current = $all_items[$item];
					if(in_array($task, $current))
						return true;
				}	
			}
		}
		
		return false;
		
	}
	
	public function get_default_status($item = "", $user_type = "" )
	{
		
		$user_type = $this->session->userdata('user_type');
		if(in_array($user_type, $this->site_users ))
		{
			$access = $this->site_user_access [$user_type]['content']	 ;
			
			if($access['default_status'] == 'publish_all')
			{
				return 'publish';
			}else if($access['default_status'] == 'limited'){
				
				$all_items = $access['statuses'];
				if(array_key_exists($item,$all_items))
				{
					$status = $all_items[$item];
					return $status;	
				}	
			}
		}
		
		return "draft";
		
	}
	
	public function EncryptClientId($id)
	{
		return substr(md5($id), 0, 8).dechex($id);
	}

	public function DecryptClientId($id)
	{
		$md5_8 = substr($id, 0, 8);
		$real_id = hexdec(substr($id, 8));
		return ($md5_8==substr(md5($real_id), 0, 8)) ? $real_id : 0;
	}
	
	public function user_id_address()
	{
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) 
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} 
		elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) 
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} 
		else 
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	
	public function isLogin()	{
		$site_url = site_url();		
		if(isset($_SESSION['f_logged_in']) && $_SESSION['f_logged_in']==TRUE && isset($_SESSION['site_url']) && $_SESSION['site_url'] == $site_url )
			return true;		
		else
			return false;
	}
	
	
	public function user_name_check($val)
	{
		$this->load->model('Common_model');
		$options=array('where'=>array('user_name'=>$val));
		$user_exsist=$this->Common_model->commonSelect('users',$options);
		if($user_exsist->num_rows() > 0 )
		{
			$this->form_validation->set_message('user_name_check', ' %s already exsist');
			return FALSE;
		}	
		else
		{	return TRUE;		}
	}
	
	public function user_email_check($val)
	{
		$this->load->model('Common_model');
		$options=array('where'=>array('user_email'=>$val));
		$user_exsist=$this->Common_model->commonSelect('users',$options);
		if($user_exsist->num_rows() > 0 )
		{
			$this->form_validation->set_message('user_email_check', ' %s already exsist');
			return FALSE;
		}	
		else
		{	return TRUE;		}
	}
	

}