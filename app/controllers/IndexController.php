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
        $this->view->moviesTotal = Movies::count();
    }
    public function notFoundAction()
    {
        dd('"'.$this->router->getRewriteUri().'"不是有效的路由，请检查routes.php文件，确认设置正确');
    }

    public function searchAction($search)
    {
        $this->view->movies = Movies::search($search);
        $this->view->search = $search;
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
