<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guestbook extends MY_Controller {	
	
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
		
		
		$wedding_user_id = $this->session->userdata('user_id');

		$data['query'] = $this->Common_model->commonQuery("select * from wedding_invitations where wedding_user_id ='$wedding_user_id' order by id");
			
			
		$evns = $this->Common_model->commonQuery("SELECT event_id,event_title,event_date,event_time FROM wedding_event");
		$data['events'] = $evns->result();
		$data['theme']=$theme;
		
		$data['content'] = "$theme/guestbook/manage";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	
	public function delete($rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='wedding_invitations';
		$pid='id';
		$url='/attendee/manage/';	 	
		$fld='Attendee';
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
	
	
	public function managelist()
	{
	    $CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		
		$wedding_id = $this->session->userdata('wedding_id');
		
		
		$data['query'] = $query = $this->Common_model->commonQuery("
				select wt.*, wd.site_name
				
				from wedding_tamu as wt
				left join wedding_details as wd on wd.id = wt.wedding_user_id
				where wt.wedding_user_id = $wedding_id
				order by wt.nama_undangan  ASC
				");	
		
		$data['theme']=$theme;
		
		
		
		$data['content'] = "$theme/guestbook/managelist";
		
		$this->load->view("$theme/header",$data);
	    
	}
	
	
	public function add_tamu()
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
			
			
			$this->form_validation->set_rules('no_hp', 'No Handphone', 'trim|required');
			$this->form_validation->set_rules('nama_undangan', 'Nama Tamu Undangan', 'trim|required');
			$this->form_validation->set_rules('template', 'Isi Undangan', 'trim|required');
			
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
				$wedding_user_id= 0;
				if(!empty($this->session->userdata('user_id'))){
					$wedding_user_id = $this->session->userdata('user_id');
				}
				
				$wedding_id= 0;
				if(!empty($this->session->userdata('wedding_id'))){
					$wedding_id = $this->session->userdata('wedding_id');
				}
				
				$datai = array( 
						'wedding_user_id' => $wedding_id,
						'no_hp'  =>trim($no_hp),
						'nama_undangan'  =>trim($nama_undangan),
						'template'  =>trim($template),
					); 
				
				$user_id=$this->Common_model->commonInsert('wedding_tamu',$datai);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Story added Successfully.
							</div>
							';
				redirect('/guestbook/managelist','location');	
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/guestbook/add_tamu";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function edit_tamu($c_id = NULL)
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
			
			$this->form_validation->set_error_delimiters("<div class='notification note-error'>	
			<a href='#' class='close' title='Close'>
			<span>close</span></a> 	<span class='icon'></span>	<p><strong>Error :</strong>", "</p></div>");
			
				
			$this->form_validation->set_rules('no_hp', 'No Handphone', 'trim|required');
			$this->form_validation->set_rules('nama_undangan', 'Nama Undangan', 'trim|required');
			$this->form_validation->set_rules('template', 'Isi Undangan', 'trim|required');
			
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
				$wedding_id= 0;
				if(!empty($this->session->userdata('wedding_id'))){
					$wedding_id = $this->session->userdata('wedding_id');
				}
				
				$datai = array( 
						'wedding_user_id' => $wedding_id,
						'no_hp'  =>trim($no_hp),
						'nama_undangan'  =>trim($nama_undangan),
						'template'  =>trim($template),
					); 
					
				$this->Common_model->commonUpdate('wedding_tamu',$datai,'id',$cId);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Story Updated Successfully.
						  </div>
							';
				redirect('/guestbook/managelist','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
				select * from wedding_tamu where id = $decId");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/guestbook/edit_tamu";
		
		$this->load->view("$theme/header",$data);
		
	}
	

    public function delete_tamu($rowid)
	{
	   // tesx($rowid);
	    
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='wedding_tamu';
		$pid='id';
		$url='/guestbook/managelist/';	 	
		$fld='Guestbokk';
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
}
