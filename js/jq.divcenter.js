(function($) {
jQuery.fn.divcenter = function () {
	return this.each(function() {
		var div = $(this);
		var parent_div = div.parent();
		var div_top = 	parseInt(parent_div.height()/2)-parseInt(div.height()/2);
		var div_left = parseInt(parent_div.width()/2)-parseInt(div.width()/2);
		
		div.css({
			top: div_top-10,
			left: div_left+70
		});
		
    });
}
})(jQuery);