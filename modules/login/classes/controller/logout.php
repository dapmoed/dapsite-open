<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Logout extends Controller_Template {
	
	public $template = 'templates/default/logout';
	
	public function before()
	{
		parent::before();
		$this->template = Templates::load('logout');
		
		if (!Login::alredy_login()){
			Request::instance()->redirect('login');
		}
		return false;
	}
	
	public function action_index()
	{	
		/* Если аякс */
		if (Request::$is_ajax){
			if (Login::logout()){
				$json = array(
					'status'	=>	'FALSE',
				);
			}
			else{
				$json = array(
					'status'	=>	'TRUE',
					'user'		=>	array(
						'id'		=>	Login::get_user()->id,
						'username'	=>	Login::get_user()->username,
					)
				);
			}
			echo json_encode($json);
		}
		else{
			if ($_POST){
				Login::logout('login');	
			}
			else{
				
			}
		}		
		return false;
	}
	
	public function action_now()
	{
		/* Если аякс */
		if (Request::$is_ajax){
			if (Login::logout()){
				$json = array(
					'status'	=>	'FALSE',
				);
			}
			else{
				$json = array(
					'status'	=>	'TRUE',
					'user'		=>	array(
						'id'		=>	Login::get_user()->id,
						'username'	=>	Login::get_user()->username,
					)
				);
			}
			echo json_encode($json);
		}
		else{
			if (isset($_GET['act'])){
				Login::logout('login');	
			}
			else{
				
			}
		}		
		return false;
	}
		
	public function after()
	{
		parent::after();
		
		if (!Request::$is_ajax){
			Loadlib::load($this->template);//Загрузка css и js
			Seo::load_title($this->template,'Вы уже авторизованы');
			Seo::load_meta($this->template,'авторизация логин login user administration administrator');
		}
		
		return false;
	}
}
