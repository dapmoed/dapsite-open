<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Компонент главная страница сайта
 */
abstract class Kohana_News {
	public static function view($obtained_parametrs,$global_data,&$template=NULL){
		return FALSE;
	}
	
	
	public static function be_view($obtained_parametrs,$global_data,&$template=NULL){
		return FALSE;
	}
} // End Main