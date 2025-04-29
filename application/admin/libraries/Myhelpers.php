<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myhelpers {

	public function Index(){}
	public function show_sub_cats($cat_type,$parent_id,$cat_level)
	{
		$CI =& get_instance();
		$CI->load->model('Categories_model');
		$query = $CI->Categories_model->show_sub_cats($cat_type,$parent_id,$cat_level);	
		return $query;		
	}
	
	public function get_sub_cat_count($cat_type,$parent_id)
	{
		$CI =& get_instance();
		$CI->load->model('Categories_model');
		$query = $CI->Categories_model->get_sub_cat_count($cat_type,$parent_id);	
		return $query;		
	}
	
	public function update_hit_count($field_name,$field_id)
	{
		$CI =& get_instance();
		$CI->load->model('Myhelper_model');
		$CI->Myhelper_model->update_hit_count($field_name,$field_id);		
	}
	public function show_child_cats($cat_type,$parent_id)
	{
		$CI =& get_instance();
		$CI->load->model('Categories_model');
		$query = $CI->Categories_model->show_child_cats($cat_type,$parent_id);	
		return $query;		
	}

}
