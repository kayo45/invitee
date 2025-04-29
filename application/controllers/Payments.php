<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . "libraries/PayPal-PHP-SDK/paypal/rest-api-sdk-php/sample/bootstrap.php");
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;

class Payments extends MY_Controller {
	
	public function index(){ 
		
		$this->load->model('Common_model');
		$CI =& get_instance();
		
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		$this->load->helper('text');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		
		$data['theme']=$theme;
		if(isset($_GET['p']) && !empty($_GET['p'])){
			$payment_args = $_GET['p'];
			$payment_args = $this->global_lib->base64url_decode($payment_args);
		}else{
			redirect(base_url());
		}
		$payment_arg_lists = explode('&',$payment_args);
		
		foreach($payment_arg_lists as $payment_arg){
			$pa = explode("=",$payment_arg);
			if(isset($pa[0]) && isset($pa[1]))
				${$pa[0]}=$pa[1];
			
		}
		$product_arr = array();
		$product_id ='';
		
		$product_arr['title'] = '';
		$product_arr['price'] = 0;
		$product_arr['description'] = '';
		$product_id = 0;
		
		if(isset($package_id) && !empty($package_id)){
			$qry = $this->Common_model->commonQuery("select * from packages where package_id=$package_id");
			if($qry->num_rows() > 0){
					foreach($qry->result() as $row){
						if($row->package_price != 0){
							$product_arr['title'] = $row->package_name;
							$product_arr['price'] = $row->package_price;
							$product_arr['description'] = $row->package_name.$row->package_price;
							$product_id = $row->package_id;
						}else{
							$obj = array();
							$pacakge_id = $row->package_id;
							foreach($row  as $k=>$v){
								$obj[$k] = $v;
							}
							
							$user_information = array();
							$user_id =  $this->session->userdata('user_id');
							$user_mobile = $this->global_lib->get_user_meta($user_id,'mobile');
							$user_information['user_id'] = $user_id;
							$user_information['user_contact'] = $user_mobile;
							$user_data = $this->Common_model->commonQuery("select * from users where user_id=$user_id");
							if($user_data->num_rows()>0){
								foreach($user_data->result() as $row){
									$user_information['user_email'] = $row->user_email;
									$user_information['user_name']  = $row->user_name;
								}
							}
							
							$user_information['package_id'] = $pacakge_id;
							$user_information['package_obj'] = $obj;
							$user_information['package_type'] = 'free';
							echo $this->free_packages($user_information);
						}
					}
			}else{
				echo 'No Package Found';exit;
			}
		}
	
			if(isset($url) && !empty($url)){
				$data['post_url'] = $url;
			}
		$data['product'] = $product_arr;
		$data['payment_methods'] = $this->global_lib->get_option('payment_methods');
		$data['item_id'] = $product_id;
		$this->load->view("$theme/payment_getways/details",$data);
		
        
    }
	
