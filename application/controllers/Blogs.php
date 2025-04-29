<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends MY_Controller {
	
	
	
	public function index()
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
		
		
		$today_timestamp = mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
		
		$data['blogs'] = $this->Common_model->commonQuery("select b.*,bc.title as cat_title,bc.slug as cat_slug from blogs as b 
		left join blog_categories as bc on bc.c_id = b.cat_id
		where b.status = 'publish' and b.publish_on <= $today_timestamp order by b.publish_on DESC
		");
		
		
		$data['content'] = "$theme/blogs";
		
		$data['page_title'] = "Blogs";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function single($slug)
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
		
		$today_timestamp = mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));

		$data['blog'] = $this->Common_model->commonQuery("
		select b.*,bc.title as cat_title,bc.slug as cat_slug from blogs as b 
		left join blog_categories as bc on bc.c_id = b.cat_id
		where b.slug='$slug' and b.publish_on <= $today_timestamp and b.status = 'publish'  order by b.publish_on DESC
		");
		
		$data['blog_categories'] = $this->Common_model->commonQuery("select bc.title,bc.slug as cat_slug,COUNT(b.b_id) AS total_blog	
		from blog_categories as bc
		left join blogs as b on b.cat_id = bc.c_id and b.status = 'publish' and b.publish_on <= $today_timestamp
		where bc.status = 'Y'  group by bc.c_id order by total_blog DESC limit 10");
		
		$data['recent_blogs'] = $this->Common_model->commonQuery("select b.slug,b.title
		from blogs as b
		where b.status = 'publish' and b.publish_on <= $today_timestamp order by b.publish_on DESC limit 10");
		
		$data['content'] = "$theme/single_blog";
		
		$data['page_title'] = $slug;
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function category($slug = Null)
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ; 
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		$data['theme']=$theme;
		$data['wedding'] = $this->Common_model->commonQuery("select * from wedding_details limit 1");
		
		$today_timestamp = mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
		
		$data['blogs'] = $blogs = $this->Common_model->commonQuery("select b.*,bc.title as cat_title,bc.slug as cat_slug from blogs as b 
		inner join blog_categories as bc on bc.c_id = b.cat_id
		where b.status = 'publish' and b.publish_on <= $today_timestamp and bc.slug = '$slug' order by b.publish_on DESC
		");
		
		if($blogs->num_rows() == 0)
		{
			redirect('/blogs','location');
		}
		
		
		
		$data['content'] = "$theme/blogs";

		$this->load->view("$theme/header",$data);	
	}
	
	
	
}
