(function($) {
jQuery.ajax_loader = function (options) {
	var default_options = {
		'type': 'backend'
	}
	options = $.extend(default_options,options);
		
	switch (options['type']){
		case 'backend':{
			$(document).ajaxStart(function(){
				$("<div id='ajax_loader_backend'>Выполняется запрос</div>").prependTo("body").hide().fadeIn("slow");
			});
			
			$(document).ajaxStop(function(){
				$("#ajax_loader_backend").fadeOut("slow",function(){
					$(this).remove();
				})
			});
		}
		break;
		default:{}break;
	}
	return this;	
}
})(jQuery);
$.ajax_loader();