<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Controller {	
	
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
		
		$data['query'] = $this->Common_model->commonQuery("select wedding_slider.*,users.user_name from `wedding_slider` 
		inner join users on wedding_slider.wedding_user_id = users.user_id
		where wedding_slider.wedding_id = $wedding_id order by wedding_slider.place asc,
		wedding_slider.img_order asc");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/slider/manage";
		
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
			$this->form_validation->set_rules('place', 'Placement', 'trim|required');

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

				$wedding_user_id= '';

				if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_id') > 0){
					$wedding_user_id = $this->session->userdata('user_id');
				}
				$wedding_id= '';
				if(!empty($this->session->userdata('wedding_id')) && $this->session->userdata('wedding_id') > 0){
					$wedding_id = $this->session->userdata('wedding_id');
				}
				$datai = array(
								'slide_img' => trim($photo),
								'wedding_user_id' => trim($wedding_user_id),
								'wedding_id' => trim($wedding_id),
								'img_order'=>trim($img_order),
								'place'=>trim($place),
								'created_at'=>$cur_time,
								'updated_at'=>$cur_time,
								);

				// tesx($datai);

				$user_id=$this->Common_model->commonInsert('wedding_slider',$datai);

				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

								Slider added Successfully.
							</div>
							';
				redirect('/slider/manage','location');
			}
		}

		$data['theme']=$theme;

		$data['content'] = "$theme/slider/add_new";

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
			$this->form_validation->set_rules('place', 'Placement', 'trim|required');

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
								'place' => trim($place),
								'updated_at' => $cur_time,
								'id' => $cId
								);

				// tesx($datai);


				$this->Common_model->commonUpdate('wedding_slider',$datai,'id',$cId);
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								Slider Updated Successfully.
							</div>
							';
				redirect('/slider/manage','location');

			}
		}

		$data['id'] = $c_id;

		$decId = $this->global_lib->DecryptClientId($c_id);

		$data['query'] = $this->Common_model->commonQuery("
				select * from wedding_slider where id = $decId");

		$data['theme']=$theme;

		$data['content'] = "$theme/slider/edit";

		$this->load->view("$theme/header",$data);

	}



	public function delete($rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');

		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');

		$tbl='wedding_slider';
		$pid='id';
		$url='/slider/manage/';
		$fld='Slider';

		$result = $this->Common_model->commonQuery("select slide_img from wedding_slider where id = $rowid and slide_img != ''");
		if($result->num_rows() > 0)
		{
			$photo_name = $result->row()->slide_img;
			if(isset($photo_name) && !empty($photo_name) && file_exists('../uploads/slider/'.$photo_name))
				unlink('../uploads/slider/'.$photo_name);
		}

		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid);
		

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

		$result = $this->Common_model->commonQuery("select img_order from wedding_slider where id = $order_id");
		$newVal='';
		foreach($result->result() as $row){
			$temp = $row->img_order;
			$temp++;
			$newVal = $temp;
		}
			$datai = array(
						'img_order' => $newVal,
						'id' => $order_id);

			$this->Common_model->commonUpdate('wedding_slider',$datai,'id',$order_id);
			$_SESSION['msg'] = '
					<div class="alert alert-success alert-dismissable" >
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						slider Order Updated Successfully. New Value is: '.$newVal.'
				</div>
					';

		redirect('/slider/manage','location');
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
		
		$result = $this->Common_model->commonQuery("select img_order from wedding_slider where id = $order_id");
		$newVal='';
		foreach($result->result() as $row){
			$temp = $row->img_order;
			$temp--;
			$newVal = $temp;
		}
			$datai = array( 
						'img_order' => $newVal,
						'id' => $order_id);
						
			$this->Common_model->commonUpdate('wedding_slider',$datai,'id',$order_id);
			$_SESSION['msg'] = '
					<div class="alert alert-success alert-dismissable" >
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						Slider Order Updated Successfully. And New Value is: '.$newVal.'
				  </div>
					';	
		
			redirect('/slider/manage','location');	
	}


}
