(function($) {
jQuery.fn.backend_notify = function () {
	$(this).live('click',function(){
			$(this).animate({height: 0,opacity: 0},{duration:100,complete:function(){
				$(this).remove();
				$(".notify_wraper").height("auto");
			}});
			
	});
	
	return this.each(function() {
		var div = $(this);
		
    });
}

jQuery.add_notify = function (options) {
	var default_options = {
		'type': 'warning',
		'text': 'Внимание!'
	}
	options = $.extend(default_options,options);

	if ($(".notify_wraper").find('div').is("div")){
		height_notify_wraper = $(".notify_wraper").height();
	}
	else{
		height_notify_wraper = "auto";
	}
	
	$(".notify_wraper").html('').height(height_notify_wraper);
	switch (options['type']){
		case 'warning':{
			$("<div class='warning'>"+options['text']+"</div>").appendTo(".notify_wraper").hide().css({height: 0,opacity:0}).animate({height: 35,opacity: 1},{duration:100,complete:100});
		}
		break;
		case 'successfull':{
			$("<div class='successfull'>"+options['text']+"</div>").appendTo(".notify_wraper").hide().css({height: 0,opacity:0}).animate({height: 35,opacity: 1},{duration:100,complete:100});
		}
		break;
		default:{}break;
	}
	
	return this;
}
})(jQuery);
$(".notify_wraper div").backend_notify();