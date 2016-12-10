<?php

class IndexController extends \core\myController
{

    public function indexAction($page = 1)
    {
        $page = $this->getPaginatorByQueryBuilder(Movies::getlatest(),50,$page);
        $this->view->page =$page;
        $this->view->movies = $page->items;
        $this->view->moviesTotal = $page->total_items;
    }
    public function notFoundAction()
    {
        dd('"'.$this->router->getRewriteUri().'"不是有效的路由，请检查routes.php文件，确认设置正确');
    }

    public function searchAction($search)
    {
        if($this->isMatchedForYoutubeKey($search) && $movie = Movies::findByKey($search)){
            return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
        }
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
