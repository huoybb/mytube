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
        $searchUrl = 'https://www.youtube.com/results?search_query='.urlencode($this->entity->title);
        return $this->createLink($this->entity->getMovieUrl(),'视频链接').' '.$this->createLink($searchUrl,'相似搜索');
    }
    public function fileName()
    {
        $filename = FileInfo::getFileKey($this->entity->title);
        return "<pre>{$filename}</pre>";
    }
    public function downloadLink()
    {
        $url =  'http://en.savefrom.net/#url=' . $this->entity->getMovieUrl();
        return $this->createLink($url,'En.SaveFrom.Net');
    }
    public function tags()
    {
        $result = '';
        foreach($this->entity->getTags() as $tag){
            $url = $this->url->get(['for'=>'tags.show','tag'=>$tag->id]);
            $result .= ' '.$this->createLink($url,$tag->name,'btn btn-primary btn-xs');
        }
        return $result;
    }



}