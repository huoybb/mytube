<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/30
 * Time: 19:18
 */
class MoviesPresenter extends \core\myPresenter implements myEntityInterface
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
        return $this->createLink($url,'En.SaveFrom.Net','btn btn-info btn-xs');
    }
    public function tags()
    {
        $result = '';
        foreach($this->entity->getTags() as $tag){
            $url = $this->url->get(['for'=>'tags.show','tag'=>$tag->id]);
            $result .= ' '.$this->createLink($url,$tag->name."({$tag->count})",'btn btn-primary btn-xs');
        }
        return $result;
    }

    public function showLink()
    {
        $url = $this->url->get(['for'=>'movies.show','movie'=>$this->entity->id]);
        return $this->createLink($url,$this->entity->title);
    }
    public function type()
    {
        $url = $this->url->get(['for'=>'home']);
        return "<a href='{$url}' class='btn btn-danger btn-xs'>视频</a>";
    }

    public function completed()
    {
        if(!$this->entity->duration) return '0%';
        $num = floor($this->entity->playtime/$this->entity->duration * 100);
        return $num.'%';
    }

    public function operation()
    {
        $result = '';
        $url = $this->url->get(['for'=>'movies.edit','movie'=>$this->entity->id]);
        $result .= $this->createLink($url,'编辑',"btn btn-warning btn-xs");
        $url = $this->url->get(['for'=>'movies.delete','movie'=>$this->entity->id]);
        $result .= ' '.$this->createLink($url,'删除',"btn btn-danger btn-xs");
        return $result;
    }

    public function breadcrumbs()
    {
        $result = <<<EOF
            <ol class="breadcrumb">
              <li><a href="{$this->url->get(['for'=>'home'])}">首页</a></li>
              <li><a href="{$this->url->get(['for'=>'home'])}">视频</a></li>
              <li class="active">{$this->entity->title}</li>
            </ol>
EOF;
        return $result;
    }
}