<?php

class TagsController extends \core\myController
{
    public function indexAction()
    {
        $this->view->tags = Tags::getLastesByUser($this->auth->user());
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
    public function editAction(Tags $tag)
    {
        if($this->request->isPost()){
            $tag->save($this->request->getPost());
            return $this->redirect(['for'=>'tags.show','tag'=>$tag->id]);
        }
        $this->view->mytag = $tag;
    }
}

