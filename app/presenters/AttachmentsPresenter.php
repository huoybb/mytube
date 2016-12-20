<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/18
 * Time: 20:26
 */
class AttachmentsPresenter extends \core\myPresenter
{
    /** @var  Attachments */
    public $entity;
    public function getFileSize()
    {
        /** @var \core\myTools $myTools */
        $myTools = $this->di->get('myTools');
        return $myTools->formatSizeUnits($this->entity->getFileSize());
    }
    public function getFileBaseName()
    {
        return basename($this->entity->url);
    }
    public function operation()
    {
        $links = [
            [
                'url'=>"#",
                'title'=>'编辑',
                'class'=>'btn btn-warning btn-xs'
            ],
            [
                'url'=>$this->url(['for'=>'attachments.delete','attachment'=>$this->entity->id]),
                'title'=>'删除',
                'class'=>'btn btn-danger btn-xs'
            ],
        ];
        return $this->buildArrayOfLinkButtons($links);
    }




}