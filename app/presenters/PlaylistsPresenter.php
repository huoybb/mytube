<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/4
 * Time: 17:42
 */
class PlaylistsPresenter extends \core\myPresenter implements youtubeLinkInterface, myEntityInterface
{
    /**
     * @var Playlists
     */
    protected $entity;
    public function showLink()
    {
        $url = $this->url->get(['for'=>'playlists.show','playlist'=>$this->entity->id]);
        return $this->createLink($url,$this->entity->title);
    }
    public function channel()
    {
        $channel = Channels::findFirst($this->entity->channel_id);
        $url = $this->url->get(['for'=>'channels.show','channel'=>$channel->id]);
        return $this->createLink($url,$channel->title);
    }
    public function count()
    {
        return  $this->entity->movies()->count();
    }
    public function lastUpdated()
    {
        return $this->entity->lastUpdated;
    }
    public function type()
    {
        $url = $this->url->get(['for'=>'playlists.index']);
        return "<a href='{$url}' class='btn btn-primary btn-xs'>列表</a>";
    }

    public function youtube()
    {
        $url = '/playlist?list='.$this->entity->key;
        $url = $this->youtubePrefix($url);
        return $this->createLink($url,'列表链接');
    }
    public function operation()
    {
        $url = $this->url->get(['for'=>'playlists.edit','playlist'=>$this->entity->id]);
        $result = $this->createLink($url,'编辑');
        $url = $this->url->get(['for'=>'playlists.updateFromYoutube','playlist'=>$this->entity->id]);
        $result .= ' '.$this->createLink($url,'更新');
        return $result;
    }
    // todo 需要与moviespresenter一起提取出trait来使用
    public function tags()
    {
        $result = '';
        foreach($this->entity->getTags() as $tag){
            $url = $this->url->get(['for'=>'tags.show','tag'=>$tag->id]);
            $result .= ' '.$this->createLink($url,$tag->name."({$tag->count})",'btn btn-primary btn-xs');
        }
        return $result;
    }


    public function breadcrumbs()
    {
        $nav = [
            ['url'=>$this->url->get(['for'=>'home']),'value'=>'首页','isActive'=>false],
            ['url'=>$this->url->get(['for'=>'playlists.index']),'value'=>'列表','isActive'=>false],
            ['url'=>'','value'=>$this->entity->title,'isActive'=>true],
        ];
        return $this->buildBreadcrumbs($nav);
    }
}