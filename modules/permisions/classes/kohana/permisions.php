<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Абстрактный класс реализации разделения прав в CMS
 */
abstract class Kohana_Permisions {
	
	public static function is_allow($controller,$com,$act){
		$permision = new Model_Permision();
		$result_permision = $permision->is_allow($controller,$com,$act);
		return $result_permision;
	}
	
} // End Permisions