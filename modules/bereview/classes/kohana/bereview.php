<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Компонент главная административной панели
 */
abstract class Kohana_Bereview {
	
	public static function be_view($obtained_parametrs,$global_data,&$template=NULL){
		//Добаление в шаблон тайтла
		$config_com = Kohana_Config::instance()->load($obtained_parametrs['com']);
		if (isset($config_com['title'])){
			Seo::load_title($template,$config_com['title']);
		}
		else{
			Seo::load_title($template,'');
		}		
		//Название компонента	
		$template->main_content->toolbar_components->name_component = 'Главная страница панели администрирования';
		//Меню - список действий
		$template->main_content->toolbar_components->actions_component = array(
			'kategory'	=> array(
				'text'	=> 'Категории',
				'link'	=> url::base().'backend/index/'.$obtained_parametrs['com'].'?act='.'view_kategory',
			),
			'add_articles'	=> array(
				'text'	=> 'Добавление статей',
				'link'	=> url::base().'backend/index/'.$obtained_parametrs['com'].'?act='.'add_articles',
			),
			'settings'	=> array(
				'text'	=> 'Настройка',
				'link'	=> url::base().'backend/index/'.$obtained_parametrs['com'].'?act='.'settings',
			),
		);
		
		
		//Выясняем какое действие
		switch($global_data['clean_get']['act']){
			case 'main': {
				//Кнопки
				$template->main_content->toolbar_components->buttons_component = array(
					'save'	=> array(
						'text'	=>  'Сохранить',
						'link'	=>	'',
						'img'	=>	'save.png',
					),
					'apply'	=> array(
						'text'	=>  'Применить',
						'link'	=>	'',
						'img'	=>	'apply.png',
					),
					'cancel'	=> array(
						'text'	=>  'Отмена',
						'link'	=>	'',
						'img'	=>	'cancel.png',
					),
					'help'	=> array(
						'text'	=>  'Помощь',
						'link'	=>	'',
						'img'	=>	'help.png',
					),
				);
				$template->main_content->view_components =  Bereview::act_main();
			}
			break;
			case 'view_kategory':{
				$template->main_content->toolbar_components->buttons_component = array(
					'save'	=> array(
						'text'	=>  'Сохранить',
						'link'	=>	'',
						'img'	=>	'save.png',
					),
					'help'	=> array(
						'text'	=>  'Помощь',
						'link'	=>	'',
						'img'	=>	'help.png',
					),
				);
			}
			break;
			case 'add_articles': {
				//Кнопки
				$template->main_content->toolbar_components->buttons_component = array(
					'save'	=> array(
						'text'	=>  'Сохранить',
						'link'	=>	'',
						'img'	=>	'save.png',
					),
					'cancel'	=> array(
						'text'	=>  'Отмена',
						'link'	=>	'',
						'img'	=>	'cancel.png',
					),
					'help'	=> array(
						'text'	=>  'Помощь',
						'link'	=>	'',
						'img'	=>	'help.png',
					),
				);
			}
			default:{
			}
			break;
		}
		
		return FALSE;
	}
	
	
	static function act_main(){
		return FALSE;
	}
	
	
} // End Main