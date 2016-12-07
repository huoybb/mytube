<?php
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));
function getMyEnv(){
    return 'web';
}

try {
    /*
     * 加载composer
     */
    require APP_PATH .'/vendor/autoload.php';

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
//    $di = new FactoryDefault();
    $di = new \core\myDI();

    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";

    /**
     * Call the autoloader service.  We don't need to keep the results.
     */
    $di->getLoader();

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
