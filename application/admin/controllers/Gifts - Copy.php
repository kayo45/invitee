<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gifts extends MY_Controller {	
	
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
		$this->manage();
	}
	
	
	public function manage()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme');
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		
		$data['query'] = $this->Common_model->commonQuery("select * from wedding_gifts order by gift_id");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/gifts/manage";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function add_new()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme');
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		
		if(isset($_POST['submit']) || isset($_POST['draft']))
		{
			
			extract($_POST);
			
			
			foreach($_POST as $k=>$v)
			{
				
				$_POST[$k] = $this->security->xss_clean($v);
				$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
			}
			
			if(isset($_POST['multi_lang']) && !empty($_POST['multi_lang']))
			{
				foreach($_POST['multi_lang'] as $mk=>$mv)
				{
					foreach($mv as $mvk=>$mvv)
					{
						$_POST['multi_lang'][$mk][$mvk] = str_replace('[removed]','',$mvv);
					}
				}
			}
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', "</div>");
			
			
			$this->form_validation->set_rules('gift_title', 'Gift Title', 'trim|required');
			$this->form_validation->set_rules('gift_image', 'Gift Image', 'trim|required');
			$this->form_validation->set_rules('gift_price', 'Gift Price', 'trim|required');
			$this->form_validation->set_rules('gift_description', 'Gift Description', 'trim|required');
			
			
			
			if ($this->form_validation->run() != FALSE)
			{
				
				extract($_POST,EXTR_OVERWRITE);
				 
				
				if(empty($user_id) || $user_id == 0)
				{	
					$_SESSION['msg'] = '<p class="error_msg">Session Expired.</p>';
					$_SESSION['logged_in'] = false;	
					$this->session->set_userdata('logged_in', false);
					redirect('/logins','location');
				}
				
				if(isset($_POST['submit']))
					$page_status = 'publish';
				else if(isset($_POST['draft']))
					$page_status = 'draft';
				else
					$page_status = 'draft';
				
				$cur_time = time();
				
				$config = array( 'field' => 'slug', 'title' => 'title', 'table' => 'wedding_gifts', 'id' => 'gift_id');
				$this->load->library('Slug_lib', $config);
				
				$datap = array( 'title' => $gift_title, );
				$slug = $this->slug_lib->create_uri($datap); 
				$datai = array( 
								'title' => trim($gift_title),
								'slug' => trim($slug),
								'image'=>trim($gift_image),
								'price'=>trim($gift_price),
								'description' => trim($gift_description),
								'created_at'=>$cur_time,
								'updated_at'=>$cur_time,
								); 
				
				$user_id=$this->Common_model->commonInsert('wedding_gifts',$datai);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Gifts added Successfully.
							</div>
							';
				redirect('/gifts/manage','location');	
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/gifts/add_new";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function edit($c_id = NULL)
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
					
		if(isset($_POST['submit']) || isset($_POST['draft']))
		{
			extract($_POST);
			
			foreach($_POST as $k=>$v)
			{
				$_POST[$k] = $this->security->xss_clean($v);
				$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
			}
			
			if(isset($_POST['multi_lang']) && !empty($_POST['multi_lang']))
			{
				foreach($_POST['multi_lang'] as $mk=>$mv)
				{
					foreach($mv as $mvk=>$mvv)
					{
						$_POST['multi_lang'][$mk][$mvk] = str_replace('[removed]','',$mvv);
					}
				}
			}
			
			$this->form_validation->set_error_delimiters("<div class='notification note-error'>	
			<a href='#' class='close' title='Close'>
			<span>close</span></a> 	<span class='icon'></span>	<p><strong>Error :</strong>", "</p></div>");
			
				
			$this->form_validation->set_rules('gift_title', 'Gift Title', 'trim|required');
			$this->form_validation->set_rules('gift_price', 'Gift Price', 'trim|required');
			$this->form_validation->set_rules('gift_description', 'Gift Description', 'trim|required');
			
			
			
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				
				if(isset($_POST['submit']))
					$page_status = 'publish';
				else if(isset($_POST['draft']))
					$page_status = 'draft';
				else
					$page_status = 'draft';
				 
				$cId = $this->global_lib->DecryptClientId($Id);
				
				$cur_time = time();
				
				$datai = array( 
								'title' => trim($gift_title),
								'image'=>trim($gift_image),
								'price'=>trim($gift_price),
								'description' => trim($gift_description),
								'created_at'=>$cur_time,
								'updated_at'=>$cur_time,
								); 
			
				
				if(isset($slug) && isset($old_slug) && !empty($slug) &&  $slug != $old_slug )
					{
						
						$config = array(
						'field' => 'slug',
						'title' => 'title',
						'table' => 'wedding_gifts',
						'id' => 'gift_id',
						);
						$this->load->library('Slug_lib', $config);
						
						$datap = array(
							'slug' => $slug,
						);
						 $slug = $this->slug_lib->create_uri($datap);
						
						
						$datai['slug'] = $slug;
						
					}
				
				$this->Common_model->commonUpdate('wedding_gifts',$datai,'gift_id',$cId);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Gifts Updated Successfully.
						  </div>
							';
				redirect('/gifts/manage','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
				select * from wedding_gifts where gift_id = $decId");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/gifts/edit";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function delete($rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='wedding_gifts';
		$pid='gift_id';
		$url='/gifts/manage/';	 	
		$fld='Gifts';
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
	
	
	
}
