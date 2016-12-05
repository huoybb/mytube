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
    $router->addx('/search/{search}','index::search')->setName('search');

    $router->addGet('/movies/{movie:[0-9]+}','movies::show')->setName('movies.show');
    $router->addx('/movies/{movie:[0-9]+}/addComment','movies::addComment',[isCommentValid::class])->setName('movies.addComment');
    $router->addx('/movies/{movie:[0-9]+}/addTag','movies::addTag',[isTagValid::class])->setName('movies.addTag');
    $router->addx('/movies/{movie:[0-9]+}/updatePlayTime','movies::updatePlayTime')->setName('movies.updatePlayTime');
    $router->addx('/movies/{movie:[0-9]+}/edit','movies::edit')->setName('movies.edit');
    $router->addx('/movies/{movie:[0-9]+}/delete','movies::delete')->setName('movies.delete');

    $router->addGet('/channels','channels::index')->setName('channels.index');
    $router->addGet('/channels/{channel:[0-9]+}','channels::show')->setName('channels.show');
    $router->addx('/channels/{channel:[0-9]+}/addComment','channels::addComment',[isCommentValid::class])->setName('channels.addComment');
    $router->addx('/channels/{channel:[0-9]+}/edit','channels::edit')->setName('channels.edit');

    $router->addGet('/playlists','playlists::index')->setName('playlists.index');
    $router->addGet('/playlists/{playlist:[0-9]+}','playlists::show')->setName('playlists.show');
    $router->addx('/playlists/{playlist:[0-9]+}/addComment','playlists::addComment',[isCommentValid::class])->setName('playlists.addComment');
    $router->addx('/playlists/{playlist:[0-9]+}/edit','playlists::edit')->setName('playlists.edit');

    $router->addx('/logout','auth::logout')->setName('logout');
    $router->addGet('/myLatestComments','auth::latestComments')->setName('myLatestComments');

    $router->addx('/comments/{comment:[0-9]+}','comments::show')->setName('comments.show');
    $router->addx('/comments/{comment:[0-9]+}/delete','comments::delete')->setName('comments.delete');
    $router->addx('/comments/{comment:[0-9]+}/edit','comments::edit')->setName('comments.edit');

    $router->addGet('/tags','tags::index')->setName('tags.index');
    $router->addGet('/tags/{tag:[0-9]+}','tags::show')->setName('tags.show');
    $router->addx('/tags/{tag:[0-9]+}/addComment','tags::addComment',[isCommentValid::class])->setName('tags.addComment');
    $router->addx('/tags/{tag:[0-9]+}/edit','tags::edit')->setName('tags.edit');
});

$router->addGet('/getYoutube/{key}','youtube::getMovie')->setName('youtube.getMovie');
$router->addGet('/getYoutubeList/{key}','youtube::getList')->setName('youtube.getList');

$router->addx('/register','auth::register')->setName('register');
$router->addx('/login','auth::login')->setName('login');

return $router;
