<?php defined('SYSPATH') or die('No direct script access.');

class Exrequest_Request extends Kohana_Request {

	public static function factory($route, $params = NULL)
	{
		return new Request($route, $params);
	}
	
	public function __construct($route, $params = NULL)
	{
		if (is_array($params))
		{
			$this->route = Route::get($route);
			
			$params = $this->route->extend_by_defaults($params);
			
			if (isset($params['directory']))
			{
				// Controllers are in a sub-directory
				$this->directory = $params['directory'];
			}
			
			// Store the controller
			$this->controller = $params['controller'];
			
			if (isset($params['action']))
			{
				// Store the action
				$this->action = $params['action'];
			}
			
			// These are accessible as public vars and can be overloaded
			unset($params['controller'], $params['action'], $params['directory']);

			// Params cannot be changed once matched
			$this->_params = $params;
			
			$this->uri = $route.'/'.$this->controller.'/'.$this->action;
		}
		else
		{
			parent::__construct($route);
		}
	}
}
