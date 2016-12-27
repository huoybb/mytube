<?php

class IndexController extends \core\myController
{

    public function indexAction($page = 1)
    {
        $this->view->page = $this->getPaginatorByQueryBuilder(Movies::getLatestWithComments(),50,$page);
    }

    public function searchAction($search)
    {
        if($this->isMatchedForYoutubeKey($search) && $movie = Movies::findByKey($search)){
            return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
        }
        $this->view->movies = Movies::search($search);
        $this->view->search = $search;
    }

    private function isMatchedForYoutubeKey(&$key)
    {
        if(strlen($key) == 11) return true;
        if(strlen($key) == 15 && preg_match('/.+\.mp4/sim', $key)) {
            $key = str_replace('.mp4','',$key);
            return true;
        }
        return false;
    }


}
