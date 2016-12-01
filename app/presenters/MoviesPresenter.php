<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/30
 * Time: 19:18
 */
class MoviesPresenter extends \core\myPresenter
{
    /**
     * @var Movies
     */
    protected $entity;
    public function description()
    {
        return "<pre>{$this->entity->description}</pre>";
    }
    public function channel()
    {
        $url = $this->url->get(['for'=>'channels.show','channel'=>$this->entity->channel_id]);
        $title = $this->entity->channel_title;
//        return "<a href='{$url}' target='_blank'>{$title}</a>";
        return $this->createLink($url,$title);
    }
    public function uploader()
    {
        $url = $this->youtubePrefix($this->entity->uploader_url);
        return "<a href='{$url}' target='_blank'>上传者</a>";
    }
    public function youtubeUrl()
    {
        return $this->createLink($this->entity->getMovieUrl(),'链接');
    }
    public function fileName()
    {
        return "<pre>{$this->entity->getFileKey()}</pre>";
    }
    public function downloadLink()
    {
        $url =  'http://en.savefrom.net/#url=' . $this->entity->getMovieUrl();
        return $this->createLink($url,'En.SaveFrom.Net');
    }


}