(function($) {
jQuery.fn.imghover = function () {
	
	return this.each(function() {
		var div = $(this);				
		
		if ($(this).attr("hover")!=null){
		
			div.css({
				cursor: "pointer"
			});
			
			div.mouseover(function(){
				div.attr({src: $(this).attr("hover")});
			});
			
			div.mouseout(function(){
				div.attr({src: $(this).attr("no_hover")});
			})
		}		
    });
}
})(jQuery);