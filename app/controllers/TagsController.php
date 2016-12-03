<?php

class TagsController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $this->view->tags = Tags::find();
    }

    public function showAction(Tags $tag)
    {
        $this->view->mytag = $tag;
    }


}

