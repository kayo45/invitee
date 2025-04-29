<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wedevent extends MY_Controller {


	public function _remap($method = null, $args = null) {
		
		
		//$multi_lang = $this->enable_multi_lang;
		//$default_lang = $this->default_language;
		//$default_lang_code = $this->default_lang_code;
		//print_r($method); print_r($args);exit;
		if($method == 'event')
			$this->event($args);
	}	
	
	public function event($args)
	{

	
		

		if(isset($args[0]) && $args[0] != '' )
		{
			$site_name = $args[0];

			$get_site_id = $this->Common_model->commonQuery("select * from wedding_details where site_name LIKE '%$site_name%' ")->row_array();
			
			$site_id = $get_site_id['id'];
			
			
			$this->load->model('Common_model');
			$CI =& get_instance();
			
			$getTheme =  $this->Common_model->commonQuery("select * from wedding_details where site_name = '$site_name' and id = '$site_id'")->row_array();
			


            if(!empty($getTheme['template'])){
                $theme = $getTheme['template'];
            }else{
                $theme = $CI->config->item('theme') ;  
                
            }
            

			
			$this->load->library('Global_lib');
			$this->load->helper('text');
			
			$data = $this->global_lib->uri_check();
			
			$data['myHelpers']=$this;
			
			$data['theme']=$theme;
			

			
			$data['wedding'] = $data['couple'] = $this->Common_model->commonQuery("select * from wedding_details where site_name = '$site_name' and id = '$site_id'");
			
			$data['slider'] = $data['couple']->row();
			$wedding_user_id = $data['couple']->row()->wedding_user_id;
			
			$data['info'] = $data['couple']->row();
			
			$homepage_section = $this->global_lib->get_user_meta($wedding_user_id,'homepage_section');
			if(isset($homepage_section) && !empty($homepage_section))
			{
				$data['homepage_section'] = json_decode($homepage_section,true);
			}
			
			$data['cur_page'] = 'home'; 
			
			$data['content'] = "$theme/wed-home-page";
			
			$data['page_title'] = "Home";
			$data['wedding_id'] = $site_id;
			$data['wedding_user_id'] = $wedding_user_id;

			
			$this->load->view("$theme/wed-header",$data);
		}
	}
	
	public function index($wedder)
	{

		$this->load->model('Common_model');
		$CI =& get_instance();
		
		$theme = $CI->config->item('theme') ;  
		
		$this->load->library('Global_lib');
		$this->load->helper('text');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		
		$data['theme']=$theme;
		
		
		$data['wedding'] = $this->Common_model->commonQuery("select * from wedding_details limit 1");
		
		
		
		$data['couple'] = $this->Common_model->commonQuery("select * from wedding_details");
		
		
		
		
		
		
		$data['slider'] = $data['couple']->row();
		
		
		
		
		
		$homepage_section = $this->global_lib->get_option('homepage_section');
		if(isset($homepage_section) && !empty($homepage_section))
		{
			$data['homepage_section'] = json_decode($homepage_section,true);
		}
		
		$data['cur_page'] = 'home'; 
		
		$data['content'] = "$theme/home-page";
		
		$data['page_title'] = "Home";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	
	
	
	
}
