<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->load->model('Common_model');
		$CI 	= & get_instance();
		$theme 	= $CI->config->item('theme') ;

		$this->load->library('Global_lib');
		$this->load->helper('text');

		$data 				= $this->global_lib->uri_check();

		$data['myHelpers']	= $this;

		$data['theme']		= $theme;

		$homepage_section 	= $this->global_lib->get_option('homepage_section');
		if(isset($homepage_section) && !empty($homepage_section))
		{
			$data['homepage_section'] = json_decode($homepage_section,true);
		}

		$data['content'] 	= "$theme/home-page";

		$data['cur_page'] 	= 'home';

		$data['page_title'] = "Home";

		$this->load->view("$theme/header",$data);

	}

	public function register()
	{
		$data = $this->security->xss_clean($_POST);

		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;

		$this->load->library('Global_lib');
		$this->load->helper('security');

		$enbale_front_end_registration = $this->global_lib->get_option('enbale_front_end_registration');

		$logged_in = $this->session->userdata('logged_in');
		if($enbale_front_end_registration != 'Y' || $logged_in == TRUE)
		{
			redirect('/','location');
		}

		$data = $this->global_lib->uri_check();
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		$data['has_banner'] = false;

		$data['page_title'] = "Register";

		$data['theme']=$theme;

		$data['content'] = "$theme/register";

		$this->load->view("$theme/header",$data);

	}

}
