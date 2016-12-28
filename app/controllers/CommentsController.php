<?php

class CommentsController extends \core\myController
{

    public function showAction(Comments $comment)
    {
        $this->view->comment = $comment;
    }

    public function editAction(Comments $comment)
    {
        if($this->request->isPost()){
            $comment->save($this->request->getPost());
            $this->redirect(['for'=>'comments.show','comment'=>$comment->id]);
        }
        $this->view->comment = $comment;
    }
    public function deleteAction(Comments $comment)
    {
        $this->handleCommentableCache($comment);
        $comment->delete();
        return $this->redirectBack();
    }

    /**
     * @param Comments $comment
     */
    protected function handleCommentableCache(Comments $comment)
    {
        $commentable = $comment->commentable();
        if ($this->view->getCache()->exists($commentable->getCacheKey())) {
            $this->view->getCache()->delete($commentable->getCacheKey());
        }
    }


}

