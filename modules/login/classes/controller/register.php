<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Register extends Controller_Template {
	
	public $template = 'register';
	
	public function before()
	{
		parent::before();
		/* Подключение модели пользователя */
		$this->model_user = new Model_User;
		return false;
	}
	
	public function action_index()
	{		
		
		return false;
	}
		
	public function after()
	{
		parent::after();
		
		if (!Request::$is_ajax){
			Loadlib::load($this->template);//Загрузка css и js
			Seo::load_title($this->template,'Регистрация нового пользователя');
			Seo::load_meta($this->template,'авторизация логин login user administration administrator');
		}	
				
		return false;
	}
}
