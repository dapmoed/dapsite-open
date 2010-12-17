<?php defined('SYSPATH') or die('No direct script access.');

class Exrequest_Route extends Kohana_Route {

	public function extend_by_defaults(array $params)
	{
		foreach ($this->_defaults as $key => $value)
		{
			if ( ! isset($params[$key]) OR $params[$key] === '')
			{
				// Set default values for any key that was not matched
				$params[$key] = $value;
			}
		}

		return $params;
	}
}
