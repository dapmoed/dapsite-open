<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Компонент главная страница сайта
 */
abstract class Kohana_Articles {
	public static function view($obtained_parametrs,$global_data,&$template=NULL){
		return FALSE;
	}
		
	public static function be_view($obtained_parametrs,$global_data,&$template=NULL){
		//Если действие main перенаправить надо то меняем
		if ($global_data['clean_get']['act']=='main'){
			$global_data['clean_get']['act']='articles';
		}
		
		if (!isset($global_data['clean_get']['method'])){
			$method = 'view';
		}
		else{
			$method = $global_data['clean_get']['method'];
		}
		if (!Request::$is_ajax){
			//Название компонента	
			$template->main_content->toolbar_components->name_component = 'Содержимое';
			//Меню - список действий
			$template->main_content->toolbar_components->actions_component = Components::determine_activity_com_menu(array(
				'kategores'	=> array(
					'text'	=> 'Категории',
					'link'	=> url::base().'backend/index/'.$obtained_parametrs['com'].'?act='.'kategores',
					'active'=> FALSE,
				),
				'articles'	=> array(
					'text'	=> 'Статьи',
					'link'	=> url::base().'backend/index/'.$obtained_parametrs['com'].'?act='.'articles',
					'active'=> FALSE,
				),
				'settings'	=> array(
					'text'	=> 'Настройка',
					'link'	=> url::base().'backend/index/'.$obtained_parametrs['com'].'?act='.'settings',
					'active'=> FALSE,
				),
			),$global_data['clean_get']['act']);
		}
		
		//Выясняем какое действие
		switch($global_data['clean_get']['act']){
			case 'main': {
				Seo::load_title($template,'Компонент  Содержимое ');
				$template->main_content->view_components =  Articles::act_main();
			}
			break;
			case 'kategores':{
				Seo::load_title($template,'Категории -> Компонент  Содержимое ');
				$template->main_content->view_components =  Articles::act_kategores();				
			}
			break;
			case 'articles': {
				switch ($method){
					case 'view':{
						Seo::load_title($template,'Статьи -> Компонент  Содержимое ');
						Loadlib::append_js($template,array('articles/articles'));
						$template->main_content->view_components =  Articles::act_articles($global_data,$method);
					}
					break;
					case 'get':{
						return  Articles::get_json_jqdatatables($global_data['clean_get'],array('number','checked','title','publish','order','id','section_id','user_id','last_edit'));
					}
					break;
					default:{
					}
					break;
				}
			}
			break;
			case 'settings': {
				Seo::load_title($template,'Настройки -> Компонент  Содержимое ');
				$template->main_content->view_components =  Articles::act_settings();
			}
			break;
			default:{
				throw new Kohana_Exception403;
			}
			break;
		}
		
		return FALSE;
	}
	
	static function act_main(){
		return FALSE;
	}
	
	static function act_kategores(){
		return FALSE;
	}
	
	static function act_articles($global_data,$method){
		$view_components = Templates::be_load('articles');
		$view_components->link = Request::instance()->uri.'?act='.$global_data['clean_get']['act'].'&method='.$method;
		$view_components->table = Comhtml::data_table(array('№','checked','<div>Заголовок</div>','<div>Опубликована</div>','Порядок','<div>ID</div>','<div>Категория</div>','<div>Автор</div>','<div>Дата последнего изменения</div>'));
		return $view_components;
	}
	
	static function act_settings(){
		return FALSE;
	}
	
	//Формирование json для dataTables - (плагин для jQuery)
	static function get_json_jqdatatables($clean_get,$array_field){
		$articles_model = new Model_Article();
		$mysql_result = $articles_model->get_articles($clean_get);
		
		$json = array();
		$json['sEcho'] = 1;
		$json['iTotalRecords'] = count($mysql_result);
		$json['iTotalDisplayRecords'] = 10;
		$json['aaData'] = array();
		$i = 0;
		if ($mysql_result){
			foreach ($mysql_result as $row){
				$j = 0;
				foreach ($array_field as $field){
					switch ($field){
						case 'number':{
							$json['aaData'][$i][$j] = $i+1;
						}
						break;
						case 'checked':{
							$json['aaData'][$i][$j] = '<input type="checkbox" name="ch['.$row->id.']" class="checked_row"/>';
						}
						break;
						case 'publish':{
							if ($row->$field==0){
								$json['aaData'][$i][$j] = '<img src="'.url::base().'images/unpublish.png" alt="" title="" class="unpublish" />';
							}
							else{
								$json['aaData'][$i][$j] = '<img src="'.url::base().'images/publish.png" alt="" title="" class="publish"  />';
							}
						}
						break;
						default:{
							$json['aaData'][$i][$j] = $row->$field;
						}
						break;
					}
					$j++;
				}
				$i++;
			}
		}
		return json_encode($json);
	}
} // End Main