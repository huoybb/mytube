<?php

class MoviesController extends ControllerBase
{

    public function indexAction()
    {

    }
    public function showAction(Movies $movie)
    {
        $this->view->movie = $movie;
        $this->view->file = $movie->getVideoFile();
        $this->view->commentForm = new commentForm(new Comments());
    }
    public function addCommentAction(Movies $movie)
    {
        $movie->addComment($this->request->getPost());
        return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
    }



}

