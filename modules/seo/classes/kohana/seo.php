<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Абстрактный класс для авторизации
 */
abstract class Kohana_Seo {
		
	//Загрузка метаданных keywords description
	public static function load_meta(&$template,$key_words){	
		$config_seo = Kohana_Config::instance()->load('seo');
	
		$template->meta_keywords = '<meta name="keywords" content="" />';
		$template->meta_description = '<meta name="description" content="" />';
		
		if (isset($config_seo['meta_keywords'])){
			$template->meta_keywords = '<meta name="keywords" content="'.$config_seo['meta_keywords'].' '.$key_words.'" />';
		}
		if (isset($config_seo['meta_description'])){
			$template->meta_description = '<meta name="description" content="'.$config_seo['meta_description'].'" />';
		}		
	}
	
	
	public static function load_title(&$template,$title){
		$config_global = Kohana_Config::instance()->load('global_configuration');
		if (!Request::$is_ajax){
			$template->title = $title.' - '.$config_global['title'];
		}	
	}
} // End Loadlib