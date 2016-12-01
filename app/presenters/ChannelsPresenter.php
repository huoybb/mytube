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
    public function YoutubeLink()
    {
        return $this->youtubePrefix($this->entity->url);
    }
    public function moviesCount()
    {
        return $this->entity->movies()->count();
    }


}