<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

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
		redirect('/main/','location');
	}
	
	public function general_settings()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			$this->form_validation->set_error_delimiters('<div class="box-body"><div class="alert alert-danger alert-dismissable" style="margin-top:10px; margin-bottom:0px;">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				', "</div></div>");
			
			$this->form_validation->set_rules('options[website_logo_text]', 'Website Logo Text', 'trim|required');
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				
				if($this->session->userdata('user_id') != 1)
				{	
					redirect('/','location');
				}
				
				
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
				
				
				if(isset($multi_lang) && !empty($multi_lang)){
					foreach($multi_lang as $k=>$v)
					{
						foreach($v as $vk=>$vv)
						{
							if($vv == '')
								continue;
							if($k == 'en')
							{
								${$vk.'_id'} = $this->global_lib->update_option($vk,$vv);
							}
							
							$options_lang_details = $this->Common_model->commonQuery("select * from options_lang_details
								where opt_id = ".${$vk.'_id'}." and language = '$k' ");
							if($options_lang_details->num_rows() == 0)
							{
								$datai = array( 			
											'lang_text' => addslashes(trim($vv)),									
											'opt_id' => ${$vk.'_id'},	
											'language' => $k,
											);
							
								$this->Common_model->commonInsert('options_lang_details',$datai);
							}
							else
							{
								$this->Common_model->commonQuery("update options_lang_details set 
									  lang_text = '".addslashes(trim($vv))."'
									where opt_id = ".${$vk.'_id'}." and language = '$k'");
							}
							
						}
						
					}
				}
				
				foreach($options as $key=>$value)
				{
					$query = $this->Common_model->commonQuery("select * from options where option_key = '$key' ");			
					if($query->num_rows() > 0)
					{
						$row = $query->row();
						$options_id = $row->option_id;
						if(is_array($value))
							$value = json_encode($value);
						$datai = array('option_value' => $value);
						$this->Common_model->commonUpdate('options',$datai,'option_id',$options_id);			
					}
					else
					{
						if(is_array($value))
							$value = json_encode($value);
						$datai = array( 'option_key' => $key,	'option_value' => $value);
						$this->Common_model->commonInsert('options',$datai);
					}
					
				}
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								General Settings Update Successfully.
							</div>
							';
				redirect('/settings/general_settings','location');	
			
			
			}
		
		}
		
		$data['options_list'] = $this->Common_model->commonQuery("select * from options");	
		
		$data['currency_symbols'] = $CI->config->item('currency_symbols') ;
		
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/general_settings";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function social_settings()
	{
		
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');

		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			
				extract($_POST,EXTR_OVERWRITE);
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				if($this->session->userdata('user_id') != 1)
				{	
					redirect('/','location');
				}
				
				$social_media = array();
				foreach($options as $key=>$value)
				{
					$social_media[$key] = $value;
				}
				
				
				$query = $this->Common_model->commonQuery("select * from options where option_key = 'social_media' ");			
				if($query->num_rows() > 0)
				{
					$row = $query->row();
					$options_id = $row->option_id;
					$datai = array('option_value' => json_encode($social_media));
					$this->Common_model->commonUpdate('options',$datai,'option_id',$options_id);			
				}
				else
				{
					$datai = array( 'option_key' => 'social_media',	'option_value' => json_encode($social_media));
					$this->Common_model->commonInsert('options',$datai);
				}
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Social Settings Update Successfully.
							</div>
							';
				redirect('/settings/social_settings','location');	
			
		}
		
		$data['options_list'] = $this->Common_model->commonQuery("select * from options where option_key = 'social_media'");	
		
		$data['social_medias'] = $CI->config->item('social_medias') ;
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/social_settings";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function change_password()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');

		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			$this->form_validation->set_error_delimiters('<div class="box-body"><div class="alert alert-danger alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				', "</div></div>");
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				
				$datai = array( 
								'user_pass' => md5($password),
								);
				
				
				$this->Common_model->commonUpdate('users',$datai,'user_id',$this->session->userdata('user_id'));
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Password Changed Successfully.
							</div>
							';
				redirect('/settings/change_password','location');	
			
			
			}
		
		}
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/change_password";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	
	public function site_languages()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		
		$data['languages'] = $CI->config->item('languages') ;
		$data['currency_symbols'] = $CI->config->item('currency_symbols') ;
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		if(isset($_POST['submit']))
		{
			
				
				extract($_POST,EXTR_OVERWRITE);
				
				
				$msg_text = '';
				
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}
				
				
				if(isset($options) && isset($options['site_language']) && !empty($options['site_language']))
				{
					$site_language = $this->global_lib->get_option('site_language');
					$site_language_array = json_decode($site_language,true);
					
					
					foreach($options['site_language'] as $k=>$v)
					{
						if(!isset($v['language'])) continue;
						$lang_exp = explode('~',$v['language']);
						$lang_name = $lang_exp[0];
						$lang_code = $lang_exp[1];
						$lang_slug = $this->global_lib->get_slug($lang_name,'_');
						
						foreach($site_language_array as $slak=>$slav)
						{
							if(!isset($slav['language'])) continue;
							if($slav['language'] == $v['language'])
								unset($site_language_array[$slak]);
						}
						
						$sql_result = $this->Common_model->commonQuery("SHOW COLUMNS FROM languages LIKE '$lang_slug'");
						if($sql_result->num_rows() == 0)
						{
							$this->Common_model->commonQuery("ALTER TABLE languages
							ADD COLUMN $lang_slug VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT ''");
						}
						
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
							if($lang_slug != 'english' && isset($remove_old_lang) && $remove_old_lang == 'Y')
							{
								unlink("../application/language/$lang_slug/".$lang_slug."_lang.php");
							}
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
							
						if($lang_slug != 'english')
						{
							$eng_lang_slug = 'english';
							
							$fp = fopen("../application/language/$eng_lang_slug/".$eng_lang_slug."_lang.php","wb");
							if($fp)
							{
								$output = "<?php \n\n";
								$keyword_result = $this->Common_model->commonQuery("select keyword,$eng_lang_slug from languages where lang_for = 'front'
													order by lang_id DESC");
							   if($keyword_result->num_rows() > 0) 
							   { 
									foreach($keyword_result->result() as $row)
									{
										$output .= '$lang'."['".$row->keyword."'] = '".addslashes($row->$eng_lang_slug)."';\n";
									}
							   }
								fwrite($fp,$output);
								fclose($fp);
							}
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
							if($lang_slug != 'english' && isset($remove_old_lang) && $remove_old_lang == 'Y')
							{
								unlink("../application/admin/language/$lang_slug/".$lang_slug."_lang.php");
							}
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
						
						if($lang_slug != 'english')
						{
							$eng_lang_slug = 'english';
							$fp = fopen("../application/admin/language/$eng_lang_slug/".$eng_lang_slug."_lang.php","wb");
							if($fp)
							{
								$output = "<?php \n\n";
								$keyword_result = $this->Common_model->commonQuery("select keyword,$eng_lang_slug from languages where lang_for = 'back'
													order by lang_id DESC");
							   if($keyword_result->num_rows() > 0) 
							   { 
									foreach($keyword_result->result() as $row)
									{
										$output .= '$lang'."['".$row->keyword."'] = '".addslashes($row->$eng_lang_slug)."';\n";
									}
							   }
								fwrite($fp,$output);
								fclose($fp);
							}
						}
					}
					
					if(isset($site_language_array) && !empty($site_language_array))
					{
						foreach($site_language_array as $k=>$v)
						{
							if(!isset($v['language'])) continue;
							$lang_exp = explode('~',$v['language']);
							$lang_name = $lang_exp[0];
							$lang_code = $lang_exp[1];
							$lang_slug = $this->global_lib->get_slug($lang_name,'_');
							if($lang_slug != 'english' && isset($remove_old_lang) && $remove_old_lang == 'Y')
							{
								$sql_result = $this->Common_model->commonQuery("SHOW COLUMNS FROM languages LIKE '$lang_slug'");
								if($sql_result->num_rows() > 0)
								{
									$this->Common_model->commonQuery("ALTER TABLE `languages` DROP `$lang_slug`"); 
								}
								$this->Common_model->commonDelete('options_lang_details',$lang_code,'language' );
								$this->Common_model->commonDelete('page_lang_details',$lang_code,'language' );
								
								
								if(is_dir("../application/language/$lang_slug") )
								{
									array_map('unlink', glob("../application/language/$lang_slug/*.*"));
									rmdir("../application/language/$lang_slug");
								}
								
								if(is_dir("../application/admin/language/$lang_slug"))
								{
									array_map('unlink', glob("../application/admin/language/$lang_slug/*.*"));
									rmdir("../application/admin/language/$lang_slug");
								}
							}
						}
					}
				}
				
				
				foreach($options as $k=>$v)
				{
					if($k == 'site_language')
						$val = json_encode($v);
					else
						$val = $v;
					$this->global_lib->update_option($k,$val);
				}
				
				if($msg_text == '')
				{
					$msg_text = '
					<div class="alert alert-success alert-dismissable"  >
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						'.mlx_get_lang("Site Language Updated Successfully").'
					</div>
					';
				}
				
				$_SESSION['msg'] = $msg_text;
				redirect('/settings/site_languages','location');	
		}
		
		$data['site_language'] = $this->global_lib->get_option('site_language');
		$data['enable_multi_language'] = $this->global_lib->get_option('enable_multi_language');
		$data['default_language'] = $this->global_lib->get_option('default_language');
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/site_languages";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function front_keyword_settings()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['languages'] = $CI->config->item('languages') ;
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			$this->form_validation->set_error_delimiters('<div class="box-body"><div class="alert alert-danger alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				', "</div></div>");
			
			$this->form_validation->set_rules('language_title', 'Language Title', 'trim|required');
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				
				
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				$lang_exp = explode('~',$language_title);
				$lang_name = $lang_exp[0];
				$lang_code = $lang_exp[1];
				
				$lang_slug = $this->global_lib->get_slug($lang_name,'_');
				$site_lang_array = array();
				$key = 'website_languages';
				$site_lang = $this->global_lib->get_option($key);
				if(!empty($site_lang))
				{
					$site_lang_array = json_decode($site_lang,true);
					if(array_key_exists($lang_slug,$site_lang_array))
					{
						$_SESSION['msg'] = '
							<div class="alert alert-danger alert-dismissable"  >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Language Already Exists").'
							</div>';
						redirect('/settings/front_keyword_settings','location');	
					}
					$site_lang_array[$lang_slug] = array('title' => $lang_name,'code' => $lang_code);
					
				}
				else
				{
					
					$site_lang_array[$lang_slug] = array('title' => $lang_name,'code' => $lang_code);
					
					$this->global_lib->update_option($key,json_encode($site_lang_array));
				}
				$this->global_lib->update_option($key,json_encode($site_lang_array));
				
				$this->Common_model->commonQuery("ALTER TABLE languages
								ADD COLUMN $lang_slug VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL");
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Website Language Added Successfully").'
							</div>
							';
				redirect('/settings/front_keyword_settings','location');	
			
			
			}
		
		}
		else if(isset($_POST['lang_update']))
		{
			extract($_POST);
			foreach($_POST as $k=>$v)
			{
				$_POST[$k] = $this->security->xss_clean($v);
				$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
			}

			if(isset($lang_ids) && !empty($lang_ids))
			{
				foreach($lang_ids as $k=>$v)
				{
					$datai = array($lang_slug => addslashes($v));
					$this->Common_model->commonUpdate('languages',$datai,'lang_id',$k);
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
			
			$_SESSION['msg'] = '
						<div class="alert alert-success alert-dismissable"  >
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							'.mlx_get_lang("Website Language Updated Successfully").'
						</div>
						';
			redirect('/settings/front_keyword_settings','location');	
			
		}
		else if(isset($_POST['delete_lang']))
		{
			extract($_POST);
			
			foreach($_POST as $k=>$v)
			{
				$_POST[$k] = $this->security->xss_clean($v);
				$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
			}

			
			$key = 'website_languages';
			$site_lang = $this->global_lib->get_option($key);
			if(!empty($site_lang))
			{
				$site_lang_array = json_decode($site_lang,true);
				if(array_key_exists($lang_slug,$site_lang_array))
				{
					unset($site_lang_array[$lang_slug]);
				}
				$this->global_lib->update_option($key,json_encode($site_lang_array));
			}
			$this->Common_model->commonQuery("ALTER TABLE languages DROP COLUMN $lang_slug ");
			
			if(is_dir("../application/language/$lang_slug"))
			{
				array_map('unlink', glob("../application/language/$lang_slug/*.*"));
				rmdir("../application/language/$lang_slug");
			}
			
			if(is_dir("../application/admin/language/$lang_slug"))
			{
				array_map('unlink', glob("../application/admin/language/$lang_slug/*.*"));
				rmdir("../application/admin/language/$lang_slug");
			}
			
			$def_lang = $this->global_lib->get_option('language');
			if(!empty($def_lang) && $def_lang == $lang_slug)
			{
				$this->global_lib->update_option('language','english');
			}
			
			$_SESSION['msg'] = '
						<div class="alert alert-success alert-dismissable"  >
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							'.mlx_get_lang("Website Language Deleted Successfully").'
						</div>
						';
			redirect('/settings/front_keyword_settings','location');	
		}
		
		
		$key = 'site_language';
		$data['site_language'] = $this->global_lib->get_option($key);
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/front_keyword_settings";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function manage_front_keywords()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			$this->form_validation->set_error_delimiters('<div class="box-body"><div class="alert alert-danger alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				', "</div></div>");
			
			$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required');
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				
				$query = $this->Common_model->commonQuery("select keyword from languages where keyword = '$keyword' and lang_for = 'front'");			
				if($query->num_rows() > 0)
				{
					$_SESSION['msg'] = '
							<div class="alert alert-danger alert-dismissable"  >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Keyword Already Exists").'
							</div>
							';
					redirect('/settings/manage_front_keywords','location');		
				}
				else
				{
					$datai = array( 'keyword' => $keyword, 'lang_for' => 'front');
					$this->Common_model->commonInsert('languages',$datai);
				}
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable"  >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Website Keyword Update Successfully").'
							</div>
							';
				redirect('/settings/manage_front_keywords','location');	
			
			
			}
		
		}
		
		$data['website_keywords'] = $this->Common_model->commonQuery("select keyword,lang_id from languages where lang_for = 'front' order by lang_id DESC ");
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/manage_front_keywords";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	
	
	public function admin_keyword_settings()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['languages'] = $CI->config->item('languages') ;
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			$this->form_validation->set_error_delimiters('<div class="box-body"><div class="alert alert-danger alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				', "</div></div>");
			
			$this->form_validation->set_rules('language_title', 'Language Title', 'trim|required');
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				
				
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				$lang_exp = explode('~',$language_title);
				$lang_name = $lang_exp[0];
				$lang_code = $lang_exp[1];
				
				$lang_slug = $this->global_lib->get_slug($lang_name,'_');
				$site_lang_array = array();
				$key = 'website_languages';
				$site_lang = $this->global_lib->get_option($key);
				if(!empty($site_lang))
				{
					$site_lang_array = json_decode($site_lang,true);
					if(array_key_exists($lang_slug,$site_lang_array))
					{
						$_SESSION['msg'] = '
							<div class="alert alert-danger alert-dismissable"  >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Language Already Exists").'
							</div>';
						redirect('/settings/admin_keyword_settings','location');	
					}
					$site_lang_array[$lang_slug] = array('title' => $lang_name,'code' => $lang_code);
					
				}
				else
				{
					
					$site_lang_array[$lang_slug] = array('title' => $lang_name,'code' => $lang_code);
					
					$this->global_lib->update_option($key,json_encode($site_lang_array));
				}
				$this->global_lib->update_option($key,json_encode($site_lang_array));
				
					$this->Common_model->commonQuery("ALTER TABLE languages
								ADD COLUMN $lang_slug VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL");
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Website Language Added Successfully").'
							</div>
							';
				redirect('/settings/admin_keyword_settings','location');	
			
			
			}
		
		}
		else if(isset($_POST['lang_update']))
		{
			extract($_POST);
			foreach($_POST as $k=>$v)
			{
				$_POST[$k] = $this->security->xss_clean($v);
				$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
			}

			if(isset($lang_ids) && !empty($lang_ids))
			{
				foreach($lang_ids as $k=>$v)
				{
					$datai = array($lang_slug => addslashes($v));
					$this->Common_model->commonUpdate('languages',$datai,'lang_id',$k);
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
			
			$_SESSION['msg'] = '
						<div class="alert alert-success alert-dismissable" >
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							'.mlx_get_lang("Website Language Updated Successfully").'
						</div>
						';
			redirect('/settings/admin_keyword_settings','location');	
		}
		else if(isset($_POST['delete_lang']))
		{
			extract($_POST);
			
			$key = 'website_languages';
			$site_lang = $this->global_lib->get_option($key);
			if(!empty($site_lang))
			{
				$site_lang_array = json_decode($site_lang,true);
				if(array_key_exists($lang_slug,$site_lang_array))
				{
					unset($site_lang_array[$lang_slug]);
				}
				$this->global_lib->update_option($key,json_encode($site_lang_array));
			}
			$this->Common_model->commonQuery("ALTER TABLE languages DROP COLUMN $lang_slug ");
			
			if(is_dir("../application/admin/language/$lang_slug"))
			{
				array_map('unlink', glob("../application/admin/language/$lang_slug/*.*"));
				rmdir("../application/admin/language/$lang_slug");
			}
			if(is_dir("../application/language/$lang_slug"))
			{
				array_map('unlink', glob("../application/language/$lang_slug/*.*"));
				rmdir("../application/language/$lang_slug");
			}
			$def_lang = $this->global_lib->get_option('language');
			if(!empty($def_lang) && $def_lang == $lang_slug)
			{
				$this->global_lib->update_option('language','english');
			}
			
			$_SESSION['msg'] = '
						<div class="alert alert-success alert-dismissable"  >
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							'.mlx_get_lang("Website Language Deleted Successfully").'
						</div>
						';
			redirect('/settings/admin_keyword_settings','location');	
		}
		
		
		$key = 'site_language';
		$data['site_language'] = $this->global_lib->get_option($key);
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/admin_keyword_settings";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function manage_admin_keywords()
	{
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			$this->form_validation->set_error_delimiters('<div class="box-body"><div class="alert alert-danger alert-dismissable" >
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				', "</div></div>");
			
			$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required');
			if ($this->form_validation->run() != FALSE)
			{
				extract($_POST,EXTR_OVERWRITE);
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				
				$query = $this->Common_model->commonQuery("select keyword from languages where keyword = '$keyword' and lang_for = 'back'");			
				if($query->num_rows() > 0)
				{
					$_SESSION['msg'] = '
							<div class="alert alert-danger alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Keyword Already Exists").'
							</div>
							';
					redirect('/settings/manage_admin_keywords','location');		
				}
				else
				{
					$datai = array( 'keyword' => $keyword, 'lang_for' => 'back');
					$this->Common_model->commonInsert('languages',$datai);
				}
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.mlx_get_lang("Website Keyword Update Successfully").'
							</div>
							';
				redirect('/settings/manage_admin_keywords','location');	
			
			
			}
		
		}
		
		$data['website_keywords'] = $this->Common_model->commonQuery("select keyword,lang_id from languages where lang_for = 'back' order by lang_id DESC ");
		
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/manage_admin_keywords";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	
	public function email_setting()
	{
		
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');

		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			
				extract($_POST,EXTR_OVERWRITE);
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				if($this->session->userdata('user_id') != 1)
				{	
					redirect('/','location');
				}
				
				$email_setting = array();
				foreach($options as $key=>$value)
				{
					$email_setting[$key] = $value;
				}
				
				
				$query = $this->Common_model->commonQuery("select * from options where option_key = 'email_setting' ");			
				if($query->num_rows() > 0)
				{
					$row = $query->row();
					$options_id = $row->option_id;
					$datai = array('option_value' => json_encode($email_setting));
					$this->Common_model->commonUpdate('options',$datai,'option_id',$options_id);			
				}
				else
				{
					$datai = array( 'option_key' => 'email_setting',	'option_value' => json_encode($email_setting));
					$this->Common_model->commonInsert('options',$datai);
				}
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Email Settings Update Successfully.
							</div>
							';
				redirect('/settings/email_setting','location');	
			
		}
		
		$data['options_list'] = $this->Common_model->commonQuery("select * from options where option_key = 'email_setting'");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/email_settings";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	
	public function email_templates()
	{
		
		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');

		
		if(isset($_POST['submit']))
		{
			extract($_POST);
			
				extract($_POST,EXTR_OVERWRITE);
				foreach($_POST as $k=>$v)
				{
					$_POST[$k] = $this->security->xss_clean($v);
					$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
				}

				if($this->session->userdata('user_id') != 1)
				{	
					redirect('/','location');
				}
				
				$email_setting = array();
				foreach($options as $key=>$value)
				{
					$email_setting[$key] = $value;
				}
				
				
				$query = $this->Common_model->commonQuery("select * from options where option_key = 'email_setting' ");			
				if($query->num_rows() > 0)
				{
					$row = $query->row();
					$options_id = $row->option_id;
					$datai = array('option_value' => json_encode($email_setting));
					$this->Common_model->commonUpdate('options',$datai,'option_id',$options_id);			
				}
				else
				{
					$datai = array( 'option_key' => 'email_setting',	'option_value' => json_encode($email_setting));
					$this->Common_model->commonInsert('options',$datai);
				}
				
				$_SESSION['msg'] = '
							<div class="alert alert-success alert-dismissable" >
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								
								Email Settings Update Successfully.
							</div>
							';
				redirect('/settings/email_setting','location');	
			
		}
		
		$data['options_list'] = $this->Common_model->commonQuery("select * from options where option_key = 'email_setting'");	
		
		$data['theme']=$theme;
		
		$data['content'] = "$theme/settings/email_settings";
		
		$this->load->view("$theme/header",$data);
		
	}
	
	public function delete_keyword($slug, $rowid)
	{
		$CI =& get_instance();
		$this->load->library('Global_lib');
		if(!is_array($rowid))
			$rowid	= $this->global_lib->DecryptClientId($rowid);
		$this->load->model('Common_model');
			
		$tbl='languages';
		$pid='lang_id';
		if($slug == 'front')
			$url='/settings/manage_front_keywords/';	 	
		else
			$url='/settings/manage_admin_keywords/';
		$fld= mlx_get_lang("Keyword");
		
		
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid );			
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" style="margin-top:10px; margin-bottom:0px;">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								'.$rows.' '.$fld.' '.mlx_get_lang("Deleted Successfully").'
							</div>
							';
		redirect($url,'location','301');	
	}
	
}
