<?php

class CommentsController extends ControllerBase
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
        $comment->delete();
        return $this->redirectBack();
    }


}

