<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Абстрактный класс реализации компонентной системы
 */
abstract class Kohana_Components {
	
	public static function load($obtained_parametrs,& $template,$global_data){
		//Проверка есть ли переменная дествия если нет то установка дефолта
		if (!isset($global_data['clean_get']['act'])){
			$global_data['clean_get']['act'] = 'main';
		}
		else{
			$global_data['clean_get']['act'] = strip_tags($global_data['clean_get']['act']);
		}
		
		$global_configuration = Kohana_Config::instance()->load('global_configuration');//Общие настройки сайта
		
		if (isset($global_configuration['access_frontend_all'])){
			if (!$global_configuration['access_frontend_all']){
				//Проверка прав доступа текущего пользовател к компоненту и дествию
				switch(Permisions::is_allow(Request::instance()->controller,$obtained_parametrs['com'],$global_data['clean_get']['act'])){
					case 'ALLOW':
						break;
					case 'DISALLOW':
						throw new Kohana_Exception403;
						break;
					case 'UNREGISTER':
						Request::instance()->redirect('login');
						break;
					default:
						break;
				}
			}
		}
				
		if (class_exists($obtained_parametrs['com'])){
			if (method_exists($obtained_parametrs['com'],'view')){
				if (Request::$is_ajax){
					eval("\$result = ".$obtained_parametrs['com']."::view(\$obtained_parametrs,\$global_data);");
					return $result;
				}
				else{
					eval($obtained_parametrs['com']."::view(\$obtained_parametrs,\$global_data,\$template);");
					Loadlib::append($template,$obtained_parametrs['com']);
				}
			}
			else{
				throw new Kohana_Exception404;
			}
		}	
		else{
			throw new Kohana_Exception404;
		}
	}
	
	
	public static function be_load($obtained_parametrs,& $template,$global_data){
		//Проверка есть ли переменная дествия если нет то установка дефолта
		if (!isset($global_data['clean_get']['act'])){
			$global_data['clean_get']['act'] = 'main';
		}
		else{
			$global_data['clean_get']['act'] = strip_tags($global_data['clean_get']['act']);
		}
		
		//Проверка прав доступа текущего пользовател к компоненту и дествию
		$permision = new Model_Permision();
		$result_permision = $permision->is_allow(Request::instance()->controller,$obtained_parametrs['com'],$global_data['clean_get']['act']);
		switch($result_permision){
			case 'ALLOW':
				break;
			case 'DISALLOW':
				throw new Kohana_Exception403;
				break;
			case 'UNREGISTER':
				Request::instance()->redirect('login');
				break;
			default:
				break;
		}
	
		if (class_exists($obtained_parametrs['com'])){
			if (method_exists($obtained_parametrs['com'],'be_view')){
				if (Request::$is_ajax){
					eval("\$result = ".$obtained_parametrs['com']."::be_view(\$obtained_parametrs,\$global_data);");
					return $result;
				}
				else{
					$template->main_content = Templates::be_load('components');
					$template->main_content->notify = Templates::be_load('notify');
					$template->main_content->toolbar_components = Templates::be_load('toolbar_components');
					$template->main_content->footer = Templates::be_load('footer');
					eval($obtained_parametrs['com']."::be_view(\$obtained_parametrs,\$global_data,\$template);");
					Loadlib::append($template,$obtained_parametrs['com']);
				}
			}
			else{
				throw new Kohana_Exception404;
			}
		}	
		else{
			throw new Kohana_Exception404;
		}
	}
	
	//Установка флага активности меню компонента
	public static function determine_activity_com_menu($array_com_menu,$act){
		if (isset($array_com_menu[$act])){
			if (isset($array_com_menu[$act]['active'])){
				$array_com_menu[$act]['active'] = TRUE;
			}
		}
		return $array_com_menu;
	}
		
	public static function notify(& $template,$type,$caption=NULL){
		if (!isset($template->main_content->notify->notifycators)){$template->main_content->notify->notifycators='';}
		switch ($type){
			case 'error':{
				if (!$caption){$caption='Внимание! Запись не была удалена!';}
				$template->main_content->notify->notifycators .= '<div class="error">'.$caption.'</div>';
			}
			break;
			case 'warning':{
				if (!$caption){$caption='Внимание! Запись не была удалена!';}
				$template->main_content->notify->notifycators .= '<div class="warning">'.$caption.'</div>';
			}
			break;
			case 'successfull':{
				if (!$caption){$caption='Все отлично. Все изменения сохранены.';}
				$template->main_content->notify->notifycators .= '<div class="successfull">'.$caption.'</div>';
			}
			break;
		}
		return TRUE;
	}
	
} // End Components