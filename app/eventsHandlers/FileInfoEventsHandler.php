<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/16
 * Time: 14:58
 */
class FileInfoEventsHandler
{
    public function whenMovieDeleted(MovieDeleted $event)
    {
        if($file = FileInfo::getFilePathFromMovie($event->movie)) unlink($file);
    }
    public function whenAttachmentDeleted(AttachmentDeleted $event)
    {
        if($file = FileInfo::getFilePathFromAttachment($event->attachment)) unlink($file);
    }

}