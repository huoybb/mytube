<?php

class YoutubeController extends \core\myController
{

    public function getMovieAction($key)
    {
        $movie = Movies::findOrDownloadByKey($key);
        return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
    }

    public function getListAction($key)
    {
        $playlist = Playlists::findOrDownloadByKey($key);
        return $this->redirect(['for'=>'playlists.show','playlist'=>$playlist->id]);
    }
    public function getMovieWithListAction($movieKey,$listKey,$index)
    {
        $playlist = Playlists::findOrDownloadByKey($listKey);
        $movie = Movies::findOrDownloadByKey($movieKey);
        Playlistables::UpdateOrNewByData($playlist,$movie,$index);
        return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);

    }


}

