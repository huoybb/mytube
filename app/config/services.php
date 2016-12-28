<?php

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
//    $di = new FactoryDefault();
$di = new \core\myDI();

$providers = [
    'config'            =>\serviceProviders\configProvider::class,
    'loader'            =>\serviceProviders\loaderProvider::class,
    'url'               =>\serviceProviders\urlProvider::class,
    'router'            =>\serviceProviders\routerProvider::class,
    'dispatcher'        =>\serviceProviders\dispatcherProvider::class,
    'view'              =>\serviceProviders\viewProvider::class,
    'viewCache'         =>\serviceProviders\viewCacheProvider::class,
    'db'                =>\serviceProviders\dbProvider::class,
    'modelsMetadata'    =>\serviceProviders\modelsMetadataProvider::class,
    'flash'             =>\serviceProviders\flashProvider::class,
    'session'           =>\serviceProviders\sessionProvider::class,
    'crypt'             =>\serviceProviders\cryptProvider::class,
    'security'          =>\serviceProviders\securityProvider::class,
//    'cookies'           =>\serviceProviders\cookiesProvider::class,//默认其实就加载了，如果不改变设置，可以不用加载的
    'eventsManager'     =>\serviceProviders\eventsManagerProvider::class,
    'auth'              =>\serviceProviders\authProvider::class,
//    'gate'              =>\serviceProviders\gateProvider::class,
//
//
//    //下面是自主加载的服务
//    'newspaperparser'   =>\App\serviceProviders\newpaperparserProvider::class,//获取报纸信息的服务；
    'myTools'           =>\core\myToolsProvider::class,
];
$di->register($providers);

return $di;