(function($) {
jQuery.fn.main_menu = function (options) {
	var default_options = {
	}
	
	var domain = '/dapsite/';
	
	options = $.extend(default_options,options);
	main_menu = this;
	
	$(".sub_menu_li").live("click",function(){
		/* Скрытие подменю */
		$("#sub_menu").animate({"margin-left": -$("#sub_menu").width()-100},100);
		/* Скрытие указателя активного меню */
		$("#pointer_line").animate({"width":0},100);
		/* Снятие активности меню */
		$("li",main_menu).each(function(){
			var div1 = $(this);
			div1.removeClass("active");
		});
	});
	
	return $("li",this).each(function() {
		var div = $(this);
		div.disableSelection();
		var icon = $(".menu_icon",this);
		var sub_menu = $("#sub_menu");
		var sub_menu_width = sub_menu.width();
		var submenu_container = $("#submenu_container");
		
		sub_menu.css({
				"margin-left": -sub_menu_width-100
		});
		
		/* Добавление картинки к быкгранду элемента Иконка */
		if (icon.attr("src")!=null){
			icon.css({
				background: "url("+icon.attr("src")+") 110px 8px no-repeat"
			});
		};
		/* Добавление класса активности при наведении */
		div.mouseover(function(){
			if (!div.hasClass("mover")){
				div.addClass("mover");
			}
		});
		/* Удаление класса активности при отведении мыщи от элемента */
		div.mouseout(function(){
			div.removeClass("mover");
		});
		
		/* При щелчке элемент становится активным, остальные теряют активность */
		div.click(function(){
			sub_menu_width = sub_menu.width();
						
			if (div.hasClass('active')){
				div.removeClass("active");
				
				/* Скрытие подменю */
				$("#sub_menu").animate({"margin-left": -sub_menu_width-100},100);
				
				/* Скрытие картинки загрузки аякса */
				
				/* Скрытие указателя активного меню */
				$("#pointer_line").animate({"width":0},100);
			}
			else{
				$("li",main_menu).each(function(){
					var div1 = $(this);
					div1.removeClass("active");
				});
				div.addClass("active");	
				
				/* Анимация указателя активного элемента меню */
				
				/* Скрытие подменю */
				$("#sub_menu").animate({"margin-left": -sub_menu_width-100},100,function(){
										
					/* Отправка запроса на возвращение списка подменю */
					$.ajax({
					  url: domain+'backend/index/backend?act=submenu&id='+div.attr("id_menu"),
					  dataType: 'json',
					  success: function(json){
						if (json!=null){
						if (json.status==true){
							/* Скрытие картинки аякс загрузки */
							submenu_container.html('<ul></ul>');
							$.each(json.submenu, function(i,submenu){
								html = '<li class="sub_menu_li" style="background: url('+domain+'images/'+submenu.img+') top left no-repeat;"><a href="'+submenu.link+'">'+submenu.title+'</a></li>';
								$('ul',submenu_container).append(html);
							})
							/* Появление подменю */
							$("#sub_menu").animate({"margin-left": 0},100);
							$("#pointer_line").animate({"width":div.offset().left+parseInt(div.width()/2)+10},100);
						}
						else{
							
						}
						}
					  },
					  beforeSend: function(){
						/* Отображение картинки аякс загрузки */
						submenu_container.html('<div class="ajax_loader">Загрузка...</div>');
						$(".ajax_loader").divcenter().fadeIn("slow");
					  }
					});
				});
				
			}
		});
    });
}
})(jQuery);