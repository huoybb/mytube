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

}