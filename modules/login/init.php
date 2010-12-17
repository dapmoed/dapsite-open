<?php defined('SYSPATH') or die('No direct script access.');


// Catch-all route for Codebench classes to run
Route::set('login', 'login')
	->defaults(array(
		'controller' => 'login',
		'action' => 'index'));