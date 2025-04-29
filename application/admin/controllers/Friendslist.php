<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friendslist extends MY_Controller {	
	
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
		
		$data['wedding_details'] = $this->Common_model->commonQuery("select * from wedding_details");
		
		$data['query'] = $this->Common_model->commonQuery("select * from wedding_friendslist order by friend_id");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/friends/manage";
		
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
			
			
			$this->form_validation->set_rules('first_name', 'Friend Frist Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Friend Last Name', 'trim|required');
			$this->form_validation->set_rules('Email', 'Friend Email Address', 'trim|required');
			
				
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
				
			
				
				$cur_time = time();
				
				
				$datai = array( 
								'first_name' => trim($first_name),
								'last_name'=>trim($last_name),
								'email'=>trim($Email),
								'city' => trim($City),
								'state' => trim($State),
								'country' => trim($Country),
								'created_at'=>$cur_time,
								'updated_at'=>$cur_time,
								); 
				
				$friend_id=$this->Common_model->commonInsert('wedding_friendslist',$datai);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Event added Successfully.
							</div>
							';
				redirect('/friendslist/manage','location');	
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/friends/add_new";
		
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
			
				
			$this->form_validation->set_rules('first_name', 'Friends Frist Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Friends Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Friends Email Address', 'trim|required');
			
			
			
			
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
								'first_name' => trim($first_name),
								'last_name'=>trim($last_name),
								'email'=>trim($email),
								'city' => trim($city),
								'state' => trim($state),
								'country' => trim($country),
								'created_at'=>$cur_time,
								'updated_at'=>$cur_time,
								); 
					
				
				$this->Common_model->commonUpdate('wedding_friendslist',$datai,'friend_id',$cId);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Event Updated Successfully.
						  </div>
							';
				redirect('/friendslist/manage','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
				select * from wedding_friendslist where friend_id = $decId");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/friends/edit";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function delete($rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='wedding_friendslist';
		$pid='friend_id';
		$url='/friendslist/manage/';	 	
		$fld='Event';
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
	
	public function sendInvitation($id=null){
				
		$CI =& get_instance();		
		$this->load->library('Global_lib');		
		$this->load->model('Common_model');
		$this->load->helper('text');
		$this->load->library('email');
		
		
		$dec_id = $this->global_lib->decryptClientId($id);
		$friend = "select * from wedding_friendslist where friend_id=$dec_id ";
		$res = $this->Common_model->commonQuery($friend);
		
		$wedding = "select * from wedding_details";
		$rs = $this->Common_model->commonQuery($wedding);
		
		$rec = $res->row()->email;
		$sql = "select * from options where option_key='email_setting' ";
		$site_link = str_replace('/admin/','/',base_url());
		$msg='<a href="'.$site_link.'?name='.$res->row()->first_name.'&email='.$res->row()->email.'#rsvp">You Have Invitation from xyz</a>
			Dear '.$res->row()->first_name.' '.$res->row()->last_name.' Hope you doing Well <br/>
			We are celebrating Our Wedding on '.date('M d, Y',$rs->row()->wedding_date).' Bless us with your Wishes Thanks <br/>
			We Will Wating for You and Your Family';
		
		$result = $this->Common_model->commonQuery($sql);
		$setting = [];
		
		foreach($result->result() as $options){
			$option = json_decode($options->option_value);
		}
		
		foreach($option as $key=>$value){
			$setting[$key]=$value;
		}
		
		
		$config = $setting;
		
		$this->email->initialize($config);
		
		$this->email->set_newline("\r\n");
		
		$htmlContent = $msg;
		$this->email->to($rec);
		$this->email->from('support@minmindlogixtech.com','Wedding Cms');
		$this->email->subject('This is the Testing Mail From Wedding CMS');
		$this->email->message($htmlContent);
		
		
		$response = $this->email->send();
		
		if($response == true){
			$_SESSION['msg'] = '
			<div class="alert alert-success alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				
				Invitation Send Sucessfully
			</div>
			';
			redirect('/friendslist/manage','location');	
		}else{
			$_SESSION['msg'] = '
			<div class="alert alert-danger alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				
				Something Went Wrong
			</div>
			';
			redirect('/friendslist/manage','location');	
		}
		
		
	}
	
}
