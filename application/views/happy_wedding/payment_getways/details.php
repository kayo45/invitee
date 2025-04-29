<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Checkout Payment</title>

<?php echo link_tag("application/views/$theme/theme/css/bootstrap.min.css"); ?>
<?php echo link_tag("application/views/$theme/theme/css/payment_methods.css"); ?>
<?php if($this->site_direction == 'rtl') { ?>
	
		<?php echo link_tag("application/views/$theme/theme/css/bootstrap-rtl.min.css"); ?>
		<?php echo link_tag("application/views/$theme/theme/css/payment_methods_rtl.css"); ?>
	<?php } ?>
</head>

<body translate="no">
	<form  action="" method="POST" id="payment_submit" >
		<input type="hidden" id='base_url' value="<?php echo html_escape(base_url());?>" >
		<div class="tab_container">
			<input id="tab1" type="radio" name="tabs" checked>
			<label for="tab1"><span class="numberCircle">1</span><span><?php echo mlx_get_lang('Product'); ?></span></label>

			<input id="tab2" type="radio" name="tabs">
			<label for="tab2"><span class="numberCircle">2</span><span><?php echo mlx_get_lang('Customer'); ?></span></label>

			<input id="tab3" type="radio" name="tabs" >
			<label for="tab3"><span class="numberCircle">3</span><span><?php echo mlx_get_lang('Payment'); ?></span></label>
			 
				<section id="content1" class="tab-content">
					<h3><?php echo mlx_get_lang('You Have Choosen Product'); ?></h3>
						<div class="product">
						<h1><?php echo $product['title']; ?> <small><?php echo  $this->site_currency; ?> <span id="final_price"><?php echo $product['price'];?></small></h1>
							  <div class="quantity">
								  <input type="number" name="quantity" min="1" max="9" step="1" value="1">
							  </div>
							  </br>
							  </br>
							  </br>
							<p class="text-center"><?php echo $product['description']; ?></p>
						</div>
					<input type="hidden" name="id" value="<?php echo $item_id;?>"/>
					
					<input type="hidden" name="post_url" id="post_url" value="
					<?php 
						if(isset($post_url) && !empty($post_url)){
							echo $post_url;
						}?>
					"/>
					<input type="hidden" name="currency_symbol" value="<?php echo $this->site_currency;?>"/>
					<input type="hidden" name="price" id="price" value="<?php echo html_escape($product['price']);?>"/>
					<input type="hidden" name="total_price" id="total_price" value="<?php echo html_escape($product['price']);?>"/>
					<input type="hidden" name="description" value="<?php echo html_escape($product['description']); ?>"/>
					<input type="hidden" name="product_name" value="<?php echo html_escape($product['title']);?>"/>
					
					<div class="button-master-container">
					  <div class="button-container">
					   
					  <a href="<?php echo base_url();?>"><?php echo mlx_get_lang('Return to Gifts'); ?></a>
					  
					  </div>
					  <div class="button-container button-finish">
					 
					  <button id="btn-next" data-id="tab 1">
						<?php echo mlx_get_lang('NEXT'); ?>
					  </button>
					  </div>
					</div>
				</section>

				<section id="content2" class="tab-content ">
				<h3><?php echo mlx_get_lang('Customer Information'); ?></h3>
		      	
				<?php if(isset($_COOKIE['sender'])) {
						$cookie = json_decode($_COOKIE['sender']);
				?>
					<div class="form-group user-form">
						<label for="userName"><?php echo mlx_get_lang('Sender Name'); ?>:</label>
						<input type="text" class="form-control" name="sender_name" required  id="userName" value="<?php echo $cookie->name;?>" >
						<div class="error" id="name_error"></div>
					  </div>
					  <div class="form-group user-form">
						<label for="sender_email"><?php echo mlx_get_lang('Sender Email'); ?>:</label>
						<input type="email" class="form-control" name="sender_email" required id="sender_email" value="<?php echo $cookie->email;?>" >
						<div class="error" id="email_error"></div>
						
					  </div>
					  <div class="form-group user-form">
						<label for="sender_contact"><?php echo mlx_get_lang('Contact Number'); ?>:</label>
						<input type="number" class="form-control" name="sender_contact" required id="sender_contact" value="<?php echo $cookie->contact_number;?>">
						<div class="error" id="contact_error"></div>
					  </div>
					<?php }else{ ?>
						<div class="form-group user-form">
						<label for="userName"><?php echo mlx_get_lang('Sender Name'); ?>:</label>
						<input type="text" class="form-control" name="sender_name" id="userName" required >
						<div class="error" id="name_error"></div>
					  </div>
					  <div class="form-group user-form">
						<label for="sender_email"><?php echo mlx_get_lang('Sender Email'); ?>:</label>
						<input type="email" class="form-control" name="sender_email" required id="sender_email" >
						<div class="error" id="email_error"></div>
					  </div>
					  <div class="form-group user-form">
						<label for="sender_contact"><?php echo mlx_get_lang('Contact Number'); ?></label>
						<input type="number" class="form-control" name="sender_contact" required id="sender_contact">
						<div class="error" id="contact_error"></div>
					  </div>
					<?php }?>
					<div class="button-master-container">
					  <div class="button-container">
					  					  <button  id="btn-pre" data-id="tab 2">
						<?php echo mlx_get_lang('Preview'); ?>
					  </button>
					  </div>
					  <div class="button-container button-finish">
					 
					  <button  id="btn-next-2" data-id="tab 2">
						
						<?php echo mlx_get_lang('Next'); ?>
					  </button>
					  </div>
					</div>
				</section>


			<section id="content3" class="tab-content">
				<h4 class="payment-title"><?php echo mlx_get_lang('Choose your payment method'); ?> </br><small>
				<span class=" error form-inline" id="form_error"></span>
				</small>
				</h4>
				
		      	<?php 
					$methos = json_decode($payment_methods,true);
					foreach($methos as $key=>$method){
						
						$method_name_ex = explode("_",$key);
						$method_name = $method_name_ex[2];
						if($method['is_enable'] == 'Y'){?>
				<div class="pymt-radio">

				<div class="row-payment-method payment-row">
				
				  <div class="select-icon hr">
				 
					<input type="radio" id="<?php echo $method_name; ?>" name="radios" 
					value="<?php echo $method_name; ?>" 
						<?php if(isset($_COOKIE['sender'])){
								$cookie = json_decode($_COOKIE['sender']);
							if($method_name == $cookie->payment_method){
								echo 'checked';
							}else{
								echo '';
							}
						}?>>
					<label for="<?php echo $method_name; ?>"></label>
				  </div>
				  <div class="select-txt hr">
					<p class="pymt-type-name"><?php echo ucfirst($method_name); ?></p>
					<p class="pymt-type-desc">Safe payment online. Credit card needed. <?php echo $method_name; ?> account is not necessary.</p>
				  </div>
				  <div class="select-logo">
				  <?php if($method_name == 'paypal'){?>
				  <div class="select-logo-sub logo-spacer">
					<img src="data:image/png;base64,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">
				  </div>
					<?php }elseif($method_name == 'stripe'){?>
					 <div class="select-logo-sub logo-spacer">
					<img src="data:image/png;base64,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" style="width: 70%;">
					</div>
					<?php } ?>
					
				  </div>
				  
				</div>
      
				
				<?php }
					}
					?>
					<div class="form-cc" id="stripe-form">
						<div class="row-cc">
						<div class="cc-field">
						  <div class="cc-title"><?php echo mlx_get_lang('Credit Card Number'); ?></div>
								<div id="card_number" class="form-control input cc-txt  StripeElement StripeElement--empty" required="required"></div>
							
						</div>
						</div>
					
						<div class="row-cc">
						<div class="cc-field">
						  <div class="cc-title"><?php echo mlx_get_lang('Expiry Date'); ?></div>
							<div id="card_expiry" class="form-control input cc-txt StripeElement StripeElement--empty" required="required"></div>
							
						</div>
						</div>
						
						<div class="cc-field">
						  <div class="cc-title"><?php echo mlx_get_lang('CVV Code'); ?><span class="numberCircle">?</span></div>
							<div id="card_cvc" class="form-control input cc-txt StripeElement StripeElement--empty" required="required">
							</div>
						</div>
						
					 </div>
					   <div id="paymentResponse"></div>
							
					</div>
					<div class="button-master-container">
					  <div class="button-container">
					   <button  id="btn-pre-2" data-id="tab 3">
						<?php echo mlx_get_lang('Preview'); ?>
					  </button>
					  </div>
					  <div class="button-container button-finish">
					 
					  <button type="submit"  id="payBtn" data-id="tab3">
						<?php echo mlx_get_lang('Proceed'); ?>
					  </button>
					  </div>
					</div>
				</form>
			</section>
		</div>
	
</body>

<script src="https://js.stripe.com/v3/"></script>
<?php echo script_tag("application/views/$theme/theme/js/jquery.min.js");?>
<?php echo script_tag("application/views/$theme/theme/js/stripeConfig.js");?>

<?php echo script_tag("application/views/$theme/theme/js/bootstrap.min.js");?>
<?php echo script_tag("application/views/$theme/theme/js/payment_methods.js");?>

</html>

