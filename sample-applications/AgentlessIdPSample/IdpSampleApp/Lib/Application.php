<?php

// for simplicity, do not use in production, consider using a Post/Redirect/Get pattern.

class Application
{
	protected $controller = '';

	public function __construct()
	{
		try
		{
			$this->prepareURL();
			$this->controller = new $this->controller;
			$this->controller->handle(); 
		}
		catch (Exception $e)
		{
			$this->controller = new ErrorController();
			$this->controller->handle();
		}
	}


	protected function prepareURL()
	{
		$request = $_SERVER['REQUEST_URI'];

		$url = explode('?', $request);

		if (count($url) == 1 || empty($url[1]) || strpos($url[1], IdpConstants::RESUME_PATH) !== false)
		{
			$this->controller = IdpConstants::APP_CONTROLLER;
		} 
		else
		{
			$action = explode('&', $url[1]);
			$action = explode('=', $action[0]);

			if (count($action) == 1 || $action[0] != 'action' || empty($action[1]) )
			{
				throw new Exception();
			}
			else
			{
				switch($action[1])
				{
					case IdpConstants::CONFIGURE:
						$this->controller = IdpConstants::CONFIGURE_CONTROLLER;
						break;
					case IdpConstants::DROPOFF:
						$this->controller = IdpConstants::DROPOFF_CONTROLLER;
						break;
					case IdpConstants::LOGIN:
						$this->controller = IdpConstants::LOGIN_CONTROLLER;
						break;
					case IdpConstants::LOGOUT:
						$this->controller = IdpConstants::LOGOUT_CONTROLLER;
						break;
					case IdpConstants::RESUME:
						$this->controller = IdpConstants::RESUME_CONTROLLER;
						break;
					default:
						throw new Exception();
				}
			}
		}
	}

}