	public function create_gift_sender($post=array()){
			
		$this->load->model('Common_model');
		$CI =& get_instance();
		$theme = $CI->config->item('theme');
		$this->load->library('Global_lib');
		$this->load->helper('text');
		$this->load->library('stripe_lib');
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		
		$data['theme']=$theme;
		
		
		extract($post);
		$sender_id='';
		
			if(!isset($_COOKIE['sender'])) {
				
				$transaction_id = $this->global_lib->getToken(16);	
					if($package_type == 'free'){
						/*
						$datai = array( 	
								
						'package_id' => $package_id,									
						'transaction_id' => $transaction_id,
						'name' => $user_name,
						'email' => $user_email,
						'contact_number' => $user_contact,									
						'payment_method' =>'free Package',
						'status' => 'Completed',	
						);
						$sender_id = $this->Common_model->commonInsert('package_buyer',$datai);
						*/
						
						$cook_array = array( 			
							'package_id' => $package_id,									
							'transaction_id' => $transaction_id,
							'name' => $user_name,
							'email' => $user_email,
							'contact_number' => $user_contact,									
							'payment_method' =>'free Package',
							'status' => 'pendding',	
							'currency_symbol'=>$package_obj['package_currency'],
							'price'=>$package_obj['package_price'],
							'total_price'=>$package_obj['package_price'],
							'description'=>$package_obj['package_name'],
							'price'=>$package_obj['package_price'],
							'product_name'=>$package_obj['package_name'],
						);
						
						$cook = json_encode($cook_array);
						setcookie('sender', $cook, time() + (86400 * 30), "/"); 
					}else{
						$datai = array( 			
						'gift_id' => $id,									
						'transaction_id' => $transaction_id,
						'name' => $sender_name,
						'email' => $sender_email,
						'contact_number' => $sender_contact,									
						'payment_method' =>$radios,
						'status' => 'Completed',	
						
						);
						$sender_id = $this->Common_model->commonInsert('gift_senders',$datai);
						
						$cook_array = array( 			
							'gift_id' => $id,									
							'transaction_id' => $transaction_id,
							'name' => $sender_name,
							'email' => $sender_email,
							'contact_number' => $sender_contact,									
							'payment_method' =>$radios,
							'status' => 'pendding',	
							'currency_symbol'=>$currency_symbol,
							'price'=>$price,
							'total_price'=>$total_price,
							'description'=>$description,
							'price'=>$price,
							'product_name'=>$product_name,
							
						);
						
							$cook = json_encode($cook_array);
						setcookie('sender', $cook, time() + (86400 * 30), "/"); 
					}
					
			}else {
				$cookie = json_decode($_COOKIE['sender']);
				
					if(isset($package_type) && $package_type == 'free'){
						$transaction_id = $cookie->transaction_id;
						$sender_id = $user_id;
					}else{
						$transaction_id = $cookie->transaction_id;
						$user_id = $this->session->userdata('user_id');
						$sender_id = $user_id;//$id;
					}
					
					
					
			}
			
				
				if($sender_id > 0){
					$arr = ['sender_id'=>$sender_id,
					'trans_id'=>$transaction_id,];
					return $arr;
				}else{
					return false;
				}
	}
	
    public function paypal(){

	 	$CI =& get_instance();	
		$theme = $CI->config->item('theme') ;		
	 	$this->load->library('Global_lib');		
		$this->load->library('Paypal_lib');					
	 	$data = $this->global_lib->uri_check();		
	 	$data['myHelpers']=$this;		
	 	$this->load->model('Common_model');		
	 	$this->load->helper('text');
		$data['theme']=$theme;
		
		
		$post = $_POST;	
		$post['from'] = 'user_to_owner';
		$res = $this->paypal_lib->createPayment($post);
		$data['content'] = "$theme/payment_methods/paypal";			
		$this->load->view("$theme/header",$data);
		

	 }
	
