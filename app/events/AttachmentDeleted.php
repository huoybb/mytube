<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/20
 * Time: 17:21
 */
class AttachmentDeleted
{
    public $attachment;

    /**
     * AttachmentDeleted constructor.
     * @param Attachments $attachment
     */
    public function __construct(Attachments $attachment)
    {
        $this->attachment = $attachment;
    }

}