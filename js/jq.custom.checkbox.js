(function($) {
jQuery.fn.custom_chk = function (options) {
	var default_options = {
		class_active: "active_chk",
		class_mouse_over: "mouse_over_chk"
	};

	options = $.extend(default_options,options);
		
	return this.each(function() {
		var div = $(this);
		 
		var checkbox = $('input[type=checkbox]',this);
		
		
		if (checkbox.attr('checked')==true){
			div.addClass(options.class_active);
		}		
		 
		 div.click(function(){
			if (div.hasClass(options.class_active)){
				div.removeClass(options.class_active);
				checkbox.removeAttr("checked");
			}
			else{
				div.addClass(options.class_active);
				div.removeClass(options.class_mouse_over);
				checkbox.attr('checked','checked');
			}
		 });
		 
		 div.mouseover(function(){
			if (!div.hasClass(options.class_active)){
				div.addClass(options.class_mouse_over);		
			}				
		 });
		 
		 div.mouseout(function(){
			div.removeClass(options.class_mouse_over);
		 });
    });
}
})(jQuery);