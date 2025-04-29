<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_images extends MY_Controller {
	
	public function upload_gallery_images_callback_func()
	{
		extract($_POST);		
		$CI =& get_instance();		
		$this->load->library('Global_lib');		
		$this->load->model('Common_model');		
		
		$target = 'photo_gallery/';
		
		if(!is_dir('../uploads/'.$target))
		{
			mkdir('../uploads/'.$target,0777,true);
		}
		
		$uploaded_path = '../uploads/'.$target;
		
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
		 
		$file_name = $_REQUEST["name"];
		
		$explod = explode(".", $file_name);
		$extension = end($explod);
		$name = str_replace('.'.$extension,'',$file_name);
		
		$first = 1;
		$separator = '-';
		
		if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'thumbs')
		{
			$new_file_name = $thumbnail_image_name = $name.'-t.'.$extension;
		}
		else if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'medium')
		{
			$new_file_name = $medium_image_name = $name.'-m.'.$extension;
		}
		else
		{
			$new_file_name = $file_name;
		}
		
		
		while ( file_exists('../uploads/'.$target . $new_file_name ) ) 
		{
			if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'thumbs')
			{
				$new_file_name = $thumbnail_image_name = $name.$separator.$first.'-t'.".".$extension;
			}
			else if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'medium')
			{
				$new_file_name = $medium_image_name = $name.$separator.$first.'-m'.".".$extension;
			}
			else
			{
				$new_file_name = $name.$separator.$first.".".$extension;  
			}
			
			
			$first++;   
		}
		
		$file_name = $new_file_name;
		$filePath = $uploaded_path.$file_name;
		 
		 
		$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out) {
		  $in = @fopen($_FILES['file']['tmp_name'], "rb");
		  if ($in) {
			while ($buff = fread($in, 4096))
			  fwrite($out, $buff);
		  } else
			die('{"OK": 0, "info": "Failed to open input stream."}');
		 
		  @fclose($in);
		  @fclose($out);
		  
		   @unlink($_FILES['file']['tmp_name']);
		  
		} else
		  die('{"OK": 0, "info": "Failed to open output stream."}');
		 
		if (!$chunks || $chunk == $chunks - 1) {
		  rename("{$filePath}.part", $filePath);
		  
		  $temp = tempnam(sys_get_temp_dir(), 'TMP_');
		  file_put_contents($temp, file_get_contents("$filePath"));
		  
		  
		  unlink($temp);
		  
		  if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'medium')
		  {
			   $post_type = 'media-album';
			   $origoinal_image_name = str_replace('-m.','.',$file_name);
			   $thumbnail_image_name = str_replace('-m.','-t.',$file_name);
			   $medium_image_name = $file_name;
			   $filePath = $uploaded_path.$medium_image_name;
			   $datai = array( 'image_name' => $origoinal_image_name,
								'image_path' => 'uploads/'.$target,
								'image_type' => 'original',
								'parent_image_id' => 0, 
								'image_alt' => $origoinal_image_name,
								'wedding_user_id' => $this->session->userdata('user_id'),
								'wedding_id' => $this->session->userdata('wedding_id'),
								);
					
				$p_i_parent_ID = $CI->Common_model->commonInsert('wedding_gallery',$datai);
				
				$datai = array( 
						'parent_image_id' => $p_i_parent_ID,
						'image_path' => 'uploads/'.$target,	
						'image_name' => $thumbnail_image_name,
						'image_type' => 'thumbnail',
						'image_alt' => $origoinal_image_name,
						'wedding_user_id' => $this->session->userdata('user_id'),
						'wedding_id' => $this->session->userdata('wedding_id'),
						);
						
				$this->Common_model->commonInsert('wedding_gallery',$datai);
				
				$datai = array( 
						'parent_image_id' => $p_i_parent_ID,
						'image_path' => 'uploads/'.$target,	
						'image_name' => $medium_image_name,
						'image_type' => 'medium',
						'image_alt' => $origoinal_image_name,
						'wedding_user_id' => $this->session->userdata('user_id'),
						'wedding_id' => $this->session->userdata('wedding_id'),
						);
						
				$this->Common_model->commonInsert('wedding_gallery',$datai);
				
				header('Content-type: application/json');				
				echo json_encode(array('type'=> 'success',
									   'thumb_img_url' => $filePath,
									   'img_name' => $origoinal_image_name,
									   'img_id' => $this->global_lib->EncryptClientId($p_i_parent_ID)));
				exit;
		   }
		}
		
		header('Content-type: application/json');				
		echo json_encode(array('type'=> 'error',));
		exit;
	}
	
	public function delete_gallery_images_callback_func()	
	{		 
		extract($_POST);		
		$CI =& get_instance();	
		$this->load->model('Common_model');		
		$this->load->library('Global_lib');		
		$image_name = $img_name;
		
		
		$result = $this->Common_model->commonQuery("select * from wedding_gallery 
		where image_alt = '$image_name'");
		
		if($result->num_rows() > 0 )
		{
			foreach($result->result() as $row)
			{
				$img_url = $row->image_path.$row->image_name;
				if(file_exists('../'.$img_url))
					unlink('../'.$img_url);
				$this->Common_model->commonDelete('wedding_gallery',$row->image_id,'image_id' );
			}
		}
		echo 'success';
	}
	
	public function upload_image_callback_func()
	{
		extract($_POST);		
		$CI =& get_instance();		
		$this->load->library('Global_lib');			
		$this->load->model('Common_model');		
		
		$target = $image_type.'/';
		
		if(!is_dir('../uploads/'.$target))
		{
			mkdir('../uploads/'.$target,0777,true);
		}
		
		$uploaded_path = '../uploads/'.$target;
		
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
		 
		$file_name = $_REQUEST["name"];
		
		$explod = explode(".", $file_name);
		$extension = end($explod);
		$name = str_replace('.'.$extension,'',$file_name);
		
		$first = 1;
		$separator = '-';
		
		if($image_type == 'slider' || $image_type == 'site_slider')
		{
			$new_file_name = $file_name;
		}
		else
		{
			if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'thumbs')
			{
				$new_file_name = $name.'-300X300.'.$extension;
			}
			else if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'medium')
			{
				$new_file_name = $medium_image_name = $name.'-500X500.'.$extension;
			}
			else
			{
				$new_file_name = $file_name;
			}
		}
		
		while ( file_exists('../uploads/'.$target . $new_file_name ) ) 
		{
			if($image_type == 'slider' || $image_type == 'site_slider')
			{
				$new_file_name = $name.$separator.$first.".".$extension;  
			}
			else
			{
				if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'thumbs')
				{
					$new_file_name = $name.$separator.$first.'-300X300'.".".$extension;
				}
				else if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'medium')
				{
					$new_file_name = $medium_image_name = $name.$separator.$first.'-500X500'.".".$extension;
				}
				else
				{
					$new_file_name = $name.$separator.$first.".".$extension;  
				}
			}
			
			$first++;   
		}
		
		$file_name = $new_file_name;
		$filePath = $uploaded_path.$file_name;
		 
		 
		$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out) {
		  $in = @fopen($_FILES['file']['tmp_name'], "rb");
		  if ($in) {
			while ($buff = fread($in, 4096))
			  fwrite($out, $buff);
		  } else
			die('{"OK": 0, "info": "Failed to open input stream."}');
		 
		  @fclose($in);
		  @fclose($out);
		  
		   @unlink($_FILES['file']['tmp_name']);
		  
		} else
		  die('{"OK": 0, "info": "Failed to open output stream."}');
		 
		if (!$chunks || $chunk == $chunks - 1) {
		  rename("{$filePath}.part", $filePath);
		  
		  $temp = tempnam(sys_get_temp_dir(), 'TMP_');
		  file_put_contents($temp, file_get_contents("$filePath"));
		  
		  
		  unlink($temp);
		  
		  if($image_type == 'slider' || $image_type == 'site_slider')
			{
			   $origoinal_image_name = $file_name;
			   $filePath = $uploaded_path.$file_name;
			   			header('Content-type: application/json');				
				echo json_encode(array('type'=> 'success',
									   'thumb_img_url' => $filePath,
									   'img_name' => $origoinal_image_name));
				exit;

			}
			else if(isset($_GET['diretorio']) && $_GET['diretorio'] == 'medium')
		   {
				
				$origoinal_image_name = str_replace('-500X500.','.',$file_name);
			   $thumbnail_image_name = str_replace('-500X500.','-300X300.',$file_name);
			   $medium_image_name = $file_name;
			   $filePath = $uploaded_path.$thumbnail_image_name;
			   			header('Content-type: application/json');				
				echo json_encode(array('type'=> 'success',
									   'thumb_img_url' => $filePath,
									   'img_name' => $origoinal_image_name));
				exit;

			}
			else
			{
				header('Content-type: application/json');				
				echo json_encode(array('type'=> 'error',));
				exit;
			}
		}
		
		header('Content-type: application/json');				
		echo json_encode(array('type'=> 'error',));
		exit;
	}
	
	public function delete_image_callback_func()	
	{		 
		extract($_POST);		
		$CI =& get_instance();	
		$this->load->model('Common_model');		
		$this->load->library('global_lib');		
		$target = $img_type;
		
		$explod = explode(".", $img_name);
		$extension = end($explod);
		$name = str_replace('.'.$extension,'',$img_name);
		
		$thumb_img_name = $name.'-300X300.'.$extension;
		$medium_img_name = $name.'-500X500.'.$extension;
		
		if(file_exists('../uploads/'.$target.'/'.$img_name))
		{
			unlink('../uploads/'.$target.'/'.$img_name);
		}
		if(file_exists('../uploads/'.$target.'/'.$medium_img_name))
		{
			unlink('../uploads/'.$target.'/'.$medium_img_name);
		}
		if(file_exists('../uploads/'.$target.'/'.$thumb_img_name))
		{
			unlink('../uploads/'.$target.'/'.$thumb_img_name);
		}
		
		if(isset($element_id) && !empty($element_id))
		{
			$decId = $this->global_lib->DecryptClientId($element_id);
			if($target == 'story')
			{
				$datai = array( 'image' => '');
				$this->Common_model->commonUpdate('wedding_story',$datai,'id',$decId);
			}else if($target == 'relatives')
			{
				$datai = array( 'image' => '');
				$this->Common_model->commonUpdate('wedding_relatives',$datai,'r_id',$decId);
			}
			else if($target == 'blogs')
			{
				$datai = array( 'image' => '');
				$this->Common_model->commonUpdate('blogs',$datai,'b_id',$decId);
			}
			else if($target == 'weddings')
			{
				if(isset($element_column) && !empty($element_column))
				{
					$datai = array( $element_column => '');
					$this->Common_model->commonUpdate('wedding_details',$datai,'id',$decId);
				}
			}
		}
		
		echo 'success';
	}
	
	
}
