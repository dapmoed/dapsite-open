<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Абстрактный класс для авторизации
 */
abstract class Kohana_Login {

	protected static $_instance;

	/* Возвращает объект класс логин */	
	public static function instance()
	{
		if ( ! isset(Login::$_instance))
		{
			$config = Kohana::config('login');
			$class = 'Login';
			Login::$_instance = new $class($config);
		}
		return Login::$_instance;
	}
	
	/* Авторизация и перенаправление на указзанне урлы */
	public static function login($username,$password,$remember,$success_redirect=NULL,$error_redirect=NULL)
	{
		if (Auth::instance()->login($username,$password,$remember)){
			//Перенаправление в случае если логин прошел
			if ($success_redirect==NULL){
				return TRUE;
			}
			else{
				$success_redirect = '/'.Login::get_memory($success_redirect);
				Request::instance()->redirect($success_redirect);
				
			}		
		}
		else{
			//Перенаправление в случае если логин не прошел
			if ($error_redirect==NULL){
				return FALSE;
			}
			else{
				Request::instance()->redirect($error_redirect);
			}
		}
	}
	/* Выход из авторизации */
	public static function logout($url_redirect=NULL){
		if (Auth::instance()->logout()){
			if ($url_redirect==NULL){
				return TRUE;
			}
			else{
				/* После выхода перенаправляется */
				Request::instance()->redirect($url_redirect);
			}
		}
		else{
			return FALSE;
		}
	}
	
	public static function alredy_login(){
		if (Auth::instance()->logged_in()){
			return TRUE;
		}
		return FALSE;
	}
	
	/* Находим id и username текущего залогиненного пользователя */
	public static function get_user(){
		if (Auth::instance()->logged_in()){
			return Auth::instance()->get_user();			
		}
		else{
			return FALSE;
		}
	}
	
	public static function set_memory(){
		Cookie::set('login_memory', Request::instance()->uri);
		return FALSE;
	}
	
	public static function get_memory($default_uri){
		return Cookie::get('login_memory',$default_uri);
	}
	
} // End Login