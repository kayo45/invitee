<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once(APPPATH . "libraries/PayPal-PHP-SDK/paypal/rest-api-sdk-php/sample/bootstrap.php");
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;

class Gifts extends MY_Controller { 
     public $_api_context;
	 
    function __construct() { 
        parent::__construct(); 
        
    } 
     
    public function index(){ 
		$this->load->model('Common_model');
		$CI =& get_instance();
		
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		$this->load->helper('text');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		
		$data['theme']=$theme;
		
		extract($_POST);
		
		
        
		$qry = $this->Common_model->commonQuery("select * from wedding_gifts where slug='$slug' ");	
		$product_arr = array();
		$product_id ='';
		
		if($qry->num_rows()==0)
			redirect('/','location');
		
		foreach($qry->result() as $row){
			$product_arr['title'] = $row->title;
			$product_arr['price'] = $row->price;
			$product_arr['description'] = $row->description;
			$product_id = $row->gift_id;
		}
		$data['product'] = $product_arr;
		$data['payment_methods'] = $this->global_lib->get_option('payment_methods');
		$data['item_id'] = $product_id;
		$this->load->view("$theme/payment_getways/details",$data);
		
        
    } 
	
	public function purchase($slug){ 
		$this->load->model('Common_model');
		$CI =& get_instance();
		
		$theme = $CI->config->item('theme') ;
		
		$this->load->library('Global_lib');
		$this->load->helper('text');
		
		$data = $this->global_lib->uri_check();
		
		$data['myHelpers']=$this;
		
		$data['theme']=$theme;
		
		extract($_POST);
		
		
        
		$qry = $this->Common_model->commonQuery("select * from wedding_gifts where slug='$slug' ");	
		$product_arr = array();
		$product_id ='';
		
		if($qry->num_rows()==0)
			redirect('/','location');
		
		foreach($qry->result() as $row){
			$product_arr['title'] = $row->title;
			$product_arr['price'] = $row->price;
			$product_arr['description'] = $row->description;
			$product_id = $row->gift_id;
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
				
				
			}else {
				$cookie = json_decode($_COOKIE['sender']);
				
					$transaction_id = $cookie->transaction_id;
					$qry = $this->Common_model->commonQuery("select sender_id from gift_senders where transaction_id='$transaction_id'");
					$id = $qry->row()->sender_id;
					$sender_id = $id;
					
					
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
				
				$posted_data  = $this->session->userdata('post_data');
				
				$pid = $posted_data['id'];
				
				$get_trans_id = $this->create_gift_sender($posted_data);
				$sender_id = $get_trans_id["sender_id"];
										
				$qry = $this->Common_model->commonQuery('select * from wedding_gifts where gift_id='.$pid);
				$product_info = $qry->result();
				
				$transaction_id = $get_trans_id["trans_id"];
						
						$transaction_key = $this->global_lib->getToken(16);	
						$details =[];
						
						foreach ($product_info as $product_detail) {
							foreach ($product_detail as $key => $value) {
								$details[$key] = $value;
							}
						}
						
						$paypal_reponse_obj = json_encode($res);
						$product_json_obj = json_encode($details);
						$curr_time = time();
						
                        $datai = array( 
							'transaction_key'=>$transaction_id,
							'product_id'=>$pid,
							'product_detail'=>$product_json_obj,
							'user_id'=>$sender_id,
							'payment_mode'=>'paypal',
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
								$trans_details = 'hi, Admin '.$username.' has been created order for '.$details['title'].' and its Price : '.$details['price'].' with payment method Paypal';
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
								'status' => $status,
								);
								$this->Common_model->commonUpdate('gift_senders',$datai,'sender_id',$sender_id);
								
								$this->session->set_flashdata('msg','Payment success');
								$this->session->unset_userdata('id');
								$data['theme']=$theme;	
								$data['url'] = base_url();
								setcookie('sender', '', time()-100 , '/');
								$this->load->view("$theme/payment_getways/paypal_success",$data);
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
            $paymentID = $this->payments($postData); 
			 
            if($paymentID){ 
			//var_dump($paymentID);exit;
                redirect('gifts/payment_status/'); 
            }else{ 
                $apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':''; 
                $data['error_msg'] = 'Transaction has been failed!'.$apiError; 
            } 
        }else{
			
			echo 'Stripe Was Not Prepare For Transaction';
		}
			
	 	

	 }
	
    function payments($postData){ 
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
					
						$sender_id = $get_trans_id['sender_id'];
						$transaction_id = $get_trans_id["trans_id"];
						$qry = $this->Common_model->commonQuery("select * from wedding_gifts where gift_id=$id");	
						$postData['product'] = $qry;
						
						$details = [];
						
						foreach ($postData['product']->result() as $package_detail) {
							foreach ($package_detail as $key => $value) {
								$details[$key] = $value;
							}
						}
						
						$stripe_reponse_obj = json_encode($charge);
						$package_json_obj = json_encode($details);
						$curr_time = time();
						
                        $datai = array( 
							'transaction_key'=>$transaction_id,
							'product_id'=>$gift_id,
							'product_detail'=>$package_json_obj,
							'user_id'=>$sender_id,
							'payment_mode'=>'stripe',
							'transaction_meta'=>$stripe_reponse_obj,
							'transaction_amount'=>$paidAmount,
							'transaction_date'=>$curr_time,
							'status'=>ucfirst('Completed'),
							
                        ); 
						
                        $transaction_id = $this->Common_model->commonInsert('transaction',$datai);
                        					
                        if($payment_status == 'succeeded'){ 
																
								$trans_type = 'Stripe';
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
								'status' => $payment_status,
								);
								$this->Common_model->commonUpdate('gift_senders',$datai,'sender_id',$sender_id);

							 $this->session->set_flashdata('msg','Payment success');
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
		/*	
		var_dump($id);exit;
        $qry =  $this->Common_model->commonQuery("select * from transaction Where transaction_id=$id"); 
		$order = $qry->row(); 
        $data['order'] = $order;
		*/
		$data['url'] = base_url();
		setcookie('sender', '', time()-100 , '/');		
	 	$this->load->view("$theme/payment_getways/stripe_success",$data);
    }
}