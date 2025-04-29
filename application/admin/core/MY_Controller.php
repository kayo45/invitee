<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	var $theme;
	var $site_users;
	var $site_user_access;
	var $site_user_settings;
	var $site_user_active_settings  = false;	 
	function __construct()
	{
		parent::__construct();
		
		$CI =& get_instance();
		$this->theme = $CI->config->item('theme');
		$this->load->model('Common_model');
		$this->site_users = $CI->config->item('site_users');
		$this->site_user_access = $CI->config->item('site_user_access');
		$this->site_user_settings = $CI->config->item('settings');
		
		$this->set_default_timezone();
		
		$this->load->library('global_lib');
		
		$this->cms_version 	= $CI->config->item('cms_version')  ;
		
		$this->load->helper('mlxlang_helper');
		
		$is_user_login = $this->is_user_login();
		
		if(!$is_user_login)
		{
			$is_expired = $this->session->userdata('is_expired');
			if(!$is_expired)
			{
				$newdata = array('username', 
								'user_name',
								'user_email', 
								'user_id', 
								'user_type',  
								'site_url',
								);
				foreach($newdata as $k=>$v)
				{
					unset($_SESSION[$v]);
				}
				
				$this->session->unset_userdata($newdata);
				$this->session->set_userdata('logged_in', false);
				$_SESSION['logged_in'] = false;		
				
				$this->session->set_userdata('is_expired', true);
				$_SESSION['is_expired'] = true;		
				
				$_SESSION['msg'] = '<p class="success_msg">Your Session Expired.</p>';
				
				redirect('/logins','location');
			}
			
		}
		
		
		$user_type = $this->session->userdata('user_type'); 
		$wedding_id = 0;
		//if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
		if($user_type == 'wedding_user')	
		{
			$user_id = $_SESSION['user_id'];
			$wedding_data = $CI->Common_model->commonQuery("select * from wedding_details where wedding_user_id = $user_id");
			if($wedding_data->num_rows() > 0){
				$wedding_id = $wedding_data->row()->id;
				$wedding_site = str_replace('admin/','',base_url()).$wedding_data->row()->site_name.'/'.$wedding_data->row()->id;
				$_SESSION['wedding_site'] = $wedding_site;
				$_SESSION['site_status'] = $wedding_data->row()->site_status;
				$_SESSION['wedding_site_payment_status'] = $wedding_data->row()->payment_status;
			}else{
				$_SESSION['wedding_site'] = '';
				$_SESSION['site_status'] = 'incomplete';
				
			}
		}
		$_SESSION['wedding_id'] = $wedding_id;
		
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
			$is_lang_exists = false;
			$lang_slug = $CI->global_lib->get_slug($lang_title);
			foreach($site_language_array as $slak=>$slav)
			{
				if($slav['language'] == $lang_title.'~'.$lang_code && file_exists('../application/admin/language/'.$lang_slug.'/'.$lang_slug.'_lang.php'))
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
			$is_lang_exists = false;
			$lang_slug = $CI->global_lib->get_slug($lang_title);
			foreach($site_language_array as $slak=>$slav)
			{
				if($slav['language'] == $lang_title.'~'.$lang_code && file_exists('../application/admin/language/'.$lang_slug.'/'.$lang_slug.'_lang.php'))
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
		
		if(!$this->site_user_active_settings && 0)
		{
			$user_type = $this->session->userdata('user_type');
			
			$options = $this->Common_model->commonQuery("select * from options where option_key like '$user_type%'");	
			$active_options = array();
			if(isset($options) && $options->num_rows()>0)
			{
				
				foreach($options->result() as $row)
				{
					if($row->option_value == 'yes')
						$active_options [$row->option_key] = $row->option_value;;
				}
				
			}
			
			if(count($active_options ) > 0)
			{
				if(isset($this->site_user_settings [$user_type]))
				{
				$settings = $this->site_user_settings [$user_type];
				foreach($settings as $setting)
				{
					if( isset($setting['controller']) &&   array_key_exists($setting['name'],$active_options))
					{
						
						if(isset($this->site_user_access[$user_type]['menu']['menu_items']))
						{
							
							$this->site_user_access[$user_type]['menu']['menu_items'][] = $setting['controller'];
							$this->site_user_access[$user_type]['menu']['menu_items'][] = $setting['controller'] 
										. "||" . $setting['method'];
										
							if($setting['method'] == 'add_new')
							{
								$this->site_user_access[$user_type]['menu']['menu_items'][] = $setting['controller'] 
											. "||manage" ;
							}								
						}
						
						
						if(isset($this->site_user_access[$user_type]['view']['all_items']))
						{
						
							if(isset(	$this->site_user_access[$user_type]['view']['all_items'][ $setting['controller'] ] ))
							{
								$arr = 	$this->site_user_access[$user_type]['view']['all_items'][ $setting['controller'] ] ;
								$arr [] = $setting['method'];  
								if($setting['method'] == 'add_new')
									$arr [] = 'manage';
								
								$this->site_user_access[$user_type]['view']['all_items'][ $setting['controller'] ] = $arr;		
								
							}
							else
							{
								$arr =  array();
								$arr [] = $setting['method'];  
								if($setting['method'] == 'add_new')
									$arr [] = 'manage';
									
								$this->site_user_access[$user_type]['view']['all_items'][$setting['controller'] ] = $arr;		
							
							}
										
						
						}
						
						
							
					}
				}
				}
			}
			$this->site_user_active_settings =  true;
		}	
		
    }
	
	public function is_user_login()
	{
		$this->load->model('Common_model');	
		
		$user_type = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		
		if($user_type === FALSE && $user_id === FALSE)
		{
			return false;
		}
		else
		{
			$is_expired = $this->session->userdata('is_expired');
			if(!$is_expired)
			{
				return false;
			}
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
	
	public function has_menu_access($menu_item = "", $user_type )
	{
		if(array_key_exists($user_type, $this->site_users ))
		{
			$menu_access = $this->site_user_access [$user_type]['menu']	 ;
			if($menu_access['has_access'] == 'access_all')
			{
				return true;
			}
			else if($menu_access['has_access'] == 'exclude'){
				$menu_items = $menu_access['menu_items'];
				
				if(!in_array($menu_item, $menu_items ))
					return true;
			}	
			else if($menu_access['has_access'] == 'limited'){
				
				$menu_items = $menu_access['menu_items'];
				
				if(in_array($menu_item, $menu_items ))
				{
					return true;
				}
			}
		}
		return false;
	}
	
	public function has_class_access($class_item = "", $user_type = "" )
	{
		
		if($class_item == "")
		{
			$class_item =  $this->router->fetch_class();
		}
		
		$user_type = $this->session->userdata('user_type');
		
		if(isset($this->site_user_settings[$user_type]))
			$user_settings = $this->site_user_settings[$user_type];
		else
			$user_settings = array();
		
		
		if(in_array($user_type, $this->site_users ))
		{
			$class_access = $this->site_user_access [$user_type]['controller']	 ;
			
			if($class_access['has_access'] == 'access_all')
			{
				return true;
			}
			
			else if($class_access['has_access'] == 'limited'){
				
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
		
		if(isset($this->site_user_settings[$user_type]))
			$user_settings = $this->site_user_settings[$user_type];
		else
			$user_settings = array();
		
		if(array_key_exists($user_type, $this->site_users ))
		{
			$method_access = $this->site_user_access [$user_type]['view']	 ;
			
			if($method_access['has_access'] == 'access_all')
			{
				return true;
			}
			else if($method_access['has_access'] == 'exclude'){
				if(!array_key_exists($class_item, $method_access ['all_items']) )
				{
					return true;
				}
			}
			else if($method_access['has_access'] == 'limited'){
				
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
	
	public function isLogin()	{
		$site_url = site_url();		
		$logged_in = $this->session->userdata('logged_in');
		$sess_site_url = $this->session->userdata('site_url');
		if(isset($logged_in) && $logged_in == TRUE 
		&& isset($sess_site_url) && $sess_site_url == $site_url)
		{
			
			return true;		

		}		
		else
		{
			$_SESSION['msg'] = '<p class="error_msg">You have to login first to proceed.</p>';
			return false;
		}
	}
	
}