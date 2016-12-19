<?php

class AttachmentsController extends \core\myController
{

    public function indexAction($page = 1)
    {
        $this->view->page = $this->getPaginatorByQueryBuilder(Attachments::getLatestQuery(),10,$page);
    }

}

