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


	function tanggal($date){
		date_default_timezone_set('Asia/Jakarta');
		// array hari dan bulan
		$Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		$Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		// pemisahan tahun, bulan, hari, dan waktu
		$tahun = substr($date,0,4);
		$bulan = substr($date,5,2);
		$tgl = substr($date,8,2);
		$waktu = substr($date,11,5);
		$hari = date("w",strtotime($date));
		$result = $Hari[$hari];

		return $result;
	}


	function bulan($date){
		date_default_timezone_set('Asia/Jakarta');
		// array hari dan bulan
		$Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		$Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		// pemisahan tahun, bulan, hari, dan waktu
		$tahun = substr($date,0,4);
		$bulan = substr($date,5,2);
		$tgl = substr($date,8,2);
		$waktu = substr($date,11,5);
		$hari = date("w",strtotime($date));
		$result = $Bulan[$bulan];

		return $result;
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


