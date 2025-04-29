<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Page extends MY_Controller {

	
	public function index($page_slug)

	{
		$CI =& get_instance();

		$theme = $CI->config->item('theme') ;

		$this->load->library('Global_lib');

		

		$data = $data = $this->global_lib->uri_check();

		$data['myHelpers']=$this;

		$this->load->model('Common_model');

		$this->load->helper('text');

		$data['theme']=$theme;

		$data['content'] = "$theme/page_result";

		
		$this->load->view("$theme/header",$data);

		$data['sidebar'] = 'sidebar-left';		
	
	}

	public function dynamic_page($slug)
	{
		$CI =& get_instance();

		$theme = $CI->config->item('theme') ;

		$this->load->library('Global_lib');

		

		$data = $data = $this->global_lib->uri_check();

		$data['myHelpers']=$this;

		$this->load->model('Common_model');

		$this->load->helper('text');

		$data['theme']=$theme;
		
		$query = "select page_title,page_content
		from pages
		where page_slug = '$slug'";
		
		$single_page_result = $this->Common_model->commonQuery($query );
		if($single_page_result->num_rows() > 0)
		{
			$data['page_row'] = $single_page_result->row();
		}
		else
		{
			redirect('/','location');
		}
		$data['wedding'] = $this->Common_model->commonQuery("select * from wedding_details limit 1");
		
		$data['content'] = "$theme/page/dynamic_page";

		$this->load->view("$theme/header",$data);
	}

	

}

