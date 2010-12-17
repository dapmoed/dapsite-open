<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Bemenu extends ORM {
	var $_table_name = 'be_menu';
	
	public function get_item_menu(){
		$list_menu = ORM::factory('bemenu')
						->where('submenu','=',0)
						->find_all();
							
		if (count($list_menu)>0){
			return 	$list_menu;
		}				
		else{
			return FALSE;
		}
	}
	
	public function get_item_submenu($id){
		$list_submenu = ORM::factory('bemenu')
						->where('submenu','=',1)
						->where('id_menu','=',$id)
						->order_by('order','ASC')
						->find_all();
						
		if (count($list_submenu)>0){
			return 	$list_submenu;
		}				
		else{
			return FALSE;
		}
	}
} // End Permisions Model