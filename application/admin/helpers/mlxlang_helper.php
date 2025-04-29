<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('mlx_get_lang'))
{
    function mlx_get_lang($keyword = "")
    { 	
		$CI =& get_instance();
		
		$output = $CI->lang->line($keyword); 
		if(empty($output))
			return $keyword;
		else	
			return $output;
    }   

	function tesx()
	{
		$env = (ENVIRONMENT == 'production') ? 'none' : 'block';
		$args = func_get_args();
		if(is_array($args) && count($args)){ foreach($args as $x){
			$echo = "<div style='display:$env'><pre>";
			if(is_array($x) || is_object($x)){
				$echo .= print_r($x, true);
			}else{
				$echo .= var_export($x, true);
			}
			$echo .= "</pre><hr /></div>";
			echo $echo;
		}}
		die();
	}
}