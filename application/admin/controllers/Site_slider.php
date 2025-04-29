<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_slider extends MY_Controller {	
	
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
		
		$user_id = $this->session->userdata('user_id');
		
		$data['query'] = $this->Common_model->commonQuery("select * from `site_slider` 
		where user_id = $user_id
		order by img_order ASC");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/site_slider/manage";
		
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
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', "</div>");
			
			
			$this->form_validation->set_rules('photo', 'photo', 'trim|required');
			$this->form_validation->set_rules('img_order', 'Image Order', 'trim|required');
			
			
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
				
				$user_id = $this->session->userdata('user_id');
				
				$datai = array( 
								'slide_img' => trim($photo),
								'user_id' => trim($user_id),
								'img_order'=>trim($img_order),
								'created_at'=>$cur_time,
								'updated_at'=>$cur_time,
								); 
				
				$user_id=$this->Common_model->commonInsert('site_slider',$datai);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Site Slider added Successfully.
							</div>
							';
				redirect('/site_slider/manage','location');	
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/site_slider/add_new";
		
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
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', "</div>");
			
				
			$this->form_validation->set_rules('photo', 'photo', 'trim|required');
			$this->form_validation->set_rules('img_order', 'Image Order', 'trim|required');
			
			
			
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
								'slide_img' => trim($photo),
								'img_order' => trim($img_order),
								'updated_at' => $cur_time
								);
					
				
				$this->Common_model->commonUpdate('site_slider',$datai,'id',$cId);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Site Slider Updated Successfully.
						  </div>
							';
				redirect('/site_slider/manage','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
				select * from site_slider where id = $decId");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/site_slider/edit";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function delete($rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='site_slider';
		$pid='id';
		$url='/site_slider/manage/';	 	
		$fld='Site Slider';
		
		$result = $this->Common_model->commonQuery("select slide_img from site_slider where id = $rowid and slide_img != ''");
		if($result->num_rows() > 0)
		{
			$photo_name = $result->row()->slide_img;
			if(isset($photo_name) && !empty($photo_name) && file_exists('../uploads/site_slider/'.$photo_name))
				unlink('../uploads/site_slider/'.$photo_name);
		}
		
		$rows = $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
	
	public function plus($id){
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		$order_id = $this->global_lib->DecryptClientId($id);
		
		$result = $this->Common_model->commonQuery("select img_order from site_slider where id = $order_id");
		$newVal='';
		foreach($result->result() as $row){
			$temp = $row->img_order;
			$temp++;
			$newVal = $temp;
		}
			$datai = array( 
						'img_order' => $newVal,
						'id' => $order_id);
						
			$this->Common_model->commonUpdate('site_slider',$datai,'id',$order_id);
			$_SESSION['msg'] = '
					<div class="alert alert-success alert-dismissable" >
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						Site Slider Order Updated Successfully. New Value is: '.$newVal.'
				  </div>
					';	
		
			redirect('/site_slider/manage','location');	
	}
	public function minus($id){
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		$order_id = $this->global_lib->DecryptClientId($id);
		
		$result = $this->Common_model->commonQuery("select img_order from site_slider where id = $order_id");
		$newVal='';
		foreach($result->result() as $row){
			$temp = $row->img_order;
			$temp--;
			$newVal = $temp;
		}
			$datai = array( 
						'img_order' => $newVal,
						'id' => $order_id);
						
			$this->Common_model->commonUpdate('site_slider',$datai,'id',$order_id);
			$_SESSION['msg'] = '
					<div class="alert alert-success alert-dismissable" >
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						Site Slider Order Updated Successfully. And New Value is: '.$newVal.'
				  </div>
					';	
		
			redirect('/site_slider/manage','location');	
	}
	
}
