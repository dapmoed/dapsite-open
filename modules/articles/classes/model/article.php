<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Article extends ORM {
	protected $_belongs_to = array('section'=>array(
									'model' 	  => 'section',
									'foreign_key' => 'section_id'));
	
	public function get_articles($get){
		$articles = ORM::factory('article')
							->find_all();			
		return $articles;
	}
} // End Model_Article