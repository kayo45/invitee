var stripe = Stripe('pk_test_PtNDu1GnvxRwMoicibD09sye00FVMMFfur');
var elements = stripe.elements();
var style = {
    base: {
        fontWeight: 400,
        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
        fontSize: '16px',
        lineHeight: '1.4',
        color: '#555',
        backgroundColor: '#fff',
        '::placeholder': {
            color: '#888',
        },
    },
    invalid: {
        color: '#eb1c26',
    }
};

var cardElement = elements.create('cardNumber', {
    style: style
});
cardElement.mount('#card_number');

var exp = elements.create('cardExpiry', {
    'style': style
});
exp.mount('#card_expiry');

var cvc = elements.create('cardCvc', {
    'style': style
});
cvc.mount('#card_cvc');

var resultContainer = document.getElementById('paymentResponse');
var radioChecked='';
if($('input[name = "radios"]').is(':checked')){
	 radioChecked = document.querySelector('input[name = "radios"]:checked').value;
}


cardElement.addEventListener('change', function(event) {
			radioChecked = document.querySelector('input[name = "radios"]:checked').value;
				if (event.error) {
					if(radioChecked == 'stripe'){
						resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
						
					}
				} else {
					resultContainer.innerHTML = '';
					
				}
				
		
});

var form = document.getElementById('payment_submit');
form.addEventListener('submit', function(e) {   
	if(radioChecked == 'stripe'){
		
		e.preventDefault();
		createToken();
	}
});
function createToken() {
	
    stripe.createToken(cardElement).then(function(result) {
		
        if (result.error) {
			if(radioChecked == 'stripe'){
				resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
			}
        } else {
				stripeTokenHandler(result.token);
        }
    });
}
function stripeTokenHandler(token) {
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);
		form.submit();

}
