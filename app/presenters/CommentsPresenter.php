<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/5
 * Time: 8:39
 */
class CommentsPresenter extends \core\myPresenter
{
    /**
     * @var Comments
     */
    protected $entity;
    public function content()
    {
        return "<pre>{$this->entity->content}</pre>";
    }
    public function commentable()
    {
        $object = $this->entity->commentable();
        return $object->present('showLink');
    }
    public function user()
    {
        return $this->entity->user()->name;
    }



}