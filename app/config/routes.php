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
$router->group([isLogin::class],function() use($router){
    $router->addGet('/','index::index')->setName('home');
    $router->addGet('/getYoutube/{key}','index::getYoutube')->setName('youtube.getMovie');
    $router->addx('/search/{search}','index::search')->setName('search');

    $router->addGet('/movies/{movie:[0-9]+}','movies::show')->setName('movies.show');

    $router->addGet('/channels','channels::index')->setName('channels.index');
    $router->addGet('/channels/{channel:[0-9]+}','channels::show')->setName('channels.show');

    $router->addx('/register','auth::register')->setName('register');
    $router->addx('/logout','auth::logout')->setName('logout');
});
$router->addx('/login','auth::login')->setName('login');

return $router;
