<?php defined('SYSPATH') or die('No direct access');
 
class Kohana_Exception404 extends Kohana_Exception {
 
	public function __construct($message = 'error 404', array $variables = NULL, $code = 0)
	{
		parent::__construct($message, $variables, $code);
	}
 
} // End Kohana_Exception 403