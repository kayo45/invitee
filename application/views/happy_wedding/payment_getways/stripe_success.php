<html lang="en">
<head>
<meta charset="UTF-8">
<title>Happy Wedding - Successfully Payment</title>
<?php echo link_tag("application/views/$theme/theme/css/payment_methods.css"); ?>
</head>
<body translate="no">
	
	<div class="success-message stripe-success-block">
    <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
        <circle cx="38" cy="38" r="36"/>
        <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
    </svg>
    <h1 class="success-message__title"><?php echo mlx_get_lang('Payment Received Successfully !'); ?></h1>
    <div class="success-message__content">
        <p><?php echo mlx_get_lang('We will respond in approximately 1 minutes'); ?></p>
		<p><?php echo mlx_get_lang('After Few Minutes you will be redirect to Home Page'); ?></p>
    </div>
	<input type="hidden" id="return_url" value="<?php echo $url;?>"/>
</div>
	
</body>
<?php echo script_tag("application/views/$theme/theme/js/jquery.min.js");?>
<?php echo script_tag("application/views/$theme/theme/js/payment_methods.js");?>

</html>

