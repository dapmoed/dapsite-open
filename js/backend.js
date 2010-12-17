$(document).ready(function(){	
	/* Если у картинки есть атрибуты для изменения рисунка при наведении то срабатывает плагин */
	$("img").imghover();
	
	/* Нажатия на кнопкт Перейти на сайт и Логаут */
	$("#btn_on_site").click(function(){
	});
	
	$("#btn_logout").click(function(){
	});
	
	/* Создание главного меню */
	$(".main_menu").main_menu();
});