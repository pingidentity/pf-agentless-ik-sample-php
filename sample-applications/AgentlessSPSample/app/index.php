<?php
	const SP_SAMPLE_APP = "SpSampleApp";

	define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
	define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
	define('CONFIGURATION', ROOT . SP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Configuration' . DIRECTORY_SEPARATOR);
	define('CONTROLLER', ROOT . SP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR);
	define('LIB', ROOT . SP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR);
	define('EXCEPTION', ROOT . SP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Exception' . DIRECTORY_SEPARATOR);
	define('MODEL', ROOT . SP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR);
	define('VIEW', ROOT . SP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);

	$modules = [ROOT, APP, CONFIGURATION, CONTROLLER, EXCEPTION, LIB, MODEL, VIEW];

	set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
	spl_autoload_register('spl_autoload', false);

	$spAdapterConfiguration = new ConfigurationManager();
	$spAdapterConfiguration->loadConfiguration();
	
	new Application();
