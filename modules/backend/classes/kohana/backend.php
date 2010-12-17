<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Компонент административной части
 */
abstract class Kohana_Backend {
	public static function be_view($obtained_parametrs,$global_data,&$template=NULL){
		switch ($global_data['clean_get']['act']){
			case 'submenu':{
					if (!Request::$is_ajax){
						throw new Kohana_Exception404;
					}
					return Backend::view_submenu($global_data['clean_get']['id']);
				}
				break;
			default:
				throw new Kohana_Exception404;
				break;
		}	
		return FALSE;
	}
	
	static function view_submenu($id){
		$bemenu = new Model_Bemenu();
		$list_submenu = $bemenu->get_item_submenu($id);
		$json = array(
			'submenu'	=> array(
			),
			'status'	=> TRUE,
		);
		if ($list_submenu){
			$i = 0;
			foreach ($list_submenu as $submenu){
				$json['submenu'][$i]['id'] = $submenu->id;
				$json['submenu'][$i]['title'] = $submenu->title;
				$json['submenu'][$i]['link'] = url::base().'backend/index/'.$submenu->com;
				$json['submenu'][$i]['img'] = $submenu->img;
				$i++;
			}
		}else{
			$json['status'] = FALSE;
		}
		
		return json_encode($json);
	}
	
	public static function view_main_menu(){
		$template = Templates::be_load('main_menu');
		
		$bemenu = new Model_Bemenu();
		$template->list_menu = $bemenu->get_item_menu();
		
		return $template;
	}
	
} // End Main