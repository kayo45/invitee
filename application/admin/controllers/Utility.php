<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility extends MY_Controller {	
	
	function __construct() {
        parent::__construct();
        if(!$this->isLogin())
		{
			
			redirect('/logins','location');
		}
		
    }
	
	public function index()
	{
		redirect('/main/','location');
	}
	
	
	public function audio(){

		$wedding_user_id = $this->session->userdata('user_id');

		// tesx($wedding_user_id);

		$data['query'] = $this->Common_model->commonQuery("
		select * from wedding_utility where wedding_user_id = $wedding_user_id
		AND nama='audio' ");

		$c_id = $this->Common_model->commonQuery("
				select * from wedding_utility where wedding_user_id = $wedding_user_id
				AND nama='audio' ")->row_array();
		
		$c_id = $c_id['id_utility'];

		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');


		$data['title']='Mp3 Upload';
		$data['error']='';
		$data['success']='';

		// $foldername= FCPATH. '../uploads/audio/';

		// tesx($foldername);
	    if(isset($_POST['save'])){
	        if(empty($_FILES["uploadSong"]["name"])){
				$data['error']='The Upload track field is required';

				$data['query'] = $this->Common_model->commonQuery("
				select * from wedding_utility where wedding_user_id = $wedding_user_id
				AND nama='audio' ");

				$c_id = $this->Common_model->commonQuery("
						select * from wedding_utility where wedding_user_id = $wedding_user_id
						AND nama='audio' ")->row_array();
				
				$c_id = $c_id['id_utility'];
				
				$data['theme']=$theme;

				$data['content'] = "$theme/utility/audio";
				
				$this->load->view("$theme/header",$data);
			}else{

				$dtaudio = $this->Common_model->commonQuery("
						select * from wedding_utility where wedding_user_id = $wedding_user_id
						AND nama='audio' ")->row_array();

				$fileName = $_FILES["uploadSong"]["name"];
				$foldername = APPPATH.'../../uploads/audio';

				// tesx($dtaudio['konten']);

				$path = APPPATH.'../../uploads/audio/'.$dtaudio['konten'] ;

				
				if(is_file($path)){
				  unlink($path);

				//   tesx('ok');
				}

				// tesx($path);

				
				$this->load->library('upload_audio');
				$returnArr = $this->upload_audio->uploadMp3($_FILES["uploadSong"]["name"],$fileName,$foldername);
				

				$up=explode(".",$_FILES["uploadSong"]["name"]);
                $name2=$up[0];
                $end=end($up);
                $asset_url_name = str_replace(' ','',$name2).strtotime(date('Y-m-d')).'.'.$end;

				


				$datai = array( 
					'konten' => trim($asset_url_name),
				);
				$this->Common_model->commonUpdate('wedding_utility',$datai,'id_utility',$c_id);



				
				if($returnArr['success']==1){
					$data['query'] = $this->Common_model->commonQuery("
					select * from wedding_utility where wedding_user_id = $wedding_user_id
					AND nama='audio' ");

					$c_id = $this->Common_model->commonQuery("
							select * from wedding_utility where wedding_user_id = $wedding_user_id
							AND nama='audio' ")->row_array();
					
					$c_id = $c_id['id_utility'];
					
					$data['success']='Song upload path is : '.$returnArr['filepath'];
					$data['theme']=$theme;

					$data['content'] = "$theme/utility/audio";
					
					$this->load->view("$theme/header",$data);
				}else{
					$data['query'] = $this->Common_model->commonQuery("
					select * from wedding_utility where wedding_user_id = $wedding_user_id
					AND nama='audio' ");

					$c_id = $this->Common_model->commonQuery("
							select * from wedding_utility where wedding_user_id = $wedding_user_id
							AND nama='audio' ")->row_array();
					
					$c_id = $c_id['id_utility'];
					
					$data['error']=$returnArr['message'];
					$data['theme']=$theme;

					$data['content'] = "$theme/utility/audio";
					
					$this->load->view("$theme/header",$data);
				}
				
			}
		}else{
			$data['query'] = $this->Common_model->commonQuery("
			select * from wedding_utility where wedding_user_id = $wedding_user_id
			AND nama='audio' ");

			$c_id = $this->Common_model->commonQuery("
					select * from wedding_utility where wedding_user_id = $wedding_user_id
					AND nama='audio' ")->row_array();
			
			$c_id = $c_id['id_utility'];
			
			$data['theme']=$theme;
		
			$data['content'] = "$theme/utility/audio";
			
			$this->load->view("$theme/header",$data);

		        // $this->load->view('songupload',$arr);	
		}
	}
	
	
	public function filter_ig() {
		$wedding_user_id = $this->session->userdata('user_id');

		

		$c_id = $this->Common_model->commonQuery("
				select * from wedding_utility where wedding_user_id = $wedding_user_id
				AND nama='filter_ig' ")->row_array();
		
		$c_id = $c_id['id_utility'];

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
			
				
			$this->form_validation->set_rules('filter_ig', 'Filter Ig Link', 'trim|required');
			
			
			
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
				
				
				
				$wedding_user_id= '';
				
					if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_id') > 0){
						$wedding_user_id = $this->session->userdata('user_id');
					}
					
				$datai = array( 
					'konten' => trim($filter_ig),
				);

				// tesx($c_id ,$datai);
					
				
				$this->Common_model->commonUpdate('wedding_utility',$datai,'id_utility',$c_id);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Filter IG Updated Successfully.
						  </div>
							';
				redirect('/utility/filter_ig','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
		select * from wedding_utility where wedding_user_id = $wedding_user_id
		AND nama='filter_ig' ");
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/utility/filter_ig";
		
		$this->load->view("$theme/header",$data);
		
	}

	public function maps() {
		$wedding_user_id = $this->session->userdata('user_id');

		$c_id = $this->Common_model->commonQuery("
				select * from wedding_utility where wedding_user_id = $wedding_user_id
				AND nama='maps' ")->row_array();
		
		$c_id = $c_id['id_utility'];

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
			
				
			$this->form_validation->set_rules('maps', 'Maps Embed', 'trim|required');
			
			
			
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
				
				
				
				$wedding_user_id= '';
				
					if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_id') > 0){
						$wedding_user_id = $this->session->userdata('user_id');
					}
					
				$datai = array( 
					'konten' => trim($maps),
				);

				// tesx($c_id ,$datai);
					
				
				$this->Common_model->commonUpdate('wedding_utility',$datai,'id_utility',$c_id);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Filter IG Updated Successfully.
						  </div>
							';
				redirect('/utility/maps','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
		select * from wedding_utility where wedding_user_id = $wedding_user_id
		AND nama='maps' ");
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/utility/maps";
		
		$this->load->view("$theme/header",$data);
		
	}

	public function youtube() {
		$wedding_user_id = $this->session->userdata('user_id');

		$c_id = $this->Common_model->commonQuery("
				select * from wedding_utility where wedding_user_id = $wedding_user_id
				AND nama='youtube' ")->row_array();
		
		$c_id = $c_id['id_utility'];

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
			
				
			$this->form_validation->set_rules('youtube', 'Maps Embed', 'trim|required');
			
			
			
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
				
				
				
				$wedding_user_id= '';
				
					if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_id') > 0){
						$wedding_user_id = $this->session->userdata('user_id');
					}
					
				$datai = array( 
					'konten' => trim($youtube),
				);

				// tesx($c_id ,$datai);
					
				
				$this->Common_model->commonUpdate('wedding_utility',$datai,'id_utility',$c_id);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Filter IG Updated Successfully.
						  </div>
							';
				redirect('/utility/youtube','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
		select * from wedding_utility where wedding_user_id = $wedding_user_id
		AND nama='youtube' ");
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/utility/youtube";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	
}
