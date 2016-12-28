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
$router->notFound('error::notFound');
$router->group([isLogin::class],function() use($router){
    $router->addGet('/','index::index','home');
    $router->addGet('/page/{page:[0-9]+}','index::index','home.page');
    $router->addx('/search/{search}','index::search','search');

    $router->addGet('/movies/withVideos','movies::withVideos','movies.index.withVideos');
    $router->addGet('/movies/withVideos/{page:[0-9]+}','movies::withVideos','movies.index.withVideos.page');
    $router->addGet('/movies/{movie:[0-9]+}','movies::show','movies.show');
    $router->addx('/movies/{movie:[0-9]+}/edit','movies::edit','movies.edit')->setMiddlewares([checkToken::class,hasAuthority::over('movie'),MoviesForm::class]);
    $router->addx('/movies/{movie:[0-9]+}/delete','movies::delete','movies.delete')->setMiddlewares([hasAuthority::over('movie')]);

    $router->addPost('/movies/{movie:[0-9]+}/addComment','movies::addComment','movies.addComment')->setMiddlewares([deleteMovieCache::over('movie'),CommentsForm::class]);

    $router->addx('/movies/{movie:[0-9]+}/setFile','movies::setFile','movies.setFile')->setMiddlewares([hasAuthority::over('movie')]);
    $router->addx('/movies/{movie:[0-9]+}/updatePlayTime','movies::updatePlayTime','movies.updatePlayTime');
    $router->addPost('/movies/{movie:[0-9]+}/addVideoTag','movies::addVideoTag','movies.addVideoTag');
    $router->addx('/movies/{movie:[0-9]+}/editMovietags','movies::editMovietags','movies.editMovietags');

    $router->addx('/movies/{movie:[0-9]+}/tags','movies::tags','movies.tags');
    $router->addPost('/movies/{movie:[0-9]+}/tags/add','movies::addTag','movies.addTag')->setMiddlewares([TagsForm::class]);
    $router->addx('/movies/{movie:[0-9]+}/tags/{tag:[0-9]+}/delete','movies::deleteTag','movies.tags.delete');

    $router->addx('/movies/{movie:[0-9]+}/addAttachment','movies::addAttachment','movies.addAttachment');
    $router->addx('/movies/{movie:[0-9]+}/attachments','movies::attachmentList','movies.attachments.index');

    $router->addGet('/channels','channels::index','channels.index');
    $router->addGet('/channels/{channel:[0-9]+}','channels::show','channels.show');
    $router->addx('/channels/{channel:[0-9]+}/edit','channels::edit','channels.edit')->setMiddlewares([checkToken::class]);
    $router->addPost('/channels/{channel:[0-9]+}/addComment','channels::addComment','channels.addComment')->setMiddlewares([checkToken::class,CommentsForm::class]);
    $router->addGet('/channels/{channel:[0-9]+}/playlists','channels::showplaylists','channels.showplaylists');

    $router->addGet('/playlists','playlists::index','playlists.index');
    $router->addGet('/playlists/{playlist:[0-9]+}','playlists::show','playlists.show');
    $router->addx('/playlists/{playlist:[0-9]+}/edit','playlists::edit','playlists.edit')->setMiddlewares([checkToken::class]);
    $router->addPost('/playlists/{playlist:[0-9]+}/addComment','playlists::addComment','playlists.addComment')->setMiddlewares([checkToken::class,CommentsForm::class]);
    $router->addx('/playlists/{playlist:[0-9]+}/updateFromYoutube','playlists::updateFromYoutube','playlists.updateFromYoutube');

    $router->addPost('/playlists/{playlist:[0-9]+}/addTag','playlists::addTag','playlists.addTag')->setMiddlewares([checkToken::class,TagsForm::class]);
    $router->addGet('/playlists/{playlist:[0-9]+}/editTag','playlists::editTag','playlists.editTag');
    $router->addx('/playlists/{playlist:[0-9]+}/deleteTag/{tag:[0-9]+}','playlists::deleteTag','playlists.deleteTag');

    $router->addx('/logout','auth::logout','logout');
    $router->addGet('/myLatestComments','auth::latestComments','myLatestComments');

    $router->addx('/comments/{comment:[0-9]+}','comments::show','comments.show');
    $router->addx('/comments/{comment:[0-9]+}/delete','comments::delete','comments.delete')->setMiddlewares([hasAuthority::over('comment')]);
    $router->addx('/comments/{comment:[0-9]+}/edit','comments::edit','comments.edit')->setMiddlewares([checkToken::class,hasAuthority::over('comment'),CommentsForm::class]);

    $router->addGet('/tags','tags::index','tags.index');
    $router->addGet('/tags/{tag:[0-9]+}','tags::show','tags.show');
    $router->addPost('/tags/{tag:[0-9]+}/addComment','tags::addComment','tags.addComment')->setMiddlewares([checkToken::class,CommentsForm::class]);
    $router->addx('/tags/{tag:[0-9]+}/edit','tags::edit','tags.edit')->setMiddlewares([checkToken::class,TagsForm::class]);
    $router->addx('/tags/{tag:[0-9]+}/addAttachment','tags::addAttachment','tags.addAttachment');
    $router->addx('/tags/{tag:[0-9]+}/attachments','tags::attachments','tags.attachments');

    $router->addGet('/getYoutube/{key}','youtube::getMovie','youtube.getMovie');
    $router->addGet('/getYoutubeWithList/{movieKey}/{listKey}/{index}','youtube::getMovieWithList','youtube.getMovieWithList');
    $router->addGet('/getYoutubeList/{key}','youtube::getList','youtube.getList');

    $router->addGet('/videotags','videotags::index','videotags.index');
    $router->addGet('/videotags/{videotag:[0-9]+}/delete','videotags::delete','videotags.delete');

    $router->addx('/watchlists/want','watchlists::want','watchlists.want');
    $router->addx('/watchlists/want/page/{page:[0-9]+}','watchlists::want','watchlists.want.page');
    $router->addx('/watchlists/want/{movie:[0-9]+}','watchlists::addToWantList','watchlists.want.add');

    $router->addx('/watchlists/doing','watchlists::doing','watchlists.doing');
    $router->addx('/watchlists/doing/page/{page:[0-9]+}','watchlists::doing','watchlists.doing.page');
    $router->addx('/watchlists/doing/{movie:[0-9]+}','watchlists::addToDoingList','watchlists.doing.add');

    $router->addx('/watchlists/done','watchlists::done','watchlists.done');
    $router->addx('/watchlists/done/page/{page:[0-9]+}','watchlists::done','watchlists.done.page');
    $router->addx('/watchlists/done/{movie:[0-9]+}','watchlists::addToDoneList','watchlists.done.add');

    $router->addGet('/attachments','attachments::index','attachments.index');
    $router->addGet('/attachments/page/{page:[0-9]+}','attachments::index','attachments.index.page');
    $router->addx('/attachments/{attachment:[0-9]+}/delete','attachments::delete','attachments.delete');
});

$router->addGet('/register','auth::register','register');
$router->addPost('/register','auth::register','register')->setMiddlewares([checkToken::class,isRegisterValid::class]);
$router->addGet('/login','auth::login','login');
$router->addPost('/login','auth::login','login')->setMiddlewares([checkToken::class]);

return $router;
