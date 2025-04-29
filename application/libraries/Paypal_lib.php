<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/PayPal-PHP-SDK/paypal/rest-api-sdk-php/sample/bootstrap.php'); 
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;

class Paypal_lib {
	
	public $_api_context;
	
	function  __construct()
    {
        
				
        $CI =& get_instance();	
		$CI->load->library('session');
		
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
		
    }
	
	public function createPayment($post = array()){
			$CI =& get_instance();	
			
			extract($post);
			
			$CI->load->config('paypal');
			$this->_api_context->setConfig($CI->config->item('settings'));
			
			$product_id =array(
				'product_id'=>$id,
			);
					
			$payer = new Payer();
			$payer->setPaymentMethod("paypal");
			$item1["name"] = $product_name;
			$item1["description"] = $description;
			$item1["currency"] = $currency_symbol;
			$item1["quantity"] =$quantity;
			$item1["price"] = $price;

			$itemList = new ItemList();
			$itemList->setItems(array($item1));
		
		
			$details['tax'] = 0;
			$details['subtotal'] = $total_price;
			$amount['currency'] = $currency_symbol;
			$amount['total'] = $details['tax'] + $details['subtotal'];
			$amount['details'] = $details;
			
			$transaction['description'] ='Product '.$product_name.'';
			$transaction['amount'] = $amount;
			$transaction['invoice_number'] = uniqid();
			$transaction['item_list'] = $itemList;
			$CI->session->set_userdata('post_data', json_encode($post));
			
			$baseUrl = base_url();
			
			
			if(isset($post_url) && !empty($post_url)){
				
				$redirectUrls = new RedirectUrls();
				$redirectUrls->setReturnUrl($baseUrl."payments/paypal_success/")
				->setCancelUrl($baseUrl."payments/paypal_cancel");
				
			}else{
				
				if(!empty($post['from']) && $post['from'] == 'user_to_owner'){
				$redirectUrls = new RedirectUrls();
				$redirectUrls->setReturnUrl($baseUrl."payments/paypal_success/")
				->setCancelUrl($baseUrl."payments/paypal_cancel");
				}else{
					$redirectUrls = new RedirectUrls();
					$redirectUrls->setReturnUrl($baseUrl."gifts/paypal_success/")
					->setCancelUrl($baseUrl."gifts/paypal_cancel");
				}
			}
			
			
			
			$payment = new Payment();
			$payment->setIntent("sale")
				->setPayer($payer)
				->setRedirectUrls($redirectUrls)
				->setTransactions(array($transaction));
			try {
				
				$payment->create($this->_api_context);
				
				
			} catch (Exception $ex) {
				
				echo $ex;
			}
			
			foreach($payment->getLinks() as $link) {
				
				if($link->getRel() == 'approval_url') {
					$redirect_url = $link->getHref();
					break;
				}
			}

			if(isset($redirect_url)) {
				redirect($redirect_url);
			}
			
	}
	
	function refund_payment(){
        $refund_amount = $this->input->post('refund_amount');
        $saleId = $this->input->post('sale_id');
        $paymentValue =  (string) round($refund_amount,2); ;

		
        $amt = new Amount();
        $amt->setCurrency('INR')
            ->setTotal($paymentValue);

        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amt);

		
        $sale = new Sale();
        $sale->setId($saleId);
        try {
            $refundedSale = $sale->refundSale($refundRequest, $this->_api_context);
        } catch (Exception $ex) {
            ResultPrinter::printError("Refund Sale", "Sale", null, $refundRequest, $ex);
            exit(1);
        }

		 ResultPrinter::printResult("Refund Sale", "Sale", $refundedSale->getId(), $refundRequest, $refundedSale);

        return $refundedSale;
    }
	
	
	
}


