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
    protected $entity;
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



}