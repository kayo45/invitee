<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {	
	
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
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		
		$data['query'] = $query = $this->Common_model->commonQuery("
				select u.*,wd.site_name,wd.id as wedding_id,wd.site_status,wd.payment_status from users as u
				left join wedding_details as wd on wd.wedding_user_id = u.user_id
				where u.user_type != 'admin'
				order by u.user_id  DESC
				");	
		
		$data['theme']=$theme;
		
		
		
		$data['content'] = "$theme/user/manage";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function add_new()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		$data['social_medias'] = $CI->config->item('social_medias') ;
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
			
				
			$this->form_validation->set_rules('user_meta[first_name]', 'First Name', 'trim|required');
			$this->form_validation->set_rules('user_meta[last_name]', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('UserType', 'User Type', 'trim|required');
			$this->form_validation->set_rules('UserName', 'User Name', 'trim|required');
			$this->form_validation->set_rules('Password', 'Password', 'trim|required');
			$this->form_validation->set_rules('RepeatPassword', 'Repeat Password', 'trim|required|matches[Password]');
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				 
				 
				if(empty($user_id) || $user_id == 0)
				{	
					$_SESSION['msg'] = '<p class="error_msg">'.mlx_get_lang("Session Expired").'</p>';
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
				$datai = array( 
								'user_name' => trim($UserName),	
								'user_pass' => md5(trim($Password)),
								'user_email' => trim($UserEmail),
								'user_type' => trim($UserType),	
								'user_registered_date' => $cur_time,	
								'user_update_date' => $cur_time,
								'user_link_id' => '',
								'user_code' => '',
								'user_verified' => 'Y',
								'user_status' => $status,
								); 
				$user_id=$this->Common_model->commonInsert('users',$datai);
				
				foreach($user_meta as $key=>$val)
				{
					if(is_array($val))
						$val = json_encode($val);
					$datai = array( 
								'meta_key' => trim($key),	
								'meta_value' => trim($val),
								'user_id' => $user_id
								);
					$this->Common_model->commonInsert('user_meta',$datai);
				}
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("User Added Successfully").'
							</div>
							';
				redirect('/user/manage','location');	
			
			
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/user/add_new";
		
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
		
		$data['social_medias'] = $CI->config->item('social_medias') ;
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
			
				
			$this->form_validation->set_rules('user_meta[first_name]', 'First Name', 'trim|required');
			$this->form_validation->set_rules('user_meta[last_name]', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
			
			$c_id = $user_id;
			
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				
				if(isset($_POST['submit']))
					$page_status = 'publish';
				else if(isset($_POST['draft']))
					$page_status = 'draft';
				else
					$page_status = 'draft';
				 
				$cId = $this->global_lib->DecryptClientId($user_id);
				
				$cur_time = time();
				
				$sql = "select user_verified,user_email
				   from users  
				   where user_id = '$cId' and user_verified = 'N'";
				$user_result = $this->Common_model->commonQuery($sql );
				
				if($user_result->num_rows() >0)
				{
					$user_row = $user_result->row();
					if($status == 'Y')
					{
						$user_verified = 'Y';
						$to = $user_row->user_email; 
				
						$site_domain_name = $this->global_lib->get_option('site_domain');
						$site_domain_email = $this->global_lib->get_option('site_domain_email');
						
						$first_name = $this->global_lib->get_user_meta($cId,'first_name');
						$last_name = $this->global_lib->get_user_meta($cId,'last_name');
						
						$subject = mlx_get_lang("Account Activated Successfully");
						$htmlContent = ' 
							<html> 
							<head> 
								<title>'.mlx_get_lang("Account Activated Successfully").'</title> 
							</head> 
							<body> 
								<p>'.mlx_get_lang("Hello").' <strong>'.$first_name.' '.$last_name.'</strong></p>
								<p>'.mlx_get_lang("Your account activated successfully. please login with your login credentials.").'</p>
							</body> 
							</html>'; 
						
						$headers = "MIME-Version: 1.0" . "\r\n"; 
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
						$headers .= 'From: '.$site_domain_name.'<'.$site_domain_email.'>' . "\r\n";
						$headers .= "X-Mailer: PHP ". phpversion();
						
						mail($to, $subject, $htmlContent, $headers);
					}
				}
				
				if(isset($Password) && !empty($Password))
				{
					
					$datai = array( 
								'user_pass' => md5(trim($Password)),
								'user_email' => trim($UserEmail),
								'user_update_date' => $cur_time,
								'user_status' => $status,
								'user_type' => $user_type,
								);
					
				}
				else
				{
					$datai = array( 
								'user_email' => trim($UserEmail),
								'user_update_date' => $cur_time,
								'user_status' => $status,
								'user_type' => $user_type,
								);
				}
				
				if(isset($user_verified))
				{
					$datai['user_verified'] = $user_verified;
				}
				
				$post_id = $this->Common_model->commonUpdate('users',$datai,'user_id',$cId);
				
				
				
				foreach($user_meta as $key=>$val)
				{
					if(is_array($val))
						$val = json_encode($val);
										
					$sql = "select * from user_meta where meta_key='$key' and user_id=$cId";
					$result = $this->Common_model->commonQuery($sql);
					
					if($result->num_rows()>0){
						
						$meta_id = $result->row()->meta_id; 
						$datai = array( 
								'meta_value' => trim($val),
								);
							$this->Common_model->commonUpdate('user_meta',$datai,'meta_id',$meta_id);
					
					}else{
						$datai = array( 
								'meta_key' => trim($key),	
								'meta_value' => trim($val),
								'user_id' => $cId
								);
						$this->Common_model->commonInsert('user_meta',$datai);
					}
								
					
				}
				
				
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("User Updated Successfully").'
						  </div>
							';
				redirect('/user/manage','location');	
			
			
			}
		}
		
		$data['user_id'] = $c_id;
		$decId = $this->global_lib->DecryptClientId($c_id);
		$data['query'] = $this->Common_model->commonQuery("
				select * from users where user_id = $decId");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/user/edit";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function create_site($wedding_user_id)
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		$data['wedding_user_id'] = $wedding_user_id;
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
			
			$this->form_validation->set_rules('payment_title', 'Payment Title', 'trim|required');
			$this->form_validation->set_rules('payment_status', 'Payment Status', 'trim|required');
			$this->form_validation->set_rules('payment_amount', 'Payment Amount', 'trim|required');
			$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
			
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				 
				 
				if(empty($user_id) || $user_id == 0)
				{	
					$_SESSION['msg'] = '<p class="error_msg">'.mlx_get_lang("Session Expired").'</p>';
					$_SESSION['logged_in'] = false;	
					$this->session->set_userdata('logged_in', false);
					redirect('/logins','location');
				}
				
			
				
				$cur_time = time();
				$datai = array( 
								'wedding_user_id' => $this->global_lib->DecryptClientId($wedding_user_id),	
								'payment_status' => 'complete',
								'payment_by' => $user_id,
								'payment_remark' => trim($payment_remark),	
								'template'  => '',
								'created_at' => $cur_time,	
								'updated_at' => $cur_time,
								); 
				$wedding_id = $this->Common_model->commonInsert('wedding_details',$datai);
				
				
				$datai = array( 
							'product_id' => $wedding_id,	
							'product_detail' => 'wedding',
							'user_id' => $user_id,
							'payment_mode' => $payment_mode,
							'transaction_amount' => $payment_amount,
							'transaction_date' => $cur_time,
							'status' => $payment_status
							);
				$this->Common_model->commonInsert('transaction',$datai);
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Site Created Successfully").'
							</div>
							';
				redirect('/user/manage','location');	
			
			
			}
		}
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/user/create_site";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function delete($rowid)
	{
		
		
		
		$CI =& get_instance();
		$this->load->library('Global_lib');
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='users';
		$pid='user_id';
		$url='/user/manage/';	 	
		$fld=mlx_get_lang("User");
		
		if($this->global_lib->get_user_meta($rowid,'photo_url'))
		{
			$photo_name = $this->global_lib->get_user_meta($rowid,'photo_url');
			if(isset($photo_name) && !empty($photo_name) && file_exists('uploads/user/'.$photo_name))
				unlink('uploads/user/'.$photo_name);
		}
		
		$this->Common_model->commonDelete('user_meta',$rowid,$pid );
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid );			
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.$rows.' '.$fld.' '.mlx_get_lang("Deleted Successfully").'
							</div>
							';
		redirect($url,'location','301');	
	}
	
	
	
}
