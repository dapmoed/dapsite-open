<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Функции для работы с базовыми html объектами такими как таблицы и т.д.
 */
abstract class Kohana_Comhtml {
	
	public static function data_table($array_header){
		$table = '<div class="table_wraper">
					<table id="admin_table">
						<thead>
							<tr>';
		foreach ($array_header as $th){
			if ($th=='checked'){
				$th = '';
			}
			$table .= '<th>
					  '.$th.'
					   </th>';
		}		

		$table .= '</tr>
				 </thead>';	
				 
		$table .= '<tfoot>
					<tr>';
		foreach ($array_header as $th){
			if ($th=='checked'){
				$th = '<input type="checkbox" name="ch_all" />';
			}
			$table .= '<th>
					  '.$th.'
					   </th>';
		}		

		$table .= '</tr>
				 </tfoot>
				 <tbody>
				 </tbody>
				 </table>
				 <div class="action_table">
				 <select>
					<option value="none">Действия с выделлеными объектами</option>
					<option value="delete">Удалить</option>
					<option value="publish">Публиковать</option>
					<option value="unpublish">Скрыть</option>
					<option value="move">Перенести в категорию</option>
				</select>
			     </div>';			 
		return $table;		 
	}
	
} // End Main