<?php
	const IDP_SAMPLE_APP = "IdpSampleApp";

	define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
	define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
	define('CONFIGURATION', ROOT . IDP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Configuration' . DIRECTORY_SEPARATOR);
	define('CONTROLLER', ROOT . IDP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR);
	define('EXCEPTION', ROOT . IDP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Exception' . DIRECTORY_SEPARATOR);
	define('LIB', ROOT . IDP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR);
	define('MODEL', ROOT . IDP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR);
	define('VIEW', ROOT . IDP_SAMPLE_APP . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);

	$modules = [ROOT, APP, CONFIGURATION, CONTROLLER, EXCEPTION, LIB, MODEL, VIEW];

	set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
	spl_autoload_register('spl_autoload', false);

	$configuration = new ConfigurationManager();
	$configuration->loadConfiguration();

	new Application();

