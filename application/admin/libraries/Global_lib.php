<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_lib {



	public function Index(){}

	public function uri_check()
	{

		

		$str=uri_string();

		$strs=explode("/",$str);

		
		if( isset($strs[1]))   
		{
			$data['func']=$strs[1]; 			
			$data['class']=$strs[0];
		}
        else if(isset($strs[0]) && isset($strs[0]) == 'menu')
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

	public function get_options()	{
		$CI =& get_instance();
		$CI->load->model('Common_model');
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
	
	public function get_skin_class()
	{
		$CI =& get_instance();
		
		$skin_default = 'skin-blue';
		$skin_class = 'primary';
		$skin = $this->get_option('skin');
		if(!empty($skin))
			$skin_default = $skin;
		
		if($skin_default == 'skin-blue' || $skin_default == 'skin-blue-light')
		{
			$skin_class = 'primary';
		}
		else if($skin_default == 'skin-black' || $skin_default == 'skin-black-light')
		{
			$skin_class = 'default';
		}
		else if($skin_default == 'skin-purple' || $skin_default == 'skin-purple-light')
		{
			$skin_class = 'purple';
		}
		else if($skin_default == 'skin-green' || $skin_default == 'skin-green-light')
		{
			$skin_class = 'success';
		}
		else if($skin_default == 'skin-red' || $skin_default == 'skin-red-light')
		{
			$skin_class = 'danger';
		}
		else if($skin_default == 'skin-yellow' || $skin_default == 'skin-yellow-light')
		{
			$skin_class = 'warning';
		}
		return $skin_class;
	}
	
	
	public function get_option($option = "")	{
		$CI =& get_instance();
		$result = "";
		if(!empty($option))
		{
			$query = $CI->Common_model->commonQuery("select * from options where option_key = '$option' ");	
			
			if($query->num_rows()>0)
			{
				$row = $query->row();
				return $row->option_value;
			}
			else
				return false;
		}
		return 	false;
	}
	
	
	
	public function update_option($key  ,$val)
	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from options where option_key = '$key' ");			
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			$option_id=$row->option_id;
			$datai = array('option_value' => $val);
			$CI->Common_model->commonUpdate('options',$datai,'option_id',$option_id);			
			return $option_id;
		}
		else
		{
			$datai = array( 'option_key' => $key,	'option_value' => $val);
			return $CI->Common_model->commonInsert('options',$datai);
		}
	}
	
	public function get_option_lang($key,$lang = 'en')
	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select lang_text from options as opt
		inner join options_lang_details as old on old.opt_id = opt.option_id
		where opt.option_key = '$key' and old.language = '$lang'");			
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			return $row->lang_text;
		}
		else if($lang == 'en')
		{
			return $this->get_option($key);
		}
		return '';
	}
	
	public function get_slug($input_string = NULL,$seperator = "-")

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

	

	public function add_post_meta($post_id , $key  ,$val)
	{
		$CI =& get_instance();
		$datai = array( 'meta_key' => $key,	'meta_value' => $val, 'post_id' => $post_id);
		return $metaid=$CI->Common_model->commonInsert('post_meta',$datai);

	}

	public function delete_post_meta($post_id , $key  ,$val)
	{
		$CI =& get_instance();
		$datai = array( 'meta_key' => $key,	'meta_value' => $val, 'post_id' => $post_id);
	}

	public function update_post_meta($post_id , $key  ,$val)
	{
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
	
	public function update_user_meta($user_id , $key  ,$val)
	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from user_meta where user_id = '$user_id' AND 
				meta_key = '$key' ");			
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
	
	public function update_cat_meta($cat_id , $key  ,$val)
	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from cat_meta where cat_id = '$cat_id' AND meta_key = '$key' ");			
		if($query->num_rows() > 0)
		{
			$row=$query->row();
			$meta_id=$row->meta_id;
			$datai = array('meta_value' => $val);
			return $metaid = $CI->Common_model->commonUpdate('cat_meta',$datai,'meta_id',$meta_id);			
		}
		else
		{
			$datai = array( 'meta_key' => $key,	'meta_value' => $val, 'cat_id' => $cat_id);
			return $metaid=$CI->Common_model->commonInsert('cat_meta',$datai);
		}
	}
	
	public function get_cat_meta($id = NULL ,$key = NULL)
	{

		$CI =& get_instance();

		$query = $CI->Common_model->commonQuery("select * from cat_meta where cat_id = '$id' AND meta_key = '$key' ");	
		if($query->num_rows()>0)
		{
			$row = $query->row();
			return $val = $row->meta_value;
		}
		else
			return false;
	}

	public function get_cat_metadata($id = NULL)
	{
		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from cat_meta where cat_id = '$id'");	
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
	
	public function get_unique_product_slug($product_id = NULL , $product_slug, $attempt)
	{
		$CI =& get_instance();
		
		if($product_id == NULL)
		{
			$sql = "select * from products where product_slug = '$product_slug'";
		}
		else
		{
			$sql = "select * from products where 
			product_id = '$product_id' and product_slug = '$product_slug'";
		}
		
		$query = $CI->Common_model->commonQuery($sql);	
		if($query->num_rows()>0)
		{
			$count = $attempt++;
			
			$this->get_unique_product_slug($product_id,$product_slug.'-'.$count,$attempt);
		}
		else
		{
			return $product_slug;
		}
	}

	public function get_admin_user_ids()
	{
		$CI =& get_instance();
		$user_ids = array();
		$query = $CI->Common_model->commonQuery("select user_id from users where user_type = 'admin'");	
		if($query->num_rows()>0)
		{
			foreach($query->result() as $row)
			{
				$user_ids[] = $row->user_id;
			}
			
		}
		return $user_ids;
	}
	
	public function relativeTime($time, $short = false){
		$SECOND = 1;
		$MINUTE = 60 * $SECOND;
		$HOUR = 60 * $MINUTE;
		$DAY = 24 * $HOUR;
		$MONTH = 30 * $DAY;
		$before = time() - $time;

		if ($before < 0)
		{
			return "not yet";
		}

		if ($short){
			if ($before < 1 * $MINUTE)
			{
				return ($before <5) ? "Just Now" : $before . " Ago";
			}

			if ($before < 2 * $MINUTE)
			{
				return "1 ".mlx_get_lang("Min Ago");
			}

			if ($before < 45 * $MINUTE)
			{
				return floor($before / 60) . " ".mlx_get_lang("Min Ago");
			}

			if ($before < 90 * $MINUTE)
			{
				return "1 ".mlx_get_lang("Hour Ago");
			}

			if ($before < 24 * $HOUR)
			{

				return floor($before / 60 / 60). " ".mlx_get_lang("Hour Ago");
			}

			if ($before < 48 * $HOUR)
			{
				return "1 Day Ago";
			}

			if ($before < 30 * $DAY)
			{
				return floor($before / 60 / 60 / 24) . " ".mlx_get_lang("Day Ago");
			}


			if ($before < 12 * $MONTH)
			{
				$months = floor($before / 60 / 60 / 24 / 30);
				return $months <= 1 ? "1 ".mlx_get_lang("Month Ago") : $months . " ".mlx_get_lang("Month Ago");
			}
			else
			{
				$years = floor  ($before / 60 / 60 / 24 / 30 / 12);
				return $years <= 1 ? "1 ".mlx_get_lang("Year Ago") : $years." ".mlx_get_lang("Year Ago");
			}
		}

		if ($before < 1 * $MINUTE)
		{
			return ($before <= 1) ? "just now" : $before . " seconds ago";
		}

		if ($before < 2 * $MINUTE)
		{
			return "a minute ago";
		}

		if ($before < 45 * $MINUTE)
		{
		    return floor($before / 60) . " minutes ago";
		}

		if ($before < 90 * $MINUTE)
		{
			return "an hour ago";
		}

		if ($before < 24 * $HOUR)
		{

			return (floor($before / 60 / 60) == 1 ? 'about an hour' : floor($before / 60 / 60).' hours'). " ago";
		}

		if ($before < 48 * $HOUR)
		{
			return mlx_get_lang('Yesterday at').' '.date('h:i A',$time);
		}

		if ($before < 30 * $DAY)
		{
			return date('M d,Y h:i A',$time);
		}

		if ($before < 12 * $MONTH)
		{

			return date('M d,Y h:i A',$time);
		}
		else
		{
			return date('M d,Y h:i A',$time);
		}

		return "$time";
	}
	
	public function get_currency_symbol($currency_code = null)
	{
		
		$CI =& get_instance();
		
		$currency_symbols = $CI->config->item('currency_symbols');
		
		$selected_currency = $this->get_option('currency');
		if($currency_code != null)
		{
			
			if(array_key_exists($currency_code,$currency_symbols))
				return $currency_symbols[$currency_code];
		}
		else if(isset($currency_symbols) && !empty($currency_symbols) && $selected_currency && $selected_currency != '')
		{
			if(array_key_exists($selected_currency,$currency_symbols))
				return $currency_symbols[$selected_currency];
		}
		return '';
	}
	
	public function moneyFormatDollar($num, $args = array())
	{
		extract($args);	
		
		
		$CI =& get_instance();
		
		
		if(isset($CI->currency_pos)) $currency_pos =  $CI->currency_pos ;  else $currency_pos = 'left'; 
		if(isset($CI->thousand_sep)) $thousand_sep =  $CI->thousand_sep ; else $thousand_sep = ','; 
		if(isset($CI->decimal_sep))  $decimal_sep =  $CI->decimal_sep ; else $decimal_sep = '.'; 
		if(isset($CI->num_decimals)) $num_decimals =  $CI->num_decimals ; else $num_decimals = '2'; 
		
		
		$amount = number_format($num, $num_decimals, $decimal_sep, $thousand_sep);
		
		if(isset($currency_symbol)){
			if($currency_pos == 'left')
				$amount = $currency_symbol . $amount;
			if($currency_pos == 'left_space')
				$amount = $currency_symbol. " ".$amount;
			
			if($currency_pos == 'right')
				$amount .= $currency_symbol;
			if($currency_pos == 'right_space')
				$amount .= " ".$currency_symbol;
		}
		return $amount;
		
	}
	
	public function moneyFormatDollarOld($num)
	{	
		$is_neg = false;
		if ($num < 0)
		{
			$num = ltrim($num, '-'); 
			$is_neg = true;
		}
		
		$explrestunits = "" ;
		if(strlen($num)>3){
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3); 
			
			if(strlen($restunits) == 4)
			{
				$restunits = "00".$restunits; 
			}
			else
			{
				$restunits = (strlen($restunits)%4 == 1)?"0".$restunits:$restunits; 
			}
			
			
			$expunit = str_split($restunits, 3);
			
			for($i=0; $i<sizeof($expunit); $i++){
				if($i==0){
					$explrestunits .= (int)$expunit[$i].","; 
				}else{
					$explrestunits .= $expunit[$i].",";
				}
			}
			$thecash = $explrestunits.$lastthree;
		} else {
			$thecash = $num;
		}
		if($is_neg)
		{
			return '-'.$thecash;
		}
		else
		{
			return $thecash; 
		}
	}
	
	public function get_timestamp_from_date($date,$type = 'start')
	{
		$CI =& get_instance();
		$default_date_format = $this->get_option('default_date_format');
		if(empty($default_date_format) || $default_date_format == '')
		{
			$default_date_format = 'mm/dd/yyyy';
		}
		$date_timestamp = '';
		if($default_date_format == 'mm/dd/yyyy')
		{
			$date_explode = explode('/',$date);
			if($type == 'end')
				$date_timestamp = mktime(23,59,59,$date_explode[0],$date_explode[1],$date_explode[2]);
			else
				$date_timestamp = mktime(0,0,0,$date_explode[0],$date_explode[1],$date_explode[2]);
			
		}
		else if($default_date_format == 'dd/mm/yyyy')
		{
			$date_explode = explode('/',$date);
			if($type == 'end')
				$date_timestamp = mktime(23,59,59,$date_explode[1],$date_explode[0],$date_explode[2]);
			else
				$date_timestamp = mktime(0,0,0,$date_explode[1],$date_explode[0],$date_explode[2]);
		}
		return $date_timestamp;
	}
	
	public function get_default_date_format($has_short = false)
	{
		$CI =& get_instance();
		$default_date_format = $this->get_option('default_date_format');
		if(empty($default_date_format) || $default_date_format == '')
		{
			$default_date_format = 'mm/dd/yyyy';
		}
		if($has_short)
		{
			$default_date_format = str_replace('mm','m',$default_date_format);
			$default_date_format = str_replace('dd','d',$default_date_format);
			$default_date_format = str_replace('yyyy','yy',$default_date_format);
		}
		return $default_date_format;
	}
	
	public function get_date_from_timestamp($retun_type = null, $date = null)
	{
		$CI =& get_instance();
		$default_date_format = $this->get_option('default_date_format');
		if(empty($default_date_format) || $default_date_format == '')
		{
			$default_date_format = 'mm/dd/yyyy';
		}
		
		$default_date = '';
		if($default_date_format == 'mm/dd/yyyy')
		{
			if($retun_type != null && $retun_type == 'start_date')
			{
				if($date != null)
				{
					$default_date = date('m/04/Y',$date); 
				}
				else
				{
					$default_date = date('m/04/Y',time()); 
				}
			}
			else if($retun_type != null && $retun_type == 'end_date')
			{
				if($date != null)
				{
					$default_date = date('m/03/Y',$date); 
				}
				else
				{
					$default_date = date('m/03/Y',time()); 
				}
			}
			else
			{
				if($date == null)
				{
					$default_date = date('m/d/Y',time());
				}
				else
				{
					$default_date = date('m/d/Y',$date);
				}
			}
		}
		else if($default_date_format == 'dd/mm/yyyy')
		{
			
			if($retun_type != null && $retun_type == 'start_date')
			{
				
				if($date != null)
				{
					$default_date = date('04/m/Y',$date); 
				}
				else
				{
					$default_date = date('04/m/Y',time()); 
				}
			}
			else if($retun_type != null && $retun_type == 'end_date')
			{
				
				if($date != null)
				{
					$default_date = date('03/m/Y',$date); 
				}
				else
				{
					$default_date = date('03/m/Y',time()); 
				}
			}
			else
			{
				if($date == null)
				{
					$default_date = date('d/m/Y',time());
				}
				else
				{
					$default_date = date('d/m/Y',$date);
				}
			}
		}
		return $default_date;
	}
	
	public function get_dates_between_2_dates($date1, $date2, $format = 'm/d/Y' )
	{
      $dates = array();
      $current = strtotime($date1);
      $date2 = strtotime($date2);
      $stepVal = '+1 day';
      while( $current <= $date2 ) {
         $dates[] = date($format, $current);
         $current = strtotime($stepVal, $current);
      }
      return $dates;
   }
    
	 public function get_dates_between_2_timestamp($date1, $date2, $format = 'm/d/Y' ) {
      $dates = array();
      $current = $date1;
      $date2 = $date2;
      $stepVal = '+1 day';
      while( $current <= $date2 ) {
         $dates[] = date($format, $current);
         $current = strtotime($stepVal, $current);
      }
      return $dates;
   }
   
   public function get_lang_title_by_code($lang_code)
	{
		if($lang_code == '')
			return '';
		
		$site_language = $this->get_option('site_language');
		$site_language_array = json_decode($site_language,true);
		foreach($site_language_array as $k=>$v)
		{
			if (strpos($v['language'], '~'.$lang_code) !== false) {
				$lang_exp = explode('~',$v['language']);
				return ucfirst($lang_exp[0]);
			}
		}
		return '';
	}
    
	
	public function get_include_contents($filename) {
		if (is_file($filename)) {
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		return false;
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

