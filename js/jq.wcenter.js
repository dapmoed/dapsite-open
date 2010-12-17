(function($) {
jQuery.fn.wcenter = function () {
	return this.each(function() {
		 var div = $(this);		 
		 div.css({
			top: parseInt($(window).height()/2)-parseInt(div.height()/2),
			left: parseInt($(window).width()/2)-parseInt(div.width()/2),
			position: "fixed"
		 });
    });
}
})(jQuery);