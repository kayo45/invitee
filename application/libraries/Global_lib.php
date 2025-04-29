<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_lib {

	var $site_options = "";

	

	public function Index(){}
	
	public function get_property_url($property_id , $property = ''){
		
		$CI =& get_instance();
		$CI->load->library('propertylib');
		return $CI->propertylib->get_url($property_id , $property);
	}	
	
	public function uri_check()
	{
		
		$str=uri_string();
		$strs=explode("/",$str);
		$data['class']='main';
		
		if( isset($strs[1]))   
		{
			$data['func']=$strs[1]; 
			switch ($strs[1])
			{
				case 'home': 
				$data['class']='home';break;
				
				case 'blogs': 
				$data['class']='blogs';break;
				
				case 'classified': 
				$data['class']='classifieds';break;
				
				case 'user_classified': 
				$data['class']='classifieds';break;
				
				case 'articles': 
				$data['class']='articles';break;
				
				case 'view_article': 
				$data['class']='articles';break;
				
				case 'search_classified': 
				$data['class']='classifieds';break;
				
				case 'category' : 
					if(isset($strs[2]))
					{
						switch($strs[2])
						{
							case 'classified' :
							$data['class']='classifieds';break;
							
							case 'article' :
							$data['class']='articles';break;
						}
					
					}
				case 'user_data' : 
					if(isset($strs[2]))
					{
						switch($strs[2])
						{
							case 'classified' :
							$data['class']='classifieds';break;
							
							case 'article' :
							$data['class']='articles';break;
						}
					
					}	
			}	
		}
		else if(isset($strs[0]) && !empty($strs[0]))
		{
			$data['func']=$strs[0];
			$data['class']=$strs[0];
		}
		else {
			$data['func']='home';
			$data['class']='home';
		}	
			
		
		return $data;
	}	
	
	public function get_page_slug_by_id($page_id)	
	{				
		$CI =& get_instance();		
		$enc_id = $this->DecryptClientId($page_id);
		$query = $CI->Common_model->commonQuery("select page_slug from pages where page_id = '$enc_id' ");							
		if($query->num_rows() > 0)		
		{			
			$row=$query->row();			
			$page_slug=$row->page_slug;			
			return $page_slug;		
		}				
		else		
		{			
			return false;		
		}					
	}
	
	public function get_options()	{
		$CI =& get_instance();
		
		if(empty($this->site_options))
		{
			$sql  = "select * from options";
			$options_list = $CI->Common_model->commonQuery($sql);			
			
			$options = array();
			if(isset($options_list) && $options_list->num_rows()>0)
			{
			  foreach($options_list->result() as $row)
			  {
			   $options[$row->option_key] = $row->option_value;
			  }
			}
			
			$this->site_options = $options;
			
		}
		
		return 		$this->site_options ;
		
	}
	
	public function get_option($option = "")	{
		
		$result = "";
		if(!empty($option))
		{
			$options = $this->get_options();
			if(array_key_exists($option,$options))
				$result = $options[$option];
		}
		
		return 	$result;
		
	}
	
	public function get_option_lang($key,$lang = 'en')
	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select lang_text from options as opt
		inner join options_lang_details as old on old.opt_id = opt.option_id
		where opt.option_key = '$key' and old.language = '$lang' and old.lang_text != ''");			
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			return $row->lang_text;
		}
		else
		{
			return $this->get_option($key);
		}
	}
	
	public function update_post_meta($post_id , $key  ,$val)	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from post_meta where post_id = '$post_id' AND meta_key = '$key' ");			
		
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			$meta_id=$row->meta_id;
			$datai = array('meta_value' => $val);
			
			return $metaid = $CI->Common_model->commonUpdate('post_meta',$datai,'meta_id',$meta_id);			
		}
		else
		{
			$datai = array( 'meta_key' => $key,	'meta_value' => $val, 'post_id' => $post_id);
								
			return $metaid=$CI->Common_model->commonInsert('post_meta',$datai);
		}
	}
	
	public function get_post_meta($id = NULL ,$key = NULL)
	{
		
		$CI =& get_instance();
		
		$query = $CI->Common_model->commonQuery("select * from post_meta where post_id = '$id' AND meta_key = '$key' ");	
		
		if($query->num_rows()>0)
		{
			$row = $query->row();
			return $val = $row->meta_value;
		}
		else
			return false;
	}
	
	public function get_post_metadata($id = NULL)
	{
		$CI =& get_instance();
		
		$query = $CI->Common_model->commonQuery("select * from post_meta where post_id = '$id'");	
		
		if($query->num_rows()>0)
		{
			$metadata_array = array();
			foreach($query->result() as $row)
			{	
				$metadata_array[$row->meta_key] = $row->meta_value;
			}
			return $metadata_array;
		}
		else
			return false;
	}
	
	public function get_property_image($id = NULL ,$type = NULL)
	{

		$CI =& get_instance();
		if($type == NULL)
			$type = 'thumbnail';
		$query = $CI->Common_model->commonQuery("select * from properties where p_id = '$id' ");	
		if($query->num_rows()>0)
		{
			$row = $query->row();
			if(!empty($row->property_images))
			{
				$img_exp = explode(',',$row->property_images);
				
				foreach($img_exp as $k=>$v)
				{
					
					$img_query = $CI->Common_model->commonQuery("select p1.* from post_images pi 
								inner join post_images as p1 on p1.parent_image_id = pi.image_id
								and p1.image_type = '$type'
								where pi.image_id = '$v'");	
					$image_meta = array();
					
					if($img_query->num_rows()>0)
					{
						$img_row = $img_query->row();
						$image_meta[] = $img_row->image_path.$img_row->image_name;
					}
					return $image_meta;
				}
			}
			else
				return false;
		}
		else
			return false;
	}
	
	public function get_slug($input_string = NULL,$seperator = "_")

	{

		

		$slug= trim($input_string);


		$slug	=	preg_replace('/[^A-Za-z0-9 ]/', '', $slug);

		

		$aslug=explode(" ",$slug);

		foreach($aslug as $k=>$v)

		{	

			$aslug[$k] = strtolower($aslug[$k]);

			if(!$aslug[$k]) unset($aslug[$k]);

			

		}

		$slug= implode($seperator, $aslug);	

		

		return $slug;

	}

	public function get_property_gallery($id = NULL)
	{

		$CI =& get_instance();
		$image_meta = array();
		$query = $CI->Common_model->commonQuery("select * from properties where p_id = '$id' ");	
		if($query->num_rows()>0)
		{
			$row = $query->row();
			if(!empty($row->property_images))
			{
				$img_exp = explode(',',$row->property_images);
				
				foreach($img_exp as $k=>$v)
				{
					
					$img_query = $CI->Common_model->commonQuery("select pi.* from post_images pi 
								where ( pi.image_type = 'large' OR pi.image_type = 'thumbnail' ) and pi.parent_image_id = '$v'");	
					
					
					if($img_query->num_rows()>0)
					{
						foreach($img_query->result() as $img_row)
						{
							$image_meta[$img_row->parent_image_id][$img_row->image_type] = $img_row->image_path.$img_row->image_name;
						}
					}
					
				}
			}
			
		}
		return $image_meta;
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
	
	public function get_post_title_by_slug($slug)	
	{				
		$CI =& get_instance();		
		$query = $CI->Common_model->commonQuery("select * from posts where post_slug = '$slug' ");							
		if($query->num_rows() > 0)		
		{			
			$row=$query->row();			
			$post_title=$row->post_title;			
			return $post_title;		
		}				
		else		
		{			
			return false;		
		}					
	}	
	
	public function get_cat_title_by_slug($slug)	
	{				
		$CI =& get_instance();		
		$query = $CI->Common_model->commonQuery("select * from categories where cat_slug = '$slug' ");							
		if($query->num_rows() > 0)		
		{			
			$row=$query->row();			
			$cat_title=$row->cat_title;			
			return $cat_title;		
		}				
		else		
		{			
			return false;		
		}					
	}
	
	public function get_user_meta($id = NULL ,$key = NULL)
	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from user_meta where user_id = '$id' AND meta_key = '$key' ");	
		
		if($query->num_rows()>0)
		{
			$row = $query->row();
			return $val = $row->meta_value;
		}
		else
			return false;
	}
	
	public function update_user_meta($user_id , $key  ,$val)	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from user_meta where user_id = '$user_id' AND meta_key = '$key' ");			
		
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			$meta_id=$row->meta_id;
			$datai = array('meta_value' => $val);
			
			return $metaid = $CI->Common_model->commonUpdate('user_meta',$datai,'meta_id',$meta_id);			
		}
		else
		{
			$datai = array( 'meta_key' => $key,	'meta_value' => $val, 'user_id' => $user_id);
								
			return $metaid=$CI->Common_model->commonInsert('user_meta',$datai);
		}
	}
	
	public function get_user_metadata($id = NULL)
	{
		$CI =& get_instance();
		
		$query = $CI->Common_model->commonQuery("select * from user_meta where user_id = '$id'");	
		
		if($query->num_rows()>0)
		{
			$metadata_array = array();
			foreach($query->result() as $row)
			{	
				$metadata_array[$row->meta_key] = $row->meta_value;
			}
			return $metadata_array;
		}
		else
			return false;
	}
	
	public function get_admin_user_emails()
	{
		$CI =& get_instance();
		$user_emails = array();
		$query = $CI->Common_model->commonQuery("select user_email from users where user_type = 'admin'");	
		if($query->num_rows()>0)
		{
			foreach($query->result() as $row)
			{
				$user_emails[] = $row->user_email;
			}
			
		}
		return $user_emails;
	}
	
	public function get_product_image($id = NULL ,$type = NULL,$count = NULL)
	{

		$CI =& get_instance();
		if($type == NULL)
			$type = 'thumbnail';
		$query = $CI->Common_model->commonQuery("select * from products where product_id = '$id' ");	
		if($query->num_rows()>0)
		{
			$row = $query->row();
			if(!empty($row->product_images))
			{
				$img_exp = explode(',',$row->product_images);
				
				$n = 0;
				$image_meta = array();
				foreach($img_exp as $k=>$v)
				{
					if($count != NULL && $count == $n)
					{
						break;
					}
					
					$img_query = $CI->Common_model->commonQuery("select p1.* from post_images pi 
								inner join post_images as p1 on p1.parent_image_id = pi.image_id
								and p1.image_type = '$type'
								where pi.image_id = '$v'");	
					
					
					if($img_query->num_rows()>0)
					{
						$img_row = $img_query->row();
						$image_meta[] = $img_row->image_path.$img_row->image_name;
						$n++;
					}
				}
				return $image_meta;
			}
			else
				return false;
		}
		else
			return false;
	}
	
	public function get_get_title_by_ids($ids = NULL)
	{
		$cat_title_string = '';
		if($ids == NULL)
			return $cat_title_string;
		$CI =& get_instance();
		
		$query = $CI->Common_model->commonQuery("select * from categories where cat_id in ($ids) ");	
		if($query->num_rows()>0)
		{
			
			foreach($query->result() as $row)
			{
				$cat_title_string .= $row->cat_slug.' ';
			}
		}
		return $cat_title_string;
	}
	
	public function truncate_string($string, $length, $stopanywhere=false) {
		
		$words = explode(" ",$string);
		if(count($words) > $length)
		{
			return implode(" ", array_splice($words, 0, $length)).'...';
		}
		return $string;
	}
	
	function getVisitorIP_func()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}
	
	function relativeTime($time, $short = false){
		$SECOND = 1;
		$MINUTE = 60 * $SECOND;
		$HOUR = 60 * $MINUTE;
		$DAY = 24 * $HOUR;
		$MONTH = 30 * $DAY;
		$before = time() - $time;

		if ($before < 0)
		{
			return mlx_get_lang("Not Yet");
		}

		if ($short){
			if ($before < 1 * $MINUTE)
			{
				return ($before <5) ? mlx_get_lang("Just Now") : $before . mlx_get_lang(" Ago");
			}

			if ($before < 2 * $MINUTE)
			{
				return mlx_get_lang("1 Min Ago");
			}

			if ($before < 45 * $MINUTE)
			{
				return floor($before / 60) . " ".mlx_get_lang("Min Ago");
			}

			if ($before < 90 * $MINUTE)
			{
				return mlx_get_lang("1 Hour Ago");
			}

			if ($before < 24 * $HOUR)
			{

				return floor($before / 60 / 60). " ".mlx_get_lang("Hour Ago");
			}

			if ($before < 48 * $HOUR)
			{
				return mlx_get_lang("1 Day Ago");
			}

			if ($before < 30 * $DAY)
			{
				return floor($before / 60 / 60 / 24) . " ".mlx_get_lang('Day Ago');
			}


			if ($before < 12 * $MONTH)
			{
				$months = floor($before / 60 / 60 / 24 / 30);
				return $months <= 1 ? mlx_get_lang("1 Month Ago") : $months . " ".mlx_get_lang("Month Ago");
			}
			else
			{
				$years = floor  ($before / 60 / 60 / 24 / 30 / 12);
				return $years <= 1 ? mlx_get_lang("1 Year Ago") : $years." ".mlx_get_lang("Year Ago");
			}
		}

		if ($before < 1 * $MINUTE)
		{
			return ($before <= 1) ? mlx_get_lang("Just Now") : $before . " ".mlx_get_lang("Seconds Ago");
		}

		if ($before < 2 * $MINUTE)
		{
			return mlx_get_lang("A Minute Ago");
		}

		if ($before < 45 * $MINUTE)
		{
		    return floor($before / 60) . " ".mlx_get_lang("Minutes Ago");
		}

		if ($before < 90 * $MINUTE)
		{
			return mlx_get_lang("An Hour Ago");
		}

		if ($before < 24 * $HOUR)
		{

			return (floor($before / 60 / 60) == 1 ? mlx_get_lang('About an Hour') : floor($before / 60 / 60).' '.mlx_get_lang('Hours')). " ".mlx_get_lang("Ago");
		}

		if ($before < 48 * $HOUR)
		{
			return mlx_get_lang("Yesterday");
		}

		if ($before < 30 * $DAY)
		{
			return floor($before / 60 / 60 / 24) . " ".mlx_get_lang("Days Ago");
		}

		if ($before < 12 * $MONTH)
		{

			$months = floor($before / 60 / 60 / 24 / 30);
			return $months <= 1 ? mlx_get_lang("One Month Ago") : $months . " ".mlx_get_lang("Months Ago");
		}
		else
		{
			$years = floor  ($before / 60 / 60 / 24 / 30 / 12);
			return $years <= 1 ? mlx_get_lang("One Year Ago") : $years." ".mlx_get_lang("Years Ago");
		}

		return "$time";
	}
	
	public function get_currency_symbol()
	{
		
		$CI =& get_instance();
		
		$currency_symbols = $CI->config->item('currency_symbols');
		$selected_currency = $this->get_option('currency');
		
		if(isset($CI->site_currency) && !empty($CI->site_currency))
		{
			
			if(array_key_exists($CI->site_currency,$currency_symbols))
				return $currency_symbols[$CI->site_currency];
		}
		else if(isset($currency_symbols) && !empty($currency_symbols) && $selected_currency && $selected_currency != '')
		{
			if(array_key_exists($selected_currency,$currency_symbols))
				return $currency_symbols[$selected_currency];
		}
		return '';
	}
	
	
	public function get_currency_code()
	{
		
		$CI =& get_instance();
		
		$currency_symbols = $CI->config->item('currency_symbols');
		
		
		$selected_currency = $this->get_option('currency');
		
		if(isset($CI->site_currency) && !empty($CI->site_currency))
		{
			
			if(array_key_exists($CI->site_currency,$currency_symbols))
				
				return $currency_symbols[$CI->site_currency];
		}
		else if(isset($currency_symbols) && !empty($currency_symbols) && $selected_currency && $selected_currency != '')
		{
			if(array_key_exists($selected_currency,$currency_symbols))
				return $currency_symbols[$selected_currency];
		}
		return '';
	}

	public function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $max = strlen($codeAlphabet);
    
        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[rand(0, $max-1)];
        }
    
        return $token;
	}
	
	
	public function get_events($id)
	{
		$CI =& get_instance();
		if(!empty($id))
		{
			$sql  = "select event_title from wedding_event WHERE event_id=$id";
			$events_list = $CI->Common_model->commonQuery($sql);			
			
			
			if(isset($events_list) && $events_list->num_rows()>0)
			{
			  foreach($events_list->result() as $row)
			  {
				return $row->event_title;
			  }
			}
		}
		
	}
	
	public function get_image_type($img_path = null, $img_name = null, $return_type = 'thumb')
	{
		if($img_path != null && $img_name != null)
		{
			$explod = explode(".", $img_name);
			$extension = end($explod);
			$name = str_replace('.'.$extension,'',$img_name);
			$thumb_img_name = $name.'-300X300.'.$extension;
			$medium_img_name = $name.'-500X500.'.$extension;
			
			$returned_file = '';
			if($return_type == 'thumb' && file_exists($img_path.$thumb_img_name))
			{
				$returned_file = $thumb_img_name;
			}
			else if($return_type == 'medium' && file_exists($img_path.$medium_img_name) || ($return_type == 'thumb' && !file_exists($img_path.$thumb_img_name) && file_exists($img_path.$medium_img_name)))
			{
				$returned_file = $medium_img_name;
			}
			else if(file_exists($img_path.$img_name) || $return_type == 'full')
			{
				$returned_file = $img_name;
			}
			
			return $returned_file;
		}
		return '';
	}
	
	public function base64url_encode($bin) {
		return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($bin));
	}

	public function base64url_decode($str) {
		return base64_decode(str_replace(['-', '_'], ['+', '/'], $str));
	}
}
