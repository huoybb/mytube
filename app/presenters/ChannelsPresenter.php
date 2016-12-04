<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/1
 * Time: 15:42
 */
class ChannelsPresenter extends \core\myPresenter
{
    /**
     * @var Channels
     */
    protected $entity;

    public function moviesCount()
    {
        return $this->entity->movies()->count();
    }
    public function youtube()
    {
        $url = $this->youtubePrefix($this->entity->url);
        return $this->createLink($url,'频道链接');
    }
    public function showLink()
    {
        $url = $this->url->get(['for'=>'channels.show','channel'=>$this->entity->id]);
        return $this->createLink($url,$this->entity->title);
    }
    public function type()
    {
        $url = $this->url->get(['for'=>'channels.index']);
        return "<a href='{$url}' class='btn btn-warning btn-xs'>频道</a>";
    }




}