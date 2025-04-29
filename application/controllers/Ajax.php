<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

	
	public function sendEnquiryForm()
	{
		$post = json_decode($_POST['data']);
	
		$your_name = $post->{'your_name'};
		$your_email = $post->{'your_email'};
		$contact_no = $post->{'contact_no'};
		$subject = $post->{'subject'};
		$message = $post->{'message'};
		
		
		$error_message = "";
 		
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	 
		if(!preg_match($email_exp,$your_email)) {
			 
			$error_message .= '<li class="alignleft error-msg">The Email Address you entered does not appear to be valid.</li>';
	 
		}
		
		$string_exp = "/^[A-Za-z .'-]+$/";
		
		if(!preg_match($string_exp,$your_name)) {
		
		$error_message .= '<li class="alignleft error-msg">Your Name entered does not appear to be valid.</li>';
		
		}
		
		if($error_message == "")
		{
			$from = "From: $your_email";

			mail("azizchouhan@gmail.com",$subject,$message,$from);
			
			$return ['output'] = "success";
		}else
		{
			$return ['output'] = $error_message;
		
		}	
		
		
		
		header('Content-type: application/json');
		echo json_encode(array('data_returned'=>$return));
		return;
	}
	
	public function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
	
	public function add_subscriber()	
	{		 
		extract($_POST);		
		$CI =& get_instance();		
		$this->load->model('Common_model');
		
		
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		$string_exp = "/^[A-Za-z .'-]+$/";
		if(!preg_match($email_exp,$email)) {
			$msg = '<div class="alert alert-danger alert-dismissable" style="text-align:center;">
					The Email Address you entered does not appear to be valid.
					</div>';
	 
		}
		else if(!preg_match($string_exp,$name)) {
		
			$msg = '<div class="alert alert-danger alert-dismissable" style="text-align:center;">
					Your Name entered does not appear to be valid.
					</div>';
		
		}
		else
		{
			$datai = array( 
							'c_name' => trim($name),	
							'c_email' => trim($email),
							'c_date' => time(),
							'c_type' => 'subscribe'
							);
						
			$post_id=$this->Common_model->commonInsert('form_details',$datai);
			
			$msg = '<div class="alert alert-success alert-dismissable" style="text-align:center;">
					Subscribed Successfully.
					</div>';
			
		}	
				
			
		header('Content-type: application/json');				
		echo json_encode(array('msg' => $msg));
			
	}
	
	
	 public function fetch_delivery_city()
	{
		extract($_POST);		
		$CI =& get_instance();		
		$CI->load->model('Common_model');
		 $qry = "select * from delivery_charges inner join loc_cities on loc_cities.city_id = delivery_charges.delivery_city_id where delivery_charges.delivery_type_id = '".$del_type."' ";
		$result = $CI->Common_model->commonQuery($qry );
		$charges = "<option value=''>Select Delivery City</option>";
		if(isset($result) && $result->num_rows()>0) 
		{ 
			foreach($result->result() as $row1)
			{
			  $charges .="<option value='".$row1->delivery_charge_id."'>".$row1->city_name. "-".$row1->delivery_price."</option>";
				
			}
		}
		header('Content-type: application/json');				
		echo json_encode(array('charges' => $charges));
	
	 exit; 
	}
	
	public function subsscribe(){
		$CI =& get_instance();		
		$CI->load->model('Common_model');
		$res = $CI->Common_model->commonQuery('SELECT *FROM `push_message');
		echo  json_encode($res->row());
		
	}
	
	public function invitationPost(){
		$msg='';		
		$CI =& get_instance();		
		$CI->load->model('Common_model');
		$this->load->library('Global_lib');
			
			if(isset($_POST)){
				extract($_POST);
					$cur_time = time();
					$sub = '';
					$functions = '';
					if(isset($are_you) && $are_you == 'yes'){
						if(isset($events)){
							$event = implode(",",$this->input->post('events'));
						}
						
						$datai = array( 
									'guest_names' => trim($name),
									'email' => trim($email),
									'number_of_guest' => trim($guest),
									'event_title' => $event,
									'messages' => trim($notes),
									'created_at'=>$cur_time,
									'updated_at'=>$cur_time,
									);
								$sub = "Mr. $name is Attending.";
								$functions = $event;
					}else{
						$datai = array( 
									'guest_names' => trim($name),
									'email' => trim($email),
									'number_of_guest' => trim($guest),
									'event_title' => 'No I am not Attending',
									'messages' => trim($notes),
									'created_at'=>$cur_time,
									'updated_at'=>$cur_time,
									);
									$sub = "Mr. $name is Not Attending.";
					}
					
					$evt = array();
					foreach($events as $event_id){
						$evt[] = $this->global_lib->get_events($event_id);
					}
					$funtions = implode(', ',$evt);
					$to = $email;
					$subject = $sub;
					$guests='';
					if($guest == 1){
						$guests = $guest.' Guest';
					}else{
						$guests = $guest.' Guests';
					}
					$message = "
					<html>
					<head>
					<title>HTML email</title>
					</head>
					<body>
					<p>Mr. $name will attending Your $funtions with $guests  and $name sent you an Message <br/> $notes. </p>
					
					</body>
					</html>
					";

					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					$headers .= 'From: <webmaster@example.com>' . "\r\n";

					echo $message;
					
			}else{
				$msg =  'Invalid Entry';
			}
		echo  $msg;		
	}
	
	public function user_field_validation_callback_func()
	{
		extract($_POST);
		$this->load->model('Common_model');
		$options=array('where'=>array($field_type=>$field_value));
		$user_exsist=$this->Common_model->commonSelect('users',$options);
		
		if($user_exsist->num_rows() > 0 )
		{
			echo 'false';
		}	
		else
		{	
			echo 'true';
		}
		return;
	}
	
	public function register_user_form_callback_func()
	{
		extract($_POST);
		
		$this->load->model('Common_model');
		$this->load->library('Global_lib');
		$cur_time = time();
		
		$enbale_reg_auto_login = $this->global_lib->get_option('enbale_reg_auto_login');
		$default_user_status_after_reg = $this->global_lib->get_option('default_user_status_after_reg');
		$datai = array( 
						'user_name' => trim($username),	
						'user_pass' => md5(trim($password)),
						'user_email' => trim($email),
						'user_type' => 'wedding_user',	
						'user_registered_date' => $cur_time,	
						'user_update_date' => $cur_time,
						'user_link_id' => '',
						'user_code' => '',
						'user_verified' => 'N',
						'user_status' => 'N',
						); 
		
		if($enbale_reg_auto_login == 'Y')
		{
			$datai['user_verified'] = 'Y';
			$datai['user_status'] = 'Y';
		}
		else if($default_user_status_after_reg == 'Y')
		{
			$datai['user_verified'] = 'Y';
			$datai['user_status'] = 'Y';
		}
		
		$user_id = $this->Common_model->commonInsert('users',$datai);
		
		$user_meta = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					);
		if(isset($photo_url) && !empty($photo_url))
		{
			$user_meta['photo_url'] = $photo_url;
		}
		if(isset($att_photo_hidden) && !empty($att_photo_hidden))
		{
			$user_meta['photo_url'] = $att_photo_hidden;
		}
		foreach($user_meta as $key=>$val)
		{
			$datai = array( 
						'meta_key' => trim($key),	
						'meta_value' => trim($val),
						'user_id' => $user_id
						);
			$this->Common_model->commonInsert('user_meta',$datai);
		}
		
		$to = $email; 
				
		$site_domain_name = $this->global_lib->get_option('site_domain');
		$site_domain_email = $this->global_lib->get_option('site_domain_email');
		
		$subject = "Registered Successfully";
		$htmlContent = ' 
			<html> 
			<head> 
				<title>Registered Successfully</title> 
			</head> 
			<body> 
				<p>Hello <strong>'.$first_name.' '.$last_name.'</strong></p>
				<p>Thank you for register. your account will be activate after admin verification.</p>
			</body> 
			</html>'; 
		
		$headers = "MIME-Version: 1.0" . "\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		$headers .= 'From: '.$site_domain_name.'<'.$site_domain_email.'>' . "\r\n";
		$headers .= "X-Mailer: PHP ". phpversion();
		
		//mail($to, $subject, $htmlContent, $headers);
		
		$admin_emails = $this->global_lib->get_admin_user_emails();
		if(!empty($admin_emails))
		{
			
			foreach($admin_emails as $ak=>$av)
			{
				$to = $av; 
				$from = trim($email); 
				$fromName = $first_name.' '.$last_name;
				
				$site_domain_name = $this->global_lib->get_option('site_domain');
				$site_domain_email = $this->global_lib->get_option('site_domain_email');
				
				$subject = "A registration form submitted";
				$htmlContent = ' 
					<html> 
					<head> 
						<title>A registration form submitted</title> 
					</head> 
					<body> 
						<h1>A registered form submitted with following details :- </h1> 
						<table cellspacing="0" style="border: 1px solid #dddddd; width: 100%; text-align:left;"> 
							<tr> 
								<th>First Name : </th><td>'.trim($first_name).'</td> 
							</tr> 
							<tr > 
								<th>Last Name : </th><td>'.trim($last_name).'</td> 
							</tr> 
							<tr> 
								<th>Username : </th><td>'.trim($username).'</td> 
							</tr> 
							<tr> 
								<th>Email : </th><td>'.trim($email).'</td> 
							</tr> 
						</table> 
					</body> 
					</html>'; 
				
				$headers = "MIME-Version: 1.0" . "\r\n"; 
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: '.$site_domain_name.'<'.$site_domain_email.'>' . "\r\n";
				
				//mail($to, $subject, $htmlContent, $headers);
				
			}
		}
		
		
		$auto_redirect = 'N';
		
		
		$output = '<div class="alert alert-success alert-dismissable" >
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			Registered Successfully. You can login after admin verification.
		</div>';
		if($enbale_reg_auto_login == 'Y')
		{
			/*
			$newdata = array(  
							'first_name',
							'last_name',
							'username', 
							'user_name',
							'user_email', 
							'user_id', 
							'user_type', 
							'user_status', 
							'site_url'
							);
			foreach($newdata as $k=>$v)
			{
				unset($_SESSION[$v]);
			}
			$this->session->unset_userdata($newdata);
			$this->session->set_userdata('logged_in', false);
			$_SESSION['logged_in'] = false;	
			*/
			
			if (isset($_COOKIE["PHPSESSID"])) {
				session_destroy();
				session_unset();
				session_start();
			}
			
			$auto_redirect = 'Y';
			$sql="select * from users where user_id = '".$user_id."'"; 
			$detail = $this->Common_model->commonQuery($sql);
			$site_url = site_url();	
			$user_data=$detail->row();
			$newdata = array(  
				'first_name' => $first_name,
				'last_name' => $last_name,
				'username'  => $username, 
				'user_name'     => $username,
				'user_email'     => $email, 
				'user_id'     => $user_id, 
				'user_type'     => $user_data->user_type, 
				'user_status'     => $user_data->user_status, 
				'logged_in' => TRUE,
				'site_url' => $site_url
				);
			foreach($newdata as $k=>$v)
			{
				$_SESSION[$k] = $v;
			}
			$this->session->set_userdata($newdata);
			$output = '<div class="alert alert-success alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				Registered Successfully. Redirecting...
			</div>';
		}
		else if($default_user_status_after_reg == 'Y')
		{
			$datai['user_verified'] = 'Y';
			$datai['user_status'] = 'Y';
			$output = '<div class="alert alert-success alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				Registered Successfully. You can login with your login credentials.
			</div>';
		}
		
		header('Content-type: application/json');
		echo json_encode(array('status'=>'success','output' => $output,'auto_redirect' => $auto_redirect));
		return;
		
	}
	
	
	public function guestbooks() {
		$wedding_user_id 	= $_POST['wedding_user_id'];
		$nama 				= $_POST['nama'];
		$kehadiran			= $_POST['dropdown'];
		$submit				= 'oke';

		

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
			
				
			$this->form_validation->set_rules('wedding_user_id', 'wedding_user_id', 'trim|required');
			
			
			
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				
				
				
					
				$datai = array( 
					'wedding_user_id' => $wedding_user_id,
					'guest_names' => trim($nama),
					'email' => trim($nama),
					'number_of_guest' => '1',
					'event_title'	=> 'wedding',
					'messages' => trim($dropdown),
					'created_at'=> time(),
					'updated_at' => time(),
				);

				// tesx($_POST, $datai);
				$this->Common_model->commonInsert('wedding_invitations',$datai);


				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Send Successfully.
						  </div>
							';
				redirect($_SERVER["HTTP_REFERER"]);	
			
			
			}
		}
		
		
	}
	
}
