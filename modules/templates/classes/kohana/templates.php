<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Абстрактный класс для авторизации
 */
abstract class Kohana_Templates {

	/* Загрузка  вида из текущего шаблона  */
	public static function load($view){
		$global_configuration = Kohana_Config::instance()->load('global_configuration');
		return new View($global_configuration['template_path'].$global_configuration['template'].$view);
	}
	/* Загрузка  вида из текущего шаблона административной панели  */
	public static function be_load($view){
		$global_configuration = Kohana_Config::instance()->load('global_configuration');
		return new View($global_configuration['backend']['template_path'].$global_configuration['backend']['template'].$view);
	}
} // End Loadlib