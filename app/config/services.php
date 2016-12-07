<?php

use Phalcon\Crypt;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Security;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
//    $di = new FactoryDefault();
$di = new \core\myDI();


/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/app/config/config.php";
});

/**
 * Shared loader service
 */
$di->setShared('loader', function () {
    $config = $this->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/app/config/loader.php';

    return $loader;
});

/**
 * Add routing capabilities
 */
$di->set("router",function () {
    $router = require APP_PATH . "/app/config/routes.php";
    return $router;
});

$di->setShared('dispatcher',function(){
    /** @var Phalcon\Events\Manager $eventsManager */
    $eventsManager = $this->getEventsManager();
    $eventsManager->attach("dispatch:beforeDispatchLoop", function(Event $event, Dispatcher $dispatcher){
        return $this->getRouter()->executeModelBinding($dispatcher);
    });
    $eventsManager->attach('dispatch:beforeExecuteRoute',function(Event $event, Dispatcher $dispatcher){
        /** @var \core\myRouter $router */
        $router = $this->getRouter();
        $router->handle();
        return $router->executeMiddleWareChecking($this->getRequest(), $this->getResponse(),$dispatcher);
    });

    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    // Disable several levels，取消三级的模板渲染机制，这个将来也是可以利用一下的。
    $view->disableLevel(array(
        View::LEVEL_LAYOUT      => true,
        View::LEVEL_MAIN_LAYOUT => true
    ));
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view, $di) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $di);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_',
                'compileAlways'=> true,//修改view的时候用这个
            ]);

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ]);
    $view->search = $this->get('request')->get('search');//设置每个页面的search变量，这个应该是一个全局的变量
    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Phalcon\Flash\Session([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

$di->setShared('auth',function(){
    $auth = (new \core\myAuth())->setDI($this)->init();
    return $auth;
});

$di->setShared('eventsManager',function(){
    $eventsManager = require APP_PATH . "/app/config/events.php";
    return $eventsManager;
});

$di->setShared("crypt",function () {
    $crypt = new Crypt();
    $crypt->setKey('%31.1e$i86e$f!8jz');
    return $crypt;
});

return $di;