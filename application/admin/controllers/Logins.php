<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logins extends MY_Controller {
	
	public function index()
	{
		$this->login();
	}
	
	
	public function login()
	{
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		$CI->load->library('Global_lib');
		$site_url = site_url();	
		if(isset($_POST['submit']))
		{
			
			$username=$_POST['username'];
			$userpass=$_POST['userpass'];
			$this->load->model('Common_model');
			$sql="select * from users where user_name='".$username."' and user_pass = '".md5($userpass)."'"; 
			$detail = $this->Common_model->commonQuery($sql);
			
			if($detail->num_rows()>0)
			{
				$datai=$detail->row();
				
				if($datai->user_status == 'Y')
				{
					$newdata = array(  
						'first_name' => $this->global_lib->get_user_meta($datai->user_id,'first_name'),
						'last_name' => $this->global_lib->get_user_meta($datai->user_id,'last_name'),
						'username'  => $username, 
						'user_name'     => $datai->user_name,
						'user_email'     => $datai->user_email, 
						'user_id'     => $datai->user_id, 
						'user_type'     => $datai->user_type, 
						'user_status'     => $datai->user_status, 
						'logged_in' => TRUE,
						'site_url' => $site_url
						);
						
						
						
					foreach($newdata as $k=>$v)
					{
						$_SESSION[$k] = $v;
						
					}
					$this->session->set_userdata($newdata);
					if(isset($_POST['redirect_to']) && !empty($_POST['redirect_to']))
						redirect($_POST['redirect_to'],'location');
					else
						redirect('/main/','location');
				}
				else
				{
					 $_SESSION['msg'] = '<p class="error_msg">Your account is not active, Contact Site Administrative.</p>';
					 $data['theme'] = $theme;
					 $this->load->view($theme . '/login',$data);
				}
			}
			else
			{	
				 $_SESSION['msg'] = '<p class="error_msg">Username/Password Mismatch.</p>';
				 $data['theme'] = $theme;
				 $this->load->view($theme . '/login',$data);
			}

		}
		else
		{
			
			$data['theme'] = $theme;
			$this->load->view($theme . '/login', $data);
			 
		}
	}
	
	public function logout()
	{
		
		$newdata = array(  'first_name', 'last_name', 'username',	'user_name', 'user_email', 
						'user_id', 'user_type', 'user_status', 'site_url' 				);
						
		foreach($newdata as $k=>$v)
		{
			unset($_SESSION[$v]);
		}
		$this->session->unset_userdata($newdata);
		$this->session->set_userdata('logged_in', false);
		$_SESSION['logged_in'] = false;		
		$_SESSION['msg'] = '<p class="success_msg">Logged Out Successfully.</p>';
		redirect('/logins','location');	
		
	}
}