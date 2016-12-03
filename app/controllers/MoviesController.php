<?php

class MoviesController extends ControllerBase
{

    public function indexAction()
    {

    }
    public function showAction(Movies $movie)
    {
        $this->view->movie = $movie;
    }
    public function addCommentAction(Movies $movie)
    {
        $movie->addComment($this->request->getPost());
        return $this->redirect(['for'=>'movies.show','movie'=>$movie->id]);
    }



}

