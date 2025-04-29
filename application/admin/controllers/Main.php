<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {
	
	function __construct() {
        parent::__construct();
        if(!$this->isLogin())
		{
			redirect('/logins','location');
		}
	}
	
	public function index()
	{
		$user_type = $this->session->userdata('user_type');
		
		
		if($user_type == 'wedding_user')
			$this->wedding_dashboard();
		else if($user_type == 'admin')
			$this->admin_dashboard();
			
	}
	
	public function admin_dashboard()
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
		$content_sections = $CI->config->item('content_sections') ;

		$user_id = $this->session->userdata('user_id');
		$query = "select * from wedding_details where site_status = 'all-set-go'"; 
		$wedding_sites = $this->Common_model->commonquery($query);
		
		
		$data['wedding_sites'] = $wedding_sites;
		$data['social_medias'] = $CI->config->item('social_medias') ;
		
		$data['theme']=$theme;
							
				
		$data['content'] = "$theme/admin_dashboard";				
		$this->load->view("$theme/header",$data);	
		
	}
	
	public function wedding_dashboard($step=0)
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
		$content_sections = $CI->config->item('content_sections') ;

		$user_id = $this->session->userdata('user_id');
		$query = "select * from wedding_details where wedding_user_id = $user_id";
		
		$res = $this->Common_model->commonquery($query);
		
		
		$step = 0;
		$wedding_data = $this->Common_model->commonQuery("select * from wedding_details where wedding_user_id = $user_id");
		if($wedding_data->num_rows() > 0)
		{
			$hsr = $wedding_data->row();
			
			$data['row'] = $hsr;
			$data['groom_links'] = json_decode($hsr->groom_social_links,true);
			$data['bride_links'] = json_decode($hsr->bride_social_links,true);
			
			/* empty($hsr->wedding_time) || empty($hsr->wedding_venue) || empty($hsr->wedding_date) ||*/
			
			/*
			|| empty($hsr->groom_short_description) || empty($hsr->groom_social_links) || empty($hsr->groom_signature)
			|| empty($hsr->bride_short_description) || empty($hsr->bride_social_links)
			|| empty($hsr->bride_signature)
			**/
			if(empty($hsr->site_name) ||  empty($hsr->wedding_status) || empty($hsr->wedding_title) || empty($hsr->wedding_side)){
				$data['step'] = $step=0;
			}
			else if(empty($hsr->groom_name) || empty($hsr->groom_photo) ){
				$data['step'] = $step=1;
			}
			else if(empty($hsr->bride_name) || empty($hsr->bride_photo) 
			)
			{
				$data['step'] = $step=3;
			}
			else
			{
				$data['step'] = $step=4;
			}
		}
		
		$data['social_medias'] = $CI->config->item('social_medias') ;
		
		$data['step'] = $step;
		$data['theme']=$theme;
							
				
		$data['content'] = "$theme/wedding_dashboard";				
		$this->load->view("$theme/header",$data);	
		
	}	
	
	public function home_page()
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
		$user_id = $this->session->userdata('user_id');
		
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
			
			if($user_type == 'admin')
				$this->global_lib->update_option('homepage_section',json_encode($content));
			else
				$this->global_lib->update_user_meta($user_id,'homepage_section',json_encode($content));
			
			$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" style="margin-top:10px;margin-bottom:0px;">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			'.mlx_get_lang("Homepage Section Updated Successfully").'</div>';				
			redirect('/main/home_page','location');										
			
		}
		
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
		
		if($user_type == 'admin')
		{
			$content_sections = $CI->config->item('content_sections') ;
			$data['content_sections']=$content_sections;		
		}
		else
		{
			$content_sections = $CI->config->item('wed_content_sections') ;
			$data['content_sections']=$content_sections;
		}
	
		$data['content'] = "$theme/home_page";				
		$this->load->view("$theme/header",$data);	
		
	}	
}