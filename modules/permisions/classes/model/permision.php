<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Permision extends ORM {
	var $_table_name = 'permisions';
	
	public function is_allow($controller,$com,$act){
		$permisions_act = ORM::factory('permision')
						->where('controller','=',"$controller")
						->where('com','=',"$com")
						->where('act','=',"$act")->find();
				
		if (!empty($permisions_act->value)){
			return $this->parse_list_permisions($permisions_act->value);
		}
		else{
			$permisions_com = ORM::factory('permision')
						->where('controller','=',"$controller")
						->where('com','=',"$com")
						->where('act','=','')->find();
						
			if (!empty($permisions_com->value)){
				return $this->parse_list_permisions($permisions_com->value);
			}
			else{
				$permisions_controller = ORM::factory('permision')
						->where('controller','=',"$controller")
						->where('com','=','')
						->where('act','=','')->find();	
						
				if (!empty($permisions_controller->value)){
					return $this->parse_list_permisions($permisions_controller->value);
				}
				else{
					return 'ALLOW';
				}
			}
		}
	}
	
	function parse_list_permisions($string_permisions){
		$user = Login::get_user();
		if ($user){
			if ($string_permisions!=='ALL'){
				$array_permisions = explode(',',$string_permisions);
				$id_user = $user->id;
				$roles_user = DB::select()->from('roles_users')->where('user_id', '=', "$id_user")->execute();
				$k = 1;
				foreach ($roles_user as $role){
					$k *= $role['role_id'];
				}
				if (in_array($k,$array_permisions)){
					return 'ALLOW';
				}
				else{
					return 'DISALLOW';
				}
			}
			else{
				return 'ALLOW';
			}
		}
		else{
			return 'UNREGISTER';
		}
	}
} // End Permisions Model