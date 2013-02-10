<?php
/**
* PolloPHP Application
* 
* The entry point of the application
* 
* @link https://github.com/durangol/PolloPHP-ExampleApplication
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

// Set constants
define('LIBRARY_PATH', __DIR__ . '/../library');
define('APPLICATION_PATH', __DIR__ . '/../application');
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');

// Set include paths
set_include_path(implode(PATH_SEPARATOR, array(
    LIBRARY_PATH,
    APPLICATION_PATH,
    get_include_path()
)));

// Set Autoloader
require LIBRARY_PATH . '/Pollo/Autoloader.php';
require LIBRARY_PATH . '/Pollo/Autoloader/StandardAutoloader.php';
$autoloader = new \Pollo\Autoloader();
$autoloader->addAutoloader(new \Pollo\Autoloader\StandardAutoloader());

// Set Application components
$config = new \Pollo\Application\Config(APPLICATION_PATH . '/config/application.php');
$bootstrap = new \Pollo\Application\Bootstrap($config);
$dispatcher = new \Pollo\Application\Mvc\Dispatcher(new \Pollo\Request\Http(), new \Pollo\Response\Http());

// Create and run Application
$application = new \Pollo\Application($bootstrap, $dispatcher, APPLICATION_ENV);
$application->run();