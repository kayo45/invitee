<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kutipan extends MY_Controller {
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
		
		$wedding_user_id= '';
				
		if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_id') > 0){
			$wedding_user_id = $this->session->userdata('user_id');
		}
		
		$wedding_id = $this->session->userdata('wedding_id');
		
		
		$data['query'] = $this->Common_model->commonQuery("select wk.* ,users.user_name
		from wedding_kutipan wk
		inner join users on wk.wedding_user_id = users.user_id 
		where wk.wedding_id = $wedding_id
		order by wk.place ASC ");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/kutipan/manage";
		
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

			$w_u_id = $this->session->userdata('user_id');
			
			$placement = $_POST['place'];
			$cekPlace = $this->Common_model->commonQuery("
				select * from wedding_kutipan where wedding_user_id = $w_u_id AND place LIKE '%$placement%' ")->row_array();	


			if($cekPlace == TRUE){
				$_SESSION['msg'] = '
								<div class="alert alert-warning alert-dismissable" >
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
									
									Placement Sudah Ada, Silahkan Di Edit
								</div>
								';
				redirect('/kutipan/manage','location');	
			}
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>', "</div>");
			
			
			$this->form_validation->set_rules('place', 'Placement', 'trim|required');
			$this->form_validation->set_rules('kutipan', 'Kutipan', 'trim|required');
			
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
								'place' => trim($place),
								'wedding_user_id' => $wedding_user_id,
								'wedding_id' => $wedding_id,
								'kutipan'=>trim($kutipan),
								); 
				
				$user_id=$this->Common_model->commonInsert('wedding_kutipan',$datai);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Story added Successfully.
							</div>
							';
				redirect('/kutipan/manage','location');	
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/kutipan/add_new";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function edit($c_id = NULL)
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
			
				
			$this->form_validation->set_rules('place', 'Placement', 'trim|required');
			$this->form_validation->set_rules('kutipan', 'Kutipan', 'trim|required');
			
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
				$wedding_user_id= '';
				
				if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_id') > 0){
					$wedding_user_id = $this->session->userdata('user_id');
				}
				$datai = array( 
						'place' => trim($place),
						'kutipan'=>trim($kutipan),
					); 
				$this->Common_model->commonUpdate('wedding_kutipan',$datai,'id',$cId);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Story Updated Successfully.
						  </div>
							';
				redirect('/kutipan/manage','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
				select * from wedding_kutipan where id = $decId");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/kutipan/edit";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function delete($rowid)
	{
		
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');

		// tesx($rowid);
			
		$tbl='wedding_kutipan';
		$pid='id';
		$url='/kutipan/manage/';	 	
		$fld='Kutipan';
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
	
	
}
