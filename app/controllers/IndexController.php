<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
       $this->view->movies = Movies::getLatest();
    }
    public function notFoundAction()
    {
        dd('没有找到路由');

    }

    public function getYoutubeAction($key)
    {
        $movie = Movies::findOrDownloadByKey($key);
        return $this->response->redirect($this->url->get(['for'=>'movies.show','movie'=>$movie->id]));
    }

}
