<?php

class YoutubeController extends ControllerBase
{

    public function getMovieAction($key)
    {
        $movie = Movies::findOrDownloadByKey($key);
        return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
    }

    public function getListAction($key)
    {
        $playlist = Playlists::findOrDownloadByKey($key);
        dd($playlist);//后续将列表的视图也要搞出来
    }

}

