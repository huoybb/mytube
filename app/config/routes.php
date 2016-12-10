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
    $router->addGet('/page/{page:[0-9]+}','index::index')->setName('home.page');
    $router->addx('/search/{search}','index::search')->setName('search');

    $router->addGet('/movies/{movie:[0-9]+}','movies::show','movies.show');
    $router->addPost('/movies/{movie:[0-9]+}/addComment','movies::addComment','movies.addComment')->setMiddlewares([checkToken::class,isCommentValid::class]);
    $router->addPost('/movies/{movie:[0-9]+}/addTag','movies::addTag','movies.addTag')->setMiddlewares([checkToken::class,isTagValid::class]);
    $router->addx('/movies/{movie:[0-9]+}/updatePlayTime','movies::updatePlayTime','movies.updatePlayTime');
    $router->addGet('/movies/{movie:[0-9]+}/edit','movies::edit','movies.edit')->setMiddlewares([hasAuthority::class]);
    $router->addPost('/movies/{movie:[0-9]+}/edit','movies::edit','movies.edit')->setMiddlewares([checkToken::class,hasAuthority::class]);
    $router->addx('/movies/{movie:[0-9]+}/delete','movies::delete','movies.delete')->setMiddlewares([hasAuthority::over('movie')]);
    $router->addx('/movies/{movie:[0-9]+}/setFile','movies::setFile','movies.setFile')->setMiddlewares([hasAuthority::over('movie')]);

    $router->addGet('/channels','channels::index','channels.index');
    $router->addGet('/channels/{channel:[0-9]+}','channels::show','channels.show');
    $router->addPost('/channels/{channel:[0-9]+}/addComment','channels::addComment','channels.addComment')->setMiddlewares([checkToken::class,isCommentValid::class]);
    $router->addGet('/channels/{channel:[0-9]+}/edit','channels::edit','channels.edit');
    $router->addPost('/channels/{channel:[0-9]+}/edit','channels::edit','channels.edit')->setMiddlewares([checkToken::class]);
    $router->addGet('/channels/{channel:[0-9]+}/playlists','channels::showplaylists','channels.showplaylists');

    $router->addGet('/playlists','playlists::index','playlists.index');
    $router->addGet('/playlists/{playlist:[0-9]+}','playlists::show','playlists.show');
    $router->addPost('/playlists/{playlist:[0-9]+}/addComment','playlists::addComment')->setName('playlists.addComment')->setMiddlewares([checkToken::class,isCommentValid::class]);
    $router->addGet('/playlists/{playlist:[0-9]+}/edit','playlists::edit')->setName('playlists.edit');
    $router->addPost('/playlists/{playlist:[0-9]+}/edit','playlists::edit')->setName('playlists.edit')->setMiddlewares([checkToken::class]);
    $router->addx('/playlists/{playlist:[0-9]+}/updateFromYoutube','playlists::updateFromYoutube')->setName('playlists.updateFromYoutube');
    $router->addPost('/playlists/{playlist:[0-9]+}/addTag','playlists::addTag')->setName('playlists.addTag')->setMiddlewares([checkToken::class,isTagValid::class]);

    $router->addx('/logout','auth::logout')->setName('logout');
    $router->addGet('/myLatestComments','auth::latestComments')->setName('myLatestComments');

    $router->addx('/comments/{comment:[0-9]+}','comments::show')->setName('comments.show');
    $router->addx('/comments/{comment:[0-9]+}/delete','comments::delete')->setName('comments.delete')->setMiddlewares([hasAuthority::over('comment')]);
    $router->addGet('/comments/{comment:[0-9]+}/edit','comments::edit')->setName('comments.edit')->setMiddlewares([hasAuthority::over('comment')]);
    $router->addPost('/comments/{comment:[0-9]+}/edit','comments::edit')->setName('comments.edit')->setMiddlewares([checkToken::class,hasAuthority::over('comment'),isCommentValid::class]);

    $router->addGet('/tags','tags::index')->setName('tags.index');
    $router->addGet('/tags/{tag:[0-9]+}','tags::show')->setName('tags.show');
    $router->addPost('/tags/{tag:[0-9]+}/addComment','tags::addComment')->setName('tags.addComment')->setMiddlewares([checkToken::class,isCommentValid::class]);
    $router->addGet('/tags/{tag:[0-9]+}/edit','tags::edit')->setName('tags.edit');
    $router->addPost('/tags/{tag:[0-9]+}/edit','tags::edit')->setName('tags.edit')->setMiddlewares([checkToken::class]);

    $router->addGet('/getYoutube/{key}','youtube::getMovie')->setName('youtube.getMovie');
    $router->addGet('/getYoutubeList/{key}','youtube::getList')->setName('youtube.getList');
});

$router->addGet('/register','auth::register')->setName('register');
$router->addPost('/register','auth::register')->setName('register')->setMiddlewares([checkToken::class]);
$router->addGet('/login','auth::login')->setName('login');
$router->addPost('/login','auth::login')->setName('login')->setMiddlewares([checkToken::class]);

return $router;
