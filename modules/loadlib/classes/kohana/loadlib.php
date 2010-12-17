<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Абстрактный класс для авторизации
 */
abstract class Kohana_Loadlib {

	/* Загрузка библиотек общих и конткретных для контролера  */
	public static function load(&$template){
		$config_load_lib_ctrl = Kohana_Config::instance()->load(Request::instance()->controller);
		$config_load_lib = Kohana_Config::instance()->load('loadlib');
		
		if (isset($config_load_lib_ctrl['loadlib'])){
			if (isset($template->css)){
				$template->css 	=	Arr::merge($config_load_lib['css'],$config_load_lib_ctrl['loadlib']['css'],$template->css);
			}
			else{
				$template->css 	=	Arr::merge($config_load_lib['css'],$config_load_lib_ctrl['loadlib']['css']);
			}
			if (isset($template->js)){
				$template->js	=	Arr::merge($config_load_lib['js'],$config_load_lib_ctrl['loadlib']['js'],$template->js);
			}
			else{
				$template->js	=	Arr::merge($config_load_lib['js'],$config_load_lib_ctrl['loadlib']['js']);
			}
		}
		else{
			if (isset($template->css)){
				$template->css 	=	Arr::merge($config_load_lib['css'],$template->css);
			}
			else{
				$template->css 	=	$config_load_lib['css'];
			}
			if (isset($template->js)){
				$template->js	=	Arr::merge($config_load_lib['js'],$template->js);
			}
			else{
				$template->js	=	$config_load_lib['js'];
			}
		}
		return FALSE;
	}
	//Добавление библиотек общих для компонента
	public static function append(&$template,$com){
		$config_load_lib_ctrl = Kohana_Config::instance()->load($com);
			
		if (isset($config_load_lib_ctrl['loadlib'])){
			if (isset($template->css)){
				$template->css 	=	Arr::merge($template->css,$config_load_lib_ctrl['loadlib']['css']);
			}
			else{
				$template->css 	=	$config_load_lib_ctrl['loadlib']['css'];
			}
			if (isset($template->js)){
				$template->js	=	Arr::merge($template->js,$config_load_lib_ctrl['loadlib']['js']);
			}
			else{
				$template->js	=	$config_load_lib_ctrl['loadlib']['js'];
			}
		}
		return FALSE;
	}
	
	
	public static function append_js(&$template,$link_array){		
		if (isset($template->js)){
			$template->js	=	Arr::merge($template->js,$link_array);
		}
		else{
			$template->js	=	$link_array;
		}
		return FALSE;
	}
	
	public static function append_css(&$template,$link_array){		
		if (isset($template->css)){
			$template->css 	=	Arr::merge($template->css,$link_array);
		}
		else{
			$template->css 	=	$link_array;
		}
		return FALSE;
	}
	
	public static function view_css($array){
		$css = new View('loadlibcss');
		$css->list_lib = $array;
		return $css;
	}
	
	public static function view_js($array){
		$js = new View('loadlibjs');
		$js->list_lib = $array;
		return $js;
	}
	
} // End Loadlib