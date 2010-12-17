$(document).ready(function(){	
	$(window).resize(function(){
		$("#container").wcenter();
		$("#abstract").wcenter();
	});
	$("#container").wcenter();
	$("#abstract").wcenter();
	
	$(".input_checkbox").custom_chk();
	
	$("#container").notify_form_login();
	
	$("#input_username").focus();
	
	$("#form_login").submit(function(){
		var notify = $("#notify_form_login");
		var inputs = $("input[type=text],input[type=password]","#form_login");
		var error_text = '<div class="name_notify">Ошибка</div><ul>';
		var flag_empty = false;
		inputs.each(function(){	
			if ($(this).val()==''){
				flag_empty = true;
				error_text += '<li>'+$(this).attr("error")+'</li>'
			}
		});
		error_text += '</ul><center>Для продолжения нажмите ESC.</center>';
		if (flag_empty){
			$("#notify_form_login").html(error_text);
			notify.wcenter();
			$("#block_form").show();
			notify.fadeIn("slow");
			return false;
		}
	});
});