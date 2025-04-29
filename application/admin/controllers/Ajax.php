<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

	public function submit_dashboard_form_wizard_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');

		$wedding_id = $_SESSION['wedding_id'];
		$query = "select * from wedding_details where id = $wedding_id";
		$res = $this->Common_model->commonquery($query);

		if(!isset($groom_links)) $groom_links = array();
		if(!isset($bride_links)) $bride_links = array();

		$wedding_user_id	= $this->session->userdata('user_id');

		$site_name = trim($site_name);
		$site_name = strtolower($site_name);
		//Make alphanumeric (removes all other characters)
		$site_name = preg_replace("/[^a-z0-9_\s-]/", "", $site_name);
		//Clean up multiple dashes or whitespaces
		$site_name = preg_replace("/[\s-]+/", " ", $site_name);
		//Convert whitespaces and underscore to dash
		$site_name = preg_replace("/[\s_]/", "-", $site_name);

		$site_status = "under-construction";

		if(!empty($site_name) &&
			!empty($groom_name) &&
			!empty($bride_name) &&
			!empty($groom_photo) && !empty($bride_photo) 	)
			$site_status = "all-set-go";

		if($res->num_rows() == 0){
			$datai = array(
					'site_name' => trim($site_name),
					'groom_name' => trim($groom_name),
					'wedding_time' => trim($wedding_time),
					'wedding_venue' => trim($wedding_venue),
					'groom_photo' => trim($groom_photo),
					'groom_photo_bg' => trim($groom_photo_bg),
					'groom_tag_line' => trim($groom_tag_line),
					'groom_short_description' => trim($groom_short_description),
					'groom_social_links' => json_encode($groom_links),
					'bride_name' => trim($bride_name),
					'bride_photo' => trim($bride_photo),
					'bride_photo_bg' => trim($bride_photo_bg),
					'bride_tag_line' => trim($bride_tag_line),
					'bride_short_description' => trim($bride_short_description),
					'bride_social_links' => json_encode($bride_links),
					'wedding_date' => strtotime($wed_date),
					'wedding_title' => trim($wed_title),
					'created_at' => time(),
					'updated_at' => time(),
					'wedding_user_id' => $wedding_user_id,
					'site_status' => $site_status,

					'groom_signature' => trim($groom_signature),
					'bride_signature' => trim($bride_signature),
					'wedding_side' => trim($wedding_side),
					'wedding_status' => trim($wedding_status),

					'payment_by' => 0,
					'payment_remark' => ''

				);

				$this->Common_model->commonInsert('wedding_details',$datai);
		}
		else
		{

			$row= $res->row();
			$id = $row->id;
			$datai = array( 
				'site_name' => trim($site_name),
				'groom_name' => trim($groom_name),
					'wedding_time' => trim($wedding_time),
					'wedding_venue' => trim($wedding_venue),
				'groom_photo' => trim($groom_photo),
				'groom_photo_bg' => trim($groom_photo_bg),
				'groom_tag_line' => trim($groom_tag_line),
				'groom_short_description' => trim($groom_short_description),
				'groom_social_links' => json_encode($groom_links),
				'bride_name' => trim($bride_name),
				'bride_photo' => trim($bride_photo),
				'bride_photo_bg' => trim($bride_photo_bg),
				'bride_tag_line' => trim($bride_tag_line),
				'bride_short_description' => trim($bride_short_description),
				'bride_social_links' => json_encode($bride_links),
				'wedding_date' => strtotime($wed_date),
				'wedding_title' => trim($wed_title),
				'updated_at' => time(),	
				'site_status' => $site_status,
				'groom_signature' => trim($groom_signature),
				'bride_signature' => trim($bride_signature),
				'wedding_side' => trim($wedding_side),
				'wedding_status' => trim($wedding_status),

			);

			$this->Common_model->commonUpdate('wedding_details',$datai,'id',$id);

		}
		// tesx($datai);
		$step = 0;
		$wedding_data = $this->Common_model->commonQuery("select * from wedding_details");
		if($wedding_data->num_rows() > 0)
		{
			$hsr = $wedding_data->row();

			if(empty($hsr->site_name) || empty($hsr->wedding_time) || empty($hsr->wedding_venue) || empty($hsr->wedding_date) || empty($hsr->wedding_status) || empty($hsr->wedding_title) || empty($hsr->wedding_side)){
				$step=0;
			}
			else if(empty($hsr->groom_name) || empty($hsr->groom_photo) || empty($hsr->groom_short_description) || empty($hsr->groom_social_links) || empty($hsr->groom_signature)){
				$step=1;
			}
			else if(empty($hsr->bride_name) || empty($hsr->bride_photo) || empty($hsr->bride_short_description) || empty($hsr->bride_social_links)
			|| empty($hsr->bride_signature)
			){
				$step=4;
			}
			else
			{
				$data['step'] = $step=4;
			}
		}
		echo $step;
	}

	public function update_keywords_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');

		$datai = array(
				$lang_slug => addslashes($value)
		);
		$encId = $this->DecryptClientId($lang_id);
		$this->Common_model->commonUpdate('languages',$datai,'lang_id',$encId);

		echo 'success';
	}

	public function import_lang_keyword_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');

		if($lang_for == 'front')
		{
			$file_content = $this->global_lib->get_include_contents(FCPATH.'../application/language/import-language-files/'.$lang_file);
		}
		else
		{
			$file_content = $this->global_lib->get_include_contents(FCPATH.'../application/admin/language/import-language-files/'.$lang_file);
		}

		$myarray = $this->global_lib->strtoarray(trim($file_content));

		$sql = "select * from languages where lang_for = '$lang_for'";
		$result = $this->Common_model->commonQuery($sql);
		if($result->num_rows() > 0 && !empty($myarray))
		{
			foreach($result->result() as $row)
			{
				if(array_key_exists(trim($row->keyword),$myarray))
				{

					if($overright_keyword == 'Y' || empty($row->$lang))
					{
						$datai = array(
								$lang => $myarray[$row->keyword]
						);
						$this->Common_model->commonUpdate('languages',$datai,'lang_id',$row->lang_id);
					}
					unset($myarray[$row->keyword]);
				}
			}
		}

		if(!empty($myarray))
		{
			foreach($myarray as $k=>$v)
			{
				$datai = array( 'keyword' => $k, 'lang_for' => $lang_for, $lang => $v);
				$this->Common_model->commonInsert('languages',$datai);
			}
		}

		$site_language = $this->global_lib->get_option('site_language');
		$site_language_array = json_decode($site_language,true);
		foreach($site_language_array as $k=>$v)
		{
			$lang_exp = explode('~',$v['language']);
			$lang_name = $lang_exp[0];
			$lang_code = $lang_exp[1];
			$lang_slug = $this->global_lib->get_slug($lang_name,'_');

			if(!is_dir("../application/language"))
			{
				mkdir("../application/language",0777);
			}

			if(!is_dir("../application/language/$lang_slug"))
			{
				mkdir("../application/language/$lang_slug",0777);
			}
			if(file_exists("../application/language/$lang_slug/".$lang_slug."_lang.php"))
			{
				if($lang_slug!='english')
				unlink("../application/language/$lang_slug/".$lang_slug."_lang.php");
			}

			$fp = fopen("../application/language/$lang_slug/".$lang_slug."_lang.php","wb");
			if($fp)
			{
				$output = "<?php \n\n";
				$keyword_result = $this->Common_model->commonQuery("select keyword,$lang_slug from languages where lang_for = 'front'
									order by lang_id DESC");
				if($keyword_result->num_rows() > 0)
				{
						foreach($keyword_result->result() as $row)
						{
							$output .= '$lang'."['".$row->keyword."'] = '".addslashes($row->$lang_slug)."';\n";
						}
				}
				fwrite($fp,$output);
				fclose($fp);
			}
			if(!is_dir("../application/admin/language"))
			{
				mkdir("../application/admin/language",0777);
			}

			if(!is_dir("../application/admin/language/$lang_slug"))
			{
				mkdir("../application/admin/language/$lang_slug",0777);
			}
			if(file_exists("../application/admin/language/$lang_slug/".$lang_slug."_lang.php"))
			{
				if($lang_slug!='english')
				unlink("../application/admin/language/$lang_slug/".$lang_slug."_lang.php");
			}

			$fp = fopen("../application/admin/language/$lang_slug/".$lang_slug."_lang.php","wb");
			if($fp)
			{
				$output = "<?php \n\n";
				$keyword_result = $this->Common_model->commonQuery("select keyword,$lang_slug from languages where lang_for = 'back'
									order by lang_id DESC");
				if($keyword_result->num_rows() > 0)
				{
						foreach($keyword_result->result() as $row)
						{
							$output .= '$lang'."['".$row->keyword."'] = '".addslashes($row->$lang_slug)."';\n";
						}
				}
				fwrite($fp,$output);
				fclose($fp);
			}

		}

		echo 'success';
	}



	public function export_lang_keyword_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');

		$output = "";
		$sql = "select * from languages where lang_for = '$lang_for'";
		$result = $this->Common_model->commonQuery($sql);
		if($result->num_rows() > 0)
		{
			foreach($result->result() as $row)
			{
				$output .= '$lang'."['".$row->keyword."'] = '".addslashes($row->$lang)."';\n";
			}
		}
		$time_stamp = time();
		$file_name = '';
		$file_path = '';

		if($lang_for == 'front' && $export_type == 'save')
		{
			if(!is_dir("../application/language/import-language-files"))
			{
				mkdir("../application/language/import-language-files",0777);
			}

			$fp = fopen("../application/language/import-language-files/".$lang."-$time_stamp.lang","wb");
			$file_name = $lang."-$time_stamp.lang";
			$file_path = base_url("../application/language/import-language-files/");
			if($fp)
			{
				fwrite($fp,$output);
				fclose($fp);
			}
		}
		else if($lang_for == 'back' && $export_type == 'save')
		{
			if(!is_dir("../application/admin/language/import-language-files"))
			{
				mkdir("../application/admin/language/import-language-files",0777);
			}

			$fp = fopen("../application/admin/language/import-language-files/".$lang."-$time_stamp.lang","wb");
			$file_name = $lang."-$time_stamp.lang";
			$file_path = base_url("../application/admin/language/import-language-files/");
			if($fp)
			{
				fwrite($fp,$output);
				fclose($fp);
			}
		}
		else if($export_type == 'download')
		{
			$file_name = $lang."-$time_stamp.lang";

			header('Content-type: application/json');
			echo json_encode(array('file_name'=> $file_name,'file_content' => $output));
		}
		else
		{
			echo 'success';
		}
	}



	public function hide_notifications_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');

		if(isset($notif_id) && !empty($notif_id))
		{
			$datai = array(
					'notif_status' => 'H'
			);
			$encId = $this->DecryptClientId($notif_id);
			$this->Common_model->commonUpdate('notifications',$datai,'notif_id',$encId);
		}
		echo 'success';
	}



	public function remove_notifications_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');

		$encId = $this->DecryptClientId($notif_id);
		$this->Common_model->commonDelete('notifications',$encId,'notif_id' );
		echo 'success';
	}



	public function toggle_featured_property_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');

		if(isset($p_id) && !empty($p_id))
		{
			$datai = array(
					'is_feat' => $is_feat
			);
			$encId = $this->DecryptClientId($p_id);
			$this->Common_model->commonUpdate('properties',$datai,'p_id',$encId);
		}

		echo 'success';
	}



	public function check_username_existence()	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->library('Global_lib');
		$this->load->model('Common_model');
		$this->load->helper('text');
		$sql = "select * from users
				where user_name = '$user_name' ";
		$result = $this->Common_model->commonQuery($sql);
		if($result->num_rows() > 0 )
		{
			echo 'error';
		}
		else
		{
			echo 'success';
		}
	}



	public function EncryptClientId($id)
	{
		return substr(md5($id), 0, 8).dechex($id);
	}


	public function DecryptClientId($id)
	{
		$md5_8 = substr($id, 0, 8);
		$real_id = hexdec(substr($id, 8));
		return ($md5_8==substr(md5($real_id), 0, 8)) ? $real_id : 0;
	}



	public function upload_images_callback_func()
	{

		extract($_POST);
		$CI =& get_instance();
		$CI->load->library('global_lib');
		$CI->load->library('simpleimage');
		$target = $user_type.'/';

		if(!is_dir('../uploads/'.$target)){
			mkdir('../uploads/'.$target,0777,true);
		}
		if(isset($_FILES) && !empty($_FILES))
		{
			$name = $_FILES["img"]["name"];
			$path_parts = pathinfo($_FILES["img"]["name"]);
			$extension = $path_parts['extension'];
			$actual_name= $path_parts['filename'];
			$exp_data = explode(' ',$actual_name);
			$actual_name = implode('_',$exp_data);
			$name_wihout_ext = $actual_name.'-'.time();
			$name = $actual_name.'-'.time().".".$extension;

			$CI->simpleimage->load($_FILES['img']['tmp_name']);
			$CI->simpleimage->save('../uploads/'.$target.$name);

			$thumbnail_image_name = $actual_name.'-'.time().'-300X300.'.$extension;

			$CI->simpleimage->load($_FILES['img']['tmp_name']);
			$CI->simpleimage->crop(300,300);
			$CI->simpleimage->save('../uploads/'.$target.$thumbnail_image_name);

			header('Content-type: application/json');
			echo json_encode(array('img_url'=> base_url().'../uploads/'.$target.$name,'img_name' => $name));

		}
	}


	public function delete_images_callback_func()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');
		$this->load->library('global_lib');
		$target = $user_type.'/';
		if(file_exists('../uploads/'.$target.$img_name))
			unlink('../uploads/'.$target.$img_name);

		if(isset($user_type) && isset($user_id) && !empty($user_id) && isset($field_name) && !empty($field_name))
		{
			$encId = $this->DecryptClientId($user_id);
			$this->Common_model->commonQuery("
				update user_meta set meta_value = ''
				where meta_key  = '$field_name' and user_id = $encId
				");
		}

		echo 'success';
	}



	public function getFriendsEmail(){
		extract($_POST);
		$CI =& get_instance();
		$this->load->library('Global_lib');
		$this->load->model('Common_model');
		$this->load->helper('text');


			$sql = "select * from wedding_friendslist ";
			$result = $this->Common_model->commonQuery($sql);
			$email =array();
			foreach($result->result() as $row){
				$email[]= $row->email;
			}
			if(!empty($email)){
				$response = implode(",",$email);
				echo json_encode($response);
			}else{
				$email = 'Invailid Request';
				echo json_encode($email);
			}

	}



	public function sendMail(){
		extract($_POST);
		$CI =& get_instance();
		$this->load->library('Global_lib');
		$this->load->model('Common_model');
		$this->load->helper('text');
		$this->load->library('email');

			$rec = implode(',',$recipient);
			$sql = "select * from options where option_key='email_setting' ";

			$result = $this->Common_model->commonQuery($sql);
			$setting = [];
			foreach($result->result() as $options){
				$option = json_decode($options->option_value);
			}
			foreach($option as $key=>$value){
				$setting[$key]=$value;
			}

			$config = $setting;

			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->clear();
			$htmlContent = $msg;

			$this->email->to($rec);
			$this->email->from('support@minmindlogixtech.com','Wedding Cms');
			$this->email->subject('This is the Testing Mail From Wedding CMS');
			$this->email->message($htmlContent);

			$response = $this->email->send();

			if($response == true){
				echo json_encode('Emails Sent Succssfully');
			}else{
				echo json_encode('Email Sendding failed');
			}
	}



	public function manage_users_gifts()
	{
		extract($_POST);
		$CI =& get_instance();
		$this->load->model('Common_model');
		$this->load->library('Global_lib');
		$encId = $this->DecryptClientId($id);
		$user_id = $this->session->userdata('user_id');
		$user_gifts = $this->global_lib->get_user_meta($user_id,'my_gifts');
		$my_gifts = array();
		$gift = array('gift_id'=>$encId);

		if($user_gifts){
			$my_gifts = json_decode($user_gifts,true);

		}

		/*if(!array_key_exists($encId, $my_gifts))
			$my_gifts []= $gift;*/

		if(isset($action))
		{
			if($action == 'add')
				$my_gifts [$encId]= $gift;
			else if($action == 'remove')
				unset($my_gifts[$encId]);
		}

		$my_gifts = json_encode($my_gifts);
		$this->global_lib->update_user_meta($user_id,'my_gifts',$my_gifts);
	}



}
