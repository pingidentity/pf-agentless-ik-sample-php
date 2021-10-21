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

    /**
     * Custom loader to look for CamelCased filenames names rather than the default
     * of lower cased filenames
     */
    function custom_load($class)
    {
        $include_path = explode(PATH_SEPARATOR, get_include_path());
        foreach ($include_path as $folder) {
            if (count(glob("$folder$class.php")) > 0) {
                include $folder . $class . ".php";
            }
        }
    }

	set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
	spl_autoload_register('custom_load', false);

	$spAdapterConfiguration = new ConfigurationManager();
	$spAdapterConfiguration->loadConfiguration();
	
	new Application();
