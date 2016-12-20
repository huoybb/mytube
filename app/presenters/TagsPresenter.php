<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 18:00
 */
class TagsPresenter extends \core\myPresenter implements  myEntityInterface
{
    /**
     * @var Tags
     */
    public $entity;
    public function count()
    {
        if(property_exists($this->entity,'count')) return $this->entity->count;
        return $this->entity->getTaggedObjects()->count();
    }
    public function title()
    {
        return $this->entity->name;
    }

    public function showLink()
    {
        $url = $this->url(['for'=>'tags.show','tag'=>$this->entity->id]);
        return $this->createLink($url,$this->entity->name);
    }
    public function type()
    {
        $url = $this->url(['for'=>'tags.index']);
        return "<a href='{$url}' class='btn btn-info btn-xs'>标签</a>";
    }
    public function operation()
    {
        $url = $this->url(['for'=>'tags.edit','tag'=>$this->entity->id]);
        return $this->createLink($url,'编辑');
    }
    public function description()
    {
        return "<pre>{$this->entity->description}</pre>";
    }

    public function breadcrumbs()
    {
        $nav = [
            ['url'=>$this->url(['for'=>'home']),'value'=>'首页','isActive'=>false],
            ['url'=>$this->url(['for'=>'tags.index']),'value'=>'标签','isActive'=>false],
            ['url'=>'','value'=>$this->entity->name,'isActive'=>true],
        ];
        return $this->buildBreadcrumbs($nav);
    }
    public function addAttachmentUrl()
    {
        return $this->url->get(['for'=>'tags.addAttachment','tag'=>$this->entity->id]);
    }
    public function attachmentListUrl()
    {
        return $this->url->get(['for'=>'tags.attachments','tag'=>$this->entity->id]);
    }
}