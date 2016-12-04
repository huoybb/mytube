<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/4
 * Time: 17:42
 */
class PlaylistsPresenter extends \core\myPresenter
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





}