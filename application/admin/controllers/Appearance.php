<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appearance extends MY_Controller {
	
	function __construct() {
        parent::__construct();
        if(!$this->isLogin())
		{
			redirect('/logins','location');
		}
	}
	
	
	public function themes()
	{
		if(!$this->isLogin())
		{
			redirect('/logins','location');
		}
		
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		$user_type = $this->session->userdata('user_type');
		
		if(isset($_POST['submit']) || isset($_POST['draft']))		
		{			
			
			extract($_POST,EXTR_OVERWRITE);	
			
			if($user_type == 'admin')
				$this->global_lib->update_option('front_theme',$front_theme);
			else if($user_type == 'wedding_user')
			{
				$user_id = $this->session->userdata('user_id');
				$this->global_lib->update_user_meta($user_id,'front_theme',$front_theme);
			}
			
			$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			'.mlx_get_lang("Theme Updated Successfully").'
			</div>							';				
			redirect('/appearance/themes','location');										
			
		
			
			
		}
		
		$data['theme']=$theme;
		
		if($user_type == 'admin')
			$data['front_themes'] = $this->global_lib->get_option('front_theme');
		else if($user_type == 'wedding_user')
		{
			$user_id = $this->session->userdata('user_id');
			$data['front_themes'] = $this->global_lib->get_user_meta($user_id,'front_theme');
		}
		$front_end_themes = array(
			'Blue'=>array('title'=>'Blue Theme','color_code'=>'#5A16F5','name'=>'blue',),
			'Pink'=>array('title'=>'Pink Theme','color_code'=>'#F2A7A7','name'=>'pink'),
			'Green'=>array('title'=>'Green Theme','color_code'=>'#2F591B','name'=>'green'),
			'Yellow'=>array('title'=>'Yellow Theme','color_code'=>'#d39f00','name'=>'yellow'),
// 			'Orange'=>array('title'=>'Orange Theme','color_code'=>'#f48f25','name'=>'orange'),
// 			'Red'=>array('title'=>'Red Theme','color_code'=>'#9E020C','name'=>'red'),
// 			'Teal'=>array('title'=>'Teal Theme','color_code'=>'#349992','name'=>'teal'),
// 			'Purple'=>array('title'=>'Purple Theme','color_code'=>'#2E0259','name'=>'purple'),
// 			'Navy'=>array('title'=>'Navy Theme','color_code'=>'#008ea8','name'=>'navy'),
// 			'Maroon'=>array('title'=>'Maroon Theme','color_code'=>'#400101','name'=>'maroon'),
// 			'Magenta'=>array('title'=>'Magenta Theme','color_code'=>'#9958af','name'=>'magenta'),
// 			'Chocolate'=>array('title'=>'Chocolate Theme','color_code'=>'#59433E','name'=>'chocolate'),
			
		);
		
		$front_end_themeplate = array(
		    '1'=>array('title'=>'Blue Theme','color_code'=>'#5A16F5','name'=>'Happy Wedding',),
		    '2'=>array('title'=>'Blue Theme','color_code'=>'#5A16F5','name'=>'Modern Gen',),
		    '3'=>array('title'=>'Blue Theme','color_code'=>'#5A16F5','name'=>'Luxury',),
		    
	    );
	  
		
		
		$data['front_end_themes']=$front_end_themes;	
		
		$data['front_end_themeplate']= $front_end_themeplate;	
				
		$data['content'] = "$theme/appearance/themes";				
		$this->load->view("$theme/header",$data);	
		
	}	
	
	public function menus()
	{
		if(!$this->isLogin())
		{
			redirect('/logins','location');
		}
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		if(isset($_POST['submit']) || isset($_POST['draft']))		
		{			
			extract($_POST,EXTR_OVERWRITE);				 								
			
			
			
			$content = array();
			
			foreach($_POST as $k=>$v)
			{
				if(is_array($v) && $k != 'submit')
					$content[$k] = $v;
			}
			
			foreach($_POST as $k=>$v)
			{
				$_POST[$k] = $this->security->xss_clean($v);
				$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				
			}
			
			/*echo "<pre> after"; print_r($_POST); echo "</pre>"; exit;*/
			
			if(isset($options) && !empty($options))
			{
				foreach($options as $k=>$v)
				{
					$this->global_lib->update_option($k,$v);
				}
			}
			
			$data['cur_menu'] = $cur_menu;
			
			$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			'.mlx_get_lang("Menus Updated Successfully").'
			</div>							';				
			
		}
		
		
		if(isset($_POST['menu_location_submit']) )
		{
			extract($_POST,EXTR_OVERWRITE);		
			$menu_list = $this->global_lib->get_option($menu_locations);
			if(isset($menu_list) && !empty($menu_list))
			{
				$data['menu_list'] = $menu_list;
			}
			$data['menu_type'] = ucwords(str_replace('_',' ',$menu_locations));
			$data['menu_slug'] = $menu_locations;
				
		}
		else if(isset($_POST['cur_menu']) && !empty($_POST['cur_menu']) )
		{
			extract($_POST,EXTR_OVERWRITE);		
			$menu_list = $this->global_lib->get_option($cur_menu);
			if(isset($menu_list) && !empty($menu_list))
			{
				$data['menu_list'] = $menu_list;
			}
			$data['menu_type'] = ucwords(str_replace('_',' ',$cur_menu));
			$data['menu_slug'] = $cur_menu;
		}
		else
		{
			$menu_list = $this->global_lib->get_option('primary_menu');
			if(isset($menu_list) && !empty($menu_list))
			{
				$data['menu_list'] = $menu_list;
			}
			$data['menu_type'] = 'Primary Menu';
			$data['menu_slug'] = 'primary_menu';
				
		}
		
		$data['page_list'] = $this->Common_model->commonQuery("select page_id,page_title from pages where page_status = 'Y'");
		
		$user_id = $this->session->userdata('user_id');
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin')
		{
			$homepage_section = $this->global_lib->get_option('homepage_section');
		
			if(isset($homepage_section) && !empty($homepage_section))
			{
				$data['meta_content_lists'] = json_decode($homepage_section,true);
			}
		}
		else
		{
			$homepage_section = $this->global_lib->get_user_meta($user_id,'homepage_section');
		
			if(isset($homepage_section) && !empty($homepage_section))
			{
				$data['meta_content_lists'] = json_decode($homepage_section,true);
			}
		}
		
		
		$data['theme']=$theme;		
		$data['content'] = "$theme/appearance/menus";				
		$this->load->view("$theme/header",$data);		
		
	}
		
		
	
}

