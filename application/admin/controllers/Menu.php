<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {
	
	function __construct() 
	{
        parent::__construct();
        if(!$this->isLogin())
		{
			redirect('/logins','location');
		}
	}
	
	public function index()
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
		
		$data['theme']=$theme;		
		$data['content'] = "$theme/menu/menus";				
		$this->load->view("$theme/header",$data);	
		
	}
	
}

