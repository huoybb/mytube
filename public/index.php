<?php
error_reporting(E_ALL);

define('APP_PATH', realpath('..'));
/**
 * 便于区分web，Cli等不同运行环境设置的函数
 */
if(! function_exists('getMyEnv')){
    /**
     * @return string
     */
    function getMyEnv(){
        return 'web';
    }
}

try {
    /**
     * 加载composer
     */
    require APP_PATH .'/vendor/autoload.php';

    /**
     * 设置并加载Di服务
     */

    $di = include APP_PATH . "/app/config/services.php";

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
