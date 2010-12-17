(function($) {
jQuery.fn.sloind_table = function (options) {
	var default_options = {
	}
	options = $.extend(default_options,options);
	
	function scan_table(object_table){	
		$(".checked_row",object_table).each(function(){
			$(this).parent().parent().removeClass("checked_row");
			
			if ($(this).attr("checked")){
				$(this).parent().parent().addClass("checked_row");
			}
		});
	};	
	
	function count_check_row(object_table){	
		count = 0;
		$(".checked_row",object_table).each(function(){
			if ($(this).attr("checked")){
				count++;
			}
		});
		return count;
	};	
	
	//Добавление селекта Выбор действия для группы обектов
	action_table = $(".action_table",this).clone();
	$(".action_table",this).remove();
	action_table.appendTo($(".bottom_table",this));
			
	return $("table",this).each(function() {
		var div = $(this);
		scan_table(div);
		
		$("input[type=checkbox]",div).live("change",function(){
			scan_table(div);
		})
		
		$("input[name=ch_all]",div).live("change",function(){
			flag = false;
			$("input[type=checkbox]",div).each(function(){
				if (!$(this).attr("checked")){
					flag = true;
				}
			});
			
			if (flag){
				$("input[type=checkbox]",div).attr("checked","checked");
			}
			else{
				$("input[type=checkbox]",div).removeAttr("checked");
			}
			scan_table(div);
			$("input[name=ch_all]",div).removeAttr("checked");
		});	
    });
}
})(jQuery);