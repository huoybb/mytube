<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/30
 * Time: 6:03
 */
use Phalcon\Mvc\Router;

$router = new Router();
$router->removeExtraSlashes(true);
$router->notFound('index::notFound');

$router->addGet('/','index::index')->setName('home');
$router->addGet('/getYoutube/{key}','index::getYoutube')->setName('youtube.getMovie');
return $router;

