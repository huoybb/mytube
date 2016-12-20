<?php

class AttachmentsController extends \core\myController
{

    public function indexAction($page = 1)
    {
        $this->view->page = $this->getPaginatorByQueryBuilder(Attachments::getLatestQuery(),10,$page);
    }
    public function deleteAction(Attachments $attachment)
    {
        $this->eventsManager->trigger(new AttachmentDeleted($attachment));
        $attachment->delete();
        return $this->redirectBack();
    }

}

