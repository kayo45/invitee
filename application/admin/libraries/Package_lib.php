<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Package_lib {


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
	
	public function add_credit_uses($credit_uses_for,$using_id,$uses_type,$user_id){

		$CI =& get_instance();	
		$datai = array( 
			'credit_uses_for' => $credit_uses_for,
			'using_id' => $using_id,
			'uses_type' => $uses_type,
			'user_id' => $user_id
		);
		
		if(isset($CI->credit_id))
			$datai['credit_id'] = $CI->credit_id; 
		
		$CI->Common_model->commonInsert('credit_uses',$datai);
	}
	
	public function is_subscription_expires(){

		$CI =& get_instance();
		$user_type = $CI->session->userdata('user_type');
		
		if($user_type == 'admin')
		{
			return false;
		}
		else 
		{
			if($CI->is_subscription == 'Y')
			{
				$user_id = $CI->session->userdata('user_id');
				$subscription_credit = $this->get_credits_by_user_id($user_id,'subscription_credit');
				
				if($subscription_credit > time())
				{
					return true;
				}
				else
					return false;
			}
			
		}
		return false;
	}
	
	public function check_credit_used($uses_for ,  $using_id,$uses_type){

		$CI =& get_instance();	
		$result = $CI->Common_model->commonQuery("select * from credit_uses where credit_uses_for = '$uses_for' and  
										using_id = $using_id and 
										uses_type = '$uses_type'");
		if($result->num_rows() > 0)
			return true;
		else
			return false;
	}
	
		
	
	public function get_credits_by_user_id($user_id,$slug){

		$CI =& get_instance();	
		$CI->load->library('Global_lib');	
		$ret_val = $CI->global_lib->get_user_meta($user_id,$slug);
		if(empty($ret_val))
			$ret_val = 0;
		return $ret_val;
	}
	
	public function get_credit_id_by_user_id($user_id, $credit_for, $credit_type ){

		$CI =& get_instance();	
		
		
		$cur_time = time();
		$credits_result = $CI->Common_model->commonQuery("select * from credits  
							where user_id = $user_id and 
							status='Active' and 
							updated_credit > 0 and
							credit_for='$credit_for' and 
							credit_type='$credit_type' and 	
							(credit_expires= 0 or credit_expires > $cur_time)
							ORDER BY credit_id ASC
							limit 1  ");
		
		$credit_id = 0;	
		if($credits_result->num_rows() > 0)
		{
			$credits_row = $credits_result->row();
			$credit_id = $credits_row->credit_id;
		}	
		 return $credit_id;
		
		
	}
	
	public function update_credits_updated_credit_for_user($credit_id ){

		$CI =& get_instance();	
		
		
		$cur_time = time();
		$credits_result = $CI->Common_model->commonQuery("update credits  
							set updated_credit = (updated_credit - 1)
							where credit_id = $credit_id ");
	}
	
	
	public function update_credits_by_user_id($user_id,$slug,$action = '',$action_val = 1){

		$CI =& get_instance();	
		$CI->load->library('Global_lib');
		$ret_val = $CI->global_lib->get_user_meta($user_id,$slug);
		if($ret_val != ''  )	
		{
			if($action == 'minus_credit')
			{
				$CI->Common_model->commonQuery("UPDATE user_meta set meta_value = meta_value - $action_val where user_id = $user_id and meta_key = '$slug'");
			}
			else if($action == 'add_credit')
			{
				$CI->Common_model->commonQuery("UPDATE user_meta set meta_value = meta_value + $action_val where user_id = $user_id and meta_key = '$slug'");
			}
			
		}else {
			$this->update_user_meta_credit($user_id, $slug , $action_val);
			
		}
	}
	
	public function get_features_by_package_id_old($id){

		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from package_features where package_id = '$id'");	

		$pkg = $CI->Common_model->commonQuery("select * from packages where package_id = '$id'");	

		if($query->num_rows()>0){		
			$output = '';
			foreach($query->result() as $key=>$row)
			{	
				if($row->feature_for === 'wedding_site'){
					$output ='<div class="wrapper subscription">
						<div class="ribbon-wrapper-green"><div class="ribbon-green">'.ucfirst($pkg->row()->package_type).'</div></div></div>';
					$output .= '<h4 class="text-center">'.ucfirst($row->feature_for).'</h4>';
						
					$subs = explode('-',$row->feature_type);
					$output .= $row->feature_value.' ';
					$life='';
					if($subs[0] == 'daily'){
						if($row->feature_value == 1){
							$life = 'Day';
						}else{
							$life = 'Daily';
						}
					}elseif($subs[0] == 'weekly'){
						if($row->feature_value == 1){
							$life = 'Week';
						}else{
							$life = 'weekly';
						}
						$life = 'Months';
					}elseif($subs[0] == 'monthly'){
						if($row->feature_value == 1){
							$life = 'Month';
						}else{
							$life = 'monthly';
						}
					}elseif($subs[0] == 'yearly' && $row->feature_value == 1){
						if($row->feature_value == 1){
							$life = 'Year';
						}else{
							$life = 'Yearly';
						}
					}

					$output .= $life.' '.ucwords($subs[1]).'<br/>';
					
				}
				
				$output .= '<ul class="nav nav-stacked"> ';
				
				if($row->feature_type == 'wedding_site'){
					
					$output .= $row->feature_type.'<br/>';
					$output .= $row->feature_value;
				}
				elseif($row->feature_type == 'post_property'){
					$output ='<div class="wrapper">
						<div class="ribbon-wrapper-orange">
						<div class="ribbon-orange">'.ucfirst($pkg->row()->package_type).'
						</div>
						</div>
						</div>';
						$output .= '<li><a href="#">'.ucfirst($pkg->row()->package_type).'<span class="pull-right badge bg-blue">'.$row->feature_value.'</span></a></li>';
				}elseif($row->feature_type == 'featured_property'){
					$output ='<div class="wrapper">
						<div class="ribbon-wrapper-orange">
						<div class="ribbon-orange">'.ucfirst($pkg->row()->package_type).'
						</div>
						</div>
						</div>';
					$output .= '<li><a href="#">'.ucfirst($pkg->row()->package_type).'<span class="pull-right badge bg-blue">'.$row->feature_value.'</span></a></li>';
				}elseif($row->feature_type == 'post_blog'){
					$output ='<div class="wrapper">
						<div class="ribbon-wrapper-orange">
						<div class="ribbon-orange">'.ucfirst($pkg->row()->package_type).'
						</div>
						</div>
						</div>';
					$output .= '<li><a href="#">'.ucfirst($pkg->row()->package_type).'<span class="pull-right badge bg-blue">'.$row->feature_value.'</span></a></li>';
				}elseif($row->feature_type == 'urgent_property'){
					$output ='<div class="wrapper">
						<div class="ribbon-wrapper-orange">
						<div class="ribbon-orange">'.ucfirst($pkg->row()->package_type).'
						</div>
						</div>
						</div>';
					$output .= '<li><a href="#">'.ucfirst($pkg->row()->package_type).'<span class="pull-right badge bg-blue">'.$row->feature_value.'</span></a></li>';
				}
				
				
			}
			$output .= '</ul>';
			echo $output;
		}
		else{
			return false;
		}
	}
	

	public function get_features_by_package_id($id){

		$CI =& get_instance();
		$query = $CI->Common_model->commonQuery("select * from package_features where package_id = '$id'");	

		$pkg = $CI->Common_model->commonQuery("select * from packages where package_id = '$id'");	

		$package_features = array();
		/*
		$package_features['subscription'] = array( 'title'=> 'Subscription', 'details'=> '',);
		$package_features['post_property'] = array( 'title'=> 'Property Posting', 'details'=> '',);
		$package_features['featured_property'] = array( 'title'=> 'Featured Property Posting', 'details'=> '',);
		$package_features['post_blog'] = array( 'title'=> 'Blog Posting', 'details'=> '',);
		*/
		$package_features['wedding_site'] = array( 'title'=> 'Wedding Site', 'details'=> '',);
		
		
		if($query->num_rows()>0){		
			$output = '';
			foreach($query->result() as $key=>$row)
			{	
				$details = '';
				if($row->feature_for === 'wedding_site'){
					
					$life = $lifetime = '';
					$lifetime =  $row->feature_value ;
					
					$subs = explode('-',$row->feature_type);
					if($subs[0] == 'daily'){
						if($row->feature_value == 1){
							$life = 'Day';
						}else{
							$life = 'Days';
						}
					}elseif($subs[0] == 'weekly'){
						if($row->feature_value == 1){
							$life = 'Week';
						}else{
							$life = 'weeks';
						}
						
					}elseif($subs[0] == 'monthly'){
						if($row->feature_value == 1){
							$life = 'Month';
						}else{
							$life = 'months';
						}
					}elseif($subs[0] == 'yearly' ){
						if($row->feature_value == 1){
							$life = 'Year';
						}else{
							$life = 'Years';
						}
					}

					$package_features['wedding_site']['details'] = $lifetime . " ". $life;
					
					
				}
				
				/*
				if($row->feature_type == 'post_property'){
					$package_features['post_property']['details'] = $row->feature_value ;
				}elseif($row->feature_type == 'featured_property'){
					$package_features['featured_property']['details'] = $row->feature_value ;
				}elseif($row->feature_type == 'post_blog'){
					$package_features['post_blog']['details'] = $row->feature_value ;
				}
				else
					*/
				if($row->feature_type == 'wedding_site'){
					$package_features['wedding_site']['details'] = $row->feature_value ;
				}
				
			}
			
			
		}
		return $package_features;
	}
	
	public function create_credits($package_id,$transaction_id,$user_id,$transaction_status = 'Pending'){

		$CI =& get_instance();	
		$package_features = $CI->Common_model->commonQuery("select * from package_features where package_id = '$package_id'");
		$package = $CI->Common_model->commonQuery("select * from packages where package_id = '$package_id'");	
		
		$cur_time = time();
		$credit_expires = 0;
		$package_life =  $package->row()->package_life;
		$credit_expires = strtotime("+".$package_life);
		if($credit_expires == $cur_time)
			$credit_expires = 0;

		foreach ($package_features->result() as $data) {
				
				$credit_type = $data->feature_type;
				$credit_value = $data->feature_value;
				$credit_for = $data->feature_for;
				if($data->feature_for == 'subscription'){
					$ftype = $data->feature_type;
					$fvalue = $data->feature_value;
					
					if($ftype == 'daily-subscription'){
						$credit_expires = strtotime("+".$fvalue . " days");
						
					}elseif($ftype == 'weekly-subscription'){
						$credit_expires = strtotime("+".$fvalue . " weeks");
						
					}elseif($ftype == 'monthly-subscription'){
						$credit_expires = strtotime("+".$fvalue . " months");
						
					}elseif($ftype == 'yearly-subscription'){
						$credit_expires = strtotime("+".$fvalue . " years");
						
					}
					$credit_for = $credit_type = "subscription";
					$diff = $credit_expires - $cur_time; 
					$credit_value =  abs(round($diff / 86400)); 
					
				}
				$datai = array( 			
					'transaction_id' =>  $transaction_id,
					'credit_type' => $credit_type,
					'updated_credit' => $credit_value,
					'credit_value' => $credit_value,
					'user_id' => $user_id,	
					'credit_expires' => $credit_expires,	

					'credit_for' => $credit_for,
					'status'=>$transaction_status,								
					'created_at' => $cur_time,
					'updated_at'=>$cur_time,
				);	
				$creadit_id = $CI->Common_model->commonInsert('credits',$datai);
			}
			if($creadit_id >0){
				return $creadit_id;
			}else{
				return 'something went wrong';
			}		
	}
	
	
	public function update_user_credit_while_login(){
		$CI =& get_instance();
		$user_type = $CI->session->userdata('user_type');
		$user_id = $CI->session->userdata('user_id');
		
	}
	
	 public function get_total_credits($user_id){
		$CI =& get_instance();

		if(empty($user_id)){
			return 0;
		}else{
			
			$total_credits = $CI->Common_model->commonQuery("select sum(meta_value) as total_credits from user_meta where user_id=$user_id 
			and ( meta_key like '%_credit') and meta_key != 'subscription_credit' ");
			if($total_credits->num_rows()>0){
				return $total_credits->row()->total_credits;
			}else{
				return 0;
			}
		}
		
	 }
	

	public function update_user_meta_credit($user_id, $credit_type , $credit_value){
		
		$CI =& get_instance();	
		$CI->load->library('Global_lib');
		
		
		$user_meta_get = $CI->Common_model->commonQuery('select * from user_meta where user_id='.$user_id.
					' and meta_key="'.$credit_type.'"  ');
		
		
		if($user_meta_get->num_rows() == 0){
			
			
			$datai = array( 			
					'meta_key' =>  $credit_type ,
					'meta_value' => $credit_value,
					'user_id' => $user_id,	
				);	
			$user_meta_id = $CI->Common_model->commonInsert('user_meta',$datai);
		}else{
			
			
					
				$CI->Common_model->commonQuery("UPDATE user_meta set meta_value = '$credit_value'
								where user_id = $user_id and meta_key = '".$credit_type."'");
			
		}
	
	}
	
	public function update_user_meta_credit_changed($user_id, $credit_type , $credit_value){
		
		$CI =& get_instance();	
		$CI->load->library('Global_lib');
		
		
		$user_meta_get = $CI->Common_model->commonQuery('select * from user_meta where user_id='.$user_id.
					' and meta_key="'.$credit_type.'_credit"  ');
			
		if($user_meta_get->num_rows() == 0){
			
			
			$datai = array( 			
					'meta_key' =>  $credit_type . "_credit",
					'meta_value' => $credit_value,
					'user_id' => $user_id,	
				);	
			$user_meta_id = $CI->Common_model->commonInsert('user_meta',$datai);
		}else{
			
			
			if($credit_type != 'subscription')
			{
				$CI->package_lib->update_credits_by_user_id($user_id,$credit_type.'_credit','add_credit',$credit_value);
			}else{
				
				$CI->Common_model->commonQuery("UPDATE user_meta set meta_value = '$credit_value'
								where user_id = $user_id and meta_key = '".$credit_type."_credit'");
				
			}
			
		}
	
	}
	
	
	
	
}