	public function paypal_success($post = array())
    {
		
		$CI =& get_instance();		
		$theme = $CI->config->item('theme') ;				
		$this->load->library('Global_lib');		
		$data = $this->global_lib->uri_check();		
		$data['myHelpers']=$this;		
		$this->load->model('Common_model');		
		$this->load->helper('text');
		
		$payment_methods = $CI->global_lib->get_option('payment_methods');
		$payment_method_paypal = json_decode($payment_methods);
		if($payment_method_paypal->payment_method_paypal_section->is_enable == 'Y'){
			
			if(!empty($payment_method_paypal->payment_method_paypal_section->paypal_client_id) &&
			!empty($payment_method_paypal->payment_method_paypal_section->paypal_client_secret)){
				
				
					$paypal_id = $payment_method_paypal->payment_method_paypal_section->paypal_client_id;
					
					$paypal_secret=$payment_method_paypal->payment_method_paypal_section->paypal_client_secret;
			}
		
		}
				
        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $paypal_id,$paypal_secret
            )
        );
		
        $payment_id = $this->input->get("paymentId") ;
        $PayerID = $this->input->get("PayerID") ;
        $token = $this->input->get("token") ;
        if (empty($PayerID) || empty($token)) {
            $this->session->set_flashdata('success_msg','Payment failed');
            redirect(base_url());
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
			$transaction_key = $this->global_lib->getToken(16);
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
						$posted_data  = json_decode($_SESSION['post_data'],true);
						
						$user_id = $this->session->userdata('user_id');
				
						$transaction_key = $this->global_lib->getToken(16);	
												
						$paypal_reponse_obj = json_encode($res);
						$product_json_obj = json_encode($posted_data);
						$curr_time = time();
						
                        $datai = array( 
							'transaction_key'=>$transaction_key,
							'product_id'=>$posted_data['id'],
							'product_detail'=>$product_json_obj,
							'user_id'=>$user_id,
							'payment_mode'=>$posted_data['radios'],
							'transaction_meta'=>$paypal_reponse_obj,
							'transaction_amount'=>$Total,
							'transaction_date'=>$curr_time,
							'status'=>ucfirst('Completed'),
							
                        ); 
						
                        $transaction_id = $this->Common_model->commonInsert('transaction',$datai);
                       
						if($status == 'completed'){ 
																
								$trans_type = 'Paypal';
								$transaction_type = 'Paid Via Paypal';
								$username = $this->global_lib->get_user_meta($user_id,'first_name');
								$trans_details = 'hi, Admin '.$username.' has been created order for '.$paypal_reponse_obj.' and its Price : '.$Total.' with payment method Paypal';
								$cur_time = time();
								$datalog = array( 			
									'transaction_id' =>$transaction_id,
									'trans_details' =>$trans_details,
									'trans_type' => $transaction_type,							
									'created_by' => 0,
									'created_on' => $cur_time,								
								);
								$log_id = $this->Common_model->commonInsert('transaction_logs',$datalog);
								$datai = array( 
								'payment_status' => 'complete',
								'payment_by'=>$user_id,
								);
								$this->Common_model->commonUpdate('wedding_details',$datai,'wedding_user_id',$user_id);
								
								
								 $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" style="margin-top:10px;margin-bottom:0px;">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			Payment Success</div>';
								
								$data['theme']=$theme;	
								$data['url'] = base_url();
								setcookie('sender', '', time()-100 , '/');
								redirect(base_url().trim($posted_data['post_url']));
							}		
							           
            
        }
		
	}
	
	
	public function paypal_cancel(){
		
		redirect(base_url());
	}
	
	public function stripe($arr=null){
		
	 	$CI =& get_instance();				
	 	$this->load->library('Global_lib');						
	 	$data = $this->global_lib->uri_check();		
	 	$data['myHelpers']=$this;		
	 	$this->load->model('Common_model');		
	 	$this->load->helper('text');
        $this->load->library('stripe_lib'); 
        if($this->input->post('stripeToken')){
            $postData = $this->input->post(); 		
            $paymentID = $this->payment($postData); 
			 
            if($paymentID){ 
                redirect('payments/payment_status/'); 
            }else{ 
                $apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':''; 
                $data['error_msg'] = 'Transaction has been failed!'.$apiError; 
            } 
        }else{
			
			echo 'Stripe Was Not Prepare For Transaction';
		}
			
	 	

	 }
	
    function payment($postData){ 
        if(!empty($postData)){ 
			
				$token  = $postData['stripeToken']; 
				$name = $postData['sender_name']; 
				$email = $postData['sender_email']; 		
				$address =  [
							'line1' => 'Behind Post office',
							'postal_code' => '334004',
							'city' => 'bikaner',
							'state' => 'RAJ',
							'country' => 'IN',
							];
						
				$customer = $this->stripe_lib->addCustomer($email, $token,$name,$address); 
				
				$gift_id = '';
				$itemName = '';
				$itemPrice = '';
				$itemCurrency = '';
				$user_id = '';
				
				
				 foreach ($postData as $Item){
					 
						$gift_id = $postData['id'];
						$itemName = $postData['product_name'];
						$itemPrice = $postData['total_price'];
						$itemCurrency = $postData['currency_symbol'];
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
                        						
						extract($_POST);
						
						
						$get_trans_id = $this->create_gift_sender($_POST);
						$user_id = $this->session->userdata('user_id');
						$sender_id = $get_trans_id['sender_id'];
						$transaction_id = $get_trans_id["trans_id"];
																		
						$stripe_reponse_obj = json_encode($charge);
						$package_json_obj = json_encode($_POST);
						$curr_time = time();
						
                        $datai = array( 
							'transaction_key'=>$transaction_id,
							'product_id'=> $id,
							'product_detail'=>$package_json_obj,
							'user_id'=>$user_id,
							'payment_mode'=>$radios,
							'transaction_meta'=>$stripe_reponse_obj,
							'transaction_amount'=>$paidAmount,
							'transaction_date'=>$curr_time,
							'status'=>ucfirst('Completed'),
							
                        ); 
						
                        $transaction_id = $this->Common_model->commonInsert('transaction',$datai);
                        					
                        if($payment_status == 'succeeded'){ 
																
								$trans_type = $radios;
								$transaction_type = 'Paid Via Stripe';
								$username = $this->global_lib->get_user_meta($user_id,'first_name');
								$trans_details = 'hi, Admin '.$username.' has been created order for '.$itemName.' and its Price : '.$itemPrice.' with payment method Stripe';
								$cur_time = time();
								$datalog = array( 			
									'transaction_id' =>$transaction_id,
									'trans_details' =>$trans_details,
									'trans_type' => $transaction_type,							
									'created_by' => $sender_id,
									'created_on' => $cur_time,								
								);
								$log_id = $this->Common_model->commonInsert('transaction_logs',$datalog);
								$datai = array( 
								'payment_status' => 'complete',
								'payment_by'=>$user_id,
								);
								$this->Common_model->commonUpdate('wedding_details',$datai,'wedding_user_id',$user_id);

							 
							 $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" style="margin-top:10px;margin-bottom:0px;">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			Payment Success</div>';
							 $_SESSION['post_url'] = trim($post_url);
                            return $transaction_id; 
                        } 
                    } 
                } 
            } 
        } 
        return false; 
    } 
     
    function payment_status(){ 
		$CI =& get_instance();		
	 	$theme = $CI->config->item('theme') ;				
	 	$this->load->library('Global_lib');					
	 	$data = $this->global_lib->uri_check();		
	 	$data['myHelpers']=$this;		
	 	$this->load->model('Common_model');		
	 	$this->load->helper('text');
        $this->load->library('stripe_lib'); 
	 	$data['theme']=$theme;
		$data['url'] = base_url();
		$url = $_SESSION['post_url'];
		setcookie('sender', '', time()-100 , '/');	
		redirect(base_url().$url);
	 	//$this->load->view("$theme/payment_getways/stripe_success",$data);
    }
	
	function free_packages($arr=null){
		
		$CI =& get_instance();		
	 	$theme = $CI->config->item('theme') ;				
	 	$this->load->library('Global_lib');					
	 	$data = $this->global_lib->uri_check();		
	 	$data['myHelpers']=$this;		
	 	$this->load->model('Common_model');		
	 	$this->load->helper('text');
	 	$data['theme']=$theme;
		
				extract($arr);
						
						//var_dump($arr);exit;
						
						$get_trans_id = $this->create_gift_sender($arr);
					
						$sender_id = $get_trans_id['sender_id'];
						$transaction_id = $get_trans_id["trans_id"];
																		
						$stripe_reponse_obj = 'null';
						$package_json_obj = json_encode($package_obj);
						$curr_time = time();
						
                        $datai = array( 
							'transaction_key'=>$transaction_id,
							'product_id'=> $package_id,
							'product_detail'=>$package_json_obj,
							'user_id'=>$user_id,
							'payment_mode'=>'null',
							'transaction_meta'=>$stripe_reponse_obj,
							'transaction_amount'=>0,
							'transaction_date'=>$curr_time,
							'status'=>ucfirst('Completed'),
							
                        ); 
						
                        $transaction_id = $this->Common_model->commonInsert('transaction',$datai);
                        					
                        if($package_type == 'free'){ 
																
								$trans_type = 'Direct_method';
								$transaction_type = 'Paid Via Direct_method';
								$trans_details = 'hi, Admin '.$user_name.' has been created order for '.$package_obj['package_name'].' and its Price : 0 with payment method Direct';
								$cur_time = time();
								$datalog = array( 			
									'transaction_id' =>$transaction_id,
									'trans_details' =>$trans_details,
									'trans_type' => $transaction_type,							
									'created_by' => 0,
									'created_on' => $cur_time,								
								);
								$log_id = $this->Common_model->commonInsert('transaction_logs',$datalog);
								$datai = array( 
								'payment_status' => 'Complated',
								);
								$this->Common_model->commonUpdate('wedding_details',$datai,'wedding_user_id',$sender_id);

							 $this->session->set_flashdata('msg','Payment success');
                            //return $transaction_id; 
							if($transaction_id > 0){
								$payment_args = "package_id=$package_id";
								$payment_args = $this->global_lib->base64url_encode($payment_args);
								redirect(base_url().'admin/packages/choose_package/?t='.$payment_args);
							}else{
								redirect(base_url().'admin/packages/choose_package/');
							} 
		}
	}
	
}
