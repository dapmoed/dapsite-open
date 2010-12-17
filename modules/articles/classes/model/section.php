<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Section extends ORM {
	protected $_table_name = 'section_articles';
	protected $_has_many = array(
				'articles' => array(
					'model' 	  => 'article',
					'foreign_key' => 'section_id',
				),
			);
} // End Model_Section_Article