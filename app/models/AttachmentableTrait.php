<?php

/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2016/12/18
 * Time: 20:20
 */
trait AttachmentableTrait
{
    public function uploadAndStoreAttachments(\Phalcon\Http\Request $request)
    {
        /** @var Movies $this */
        $this->getEventsManager()->trigger(new MoviesAttachmentAdded($this));
        /** @var \core\myTools $myTools */
        $myTools = \core\myDI::make('myTools');
        $files = [];
        foreach($request->getUploadedFiles() as $f){
            $data = [];
            $data['name'] = $f->getName();
            $data['url']=$myTools->storeAttachment($f);
            $data['user_id'] = auth()->user()->id;
            $data['attachmentable_id'] = $this->id;
            $data['attachmentable_type'] = get_class($this);

            $attachment = (new Attachments());
            $attachment->save($data);

            $files[] = $attachment;
        }
        return $files;
    }
    public function attachments()
    {
        return $this->make('attachments',function(){
            return Attachments::findByAttachmentable($this);
        });
    }
    public function hasAttachments()
    {
        return count($this->attachments());
    }
}