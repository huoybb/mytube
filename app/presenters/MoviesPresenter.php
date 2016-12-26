<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/11/30
 * Time: 19:18
 */
class MoviesPresenter extends \core\myPresenter implements myEntityInterface
{
    use taggablePresenterTrait;
    /**
     * @var Movies
     */
    public $entity;
    public function description()
    {
        return "<pre>{$this->entity->description}</pre>";
    }
    public function channel()
    {
        $url = $this->url(['for'=>'channels.show','channel'=>$this->entity->channel_id]);
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
    public function key()
    {
        return "<pre>{$this->entity->key}</pre>";
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

    public function showLink()
    {
        $myTools = $this->di->get('myTools');
        $url = $this->url(['for'=>'movies.show','movie'=>$this->entity->id]);
        $title = $myTools->cut($this->entity->title);

        return "<a href='$url' title='{$this->entity->title}'>{$title}</a>";
    }
    public function type()
    {
        $url = $this->url(['for'=>'home']);
        return "<a href='{$url}' class='btn btn-danger btn-xs'>视频</a>";
    }

    public function completed()
    {
        if($this->entity->hasVideoFile){
            if(!$this->entity->duration) return '0%';
            $num = floor($this->entity->playtime/$this->entity->duration * 100);
            return $num.'%';
        }
        return null;
    }

    public function operation()
    {
        $movieButtons = [
            ['url'=>$this->url(['for'=>'movies.edit','movie'=>$this->entity->id]),'title'=>'编辑','class'=>"btn btn-warning btn-xs"],
            ['url'=>$this->url(['for'=>'movies.delete','movie'=>$this->entity->id]),'title'=>'删除','class'=>"btn btn-danger btn-xs"],
        ];

        $result = $this->insertButtonsToGroup($this->buildArrayOfLinkButtons($movieButtons));
        if(!$this->entity->hasVideoFile && $this->entity->getVideoFile()){
            $setFileButton=['url'=>$this->url(['for'=>'movies.setFile','movie'=>$this->entity->id]),'title'=>'确认视频文件','class'=>"btn btn-danger btn-xs"];
            $result .= ' '.$this->createLink($setFileButton['url'],$setFileButton['title'],$setFileButton['class']);
        }
        $result .= ' '.$this->addToWatchlistLinks();
        return $result;
    }

    public function addToWatchlistLinks()
    {
        $urls = [
            ['url'=>$this->url(['for'=>'watchlists.want.add','movie'=>$this->entity->id]),'title'=>'想看','class'=>"btn btn-warning btn-xs",'disabled'=>$this->lastWatchStatusIs('want')],
            ['url'=>$this->url(['for'=>'watchlists.doing.add','movie'=>$this->entity->id]),'title'=>'在看','class'=>"btn btn-warning btn-xs",'disabled'=>$this->lastWatchStatusIs('doing')],
            ['url'=>$this->url(['for'=>'watchlists.done.add','movie'=>$this->entity->id]),'title'=>'看过','class'=>"btn btn-warning btn-xs",'disabled'=>$this->lastWatchStatusIs('done')],
        ];
        return $this->insertButtonsToGroup($this->buildArrayOfLinkButtons($urls));
    }
    public function breadcrumbs()
    {
        $nav = [
            ['url'=>$this->url(['for'=>'home']),'value'=>'首页','isActive'=>false],
            ['url'=>$this->url(['for'=>'home']),'value'=>'视频','isActive'=>false],
            ['url'=>'','value'=>$this->entity->title,'isActive'=>true],
        ];
        return $this->buildBreadcrumbs($nav);
    }

    public function editTagUrl()
    {
        return $this->url(['for'=>'movies.tags','movie'=>$this->entity->id]);
    }
    public function deleteTag(Tags $tag)
    {
        $url = $this->url->get(['for'=>'movies.tags.delete','movie'=>$this->entity->id,'tag'=>$tag->id]);
        return $this->createLink($url,'删除');
    }

    private function lastWatchStatusIs($status)
    {
        $lastWatch = $this->entity->getLastWatch();
        if($lastWatch && $lastWatch->status == $status) return 'disabled';
        return null;
    }
    public function addAttachmentUrl()
    {
        return $this->url->get(['for'=>'movies.addAttachment','movie'=>$this->entity->id]);
    }
    public function attachmentListUrl()
    {
        return $this->url->get(['for'=>'movies.attachments.index','movie'=>$this->entity->id]);
    }
    public function created_at()
    {
        return $this->entity->created_at->diffForHumans();
    }
    public function commentCounts()
    {
        if($this->entity->commentCounts) return $this->entity->commentCounts;
        return null;
    }



}