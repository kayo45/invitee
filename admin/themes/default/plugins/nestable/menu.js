
function escapeMenuHtml(text) {
	var filter_data = DOMPurify.sanitize(text, {SAFE_FOR_TEMPLATES: true});
	return jQuery.trim(filter_data);
}

var updateOutput = function (e) {
  
  var list = e.length ? e : $(e.target),
      output = list.data('output');
  if (window.JSON) {
    if (output) {
      output.val(window.JSON.stringify(list.nestable('serialize')));
    }
  } else {
    alert('JSON browser support required for this page.');
  }
  
};

var nestableList = $(".nestable_menus .nestable > .dd-list");


var deleteFromMenuHelper = function (target) {
  if (target.data('new') == 1) {
    target.fadeOut(function () {
      target.remove();
      updateOutput($('.nestable_menus .nestable').data('output', $('#json-output')));
    });
  } else {
    target.appendTo(nestableList); 
    target.data('deleted', '1');
    target.fadeOut();
  }
};

var deleteFromMenu = function (e) {
	e.preventDefault();
  var targetId = $(this).data('owner-id');
  var target = $(this).parent();
  var result = confirm("Delete " + target.data('name') + " and all its subitems ?");
  if (!result) {
    return;
  }

  target.find("li").each(function () {
    deleteFromMenuHelper($(this));
  });

  deleteFromMenuHelper(target);

  updateOutput($('.nestable_menus .nestable').data('output', $('#json-output')));
};





var addToMenu = function (thiss) {
   
   var menu_type = thiss.parents('.box').find('.menu_type').val();
   
   if(menu_type == 'page' || menu_type == 'static' || menu_type == 'homepage')
   {
	   var menuTypeTitle = '';
	   if(menu_type == 'page') var menuTypeTitle = 'Page';
	   if(menu_type == 'homepage') var menuTypeTitle = 'Static Section';
	   if(menu_type == 'static') var menuTypeTitle = 'Static Page';
	   var has_checked = false;
	   thiss.parents('.box').find('.checkbox').each(function(){
			if($(this).find('.minimal').prop("checked"))
			{
				var newName = $(this).find('.minimal').attr('data-title');
				var newId = $(this).find('.minimal').val();
				nestableList.append(
					'<li class="dd-item" ' +
					'data-id="' + newId + '" ' +
					'data-name="' + newName + '" ' +
					'data-new="1" ' +
					'data-menu_type="' + menuTypeTitle + '" ' +
					'data-deleted="0">' +
					'<div class="dd-handle">' + newName + '<span>'+ menuTypeTitle+'</span></div> ' +
					'<span class="button-delete btn btn-default btn-xs pull-right" ' +
					'data-owner-id="' + newId + '"> ' +
					'<i class="fa fa-times-circle-o" aria-hidden="true"></i> ' +
					'</span>' +
					'</li>'
				  );
				has_checked = true;
			}
	   });
	   
	   if(has_checked)
	   {
		   thiss.parents('.box').find('.checkbox').each(function(){
			   if($(this).find('.minimal').prop("checked"))
			   {
				   $(this).find('.minimal').iCheck('uncheck');
			   }
		   });
	   }
   }   
   else if(menu_type == 'custom_link' )
   {
	   var cl_url = escapeMenuHtml(thiss.parents('.box').find('.cl_url').val());
	   var cl_title = escapeMenuHtml(thiss.parents('.box').find('.cl_title').val());
	   
	   if(cl_url != '' && cl_title != '')
	   {
			var newName = cl_title;
			var newId = 'custom_link~'+cl_url;
			nestableList.append(
				'<li class="dd-item" ' +
				'data-id="' + newId + '" ' +
				'data-name="' + newName + '" ' +
				'data-new="1" ' +
				'data-menu_type="Custom Link" ' +
				'data-deleted="0">' +
				'<div class="dd-handle">' + newName + '<span>Custom Link</span></div> ' +
				'<span class="button-delete btn btn-default btn-xs pull-right" ' +
				'data-owner-id="' + newId + '"> ' +
				'<i class="fa fa-times-circle-o" aria-hidden="true"></i> ' +
				'</span>' +
				'</li>'
			  );
			thiss.parents('.box').find('.cl_url').val('http://');
			thiss.parents('.box').find('.cl_title').val('');
	   }
	   else
	   {
		   thiss.parents('.box').find('.cl_url').val('http://');
		   thiss.parents('.box').find('.cl_title').val('');
	   }
   }
   
  updateOutput($('.nestable_menus .nestable').data('output', $('#json-output')));

};

$(function () {
	"use strict";
	
	$(document).delegate(".nestable_menus .nestable .button-delete",'click',deleteFromMenu);
	
	$(".add_to_menu").on('click',function (e) {
		e.preventDefault();
		var thiss = $(this);
		addToMenu(thiss);
	  });
	  
	updateOutput($('.nestable_menus .nestable').data('output', $('#json-output')));
});