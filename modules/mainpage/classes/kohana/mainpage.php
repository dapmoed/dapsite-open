<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Компонент главная страница сайта
 */
abstract class Kohana_Mainpage {
	
	public static function view($obtained_parametrs,$global_data,&$template=NULL){
		//Добаление в шаблон тайтла
		$config_com = Kohana_Config::instance()->load($obtained_parametrs['com']);
		if (isset($config_com['title'])){
			Seo::load_title($template,$config_com['title']);
		}
		else{
			Seo::load_title($template,'');
		}				
		return FALSE;
	}
} // End Main