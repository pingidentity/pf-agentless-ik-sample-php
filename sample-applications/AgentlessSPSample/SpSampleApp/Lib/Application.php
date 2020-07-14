<?php
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

		if (count($url) == 1 || empty($url[1]) || (strpos($url[1], SpConstants::REF_ID) !== false && strpos($url[1], SpConstants::LOGOUT) === false))
		{
			$this->controller = SpConstants::APP_CONTROLLER;
		} 
		else
		{
			$action = explode('&', $url[1]);
			$action = explode('=', $action[0]);

			if (count($action) == 1 || $action[0] != 'action' || empty($action[1]))
			{
				throw new Exception();
			}
			else
			{
				switch($action[1])
				{
					case SpConstants::CONFIGURE:
						$this->controller = SpConstants::CONFIGURE_CONTROLLER;
						break;
					case SpConstants::LOGGED_OUT:
						$this->controller = SpConstants::LOGGED_OUT_CONTROLLER;
						break;
					case SpConstants::LOGOUT:
						$this->controller = SpConstants::LOGOUT_CONTROLLER;
						break;
					default:
						throw new Exception();
				}
			}
		}
	}

}