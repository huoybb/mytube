<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
//        foreach(Movies::find() as $movie){
//            if(!$movie->channel_id){
//                $channel = Channels::findByUrl($movie->channel_url);
//                if(!$channel) {
//                    $channel = new Channels(['title'=>$movie->channel_title,'url'=>$movie->channel_url]);
//                    $channel->save();
//                }
//                $movie->save(['channel_id'=>$channel->id]);
//            }
//        }
        $this->view->movies = Movies::getlatest();
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

    public function searchAction($search)
    {
        $this->view->movies = Movies::search($search);
        $this->view->search = $search;
    }

    public function showChannelAction($channel)
    {
        $this->view->movies = Movies::findByChannel($channel);
        $this->view->channel = $channel;
    }



}
