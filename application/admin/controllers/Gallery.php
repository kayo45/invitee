<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MY_Controller {	
	
	function __construct() {
        parent::__construct();
        if(!$this->isLogin())
		{
			
			redirect('/logins','location');
		}
		
		if(!$this->has_method_access())
		{
			redirect('/main/','location');
		}
    }
	
	public function index()
	{
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
				
		$user_id = $this->session->userdata('user_id');
		$user_type = $this->session->userdata('user_type');
		
		$qry = "select wedding_gallery.*, users.user_name from wedding_gallery 
			inner join users on wedding_gallery.wedding_user_id = users.user_id
				where wedding_gallery.image_type = 'medium' and wedding_user_id = $user_id
				order by wedding_gallery.image_id DESC";	
		
		$data['album_list'] = $this->Common_model->commonQuery($qry);	
		
		$data['theme'] = $theme;
		
		$data['content'] = "$theme/gallery/manage";
		
		$this->load->view("$theme/header",$data);
	}
	
	
	
}
