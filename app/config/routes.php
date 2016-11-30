<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/30
 * Time: 6:03
 */
use core\myRouter;

$router = new myRouter();
$router->removeExtraSlashes(true);
$router->notFound('index::notFound');

$router->addGet('/','index::index')->setName('home');
$router->addGet('/getYoutube/{key}','index::getYoutube')->setName('youtube.getMovie');

$router->addGet('/movies/{movie:[0-9]+}','movies::show')->setName('movies.show');
return $router;

