
$(document).ready(function(){
	"use strict";
	
	//var page = window.location.pathname.split("/").pop();
	var page = $("#post_url").val();
	var base_url = $('#base_url').val();
	var stripe_check = is_stripe_checked();
	
	if(stripe_check == true){
		$("#stripe-form").show();
		$("#payment_submit").attr("action",base_url+"gifts/stripe");
	}else{
		$("#stripe-form").hide();
	}
	
	jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    
	jQuery('.quantity').each(function() {
		
		var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');
		console.log();
		var price = $("#price").val();
		var total_price = $("#total_price").val();
		var final_price = $("#final_price").val();
		
		  btnUp.on('click',function() {
			var oldValue = parseFloat(input.val());
			if (oldValue >= max) {
			  var newVal = oldValue;
			} else {
			  var newVal = oldValue + 1;
			  $("#final_price").html(price*newVal);
			  $("#total_price").val(price*newVal);
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		  });

		  btnDown.on('click',function() {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
			  var newVal = oldValue;
			} else {
			  var newVal = oldValue - 1;
			  $("#final_price").html(price*newVal);
			  $("#total_price").val(price*newVal);
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		  });

    });
	
	if(page != ''){
			$("#stripe").on('change',function(){
		if(this.checked == true){
			$("#stripe-form").show();
			$("#payment_submit").attr("action",base_url+"payments/" + $(this).val());
		}
	});
	$("#paypal").on('change',function(){
		if(this.checked == true){
			$("#stripe-form").hide();
			$("#payment_submit").attr("action",base_url+"payments/" + $(this).val());			
		}
	});
	}else{
		$("#stripe").on('change',function(){
		if(this.checked == true){
			$("#stripe-form").show();
			$("#payment_submit").attr("action",base_url+"gifts/" + $(this).val());
		}
	});
	$("#paypal").on('change',function(){
		if(this.checked == true){
			alert(page);
			$("#stripe-form").hide();
			$("#payment_submit").attr("action",base_url+"gifts/" + $(this).val());			
		}
		
	});
	}
	

	$("#btn-next").on("click",function(e){
		e.preventDefault();
		var cur_tab = $(this).data('id');
		
		var tab = cur_tab.split(" ");
		
		$(document).find("#"+tab[0]+tab[1]).prop("checked",false);
		var the_tab = parseInt(tab[1]);
		var next_tab = the_tab+1;
		
		$(document).find("#"+tab[0]+next_tab).prop("checked",true);
	});
	$("#btn-next-2").on("click",function(e){
		e.preventDefault();
		var cur_tab = $(this).data('id');
		var tab = cur_tab.split(" ");
		$(document).find("#"+tab[0]+tab[1]).prop("checked",false);
		var the_tab = parseInt(tab[1]);
		var next_tab = the_tab+1;
		if(next_tab == 3 ){
			if($.trim($("#userName").val()) == '' && $.trim($("#sender_email").val()) == '' && $.trim($("#sender_contact").val()) == ''){
				$(document).find("#"+tab[0]+tab[1]).prop("checked",true);
				
				$(document).find("#name_error").html("Please Enter Your Sender Name");
				$(document).find("#email_error").html("Please  Enter Your Sender Email");
				$(document).find("#contact_error").html("Please Enter Your Sender Contact Number");
				
				$(document).find("#"+tab[0]+tab[2]).prop("checked",true);
			}else{
				var email = $("#sender_email").val();
				if(!isValidEmailAddress(email)) { 
					$(document).find("#email_error").html("Please  Enter Valid Email");
					$(document).find("#"+tab[0]+tab[1]).prop("checked",true);
				}else{
					$(document).find("#"+tab[0]+next_tab).prop("checked",true);
				}
				
				
			}
			
		}
		
		
	});
	$("#btn-pre").on("click",function(e){
		e.preventDefault();
		var cur_tab = $(this).data('id');
		
		var tab = cur_tab.split(" ");
		
		$(document).find("#"+tab[0]+tab[1]).prop("checked",false);
			var the_tab = parseInt(tab[1]);
			var next_tab = the_tab-1;
		$(document).find("#"+tab[0]+next_tab).prop("checked",true);
	});
	
	$("#btn-pre-2").on("click",function(e){
		e.preventDefault();
		var cur_tab = $(this).data('id');
		
		var tab = cur_tab.split(" ");
		
		$(document).find("#"+tab[0]+tab[1]).prop("checked",false);
		var the_tab = parseInt(tab[1]);
		var next_tab = the_tab-1;
		$(document).find("#"+tab[0]+next_tab).prop("checked",true);
	});

	$("#payBtn").on("click",function(e){
		
		if($('input[name="radios"]').val() == 'paypal'){
			e.preventDefault();
			if($('input[name="radios"]').is(":checked")){
				if($.trim($("#userName").val()) == '' && 
				$.trim($("#sender_email").val()) == ''&&
				$.trim($("#sender_contact").val()) == ''){
					$(document).find("#tab2").prop("checked",true);
				}else{
					$("#payment_submit").submit();
				}
				
			}
		}
	});

});



function is_stripe_checked(){
	return $("#stripe").prop( "checked" );
}	

if($(".paypal-success-block").length){
	var base_url = document.querySelector("#return_url").value;
function PathLoader(el) {
	this.el = el;
    this.strokeLength = el.getTotalLength();
	
    this.el.style.strokeDasharray =
    this.el.style.strokeDashoffset = this.strokeLength;
}

PathLoader.prototype._draw = function (val) {
    this.el.style.strokeDashoffset = this.strokeLength * (1 - val);
}

PathLoader.prototype.setProgress = function (val, cb) {
	this._draw(val);
    if(cb && typeof cb === 'function') cb();
}

PathLoader.prototype.setProgressFn = function (fn) {
	if(typeof fn === 'function') fn(this);
}

var body = document.body,
    svg = document.querySelector('svg path');

if(svg !== null) {
    svg = new PathLoader(svg);
    
    setTimeout(function () {
        document.body.classList.add('active');
        svg.setProgress(1);
    }, 1000);
}

setTimeout(function () {
       window.location.href = base_url;
    }, 10000);
}


if($(".stripe-success-block").length){
	var base_url = document.querySelector("#return_url").value;
function PathLoader(el) {
	this.el = el;
    this.strokeLength = el.getTotalLength();
	
    this.el.style.strokeDasharray =
    this.el.style.strokeDashoffset = this.strokeLength;
}

PathLoader.prototype._draw = function (val) {
    this.el.style.strokeDashoffset = this.strokeLength * (1 - val);
}

PathLoader.prototype.setProgress = function (val, cb) {
	this._draw(val);
    if(cb && typeof cb === 'function') cb();
}

PathLoader.prototype.setProgressFn = function (fn) {
	if(typeof fn === 'function') fn(this);
}

var body = document.body,
    svg = document.querySelector('svg path');

if(svg !== null) {
    svg = new PathLoader(svg);
    
    setTimeout(function () {
        document.body.classList.add('active');
        svg.setProgress(1);
    }, 1000);
}

setTimeout(function () {
       window.location.href = base_url;
    }, 10000);
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

