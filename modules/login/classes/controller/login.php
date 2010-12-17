<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Login extends Controller_Template {
	
	public $template = 'templates/default/login';
	
	public function before()
	{
		parent::before();
		$this->template = Templates::load('login');
		/* Подключение модели пользователя */
		$this->model_user = new Model_User;
		/* Попытка автоматического входа */
		Auth::instance()->auto_login();	
		/* Если уже авторизован перенаправляем на страницу информации о пользователе с возможностью выхода */
		if (Login::alredy_login()){
			Request::instance()->redirect('logout');
		}
		
		$this->template->notify = "";
		
		return false;
	}
	
	public function action_index()
	{		
		/* Заголовок формы в шаблоне */
		$this->template->title_form = "Авторизация";
		$lang_error_array = Kohana_Config::instance()->load('login');
		if ($_POST){
			$form_data = array();
			$keys = array ('username','password','remember_me');
			$form_data = Arr::extract($_POST, $keys, NULL);
			/* Очистка от возможных XSS*/
			$form_data = Security::array_xss_clean($form_data);
			/* Валидация */
			$post = Validate::factory($form_data)
					->filter(TRUE,'trim')
					->rules('username', array('not_empty'=>NULL))
					->rules('password', array('not_empty'=>NULL));
			if ($post['remember_me']===''){
				$remember = FALSE;
			}
			else{
				$remember = TRUE;
			}		
			if ($post->check()){
				if (Request::$is_ajax){//Если ajax
					$this->auto_render = FALSE;
					$alredy_login = Login::login($post['username'],$post['password'],$remember);
					/* В json передаем статус текущего залогиненного пользователя */
					if ($alredy_login){
						$json = array(
							'logged'	=>	'TRUE',
							'user'		=>	array(
								'id'		=>	Login::get_user()->id,
								'username'	=>	Login::get_user()->username,
							)
						);
					}
					else{
						$json = array(
							'logged'	=>	'FALSE',
						);
					}
					echo json_encode($json);
				}
				else{
					if ($this->model_user->unique_key_exists($post['username'],'username')){
						if (!Login::login($post['username'],$post['password'],$remember,'success_redirect')){
							$errors = array(
								'0'	=> $lang_error_array['error']['NAME_OR_PASS_INCORRECT'],
							);
						}
					}
					else{
						$errors = array(
							'0'	=> $lang_error_array['error']['NO_SUCH_USER'],
						);
					}
				}
			}
			else{
				$errors = array(
					'0'	=> $lang_error_array['error']['EMPTY_NAME_OR_PASS'],
				);
			}
		}
		else{
				
		}
		
		if (isset($errors)){
			$this->template->notify = Templates::load('login/notify');
			$this->template->notify->errors = $errors;
		}
		return false;
	}
		
	public function after()
	{
		parent::after();
		if (!Request::$is_ajax){
			Loadlib::load($this->template);//Загрузка css и js
			Seo::load_title($this->template,'Авторизация');
			Seo::load_meta($this->template,'авторизация логин login user administration administrator');
		}		
		return false;
	}
}
