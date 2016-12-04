<?php

class TagsController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->tags = Tags::find();
    }

    public function showAction(Tags $tag)
    {
        $this->view->mytag = $tag;
    }

    public function addCommentAction(Tags $tag)
    {
        $tag->addComment($this->request->getPost());
        return $this->redirect(['for'=>'tags.show','tag'=>$tag->id]);
    }



}

