<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/3
 * Time: 18:00
 */
class TagsPresenter extends \core\myPresenter
{
    /**
     * @var Tags
     */
    protected $entity;
    public function count()
    {
        return $this->entity->getTaggedObjects()->count();
    }
    public function title()
    {
        return $this->entity->name;
    }

    public function showLink()
    {
        return $this->url->get(['for'=>'tags.show','tag'=>$this->entity->id]);
    }
    public function type()
    {
        $url = $this->url->get(['for'=>'tags.index']);
        return "<a href='{$url}' class='btn btn-info btn-xs'>标签</a>";
    }

}