
var id, img_data;


$(function () {

  "use strict";
  
	$('.alert:not(".show_always")').delay(5000).fadeOut('slow');
	
	var id;
	
	function escapeHtml(text) {
		var filter_data = DOMPurify.sanitize(text, {SAFE_FOR_TEMPLATES: true});
		return jQuery.trim(filter_data);
	}
	
	function progress(e){
		if(e.lengthComputable){
		   $('#'+id+'_progress').show();
			$('progress').attr({value:e.loaded,max:e.total});
		}
	}
	
	function cal_deleted_img()
	{
		var del_leng = $('.media_container .media_images.selected').length;
		if(del_leng > 0)
		{
			if(del_leng == 1)
				$('.select-msg-text-block').html(del_leng+' image selected');
			else
				$('.select-msg-text-block').html(del_leng+' images selected');
			$('.remove-multi-image').removeClass('disabled');
		}
		else
		{
			$('.select-msg-text-block').html('(Click on image to select multiple)');
			$('.remove-multi-image').addClass('disabled');
		}
	}
	
	function update_video_links()
	{
		if($('.vdo_url_container').find('.form-group').length <= 1)
		{
			$('.vdo_url_container').find('.form-group .remove-video-link').addClass('disabled');
		}
		else
		{
			$('.vdo_url_container').find('.form-group .remove-video-link').removeClass('disabled');
		}
	}
	
	function extendMagnificIframe(){

		var $start = 0;
		var $iframe = {
			markup: '<div class="mfp-iframe-scaler">' +
					'<div class="mfp-close"></div>' +
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
					'</div>' +
					'<div class="mfp-bottom-bar">' +
					'<div class="mfp-title"></div>' +
					'</div>',
			patterns: {
				youtube: {
					index: 'youtu', 
					id: function(url) {   

						var m = url.match( /^.*(?:youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/ );
						if ( !m || !m[1] ) return null;

							if(url.indexOf('t=') != - 1){

								var $split = url.split('t=');
								var hms = $split[1].replace('h',':').replace('m',':').replace('s','');
								var a = hms.split(':');

								if (a.length == 1){

									$start = a[0]; 

								} else if (a.length == 2){

									$start = (+a[0]) * 60 + (+a[1]); 

								} else if (a.length == 3){

									$start = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 

								}
							}                                   

							var suffix = '?autoplay=1';

							if( $start > 0 ){

								suffix = '?start=' + $start + '&autoplay=1';
							}

						return m[1] + suffix;
					},
					src: '//www.youtube.com/embed/%id%'
				},
				vimeo: {
					index: 'vimeo.com/', 
					id: function(url) {        
						var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
						if ( !m || !m[5] ) return null;
						return m[5];
					},
					src: '//player.vimeo.com/video/%id%?autoplay=1'
				}
			}
		};

		return $iframe;     

	}
	
	function RemoveRougeChar(convertString){
		return convertString;
	}
	
	function update_site_language_name_id_func()
	{
		$('.select2_elem').select2('destroy');
		
		$('.minimal').iCheck('destroy');
		$('.lang-container .single-lang-block').each(function(i){
			var row_count = i+1; 
			$(this).find('.col-md-4').each(function() {
				if($(this).find('select').length)
				{
					$(this).find('select').attr("id", $(this).find('select').attr("id").replace(/\d+/, row_count));
					$(this).find('select').attr("name", $(this).find('select').attr("name").replace(/\d+/, row_count));
				}
				if($(this).find('input[type="radio"]').length)
				{
					$(this).find('.radio_toggle_wrapper input[type="radio"]').each(function() {
						$(this).attr("id", $(this).attr("id").replace(/\d+/, row_count));
						$(this).attr("name", $(this).attr("name").replace(/\d+/, row_count));
					});
					
				}
				if($(this).find('label').length)
				{
					if($(this).find('label').length == 1)
						$(this).find('label').attr("for", $(this).find('label').attr("for").replace(/\d+/, row_count));
					else
					{
						$(this).find('.radio_toggle_wrapper label').each(function() {
							$(this).attr("for", $(this).attr("for").replace(/\d+/, row_count));
						});
						
					}
				}
				
				$(this).find('.inputtext').each(function(e) {
					$(this).attr("id", $(this).attr("id").replace(/\d+/, row_count));
					$(this).attr("name", $(this).attr("name").replace(/\d+/, row_count));
					
				});
				
			});
			$(this).find('.radio_toggle_wrapper input[type="radio"]:checked').next('label').trigger('click');
			
			$(this).find('.language_list').select2({
				width : '100%'
			});
			$(this).find('.currency_list').select2({
				width : '100%'
			});
			$(this).find('.timezone_list').select2({
				width : '100%'
			});
			$(this).find('.currency_pos_list').select2({
				width : '100%'
			});
			
			$(this).find('.minimal').iCheck({
			  checkboxClass: 'icheckbox_minimal-blue',
			  radioClass: 'iradio_minimal-blue'
			});
			
		});
		
		if($('.lang-container .single-lang-block').length <= 1)
		{
			$('.lang-container .single-lang-block .remove-lang-block').hide();
		}
		else
		{
			$('.lang-container .single-lang-block .remove-lang-block').show();
		}
	}
	
	if($('.homepage_section_form').length)
   {
	  if($('.show_hide_block_btn').length)
		{
			$('.show_hide_block_btn').each(function(e) { 
				
				var elem_name = $(this).attr('name');
				var elem_val = $("input[name='"+elem_name+"']:checked").val();
				var data_target = $("input[name='"+elem_name+"']:checked").attr('data-target');
				$('.'+data_target).hide();
				$('.'+data_target+'.'+elem_val+'_block').addClass('hidden-elem').show();
			});
			
			
			$('.show_hide_block_btn').each(function(e) {
				
				if(!$(this).parents('.form-group').hasClass('carousel_block') && 
					!$(this).parents('.form-group').hasClass('grid_block'))
				{
					var elem_name = $(this).attr('name');
					var elem_val = $("input[name='"+elem_name+"']:checked").val();
					var data_target = $("input[name='"+elem_name+"']:checked").attr('data-target');
					if(!$('.'+data_target+'.'+elem_val+'_block').hasClass('hidden-elem'))
					{
						$('.'+data_target).hide();
						$('.'+data_target+'.'+elem_val+'_block').show();
					}
				}
			});
			
		}
		
		$('.show_hide_block_btn:not(".child_element_block")').on('change',function() {
			var elem_name = $(this).attr('name');
			var elem_val = $("input[name='"+elem_name+"']:checked").val();
			var data_target = $("input[name='"+elem_name+"']:checked").attr('data-target');
			$('.'+data_target).hide();
			$('.'+data_target+'.'+elem_val+'_block').show();
			return false;
		});
		
		$(document).delegate('.collapsed','click',function() {
			$(this).find('.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up');
			$(this).parents('li').find('.section_fields').removeClass('hide');
			$(this).removeClass('collapsed').addClass('expended');
			
			return false;
		});
		
		$(document).delegate('.expended','click',function() {
			$(this).find('.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			$(this).parents('li').find('.section_fields').addClass('hide');
			$(this).removeClass('expended').addClass('collapsed');
			return false;
		});
		
		$(".todo-list").sortable({
			placeholder: "sort-highlight",
			handle: ".handle",
			forcePlaceholderSize: true,
			zIndex: 999999,
			cancel : '.fixed-section'
		  });
		
		function escapeHtml(text) {
			'use strict';
			var filter_data = DOMPurify.sanitize(text, {SAFE_FOR_TEMPLATES: true});
			return jQuery.trim(filter_data);
		}

		$('.submit-section-btn').on('click',function() {
			var values = $('.form').find(":input,textarea")
			.filter(function(index, element) {
				var updated_string = escapeHtml($(element).val());
				$(element).val(updated_string);
			})
			if (values) {
				$('.form').submit();
			}
			else
			{
				return false;
			}
		});
  }
	
	
	$('.keywords').on('change',function() {
		var thiss = $(this);
		thiss.parents('.form-group').addClass('processing');
		var lang_id =  thiss.attr('data-lang_id');
		var lang_slug =  thiss.attr('data-lang_slug');		
		var value =  thiss.val();
		$.ajax({						
			url: base_url+'ajax/update_keywords_callback_func',						
			type: 'POST',						
			success: function (res) 
			{							
				thiss.parents('.form-group').removeClass('processing');
				thiss.parent().append('<span class="label label-success" >Updated</span>');
				
				thiss.parent().find('.label').delay(3000).hide("slow",function(){
					$(this).remove();
				});
				
			},						
			data: {lang_id : lang_id, lang_slug : lang_slug, value : value},						
			cache: false					
		});	
		return false;
	});
	
	$('.delete-property').on('click',function() {
		if (!confirm("Do you really want to delete this property?")){
		  return false;
		}
	});
	
	$('.skin-container li a').on('click',function() {
		var skin = $(this).attr('data-skin');
		$('.option_skin').val(skin);
		$('.skin-container li a').addClass('full-opacity-hover');
		$(this).removeClass('full-opacity-hover');
		return false;
	});
	
	
	
	$('.show_hide_property_for_cities').on('change',function() {
		if($(this).val() == 'Y')
		{
			$('.show_hide_property_for_cities_block').show();
		}
		else
		{
			$('.show_hide_property_for_cities_block').hide();
		}
	});
	
	
	
	
	$('.show_hide_property_for_states').on('change',function() {
		if($(this).val() == 'Y')
		{
			$('.show_hide_property_for_states_block').show();
		}
		else
		{
			$('.show_hide_property_for_states_block').hide();
		}
	});
	
	$('.featured-prod-checkbox').on('ifChanged', function (event) { $(event.target).trigger('change'); });
	
	$('.featured-prod-checkbox').on('change',function() {
		$('.full_sreeen_overlay').show();
		var thiss = $(this);
		var p_id = thiss.attr('data-p_id');
		var is_feat = 'N';
		if(thiss.is(':checked'))
			is_feat = 'Y';
		
		$.ajax({
			url: base_url+'ajax/toggle_featured_property_callback_func',
			type: 'POST',
			success: function (res) {
				if(res != 'success')
				{
					$('.page-title').after(res);
					thiss.iCheck('uncheck');
				}
				$('.full_sreeen_overlay').hide();
			},
			data: {is_feat : is_feat,p_id : p_id},
			cache: false
		});
	
		
		return false;
	});
	
	$('#UserName').on('keyup',function() {
		var user_name = $(this).val();
		var thiss = $(this);
		if(user_name != '')
		{
			$.ajax({
				url: base_url+'ajax/check_username_existence',
				type: 'POST',
				success: function (res) {
					thiss.parents('.form-group').removeClass('has-success');
					thiss.parents('.form-group').removeClass('has-error');
					if(res == 'success')
					{
						thiss.parents('.form-group').addClass('has-success');
						$('#save_publish').removeClass('disabled');
					}
					else
					{
						thiss.parents('.form-group').addClass('has-error');
						$('#save_publish').addClass('disabled');
					}	
					
				},
				data: {user_name : user_name},
				cache: false
			});
		}
		return false;
	});

	$('#RepeatPassword').on('keyup',function() {
		var password = $('#Password').val();
		var thiss = $(this);
		thiss.parents('.form-group').removeClass('has-success');
		thiss.parents('.form-group').removeClass('has-error');
		if($(this).val() != '')
		{
			if(password == $(this).val())
			{
				thiss.parents('.form-group').addClass('has-success');
				$('#save_publish').removeClass('disabled');
			}
			else
			{
				thiss.parents('.form-group').addClass('has-error');
				$('#save_publish').addClass('disabled');
			}	
		}
	});
	
	$(document).delegate('.media_images','click',function() {
		if($(this).hasClass('selected'))
		{
			$(this).find('.select-check').addClass('hide');
			$(this).removeClass('selected');
		}
		else
		{
			$(this).find('.select-check').removeClass('hide');
			$(this).addClass('selected');
		}
		cal_deleted_img();
		return false;
	});
		
	$('.remove-multi-image').on('click',function() {
		if(!$(this).hasClass('disabled'))
		{
			
			var strconfirm = confirm('Are you sure you want to delete?');
			if (strconfirm == true)
			{
				$('.full_sreeen_overlay').show();
				$('.media_container .media_images.selected').each(function() {
					$(this).find('.remove_multi_img').trigger('click');
				});
				
				$('.select-msg-text-block').html('(Click on image to select multiple)');
				$('.remove-multi-image').addClass('disabled');
			}
			$('.full_sreeen_overlay').hide();
		}
		
		return false;
	});
		
	$(document).delegate('a.remove_multi_img','click',function() {
		var id = $(this).attr('data-name');
		var thiss = $(this);
		var img_name = $('#'+id+'_hidden').val();
		var image_type =  $('#'+id).attr('data-type');
		$('.full_sreeen_overlay').show();
		$.ajax({
			url: base_url+'ajax_images/delete_images_callback_func',
			type: 'POST',
			success: function (res) {
				if(res == 'success')
				{
					if(image_type == 'media')
					{
						thiss.parent().parent().fadeOut().remove();
					}
					else
					{
						$('a#'+id+'_link').removeAttr('href').removeAttr('download');
						$('a#'+id+'_link img').removeAttr('src');
						$('#'+id+'_link').hide();
						$('#'+id).parent().show();
						thiss.hide();
						$('#'+id+'_hidden').val('');
					}
				}
				$('.full_sreeen_overlay').hide();
			},
			data: {img_name : img_name,image_type : image_type},
			cache: false
		});
		return false;
	});
		
	$('.select-all-btn').on('click',function() {
		$('.media_container .media_images').addClass('selected');
		$('.media_container .media_images').find('.select-check').removeClass('hide');
		cal_deleted_img();
		return false;
	});
	
	$('.unselect-all-btn').on('click',function() {
		$('.media_container .media_images').removeClass('selected');
		$('.media_container .media_images').find('.select-check').addClass('hide');
		cal_deleted_img();
		return false;
	});
	
	if($('.login-page').length)
	{
		$('p.error_msg,p.success_msg').delay(5000).fadeOut('slow');
	}
	
	if($('.site_language_form').length)
	{
		$('.add-lang-btn').on('click',function() {
			var cloned_elem = $('.default-lang-block').clone(true);
			cloned_elem.removeClass('hide default-lang-block');
			$('.lang-container').append(cloned_elem);
			update_site_language_name_id_func();
			return false;
		});
		
		$(document).delegate('.remove-lang-block','click',function() {
			
			if($(this).parents('.single-lang-block').find('input[type="radio"][name="options[default_language]"]').is(':checked'))
			{
				$(this).parents('.lang-container').find('.single-lang-block').eq(0).find('input[type="radio"][name="options[default_language]"]').iCheck('check');
			}
			$(this).parents('.single-lang-block').remove();
			update_site_language_name_id_func();
			return false;
		});
		
		$(document).delegate('.language_list','change',function() {
			var cur_val = $(this).val();
			$(this).parents('.single-lang-block').find('.minimal').val(cur_val);
		});
		
		
	}
	
	$('.form').on('submit',function(e) {						   
		$('.form').find(":input,select,textarea").filter(function(index, element) 
		{	
			if(!$(element).hasClass('distances_list') && !$(element).hasClass('amenities_list') 
				&& !$(element).hasClass('property_for_cities') && !$(element).hasClass('property_for_states') 
				&& !$(element).hasClass('no_clean') && !$(element).hasClass('assign_to_list'))
			{
				var updated_string = escapeHtml($(element).val());
				$(element).val(updated_string);
			}
		});
	});
	
	$('a.remove_img').on('click',function() {
		var id = $(this).attr('data-name');
		var thiss = $(this);
		var img_name = $('#'+id+'_hidden').val();
		var user_type =  $('#'+id).attr('data-user-type');
		
		var strconfirm = confirm("Are you sure you want to delete?");
		if (strconfirm == true)
		{
				$('.full_sreeen_overlay').show();
				$.ajax({
					url: base_url + 'ajax_images/delete_image_callback_func',
					type: 'POST',
					success: function (res) {
						if(res == 'success')
						{
							$('a#'+id+'_link').removeAttr('href').removeAttr('download');
							$('a#'+id+'_link img').removeAttr('src');
							$('#'+id+'_link').hide();
							$('#'+id).parent().show();
							thiss.hide();
							$('#'+id+'_hidden').val('');
						}
						$('.full_sreeen_overlay').hide();
					},
					data: {img_name : img_name,user_type : user_type},
					cache: false
				});
			
		}
		return false;
	});
		
	if ($('#back-to-top').length) {
		var scrollTrigger = 100, 
			backToTop = function () {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					$('#back-to-top').addClass('show');
				} else {
					$('#back-to-top').removeClass('show');
				}
			};
		backToTop();
		$(window).on('scroll', function () {
			backToTop();
		});
		$('#back-to-top').on('click', function (e) {
			e.preventDefault();
			$("html,body").animate({
                scrollTop: 0
            }, 2000, "easeInOutExpo");
			return false;
		});
	}
	
	if($(".publish_on").length)
	{
		$(".publish_on").each(function() {
			var format = $(this).attr('data-format');
			var date = new Date();
			date.setDate(date.getDate());
			$(this).datepicker({
				autoclose:true,
				format : format,
				startDate:date
			});
		});
	}
	
	$('.gallery_images').magnificPopup({
	  delegate: 'a', 
	  type: 'image',
	  gallery:{
		enabled:true
	  }
	});
	
	$('#toggle-one').bootstrapToggle({
		  on: 'Yes, I am attending',
		  off: 'No, I am Not attending'
		});
		
	$('#toggle-one').on('change',function() {
		if($(this).prop('checked') === true){
			$("#functions").show();
			$(this).val('yes');
			
		}else{
			$("#functions").hide();
			$(this).val('no');
			
		}
		
	});
	
	$("#gift_btn").on("click", function() {
		var bottom = $(".partner-grids").offset().top;
		
		$(".partner-grids").animate({
			scrollTop: bottom
		}, 700);
		return false;
	});
	
	if($('.register_form').length)
	{
		function removePhpCookie(cookieName)
		{
			var cookieValue = "";
			var cookieLifetime = -1;
			var date = new Date();
			date.setTime(date.getTime()+(cookieLifetime*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
			document.cookie = cookieName+"="+JSON.stringify(cookieValue)+expires+"; path=/";
		}

		$.validator.addMethod(
			"regex",
			function(value, element, regexp) {
				var check = false;
				return this.optional(element) || regexp.test(value);
			},
			"Please provide a valid username."
		);
		jQuery.validator.addMethod("noSpace", function(value, element) { 
		  return value.indexOf(" ") < 0 && value != ""; 
		}, "Username didn't accept space between characters.");
		
		var validator = $( "#register_form" ).validate({
			//ignore: "input[type='file']#att_photo",
			normalizer: function( value ) {
				return $.trim( value );
			},
			rules: 
			{
				first_name: 
					{
						required: true
					},
				last_name: 
					{
						required: true
					},
				username: {
					required: true,
					minlength: 5,
					noSpace: true,
					regex: /^[a-z0-9_]+$/,
					//alphanumeric: true,
					"remote":
                    {
                      url: base_url+'ajax/user_field_validation_callback_func',
                      type: "post",
                      data:
                      {
						  field_type:'user_name',
                          field_value: function()
                          {
                              return $('#register_form :input[name="username"]').val();
                          }
                      },
					  beforeSend: function (response) {
						  $('#register_form :input[name="username"]').siblings('.fa').attr('class','fa fa-spinner fa-spin').show();
					  },
					  complete: function () {
							
					  },
					  dataFilter: function (responseString) {
							var response = jQuery.parseJSON(responseString);
							if(response)
							{
								$('#register_form :input[name="username"]').siblings('.fa').attr('class','fa fa-check text-success');
								return 'true';
							}
							else
							{
								$('#register_form :input[name="username"]').siblings('.fa').attr('class','fa fa-close text-danger');
								return 'false';
							}
							 
						},
                    }
				  },
				email: {
					required: true,
					email: true,
					"remote":
                    {
                      url: base_url+'ajax/user_field_validation_callback_func',
                      type: "post",
                      data:
                      {
						  field_type:'user_email',
                          field_value: function()
                          {
                              return $('#register_form :input[name="email"]').val();
                          }
                      },
					  beforeSend: function (response) {
						  $('#register_form :input[name="email"]').siblings('.fa').show();
					  },
					  complete: function () {
							
					  },
					  dataFilter: function (responseString) {
							var response = jQuery.parseJSON(responseString);
							if(response)
							{
								$('#register_form :input[name="email"]').siblings('.fa').attr('class','fa fa-check text-success');
							}
							else
							{
								$('#register_form :input[name="email"]').siblings('.fa').attr('class','fa fa-close text-danger');
							}
						},
                    }
				  },
				password:
				{
					required: true,
					minlength: 8
				},
				repeat_password:
				{
					required: true,
					equalTo: password,
					minlength: 8
				},
			},
			messages:{
			  username:{
				remote:'Username not available. Please try another username.'
			  },
			  email:{
				remote:'Email already registered. Please try another email.'
			  },
			},
			
		  submitHandler: function(form) {
			
		  }
			
		});
		
		if($('.register_form').find('.photo_url_field').length)
		{
			$("#register_form").validate();
			$("input#att_photo_hidden").rules("add", "required");
		}
		
		$('#register_form').on('submit',function() {
			if ($('#register_form').valid()) {
				$('.submit-contact-form-btn').html('Registering...');
			
			
			
			removePhpCookie("PHPSESSID");
            $.ajax({
                type: 'POST',
                url: base_url+'ajax/register_user_form_callback_func',
                dataType: "json",
                data: $(this).serialize(),
                success: function(result) {
					$('.submit-contact-form-btn').html('Register');
					$('#register_form h4').after(result.output);
					$('#register_form .fa').hide();
					$('#register_form')[0].reset();
					
					if($('#register_form').find('.custom-file-upload').length)
					{
						var profile_img_parent = $('#register_form');
						var pi_id = 'att_photo';
						profile_img_parent.find('#'+pi_id+'_link').removeAttr('href').removeAttr('download');
						profile_img_parent.find('#'+pi_id+'_link img').removeAttr('src');
						profile_img_parent.find('#'+pi_id+'_link').hide();
						profile_img_parent.find('#'+pi_id+'_remove_img').hide();
						profile_img_parent.find('#'+pi_id+'_remove_img .fa').show();
						profile_img_parent.find('#'+pi_id).parent().show();
						profile_img_parent.find('#'+pi_id+'_hidden').val('');
					}
					
					if(result.auto_redirect == 'Y')
					{
						window.location.href = base_url+'admin/main';
					}
					else
					{
						$('html,body').animate({
							scrollTop: 200
						}, 700);
					}
				},
            });
			
			}
		});
		
	}
	
	var w = 600;
	var h = 400;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	
	$('.social-share-btn').each(function() {
		$(this).attr('onclick',$(this).attr('onclick').replace('LEFT_POS',left));
		$(this).attr('onclick',$(this).attr('onclick').replace('TOP_POST',top));
	});
	
});
