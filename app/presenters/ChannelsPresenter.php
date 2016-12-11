<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/1
 * Time: 15:42
 */
class ChannelsPresenter extends \core\myPresenter implements youtubeLinkInterface, myEntityInterface
{
    /**
     * @var Channels
     */
    protected $entity;

    public function moviesCount()
    {
        return $this->entity->movies()->count();
    }
    public function playlistsCount()
    {
        if($this->entity->playlists()->count()) return $this->entity->playlists()->count();
        return null;
    }

    public function youtube()
    {
        $url = $this->youtubePrefix($this->entity->url);
        if(!$this->entity->url) $url = $this->youtubePrefix($this->entity->uploader_url);
        return $this->createLink($url,'频道链接');
    }
    public function showLink()
    {
        $url = $this->url(['for'=>'channels.show','channel'=>$this->entity->id]);
        return $this->createLink($url,$this->entity->title);
    }
    public function type()
    {
        $url = $this->url(['for'=>'channels.index']);
        return "<a href='{$url}' class='btn btn-warning btn-xs'>频道</a>";
    }
    public function operation()
    {
        $url = $this->url(['for'=>'channels.edit','channel'=>$this->entity->id]);
        return $this->createLink($url,'编辑');
    }
    public function breadcrumbs()
    {
        $nav = [
            ['url'=>$this->url(['for'=>'home']),'value'=>'首页','isActive'=>false],
            ['url'=>$this->url(['for'=>'channels.index']),'value'=>'频道','isActive'=>false],
            ['url'=>'','value'=>$this->entity->title,'isActive'=>true],
        ];
        return $this->buildBreadcrumbs($nav);
    }


}