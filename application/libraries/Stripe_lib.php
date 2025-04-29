<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class Stripe_lib{ 
    var $CI; 
    var $api_error; 
	
    function __construct(){ 
		
        $this->api_error = ''; 
        $this->CI =& get_instance(); 
		require APPPATH .'third_party/stripe/init.php'; 
        
        $payment_methods = $this->CI->global_lib->get_option('payment_methods');
		$payment_method_stripe = json_decode($payment_methods);
		
		
		$stripe_id = '';
		$stripe_secret='';
		
		if($payment_method_stripe->payment_method_stripe_section->is_enable == 'Y'){
			
			if(!empty($payment_method_stripe->payment_method_stripe_section->stripe_client_id) &&
			!empty($payment_method_stripe->payment_method_stripe_section->stripe_client_secret)){
				
				
					$this->stripe_id = $stripe_id = $payment_method_stripe->payment_method_stripe_section->stripe_client_id;
					 $stripe_secret=$payment_method_stripe->payment_method_stripe_section->stripe_client_secret;
			}
		
		} 
		
        \Stripe\Stripe::setApiKey($stripe_secret); 
    } 
 
    function addCustomer($email, $token,$name,$address){ 
		
        try { 
            $customer = \Stripe\Customer::create(array( 
				'name' => $name,
                'email' => $email, 
				'address' => $address,
                'source'  => $token 
            )); 
            return $customer; 
        }catch(Exception $e) { 
              echo $this->api_error = $e->getMessage(); 
            return false; 
        } 
    } 
     
    function createCharge($customerId, $itemName, $itemPrice, $itemCurrency){ 
       $itemPriceCents = ($itemPrice*100); 
        
        try { 
            $charge = \Stripe\Charge::create(array( 
                'customer' => $customerId, 
                'amount'   => $itemPriceCents, 
                'currency' => $itemCurrency, 
                'description' => $itemName, 
                 
            )); 
             
            $chargeJson = $charge->jsonSerialize(); 
			
            return $chargeJson; 
        }catch(Exception $e) { 
             $this->api_error = $e->getMessage(); 
            return false; 
        } 
    } 
}