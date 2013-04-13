<?php
ini_set('html_errors', 1);

/**
* PolloPHP Application* 
* The entry point of the application
* 
* @link https://github.com/durangol/PolloPHP-ExampleApplication
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

// Set constants
define('LIBRARY_PATH', realpath(__DIR__ . '/../library'));
define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');

// Set include paths
set_include_path(implode(PATH_SEPARATOR, array(
    LIBRARY_PATH,
    APPLICATION_PATH,
    get_include_path()
)));

require LIBRARY_PATH . '/Pollo/Autoloader.php';
require LIBRARY_PATH . '/Pollo/Autoloader/StandardAutoloader.php';
$autoloader = new \Pollo\Autoloader();
$autoloader->addAutoloader('Pollo', new \Pollo\Autoloader\StandardAutoloader(array(
	'Pollo' => LIBRARY_PATH . '/Pollo'
)));

// Set Application components
$config = new \Pollo\Application\Config(require APPLICATION_PATH . '/config/application.php');
$bootstrap = new \Pollo\Application\Bootstrap($config);
$router = new \Pollo\Application\Mvc\Router(array());
$dispatcher = new \Pollo\Application\Mvc\Dispatcher(new \Pollo\Request\Http(), new \Pollo\Response\Http());

// Create and run Application
$application = new \Pollo\Application($bootstrap, $router, $dispatcher, APPLICATION_ENV);
$application->run();