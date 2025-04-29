<?php echo link_tag("themes/$theme/plugins/icheck/minimal/_all.css"); ?>
<div class="panel">
    <div class="panel-heading">
        
    </div>
    <div class="panel-body">
       <div class="card-errors"></div>
		
        
        <form action="<?php 
		$id='';
		if(isset($item_id)){
			$id =  $item_id;
		}
		echo base_url().'gifts/confirmation/'.$id.'';?>" method="POST" id="paymentFrm">
            <div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Please Choose Any Payment Method</h3>
				</div>
			<div class="box-body content-box">

				<input type="hidden" name="user_id" class="user_id" value="30">

			<div class="box-header with-border">
				<h4 class="box-title">
				<input type="radio" name="payment_method" required id="stripe" value="stripe" class="minimal ">
				<a data-toggle="collapse" data-parent="#accordion" id="btn_stripe" href="#1" aria-expanded="false" class="collapsed payment-method text-black">
					Stripe
				</a>
				</h4>
			</div>
			<div id="stripe" class="panel-collapse collapse" aria-expanded="false" >
				<div class="box-body">
					Use: Pay online via Stripe	
				</div>
			</div>
			
			<div class="box-header with-border">
				<h4 class="box-title">
				<input type="radio" name="payment_method" required id="Paypal" value="Paypal" class="minimal">
				<a data-toggle="collapse" data-parent="#accordion" id="btn_stripe" href="#1" aria-expanded="false" class="collapsed payment-method text-black">
					Paypal
				</a>
				</h4>
			</div>
			<div id="stripe" class="panel-collapse collapse" aria-expanded="false" >
				<div class="box-body">
				Use: Pay online via Paypal	
				</div>
			</div>
			
		<div class="box-footer">
			<button type="submit" name="submit" class="btn btn-success submit-form-btn" id="save_publish">CheckOut</button>
		</div>
        </form>
    </div>
</div>

<?php echo script_tag("themes/$theme/plugins/icheck/icheck.min.js"); ?>
