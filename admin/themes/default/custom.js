var id, img_data;


$(function () {

  "use strict";
	
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
		var del_leng = $('.media_container .album_images.selected').length;
		if(del_leng > 0)
		{
			if(del_leng == 1)
				$('.select-msg-text-block').html(del_leng+' image selected');
			else
				$('.select-msg-text-block').html(del_leng+' images selected');
			$('.remove-album-images').removeClass('disabled');
		}
		else
		{
			$('.select-msg-text-block').html('(Click on image to select multiple)');
			$('.remove-album-images').addClass('disabled');
		}
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
		
		$('.show_hide_block_btn:not(".child_element_block")').change(function() {
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
		var value =  escapeHtml(thiss.val());
		thiss.val(value);
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
	
	
	$('.skin-container li a').on('click',function() {
		var skin = $(this).attr('data-skin');
		$('.option_skin').val(skin);
		$('.skin-container li a').addClass('full-opacity-hover');
		$(this).removeClass('full-opacity-hover');
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
	
	
	
	$(document).delegate('.album_images','click',function() {
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
		
	$('.remove-album-images').on('click',function() {
		if(!$(this).hasClass('disabled'))
		{
			
			var strconfirm = confirm('Are you sure you want to delete?');
			if (strconfirm == true)
			{
				$('.full_sreeen_overlay').show();
				$('.media_container .album_images.selected').each(function() {
					$(this).find('.remove_album_image').trigger('click');
				});
				
				$('.select-msg-text-block').html('(Click on image to select multiple)');
				$('.remove-album-images').addClass('disabled');
			}
			$('.full_sreeen_overlay').hide();
		}
		
		return false;
	});
		
	$(document).delegate('a.remove_album_image','click',function() {
		var id = $(this).attr('data-name');
		var thiss = $(this);
		var img_name = $('#'+id+'_hidden').val();
		var image_type =  $('#'+id).attr('data-type');
		$('.full_sreeen_overlay').show();
		$.ajax({
			url: base_url+'ajax_images/delete_gallery_images_callback_func',
			type: 'POST',
			success: function (res) {
				if(res == 'success')
				{
					if(image_type == 'photo_gallery')
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
		
	$('.select-all-album-btn').on('click',function() {
		$('.media_container .album_images').addClass('selected');
		$('.media_container .album_images').find('.select-check').removeClass('hide');
		cal_deleted_img();
		return false;
	});
	
	$('.unselect-all-album-btn').on('click',function() {
		$('.media_container .album_images').removeClass('selected');
		$('.media_container .album_images').find('.select-check').addClass('hide');
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
				&& !$(element).hasClass('no_clean') && !$(element).hasClass('assign_to_list') && !$(element).hasClass('openstreetmap_embed_code'))
			{
				var updated_string = escapeHtml($(element).val());
				$(element).val(updated_string);
			}
		});
		
		
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
			$('html,body').animate({
				scrollTop: 0
			}, 700);
		});
	}
	
	$(".from_date").datepicker({
	  autoclose: true,
	}).on('changeDate', function (selected) {
		var startDate = new Date(selected.date.valueOf());
		$('.to_date').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('.to_date').datepicker('setStartDate', null);
	});
	
	$(".to_date").datepicker({
	   autoclose: true,
	}).on('changeDate', function (selected) {
	   var endDate = new Date(selected.date.valueOf());
	   $('.from_date').datepicker('setEndDate', endDate);
	}).on('clearDate', function (selected) {
	   $('.from_date').datepicker('setEndDate', null);
	});
	
	$(".datepicker").datepicker({
		autoclose:true
	});
	
	var date = new Date();
	
	date.setDate(date.getDate());
	$(".datepicker_elem").datepicker({
		autoclose:true,
		startDate: date,
		todayHighlight: true
	}).on("show", function (e) {
		if (e.date) {
			$(this).data("stickyDate", e.date);
		}
		else {
			$(this).data("stickyDate", null);
		}
	}).on("hide", function (e) {
		var stickyDate = $(this).data("stickyDate");

		if (!e.date && stickyDate) {
			$(this).datepicker("setDate", stickyDate);
			$(this).data("stickyDate", null);
		}
	});
	
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue'
	});
	
	$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	  checkboxClass: 'icheckbox_minimal-red',
	  radioClass: 'iradio_minimal-red'
	});
	
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	  checkboxClass: 'icheckbox_flat-red',
	  radioClass: 'iradio_flat-red'
	});

	$('input[type="checkbox"].minimal-green, input[type="radio"].minimal-green').iCheck({
	  checkboxClass: 'icheckbox_minimal-green',
	  radioClass: 'iradio_minimal-green'
	});
	
	$('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
	  checkboxClass: 'icheckbox_flat-green',
	  radioClass: 'iradio_flat-green'
	});
	
	$(".sidebar").slimscroll({
		height: ($(window).height() - $(".main-header").height()) + "px",
		color: "rgba(0,0,0,0.2)",
		size: "3px"
	  });
	
	$(".control-sidebar .tab-pane .scrollable_tab").slimscroll({
		height: (($(window).height() - ($(".main-header").height() + $('.control-sidebar ul.nav-tabs').height() + ($('.control-sidebar .tab-content h3.control-sidebar-heading').height()*4)) )+5) + "px",
		color: "rgba(0,0,0,0.2)",
		size: "3px"
	  });
	
	if($('.ckeditor-element').length)
	{
		var path = base_url.replace("/admin","");
		$('.ckeditor-element').each(function(e) {
			var cur_elem_id = $(this).attr('id');
			var lang_code = $(this).attr('data-lang_code');
			var lang_dir = $(this).attr('data-lang_dir');
			var editor = CKEDITOR.replace( cur_elem_id,{
				language: lang_code,
				contentsLangDirection : lang_dir,
				filebrowserBrowseUrl: path+'ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl: path+'ckfinder/ckfinder.html?type=Images',
				filebrowserUploadUrl: path+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			});
			editor.config.removeButtons = 'Language';
			var extra =["codesnippet","youtube"];
			editor.config.extraPlugins=extra;
			editor.config.basicEntities = false;
		});
	}
	
	if($('.short-description-element').length)
	{
		var maxLength = 150;
		$('.short-description-element').keyup(function() {
		  var textlen = maxLength - $(this).val().length;
		  $(this).parents('.form-group').find('.rchars').text(textlen);
		});
		
		$('.short-description-element').each(function(e) {
			var textlen = maxLength - $(this).val().length;
			$(this).parents('.form-group').find('.rchars').text(textlen);
		});
	}
	
	$('.datatable-element').DataTable({
	  "paging": true,
	  "lengthChange": false,
	  "searching": true,
	  "ordering": false,
	  "info": true,
	  "autoWidth": false
	});
	
	$('.datatable-element-scrollx').DataTable({
	  "paging": true,
	  "lengthChange": false,
	  "searching": true,
	  "ordering": false,
	  "info": true,
	  "autoWidth": false,
	  "scrollX": true,
	});
	
	$('.alert:not(".show_always")').delay(5000).fadeOut('slow');
	
	if($('.show_hide_setting_elem').length)
	{
		$('.show_hide_setting_elem').each(function() {
			var thiss = $(this);
			var elem_name = thiss.attr('name');
			var show_hide_elem = thiss.attr('data-elem');
			$('.'+show_hide_elem).hide();
			var target = $("input[name='"+elem_name+"']:checked").attr('data-target');
			$('.'+target).show();
		});
		
		$('.show_hide_setting_elem').on('change',function() {
			var thiss = $(this);
			var elem_name = thiss.attr('name');
			var show_hide_elem = thiss.attr('data-elem');
			$('.'+show_hide_elem).hide();
			var target = $("input[name='"+elem_name+"']:checked").attr('data-target');
			$('.'+target).show();
		});
	}
	
	$('.select2_elem').select2({
		width:'100%'
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
	
	$(".timepicker_elem").timepicker({});
	
	$('.export_front_lang_form').on('submit',function() {
		var thiss = $(this);
		
		
		$('.full_sreeen_overlay').show();
		$.ajax({
			url: base_url +'ajax/export_lang_keyword_callback_func',
			type: 'POST',
			success: function (res) {
				if($('input:radio[name="export_type"]:checked').val() == 'save')
				{
					$('.page-title').after('<div class="alert alert-success alert-dismissable" style="margin-top:10px; margin-bottom:0px;">'+
						'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
						 'Keyword Export Successfully'+
					'</div>');
				}
				else
				{
					var data = new Blob([res.file_content], {type: 'text/plain'});

					var textFile;
					if (textFile !== null) {
					  window.URL.revokeObjectURL(textFile);
					}

					textFile = window.URL.createObjectURL(data);
					
					var link=document.createElement('a');
					 link.href=textFile;
					 link.setAttribute('download',res.file_name);
					 document.body.appendChild(link);
					 link.click();
					 link.remove();
				}
				thiss.find('.select2_elem').val('').trigger('change');
				thiss.find('input:radio[value="download"]').attr('checked',true).trigger('change');
				thiss[0].reset();
				
				$('.alert').delay(5000).fadeOut('slow');
				$('.full_sreeen_overlay').hide();
			},
			data: thiss.serialize(),
			cache: false
		});
		return false;
	});
	
	$('.import_admin_lang_form').on('submit',function() {
		var thiss = $(this);
		$('.full_sreeen_overlay').show();
		$.ajax({
			url: base_url +'ajax/import_lang_keyword_callback_func',
			type: 'POST',
			success: function (res) {
				thiss.find('.select2_elem').val('').trigger('change');
				thiss.find('input:radio[value="N"]').attr('checked',true).trigger('change');
				thiss[0].reset();
				$('.page-title').after('<div class="alert alert-success alert-dismissable" style="margin-top:10px; margin-bottom:0px;">'+
					'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
					 'Keyword Imported Successfully'+
				'</div>');
				$('.alert').delay(5000).fadeOut('slow');
				$('.full_sreeen_overlay').hide();
			},
			data: thiss.serialize(),
			cache: false
		});
		return false;
	});
	
	$('.import_front_lang_form').on('submit',function() {
		var thiss = $(this);
		$('.full_sreeen_overlay').show();
		$.ajax({
			url: base_url +'ajax/import_lang_keyword_callback_func',
			type: 'POST',
			success: function (res) {
				thiss.find('.select2_elem').val('').trigger('change');
				thiss.find('input:radio[value="N"]').attr('checked',true).trigger('change');
				thiss[0].reset();
				$('.page-title').after('<div class="alert alert-success alert-dismissable" style="margin-top:10px; margin-bottom:0px;">'+
					'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
					 'Keyword Imported Successfully'+
				'</div>');
				$('.alert').delay(5000).fadeOut('slow');
				$('.full_sreeen_overlay').hide();
			},
			data: thiss.serialize(),
			cache: false
		});
		return false;
	});
	
	$('.export_admin_lang_form').on('submit',function() {
		var thiss = $(this);
		
		
		$('.full_sreeen_overlay').show();
		$.ajax({
			url: base_url +'ajax/export_lang_keyword_callback_func',
			type: 'POST',
			success: function (res) {
				if($('input:radio[name="export_type"]:checked').val() == 'save')
				{
					$('.page-title').after('<div class="alert alert-success alert-dismissable" style="margin-top:10px; margin-bottom:0px;">'+
						'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
						 'Keyword Export Successfully'+
					'</div>');
				}
				else
				{
					var data = new Blob([res.file_content], {type: 'text/plain'});

					var textFile;
					if (textFile !== null) {
					  window.URL.revokeObjectURL(textFile);
					}

					textFile = window.URL.createObjectURL(data);
					
					var link=document.createElement('a');
					 link.href=textFile;
					 link.setAttribute('download',res.file_name);
					 document.body.appendChild(link);
					 link.click();
					 link.remove();
					
				}
				thiss.find('.select2_elem').val('').trigger('change');
				thiss.find('input:radio[value="download"]').attr('checked',true).trigger('change');
				thiss[0].reset();
				
				$('.alert').delay(5000).fadeOut('slow');
				$('.full_sreeen_overlay').hide();
			},
			data: thiss.serialize(),
			cache: false
		});
		return false;
	});
	
	if($('.nav-tabs-custom').length)
	{
		$(window).scroll(function(){
			if ($(window).scrollTop() >= 100) {
				$('.nav.nav-tabs').addClass('fixed-tab');
			}
			else {
				$('.nav.nav-tabs').removeClass('fixed-tab');
			}
		});
	}
	
	$('#sendMail').on('click',function(e){
		var checkbox = $('#friends_table').find('td #friends');
		$(document).find("#recipient-name").html('');
		if(checkbox.is(':checked')) {
			 var allVals = [];
			 $('#friends_table :checked').each(function() {
			   allVals.push($(this).data('email'));
			 });
			 allVals.forEach((element) => {
				 $(document).find("#recipient-name").append('<option value="'+element+'" selected>'+element+'</option>');
				 var existingEmailAddresses = allVals;

					$("#recipient-name").val(existingEmailAddresses).select2({
						width: "auto",
						multiple: true,
					});
			});
			 $("#sendMailBox").modal("show");
		}else{
			alert('Pelase Select Atleast One Friend');
			$("#sendMailBox").modal("hide");
		}
	});
	
	$("#select_all").on('click',function(e){
			$(document).find("#recipient-name").html('');
			$.ajax({
				url: base_url+"ajax/getFriendsEmail",
				type: 'GET',
				dataType: 'json', 
				success: function(res) {
					let arr = res.split(',');
					arr.forEach((element) => {
						 $(document).find("#recipient-name").append('<option value="'+element+'" selected>'+element+'</option>');
						 var existingEmailAddresses = arr;

							$("#recipient-name").val(existingEmailAddresses).select2({
								width: "auto",
								multiple: true,
							});
					});
												
					$("#sendMailBox").modal("show");
				}
			});
				
			
	});

	$("#send").on('click',function(e){
		var msg = $(document).find("#message").val();
		var rec = $(document).find("#recipient-name").val();
		if(msg != ''){
			$.ajax({
				url: base_url+"ajax/sendMail",
				type: 'POST',
				data:{recipient:rec,msg:msg},
				dataType: 'json', 
				success: function(res) {
					$(document).find("#error").html(res);		
				}
			});
		}else{
			$(document).find("#error").html('Please Wrtie Message To Send Mail');
		}
		
	});
	 
	
	if($(".dashboard-section").length){
		
		$('.dashboard-form').on('submit',function() {
			var thiss = $(this);
			$.ajax({
				url: base_url+"ajax/submit_dashboard_form_wizard_callback_func",
				type: 'POST',
				data: thiss.serialize(),
				dataType: 'json', 
				success: function(res) {
					if(res > 3)
					{
						$('.unfill-form-block').hide();
						$('.fill-form-block').show();
					}
					else
					{
						$('.fill-form-block').hide();
						$('.unfill-form-block').show();
					}
				}
			});
		});
		
		
		function update_form_content()
		{
			$('.on-change-cls').each(function() {
				  var target = $(this).attr('data-target');
				  var cur_val = $(this).val();
				  $('#'+target).html(cur_val);
			});
		  
		  $('.on-image-change-cls').each(function() {
			  var cur_img = $(this).attr('src');
			  var target = $(this).attr('data-target');
			 
			  if(cur_img === 'undefined' || cur_img === null || cur_img == '')
			  {
				  $('#'+target).attr('src','').hide();
			  }
			  else
			  {
				  $('#'+target).attr('src',cur_img).show();
			  }
		  });
		  
		}

		function setClasses(index, steps) {
			update_form_content();
			
			if (index < 0 || index > steps) return;
			
			if(index == 0) {
			  $("#prev").prop('disabled', true);
			} else {
			  $("#prev").prop('disabled', false);
			  
			}
			if(index == steps) {
			  $("#next").text('Done');
			  $("#next").attr('type','submit');
			  
			  $('.box-footer').hide();
			  
			} else {
			  $("#next").text('Next');
			  $("#next").removeAttr('type');
			  $('.box-footer').show();
			}
			
			$(".step-wizard ul li").each(function() {
			  $(this).removeClass();
			});
			
			$(".step-wizard ul li:lt(" + index + ")").each(function() {
			  $(this).addClass("done");
			});
			
			$(".step-wizard ul li:eq(" + index + ")").addClass("active");
			
			$('.tab-block').hide();
			
			var cur_tab = $(".step-wizard ul li:eq(" + index + ") > button").attr('id');
			$('.'+cur_tab).show();
			
			var p = index * (100 / steps);
			$("#prog").width(p + '%');
		}

		$(".step-wizard ul button").on('click',function() {
			
			var step = $(this).find("div.step")[0].innerText;   
			var steps = $(".step-wizard ul li").length;
			setClasses(step - 1, steps - 1);
			return false;
			
		  });
		  
		  $("#prev").on('click',function(){
			var step = $(".step-wizard ul li.active div.step")[0].innerText;
			var steps = $(".step-wizard ul li").length;    
			setClasses(step - 2, steps - 1);
			return false;
		  });
		  
		  $("#next").on('click',function(){
			 
			if ($(this).text() == 'Done') {
			  
			} else {
			  $('.dashboard-form').submit();
			  var step = $(".step-wizard ul li.active div.step")[0].innerText;
			  var steps = $(".step-wizard ul li").length;    
			  setClasses(step, steps - 1);
			  return false;
			}
			});
		
		if($('input[type="hidden"][name="cur_tab"]').val() != '')
			setClasses($('input[type="hidden"][name="cur_tab"]').val(), $(".step-wizard ul li").length - 1);
		else			
			setClasses(0, $(".step-wizard ul li").length - 1);
	}
	
	$('.homepage_section_container .form-group').on('click',function() {
		$('.homepage_section_container .form-group').removeClass('active');
		$(this).addClass('active');
	});
	
	$('.site_name_pre,.site_name_post').on('blur',function() {
		var site_name_pre = $('.site_name_pre').val();
		var site_name_post = $('.site_name_post').val();
		
		var site_name_pre = site_name_pre.toLowerCase();
		var site_name_post = site_name_post.toLowerCase();
		
		$('.site_name_pre').val(site_name_pre);
		$('.site_name_post').val(site_name_post);
		
		if(site_name_pre == '' && site_name_post == '')
			$('input[type="hidden"][name="site_name"]').val('');
		else
			$('input[type="hidden"][name="site_name"]').val(site_name_pre+'-weds-'+site_name_post);
	});
});