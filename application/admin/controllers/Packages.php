<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends MY_Controller {
	
	public $_api_context;
	
	function __construct() {
        parent::__construct();
        if(!$this->isLogin())
		{
			redirect('/logins','location');
		}
		$CI =& get_instance();		
		$this->load->library('Global_lib');	
		$CI =& get_instance();	
		
    }
	
	public function index()	
	{		
		$this->manage();	
	}
	
	public function manage()	
	{		
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
		$this->load->library('Global_lib');		
						
		$data = $this->global_lib->uri_check();		
		
		$data['myHelpers']=$this;		
		$this->load->model('Common_model');		
		$this->load->helper('text');						
		$data['query'] = $this->Common_model->commonQuery("select * from packages order by package_id DESC");					
		$data['theme']=$theme;				
		$data['content'] = "$theme/packages/manage";				
		$this->load->view("$theme/header",$data);			
	}
	
	
	public function change($t_id=null){
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
		$this->load->library('Global_lib');		
		$this->load->library('Package_lib');
		$data = $this->global_lib->uri_check();		
		$data['myHelpers']=$this;		
		$this->load->model('Common_model');		
		$this->load->helper('text');
		
		$user_credit_types = array("post_property_credit","post_blog_credit","featured_property_credit","subscription_credit");
		
		if(isset($_POST['submit'])){
			extract($_POST,EXTR_OVERWRITE);	
			$decId = $this->DecryptClientId($t_id);
			 $uid = $user_id;
			$datai = array( 			
				'status' => $status,									
			);
			$this->Common_model->commonUpdate('transaction',$datai,'transaction_id',$decId);
			if($status == 'Completed'){

				$package_info = $this->Common_model->commonQuery('select * from packages where package_id='.$package_id);
				if($package_info->num_rows() == 0) 
					return false;
				
				$cur_time = time();
				$datai = array( 			
					'status' => 'Active',
					'updated_at' => $cur_time,									
				);
				$this->Common_model->commonUpdate('credits',$datai,'transaction_id',$decId);
				
				$package_features_info = $this->Common_model->commonQuery('select * from package_features where package_id='.$package_id);
				
				$credit_expires = 0;
				$package_life =  $package_info->row()->package_life;
				$credit_expires = strtotime("+".$package_life);
				if($credit_expires == $cur_time)
					$credit_expires = 0;
				
				
				foreach ($package_features_info->result() as $package_feature) {
					$credit_type = $package_feature->feature_type;
					$credit_value = $package_feature->feature_value;
					$credit_for = $package_feature->feature_for;
					
					if($package_feature->feature_for == 'subscription'){
						$ftype = $package_feature->feature_type;
						$fvalue = $package_feature->feature_value;
						
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
						
						$credit_value = $credit_expires;
					}
					
					if($credit_type == 'subscription'){
						
						$credit_type_var = $credit_type . "_credit";
						$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credit_value);
						
						$credit_type_var = $credit_type . "_credited";
						$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $cur_time);
					}else 
					{
						$credit_type_var = $credit_type . "_credit";
						$this->package_lib->update_credits_by_user_id($user_id,
							$credit_type_var,'add_credit',$credit_value);
						
						
						
						$credited_val = $this->global_lib->get_user_meta($user_id  ,$credit_type_var);		
						
						$credit_type_var = $credit_type . "_credited";
						if(!$credited_val )
							$credited_val = $credit_value;
						
						$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credited_val);
					}	
				}	
				
			}

				
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		'.mlx_get_lang("Transaction Status Update Successfully").'		
		</div>	';				
		redirect('packages/transaction','location');							

		}						
		$decId = $this->DecryptClientId($t_id);		
		$data['transaction'] = $blog_meta =  $this->Common_model->commonQuery("select *from transaction where transaction_id = $decId ");

		$data['theme']=$theme;	
		$data['content'] = "$theme/packages/change_transaction";			
		$this->load->view("$theme/header",$data);

	}
	public function payment_methods()	
	{		
		$CI =& get_instance();
		$theme = $CI->config->item('theme') ;
		$this->load->library('Global_lib');
		
		$data = $this->global_lib->uri_check();
		$data['myHelpers']=$this;
		$this->load->model('Common_model');
		$this->load->helper('text');
		$payments_methods = $CI->config->item('payment_methods') ;
		
		if(isset($_POST['submit']) || isset($_POST['draft']))		
		{			
			extract($_POST,EXTR_OVERWRITE);				 								
			
			$user_id = $this->session->userdata('user_id');
			
			$content = array();
			
			foreach($_POST as $k=>$v)
			{
				if(is_array($v) && $k != 'submit')
					$content[$k] = $v;
			}
			
			foreach($_POST as $k=>$v)
			{
				$_POST[$k] = $this->security->xss_clean($v);
				$_POST[$k] = str_replace('[removed]','',$_POST[$k]);
			}
			
			
			$this->global_lib->update_option('payment_methods',json_encode($content));
			
			$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			'.mlx_get_lang("Payment Methods Updated Successfully").'
			</div>							';				
			redirect('/packages/payment_methods','location');										
			
		}
		
		$payments_methods_section = $this->global_lib->get_option('payment_methods');

		if(isset($payments_methods_section) && !empty($payments_methods_section))
		{
			$data['meta_content_lists'] = json_decode($payments_methods_section,true);
		}					
			$data['theme']=$theme;	

			$data['payment_methods']=$payments_methods;	

			$data['content'] = "$theme/packages/payment_methods";				
			$this->load->view("$theme/header",$data);			
	}
	public function transaction(){
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
		$this->load->library('Global_lib');		
						
		$data = $this->global_lib->uri_check();		
		
		$data['myHelpers']=$this;		
		$this->load->model('Common_model');		
		$this->load->helper('text');
								
		$data['query'] = $this->Common_model->commonQuery("select * from transaction order by transaction_id DESC");

		$data['theme']=$theme;	
		$data['content'] = "$theme/packages/transactions";			
		$this->load->view("$theme/header",$data);

	}
	
	
	 public function paypal(){

	 	$CI =& get_instance();		
	 	$theme = $CI->config->item('theme') ;				
	 	$this->load->library('Global_lib');		
	 	$this->load->library('Package_lib');
		$this->load->library('Paypal_lib');					
	 	$data = $this->global_lib->uri_check();		
	 	$data['myHelpers']=$this;		
	 	$this->load->model('Common_model');		
	 	$this->load->helper('text');
	 	$data['theme']=$theme;	
		
		if(isset($_POST['submit'])){
			extract($_POST);
			$post = $_POST;
					
			$res = $this->paypal_lib->createPayment($post);
			
			
		}
		
	 	$data['content'] = "$theme/packages/paypal";			
	 	$this->load->view("$theme/header",$data);

	 }
	 
	 public function stripe($id=null){

	 	$CI =& get_instance();		
	 	$theme = $CI->config->item('theme') ;				
	 	$this->load->library('Global_lib');		
	 	$this->load->library('Package_lib');				
	 	$data = $this->global_lib->uri_check();		
	 	$data['myHelpers']=$this;		
	 	$this->load->model('Common_model');		
	 	$this->load->helper('text');
        $this->load->library('stripe_lib'); 
		$data['stripe_id'] =  $this->stripe_lib->get_stripe_id();
		
	 	$data['theme']=$theme;	
		extract($_POST);
		
		if(isset($_POST['item_id'])){
			
			$data['product'] = $_POST;
		}
        if($this->input->post('stripeToken')){
			extract($this->input->post());
            $postData = $this->input->post(); 
			$qry = $this->Common_model->commonQuery("select * from packages Where package_id=$package_id");
            $postData['product'] = $qry; 
            
			
            $paymentID = $this->payment($postData); 
            
            if($paymentID){ 
                redirect('packages/payment_status/'.$paymentID); 
            }else{ 
                $apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':''; 
                $data['error_msg'] = 'Transaction has been failed!'.$apiError; 
            } 
        }
		
	 	$data['content'] = "$theme/packages/stripe_payment_page";			
	 	$this->load->view("$theme/header",$data);

	 }

	public function getPaymentStatus()
    {
		
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
		$this->load->library('Global_lib');		
		$data = $this->global_lib->uri_check();		
		$data['myHelpers']=$this;		
		$this->load->model('Common_model');		
		$this->load->helper('text');
		
        $payment_id = $this->input->get("paymentId") ;
        $PayerID = $this->input->get("PayerID") ;
        $token = $this->input->get("token") ;
        if (empty($PayerID) || empty($token)) {
            $this->session->set_flashdata('success_msg','Payment failed');
            redirect('packages/choose_package');
        }
        $payment = Payment::get($payment_id,$this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input->get('PayerID'));

        $result = $payment->execute($execution,$this->_api_context);

        if ($result->getState() == 'approved') {
            $trans = $result->getTransactions();
			$user_id = $this->session->userdata('user_id');
			$itemList = $trans[0]->getItemList();
			
           $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
            $Tax = $trans[0]->getAmount()->getDetails()->getTax();

            $payer = $result->getPayer();
            $PaymentMethod =$payer->getPaymentMethod();
            $PayerStatus =$payer->getStatus();
            $PayerMail =$payer->getPayerInfo()->getEmail();

            $relatedResources = $trans[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
			$status = $relatedResources[0]->getSale()->getState();
            $saleId = $sale->getId();
            $CreateTime = $sale->getCreateTime();
            $UpdateTime = $sale->getUpdateTime();
            $State = $sale->getState();
            $Total = $sale->getAmount()->getTotal();
			$transaction_key = $this->package_lib->getToken(16);
			$res = array(
				'state' =>$State,
				'total' =>$Total,
				'subtotal' =>$Subtotal,
				'tax' =>$Tax,
				'payment_method' =>$PaymentMethod,
				'payer_status' =>$PayerStatus,
				'creation_time'=>$CreateTime,
			);
			$data['result'] = $res;
			$package_id = $this->session->userdata('package_id');
			
			$package_info = $this->Common_model->commonQuery('select * from packages where package_id='.$package_id);
			
			$details =[];
			foreach ($package_info->result() as $package_detail) {
				foreach ($package_detail as $key => $value) {
					$details[$key] = $value;
				}
			}
			$package_json_obj = json_encode($details);
			
			$paypal_transaction_id = $result->getId();
			$paypal_res = array(
				'paypal_trans_id' =>$paypal_transaction_id,
				'method'=>$PaymentMethod,
			);
			$paypal_reponse_obj = json_encode($paypal_res);
			$datai = array(
				'transaction_key' =>$transaction_key,
				'packages_id' =>$package_id,
				'package_detail' =>$package_json_obj,
				'user_id' =>$user_id,
				'payment_mode' =>$PaymentMethod,
				'transaction_meta' =>$paypal_reponse_obj,
				'transaction_amount' =>$Total,
				'transaction_date'=>strtotime($CreateTime),
				'status'=>ucfirst($status),
			);
			
			$transaction_id = $this->Common_model->commonInsert('transaction',$datai);
			
			if($status == 'completed'){
				
				if($package_info->num_rows() == 0) 
					return false;
				
				if($transaction_id >0){
					
					$res = $this->package_lib->create_credits($package_id,$transaction_id,$user_id,$transaction_status='Active');
				}
				$trans_type = $PaymentMethod;
				$transaction_type = 'Paid Via Paypal';
				$username = $this->global_lib->get_user_meta($user_id,'first_name');
				$trans_details = 'hi, Admin '.$username.' has been created order for '.$package_info->row()->package_name.' and its Price : '.$package_info->row()->package_price.' with payment method '.$PaymentMethod.'';
				$cur_time = time();
				$datalog = array( 			
					'transaction_id' =>$transaction_id,
					'trans_details' =>$trans_details,
					'trans_type' => $transaction_type,							
					'created_by' => $user_id,
					'created_on' => $cur_time,								
				);
				$log_id = $this->Common_model->commonInsert('transaction_logs',$datalog);
				
				$package_features_info = $this->Common_model->commonQuery('select * from package_features where package_id='.$package_id);
				
				
				$credit_expires = 0;
				$package_life =  $package_info->row()->package_life;
				$credit_expires = strtotime("+".$package_life);
				if($credit_expires == $cur_time)
					$credit_expires = 0;
				
				
				foreach ($package_features_info->result() as $package_feature) {
					$credit_type = $package_feature->feature_type;
					$credit_value = $package_feature->feature_value;
					$credit_for = $package_feature->feature_for;
					if($package_feature->feature_for == 'subscription'){
						$ftype = $package_feature->feature_type;
						$fvalue = $package_feature->feature_value;
						
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
						$credit_value = $credit_expires;
					}
					$credit_type_var = $credit_type . "_credit";
					$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credit_value);
					
					if($credit_type == 'subscription'){

						$credit_type_var = $credit_type . "_credit";
						$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credit_value);

						$credit_type_var = $credit_type . "_credited";
						$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $cur_time);
					}else {
						$credit_type_var = $credit_type . "_credit";
						$this->package_lib->update_credits_by_user_id($user_id,
							$credit_type_var,'add_credit',$credit_value);

						$credited_val = $this->global_lib->get_user_meta($user_id  ,$credit_type_var);		

						$credit_type_var = $credit_type . "_credited";
						if(!$credited_val )
							$credited_val = $credit_value;

						$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credited_val);
					}
				}
			}
				
           
            $this->session->set_flashdata('msg','Payment success');
			$this->session->unset_userdata('id');
			$data['theme']=$theme;	
			$data['content'] = "$theme/packages/paypal/success";			
			$this->load->view("$theme/header",$data);
        }else{
			$this->session->set_flashdata('msg','Payment failed');
			$data['theme']=$theme;	
			$data['content'] = "$theme/packages/paypal/cancel";			
			$this->load->view("$theme/header",$data);
		}
		
	}
	 
    function payment($postData){ 
        
        if(!empty($postData)){ 
				
            $token  = $postData['stripeToken']; 
            $name = $postData['name']; 
            $email = $postData['email']; 		
            $address =  [
						'line1' => 'Behind Post office',
						'postal_code' => '334004',
						'city' => 'bikaner',
						'state' => 'RAJ',
						'country' => 'IN',
						];
						
            	$customer = $this->stripe_lib->addCustomer($email, $token,$name,$address); 
             
			 $itemName='';
			 $itemPrice='';
			 $itemCurrency='';
			 $user_id = $postData['user_id'];
			 
			 foreach ($postData['product']->result() as $Item){
				$package_id = $Item->package_id;
				$itemName = $Item->package_name;
				$itemPrice = $Item->package_price;
				$itemCurrency = $Item->package_currency;
				}
            if($customer){ 
                $charge = $this->stripe_lib->createCharge($customer->id, $itemName, $itemPrice,$itemCurrency); 
                
                if($charge){ 
				
                    if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){ 
                        
						 $transactionID = $charge['balance_transaction']; 
                        $paidAmount = $charge['amount']; 
                        $paidAmount = ($paidAmount/100); 
                        $paidCurrency = $charge['currency']; 
                        $payment_status = $charge['status']; 
                         
                        $transaction_key = $this->package_lib->getToken(16);	
						$details =[];
						foreach ($postData['product']->result() as $package_detail) {
							foreach ($package_detail as $key => $value) {
								$details[$key] = $value;
							}
						}
						
						$stripe_reponse_obj = json_encode($charge);
						$package_json_obj = json_encode($details);
						$curr_time = time();
						
                        $datai = array( 
							'transaction_key'=>$transaction_key,
							'packages_id'=>$package_id,
							'package_detail'=>$package_json_obj,
							'user_id'=>$user_id,
							'payment_mode'=>'stripe',
							'transaction_meta'=>$stripe_reponse_obj,
							'transaction_amount'=>$paidAmount,
							'transaction_date'=>$curr_time,
							'status'=>ucfirst('Completed'),
							
                        ); 
						
                        $transaction_id = $this->Common_model->commonInsert('transaction',$datai);
                        
                        if($payment_status == 'succeeded'){ 
						
							if($transaction_id >0){
					
									$res = $this->package_lib->create_credits($package_id,$transaction_id,$user_id,$transaction_status='Active');
								}
								
								$trans_type = 'Stripe';
								$transaction_type = 'Paid Via Stripe';
								$username = $this->global_lib->get_user_meta($user_id,'first_name');
								$trans_details = 'hi, Admin '.$username.' has been created order for '.$itemName.' and its Price : '.$itemPrice.' with payment method Stripe';
								$cur_time = time();
								$datalog = array( 			
									'transaction_id' =>$transaction_id,
									'trans_details' =>$trans_details,
									'trans_type' => $transaction_type,							
									'created_by' => $user_id,
									'created_on' => $cur_time,								
								);
								$log_id = $this->Common_model->commonInsert('transaction_logs',$datalog);
							
							
								$package_features_info = $this->Common_model->commonQuery('select * from package_features where package_id='.$package_id);
				
								$package_info=$postData['product'];
								$credit_expires = 0;
								$package_life =  $package_info->row()->package_life;
								$credit_expires = strtotime("+".$package_life);
								if($credit_expires == $cur_time)
									$credit_expires = 0;
								
								
								foreach ($package_features_info->result() as $package_feature) {
									$credit_type = $package_feature->feature_type;
									$credit_value = $package_feature->feature_value;
									$credit_for = $package_feature->feature_for;
									if($package_feature->feature_for == 'subscription'){
										$ftype = $package_feature->feature_type;
										$fvalue = $package_feature->feature_value;
										
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
										$credit_value = $credit_expires;
									}
									$credit_type_var = $credit_type . "_credit";
									$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credit_value);
									
									if($credit_type == 'subscription'){

										$credit_type_var = $credit_type . "_credit";
										$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credit_value);

										$credit_type_var = $credit_type . "_credited";
										$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $cur_time);
									}else {
										$credit_type_var = $credit_type . "_credit";
										$this->package_lib->update_credits_by_user_id($user_id,
											$credit_type_var,'add_credit',$credit_value);

										$credited_val = $this->global_lib->get_user_meta($user_id  ,$credit_type_var);		

										$credit_type_var = $credit_type . "_credited";
										if(!$credited_val )
											$credited_val = $credit_value;

										$this->package_lib->update_user_meta_credit( $user_id, $credit_type_var , $credited_val);
									}
									
								}
								
							 $this->session->set_flashdata('msg','Payment success');
                            return $transaction_id; 
                        } 
                    } 
                } 
            } 
        } 
        return false; 
    } 
     
    function payment_status($id){ 
		$CI =& get_instance();		
	 	$theme = $CI->config->item('theme') ;				
	 	$this->load->library('Global_lib');		
	 	$this->load->library('Package_lib');				
	 	$data = $this->global_lib->uri_check();		
	 	$data['myHelpers']=$this;		
	 	$this->load->model('Common_model');		
	 	$this->load->helper('text');
        $this->load->library('stripe_lib'); 
		$data['stripe_id'] =  $this->stripe_lib->get_stripe_id();
		
	 	$data['theme']=$theme;
       
        $qry =  $this->Common_model->commonQuery("select * from transaction Where transaction_id=$id"); 
		$order = $qry->row(); 
        $data['order'] = $order; 
		$data['content'] = "$theme/packages/stripe/payment-status";			
	 	$this->load->view("$theme/header",$data);
    }
	
	function my_payments(){
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
		$this->load->library('Global_lib');		
		$data = $this->global_lib->uri_check();		
		$data['myHelpers']=$this;		
		$this->load->model('Common_model');		
		$this->load->helper('text');						
						
		$data['theme']=$theme;				
		$data['content'] = "$theme/packages/my_payments";				
		$this->load->view("$theme/header",$data);
	}
	
	
	public function add_new()	
	{				
						
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
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
			
			
			extract($_POST,EXTR_OVERWRITE);		
			
			if(empty($user_id) || $user_id == 0)				
			{						
				$_SESSION['msg'] = '<p class="error_msg">'.mlx_get_lang("Session Expired").'</p>';					
				$_SESSION['logged_in'] = false;						
				$this->session->set_userdata('logged_in', false);					
				redirect('/logins','location');				
			}
			
			
			$applicabled_for ='';	
			if(!empty($user_types)){
				$applicabled_for = implode(',',$user_types);
			}
			if(empty($applicabled_for)){
				$applicabled_for = 'all';
			}

			$pacakge_type = 'wedding_site';
			/*
			if(isset($feature) && isset($feature['is_subscription']['enable'])){
				$pacakge_type = 'subscription';
			}
			*/
			//echo "<pre>"; print_r($_POST); exit;
				$cur_time = time();
				$datai = array( 			
						'package_name' => $package,									
						'package_price' => $packages_price,
						'package_currency' => $currency_code,
						'package_life' => $package_lifetime,
						'package_type' => $pacakge_type,									
						'applicable_for' =>$applicabled_for,
						'purchase_limit' => $limit_purchase_by_user,							
						'purchase_button_text' => $purchase_button_text,
						'package_order' => $package_order,								
						// 'is_default' => $is_default,
						'created_at'=>$cur_time,
						'updated_at'=>$cur_time
					);
				
				$package_id = $this->Common_model->commonInsert('packages',$datai);
				
				if(isset($feature) && !empty($feature)){
					
					foreach($feature as $k=>$v)
					{
						
						if($k == 'is_subscription'  && isset($v['enable']))
						{
							
							$exp_sv = explode(' ',$v['subscription_validity']);
							
							if(count($exp_sv) > 1)
							{
								if($exp_sv[1] == 'days'){
									$exp_sv[1] = 'daily-subscription';
									
								}elseif($exp_sv[1] == 'weeks'){
									$exp_sv[1] = 'weekly-subscription';
									
								}elseif($exp_sv[1] == 'months'){
									$exp_sv[1] = 'monthly-subscription';
									
								}elseif($exp_sv[1] == 'year'){
									$exp_sv[1] = 'yearly-subscription';
									
								}
								$datai = array( 			
									'package_id' => $package_id,									
									'feature_for' => 'subscription',
									'feature_type' => strtolower($exp_sv[1]),
									'feature_value' => $exp_sv[0]
								);
								$this->Common_model->commonInsert('package_features',$datai);
								
							}
						}
						else if($k == 'property'  && isset($v['enable']))
						{
							
							if(isset($v['post_property']) && !empty($v['post_property']))
							{
								$datai = array( 			
									'package_id' => $package_id,									
									'feature_for' => 'property',
									'feature_type' => 'post_property',
									'feature_value' => $v['post_property']
								);
								$this->Common_model->commonInsert('package_features',$datai);
							}
							if(isset($v['featured_property']) && !empty($v['featured_property']))
							{
								$datai = array( 			
									'package_id' => $package_id,									
									'feature_for' => 'property',
									'feature_type' => 'featured_property',
									'feature_value' => $v['featured_property']
								);
								$this->Common_model->commonInsert('package_features',$datai);
							}
							if(isset($v['urgent_property']) && !empty($v['urgent_property']))
							{
								$datai = array( 			
									'package_id' => $package_id,									
									'feature_for' => 'property',
									'feature_type' => 'urgent_property',
									'feature_value' => $v['urgent_property']
								);
								$this->Common_model->commonInsert('package_features',$datai);
							}
						}
						else if($k == 'blog'  && isset($v['enable']))
						{
							$datai = array( 			
								'package_id' => $package_id,									
								'feature_for' => 'blog',
								'feature_type' => 'post_blog',
								'feature_value' => $v['post_blog']
							);
							$this->Common_model->commonInsert('package_features',$datai);
						}else if($k=='wedding_site' && isset($v['enable'])){
							$datai = array( 			
								'package_id' => $package_id,									
								'feature_for' => 'wedding_site',
								'feature_type' => 'number_of_sites',
								'feature_value' => $v['nof_site']
							);
							$this->Common_model->commonInsert('package_features',$datai);
						}
						
					}
				}
				
				
			$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" style="margin-top:10px;margin-bottom:0px;">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			'.mlx_get_lang("Package Added Successfully").'
			</div>							';				
			redirect('packages/manage','location');										
			
		}						
		
		$data['currency_symbols'] = $CI->config->item('currency_symbols') ;
		
		$data['theme']=$theme;				
		$data['content'] = "$theme/packages/add_new";				
		$this->load->view("$theme/header",$data);			
	}		
	
	
	public function edit($b_id = NULL)	
	{		
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
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
			
				extract($_POST,EXTR_OVERWRITE);								
				
				
				$decId = $this->DecryptClientId($b_id);
				
				$applicabled_for ='';	
				if(!empty($user_types)){
					$applicabled_for = implode(',',$user_types);
				}
				if(empty($applicabled_for)){
					$applicabled_for = 'all';
				}
				
				$package_type = 'wedding_site';
				/*
				if(isset($feature) && isset($feature['is_subscription']['enable'])){
					$package_type = 'subscription';
				}
				*/
				$cur_time = time();
				$datai = array( 			
						'package_name' => $package,									
						'package_price' => $packages_price,
						'package_currency' => $currency_code,
						'package_life' => $package_lifetime,
						'package_type' => $package_type,									
						'applicable_for' =>$applicabled_for,
						'purchase_limit' => $limit_purchase_by_user,							
						'purchase_button_text' => $purchase_button_text,
						'package_order' => $package_order,		
						'updated_at'=>$cur_time
					);	

				$this->Common_model->commonUpdate('packages',$datai,'package_id',$decId);				
				
				$this->Common_model->commonDelete('package_features',$decId,'package_id' );		
				
				if(isset($feature) && !empty($feature)){
					
					foreach($feature as $k=>$v)
					{
						
						if($k == 'is_subscription' && isset($v['enable']) )
						{
							$exp_sv = explode(' ',$v['subscription_validity']);
							/*print_r($exp_sv);
							exit;*/
							if(count($exp_sv) > 1)
							{
								if($exp_sv[1] == 'days'){
									$exp_sv[1] = 'daily-subscription';
								}elseif($exp_sv[1] == 'weeks'){
									$exp_sv[1] = 'weekly-subscription';
								}elseif($exp_sv[1] == 'months'){
									$exp_sv[1] = 'monthly-subscription';
								}elseif($exp_sv[1] == 'year'){
									$exp_sv[1] = 'yearly-subscription';
								}
								$datai = array( 			
									'package_id' => $decId,									
									'feature_for' => 'subscription',
									'feature_type' => strtolower($exp_sv[1]),
									'feature_value' => $exp_sv[0]
								);
								$this->Common_model->commonInsert('package_features',$datai);
							}

							
						}
						else if($k == 'property' && isset($v['enable']) )
						{
							if(isset($v['post_property']) && !empty($v['post_property']))
							{
								$datai = array( 			
									'package_id' => $decId,									
									'feature_for' => 'property',
									'feature_type' => 'post_property',
									'feature_value' => $v['post_property']
								);
								$this->Common_model->commonInsert('package_features',$datai);
							}
							if(isset($v['featured_property']) && !empty($v['featured_property']))
							{
								$datai = array( 			
									'package_id' => $decId,									
									'feature_for' => 'property',
									'feature_type' => 'featured_property',
									'feature_value' => $v['featured_property']
								);
								$this->Common_model->commonInsert('package_features',$datai);
							}
							if(isset($v['urgent_property']) && !empty($v['urgent_property']))
							{
								$datai = array( 			
									'package_id' => $decId,									
									'feature_for' => 'property',
									'feature_type' => 'urgent_property',
									'feature_value' => $v['urgent_property']
								);
								$this->Common_model->commonInsert('package_features',$datai);
							}
						}
						else if($k == 'blog' && isset($v['enable']) )
						{
							$datai = array( 			
								'package_id' => $decId,									
								'feature_for' => 'blog',
								'feature_type' => 'post_blog',
								'feature_value' => $v['post_blog']
							);
							$this->Common_model->commonInsert('package_features',$datai);
						}else if($k=='wedding_site' && isset($v['enable'])){
							$datai = array( 			
								'package_id' => $decId,									
								'feature_for' => 'wedding_site',
								'feature_type' => 'number_of_sites',
								'feature_value' => $v['nof_site']
							);
							$this->Common_model->commonInsert('package_features',$datai);
						}
						
					}
				}
				
				$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable"  style="margin-top:10px;margin-bottom:0px;">	
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>		
				'.mlx_get_lang("Package Updated Successfully").'
				</div>							';	
				redirect('/packages/manage','location');				
			}

		$decId = $this->DecryptClientId($b_id);		
		$data['blog_meta'] = $blog_meta =  $this->Common_model->commonQuery("select *from packages where package_id = $decId ");
		
		
		if($blog_meta->num_rows() == 0)
		{
			$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable" style="margin-top:10px;margin-bottom:0px;">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			'.mlx_get_lang("Invalid Packages").'
			</div>							';				
			redirect('/packages/manage','location');
		}
		
		$data['currency_symbols'] = $CI->config->item('currency_symbols') ;
		$data['theme']=$theme;				
		$data['content'] = "$theme/packages/edit";			
		$this->load->view("$theme/header",$data);
	}	
	
	public function delete($rowid)	
	{								
		$CI =& get_instance();		
		$this->load->library('Global_lib');		
		if(!is_array($rowid))			
			$rowid	= $this->global_lib->DecryptClientId($rowid);		
		$this->load->model('Common_model');				
		$tbl='packages';		
		$pid='package_id';		
		$url='/packages/manage/';	 			
		$fld= mlx_get_lang("package");				
			
		$this->Common_model->commonDelete('package_features',$rowid,'package_id' );		
			
		$rows= $this->Common_model->commonDelete($tbl,$rowid,$pid );					
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" style="margin-top:10px;margin-bottom:0px;">								
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>																
		'.$rows.' '.$fld.' '.mlx_get_lang("Deleted Successfully").'							
		</div>							';		
		redirect($url,'location','301');		
	}
	
	public function choose_package($package_type=''){
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
		$this->load->library('Global_lib');
		$this->load->library('Package_lib');		
						
		$data = $this->global_lib->uri_check();		
		
		$data['myHelpers']=$this;		
		$this->load->model('Common_model');		
		$this->load->helper('text');
		$uid = $this->session->userdata('user_id');
		
		
		$member_type = $this->session->userdata('user_type');	
		
		if($package_type == 'wedding_site'){
			
			$data['query'] = $this->Common_model->commonQuery("select * from packages where applicable_for LIKE '%$member_type%' 
				or applicable_for='all' ");
			
		}else{

			if($package_type == 'topup')
			{	$query = "select * from packages as pk 
				Where pk.package_type = 'topup' and
				pk.applicable_for LIKE '%$member_type%' or pk.applicable_for='all' ";

			}else{
				$query = "select * from packages as pk 
				where pk.applicable_for LIKE '%$member_type%' or pk.applicable_for='all' ";
			}
			
			$data['query'] = $this->Common_model->commonQuery($query);
		}

		$data['theme']=$theme;	
		$data['content'] = "$theme/packages/choose_package";			
		$this->load->view("$theme/header",$data);
	}

}
