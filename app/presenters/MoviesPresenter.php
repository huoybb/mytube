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
        $url = $this->youtubePrefix($this->entity->channel_url);
        $title = $this->entity->channel_title;
        return "<a href='{$url}' target='_blank'>{$title}</a>";
    }
    public function uploader()
    {
        $url = $this->youtubePrefix($this->entity->uploader_url);
        return "<a href='{$url}' target='_blank'>上传者</a>";
    }
    public function created_at()
    {
        return $this->entity->created_at->diffForHumans();
    }

    private function youtubePrefix($url)
    {
        return 'https://www.youtube.com/'.$url;
    }


}