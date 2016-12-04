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

    private function fixChannelsData()
    {
        foreach(Channels::find() as $channel){
            $uploader_url = $channel->movies()->getFirst()->uploader_url;
            if(preg_match('%/user/([^/]+)%sim', $uploader_url)){
                $channel->save(['uploader_url'=>$uploader_url]);
            }
            var_dump($uploader_url);
        }
    }


}
