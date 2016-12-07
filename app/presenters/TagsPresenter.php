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
    protected $entity;
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
        $url = $this->url->get(['for'=>'tags.show','tag'=>$this->entity->id]);
        return $this->createLink($url,$this->entity->name);
    }
    public function type()
    {
        $url = $this->url->get(['for'=>'tags.index']);
        return "<a href='{$url}' class='btn btn-info btn-xs'>标签</a>";
    }
    public function operation()
    {
        $url = $this->url->get(['for'=>'tags.edit','tag'=>$this->entity->id]);
        return $this->createLink($url,'编辑');
    }
    public function description()
    {
        return "<pre>{$this->entity->description}</pre>";
    }


    public function breadcrumbs()
    {
        $result = <<<EOF
            <ol class="breadcrumb">
              <li><a href="{$this->url->get(['for'=>'home'])}">首页</a></li>
              <li><a href="{$this->url->get(['for'=>'tags.index'])}">标签</a></li>
              <li class="active">{$this->entity->name}</li>
            </ol>
EOF;
        return $result;
    }
}