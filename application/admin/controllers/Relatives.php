<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatives extends MY_Controller {	
	
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
		
		
				
		$wedding_id = $this->session->userdata('wedding_id');
		
				
		$wedding_user_id = $this->session->userdata('user_id');
		
		
		$data['query'] = $this->Common_model->commonQuery(
		"select r.*,re.title as relation_title from `wedding_relatives` as r 
			left join wedding_relations as re on re.rel_id = r.relation
			inner join users on r.wedding_user_id = users.user_id
		where r.wedding_id = $wedding_id and r.wedding_user_id= $wedding_user_id
		 order by r.r_id DESC ");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/relatives/manage";
		
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
			
			
			$this->form_validation->set_rules('name', 'Relative Name', 'trim|required');
			$this->form_validation->set_rules('type', 'Relative Type', 'trim|required');
			
			
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
					$status = 'Y';
				else if(isset($_POST['draft']))
					$status = 'N';
				else
					$status = 'N';
				
				$cur_time = time();
				$wedding_id = $this->session->userdata('wedding_id');
		
				$wedding_user_id = $this->session->userdata('user_id');
				$datai = array( 
								'name' => trim($name),
								'sub_title'=>trim($sub_title),
								'image' => trim($photo),
								'type' => trim($type),
								'created_on'=>$cur_time,
								'created_by'=>$user_id,
								'wedding_id' => trim($wedding_id),
								'wedding_user_id' => trim($wedding_user_id),
								'status' => $status
								); 
				$datai['relation'] = '';
				if(isset($relation) && !empty($relation))
				{
					$datai['relation'] = $relation;
				}
				
				if(isset($social_meta) && !empty($social_meta))
				{
					$datai['social_meta'] = json_encode($social_meta);
				}
				$this->Common_model->commonInsert('wedding_relatives',$datai);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								Relative added Successfully.
							</div>
							';
				redirect('/relatives/manage','location');	
			}
		}
		
		$data['relation_list'] = $this->Common_model->commonQuery("select * from `wedding_relations` order by rel_id DESC ");	
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/relatives/add_new";
		
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
			
				
			$this->form_validation->set_rules('name', 'Relative Name', 'trim|required');
			$this->form_validation->set_rules('type', 'Relative Type', 'trim|required');
			
			
			
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
				
				if(isset($_POST['submit']))
					$status = 'Y';
				else if(isset($_POST['draft']))
					$status = 'N';
				else
					$status = 'N';
				
				$cur_time = time();
				
				$datai = array( 
								'name' => trim($name),
								'sub_title'=>trim($sub_title),
								'image' => trim($photo),
								'type' => trim($type),
								'status' => $status
								); 
				$datai['relation'] = '';
				if(isset($relation) && !empty($relation))
				{
					$datai['relation'] = $relation;
				}
				
				if(isset($social_meta) && !empty($social_meta))
				{
					$datai['social_meta'] = json_encode($social_meta);
				}
				
				$this->Common_model->commonUpdate('wedding_relatives',$datai,'r_id',$cId);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Relative Updated Successfully.
						  </div>
							';
				redirect('/relatives/manage','location');	
			
			
			}
		}
		
		$data['id'] = $c_id;
		
		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
				select * from wedding_relatives where r_id = $decId");	
		
		$data['relation_list'] = $this->Common_model->commonQuery("select * from `wedding_relations` order by rel_id DESC ");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/relatives/edit";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function relations($rel_id = null)
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
				
			$user_id = $this->session->userdata('user_id');
			
			if(isset($rel_id) && !empty($rel_id))
			{
				$decId = $this->DecryptClientId($rel_id);
				
				
				$datai = array( 
							'title' => trim($title),
							'status' => $status,
							);
				
				$this->Common_model->commonUpdate('wedding_relations',$datai,'rel_id',$decId);
				$_SESSION['msg'] = '
						<div class="alert alert-success alert-dismissable" >
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							'.mlx_get_lang("Relation Updated Successfully").'
						</div>
						';
			}
			else
			{
				
				$datai = array( 
							'title' => trim($title),
							'created_on' => time(),
							'status' => $status,
							'created_by' => $user_id,
							);
				$this->Common_model->commonInsert('wedding_relations',$datai);
				
				
				$_SESSION['msg'] = '
						<div class="alert alert-success alert-dismissable"  >
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							'.mlx_get_lang("Relation Added Successfully").'
						</div>
						';
			}
			
			redirect('/relatives/relations','location');	
				
		}
		
		$data['query'] = $this->Common_model->commonQuery("
						SELECT * FROM `wedding_relations` as rel 
						order by rel.rel_id DESC");		
		
		if($rel_id != null)
		{
			$decId = $this->DecryptClientId($rel_id);
			$pt_result = $this->Common_model->commonQuery("select * from wedding_relations where rel_id = $decId ");
			if($pt_result->num_rows() > 0)
			{
				$pt_row = $pt_result->row();
				$data['rel_id'] = $pt_row->rel_id;
				$data['title'] = $pt_row->title;
				$data['status'] = $pt_row->status;
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/relatives/relations";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function delete($rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='wedding_relatives';
		$pid='r_id';
		$url='/relatives/manage/';	 	
		$fld='Relatives';
		
		$result = $this->Common_model->commonQuery("select image from wedding_relatives where r_id = $rowid and image != ''");
		if($result->num_rows() > 0)
		{
			$img_row = $result->row();
			$photo_name = $img_row->image;
			if(isset($photo_name) && !empty($photo_name) && file_exists('../uploads/relatives/'.$photo_name))
				unlink('../uploads/relatives/'.$photo_name);
		}
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
	
	public function delete_relation($rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');
		
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='wedding_relations';
		$pid='rel_id';
		$url='/relatives/relations';	 	
		$fld='Relation';
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		
		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								'.$rows.' '.$fld.' Deleted Successfully.
							</div>
							';
		redirect($url,'location','301');	
	}
}
