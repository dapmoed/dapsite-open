<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Backend extends Controller_Template {		
	public $template = 'backend/templates/default/index';
	public $global_configuration = NULL;
	public $global_data = NULL;
	public $obtained_parametrs = NULL;
	
	public function before()
	{
		parent::before();
		$this->global_configuration = Kohana_Config::instance()->load('global_configuration');//Общие настройки сайта
		$this->template = Templates::be_load('index');//Загрузка основного вида текущего шаблона
		
		$this->global_data['clean_get'] = Security::array_xss_clean($_GET);//Очистка от XSS атак глобальных массивов для передачи компоненту
		$this->global_data['clean_post'] = $_POST;//Security::array_xss_clean($_POST);
		$this->global_data['clean_request'] = Security::array_xss_clean($_REQUEST);
		
		Login::set_memory();
		return false;
	}
	
	public function action_index()
	{	
		$this->obtained_parametrs = Security::array_xss_clean($this->request->param());
				
		if (Request::$is_ajax){
			$this->auto_render = FALSE;
			echo Components::be_load($this->obtained_parametrs,$this->template,$this->global_data);
		}
		else{
			Components::be_load($this->obtained_parametrs,$this->template,$this->global_data);
		}
		return false;
	}
		
	public function after()
	{
		parent::after();
		if (!Request::$is_ajax){
			Loadlib::load($this->template);//Загрузка css и js
		}	
		return false;
	}
}
