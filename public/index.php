<?php
error_reporting(E_ALL);

define('APP_PATH', realpath('..'));
/**
 * 加载composer
 */
require APP_PATH .'/vendor/autoload.php';

try {
    /**
     * 设置并加载Di服务
     */
    $di = include APP_PATH . "/app/config/services.php";

    /**
     * Call the autoloader service.  We don't need to keep the results.
     */
    $di->getLoader()->register();

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    /**
     * add phalcon-debugbar
     */
//    $di['app'] = $application; //  Important
//    (new Snowair\Debugbar\ServiceProvider(APP_PATH."/app/config/debugbar.php"))->start();

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
